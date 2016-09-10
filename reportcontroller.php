<?php

require_once(dirname(__FILE__) . "/basecontroller.php");
/**
 *  This Service controller General Report, Export excel and PDF .
 * */

/**
 *  Service controller  : Report controller
 *  Author              : VGS_104
 * */
class Reportcontroller extends Basecontroller {

    public $request;

    function __construct() {
        parent::__construct();
        $this->load->helper(array('string', 'url'));
    }

    public function General($GetModuleName = FALSE) {
        $tables = array('reserve', 'restaurant', 'contactus', 'users');
        foreach ($tables as $table) {
            $table_name = $table;
            $table_name_lable = ucfirst(str_replace('_', ' ', $table_name));
            if (!in_array($table_name, array('users_token', 'users'))) {
                $tables_fields = $this->db->field_data($table_name);
                $Dashboarddata[$table_name]['name'] = $table_name_lable;
            }
        }
        parent::handleSuccess($Dashboarddata);
    }

    public function Reservation() {
        $data = array();
        $dataTableData = $this->GetReservationTableData();
        $data["list"] = $dataTableData["list"];
        $data["headingname"] = $dataTableData["headingname"];

        if ($this->getUserData['acsess_type'] == 'admin') {
            $data["dropdowns"]['fk_users_fullname']['list'] = Getdropdowns('users', 'fullname');
            $data["dropdowns"]['fk_users_fullname']['type'] = 'select';
            $data["dropdowns"]['fk_users_fullname']['name'] = 'USERNAME';

            $data["dropdowns"]['fk_restaurant_restaurantname']['list'] = Getdropdowns('restaurant', 'restaurantname');
        } else {
            $data["dropdowns"]['fk_restaurant_restaurantname']['list'] = Getdropdowns('restaurant', 'restaurantname', array('fk_users_fullname' => $this->getUserData['id']));
        }

        $data["dropdowns"]['fk_restaurant_restaurantname']['name'] = 'RESTAURANTNAME';
        $data["dropdowns"]['fk_restaurant_restaurantname']['type'] = 'select';

        $data["dropdowns"]['reservationdate']['name'] = 'DATE';
        $data["dropdowns"]['reservationdate']['type'] = 'date';

        $data["dropdowns"]['reservetype']['list'] = array('lunch' => 'Lunch', 'diner' => 'Diner');
        $data["dropdowns"]['reservetype']['name'] = 'TYPE';
        $data["dropdowns"]['reservetype']['type'] = 'select';

        $data["dropdowns"]['entered']['list'] = array('0' => 'Nee', '1' => 'Ja');
        $data["dropdowns"]['entered']['name'] = 'ARRIVED';
        $data["dropdowns"]['entered']['type'] = 'select';

        parent::handleSuccess($data);
    }

    public function GetReservationTableData() {
        $table_name = 'reserve';
        $data["headingname"] = array('fk_users_fullname' => 'USERNAME', 'reservationdate' => 'DATE', 'fk_restaurant_restaurantname' => 'RESTAURANTNAME', 'type' => 'TYPE', 'pax' => 'PAX','restable'=>'TABLE', 'starttime' => 'Starttime', 'name' => 'NAME', 'emailaddress' => 'EMAIL', 'phone' => 'PHONE', 'comment' => 'COMMENT', 'entered' => 'ENTERED');
        $giParse = array('select' => array('fk_users_fullname', 'reservationdate', 'fk_restaurant_restaurantname', 'type','restable' ,'pax', 'entered', 'name', 'starttime', 'emailaddress', 'phone', 'comment'));
        if (isset($_POST['Search']) && count($_POST['Search']) > 0) {
            foreach ($_POST['Search'] as $key => $value) {
                if (!empty($value)) {
                    if ($key == 'entered') {
                        $_POST['Search']->entered = ($value == 'Nee') ? '0' : '1';
                    }
                    if ($key == 'reservationdate') {
                        $_POST['Search']->reservationdate = $value;
                    }
                    if ($key == 'reservetype') {
                        $_POST['Search']->type = $value;
                        unset($_POST['Search']->$key);
                    }
                } else {
                    unset($_POST['Search']->$key);
                }
            }
            $giParse['filter'] = $_POST['Search'];
        }
        if ($this->getUserData['acsess_type'] != 'admin') {
            $giParse['filter']->fk_users_id = $this->getUserData['id'];
        }

        $data['list'] = $this->dbmodel->getGridAll($table_name, $giParse);
        foreach ($data['list'] as $key => $value) {
            $data['list'][$key]->entered = ($value->entered == '1') ? 'Ja' : 'Nee';
            $data['list'][$key]->restable='Table '.$value->restable;
        }
        return $data;
    }

