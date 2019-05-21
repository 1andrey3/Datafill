<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Modernizaciones extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/configdb_model');
        $this->load->model('data/Dao_service_model');
        $this->load->model('data/Dao_modernizaciones_model');
//        $this->load->model('data/Dao_report_model');
    }

    // no trae las modernizaciones pero carga la vista modernixzaciones
    public function getModernizaciones() {
        $this->load->view('Template/header');
        $this->load->view('modernizaciones');
        $this->load->view('Template/footer');
    }

    // Tabla que muestran las ordenes que se encuentran en la tabla de modernizaciones
    public function c_get_modernizaciones() {
        $get_modernizaciones = $this->Dao_modernizaciones_model->get_modernizaciones();
        echo json_encode($get_modernizaciones);
    }

    //trae todas las modernizaciones que tengan el mismo id orden
    public function c_getOrdenDetail($idOrden, $actividad, $sitio, $f_asignacion, $f_ejecucion_claro, $estado, $proyecto, $f_forecast, $f_creacion, $solicitante, $region) {
        echo '<pre>'; print_r($record); echo '</pre>';
        $datos['idOrden'] = $idOrden;
        $datos['ss'] = [urldecode($idOrden), urldecode($actividad), urldecode($sitio), urldecode($f_asignacion), urldecode($f_ejecucion_claro), urldecode($estado), urldecode($proyecto), urldecode($f_forecast), urldecode($f_creacion), urldecode($solicitante), urldecode($region)];
        $this->load->view('ordenModerDetail', $datos);
    }

    // PONGA UN HP COMENTARIO DE Q MIERDAS HACE ESTA FUNCIOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOONNNNNNNNNNNN
    public function c_getOrdenDetailsModerById() {
        $idOrden = $this->input->post('idOrden');
        $get_modernizaciones = $this->Dao_modernizaciones_model->getOrdenDetailsModerById($idOrden);
        echo json_encode($get_modernizaciones);
    }

    // ajax q retorna registros de tbl modernizaciones hacia js segun su id_modernizacin
    public function js_getModer(){
        $ms = $this->input->post('mds');
        $response = $this->Dao_modernizaciones_model->getAllModernizacionesByIds($ms);
        echo json_encode($response);
    }
    //FUNCIÓN PARA ACTUALIZAR LAS ASOCIADAS DE LAS MODERNIZACIONES
    public function updateModer()
    {
        $update = $this->input->post('updates');
        $ids = $this->input->post('ids');
        $cambios = array_merge($update["selects"],$update["inputs"]); //FUNCION PARA COMBINAR ARRAYS
        // print_r($cambios["id_moder"]);
        
        $answer = $this->Dao_modernizaciones_model->UpdateModernizaciones($cambios,$ids);
        echo $answer;
    }


}
