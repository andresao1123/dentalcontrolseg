<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\User;

class Users extends BaseController{

    var $auth0Local;

    function __construct(){
        parent::__construct(); 
        $this->auth0Local = parent::$auth0;
        // $this->data can be accessed from anywhere in the controller.
    }    
    
    public function index(){
        
        // $tituloPagina['TituloPagina'] = "Iniciar Sesion";
        // $datos['header'] =view('templates/HeaderNotLogged',$tituloPagina);
        // $datos['error'] = null;
        // return view('LoginViews/Login',$datos);
        $this->auth0Local->clear();
        return redirect()->to($this->auth0Local->login(ROUTE_URL_CALLBACK));
    }
    public function logValidation(){
        $session = $this->auth0Local->getCredentials();
        if ($session === null) {
            // The user isn't logged in.
            $tituloPagina['TituloPagina'] = "Iniciar Sesion";
            $datos['header'] =view('templates/HeaderNotLogged',$tituloPagina);
            $datos['error'] = null;
            return view('/errors/error',$datos);
          }
        else{
            
            $tituloPagina['TituloPagina'] = "Validacion login";
            $datos['header'] = view('templates/HeaderTest',$tituloPagina);
            $datos['user'] = $session;
            return view('LoginViews/LoginValidation',$datos);
        }
        
    }

    public function login(){
        // $usuario = new User();
        // $username = $this->request->getVar('username');
        // $password = $this->request->getVar('password');
        // $sql = "SELECT userId, username, Nombre, Apellido, correoElectronico, contrasenia, Rol,id_doctor 
        // from user where contrasenia = ? and (username = ? or correoElectronico = ?)";
        // $query = $usuario->db->query($sql,[$password,$username,$username]);
        // $result = $query->getRowArray();
        // if($result != null){
        //     $_SESSION['username']= $result['username'];
        //     $_SESSION['correoElectronico'] = $result['correoElectronico'];
        //     $_SESSION['Rol'] = $result['Rol'];
        //     if($result['id_doctor'] != null){
        //         $_SESSION['id_doctor'] = $result['id_doctor'];
        //     }
        //     return redirect()->to('/');
        // }
        // else{
        //     $tituloPagina['TituloPagina'] = "Iniciar Sesion";
        //     $datos['header'] = view('templates/HeaderNotLogged',$tituloPagina);
        //     $datos['error'] = "Contraseña o usuario incorrectos, compruebe sus credenciales";
        //     return view('LoginViews/Login',$datos);
        // }
        $this->auth0Local->clear();
        return redirect()->to($this->auth0Local->login(ROUTE_URL_CALLBACK));
    }
    public function callback(){
        
        $this->auth0Local->exchange(ROUTE_URL_CALLBACK);

        return redirect()->to($this->auth0Local->login(ROUTE_URL_INDEX));
    }
    public function logout(){
        // session_destroy();
        // return redirect()->to('/');
        return redirect()->to($this->auth0Local->logout(ROUTE_URL_INDEX));
    }
}
