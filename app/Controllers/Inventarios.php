<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Inventario;
class Inventarios extends BaseController{

    public function index(){
        if(!Comprobadores::isLogged()){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else{
            $inventarios = new Inventario();
            
            $datos['inventarios'] =$inventarios->getInventarios();
            $tituloPagina['TituloPagina'] = "Ver Inventario";
            $datos['header'] = view('templates/Header',$tituloPagina);
            
            
            return view('InventariosViews/VerInventarios',$datos);
        }
    }

    public function actualizarProducto(){
        if(!isset($_SESSION['Rol'])){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else{
            $inventarios = new Inventario();
            
            $datos['inventarios'] =$inventarios->getInventarios();
            $tituloPagina['TituloPagina'] = "Actualizar producto";
            $datos['header'] = view('templates/Header',$tituloPagina);
            
            
            return view('InventariosViews/actualizarCantidades',$datos);
        }
    }
    public function actualizarCantidades(){
        $id = $this->request->getVar('IdInventario');
        $tipo = $this->request->getVar('Tipo');
        $selector=$_POST['Agregar-Reducir'];
        $CantidadAIngresarOReducir=$this->request->getVar('CantidadAgregada-reducida');
        $cantidadActual=$this->request->getVar('CantidadActual');
        $cantidadMaxima=$this->request->getVar('CantidadMaxima');
        $cantidadMinima=$this->request->getVar('CantidadMinima');
        $prioridad=0;
        $inventarios = new Inventario();
        if(intval($selector) == 1){
            $cantidadActual+= $CantidadAIngresarOReducir;
            if($cantidadActual > $cantidadMaxima){
                $cantidadMaxima=$cantidadActual;
                $cantidadMinima=$cantidadMaxima/2;
            }
            $prioridad=$this->setPrioridad($cantidadActual,$cantidadMaxima,$cantidadMinima);
        }
        else if(intval($selector) == 2){
            if($CantidadAIngresarOReducir <= $cantidadActual){
                $cantidadActual -= $CantidadAIngresarOReducir;
            }
            $prioridad=$this->setPrioridad($cantidadActual,$cantidadMaxima,$cantidadMinima);
        }
        
        $datos=[
            'Tipo' => $tipo,
            'CantidadActual' => $cantidadActual,
            'CantidadMinima' => $cantidadMinima,
            'CantidadMaxima' => $cantidadMaxima,
            'Prioridad' => $prioridad
        ];

        $inventarios->update($id,$datos);

        return redirect()->to(base_url('/verInventarios'));
    }

    
    public function setPrioridad($cantidadActual, $cantidadMaxima, $cantidadMinima) {
        $prioridad=0;
        $PrioL=$cantidadMaxima*0.75;
        $CantAc=$cantidadActual;
        
        if($cantidadActual<=$cantidadMaxima &&$CantAc>$PrioL){
            $prioridad = 3;
        }else if($CantAc<$PrioL && $cantidadActual>$cantidadMinima){
            $prioridad = 2;
        }else{
            $prioridad = 1;
        }
        return  $prioridad;
    }
    
    public function borrarProducto($id=null){
        $inventario = new Inventario();
        $datosTratamiento = $inventario->where('id_inventario',$_GET['id'])->first();
        $inventario->delete($datosTratamiento);
        $data['url']=base_url('/verInventarios');
        return json_encode($data,JSON_FORCE_OBJECT);
    }
    
    public function registrarProducto(){
        if(!isset($_SESSION['Rol'])){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }else{
            $inventario = new Inventario();
            $datos['inventarios'] = $inventario->getInventarios();
            $tituloPagina['TituloPagina'] = "Agregar Producto";
            $datos['header'] = view('templates/Header',$tituloPagina);
            return view('InventariosViews/AgregarProducto',$datos);
        }
    }
    public function agregarProducto(){

        $inventario = new Inventario();
        $nombreProducto = $this->request->getVar('NombreProducto');
        $TipoProducto = $this->request->getVar('TipoProducto');
        $precio = $this->request->getVar('Precio');
        $CantidadInicial = $this->request->getVar('CantidadInicial');
        $Medida = $_POST['Medida'];
        $data =[
            'Nombre' => $nombreProducto,
            'Precio' => $precio,
            'Tipo' => $TipoProducto,
            'CantidadActual' => $CantidadInicial,
            'CantidadMaxima' => $CantidadInicial,
            'CantidadMinima' => $CantidadInicial/2,
            'Prioridad' => 3,
            'Medida' => $Medida
        ];
        $inventario->insert($data);
        $url = base_url('/verInventarios');
        return redirect()->to($url);
    }

    public static function IsPrioridad3($id){
        $inventarios = new Inventario();
        $sql= "SELECT Nombre,Precio,Tipo,CantidadActual,CantidadMinima,Prioridad,CantidadMaxima,Medida from inventario where id_inventario  = ?";
        $query = $inventarios->db->query($sql,$id);
        $inventario = $query->getResultArray();
        if($inventario[0]['Prioridad'] == 3){
            return true;
        }
        else{
            return false;
        }
    }
    public static function IsPrioridad2($id){
        $inventarios = new Inventario();
        $sql= "SELECT Nombre,Precio,Tipo,CantidadActual,CantidadMinima,Prioridad,CantidadMaxima,Medida from inventario where id_inventario  = ?";
        $query = $inventarios->db->query($sql,$id);
        $inventario = $query->getResultArray();
        if($inventario[0]['Prioridad'] == 2){
            return true;
        }
        else{
            return false;
        }
    }
    public static function IsPrioridad1($id){
        $inventarios = new Inventario();
        $sql= "SELECT Nombre,Precio,Tipo,CantidadActual,CantidadMinima,Prioridad,CantidadMaxima,Medida from inventario where id_inventario  = ?";
        $query = $inventarios->db->query($sql,$id);
        $inventario = $query->getResultArray();
        if($inventario[0]['Prioridad'] == 1){
            return true;
        }
        else{
            return false;
        }
    }
    public function editarProducto(){
        if(!isset($_SESSION['Rol'])){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else{
            $inventarios = new Inventario();
            
            $datos['inventarios'] =$inventarios->getInventarios();
            $tituloPagina['TituloPagina'] = "editar producto";
            $datos['header'] = view('templates/Header',$tituloPagina);
            
            
            return view('InventariosViews/VerInventarios',$datos);
        }
    }

    public function getSingleProduct($id=null){
        
        $inventarios = new Inventario();
        $sql= "SELECT id_inventario,Nombre,Precio,Tipo,CantidadActual,CantidadMinima,Prioridad,CantidadMaxima,Medida from inventario where id_inventario  = ". $_GET['id'];
        $query = $inventarios->db->query($sql);
        $inventario = $query->getResultArray();
        $data['inventario'] = $inventario;
        return json_encode($data,JSON_FORCE_OBJECT);
    }
}
