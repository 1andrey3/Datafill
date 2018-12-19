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

    // Tabla que muestran todos los tickets que se encuentran en estado documentador
    public function c_get_modernizaciones() {
        $get_modernizaciones = $this->Dao_modernizaciones_model->get_modernizaciones();
        echo json_encode($get_modernizaciones);
    }

}

?>