<div class="content-wrapper content-wrapper-home js-load-data-dashboard" id="contentWrapperDahsboard">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading ">
                        <div class="row">
                            <div class="col-md-1">
                                <h3 style="margin: 5px;">Dashboard</h3>
                            </div>
                            <div class="col-md-11">
                                <form class="form-inline text-right" style="margin:0;">
                                    
                                    &emsp;
                                    
                                    <div class="form-group" >
                                        <label>Cabang</label>
                                        <select class="form-control js-input-dsb-cabang">
                                            <?php
                                                for ($i=0; $i<count($cabang); $i++) {
                                                    echo '<option value="'.$cabang[$i]->OurBranchID.'">'.$cabang[$i]->OurBranchID.' | '.$cabang[$i]->BranchName.'</option>'; 
                                                }
                                            ?>
                                        </select>
                                    </div>
<!--                                    <div class="form-group" >
                                        <label>Working Date</label>
                                        <select class="form-control js-input-dsb-wdate">
                                            
                                                for ($i=0; $i<count($tanggalrealisasi); $i++) {
                                                    echo '<option value="'.$tanggalrealisasi[$i]->tanggalrealisasipencairan.'">'.$tanggalrealisasi[$i]->tanggalrealisasipencairan.'</option>'; 
                                                }
                                            
                                        </select>
                                    </div>-->
                                    <div class="form-group">
                                        <label>Tanggal Realisasi</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right js-input-dsb-wdate" id="datepicker" readonly style="background-color: white;" />
                                            <div class="btn input-group-addon" id="reset-date" data-toggle="tooltip" title="Hapus Tanggal">
                                                <i class="fa fa-trash"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" >
                                        <label>Periode</label>
                                        <select class="form-control js-input-dsb-bulan">
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <!--<label>Tahun</label>-->
                                        <select class="form-control js-input-dsb-tahun">
                                            <option value="2020">2020</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body text-center">
                        <div class="col-md-12" style="text-align: left;">
                            <span class="js-load-dsb-loading" style="font-weight: 100;"></span>
                        </div>
                        <div class="h3 col-md-12" style="margin-bottom: 30px; text-align: left;">
                            <span style="border-bottom: 3px solid #000;">Rencana</span>
                        </div>
						<div class="col-md-3">
                            <!-- Apply any bg-* class to to the info-box to color it -->
                            <div class="info-box bg-blue-active">
<!--                              <span class="info-box-icon">
                                  <i class="fa fa-arrow-circle-o-right"></i>
                              </span>-->
                              <div class="info-box-content">
                                <span class="info-box-text">Total Saldo</span>
                                <span class="info-box-number" style="font-size: 30px;">Rp. <span class="js-load-dsb-total_saldo"></span></span>
                                <!-- The progress section is optional -->
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3">
                            <!-- Apply any bg-* class to to the info-box to color it -->
                            <div class="info-box bg-blue-active">
