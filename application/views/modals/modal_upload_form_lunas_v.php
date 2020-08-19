<!-- Modal -->
<div class="modal fade" id="myModalUploadFormLunas" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" style="overflow: auto;" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Upload Form <b><span class="js-id-nasabahnama"></span></b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 ">
                    <form id="formUploadLunasFile">
                        <input type="text" class="js-input-ufl-id hide" value=""/>
                        <div class="form-group" style="margin-bottom:0;">    
                            <dl class="row" style="margin-bottom:0;">
                                <dt class="col-sm-3">Periode <sup>(yyyymm)</sup></dt>
                                <dd class="col-sm-9"><p>: <span class="js-load-ufl-periode">..</span></p></dd>
								
                                <dt class="col-sm-3">Nasabah Id</dt>
                                <dd class="col-sm-9"><p>: <span class="js-load-ufl-nasabahid">..</span></p></dd>

                                <dt class="col-sm-3">Nama Nasabah</dt>
                                <dd class="col-sm-9"><p>: <span class="js-load-ufl-nasabahnama">..</span></p></dd>
                                
                                <dt class="col-sm-3">Jumlah Subsidi</dt>
                                <dd class="col-sm-9"><p>: <span class="js-load-ufl-jumlah_subsidi">..</span></p></dd>
                                
                                <dt class="col-sm-3">Tanggal Realisasi</dt>
                                <dd class="col-sm-9"><p>: <span class="js-load-ufl-workingdate">..</span></p></dd>
                            </dl>
                        </div>
                        <div class="form-group">
                            <label>Status Pencairan</label>
                            <select class="form-control js-input-ufl-statuspencairan">
                                <option value="C">CAIR</option>
                                <option value="B">BATAL CAIR</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <div class="input-group">
                                <input type="file" name="myfilelunas" class="form-control js-myfile-upload-form-lunas" id="myfilelunas" />
                                <span class="input-group-btn">
                                    <a class=" btn btn-danger js-clear-file-upload-form-lunas">Clear File</a>
                                </span>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label>Tanggal Realisasi</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                                <input type="text" class="form-control pull-right js-tgl-realisasi-lunas" id="datepicker" readonly style="background-color: white;" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            
            <button type="button" class="btn btn-default " data-dismiss="modal">Keluar</button>
            <button type="button" class="btn btn-primary js-upload-form-lunas-post">Simpan</button>
            <!--<span class="text-danger js-alert-clear-search hide">* Kosongkan dulu pencarian (<b>Search</b>) untuk menyimpan data ini</span>-->
        </div>
    </div>
  </div>
</div>