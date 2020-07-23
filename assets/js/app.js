var CONFIG = {
    
    baseurl : $('html').data('baseurl'),
    
    basejasper : 'http://10.61.3.77:8080/jasperserver/rest_v2/reports/reports/SB/'
    
};

var GLOBAL = {
    
    init : function(){
        
        $(document).ready(function(){
            $('#datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });
            $('#myModalAlert').on('hidden.bs.modal', function () {
                 $('.js-alert-value').empty().append();
            });
        });
        
    }
    
};
GLOBAL.init();

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
                { "data": "is_pencairandone_desc" },
                {
                    "data": null,
                    "bSortable": false,
                    "mRender": function(data, type, full) {
                        console.log(data);
                        if (data.is_pencairandone=='N') {
                            var t = '<div class="btn-group col-md-6"><a href="'+CONFIG.basejasper+'LRSB.pdf?kelompokid='+data.kelompokid+'&v=1" target="_blank" class="btn btn-sm btn-info col-md-12" data-kelompokid="'+data.kelompokid+'" >Form</a></div>'+
                                    ''+
                                    '<div class="btn-group col-md-6"><a class="btn btn-sm btn-warning col-md-12 js-upload-form-modal" data-kelompokid="'+data.kelompokid+'" data-kelompok="'+data.kelompok+'" data-toggle="modal" data-target="#myModalUploadForm" >Upload Form</a></div>'
                                    ;
                        } else if (data.is_pencairandone=='Y') {
                            var t = '<div class="col-md-6"><a href="'+CONFIG.basejasper+'LRSB.html?kelompokid='+data.kelompokid+'&v=2" target="_blank" class="" data-kelompokid="'+data.kelompokid+'" >Lihat Hasil Input</a></div>'+
                                    ''+
                                    '<div class="col-md-6"><a href="'+CONFIG.baseurl+'assets/files/'+data.filesource+'" class="" target="_blank" data-kelompokid="'+data.kelompokid+'" data-kelompok="'+data.kelompok+'" >Lihat File Upload</a></div>'
                                    ;
                        }
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
                        $('#myModalUploadForm').modal('hide');
                        SUBSIDIBUNGAMEKAAR.get_list({});
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
            $('.js-upload-form-post').attr({
                'data-kelompokid' : d['kelompokid']
            });
            
            $('#myTableListNasabahPerKelompok').DataTable({
                processing : true,
                serverSide : false,
                scrollY: true,
                destroy: true,
                bPaginate: false,
                searching: false,
                ordering: false,
                ajax: {
                    url : CONFIG.baseurl+"Subsidibungamekaar/list_nasabah_per_kelompok_api/",
                    type : 'POST',
                    data : { kelompokid : d['kelompokid'] }
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
            
            $(document).on('click','.js-upload-form-post',function(e){
                e.preventDefault();
                
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
                    kelompokid : $(this).data('kelompokid'),
                    status_nasabah_list : F,
                    tanggalrealisasipencairan : $('.js-tgl-realisasi').val()
                });
            });
            
            $(document).on('click','.js-upload-form-modal',function(e){
                e.preventDefault();
                $('.js-myfile-upload-form').val('');
                $('.js-tgl-realisasi').val('');
                SUBSIDIBUNGAMEKAAR.upload_form.get_list_nasabah_per_kelompok({
                    kelompokid : $(this).data('kelompokid'),
                    kelompok : $(this).data('kelompok')
                });
                
            });
            
            $('.js-clear-file-upload-form').click(function(e){
                e.preventDefault();
                $('.js-myfile-upload-form').val('');
            });
             
        });
        
    } 
    
};
SUBSIDIBUNGAMEKAAR.init();