    public function DownexcelReservation() {
        $this->load->library('excel');
        $returnArr = $this->GetReservationTableData();
        $data['filename'] = 'Reservation_' . date('d-m-y') . '.xls';
        $this->excel->streamCustom($data['filename'], $returnArr);
        parent::handleSuccess($data);
    }

    public function DownpdfReservation() {
        $returnArr = $this->GetReservationTableData();
        $data['filename'] = 'Reservation_' . date('d-m-y') . '.pdf';
        $hOut = '';
        $head = 0;
        $hOut .= '<div><center><h2>Reservation Report </h2> </center><div width="100%" style="word-wrap:break-word;"><table  width="100%" style="border:solid  width:100%; 1px;" class="table table-bordered table-hover"><thead><tr>';
        foreach ($returnArr['list'] as $key => $value) {
            if ($head == 0) {
                foreach ($value as $keyField => $valueField) {
                    $hOut .= '<td style="border:solid 1px; font-weight: bold; padding:10px;">' . $returnArr['headingname'][$keyField] . '</td>';
                    $head ++;
                }
                $hOut .= '</tr></thead><tbody>';
            }

            $hOut .= '<tr>';
            foreach ($value as $keyField => $valueField)
                $hOut .= '<td style="border:solid 1px; font-weight: bold; padding:10px;">' . $valueField . '</td>';
            $hOut .= '</tr>';
        }
        $hOut .= ' </tbody></table></div></div>';

        $this->load->library('pdf');
        $this->pdf->set_paper(array(0, 0, 1841, 595), 'portrait');
        $Viewdata['ht'] = $hOut;
        $this->pdf->load_view('pdffiles', $Viewdata);
        $this->pdf->render();
        file_put_contents('export/' . $data['filename'], $this->pdf->output());
        parent::handleSuccess($data);
    }

    public function Enquete() {
        $data = array();
        $dataTableData = $this->GetEnqueteTableData();
        $data["list"] = $dataTableData["list"];
        $data["headingname"] = $dataTableData["headingname"];
        $data["dropdowns"]['fk_reserve_name']['name'] = 'RESERVATIONNAME';
        $data["dropdowns"]['fk_reserve_name']['type'] = 'select';
        $data["dropdowns"]['fk_restaurant_id']['name'] = 'RESTAURANTNAME';
        $data["dropdowns"]['fk_restaurant_id']['type'] = 'select';
        if ($this->getUserData['acsess_type'] == 'admin') {
            $data["dropdowns"]['fk_users_fullname']['type'] = 'select';
            $data["dropdowns"]['fk_users_fullname']['name'] = 'USERNAME';
            $data["dropdowns"]['fk_users_fullname']['list'] = Getdropdowns('users', 'fullname');
            $datafk_reserve_namelist = Getdropdowns('reserve', 'name');
            $data["dropdowns"]['fk_restaurant_id']['list'] = Getdropdowns('restaurant', 'restaurantname');
        } else {
            $data["dropdowns"]['fk_restaurant_restaurantname']['list'] = Getdropdowns('restaurant', 'restaurantname', array('fk_users_fullname' => $this->getUserData['id']));
            $datafk_reserve_namelist = Getdropdowns('reserve', 'name', array('fk_users_fullname' => $this->getUserData['id']));
            $data["dropdowns"]['fk_restaurant_id']['list'] = Getdropdowns('restaurant', 'restaurantname', array('fk_users_fullname' => $this->getUserData['id']));
        }

        $Tempfk_reserve_namelist = array();
        foreach ($datafk_reserve_namelist as $key => $value) {
            if (!in_array($value, $Tempfk_reserve_namelist)) {
                array_push($Tempfk_reserve_namelist, $value);
                $data["dropdowns"]['fk_reserve_name']['list'][$key] = $value;
            }
        }


        parent::handleSuccess($data);
    }

