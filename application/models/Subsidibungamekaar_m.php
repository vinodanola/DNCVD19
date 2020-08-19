<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subsidibungamekaar_m extends CI_Model {
    
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
                    . 'min(tbl_nasabah.is_pencairandone) as is_pencairandone, '
                    . 'max(tbl_file.filesource) as filesource, '
                    . 'tbl_nasabah.bulan_subsidi_tahun_subsidi'
                    )
            ->from('tbl_nasabah')
            ->join('tbl_file', 'tbl_nasabah.kelompokid = tbl_file.kelompokid and tbl_nasabah.bulan_subsidi_tahun_subsidi = tbl_file.bulan_subsidi_tahun_subsidi', 'left');
        
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
                ->or_like('tbl_nasabah.bulan_subsidi_tahun_subsidi',$d['search'])
                ;
        }
        
        $this->db->group_by([
            'tbl_nasabah.regionid',
            'tbl_nasabah.areaid',
            'tbl_nasabah.cabangid',
            'tbl_nasabah.kelompokid',
            'tbl_nasabah.bulan_subsidi_tahun_subsidi'
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
            ->where(['kelompokid'=>$d['kelompokid']])
            ->where(['bulan_subsidi_tahun_subsidi'=>$d['bulan_subsidi_tahun_subsidi']])
            ->where(['is_pencairandone'=>'N']);
        
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
            'gid' => $d['gid'],
            'kelompokid' => $d['kelompokid'],
            'bulan_subsidi_tahun_subsidi' => $d['bulan_subsidi_tahun_subsidi'],
            'filesource' => $d['filename'],
            'createdate' => $myGetDate,
            'createdby'  => $this->session->signin['USERNAME']
        ]);
        
        foreach ($d['status_nasabah_list'] as $k => $v) {
            
            if ($d['status_nasabah_list'][$k]->status=='C'){
                $is_pencairandone = 'Y';
            } else {
                $is_pencairandone = 'N';
            }
            
            $this->db->insert('tbl_nasabah_realisasi_log', [
                'gid' => $d['gid'],
                'tbl_nasabah_id' => $d['status_nasabah_list'][$k]->id,
                'kelompokid' => $d['kelompokid'],
                'bulan_subsidi_tahun_subsidi' => $d['bulan_subsidi_tahun_subsidi'],
                'status' => $d['status_nasabah_list'][$k]->status,
                'tanggalrealisasipencairan' => $d['tanggalrealisasipencairan'],
                'createdate' => $myGetDate,
                'createby' => $this->session->signin['USERNAME']
            ]);
            
            $this->db
                ->set('updatedby',$this->session->signin['USERNAME'])
                ->set('updateddate',$myGetDate)
                ->set('tanggalrealisasipencairan', $d['tanggalrealisasipencairan'])
                ->set('is_pencairandone',$is_pencairandone)
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
	
    public function GET_TANGGAL_REALISASI($d){

        $DB = $this->load->database('db3',TRUE);

        $BranchId = $this->db->query("select top 1 * from tbl_nasabah where id='".$d['status_nasabah_list'][0]->id."'")->result()[0]->cabangid;

        return $DB->query("select top 1 *, format(SODDate,'dd/MM/yyyy') as SODDateWithFormat from t_SystemBranchStatus where OurBranchID='".$BranchId."'")->result_array();
    }
    
    public function GET_DETAIL_REALISASI_LOG($d,$l){
        
        $this->db
            ->select('tbl_nasabah_realisasi_log.gid'
                    . ', max(tbl_nasabah_realisasi_log.tanggalrealisasipencairan) as tanggalrealisasipencairan'
                    . ', max(tbl_nasabah_realisasi_log.kelompokid) as kelompokid'
                    . ', max(tbl_nasabah_realisasi_log.bulan_subsidi_tahun_subsidi) as bulan_subsidi_tahun_subsidi'
                    . ', max(tbl_file.filesource) as filesource')
            ->from('tbl_nasabah_realisasi_log')
            ->join('tbl_file', 'tbl_nasabah_realisasi_log.gid = tbl_file.gid', 'left')
            ->where(['tbl_nasabah_realisasi_log.kelompokid'=>$d['kelompokid']])
            ->where(['tbl_nasabah_realisasi_log.bulan_subsidi_tahun_subsidi'=>$d['bulan_subsidi_tahun_subsidi']]);
        
        $this->db->group_by([
            'tbl_nasabah_realisasi_log.gid'
        ]);
        
        if ($l!=FALSE) {
            return $this->db->count_all_results();    
        } else {
            $this->db->limit($d['limit'],$d['offset']);
            return $this->db->get()->result();
        }
        
    }
    
    public function GET_LIST_PER_NASABAH($d,$l){
        
        $this->db
            ->select(
                    'tbl_nasabah.id, '
                    .' ,tbl_nasabah.regionid, tbl_nasabah.region, '
                    . 'tbl_nasabah.areaid, tbl_nasabah.area, '
                    . 'tbl_nasabah.cabangid, tbl_nasabah.cabang, '
                    . 'tbl_nasabah.kelompokid, tbl_nasabah.kelompok, '
                    . 'tbl_nasabah.nasabahid, tbl_nasabah.nasabahnama, '
                    . 'tbl_nasabah.is_pencairandone, '
                    . 'tbl_nasabah.bulan_subsidi_tahun_subsidi,'
                    . 'tbl_nasabah.jumlah_subsidi'
                    )
            ->from('tbl_nasabah');
        
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
                ->or_like('tbl_nasabah.nasabahid',$d['search'])
                ->or_like('tbl_nasabah.nasabahnama',$d['search'])
                ->or_like('tbl_nasabah.bulan_subsidi_tahun_subsidi',$d['search'])
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
            ->from('tbl_nasabah')
            ->where('id',$d['id'])
            ->limit(1);
        
        return $this->db->get()->result();
        
    }
    
    public function GET_DETAIL_REALISASI_PER_NASABAH_LOG($d,$l){
        
        $this->db
            ->select('tbl_nasabah_realisasi_log.gid'
                    . ', max(tbl_nasabah_realisasi_log.tbl_nasabah_id) as tbl_nasabah_id'
                    . ', max(tbl_nasabah_realisasi_log.tanggalrealisasipencairan) as tanggalrealisasipencairan'
                    . ', max(tbl_file.filesource) as filesource'
                    . ', max(tbl_nasabah_realisasi_log.kelompokid) as kelompokid'
                    . ', max(tbl_nasabah_realisasi_log.bulan_subsidi_tahun_subsidi) as bulan_subsidi_tahun_subsidi'
                    )
            ->from('tbl_nasabah_realisasi_log')
            ->join('tbl_file', 'tbl_nasabah_realisasi_log.gid = tbl_file.gid', 'left')
            ->where(['tbl_nasabah_realisasi_log.tbl_nasabah_id'=>$d['id']]);
        
        $this->db->group_by([
            'tbl_nasabah_realisasi_log.gid'
        ]);
        
        if ($l!=FALSE) {
            return $this->db->count_all_results();    
        } else {
            $this->db->limit($d['limit'],$d['offset']);
            return $this->db->get()->result();
        }
        
    }
    
}