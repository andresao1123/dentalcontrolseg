<?php 
namespace App\Controllers;

use App\Models\Antecedente;
use App\Models\Cirujia;
use App\Models\Historial;
use CodeIgniter\Controller;
use App\Models\Paciente;
use App\Models\Tratamiento;
use CodeIgniter\Debug\Toolbar\Collectors\History;
use CodeIgniter\HTTP\Header;
use DateTime;

class Pacientes extends BaseController{

    public function index(){
        
        if(!Comprobadores::isLogged()){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else{
            $paciente = new Paciente();
            
            $datos['pacientes'] = $paciente->getPacientes();
            $tituloPagina['TituloPagina'] = "Ver pacientes";
            $datos['header'] = view('templates/Header',$tituloPagina);
            
            
            return view('PacientesViews/VerPacientes',$datos);
        }
    }


    public static function verificarExistenciaTrat($idPaciente=null){
        $tratamiento = new Tratamiento();
        $historial = new Historial();
        $TratAvaliable=false;
        $datosHistorial = $historial->where('id_paciente', $idPaciente)->first();
        $tratamientos = $tratamiento->where('id_historial',$datosHistorial['id_historial'])->first();
        if($tratamientos!= null){
            $TratAvaliable = true;
        }
        else{
            $TratAvaliable = false;
        }
        return $TratAvaliable;
    }

    public static function verificarExistenciaCir($idPaciente=null){
        $cirujia = new Cirujia();
        $cirAvaliable = false;
        $cirujias = $cirujia->where('PacienteId',$idPaciente)->first();
        if($cirujias != null){
            $cirAvaliable = true;
        }
        else{
            $cirAvaliable = false;
        }
        return $cirAvaliable;
    }

    public static function verificarExistenciaAnt($idPaciente=null){
        $antecedente = new Antecedente();
        $antAvaliable = false;
        $antecedentes = $antecedente->where('PacienteId',$idPaciente)->first();
        if($antecedentes!= null){
            $antAvaliable = true;
        }
        else{
            $antAvaliable = false;
        }
        return $antAvaliable;
    }

    public function crearPaciente(){
        if(!Comprobadores::isLogged()){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else{
            $tituloPagina['TituloPagina'] = "Crear Paciente";
            $datos['header'] = view('templates/Header',$tituloPagina);

            return view('PacientesViews/CrearPaciente',$datos);
        }
    }

    public function guardar(){
        $paciente= new Paciente();
        $Cedula=$this->request->getVar('Cedula');
        $hoy = new DateTime();
        $FechaNac = new DateTime($this->request->getVar('FechaNac'));
        $FechaNac = $FechaNac->format('Y/m/d');
        $edad =  date_diff($hoy,new DateTime($FechaNac));
        $necesitaAnt = $_POST['NecesitaAnt']==='true'?true:false;
        $datos=[
            'Nombre' => $this->request->getVar('Nombre'),
            'Apellido' => $this->request->getVar('Apellido'),
            'Cedula' => $this->request->getVar('Cedula'),
            'NumCelular' => $this->request->getVar('NumCelular'),
            'NumFijo' => $this->request->getVar('NumFijo'),
            'DirDomicilio' => $this->request->getVar('DirDomicilio'),
            'Genero' =>$_POST['Genero'],
            'CorreoElectronico' => $this->request->getVar('CorreoElectronico'),
            'FechaNac' => $FechaNac,
            'Edad'=> $edad->format('%y years')
        ];
        $paciente->insert($datos);
        $agregar=$paciente->getInsertID();
        $data=[
            'id_paciente'=> $agregar
        ];
        $historial = new Historial();
        $historial->insert($data);
        if($necesitaAnt){
            "hey";
            $url = "/agregarAntecedente/".$agregar;
            return redirect()->to($url);
        }
        else{
            return redirect()->to('/');
        }
    }

    public function Borrar($id=null){
        $paciente = new Paciente();
        $tratamiento = new Tratamiento();
        $antecedente = new Antecedente();
        $cirujia = new Cirujia();
        $historial = new Historial();
        $id = $_GET['id'];
        $datosHistorial = $historial->where('id_paciente',$id)->first();
        $sqlCirujia = "DELETE FROM cirujia WHERE PacienteId= ?";
        $sqlAntecedentes = "DELETE FROM antecedentes WHERE PacienteId= ?";
        $sqlTratamiento = "DELETE FROM tratamiento WHERE id_historial = ?";
        $sqlHistorial =  "DELETE FROM historial WHERE id_paciente= ?";
        $sqlPaciente = "DELETE FROM paciente WHERE id_paciente= ?";
        $cirujia->db->query($sqlCirujia,$id);
        $antecedente->db->query($sqlAntecedentes,$id);
        $tratamiento->db->query($sqlTratamiento,$datosHistorial['id_historial']);
        $historial->db->query($sqlHistorial,$id);
        $paciente->db->query($sqlPaciente,$id);
        $data['url']=base_url("/verPacientes");
        return json_encode($data,JSON_FORCE_OBJECT);
    }

    public function Editar($id=null){
        $tituloPagina['TituloPagina'] = "Editar Paciente";
        $datos['header'] = view('templates/Header',$tituloPagina);
        $paciente = new Paciente();
        $datos['Paciente']= $paciente->where('id_paciente',$id)->first();
        return view('PacientesViews/editarPaciente',$datos);
    }
    public function actualizarPaciente(){
        if(!Comprobadores::isLogged()){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else{
            $paciente = new Paciente();
            $id = $this->request->getVar('id_paciente');
            $datos = [
                'Nombre' => $this->request->getVar('Nombre'),
                'Apellido' => $this->request->getVar('Apellido'),
                'NumCelular' => $this->request->getVar('NumCelular'),
                'NumFijo' => $this->request->getVar('NumFijo'),
                'DirDomicilio' => $this->request->getVar('DirDomicilio'),
                'Genero' => $_POST['Genero'],
                'CorreoElectronico' => $this->request->getVar('CorreoElectronico')
            ];

            $paciente->update($id,$datos);

            return redirect()->to('/');
        }
    }
}