<?php

namespace App\Controllers;
use App\Models\User;
class Home extends BaseController
{
    var $auth0Local;
    function __construct(){
        parent::__construct(); 
        $this->auth0Local = parent::$auth0;
        // $this->data can be accessed from anywhere in the controller.
    }    
    public function index()
    {
        $session = $this->auth0Local->getCredentials();
        if ($session === null) {
        
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else{
            $user = new User();
            $sql = "Select username,correoElectronico,Rol from user where correoElectronico = ?";
            $query = $user->db->query($sql,$session->user["email"]);
            $result = $query->getRowArray();
            if($result != null){
                $_SESSION['username']= $result['username'];
                $_SESSION['correoElectronico'] = $result['correoElectronico'];
                $_SESSION['Rol'] = $result['Rol'];
            }
            else{
                $Doctor = new Doctores();
                return $Doctor->registrarDoctor($session->user["email"]);
            }
            $tituloPagina['TituloPagina'] = "Home";
            $datos['header'] = view('templates/Header',$tituloPagina);
            return view('PacientesViews/index',$datos);
        }
    }
}
