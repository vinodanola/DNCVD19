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
                        <table id="tbBansos" class="table table-hover small js-load-tbl-bansos">
                            <thead>
                                <!--<th>region_id</th>-->
                                <th>region</th>
                                <!--<th>area_id</th>-->
                                <th>area</th>
                                <!--<th>cabang_id</th>-->
                                <th>cabang</th>
                                <th>kelompok_id</th>
                                <th>kelompok</th>
                                <th>nasabah_id</th>
                                <th>nasabah</th>
                                <th>norek</th>
                                <th>status</th>
                                <th></th>
                            </thead>
                            <tfoot>
                                <tr>
                                    <!--<td></td>-->
                                    <td></td>
                                    <!--<td></td>-->
                                    <td></td>
                                    <!--<td></td>-->
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
<?php require_once 'modals/modal_upload_form_bansos_v.php'; ?>

<?php require_once 'modals/modal_detail_realisasi_bansos_v.php'; ?>