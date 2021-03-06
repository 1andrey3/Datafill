<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_service_model extends CI_Model {

    public function __construct() {
        $this->load->model('data/configdb_model');
        $this->load->model('data/dao_order_model');
        $this->load->model('data/dao_site_model');
        $this->load->model('data/dao_user_model');
        $this->load->model('data/dao_rf_model');
        $this->load->model('service_model');
        $this->load->model('order_model');
        $this->load->model('service_spec_model');
    }

    public function getAllServices() {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT * FROM service;";
        if ($session != "false") {
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $service = new service_model;
                    $service->createService($row['K_IDSERVICE'], $row['N_GERENCY'], $row['N_TYPE'], $row['N_DESCRIPTION'], $row['N_SCOPE'], $row['N_DURATION']);
                    $answer[$i] = $service;
                    $i++;
                }
            }
        } else {
            $answer = "Error de informacion";
        }
        return $answer;
    }

    public function getServicesPerUser($userId) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT * FROM specific_service WHERE K_IDUSER = " . $userId . ";";
        if ($session != "false") {
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $sService = new service_spec_model;
                    $sService->createServiceS($row['K_ID_SP_SERVICE'], $row['N_DURATION'], $row['K_IDCLARO'], $row['N_DESCRIPTION'], $row['D_DATE_START_P'], $row['D_DATE_FINISH_P'], $row['D_DATE_CREATION'], $row['D_FORECAST'], $this->dao_order_model->getOrderById($row['K_IDORDER']), $this->dao_site_model->getSitePerId($row['K_IDSITE']), $this->getServicePerId($row['K_IDSERVICE']), $row['K_IDUSER'], $row['N_CLARO_DESCRIPTION'], $row['N_INGENIERO_SOL'], $row['N_PROYECTO'], $row['N_ESTADO'], $row['N_CRQ']);
                    $sService->setDateFinishR($row['D_DATE_FINISH_R']);
                    $sService->setDateStartR($row['D_DATE_START_R']);
                    $answer[$i] = $sService;
                    $i++;
                }
            }
        } else {
            $answer = "Error de informacion";
        }
        return $answer;
    }

    public function getServicePerId($serviceId) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT * FROM service WHERE K_IDSERVICE = " . $serviceId . ";";
        $result       = $session->query($sql);
        $row          = $result->fetch_assoc();
        $service      = new service_model;
        $service->createService($row['K_IDSERVICE'], $row['N_GERENCY'], $row['N_TYPE'], $row['N_DESCRIPTION'], $row['N_SCOPE'], $row['N_DURATION']);
        return $service;
    }

    public function insertServiceS($service) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT count(*) FROM specific_service;";
        if ($session != "false") {
            $result = $session->query($sql);
            $row    = $result->fetch_assoc();
            $order  = $this->dao_order_model->getOrderById($service->getOrder());
            if ($order->getId() == "") {
                $newOrder = new order_model;
                $newOrder->createOrder($service->getOrder(), "", $service->getDateCreation());
                $this->dao_order_model->insertOrder($newOrder);
            }
            $sql2 = "INSERT INTO specific_service (K_IDUSER, K_IDSERVICE, K_IDSITE, K_IDORDER, D_DATE_START_P, D_DATE_FINISH_P, D_FORECAST, K_IDCLARO, N_DESCRIPTION, D_DATE_CREATION, N_ING_SOL, N_ESTADO, N_PROYECTO, N_CRQ, N_CLARO_DESCRIPTION)
                values (" . $service->getUser() . ", " . $service->getService() . ", " . $service->getSite() . " , '" . $service->getOrder() . "', STR_TO_DATE('" . $service->getDateStartP() . "', '%Y-%m-%d'), STR_TO_DATE('" . $service->getDateFinishP() . "', '%Y-%m-%d'), STR_TO_DATE('" . $service->getDateForecast() . "', '%Y-%m-%d'), '" . $service->getIdClaro() . "', '" . $service->getDescription() . "', STR_TO_DATE('" . $service->getDateCreation() . "', '%Y-%m-%d'), '" . $service->getIngSol() . "', '" . $service->getEstado() . "', '" . $service->getProyecto() . "', '" . $service->getCRQ() . "', '" . $service->getClaroDescription() . "');";
            print_r($sql2);
            $result = $session->query($sql2);
        } else {
            $answer = "Error de informacion";
        }
    }

    //CAMILO-------------------------------------------------INSERTA DATOS DE EXCEL

    public function insertFromExcel($activity) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT count(*) FROM specific_service;";
        $count        = 0;
        if ($session != "false") {
            $result = $session->query($sql);
            $row    = $result->fetch_assoc();
            $order  = $this->dao_order_model->getOrderById($activity->getOrder());
            if ($order->getId() == "") {
                $newOrder = new order_model;
                $newOrder->createOrder($activity->getOrder(), "", $activity->getDateCreation());
                $this->dao_order_model->insertOrder($newOrder);
            }
            $timezone = date_default_timezone_get();
            $date     = date('m-d-Y', time());
            $sql3     = "SELECT  COUNT(*) FROM specific_service where K_IDCLARO = " . $activity->getIdClaro() . ";";
            $result   = $session->query($sql3);
            $row      = $result->fetch_assoc();
            if ($row['COUNT(*)'] == 0) {
                $sql2 = "INSERT INTO specific_service (K_IDUSER, K_IDCLARO, N_DESCRIPTION, N_CLARO_DESCRIPTION, D_DATE_CREATION, D_FORECAST, K_IDORDER, K_IDSITE, K_IDSERVICE, N_ING_SOL, N_PROYECTO,N_ESTADO, N_CANTIDAD, N_REGION, D_DATE_START_P, K_ID_DOCUMENTADOR) values ("
                . $activity->getId() . ", "
                . $activity->getIdClaro() . ",'"
                . $activity->getDescription() . "', '"
                . $activity->getClaroDescription() . "',
                            STR_TO_DATE('" . $activity->getDateCreation() . "','%Y-%m-%d'),
                            STR_TO_DATE('" . $activity->getDateForecast() . "','%Y-%m-%d'),"
                . $activity->getOrder() . ","
                . $activity->getSite() . ","
                . $activity->getService() . ",'"
                . $activity->getIngSol() . "','"
                . $activity->getProyecto() . "','"
                . $activity->getEstado() . "' ,"
                . $activity->getQuantity() . ", '"
                . $activity->getRegion() . "',
                            STR_TO_DATE('" . $date . "','%m-%d-%Y'),"
                . $activity->getNumDoc() . ");";
                $result = $session->query($sql2);
                $count++;
            }
        } else {
            $answer = "Error de informacion";
        }
        return $count;
    }
    //CAMILO--------------------------------------------Cancela con excel
    public function CancelFromExcel($cancel) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        if ($session != "false") {
            if ($cancel != "") {
                $sql = "UPDATE specific_service SET N_ESTADO = 'Cancelado' WHERE K_IDCLARO = " . $cancel . ";";
                $session->query($sql);
            }

        } else {
            $answer = "Error de informacion";
        }
    }

    //CAMILO--------------------------------------------ejecuta con excel
    public function executeFromExcel($executed, $fEjecucion, $estado) {

        if ($estado == 'Cancelada') {
            $estado     = 'Cancelado';
            $fEjecucion = 'null';
        } else {
            $estado     = 'Ejecutado';
            $fEjecucion = "STR_TO_DATE('" . $fEjecucion . "', '%Y-%m-%d')";
        }

        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        if ($session != "false") {

            if ($executed != "") {
                $sql = "UPDATE specific_service SET N_ESTADO = '" . $estado . "' , D_CLARO_F = $fEjecucion WHERE K_IDCLARO = " . $executed . ";";
                $session->query($sql);
            }

        } else {
            $answer = "Error de informacion";
        }
    }
    //CAMILO-------------------------------------------------INSERTA DATOS DE CIERRE
    public function updateClose($close) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "UPDATE specific_service SET D_DATE_START_R = STR_TO_DATE('" . $close->getDateStartR() . "', '%Y-%m-%d'),  D_DATE_FINISH_R = STR_TO_DATE('" . $close->getDateFinishR() . "', '%Y-%m-%d'),  N_ESTADO = '" . $close->getEstado() . "', N_CRQ = '" . $close->getCRQ() . "', N_CIERRE_DESCRIPTION = '" . $close->getCierreDescription() . "', N_DESCRIPTION_PROCESS = '" . $close->getDescriptionProceso() . "' WHERE K_IDCLARO = '" . $close->getIdClaro() . "';";
