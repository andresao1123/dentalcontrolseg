<?php 
namespace App\Models;

use CodeIgniter\Model;

class Tratamiento extends Model{
    protected $table      = 'tratamiento';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_tratamiento';
    protected $allowedFields =['Fecha','Nombre','Tipo','Presupuesto','id_historial','Abono','FormaPago','Saldo','FechaPago'];
    public function getTratamientos(){
        return $this->findAll();
    }
}