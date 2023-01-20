<?php 
namespace App\Models;

use CodeIgniter\Model;

class Doctor extends Model{
    protected $table      = 'doctor';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_doctor';
    protected $allowedFields =['Nombre','Apellido','Especialidad','NumFijo','NumCelular','Genero','CorreoElectronico','FechaNac','Cedula','Edad'];
    public function getDoctores(){
        return $this->findAll();
    }
}