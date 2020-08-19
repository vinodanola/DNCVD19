<div class="content-wrapper content-wrapper-home" >
    <section class="content" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <form >
                                <div class="col-md-12">
                                    <h4>Daftar Nasabah Belum Lunas</h4>
                                    <p>
                                        <span >
                                            Penyaluran subsidi bunga nasabah belum lunas <b>per nasabah</b>. Silahkan pilih kelompok yang akan disalurkan subsidi bunga.
                                        </span>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="tbSubsidiBungaMekaarPerNasabah" class="table table-hover small js-load-tbl-subsidibungamekaar-pernasabah">
                            <thead>
                                <th>region id</th>
                                <th>region</th>
                                <th>area id</th>
                                <th>area</th>
                                <th>cabang id</th>
                                <th>cabang</th>
                                <th>nasabah id</th>
                                <th>nasabah</th>
                                <th>periode (yyyymm)</th>
                                <th>status realisasi</th>
                                <th></th>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once 'modals/modal_upload_form_pernasabah_v.php'; ?>
<?php require_once 'modals/modal_detail_realisasi_pernasabah_v.php'; ?>