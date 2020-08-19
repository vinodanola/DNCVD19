<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subsidibungamekaar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Subsidibungamekaar_m');
        $this->load->helper('url');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function per_kelompok()
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
    
    public function per_nasabah()
    {
        $data_signin = [
            'signin' => $this->input->get('sign_in')
        ];
        
        $this->load->view('head_v');
        
        if ($this->session->signin){
            $this->load->view('navbar_v');
            $this->load->view('subsidibungamekaar_pernasabah_v');
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
        
        $h = $this->Subsidibungamekaar_m->GET_LIST($R,FALSE);
        
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
                    'bulan_subsidi_tahun_subsidi' => $h[$i]->bulan_subsidi_tahun_subsidi
                ];
                array_push($D, $Ra);
            }
        }
        
        $R['recordsTotal'] = $this->Subsidibungamekaar_m->GET_LIST($R,TRUE);
        $R['recordsFiltered'] = $this->Subsidibungamekaar_m->GET_LIST($R,TRUE);
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
            'kelompokid' => $this->input->post('kelompokid'),
            'bulan_subsidi_tahun_subsidi' => $this->input->post('bulan_subsidi_tahun_subsidi')
        ];
        
        $h = $this->Subsidibungamekaar_m->GET_LIST_NASABAH_PER_KELOMPOK($R,FALSE);
        
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
        
        /* start get working date */
        $R['status_nasabah_list'][0]->id = $h[0]->id;
        $R['workingdate'] = $this->Subsidibungamekaar_m->GET_TANGGAL_REALISASI($R)[0]['SODDateWithFormat'];
        /* end get working date */
        
        $R['recordsTotal'] = $this->Subsidibungamekaar_m->GET_LIST_NASABAH_PER_KELOMPOK($R,TRUE);
        $R['recordsFiltered'] = $this->Subsidibungamekaar_m->GET_LIST_NASABAH_PER_KELOMPOK($R,TRUE);
        $R['data'] = $D;
        
        echo json_encode($R);
    }
    
    
    public function post_upload_form_api()
    {
        $R = [
            'myfile'                => $_FILES["file"],
            'status_nasabah_list'   => json_decode($this->input->post('status_nasabah_list')),
            'kelompokid'            => $this->input->post('kelompokid'),
            'bulan_subsidi_tahun_subsidi' => $this->input->post('bulan_subsidi_tahun_subsidi'),
            //'tanggalrealisasipencairan' => $this->input->post('tanggalrealisasipencairan'),
            'status'                => 'error',
            'gid'                  => generate_string()
        ];
		
        $R['tanggalrealisasipencairan'] = $this->Subsidibungamekaar_m->GET_TANGGAL_REALISASI($R)[0]['SODDate'];
        
        /* Start Validation */
        
        if (explode(".", strtolower($R['myfile']['name']))[1]!='pdf') {
            $R['status'] = 'error';
            $R['message'] = 'Format file harus pdf';
        } else if (validateDate($R['tanggalrealisasipencairan']) == false){
            $R['status'] = 'error';
            $R['message'] = 'Tanggal realisasi pencairan harus diisi';
        } else if ($R['kelompokid']=='' || $R['kelompokid']=='undefined'){
            $R['status'] = 'error';
            $R['message'] = 'Kelompok id tidak boleh kosong';
        } else if ($R['bulan_subsidi_tahun_subsidi']=='' || $R['bulan_subsidi_tahun_subsidi']=='undefined'){
            $R['status'] = 'error';
            $R['message'] = 'Bulan dan Tahun tidak boleh kosong';
        /* End Validation */
        } else {
            
            $Rdate = gmdate('Ymdhis');

            $R['filename'] = $R['kelompokid'].'__'.$R['bulan_subsidi_tahun_subsidi'].'__'.$Rdate.'.'.explode(".", strtolower($R['myfile']['name']))[1];

            $R['uploaddir'] = $this->config->item('base_upload_file_dir').'nasabahbelumlunas/'.$R['filename'];

            if (move_uploaded_file($R['myfile']['tmp_name'], $R['uploaddir'])) {

                $R['message'] = "File berhasil di upload ";

                if ($this->Subsidibungamekaar_m->POST_UPLOAD_FORM($R)){

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
            'kelompokid' => $this->input->post('kelompokid'),
            'bulan_subsidi_tahun_subsidi' => $this->input->post('bulan_subsidi_tahun_subsidi')
        ];
        
        $h = $this->Subsidibungamekaar_m->GET_DETAIL_REALISASI_LOG($R,FALSE);
        
        $D = [];
        if ($h) {

            for($i=0; $i<count($h); $i++)
            {
                $Ra = [
                    'gid' => $h[$i]->gid,
                    'tanggalrealisasipencairan' => $h[$i]->tanggalrealisasipencairan,
                    'kelompokid' => $h[$i]->kelompokid,
                    'bulan_subsidi_tahun_subsidi' => $h[$i]->bulan_subsidi_tahun_subsidi,
                    'filesource' => $h[$i]->filesource
                ];
                array_push($D, $Ra);
            }
        }
        
        $R['recordsTotal'] = $this->Subsidibungamekaar_m->GET_DETAIL_REALISASI_LOG($R,TRUE);
        $R['recordsFiltered'] = $this->Subsidibungamekaar_m->GET_DETAIL_REALISASI_LOG($R,TRUE);
        $R['data'] = $D;
        
        echo json_encode($R);
        
    }
    
    public function list_per_nasabah_api(){
        
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
        
        $h = $this->Subsidibungamekaar_m->GET_LIST_PER_NASABAH($R,FALSE);
        
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
                    'kelompok' => $h[$i]->kelompok,
                    'nasabahid' => $h[$i]->nasabahid,
                    'nasabahnama' => $h[$i]->nasabahnama,
                    'is_pencairandone' => $h[$i]->is_pencairandone,
                    'is_pencairandone_desc' => $h[$i]->is_pencairandone=='Y' ? 'SELESAI' : 'BELUM SELESAI',
                    'bulan_subsidi_tahun_subsidi' => $h[$i]->bulan_subsidi_tahun_subsidi,
                    'jumlah_subsidi' => $h[$i]->jumlah_subsidi
                ];
                array_push($D, $Ra);
            }
        }
        
        $R['recordsTotal'] = $this->Subsidibungamekaar_m->GET_LIST_PER_NASABAH($R,TRUE);
        $R['recordsFiltered'] = $this->Subsidibungamekaar_m->GET_LIST_PER_NASABAH($R,TRUE);
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

        $Q = $this->Subsidibungamekaar_m->GET_NASABAH_DETAIL($d);
        
        /* start get working date */
        $R['status_nasabah_list'][0]->id = $id;
        $R['workingdate'] = $this->Subsidibungamekaar_m->GET_TANGGAL_REALISASI($R)[0]['SODDateWithFormat'];
        /* end get working date */

        if ($Q)
        {
          $R['status'] = true;
          $R['message'] = 'Data loaded';
          $R['data'] = $Q;
        }

        echo json_encode($R);
        
    }
    
    public function list_detail_realisasi_per_nasabah(){
        
        $R = [
            'offset' =>((int)$_POST['start']),
            'limit' => (int)$_POST['length'],
            'search' => $_POST['search']['value'],
            'draw' =>  $this->input->post('draw'),
            'id' => $this->input->post('id')
        ];
        
        $h = $this->Subsidibungamekaar_m->GET_DETAIL_REALISASI_PER_NASABAH_LOG($R,FALSE);
        
        $D = [];
        if ($h) {

            for($i=0; $i<count($h); $i++)
            {
                $Ra = [
                    'gid' => $h[$i]->gid,
                    'id' => $h[$i]->tbl_nasabah_id,
                    'tanggalrealisasipencairan' => $h[$i]->tanggalrealisasipencairan,
                    'filesource' => $h[$i]->filesource,
                    'kelompokid' => $h[$i]->kelompokid,
                    'bulan_subsidi_tahun_subsidi' => $h[$i]->bulan_subsidi_tahun_subsidi
                ];
                array_push($D, $Ra);
            }
        }
        
        $R['recordsTotal'] = $this->Subsidibungamekaar_m->GET_DETAIL_REALISASI_PER_NASABAH_LOG($R,TRUE);
        $R['recordsFiltered'] = $this->Subsidibungamekaar_m->GET_DETAIL_REALISASI_PER_NASABAH_LOG($R,TRUE);
        $R['data'] = $D;
        
        echo json_encode($R);
        
    }
    
}