<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->model('report_model');

        if ($this->session->userdata('userid') == "") {
            redirect(base_url() . 'login/', 'refresh');
        }
    }

    public function index() {

        $purchase_shop_details = $this->report_model->purchase_shop_list();
        $deliver_pickup_list = $this->report_model->deliver_pickup_list();
        $payment_mode_list = $this->report_model->payment_mode_list();
        $data = array("purchase_shop_details" => $purchase_shop_details, 'deliver_pickup_list' => $deliver_pickup_list, 'payment_mode_list' => $payment_mode_list);
        $this->load->view('includes/header');
        $this->load->view('dashboard', $data);
        $this->load->view('includes/footer');
    }

    public function addAjaxInvoice() {

        if (($this->input->server('REQUEST_METHOD') == "POST")) {

            $order_date_count = count($this->input->post('order_date'));
            $order_date = $this->input->post('order_date');
            $order_no = $this->input->post('order_no');
            $customer_name = $this->input->post('customer_name');
            $item_description = $this->input->post('item_description');
            $purchased_shop = $this->input->post('purchased_shop');
            $sold_price = $this->input->post('sold_price');
            $purchase_price = $this->input->post('purchase_price');
            $deliver_cost = $this->input->post('deliver_cost');
            $deliver_pickup = $this->input->post('deliver_pickup');
            $net = $this->input->post('net');
            $payment_mode = $this->input->post('payment_mode');
            $cash_received = $this->input->post('cash_received');
            $status = $this->input->post('status');
            for ($i = 0; $i < $order_date_count; $i++) {
                $set_data = array('order_date' => trim(date("Y-m-d", strtotime($order_date[$i]))),
                    'order_no' => trim($order_no[$i]),
                    'customer_name' => trim($customer_name[$i]),
                    'item_description' => trim($item_description[$i]),
                    'purchase_id' => trim($purchased_shop[$i]),
                    'sold_price' => trim($sold_price[$i]),
                    'purchase_price' => trim($purchase_price[$i]),
                    'deliver_cost' => trim($deliver_cost[$i]),
                    'deliver_pickup_id' => trim($deliver_pickup[$i]),
                    'net' => trim($net[$i]),
                    'payment_id' => trim($payment_mode[$i]),
                    'cash_received' => trim($cash_received[$i]),
                    'status' => trim($status[$i]),
                    'created_by' => $this->session->userdata('userid')
                );

                $addInvoice = $this->report_model->addInvoice($set_data);
            }
        }
    }

    public function addExpense() {
        $data['expense_type_list'] = $this->report_model->expense_type_list();
        $this->load->view('includes/header');
        $this->load->view('addExpense', $data);
        $this->load->view('includes/footer');
    }

    public function ajaxAddExpense() {
        if (($this->input->server('REQUEST_METHOD') == "POST")) {

            $expenses_date_count = count($this->input->post('expense_date'));
            $expenses_date = $this->input->post('expense_date');
            $expense_type = $this->input->post('expense_type');
            $expense_description = $this->input->post('expense_description');
            $expense_amount = $this->input->post('expense_amount');
            $expense_status = $this->input->post('status');
            for ($i = 0; $i < $expenses_date_count; $i++) {
                $set_data = array('expense_date' => trim(date("Y-m-d", strtotime($expenses_date[$i]))),
                    'type_id' => trim($expense_type[$i]),
                    'description' => trim($expense_description[$i]),
                    'amount' => trim($expense_amount[$i]),
                    'status' => trim($expense_status[$i])
                );

                $addExtraExpense = $this->report_model->addExtra_Expense($set_data);
            }
        }
    }

    public function monthly_report() {

        $this->load->view('includes/header');
        $this->load->view('report/monthlyReport');
        $this->load->view('includes/footer');
    }

    public function ajaxMonthlyReport() {

        if (($this->input->server('REQUEST_METHOD') == "POST")) {
            $monthdate = $this->input->post('monthdate');
            $ts = strtotime($monthdate);
            $total_dates = date('t', $ts) - 1;
            $start_date = date('Y-m-d', strtotime($monthdate));
            $end_date = date('Y-m-d', strtotime("+" . $total_dates . " days", strtotime($start_date)));

            $month_formats = date("M-y", strtotime($monthdate));

            $month_common_list = $this->report_model->month_common_List($start_date, $end_date);
//echo "<pre>";print_r($month_common_list);die;
            $month_extra_expense_list = $this->report_model->month_extra_expenseList($start_date, $end_date);
            $month_deliveredList = $this->report_model->month_deliveredList($start_date, $end_date);
            $month_paymentmodeList = $this->report_model->month_paymentmodeList($start_date, $end_date);

            $data = array('month_extra_expense_list' => $month_extra_expense_list,
                'month_deliveredList' => $month_deliveredList,
                'month_paymentmodeList' => $month_paymentmodeList,
                'month_common_list' => $month_common_list,
                'month_formats' => $month_formats
            );

            $this->load->view('report/ajaxmonthlyReport', $data);
        }
    }

    public function monthly_reportView() {

        $this->load->view('includes/header');
        $this->load->view('report/monthlyReportView');
        $this->load->view('includes/footer');
    }

    public function ajaxMonthlyReportView() {

        if (($this->input->server('REQUEST_METHOD') == "POST")) {
            $monthdate = $this->input->post('monthdate');
            $ts = strtotime($monthdate);
            $total_dates = date('t', $ts) - 1;
            $start_date = date('Y-m-d', strtotime($monthdate));
            $end_date = date('Y-m-d', strtotime("+" . $total_dates . " days", strtotime($start_date)));
            $month_formats = date("M-y", strtotime($monthdate));

            $month_viewReport_list = $this->report_model->month_report_view_List($start_date, $end_date);
//echo "<pre>";print_r($month_viewReport_list);die;
            $purchase_shop_details = $this->report_model->purchase_shop_list();
            $deliver_pickup_list = $this->report_model->deliver_pickup_list();
            $payment_mode_list = $this->report_model->payment_mode_list();
            $data = array("purchase_shop_details" => $purchase_shop_details,
                'deliver_pickup_list' => $deliver_pickup_list,
                'payment_mode_list' => $payment_mode_list,
                'month_viewReport_list' => $month_viewReport_list,
                'start_date' => $start_date,
                'end_date' => $end_date
            );


            $this->load->view('report/ajaxReportView', $data);
        }
    }

    public function generateviewReportExcel() {
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Report View');

        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth('10');
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth('20');
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth('20');
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth('20');
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth('10');
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth('10');
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth('10');
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth('20');
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth('10');
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth('20');
        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth('10');
        $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth('20');

        $this->excel->getActiveSheet()->setCellValue('A1', 'No');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Date');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Customer Name');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Item Description');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Purchased Shop');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Sold Price');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Purchased Price');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Deliver Cost');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Delivered / Pickup By');
        $this->excel->getActiveSheet()->setCellValue('j1', 'Net');
        $this->excel->getActiveSheet()->setCellValue('K1', 'Payment Mode');
        $this->excel->getActiveSheet()->setCellValue('L1', 'Cash Received');
        $this->excel->getActiveSheet()->setCellValue('M1', 'Status');

        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $month_viewReport_list = $this->report_model->month_report_view_List($start_date, $end_date);
        $purchase_shop_details = $this->report_model->purchase_shop_list();
        $deliver_pickup_list = $this->report_model->deliver_pickup_list();
        $payment_mode_list = $this->report_model->payment_mode_list();
        $x = 1;
        foreach ($month_viewReport_list as $key => $reports) {
            $x++;
            $this->excel->getActiveSheet()->setCellValue('A' . $x, $key + 1);
            $this->excel->getActiveSheet()->setCellValue('B' . $x, $reports['order_date']);
            $this->excel->getActiveSheet()->setCellValue('C' . $x, $reports['customer_name']);
            $this->excel->getActiveSheet()->setCellValue('D' . $x, $reports['item_description']);
            $purchase_name = '';
            foreach ($purchase_shop_details as $details) {
                if ($details['id'] == $reports['purchase_id']) {
                    $purchase_name = $details['name'];
                }
            }

            $this->excel->getActiveSheet()->setCellValue('E' . $x, $purchase_name);
            $this->excel->getActiveSheet()->setCellValue('F' . $x, "AED " . $reports['sold_price']);
            $this->excel->getActiveSheet()->setCellValue('G' . $x, "AED " . $reports['purchase_price']);
            $this->excel->getActiveSheet()->setCellValue('H' . $x, "AED " . $reports['deliver_cost']);

            $deliver_pickup_name = '';
            foreach ($deliver_pickup_list as $dList) {
                if ($dList['id'] == $reports['deliver_pickup_id']) {
                    $deliver_pickup_name = $dList['name'];
                }
            }

            $this->excel->getActiveSheet()->setCellValue('I' . $x, $deliver_pickup_name);
            $this->excel->getActiveSheet()->setCellValue('J' . $x, "AED " . $reports['net']);

            $payment_name = '';
            foreach ($payment_mode_list as $pList) {
                if ($pList['id'] == $reports['payment_id']) {
                    $payment_name = $pList['name'];
                }
            }

            $this->excel->getActiveSheet()->setCellValue('K' . $x, $payment_name);
            $this->excel->getActiveSheet()->setCellValue('L' . $x, "AED " . $reports['cash_received']);

            $status_name = '';
            if ($reports['status'] == "1") {
                $status_name = "Verified";
            } else {
                $status_name = "Unverified";
            }

            $this->excel->getActiveSheet()->setCellValue('M' . $x, $status_name);
        }
