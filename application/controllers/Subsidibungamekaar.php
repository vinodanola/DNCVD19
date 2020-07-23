<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subsidibungamekaar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('subsidibungamekaar_m');
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
            $this->load->view('subsidibungamekaar_v');
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
            'region' => $this->input->post('regionid'),
            'areaid' => $this->input->post('regionid'),
            'area' => $this->input->post('regionid'),
            'cabangid' => $this->input->post('regionid'),
            'cabang' => $this->input->post('regionid'),
        ];
        
        $h = $this->subsidibungamekaar_m->GET_LIST($R,FALSE);
        
        $D = [];
        if ($h) {

            for($i=0; $i<count($h); $i++)
            {
                $Ra = [
                    'regionid' => $h[$i]->regionid,
                    'region' => $h[$i]->region,
                    'areaid' => $h[$i]->areaid,
                    'area' => $h[$i]->area,
                    'cabangid' => $h[$i]->cabangid,
                    'cabang' => $h[$i]->cabang,
                    'kelompokid' => $h[$i]->kelompokid,
                    'kelompok' => $h[$i]->kelompok,
                    'is_pencairandone' => $h[$i]->is_pencairandone,
                    'is_pencairandone_desc' => $h[$i]->is_pencairandone=='Y' ? 'SELESAI' : 'BELUM SELESAI',
                    'filesource' => $h[$i]->filesource,
                ];
                array_push($D, $Ra);
            }
        }
        
        $R['recordsTotal'] = $this->subsidibungamekaar_m->GET_LIST($R,TRUE);
        $R['recordsFiltered'] = $this->subsidibungamekaar_m->GET_LIST($R,TRUE);
        $R['data'] = $D;
        
        echo json_encode($R);
    }
    
    public function list_nasabah_per_kelompok_api()
    {
        $R = [
            'offset' =>((int)$_POST['start']),
            'limit' => (int)$_POST['length'],
            'search' => $_POST['search']['value'],
            'draw' =>  $this->input->post('draw'),
            'kelompokid' => $this->input->post('kelompokid')
        ];
        
        $h = $this->subsidibungamekaar_m->GET_LIST_NASABAH_PER_KELOMPOK($R,FALSE);
        
        $D = [];
        if ($h) {

            for($i=0; $i<count($h); $i++)
            {
                $Ra = [
                    'id' => $h[$i]->id,
                    'nasabahid' => $h[$i]->nasabahid,
                    'nasabahnama' => $h[$i]->nasabahnama
                ];
                array_push($D, $Ra);
            }
        }
        
        $R['recordsTotal'] = $this->subsidibungamekaar_m->GET_LIST_NASABAH_PER_KELOMPOK($R,TRUE);
        $R['recordsFiltered'] = $this->subsidibungamekaar_m->GET_LIST_NASABAH_PER_KELOMPOK($R,TRUE);
        $R['data'] = $D;
        
        echo json_encode($R);
    }
    
    
    public function post_upload_form_api()
    {
        $R = [
            'myfile'                => $_FILES["file"],
            'status_nasabah_list'   => json_decode($this->input->post('status_nasabah_list')),
            'kelompokid'            => $this->input->post('kelompokid'),
            'tanggalrealisasipencairan' => $this->input->post('tanggalrealisasipencairan'),
            'status'                => 'error'
        ];
        
        /* Start Validation */
        
        if (explode(".", strtolower($R['myfile']['name']))[1]!='pdf') {
            $R['status'] = 'error';
            $R['message'] = 'Format file harus pdf';
        } else if (validateDate($R['tanggalrealisasipencairan']) == false){
            $R['status'] = 'error';
            $R['message'] = 'Tanggal realisasi pencairan harus diisi';
            
        /* End Validation */
        } else {
            
            $Rdate = gmdate('Ymdhis');

            $R['filename'] = $R['kelompokid'].'__'.$Rdate.'.'.explode(".", strtolower($R['myfile']['name']))[1];

            $R['uploaddir'] = $_SERVER['DOCUMENT_ROOT'].'SubsidiBunga/assets/files/'.$R['filename'];

            if (move_uploaded_file($R['myfile']['tmp_name'], $R['uploaddir'])) {

                $R['message'] = "File berhasil di upload ";

                if ($this->subsidibungamekaar_m->POST_UPLOAD_FORM($R)){

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
    
}