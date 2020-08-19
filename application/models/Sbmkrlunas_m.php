<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sbmkrlunas_m extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }
    
    public function GET_LIST($d,$l){
        
        $this->db
            ->select(
                    'tbl_nasabah_lunas.id, '
                    . 'tbl_nasabah_lunas.regionid, tbl_nasabah_lunas.region as region, '
                    . 'tbl_nasabah_lunas.areaid, tbl_nasabah_lunas.area as area, '
                    . 'tbl_nasabah_lunas.cabangid, tbl_nasabah_lunas.cabang as cabang, '
                    . 'tbl_nasabah_lunas.nasabahid, tbl_nasabah_lunas.nasabahnama as nasabahnama, '
                    . 'tbl_nasabah_lunas.is_pencairandone as is_pencairandone, '
                    . 'tbl_nasabah_lunas.bulan_subsidi_tahun_subsidi as bulan_subsidi_tahun_subsidi'
                    )
            ->from('tbl_nasabah_lunas');
        
        if ($d['search']){
            $this->db
                ->like('tbl_nasabah_lunas.regionid',$d['search'])
                ->or_like('tbl_nasabah_lunas.region',$d['search'])
                ->or_like('tbl_nasabah_lunas.areaid',$d['search'])
                ->or_like('tbl_nasabah_lunas.area',$d['search'])
                ->or_like('tbl_nasabah_lunas.cabangid',$d['search'])
                ->or_like('tbl_nasabah_lunas.cabang',$d['search'])
                ->or_like('tbl_nasabah_lunas.nasabahid',$d['search'])
                ->or_like('tbl_nasabah_lunas.nasabahnama',$d['search'])
                ->or_like('tbl_nasabah_lunas.bulan_subsidi_tahun_subsidi',$d['search'])
                ;
        }
        
        if ($l!=FALSE) {
            return $this->db->count_all_results();    
        } else {
            $this->db->limit($d['limit'],$d['offset']);
            return $this->db->get()->result();
        }
        
    }
    
    public function GET_NASABAH_DETAIL($d){
        
        $this->db
            ->select('*')
            ->from('tbl_nasabah_lunas')
            ->where('id',$d['id'])
            ->limit(1);
        
        return $this->db->get()->result();
        
    }
    
    public function POST_UPLOAD_FORM_LUNAS($d){
        
        $myGetDate = $this->db->query('select getdate() as mygetdate')->result()[0]->mygetdate;
        
        $this->db->trans_begin();
     
        $this->db->insert('tbl_file_lunas', [
            'usedid'     => $d['id'],
            'gid'        => $d['gid'],
            'filesource' => $d['filename'],
            'createdate' => $myGetDate,
            'createdby'  => $this->session->signin['USERNAME']
        ]);
        
        if ($d['statuspencairan']=='C'){
            $is_pencairandone = 'Y';
        } else {
            $is_pencairandone = 'N';
        }

        $this->db->insert('tbl_nasabah_lunas_realisasi_log', [
            'gid' => $d['gid'],
            'tbl_nasabah_lunas_id' => $d['id'],
            'status' => $d['statuspencairan'],
            'tanggalrealisasipencairan' => $d['tanggalrealisasipencairan'],
            'createdate' => $myGetDate,
            'createby' => $this->session->signin['USERNAME']
        ]);
            
        $this->db
            ->set('updatedby',$this->session->signin['USERNAME'])
            ->set('updateddate',$myGetDate)
            ->set('tanggalrealisasipencairan', $d['tanggalrealisasipencairan'])
            ->set('is_pencairandone', $is_pencairandone)
            ->set('status', $d['statuspencairan'])
            ->where('id', $d['id'])
            ->update('tbl_nasabah_lunas');
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            log_message('ERROR', $this->db->status());
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
        
    }
	
    public function GET_TANGGAL_REALISASI($d){

        $DB = $this->load->database('db3',TRUE);

        $BranchId = $this->db->query("select top 1 * from tbl_nasabah_lunas where id='".$d['id']."'")->result()[0]->cabangid;

        return $DB->query("select top 1 *, format(SODDate,'dd/MM/yyyy') as SODDateWithFormat from t_SystemBranchStatus where OurBranchID='".$BranchId."'")->result_array();
    }
    
    public function GET_DETAIL_REALISASI_LOG($d,$l){
        
        $this->db
            ->select('tbl_nasabah_lunas_realisasi_log.gid'
                    . ', max(tbl_nasabah_lunas_realisasi_log.tbl_nasabah_lunas_id) as tbl_nasabah_lunas_id'
                    . ', max(tbl_nasabah_lunas_realisasi_log.tanggalrealisasipencairan) as tanggalrealisasipencairan'
                    . ', max(tbl_file_lunas.filesource) as filesource')
            ->from('tbl_nasabah_lunas_realisasi_log')
            ->join('tbl_file_lunas', 'tbl_nasabah_lunas_realisasi_log.gid = tbl_file_lunas.gid', 'left')
            ->where(['tbl_nasabah_lunas_realisasi_log.tbl_nasabah_lunas_id'=>$d['id']]);
        
        $this->db->group_by([
            'tbl_nasabah_lunas_realisasi_log.gid'
        ]);
        
        if ($l!=FALSE) {
            return $this->db->count_all_results();    
        } else {
            $this->db->limit($d['limit'],$d['offset']);
            return $this->db->get()->result();
        }
        
    }
    
}