<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report_m extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }
    
    public function GET_SALDO_DETAIL($d,$l){
        
        $this->db
            ->select( 'tbl_dashboard.bulantahun'
                    . ', tbl_dashboard.cabangid'
                    . ', tbl_dashboard.tanggalrealisasipencairan'
                    . ', tbl_dashboard.total_saldo'
                    . ', tbl_dashboard.total_subsidi_nominal'
                    . ', tbl_dashboard.total_subsidi_noa'
                    . ', tbl_dashboard.total_subsidi_nbl_nominal'
                    . ', tbl_dashboard.total_subsidi_nbl_noa'
                    . ', tbl_dashboard.total_subsidi_nl_nominal'
                    . ', tbl_dashboard.total_subsidi_nl_noa'
                    . ', tbl_dashboard.realisasi_nbl_cair_nominal'
                    . ', tbl_dashboard.realisasi_nbl_cair_noa'
                    . ', tbl_dashboard.realisasi_nbl_batal_nominal'
                    . ', tbl_dashboard.realisasi_nbl_batal_noa'
                    . ', tbl_dashboard.realisasi_nbl_blm_nominal'
                    . ', tbl_dashboard.realisasi_nbl_blm_noa'
                    . ', tbl_dashboard.realisasi_nl_cair_nominal'
                    . ', tbl_dashboard.realisasi_nl_cair_noa'
                    . ', tbl_dashboard.realisasi_nl_batal_nominal'
                    . ', tbl_dashboard.realisasi_nl_batal_noa'
                    . ', tbl_dashboard.realisasi_nl_blm_nominal'
                    . ', tbl_dashboard.realisasi_nl_blm_noa'
                    . ', tbl_dashboard.createddate')
            ->from('tbl_dashboard');
        
        if ($d['search']){
            $this->db
                ->or_like('tbl_dashboard.bulantahun',$d['search'])
                ->or_like('tbl_dashboard.cabangid',$d['search'])
                ->or_like('tbl_dashboard.tanggalrealisasipencairan',$d['search'])
                ->or_like('tbl_dashboard.total_saldo',$d['search'])
                ->or_like('tbl_dashboard.total_subsidi_nominal',$d['search'])
                ->or_like('tbl_dashboard.total_subsidi_noa',$d['search'])
                ->or_like('tbl_dashboard.total_subsidi_nbl_nominal',$d['search'])
                ->or_like('tbl_dashboard.total_subsidi_nbl_noa',$d['search'])
                ->or_like('tbl_dashboard.total_subsidi_nl_nominal',$d['search'])
                ->or_like('tbl_dashboard.total_subsidi_nl_noa',$d['search'])
                ->or_like('tbl_dashboard.realisasi_nbl_cair_nominal',$d['search'])
                ->or_like('tbl_dashboard.realisasi_nbl_cair_noa',$d['search'])
                ->or_like('tbl_dashboard.realisasi_nbl_batal_nominal',$d['search'])
                ->or_like('tbl_dashboard.realisasi_nbl_batal_noa',$d['search'])
                ->or_like('tbl_dashboard.realisasi_nbl_blm_nominal',$d['search'])
                ->or_like('tbl_dashboard.realisasi_nbl_blm_noa',$d['search'])
                ->or_like('tbl_dashboard.realisasi_nl_cair_nominal',$d['search'])
                ->or_like('tbl_dashboard.realisasi_nl_cair_noa',$d['search'])
                ->or_like('tbl_dashboard.realisasi_nl_batal_nominal',$d['search'])
                ->or_like('tbl_dashboard.realisasi_nl_batal_noa',$d['search'])
                ->or_like('tbl_dashboard.realisasi_nl_blm_nominal',$d['search'])
                ->or_like('tbl_dashboard.realisasi_nl_blm_noa',$d['search'])
                ->or_like('tbl_dashboard.createddate',$d['search'])
                ;
        }
        
        if ($l!=FALSE) {
            return $this->db->count_all_results();    
        } else {
            $this->db->limit($d['limit'],$d['offset']);
            return $this->db->get()->result();
        }
        
    }
    
}

