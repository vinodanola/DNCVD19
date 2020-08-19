<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_m extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }
    
    public function GET_DASHBOARD_DATA($d){
        
        $this->db
            ->select('*')
            ->from('tbl_dashboard')
            ->where('bulantahun',$d['periode'])
            ->where('cabangid',$d['cabang']) 
            ->where("isnull(tanggalrealisasipencairan,'')",$d['wdate'])
            ->limit(1);
        
        return $this->db->get()->result();
        
    }
    
    public function GET_CABANG(){
        
        $DB = $this->load->database('db3',TRUE);
        
        $DB
            ->select('*')
            ->from('t_SystemBranchSetting')
            ->where("BranchStatusID='A' AND (OurBranchID like '9%' OR OurBranchID like '00000')")
            ->order_by('OurBranchID', 'ASC');
        
        return $DB->get()->result();
        
    }
    
    public function GET_TANGGAL_REALISASI(){
        
        $this->db
            ->select('tanggalrealisasipencairan')
            ->from('tbl_dashboard')
            //->where('tanggalrealisasipencairan is not null')
            ->group_by(tanggalrealisasipencairan);
        
        return $this->db->get()->result();
        
    }
    
}

