<?php
App::uses('AppController', 'Controller');
class UserController extends AppController {
    var $name = 'user';
    var $components = array('Cookie', 'Email', 'Session', 'RequestHandler');
    var $helpers = array('Html', 'Js', 'Form', 'Session', 'Paginator', 'Common');
    var $uses = array('AppUser', 'BusinessLine', 'Subvertical', 'ProfitCenter', 'Permission', 'UserPermission', 'userCredential', 'DunningStepMaster', 'DunningMasterRecipient', 'MasterDataDetail', 'InvoiceDunning', 'InvoiceDunningRecipient', 'Contact');

    public function beforeFilter() {
        
        parent::beforeFilter();
        $this->layout = 'admin_layout';
        $ses = $this->Session->read('admin');
        $login_type =$ses['Admin']['AppUser']['user_type'];
        
        if (!$this->RequestHandler->isAjax()) {
            if (empty($ses) && !in_array($this->request->action, array('scheduleDunningReminder', 'schedular_emails', 'schedulerReminder')) || $login_type==2 ) {
                $this->redirect(array('controller' => 'home', 'action' => 'index'));
            }
        }
    }
    function index() {
        $this->set('title', 'User List');
        $this->paginate = array('limit' => 20, 'order' => 'AppUser.id desc', 'fields' => array('AppUser.*', 'UserPermission.*', 'BusinessLine.bl_name', 'Subvertical.sv_name', 'Permission.permission_desc'), 'joins' => array(array("table" => "user_permissions", "alias" => "UserPermission", "conditions" => array("UserPermission.app_user_id = AppUser.id")), array("table" => "business_lines", "alias" => "BusinessLine", "conditions" => array("BusinessLine.id = UserPermission.business_line_id")), array("table" => "subverticals", "alias" => "Subvertical", "conditions" => array("Subvertical.id = UserPermission.subvertical_id")), array("table" => "permissions", "alias" => "Permission", "conditions" => array("Permission.id = UserPermission.permission_id"))));
        $user_data = $this->paginate('AppUser');
        $this->set('user_data', $user_data);
    }
    /**********Dashboard(customers And Conracts)************/
    function dashboard() {
        $this->loadModel('Entitie');
        $this->loadModel('Contract');
        $this->loadModel('Project');
        $this->loadModel('UserPermission');
        /**********************Starts Here Code Used For Active Customer Count******************/
        $totalCustomerCount = $this->Entitie->find('all', array('fields' => array('Entitie.id')));
        $this->set("totalCustomerCount", $totalCustomerCount);
        /*********************End Here Code Used For Active Customer Count*********************/
        /****************Starts Here Code Used For Active Contract Count****************/
        $totalContractCount = $this->Contract->find('all', array('fields' => array('Contract.id')));
        $this->set("totalContractCount", $totalContractCount);
        /****************End Here Code Used For Active Contract Count****************/
        /*****************Starts Here Code Used For Active Project Count*************/
        $totalProjectCount = $this->Project->find('all', array('fields' => array('Project.id')));
        $this->set("totalProjectCount", $totalProjectCount);
        /****************End Here Code Used For Active Project Count*****************/
        $businessLineIds = array();
        $subvertical = array();
        $conditionArray = array();
        $conditionArray1 = array();
        $conditionArray2 = array();
        $topLocationextra = array();
        $graphFilterData = array();
        $filterSelectValue = 0;
        $startDate = date('Y-04-1', strtotime('-1 year'));
        $endDate = date('Y-03-31');
        $fascialYearDiff;
        $currentUserSession = $this->Session->read();
        $app_user_id = $currentUserSession['admin']['Admin']['AppUser']['id'];
        $user_var_sub_data = $this->UserPermission->find('all', array('recursive' => '-1', 'field' => array('UserPermission.business_line_id', ' UserPermission.subvertical_id'), 'conditions' => array('UserPermission.app_user_id' => $app_user_id)));
        for ($f = 0;$f < sizeof($user_var_sub_data);++$f) {
            $businessLineIds[] = $user_var_sub_data[$f]['UserPermission']['business_line_id'];
        }
        if ($this->request->is('post')) {
            $dropdownFilter = !empty($this->request->data['dropdownFilter']) ? $this->request->data['dropdownFilter'] : "";
            if (!empty($dropdownFilter)) {
                if ($dropdownFilter == 1) {
                    $currentMonth = date("m");
                    $currentYear = date("Y");
                    $filterSelectValue = 1;
                    $contractsExpiringCount = 1;
                    $fascialYearDiff = 1;
                    $conditionArray[] = "DATE_FORMAT(contracts.contract_start_dt,'%m')=" . $currentMonth;
                    $conditionArray[] = "DATE_FORMAT(contracts.contract_start_dt,'%Y')=" . $currentYear;
                    $conditionArray1[] = "DATE_FORMAT(entities.`created_date`,'%m')=" . $currentMonth;
                    $conditionArray1[] = "DATE_FORMAT(entities.`created_date`,'%Y')=" . $currentYear;
                    $conditionArray2[] = "DATE_FORMAT(contracts.contract_end_dt,'%m')=" . $currentMonth;
                    $conditionArray2[] = "DATE_FORMAT(contracts.contract_end_dt,'%Y')=" . $currentYear;
                } else if ($dropdownFilter == 2) {
                    $filterSelectValue = 2;
                    $contractsExpiringCount = 3;
                    $fascialYearDiff = 3;
                    $quarterMonthArray = array(date("Y-m", strtotime("-1 month")), date("Y-m"), date("Y-m", strtotime("+1 month")));
                    $conditionArray[] = "DATE_FORMAT(contracts.contract_start_dt,'%Y-%m') IN (" . implode(",", $quarterMonthArray) . ")";
                    $conditionArray1[] = "DATE_FORMAT(entities.`created_date`,'%Y-%m') IN (" . implode(",", $quarterMonthArray) . ")";
                    $conditionArray2[] = "DATE_FORMAT(contracts.contract_end_dt,'%Y-%m') IN (" . implode(",", $quarterMonthArray) . ")";
                } else if ($dropdownFilter == 3) {
                    $startDate = date('Y-04-1', strtotime('-1 year'));
                    $endDate = date('Y-03-31');
                    $filterSelectValue = 3;
                    $contractsExpiringCount = 6;
                    $fascialYearDiff = 6;
                    $conditionArray[] = "contracts.contract_start_dt >='" . $startDate . "'";
                    $conditionArray[] = "contracts.contract_start_dt <='" . $endDate . "'";
                    $conditionArray1[] = "entities.`created_date` >='" . $startDate . "'";
                    $conditionArray1[] = "entities.`created_date` <='" . $endDate . "'";
                    $conditionArray2[] = "contracts.contract_end_dt >='" . $startDate . "'";
                    $conditionArray2[] = "contracts.contract_end_dt <='" . $endDate . "'";
                }
            } else {
                $filterSelectValue = 3;
                $startDate = date('Y-04-1', strtotime('-1 year'));
                $endDate = date('Y-03-31');
                $contractsExpiringCount = 6;
                $fascialYearDiff = 6;
                $conditionArray[] = "contracts.contract_start_dt >='" . $startDate . "'";
                $conditionArray[] = "contracts.contract_start_dt <='" . $endDate . "'";
                $conditionArray1[] = "entities.`created_date` >='" . $startDate . "'";
                $conditionArray1[] = "entities.`created_date` <='" . $endDate . "'";
                $conditionArray2[] = "contracts.contract_end_dt >='" . $startDate . "'";
                $conditionArray2[] = "contracts.contract_end_dt <='" . $endDate . "'";
                $topLocationextra[] = array("entities.`created_date` >=" => $startDate, "entities.`created_date` <=" => $endDate);
            }
        } else {
            $filterSelectValue = 3;
            $startDate = date('Y-04-1', strtotime('-1 year'));
            $endDate = date('Y-03-31');
            $contractsExpiringCount = 6;
            $fascialYearDiff = 6;
            $conditionArray[] = "contracts.contract_start_dt >='" . $startDate . "'";
            $conditionArray[] = "contracts.contract_start_dt <='" . $endDate . "'";
            $conditionArray1[] = "entities.`created_date` >='" . $startDate . "'";
            $conditionArray1[] = "entities.`created_date` <='" . $endDate . "'";
            $conditionArray2[] = "contracts.contract_end_dt >='" . $startDate . "'";
            $conditionArray2[] = "contracts.contract_end_dt <='" . $endDate . "'";
            $topLocationextra[] = array("entities.`created_date` >=" => $startDate, "entities.`created_date` <=" => $endDate);
        }
        /**Dashboard Modal Filter**/
        if (!empty($this->request->data['filterVertical'])) {
            unset($businessLineIds);
            $graphFilterData['vertical'] = $this->request->data['filterVertical'];
            for ($t = 0;$t < sizeof($graphFilterData['vertical']);++$t) {
                $businessLineIds[] = $graphFilterData['vertical'][$t];
            }
            $graphFilterData['sub_vertical'] = $this->request->data['filterSubVertical'];
            if (!empty($this->request->data['filterSubVertical'])) {
                $conditionArray[] = "projects.subvertical IN (" . implode(",", $this->request->data['filterSubVertical']) . ")";
            }
            $startDate = date('Y-04-1', strtotime('-1 year'));
            $endDate = date('Y-03-31');
            $contractsExpiringCount = 6;
            $fascialYearDiff = 6;
            $conditionArray[] = "contracts.contract_start_dt >='" . $startDate . "'";
            $conditionArray[] = "contracts.contract_start_dt <='" . $endDate . "'";
            $conditionArray1[] = "entities.`created_date` >='" . $startDate . "'";
            $conditionArray1[] = "entities.`created_date` <='" . $endDate . "'";
            $conditionArray2[] = "contracts.contract_end_dt >='" . $startDate . "'";
            $conditionArray2[] = "contracts.contract_end_dt <='" . $endDate . "'";
            $topLocationextra[] = array("entities.`created_date` >=" => $startDate, "entities.`created_date` <=" => $endDate);
        } else {
            $graphFilterData['vertical'] = array();
        }
        if (!empty($this->request->data['filterProfitCenter'])) {
            $graphFilterData['ProfitCenter'] = $this->request->data['filterProfitCenter'];
            if (!empty($this->request->data['filterProfitCenter'])) {
                $conditionArray[] = "projects.profit_center_id IN (" . implode(",", $this->request->data['filterProfitCenter']) . ")";
            }
            $startDate = date('Y-04-1', strtotime('-1 year'));
            $endDate = date('Y-03-31');
            $contractsExpiringCount = 6;
            $fascialYearDiff = 6;
            $conditionArray[] = "contracts.contract_start_dt >='" . $startDate . "'";
            $conditionArray[] = "contracts.contract_start_dt <='" . $endDate . "'";
            $conditionArray1[] = "entities.`created_date` >='" . $startDate . "'";
            $conditionArray1[] = "entities.`created_date` <='" . $endDate . "'";
            $conditionArray2[] = "contracts.contract_end_dt >='" . $startDate . "'";
            $conditionArray2[] = "contracts.contract_end_dt <='" . $endDate . "'";
            $topLocationextra[] = array("entities.`created_date` >=" => $startDate, "entities.`created_date` <=" => $endDate);
        }
        $this->set("graphFilterData", $graphFilterData);
        /**Custom Date Range Code**/
        if (!empty($this->request->data['stratDate']) && !empty($this->request->data['endDate'])) {
            $startDate = $this->request->data['stratDate'];
            $contractsExpiringCount = 6;
            $fascialYearDiff = 6;
            $filterSelectValue = 3;
            $conditionArray[] = "DATE_FORMAT(contracts.contract_start_dt,'%Y/%m') >='" . $startDate . "'";
            $conditionArray[] = "DATE_FORMAT(contracts.contract_start_dt,'%Y/%m') <='" . $endDate . "'";
            $conditionArray1[] = "DATE_FORMAT(entities.`created_date`,'%Y/%m') >='" . $startDate . "'";
            $conditionArray1[] = "DATE_FORMAT(entities.`created_date`,'%Y/%m') <='" . $endDate . "'";
            $conditionArray2[] = "DATE_FORMAT(contracts.contract_end_dt,'%Y/%m') >='" . $startDate . "'";
            $conditionArray2[] = "DATE_FORMAT(contracts.contract_end_dt,'%Y/%m') <='" . $endDate . "'";
        }
        /*Start Here Code Used For Top Ten Contracts Count*/
        $topTenContract = $this->Contract->query("SELECT MAX(contracts.tot_ctrct_value) AS Maxtot_ctrct_value,contracts.`contract_title`,contracts.contract_start_dt,contracts.status,contracts.id AS id ,projects.profit_center_id,projects.contract_id FROM contracts INNER JOIN projects ON projects.contract_id=contracts.id WHERE " . implode("&&", $conditionArray) . " && contracts.status=1 GROUP BY contracts.id ORDER BY Maxtot_ctrct_value DESC LIMIT 10");
        /*End Here Code Used For Top Ten Contracts Count*/
        /*Start Here Code Used For Top Ten Coustomers Count*/
        $topTenCustomer = $this->Contract->query("SELECT COUNT(contracts.cust_entity_id) AS MAXCOUNT, SUM(contracts.`tot_ctrct_value`) AS Amount ,contracts.cust_entity_id,contracts.contract_start_dt,contracts.status,entities.`entitiy_name`,contracts.id AS contract_id ,projects.profit_center_id,projects.contract_id FROM contracts INNER JOIN entities ON entities.id=contracts.`cust_entity_id` INNER JOIN projects ON projects.contract_id=contracts.id WHERE " . implode("&&", $conditionArray) . " && contracts.status=1 && entities.`status` LIKE '%Active%' GROUP BY contracts.`cust_entity_id` ORDER BY MAXCOUNT DESC LIMIT 10");
        /*End Here Code Used For Top Ten Coustomers Count*/
        /*Start Here Code Used For Top Ten Location Count*/
        $topTenLocation = array();
        $coustomerCount = $this->Contract->query("SELECT entities.id , entities.`entitiy_name`,entity_addresses.`city`, COUNT(entity_addresses.city) AS coustomerCount , SUM(entities.entity_turnover) AS customerValue ,entities.`created_date` FROM entities INNER JOIN entity_addresses ON entities.`id`=entity_addresses.`entity_id` WHERE " . implode("&&", $conditionArray1) . " GROUP BY entity_addresses.city ORDER BY coustomerCount DESC LIMIT 10");
        for ($i = 0;$i < sizeof($coustomerCount);++$i) {
            $contractCount = $this->Contract->query("SELECT entity_addresses.`city`,entity_addresses.id,COUNT(entity_addresses.city) AS contractCount, SUM(contracts.tot_ctrct_value) AS contractValue ,contracts.contract_start_dt FROM entity_addresses INNER JOIN contracts ON entity_addresses.id=contracts.`bill_to_address_id`  INNER JOIN projects ON projects.customer_entity_id=entity_addresses.entity_id WHERE " . implode("&&", $conditionArray) . " && entity_addresses.`city` LIKE '%" . $coustomerCount[$i]['entity_addresses']['city'] . "%'");
            $topTenLocation[] = array("location" => $coustomerCount[$i]['entity_addresses']['city'], "customerValue" => $coustomerCount[$i][0]['customerValue'], "customer_count" => $coustomerCount[$i][0]['coustomerCount'], "contractValue" => $contractCount[0][0]['contractValue'], "contract_count" => $contractCount[0][0]['contractCount']);
        }
        /*End Here Code Used For Top Ten Location Count*/
        /*Start Here Code Used For Contract Expiring Count*/
        $contractsExpiringArray = array();
        for ($i = 0;$i < $contractsExpiringCount;++$i) {
            $contractsExpiring = $this->Contract->query("SELECT contracts.`contract_title`,COUNT(contracts.contract_end_dt) AS countExpringContract,SUM(contracts.`tot_ctrct_value`) AS expiringContractValue,contracts.id,DATE_FORMAT(DATE(contracts.contract_end_dt),' %M') AS csdate ,DATE_FORMAT(DATE(contracts.contract_end_dt),' %Y') AS csYear, contracts.status FROM contracts WHERE DATE_FORMAT(contracts.contract_end_dt,'%Y')='" . date("Y", strtotime("-" . $i . "month")) . "' && DATE_FORMAT(contracts.contract_end_dt,'%m')='" . date("m", strtotime("-" . $i . "month")) . "' && contracts.status=1 GROUP BY csdate");
            if ($contractsExpiring) {
                for ($y = 0;$y < sizeof($contractsExpiring);++$y) {
                    $contractsExpiringArray[] = array("countExpringContract" => !empty($contractsExpiring[$y][0]['countExpringContract']) ? $contractsExpiring[$y][0]['countExpringContract'] : 0, "expiringContractValue" => !empty($contractsExpiring[$y][0]['expiringContractValue']) ? $contractsExpiring[$y][0]['expiringContractValue'] : 0, "csdate" => !empty($contractsExpiring[$y][0]['csdate']) ? $contractsExpiring[$y][0]['csdate'] : date("M", strtotime("-" . $i . "month")), "csYear" => !empty($contractsExpiring[$y][0]['csYear']) ? $contractsExpiring[$y][0]['csYear'] : date("Y", strtotime("-" . $i . "month")));
                }
            } else {
                $contractsExpiringArray[] = array("countExpringContract" => 0, "expiringContractValue" => 0, "csdate" => date("M", strtotime("-" . $i . "month")), "csYear" => date("Y", strtotime("-" . $i . "month")));
            }
        }
        
        /*End Here Code Used For Fiscal Year*/
        $this->set("topLocationextra", $topLocationextra);
        $this->set("showingfascialYear", $showingfascialYear);
        $this->set("contractsExpiring", $contractsExpiringArray);
        $this->set("topTenLocation", $topTenLocation);
        $this->set("topTenContract", $topTenContract);
        $this->set("topTenCustomer", $topTenCustomer);
        $this->set("filterSelectValue", $filterSelectValue);
    }
    /************project And Billing graphs**************/
    function projectsrevenue() {
        $this->loadModel('Entitie');
        $this->loadModel('Contract');
        $this->loadModel('Project');
        $this->loadModel('UserPermission');
        /***********Starts Here Code Used For Active Customer Count***********/
        $totalCustomerCount = $this->Entitie->find('all', array('fields' => array('Entitie.id')));
        $this->set("totalCustomerCount", $totalCustomerCount);
        /***********End Here Code Used For Active Customer Count***********/
        /***********Starts Here Code Used For Active Contract Count********/
        $totalContractCount = $this->Contract->find('all', array('fields' => array('Contract.id')));
        $this->set("totalContractCount", $totalContractCount);
        /***********End Here Code Used For Active Contract Count***********/
        /*****************************************************************/
        /*Starts Here Code Used For Active Project Count*/
        /*****************************************************************/
        $totalProjectCount = $this->Project->find('all', array('fields' => array('Project.id')));
        $this->set("totalProjectCount", $totalProjectCount);
        /*****************************************************************/
        /*End Here Code Used For Active Project Count*/
        /*****************************************************************/
        $conditionArray = array();
        $conditionArray1 = array();
        $conditionArray2 = array();
        $billingTrendMonthCount = 0;
        $provisionForDoubtfulDebt = 0;
        $currentUserSession = $this->Session->read();
        $app_user_id = $currentUserSession['admin']['Admin']['AppUser']['id'];
        $user_var_sub_data = $this->UserPermission->find('all', array('recursive' => '-1', 'field' => array('UserPermission.business_line_id', 'UserPermission.subvertical_id'), 'conditions' => array('UserPermission.app_user_id' => $app_user_id)));
        $businessLineIds = array();
        for ($f = 0;$f < sizeof($user_var_sub_data);++$f) {
            $businessLineIds[] = $user_var_sub_data[$f]['UserPermission']['business_line_id'];
        }
        if ($this->request->is('post')) {
            if (!empty($this->request->data['filterVertical'])) {
                unset($businessLineIds);
                $graphFilterData['vertical'] = $this->request->data['filterVertical'];
                for ($t = 0;$t < sizeof($graphFilterData['vertical']);++$t) {
                    $businessLineIds[] = $graphFilterData['vertical'][$t];
                }
            } else {
                $graphFilterData['vertical'] = array();
            }
            if (!empty($this->request->data['filterSubVertical'])) {
                $graphFilterData['sub_vertical'] = $this->request->data['filterSubVertical'];
            } else {
                $graphFilterData['sub_vertical'] = array();
            }
            if (!empty($this->request->data['filterProfitCenter'])) {
                $graphFilterData['ProfitCenter'] = $this->request->data['filterProfitCenter'];
                if (!empty($this->request->data['filterProfitCenter'])) {
                    $conditionArray[] = "projects.profit_center_id IN (" . implode(",", $this->request->data['filterProfitCenter']) . ")";
                }
            }
            $this->set("graphFilterData", $graphFilterData);
            $dropdownFilter = $this->request->data['dropdownFilter'];
            $filterSelectValue;
            if (!empty($dropdownFilter)) {
                if ($dropdownFilter == 1) {
                    $currentMonth = date("m");
                    $currentYear = date("Y");
                    $billingTrendMonthCount = 1;
                    $provisionForDoubtfulDebt = 1;
                    $filterSelectValue = 1;
                    $conditionArray[] = "projects.start_date='" . $currentMonth . "'";
                    $conditionArray[] = "projects.start_date='" . $currentYear . "'";
                    $conditionArray1[] = "invoices.invoice_date='" . $currentMonth . "'";
                    $conditionArray1[] = "invoices.invoice_date='" . $currentYear . "'";
                    $conditionArray2[] = "projects.`initial_end_date`='" . $currentMonth . "'";
                    $conditionArray2[] = "projects.`initial_end_date`='" . $currentYear . "'";
                } else if ($dropdownFilter == 2) {
                    $billingTrendMonthCount = 3;
                    $provisionForDoubtfulDebt = 3;
                    $filterSelectValue = 2;
                    $quarterMonthArray = array(date("Y-m", strtotime("-1 month")), date("Y-m"), date("Y-m", strtotime("+1 month")));
                    $conditionArray[] = "DATE_FORMAT(projects.start_date,'%Y-%m') IN (" . implode(",", $quarterMonthArray) . ")";
                    $conditionArray1[] = "DATE_FORMAT(invoices.invoice_date ,'%Y-%m') IN (" . implode(",", $quarterMonthArray) . ")";
                    $conditionArray2[] = "DATE_FORMAT(projects.`initial_end_date` ,'%Y-%m') IN (" . implode(",", $quarterMonthArray) . ")";
                } else if ($dropdownFilter == 3) {
                    $billingTrendMonthCount = 6;
                    $provisionForDoubtfulDebt = 6;
                    $filterSelectValue = 3;
                    $startDate = date('Y-04-1', strtotime('-1 year'));
                    $endDate = date('Y-03-31');
                    $conditionArray[] = "projects.start_date >='" . $startDate . "'";
                    $conditionArray[] = "projects.start_date <='" . $endDate . "'";
                    $conditionArray1[] = "invoices.invoice_date >='" . $startDate . "'";
                    $conditionArray1[] = "invoices.invoice_date <='" . $endDate . "'";
                    $conditionArray2[] = "projects.`initial_end_date` >='" . $startDate . "'";
                    $conditionArray2[] = "projects.`initial_end_date` <='" . $endDate . "'";
                }
            } else {
                $billingTrendMonthCount = 6;
                $provisionForDoubtfulDebt = 6;
                $filterSelectValue = 3;
                $startDate = date('Y-04-1', strtotime('-1 year'));
                $endDate = date('Y-03-31');
                $conditionArray[] = "projects.start_date >='" . $startDate . "'";
                $conditionArray[] = "projects.start_date <='" . $endDate . "'";
                $conditionArray1[] = "invoices.invoice_date >='" . $startDate . "'";
                $conditionArray1[] = "invoices.invoice_date <='" . $endDate . "'";
                $conditionArray2[] = "projects.`initial_end_date` >='" . $startDate . "'";
                $conditionArray2[] = "projects.`initial_end_date` <='" . $endDate . "'";
            }
        } else {
            $billingTrendMonthCount = 6;
            $provisionForDoubtfulDebt = 6;
            $filterSelectValue = 3;
            $startDate = date('Y-04-1', strtotime('-1 year'));
            $endDate = date('Y-03-31');
            $conditionArray[] = "projects.start_date >='" . $startDate . "'";
            $conditionArray[] = "projects.start_date <='" . $endDate . "'";
            $conditionArray1[] = "invoices.invoice_date >='" . $startDate . "'";
            $conditionArray1[] = "invoices.invoice_date <='" . $endDate . "'";
            $conditionArray2[] = "projects.`initial_end_date` >='" . $startDate . "'";
            $conditionArray2[] = "projects.`initial_end_date` <='" . $endDate . "'";
        }
        /**Custom Date Range Code**/
        if (!empty($this->request->data['stratDate']) && !empty($this->request->data['endDate'])) {
            $startDate = $this->request->data['stratDate'];
            $endDate = $this->request->data['endDate'];
            $conditionArray[] = "DATE_FORMAT(projects.start_date,'%Y/%m') >='" . $startDate . "'";
            $conditionArray[] = "DATE_FORMAT(projects.start_date,'%Y/%m') <='" . $endDate . "'";
            $conditionArray1[] = "DATE_FORMAT(invoices.invoice_date,'%Y/%m') >='" . $startDate . "'";
            $conditionArray1[] = "DATE_FORMAT(invoices.invoice_date,'%Y/%m') <='" . $endDate . "'";
            $conditionArray2[] = "DATE_FORMAT(projects.`initial_end_date`,'%Y/%m') >='" . $startDate . "'";
            $conditionArray2[] = "DATE_FORMAT(projects.`initial_end_date`,'%Y/%m') <='" . $endDate . "'";
        }
        /*This Code Used For Top 10 Projects In (Project & Billing Section)*/
        $toptenProjects = $this->Project->query("SELECT entities.`entitiy_name`,entity_addresses.`city`, SUM(projects.project_value) AS total_project_value, projects.`customer_entity_id`,projects.start_date,contracts.id AS contract_id FROM entities LEFT JOIN entity_addresses ON entities.id=entity_addresses.`entity_id` LEFT JOIN projects ON entities.`id`=projects.`customer_entity_id` LEFT JOIN contracts ON entities.id=contracts.`cust_entity_id`  WHERE " . implode("&&", $conditionArray) . " && projects.status=1  GROUP BY projects.`customer_entity_id` ORDER BY total_project_value DESC LIMIT 10");
        /*This Code Used For Top 10 Locations (Billing) In (Project & Billing Section)*/
        $topLocationBilling = $this->Project->query("SELECT entities.`entitiy_name`,entity_addresses.`city`, SUM(invoices.invoice_amount) AS total_invoice_value, invoices.`entity_id`,invoices.invoice_date,contracts.id AS contract_id FROM entities LEFT JOIN entity_addresses ON entities.id=entity_addresses.`entity_id` LEFT JOIN projects ON entities.`id`=projects.`customer_entity_id` LEFT JOIN invoices ON entities.id=invoices.`entity_id` LEFT JOIN contracts ON entities.id=contracts.`cust_entity_id`  WHERE " . implode("&&", $conditionArray1) . " && invoices.is_active=1  GROUP BY entity_addresses.`city`  ORDER BY total_invoice_value DESC LIMIT 10");
        /*This Code Used For Vertical Wise Revenue In (Project & Billing Section)*/
        $veticalWiseRevenue = $this->Project->query("SELECT projects.business_line, SUM(invoices.invoice_amount) AS amountBusinessLine, invoices.`is_active`, business_lines.bl_name, invoices.invoice_date FROM projects LEFT JOIN business_lines ON business_lines.`id`=projects.`business_line` LEFT JOIN invoices ON invoices.entity_id=projects.customer_entity_id  WHERE  " . implode("&&", $conditionArray1) . " && invoices.is_active=1 && business_lines.`id` IN (" . implode(",", $businessLineIds) . ")  GROUP BY projects.business_line");
        
        /*This Code Used For Provision For Doubtful Debt In (Project & Billing Section)*/
        $provisionForDoubtfulDebtVerticalsArray = array();
        for ($month = 0;$month < $provisionForDoubtfulDebt;++$month) {
            $provisionForDoubtfulDebtVerticals = $this->Project->query("SELECT projects.business_line, SUM(invoices.invoice_amount) AS amountBusinessLine,business_lines.bl_name, invoices.invoice_due_dt FROM projects LEFT JOIN business_lines ON business_lines.`id`=projects.`business_line` LEFT JOIN invoices ON invoices.entity_id=projects.customer_entity_id  WHERE DATE_FORMAT(invoices.`invoice_due_dt`,'%m')=" . date('m', strtotime("-" . $month . " month")) . " &&  DATE_FORMAT(invoices.`invoice_due_dt`,'%Y')=" . date('Y', strtotime("-" . $month . " month")) . " && business_lines.`id` IN (" . implode(",", $businessLineIds) . ") &&  invoices.`ar_cat_id`=2 GROUP BY projects.business_line");
            if (!empty($provisionForDoubtfulDebtVerticals)) {
                for ($t = 0;$t < sizeof($provisionForDoubtfulDebtVerticals);++$t) {
                    $provisionForDoubtfulDebtVerticalsArray[] = array("business_line" => !empty($provisionForDoubtfulDebtVerticals[$t]['business_lines']['bl_name']) ? $provisionForDoubtfulDebtVerticals[$t]['business_lines']['bl_name'] : "0", "recordValues" => array("month_years" => date("M", strtotime("-" . $month . "Month")), "years" => date("Y", strtotime("-" . $month . "Month")), "amountBusinessLine" => !empty($provisionForDoubtfulDebtVerticals[$t][0]['amountBusinessLine']) ? $provisionForDoubtfulDebtVerticals[$t][0]['amountBusinessLine'] : 0));
                }
            } else {
                $provisionForDoubtfulDebtVerticalsArray[] = array("business_line" => 0, "recordValues" => array("month_years" => date("M", strtotime("-" . $month . "Month")), "years" => date("Y", strtotime("-" . $month . "Month")), "amountBusinessLine" => 0));
            }
        }
        /*This Code Used For Provision For Doubtful Debt In (Project & Billing Section)*/
        $provisionForDoubtfulDebtCustomerArray = array();
        for ($month = 0;$month < $billingTrendMonthCount;++$month) {
            $provisionForDoubtfulDebtCustomers = $this->Project->query("SELECT entities.`id`,entities.`entitiy_name`, SUM(invoices.`invoice_amount`) AS invoiceamount,invoices.`invoice_due_dt` FROM entities LEFT JOIN invoices ON entities.id=invoices.`entity_id` WHERE DATE_FORMAT(invoices.`invoice_due_dt`,'%m')=" . date('m', strtotime("-" . $month . " month")) . " && DATE_FORMAT(invoices.`invoice_due_dt`,'%Y')=" . date('Y', strtotime("-" . $month . " month")) . " && invoices.`ar_cat_id`=2 GROUP BY entities.`entitiy_name` ORDER BY invoiceamount");
            if (sizeof($provisionForDoubtfulDebtCustomers) > 0) {
                break;
            }
        }
        for ($month = 0;$month < $provisionForDoubtfulDebt;++$month) {
            for ($t = 0;$t < sizeof($provisionForDoubtfulDebtCustomers);++$t) {
                $provisionForDoubtfulDebtCustomersData = $this->Project->query("SELECT entities.`entitiy_name`, SUM(invoices.`invoice_amount`) AS invoiceamount,invoices.`invoice_due_dt` FROM entities LEFT JOIN invoices ON entities.id=invoices.`entity_id` WHERE DATE_FORMAT(invoices.`invoice_due_dt`,'%m')=" . date('m', strtotime("-" . $month . " month")) . " && DATE_FORMAT(invoices.`invoice_due_dt`,'%Y')=" . date('Y', strtotime("-" . $month . " month")) . " && invoices.`ar_cat_id`=2 && entities.id=" . $provisionForDoubtfulDebtCustomers[$t]['entities']['id'] . " GROUP BY entities.`entitiy_name`");
                $provisionForDoubtfulDebtCustomerArray[] = array("customer_name" => !empty($provisionForDoubtfulDebtCustomersData[$t]['entities']['entitiy_name']) ? $provisionForDoubtfulDebtCustomersData[$t]['entities']['entitiy_name'] : "0", "month_years" => date("M", strtotime("-" . $month . "Month")), "years" => date("Y", strtotime("-" . $month . "Month")), "amountBusinessLine" => !empty($provisionForDoubtfulDebtCustomersData[$t][0]['invoiceamount']) ? $provisionForDoubtfulDebtCustomersData[$t][0]['invoiceamount'] : 0);
            }
        }
        /*** Projected Vs. Actual For Vertical Graph IN (Projects & Billings) ***/
        $uniquebusinessLineIds = array_values(array_unique($businessLineIds));
        $projectedVsActualVerticalArray = array();
        for ($t = 0;$t < sizeof($uniquebusinessLineIds);++$t) {
            $projectedVsActualVertical = $this->Project->query("SELECT business_lines.`bl_name`, business_lines.`id`, SUM(projects.`project_value`) AS projectValue, SUM(pricings.`billing_type_val`) AS actualValue, SUM(promise_to_pays.`promise_amount`) AS ptomiseToPay FROM business_lines LEFT JOIN projects ON business_lines.id=projects.`business_line` LEFT JOIN project_tasks ON projects.id=project_tasks.`project_id` LEFT JOIN pricings ON project_tasks.id= pricings.`task_id`LEFT JOIN promise_to_pays ON promise_to_pays.entity_id=projects.`customer_entity_id` WHERE " . implode("&&", $conditionArray2) . " && business_lines.`id` IN (" . $uniquebusinessLineIds[$t] . ")  GROUP BY business_lines.`id`");
            $businessLineData = $this->Project->query("SELECT business_lines.`bl_name`, business_lines.`id` FROM business_lines WHERE business_lines.`id`=" . $uniquebusinessLineIds[$t]);
            if ($projectedVsActualVertical) {
                for ($r = 0;$r < sizeof($projectedVsActualVertical);++$r) {
                    $projectedVsActualVerticalArray[] = array("bl_name" => $projectedVsActualVertical[$r]['business_lines']['bl_name'], "projectValue" => $projectedVsActualVertical[$r][0]['projectValue'], "actualValue" => $projectedVsActualVertical[$r][0]['actualValue'], "ptomiseToPay" => $projectedVsActualVertical[$r][0]['ptomiseToPay']);
                }
            } else {
                $projectedVsActualVerticalArray[] = array("bl_name" => $businessLineData[0]['business_lines']['bl_name'], "projectValue" => 0, "actualValue" => 0, "ptomiseToPay" => 0);
            }
        }
        /*** Projected Vs. Actual For Projects Graph IN (Projects & Billings) ***/
        $projectedVsActualProjects = $this->Project->query("SELECT projects.`project_title`, business_lines.`id`, SUM(projects.`project_value`) AS projectValue,SUM(pricings.`billing_type_val`) AS actualValue, SUM(promise_to_pays.`promise_amount`) AS promiseToPay FROM business_lines LEFT JOIN projects ON business_lines.id=projects.`business_line` LEFT JOIN project_tasks ON projects.id=project_tasks.`project_id` LEFT JOIN pricings ON project_tasks.id= pricings.`task_id` LEFT JOIN promise_to_pays ON promise_to_pays.entity_id=projects.`customer_entity_id` WHERE " . implode("&&", $conditionArray2) . " GROUP BY projects.`project_title` ORDER BY projectValue DESC LIMIT 10");
        /*This Code Used For Billing Growth & Billing Trends In (Project & Billing Section)*/
        $billingGrowth = $this->Project->query("SELECT business_lines.bl_name, SUM(invoices.invoice_amount) AS amountBusinessLine,projects.business_line, invoices.invoice_date FROM projects LEFT JOIN business_lines ON business_lines.`id`=projects.`business_line` LEFT JOIN invoices ON invoices.entity_id=projects.customer_entity_id WHERE " . implode("&&", $conditionArray1) . " && business_lines.`id` IN (" . implode(",", $businessLineIds) . ") GROUP BY projects.business_line");
        $this->set("billingTrendsCount", $billingTrendMonthCount);
        $this->set("customerWiseArray", $provisionForDoubtfulDebtCustomerArray);
        $this->set("provisionForDoubtfulDebtCustomer", $provisionForDoubtfulDebtCustomerArray);
        $this->set("projectedVsActualVertical", $projectedVsActualVerticalArray);
        $this->set("projectedVsActualProjects", $projectedVsActualProjects);
        $this->set("filterSelectValue", $filterSelectValue);
        $this->set("topLocationBilling", $topLocationBilling);
        $this->set("toptenProjects", $toptenProjects);
    }
    /****************Create users***************/
    public function create_user($id = '') {
        $this->set('title', 'User Details');
        $userid = base64_decode($id);
        $this->loadModel('UserPermission');
        $userDetail = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $userid)));
        $UserPermission = $this->UserPermission->find('list', array('fields' => array('UserPermission.app_user_id'), 'group' => 'UserPermission.app_user_id'));
        $this->AppUser->virtualFields = array('full_name' => "CONCAT(AppUser.first_name, ' ', AppUser.last_name)");
        $userlist = $this->AppUser->find('list', array('fields' => array('AppUser.id', 'AppUser.full_name'), 'conditions' => array('AppUser.id ' => $UserPermission)));
        $verticalList = $this->BusinessLine->find('list', array('group' => 'BusinessLine.bl_name', 'conditions' => array('is_active' => '1'), 'fields' => array('BusinessLine.bl_name')));
        $permissionList = $this->Permission->find('list', array('conditions' => array('is_active' => '1'), 'fields' => array('Permission.permission_desc')));
        $plist = $this->UserPermission->find('all', array('recursive' => '-1', 'conditions' => array('app_user_id' => $userid, 'is_active' => '1'), 'fields' => array('UserPermission.*')));
        $this->set('userid', $id);
        $this->set('verticalList', $verticalList);
        $this->set('permissionList', $permissionList);
        $this->set('userDetail', $userDetail);
        $this->set('plist', $plist);
        $this->set('userlist', $userlist);
        
    }
    /*************Create And update user******************/
    public function addUpdateDetails() {
        $msg = '';
        $sesn = $this->Session->read('admin');
        $userid = $sesn['Admin']['AppUser']['id'];
        $data = $this->request->data;
        $id = $data['AppUser']['id'];
        $appUser['AppUser'] = $data['AppUser'];
        $userPermission = $data['UserPermission'];
        if ($id == 0 || $id == '') {
            $appUser['AppUser']['created_by'] = $userid;
            $appUser['AppUser']['user_type'] = 2;
            $appUser['AppUser']['created_date'] = date('Y-m-d H:i:s');
            $this->AppUser->create();
            $this->AppUser->save($appUser);
            $id = $this->AppUser->getInsertID();
            $msg = 'User information added succcessfully';
            $userc['userCredential']['app_user_id'] = $id;
            $userc['userCredential']['created_by'] = $userid;
            $userc['userCredential']['modified_by'] = $userid;
            $userc['userCredential']['credential'] = md5(12345678);
            $userc['userCredential']['created_date'] = date('Y-m-d H:i:s');
            $userc['userCredential']['modified_date'] = date('Y-m-d H:i:s');
            $userc['userCredential']['is_active'] = 1;
            $this->userCredential->save($userc);
        } else {
            $appUser['modified_by'] = $userid;
            $appUser['modified_date'] = date('Y-m-d H:i:s');
            $this->AppUser->id = $id;
            $this->AppUser->save($appUser);
            $msg = 'User information updated succcessfully';
        }
        if ($id) {
            $this->UserPermission->deleteAll(array('app_user_id' => $id));
            foreach ($userPermission['business_line_id'] as $index => $value) {
                $business_line_id = $userPermission['business_line_id'][$index];
                $subvertical_id = $userPermission['subvertical_id'][$index];
                $permission_id = $userPermission['permission_id'][$index];
                $d = explode('/', $userPermission['activation_date'][$index]);
                $activation_date = $d[2] . '-' . $d[1] . '-' . $d[0];
                $rolePermission = array('app_user_id' => $id, 'permission_id' => $permission_id, 'business_line_id' => $business_line_id, 'subvertical_id' => $subvertical_id, 'activation_date' => $activation_date, 'is_active' => '1');
                $this->UserPermission->create();
                $this->UserPermission->save($rolePermission);
            }
        }
        $this->redirect('/user');
    }

    /*********Delete selected role of customer create***********/
    function delete_role() {
        $this->UserPermission->delete($_POST['id']);
        echo 'success';
        die;
    }
    function actions($model = null) {
        $this->loadModel($model);
        if ($_POST['id'] != '') {
            $save[$model]['id'] = $_POST['id'];
            $save[$model]['is_active'] = $_POST['type'];
            $this->$model->save($save);
        }
        echo 'success';
        die;
    }
    public function ajaxDeptRoleTmpt() {
        if ($this->Session->check('verticalList')) {
            $verticalList = $this->Session->read('verticalList');
        } else {
            $verticalList = $this->BusinessLine->find('all', array('conditions' => array('is_active' => '1')));
        }
        if ($this->Session->check('permissionList')) {
            $permissionList = $this->Session->read('permissionList');
        } else {
            $permissionList = $this->Permission->find('all', array('conditions' => array('is_active' => '1')));
        }
        $view = new View($this, false);
        $view->viewPath = 'Elements'; // Directory inside view directory to search for .ctp files
        $view->layout = false; // if you want to disable layout
        $view->set('verticalList', $verticalList); // set your variables for view here
        $view->set('permissionList', $permissionList);
        $html = $view->render('user/dept_role');
        echo $html;
        exit();
    }
    /***************Get Sub verticals For Create User *****************/
    public function ajaxGetSubVerticalList() {
        $verticalId = $this->request->data['verticalId'];
        if ($this->request->isPost()) {
            $subVerticalList = $this->Subvertical->find('all', array('recursive' => '-1', 'conditions' => array('Subvertical.business_line_id' => $verticalId, 'Subvertical.is_active' => 1)));
            $htmlData = '';
            foreach ($subVerticalList as $subVertical) {
                $subVertical = $subVertical['Subvertical'];
                $subVerticalId = $subVertical['id'];
                $subVerticalName = $subVertical['sv_name'];
                $htmlData.= '<option value="' . $subVerticalId . '">' . $subVerticalName . '</option>';
            }
            echo json_encode($htmlData);
            die;
        }
    }
    /***************Get Profit center of seleted subvertical***************/
    public function ajaxGetProfitCenterList() {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
        }
        if ($this->request->isPost()) {
            $subVerticalId = $this->request->data['subVerticalId'];
            $profitCenterList = $this->ProfitCenter->find('all', array('conditions' => array('subvertical_id' => $subVerticalId, 'is_active' => '1')));
            $htmlData = '<select class="customselect" name="data[UserPermission][profit_centers_id][]">';
            $htmlData.= '<option value="">Select</option>';
            foreach ($profitCenterList as $profitCenter) {
                $profitCenter = $profitCenter['ProfitCenter'];
                $profitCenterId = $profitCenter['id'];
                $profitCenterName = $profitCenter['pc_name'];
                $htmlData.= '<option value="' . $profitCenterId . '">' . $profitCenterName . '</option>';
            }
            $htmlData.= '</select>';
            echo $htmlData;
            exit();
        }
    }

    /*********CMS listing**********/
    function cms() {
        $this->set('title', 'CMS');
        $dmastrs = $this->DunningStepMaster->find('all', array('recursive' => '-1', 'order' => 'DunningStepMaster.credit_period asc', 'group' => 'DunningStepMaster.credit_period', 'fields' => array('DunningStepMaster.credit_period', 'DunningStepMaster.dunning_step_no', 'COUNT(DunningStepMaster.credit_period) as steps')));
        $this->set('dmastrs', $dmastrs);
    }
    /***********CMS Details of selected CMS************/
    function cms_details($credit_period = null) {
        if (empty($credit_period)) {
            $this->redirect(array('controller' => 'user', 'action' => 'cms'));
        }
        $this->set('title', 'Cms Details');
        $dmastrs = $this->DunningStepMaster->find('all', array('order' => 'DunningStepMaster.credit_period asc', 'fields' => array('DunningStepMaster.*', 'MasterDunningType.master_data_type', 'MasterDunningType.master_data_desc', 'MasterDunningMode.master_data_type', 'MasterDunningMode.master_data_desc', 'MasterDunningIntensity.master_data_type', 'MasterDunningIntensity.master_data_desc'), 'conditions' => array('DunningStepMaster.credit_period' => $credit_period), 'contain' => array('DunningMasterRecipient' => array('fields' => array('DunningMasterRecipient.*')))));
        $this->set('dmastrs', $dmastrs);
    }
    /***********Create CMS********************/
    function add_cms($credit_period = null) {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $damsterrec = $data['DunningMasterRecipient'];
            $damster['DunningStepMaster'] = $data['DunningStepMaster'];
            $damster['DunningStepMaster']['credit_period'] = $data['CreditPeriod'];
            $damster['DunningStepMaster']['created_by'] = 1;
            $damster['DunningStepMaster']['modified_by'] = 1;
            $damster['DunningStepMaster']['is_active'] = 1;
            $damster['DunningStepMaster']['system_step'] = $damster['DunningStepMaster']['dunning_step_no'];
            if ($damster['DunningStepMaster']['id'] == '') {
                $damster['DunningStepMaster']['created_date'] = date('Y-m-d H:i:s');
            }
            $damster['DunningStepMaster']['modified_date'] = date('Y-m-d H:i:s');
            $this->DunningStepMaster->save($damster);
            if ($damster['DunningStepMaster']['id'] == '') $masterid = $this->DunningStepMaster->getLastInsertId();
            else $masterid = $damster['DunningStepMaster']['id'];
            if (!empty($damsterrec['internal_rcpt'])) {
                $total = count($damsterrec['internal_rcpt']);
                for ($i = 0;$i < $total;$i++) {
                    $inc['DunningMasterRecipient']['dunning_step_id'] = $masterid;
                    $inc['DunningMasterRecipient']['recipient_role'] = $damsterrec['internal_rcpt'][$i];
                    $inc['DunningMasterRecipient']['id'] = $damsterrec['internal_rcpt_id'][$i];
                    $inc['DunningMasterRecipient']['in_cc'] = 0;
                    $inc['DunningMasterRecipient']['internal_rcpt'] = 1;
                    $inc['DunningMasterRecipient']['escalation_rcpt'] = 0;
                    $inc['DunningMasterRecipient']['created_by'] = 1;
                    $inc['DunningMasterRecipient']['modified_by'] = 1;
                    $inc['DunningMasterRecipient']['is_active'] = 1;
                    $inc['DunningMasterRecipient']['created_date'] = date('Y-m-d H:i:s');
                    $inc['DunningMasterRecipient']['modified_date'] = date('Y-m-d H:i:s');
                    $this->DunningMasterRecipient->create();
                    $this->DunningMasterRecipient->save($inc);
                }
            }
            if (!empty($damsterrec['internal_rcpt_cc'])) {
                $total = count($damsterrec['internal_rcpt_cc']);
                for ($i = 0;$i < $total;$i++) {
                    $inc1['DunningMasterRecipient']['dunning_step_id'] = $masterid;
                    $inc1['DunningMasterRecipient']['recipient_role'] = $damsterrec['internal_rcpt_cc'][$i];
                    $inc1['DunningMasterRecipient']['id'] = $damsterrec['internal_rcpt_cc_id'][$i];
                    $inc1['DunningMasterRecipient']['in_cc'] = 1;
                    $inc1['DunningMasterRecipient']['internal_rcpt'] = 1;
                    $inc1['DunningMasterRecipient']['escalation_rcpt'] = 0;
                    $inc1['DunningMasterRecipient']['created_by'] = 1;
                    $inc1['DunningMasterRecipient']['modified_by'] = 1;
                    $inc1['DunningMasterRecipient']['is_active'] = 1;
                    $inc1['DunningMasterRecipient']['created_date'] = date('Y-m-d H:i:s');
                    $inc1['DunningMasterRecipient']['modified_date'] = date('Y-m-d H:i:s');
                    $this->DunningMasterRecipient->create();
                    $this->DunningMasterRecipient->save($inc1);
                }
            }
            if (!empty($damsterrec['internal_rcpt_client'])) {
                $total = count($damsterrec['internal_rcpt_client']);
                for ($i = 0;$i < $total;$i++) {
                    $inc2['DunningMasterRecipient']['dunning_step_id'] = $masterid;
                    $inc2['DunningMasterRecipient']['recipient_role'] = $damsterrec['internal_rcpt_client'][$i];
                    $inc2['DunningMasterRecipient']['id'] = $damsterrec['internal_rcpt_client_id'][$i];
                    $inc2['DunningMasterRecipient']['in_cc'] = 0;
                    $inc2['DunningMasterRecipient']['internal_rcpt'] = 2;
                    $inc2['DunningMasterRecipient']['escalation_rcpt'] = 0;
                    $inc2['DunningMasterRecipient']['created_by'] = 1;
                    $inc2['DunningMasterRecipient']['modified_by'] = 1;
                    $inc2['DunningMasterRecipient']['is_active'] = 1;
                    $inc2['DunningMasterRecipient']['created_date'] = date('Y-m-d H:i:s');
                    $inc2['DunningMasterRecipient']['modified_date'] = date('Y-m-d H:i:s');
                    $this->DunningMasterRecipient->create();
                    $this->DunningMasterRecipient->save($inc2);
                }
            }
            if (!empty($damsterrec['internal_rcpt_client_cc'])) {
                $total = count($damsterrec['internal_rcpt_client_cc']);
                for ($i = 0;$i < $total;$i++) {
                    $inc3['DunningMasterRecipient']['dunning_step_id'] = $masterid;
                    $inc3['DunningMasterRecipient']['recipient_role'] = $damsterrec['internal_rcpt_client_cc'][$i];
                    $inc3['DunningMasterRecipient']['id'] = $damsterrec['internal_rcpt_client_cc_id'][$i];
                    $inc3['DunningMasterRecipient']['in_cc'] = 1;
                    $inc3['DunningMasterRecipient']['internal_rcpt'] = 2;
                    $inc3['DunningMasterRecipient']['escalation_rcpt'] = 0;
                    $inc3['DunningMasterRecipient']['created_by'] = 1;
                    $inc3['DunningMasterRecipient']['modified_by'] = 1;
                    $inc3['DunningMasterRecipient']['is_active'] = 1;
                    $inc3['DunningMasterRecipient']['created_date'] = date('Y-m-d H:i:s');
                    $inc3['DunningMasterRecipient']['modified_date'] = date('Y-m-d H:i:s');
                    $this->DunningMasterRecipient->create();
                    $this->DunningMasterRecipient->save($inc3);
                }
            }
            if (!empty($damsterrec['internal_esclation'])) {
                $total = count($damsterrec['internal_esclation']);
                for ($i = 0;$i < $total;$i++) {
                    $inc4['DunningMasterRecipient']['dunning_step_id'] = $masterid;
                    $inc4['DunningMasterRecipient']['recipient_role'] = $damsterrec['internal_esclation'][$i];
                    $inc4['DunningMasterRecipient']['id'] = $damsterrec['internal_esclation_id'][$i];
                    $inc4['DunningMasterRecipient']['in_cc'] = 0;
                    $inc4['DunningMasterRecipient']['internal_rcpt'] = 0;
                    $inc4['DunningMasterRecipient']['escalation_rcpt'] = 1;
                    $inc4['DunningMasterRecipient']['created_by'] = 1;
                    $inc4['DunningMasterRecipient']['modified_by'] = 1;
                    $inc4['DunningMasterRecipient']['is_active'] = 1;
                    $inc4['DunningMasterRecipient']['created_date'] = date('Y-m-d H:i:s');
                    $inc4['DunningMasterRecipient']['modified_date'] = date('Y-m-d H:i:s');
                    $this->DunningMasterRecipient->create();
                    $this->DunningMasterRecipient->save($inc4);
                }
            }
            if (!empty($damsterrec['internal_esclation_cc'])) {
                $total = count($damsterrec['internal_esclation_cc']);
                for ($i = 0;$i < $total;$i++) {
                    $inc5['DunningMasterRecipient']['dunning_step_id'] = $masterid;
                    $inc5['DunningMasterRecipient']['recipient_role'] = $damsterrec['internal_esclation_cc'][$i];
                    $inc5['DunningMasterRecipient']['id'] = $damsterrec['internal_esclation_cc_id'][$i];
                    $inc5['DunningMasterRecipient']['in_cc'] = 1;
                    $inc5['DunningMasterRecipient']['internal_rcpt'] = 0;
                    $inc5['DunningMasterRecipient']['escalation_rcpt'] = 1;
                    $inc5['DunningMasterRecipient']['created_by'] = 1;
                    $inc5['DunningMasterRecipient']['modified_by'] = 1;
                    $inc5['DunningMasterRecipient']['is_active'] = 1;
                    $inc5['DunningMasterRecipient']['created_date'] = date('Y-m-d H:i:s');
                    $inc5['DunningMasterRecipient']['modified_date'] = date('Y-m-d H:i:s');
                    $this->DunningMasterRecipient->create();
                    $this->DunningMasterRecipient->save($inc5);
                }
            }
            if (!empty($damsterrec['internal_esclation_client'])) {
                $total = count($damsterrec['internal_esclation_client']);
                for ($i = 0;$i < $total;$i++) {
                    $inc6['DunningMasterRecipient']['dunning_step_id'] = $masterid;
                    $inc6['DunningMasterRecipient']['recipient_role'] = $damsterrec['internal_esclation_client'][$i];
                    $inc6['DunningMasterRecipient']['id'] = $damsterrec['internal_esclation_client_id'][$i];
                    $inc6['DunningMasterRecipient']['in_cc'] = 0;
                    $inc6['DunningMasterRecipient']['internal_rcpt'] = 0;
                    $inc6['DunningMasterRecipient']['escalation_rcpt'] = 2;
                    $inc6['DunningMasterRecipient']['created_by'] = 1;
                    $inc6['DunningMasterRecipient']['modified_by'] = 1;
                    $inc6['DunningMasterRecipient']['is_active'] = 1;
                    $inc6['DunningMasterRecipient']['created_date'] = date('Y-m-d H:i:s');
                    $inc6['DunningMasterRecipient']['modified_date'] = date('Y-m-d H:i:s');
                    $this->DunningMasterRecipient->create();
                    $this->DunningMasterRecipient->save($inc6);
                }
            }
            if (!empty($damsterrec['internal_esclation_client_cc'])) {
                $total = count($damsterrec['internal_esclation_client_cc']);
                for ($i = 0;$i < $total;$i++) {
                    $inc7['DunningMasterRecipient']['dunning_step_id'] = $masterid;
                    $inc7['DunningMasterRecipient']['recipient_role'] = $damsterrec['internal_esclation_client_cc'][$i];
                    $inc7['DunningMasterRecipient']['id'] = $damsterrec['internal_esclation_client_cc_id'][$i];
                    $inc7['DunningMasterRecipient']['in_cc'] = 1;
                    $inc7['DunningMasterRecipient']['internal_rcpt'] = 0;
                    $inc7['DunningMasterRecipient']['escalation_rcpt'] = 2;
                    $inc7['DunningMasterRecipient']['created_by'] = 1;
                    $inc7['DunningMasterRecipient']['modified_by'] = 1;
                    $inc7['DunningMasterRecipient']['is_active'] = 1;
                    $inc7['DunningMasterRecipient']['created_date'] = date('Y-m-d H:i:s');
                    $inc7['DunningMasterRecipient']['modified_date'] = date('Y-m-d H:i:s');
                    $this->DunningMasterRecipient->create();
                    $this->DunningMasterRecipient->save($inc7);
                }
            }
            echo 'success';
            die;
        }
        if (!empty($credit_period)) {
            $dmastrs = $this->DunningStepMaster->find('all', array('order' => 'DunningStepMaster.credit_period asc', 'fields' => array('DunningStepMaster.*', 'MasterDunningType.master_data_type', 'MasterDunningType.master_data_desc', 'MasterDunningMode.master_data_type', 'MasterDunningMode.master_data_desc', 'MasterDunningIntensity.master_data_type', 'MasterDunningIntensity.master_data_desc'), 'conditions' => array('DunningStepMaster.credit_period' => $credit_period), 'contain' => array('DunningMasterRecipient' => array('fields' => array('DunningMasterRecipient.*')))));
        }
        $this->set('title', 'Cms Details');
        $this->set('dmastrs', @$dmastrs);
        
        $dType = $this->MasterDataDetail->find('list', array('order' => 'MasterDataDetail.master_data_desc asc', 'fields' => array('MasterDataDetail.master_data_desc'), 'conditions' => array('MasterDataDetail.master_data_desc NOT' => '', 'MasterDataDetail.master_data_type' => 'dunning_type')));
        $this->set('dType', $dType);
        $dMode = $this->MasterDataDetail->find('list', array('order' => 'MasterDataDetail.master_data_desc asc', 'fields' => array('MasterDataDetail.master_data_desc'), 'conditions' => array('MasterDataDetail.master_data_desc NOT' => '', 'MasterDataDetail.master_data_type' => 'dunning_mode')));
        $this->set('dMode', $dMode);
        $intMode = $this->MasterDataDetail->find('list', array('order' => 'MasterDataDetail.master_data_desc asc', 'fields' => array('MasterDataDetail.master_data_desc'), 'conditions' => array('MasterDataDetail.master_data_desc NOT' => '', 'MasterDataDetail.master_data_type' => 'dunning_intensity')));
        $this->set('intMode', $intMode);
        $roles = $this->MasterDataDetail->find('list', array('order' => 'MasterDataDetail.master_data_desc asc', 'group' => 'MasterDataDetail.master_data_desc', 'fields' => array('MasterDataDetail.master_data_desc'), 'conditions' => array('MasterDataDetail.master_data_desc NOT' => '', 'MasterDataDetail.master_data_type' => 'contact(contact_role)')));
        $this->set('roles', $roles);
        $introles = $this->AppUser->find('all', array('order' => 'AppUser.first_name asc', 'group' => 'AppUser.user_email', 'fields' => array('AppUser.id', 'AppUser.first_name', 'AppUser.last_name'), 'conditions' => array('AppUser.user_type NOT' => 1, 'AppUser.first_name NOT' => '', 'AppUser.is_active' => 1)));
        $this->set('introles', $introles);
        
    }
    /************delete dunning step master*************/
    function delete_dunning_step_master() {
        $count = $this->InvoiceDunning->find('count', array('conditions' => array('InvoiceDunning.dunning_step_id' => $_POST['id'])));
        if ($count == 0) {
            $dmastrf = $this->DunningStepMaster->find('first', array('fields' => array('DunningStepMaster.id', 'DunningStepMaster.dunning_step_no'), 'conditions' => array('DunningStepMaster.id' => $_POST['id'])));
            $this->DunningMasterRecipient->deleteAll(array("DunningMasterRecipient.dunning_step_id" => $_POST['id']));
            $this->DunningStepMaster->delete($_POST['id']);
            $dmastrs = $this->DunningStepMaster->find('all', array('fields' => array('DunningStepMaster.id', 'DunningStepMaster.dunning_step_no'), 'conditions' => array('DunningStepMaster.credit_period' => $_POST['period'], 'DunningStepMaster.dunning_step_no >' => $dmastrf['DunningStepMaster']['dunning_step_no'])));
            foreach ($dmastrs as $dm) {
                $da['DunningStepMaster']['system_step'] = $dm['DunningStepMaster']['dunning_step_no'] - 1;
                $da['DunningStepMaster']['dunning_step_no'] = $dm['DunningStepMaster']['dunning_step_no'] - 1;
                $da['DunningStepMaster']['id'] = $dm['DunningStepMaster']['id'];
                $da['DunningStepMaster']['modified_date'] = date('Y-m-d H:i:s');
                $this->DunningStepMaster->save($da);
            }
            echo 'success';
            die;
        } else {
            echo 'error';
            die;
        }
    }
    /**********delete dunning step master recepent in create cms**************/
    function delete_dunning_step_master_recpnt() {
        $count = $this->InvoiceDunningRecipient->find('count', array('conditions' => array('InvoiceDunningRecipient.recipient_id' => $_POST['id'])));
        if ($count == 0) {
            $this->DunningMasterRecipient->delete($_POST['id']);
            echo 'success';
            die;
        } else {
            echo 'error';
            die;
        }
    }
    /***********Profit Center Listing************/
    public function profit_center() {
        $this->layout = 'admin_layout';
        $this->loadModel('ProfitCenter');
        
        $this->loadModel('BusinessLine');
        
        $this->paginate = array('limit' => 20, 'order' => 'ProfitCenter.id asc', 'joins' => array(array('table' => 'subverticals', 'alias' => 'Subvertical', 'type' => 'INNER', 'conditions' => array('Subvertical.id = ProfitCenter.subvertical_id')), array('table' => 'business_lines', 'alias' => 'BusinessLine', 'type' => 'INNER', 'conditions' => array('BusinessLine.id = Subvertical.business_line_id')),), 'fields' => array('ProfitCenter.*', 'Subvertical.*', 'BusinessLine.*'));
        $profit_center_data = $this->paginate('ProfitCenter');
        $vartical_data = $this->BusinessLine->find('all', array('group' => 'BusinessLine.bl_name', 'field' => array('BusinessLine.*'), 'conditions' => array('BusinessLine.is_active' => '1')));
        
        $this->set('profit_center_data', $profit_center_data);
        $this->set('vartical_data', $vartical_data);
    }

    /**********Contact role Listing in Masters****************/
    public function contact_role() {
        $this->layout = 'admin_layout';
        $this->loadModel('MasterDataDetail');
        $this->paginate = array('limit' => 20, 'field' => array('MasterDataDetail.*'), 'conditions' => array('MasterDataDetail.master_data_type' => 'contact(contact_role)'));
        $contact_role = $this->paginate('MasterDataDetail');
        $this->set('contact_role', $contact_role);
    }
    /*************user role Listing***************/
    public function user_role() {
        $this->layout = 'admin_layout';
        $this->loadModel('Permission');
        $this->paginate = array('limit' => 20, 'field' => array('Permission.*'), 'conditions' => array('Permission.is_role' => '1'));
        $user_role = $this->paginate('Permission');
        $this->set('user_role', $user_role);
    }
