<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Welcome_m');
        $this->load->helper('url');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $data_signin = [
            'signin' => $this->input->get('sign_in'),
            'cabang' => $this->Welcome_m->GET_CABANG(),
            'tanggalrealisasi' => $this->Welcome_m->GET_TANGGAL_REALISASI()
        ];
        
        $this->load->view('head_v');
        
        if ($this->session->signin){
            $this->load->view('navbar_v');
            $this->load->view('welcome_v',$data_signin);
        } else {
            $this->load->view('login_v',$data_signin);
        }
        $this->load->view('footer_v');
    }
    
    public function index_bansos()
    {
        $data_signin = [
            'signin' => $this->input->get('sign_in')
        ];
        
        $this->load->view('head_v');
        
        if ($this->session->signin){
            $this->load->view('navbar_v');
            $this->load->view('welcomebansos_v',$data_signin);
        } else {
            $this->load->view('login_v',$data_signin);
        }
        $this->load->view('footer_v');
    }
    
    
    public function signin(){
        
        $u = $this->input->post('username');
        $p = $this->input->post('password');
        
        $DB = $this->load->database('db2',TRUE);
        
        //$Q = $DB->query("select top 1 * from mkr_users where username='".$u."' and password='".sha1(md5($p))."' ")->result_array();
        
        $Q = $DB->query("select top 1 * from mkr_users where username='".$u."'")->result_array();
        
        if (count($Q)==1) {
            $this->session->set_userdata('signin',[
                'MENU'      => ['M2'],
                'ID'        => $Q[0]['id'],
                'USERNAME'  => $Q[0]['username'], 
                'SDM_ID'    => $Q[0]['sdm_id'],
                'NAMA'      => $Q[0]['nama_depan'],
                'JABATAN'   => $Q[0]['nama_tengah']
            ]);
            redirect(base_url(), 'refresh');
        } else {
            redirect(base_url().'?sign_in=failed', 'refresh');
        }
        
    }
    
    public function signout(){
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }
    
    public function get_dashboard_data_api(){
        
        $R = [
            'status' => false,
            'message' => 'Failed',
            'data' => []
        ];

        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $cabang = $this->input->get('cabang');
        $wdate = $this->input->get('wdate');

        $d = [
            'periode' => $tahun.$bulan,
            'cabang' => $cabang,
            'wdate' => $wdate
        ];

        $Q = $this->Welcome_m->GET_DASHBOARD_DATA($d);

        if ($Q)
        {
          $R['status'] = true;
          $R['message'] = 'Data loaded';
          $R['data'] = $Q;
        }

        echo json_encode($R);
        
    }
    
}
