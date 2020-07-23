<!-- Modal -->
<div class="modal fade" id="myModalUploadForm" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" style="overflow: auto;" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Upload Form <b><span class="js-id-kelompok"></span></b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 ">
                    <form id="formUploadFile">
                        <div class="form-group">
                            <label>File</label>
                            <div class="input-group">
                                <input type="file" name="myfile" class="form-control js-myfile-upload-form" id="myfile" />
                                <span class="input-group-btn">
                                    <a class=" btn btn-danger js-clear-file-upload-form">Clear File</a>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Realisasi</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right js-tgl-realisasi" id="datepicker" readonly>
                            </div>
                        </div>
                            <br>
                        <div class="form-group">    
                            <table id="myTableListNasabahPerKelompok" class="able table-hover table-bordered small">
                                <thead>
                                    <th>nasabah id</th>
                                    <th>nasabah</th>
                                    <th>status</th>
                                </thead>
                                <tfoot>
                                    <tr>
<!--                                        <td></td>
                                        <td></td>
                                        <td></td>-->
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary js-upload-form-post">Save</button>
        </div>
    </div>
  </div>
</div>