<?php

namespace App\Controllers;

use App\Enums\EstadosCitas as EnumsEstadosCitas;
use CodeIgniter\Controller;
use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Event;
use App\Models\Evento;
use App\Models\Paciente;
use CodeIgniter\Database\Query;
use CodeIgniter\HTTP\Response;
use Enums\EstadosCitas;
use DateTime;


class Citas extends BaseController
{

    public function verCalendario()
    {
        if (!Comprobadores::isLogged()) {
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged', $tituloPagina);
            return view('/errors/error', $datos);
        } else {
            $this->VerificarCitasValidas();
            $doctores = new Doctor();
            $sql = "SELECT id_doctor, Nombre,Apellido, CONCAT(Nombre,' ',Apellido) as NombreCompleto,Genero,NumCelular,NumFijo,Especialidad,CorreoElectronico,FechaNac,Cedula,Edad from doctor";
            $query = $doctores->db->query($sql);
            $datos['doctores'] = $query->getResultArray();
            $paciente = new Paciente();
            $sqlPaciente = "SELECT id_paciente, Nombre,Apellido, CONCAT(Nombre,' ',Apellido) as NombreCompleto from paciente";
            $query = $paciente->db->query($sqlPaciente);
            $datos['pacientes'] = $query->getResultArray();
            $tituloPagina['TituloPagina'] = "Ver calendario";
            $datos['header'] = view('templates/Header', $tituloPagina);
            return view('Calendars/Calendario', $datos);
        }
    }


    public function verCitasPorEstado()
    {
        if (!Comprobadores::isLogged()) {
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged', $tituloPagina);
            return view('/errors/error', $datos);
        } else {
            $tituloPagina['TituloPagina'] = "Ver citas";
            $datos['header'] = view('templates/Header', $tituloPagina);
            return view('Calendars/citasPorEstado', $datos);
        }
    }


    public function obtenerTodasLasCitas($estado=null){
        $citasModel = new Cita();
        $estado = $_GET['estado'];
        $query = null;
        if($estado == "Ninguna"){
            $sql = "SELECT c.id_cita as id_cita ,CONCAT(p.Nombre,' ',p.Apellido) as 'Nombre del paciente',
                CONCAT(d.Nombre,' ',d.Apellido) as 'Nombre del doctor',c.Fecha as 'Fecha de la cita',c.HoraInicio as 'Hora de la cita',
                c.Estado as 'Estado' FROM cita c
                join doctor d on d.id_doctor = c.id_doctor
                join paciente p on p.id_paciente = c.id_paciente";
            $query = $citasModel->db->query($sql);
        }
        else{
            $sql = "SELECT c.id_cita as id_cita ,CONCAT(p.Nombre,' ',p.Apellido) as 'Nombre del paciente',
            CONCAT(d.Nombre,' ',d.Apellido) as 'Nombre del doctor',c.Fecha as 'Fecha de la cita',c.HoraInicio as 'Hora de la cita',
            c.Estado as 'Estado' FROM cita c
            join doctor d on d.id_doctor = c.id_doctor
            join paciente p on p.id_paciente = c.id_paciente
            where c.Estado = ?";
            $query = $citasModel->db->query($sql,$estado);
        }
        $citas=$query->getResultArray();
        return json_encode($citas);
    }


    
    private function VerificarCitasValidas()
    {
        $citas = new Cita();
        $fecha_actual = strtotime(date("Y-m-d"), time());
        $sql = "SELECT id_cita,id_paciente,id_doctor,Fecha,HoraInicio,HoraFin,Estado from cita";
        $query = $citas->db->query($sql);
        $citasObtenidas = $query->getResultArray();
        foreach ($citasObtenidas as $cita) {
            $fecha_cita = strtotime($cita['Fecha']);
            if ($fecha_actual > $fecha_cita) {
                if ($cita['Estado'] == "Confirmada") {
                    $cita['Estado'] == "Completa";
                } else if ($cita['Estado'] == "Pendiente") {
                    $cita['Estado'] = "Cancelada";
                } else {
                    $cita['Estado'] = "Cancelada";
                }
                $citas->update($cita['id_cita'], $cita);
            }
        }
    }

    public function show()
    {
        $citas = new Cita();
        // $sql= "SELECT id_cita,id_paciente,id_doctor,Fecha,HoraInicio,HoraFin,Estado,CorreoElectronico from cita 
        // join doctor
        // where id_doctor = ? and (Estado = 'Pendiente' or Estado = 'Confirmada') ";
        // $query = $citas->db->query($sql);
        $sql = "SELECT cita.id_cita,cita.id_paciente,cita.id_doctor,cita.Fecha,cita.HoraInicio,cita.HoraFin,
        cita.Estado,doctor.Nombre,doctor.Apellido, CONCAT(doctor.Nombre,' ',doctor.Apellido) as NombreCompleto,
        paciente.Nombre,paciente.Apellido, CONCAT(paciente.Nombre,' ',paciente.Apellido) as NombreCompletoPaciente from cita
        join doctor on doctor.id_doctor =  cita.id_doctor
        join paciente on paciente.id_paciente = cita.id_paciente
        where (Estado = 'Pendiente' or Estado = 'Confirmada') ";
        $query = $citas->db->query($sql);
        $citasCreadas = $query->getResultArray();
        $jsonevent = array();
        foreach ($citasCreadas as $citaCreada) {
            $jsonevent[] = array(
                "title" => "Cita de " . $citaCreada['NombreCompletoPaciente'],
                "descripcion" => "Doctor a cargo " . $citaCreada['NombreCompleto'],
                "start" => date(DATE_ISO8601, strtotime($citaCreada['Fecha'] . " " . $citaCreada['HoraInicio'])),
                'allDay' => false,
                "end" => date(DATE_ISO8601, strtotime($citaCreada['Fecha'] . " " . $citaCreada['HoraFin']))
            );
        }
        return json_encode($jsonevent);
    }


