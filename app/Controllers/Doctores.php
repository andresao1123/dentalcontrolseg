<?php 
namespace App\Controllers;

use App\Models\Cita;
use CodeIgniter\Controller;
use App\Models\Doctor;
use App\Models\Evento;
use App\Models\User;
use DateTime;
use PhpParser\Comment\Doc;

class Doctores extends BaseController{

    public function index(){
        if(!Comprobadores::isLogged()){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else if(isset($_SESSION['Rol']) && $_SESSION['Rol'] == "Doctor" ){
            $tituloPagina['TituloPagina'] = "Unauthorized";
            $datos['header'] = view('templates/Header',$tituloPagina);
            return view('/errors/Unauthorized',$datos);
        }
        else{
            $doctores = new Doctor();
            $sql = "SELECT id_doctor, Nombre,Apellido, CONCAT(Nombre,' ',Apellido) as NombreCompleto,Genero,NumCelular,NumFijo,Especialidad,CorreoElectronico,FechaNac,Cedula,Edad from doctor";
            $query = $doctores->db->query($sql);
            $datos['Doctores'] =$query->getResultArray();
            $tituloPagina['TituloPagina'] = "Ver Doctores";
            $datos['header'] = view('templates/Header',$tituloPagina);
            return view('DoctoresViews/verDoctores',$datos);
        }
    }

    public function registrarDoctor($email = null){
        if(!Comprobadores::isLogged()){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else{
            $tituloPagina['TituloPagina'] = "Crear Doctor";
            $datos['header'] = view('templates/Header',$tituloPagina);
            if($email != null){
                $datos["email"] = $email;
            }
            else{
                $datos["email"] = null;
            }
            return view('DoctoresViews/registrarDoctor',$datos);
        }
    }

    public function agregarDoctor(){
        $doctor= new Doctor();
        $hoy = new DateTime();
        $FechaNac = new DateTime($this->request->getVar('FechaNac'));
        $FechaNac = $FechaNac->format('Y/m/d');
        $edad =  date_diff($hoy,new DateTime($FechaNac));
        $nombre = $this->request->getVar('Nombre');
        $apellido =$this->request->getVar('Apellido');
        $cedula = $this->request->getVar('Cedula');
        $correoElectronico = $this->request->getVar('CorreoElectronico');
        $datos=[
            'Nombre' => $nombre,
            'Apellido' => $apellido,
            'Cedula' => $cedula,
            'Especialidad' => $this->request->getVar('Especialidad'),
            'NumCelular' => $this->request->getVar('NumCelular'),
            'NumFijo' => $this->request->getVar('NumFijo'),
            'CorreoElectronico' => $correoElectronico,
            'Genero' =>$_POST['Genero'],
            'FechaNac' => $FechaNac,
            'Edad'=> $edad->format('%y years')
        ];
        $doctor->insert($datos);
        $users = new User();
        $username = strtolower($nombre[0].".".$apellido);
        $password = $cedula;
        $newUser = [
            "username" => $username,
            "Nombre" => $nombre,
            "Apellido" => $apellido,
            "correoElectronico" => $correoElectronico,
            "contrasenia" => $password,
            "Rol" => "Doctor",
            "id_doctor" => $doctor->getInsertID()
        ];
        $users->insert($newUser);
        return redirect()->to('/');
        
    }
    public function editarDoctor($id=null){
        if(!Comprobadores::isLogged()){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else if(isset($_SESSION['Rol']) && $_SESSION['Rol'] == "Doctor" ){
            $tituloPagina['TituloPagina'] = "Unauthorized";
            $datos['header'] = view('templates/Header',$tituloPagina);
            return view('/errors/Unauthorized',$datos);
        }
        else{
            $tituloPagina['TituloPagina'] = "Editar Doctor";
            $datos['header'] = view('templates/Header',$tituloPagina);
            $doctor = new Doctor();
            $datos['Doctor']= $doctor->where('id_doctor',$id)->first();
            return view('PcientesViews/index',$datos);
        }
    }
    public function actualizarDoctor(){
        if(!Comprobadores::isLogged()){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else{
            $doctor= new Doctor();
            $id = $this->request->getVar('id_doctor');
            $datos = [
                'Nombre' => $this->request->getVar('Nombre'),
                'Apellido' => $this->request->getVar('Apellido'),
                'Especialidadr' => $this->request->getVar('Especialidad'),
                'NumCelular' => $this->request->getVar('NumCelular'),
                'NumFijo' => $this->request->getVar('NumFijo'),
                'Genero' => $_POST['Genero'],
                'CorreoElectronico' => $this->request->getVar('CorreoElectronico')
            ];

            $doctor->update($id,$datos);

            return redirect()->to('/verDoctores');
        }
    }

    public function borrarDoctor($id=null){
        $doctor = new Doctor();
        $eventos = new Evento();
        $citas = new Cita();
        $users = new User();
        $id = $_GET['id'];
        $eventoObtenidos = $eventos->where('id_doctor',$id);
        foreach($eventoObtenidos as $evento){
            $eventos->delete($evento);
        }
        $user = $users->where('id_doctor',$id)->first();
        $users->delete($user);
        $citasObtenidas = $citas->where('id_doctor',$id);
        foreach($citasObtenidas as $cita){
            $citas->delete($cita);
        }
        $doctorABorrar = $doctor->where('id_doctor',$id)->first();
        $doctor->delete($doctorABorrar);
        $data['url']=base_url('/verDoctores');
        return json_encode($data,JSON_FORCE_OBJECT);
    }
}