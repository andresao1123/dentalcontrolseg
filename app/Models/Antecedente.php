<?php 
namespace App\Models;

use CodeIgniter\Model;

class Antecedente extends Model{
    protected $table      = 'antecedentes';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'AntecedentesId	';
    protected $allowedFields=['PacienteId','Alergias','CirujiasPrevias','Enfermedades','Habitos','Motivo','ProblemasHemorragicos'];
    public function getAntecedentes(){
        return $this->findAll();
    }
}