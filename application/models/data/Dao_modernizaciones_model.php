<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_modernizaciones_model extends CI_Model {

    public function __construct() {
        $this->load->model('data/configdb_model');
        $this->load->model('data/dao_service_model');
    }

    public function get_modernizaciones() {
        $query = $this->db->query("
            SELECT ss.K_IDORDER, ss.K_IDCLARO, ss.K_IDSITE,  site.N_NAME, ot.D_ASIG_Z, ss.D_CLARO_F, ss.N_ESTADO, ss.N_PROYECTO, ss.D_FORECAST, ot.D_DATE_CREATION, ss.N_ING_SOL, ss.n_region
            FROM modernizacion moder
            INNER JOIN specific_service ss ON ss.K_ID_SP_SERVICE= moder.k_id_sp_services
            INNER JOIN ot ON ss.K_IDORDER = ot.K_IDORDER
            INNER JOIN site ON ss.K_IDSITE = site.K_IDSITE
            GROUP BY K_IDORDER
        ");
        return $query->result();
    }

    public function getOrdenDetailsModerById($idOrden) {
        $query = $this->db->query("
            SELECT moder.id_moder, ss.K_IDORDER, moder.tipo_orden, moder.trabajo, moder.id, moder.tipo_tecnologia, moder.f_cierre_ing
            FROM modernizacion moder
            INNER JOIN specific_service ss ON ss.K_ID_SP_SERVICE= moder.k_id_sp_services
            INNER JOIN ot ON ss.K_IDORDER = ot.K_IDORDER
            INNER JOIN site ON ss.K_IDSITE = site.K_IDSITE
            WHERE ss.K_IDORDER = $idOrden
        ");
        return $query->result();
    }

}
?>
