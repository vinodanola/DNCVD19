var CONFIG = {
    
    baseurl : $('html').data('baseurl'),
    
    basejasper : 'http://10.61.3.77:8080/jasperserver/rest_v2/reports/reports/SB/',
    
    basefile : $('html').data('baseurl')+'assets/files/',
    
    numbermask : '000.000.000.000.000,00'
    
};

var GLOBAL = {
    
    init : function(){
        
        $(document).ready(function(){
            $('#datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });
            $("#reset-date").click(function(){
                $('#datepicker').val("").datepicker("update");
            });
            $('#myModalAlert').on('hidden.bs.modal', function () {
                $('.js-alert-value').empty().append();
                $('#myModalAlert .modal-footer').addClass('hide');
            });
            
            $('.modal').on('hidden.bs.modal', function () {
                $('body').css({'padding-right' : '0'});
            });
            
            $('[data-toggle="tooltip"]').tooltip();
            
        });
        
    }
    
};
GLOBAL.init();

var WELCOME = {
    
    get_data_dashboard : function(d){
        
        $('.js-load-dsb-loading').empty().append('Loading ...');
        
        var mymaskformat = '000.000.000.000.000,00';
        
        $.ajax({
            type    : "GET",
            url     : CONFIG.baseurl+"Welcome/get_dashboard_data_api/?tahun="+d['tahun']+'&bulan='+d['bulan']+'&cabang='+d['cabang']+'&wdate='+d['wdate'],
            dataType: 'json',
            success : function(R){
                if (R.status == true){
                    $('.js-load-dsb-bulantahun').empty().append(R.data[0].bulantahun);
                    $('.js-load-dsb-total_subsidi_nominal').empty().append(R.data[0].total_subsidi_nominal).unmask().mask(mymaskformat, {reverse: true});
                    $('.js-load-dsb-total_subsidi_noa').empty().append(R.data[0].total_subsidi_noa);
                    $('.js-load-dsb-total_saldo').empty().append(R.data[0].total_saldo).unmask().mask(mymaskformat, {reverse: true});
                    $('.js-load-dsb-total_subsidi_nbl_nominal').empty().append(R.data[0].total_subsidi_nbl_nominal).unmask().mask(mymaskformat, {reverse: true});
                    $('.js-load-dsb-total_subsidi_nbl_noa').empty().append(R.data[0].total_subsidi_nbl_noa);
                    $('.js-load-dsb-total_subsidi_nl_nominal').empty().append(R.data[0].total_subsidi_nl_nominal).unmask().mask(mymaskformat, {reverse: true});
                    $('.js-load-dsb-total_subsidi_nl_noa').empty().append(R.data[0].total_subsidi_nl_noa);
                    $('.js-load-dsb-realisasi_nbl_cair_nominal').empty().append(R.data[0].realisasi_nbl_cair_nominal).unmask().mask(mymaskformat, {reverse: true});
                    $('.js-load-dsb-realisasi_nbl_cair_noa').empty().append(R.data[0].realisasi_nbl_cair_noa);
                    $('.js-load-dsb-realisasi_nbl_batal_nominal').empty().append(R.data[0].realisasi_nbl_batal_nominal).unmask().mask(mymaskformat, {reverse: true});
                    $('.js-load-dsb-realisasi_nbl_batal_noa').empty().append(R.data[0].realisasi_nbl_batal_noa);
                    $('.js-load-dsb-realisasi_nbl_blm_nominal').empty().append(R.data[0].realisasi_nbl_blm_nominal).unmask().mask(mymaskformat, {reverse: true});
                    $('.js-load-dsb-realisasi_nbl_blm_noa').empty().append(R.data[0].realisasi_nbl_blm_noa);
                    $('.js-load-dsb-realisasi_nl_cair_nominal').empty().append(R.data[0].realisasi_nl_cair_nominal).unmask().mask(mymaskformat, {reverse: true});
                    $('.js-load-dsb-realisasi_nl_cair_noa').empty().append(R.data[0].realisasi_nl_cair_noa);
                    $('.js-load-dsb-realisasi_nl_batal_nominal').empty().append(R.data[0].realisasi_nl_batal_nominal).unmask().mask(mymaskformat, {reverse: true});
                    $('.js-load-dsb-realisasi_nl_batal_noa').empty().append(R.data[0].realisasi_nl_batal_noa);
                    $('.js-load-dsb-realisasi_nl_blm_nominal').empty().append(R.data[0].realisasi_nl_blm_nominal).unmask().mask(mymaskformat, {reverse: true});
                    $('.js-load-dsb-realisasi_nl_blm_noa').empty().append(R.data[0].realisasi_nl_blm_noa);
                    $('.js-load-dsb-loading').empty().append('Last updated '+R.data[0].createddate);
                } else {
                    console.log(R);
                    $('.js-load-dsb-bulantahun').empty().append('0.00');
                    $('.js-load-dsb-total_subsidi_nominal').empty().append('0,00');
                    $('.js-load-dsb-total_subsidi_noa').empty().append('0');
                    $('.js-load-dsb-total_saldo').empty().append('0,00');
                    $('.js-load-dsb-total_subsidi_nbl_nominal').empty().append('0,00');
                    $('.js-load-dsb-total_subsidi_nbl_noa').empty().append('0');
                    $('.js-load-dsb-total_subsidi_nl_nominal').empty().append('0,00');
                    $('.js-load-dsb-total_subsidi_nl_noa').empty().append('0');
                    $('.js-load-dsb-realisasi_nbl_cair_nominal').empty().append('0,00');
                    $('.js-load-dsb-realisasi_nbl_cair_noa').empty().append('0');
                    $('.js-load-dsb-realisasi_nbl_batal_nominal').empty().append('0,00');
                    $('.js-load-dsb-realisasi_nbl_batal_noa').empty().append('0');
                    $('.js-load-dsb-realisasi_nbl_blm_nominal').empty().append('0,00');
                    $('.js-load-dsb-realisasi_nbl_blm_noa').empty().append('0');
                    $('.js-load-dsb-realisasi_nl_cair_nominal').empty().append('0,00');
                    $('.js-load-dsb-realisasi_nl_cair_noa').empty().append('0');
                    $('.js-load-dsb-realisasi_nl_batal_nominal').empty().append('0,00');
                    $('.js-load-dsb-realisasi_nl_batal_noa').empty().append('0');
                    $('.js-load-dsb-realisasi_nl_blm_nominal').empty().append('0,00');
                    $('.js-load-dsb-realisasi_nl_blm_noa').empty().append('0');
                    $('.js-load-dsb-loading').empty().append('Data Not Found');
                }
            },
            error : function(R){
                //alert(R);
                console.log(R);
                $('.js-load-dsb-loading').empty().append(R);
            }
        });
        
    },
    
    init : function(){
        
        $(document).ready(function(){
            
            $('.js-load-data-dashboard').html(function(){
                $('.js-input-dsb-cabang').val('00000');
                $('.js-input-dsb-bulan').val('05');
                WELCOME.get_data_dashboard({
                    'bulan' : $('.js-input-dsb-bulan').val(),
                    'tahun' : $('.js-input-dsb-tahun').val(),
                    'cabang' : $('.js-input-dsb-cabang').val(),
                    'wdate' : $('.js-input-dsb-wdate').val()
                });
            });
            
            $('.js-input-dsb-bulan, .js-input-dsb-tahun, .js-input-dsb-cabang, .js-input-dsb-wdate').change(function(){
                WELCOME.get_data_dashboard({
                    'bulan' : $('.js-input-dsb-bulan').val(),
                    'tahun' : $('.js-input-dsb-tahun').val(),
                    'cabang' : $('.js-input-dsb-cabang').val(),
                    'wdate' : $('.js-input-dsb-wdate').val()
                });
            });
            
            
        });
        
    }
    
};
WELCOME.init();

var SUBSIDIBUNGAMEKAAR = {
    
    table : function(d){
        $('#tbSubsidiBungaMekaar').DataTable({
            scrollX: true,
            destroy: true,
            data: d['data'],
            columns : [
                { "data": "regionid" },
                { "data": "region" },
                { "data": "areaid" },
                { "data": "area" },
                { "data": "cabangid" },
                { "data": "cabang" },
                { "data": "kelompokid" },
                { "data": "kelompok" }
            ]
        });
        
    },
    
    get_list : function(d){
        
        var regionid    = d['regionid'] ? d['regionid'] : '';
        var region      = d['region'] ? d['region'] : '';
        var areaid      = d['areaid'] ? d['areaid'] : '';
        var area        = d['area'] ? d['area'] : '';
        var cabangid    = d['cabangid'] ? d['cabangid'] : '';
        var cabang      = d['cabang'] ? d['cabang'] : '';
        var kelompokid  = d['kelompokid'] ? d['kelompokid'] : '';
        var kelompok    = d['kelompok'] ? d['kelompok'] : '';
      
        $('#tbSubsidiBungaMekaar').DataTable({
            processing : true,
            serverSide : true,
            //scrollX: true,
            destroy: true,
            bSort: false,
            ajax: {
                url : CONFIG.baseurl+"Subsidibungamekaar/list_api/",
                type : 'POST',
                data : {regionid : regionid}
            },
            columns : [
                { "data": "regionid" },
                { "data": "region" },
                { "data": "areaid" },
                { "data": "area" },
                { "data": "cabangid" },
                { "data": "cabang" },
                { "data": "kelompokid" },
                { "data": "kelompok" },
                { "data": "bulan_subsidi_tahun_subsidi" },
                { "data": "is_pencairandone_desc" },
                {
                    "data": null,
                    "bSortable": false,
                    "mRender": function(data, type, full) {
                        console.log(data);
                        var t = '<div class="row">';
                        if (data.is_pencairandone=='N') {
                            
                                t +='<div class="btn-group">'+
                                        '<div class="dropdown">'+
                                            '<button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown">'+
                                                'Form <span class="caret"></span>'+
                                            '</button>'+
                                            '<ul class="dropdown-menu">'+
                                              '<li><a href="'+CONFIG.basejasper+'LRSB.pdf?kelompokid='+data.kelompokid+'&periode='+data.bulan_subsidi_tahun_subsidi+'&v=3" target="_blank" data-kelompokid="'+data.kelompokid+'" data-bulan_subsidi_tahun_subsidi="'+data.bulan_subsidi_tahun_subsidi+'">Lembar Pemberitahuan</a></li>'+
                                              '<li><a href="'+CONFIG.basejasper+'LRSB.pdf?kelompokid='+data.kelompokid+'&periode='+data.bulan_subsidi_tahun_subsidi+'&v=1" target="_blank" data-kelompokid="'+data.kelompokid+'" data-bulan_subsidi_tahun_subsidi="'+data.bulan_subsidi_tahun_subsidi+'">Lembar Realisasi</a></li>'+
                                            '</ul>'+
                                        '</div>'+   
                                    '</div>'+
                                     
                                    '&nbsp;<div class="btn-group"><a class="btn btn-sm btn-warning col-md-12 js-upload-form-modal" data-kelompokid="'+data.kelompokid+'" data-kelompok="'+data.kelompok+'" data-bulan_subsidi_tahun_subsidi="'+data.bulan_subsidi_tahun_subsidi+'" data-toggle="modal" data-target="#myModalUploadForm" >Upload Form</a></div>';
                                     
                        } 
                        t += '&nbsp;<div class="btn-group"><a class="btn btn-sm btn-success js-detail-realisasi-modal" data-toggle="modal" data-target="#myModalDetailRealisasi" data-kelompokid="'+data.kelompokid+'" data-bulan_subsidi_tahun_subsidi="'+data.bulan_subsidi_tahun_subsidi+'" data-kelompok="'+data.kelompok+'">Detail Realisasi</a></div>'+
                             '</div>';
                        
                        return t;
                    }
                }
            ]
        });
        
    },
    
    get_list_per_nasabah : function(d){
      
        $('#tbSubsidiBungaMekaarPerNasabah').DataTable({
            processing : true,
            serverSide : true,
            //scrollX: true,
            destroy: true,
            bSort: false,
            ajax: {
                url : CONFIG.baseurl+"Subsidibungamekaar/list_per_nasabah_api/",
                type : 'POST',
                data : {}
            },
            columns : [
                { "data": "regionid" },
                { "data": "region" },
                { "data": "areaid" },
                { "data": "area" },
                { "data": "cabangid" },
                { "data": "cabang" },
                { "data": "nasabahid" },
                { "data": "nasabahnama" },
                { "data": "bulan_subsidi_tahun_subsidi" },
                { "data": "is_pencairandone_desc" },
                {
                    "data": null,
                    "bSortable": false,
                    "mRender": function(data, type, full) {
                        console.log(data);
                        var t = '<div class="row">';
                        if (data.is_pencairandone=='N') {
                            
                                t +='<div class="btn-group">'+
                                        '<div class="dropdown">'+
                                            '<button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown">'+
                                                'Form <span class="caret"></span>'+
                                            '</button>'+
                                            '<ul class="dropdown-menu">'+
                                              '<li><a href="'+CONFIG.basejasper+'LRSB.pdf?kelompokid='+data.kelompokid+'&periode='+data.bulan_subsidi_tahun_subsidi+'&v=3&id='+data.id+'" target="_blank">Lembar Pemberitahuan</a></li>'+
                                              '<li><a href="'+CONFIG.basejasper+'LRSB.pdf?kelompokid='+data.kelompokid+'&periode='+data.bulan_subsidi_tahun_subsidi+'&v=1&id='+data.id+'" target="_blank">Lembar Realisasi</a></li>'+
                                            '</ul>'+
                                        '</div>'+   
                                    '</div>'+
                                     
                                    '&nbsp;<div class="btn-group"><a class="btn btn-sm btn-warning col-md-12 js-upload-form-pernasabah-modal" data-id="'+data.id+'" data-nasabahid="'+data.nasabahid+'" data-nasabahnama="'+data.nasabahnama+'" data-jumlah_subsidi="'+data.jumlah_subsidi+'"  data-kelompokid="'+data.kelompokid+'" data-bulan_subsidi_tahun_subsidi="'+data.bulan_subsidi_tahun_subsidi+'" data-kelompok="'+data.kelompok+'" data-toggle="modal" data-target="#myModalUploadFormPerNasabah" >Upload Form</a></div>';
                                     
                        } 
                        t += '&nbsp;<div class="btn-group"><a class="btn btn-sm btn-success js-detail-realisasi-pernasabah-modal" data-toggle="modal" data-target="#myModalDetailRealisasiPerNasabah" data-id="'+data.id+'" data-nasabahid="'+data.nasabahid+'" data-nasabahnama="'+data.nasabahnama+'" data-jumlah_subsidi="'+data.jumlah_subsidi+'"  data-kelompokid="'+data.kelompokid+'" data-bulan_subsidi_tahun_subsidi="'+data.bulan_subsidi_tahun_subsidi+'" data-kelompok="'+data.kelompok+'">Detail Realisasi</a></div>'+
                             '</div>';
                        
                        return t;
                    }
                }
            ]
        });
        
    },
    
    upload_form : {
        
        post : function(d){
            
            $('#myModalAlert').modal('show');
            $('.js-alert-value').empty().append('<h2 class="text-warning">Please waiting ...</h2>');
            $('.js-percent-progress-upload').empty().append('');
            $('.js-percent-progress-download').empty().append('');

            var fd = new FormData();
            var f = $('.js-myfile-upload-form').prop('files')[0];
            
            console.log('upload form d',d);
            
            fd.append('file', f);
            fd.append('status_nasabah_list', JSON.stringify(d['status_nasabah_list']));
            fd.append('kelompokid', d['kelompokid']);
            fd.append('bulan_subsidi_tahun_subsidi', d['bulan_subsidi_tahun_subsidi']);
            fd.append('tanggalrealisasipencairan', d['tanggalrealisasipencairan']);

            $.ajax({
                url: CONFIG.baseurl+"Subsidibungamekaar/post_upload_form_api/",
                type: "POST",
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: fd,
                xhr: function () {

                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener("progress", function(evt){
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                         $('.js-percent-progress-upload').html('Upload : ' + Math.round(percentComplete * 100) + "%");
                        //Do something with upload progress
                        console.log(percentComplete);
                      }
                    }, false);
                    //Download progress
                    xhr.addEventListener("progress", function(evt){
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        //$('.js-percent-progress-download').html(' | Download : ' + Math.round(percentComplete * 100) + "%");
                        //Do something with download progress
                        console.log(percentComplete);
                      }
                    }, false);
                    return xhr;
                },
                success : function(R){

                    console.log(R);
                    
                    $('#myModalAlert .modal-footer').removeClass('hide');

                    if (R.status == 'success') {
                        $('.js-myfile-upload-form').val('');
                        $('.js-alert-value').empty().append('<h2 class="text-success text-uppercase">'+R.status +'</h2> <br> '+R.message);
                        $('#myModalUploadForm, #myModalUploadFormPerNasabah').modal('hide');
                        //SUBSIDIBUNGAMEKAAR.get_list({});
                        $('#tbSubsidiBungaMekaar, #tbSubsidiBungaMekaarPerNasabah').DataTable().ajax.reload(null, false);
                    } else {
                        $('.js-alert-value').empty().append('<h2 class="text-danger text-uppercase">'+R.status +'</h2> <br> '+R.message);
                    }

                },
                error: function(e){
                    console.log(e);
                    $('#myModalAlert .modal-footer').removeClass('hide');
                    $('.js-alert-value').empty().append(
                            '<br><h2 class="text-danger text-uppercase">error</h2>'+
                            '<br>status : ' + e.status+
                            '<br>statusText : ' + e.statusText+
                            '<br>responseText : ' + e.responseText
                        );
                }
            });
            
        },
        
        get_list_nasabah_per_kelompok : function(d){
            
            console.log('inid',d['kelompokid']);
            
            $('.js-id-kelompok').empty().append(d['kelompok']);
            $('.js-bulan-subsidi-tahun-subsidi').empty().append(d['bulan_subsidi_tahun_subsidi']);
            $('.js-upload-form-post').attr({
                'data-kelompokid' : d['kelompokid'],
                'data-bulan_subsidi_tahun_subsidi' : d['bulan_subsidi_tahun_subsidi']
            });
			
            $('.js-input-kelompokid').val(d['kelompokid']);
            $('.js-input-bulan_subsidi_tahun_subsidi').val(d['bulan_subsidi_tahun_subsidi']);
            
            
            
            var table = $('#myTableListNasabahPerKelompok').DataTable({
                processing : true,
                serverSide : false,
                scrollY: '200px',
                scrollCollapse: true,
                destroy: true,
                bPaginate: false,
                searching: true,
                ordering: false,
                bSort: false,
                ajax: {
                    url : CONFIG.baseurl+"Subsidibungamekaar/list_nasabah_per_kelompok_api/",
                    type : 'POST',
                    data : { kelompokid : d['kelompokid'] , bulan_subsidi_tahun_subsidi : d['bulan_subsidi_tahun_subsidi'] }
                },
                columns : [
                    { "data": "nasabahid" },
                    { "data": "nasabahnama" },
                    {
                        "data": null,
                        "bSortable": false,
                        "mRender": function(data, type, full) {
                            console.log(data);					
                            var t = '<div class="col-md-12" style="padding: 0;">'+
                                    '<select class="form-control js-select-status" style="border-color: transparent;" data-id="'+data.id+'">'+
                                        '<option value="C">CAIR</option>'+
                                        '<option value="B">BATAL CAIR</option>'+
                                    '</select>'+
                                    '</div>';												   						
                            return t;
                        }
                    }
                ],
                initComplete: function(settings, json) {
                    $('.js-workingdate').empty().append(json.workingdate);
                    console.log(json);
                }
            });
            
            $(document).on('keyup','#myTableListNasabahPerKelompok_filter input',function(e){
                table.search( this.value ).draw();
                if ($(this).val()==''){
                    $('.js-upload-form-post').prop('disabled',false);
//                    $('.js-alert-clear-search').addClass('hide');
                    $('.js-upload-form-show-nasabah').addClass('hide');
                } else {
                    $('.js-upload-form-post').prop('disabled',true);
//                    $('.js-alert-clear-search').removeClass('hide');
                    $('.js-upload-form-show-nasabah').removeClass('hide');
                }
            });
            
            $(document).on('click','.js-upload-form-show-nasabah',function(e){
                e.preventDefault();
                $('#myTableListNasabahPerKelompok_filter input').val('');
                //table.search( $('#myTableListNasabahPerKelompok_filter input').val() ).draw();
                $('#myTableListNasabahPerKelompok_filter input').keyup();
            });
            
        },
        
        get_nasabah_detail : function(d){
            
            $.ajax({
                type    : "GET",
                url     : CONFIG.baseurl+"Subsidibungamekaar/get_nasabah_detail/?id="+d['id'],
                dataType: 'json',
                success : function(R){
                    if (R.status == true){
                        $('.js-input-id').val(R.data[0].id);
                        $('.js-input-nasabahid').val(R.data[0].nasabahid);
                        $('.js-input-kelompokid').val(R.data[0].kelompokid);
                        $('.js-input-bulan_subsidi_tahun_subsidi').val(R.data[0].bulan_subsidi_tahun_subsidi);
                        
                        $('.js-load-ufpn-periode').empty().append(R.data[0].bulan_subsidi_tahun_subsidi);
                        $('.js-load-ufpn-nasabahid').empty().append(R.data[0].nasabahid);
                        $('.js-load-ufpn-nasabahnama').empty().append(R.data[0].nasabahnama);
                        $('.js-load-ufpn-jumlah_subsidi').empty().append(R.data[0].jumlah_subsidi);
                        $('.js-load-ufpn-workingdate').empty().append(R.workingdate);
                    } else {
                        $('#myModalUploadFormLunas').modal('hide');
                        alert('Detail nasabah tidak ditemukan');
                        console.log(R);
                    }
                },
                error : function(R){
                    alert(R);
                    console.log(R);
                }
            });
            
        }

    },
    
    detail_realisasi : {
        
        open_modal_detail_realisasi : function(d){
            
            $('.js-load-dr-periode').empty().append(d['bulan_subsidi_tahun_subsidi']);
            $('.js-load-dr-kelompok').empty().append(d['kelompok']);
            
            $('#myTableListDetailRealisasi').DataTable({
                processing : true,
                serverSide : true,
                //scrollX: true,
                destroy: true,
                bSort: false,
                ajax: {
                    url : CONFIG.baseurl+"Subsidibungamekaar/list_detail_realisasi/",
                    type : 'POST',
                    data : {kelompokid : d['kelompokid'], bulan_subsidi_tahun_subsidi : d['bulan_subsidi_tahun_subsidi']}
                },
                columns : [
                    { "data": "gid" },
                    { "data": "tanggalrealisasipencairan" },
                    {
                        "data": null,
                        "bSortable": false,
                        "mRender": function(data, type, full) {
                            console.log(data);
                            var t = '<div class="row">'+
                           
                                        '<div class="col-md-6"><a href="'+CONFIG.basejasper+'LRSB.html?kelompokid='+data.kelompokid+'&periode='+data.bulan_subsidi_tahun_subsidi+'&v=2&gid='+data.gid+'" target="_blank" class="" data-kelompokid="'+data.kelompokid+'" data-bulan_subsidi_tahun_subsidi="'+data.bulan_subsidi_tahun_subsidi+'">Lihat Hasil Input</a></div>'+
                                    
                                        '<div class="col-md-6"><a href="'+CONFIG.basefile+'nasabahbelumlunas/'+data.filesource+'" class="" target="_blank" data-kelompokid="'+data.kelompokid+'" data-kelompok="'+data.kelompok+'" data-bulan_subsidi_tahun_subsidi="'+data.bulan_subsidi_tahun_subsidi+'">Lihat File Upload</a></div>'+
                                    
                                    '</div>';

                            return t;
                        }
                    }
                ]
            });
            
        },
        
        open_modal_detail_realisasi_per_nasabah : function(d){
            
            $('.js-load-drpn-nasabahnama').empty().append(d['nasabahnama']);
            $('.js-load-drpn-bulan_subsidi_tahun_subsidi').empty().append(d['bulan_subsidi_tahun_subsidi']);
            
            $('#myTableListDetailRealisasi').DataTable({
                processing : true,
                serverSide : true,
                //scrollX: true,
                destroy: true,
                bSort: false,
                ajax: {
                    url : CONFIG.baseurl+"Subsidibungamekaar/list_detail_realisasi_per_nasabah/",
                    type : 'POST',
                    data : {id : d['id'],type : 'pernasabah', kelompokid : d['kelompokid'], bulan_subsidi_tahun_subsidi : d['bulan_subsidi_tahun_subsidi']}
                },
                columns : [
                    { "data": "gid" },
                    { "data": "tanggalrealisasipencairan" },
                    {
                        "data": null,
                        "bSortable": false,
                        "mRender": function(data, type, full) {
                            console.log(data);
                            var t = '<div class="row">'+
                           
                                        '<div class="col-md-6"><a href="'+CONFIG.basejasper+'LRSB.html?kelompokid='+data.kelompokid+'&periode='+data.bulan_subsidi_tahun_subsidi+'&v=2&gid='+data.gid+'&id='+data.id+'" target="_blank">Lihat Hasil Input</a></div>'+
                                    
                                        '<div class="col-md-6"><a href="'+CONFIG.basefile+'nasabahbelumlunas/'+data.filesource+'" class="" target="_blank" >Lihat File Upload</a></div>'+
                                    
                                    '</div>';

                            return t;
                        }
                    }
                ]
            });
            
        }
        
    },
    
    init : function(){
        
        $(document).ready(function(){
            
            //console.log('subsidi bunga');
            
            $('.js-load-tbl-subsidibungamekaar').html(function(){
                SUBSIDIBUNGAMEKAAR.get_list({});
            });
            
            $('.js-load-tbl-subsidibungamekaar-pernasabah').html(function(){
                SUBSIDIBUNGAMEKAAR.get_list_per_nasabah({});
            });
            
            $(document).on('click','.js-upload-form-post',function(e){
                e.preventDefault();
                
                bootbox.confirm({
                    title: "Konfirmasi",
                    message: "Apakah Anda yakin ingin menyimpan data ini ?",
                    buttons: {
                        cancel: {
                            label: '<i class="fa fa-times"></i> Tidak'
                        },
                        confirm: {
                            label: '<i class="fa fa-check"></i> Ya'
                        }
                    },
                    callback: function (result) {
                        console.log('This was logged in the callback: ' + result);
                        if (result==true){
                            
                            var lns = $('#formUploadFile :input.js-select-status');
                
                            var F = [];

                            for (var i=0; i<lns.length; i++){

                                F.push({ 
                                    'id' : lns[i].getAttribute("data-id"),
                                    'status' : lns[i].value
                                });

                            }

                            //console.log('status_nasabah_list',F);

                            SUBSIDIBUNGAMEKAAR.upload_form.post({
                                kelompokid : $('.js-input-kelompokid').val(),
                                bulan_subsidi_tahun_subsidi : $('.js-input-bulan_subsidi_tahun_subsidi').val(),
                                status_nasabah_list : F,
                                tanggalrealisasipencairan : $('.js-tgl-realisasi').val()
                            });
                            
                        }
                    }
                });
                
                
            });
            
            $(document).on('click','.js-upload-form-pernasabah-post',function(e){
                e.preventDefault();
                
                bootbox.confirm({
                    title: "Konfirmasi",
                    message: "Apakah Anda yakin ingin menyimpan data ini ?",
                    buttons: {
                        cancel: {
                            label: '<i class="fa fa-times"></i> Tidak'
                        },
                        confirm: {
                            label: '<i class="fa fa-check"></i> Ya'
                        }
                    },
                    callback: function (result) {
                        if (result==true){
                            var F = [
                                {
                                    id : $('.js-input-id').val(),
                                    status : $('.js-input-ufpn-statuspencairan').val()
                                }
                            ];
                            SUBSIDIBUNGAMEKAAR.upload_form.post({
                                kelompokid : $('.js-input-kelompokid').val(),
                                bulan_subsidi_tahun_subsidi : $('.js-input-bulan_subsidi_tahun_subsidi').val(),
                                status_nasabah_list : F,
                                tanggalrealisasipencairan : $('.js-tgl-realisasi').val()
                            });
                        }
                    }
                });
                
                
            });
            
            $(document).on('click','.js-upload-form-modal',function(e){
                e.preventDefault();
                $('.js-input-kelompokid').val('');
                $('.js-input-bulan_subsidi_tahun_subsidi').val('');
                $('.js-myfile-upload-form').val('');
                $('.js-tgl-realisasi').val('');
                $('.js-upload-form-show-nasabah').addClass('hide');
                SUBSIDIBUNGAMEKAAR.upload_form.get_list_nasabah_per_kelompok({
                    kelompokid : $(this).data('kelompokid'),
                    kelompok : $(this).data('kelompok'),
                    bulan_subsidi_tahun_subsidi : $(this).data('bulan_subsidi_tahun_subsidi')
                });
                
            });
            
            $(document).on('click','.js-upload-form-pernasabah-modal',function(e){
                e.preventDefault();
                $('.js-input-id').val('');
                $('.js-input-kelompokid').val('');
                $('.js-input-bulan_subsidi_tahun_subsidi').val('');
                $('.js-myfile-upload-form').val('');
                $('.js-tgl-realisasi').val('');
                SUBSIDIBUNGAMEKAAR.upload_form.get_nasabah_detail({
                    id : $(this).data('id')
                });
            });
            
            $('.js-clear-file-upload-form').click(function(e){
                e.preventDefault();
                $('.js-myfile-upload-form').val('');
            });
            
            $(document).on('click','.js-detail-realisasi-modal',function(e){
                e.preventDefault();
                SUBSIDIBUNGAMEKAAR.detail_realisasi.open_modal_detail_realisasi({
                    kelompokid : $(this).data('kelompokid'),
                    kelompok : $(this).data('kelompok'),
                    bulan_subsidi_tahun_subsidi : $(this).data('bulan_subsidi_tahun_subsidi')
                });
            });
            
            $(document).on('click','.js-detail-realisasi-pernasabah-modal',function(e){
                e.preventDefault();
                SUBSIDIBUNGAMEKAAR.detail_realisasi.open_modal_detail_realisasi_per_nasabah({
                    type : 'pernasabah',
                    id : $(this).data('id'),
                    nasabahnama : $(this).data('nasabahnama'),
                    kelompokid : $(this).data('kelompokid'),
                    bulan_subsidi_tahun_subsidi : $(this).data('bulan_subsidi_tahun_subsidi')
                });
            });
            
            
             
        });
        
    } 
    
};
SUBSIDIBUNGAMEKAAR.init();

