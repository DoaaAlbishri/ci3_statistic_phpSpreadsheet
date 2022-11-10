<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Statistics extends CI_Controller {
        public function index()
        {
            $data['title'] = 'All Statistic';

            $data['statistics'] = $this->statistic_model->get_top_customers();

            $data['orders'] = $this->statistic_model->get_orders();

            $data['customers'] = $this->statistic_model->get_best_customer();
           
            $data['orderDetails'] = $this->statistic_model->get_most_seller_products();
           
            $data['products'] = $this->statistic_model->get_products();
           
            $data['mostPopular'] = $this->statistic_model->get_most_popular_product();

            $data['quantities'] = $this->statistic_model->get_running_out();

            $data['allCustomers'] = $this->statistic_model->get_customers();


            

            $this->load->view('tamplates/header.php',$data);
            $this->load->view('statistics/index',$data);
            $this->load->view('tamplates/footer.php',$data);
        }

        public function createExcel() {
            $fileName = 'customers.xlsx';  
            $customersData = $this->statistic_model->get_customers();
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'customerID');
            $sheet->setCellValue('B1', 'customerName');
            $sheet->setCellValue('C1', 'address');
            $sheet->setCellValue('D1', 'PostalCode'); 
            $rows = 2;
            foreach ($customersData as $val){
                $sheet->setCellValue('A' . $rows, $val['customerID']);
                $sheet->setCellValue('B' . $rows, $val['customerName']);
                $sheet->setCellValue('C' . $rows, $val['address']);
                $sheet->setCellValue('D' . $rows, $val['PostalCode']);
                $rows++;
            } 
            $writer = new Xlsx($spreadsheet);
            $writer->save("uploads/".$fileName);
            header("Content-Type: application/vnd.ms-excel");
            redirect(base_url()."uploads/".$fileName);              
        }    

    }