<!--                              <span class="info-box-icon">
                                  <i class="fa fa-arrow-circle-o-right"></i>
                              </span>-->
                              <div class="info-box-content">
                                <span class="info-box-text">Total Subsidi</span>
                                <span class="info-box-number" >Rp. <span class="js-load-dsb-total_subsidi_nominal"></span></span>
                                <!-- The progress section is optional -->
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    NOA <span class="js-load-dsb-total_subsidi_noa"></span>
                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3">
                            <!-- Apply any bg-* class to to the info-box to color it -->
                            <div class="info-box bg-blue-gradient">
                              <!--<span class="info-box-icon"><i class="fa fa-dollar"></i></span>-->
                              <div class="info-box-content">
                                <span class="info-box-text">Total Subsidi Nasabah Belum Lunas</span>
                                <span class="info-box-number">Rp. <span class="js-load-dsb-total_subsidi_nbl_nominal"></span></span>
                                <!-- The progress section is optional -->
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    NOA <span class="js-load-dsb-total_subsidi_nbl_noa"></span>
                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 ">
                            <!-- Apply any bg-* class to to the info-box to color it -->
                            <div class="info-box bg-blue-gradient">
                              <!--<span class="info-box-icon"><i class="fa fa-dollar"></i></span>-->
                              <div class="info-box-content">
                                <span class="info-box-text">Total Subsidi Nasabah Lunas</span>
                                <span class="info-box-number">Rp. <span class="js-load-dsb-total_subsidi_nl_nominal"></span></span>
                                <!-- The progress section is optional -->
                                <div class="progress">
                                  <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    NOA <span class="js-load-dsb-total_subsidi_nl_noa"></span>
                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        
                        
                        <div class="col-md-12 h3" style="margin-bottom: 30px; text-align: left;">
                            <span style="border-bottom: 3px solid #000; ">Realisasi <small>Nasabah Belum Lunas</small></span>
                        </div>
                        <div class="col-md-4 ">
                            <!-- Apply any bg-* class to to the info-box to color it -->
                            <div class="info-box bg-green">
                              <!--<span class="info-box-icon"><i class="fa fa-dollar"></i></span>-->
                              <div class="info-box-content">
                                <span class="info-box-text">Cair</span>
                                <span class="info-box-number">Rp. <span class="js-load-dsb-realisasi_nbl_cair_nominal"></span></span>
                                <!-- The progress section is optional -->
                                <div class="progress">
                                  <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    NOA <span class="js-load-dsb-realisasi_nbl_cair_noa"></span>
                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-4 ">
                            <!-- Apply any bg-* class to to the info-box to color it -->
                            <div class="info-box bg-red">
                              <!--<span class="info-box-icon"><i class="fa fa-dollar"></i></span>-->
                              <div class="info-box-content">
                                <span class="info-box-text">Batal</span>
                                <span class="info-box-number">Rp. <span class="js-load-dsb-realisasi_nbl_batal_nominal"></span></span>
                                <!-- The progress section is optional -->
                                <div class="progress">
                                  <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    NOA <span class="js-load-dsb-realisasi_nbl_batal_noa"></span>
                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-4 ">
                            <!-- Apply any bg-* class to to the info-box to color it -->
                            <div class="info-box bg-gray">
                              <!--<span class="info-box-icon"><i class="fa fa-dollar"></i></span>-->
                              <div class="info-box-content">
                                <span class="info-box-text">Belum Realisasi</span>
                                <span class="info-box-number">Rp. <span class="js-load-dsb-realisasi_nbl_blm_nominal"></span></span>
                                <!-- The progress section is optional -->
                                <div class="progress">
                                  <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    NOA <span class="js-load-dsb-realisasi_nbl_blm_noa"></span>
                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        
                        <div class="col-md-12 h3" style="margin-bottom: 30px; text-align: left;">
                            <span style="border-bottom: 3px solid #000; ">Realisasi <small>Nasabah Lunas</small></span>
                        </div>
                        <div class="col-md-4 ">
                            <!-- Apply any bg-* class to to the info-box to color it -->
                            <div class="info-box bg-green">
                              <!--<span class="info-box-icon"><i class="fa fa-dollar"></i></span>-->
                              <div class="info-box-content">
                                <span class="info-box-text">Cair</span>
                                <span class="info-box-number">Rp. <span class="js-load-dsb-realisasi_nl_cair_nominal"></span></span>
                                <!-- The progress section is optional -->
                                <div class="progress">
                                  <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    NOA <span class="js-load-dsb-realisasi_nl_cair_noa"></span>
                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-4 ">
                            <!-- Apply any bg-* class to to the info-box to color it -->
                            <div class="info-box bg-red">
                              <!--<span class="info-box-icon"><i class="fa fa-dollar"></i></span>-->
                              <div class="info-box-content">
                                <span class="info-box-text">Batal</span>
                                <span class="info-box-number">Rp. <span class="js-load-dsb-realisasi_nl_batal_nominal"></span></span>
                                <!-- The progress section is optional -->
                                <div class="progress">
                                  <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    NOA <span class="js-load-dsb-realisasi_nl_batal_noa"></span>
                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-4 ">
                            <!-- Apply any bg-* class to to the info-box to color it -->
                            <div class="info-box bg-gray">
                              <!--<span class="info-box-icon"><i class="fa fa-dollar"></i></span>-->
                              <div class="info-box-content">
                                <span class="info-box-text">Belum Realisasi</span>
                                <span class="info-box-number">Rp. <span class="js-load-dsb-realisasi_nl_blm_nominal"></span></span>
                                <!-- The progress section is optional -->
                                <div class="progress">
                                  <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    NOA <span class="js-load-dsb-realisasi_nl_blm_noa"></span>
                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>