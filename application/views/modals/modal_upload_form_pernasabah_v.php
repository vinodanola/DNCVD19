<!-- Modal -->
<div class="modal fade" id="myModalUploadFormPerNasabah" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" style="overflow: auto;" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Upload Form</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 ">
                    <form id="formUploadFile">
                        <div class="form-group hide">
                            <div class="input-group">
                                <input type="text" class="form-control pull-right js-input-id" readonly style="background-color: #f5f5f5;" />
                                <input type="text" class="form-control pull-right js-input-nasabahid" readonly style="background-color: #f5f5f5;" />
                                <input type="text" class="form-control pull-right js-input-kelompokid" readonly style="background-color: #f5f5f5;" />
                                <input type="text" class="form-control pull-right js-input-bulan_subsidi_tahun_subsidi" readonly style="background-color: #f5f5f5;" />
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom:0;">    
                            <dl class="row" style="margin-bottom:0;">
                                <dt class="col-sm-3">Periode <sup>(yyyymm)</sup></dt>
                                <dd class="col-sm-9"><p>: <span class="js-load-ufpn-periode">..</span></p></dd>
								
                                <dt class="col-sm-3">Nasabah Id</dt>
                                <dd class="col-sm-9"><p>: <span class="js-load-ufpn-nasabahid">..</span></p></dd>

                                <dt class="col-sm-3">Nama Nasabah</dt>
                                <dd class="col-sm-9"><p>: <span class="js-load-ufpn-nasabahnama">..</span></p></dd>
                                
                                <dt class="col-sm-3">Jumlah Subsidi</dt>
                                <dd class="col-sm-9"><p>: <span class="js-load-ufpn-jumlah_subsidi">..</span></p></dd>
                                
                                <dt class="col-sm-3">Tanggal Realisasi</dt>
                                <dd class="col-sm-9"><p>: <span class="js-load-ufpn-workingdate">..</span></p></dd>
                            </dl>
                        </div>
                        <div class="form-group">
                            <label>Status Pencairan</label>
                            <select class="form-control js-input-ufpn-statuspencairan">
                                <option value="C">CAIR</option>
                                <option value="B">BATAL CAIR</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <div class="input-group">
                                <input type="file" name="myfile" class="form-control js-myfile-upload-form" id="myfile" />
                                <span class="input-group-btn">
                                    <a class=" btn btn-danger js-clear-file-upload-form">Hapus File</a>
                                </span>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label>Tanggal Realisasi</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right js-tgl-realisasi" id="datepicker" readonly style="background-color: white;" />
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            
            <button type="button" class="btn btn-default " data-dismiss="modal">Keluar</button>
            <button type="button" class="btn btn-primary js-upload-form-pernasabah-post">Simpan</button>
        </div>
    </div>
  </div>
</div>