<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bansos_m extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }
    
    public function GET_LIST($d,$l){
        
        $this->db
            ->select('tbl_bansos_nasabah.* ')
            ->from('tbl_bansos_nasabah');
        
        if ($d['search']){
            $this->db
                ->like('tbl_bansos_nasabah.regionid',$d['search'])
                ->or_like('tbl_bansos_nasabah.region',$d['search'])
                ->or_like('tbl_bansos_nasabah.areaid',$d['search'])
                ->or_like('tbl_bansos_nasabah.area',$d['search'])
                ->or_like('tbl_bansos_nasabah.cabangid',$d['search'])
                ->or_like('tbl_bansos_nasabah.cabang',$d['search'])
                ->or_like('tbl_bansos_nasabah.kelompokid',$d['search'])
                ->or_like('tbl_bansos_nasabah.kelompok',$d['search'])
                ->or_like('tbl_bansos_nasabah.nasabahid',$d['search'])
                ->or_like('tbl_bansos_nasabah.nasabahnama',$d['search'])
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
            ->from('tbl_bansos_nasabah')
            ->where('id',$d['id'])
            ->limit(1);
        
        return $this->db->get()->result();
        
    }
    
    public function POST_UPLOAD_FORM_BANSOS($d){
        
        $myGetDate = $this->db->query('select getdate() as mygetdate')->result()[0]->mygetdate;
        
        $this->db->trans_begin();
        
        $this->db
            ->set('active',0)
            ->where('usedid', $d['id'])
            ->update('tbl_bansos_file');
        
        $this->db
            ->set('active',0)
            ->where('tbl_bansos_nasabah_id', $d['id'])
            ->update('tbl_bansos_nasabah_realisasi_log');
     
        $this->db->insert('tbl_bansos_file', [
            'usedid'     => $d['id'],
            'gid'        => $d['gid'],
            'filesource' => $d['filename'],
            'createddate' => $myGetDate,
            'createdby'  => $this->session->signin['USERNAME']
        ]);
        
        if ($d['statuspencairan']=='C'){
            $is_pencairandone = 'Y';
        } else {
            $is_pencairandone = 'N';
        }

        $this->db->insert('tbl_bansos_nasabah_realisasi_log', [
            'gid' => $d['gid'],
            'tbl_bansos_nasabah_id' => $d['id'],
            'status' => $d['statuspencairan'],
            'createddate' => $myGetDate,
            'createdby' => $this->session->signin['USERNAME']
        ]);
            
        $this->db
            ->set('updatedby',$this->session->signin['USERNAME'])
            ->set('updateddate',$myGetDate)
            ->set('is_pencairandone', $is_pencairandone)
            ->set('status', $d['statuspencairan'])
            ->where('id', $d['id'])
            ->update('tbl_bansos_nasabah');
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            log_message('ERROR', $this->db->status());
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
        
    }
    
    public function GET_DETAIL_REALISASI_LOG($d,$l){
        
        $this->db
            ->select('tbl_bansos_nasabah_realisasi_log.gid'
                    . ', max(tbl_bansos_nasabah_realisasi_log.tbl_bansos_nasabah_id) as tbl_bansos_nasabah_id'
                    . ', max(tbl_bansos_file.filesource) as filesource'
                    . ', max(tbl_bansos_nasabah_realisasi_log.createddate) as createddate')
            ->from('tbl_bansos_nasabah_realisasi_log')
            ->join('tbl_bansos_file', 'tbl_bansos_nasabah_realisasi_log.gid = tbl_bansos_file.gid', 'left')
            ->where(['tbl_bansos_nasabah_realisasi_log.tbl_bansos_nasabah_id'=>$d['id']])
            ->where(['tbl_bansos_nasabah_realisasi_log.active'=>1])
            ->where(['tbl_bansos_file.active'=>1])
                ;
        
        $this->db->group_by([
            'tbl_bansos_nasabah_realisasi_log.gid'
        ]);
        
        if ($l!=FALSE) {
            return $this->db->count_all_results();    
        } else {
            $this->db->limit($d['limit'],$d['offset']);
            return $this->db->get()->result();
        }
        
    }
    
    public function GET_LIST_PER_KELOMPOK($d,$l){
        
        $this->db
            ->select(
                    'tbl_bansos_nasabah.regionid, max(tbl_bansos_nasabah.region) as region'
                    . ', tbl_bansos_nasabah.areaid, max(tbl_bansos_nasabah.area) as area'
                    . ', tbl_bansos_nasabah.cabangid, max(tbl_bansos_nasabah.cabang) as cabang'
                    . ', tbl_bansos_nasabah.kelompokid, max(tbl_bansos_nasabah.kelompok) as kelompok'
                )
            ->from('tbl_bansos_nasabah');
        
        if ($d['search']){
            $this->db
                ->like('tbl_bansos_file.regionid',$d['search'])
                ->or_like('tbl_bansos_file.region',$d['search'])
                ->or_like('tbl_bansos_file.areaid',$d['search'])
                ->or_like('tbl_bansos_file.area',$d['search'])
                ->or_like('tbl_bansos_file.cabangid',$d['search'])
                ->or_like('tbl_bansos_file.cabang',$d['search'])
                ->or_like('tbl_bansos_file.kelompokid',$d['search'])
                ->or_like('tbl_bansos_file.kelompok',$d['search'])
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
    
}

