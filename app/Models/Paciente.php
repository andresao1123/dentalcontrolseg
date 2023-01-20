<?php 
namespace App\Models;

use CodeIgniter\Model;

class Paciente extends Model{
    protected $table      = 'paciente';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_paciente';
    protected $allowedFields=['Nombre','Apellido', 'Cedula','NumCelular','NumFijo','DirDomicilio','Genero','CorreoElectronico','FechaNac','Edad'];
    public function getPacientes(){
        return $this->findAll();
    }
    
}