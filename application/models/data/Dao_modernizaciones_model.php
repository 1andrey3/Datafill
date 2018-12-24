<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_modernizaciones_model extends CI_Model {

    public function __construct() {
        $this->load->model('data/configdb_model');
        $this->load->model('data/dao_service_model');
    }

    public function get_modernizaciones() {
        $query = $this->db->query("
            SELECT ss.K_IDORDER, ss.K_IDCLARO, moder.tipo_orden,ss.K_IDSITE, moder.trabajo, moder.id, moder.tipo_tecnologia
            FROM modernizacion moder
            INNER JOIN specific_service ss ON ss.K_ID_SP_SERVICE = moder.k_id_sp_services
        ");
        return $query->result();
    }

}

?>