    public function GetEnqueteTableData() {
        
        $table_name = 'enqueteanswer';
        $data["headingname"] = array('fk_restaurant_restaurantname' => 'RESTAURANTNAME','fk_users_fullname' => 'USERNAME', 'fk_reserve_name' => 'RESERVATIONNAME', 'fk_enquetequestion_title' => 'TITLE', 'fk_enquetequestion_description' => 'DESCRIPTION', 'value' => 'ANSWER');
        $giParse = array('select' => array('fk_users_fullname', 'fk_reserve_name', 'fk_restaurant_id','fk_restaurant_restaurantname', 'fk_enquetequestion_title', 'fk_enquetequestion_description', 'value'));
        if (isset($_POST['Search']) && count($_POST['Search']) > 0) {
            foreach ($_POST['Search'] as $key => $value) {
                if (!empty($value)) {
                    if ($key == 'fk_reserve_name') {
                        $_POST['Search']->fk_reserve_name = $value;
                    }
                    if ($key == 'fk_restaurant_id') {
                        $_POST['Search']->fk_restaurant_restaurantname = $value;
                        unset($_POST['Search']->$key);
                    }
                } else {
                    unset($_POST['Search']->$key);
                }
            }
            $giParse['filter'] = $_POST['Search'];
        }

        if ($this->getUserData['acsess_type'] != 'admin') {
            $giParse['filter']->fk_users_id = $this->getUserData['id'];
        }

        $data['list'] = $this->dbmodel->getGridAll($table_name, $giParse);
        foreach ($data['list'] as $key => $value) {
            unset($data['list'][$key]->fk_restaurant_id);
        }
        return $data;
    }

    public function DownexcelEnquete() {
        $this->load->library('excel');
        $returnArr = $this->GetEnqueteTableData();
        $data['filename'] = 'En-quete' . date('d-m-y') . '.xls';
        pre($returnArr);
        $this->excel->streamCustom($data['filename'], $returnArr);
        parent::handleSuccess($data);
    }

    public function DownpdfEnquete() {
        $returnArr = $this->GetEnqueteTableData();
        $data['filename'] = 'En-quete_' . date('d-m-y') . '.pdf';
        $hOut = '';
        $head = 0;
        $hOut .= '<div><center><h2>Reservation Report </h2> </center><div width="100%" style="word-wrap:break-word;"><table  width="100%" style="border:solid  width:100%; 1px;" class="table table-bordered table-hover"><thead><tr>';
        foreach ($returnArr['list'] as $key => $value) {
            if ($head == 0) {
                foreach ($value as $keyField => $valueField) {
                    $hOut .= '<td style="border:solid 1px; font-weight: bold; padding:10px;">' . $returnArr['headingname'][$keyField] . '</td>';
                    $head ++;
                }
                $hOut .= '</tr></thead><tbody>';
            }

            $hOut .= '<tr>';
            foreach ($value as $keyField => $valueField)
                $hOut .= '<td style="border:solid 1px; font-weight: bold; padding:10px;">' . $valueField . '</td>';
            $hOut .= '</tr>';
        }
        $hOut .= ' </tbody></table></div></div>';

        $this->load->library('pdf');
        $this->pdf->set_paper(array(0, 0, 841, 595), 'portrait');
        $Viewdata['ht'] = $hOut;
        $this->pdf->load_view('pdffiles', $Viewdata);
        $this->pdf->render();
        file_put_contents('export/' . $data['filename'], $this->pdf->output());
        parent::handleSuccess($data);
    }

    public function Users() {
        $data = array();
        $dataTableData = $this->GetUsersTableData();
        $data["list"] = $dataTableData["list"];
        $data["headingname"] = $dataTableData["headingname"];


        parent::handleSuccess($data);
    }