var SBMKRLUNAS = {
    
    table : function(d){
        $('#tbSBMkrLunas').DataTable({
            scrollX: true,
            destroy: true,
            data: d['data'],
            columns : [
                { "data": "regionid" },
                { "data": "region" },
                { "data": "areaid" },
                { "data": "area" },
                { "data": "cabangid" },
                { "data": "cabang" },
                { "data": "nasabahid" },
                { "data": "nasabahnama" }
            ]
        });
        
    },
    
    get_list : function(d){
        
        var regionid    = d['regionid'] ? d['regionid'] : '';
        var region      = d['region'] ? d['region'] : '';
        var areaid      = d['areaid'] ? d['areaid'] : '';
        var area        = d['area'] ? d['area'] : '';
        var cabangid    = d['cabangid'] ? d['cabangid'] : '';
        var cabang      = d['cabang'] ? d['cabang'] : '';
        var kelompokid  = d['kelompokid'] ? d['kelompokid'] : '';
        var kelompok    = d['kelompok'] ? d['kelompok'] : '';
      
        $('#tbSBMkrLunas').DataTable({
            processing : true,
            serverSide : true,
            //scrollX: true,
            destroy: true,
            bSort: false,
            ajax: {
                url : CONFIG.baseurl+"Sbmkrlunas/list_api/",
                type : 'POST',
                data : {regionid : regionid}
            },
            columns : [
                { "data": "regionid" },
                { "data": "region" },
                { "data": "areaid" },
                { "data": "area" },
                { "data": "cabangid" },
                { "data": "cabang" },
                { "data": "nasabahid" },
                { "data": "nasabahnama" },
                { "data": "bulan_subsidi_tahun_subsidi" },
                { "data": "is_pencairandone_desc" },
                {
                    "data": null,
                    "bSortable": false,
                    "mRender": function(data, type, full) {
                        console.log(data);
                        var t = '<div class="row">';
                        if (data.is_pencairandone=='N') {
                            t +=    '<div class="btn-group">'+
                                        '<div class="dropdown">'+
                                            '<button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown">'+
                                                'Form <span class="caret"></span>'+
                                            '</button>'+
                                            '<ul class="dropdown-menu">'+
                                              '<li><a href="'+CONFIG.basejasper+'LRSBL.pdf?id='+data.id+'&v=3" target="_blank">Lembar Pemberitahuan</a></li>'+
                                              '<li><a href="'+CONFIG.basejasper+'LRSBL.pdf?id='+data.id+'&v=1" target="_blank">Lembar Realisasi</a></li>'+
                                            '</ul>'+
                                        '</div>'+   
                                    '</div>'+
                                    
                                    '&nbsp;<div class="btn-group"><a class="btn btn-sm btn-warning col-md-12 js-upload-form-lunas-modal" data-id="'+data.id+'" data-toggle="modal" data-target="#myModalUploadFormLunas" >Upload Form</a></div>'
                                    ;
                        } 
//                        else if (data.is_pencairandone=='Y') {
//                            var t = '<div class="col-md-6"><a href="'+CONFIG.basejasper+'LRSBL.html?id='+data.id+'&v=2" target="_blank" class="" data-id="'+data.id+'" >Lihat Hasil Input</a></div>'+
//                                    ''+
//                                    '<div class="col-md-6"><a href="'+CONFIG.basefile+'nasabahlunas/'+data.filesource+'" class="" target="_blank" data-id="'+data.id+'" >Lihat File Upload</a></div>'
//                                    ;
//                        }
                        t += '&nbsp;<div class="btn-group"><a class="btn btn-sm btn-success js-detail-realisasi-lunas-modal" data-toggle="modal" data-target="#myModalDetailRealisasiLunas" data-id="'+data.id+'" data-nasabahnama="'+data.nasabahnama+'" data-bulan_subsidi_tahun_subsidi="'+data.bulan_subsidi_tahun_subsidi+'">Detail Realisasi</a></div>'+
                             '</div>';
                        return t;
                    }
                }
            ]
        });
        
    },
    
    upload_form_lunas : {
      
        get_nasabah_detail : function(d){
            
            $.ajax({
                type    : "GET",
                url     : CONFIG.baseurl+"Sbmkrlunas/get_nasabah_detail/?id="+d['id'],
                dataType: 'json',
                success : function(R){
                    if (R.status == true){
                        $('.js-input-ufl-id').val(R.data[0].id);
                        $('.js-load-ufl-periode').empty().append(R.data[0].bulan_subsidi_tahun_subsidi);
                        $('.js-load-ufl-nasabahid').empty().append(R.data[0].nasabahid);
                        $('.js-load-ufl-nasabahnama').empty().append(R.data[0].nasabahnama);
                        $('.js-load-ufl-jumlah_subsidi').empty().append(R.data[0].jumlah_subsidi);
                        $('.js-load-ufl-workingdate').empty().append(R.workingdate);
                    } else {
                        $('#myModalUploadFormLunas').modal('hide');
                        alert('Detail nasabah tidak ditemukan');
                        console.log(R);
                    }
                },
                error : function(R){
                    alert(R);
                    console.log(R);
                }
            });
            
        },
        
        post : function(d){
            
            console.log('myd',d);
            
            $('#myModalAlert').modal('show');
            $('.js-alert-value').empty().append('<h2 class="text-warning">Please waiting ...</h2>');
            $('.js-percent-progress-upload').empty().append('');
            $('.js-percent-progress-download').empty().append('');

            var fd = new FormData();
            var f = $('.js-myfile-upload-form-lunas').prop('files')[0];
            
            fd.append('file', f);
            fd.append('id', d['id']);
            fd.append('statuspencairan', d['statuspencairan']);
            fd.append('tanggalrealisasipencairan', d['tanggalrealisasipencairan']);

            $.ajax({
                url: CONFIG.baseurl+"Sbmkrlunas/post_upload_form_lunas_api/",
                type: "POST",
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: fd,
                xhr: function () {

                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener("progress", function(evt){
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                         $('.js-percent-progress-upload').html('Upload : ' + Math.round(percentComplete * 100) + "%");
                        //Do something with upload progress
                        console.log(percentComplete);
                      }
                    }, false);
                    //Download progress
                    xhr.addEventListener("progress", function(evt){
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        //$('.js-percent-progress-download').html(' | Download : ' + Math.round(percentComplete * 100) + "%");
                        //Do something with download progress
                        console.log(percentComplete);
                      }
                    }, false);
                    return xhr;
                },
                success : function(R){

                    console.log(R);
                    
                    $('#myModalAlert .modal-footer').removeClass('hide');

                    if (R.status == 'success') {
                        $('.js-myfile-upload-form-lunas').val('');
                        $('.js-alert-value').empty().append('<h2 class="text-success text-uppercase">'+R.status +'</h2> <br> '+R.message);
                        $('#myModalUploadFormLunas').modal('hide');
                        //SBMKRLUNAS.get_list({});
                        $('#tbSBMkrLunas').DataTable().ajax.reload(null, false);
                    } else {
                        $('.js-alert-value').empty().append('<h2 class="text-danger text-uppercase">'+R.status +'</h2> <br> '+R.message);
                    }

                },
                error: function(e){
                    console.log(e);
                    $('#myModalAlert .modal-footer').removeClass('hide');
                    $('.js-alert-value').empty().append(
                            '<br><h2 class="text-danger text-uppercase">error</h2>'+
                            '<br>status : ' + e.status+
                            '<br>statusText : ' + e.statusText+
                            '<br>responseText : ' + e.responseText
                        );
                }
            });
            
        }
        
    },
    
    detail_realisasi : {
        
        open_modal_detail_realisasi : function(d){
            
            $('.js-load-drl-nasabahnama').empty().append(d['nasabahnama']);
            $('.js-load-drl-bulan_subsidi_tahun_subsidi').empty().append(d['bulan_subsidi_tahun_subsidi']);
            
            $('#myTableListDetailRealisasi').DataTable({
                processing : true,
                serverSide : true,
                //scrollX: true,
                destroy: true,
                bSort: false,
                ajax: {
                    url : CONFIG.baseurl+"Sbmkrlunas/list_detail_realisasi/",
                    type : 'POST',
                    data : {id : d['id']}
                },
                columns : [
                    { "data": "gid" },
                    { "data": "tanggalrealisasipencairan" },
                    {
                        "data": null,
                        "bSortable": false,
                        "mRender": function(data, type, full) {
                            console.log(data);
                            var t = '<div class="row">'+
                           
                                        '<div class="col-md-6"><a href="'+CONFIG.basejasper+'LRSBL.html?id='+data.id+'&v=2&gid='+data.gid+'" target="_blank">Lihat Hasil Input</a></div>'+
                                        
                                        '<div class="col-md-6"><a href="'+CONFIG.basefile+'nasabahlunas/'+data.filesource+'" target="_blank">Lihat File Upload</a></div>'+
                                        
                                    '</div>';

                            return t;
                        }
                    }
                ]
            });
            
        }
        
    },
    
    init : function(){
        
        $(document).ready(function(){
            
            $('.js-load-tbl-sbmkrlunas').html(function(){
                SBMKRLUNAS.get_list({});
            });
            
            $(document).on('click','.js-upload-form-lunas-modal',function(e){
                e.preventDefault();
                $('#formUploadLunasFile .js-input-ufl-id').val('');
                $('#formUploadLunasFile .js-myfile-upload-form-lunas').val('');
                $('#formUploadLunasFile .js-input-ufl-statuspencairan').val('C');
                $('#formUploadLunasFile .js-tgl-realisasi-lunas').val('');
                SBMKRLUNAS.upload_form_lunas.get_nasabah_detail({
                    id : $(this).data('id')
                });
            });
            
            $(document).on('click','.js-upload-form-lunas-post',function(e){
                e.preventDefault();
                bootbox.confirm({
                    title: "Konfirmasi",
                    message: "Apakah Anda yakin ingin menyimpan data ini ?",
                    buttons: {
                        cancel: {
                            label: '<i class="fa fa-times"></i> Tidak'
                        },
                        confirm: {
                            label: '<i class="fa fa-check"></i> Ya'
                        }
                    },
                    callback: function (result) {
                        console.log('This was logged in the callback: ' + result);
                        if (result==true){
                            SBMKRLUNAS.upload_form_lunas.post({
                                id : $('#formUploadLunasFile .js-input-ufl-id').val(),
                                statuspencairan : $('#formUploadLunasFile .js-input-ufl-statuspencairan').val(),
                                tanggalrealisasipencairan : $('#formUploadLunasFile .js-tgl-realisasi-lunas').val()
                            });
                        }
                    }
                });

            });
            
            $('.js-clear-file-upload-form-lunas').click(function(e){
                e.preventDefault();
                $('.js-myfile-upload-form-lunas').val('');
            });
            
            $(document).on('click','.js-detail-realisasi-lunas-modal',function(e){
                e.preventDefault();
                SBMKRLUNAS.detail_realisasi.open_modal_detail_realisasi({
                    id : $(this).data('id'),
                    nasabahnama : $(this).data('nasabahnama'),
                    bulan_subsidi_tahun_subsidi : $(this).data('bulan_subsidi_tahun_subsidi')
                });
            });
            
        });
        
    } 
    
};
SBMKRLUNAS.init();


