<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class Comprobadores extends Controller{
    public static function isLogged(){
        if(isset($_SESSION['Rol'])){
            return true;
        }
        else{
            return false;
        }
    }
}