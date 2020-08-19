<div class="content-wrapper content-wrapper-home" >
    <section class="content" >
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <form >
                                <div class="col-md-12">
                                    <h4>Daftar Nasabah</h4>
<!--                                    <p>
                                        <span >
                                            Penyaluran
                                        </span>
                                    </p>-->
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="tbBansos" class="table table-hover small js-load-tbl-bansos-perkelompok">
                            <thead>
                                <th>region id</th>
                                <th>region</th>
                                <th>area id</th>
                                <th>area</th>
                                <th>cabang id</th>
                                <th>cabang</th>
                                <th>kelompok id</th>
                                <th>kelompok</th>
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
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once 'modals/modal_upload_form_bansos_perkelompok_v.php'; ?>

<?php require_once 'modals/modal_detail_realisasi_bansos_perkelompok_v.php'; ?>