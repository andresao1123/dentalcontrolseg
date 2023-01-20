<?php 
namespace App\Controllers;

use App\Models\Historial;
use CodeIgniter\Controller;
use App\Models\Tratamiento;
use DateTime;

class Tratamientos extends BaseController{



    public function verTratamientos($idPaciente=null){
        if(Comprobadores::isLogged()){
        $tratamiento = new Tratamiento();
        $tituloPagina['TituloPagina'] = "Ver tratamientos";
        $datos['header'] = view('templates/Header',$tituloPagina);
        $sqlTratamientos = "SELECT tratamiento.id_tratamiento, tratamiento.Nombre, tratamiento.Tipo, tratamiento.Fecha,tratamiento.Presupuesto, 
            tratamiento.Abono, tratamiento.Saldo, tratamiento.FormaPago, tratamiento.FechaPago FROM tratamiento
            JOIN historial on historial.id_historial = tratamiento.id_historial
            join paciente on paciente.id_paciente = historial.id_paciente
            where paciente.id_paciente = ? ";
        $query = $tratamiento->db->query($sqlTratamientos,$idPaciente);
        $datos['tratamientos'] = $query->getResultArray();
        $datos['pacienteId'] = $idPaciente;
        return view('TratamientosViews/verTratamientos',$datos);
        }else{
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
    }


    public function crearTratamiento(){
        $tituloPagina['TituloPagina'] = "Crear tratamientos";
        $datos['header'] = view('templates/Header',$tituloPagina);
        $sql = "SELECT historial.id_historial, CONCAT(paciente.Nombre,' ',paciente.Apellido) AS 'NombreCompleto' FROM historial JOIN paciente ON paciente.id_paciente = historial.id_paciente";
        $historial = new Historial();
        $query=$historial->db->query($sql);
        $datos['historiales'] = $query->getResultArray();
        return view('TratamientosViews/CrearTratamiento',$datos);
    }


    public static function TieneSaldoPendiente($idTratamiento=null){
        $tratamiento = new Tratamiento();
        $SaldoPendiente=false;
        $tratamientos = $tratamiento->where('id_tratamiento',$idTratamiento)->first();
        if($tratamientos['Saldo'] > 0){
            $SaldoPendiente = true;
        }
        else{
            $SaldoPendiente = false;
        }
        return $SaldoPendiente;
    }

    public function agregarTratamiento(){
        $tratamiento = new Tratamiento();
        $idHistorial = $_POST['idHistorial'];
        $Nombre = $this->request->getVar('Nombre');
        $Tipo = $this->request->getVar('Tipo');
        $FechaTrat = new DateTime($this->request->getVar('FechaTrat'));
        $FechaTrat = $FechaTrat->format('Y/m/d');
        $fechaPago = $FechaTrat;
        $Presupuesto = floatval($this->request->getVar('Presupuesto'));
        $Abono = floatval($this->request->getVar('Abono'));
        $Saldo = $Presupuesto - $Abono;
        $FormaPago = $_POST['FormaPago'];
        $datosTratamiento = [
            'id_historial' => $idHistorial,
            'Nombre' =>$Nombre,
            'Tipo' => $Tipo,
            'Fecha'=> $FechaTrat,
            'Presupuesto' => $Presupuesto,
            'Abono' => $Abono,
            'Saldo' => $Saldo,
            'FormaPago' =>$FormaPago,
            'FechaPago' =>$fechaPago
        ];
        $tratamiento->insert($datosTratamiento);
        return redirect()->to('/');
    }

    public function borrarTratamiento($id=null, $IdPaciente=null){
        $tratamiento = new Tratamiento();
        $id = $_GET['id'];
        $IdPaciente = $_GET['IdPaciente'];
        $datosTratamiento = $tratamiento->where('id_tratamiento',$id)->first();
        $tratamiento->delete($datosTratamiento);
        $sqlTratamientos = "SELECT tratamiento.id_tratamiento, tratamiento.Nombre, tratamiento.Tipo, tratamiento.Fecha,tratamiento.Presupuesto, 
            tratamiento.Abono, tratamiento.Saldo, tratamiento.FormaPago, tratamiento.FechaPago FROM tratamiento
            JOIN historial on historial.id_historial = tratamiento.id_historial
            join paciente on paciente.id_paciente = historial.id_paciente
            where paciente.id_paciente = ? ";
        $query = $tratamiento->db->query($sqlTratamientos,$IdPaciente);    
        $tratamientos = $query->getResultArray();
        if(count($tratamientos)>0){
            $data['url']=(base_url('/verTratamientos/'.$IdPaciente));
            return json_encode($data,JSON_FORCE_OBJECT);
        }
        else{
            $data['url']=(base_url('/verPacientes'));
            return json_encode($data,JSON_FORCE_OBJECT);
        }
    }

    public function editarTratamiento($id=null,$idPaciente=null){
        $tituloPagina['TituloPagina'] = "Editar Tratamiento";
        $datos['header'] = view('templates/Header',$tituloPagina);
        $tratamiento= new Tratamiento();
        $datos['Tratamientos']= array($tratamiento->where('id_tratamiento',$id)->first());
        $datos['pacienteId'] = $idPaciente;
        return view('TratamientosViews/editarTratamiento',$datos);
    }

    public function actualizarTratamiento(){
        $tratamiento = new Tratamiento();
        $id = $this->request->getVar('id_tratamiento');
        $idPaciente= $this->request->getVar('id_paciente');
        $datos = $tratamiento->where('id_tratamiento',$id)->first();
        $datos['Abono'] += floatval($this->request->getVar('Abono'));
        $datos['Saldo'] = $datos['Presupuesto'] - $datos['Abono'];
        $datos['FormaPago'] = $_POST['FormaPago'];
        $fechaPago= new DateTime();
        $datos['FechaPago'] = $fechaPago->format('Y/m/d');;
        $tratamiento->update($id,$datos);
        return redirect()->to(base_url('/verTratamientos/'.$idPaciente));
    }
}