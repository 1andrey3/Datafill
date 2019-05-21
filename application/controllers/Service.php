
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/configdb_model');
        $this->load->model('data/dao_service_model');
        $this->load->model('data/dao_user_model');
        $this->load->model('data/dao_site_model');
        $this->load->model('data/Dao_service_model');
    }

    public function assignService() {
        //$answer['services'] = $this->dao_service_model->getAllServices();
        //$answer['engineers'] = $this->dao_user_model->getAllEngineers();
        //$answer['sites'] = $this->dao_site_model->getAllSites();
        //$answer['orders'] = $this->dao_order_model->getAllOrders();
        
        $this->load->view('Template/header');
        $this->load->view('assignService', $answer);
        $this->load->view('Template/footer');
    }

    public function listServices() {
        $res['list_docs'] = $this->dao_user_model->getAllDocs(); 
        $this->load->view('Template/header');
        $this->load->view('listServices', $res);
        $this->load->view('Template/footer');
        //Limpiamos la variable glogal
        unset($_SESSION["message"]);
    }

    public function getListServices() {
        $res = $this->dao_order_model->getAllOrders();

        $answer['services'] = $res["services"];
        $answer['count'] = $res["count"];
        // -----------Consulto cuantas actividades enviadas, canceladas, ejecutadas  y asignadas que existen-----------
        $count = count($answer['services']);
        for ($y = 0; $y < $count; $y++) {
            $answer['services'][$y]->enviadas = $this->dao_service_model->getEnviadoByOrder($answer['services'][$y]->getId());
            $answer['services'][$y]->canceladas = $this->dao_service_model->getCanceladoByOrder($answer['services'][$y]->getId());
            $answer['services'][$y]->ejecutadas = $this->dao_service_model->getEjecutadoByOrder($answer['services'][$y]->getId());
            $answer['services'][$y]->asignadas = $this->dao_service_model->getAsignadoByOrder($answer['services'][$y]->getId());
        }
        $data = [
            "draw" => intval($_GET['draw']),
            "recordsTotal" => intval($answer['count']),
            "recordsFiltered" => intval($answer['count']),
            "data" => $answer['services'],
            "sql" => $sql,
            "query" => $res['query']
        ];
        echo json_encode($data);
    }

    public function serviceDetails() {
        $answer['service'] = $this->dao_service_model->getServiceById($_GET['K_ID_SP_SERVICE']);
        $this->load->view('orderDetail', $answer);
    }

    public function RF() {
        $this->load->view('Template/header');
        $this->load->view('updateRF');
        $this->load->view('Template/footer');
    }

    public function actualizarfechaAsig(){

        $data = array(
            'K_IDORDER' => $this->input->post('idOrden'),
            'D_DATE_START_P' => $this->input->post('fecha')
        );
        $res = $this->dao_service_model->updateFecha($data);
        echo json_encode($res);
    }

    public function fechasInconsistentes(){
        $data['fechas'] = $this->dao_service_model->fechasInconsistentes();
        $this->load->view('Template/header');
        $this->load->view('tablaFechasUp', $data);
        $this->load->view('Template/footer');
        // header('content-type: text/plain');
        // print_r($data);

    }
    public function upDateFechInconsistentes(){
        $data = array(
            'K_IDCLARO' => $this->input->post('idClaro'), 
            'K_IDORDER' => $this->input->post('idOrder'),
            'D_DATE_START_P' => $this->input->post('idDateStar'),
            'N_ESTADO'  => $this->input->post('idEstado'),
            'D_DATE_START_R' => $this->input->post('idIni'),
            'D_DATE_FINISH_R' => $this->input->post('idFin'),
            'D_CLARO_F' => $this->input->post('idEjec')
        );

        $data2 = array(
            'K_IDORDER' => $this->input->post('idOrder'),
            'D_ASIG_Z' => $this->input->post('idZte')
        );
        $res = $this->dao_service_model->upDateInconsistentes($data);
        $res2 = $this->dao_service_model->upDateInconsistentesOt($data2);

        $this->json($res);
        
    }





    //funcion para reparar la tabla sites y de specific service parta eliminar los sitios repetidos
    public function reparar_tabla_sites(){
        set_time_limit(-1);
        ini_set('memory_limit', '1500M');

        // CONTADORES
        $ss_actualizados = 0;
        $site_eliminados = 0;


        // Seleccionar todos los sitios de la base de datos
        $allSites = $this->dao_site_model->getAllSites();

        // K_IDSITE
        // N_NAME

        $total = count($allSites);
        // recorrer todos los elementos que existen en allSites
        for ($i=0; $i < $total; $i++) { 
            $group = $this->dao_site_model->getSitesByNameMinus($allSites[$i]['N_NAME']);
            // Si tiene mas de un elemento es porque existen sitios repetidos( debe dejarse solo uno de ellos y actualizarse sprecific_service)
                // echo '<pre>*'; print_r(count($group)); echo '*</pre>';
                echo '<pre>****'; print_r(count($group)); echo '**</pre>';
            if (count($group) > 1) {
                //actualizar tabla de specific_service y dejar solo ids originales
                $respuesta = $this->reparar_specific_service($group);
                $ss_actualizados += $respuesta;
                // si se actualizó con exito borrar ids repetidos de tabla site
                if ($respuesta) {
                    $borrar = $this->borrar_sites_repeat($group);
                    $site_eliminados += $borrar;
                }
            } 

        } // end for
      
        echo '<pre>recorridas => '; print_r($i); echo '</pre>';
        echo '<pre>specific actualizados'; print_r($ss_actualizados); echo '</pre>';
        echo '<pre>sitios repetidos borrados'; print_r($site_eliminados); echo '</pre>';

    }


    // actualizar tabla de specific_service y dejar solo ids originales    
    private function reparar_specific_service($group){
        $copias = array_column($group, 'K_IDSITE'); // array de ids repetidos
        $id_original = $copias[0]; // id que va a quedar como original en site y en registros de specific service
        $respuesta = $this->Dao_service_model->actualizar_sites_specific_service($id_original, $copias);
        return $respuesta;
    }

    // Eliminar sitios repetidos de la tabla site
    private function borrar_sites_repeat($group){
        $array_copias = array_column($group, 'K_IDSITE');
        $array_borrar = array_values( array_diff($array_copias, array($array_copias[0])));
        $res = $this->dao_site_model->delete_site_where_in($array_borrar);
        return $res;
    }

}
