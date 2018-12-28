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

    public function getModernizaciones() {
        $this->load->view('modernizaciones');
    }

    // Tabla que muestran las ordenes que se encuentran en la tabla de modernizaciones
    public function c_get_modernizaciones() {
        $get_modernizaciones = $this->Dao_modernizaciones_model->get_modernizaciones();
        echo json_encode($get_modernizaciones);
    }

    //trae todas las modernizaciones que tengan el mismo id orden
    public function c_getOrdenDetail($idOrden) {
        $datos['idOrden'] = $idOrden;
        $this->load->view('ordenModerDetail', $datos);
    }

    public function c_getOrdenDetailsModerById() {
        $idOrden = $this->input->post('idOrden');
        $get_modernizaciones = $this->Dao_modernizaciones_model->getOrdenDetailsModerById($idOrden);
        echo json_encode($get_modernizaciones);
    }
}

?>