//Total Sale Value
        $total_last_cell = $x + 2;
        $this->excel->getActiveSheet()->getStyle('A' . $total_last_cell)->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A' . $total_last_cell)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('A' . $total_last_cell, 'Total Sale');
        $this->excel->getActiveSheet()->mergeCells('A' . $total_last_cell . ':L' . $total_last_cell);
        $this->excel->getActiveSheet()->setCellValue('M' . $total_last_cell, "AED 6772253.00");

//Daily Net Income
        $net_last_cell = $x + 3;
        $this->excel->getActiveSheet()->getStyle('A' . $net_last_cell)->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A' . $net_last_cell)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('A' . $net_last_cell, 'Daily Net Income');
        $this->excel->getActiveSheet()->mergeCells('A' . $net_last_cell . ':L' . $net_last_cell);
        $this->excel->getActiveSheet()->setCellValue('M' . $net_last_cell, "AED 6772253.00");

//Opening Balance
        $Obalance_last_cell = $x + 4;
        $this->excel->getActiveSheet()->getStyle('A' . $Obalance_last_cell)->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A' . $Obalance_last_cell)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('A' . $Obalance_last_cell, 'Opening Balance');
        $this->excel->getActiveSheet()->mergeCells('A' . $Obalance_last_cell . ':L' . $Obalance_last_cell);
        $this->excel->getActiveSheet()->setCellValue('M' . $Obalance_last_cell, "AED 0.00");

