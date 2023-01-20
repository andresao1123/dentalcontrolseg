<?php 
namespace App\Models;

use CodeIgniter\Model;

class Evento extends Model{
    protected $table      = 'evento';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['title','descripcion','start','end','id_doctor','id_cita'];
    public function getEventos(){
        return $this->findAll();
    }
}