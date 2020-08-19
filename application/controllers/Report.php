<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Report_m');
        $this->load->helper('url');
        date_default_timezone_set("Asia/Jakarta");
    }
    
    public function saldo_detail(){
        
        $data_signin = [
            'signin' => $this->input->get('sign_in')
        ];
        
        $this->load->view('head_v');
        
        if ($this->session->signin){
            $this->load->view('navbar_v');
            $this->load->view('report_saldo_detail_v');
        } else {
            $this->load->view('login_v',$data_signin);
        }
        $this->load->view('footer_v');
        
    }
    
    public function get_saldo_detail_api(){
        
        $R = [
            'offset' =>((int)$_POST['start']),
            'limit' => (int)$_POST['length'],
            'search' => $_POST['search']['value'],
            'draw' =>  $this->input->post('draw')
        ];
        
        $h = $this->Report_m->GET_SALDO_DETAIL($R,FALSE);
        
        $D = [];
        if ($h) {

            for($i=0; $i<count($h); $i++)
            {
                $Ra = [
                     'bulantahun' => $h[$i]->bulantahun
                    ,'cabangid' => $h[$i]->cabangid
                    ,'tanggalrealisasipencairan' => $h[$i]->tanggalrealisasipencairan
                    ,'total_saldo' => $h[$i]->total_saldo
                    ,'total_subsidi_nominal' => $h[$i]->total_subsidi_nominal
                    ,'total_subsidi_noa' => $h[$i]->total_subsidi_noa
                    ,'total_subsidi_nbl_nominal' => $h[$i]->total_subsidi_nbl_nominal
                    ,'total_subsidi_nbl_noa' => $h[$i]->total_subsidi_nbl_noa
                    ,'total_subsidi_nl_nominal' => $h[$i]->total_subsidi_nl_nominal
                    ,'total_subsidi_nl_noa' => $h[$i]->total_subsidi_nl_noa
                    ,'realisasi_nbl_cair_nominal' => $h[$i]->realisasi_nbl_cair_nominal
                    ,'realisasi_nbl_cair_noa' => $h[$i]->realisasi_nbl_cair_noa
                    ,'realisasi_nbl_batal_nominal' => $h[$i]->realisasi_nbl_batal_nominal
                    ,'realisasi_nbl_batal_noa' => $h[$i]->realisasi_nbl_batal_noa
                    ,'realisasi_nbl_blm_nominal' => $h[$i]->realisasi_nbl_blm_nominal
                    ,'realisasi_nbl_blm_noa' => $h[$i]->realisasi_nbl_blm_noa
                    ,'realisasi_nl_cair_nominal' => $h[$i]->realisasi_nl_cair_nominal
                    ,'realisasi_nl_cair_noa' => $h[$i]->realisasi_nl_cair_noa
                    ,'realisasi_nl_batal_nominal' => $h[$i]->realisasi_nl_batal_nominal
                    ,'realisasi_nl_batal_noa' => $h[$i]->realisasi_nl_batal_noa
                    ,'realisasi_nl_blm_nominal' => $h[$i]->realisasi_nl_blm_nominal
                    ,'realisasi_nl_blm_noa' => $h[$i]->realisasi_nl_blm_noa
                    ,'createddate' => $h[$i]->createddate
                ];
                array_push($D, $Ra);
            }
        }
        
        $R['recordsTotal'] = $this->Report_m->GET_SALDO_DETAIL($R,TRUE);
        $R['recordsFiltered'] = $this->Report_m->GET_SALDO_DETAIL($R,TRUE);
        $R['data'] = $D;
        
        echo json_encode($R);
        
    }
    
}

