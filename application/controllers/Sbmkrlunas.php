<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sbmkrlunas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sbmkrlunas_m');
        $this->load->helper('url');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $data_signin = [
            'signin' => $this->input->get('sign_in')
        ];
        
        $this->load->view('head_v');
        
        if ($this->session->signin){
            $this->load->view('navbar_v');
            $this->load->view('sbmkrlunas_v');
        } else {
            $this->load->view('login_v',$data_signin);
        }
        $this->load->view('footer_v');
    }
    
    public function list_api()
    {
        //if (!$this->session->signin) exit();
        
        $R = [
            'offset' =>((int)$_POST['start']),
            'limit' => (int)$_POST['length'],
            'search' => $_POST['search']['value'],
            'draw' =>  $this->input->post('draw'),
            'regionid' => $this->input->post('regionid'),
            'region' => $this->input->post('region'),
            'areaid' => $this->input->post('areaid'),
            'area' => $this->input->post('area'),
            'cabangid' => $this->input->post('cabangid'),
            'cabang' => $this->input->post('cabang'),
        ];
        
        $h = $this->Sbmkrlunas_m->GET_LIST($R,FALSE);
        
        $D = [];
        if ($h) {

            for($i=0; $i<count($h); $i++)
            {
                $Ra = [
                    'id' => $h[$i]->id,
                    'regionid' => $h[$i]->regionid,
                    'region' => $h[$i]->region,
                    'areaid' => $h[$i]->areaid,
                    'area' => $h[$i]->area,
                    'cabangid' => $h[$i]->cabangid,
                    'cabang' => $h[$i]->cabang,
                    'nasabahid' => $h[$i]->nasabahid,
                    'nasabahnama' => $h[$i]->nasabahnama,
                    'bulan_subsidi_tahun_subsidi' => $h[$i]->bulan_subsidi_tahun_subsidi,
                    'is_pencairandone' => $h[$i]->is_pencairandone,
                    'is_pencairandone_desc' => $h[$i]->is_pencairandone=='Y' ? 'SELESAI' : 'BELUM SELESAI',
                    'filesource' => $h[$i]->filesource,
                ];
                array_push($D, $Ra);
            }
        }
        
        $R['recordsTotal'] = $this->Sbmkrlunas_m->GET_LIST($R,TRUE);
        $R['recordsFiltered'] = $this->Sbmkrlunas_m->GET_LIST($R,TRUE);
        $R['data'] = $D;
        
        echo json_encode($R);
    }
    
    public function get_nasabah_detail(){
        
        $R = [
            'status' => false,
            'message' => 'Failed',
            'data' => []
        ];

        $id = $this->input->get('id');

        $d = [
          'id' => $id
        ];

        $Q = $this->Sbmkrlunas_m->GET_NASABAH_DETAIL($d);
        
        $R['workingdate'] = $this->Sbmkrlunas_m->GET_TANGGAL_REALISASI($d)[0]['SODDateWithFormat'];

        if ($Q)
        {
          $R['status'] = true;
          $R['message'] = 'Data loaded';
          $R['data'] = $Q;
        }

        echo json_encode($R);
        
    }
    
    public function post_upload_form_lunas_api()
    {
        $R = [
            'myfile'                => $_FILES["file"],
            'statuspencairan'       => $this->input->post('statuspencairan'),
            'id'                    => $this->input->post('id'),
            //'tanggalrealisasipencairan' => $this->input->post('tanggalrealisasipencairan'),
            'status'                => 'error',
            'gid'                   => generate_string()
        ];
		
        $R['tanggalrealisasipencairan'] = $this->Sbmkrlunas_m->GET_TANGGAL_REALISASI($R)[0]['SODDate'];
        
        /* Start Validation */
        
        if ($R['id'] == ''){
            $R['status'] = 'error';
            $R['message'] = 'Id tidak boleh kosong';
        } else if (explode(".", strtolower($R['myfile']['name']))[1]!='pdf') {
            $R['status'] = 'error';
            $R['message'] = 'Format file harus pdf';
        } else if (validateDate($R['tanggalrealisasipencairan']) == false){
            $R['status'] = 'error';
            $R['message'] = 'Tanggal realisasi pencairan harus diisi';
            
        /* End Validation */
        } else {
            
            $Rdate = gmdate('Ymdhis');

            $R['filename'] = $R['id'].'__'.$Rdate.'.'.explode(".", strtolower($R['myfile']['name']))[1];

            $R['uploaddir'] = $this->config->item('base_upload_file_dir').'nasabahlunas/'.$R['filename'];

            if (move_uploaded_file($R['myfile']['tmp_name'], $R['uploaddir'])) {

                $R['message'] = "File berhasil di upload ";

                if ($this->Sbmkrlunas_m->POST_UPLOAD_FORM_LUNAS($R)){

                    $R['status'] = 'success';

                    $R['message'] = $R['message'] . ' dan data berhasil disimpan.';

                } else {
                    $R['status'] = 'error';

                    $R['message'] = 'Data gagal disimpan.';
                }

            } else {
                $R['status'] = 'error';
                $R['message'] = "File gagal diupload. Silahkan periksa kembali file yang di upload.";
            }
        
        }
        
        echo json_encode($R);
        
    }
    
    public function list_detail_realisasi(){
        
        $R = [
            'offset' =>((int)$_POST['start']),
            'limit' => (int)$_POST['length'],
            'search' => $_POST['search']['value'],
            'draw' =>  $this->input->post('draw'),
            'id' => $this->input->post('id')
        ];
        
        $h = $this->Sbmkrlunas_m->GET_DETAIL_REALISASI_LOG($R,FALSE);
        
        $D = [];
        if ($h) {

            for($i=0; $i<count($h); $i++)
            {
                $Ra = [
                    'gid' => $h[$i]->gid,
                    'id' => $h[$i]->tbl_nasabah_lunas_id,
                    'tanggalrealisasipencairan' => $h[$i]->tanggalrealisasipencairan,
                    'filesource' => $h[$i]->filesource
                ];
                array_push($D, $Ra);
            }
        }
        
        $R['recordsTotal'] = $this->Sbmkrlunas_m->GET_DETAIL_REALISASI_LOG($R,TRUE);
        $R['recordsFiltered'] = $this->Sbmkrlunas_m->GET_DETAIL_REALISASI_LOG($R,TRUE);
        $R['data'] = $D;
        
        echo json_encode($R);
        
    }
    
}

