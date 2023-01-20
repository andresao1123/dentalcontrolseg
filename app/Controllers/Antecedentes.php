<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Antecedente;
use App\Models\Cirujia;
use App\Models\Paciente;
use CodeIgniter\Entity\Cast\ObjectCast;
use CodeIgniter\HTTP\Request;
use DateTime;
use JsonObject;
use LDAP\Result;

class Antecedentes extends BaseController{


    public function verAntecedente($idPaciente= null){
        if(!Comprobadores::isLogged()){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else{
            $antecedente = new Antecedente();
            $tituloPagina['TituloPagina'] = "Ver Antecedente";
            $datos['header'] = view('templates/Header',$tituloPagina);
            $sqlAntecedentes= "SELECT AntecedentesId , PacienteId, Alergias, CirujiasPrevias, Enfermedades,Habitos, Motivo, ProblemasHemorragicos FROM antecedentes join paciente on paciente.id_paciente = antecedentes.PacienteId
            where paciente.id_paciente = ? ";
            $antecedentes = $antecedente->db->query($sqlAntecedentes,$idPaciente)->getResultArray();
            if($antecedentes!=null){
                $datos['antecedentes'] = $antecedentes;
                $datos['CirujiasPrevias'] = "";
                $datos['ProblemasHemorragicos'] = "";
                if($antecedentes[0]['CirujiasPrevias'] == 1){
                    $datos['CirujiasPrevias'] = "Si";
                }
                else{
                    $datos['CirujiasPrevias'] = "No";
                }

                if($antecedentes[0]['ProblemasHemorragicos'] == 1){
                    $datos['ProblemasHemorragicos']="Si";
                }
                else{
                    $datos['ProblemasHemorragicos']="No";
                }
                return view('AntecedentesViews/verAntecedente',$datos);
            }else{
                return redirect()->to('/verPacientes?error=true');
            }
        }
    }
    
    

    public function crearAntecedentes($idPaciente=null){
        if(!Comprobadores::isLogged()){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            $datos['IdPaciente'] = $idPaciente;
            return view('/errors/error',$datos);
        }
        else{
            $tituloPagina['TituloPagina'] = "Crear Antecedente";
            $datos['IdPaciente']= $idPaciente;
            $datos['header'] = view('templates/Header',$tituloPagina);
            return view('AntecedentesViews/AgregarAntecedentes',$datos);
        }
    }


    public function RegistrarAntecedente(){
        if(!Comprobadores::isLogged()){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else{
            $antecedentes = new Antecedente();
            $Cirujiasprevias = 0;
            $idPaciente=$this->request->getVar('IdPaciente');
            $Alergias =$this->request->getVar('Alergias');
            $Enfermedades = $this->request->getVar('Enfermedades');
            $Habitos= $this->request->getVar('Habitos');
            $Motivo = $this->request->getVar('Motivo');
            $problemasHemorragicos = $_POST['Hemorragicos']=="Si"?true:false;
            $Cirujias= $_POST['Cirujia'];
            if($Cirujias =="Si"){
                $Cirujiasprevias = 1;
            }
            else{
                $Cirujiasprevias = 0;
            }
            $datosAntecedente=[
                'PacienteId'=>$idPaciente,
                'Alergias' =>$Alergias,
                'Enfermedades' =>$Enfermedades,
                'CirujiasPrevias' => $Cirujiasprevias,
                'Habitos'=>$Habitos,
                'Motivo' =>$Motivo,
                'ProblemasHemorragicos' => $problemasHemorragicos
            ];
            $antecedentes->insert($datosAntecedente);
            if($Cirujias){
                $cirujia = new Cirujia();
                $AntecedenteId = $antecedentes->getInsertID();
                $NombreCirujia= $this->request->getVar('NombreCirujia');
                $FechasCirujia = $this->request->getVar('FechaCirujia');
                $doctorACargo = $this->request->getVar('DoctorCargo');
                $fechasCirujias = $this->request->getVar('FechaCirujia');
                $arrayCirujiasFechas= explode(",",$fechasCirujias);
                if(count($arrayCirujiasFechas)-1 > 0){
                    foreach($arrayCirujiasFechas as $CirujiaFecha){
                        $FechaCirujia = new DateTime($CirujiaFecha);
                        $FechaCirujia = $FechaCirujia->format('Y/m/d');
                        $datosCirujia =[
                            'PacienteId' => $idPaciente,
                            'NombreCirujia' => $NombreCirujia,
                            'FechaCirujia' => $FechaCirujia,
                            'DoctorACargo' => $doctorACargo
                        ];
                        $cirujia->insert($datosCirujia);
                    }
                    return redirect()->to('/');
                }
                $datosCirujias=[
                    'AntecedenteId'=> $AntecedenteId,
                    'NombreCirujia'=>$NombreCirujia,
                    'FechaCirujia' =>$FechasCirujia,
                    'PacienteId' => $idPaciente,
                    'DoctorACargo'=>$doctorACargo
                ];
                $cirujia->insert($datosCirujias);
                return redirect()->to('/');
            }else{
                return redirect()->to('/');
            }
        }
    }

    public function borrarAntecedente($id=null){
        if(!Comprobadores::isLogged()){
            $tituloPagina['TituloPagina'] = "Not Logged";
            $datos['headerError'] = view('templates/HeaderNotLogged',$tituloPagina);
            return view('/errors/error',$datos);
        }
        else{
            $antecedente = new Antecedente();
            $cirujia = new Cirujia();
            $datosAntecedente = $antecedente->where('AntecedentesId',$id)->first();
            $cirujia->delete($cirujia->where('AntecedenteId',$datosAntecedente['AntecedentesId'])->first());
            $antecedente->delete($datosAntecedente);
            return redirect()->to('/verPacientes');
        }
    }
}