/*********Address Type Listing In Masters***************/
    public function address_type() {
        $this->layout = 'admin_layout';
        $this->loadModel('MasterDataDetail');
        $this->paginate = array('limit' => 20, 'field' => array('MasterDataDetail.*'), 'conditions' => array('MasterDataDetail.master_data_type' => 'Address Type'));
        $address_type = $this->paginate('MasterDataDetail');
        $this->set('address_type', $address_type);
    }

    /*********Contract type Listing In Masters***************/
    public function contract_type() {
        $this->layout = 'admin_layout';
        $this->loadModel('MasterDataDetail');
        $this->paginate = array('limit' => 20, 'field' => array('MasterDataDetail.*'), 'conditions' => array('MasterDataDetail.master_data_type' => 'contract_type'));
        $contract_type = $this->paginate('MasterDataDetail');
        $this->set('contract_type', $contract_type);
    }
    /*************Edit user role***************/
    public function edit_user_role() {
        $this->loadModel('Permission');
        $data = $this->request->data;
        $user_role['Permission']['permission_desc'] = $data['role'];
        $document_type['Permission']['modified_date'] = date('Y-m-d');
        $this->Permission->id = $data['role_id'];
        $this->Permission->save($user_role);
        echo "success";
        die();
    }
    /***********Edit Contact role in Masters***********/ 
    public function edit_contact_role() {
        $this->loadModel('MasterDataDetail');
        $data = $this->request->data;
        $contact_role['MasterDataDetail']['master_data_desc'] = $data['contact_role'];
        $document_type['MasterDataDetail']['modified_date'] = date('Y-m-d');
        $this->MasterDataDetail->id = $data['role_id'];
        $this->MasterDataDetail->save($contact_role);
        echo "success";
        die();
    }

    /*********Edit Ar category in masters*************/
    public function edit_ar_category() {
        $this->loadModel('ArCategory');
        $data = $this->request->data;
        $ar_cat['ArCategory']['ar_cat'] = $data['ar_category'];
        $ar_cat['ArCategory']['modified_date'] = date('Y-m-d');
        $this->ArCategory->id = $data['ar_id'];
        $this->ArCategory->save($ar_cat);
        echo "success";
        die();
    }
    
    /*********Create Ar Category of masters********/
    public function create_ar_category() {
        $this->loadModel('ArCategory');
        $data = $this->request->data;
        $ar_cat_create['ArCategory']['ar_cat'] = $data['ar_category'];
        $ar_cat_create['ArCategory']['created_date'] = date('Y-m-d');
        $ar_cat_create['ArCategory']['is_active'] = 1;
        $this->ArCategory->save($ar_cat_create);
        echo "success";
        die();
    }
   
    /*********Edit Address Type in Masters***********/
    public function edit_address_type() {
        $this->loadModel('MasterDataDetail');
        $data = $this->request->data;
        $address_type['MasterDataDetail']['master_data_desc'] = $data['address_type'];
        $document_type['MasterDataDetail']['modified_date'] = date('Y-m-d');
        $this->MasterDataDetail->id = $data['type_id'];
        $this->MasterDataDetail->save($address_type);
        echo "success";
        die();
    }
    /*********Edit Contract Type  in Masters*************/
    public function edit_contract_type() {
        $this->loadModel('MasterDataDetail');
        $data = $this->request->data;
        $contract_type['MasterDataDetail']['master_data_desc'] = $data['contract_type'];
        $document_type['MasterDataDetail']['modified_date'] = date('Y-m-d');
        $this->MasterDataDetail->id = $data['type_id'];
        $this->MasterDataDetail->save($contract_type);
        echo "success";
        die();
    }
    /**********Dunning************/
    public function dunning_type() {
        $this->layout = 'admin_layout';
        $this->loadModel('MasterDataDetail');
        $this->paginate = array('limit' => 20, 'field' => array('MasterDataDetail.*'), 'conditions' => array('MasterDataDetail.master_data_type' => 'dunning_type'));
        $dunning_type = $this->paginate('MasterDataDetail');
        $this->set('dunning_type', $dunning_type);
    }
     /***********Edit Dunning Type  in Masters**********/
    public function edit_dunning_type() {
        $this->loadModel('MasterDataDetail');
        $data = $this->request->data;
        $contract_type['MasterDataDetail']['master_data_desc'] = $data['dunning_type'];
        $document_type['MasterDataDetail']['modified_date'] = date('Y-m-d');
        $this->MasterDataDetail->id = $data['type_id'];
        $this->MasterDataDetail->save($contract_type);
        echo "success";
        die();
    }

    /************Dunning Mode Listing******************/
    public function dunning_mode() {
        $this->layout = 'admin_layout';
        $this->loadModel('MasterDataDetail');
        $this->paginate = array('limit' => 20, 'field' => array('MasterDataDetail.*'), 'conditions' => array('MasterDataDetail.master_data_type' => 'dunning_mode'));
        $dunning_mode = $this->paginate('MasterDataDetail');
        $this->set('dunning_mode', $dunning_mode);
    }
    /**********Edit Dunning Mode***********/
    public function edit_dunning_mode() {
        $this->loadModel('MasterDataDetail');
        $data = $this->request->data;
        $dunning_mode['MasterDataDetail']['master_data_desc'] = $data['dunning_mode'];
        $document_type['MasterDataDetail']['modified_date'] = date('Y-m-d');
        $this->MasterDataDetail->id = $data['type_id'];
        $this->MasterDataDetail->save($dunning_mode);
        echo "success";
        die();
    }
    /*********Dunning intensity Listing  In Masters***********/
    public function dunning_intensity() {
        $this->layout = 'admin_layout';
        $this->loadModel('MasterDataDetail');
        $this->paginate = array('limit' => 20, 'field' => array('MasterDataDetail.*'), 'conditions' => array('MasterDataDetail.master_data_type' => 'dunning_intensity'));
        $dunning_intensity = $this->paginate('MasterDataDetail');
        $this->set('dunning_intensity', $dunning_intensity);
    }
    /*********Edit Dunning Intensity In Masters*************/
    public function edit_dunning_intensity() {
        $this->loadModel('MasterDataDetail');
        $data = $this->request->data;
        $dunning_intensity['MasterDataDetail']['master_data_desc'] = $data['dunning_intensity'];
        $document_type['MasterDataDetail']['modified_date'] = date('Y-m-d');
        $this->MasterDataDetail->id = $data['type_id'];
        $this->MasterDataDetail->save($dunning_intensity);
        echo "success";
        die();
    }
    /***********Document Type Listing In Masters****************/
    public function document_type() {
        $this->layout = 'admin_layout';
        $this->loadModel('DocumentMaster');
        $this->paginate = array('limit' => 20, 'field' => array('DocumentMaster.*'));
        $document_type = $this->paginate('DocumentMaster');
        $this->set('document_type', $document_type);
    }
    /**********Edit Document Type In Masters*****************/
    public function edit_document_type() {
        $this->loadModel('DocumentMaster');
        $data = $this->request->data;
        $document_type['DocumentMaster']['desc'] = $data['document_type'];
        $document_type['DocumentMaster']['modiefied_date'] = date('Y-m-d');
        $this->DocumentMaster->id = $data['type_id'];
        $this->DocumentMaster->save($document_type);
        echo "success";
        die();
    }
    /***********Create Document Type In Masters**************/
    public function create_document_type() {
        $this->loadModel('DocumentMaster');
        $data = $this->request->data;
        $documents_type['DocumentMaster']['doc'] = $data['doc'];
        $documents_type['DocumentMaster']['desc'] = $data['desc'];
        $documents_type['DocumentMaster']['created_date'] = date('Y-m-d');
        $this->DocumentMaster->save($documents_type);
        echo "success";
        die();
    }
    /*************Invoice stages Listing in Masters************/
    public function invoice_stages() {
        $this->layout = 'admin_layout';
        $this->loadModel('InvoiceStage');
        $this->paginate = array('limit' => 20, 'order' => 'InvoiceStage.id asc', 'fields' => array('InvoiceStage.*'));
        $invoice_stages = $this->paginate('InvoiceStage');
        $this->set('invoice_stages', $invoice_stages);
    }
    /***********Edit Invoices Stages In Masters**************/
    public function edit_invoices_stages() {
        $this->loadModel('InvoiceStage');
        $data = $this->request->data;
        $invoices_stages['InvoiceStage']['stage_desc'] = $data['invoices_stages'];
        $invoices_stages['InvoiceStage']['modified_date'] = date('Y-m-d');
        $this->InvoiceStage->id = $data['type_id'];
        $this->InvoiceStage->save($invoices_stages);
        echo "success";
        die();
    }

    /**********Master Permission Role Listing************/
    public function permission_role() {
        $this->layout = 'admin_layout';
        $this->loadModel('Permission');
      
        $this->paginate = array('limit' => 20, 'fields' => array('Permission.*'));
        $permission_role = $this->paginate('Permission');
        
        $this->set('permission_role', $permission_role);
    }
    /**********Edit Permission role in masters************/
    public function edit_permission_role() {
        $this->loadModel('Permission');
        $data = $this->request->data;
        $permission_role['Permission']['permission_desc'] = $data['permission_role'];
        $permission_role['Permission']['modified_date'] = date('Y-m-d');
        $this->Permission->id = $data['role_id'];
        $this->Permission->save($permission_role);
        echo "success";
        die();
    }
    /************Pricing Type Listing in masters**************/
    public function pricing_type() {
        $this->layout = 'admin_layout';
        $this->loadModel('MasterDataDetail');
        $this->paginate = array('limit' => 20, 'field' => array('MasterDataDetail.*'), 'conditions' => array('MasterDataDetail.master_data_type' => 'Pricing Type'));
        $pricing_type = $this->paginate('MasterDataDetail');
        $this->set('pricing_type', $pricing_type);
    }
    /************Edit Pricing Type Listing in masters**************/
    public function edit_pricing_type() {
        $this->loadModel('MasterDataDetail');
        $data = $this->request->data;
        $permission_role['MasterDataDetail']['master_data_desc'] = $data['pricing_type'];
        $permission_role['MasterDataDetail']['modified_date'] = date('Y-m-d');
        $this->MasterDataDetail->id = $data['type_id'];
        $this->MasterDataDetail->save($permission_role);
        echo "success";
        die();
    }

    /***Comman function of Create Contact Role,Address type,Pricing type,Contract Type,Dunning Type,Dunning Mode,Dunning Intensity In Masters********/
    public function master() {
        $this->loadModel('MasterDataDetail');
        $data = $this->request->data;
        $master['MasterDataDetail']['master_data_type'] = $data['master_data_type'];
        $master['MasterDataDetail']['master_data_desc'] = $data['master_data_desc'];
        $master['MasterDataDetail']['created_date'] = date('Y-m-d');
        $this->MasterDataDetail->save($master);
        echo "success";
        die();
    }
    /*********Craete user role in Masters*****************/
    public function user_role_create() {
        $this->loadModel('Permission');
        $data = $this->request->data;
        $Permis['Permission']['permission_desc'] = $data['permission_desc'];
        $Permis['Permission']['is_role'] = '1';
        $Permis['MasterDataDetail']['created_date'] = date('Y-m-d');
        $this->Permission->save($Permis);
        echo "success";
        die();
    }
    /***********Create Permission Role In masters******************/
    public function create_permission_role() {
        $this->loadModel('Permission');
        $data = $this->request->data;
        $permission['Permission']['permission_desc'] = $data['permission_desc'];
        $permission['Permission']['created_date'] = date('Y-m-d');
        $this->Permission->save($permission);
        echo "success";
        die();
    }
    /*********Create Invoice Stage In Masters**********/
    public function create_invoice_stage() {
        $this->loadModel('InvoiceStage');
        $data = $this->request->data;
        $invoice_stage['InvoiceStage']['stage_desc'] = $data['stage_desc'];
        $invoice_stage['InvoiceStage']['created_date'] = date('Y-m-d');
        $this->InvoiceStage->save($invoice_stage);
        echo "success";
        die();
    }
    /*********Logo Create In Setting**************/
    public function setting() {
        $this->layout = 'admin_layout';
        $this->loadModel('Companie');
        if ($this->request->is('post')) {
            if (!empty($this->request->data['fileName']['name'])) {
                $picname = explode('.', $this->data['fileName']['name']);
                $picname = $picname['0'] . date('Ymdhis', strtotime(date('h:i:s'))) . '.' . $picname['1'];
                $path = WWW_ROOT . 'upload_company_logo/';
                move_uploaded_file($this->data['fileName']['tmp_name'], $path . $picname);
                $this->request->data['Companie']['company_logo'] = $picname;
                $this->request->data['Companie']['id'] = 1;
            }
            if ($this->Companie->save($this->data)) {
                $this->Session->setFlash(__('Logo Changed successfully'));
                $this->redirect(array('controller' => 'user', 'action' => 'setting'));
            } else {
                $this->Session->setFlash(__('Please tyr again after some time'));
                $this->redirect(array('controller' => 'user', 'action' => 'setting'));
            }
        }
    }
    /*********get sub vartical For seleted vartical in  masters**********/
    public function find_sub_varticle() {
        $this->loadModel('subverticals');
        $data = $this->request->data;
        $sub_verticle = $this->subverticals->find('all', array('group' => 'subverticals.sv_name', 'fields' => array('subverticals.sv_name', 'subverticals.id'), 'conditions' => array('subverticals.business_line_id' => $data['select_varticle_id'])));
        $option = '';
        foreach ($sub_verticle as $k => $sub_verticles) {
            $option.= '<option value="' . $sub_verticles['subverticals']['id'] . '">' . $sub_verticles['subverticals']['sv_name'] . '</option>';
        }
        $msg['option'] = $option;
        echo json_encode($msg);
        die;
    }
    /**********Edit profit center of master*************/
    public function edit_profit_center() {
        $this->loadModel('ProfitCenter');
        $this->loadModel('Subvertical');
        $this->loadModel('BusinessLine');
        $data = $this->request->data;
        $profit_center['ProfitCenter']['pc_name'] = $data['pc_name_value'];
        $profit_center['ProfitCenter']['subvertical_id'] = $data['sub_vartical_value'];
        $profit_center['ProfitCenter']['modified_date'] = date('Y-m-d');
        $this->ProfitCenter->id = $data['profit_center_id'];
        $this->ProfitCenter->save($profit_center);
        $sub_verticle = $this->Subvertical->find('all', array('fields' => array('Subvertical.business_line_id', 'Subvertical.sv_name'), 'conditions' => array('Subvertical.id' => $data['sub_vartical_value'])));
        $verticle = $this->BusinessLine->find('all', array('fields' => array('BusinessLine.bl_name'), 'conditions' => array('BusinessLine.id' => $sub_verticle[0]['Subvertical']['business_line_id'])));
        $msg = array_merge($sub_verticle, $verticle);
        echo json_encode($msg);
        die;
    }
    /**********Create profit center of master*************/
    public function create_profit_center() {
        $this->loadModel('ProfitCenter');
        $this->loadModel('Subvertical');
        $this->loadModel('BusinessLine');
        $data = $this->request->data;
        $cre_profit_center['ProfitCenter']['pc_name'] = $data['profit_center_name'];
        $cre_profit_center['ProfitCenter']['subvertical_id'] = $data['sel_sub_vertical'];
        $cre_profit_center['ProfitCenter']['created_date'] = date('Y-m-d');
        $cre_profit_center['ProfitCenter']['is_active'] = 1;;
        $this->ProfitCenter->create();
        $this->ProfitCenter->save($cre_profit_center);
        $sub_verticle = $this->Subvertical->find('all', array('fields' => array('Subvertical.business_line_id', 'Subvertical.sv_name'), 'conditions' => array('Subvertical.id' => $data['sel_sub_vertical'])));
        $verticle = $this->BusinessLine->find('all', array('fields' => array('BusinessLine.bl_name'), 'conditions' => array('BusinessLine.id' => $sub_verticle[0]['Subvertical']['business_line_id'])));
        $msg = array_merge($sub_verticle, $verticle);
        echo json_encode($msg);
        die;
    }

    /**************Create project Services In Masters*************/
    public function create_svc_catalogues() {
        $this->loadModel('SvcCatalogue');
        $this->loadModel('Subvertical');
        $this->loadModel('BusinessLine');
        $sesn = $this->Session->read('user');
        $data = $this->request->data;
        if ($this->request->is('ajax')) {
            if (!empty($data)) {
                $pro_serv['SvcCatalogue']['svc_desc'] = $data['service_name'];
                $pro_serv['SvcCatalogue']['business_line'] = $data['select_varticle'];
                $pro_serv['SvcCatalogue']['subvertical'] = $data['sel_sub_vertical'];
                $pro_serv['SvcCatalogue']['created_date'] = date('Y-m-d');
                $pro_serv['SvcCatalogue']['is_active'] = 1;
                if (isset($data['services_id']) && $data['services_id'] != '') {
                    $pro_serv['SvcCatalogue']['id'] = $data['services_id'];
                }
                $this->SvcCatalogue->save($pro_serv);
                $sub_verticle = $this->Subvertical->find('first', array('fields' => array('Subvertical.business_line_id', 'Subvertical.sv_name'), 'conditions' => array('Subvertical.id' => $data['sel_sub_vertical'])));
                $verticle = $this->BusinessLine->find('first', array('fields' => array('BusinessLine.bl_name'), 'conditions' => array('BusinessLine.id' => $data['select_varticle'])));
                $msg = array_merge($sub_verticle, $verticle);
                echo json_encode($msg);
                die;
                echo "success";
                die;
            }
        } else {
            echo "error";
            die;
        }
    }
    /************Edit Sub Category in masters**************/
    function edit_sub_category() {
        $this->loadModel('ArSubCategory');
        $data = $this->request->data;
        $EditSub['ArSubCategory']['id'] = $data['subCat_id'];
        $EditSub['ArSubCategory']['ar_sub_cat'] = $data['subCatTitle'];
        $EditSub['ArSubCategory']['ar_cat_id'] = $data['ar_cat_id'];
        $this->ArSubCategory->save($EditSub);
        echo "success";
        die();
               
    }
    /************Add Sub Category in masters**************/
    function add_SubCategory() {
        $this->loadModel('ArSubCategory');
        $this->loadModel('ArCategory');
        $data = $this->request->data;
        $subCatName = $data['subCategory'];
        $catId = $data['arCategory'];
        $saveSubCat['ArSubCategory']['ar_cat_id'] = $catId;
        $saveSubCat['ArSubCategory']['ar_sub_cat'] = $subCatName;
        $saveSubCat['ArSubCategory']['is_active'] = 1;
        $saveSubCat['ArSubCategory']['created_date'] = date('Y-m-d');
        $this->ArSubCategory->save($saveSubCat);
        $msg['msg'] = 'success';
        echo json_encode($msg);
        die;
    }

    /***********Ar Sub category in master**********/
    function ar_sub_category() {
        $this->layout = 'admin_layout';
        $this->loadModel('ArCategory');
        $this->loadModel('ArSubCategory');
        $this->paginate = array('limit' => 50, 'order' => 'ArSubCategory.id DESC', 'joins' => array(array('table' => 'ar_categories', 'alias' => 'ArCategory', 'type' => 'LEFT', 'conditions' => array('ArCategory.id = ArSubCategory.ar_cat_id')),), 'fields' => array('ArCategory.*', 'ArSubCategory.*'));
        $ar_sub_category_data = $this->paginate('ArSubCategory');
        $ar_category_data = $this->ArCategory->find('all', array('fields' => array('ArCategory.*')));
        $category_list = $this->ArCategory->find('list', array('fields' => array('ArCategory.id', 'ArCategory.ar_cat')));
        $this->set('ar_sub_category_data', $ar_sub_category_data);
        $this->set('ar_category_data', $ar_category_data);
        $this->set('category_list', $category_list);
    }

    /***********Master Ar category listing**************/
    function ar_category() {
        $this->layout = 'admin_layout';
        $this->loadModel('ArCategory');
        $this->paginate = array('limit' => 20, 'fields' => array('ArCategory.*'));
        $ar_category_data = $this->paginate('ArCategory');
        $this->set('ar_category_data', $ar_category_data);
    }
    /***********group Listing In Masters************/
    public function group() {
        $this->layout = 'admin_layout';
        $this->loadModel('Group');
        $this->paginate = array('limit' => 20, 'fields' => array('Group.*'));
        $getGroup = $this->paginate('Group');
        $this->set('group', $getGroup);
    }
    /*************Add group in Masters**************/
    function add_group() {
        $this->loadModel('Group');
        $data = $this->request->data;
        $group_name = $data['group_name'];
        $saveGp['Group']['group_name'] = $group_name;
        $saveGp['Group']['created_date'] = date('Y-m-d');
        $saveGp['Group']['modified_date'] = date('Y-m-d');
        $this->Group->save($saveGp);
        $msg['msg'] = 'success';
        echo json_encode($msg);
        die;
    }
    /*************Edit group in Masters**************/
    public function edit_group() {
        $this->loadModel('Group');
        $data = $this->request->data;
        $EditGp['Group']['id'] = $data['gp_id'];
        $EditGp['Group']['group_name'] = $data['group_name'];
        $EditGp['Group']['modified_date'] = date('Y-m-d');
        $this->Group->save($EditGp);
        echo "success";
        die();
        
    }
    /*********TaT Matrix  Listing in Masters*********/
    public function tat_matrix() {
        $this->layout = 'admin_layout';
        $this->loadModel('TatMatrice');
        $this->paginate = array('limit' => 20, 'fields' => array('TatMatrice.*'));
        $getMatric = $this->paginate('TatMatrice');
        $this->set('tat_matrix', $getMatric);
    }
    /************Edit tat Matrix in Masters***************/
    public function edit_matrix() {
        $this->loadModel('TatMatrice');
        $data = $this->request->data;
        $EditMat['TatMatrice']['id'] = $data['mat_id'];
        $EditMat['TatMatrice']['approval_day'] = $data['appDay'];
        $EditMat['TatMatrice']['reminder_day'] = $data['remDay'];
        $EditMat['TatMatrice']['escalation_day'] = $data['escDay'];
        $this->TatMatrice->save($EditMat);
        echo "success";
        die();  
    }
    /***********Project servicse Listing in Masters****************/
    function project_service() {
        $this->layout = 'admin_layout';
        $this->loadModel('ProfitCenter');
        $this->loadModel('Subvertical');
        $this->loadModel('BusinessLine');
        $this->loadModel('SvcCatalogue');
        
        $this->paginate = array('limit' => 20, 'order' => 'SvcCatalogue.id asc', 'joins' => array(array('table' => 'subverticals', 'alias' => 'Subvertical', 'type' => 'INNER', 'conditions' => array('Subvertical.id = SvcCatalogue.subvertical')), array('table' => 'business_lines', 'alias' => 'BusinessLine', 'type' => 'INNER', 'conditions' => array('BusinessLine.id = Subvertical.business_line_id'))), 'fields' => array('SvcCatalogue.*', 'BusinessLine.*', 'Subvertical.*'));
       
        $servies = $this->paginate('SvcCatalogue');
        $vartical_data = $this->BusinessLine->find('all', array('recursive' => '-1', 'group' => 'BusinessLine.bl_name', 'field' => array('BusinessLine.*'), 'conditions' => array('BusinessLine.is_active' => '1')));
        
        $this->set('servies', $servies);
        $this->set('vartical_data', $vartical_data);
    }

    /*********vertical listing In Masters************/
    function vertical() {
        $this->layout = 'admin_layout';
        $this->loadModel('BusinessLine');
        $this->loadModel('Entity');
        $this->paginate = array('limit' => 20, 'group' => 'BusinessLine.bl_name', 'order' => 'BusinessLine.id desc', 'fields' => array('BusinessLine.*', 'Entity.entitiy_name'));
        $vertical = $this->paginate('BusinessLine');
        $entity = $this->Entity->find('list', array('fields' => array('Entity.entitiy_name')));
        $this->set('entity', $entity);
        $this->set('verticals', $vertical);
        $this->set('title', 'Vertical List');
    }
    /*************Sub verticle Listing in masters******************/
    function subvertical() {
        $this->layout = 'admin_layout';
        $this->loadModel('Subvertical');
        $this->loadModel('BusinessLine');
        $this->paginate = array('limit' => 20, 'order' => 'Subvertical.id desc', 'fields' => array('Subvertical.*', 'BusinessLine.bl_name'));
        $svertical = $this->paginate('Subvertical');
        $getVertical = $this->BusinessLine->find('list', array('fields' => array('BusinessLine.id', 'BusinessLine.bl_name')));
        $this->set('sverticals', $svertical);
        $this->set('verticalsList', $getVertical);
        $this->set('title', 'SubVertical List');
    }
    /*********Add SubVertical in  masters**********/
    function add_SubVertical() {
        $this->loadModel('Subvertical');
        $this->loadModel('BusinessLine');
        $data = $this->request->data;
        $svName = $data['sv_name'];
        $svName = strtoupper($svName);
        $bl_id = $data['vertical_id'];
        $saveSubV['Subvertical']['business_line_id'] = $bl_id;
        $saveSubV['Subvertical']['sv_name'] = $svName;
        $saveSubV['Subvertical']['is_active'] = 1;
        $saveSubV['Subvertical']['created_date'] = date('Y-m-d');
        $this->Subvertical->save($saveSubV);
        $msg['msg'] = 'success';
        echo json_encode($msg);
        die;
    }

    /***************Add Verticle in masters***************/
    function add_vertical() {
        $this->loadModel('BusinessLine');
        $data = $this->request->data;
        $blName = $data['vertical'];
        $blName = strtoupper($blName);
        $getBline = $this->BusinessLine->find('first', array('recursive' => '-1', 'conditions' => array('BusinessLine.bl_name' => $blName)));
        if (!empty($getBline)) {
            $msg['msg'] = 'vertical already exist';
            $msg['status'] = 0;
        } else {
            $create_bline['BusinessLine']['bl_name'] = $blName;
            $create_bline['BusinessLine']['is_active'] = 1;
            $create_bline['BusinessLine']['created_date'] = date('Y-m-d');
            $this->BusinessLine->save($create_bline);
            $msg['msg'] = 'success';
            $msg['status'] = 1;
        }
        $msg['res'] = $msg;
        echo json_encode($msg);
        die;
    }
    /*********Edit veticle************/
    function edit_vertical() {
        $this->loadModel('BusinessLine');
        $data = $this->request->data;
        $blName = $data['blname'];
        $blName = strtoupper($blName);
        $bl_id = $data['bline_id'];
        $getBline = $this->BusinessLine->find('first', array('recursive' => '-1', 'conditions' => array('BusinessLine.bl_name' => $blName, 'BusinessLine.id !=' => $bl_id)));
        if (!empty($getBline)) {
            $msg['msg'] = 'vertical already exist';
            $msg['status'] = 0;
        } else {
            $create_bline['BusinessLine']['id'] = $bl_id;
            $create_bline['BusinessLine']['bl_name'] = $blName;
            $create_bline['BusinessLine']['modified_date'] = date('Y-m-d');
            $this->BusinessLine->save($create_bline);
            $msg['msg'] = 'success';
            $msg['status'] = 1;
        }
        $msg['res'] = $msg;
        echo json_encode($msg);
        die;
    }

    /**********Notice Period Listing in masters**************/
    function notice_period() {
        $this->layout = 'admin_layout';
        $this->loadModel('MasterDataDetail');
        $this->paginate = array('limit' => 25, 'group' => 'MasterDataDetail.master_data_desc', 'order' => 'MasterDataDetail.id desc', 'fields' => array('MasterDataDetail.*'), 'conditions' => array('MasterDataDetail.master_data_type' => 'Notice Period'));
        $notice = $this->paginate('MasterDataDetail');
        $this->set('notice', $notice);
        $this->set('title', 'Notice Period');
    }
    /********Add Notice Per In Masters***************/
    function add_notice() {
        $this->loadModel('MasterDataDetail');
        $data = $this->request->data;
        $master['MasterDataDetail']['master_data_type'] = $data['masterType'];
        $master['MasterDataDetail']['master_data_desc'] = $data['notice'];
        $master['MasterDataDetail']['created_date'] = date('Y-m-d');
        $master['MasterDataDetail']['is_active'] = 1;
        $this->MasterDataDetail->save($master);
        $msg['msg'] = 'success';
        $msg['status'] = 1;
        echo json_encode($msg);
        die;
    }
    /********Edit Notice Per In Masters***************/
    function edit_notice_period() {
        $this->loadModel('MasterDataDetail');
        $data = $this->request->data;
        $master['MasterDataDetail']['id'] = $data['notice_id'];
        $master['MasterDataDetail']['master_data_desc'] = $data['Nperiod'];
        $this->MasterDataDetail->save($master);
        echo "success";
        die();
        
    }
    /**************Dunning reminder email***********/
    function schedular_emails() {
        $this->loadModel('InvoiceDunning');
        $this->loadModel('Invoice');
        $this->loadModel('Entity');
        $this->loadModel('InvoiceDunningRecipient');
        CakePlugin::load('PHPExcel');
        App::uses('PHPExcel', 'PHPExcel.Classes');
        $custmrs = $this->Entity->find('all', array('order' => 'Entity.id desc', 'recursive' => '-1'));
        foreach ($custmrs as $custmr) {
            $cust = $custmr['Entity']['entitiy_name'];
            $entid = $custmr['Entity']['entity_id'];
            $fileName = "invoivceSheet" . $custmr['Entity']['id'] . date("Y.m.d") . ".xlsx";
            $objPHPExcel = new PHPExcel();
            $this->response->download($fileName);
            $objPHPExcel->createSheet();
            $cond = array();
            $cond = array('Invoice.entity_id' => $custmr['Entity']['id']);
            
            $invoice = $this->InvoiceDunning->find('first', array('recursive' => '-1', 'conditions' => array('InvoiceDunning.step_target_date' => date('Y-m-d')), 'fields' => array('Invoice.*', 'InvoiceDunning.*'), 'joins' => array(array('table' => 'invoices', 'alias' => 'Invoice', 'type' => 'LEFT', 'conditions' => array('Invoice.id=InvoiceDunning.invoice_id AND Invoice.entity_id=' . $custmr['Entity']['id'])))));
            $steps = $this->InvoiceDunning->find('count', array('recursive' => '-1', 'conditions' => array('InvoiceDunning.invoice_id' => $invoice['Invoice']['id'], 'InvoiceDunning.due_overdue_flg' => 0)));
            $cond = array('Invoice.id' => $invoice['Invoice']['id'], 'Invoice.dunning_attempt_no' => $steps);
            $isPaid = $this->Invoice->find('count', array('recursive' => '-1', 'conditions' => $cond));
            $invoicesdue = array();
            $invoicesovrdue = array();
            $due = 0;
            $overdue = 0;
            if (!empty($invoice) && $isPaid == 0) {
                $dunDate = $this->InvoiceDunning->find('first', array('recursive' => '-1', 'group' => 'InvoiceDunning.invoice_id', 'conditions' => array('InvoiceDunning.step_target_date' => date('Y-m-d'), 'InvoiceDunning.invoice_id' => $invoice['Invoice']['id']), 'fields' => array('InvoiceDunning.*'))); 
                $to = array();
                $cc = array();
                $name['first_name'] = '';
                $name['last_name'] = '';
                $recps = $this->InvoiceDunningRecipient->find('all', array('recursive' => '-1', 'conditions' => array('InvoiceDunningRecipient.invoice_dunning_id' => $dunDate['InvoiceDunning']['id']), 'fields' => array('InvoiceDunningRecipient.*')));
                foreach ($recps as $rc) {
                    if ($rc['InvoiceDunningRecipient']['internal_rcpt'] == 1) {
                        $app = $this->AppUser->find('first', array('recursive' => '-1', 'conditions' => array('AppUser.id' => $rc['InvoiceDunningRecipient']['recipient_id']), 'fields' => array('AppUser.first_name', 'AppUser.last_name', 'AppUser.user_email')));
                        $name['first_name'] = $app['AppUser']['first_name'];
                        $name['last_name'] = $app['AppUser']['last_name'];
                        $to[] = $app['AppUser']['user_email'];
                    }
                    if ($rc['InvoiceDunningRecipient']['in_cc'] == 1) {
                        $app = $this->AppUser->find('first', array('recursive' => '-1', 'conditions' => array('AppUser.id' => $rc['InvoiceDunningRecipient']['recipient_id']), 'fields' => array('AppUser.first_name', 'AppUser.last_name', 'AppUser.user_email')));
                        $cc[] = $rc['AppUser']['user_email'];
                    } else {
                        $cnt = $this->Contact->find('first', array('recursive' => '-1', 'conditions' => array('Contact.id' => $rc['InvoiceDunningRecipient']['recipient_id']), 'fields' => array('Contact.contact_fname', 'Contact.contact_mname', 'Contact.contact_email')));
                        $to[] = $cnt['Contact']['contact_email'];
                    }
                }
                $cc = array_diff($cc, $to);
                if (!empty($dunDate)) {
                    $invoiced = $this->Invoice->find('all', array('recursive' => '-1', 'conditions' => array('Invoice.entity_id' => $custmr['Entity']['id']), 'fields' => array('Invoice.*')));
                    foreach ($invoiced as $invo) {
                        
                        $steps = $this->InvoiceDunning->find('count', array('recursive' => '-1', 'conditions' => array('InvoiceDunning.invoice_id' => $inv['Invoice']['id'], 'InvoiceDunning.due_overdue_flg' => 0)));
                        $cond = array('Invoice.dunning_attempt_no' => $steps, 'Invoice.id' => $invo['Invoice']['id']);
                        $isPaid = $this->Invoice->find('count', array('recursive' => '-1', 'conditions' => $cond));
                        if ($isPaid == 0 || $invo['Invoice']['dunning_attempt_no'] == 0) {
                            if ($invo['Invoice']['invoice_due_dt'] <= date('Y-m-d')) {
                                //opposite var
                                $invoicesovrdue[] = $invo;
                                $overdue+= $invo['Invoice']['invoice_amount'];
                            } else {
                                $invoicesdue[] = $invo;
                                $due+= $invo['Invoice']['invoice_amount'];
                            }
                        }
                    }
                }
                $border_style = array('borders' => array('right' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => '000000')), 'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => '000000'))));
                $row = 1;
                $objPHPExcel->getActiveSheet(0)->mergeCells('F1:K1');
                $objPHPExcel->getActiveSheet(0)->getCell('F1')->setValue('Overdue Aging');
                $objPHPExcel->getActiveSheet(0)->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet(0)->getStyle("F1")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet(0)->getStyle("F1:K1")->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet(0)->getStyle('F1:K1')->applyFromArray(array('font' => array('color' => array('rgb' => 'FFFFFF'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('F1:K1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '5b87d2'))));
                $row = 2;
                $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $row, 'Client')->setCellValue('B' . $row, 'Total AR')->setCellValue('C' . $row, 'Not Due')->setCellValue('D' . $row, 'OverDue')->setCellValue('E' . $row, '0-30')->setCellValue('F' . $row, '31-60')->setCellValue('G' . $row, '61-90')->setCellValue('H' . $row, '91-120')->setCellValue('I' . $row, '121-150')->setCellValue('J' . $row, '151-180')->setCellValue('K' . $row, 'Above 180');
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':K' . $row)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':B' . $row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'bebebe'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('C' . $row)->applyFromArray(array('font' => array('color' => array('rgb' => 'FFFFFF'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('C' . $row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'bebebe'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('D' . $row)->applyFromArray(array('font' => array('color' => array('rgb' => 'FFFFFF'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('D' . $row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '5b87d2'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('E' . $row . ':K' . $row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'c6d7ef'))));
                $row = 3;
                $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $row, $custmr['Entity']['entitiy_name'])->setCellValue('B' . $row, ($due + $overdue))->setCellValue('C' . $row, $due)->setCellValue('D' . $row, $overdue)->setCellValue('E' . $row, '')->setCellValue('F' . $row, '')->setCellValue('G' . $row, '')->setCellValue('H' . $row, '')->setCellValue('I' . $row, '')->setCellValue('J' . $row, '')->setCellValue('K' . $row, '');
                $row = 4;
                $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $row, '');
                $row = 5;
                $objPHPExcel->getActiveSheet(0)->mergeCells('A' . $row . ':H' . $row);
                $objPHPExcel->getActiveSheet(0)->getCell('A' . $row)->setValue('Invoice Wise Details- Notdue Invoices');
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->getFont()->setBold(true);
                //$objPHPExcel->getActiveSheet(0)->getStyle("F1:K1")->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':H' . $row)->applyFromArray(array('font' => array('color' => array('rgb' => 'FFFFFF'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':H' . $row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'a4a4a4'))));
                $row = 6;
                $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $row, 'Client Name')->setCellValue('B' . $row, 'Invoice Number')->setCellValue('C' . $row, 'Invoice Date(M/D/YY)')->setCellValue('D' . $row, 'Invoice Value')->setCellValue('E' . $row, 'Invoice Status')->setCellValue('F' . $row, 'Due in Days')->setCellValue('G' . $row, 'Dispatch  (M/D/YY)')->setCellValue('H' . $row, 'Acknowledgment(M/D/YY)');
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':H' . $row)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':H' . $row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'c6d7ef'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('B' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('C' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('D' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('E' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('F' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('G' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('H' . $row)->applyFromArray($border_style);
                $row = 7;
                foreach ($invoicesdue as $du) {
                    $start_date = strtotime($du['Invoice']['invoice_date']);
                    $end_date = strtotime(date('Y-m-d'));
                    $diffdate = ($end_date - $start_date) / 60 / 60 / 24;
                    $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $row, $custmr['Entity']['entitiy_name'])->setCellValue('B' . $row, $du['Invoice']['invoice_number'])->setCellValue('C' . $row, date("m/d/y", strtotime($du['Invoice']['invoice_date'])))->setCellValue('D' . $row, $du['Invoice']['invoice_amount'])->setCellValue('E' . $row, 'Not Due')->setCellValue('F' . $row, $diffdate)->setCellValue('G' . $row, '')->setCellValue('H' . $row, '');
                    $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':H' . $row)->getFont()->setBold(false);
                    $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':H' . $row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'fce9d8'))));
                    $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('B' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('C' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('D' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('E' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('F' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('G' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('H' . $row)->applyFromArray($border_style);
                    $row++;
                }
                $row = $row + 1;
                $objPHPExcel->getActiveSheet(0)->mergeCells('A' . $row . ':C' . $row);
                $objPHPExcel->getActiveSheet(0)->getCell('A' . $row)->setValue('Total Notdue');
                $objPHPExcel->getActiveSheet(0)->getCell('D' . $row)->setValue($due);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':D' . $row)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':C' . $row)->applyFromArray(array('font' => array('color' => array('rgb' => 'FFFFFF'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':C' . $row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'a4a4a4'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('B' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('C' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('D' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('E' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('F' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('G' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('H' . $row)->applyFromArray($border_style);
                $row = $row + 1;
                $objPHPExcel->getActiveSheet(0)->mergeCells('A' . $row . ':H' . $row);
                $objPHPExcel->getActiveSheet(0)->getCell('A' . $row)->setValue('Invoice Wise Details- Over Due Invoices');
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->getFont()->setBold(true);
                //$objPHPExcel->getActiveSheet(0)->getStyle('A'.$row)->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':H' . $row)->applyFromArray(array('font' => array('color' => array('rgb' => 'FFFFFF'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':H' . $row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '5b87d2'))));
                $row = $row + 1;
                $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $row, 'Client Name')->setCellValue('B' . $row, 'Invoice Number')->setCellValue('C' . $row, 'Invoice Date(M/D/YY)')->setCellValue('D' . $row, 'Invoice Value')->setCellValue('E' . $row, 'Invoice Status')->setCellValue('F' . $row, 'Due in Days')->setCellValue('G' . $row, 'Dispatch  (M/D/YY)')->setCellValue('H' . $row, 'Acknowledgment(M/D/YY)');
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':H' . $row)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':H' . $row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'c6d7ef'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('B' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('C' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('D' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('E' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('F' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('G' . $row)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet(0)->getStyle('H' . $row)->applyFromArray($border_style);
                if (!empty($invoicesovrdue)) $row = $row + 1;
                foreach ($invoicesovrdue as $odu) {
                    $start_date = strtotime($odu['Invoice']['invoice_date']);
                    $end_date = strtotime(date('Y-m-d'));
                    $diffdate = ($end_date - $start_date) / 60 / 60 / 24;
                    $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $row, $custmr['Entity']['entitiy_name'])->setCellValue('B' . $row, $odu['Invoice']['invoice_number'])->setCellValue('C' . $row, date("m/d/y", strtotime($odu['Invoice']['invoice_date'])))->setCellValue('D' . $row, $odu['Invoice']['invoice_amount'])->setCellValue('E' . $row, 'Overdue')->setCellValue('F' . $row, $diffdate)->setCellValue('G' . $row, '')->setCellValue('H' . $row, '');
                    $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':H' . $row)->getFont()->setBold(false);
                    $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('B' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('C' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('D' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('E' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('F' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('G' . $row)->applyFromArray($border_style);
                    $objPHPExcel->getActiveSheet(0)->getStyle('H' . $row)->applyFromArray($border_style);
                    $row++;
                }
                $row = $row + 1;
                $objPHPExcel->getActiveSheet(0)->mergeCells('A' . $row . ':C' . $row);
                $objPHPExcel->getActiveSheet(0)->getCell('A' . $row)->setValue('Total Over due');
                $objPHPExcel->getActiveSheet(0)->getCell('D' . $row)->setValue($overdue);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':D' . $row)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':C' . $row)->applyFromArray(array('font' => array('color' => array('rgb' => 'FFFFFF'))));
                $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row . ':C' . $row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '5b87d2'))));
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header("Content-Disposition: attachment;filename=\"$fileName\"");
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $filePath = '../webroot/files/';
                $objWriter->save($filePath . $fileName);
                $attachments = $filePath . $fileName;
                App::uses('CakeEmail', 'Network/Email');
                $Email = new CakeEmail();
                $Email->config('gmail');
                $Email->emailFormat('html');
                $Email->to(array('deepak.mall@myndsol.com', 'mini@unikove.com', 'karan.likhari@myndsol.com'));
                $name['due'] = $due;
                $name['overdue'] = $overdue;
                $name['cust'] = $cust;
                $Email->cc($cc);
                $Email->subject('Receivables as on ' . date('d/m/Y') . ' for ' . $cust . ' (Cust. ID ' . $entid . ')');
                $Email->template('schedular_invoice');
                $Email->attachments($attachments);
                $Email->viewVars(array('to' => $name));
                $Email->send();
                pre(111);
                die;
                unlink($attachments);
            }
        }
        die;
        return 1;
    }
    /**********Reminder for dunning Of cms********************/
    function scheduleDunningReminder() { //Configure::write('debug', 2);
        $this->loadModel('InvoiceDunning');
        $this->loadModel('Invoice');
        $this->loadModel('MasterDataDetail');
        $this->loadModel('AppUser');
        $date = date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day'));
        $invoiveDate = $this->InvoiceDunning->find('all', array('recursive' => '-1', 'conditions' => array('InvoiceDunning.step_target_date' => $date)));
        foreach ($invoiveDate as $invcD) {
            $invoice = $this->Invoice->find('first', array('recursive' => '-1', 'fields' => array('Entitie.collector_id', 'Invoice.invoice_number'), 'conditions' => array('Invoice.id' => $invcD['InvoiceDunning']['invoice_id'])));
            
            $dmod = $this->MasterDataDetail->find('first', array('recursive' => '-1', 'fields' => array('MasterDataDetail.*'), 'conditions' => array('MasterDataDetail.id' => $invcD['InvoiceDunning']['dunning_mode'])));
            $dtype = $this->MasterDataDetail->find('first', array('recursive' => '-1', 'fields' => array('MasterDataDetail.*'), 'conditions' => array('MasterDataDetail.id' => $invcD['InvoiceDunning']['dunning_type'])));
            $collectr = $this->AppUser->find('first', array('recursive' => '-1', 'fields' => array('AppUser.*'), 'conditions' => array('AppUser.id' => $invoice['Entitie']['collector_id'])));
            $manger = $this->AppUser->find('first', array('recursive' => '-1', 'fields' => array('AppUser.*'), 'conditions' => array('AppUser.id' => $collectr['AppUser']['reporting_manager_id'])));
            $detil['name'] = $collectr['AppUser']['first_name'] . ' ' . $collectr['AppUser']['last_name'];
            $detil['invoice_no'] = $invoice['Invoice']['invoice_number'];
            $detil['step_no'] = $invcD['InvoiceDunning']['dunning_step_no'];
            $detil['mod'] = $dmod['MasterDataDetail']['master_data_desc'];
            $detil['dtype'] = $dtype['MasterDataDetail']['master_data_desc'];
            App::uses('CakeEmail', 'Network/Email');
            $Email = new CakeEmail();
            $Email->config('gmail');
            $Email->emailFormat('html');
            $Email->to(array('deepak.mall@myndsol.com', $collectr['AppUser']['user_email']));
            $Email->cc($manger['AppUser']['user_email']);
            $Email->subject('Invoice Dunning Reminder');
            $Email->template('dunning_reminder');
            $Email->viewVars(array('data' => $detil));
            $Email->send();
        }
        return 1;
    }
    /***************remider emails*********************/
    function schedulerReminder(){
        $this->schedular_emails();
        $this->scheduleDunningReminder();
        $this->contract_expirary();
        $this->collection_report();
        $this->collection_manager_report();

    }
   
    /****************Billing Reminder For Approval*******************/
    public function billing_approve_reminder() {
        $this->loadModel('Entitie');
        $this->loadModel('Contract');
        $this->loadModel('TatMatrice');
        $this->loadModel('AppUser');
        $this->loadModel('BillingSetup');
        $this->loadModel('Project');
        $this->layout = false;
        $this->autoRender = false;
        $getInactiveBilling = $this->BillingSetup->find('all', array('recursive' => - 1, 'conditions' => array('BillingSetup.status' => 0)));
        $getMatricData = $this->TatMatrice->find('first', array('conditions' => array('TatMatrice.module_name' => 'Billing & CMS setup')));
        
        foreach ($getInactiveBilling as $inactiv) {
            $getContractDtl = $this->Contract->find('first', array('fields' => array('Contract.*'), 'conditions' => array('Contract.id' => $inactiv['BillingSetup']['contract_id'])));
            $getCustDtl = $this->Entitie->find('first', array('recursive' => '-1', 'conditions' => array('Entitie.id' => $getContractDtl['Contract']['cust_entity_id'])));
            
            $reminderDays = $getMatricData['TatMatrice']['reminder_day'];
            $escalationDay = $getMatricData['TatMatrice']['escalation_day'];
            $current = time();
            $createdOn = strtotime($inactiv['BillingSetup']['created_date']);
            $diffdate = $current - $createdOn;
            $PendingDays = round($diffdate / (60 * 60 * 24));
           
            $reqRaised = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $inactiv['BillingSetup']['created_by'])));
            $reqApproved = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $reqRaised['AppUser']['reporting_manager_id'])));
            $reqApproved2 = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $reqApproved['AppUser']['reporting_manager_id'])));
            if (($PendingDays >= $reminderDays) && ($PendingDays < $escalationDay)) {
               
                $this->sendBillingReminder($type = 'rem', $req = $reqRaised, $appr = $reqApproved, $appr2 = $reqApproved2, $mailDt = $inactiv, $cust = $getCustDtl, $cont = $getContractDtl);
            }
            if ($PendingDays > $escalationDay) {
                $this->sendBillingReminder($type = 'esc', $req = $reqRaised, $appr = $reqApproved, $appr2 = $reqApproved2, $mailDt = $inactiv, $cust = $getCustDtl, $cont = $getContractDtl);
            }
        }
    }

  /**************Billing Reminder****************/
    function sendBillingReminder($type = null, $req = null, $appr = null, $appr2 = null, $mailDt = null, $cust = null, $cont = null) {
        $this->layout = false;
        $this->autoRender = false;
        $mailCC = array();
        if ($type == 'rem') {
            $Too = $appr['AppUser']['user_email'];
            $sub = "Reminder Approval Notification for " . $cust['Entitie']['entitiy_name'] . " (Cust. ID " . $cust['Entitie']['entity_id'] . ")";
            array_push($mailCC, $req['AppUser']['user_email'], $cust['Entitie']['rsm_email'], $appr2['AppUser']['user_email']);
        } else {
            $Too = $appr2['AppUser']['user_email'];
            $sub = "Escalation Approval Notification for " . $cust['Entitie']['entitiy_name'] . " (Cust. ID " . $cust['Entitie']['entity_id'] . ")";
            array_push($mailCC, $req['AppUser']['user_email'], $cust['Entitie']['rsm_email'], $appr['AppUser']['user_email']);
        }
        $link = HTTP_ROOT . 'home/billing_pending';
        $template = 'billing_approval_reminder';
        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail();
        $Email->config('gmail');
        $Email->emailFormat('html');
        $Email->to('manohar@unikove.com');
        $Email->subject($sub);
        $Email->template($template);
        $Email->viewVars(array('link' => $link, 'createBy' => $req, 'detail' => $mailDt, 'type' => $type, 'approver' => $appr, 'cust' => $cust, 'cont' => $cont));
        $Email->send();
    }
    /************Project Approval reminder****************/
    public function project_approve_reminder() {
        $this->loadModel('Entitie');
        $this->loadModel('Contract');
        $this->loadModel('TatMatrice');
        $this->loadModel('AppUser');
        $this->loadModel('Project');
        $this->layout = false;
        $this->autoRender = false;
        $getInactivePro = $this->Project->find('all', array('recursive' => - 1, 'conditions' => array('Project.status' => 0)));
        $getMatricData = $this->TatMatrice->find('first', array('conditions' => array('TatMatrice.module_name' => 'Project setup')));
        foreach ($getInactivePro as $inactiv) {
            $getCustDtl = $this->Entitie->find('first', array('recursive' => - 1, 'conditions' => array('Entitie.id' => $inactiv['Project']['customer_entity_id'])));
            $reminderDays = $getMatricData['TatMatrice']['reminder_day'];
            $escalationDay = $getMatricData['TatMatrice']['escalation_day'];
            $current = time();
            $createdOn = strtotime($inactiv['Project']['creation_dttm']);
            $diffdate = $current - $createdOn;
            $PendingDays = round($diffdate / (60 * 60 * 24));
            $reqRaised = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $inactiv['Project']['created_by'])));
            $reqApproved = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $reqRaised['AppUser']['reporting_manager_id'])));
            $reqApproved2 = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $reqApproved['AppUser']['reporting_manager_id'])));
            if (($PendingDays >= $reminderDays) && ($PendingDays < $escalationDay)) {
                $this->sendProjectReminder($type = 'rem', $req = $reqRaised, $appr = $reqApproved, $appr2 = $reqApproved2, $mailDt = $inactiv, $cust = $getCustDtl);
            }
            if ($PendingDays > $escalationDay) {
                $this->sendProjectReminder($type = 'esc', $req = $reqRaised, $appr = $reqApproved, $appr2 = $reqApproved2, $mailDt = $inactiv, $cust = $getCustDtl);
            }
        }
    }
    /************ProjectReminder****************/
    function sendProjectReminder($type = null, $req = null, $appr = null, $appr2 = null, $mailDt = null, $cust = null) {
        $this->layout = false;
        $this->autoRender = false;
        $mailCC = array();
        if ($type == 'rem') {
            $Too = $appr['AppUser']['user_email'];
            $sub = "Reminder Approval Notification for " . $cust['Entitie']['entitiy_name'] . " (Cust. ID " . $cust['Entitie']['entity_id'] . ")";
            array_push($mailCC, $req['AppUser']['user_email'], $cust['Entitie']['rsm_email'], $appr2['AppUser']['user_email']);
        } else {
            $Too = $appr2['AppUser']['user_email'];
            $sub = "Escalation Approval Notification for " . $cust['Entitie']['entitiy_name'] . " (Cust. ID " . $cust['Entitie']['entity_id'] . ")";
            array_push($mailCC, $req['AppUser']['user_email'], $cust['Entitie']['rsm_email'], $appr['AppUser']['user_email']);
        }
        $link = HTTP_ROOT . 'home/project_pending';
        $template = 'project_approval_reminder';
        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail();
        $Email->config('gmail');
        $Email->emailFormat('html');
        $Email->to('manohar@unikove.com');
        $Email->subject($sub);
        $Email->template($template);
        $Email->viewVars(array('link' => $link, 'createBy' => $req, 'detail' => $mailDt, 'type' => $type, 'approver' => $appr, 'cust' => $cust));
        $Email->send();
    }
    /************Contract Approval reminder****************/
    public function contract_approve_reminder() {
        $this->loadModel('Entitie');
        $this->loadModel('Contract');
        $this->loadModel('TatMatrice');
        $this->loadModel('AppUser');
        $this->loadModel('Project');
        $this->layout = false;
        $this->autoRender = false;
        $getInactiveCont = $this->Contract->find('all', array('recursive' => - 1, 'conditions' => array('Contract.status' => 0)));
        $getMatricData = $this->TatMatrice->find('first', array('conditions' => array('TatMatrice.module_name' => 'Contract setup')));
        foreach ($getInactiveCont as $inactiv) {
            $getCustDtl = $this->Entitie->find('first', array('recursive' => - 1, 'conditions' => array('Entitie.id' => $inactiv['Contract']['cust_entity_id'])));
            
            $reminderDays = $getMatricData['TatMatrice']['reminder_day'];
            $escalationDay = $getMatricData['TatMatrice']['escalation_day'];
            $current = time();
            $createdOn = strtotime($inactiv['Contract']['creation_dttm']);
            $diffdate = $current - $createdOn;
            $PendingDays = round($diffdate / (60 * 60 * 24));
            
            $reqRaised = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $inactiv['Contract']['created_by'])));
            $reqApproved = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $reqRaised['AppUser']['reporting_manager_id'])));
            $reqApproved2 = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $reqApproved['AppUser']['reporting_manager_id'])));
            if (($PendingDays >= $reminderDays) && ($PendingDays < $escalationDay)) {
                
                $this->sendContractReminder($type = 'rem', $req = $reqRaised, $appr = $reqApproved, $appr2 = $reqApproved2, $mailDt = $inactiv, $cust = $getCustDtl);
            }
            if ($PendingDays > $escalationDay) {
                $this->sendContractReminder($type = 'esc', $req = $reqRaised, $appr = $reqApproved, $appr2 = $reqApproved2, $mailDt = $inactiv, $cust = $getCustDtl);
            }
        }
    }
    /**********Contarct Reminder****************/
    function sendContractReminder($type = null, $req = null, $appr = null, $appr2 = null, $mailDt = null, $cust = null) {
        $this->layout = false;
        $this->autoRender = false;
        $mailCC = array();
        if ($type == 'rem') {
            $Too = $appr['AppUser']['user_email'];
            $sub = "Reminder Approval Notification for " . $cust['Entitie']['entitiy_name'] . " (Cust. ID " . $cust['Entitie']['entity_id'] . ")";
            array_push($mailCC, $req['AppUser']['user_email'], $cust['Entitie']['rsm_email'], $appr2['AppUser']['user_email']);
        } else {
            $Too = $appr2['AppUser']['user_email'];
            $sub = "Escalation Approval Notification for " . $cust['Entitie']['entitiy_name'] . " (Cust. ID " . $cust['Entitie']['entity_id'] . ")";
            array_push($mailCC, $req['AppUser']['user_email'], $cust['Entitie']['rsm_email'], $appr['AppUser']['user_email']);
        }
        $link = HTTP_ROOT . 'home/contracts_pending';
        $template = 'contracts_approval_reminder';
        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail();
        $Email->config('gmail');
        $Email->emailFormat('html');
        $Email->to('manohar@unikove.com');
        $Email->subject($sub);
        $Email->template($template);
        $Email->viewVars(array('link' => $link, 'createBy' => $req, 'detail' => $mailDt, 'type' => $type, 'approver' => $appr, 'cust' => $cust));
        $Email->send();
    }
    /************Customer Aprroval reminder****************/
    public function cust_approve_reminder() {
        $this->loadModel('Entitie');
        $this->loadModel('TatMatrice');
        $this->loadModel('AppUser');
        $this->loadModel('Project');
        $this->layout = false;
        $this->autoRender = false;
        $getInactiveCust = $this->Entitie->find('all', array('recursive' => - 1, 'conditions' => array('Entitie.status' => 'Inactive')));
        $getMatricData = $this->TatMatrice->find('first', array('conditions' => array('TatMatrice.module_name' => 'Customer setup')));
        foreach ($getInactiveCust as $inactiv) {
            $reminderDays = $getMatricData['TatMatrice']['reminder_day'];
            $escalationDay = $getMatricData['TatMatrice']['escalation_day'];
            $current = time();
            $createdOn = strtotime($inactiv['Entitie']['created_date']);
            $diffdate = $current - $createdOn;
            $PendingDays = round($diffdate / (60 * 60 * 24));
            $reqRaised = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $inactiv['Entitie']['created_by'])));
            $reqApproved = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $reqRaised['AppUser']['reporting_manager_id'])));
            $reqApproved2 = $this->AppUser->find('first', array('conditions' => array('AppUser.id' => $reqApproved['AppUser']['reporting_manager_id'])));
            $getCustPro = $this->Project->find('all', array('recursive' => - 1, 'conditions' => array('Project.customer_entity_id' => $inactiv['Entitie']['id'])));
            $vertical = array();
            if (!empty($getCustPro)) {
                foreach ($getCustPro as $pro_cust) {
                    array_push($vertical, $pro_cust['Project']['business_line']);
                }
                $vertical = array_unique($vertical);
            }
            if (!empty($vertical)) {
                //$this->$getverticalHeadEmails($vertical);
                
            }
            
            if (($PendingDays >= $reminderDays) && ($PendingDays < $escalationDay)) {
                
                $this->sendReminder($type = 'rem', $req = $reqRaised, $appr = $reqApproved, $appr2 = $reqApproved2, $mailDt = $inactiv);
            }
            if ($PendingDays > $escalationDay) {
                $this->sendReminder($type = 'esc', $req = $reqRaised, $appr = $reqApproved, $appr2 = $reqApproved2, $mailDt = $inactiv);
            }
        }
    }
    function sendReminder($type = null, $req = null, $appr = null, $appr2 = null, $mailDt = null) {
        $this->layout = false;
        $this->autoRender = false;
        $mailCC = array();
        if ($type == 'rem') {
            $Too = $appr['AppUser']['user_email'];
            $sub = "Reminder Approval Notification for " . $mailDt['Entitie']['entitiy_name'] . " (Cust. ID " . $mailDt['Entitie']['entity_id'] . ")";
            array_push($mailCC, $req['AppUser']['user_email'], $mailDt['Entitie']['rsm_email'], $appr2['AppUser']['user_email']);
            //$template = '';
            
        } else {
            $Too = $appr2['AppUser']['user_email'];
            $sub = "Escalation Approval Notification for " . $mailDt['Entitie']['entitiy_name'] . " (Cust. ID " . $mailDt['Entitie']['entity_id'] . ")";
            array_push($mailCC, $req['AppUser']['user_email'], $mailDt['Entitie']['rsm_email'], $appr['AppUser']['user_email']);
            //$template = '';
            
        }
       
        $link = HTTP_ROOT . 'home/customers_pending';
        $template = 'customers_approval_reminder';
        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail();
        $Email->config('gmail');
        $Email->emailFormat('html');
        $Email->to($Too);
        $Email->cc($mailCC);
        $Email->subject($sub);
        $Email->template($template);
        $Email->viewVars(array('link' => $link, 'createBy' => $req, 'detail' => $mailDt, 'type' => $type, 'approver' => $appr));
        $Email->send();
    }
    /************Forcasting graph****************************/
    function forecasting(){
        
    }
    /****************GRAPH Of cms********************/
    function cmschart() {
        
        $this->loadModel('GraphPeriod');
        $this->loadModel('AppUser');
        $this->loadModel('GraphCollection');
        $this->loadModel('Invoice');
        $this->loadModel('Entity');
        $this->loadModel('Contract');
        $this->loadModel('Project');
        $totalCust = $this->Entity->find('count');
        $this->set('totalCust', $totalCust);
        $totalCont = $this->Contract->find('count');
        $this->set('totalCont', $totalCont);
        $totalProject = $this->Project->find('count');
        $this->set('totalProject', $totalProject);
        /************************AR Ageing Report Graph********************************/
        $arAreport = array();
        $arAreportCr = array();
        $periods = array(30, 60, 90, 120, 150, 180, 270, 360, 361);
        $filtrdate = @$_GET['date'];
        if ($filtrdate != '') {
            $gexp = explode('-', $filtrdate);
            if (@$gexp[2] == '') {
                $pday = $this->getMonthDate($gexp[1]);
                $filtrdate = $filtrdate . '-' . $pday;
            }
            $currentDate = $filtrdate;
        } else {
            $currentDate = date("Y-m-d");
        }
        $collectionGrapgmnth = date('Y-m-01');
        if ($filtrdate != '') $collectionGrapgmnth = $filtrdate;
        foreach ($periods as $k => $period) {
            $oneYearAgo = date('Y-m-d', strtotime($currentDate . " - 365 day"));
            $quarterMonth = date("Y-m", strtotime($currentDate . "-3 months"));
            $qm = explode('-', $quarterMonth);
            $day = $this->getMonthDate($qm[1]);
            $quarterDate = $quarterMonth . '-' . $day;
            $prvMonth = date("Y-m", strtotime($currentDate . "-1 months"));
            $prv = explode('-', $prvMonth);
            $pday = $this->getMonthDate($prv[1]);
            $prvDate = $prvMonth . '-' . $pday;
            $thrtySMLY = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.period' => $period, 'GraphPeriod.created_date' => $oneYearAgo)));
            if (@$thrtySMLY[0]['total'] == '') $thrtySMLY[0]['total'] = 0;
            $thrtySMLY = $thrtySMLY[0]['total'];
            $thrtySMLYcr = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.period' => $period, 'GraphPeriod.created_date' => $oneYearAgo)));
            if (@$thrtySMLYcr[0]['total'] == '') $thrtySMLYcr[0]['total'] = 0;
            $thrtySMLYcr = $thrtySMLYcr[0]['total'];
            $quater = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.period' => $period, 'GraphPeriod.created_date' => $quarterDate)));
            if (@$quater[0]['total'] == '') $quater[0]['total'] = 0;
            $quater = $quater[0]['total'];
            $quatercr = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.period' => $period, 'GraphPeriod.created_date' => $quarterDate)));
            if (@$quatercr[0]['total'] == '') $quatercr[0]['total'] = 0;
            $quatercr = $quatercr[0]['total'];
            $prvs = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.period' => $period, 'GraphPeriod.created_date' => $prvDate)));
            if (@$prvs[0]['total'] == '') $prvs[0]['total'] = 0;
            $prvs = $prvs[0]['total'];
            $prvscr = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.period' => $period, 'GraphPeriod.created_date' => $prvDate)));
            if (@$prvscr[0]['total'] == '') $prvscr[0]['total'] = 0;
            $prvscr = $prvscr[0]['total'];
            $curent = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.period' => $period, 'GraphPeriod.created_date' => $currentDate)));
            if (@$curent[0]['total'] == '') $curent[0]['total'] = 0;
            $curent = $curent[0]['total'];
            $curentcr = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.period' => $period, 'GraphPeriod.created_date' => $currentDate)));
            if (@$curentcr[0]['total'] == '') $curentcr[0]['total'] = 0;
            $curentcr = $curentcr[0]['total'];
            $netcurr = $thrtySMLY - $curent;
            if ($netcurr == 0 || $netcurr < 0) {
                $netcurval = 'greenimg';
            } else {
                $netc = ($netcurr * 100) / $thrtySMLY;
                if ($netc < 10) $netcurval = 'orangeimg';
                else if ($netc > 10) $netcurval = '';
                if ($netc < 0) $netcurval = 'greenimg';
            }
            $netqrtr = $thrtySMLY - $quater;
            if ($netqrtr == 0 || $netqrtr < 0) {
                $netqrtrval = 'greenimg';
            } else {
                $netq = ($netqrtr * 100) / $thrtySMLY;
                if ($netq < 10) $netqrtrval = 'orangeimg';
                else if ($netq > 10) $netqrtrval = '';
                if ($netq < 0) $netqrtrval = 'greenimg';
            }
            $netprv = $thrtySMLY - $prvs;
            if ($netprv == 0 || $netprv < 0) {
                $netprvval = 'greenimg';
            } else {
                $netp = ($netprv * 100) / $thrtySMLY;
                if ($netp < 10) $netprvval = 'orangeimg';
                else if ($netp > 10) $netprvval = '';
                if ($netp < 0) $netprvval = 'greenimg';
            }
            $arAreport[$period]['as_date'] = number_format($curent);
            $arAreport[$period]['as_date_flag'] = $netcurval;
            $arAreport[$period]['prv_date'] = number_format($prvs);
            $arAreport[$period]['prv_date_flag'] = $netprvval;
            $arAreport[$period]['qtr_date'] = number_format($quater);
            $arAreport[$period]['qtr_date_flag'] = $netqrtrval;
            $arAreport[$period]['lastyr'] = number_format($thrtySMLY);
            $netcurrCr = $thrtySMLYcr - $curentcr;
            if ($netcurrCr == 0 || $netcurrCr < 0) {
                $netcurvalcr = 'greenimg';
            } else {
                $netcr = ($netcurrCr * 100) / $thrtySMLYcr;
                if ($netcr < 10) $netcurvalcr = 'orangeimg';
                else if ($netcr > 10) $netcurvalcr = '';
                if ($netcr < 0) $netcurvalcr = 'greenimg';
            }
            $netqrtrcr = $thrtySMLYcr - $quatercr;
            if ($netqrtrcr == 0 || $netqrtrcr < 0) {
                $netqrtrvalcr = 'greenimg';
            } else {
                $netqcr = ($netqrtrcr * 100) / $thrtySMLYcr;
                if ($netqcr < 10) $netqrtrvalcr = 'orangeimg';
                else if ($netqcr > 10) $netqrtrvalcr = '';
                if ($netqcr < 0) $netqrtrvalcr = 'greenimg';
            }
            $netprvcr = $thrtySMLYcr - $prvscr;
            if ($netprvcr == 0 || $netprvcr < 0) {
                $netprvvalcr = 'greenimg';
            } else {
                $netpcr = ($netprvcr * 100) / $thrtySMLYcr;
                if ($netpcr < 10) $netprvvalcr = 'orangeimg';
                else if ($netpcr > 10) $netprvvalcr = '';
                if ($netpcr < 0) $netprvvalcr = 'greenimg';
            }
            $arAreportCr[$period]['as_date'] = number_format($curentcr);
            $arAreportCr[$period]['as_date_flag'] = $netcurvalcr;
            $arAreportCr[$period]['prv_date'] = number_format($prvscr);
            $arAreportCr[$period]['prv_date_flag'] = $netprvvalcr;
            $arAreportCr[$period]['qtr_date'] = number_format($quatercr);
            $arAreportCr[$period]['qtr_date_flag'] = $netqrtrvalcr;
            $arAreportCr[$period]['lastyr'] = number_format($thrtySMLYcr);
        }
        $this->set('arAreport', $arAreport);
        $this->set('arAreportCr', $arAreportCr);
        /************************AR Ageing Report Graph End***************************/
        /************************Collections Graph********************************/
        $months = array();
        for ($i = 0;$i < 6;$i++) {
            $date = date("Y-m", strtotime($collectionGrapgmnth . " -$i months"));
            $month = date("m", strtotime($collectionGrapgmnth . " -$i months"));
            $day = $this->getMonthDate($month);
            $months[] = $date . '-' . $day;
        }
        $months[0] = $currentDate;
        $mntharray = array();
        foreach ($months as $k => $month) {
            $mnt = date("M y", strtotime($month));
            $mnt1 = date("Y-m", strtotime($month));
            $strtdate = $mnt1 . '-' . '01';
            $collectionmnth = $this->GraphCollection->find('first', array('fields' => array('SUM(GraphCollection.total_paid) as startmnth'), 'conditions' => array('GraphCollection.created_date' => $month)));
            if ($collectionmnth[0]['startmnth'] == '') $collectionmnth[0]['startmnth'] = 0;
            $totl_billing = $this->Invoice->find('first', array('fields' => array('SUM(Invoice.invoice_amount) as billing'), 'conditions' => array('Invoice.invoice_date >=' => $strtdate, 'Invoice.invoice_date <=' => $month)));
            if ($totl_billing[0]['billing'] == '') $totl_billing[0]['billing'] = 0;
            $closingarpaid = $this->GraphCollection->find('first', array('fields' => array('SUM(GraphCollection.total_paid) as paid'), 'conditions' => array('GraphCollection.created_date' => $month)));
            $closingarunpaid = $this->GraphCollection->find('first', array('fields' => array('SUM(GraphCollection.total_unpaid) as unpaid'), 'conditions' => array('GraphCollection.created_date' => $month)));
            $closingar = $closingarunpaid[0]['unpaid'] - $closingarpaid[0]['paid'];
            $openingar = $this->GraphCollection->find('first', array('fields' => array('SUM(GraphCollection.total_unpaid) as unpaid'), 'conditions' => array('GraphCollection.created_date' => $strtdate)));
            if ($openingar[0]['unpaid'] == '') $openingar[0]['unpaid'] = 0;
            $mntharray[] = "['" . $mnt . "'," . round($collectionmnth[0]['startmnth']) . ",'" . round($collectionmnth[0]['startmnth']) . "'," . round($openingar[0]['unpaid']) . ",'" . round($openingar[0]['unpaid']) . "'," . round($totl_billing[0]['billing']) . ",'" . round($totl_billing[0]['billing']) . "'," . round($closingar) . ",'" . round($closingar) . "']";
        }
        $collectiongraph = implode(',', $mntharray);
        $this->set('collectiongraph', $collectiongraph);
        /************************Collections Graph End********************************/
        $busnsline = $this->GraphPeriod->find('list', array('group' => 'GraphPeriod.business_line', 'fields' => array('GraphPeriod.business_line')));
        $arAging = array();
        foreach ($busnsline as $bl) {
            $isvalAR = 0;
            $Iscreditag = 0;
            $agingDate = array();
            $cragingDate = array();
            $thrty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 30, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($thrty) && $thrty[0]['total'] > 0) {
                $isvalAR = 1;
                $val = round($thrty[0]['total']);
                $agingDate[] = $val;
            } else {
                $val = 0;
                $agingDate[] = $val;
            }
            $crthrty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 30, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($crthrty) && $crthrty[0]['total'] > 0) {
                $Iscreditag = 1;
                $val = round($crthrty[0]['total']);
                $cragingDate[] = $val;
            } else {
                $val = 0;
                $cragingDate[] = $val;
            }
            $sixty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 60, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($sixty) && $sixty[0]['total'] > 0) {
                $isvalAR = 1;
                $val = round($sixty[0]['total']);
                //$join.=$val.','.'$<div style="font-size:15px; color:#3693cf; text-align:center;"><strong>'.$val.'"</strong></div>$'.',';
                $agingDate[] = $val;
            } else {
                $val = 0;
                $agingDate[] = $val;
            }
            $crsixty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 60, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($crsixty) && $crsixty[0]['total'] > 0) {
                $Iscreditag = 1;
                $val = round($crsixty[0]['total']);
                $cragingDate[] = $val;
            } else {
                $val = 0;
                $cragingDate[] = $val;
            }
            $ninty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 90, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($ninty) && $ninty[0]['total'] > 0) {
                $isvalAR = 1;
                $val = round($ninty[0]['total']);
                $agingDate[] = $val;
            } else {
                $val = 0;
                $agingDate[] = $val;
            }
            $crninty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 90, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($crninty) && $crninty[0]['total'] > 0) {
                $Iscreditag = 1;
                $val = round($crninty[0]['total']);
                $cragingDate[] = $val;
            } else {
                $val = 0;
                $cragingDate[] = $val;
            }
            $onetwenty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 120, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($onetwenty) && $onetwenty[0]['total'] > 0) {
                $isvalAR = 1;
                $val = round($onetwenty[0]['total']);
                $agingDate[] = $val;
            } else {
                $val = 0;
                $agingDate[] = $val;
            }
            $crtwenty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 120, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($crtwenty) && $crtwenty[0]['total'] > 0) {
                $Iscreditag = 1;
                $val = round($crtwenty[0]['total']);
                $cragingDate[] = $val;
            } else {
                $val = 0;
                $cragingDate[] = $val;
            }
            $onefifty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 150, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($onefifty) && $onefifty[0]['total'] > 0) {
                $isvalAR = 1;
                $val = round($onefifty[0]['total']);
                $agingDate[] = $val;
            } else {
                $val = 0;
                $agingDate[] = $val;
            }
            $crfifty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 150, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($crfifty) && $crfifty[0]['total'] > 0) {
                $Iscreditag = 1;
                $val = round($crfifty[0]['total']);
                $cragingDate[] = $val;
            } else {
                $val = 0;
                $cragingDate[] = $val;
            }
            $oneety = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 180, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($oneety) && $oneety[0]['total'] > 0) {
                $isvalAR = 1;
                $val = round($oneety[0]['total']);
                $agingDate[] = $val;
            } else {
                $val = 0;
                $agingDate[] = $val;
            }
            $creti = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 180, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($crfifty) && $crfifty[0]['total'] > 0) {
                $Iscreditag = 1;
                $val = round($crfifty[0]['total']);
                $cragingDate[] = $val;
            } else {
                $val = 0;
                $cragingDate[] = $val;
            }
            $twoseventy = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 270, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($twoseventy) && $twoseventy[0]['total'] > 0) {
                $isvalAR = 1;
                $val = round($twoseventy[0]['total']);
                $agingDate[] = $val;
            } else {
                $val = 0;
                $agingDate[] = $val;
            }
            $crtwosevnty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 270, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($crtwosevnty) && $crtwosevnty[0]['total'] > 0) {
                $Iscreditag = 1;
                $val = round($crtwosevnty[0]['total']);
                $cragingDate[] = $val;
            } else {
                $val = 0;
                $cragingDate[] = $val;
            }
            $treesisty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 360, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($treesisty) && $treesisty[0]['total'] > 0) {
                $isvalAR = 1;
                $val = round($treesisty[0]['total']);
                $agingDate[] = $val;
            } else {
                $val = 0;
                $agingDate[] = $val;
                //$join.='0'.','.'$<div style="font-size:15px; color:#3693cf; text-align:center;"><strong>"0"</strong></div>$'.',';
                
            }
            $crtrsixty = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 360, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($crtrsixty) && $crtrsixty[0]['total'] > 0) {
                $Iscreditag = 1;
                $val = round($crtrsixty[0]['total']);
                $cragingDate[] = $val;
            } else {
                $val = 0;
                $cragingDate[] = $val;
            }
            $above = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 0, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 361, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($above) && $above[0]['total'] > 0) {
                $isvalAR = 1;
                $val = round($above[0]['total']);
                $agingDate[] = $val;
            } else {
                $val = 0;
                $agingDate[] = $val;
            }
            $crabove = $this->GraphPeriod->find('first', array('order' => 'GraphPeriod.created_date desc', 'group' => 'GraphPeriod.entity_id', 'fields' => array('SUM(GraphPeriod.un_paid) AS total'), 'conditions' => array('GraphPeriod.type' => 1, 'GraphPeriod.business_line' => $bl, 'GraphPeriod.period' => 361, 'GraphPeriod.created_date' => $currentDate)));
            if (!empty($crabove) && $crabove[0]['total'] > 0) {
                $Iscreditag = 1;
                $val = round($crabove[0]['total']);
                $cragingDate[] = $val;
            } else {
                $val = 0;
                $cragingDate[] = $val;
            }
            $agin = implode(',', $agingDate);
            $arAging[] = '["' . $bl . '",' . $agin . ']';
            $aginCr = implode(',', $cragingDate);
            $arCreditAging[] = '["' . $bl . '",' . $aginCr . ']';
        }
        $arAging = implode(',', $arAging);
        $arCreditAging = implode(',', $arCreditAging);
        $this->set('arCreditAging', $arCreditAging);
        $this->set('arAging', $arAging);
        
    }
    function getMonthDate($month = null) {
        if ($month == 1) $day = 31;
        else if ($month == 2) $day = 28;
        else if ($month == 3) $day = 31;
        else if ($month == 4) $day = 30;
        else if ($month == 5) $day = 31;
        else if ($month == 6) $day = 30;
        else if ($month == 7) $day = 31;
        else if ($month == 8) $day = 31;
        else if ($month == 9) $day = 30;
        else if ($month == 10) $day = 31;
        else if ($month == 11) $day = 30;
        else if ($month == 12) $day = 31;
        return $day;
    }
    /////////// ************* Notifications Alerts *****************////////////////////
    function contract_expirary() {
        $this->loadModel('Contract');
        $this->loadModel('Project');
        $this->loadModel('UserPermission');
        $this->loadModel('AppUser');
        $this->loadModel('Entity');
        $this->autoRender = false;
        $this->layout = false;
        $stDate = date('Y-m-d');
        $edDate = date('Y-m-d', strtotime($stDate . ' + 30 day'));
        $expirayAlerts = $this->Contract->find('all', array('fields' => array('Contract.*'), 'conditions' => array('Contract.contract_end_dt >=' => $stDate, 'Contract.contract_end_dt <=' => $edDate)));
        foreach ($expirayAlerts as $key => $_expAlert) {
            $getEntityByContract = $this->Entity->find('first', array('fields' => array('Entity.*'), 'conditions' => array('Entity.id' => $_expAlert['Contract']['cust_entity_id'])));
            $getProjectByContract = $this->Project->find('first', array('fields' => array('Project.*'), 'conditions' => array('Project.contract_id' => $_expAlert['Contract']['id'])));
            $getUserPermission = $this->UserPermission->find('first', array('fields' => array('UserPermission.*'), 'conditions' => array('UserPermission.business_line_id' => $getProjectByContract['Project']['business_line'], 'UserPermission.subvertical_id' => $getProjectByContract['Project']['subvertical'])));
            $getVerticalHead = $this->AppUser->find('first', array('fields' => array('AppUser.*'), 'conditions' => array('AppUser.id' => $getUserPermission['UserPermission']['app_user_id'])));
            App::uses('CakeEmail', 'Network/Email');
            $Email = new CakeEmail();
            $Email->config('gmail');
            $Email->emailFormat('html');
            $Email->to($getEntityByContract['Entity']['rsm_email']);
            $Email->cc($getVerticalHead['AppUser']['user_email']);
            $Email->subject('Contract expirary notification');
            $Email->template('contract_expiry');
            $Email->viewVars(array('entity_detail' => $getEntityByContract, 'contract_detail' => $_expAlert));
            $Email->send();
        }
    }
    /**
     *  Weekly collection report to collector and collection manager
     */
    function collection_manager_report() {
        $this->loadModel('Entity');
        $this->loadModel('Contact');
        $this->loadModel('Contract');
        $this->loadModel('Subvertical');
        $this->loadModel('BusinessLine');
        $this->loadModel('Project');
        $this->loadModel('Pricing');
        $this->loadModel('ProjectTask');
        $this->loadModel('ProjectTask');
        $this->loadModel('BillingSetup');
        $this->loadModel('Group');
        $this->loadModel('AppUser');
        $this->loadModel('ProfitCenter');
        $this->loadModel('Invoice');
        $this->loadModel('EntityAddress');
        $this->loadModel('MasterDataDetail');
        $this->loadModel('Permission');
        $this->loadModel('UserPermission');
        $this->loadModel('Target');
        $this->autoRender = false;
        $this->layout = false;
        CakePlugin::load('PHPExcel');
        App::uses('PHPExcel', 'PHPExcel.Classes');
        //  $fileName = "Collection_download_mail.xlsx";
        $fileName = "Collection_download_mail" . date("Y.m.d") . ".xlsx";
        $filePath = '../webroot/files/';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->createSheet();
        $border_style = array('borders' => array('right' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => '000000')), 'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => '000000'))));
        $dayOfWeek = date('l');
        if ($dayOfWeek == 'Saturday') {
            $row = 1;
            $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $row, 'Collector Email ID')->setCellValue('B' . $row, 'Collector Name')->setCellValue('C' . $row, 'Customer ID')->setCellValue('D' . $row, 'Customer Name')->setCellValue('E' . $row, 'PM Email ID')->setCellValue('F' . $row, 'PM Name')->setCellValue('G' . $row, 'Project ID')->setCellValue('H' . $row, 'Project Title')->setCellValue('I' . $row, 'Vertical')->setCellValue('J' . $row, 'Sub Vertical')->setCellValue('K' . $row, 'Total AR')->setCellValue('L' . $row, 'Not Due')->setCellValue('M' . $row, 'Over Due')->setCellValue('N' . $row, '1-30 Days')->setCellValue('O' . $row, '31-60 Days')->setCellValue('P' . $row, '61-90 Days')->setCellValue('Q' . $row, '91-120 Days')->setCellValue('R' . $row, '121-150 Days')->setCellValue('S' . $row, '151-180 Days')->setCellValue('T' . $row, '>180 Days')->setCellValue('U' . $row, 'Target')->setCellValue('V' . $row, 'DSO')->setCellValue('W' . $row, 'Short Fall')->setCellValue('X' . $row, 'Projected DSO')->setCellValue('Y' . $row, 'Actual DSO')->setCellValue('Z' . $row, 'Current month Projected Billing')->setCellValue('AA' . $row, 'Last 2 month  Actual Billing');
            $objPHPExcel->getActiveSheet(0)->getStyle('A1:D1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '377a0b;'))));
            $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet(0)->getStyle('E1:J1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'cccf36;'))));
            $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet(0)->getStyle('K1:AA1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '377a0b;'))));
            $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->applyFromArray($border_style);
            
            /*********Get Collection Manager data(define in appController)*********/
            $per_sedcri = array('Collection Manager');
            $getallCollectionManager = $this->getUserByPermission($per_sedcri);
            /*********Get Collector data(define in appController)*********/
            $per_sedcr = array('Collector');
            $getallCollectors = $this->getUserByPermission($per_sedcr);

            $statrdate = date('Y-m-d');
            $weekStartDate = $this->rangeWeek($statrdate);
            $weekCnt = $this->weekOfMonth($statrdate);
            $getMnt = date('m');
            $getYear = date('Y');
            $getCustTarget = $this->Target->find('all', array('fields' => array('Target.*'), 'conditions' => array('Target.month' => $getMnt, 'Target.year' => $getYear)));
            
            foreach ($getCustTarget as $cust) {
                $cust_entity_id = trim($cust['Target']['customer_id']);
                $getcollectorMgr = $this->AppUser->find('first', array('fields' => array('AppUser.*'), 'conditions' => array('AppUser.user_email' => $cust['Target']['collector_email'])));
                $getReportingMgr = $getcollectorMgr['AppUser']['reporting_manager_id'];
               
                $this->AppUser->virtualFields = array('full_name' => "CONCAT(AppUser.first_name, ' ', AppUser.last_name)");
                $getCollectorName = $this->AppUser->find("first", array("fields" => array("AppUser.id", "AppUser.full_name"), 'conditions' => array('AppUser.user_email' => $cust['Target']['collector_email'])));
                $getentity = $this->Entity->find('first', array('fields' => array('Entity.id', 'Entity.entity_id', 'Entity.entitiy_name'), 'conditions' => array('Entity.entity_id' => $cust_entity_id)));
                if (!empty($getentity)) {
                    $project_master = $this->Project->query("SELECT * FROM projects AS Project LEFT JOIN project_tasks AS ProjectTask ON Project.id = ProjectTask.`project_id` LEFT JOIN billing_setups AS BillingSetup ON Project.contract_id = BillingSetup.contract_id where Project.customer_entity_id =" . $getentity['Entity']['id'] . "");
                    foreach ($project_master as $_projects) {
                        $entity_vertical = $this->BusinessLine->find('first', array('fields' => array('BusinessLine.bl_name'), 'conditions' => array('BusinessLine.id' => $_projects['Project']['business_line'])));
                        
                        $entity_Subvertical = $this->Subvertical->find('first', array('fields' => array('Subvertical.sv_name'), 'conditions' => array('Subvertical.id' => $_projects['Project']['subvertical'])));
                        $getProManager = $this->AppUser->find('first', array('fields' => array('AppUser.first_name', 'AppUser.last_name', 'AppUser.user_email', 'AppUser.user_mobile', 'AppUser.reporting_manager_id'), 'conditions' => array('AppUser.id' => $_projects['Project']['project_mgr_id'])));
                        $totalAr = 0;
                        $getTotalAr = $this->Invoice->find('all', array('fields' => array('Invoice.id', 'Invoice.invoice_amount'), 'conditions' => array('Invoice.entity_id' => $getentity['Entity']['id'], 'Invoice.ar_cat_id' => 1)));
                        if (!empty($getTotalAr)) {
                            foreach ($getTotalAr as $_totalAr) {
                                $totalAr = $totalAr + $_totalAr['Invoice']['invoice_amount'];
                            }
                        }
                        $totalNotDue = 0;
                        $gettotalNotDue = $this->Invoice->find('all', array('fields' => array('Invoice.id', 'Invoice.invoice_amount'), 'conditions' => array('Invoice.entity_id' => $getentity['Entity']['id'], 'Invoice.ar_cat_id' => 1, 'Invoice.invoice_due_dt >=' => $statrdate,)));
                        if (!empty($gettotalNotDue)) {
                            foreach ($gettotalNotDue as $_notDue) {
                                $totalNotDue = $totalNotDue + $_notDue['Invoice']['invoice_amount'];
                            }
                        }
                        $totalOverDue = $this->Invoice->find('all', array('fields' => array('Invoice.id', 'Invoice.invoice_amount'), 'conditions' => array('Invoice.invoice_due_dt < ' => $statrdate, 'Invoice.entity_id' => $getentity['Entity']['id'], 'Invoice.ar_cat_id' => 1)));
                        $over_due = 0;
                        if (!empty($totalOverDue)) {
                            foreach ($totalOverDue as $_totalOverDue) {
                                $over_due = $over_due + $_totalOverDue['Invoice']['invoice_amount'];
                            }
                        }
                        $getCollectorTarget = $this->Target->find('first', array('conditions' => array('Target.id' => $cust['Target']['id'])));
                        $totalTarget = $getCollectorTarget['Target']['week_' . $weekCnt];
                        $totalThirty = $this->calculateInvoiceAging($start = 0, $end = 30, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $totalSisty = $this->calculateInvoiceAging($start = 31, $end = 60, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $totalNinty = $this->calculateInvoiceAging($start = 61, $end = 90, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $total_1Twenty = $this->calculateInvoiceAging($start = 91, $end = 120, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $total_1Fifty = $this->calculateInvoiceAging($start = 121, $end = 150, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $total_1Eighty = $this->calculateInvoiceAging($start = 151, $end = 180, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $total_1EightyMore = $this->calculateInvoiceAging($start = 181, $end = 999999, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $Revenue90 = $this->calculateInvoiceAging($start = 0, $end = 90, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $last2mnt = $this->calculatePreviousMonth($start = $getMnt, $ed = 2, $yr = $getYear, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $ArMntEnd = $this->calculatePreviousMonth($start = $getMnt, $ed = 0, $yr = $getYear, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $getProjectTask = $this->ProjectTask->find('all', array('fields' => array('ProjectTask.*'), 'conditions' => array('DATE_FORMAT(ProjectTask.task_end_date,"%m-%Y")' => $getMnt . "-" . $getYear, 'ProjectTask.project_id' => $_projects['Project']['id'])));
                        $currentBilling = 0;
                        foreach ($getProjectTask as $taskss) {
                            if ($taskss['ProjectTask']['id'] == $_projects['ProjectTask']['id']) {
                                $day = date('d', strtotime($weekStartDate));
                                if ($day > $_projects['BillingSetup']['dt_of_mth']) {
                                    $getPricing = $this->Pricing->find('first', array('fields' => array('Pricing.*'), 'conditions' => array('Pricing.task_id' => $taskss['ProjectTask']['id'])));
                                    if (!empty($getPricing)) {
                                        $currentBilling = $currentBilling + $getPricing['Pricing']['total_task_amount'];
                                    }
                                }
                            }
                        }
                        $projectedDSO = (($totalAr + $currentBilling - $totalTarget) / ($currentBilling + $last2mnt) * 90);
                        $DSO = ($totalAr / ($currentBilling + $last2mnt) * 90);
                        $getActualDSO = (($totalAr) / ($currentBilling + $last2mnt)) * 90;
                        $shortFall = $totalTarget - $currentBilling;
                        $row = 2;
                        $objPHPExcel->getActiveSheet(1)->setCellValue('A' . $row, "" . $getCollectorTarget['Target']['collector_email'] . "")->setCellValue('B' . $row, "" . $getCollectorName['AppUser']['full_name'] . "")->setCellValue('C' . $row, "" . $getentity['Entity']['entity_id'] . "")->setCellValue('D' . $row, "" . $getentity['Entity']['entitiy_name'] . "")->setCellValue('E' . $row, "" . $getProManager['AppUser']['user_email'] . "")->setCellValue('F' . $row, "" . $getProManager['AppUser']['first_name'] . '' . $getProManager['AppUser']['last_name'] . "")->setCellValue('G' . $row, "" . $_projects['Project']['project_id'] . "")->setCellValue('H' . $row, "" . $_projects['Project']['project_title'] . "")->setCellValue('I' . $row, "" . $entity_vertical['BusinessLine']['bl_name'] . "")->setCellValue('J' . $row, "" . $entity_Subvertical['Subvertical']['sv_name'] . "")->setCellValue('K' . $row, "" . $totalAr . "")->setCellValue('L' . $row, "" . $totalNotDue . "")->setCellValue('M' . $row, "" . $over_due . "")->setCellValue('N' . $row, "" . $totalThirty . "")->setCellValue('O' . $row, "" . $totalSisty . "")->setCellValue('P' . $row, "" . $totalNinty . "")->setCellValue('Q' . $row, "" . $total_1Twenty . "")->setCellValue('R' . $row, "" . $total_1Fifty . "")->setCellValue('S' . $row, "" . $total_1Eighty . "")->setCellValue('T' . $row, "" . $total_1EightyMore . "")->setCellValue('U' . $row, "" . $totalTarget . "")->setCellValue('V' . $row, "=K" . $row . "/(SUM(Z" . $row . "+AA" . $row . "))*90")->setCellValue('W' . $row, "" . $shortFall . "")->setCellValue('X' . $row, "=(K" . $row . "+Z" . $row . "-U" . $row . ")/(SUM(Z" . $row . ":AA" . $row . "))*90")->setCellValue('Y' . $row, "" . $getActualDSO . "")->setCellValue('Z' . $row, "" . $currentBilling . "")->setCellValue('AA' . $row, "" . $last2mnt . "");
                        $row++;
                    }
                }
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header("Content-Disposition: attachment;filename=\"$fileName\"");
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $filePath = '../webroot/files/';
                $objWriter->save($filePath . $fileName);
                $attachments = $filePath . $fileName;
                App::uses('CakeEmail', 'Network/Email');
                $Email = new CakeEmail();
                $Email->config('gmail');
                $Email->emailFormat('html');
                $Email->to($getCollectorTarget['Target']['collector_email']);
                $name['name'] = $getCollectorName['AppUser']['full_name'];
                $Email->subject('Weekly Collection target as on ' . date('d/m/Y'));
                $Email->template('schedular_collection');
                $Email->attachments($attachments);
                $Email->viewVars(array('to' => $name));
                $Email->send();
                unlink($attachments);
            }
        }
    }
    /***************************/
    function collection_report() {
        $this->loadModel('Entity');
        $this->loadModel('Contact');
        $this->loadModel('Contract');
        $this->loadModel('Subvertical');
        $this->loadModel('BusinessLine');
        $this->loadModel('Project');
        $this->loadModel('Pricing');
        $this->loadModel('ProjectTask');
        $this->loadModel('ProjectTask');
        $this->loadModel('BillingSetup');
        $this->loadModel('Group');
        $this->loadModel('AppUser');
        $this->loadModel('ProfitCenter');
        $this->loadModel('Invoice');
        $this->loadModel('EntityAddress');
        $this->loadModel('MasterDataDetail');
        $this->loadModel('Permission');
        $this->loadModel('UserPermission');
        $this->loadModel('Target');
        $this->autoRender = false;
        $this->layout = false;
        CakePlugin::load('PHPExcel');
        App::uses('PHPExcel', 'PHPExcel.Classes');
        //  $fileName = "Collection_download_mail.xlsx";
        $fileName = "Collection_download_mail" . date("Y.m.d") . ".xlsx";
        $filePath = '../webroot/files/';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->createSheet();
        $border_style = array('borders' => array('right' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => '000000')), 'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => '000000'))));
        $dayOfWeek = date('l');
        if ($dayOfWeek == 'Saturday') {
            $row = 1;
            $objPHPExcel->getActiveSheet(0)->setCellValue('A' . $row, 'Collector Email ID')->setCellValue('B' . $row, 'Collector Name')->setCellValue('C' . $row, 'Customer ID')->setCellValue('D' . $row, 'Customer Name')->setCellValue('E' . $row, 'PM Email ID')->setCellValue('F' . $row, 'PM Name')->setCellValue('G' . $row, 'Project ID')->setCellValue('H' . $row, 'Project Title')->setCellValue('I' . $row, 'Vertical')->setCellValue('J' . $row, 'Sub Vertical')->setCellValue('K' . $row, 'Total AR')->setCellValue('L' . $row, 'Not Due')->setCellValue('M' . $row, 'Over Due')->setCellValue('N' . $row, '1-30 Days')->setCellValue('O' . $row, '31-60 Days')->setCellValue('P' . $row, '61-90 Days')->setCellValue('Q' . $row, '91-120 Days')->setCellValue('R' . $row, '121-150 Days')->setCellValue('S' . $row, '151-180 Days')->setCellValue('T' . $row, '>180 Days')->setCellValue('U' . $row, 'Target')->setCellValue('V' . $row, 'DSO')->setCellValue('W' . $row, 'Short Fall')->setCellValue('X' . $row, 'Projected DSO')->setCellValue('Y' . $row, 'Actual DSO')->setCellValue('Z' . $row, 'Current month Projected Billing')->setCellValue('AA' . $row, 'Last 2 month  Actual Billing');
            $objPHPExcel->getActiveSheet(0)->getStyle('A1:D1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '377a0b;'))));
            $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet(0)->getStyle('E1:J1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'cccf36;'))));
            $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet(0)->getStyle('K1:AA1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '377a0b;'))));
            $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->applyFromArray($border_style);
            
            /*********Get Collection Manager data(define in appController)*********/
            $per_sedcri = array('Collection Manager');
            $getallCollectionManager = $this->getUserByPermission($per_sedcri);
            /*********Get Collector data(define in appController)*********/
            $per_sedcr = array('Collector');
            $getallCollectors = $this->getUserByPermission($per_sedcr);
            $statrdate = date('Y-m-d');
            $weekStartDate = $this->rangeWeek($statrdate);
            $weekCnt = $this->weekOfMonth($statrdate);
            $getMnt = date('m');
            $getYear = date('Y');
            $getCustTarget = $this->Target->find('all', array('fields' => array('Target.*'), 'conditions' => array('Target.month' => $getMnt, 'Target.year' => $getYear)));
            //pre($getCustTarget);
            foreach ($getCustTarget as $cust) {
                $cust_entity_id = trim($cust['Target']['customer_id']);
                $this->AppUser->virtualFields = array('full_name' => "CONCAT(AppUser.first_name, ' ', AppUser.last_name)");
                $getCollectorName = $this->AppUser->find("first", array("fields" => array("AppUser.id", "AppUser.full_name"), 'conditions' => array('AppUser.user_email' => $cust['Target']['collector_email'])));
                $getentity = $this->Entity->find('first', array('fields' => array('Entity.id', 'Entity.entity_id', 'Entity.entitiy_name'), 'conditions' => array('Entity.entity_id' => $cust_entity_id)));
                if (!empty($getentity)) {
                    $project_master = $this->Project->query("SELECT * FROM projects AS Project LEFT JOIN project_tasks AS ProjectTask ON Project.id = ProjectTask.`project_id` LEFT JOIN billing_setups AS BillingSetup ON Project.contract_id = BillingSetup.contract_id where Project.customer_entity_id =" . $getentity['Entity']['id'] . "");
                    foreach ($project_master as $_projects) {
                        $entity_vertical = $this->BusinessLine->find('first', array('fields' => array('BusinessLine.bl_name'), 'conditions' => array('BusinessLine.id' => $_projects['Project']['business_line'])));
                        //pre($project_master);die;
                        $entity_Subvertical = $this->Subvertical->find('first', array('fields' => array('Subvertical.sv_name'), 'conditions' => array('Subvertical.id' => $_projects['Project']['subvertical'])));
                        $getProManager = $this->AppUser->find('first', array('fields' => array('AppUser.first_name', 'AppUser.last_name', 'AppUser.user_email', 'AppUser.user_mobile', 'AppUser.reporting_manager_id'), 'conditions' => array('AppUser.id' => $_projects['Project']['project_mgr_id'])));
                        $totalAr = 0;
                        $getTotalAr = $this->Invoice->find('all', array('fields' => array('Invoice.id', 'Invoice.invoice_amount'), 'conditions' => array('Invoice.entity_id' => $getentity['Entity']['id'], 'Invoice.ar_cat_id' => 1)));
                        if (!empty($getTotalAr)) {
                            foreach ($getTotalAr as $_totalAr) {
                                $totalAr = $totalAr + $_totalAr['Invoice']['invoice_amount'];
                            }
                        }
                        $totalNotDue = 0;
                        $gettotalNotDue = $this->Invoice->find('all', array('fields' => array('Invoice.id', 'Invoice.invoice_amount'), 'conditions' => array('Invoice.entity_id' => $getentity['Entity']['id'], 'Invoice.ar_cat_id' => 1, 'Invoice.invoice_due_dt >=' => $statrdate,)));
                        if (!empty($gettotalNotDue)) {
                            foreach ($gettotalNotDue as $_notDue) {
                                $totalNotDue = $totalNotDue + $_notDue['Invoice']['invoice_amount'];
                            }
                        }
                        $totalOverDue = $this->Invoice->find('all', array('fields' => array('Invoice.id', 'Invoice.invoice_amount'), 'conditions' => array('Invoice.invoice_due_dt < ' => $statrdate, 'Invoice.entity_id' => $getentity['Entity']['id'], 'Invoice.ar_cat_id' => 1)));
                        $over_due = 0;
                        if (!empty($totalOverDue)) {
                            foreach ($totalOverDue as $_totalOverDue) {
                                $over_due = $over_due + $_totalOverDue['Invoice']['invoice_amount'];
                            }
                        }
                        $getCollectorTarget = $this->Target->find('first', array('conditions' => array('Target.id' => $cust['Target']['id'])));
                        $totalTarget = $getCollectorTarget['Target']['week_' . $weekCnt];
                        $totalThirty = $this->calculateInvoiceAging($start = 0, $end = 30, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $totalSisty = $this->calculateInvoiceAging($start = 31, $end = 60, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $totalNinty = $this->calculateInvoiceAging($start = 61, $end = 90, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $total_1Twenty = $this->calculateInvoiceAging($start = 91, $end = 120, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $total_1Fifty = $this->calculateInvoiceAging($start = 121, $end = 150, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $total_1Eighty = $this->calculateInvoiceAging($start = 151, $end = 180, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $total_1EightyMore = $this->calculateInvoiceAging($start = 181, $end = 999999, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $Revenue90 = $this->calculateInvoiceAging($start = 0, $end = 90, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $last2mnt = $this->calculatePreviousMonth($start = $getMnt, $ed = 2, $yr = $getYear, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $ArMntEnd = $this->calculatePreviousMonth($start = $getMnt, $ed = 0, $yr = $getYear, $entity_id = $getentity['Entity']['id'], $ar_cat_id = 1);
                        $getProjectTask = $this->ProjectTask->find('all', array('fields' => array('ProjectTask.*'), 'conditions' => array('DATE_FORMAT(ProjectTask.task_end_date,"%m-%Y")' => $getMnt . "-" . $getYear, 'ProjectTask.project_id' => $_projects['Project']['id'])));
                        $currentBilling = 0;
                        foreach ($getProjectTask as $taskss) {
                            if ($taskss['ProjectTask']['id'] == $_projects['ProjectTask']['id']) {
                                $day = date('d', strtotime($weekStartDate));
                                if ($day > $_projects['BillingSetup']['dt_of_mth']) {
                                    $getPricing = $this->Pricing->find('first', array('fields' => array('Pricing.*'), 'conditions' => array('Pricing.task_id' => $taskss['ProjectTask']['id'])));
                                    if (!empty($getPricing)) {
                                        $currentBilling = $currentBilling + $getPricing['Pricing']['total_task_amount'];
                                    }
                                }
                            }
                        }
                        $projectedDSO = (($totalAr + $currentBilling - $totalTarget) / ($currentBilling + $last2mnt) * 90);
                        $DSO = ($totalAr / ($currentBilling + $last2mnt) * 90);
                        $getActualDSO = (($totalAr) / ($currentBilling + $last2mnt)) * 90;
                        $shortFall = $totalTarget - $currentBilling;
                        $row = 2;
                        $objPHPExcel->getActiveSheet(1)->setCellValue('A' . $row, "" . $getCollectorTarget['Target']['collector_email'] . "")->setCellValue('B' . $row, "" . $getCollectorName['AppUser']['full_name'] . "")->setCellValue('C' . $row, "" . $getentity['Entity']['entity_id'] . "")->setCellValue('D' . $row, "" . $getentity['Entity']['entitiy_name'] . "")->setCellValue('E' . $row, "" . $getProManager['AppUser']['user_email'] . "")->setCellValue('F' . $row, "" . $getProManager['AppUser']['first_name'] . '' . $getProManager['AppUser']['last_name'] . "")->setCellValue('G' . $row, "" . $_projects['Project']['project_id'] . "")->setCellValue('H' . $row, "" . $_projects['Project']['project_title'] . "")->setCellValue('I' . $row, "" . $entity_vertical['BusinessLine']['bl_name'] . "")->setCellValue('J' . $row, "" . $entity_Subvertical['Subvertical']['sv_name'] . "")->setCellValue('K' . $row, "" . $totalAr . "")->setCellValue('L' . $row, "" . $totalNotDue . "")->setCellValue('M' . $row, "" . $over_due . "")->setCellValue('N' . $row, "" . $totalThirty . "")->setCellValue('O' . $row, "" . $totalSisty . "")->setCellValue('P' . $row, "" . $totalNinty . "")->setCellValue('Q' . $row, "" . $total_1Twenty . "")->setCellValue('R' . $row, "" . $total_1Fifty . "")->setCellValue('S' . $row, "" . $total_1Eighty . "")->setCellValue('T' . $row, "" . $total_1EightyMore . "")->setCellValue('U' . $row, "" . $totalTarget . "")->setCellValue('V' . $row, "=K" . $row . "/(SUM(Z" . $row . "+AA" . $row . "))*90")->setCellValue('W' . $row, "" . $shortFall . "")->setCellValue('X' . $row, "=(K" . $row . "+Z" . $row . "-U" . $row . ")/(SUM(Z" . $row . ":AA" . $row . "))*90")->setCellValue('Y' . $row, "" . $getActualDSO . "")->setCellValue('Z' . $row, "" . $currentBilling . "")->setCellValue('AA' . $row, "" . $last2mnt . "");
                        $row++;
                    }
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header("Content-Disposition: attachment;filename=\"$fileName\"");
                    header('Cache-Control: max-age=0');
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    $filePath = '../webroot/files/';
                    $objWriter->save($filePath . $fileName);
                    $attachments = $filePath . $fileName;
                    App::uses('CakeEmail', 'Network/Email');
                    $Email = new CakeEmail();
                    $Email->config('gmail');
                    $Email->emailFormat('html');
                    //$Email->to('manohar@unikove.com');
                    $Email->to($getCollectorTarget['Target']['collector_email']);
                    //$Email->cc('mini@gmail.com');
                    $name['name'] = $getCollectorName['AppUser']['full_name'];
                    $Email->subject('Weekly Collection target as on ' . date('d/m/Y'));
                    $Email->template('schedular_collection');
                    $Email->attachments($attachments);
                    $Email->viewVars(array('to' => $name));
                    $Email->send();
                    unlink($attachments);
                }
            }
        }
    }
    /*********get Week Of month**************/
    function rangeWeek($datestr) {
        date_default_timezone_set(date_default_timezone_get());
        $dt = strtotime($datestr);
        return array("start" => date('N', $dt) == 1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last monday', $dt)),);
    }
    /*********get Week Of month(use in collection mamager report)**************/
    function weekOfMonth($qDate) {
        $dt = strtotime($qDate);
        $day = date('j', $dt);
        $month = date('m', $dt);
        $year = date('Y', $dt);
        $totalDays = date('t', $dt);
        $weekCnt = 1;
        $retWeek = 0;
        for ($i = 1;$i <= $totalDays;$i++) {
            $curDay = date("N", mktime(0, 0, 0, $month, $i, $year));
            if ($curDay == 7) {
                if ($i == $day) {
                    $retWeek = $weekCnt + 1;
                }
                $weekCnt++;
            } else {
                if ($i == $day) {
                    $retWeek = $weekCnt;
                }
            }
        }
        return $retWeek;
    }
    /***********claculate Invoice Aging(use in collection mamager report)*************/
    function calculateInvoiceAging($st = null, $ed = null, $cust_id = null, $ar_cat_id = null) {
        $this->loadModel('Invoice');
        $startDate = date('Y-m-d');
        $startDate = date('Y-m-d', strtotime($startDate . ' - ' . $st . ' day'));
        $endDate = date('Y-m-d', strtotime($startDate . ' - ' . $ed . ' day'));
        $totalInvAging = $this->Invoice->find('all', array('fields' => array('Invoice.id', 'Invoice.invoice_amount'), 'conditions' => array('Invoice.invoice_due_dt < ' => $startDate, 'Invoice.invoice_due_dt >= ' => $endDate, 'Invoice.entity_id' => $cust_id, 'Invoice.ar_cat_id' => $ar_cat_id)));
        $totalAging = 0;
        if (!empty($totalInvAging)) {
            foreach ($totalInvAging as $_aging) {
                $totalAging = $totalAging + $_aging['Invoice']['invoice_amount'];
            }
        }
        return $totalAging;
    }
    /***********claculate pre month(use in collection mamager report)*************/
    function calculatePreviousMonth($st = null, $ed = null, $year = null, $cust_id = null, $cat_id = null) {
        $this->loadModel('Invoice');
        $currentMnt = $year . '-' . $st . '-01';
        if ($ed == 0) {
            $preMnt = date('Y-m-t', strtotime($currentMnt . " - " . $ed . " Months"));
        } else {
            $preMnt = date('Y-m-d', strtotime($currentMnt . " - " . $ed . " Months"));
        }
        $totalInvAging = $this->Invoice->find('all', array('fields' => array('Invoice.id', 'Invoice.invoice_amount'), 'conditions' => array('Invoice.invoice_due_dt < ' => $currentMnt, 'Invoice.invoice_due_dt >= ' => $preMnt, 'Invoice.entity_id' => $cust_id, 'Invoice.ar_cat_id' => $cat_id)));
        $totalAging = 0;
        if (!empty($totalInvAging)) {
            foreach ($totalInvAging as $_aging) {
                $totalAging = $totalAging + $_aging['Invoice']['invoice_amount'];
            }
        }
        return $totalAging;
    }
    /**********Use for Upload Customer Contract project Invoice exl**********/
    function customer_setup() {
        
    }
    
}
