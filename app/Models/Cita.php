<?php 
namespace App\Models;

use CodeIgniter\Model;

class Cita extends Model{
    protected $table      = 'cita';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_cita';
    protected $allowedFields =['id_paciente','id_doctor','Fecha','HoraInicio','HoraFin','Estado'];
    public function getCitas(){
        return $this->findAll();
    }
}