//         echo $sql;exit('termina aqui');
        $session->query($sql);
    }
    //---------------------------------------------------------------------------------------

    public function getAllServicesS() {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT * FROM specific_service;";
        if ($session != "false") {
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $sService = new service_spec_model;
                    $sService->createServiceS($row['K_ID_SP_SERVICE'], $row['N_DURATION'], $row['K_IDCLARO'], $row['N_DESCRIPTION'], $row['D_DATE_START_P'], $row['D_DATE_FINISH_P'], $row['D_DATE_CREATION'], $row['D_FORECAST'], $this->dao_order_model->getOrderById($row['K_IDORDER']), $this->dao_site_model->getSitePerId($row['K_IDSITE']), $this->getServicePerId($row['K_IDSERVICE']), $this->dao_user_model->getUserById($row['K_IDUSER']), $row['N_CLARO_DESCRIPTION'], $row['N_ING_SOL'], $row['N_PROYECTO'], $row['N_ESTADO'], $row['N_CRQ']);
                    $sService->setDateFinishR($row['D_DATE_FINISH_R']);
                    $sService->setDateStartR($row['D_DATE_START_R']);
                    $answer[$i] = $sService;
                    $i++;
                }
            }
        } else {
            $answer = "Error de informacion";
        }
        return $answer;
    }

    public function getServiceByIdOrder($idOrder) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT * FROM specific_service WHERE K_IDORDER = '" . $idOrder . "';";
        if ($session != "false") {
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $sService = new service_spec_model();
                    $sService->createServiceS($row['K_ID_SP_SERVICE'], $row['N_DURATION'], $row['K_IDCLARO'], $row['N_DESCRIPTION'], $row['D_DATE_START_P'], $row['D_DATE_FINISH_P'], $row['D_DATE_CREATION'], $row['D_FORECAST'], $row['K_IDORDER'], $this->dao_site_model->getSitePerId($row['K_IDSITE']), $this->getServicePerId($row['K_IDSERVICE']), $this->dao_user_model->getUserById($row['K_IDUSER']), $row['N_CLARO_DESCRIPTION'], $row['N_ING_SOL'], $row['N_PROYECTO'], $row['N_ESTADO'], $row['N_CRQ']);
                    $sService->setDateFinishR($row['D_DATE_FINISH_R']);
                    $sService->setDateStartR($row['D_DATE_START_R']);
                    $sService->setCierreDescription($row['N_CIERRE_DESCRIPTION']);
                    $sService->setQuantity($row['n_cantidad']);
                    $sService->setRegion($row['n_region']);
                    $sService->setDateFinishClaro($row['D_CLARO_F']);
                    $sService->setLink1($row['N_LINK_SEND']);
                    $sService->setLink2($row['N_LINK_EXECUTE']);
                    $sService->setNumDoc($row['K_ID_DOCUMENTADOR']);
                    $answer[$i] = $sService;
                    $i++;
                }
            }
        } else {
            $answer = "Error de informacion";
        }

        return $answer;
    }

    public function getServiceById($id) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT * FROM specific_service WHERE K_ID_SP_SERVICE = '" . $id . "';";
        if ($session != "false") {
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
                $row      = $result->fetch_assoc();
                $sService = new service_spec_model();
                $sService->createServiceS($row['K_ID_SP_SERVICE'], $row['N_DURATION'], $row['K_IDCLARO'], $row['N_DESCRIPTION'], $row['D_DATE_START_P'], $row['D_DATE_FINISH_P'], $row['D_DATE_CREATION'], $row['D_FORECAST'], $this->dao_order_model->getOrderById($row['K_IDORDER']), $this->dao_site_model->getSitePerId($row['K_IDSITE']), $this->getServicePerId($row['K_IDSERVICE']), $this->dao_user_model->getUserById($row['K_IDUSER']), $row['N_CLARO_DESCRIPTION'], $row['N_ING_SOL'], $row['N_PROYECTO'], $row['N_ESTADO'], $row['N_CRQ']);
                $sService->setDateFinishR($row['D_DATE_FINISH_R']);
                $sService->setDateStartR($row['D_DATE_START_R']);
                $sService->setCierreDescription($row['N_CIERRE_DESCRIPTION']);
            }
        } else {
            $sService = "Error de informacion";
        }
        return $sService;
    }

    public function getServiceByIdActivity($id) {

        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT * FROM specific_service WHERE K_IDCLARO = '" . $id . "';";
        if ($session != "false") {
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
                $row      = $result->fetch_assoc();
                $sService = new service_spec_model();
                $sService->createServiceS(
                    $row['K_ID_SP_SERVICE'],
                    $row['N_DURATION'],
                    $row['K_IDCLARO'],
                    $row['N_DESCRIPTION'],
                    $row['D_DATE_START_P'],
                    $row['D_DATE_FINISH_P'],
                    $row['D_DATE_CREATION'],
                    $row['D_FORECAST'],
                    $this->dao_order_model->getOrderById($row['K_IDORDER']),
                    $this->dao_site_model->getSitePerId($row['K_IDSITE']),
                    $this->getServicePerId($row['K_IDSERVICE']),
                    $this->dao_user_model->getUserById($row['K_IDUSER']),
                    $row['N_CLARO_DESCRIPTION'],
                    $row['N_ING_SOL'],
                    $row['N_PROYECTO'],
                    $row['N_ESTADO'],
                    $row['N_CRQ']);

                $sService->setDateFinishR($row['D_DATE_FINISH_R']);
                $sService->setDateStartR($row['D_DATE_START_R']);
                $sService->setCierreDescription($row['N_CIERRE_DESCRIPTION']);

                $sService->setRegion($row['n_region']);
                $sService->setQuantity($row['n_cantidad']);

            }
        } else {
            $sService = "Error de informacion";
        }
        return $sService;
    }

    public function updateEng($activity, $inge) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        if ($session != "false") {
            if ($activity != "") {
                $sql = "UPDATE specific_service SET K_IDUSER = " . $inge . "  WHERE K_IDCLARO = " . $activity . ";";
                $session->query($sql);
            }

        } else {
            $answer = "Error de informacion";
        }
    }

    public function getEnviadoByOrder($order) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT count(*) FROM specific_service where N_ESTADO = 'Enviado' and K_IDORDER = " . $order . ";";
        $result       = $session->query($sql);
        $answer       = $result->fetch_assoc();
        return $answer['count(*)'];
    }

    public function getEjecutadoByOrder($order) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT count(*) FROM specific_service where N_ESTADO = 'Ejecutado' and K_IDORDER = " . $order . ";";
        $result       = $session->query($sql);
        $answer       = $result->fetch_assoc();
        return $answer['count(*)'];
    }

    public function getCanceladoByOrder($order) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT count(*) FROM specific_service where N_ESTADO = 'Cancelado' and K_IDORDER = " . $order . ";";
        $result       = $session->query($sql);
        $answer       = $result->fetch_assoc();
        return $answer['count(*)'];
    }

    public function getAsignadoByOrder($order) {
        $dbConnection = new configdb_model();
        $session      = $dbConnection->openSession();
        $sql          = "SELECT count(*) FROM specific_service where N_ESTADO = 'Asignada' and K_IDORDER = " . $order . ";";
        $result       = $session->query($sql);
        $answer       = $result->fetch_assoc();
        return $answer['count(*)'];
    }
    //consulta de todas las actividades
    public function getTotalActivities($mes, $idUser, $role,$anio) {
        $where   = "";
        $usuario = "";
        if ($idUser != '1069722400') {
            $usuario = " and ss.K_IDUSER =" . $idUser . "";
        }

        $mesMasUno = (strlen($mes + 1) == 1) ? '0'.($mes+1) : $mes+1;

        if (strlen($mes) === 1) {
            $mes = '0'.$mes;
        }
        //si le enviamos mes
        if ($anio != 0) { // si es igual a 0 significa que es el total de actividades, entonces no necesita el where
            if ($mes != 12) {
                $where = "WHERE (ss.D_CLARO_F >= '".$anio."-" . $mes . "-01' AND ss.D_CLARO_F < '".$anio."-" . ($mesMasUno) . "-01'" . $usuario . ") OR ( ss.D_DATE_START_P >= '".$anio."-" . $mes . "-01' AND ss.D_DATE_START_P < '".$anio."-" . ($mesMasUno) . "-01' AND ss.D_CLARO_F is null" . $usuario . ")";
            } else {
                $where = "WHERE (ss.D_CLARO_F >= '".$anio."-" . $mes . "-01' AND ss.D_CLARO_F < '".($anio + 1)."-01-01'" . $usuario . ") OR ( ss.D_DATE_START_P >= '".$anio."-" . $mes . "-01' AND ss.D_DATE_START_P < '".($anio + 1)."-01-01' AND ss.D_CLARO_F is null" . $usuario . ")";
            }
        }

        $query = $this->db->query("
            SELECT
                ss.K_IDORDER as ORDEN,
                ss.K_IDCLARO AS ACTIVIDAD,
                service.N_TYPE AS TIPO,
                  CASE
                  WHEN service.N_TYPE = 'C1' THEN '4,00'
                      WHEN service.N_TYPE = 'C2' THEN '4,00'
                      WHEN service.N_TYPE = 'C3' THEN '2,67'
                      WHEN service.N_TYPE = 'T1' THEN '1,14'
                      WHEN service.N_TYPE = 'T2' THEN '1,14'
                      WHEN service.N_TYPE = 'T3' THEN '1,33'
                      WHEN service.N_TYPE = 'T4' THEN '1,14'
                      WHEN service.N_TYPE = 'T5' THEN '0,50'
                      WHEN service.N_TYPE = 'T6' THEN '0,50'
                END AS TIEMPO,
                ss.n_cantidad as CANT,
                s.N_NAME as ESTACION,
                concat(u.N_NAME,' ', u.N_LASTNAME) as NOMBRE_ING,
                ss.D_DATE_START_P as F_ASIFGNACION,
                ss.D_DATE_FINISH_R as F_CIERRE_ING,
                ss.D_CLARO_F as F_EJECUCION,
                ss.N_ESTADO as ESTADO,
                ss.N_PROYECTO as PROYECTO,
                CONCAT(ud.N_NAME,' ',ud.N_LASTNAME) AS documentador,

                ss.D_FORECAST as F_FORECAST,
                ss.D_DATE_CREATION as F_CREACION,
                ss.N_ING_SOL as SOLICITANTE,
                ss.n_region as REGION ,
                ss.N_CLARO_DESCRIPTION as DESCRIPCION
                from specific_service ss
                inner join user u
                on ss.K_IDUSER = u.K_IDUSER
                LEFT JOIN user ud
                ON ss.K_ID_DOCUMENTADOR = ud.K_IDUSER
                inner join site s
                on ss.K_IDSITE = s.K_IDSITE
                inner join service
                on ss.K_IDSERVICE = service.K_IDSERVICE
            " . $where . "" . $usuario . "
            order by ss.K_IDORDER asc
            ;"
        );
        // echo("<pre>"); print_r($this->db->last_query()); echo("</pre>");
        return $query->result();
    }
    //Modelo de los meses totales que han asignado actividad
    public function getMonthsWorked() {
        $query = $this->db->query("
          SELECT distinct
          EXTRACT( YEAR_MONTH FROM specific_service.D_DATE_START_P ) AS meses
          FROM specific_service GROUP BY D_DATE_START_P;
          ");
        return $query->result();
    }

    // retorna la cantidad y estados totales por meses
    public function getCatMonthStatusTotal() {
        $user  = ($_SESSION['role'] == 4) ? "" : "where K_IDUSER = " . $_SESSION['id'] . "";
        $query = $this->db->query("
            select
            count(*) as cantidad, N_ESTADO as estado,
            CASE
                WHEN D_CLARO_F >0 THEN EXTRACT(year_month FROM D_CLARO_F)
                ELSE EXTRACT(year_month FROM D_DATE_START_P)
            END
             as meses
             from specific_service
             " . $user . "
             group by meses, estado;
            ");
        return $query->result();
    }

    public function getParamsBymonth($mes) {
        $usuario = "";
        $usuario = ($_SESSION['role'] == 4) ? "" : " and ss.K_IDUSER = " . $_SESSION['id'] . "";

        $where = "";
        $where = ($mes == 12) ?
        "(ss.D_CLARO_F >= '2017-" . $mes . "-01' and ss.D_CLARO_F < '2018-01-01'" . $usuario . ") or ( ss.D_DATE_START_P >= '2017-" . $mes . "-01' and ss.D_DATE_START_P < '2018-01-01' and ss.D_CLARO_F is null" . $usuario . ")" :

        "(ss.D_CLARO_F >= '2018-" . $mes . "-01' and ss.D_CLARO_F < '2018-" . ($mes + 1) . "-01'" . $usuario . ") or ( ss.D_DATE_START_P >= '2018-" . $mes . "-01' and ss.D_DATE_START_P < '2018-" . ($mes + 1) . "-01' and ss.D_CLARO_F is null" . $usuario . ")";

        $query = $this->db->query("
            select
            count(*) as cantidad,
            s.N_TYPE as tipo,
            ss.N_ESTADO as estado
            from specific_service ss
            inner join service s
            on ss.K_IDSERVICE = s.K_IDSERVICE
            where
            " . $where . "
            group by s.N_TYPE, ss.N_ESTADO
          ");
        return $query->result();
    }

    public function getActivitiesByTipe($tipo, $mes) {
        $usuario = "";
        $usuario = ($_SESSION['role'] == 4) ? "" : " and (ss.K_IDUSER= " . $_SESSION['id'] . ")";
        $where   = "";
        if ($mes == 12) {
            $where = "where
            (
              (ss.D_CLARO_F >= '2017-" . $mes . "-01' and ss.D_CLARO_F < '2018-01-01')
              or
                ( ss.D_DATE_START_P >= '2017-" . $mes . "-01' and ss.D_DATE_START_P < '2018-01-01' and ss.D_CLARO_F is null)
            )
            and
            (s.N_TYPE ='" . $tipo . "'" . $usuario . ");";
        } else {
            $where = "where
            (
              (ss.D_CLARO_F >= '2018-" . $mes . "-01' and ss.D_CLARO_F < '2018-" . ($mes + 1) . "-01')
              or
                ( ss.D_DATE_START_P >= '2018-" . $mes . "-01' and ss.D_DATE_START_P < '2018-" . ($mes + 1) . "-01' and ss.D_CLARO_F is null)
            )
            and
            (s.N_TYPE ='" . $tipo . "'" . $usuario . ");";
        }

        $query = $this->db->query("
            select
            s.N_TYPE as tipo,
            ss.K_IDORDER as orden,
            ss.K_IDCLARO as id,
            ss.n_cantidad as cant,
            ss.N_PROYECTO as proyecto,
            ss.D_DATE_START_P as f_asignacion,
            ss.D_CLARO_F as f_ejecucion,
            concat(u.N_NAME, ' ', u.N_LASTNAME) as ingeniero,
            ss.N_ESTADO as estado,
            ss.N_ING_SOL as ingeSol

            from specific_service ss
            inner join service s
            on ss.K_IDSERVICE = s.K_IDSERVICE
            inner join user u
            on ss.K_IDUSER = u.K_IDUSER
            " . $where . "
        ");
        return $query->result();
    }

    public function getAllProximas() {
        $user = ($_SESSION['role'] == 4) ? "" : " and (ss.K_IDUSER= " . $_SESSION['id'] . ")";

        $query = $this->db->query("
          select
            s.N_TYPE as tipo,
            ss.K_IDORDER as orden,
            ss.K_IDCLARO as id,
            ss.n_cantidad as cantidad,
            ss.N_PROYECTO as proyecto,
            ss.N_ING_SOL as solicitante,
            ss.D_DATE_START_P as asignacion,
            ss.D_CLARO_F as ejecucion,
            concat(u.N_NAME,' ',u.N_LASTNAME) as ingeniero,
            ss.N_ESTADO as estado,
            ss.N_LINK_SEND as link1,
            ss.N_LINK_EXECUTE as link2

          FROM
             specific_service ss
             inner join service s
             on ss.K_IDSERVICE = s.K_IDSERVICE
             inner join user u
             on ss.K_IDUSER = u.K_IDUSER

          where
             ss.N_ESTADO != 'Ejecutado' and
             ss.N_ESTADO != 'Cancelado' and
             (ss.N_LINK_SEND is null or ss.N_LINK_EXECUTE is null or ss.N_LINK_SEND = '' or ss.N_LINK_EXECUTE = '') " . $user . "

        ");

        return $query->result();
    }
    public function enviarDatos($data){
        if($data[2] == 'serviceType'){
            $this->db->query("UPDATE specific_service SET K_IDSERVICES = '$data[1]' WHERE K_IDCLARO = '$data[0]'");
        }
        if($data[2] == 'dateStartP'){
            $this->db->query("UPDATE specific_service SET D_DATE_START_P   = '$data[1]' WHERE K_IDCLARO = '$data[0]'");
        }
        if($data[2] == 'dateFinishR'){
            $this->db->query("UPDATE specific_service SET D_DATE_FINISH_P  = '$data[1]' WHERE K_IDCLARO = '$data[0]'");
        }
        if($data[2] == 'dateForecast'){
            $this->db->query("UPDATE specific_service SET D_FORECAST   = '$data[1]' WHERE K_IDCLARO = '$data[0]'");
        }
        if($data[2] == 'dateFinishClaro'){
            $this->db->query("UPDATE specific_service SET D_DATE_FINISH_R  = '$data[1]' WHERE K_IDCLARO = '$data[0]'");
        }
    }

    public function updateLink1($actividad, $link, $columna) {
        $data = array(
            $columna => $link,
        );
        $this->db->where('K_IDCLARO', $actividad);
        $this->db->update('specific_service', $data);

        $error = $this->db->error();
        if ($error['message']) {
            print_r($error);
            return "error";
        } else {
            return "exitoso";
        }

    }

    public function getservicesX() {
        $query = $this->db->query("
              SELECT
              concat(u.N_NAME, ' ', u.N_LASTNAME) as nombre,
              s.N_NAME as Sitio,
              sp.K_IDORDER as Orden,
              sp.D_DATE_START_P as 'Fecha inicio',
              sp.N_ESTADO as Estado

              FROM
              specific_service sp

              inner join site s
              on sp.K_IDSITE = s.K_IDSITE
              inner join user u
              on sp.K_IDUSER = u.K_IDUSER
              limit 400 , 200");

        return $query->result();

    }

    // Trae el tipo y cantidad ejecutados de el mes dado
    public function cant_by_month_executed($mes) {
        if ($mes == 12) {
            $where = "AND
                      (ss.D_CLARO_F >= '2018-12-01' AND
                      ss.D_CLARO_F < '2019-01-01')";
        } else {
            $where = "AND
                      (ss.D_CLARO_F >= '2018-" . $mes . "-01' AND
                      ss.D_CLARO_F < '2018-" . ($mes + 1) . "-01')";
        }
        $query = $this->db->query("
              SELECT
              COUNT(s.N_TYPE) AS cant,
              s.N_TYPE AS tipo,
              ss.D_CLARO_F as f_ejecucion
              FROM
              specific_service ss
              INNER JOIN service s
              ON ss.K_IDSERVICE = s.K_IDSERVICE
              WHERE
              ss.N_ESTADO = 'Ejecutado'
              " . $where . "
              GROUP BY s.N_TYPE, ss.D_CLARO_F

        ");
        return $query->result();

    }

    // Trae el tipo y cantidad asignados de el mes dado
    public function cant_by_month_assign($mes) {
        if ($mes == 12) {
            $where = "AND
                      (ss.D_DATE_START_P >= '2018-12-01' AND
                      ss.D_DATE_START_P < '2019-01-01')";
        } else {
            $where = "AND
                      (ss.D_DATE_START_P >= '2018-" . $mes . "-01' AND
                      ss.D_DATE_START_P < '2018-" . ($mes + 1) . "-01')";
        }
        $query = $this->db->query("
              SELECT
              COUNT(s.N_TYPE) AS cant,
              s.N_TYPE AS tipo,
              ss.D_DATE_START_P as f_asignacion
              FROM
              specific_service ss
              INNER JOIN service s
              ON ss.K_IDSERVICE = s.K_IDSERVICE
              WHERE
              ss.N_ESTADO = 'Asignada'
              " . $where . "
              GROUP BY s.N_TYPE, ss.D_DATE_START_P

        ");
        return $query->result();

    }

    public function updateFecha($data) {
        $this->db->where('K_IDORDER', $data['K_IDORDER']);
        $this->db->update('specific_service', $data);

        $error = $this->db->error();
        if ($error['message']) {
            return 'error';
        } else {
            return 'ok';
        }

    }

    public function upDateInconsistentes($data) {
        $this->db->where('K_IDCLARO', $data['K_IDCLARO']);
        $this->db->update('specific_service', $data);

        // print_r($this->db->last_query());
        $error = $this->db->error();
        if ($error['message']) {
            return 'error';
        } else {
            return 1;
        }

    }
    public function upDateInconsistentesOt($data) {
        $this->db->where('K_IDORDER', $data['K_IDORDER']);
        $this->db->update('ot', $data);

        $error = $this->db->error();
        if ($error['message']) {
            return 'error';
        } else {
            return 1;
        }

    }

    //retorna actividades, cullas fechas sean inconsistentes
    public function fechasInconsistentes() {
        $where = ($_SESSION['role'] == 4) ? "" : "AND (ss.K_IDUSER = " . $_SESSION['id'] . ")";
        $query = $this->db->query("
      SELECT ss.K_IDORDER AS orden, K_IDCLARO as claro, ot.D_DATE_CREATION as creacion,
         ot.D_ASIG_Z as asig_a_ZTE, ss.D_DATE_START_P as asignacion, ss.D_DATE_START_R as inicio_ing,
         ss.D_DATE_FINISH_R as fin_ing, ss.D_CLARO_F as ejecucion, ss.D_FORECAST as forecast, ss.N_ESTADO  as estado,
         concat(u.N_NAME, ' ', u.N_LASTNAME) as ingeniero
          FROM specific_service ss
          INNER JOIN ot
          ON  ss.K_IDORDER = ot.K_IDORDER
          INNER JOIN user u
          on ss.K_IDUSER = u.K_IDUSER
          WHERE  ((ot.D_ASIG_Z < ot.D_DATE_CREATION and ot.D_ASIG_Z <> '0000-00-00') OR
          (ss.D_DATE_START_P < ot.D_ASIG_Z OR ss.D_DATE_START_P < ot.D_DATE_CREATION) OR
          ((ss.D_DATE_START_R < ss.D_DATE_START_P OR ss.D_DATE_START_R < D_ASIG_Z) and (ss.D_DATE_START_R <> '0000-00-00' AND ss.D_CLARO_F <> '0000-00-00')) OR
          ((ss.D_DATE_FINISH_R < ss.D_DATE_START_R OR ss.D_DATE_FINISH_R < ss.D_DATE_START_P) and (ss.D_DATE_FINISH_R <> '0000-00-00')) OR
          (ss.D_CLARO_F < ss.D_DATE_FINISH_R OR ss.D_CLARO_F < ss.D_DATE_START_R )) AND
          (ss.N_ESTADO ='Ejecutado')
          " . $where . ";
        ");

        return $query->result();
    }

    //retorna actividades, cullas fechas sean inconsistentes
    public function cantFechasInconsistentes() {
        $where = ($_SESSION['role'] == 4) ? "" : "and (ss.K_IDUSER = " . $_SESSION['id'] . ")";
        $query = $this->db->query("
          SELECT count(*) AS cant
          FROM specific_service ss
          INNER JOIN ot
          ON  ss.K_IDORDER = ot.K_IDORDER
          INNER JOIN user u
          on ss.K_IDUSER = u.K_IDUSER
          WHERE  ((ot.D_ASIG_Z < ot.D_DATE_CREATION and ot.D_ASIG_Z <> '0000-00-00') OR
          (ss.D_DATE_START_P < ot.D_ASIG_Z OR ss.D_DATE_START_P < ot.D_DATE_CREATION) OR
          ((ss.D_DATE_START_R < ss.D_DATE_START_P OR ss.D_DATE_START_R < D_ASIG_Z) and (ss.D_DATE_START_R <> '0000-00-00' AND ss.D_CLARO_F <> '0000-00-00')) OR
          ((ss.D_DATE_FINISH_R < ss.D_DATE_START_R OR ss.D_DATE_FINISH_R < ss.D_DATE_START_P) and (ss.D_DATE_FINISH_R <> '0000-00-00')) OR
          (ss.D_CLARO_F < ss.D_DATE_FINISH_R OR ss.D_CLARO_F < ss.D_DATE_START_R )) AND
          (ss.N_ESTADO ='Ejecutado')
          " . $where . ";
          ");
        return $query->row();
    }

    // Retorna actividades de specific services where K_IDCLARO in (arg $id_actividades)
    public function get_services_by_ids($id_actividades) {
        if (count($id_actividades) == 0) {
            return false;
        }

        $query = $this->db->select("K_IDORDER, N_ING_SOL, D_DATE_CREATION, N_PROYECTO, N_DESCRIPTION, K_IDCLARO,n_region, n_cantidad,N_CLARO_DESCRIPTION, D_FORECAST")
            ->from("specific_service")
            ->where_in('K_IDCLARO', $id_actividades)
            ->get();

        return $query->result();
    }

    // actualiza los id_site de specific_service por el id dado todos las actividades que vengan en el where_in
    public function actualizar_sites_specific_service($id, $where_in) {
        $this->db->where_in('K_IDSITE', $where_in);
        $this->db->update('specific_service', array('K_IDSITE' => $id));
        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }
    //Función que reasigna a un ingeniero una actividad(JC)
    public function actualizardocu($actividad, $docu){
        $sql=$this->db->query("
            UPDATE specific_service SET K_ID_DOCUMENTADOR = '$docu' WHERE K_IDCLARO = '$actividad'
            ");
        
        if ($this->db->affected_rows() > 0){
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }

    // retorna los años en los cuales existan datos
    // recibe la columna
    public function getYearsWithData($col,$anioOMes)
    {
        $this->db->group_by($col.'x');
        $query = $this->db->select('DATE_FORMAT('.$col.' , '.$anioOMes.') AS '.$col.'x')
                        ->from('specific_service')
                        ->where(''.$col.' IS NOT NULL')
                        ->where(''.$col.' <>', '0000-00-00')
                        ->get();
        
        return $query->result();
    }


    public function getMonthsPerYear($anio,$tipoFecha)
    {
        $condicionFechaInicio = '';
        
        $this->db->group_by('mes');
        $query = $this->db->select('MONTH('.$tipoFecha.') AS mes')
                            ->from('specific_service')
                            ->where('YEAR('.$tipoFecha.')',$anio)
                            ->get();
        
        if ($tipoFecha != 'D_DATE_START_P') {
            $condicionFechaInicio = 'D_CLARO_F IS NULL';
            $this->db->where($condicionFechaInicio);
        }
        return $query->result();
        
    }
}