    public function GetUsersTableData() {
        $table_name = 'users';
        $data["headingname"] = array('fullname' => 'NAME', 'acsess_type' => 'ACSESSTYPE', 'paidtill' => 'PAIDTILL', 'payper' => 'PAYPER', 'bankaccount' => 'BANKACCOUNT', 'bankaccountname' => 'BANKACCOUNTNAME', 'apikey' => 'APIKEY', 'displayname' => 'DISPLAYNAME', 'address' => 'ADDRESS', 'zipcode' => 'ZIPCODE', 'city' => 'CITY', 'phone' => 'PHONE', 'website' => 'WEBSITE', 'maxpaxperreservation' => 'MAXPAXPERRESERVATION', 'maxreservationslunch' => 'MAXRESERVATIONSLUNCH', 'maxreservationsdiner' => 'MAXRESERVATIONSDINER', 'mailfrom' => 'MAILFROM', 'backupmail' => 'BACKUPMAIL', 'enquete' => 'ENQUETE', 'custommailtext' => 'CUSTOMMAILTEXT', 'custommailbeginning' => 'CUSTOMMAILBEGINNING', 'custommailendingname' => 'CUSTOMMAILENDINGNAME', 'custommailsubject' => 'CUSTOMMAILSUBJECT', 'custommailending' => 'CUSTOMMAILENDING', 'lunchopen' => 'LUNCHOPEN', 'lunchclose' => 'LUNCHCLOSE', 'lunchsecrun' => 'LUNCHSECRUN', 'dineropen' => 'DINEROPEN', 'dinerclose' => 'DINERCLOSE', 'dinersecrun' => 'DINERSECRUN');
        $giParse = array('select' => array('fullname', 'acsess_type', 'paidtill', 'payper', 'bankaccount', 'bankaccountname', 'apikey', 'displayname', 'address', 'zipcode', 'city', 'phone', 'website', 'maxpaxperreservation', 'maxreservationslunch', 'maxreservationsdiner', 'mailfrom', 'backupmail', 'enquete', 'lunchopen', 'lunchclose', 'lunchsecrun', 'dineropen', 'dinerclose', 'dinersecrun'));
        if (isset($_POST['Search']) && count($_POST['Search']) > 0) {
            foreach ($_POST['Search'] as $key => $value) {
                if (!empty($value)) {
                    if ($key == 'reservationdate') {
                        $_POST['Search']->$key = cdatentodb($value);
                    }
                    if ($key == 'reservetype') {
                        $_POST['Search']->type = $value;
                        unset($_POST['Search']->$key);
                    }
                } else {
                    unset($_POST['Search']->$key);
                }
            }
            $giParse['filter'] = $_POST['Search'];
        }
        $data['list'] = $this->dbmodel->getGridAll($table_name, $giParse);
        return $data;
    }

    public function DownexcelUsers() {
        $this->load->library('excel');
        $returnArr = $this->GetUsersTableData();
        $data['filename'] = 'Reservation_' . date('d-m-y') . '.xls';
        $this->excel->streamCustom($data['filename'], $returnArr);
        parent::handleSuccess($data);
    }

    public function DownpdfUsers() {
        $returnArr = $this->GetUsersTableData();
        $data['filename'] = 'Reservation_' . date('d-m-y') . '.pdf';
        $hOut = '';
        $head = 0;
        $hOut .= '<div><center><h2>Reservation Report </h2> </center><div width="100%" style="word-wrap:break-word;"><table  width="100%" style="border:solid  width:100%; 1px;" class="table table-bordered table-hover"><thead><tr>';
        foreach ($returnArr['list'] as $key => $value) {
            if ($head == 0) {
                foreach ($value as $keyField => $valueField) {
                    $hOut .= '<td style="border:solid 1px; font-weight: bold; padding:10px;">' . $returnArr['headingname'][$keyField] . '</td>';
                    $head ++;
                }
                $hOut .= '</tr></thead><tbody>';
            }

            $hOut .= '<tr>';
            foreach ($value as $keyField => $valueField)
                $hOut .= '<td style="border:solid 1px; font-weight: bold; padding:10px;">' . $valueField . '</td>';
            $hOut .= '</tr>';
        }
        $hOut .= ' </tbody></table></div></div>';

        $this->load->library('pdf');
        $this->pdf->set_paper(array(0, 0, 2300, 595), 'portrait');
        $Viewdata['ht'] = $hOut;
        $this->pdf->load_view('pdffiles', $Viewdata);
        $this->pdf->render();
        file_put_contents('export/' . $data['filename'], $this->pdf->output());
        parent::handleSuccess($data);
    }