    public function agendarCita($idDoctor = null, $fecha = null, $hora = null, $idPaciente = null)
    {

        $idDoctor = $_POST['idDoctor'];
        $fecha = new DateTime($_POST['fecha']);
        $hora = $_POST['hora'];
        $fechaFinal = new DateTime($fecha->format('Y-m-d ') . " " . strval($hora));
        $idPaciente = $_POST['idPaciente'];
        $citas = new Cita();
        $FechaCita = $fecha->format('Y/m/d');
        $strtime = strtotime($fechaFinal->format('Y-m-d H:i'));
        $horaInicio = date("H:i", $strtime);
        $horaFin = date("H:i", strtotime('+1 hour', $strtime));
        $estado = "Pendiente";
        if ($this->comprobarDisponibilidad($idDoctor, $horaInicio, $horaFin, $fecha->format('Y-m-d '))) {

            $citaAInsertar = [
                'id_paciente' => $idPaciente,
                'id_doctor' => $idDoctor,
                'Fecha' => $FechaCita,
                'HoraInicio' => $horaInicio,
                'HoraFin' => $horaFin,
                'Estado' => $estado,
                'HayQueMultar' => false,
                'CitaMultada' => false
            ];
            $citas->insert($citaAInsertar);
            $idCita = $citas->getInsertID();
            $eventos = new Evento();
            $pacientes = new Paciente();
            $doctores = new Doctor();
            $sqlDoctor = "SELECT id_doctor,Nombre,Apellido, CONCAT(Nombre,' ',Apellido) as NombreCompleto from doctor where id_doctor= ? ";
            $queryDoctor = $doctores->db->query($sqlDoctor, $idDoctor);
            $doctorObtenido = $queryDoctor->getRowArray();
            $sqlPaciente = "SELECT id_paciente,Nombre,Apellido, CONCAT(Nombre,' ',Apellido) as NombreCompleto from paciente where id_paciente = ?";
            $queryPaciente = $pacientes->db->query($sqlPaciente, $idPaciente);
            $pacienteObtenido = $queryPaciente->getRowArray();
            $evento = [
                "title" => "Cita de " . $pacienteObtenido['NombreCompleto'],
                "descripcion" => "Doctor a cargo " . $doctorObtenido['NombreCompleto'],
                "start" => date(DATE_ISO8601, strtotime($FechaCita . " " . $horaInicio)),
                "end" => date(DATE_ISO8601, strtotime($FechaCita . " " . $horaFin)),
                "id_doctor" => $idDoctor,
                'id_cita' => $idCita
            ];
            $eventos->insert($evento);
            $data['url'] = base_url('/Citas/verCalendario');
            $data['available'] = true;
            return json_encode($data, JSON_FORCE_OBJECT);
        } else {
            $data['url'] = base_url('/Citas/verCalendario');
            $data['available'] = false;
            return json_encode($data, JSON_FORCE_OBJECT);
        }
    }

    public function comprobarDisponibilidad($idDoctor, $horaInicio, $horaFin, $fecha)
    {
        $cita = new Cita();
        $sql = "SELECT id_cita,id_paciente,id_doctor,Fecha,HoraInicio,HoraFin,Estado from cita where id_doctor = ? and fecha = ? and (Estado = 'Pendiente' or Estado = 'Confirmada') ";
        $query = $cita->db->query($sql, array($idDoctor, $fecha));
        $citas = $query->getResultArray();
        if (sizeof($citas) > 0) {
            foreach ($citas as $cita) {
                if (
                    date("H:i", strtotime($horaInicio)) >= date("H:i", strtotime($cita['HoraInicio'] . " " . $cita['Fecha']))
                    && date("H:i", strtotime($horaInicio)) <=  date("H:i", strtotime($cita['HoraFin'] . " " . $cita['Fecha']))
                ) {
                    return false;
                } else if (
                    date("H:i", strtotime($horaInicio)) <= date("H:i", strtotime($cita['HoraInicio'] . " " . $cita['Fecha']))
                    && date("H:i", strtotime($horaFin)) <= date("H:i", strtotime($cita['HoraFin'] . " " . $cita['Fecha']))
                ) {
                    return false;
                }
            }
            return true;
        } else {
            return true;
        }
    }
}
