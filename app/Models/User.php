<?php 
namespace App\Models;

use CodeIgniter\Model;

class User extends Model{
    protected $table      = 'user';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'userId ';
    protected $allowedFields=['username','Nombre','Apellido','correoElectronico','contrasenia','Rol','id_doctor'];
}