    public function GetGeneralData($GetModuleName = FALSE) {
        $returnArr = $this->GetTableData($GetModuleName);
        if (count($returnArr) > 0)
            parent::handleSuccess($returnArr);
        else
            parent::handleError(array('error' => 'Data are not exist'));
    }

    public function GetTableData($GetModuleName = FALSE) {
        $tables_fields = $this->db->field_data($GetModuleName);
        $FieldArray = array();
        foreach ($tables_fields as $key => $value) {
            $viFK = explode('_', $value->name);
            if (!in_array($value->name, array('id', 'status', 'cdate', 'mdate', 'u_by', 'dels')))
                array_push($FieldArray, $value->name);

            if ($viFK[0] == 'fk') {
                $returnArr["dropdowns"][$value->name]['list'] = Getdropdowns($viFK[1], $viFK[2]);
                $returnArr["dropdowns"][$value->name]['type'] = 'select';
                $returnArr["dropdowns"][$value->name]['name'] = ucfirst(str_replace('_', ' ', str_replace('fk_', '', $value->name)));
            }

            if (isset($viFK[1]) && $viFK[1] == 'date') {
                $returnArr["dropdowns"][$value->name]['name'] = ucfirst(str_replace('_', ' ', $value->name));
                $returnArr["dropdowns"][$value->name]['type'] = 'date';
            }
        }

        $giParse = array('select' => $FieldArray);

        if (isset($_POST['Search'])) {
            foreach ($_POST['Search'] as $key => $value) {
                $viFK = explode('_', $key);
                if (isset($viFK[1]) && $viFK[1] == 'date') {
                    $_POST['Search']->$key = cdatentodb($value);
                }
            }
            $giParse['filter'] = $_POST['Search'];
        }
        $Dashboarddata = $this->dbmodel->getGridAll($GetModuleName, $giParse);
        foreach ($Dashboarddata as $key => $value) {
            $rFieldArr = array();
            foreach ($value as $keyField => $valueField) {
                $rFieldArr[ucfirst(str_replace('_', ' ', str_replace('fk_', '', str_replace('uk_', '', $keyField))))] = $valueField;
            }
            $returnArr['list'][$key] = $rFieldArr;
        }
        return $returnArr;
    }

    public function Downexcel($GetModuleName = FALSE) {
        $this->load->library('excel');
        $returnArr = $this->GetTableData($GetModuleName);
        $data['filename'] = $GetModuleName . '_' . date('d-m-y') . '.xls';
        $this->excel->stream($data['filename'], $returnArr['list']);
        parent::handleSuccess($data);
    }

    public function DeleteDown($GetModuleName = FALSE) {
        unlink('export/' . $GetModuleName);
        parent::handleSuccess('');
    }

    public function Downpdf($GetModuleName = FALSE) {
        $returnArr = $this->GetTableData($GetModuleName);
        $data['filename'] = $GetModuleName . '_' . date('d-m-y') . '.pdf';
        $hOut = '';
        $head = 0;
        $hOut .= '<div><center><h2>' . ucfirst(str_replace('_', ' ', $GetModuleName)) . ' Report </h2> </center><div width="100%" style="word-wrap:break-word;"><table  width="100%" style="border:solid  1px;" class="table table-bordered table-hover"><thead><tr>';
        foreach ($returnArr['list'] as $key => $value) {
            if ($head == 0) {
                foreach ($value as $keyField => $valueField) {
                    $hOut .= '<td style="border:solid 1px; font-weight: bold; padding:10px;">' . $keyField . '</td>';
                    $head ++;
                }
                $hOut .= '</tr></thead><tbody>';
            }

            $hOut .= '<tr>';
            foreach ($value as $keyField => $valueField)
                $hOut .= '<td style="border:solid 1px; font-weight: bold; padding:10px;">' . $valueField . '</td>';
            $hOut .= '</tr>';
        }
        $hOut .= ' </tbody></table></div></div>';

        $this->load->library('pdf');
        $Viewdata['ht'] = $hOut;
        $this->pdf->load_view('pdffiles', $Viewdata);
        $this->pdf->render();
        file_put_contents('export/' . $data['filename'], $this->pdf->output());
        parent::handleSuccess($data);
    }
    
