<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bansos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Bansos_m');
        $this->load->helper('url');
        date_default_timezone_set("Asia/Jakarta");
    }
    
    public function per_nasabah()
    {
        $data_signin = [
            'signin' => $this->input->get('sign_in')
        ];
        
        $this->load->view('head_v');
        
        if ($this->session->signin){
            $this->load->view('navbar_v');
            $this->load->view('bansos_v');
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
        
        $h = $this->Bansos_m->GET_LIST($R,FALSE);
        
        $D = [];
        if ($h) {

            for($i=0; $i<count($h); $i++)
            {
                $Ra = [
                    'id' => $h[$i]->id,
                    'regionid' => $h[$i]->regionid,
                    'region' => $h[$i]->region,
                    'regioncombine' => $h[$i]->regionid . ' - ' . $h[$i]->region,
                    'areaid' => $h[$i]->areaid,
                    'area' => $h[$i]->area,
                    'areacombine' => $h[$i]->areaid . ' - ' . $h[$i]->area,
                    'cabangid' => $h[$i]->cabangid,
                    'cabang' => $h[$i]->cabang,
                    'cabangcombine' => $h[$i]->cabangid . ' - ' . $h[$i]->cabang,
                    'kelompokid' => $h[$i]->kelompokid,
                    'kelompok' => $h[$i]->kelompok,
                    'nasabahid' => $h[$i]->nasabahid,
                    'nasabahnama' => $h[$i]->nasabahnama,
                    'norek' => $h[$i]->norek,
                    'is_pencairandone' => $h[$i]->is_pencairandone,
                    'is_pencairandone_desc' => $h[$i]->is_pencairandone=='Y' ? 'SELESAI' : 'BELUM SELESAI'
                ];
                array_push($D, $Ra);
            }
        }
        
        $R['recordsTotal'] = $this->Bansos_m->GET_LIST($R,TRUE);
        $R['recordsFiltered'] = $this->Bansos_m->GET_LIST($R,TRUE);
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

        $Q = $this->Bansos_m->GET_NASABAH_DETAIL($d);

        if ($Q)
        {
          $R['status'] = true;
          $R['message'] = 'Data loaded';
          $R['data'] = $Q;
        }

        echo json_encode($R);
        
    }
    
    public function post_upload_form_bansos_api()
    {
        $R = [
            'myfile'                => $_FILES["file"],
            'statuspencairan'       => $this->input->post('statuspencairan'),
            'id'                    => $this->input->post('id'),
            'status'                => 'error',
            'gid'                   => generate_string()
        ];
        
        /* Start Validation */
        
        if ($R['id'] == ''){
            $R['status'] = 'error';
            $R['message'] = 'Id tidak boleh kosong';
        } else if (explode(".", strtolower($R['myfile']['name']))[1]!='pdf') {
            $R['status'] = 'error';
            $R['message'] = 'Format file harus pdf';
            
        /* End Validation */
        } else {
            
            $Rdate = gmdate('Ymdhis');

            $R['filename'] = $R['id'].'__'.$Rdate.'.'.explode(".", strtolower($R['myfile']['name']))[1];

            $R['uploaddir'] = $this->config->item('base_upload_file_dir').'bansos/'.$R['filename'];

            if (move_uploaded_file($R['myfile']['tmp_name'], $R['uploaddir'])) {

                $R['message'] = "File berhasil di upload ";

                if ($this->Bansos_m->POST_UPLOAD_FORM_BANSOS($R)){

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
        
        $h = $this->Bansos_m->GET_DETAIL_REALISASI_LOG($R,FALSE);
        
        $D = [];
        if ($h) {

            for($i=0; $i<count($h); $i++)
            {
                $Ra = [
                    'gid' => $h[$i]->gid,
                    'createddate' => $h[$i]->createddate,
                    'filesource' => $h[$i]->filesource,
                    'tbl_bansos_nasabah_id' => $h[$i]->tbl_bansos_nasabah_id
                ];
                array_push($D, $Ra);
            }
        }
        
        $R['recordsTotal'] = $this->Bansos_m->GET_DETAIL_REALISASI_LOG($R,TRUE);
        $R['recordsFiltered'] = $this->Bansos_m->GET_DETAIL_REALISASI_LOG($R,TRUE);
        $R['data'] = $D;
        
        echo json_encode($R);
        
    }
    
    public function per_kelompok()
    {
        $data_signin = [
            'signin' => $this->input->get('sign_in')
        ];
        
        $this->load->view('head_v');
        
        if ($this->session->signin){
            $this->load->view('navbar_v');
            $this->load->view('bansosperkelompok_v');
        } else {
            $this->load->view('login_v',$data_signin);
        }
        $this->load->view('footer_v');
    }
    
    public function list_per_kelompok_api()
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
        
        $h = $this->Bansos_m->GET_LIST_PER_KELOMPOK($R,FALSE);
        
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
                    'kelompokid' => $h[$i]->kelompokid,
                    'kelompok' => $h[$i]->kelompok
                ];
                array_push($D, $Ra);
            }
        }
        
        $R['recordsTotal'] = $this->Bansos_m->GET_LIST_PER_KELOMPOK($R,TRUE);
        $R['recordsFiltered'] = $this->Bansos_m->GET_LIST_PER_KELOMPOK($R,TRUE);
        $R['data'] = $D;
        
        echo json_encode($R);
    }
    
    
    
}
