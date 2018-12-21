<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_site_model extends CI_Model {

    public function __construct() {
        $this->load->model('data/configdb_model');
        $this->load->model('site_model');
    }

    public function getAllSites() {
      $query = $this->db->query("
        SELECT K_IDSITE, LOWER( REPLACE(N_NAME, ' ', '') ) AS N_NAME FROM site 
      ");

      return $query->result_array();
    }

    public function getSitePerId($siteId) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT * FROM site WHERE K_IDSITE = " . $siteId . ";";
        $result       = $session->query($sql);
        $row          = $result->fetch_assoc();
        $site         = new site_model;
        $site->createSite($row['K_IDSITE'], $row['N_NAME']);
        return $site;
    }

    public function insertNewSite($newSite) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "INSERT INTO site (K_IDSITE, N_NAME) values (" . $newSite->getId() . ", '" . $newSite->getName() . "');";
        $result       = $session->query($sql);
    }

    // retorna el id maxiumo de la tabla side
    public function get_id_max(){
      $query = $this->db->query("
        SELECT MAX(K_IDSITE) AS max FROM site LIMIT 1;
      ");
      return $query->row()->max;
    }

    // retorna sitios segun su nombre en minuscula ni espacios
    public function getSitesByNameMinus($name){
      $query = $this->db->query("
        SELECT K_IDSITE, N_NAME FROM site 
        WHERE LOWER( REPLACE(N_NAME, ' ', '') ) = '$name'
      ");
      return $query->result();
    }

    // Elimina registros de site where in K_IDSITE esté en el array
    public function delete_site_where_in($where_in){
      $this->db->where_in('K_IDSITE', $where_in);
      $this->db->delete('site');
      if ($this->db->affected_rows() > 0) {
          return $this->db->affected_rows();
      } else {
          return 0;
      }
    }

}

 