<div class="content-wrapper content-wrapper-home" >
    <section class="content" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <form >
                                <div class="col-md-12">
                                    <h4>Daftar Nasabah Lunas</h4>
                                    <p>
                                        Penyaluran subsidi bunga nasabah lunas dilakukan per nasabah. Silahkan pilih nasabah yang akan disalurkan subsidi bunga.
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="tbSBMkrLunas" class="table table-hover small js-load-tbl-sbmkrlunas">
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
<?php require_once 'modals/modal_upload_form_lunas_v.php'; ?>
<?php require_once 'modals/modal_detail_realisasi_lunas_v.php'; ?>