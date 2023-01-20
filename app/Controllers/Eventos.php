<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Evento;
use Symfony\Contracts\EventDispatcher\Event;

class Eventos extends BaseController{

    public function show($id = null){
        if($_SESSION['Rol'] == "Doctor"){
            $eventos = new Evento();
            $sql = "SELECT * from evento 
            join cita on cita.id_cita = evento.id_cita
            where evento.id_doctor = ? and (cita.Estado = ? or cita.Estado = ?)";
            $query = $eventos->db->query($sql,array($_SESSION['id_doctor'],"Pendiente","Confirmada"));
            $evento = $query->getResultArray();
            $data['citas'] = $evento;
            return json_encode($data);
        }
        else{
            if(isset($_POST["id"])){
                $id = $_POST["id"];
            }
            else{
                $id = "0";
            }
            
            if($id == null){
                $eventos = new Evento();
                $sql = "SELECT * from evento 
                join cita on cita.id_cita = evento.id_cita
                where cita.Estado = ? or cita.Estado = ?";
                $query = $eventos->db->query($sql,array("Pendiente","Confirmada"));
                $evento = $query->getResultArray();
                $data['citas'] = $evento;
                return json_encode($data);
            }else{
                $eventos = new Evento();
                $sql = "SELECT * from evento 
                join cita on cita.id_cita = evento.id_cita
                where evento.id_doctor = ? and (cita.Estado = ? or cita.Estado = ?)";
                $query = $eventos->db->query($sql,array($id,"Pendiente","Confirmada"));
                $evento = $query->getResultArray();
                if(sizeof($evento)>0){
                    $data['citas'] = $evento;
                }
                else{
                    $data['citas'] = null;
                }
                return json_encode($data);
            }
        }
    }
    public function find($id = null){
        $eventos = new Evento();
        $id = $_POST['id'];
        $sql = $sql = "SELECT * from evento where id = ?";
        $query = $eventos->db->query($sql,$id);
        $evento = $query->getRowArray();
        $data['citas'] = $evento;
        return json_encode($data);
    }
}