//Cash on Hand
        $CHand_last_cell = $x + 5;
        $this->excel->getActiveSheet()->getStyle('A' . $CHand_last_cell)->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A' . $CHand_last_cell)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('A' . $CHand_last_cell, 'Cash on Hand');
        $this->excel->getActiveSheet()->mergeCells('A' . $CHand_last_cell . ':L' . $CHand_last_cell);
        $this->excel->getActiveSheet()->setCellValue('M' . $CHand_last_cell, "AED 693.00");

//Money Deposited
        $MDeposit_last_cell = $x + 6;
        $this->excel->getActiveSheet()->getStyle('A' . $MDeposit_last_cell)->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A' . $MDeposit_last_cell)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('A' . $MDeposit_last_cell, 'Cash on Hand');
        $this->excel->getActiveSheet()->mergeCells('A' . $MDeposit_last_cell . ':L' . $MDeposit_last_cell);
        $this->excel->getActiveSheet()->setCellValue('M' . $MDeposit_last_cell, "AED 0.00");

//Closing Balance
        $closing_last_cell = $x + 7;
        $this->excel->getActiveSheet()->getStyle('A' . $closing_last_cell)->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A' . $closing_last_cell)->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('A' . $closing_last_cell, 'Closing Balance');
        $this->excel->getActiveSheet()->mergeCells('A' . $closing_last_cell . ':L' . $closing_last_cell);
        $this->excel->getActiveSheet()->setCellValue('M' . $closing_last_cell, "AED 0.00");

        $filename = 'ReportView.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        $objWriter->save('php://output');
    }

    public function generateviewReportCSV() {
        $this->load->helper('url');
        $this->load->helper('download');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        $this->load->dbutil();
        $delimiter = ",";

        $newline = "\r\n";

        $filename = "ReportView.csv";

        $query = "SELECT * FROM invoice WHERE order_date between '" . $start_date . "' and '" . $end_date . "'";

        $result = $this->db->query($query);

        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);

        force_download($filename, $data);
    }

    public function generateviewReportPDF() {

        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $month_viewReport_list = $this->report_model->month_report_view_List($start_date, $end_date);

        $purchase_shop_details = $this->report_model->purchase_shop_list();
        $deliver_pickup_list = $this->report_model->deliver_pickup_list();
        $payment_mode_list = $this->report_model->payment_mode_list();
        $data = array("purchase_shop_details" => $purchase_shop_details,
            'deliver_pickup_list' => $deliver_pickup_list,
            'payment_mode_list' => $payment_mode_list,
            'month_viewReport_list' => $month_viewReport_list,
            'start_date' => $start_date,
            'end_date' => $end_date
        );

        $file_name="Reports_".date('d-m-y').".pdf";
        $this->load->library('pdf');
        $this->pdf->set_paper(array(0, 0, 1841, 595), 'portrait');        
        $this->pdf->load_view('report/PDFReportView', $data, true);
        $this->pdf->render();
        $this->pdf->stream($file_name);
        
    }

}
