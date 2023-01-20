<?php 
namespace App\Models;

use CodeIgniter\Model;

class Historial extends Model{
    protected $table      = 'historial';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_historial';
    protected $allowedFields=['id_paciente'];
    
    public function getHistoriales(){
        return $this->findAll();
    }
}