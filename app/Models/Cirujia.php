<?php 
namespace App\Models;

use CodeIgniter\Model;

class Cirujia extends Model{
    protected $table      = 'cirujia';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'CirujiaId';
    protected $allowedFields=['AntecedenteId','NombreCirujia','FechaCirujia','PacienteId','DoctorACargo'];
    public function getCirujias(){
        return $this->findAll();
    }
}