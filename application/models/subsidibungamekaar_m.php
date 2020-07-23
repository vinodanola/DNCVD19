<?php defined('BASEPATH') OR exit('No direct script access allowed');

class subsidibungamekaar_m extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function GET_LIST($d,$l){
        
        $this->db
            ->select(
                    'tbl_nasabah.regionid, max(tbl_nasabah.region) as region, '
                    . 'tbl_nasabah.areaid, max(tbl_nasabah.area) as area, '
                    . 'tbl_nasabah.cabangid, max(tbl_nasabah.cabang) as cabang, '
                    . 'tbl_nasabah.kelompokid, max(tbl_nasabah.kelompok) as kelompok, '
                    . 'max(tbl_nasabah.is_pencairandone) as is_pencairandone, '
                    . 'max(tbl_file.filesource) as filesource'
                    )
            ->from('tbl_nasabah')
            ->join('tbl_file', 'tbl_nasabah.kelompokid = tbl_file.kelompokid', 'left');
        
        if ($d['search']){
            $this->db
                ->like('tbl_nasabah.regionid',$d['search'])
                ->or_like('tbl_nasabah.region',$d['search'])
                ->or_like('tbl_nasabah.areaid',$d['search'])
                ->or_like('tbl_nasabah.area',$d['search'])
                ->or_like('tbl_nasabah.cabangid',$d['search'])
                ->or_like('tbl_nasabah.cabang',$d['search'])
                ->or_like('tbl_nasabah.kelompokid',$d['search'])
                ->or_like('tbl_nasabah.kelompok',$d['search'])
                ;
        }
        
        $this->db->group_by([
            'tbl_nasabah.regionid',
            'tbl_nasabah.areaid',
            'tbl_nasabah.cabangid',
            'tbl_nasabah.kelompokid'
        ]);
        
        if ($l!=FALSE) {
            return $this->db->count_all_results();    
        } else {
            $this->db->limit($d['limit'],$d['offset']);
            return $this->db->get()->result();
        }
        
    }
    
    public function GET_LIST_NASABAH_PER_KELOMPOK($d,$l){
        
        $this->db
            ->select('tbl_nasabah.*')
            ->from('tbl_nasabah')
            ->where(['kelompokid'=>$d['kelompokid']]);
        
        if ($l!=FALSE) {
            return $this->db->count_all_results();    
        } else {
            $this->db->limit($d['limit'],$d['offset']);
            return $this->db->get()->result();
        }
        
    }
    
    public function POST_UPLOAD_FORM($d){
        
        $myGetDate = $this->db->query('select getdate() as mygetdate')->result()[0]->mygetdate;
        
        $this->db->trans_begin();
     
        $this->db->insert('tbl_file', [
            'kelompokid' => $d['kelompokid'],
            'filesource' => $d['filename'],
            'createdate' => $myGetDate,
            'createdby'  => $this->session->signin['USERNAME']
        ]);
        
        foreach ($d['status_nasabah_list'] as $k => $v) {
            
            $this->db
                ->set('updatedby',$this->session->signin['USERNAME'])
                ->set('updateddate',$myGetDate)
                ->set('tanggalrealisasipencairan', $d['tanggalrealisasipencairan'])
                ->set('is_pencairandone', 'Y')
                ->set('status', $d['status_nasabah_list'][$k]->status)
                ->where('id', $d['status_nasabah_list'][$k]->id)
                ->update('tbl_nasabah');
            
        }
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            log_message('ERROR', $this->db->status());
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
        
    }
    
}