    public function overallSurvey() {
        $data = array();
        $dataTableData = $this->GetOverallSurveyTableData();
        $data["list"] = $dataTableData['list'];
        $data["restarunt"] = $dataTableData['restarunt'];
        $data["table"] = $dataTableData['table'];
        $data["empty"] = $dataTableData['empty'];
        parent::handleSuccess($data);
    }
    public function GetOverallSurveyTableData() {
        $table_name = 'surveyanswer';
        $where='';$wheres='';
        if (isset($_POST['Searchs']) && $_POST['Searchs']!='') {
            $where='and b.fk_restaurant_restaurantname='.$_POST['Searchs'];
        }
        if ((isset($_POST['fdate']) && $_POST['fdate']!='') && (isset($_POST['tdate']) && $_POST['tdate']!='')) {
            $wheres=" and date_format(date(from_unixtime(a.cdate)),'%d/%m/%Y') between '".$_POST['fdate']."' and '".$_POST['tdate']."'";
        }
        $sql="select a.restaurantname,a.id ,IF(b.questions IS NULL,'-', b.questions)questions,"
                . "IF(b.mark IS NULL,'-', b.mark)mark,"
                . "IF(b.maxmark IS NULL,'-', b.maxmark)maxmark,"
                . "IF(b.name IS NULL,'-', b.name)name  "
                . "from a_res_book_restaurant as a left join (select a.*,b.name,b.fk_restaurant_restaurantname from ("
                . "select b.*,a.fk_reserve_id,a.fk_users_id from ".$this->db->dbprefix("survey")." as a "
                . "inner join (select b.fk_survey_id,b.fk_surveyquestions_id,
                    group_concat(b.mark) as mark,group_concat(a.questions) as questions, 
                    group_concat(a.maxmark) as maxmark from ".$this->db->dbprefix("surveyanswer")." as b inner join 
			(SELECT questions,maxmark,id FROM ".$this->db->dbprefix("surveyquestions").") as a 
                        on a.id=b.fk_surveyquestions_id where b.dels='0' group by b.fk_survey_id) as b"
                    . " on b.fk_survey_id=a.id where a.dels='0' ".$wheres.") as a inner join "
                .$this->db->dbprefix("reserve")." as b on a.fk_reserve_id=b.id where b.dels='0' and b.status=1 ".$where." )as b "
                . "on a.id=b.fk_restaurant_restaurantname ";
        $result=$this->dbmodel->executeQuery($sql);
        $data["headingname"] = array('fk_restaurant_restaurantname' => 'RESTAURANTNAME','fk_users_fullname' => 'USERNAME', 'fk_question_title' => 'TITLE',  'value' => 'ANSWER');
        $data['list']=array();
        $data['restarunt']=array();
        $data['table']=array();
        $i=0;
        $totc=0;
        foreach ($result as $key => $value) {
            $qus= explode(',', $value->questions);
            $ans1= explode(',', $value->mark);
            $ans2= explode(',', $value->maxmark);
            $data['restarunt'][$value->id]=$value->restaurantname;
            $data['list'][$i]['restaurantname']=$value->restaurantname;
            $data['list'][$i]['restaurantnames']=$value->id;
            $data['empty']=0;
            if($value->name=='-' ){
                $totc++;
                if($totc==count($result)){
                    $data['empty']=1;
                }
            }
            $data['list'][$i]['name']=$value->name;
            $data['list'][$i]['questions']=array();
            $data['list'][$i]['question_list']=array();
            $temp=0;
            $count=0;
            if($qus[0]!='-'){
                foreach ($qus as $qus_key => $qus_value) {
                    $index=array_search($qus_value,$data['list'][$i]['questions']);
                    if($index== false){
                       array_push($data['list'][$i]['questions'],$qus_value);
                       array_push($data['table'],$qus_value);
                       $data['list'][$i]['question_list'][$qus_value]=round((round($ans1[$qus_key])*100)/$ans2[$qus_key],2);
                       $temp=$temp+$data['list'][$i]['question_list'][$qus_value];
                       $count++;
                    }
                }
                $data['list'][$i]['avg']=$temp/$count;
            }else{
                $data['list'][$i]['avg']=$temp;
            } 
                
            $i++;
        }
        if(isset($data['table'][0]))
            $data['table']=array_unique($data['table']);
        return $data;
    }
    public function DownexcelSurvey() {
        $this->load->library('excel');
        $finalreturnArr = array();
        $returnArr = $this->GetOverallSurveyTableData();
        $table=array();
        foreach ($returnArr['table'] as $value) {
            $table[$value]=$value;
        }
        $headingname = array('fk_restaurant_restaurantname'=>'RESTAURANTNAME','fk_users_fullname'=>'USERNAME','value'=>'ANSWER');
        $finalreturnArr['headingname']=array_merge($headingname,$table);
        $temp=array();
        $i=0;
        foreach ($returnArr['list'] as $key => $value) {
            if($value['name']!='-'){
                $temp[$i]['fk_restaurant_restaurantname']=$value['restaurantname'];
                $temp[$i]['fk_users_fullname']=$value['name'];
                foreach ($value['question_list'] as $keys => $values) {
                    $temp[$i][$keys]=$values;
                }
                $temp[$i]['value']=$value['avg'];
                $i++;
            }
        }
        foreach ($temp as $key => $value) {
            $finalreturnArr['list'][$key]=(object)$value;
        }
        $data['filename'] = 'Survey_' . date('d-m-y') . '.xls';
        $this->excel->streamCustom($data['filename'], $finalreturnArr);
        parent::handleSuccess($data);
    }
    public function DownpdfSurvey() {
        $finalreturnArr = array();
        $returnArr = $this->GetOverallSurveyTableData();
        $table=array();
        foreach ($returnArr['table'] as $value) {
            $table[$value]=$value;
        }
        $headingname = array('fk_restaurant_restaurantname'=>'RESTAURANTNAME','fk_users_fullname'=>'USERNAME','value'=>'ANSWER');
        $finalreturnArr['headingname']=array_merge($headingname,$table);
        $temp=array();
        $i=0;
        foreach ($returnArr['list'] as $key => $value) {
            if($value['name']!='-'){
                $temp[$i]['fk_restaurant_restaurantname']=$value['restaurantname'];
                $temp[$i]['fk_users_fullname']=$value['name'];
                foreach ($value['question_list'] as $keys => $values) {
                    $temp[$i][$keys]=$values;
                }
                $temp[$i]['value']=$value['avg'];
                $i++;
            }
        }
        $finalreturnArr['list']=$temp;
        $data['filename'] = 'Survey_' . date('d-m-y') . '.pdf';
        $hOut = '';
        $head = 0;
        $hOut .= '<div><center><h2>' . ucfirst(str_replace('_', ' ', 'Survey')) . ' Report </h2> </center><div width="100%" style="word-wrap:break-word;"><table  width="100%" style="border:solid  1px;" class="table table-bordered table-hover"><thead><tr>';
        foreach ($finalreturnArr['list'] as $key => $value) {
            if ($head == 0) {
                foreach ($value as $keyField => $valueField) {
                    $hOut .= '<td style="border:solid 1px; font-weight: bold; padding:10px;">' . $keyField . '</td>';
                    $head ++;
                }
                $hOut .= '</tr></thead><tbody>';
            }

            $hOut .= '<tr>';
            foreach ($value as $keyField => $valueField)
                $hOut .= '<td style="border:solid 1px; font-weight: bold; padding:10px;">' . $valueField . '</td>';
            $hOut .= '</tr>';
        }
        $hOut .= ' </tbody></table></div></div>';

        $this->load->library('pdf');
        $Viewdata['ht'] = $hOut;
        $this->pdf->load_view('pdffiles', $Viewdata);
        $this->pdf->render();
        file_put_contents('export/' . $data['filename'], $this->pdf->output());
        parent::handleSuccess($data);
    }
}