var REPORT = {
    
    saldo_detail : {
        
        list : function(d){
            
            $('#tbReportSaldoDetail').DataTable({
                processing : true,
                serverSide : true,
                //scrollX: true,
                destroy: true,
                bSort: false,
                ajax: {
                    url : CONFIG.baseurl+"Report/get_saldo_detail_api/",
                    type : 'POST',
                    data : {}
                },
                columns : [
                    { "data": "cabangid" },
                    { "data": "bulantahun" },
                    { "data": "tanggalrealisasipencairan" },
                    { "data": "total_saldo" },
                    { "data": "createddate" }
                ],
                initComplete: function(settings, json) {
                    console.log(json);
                    $('#tbReportSaldoDetail tbody tr').find("td:eq(3)").unmask().mask(CONFIG.numbermask, {reverse: true});
                }
            });
            
        }
        
    },
    
    init : function() {
        
        $(document).ready(function(){
            
            $('.js-load-tbl-report-saldo-detail').html(function(){
                REPORT.saldo_detail.list({});
            });
            
        });
        
    }
    
};
REPORT.init();

var BANSOS = {
    
    get_list : function(d){
        
        var regionid    = d['regionid'] ? d['regionid'] : '';
        var region      = d['region'] ? d['region'] : '';
        var areaid      = d['areaid'] ? d['areaid'] : '';
        var area        = d['area'] ? d['area'] : '';
        var cabangid    = d['cabangid'] ? d['cabangid'] : '';
        var cabang      = d['cabang'] ? d['cabang'] : '';
        var kelompokid  = d['kelompokid'] ? d['kelompokid'] : '';
        var kelompok    = d['kelompok'] ? d['kelompok'] : '';
      
        $('#tbBansos').DataTable({
            processing : true,
            serverSide : true,
            //scrollX: true,
            destroy: true,
            bSort: false,
            ajax: {
                url : CONFIG.baseurl+"Bansos/list_api/",
                type : 'POST',
                data : {regionid : regionid}
            },
            columns : [
//                { "data": "regionid" },
//                { "data": "region" },
                { "data": "regioncombine" },
//                { "data": "areaid" },
//                { "data": "area" },
                { "data": "areacombine" },
//                { "data": "cabangid" },
//                { "data": "cabang" },
                { "data": "cabangcombine" },
                { "data": "kelompokid" },
                //{ "data": "kelompok" },
                {
                    "data": null,
                    "bSortable": false,
                    "mRender": function(data, type, full) {
                        console.log(data);
                        return '<a href="'+CONFIG.basejasper+'MAIN_SP.pdf?kelompokid='+data.kelompokid+'" style="display: inline-block;width: 120px;white-space: nowrap;overflow: hidden !important;text-overflow: ellipsis;" data-toggle="tooltip" title="Print semua surat pernyataan nasabah di '+data.kelompok+'" target="_blank"><span class="fa fa-clone"></span> Print '+data.kelompok+'</a>';
                    }
                },
                { "data": "nasabahid" },
                { "data": "nasabahnama" },
                { "data": "norek" },
                { "data": "is_pencairandone_desc" },
                {
                    "data": null,
                    "bSortable": false,
                    "mRender": function(data, type, full) {
                        console.log(data);
                        var t = '<div class="row" style="white-space: nowrap;">';
                        if (data.is_pencairandone=='N') {
                            t +=    '<div class="btn-group">'+
                                        '<div class="dropdown">'+
                                            '<button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown">'+
                                                'Print <span class="caret"></span>'+
                                            '</button>'+
                                            '<ul class="dropdown-menu">'+
                                              '<li><a href="'+CONFIG.basejasper+'SP.pdf?id='+data.id+'" target="_blank">Surat Pernyataan Nasabah '+data.nasabahnama+'</a></li>'+
                                            '</ul>'+
                                        '</div>'+   
                                    '</div>'+
                                    
                                    '&nbsp;<div class="btn-group"><a class="btn btn-sm btn-warning col-md-12 js-upload-form-bansos-modal" data-id="'+data.id+'" data-toggle="modal" data-target="#myModalUploadFormBansos" >Upload Form</a></div>'
                                    ;
                        } 
                        t += '&nbsp;<div class="btn-group"><a class="btn btn-sm btn-success js-detail-realisasi-bansos-modal" data-toggle="modal" data-target="#myModalDetailRealisasiBansos" data-id="'+data.id+'" data-nasabahnama="'+data.nasabahnama+'">Detail</a></div>'+
                             '</div>';
                        return t;
                    }
                }
            ],
            initComplete: function(settings, json) {
                $('[data-toggle="tooltip"]').tooltip();
                console.log(json);
            }
        });
        
    },
    
    get_list_per_kelompok : function(){
        
        
        
    },
    
    upload_form_bansos : {
      
        get_nasabah_detail : function(d){
            
            $.ajax({
                type    : "GET",
                url     : CONFIG.baseurl+"Bansos/get_nasabah_detail/?id="+d['id'],
                dataType: 'json',
                success : function(R){
                    if (R.status == true){
                        $('.js-input-ufb-id').val(R.data[0].id);
                        $('.js-load-ufb-nasabahid').empty().append(R.data[0].nasabahid);
                        $('.js-load-ufb-nasabahnama').empty().append(R.data[0].nasabahnama);
                    } else {
                        $('#myModalUploadFormBansos').modal('hide');
                        alert('Detail nasabah tidak ditemukan');
                        console.log(R);
                    }
                },
                error : function(R){
                    alert(R);
                    console.log(R);
                }
            });
            
        },
        
        post : function(d){
            
            console.log('myd',d);
            
            $('#myModalAlert').modal('show');
            $('.js-alert-value').empty().append('<h2 class="text-warning">Please waiting ...</h2>');
            $('.js-percent-progress-upload').empty().append('');
            $('.js-percent-progress-download').empty().append('');

            var fd = new FormData();
            var f = $('.js-myfile-upload-form-bansos').prop('files')[0];
            
            fd.append('file', f);
            fd.append('id', d['id']);
            fd.append('statuspencairan', d['statuspencairan']);

            $.ajax({
                url: CONFIG.baseurl+"Bansos/post_upload_form_bansos_api/",
                type: "POST",
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: fd,
                xhr: function () {

                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener("progress", function(evt){
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                         $('.js-percent-progress-upload').html('Upload : ' + Math.round(percentComplete * 100) + "%");
                        //Do something with upload progress
                        console.log(percentComplete);
                      }
                    }, false);
                    //Download progress
                    xhr.addEventListener("progress", function(evt){
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        //$('.js-percent-progress-download').html(' | Download : ' + Math.round(percentComplete * 100) + "%");
                        //Do something with download progress
                        console.log(percentComplete);
                      }
                    }, false);
                    return xhr;
                },
                success : function(R){

                    console.log(R);
                    
                    $('#myModalAlert .modal-footer').removeClass('hide');

                    if (R.status == 'success') {
                        $('.js-myfile-upload-form-bansos').val('');
                        $('.js-alert-value').empty().append('<h2 class="text-success text-uppercase">'+R.status +'</h2> <br> '+R.message);
                        $('#myModalUploadFormBansos').modal('hide');
                        $('#tbBansos').DataTable().ajax.reload(null, false);
                    } else {
                        $('.js-alert-value').empty().append('<h2 class="text-danger text-uppercase">'+R.status +'</h2> <br> '+R.message);
                    }

                },
                error: function(e){
                    console.log(e);
                    $('#myModalAlert .modal-footer').removeClass('hide');
                    $('.js-alert-value').empty().append(
                            '<br><h2 class="text-danger text-uppercase">error</h2>'+
                            '<br>status : ' + e.status+
                            '<br>statusText : ' + e.statusText+
                            '<br>responseText : ' + e.responseText
                        );
                }
            });
            
        }
        
    },
    
    detail_realisasi : {
        
        open_modal_detail_realisasi : function(d){
            
            $('.js-load-drb-nasabahnama').empty().append(d['nasabahnama']);
            
            $('#myTableListDetailRealisasi').DataTable({
                processing : true,
                serverSide : true,
                //scrollX: true,
                destroy: true,
                bSort: false,
                ajax: {
                    url : CONFIG.baseurl+"Bansos/list_detail_realisasi/",
                    type : 'POST',
                    data : {id : d['id']}
                },
                columns : [
                    { "data": "gid" },
                    { "data": "createddate" },
                    {
                        "data": null,
                        "bSortable": false,
                        "mRender": function(data, type, full) {
                            console.log(data);
                            var t = '<div class="row">'+
                                        '<div class="col-md-6"><a href="'+CONFIG.basefile+'bansos/'+data.filesource+'" target="_blank">Lihat File Upload</a></div>'+
                                        '<div class="col-md-6"><a href="#" class="js-upload-form-bansos-modal" data-id="'+data.tbl_bansos_nasabah_id+'" data-toggle="modal" data-target="#myModalUploadFormBansos">Edit File Upload</a></div>'+
                                    '</div>';

                            return t;
                        }
                    }
                ]
            });
            
        }
    },
    
    init : function(){
        
        $(document).ready(function(){
            
            $('.js-load-tbl-bansos').html(function(){
                BANSOS.get_list({});
            });
            
            $(document).on('click','.js-upload-form-bansos-modal',function(e){
                e.preventDefault();
                $('#myModalDetailRealisasiBansos').modal('hide');
                $('#formUploadBansosFile .js-input-ufb-id').val('');
                $('#formUploadBansosFile .js-myfile-upload-form-bansos').val('');
                BANSOS.upload_form_bansos.get_nasabah_detail({
                    id : $(this).data('id')
                });
            });
            
            $(document).on('click','.js-upload-form-bansos-post',function(e){
                e.preventDefault();
                bootbox.confirm({
                    title: "Konfirmasi",
                    message: "Apakah Anda yakin ingin menyimpan data ini ?",
                    buttons: {
                        cancel: {
                            label: '<i class="fa fa-times"></i> Tidak'
                        },
                        confirm: {
                            label: '<i class="fa fa-check"></i> Ya'
                        }
                    },
                    callback: function (result) {
                        console.log('This was logged in the callback: ' + result);
                        if (result==true){
                            BANSOS.upload_form_bansos.post({
                                id : $('#formUploadBansosFile .js-input-ufb-id').val(),
                                statuspencairan : 'C'
                            });
                        }
                    }
                });

            });
            
            $('.js-clear-file-upload-form-bansos').click(function(e){
                e.preventDefault();
                $('.js-myfile-upload-form-bansos').val('');
            });
            
            $(document).on('click','.js-detail-realisasi-bansos-modal',function(e){
                e.preventDefault();
                BANSOS.detail_realisasi.open_modal_detail_realisasi({
                    id : $(this).data('id'),
                    nasabahnama : $(this).data('nasabahnama')
                });
            });
            
        });
        
    }
    
};
BANSOS.init();