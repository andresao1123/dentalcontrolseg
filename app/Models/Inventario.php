<?php 
namespace App\Models;

use CodeIgniter\Model;

class Inventario extends Model{
    protected $table      = 'inventario';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_inventario';
    protected $allowedFields=['Nombre','Precio','Tipo','CantidadActual','CantidadMinima','Prioridad','CantidadMaxima','Medida'];
    public function getInventarios(){
        return $this->findAll();
    }
}