<html data-baseurl="<?= base_url() ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>App</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/Ionicons/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/DataTables-1.10.16/media/css/jquery.dataTables.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.0-rc/dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.0-rc/dist/css/skins/_all-skins.min.css') ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css?id=') . date(DATE_RFC2822) ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/fastclick/lib/fastclick.js') ?>"></script>
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/dist/js/adminlte.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/dist/js/demo.js') ?>"></script>
    <script src="<?php echo base_url('assets/handlebars-v4.0.10.js') ?>"></script>
    <script src="<?php echo base_url('assets/jquery.cookie.js') ?>"></script>
    <script src="<?php echo base_url('assets/DataTables-1.10.16/media/js/jquery.dataTables.min.js') ?>"></script>
    
    <!-- Select2 -->
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
    <!-- InputMask -->
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/plugins/input-mask/jquery.inputmask.js') ?>"></script>
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/plugins/input-mask/jquery.inputmask.date.extensions.js') ?>"></script>
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/plugins/input-mask/jquery.inputmask.extensions.js') ?>"></script>
    <!-- date-range-picker -->
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/moment/min/moment.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
    <!-- bootstrap datepicker -->
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
    <!-- bootstrap color picker -->
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') ?>"></script>
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/plugins/timepicker/bootstrap-timepicker.min.js') ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/plugins/iCheck/icheck.min.js') ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/AdminLTE-2.4.0-rc/bower_components/fastclick/lib/fastclick.js') ?>"></script>
    
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    
    <script src="<?php echo base_url('assets/bootbox/bootbox.all.js') ?>"></script>
    <script src="<?php echo base_url('assets/jquery.mask.min.js') ?>"></script>
    
    
    <script src="<?php echo base_url('assets/js/app.js?id=') . date(DATE_RFC2822) ?>"></script>
</head>
<body class="hold-transition skin-black layout-top-nav">
    <div id="myModalAlert" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="z-index: 9999;">
        <div class="modal-dialog">
          <div class="modal-content">
<!--            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><span class="fa fa-warning"></span></h4>
            </div>-->
            <div class="modal-body">
                <span class="js-percent-progress-upload"></span><span class="js-percent-progress-download"></span>
                <span class="js-prc"></span>
                <p class="js-alert-value"></p>
            </div>
            <div class="modal-footer hide">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
    </div>
    <div class="wrapper">