<!-- Modal -->
<div class="modal fade" id="myModalDetailRealisasi" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" style="overflow: auto;" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Detail Realisasi</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 ">
                    <form id="formDetailRealisasi">
                        <div class="form-group" style="margin-bottom:0;">    
                            <dl class="row" style="margin-bottom:0;">
                                <dt class="col-sm-3">Kelompok</dt>
                                <dd class="col-sm-9"><p>: <span class="js-load-dr-kelompok">..</span></p></dd>
                                
                                <dt class="col-sm-3">Periode <sup>(yyyymm)</sup></dt>
                                <dd class="col-sm-9"><p>: <span class="js-load-dr-periode">..</span></p></dd>
                            </dl>
                        </div>
                        <div class="form-group">    
                            <table id="myTableListDetailRealisasi" class="able table-hover table-bordered small">
                                <thead>
                                    <th>realisasi id</th>
                                    <th>tanggal realisasi</th>
                                    <th></th>
                                </thead>
                                <tfoot>
                                    <tr>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            
        </div>
    </div>
  </div>
</div>