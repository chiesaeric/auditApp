$(document).ready(function() {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    // get Edit User
    $('.btn-edit-users').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        const name = $(this).data('name');
        const username = $(this).data('username');
        const password = $(this).data('password');
        const tipe = $(this).data('tipe');

        // Set data to Form Edit
        $('.id-users').val(id);
        $('.nama-users').val(name);
        $('.username').val(username);
        $('.password').val(password);
        $('.tipe').val(tipe);
        // Call Modal Edit
        $('#editModal-users').modal('show');
    });

    // get Delete User
    $('.btn-status-deactive').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.id-users').val(id);
        // Call Modal Edit
        $('#statusModal-active').modal('show');
    });

    // get Delete User
    $('.btn-status-active').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.id-users').val(id);
        // Call Modal Edit
        $('#statusModal-deactive').modal('show');
    });

    $('.btn-finish-task').on('click', function() {
        // get data from button edit
        const id = $(this).data('idaudit');
        // Set data to Form Edit
        $('.id-audit-finish').val(id);
        // Call Modal Edit
        $('#finishModal-task').modal('show');
    });

    // get Delete User
    $('.btn-hapus-users').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.id-users').val(id);
        // Call Modal Edit
        $('#deleteModal-users').modal('show');
    });

    //get Update Category
    $('.btn-edit-category').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        const name = $(this).data('title');
        const tipe = $(this).data('tipe');
        // Set data to Form Edit
        $('.id-category').val(id);
        $('.title-category').val(name);
        $('.tipe-category').val(tipe).trigger('change');
        $('.tipe-category-main').val(tipe).trigger('change');
        // Call Modal Edit
        $('#editModal-category').modal('show');
    });

    //get Update Category
    $('.btn-duplicate-category').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        const tipe = $(this).data('tipe');
        // Set data to Form Edit
        $('.id-category-dup').val(id);
        $('.tipe-category-dup').val(tipe);
        // Call Modal Edit
        $('#duplicateModal-category').modal('show');
    });

    //Get Delete Category
      // get Delete User
      $('.btn-hapus-category').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.id-category').val(id);
        // Call Modal Edit
        $('#deleteModal-category').modal('show');
    });

    //get Update Chekpoint
    $('.btn-update-cp').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        const name = $(this).data('title');
        const clausal = $(this).data('clausal');
        const evidence = $(this).data('evidence');
        const description = $(this).data('desc');
        const id_area = $(this).data('area');
        // Set data to Form Edit
        $('.id').val(id);
        $('.title').val(name);
        $('.clausal').val(clausal);
        $('.evidence').val(evidence);
        $('.description').val(description);
        $('.area-ubah').val(id_area);
        // Call Modal Edit
        $('#editModal-cp').modal('show');
    });

    //get Update Chekpoint
    $('.btn-edit-cp-ms').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        const name = $(this).data('name');
        const clausal = $(this).data('clausal');
        const evidence = $(this).data('evidence');
        const description = $(this).data('description');
        const id_area = $(this).data('area');
        // Set data to Form Edit
        $('.id-cp-ms').val(id);
        $('.title-cp-ms').val(name);
        $('.clausal-cp-ms').val(clausal);
        $('.evidence-cp-ms').val(evidence);
        $('.description-cp-ms').val(description);
        $('.id-area-cp-ms').val(id_area);
        // Call Modal Edit
        $('#editModal-cp-ms').modal('show');
    });

        //get Update Chekpoint
        $('.btn-update-ver').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const name = $(this).data('title');
            const clausal = $(this).data('clausal');
            const evidence = $(this).data('evidence');
            const description = $(this).data('desc');
            const id_area = $(this).data('area');
            // Set data to Form Edit
            $('.id-ver').val(id);
            $('.title-ver').val(name);
            $('.clausal-ver').val(clausal);
            $('.evidence-ver').val(evidence);
            $('.description-ver').val(description);
            $('.area-ubah-ver').val(id_area);
            // Call Modal Edit
            $('#editModal-ver').modal('show');
        });

       //Get Delete Checkpoint
      $('.btn-hapus-cp').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.id').val(id);
        // Call Modal Edit
        $('#deleteModal-cp').modal('show');
    });

       //Get Delete Checkpoint
       $('.btn-hapus-cp-ms').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.id').val(id);
        // Call Modal Edit
        $('#deleteModal-cp-ms').modal('show');
    });

    $('.btn-update-area').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        const name = $(this).data('nama');
        // Set data to Form Edit
        $('.id-area').val(id);
        $('.nama-area').val(name);
        // Call Modal Edit
        $('#editModal-area').modal('show');
    });

        //Get Delete Checkpoint
    $('.btn-hapus-area').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.id').val(id);
        // Call Modal Edit
        $('#deleteModal-area').modal('show');
    });

    $('.btn-audity-audit').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.id-area').val(id);
        // Call Modal Edit
        $('#audityModal-audit').modal('show');
    });

    $('.btn-edit-audit').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        const name = $(this).data('name');
        const assigne = $(this).data('assigne');
        const category = $(this).data('category');
        let deadline = $(this).data('deadline');
        let date = deadline.split(" ")[0];
        let time = deadline.split(" ")[1];
        const dateArr = date.split("-");
        const timeArr = time.split(":");
        var fixDate = dateArr[1]+"/"+dateArr[2]+"/"+dateArr[0];
        var fixTime = "";
        if(timeArr[0] >= 12){
            var timeTemp = timeArr[0]-12;
            if(timeTemp.length==1 && timeTemp!=0){
                timeTemp = "0"+timeTemp;
            }else if(timeTemp==0){
                timeTemp = parseInt(timeTemp)+12;
            }
            fixTime = timeTemp+":"+timeArr[1]+" PM";
        }else{
            fixTime = timeArr[0]+":"+timeArr[1]+" AM";
        }

        //Set data to Form Edit
        $('.id-audit').val(id);
        $(".task-name").val(name);
        $(".assigne").val(assigne).trigger('change');
        $(".id-category").val(category).trigger('change');
        $('.deadline').val(fixDate+" "+fixTime);
        // Call Modal Edit
        $('#editModal-audit').modal('show');
    });

    $('.btn-hapus-audit').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.id-audit').val(id);
        // Call Modal Edit
        $('#deleteModal-audit').modal('show');
    });

    $('.btn-approve-audit').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.id-audit').val(id);
        // Call Modal Edit
        $('#approveModal-audit').modal('show');
    });

    $('.btn-report-audit').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.id-audit-report').val(id);
        // Call Modal Edit
        $('#reportModal-audit').modal('show');
    });

    $('.btn-dokumen-pdf').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        const url = window.location.origin;
        $('.id-pdf').attr('src',url+"/img"+id);
        // Call Modal Edit
        $('#dokumenModal-pdf').modal('show');
    });
    $('.btn-dokumen-jpg').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        const url = window.location.origin;
        $('.id-jpg').attr('src',url+"/img"+id);
        // Call Modal Edit
        $('#dokumenModal-jpg').modal('show');
    });

    $('#id-tipe-bulk').change(function(){
        console.log("yeay")
        var tipe=$(this).val();
        if(tipe=="proses"){
            $.ajax({
                url : "/check/getDataByTipe",
                method : "POST",
                data : {id: "proses"},
                async : true,
                dataType : 'json',
                success: function(data){
                   var html = '';
                   html += '<option value="#">--Pilih Category--</option>';
                   for(var i=0;i<data.length;i++){
                    html += '<option value="'+data[i].id_category+'">'+data[i].title+'</option>';
                   }
                   $('#id-category-bulk').html(html);
                }
            });
        }else if(tipe=="verification"){
            $.ajax({
                url : "/check/getDataByTipe",
                method : "POST",
                data : {id: "proses"},
                async : true,
                dataType : 'json',
                success: function(data){
                   var html = '';
                   html += '<option value="#">--Pilih Category--</option>';
                   for(var i=0;i<data.length;i++){
                    html += '<option value="'+data[i].id_category+'">'+data[i].title+'</option>';
                   }
                   $('#id-category-bulk').html(html);
                }
            });
        }else if(tipe=="system"){
            $.ajax({
                url : "/check/getDataByTipe",
                method : "POST",
                data : {id: "system"},
                async : true,
                dataType : 'json',
                success: function(data){
                   var html = '';
                   html += '<option value="#">--Pilih Category--</option>';
                   for(var i=0;i<data.length;i++){
                    html += '<option value="'+data[i].id_category+'">'+data[i].title+'</option>';
                   }
                   $('#id-category-bulk').html(html);
                }
            });
        }
        $('#id-area-bulk').html('<option value="#">--Pilih Area--</option>')
    });

    $('#id-category-bulk').change(function(){
        var id=$(this).val();
        var tipe=$("#id-tipe-bulk").val();
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });

        if(tipe=="#"){
            toastr.error('Pilih tipe terlebih dahulu.')
        }
        console.log(tipe);
        if(tipe=="proses"){
            $.ajax({
                url : "getDataAreaById",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success: function(data){
                    console.log(data);
                    var html = '';
                    html += '<option value="#">--Pilih Area--</option>';
                    for(var i=0;i<data.length;i++){
                        if(data[i].nama_area!="verification"){
                            html += '<option value="'+data[i].id_area+'">'+data[i].nama_area+'</option>';
                        }
                    }
                    $('#id-area-bulk').html(html);
                }
            });
        }else if(tipe=="system" || tipe=="verification"){
            console.log("masuk ke system nih");
            $.ajax({
                url : "getDataAreaById",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success: function(data){
                    console.log(data);
                    var html = '';
                    html += '<option value="'+data[0].id_area+'" selected>tidak ada area</option>';
                    $('#id-area-bulk').html(html);
                }
            });
        }

 
    });
    
    $('#id_category_detail').change(function(){ 
        var id=$(this).val();
        var id_area=$('#id-area-system').val();
        $.ajax({
            url : "getData",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){
                 console.log(data);
                var html = '';
                var i;
                var c=0;
                if(data.length==0){
                    html += '<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>';
                }else{
                    for(i=0; i<data.length; i++){
                        c=c+1;
                        html += '<tr>';
                        html += '<td>'+c+'</td>';
                        html += '<td>'+data[i].title_cp+'</td>';
                        html += '<td>'+data[i].clausal+'</td>';
                        html += '<td style="text-align: center;"><input type="checkbox" name="check'+c+'" id=""></td>'
                        html += '</tr>';
                        html += '<input type="hidden" name="title_cp'+c+'" id="" value="'+data[i].title_cp+'">';
                        html += '<input type="hidden" name="clausal'+c+'" id="" value="'+data[i].clausal+'">';
                        html += '<input type="hidden" name="evidence'+c+'" id="" value="'+data[i].evidence+'">';
                        html += '<input type="hidden" name="tipe'+c+'" id="" value="'+data[i].tipe+'">';
                        html += '<input type="hidden" name="description'+c+'" id="" value="'+data[i].description+'">';
                        html += '<input type="hidden" name="id_area'+c+'" id="" value="'+id_area+'">';
                    }
                }
                $('#tr_checkpoint').html(html);

                var html2 = '<input type="hidden" name="count" id="" value="'+c+'">';
                $('#div_count_cp').html(html2);
            }
        });
        return false;
    }); 



    $('#id_category_detail_proses').change(function(){ 
        console.log("Yeayys");
        var id=$(this).val();
        var id_cat_current = $('#id_category').val();
        $.ajax({
            url : "getDataProses",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){
                console.log(data);
                var html = '';
                var i;
                var c=0;
                if(data.length==0){
                    html += '<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>';
                }else{
                    for(i=0; i<data.length; i++){
                        c=c+1;
                        html += '<tr>';
                        html += '<td>'+c+'</td>';
                        html += '<td>'+data[i].title_cp+'</td>';
                        html += '<td>';
                        html += '<select name="id_area'+c+'" class="form-control area-bulk select2bs4">';
                        html += '</select>';
                        html += '</td>';
                        html += '<td style="text-align: center;"><input type="checkbox" name="check'+c+'" id=""></td>'
                        html += '</tr>';
                        html += '<input type="hidden" name="title_cp'+c+'" id="" value="'+data[i].title_cp+'">';
                        html += '<input type="hidden" name="evidence'+c+'" id="" value="'+data[i].evidence+'">';
                        html += '<input type="hidden" name="tipe'+c+'" id="" value="'+data[i].tipe+'">';
                        html += '<input type="hidden" name="description'+c+'" id="" value="'+data[i].description+'">';
                    }
                }
                $('#tr_checkpointProses').html(html);

                var html2 = '<input type="hidden" name="count" id="" value="'+c+'">';
                $('#div_count_cp_proses').html(html2);
            },
            complete:function(){
                $.ajax({
                    url : "getDataArea",
                    method : "POST",
                    data : {id: id_cat_current},
                    async : true,
                    dataType : 'json',
                    success: function(datas){
                        console.log(datas);
                        var htmlArea = '';
                        for(var a=0; a<datas.length; a++){
                        htmlArea += '<option value="'+datas[a].id_area+'">'+datas[a].nama_area+'</option>';
                        }
                        $('.area-bulk').append(htmlArea);
                    }
                });
            }
        });
        return false;
    }); 

    $('#choose-tipe-cp-ms').change(function(){
        var tipe=$(this).val();
        if(tipe=="proses"){
            $('#toptitle').text('(Optional)');
            $("#clausal-cp-ms").attr("required", false);
            $("#id-area-cp").attr("readonly", false);
            $.ajax({
                url : "/check/getDataByTipe",
                method : "POST",
                data : {id: "proses"},
                async : true,
                dataType : 'json',
                success: function(data){
                   var html = '';
                   html += '<option value="#">--Pilih Category--</option>';
                   for(var i=0;i<data.length;i++){
                    html += '<option value="'+data[i].id_category+'">'+data[i].title+'</option>';
                   }
                   $('#id-category-cp').html(html);
                }
            });
        }else if(tipe=="verification"){
            $('#toptitle').text('(Optional)');
            $("#clausal-cp-ms").attr("required", false);
            $("#id-area-cp").attr("readonly", true);
            $.ajax({
                url : "/check/getDataByTipe",
                method : "POST",
                data : {id: "proses"},
                async : true,
                dataType : 'json',
                success: function(data){
                   var html = '';
                   html += '<option value="#">--Pilih Category--</option>';
                   for(var i=0;i<data.length;i++){
                    html += '<option value="'+data[i].id_category+'">'+data[i].title+'</option>';
                   }
                   $('#id-category-cp').html(html);
                }
            });
        }else if(tipe=="system"){
            $('#toptitle').text('(Harus diisi)');
            $("#clausal-cp-ms").attr("required", true);
            $("#id-area-cp").attr("readonly", true);
            $.ajax({
                url : "/check/getDataByTipe",
                method : "POST",
                data : {id: "system"},
                async : true,
                dataType : 'json',
                success: function(data){
                   var html = '';
                   html += '<option value="#">--Pilih Category--</option>';
                   for(var i=0;i<data.length;i++){
                    html += '<option value="'+data[i].id_category+'">'+data[i].title+'</option>';
                   }
                   $('#id-category-cp').html(html);
                }
            });
        }
        $('#id-area-cp').html('<option value="#">--Pilih Area--</option>')

    }); 

    $('#id-category-cp').change(function(){
        var id=$(this).val();
        var tipe=$("#choose-tipe-cp-ms").val();
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });

        if(tipe=="#"){
            toastr.error('Pilih tipe terlebih dahulu.')
        }
        console.log(tipe);
        if(tipe=="proses"){
            $.ajax({
                url : "check/getDataAreaById",
                method : "POST",
                data : {id: id, tipe: tipe},
                async : true,
                dataType : 'json',
                success: function(data){
                    console.log(data);
                    var html = '';
                    html += '<option value="#">--Pilih Area--</option>';
                    for(var i=0;i<data.length;i++){
                        if(data[i].nama_area!="verification"){
                            html += '<option value="'+data[i].id_area+'">'+data[i].nama_area+'</option>';
                        }
                    }
                    $('#id-area-cp').html(html);
                }
            });
        }else if(tipe=="system" || tipe=="verification"){
            console.log("masuk ke system nih");
            $.ajax({
                url : "check/getDataAreaById",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                success: function(data){
                    console.log(data);
                    var html = '';
                    html += '<option value="'+data[0].id_area+'" selected>tidak ada area</option>';
                    $('#id-area-cp').html(html);
                }
            });
        }

 
    }); 

    $('#btn-add-bulk').on('click', function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });

        var cat = $('#id-category-bulk').val();
        
        var tipe = $('#id-tipe-bulk').val();
        var num = $('#number-bulk').val();
        var numExst = $('#number-count-bulk').val();
        console.log(tipe);
        if(cat==null && num=="" && tipe==null ){
            toastr.error('Pilih Category, tipe dan input jumlah terlebih dahulu.')
        }else if(cat==null){
            toastr.error('Pilih Category terlebih dahulu.')
        }else if(tipe==null){
            toastr.error('Pilih Tipe terlebih dahulu.')
        }else if(num==""){
            toastr.error('input jumlah terlebih dahulu.')
        }else{
            var catName = $('#id-category-bulk').children("option:selected").text();
            var idArea = $('#id-area-bulk').val();
            var areaName = $('#id-area-bulk').children("option:selected").text();
            console.log("Ini test "+catName);
            htmlSide = '';
            htmlMain = '';
            for(i=1;i<=num;i++){
                actualNum = parseInt(numExst)+i;
                if(actualNum==1){
                    htmlSide += '<a class="nav-link active" id="vert-tabs-cp-side-'+actualNum+'" data-toggle="pill" href="#vert-tabs-cp-'+actualNum+'" role="tab" aria-controls="vert-tabs-cp-'+actualNum+'" aria-selected="true">Point '+actualNum+' <button type="button" class="btn btn-danger btn-sm float-right" id="tooltip'+actualNum+'" data-toggle="tooltip" data-placement="top" title="Data tidak lengkap" style="display: none;"><i class="fa fa-exclamation-circle"></i></button></a>';
                    htmlMain += '<div class="tab-pane text-left fade show active" id="vert-tabs-cp-'+actualNum+'" role="tabpanel" aria-labelledby="vert-tabs-cp-'+actualNum+'">'                        
                }else{
                    htmlSide += '<a class="nav-link" id="vert-tabs-cp-side-'+actualNum+'" data-toggle="pill" href="#vert-tabs-cp-'+actualNum+'" role="tab" aria-controls="vert-tabs-cp-'+actualNum+'" aria-selected="false">Point '+actualNum+' <button type="button" class="btn btn-danger btn-sm float-right" id="tooltip'+actualNum+'" data-toggle="tooltip" data-placement="top" title="Data tidak lengkap" style="display: none;"><i class="fa fa-exclamation-circle"></i></button></a>';
                    htmlMain += '<div class="tab-pane fade" id="vert-tabs-cp-'+actualNum+'" role="tabpanel" aria-labelledby="vert-tabs-cp-'+actualNum+'">'    
                }
                htmlMain += '<a class="btn btn-danger btn-sm float-right pointcp-delete" style="margin-bottom: 10px;" id="" data-numbulkdel="'+actualNum+'"><i class="fa fa-trash"></i></a>'
                htmlMain += '<div class="form-group">'
                htmlMain += '<label for="">Title</label>'
                htmlMain += '<input type="text" name="title'+actualNum+'" id="" class="form-control" required>'
                htmlMain += '</div>'
                htmlMain += '<div class="form-group">'
                htmlMain += '<label for="">Evidence</label>'
                htmlMain += '<input type="text" name="evidence'+actualNum+'" id="" class="form-control" required>'
                htmlMain += '</div>'
                htmlMain += '<div class="form-group">'
                htmlMain += '<label for="">Clausal</label>'
                if (tipe=="system"){
                    htmlMain += '<input type="text" name="clausal'+actualNum+'" id="" class="form-control" value="" required>'
                }else{
                    htmlMain += '<input type="text" name="clausal'+actualNum+'" id="" class="form-control" value="">'
                }
                htmlMain += '</div>'
                htmlMain += '<div class="row">'
                htmlMain += '<div class="col-4">'
                htmlMain += '<div class="form-group">'
                htmlMain += '<label for="">Category</label>'
                htmlMain += '<input type="text" name="" id="" class="form-control" value="'+catName+'" readonly>'
                htmlMain += '<input type="hidden" name="id_category'+actualNum+'" id="" value="'+cat+'">'
                htmlMain += '</div>'
                htmlMain += '</div>'
                htmlMain += '<div class="col-4">'
                htmlMain += '<label for="">Area</label>'
                htmlMain += '<input type="text" name="" id="" class="form-control" value="'+areaName+'" readonly>'
                htmlMain += '<input type="hidden" name="id_area'+actualNum+'" id="" value="'+idArea+'">'    
                htmlMain += '</div>'
                htmlMain += '<div class="form-group">'
                htmlMain += '</div>'
                htmlMain += '<div class="col-4">'
                htmlMain += '<div class="form-group">'
                htmlMain += '<label for="">Tipe</label>'
                htmlMain += '<input type="text" name="tipe'+actualNum+'" id="" class="form-control" value="'+tipe+'" readonly>'
                htmlMain += '</div>'
                htmlMain += '</div>'
                htmlMain += '</div>'
                htmlMain += '<div class="form-group">'
                htmlMain += '<label for="">Keterangan</label>'
                htmlMain += '<textarea name="keterangan'+actualNum+'" class="form-control" id="" cols="30" rows="10" required></textarea>'
                htmlMain += '</div>'
                htmlMain += '</div>'

            }
            var result = parseInt(num)+parseInt(numExst);
            $('.side-bulk-cp').append(htmlSide);
            $('.main-bulk-cp').append(htmlMain);
            $('#number-count-bulk').val(result);
            $('#number-count-bulk-show').text($('.pointcp-delete').length);
            $('#id-category-bulk').html('<option value="#">--Pilih Category--</option>')
            $('#id-tipe-bulk').val('#');
            $('#id-area-bulk').html('<option value="#">--Pilih Area--</option>')
            $('#number-bulk').val('');   
        
             
             

            
        }

        $('.pointcp-delete').on('click', function() {
            console.log("YEAY");
            const delNum = $(this).data('numbulkdel');
            $('#vert-tabs-cp-side-'+delNum).remove(); 
            $('#vert-tabs-cp-'+delNum).remove(); 
            $(this).prop('disabled', true);
            $('#number-count-bulk-show').text($('.pointcp-delete').length);
            
        });
        
    });

    $('.btn-hapus-foto').on('click', function() {
        const idDetail = $(this).data('iddetail');
        const idAudit = $(this).data('idaudit');
        $('.id-Detail').val(idDetail);
        $('.id-Audit').val(idAudit);
        // Call Modal Edit
        $('#deleteModal-foto').modal('show');
        
    });

    $('.btn-detail-finding').on('click', function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
        const id = $(this).data('id');
        $.ajax({
            url : "finding/getDataFindingIdAudit",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){
                if(data.length!=0){
                    toastr.success('Finding ditemukan, silahkan scroll ke bawah')
                    document.getElementById('detail-Finding-content').style.display = "block";
                }else{
                    toastr.error('Tidak ada finding di audit ini')
                }
                var html = '';
                for(var i=0; i < data.length; i++){
                    html += '<tr>';
                    html += '<td>'+(i+1)+'</td>';
                    html += '<td>'+data[i].title_cp+'</td>';
                    if(data[i].category_finding=="none"){
                        html += '<td>Belum diset</td>';
                    }else{
                        html += '<td>'+data[i].category_finding+'</td>';
                    }
                    html += '<td><button class="btn btn-danger btn-sm update-fd" onclick="showDetailFinding(this)" data-idaudit="'+data[i].id_audit+'" data-id="'+data[i].id_detail_audit+'" data-idfinding="'+data[i].id_finding+'" data-status="'+data[i].status_finding+'" data-category="'+data[i].category_finding+'" data-title="'+data[i].title_cp+'" data-evidence="'+data[i].evidence+'" data-desc="'+data[i].description+'" data-file="'+data[i].file_path+'" data-descaudit="'+data[i].desc_audit+'" data-auditee="'+data[i].nama_audity+'" data-cause="'+data[i].cause+'" data-short="'+data[i].short_term+'" data-long="'+data[i].long_term+'" data-revised="'+data[i].revised+'"><i class="fa fa-search"></i></buton></td>';
                    html += '</tr>';
                };
                $('#detail-finding').html(html);
            }
        });        
    });
 
    $('#submit-bulk').on('click', function() {
        var count = document.forms["FormBulk"]["count"].value;
        console.log('Data '+count);
        if (count != "0") {
          for (var i = 1; i <= count; i++) {
            var title = document.forms["FormBulk"]["title"+i].value;
            var evidence = document.forms["FormBulk"]["evidence"+i].value;;
            var clausal = document.forms["FormBulk"]["clausal"+i].value;;
            var keterangan = document.forms["FormBulk"]["keterangan"+i].value;;
            if (title == "" || evidence == "" || clausal == "" || keterangan == "") {
                console.log("masuk pak s"+i);
                document.getElementById('tooltip'+i).style.display = "block";
            }else{
                document.getElementById('tooltip'+i).style.display = "none";
            }
          }
        }

    });
    
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
    $('#reservationdatetime-update').datetimepicker({ icons: { time: 'far fa-clock' } });
    

    $('.foto').on('change', function() { 
        console.log("masuk foto");
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
        const number = $(this).data('number');
        const foto =  document.querySelector('#foto'+number);
        const fotoLabel = document.querySelector('#label'+number);
        const imgPreview = document.querySelector('#img-preview'+number);

        var filePath = foto.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i;
        let fileName = foto.files[0].name;
        if(!allowedExtensions.exec(filePath)){
            toastr.error('Mohon upload image menggunakan file yg valid (jpg,jpeg,gif,png,pdf)')
            foto.value = '';
            return false;
        }else if(fileName.includes("pdf")){
            fotoLabel.textContent = foto.files[0].name;

            const fileFoto = new FileReader();
            fileFoto.readAsDataURL(foto.files[0]);
    
            fileFoto.onload = function(e) {
                imgPreview.src = window.location.origin+"/img/dokumen.jpeg";
            }
            return true;
        }else{
            fotoLabel.textContent = foto.files[0].name;

            const fileFoto = new FileReader();
            fileFoto.readAsDataURL(foto.files[0]);
    
            fileFoto.onload = function(e) {
                imgPreview.src = e.target.result;
            }
            return true;
        }
        
    })

    $('#search').on('click', function() { 
        var id = $('#searchInput').val();
        var html = '';
        $.ajax({
            url : "searchCp",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){
                console.log(data);
            }
        });

    })

});

function validationForm() {    
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
        let deadline    = $('#deadline').val();
        var fixTime = ""
        const dateArr = deadline.split("/");
        const time = dateArr[2].split(" ");
        if(time[2]=="PM" && time[1].split(":")[0]==12){
            fixTime = (parseInt(time[1].split(":")[0]))+":"+time[1].split(":")[1];
        }else if(time[2]=="AM" && time[1].split(":")[0]==12){
            fixTime = "00:"+time[1].split(":")[1];
        }else if(time[2]=="PM"){
            fixTime = (parseInt(time[1].split(":")[0])+12)+":"+time[1].split(":")[1];
        }else{
            fixTime = time[1];
        }
        var newDate = new Date();
        var fixDeadline = "";
        // if(newDate.getFullYear()>parseInt(dateArr[2].split(" ")[0])){
        //     toastr.error('Tahun tidak boleh lebih kecil dari tahun saat ini('+newDate.getFullYear()+')')
        //     return false;
        // }else if(newDate.getFullYear()==parseInt(dateArr[2].split(" ")[0])){
        //     if(newDate.getMonth()+1>parseInt(dateArr[0])){
        //         toastr.error('Bulan tidak boleh lebih kecil dari bulan saat ini('+(newDate.getMonth()+1)+')')
        //         return false;
        //     }else if(newDate.getMonth()+1==parseInt(dateArr[0])){
        //         if(newDate.getDate()>=parseInt(dateArr[1])){
        //             toastr.error('Tanggal tidak boleh lebih kecil dari tanggal saat ini atau sama dengan tanggal saat ini('+(newDate.getDate())+')')
        //             return false;
        //         }else{
        //             fixDeadline = dateArr[2].split(" ")[0]+"-"+dateArr[0]+"-"+dateArr[1]+" "+fixTime+":00";
        //             $('#deadline').val(fixDeadline);
        //             return true;
        //         }
        //     }else{
        //         fixDeadline = dateArr[2].split(" ")[0]+"-"+dateArr[0]+"-"+dateArr[1]+" "+fixTime+":00";
        //         $('#deadline').val(fixDeadline);
        //         return true;
        //     }
        // }else{
        //     fixDeadline = dateArr[2].split(" ")[0]+"-"+dateArr[0]+"-"+dateArr[1]+" "+fixTime+":00";
        //     $('#deadline').val(fixDeadline);
        //     return true;
        // }
        fixDeadline = dateArr[2].split(" ")[0]+"-"+dateArr[0]+"-"+dateArr[1]+" "+fixTime+":00";
        $('#deadline').val(fixDeadline);
        return true;

    };

    function validationForm2() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });
            let deadline    = $('.deadline').val();
            var fixTime = ""
            const dateArr = deadline.split("/");
            const time = dateArr[2].split(" ");
            if(time[2]=="PM" && time[1].split(":")[0]==12){
                fixTime = (parseInt(time[1].split(":")[0]))+":"+time[1].split(":")[1];
            }else if(time[2]=="AM" && time[1].split(":")[0]==12){
                fixTime = "00:"+time[1].split(":")[1];
            }else if(time[2]=="PM"){
                fixTime = (parseInt(time[1].split(":")[0])+12)+":"+time[1].split(":")[1];
            }else{
                fixTime = time[1];
            }
            var newDate = new Date();
            var fixDeadline = "";
            // if(newDate.getFullYear()>parseInt(dateArr[2].split(" ")[0])){
            //     toastr.error('Tahun tidak boleh lebih kecil dari tahun saat ini('+newDate.getFullYear()+')')
            //     return false;
            // }else if(newDate.getFullYear()==parseInt(dateArr[2].split(" ")[0])){
            //     if(newDate.getMonth()+1>parseInt(dateArr[0])){
            //         toastr.error('Bulan tidak boleh lebih kecil dari bulan saat ini('+(newDate.getMonth()+1)+')')
            //         return false;
            //     }else if(newDate.getMonth()+1==parseInt(dateArr[0])){
            //         if(newDate.getDate()>parseInt(dateArr[1])){
            //             toastr.error('Tanggal tidak boleh lebih kecil dari tanggal saat ini ('+(newDate.getDate())+')')
            //             return false;
            //         }else{
            //             fixDeadline = dateArr[2].split(" ")[0]+"-"+dateArr[0]+"-"+dateArr[1]+" "+fixTime+":00";
            //             $('.deadline').val(fixDeadline);
            //             return true;
            //         }
            //     }else{
            //         fixDeadline = dateArr[2].split(" ")[0]+"-"+dateArr[0]+"-"+dateArr[1]+" "+fixTime+":00";
            //         $('.deadline').val(fixDeadline);
            //         return true;
            //     }
            // }else{
            //     fixDeadline = dateArr[2].split(" ")[0]+"-"+dateArr[0]+"-"+dateArr[1]+" "+fixTime+":00";
            //     $('.deadline').val(fixDeadline);
            //     return true;
            // }
            fixDeadline = dateArr[2].split(" ")[0]+"-"+dateArr[0]+"-"+dateArr[1]+" "+fixTime+":00";
            console.log(fixDeadline);
            $('.deadline').val(fixDeadline);
            return true;
        };


    function showDetailFinding(element) {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
        const id =  $(element).data('id');
        const title = $(element).data('title');
        const clausal = $(element).data('clausal');
        const evidence = $(element).data('evidence');
        const desc = $(element).data('desc');
        const descaudit = $(element).data('descaudit');
        const category = $(element).data('category');
        const status = $(element).data('status');
        const idfinding = $(element).data('idfinding');
        const idaudit = $(element).data('idaudit');
        const aditee = $(element).data('auditee');
        const cause = $(element).data('cause');
        const short = $(element).data('short');
        const long = $(element).data('long');
        const revised = $(element).data('revised');
        const file = $(element).data('file');
        const url = window.location.origin;
        
        var html = '';
        html += '<tr>';
        html += '<td style="width: 10%;">Point</td>';
        html += '<td>'+title+'</td>';
        html += '</tr>';
        html += '<tr>';
        html += '<td style="width: 10%;">Evidence</td>';
        html += '<td>'+evidence+'</td>';
        html += '</tr>';
        html += '<tr>';
        html += '<td style="width: 10%;">Clausal</td>';
        if(clausal==undefined){
            html += '<td>-</td>';
        }else{
            html += '<td>'+clausal+'</td>';
        }
        html += '</tr>';
        html += '<tr>';
        html += '<td style="width: 10%;">Keterangan</td>';
        html += '<td>'+desc+'</td>';
        html += '</tr>';
        html += '<tr>';
        html += '<td style="width: 10%;">Auditee</td>';
        html += '<td>'+aditee+'</td>';
        html += '</tr>';

        html += '<tr>';
        html += '<td style="width: 10%;">Go to task</td>';
        html += '<td><a href="/taskSummary/detail/'+idaudit+'" class="btn btn-info btn-sm">Click this</a></td>';
        html += '</tr>';
        $('#detail-cp').html(html);
        
        var html2 = '';
        if(status=="finding"){
            html2 += '<option value="finding" selected>Finding</option>';
            html2 += '<option value="non">Non Finding</option>';    
        }else{
            html2 += '<option value="finding">Finding</option>';
            html2 += '<option value="non" selected>Non Finding</option>';    
        }
        $('#status-finding').html(html2);

        var html3 = '';
        if(category=="none"){
            html3 += '<option value="none" selected>--Pilih Category--</option>';
            html3 += '<option value="major">Major</option>';
            html3 += '<option value="minor">Minor</option>';
            html3 += '<option value="observation">Observation</option>';    
        }else if(category=="major"){
            html3 += '<option value="none">--Pilih Category--</option>';
            html3 += '<option value="major" selected>Major</option>';
            html3 += '<option value="minor">Minor</option>';
            html3 += '<option value="observation">Observation</option>';    
        }else if(category=="minor"){
            html3 += '<option value="none">--Pilih Category--</option>';
            html3 += '<option value="major">Major</option>';
            html3 += '<option value="minor" selected>Minor</option>';
            html3 += '<option value="observation">Observation</option>';    
        }else if(category=="observation"){
            html3 += '<option value="none">--Pilih Category--</option>';
            html3 += '<option value="major">Major</option>';
            html3 += '<option value="minor">Minor</option>';
            html3 += '<option value="observation" selected>Observation</option>';
        }
        $('#category-finding').html(html3);
        $('#id-detail-audit').val(id);
        $('#id-audit').val(idaudit)
        $('#id-finding').val(idfinding);
        $('#desc-audit').val(descaudit);
        $('#cause').val(cause);
        $('#short-audit').val(short);
        $('#long-audit').val(long);
        $('#revised-audit').val(revised);
        //$('#foto').val(file);

        getName = file.split("/")[3];

        const fotoLabel = document.querySelector('#label');
        const imgPreview = document.querySelector('#img-preview');

        fotoLabel.textContent = getName;
        if(file==""){
            imgPreview.src = url+"/img/default.png";
        }else if(file.includes("pdf")){
            imgPreview.src = url+"/img/dokumen.jpeg";
        }else{
            imgPreview.src = url+"/img"+file;
        }

        toastr.success('Detail finding ditemukan, silahkan scroll ke bawah');
        // Call Modal Edit
        document.getElementById('detail-data-finding-content').style.display = "block";
        
    };

    function search() { 
        event.preventDefault();
        let id = $('#searchInput').val();
        var html = '';
        if(id.includes("clausal")){
            id = id.replace("clausal","").trim();
            $.ajax({
                url : "searchClausal",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                beforeSend: function(){
                    html += '<div class="col-md-12 text-center" style="margin-top: 30px;">';
                    html += '<div class="spinner-grow text-info spinner-grow-sm" role="status" style="margin-right: 10px;">';
                    html += '<span class="sr-only">Loading...</span>';
                    html += '</div>';
                    html += '<div class="spinner-grow text-danger spinner-grow-sm" role="status" style="margin-right: 10px;">';
                    html += '<span class="sr-only">Loading...</span>';
                    html += '</div>';
                    html += '<div class="spinner-grow text-warning spinner-grow-sm" role="status" style="margin-right: 10px;">';
                    html += '<span class="sr-only">Loading...</span>';
                    html += '</div>';
                    $('#resultSearch').html(html);
                },
                error:function(){
                    $('#resultSearch').empty();
                    html = '';
                    html += '<div class="col-md-12 text-center" style="margin-top: 30px;">';
                    html += '<h5> Clausal <b>'+id+'</b> ditemukan, silahkan mencari kata kunci yang lain. </h5>';
                    html += '</div>';
                    $('#resultSearch').html(html);
                },
                success:function(data){
                    $('#resultSearch').empty();
                    console.log(data);
                    html = '';
                    if(data.length==0){
                        html += '<div class="col-md-12 text-center" style="margin-top: 30px;">';
                        html += '<h5> Clausal <b>'+id+'</b> ditemukan, silahkan mencari kata kunci yang lain. </h5>';
                        html += '</div>';
                        $('#resultSearch').html(html);
                    }else{
                        for(var i=0;i<data.length;i++){
                            var clausal = '-';
                            if(data[i].clausal!=null){
                                clausal = data[i].clausal;
                            }
                            html += '<div class="col-md-12" style="margin-top: 5px;">';
                            html += '<div class="list-group">';
                            html += '<div class="list-group-item">';
                            html += '<div class="row">';
                            html += '<div class="col px-4">';
                            html += '<div>';
                            html += '<div class="float-right"><b>Clausal : '+ clausal +'</b></div>';
                            if(data[i].title_cp.length > 60){
                                html += '<h3>'+data[i].title_cp.substring(0,60)+' ...</h3>';
                                html += '<p class="mb-0">'+data[i].title_cp+'</p>';
                            }else{
                                html += '<h3>'+data[i].title_cp+'</h3>';
                            }
                            html += '<p class="mb-0">'+data[i].description+'</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="list-group-item">';
                            html += '<div class="row">';
                            html += '<div class="col px-4">';
                            html += '<div>';
                            html += '<table class="table table-striped">';
                            html += '<thead>';
                            html += '<tr>';
                            html += '<th>#</th>';
                            html += '<th>Task</th>';
                            html += '<th>Category</th>';
                            html += '<th>Date</th>';
                            html += '<th>Status</th>';
                            html += '</tr>';
                            html += '<tbody>';
                            if(data[i].data.length!=0){
                                for(var a=0;a < data[i].data.length;a++){
                                    html += '<tr>';
                                    html += '<td>'+(a+1)+'</td>';
                                    html += '<td>'+data[i].data[a].task+'</td>';
                                    html += '<td>'+data[i].data[a].category+'</td>';
                                    html += '<td>'+data[i].data[a].date+'</td>';
                                    html += '<td>'+data[i].data[a].status+'</td>';
                                    html += '</tr>';    
                                }
                            }else{
                                html += '<tr>';
                                html += '<td></td>';
                                html += '<td></td>';
                                html += '<td style="text-align: center;">No Task Found ...</td>';
                                html += '<td></td>';
                                html += '<td></td>';
                                html += '</tr>';
                            }
                            html += '</tbody>';
                            html += '</table>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';                
                        }
                        $('#resultSearch').html(html);
                    }
                }
            });
         }else if(id!=""){
            $.ajax({
                url : "searchCp",
                method : "POST",
                data : {id: id},
                async : true,
                dataType : 'json',
                beforeSend: function(){
                    html += '<div class="col-md-12 text-center" style="margin-top: 30px;">';
                    html += '<div class="spinner-grow text-info spinner-grow-sm" role="status" style="margin-right: 10px;">';
                    html += '<span class="sr-only">Loading...</span>';
                    html += '</div>';
                    html += '<div class="spinner-grow text-danger spinner-grow-sm" role="status" style="margin-right: 10px;">';
                    html += '<span class="sr-only">Loading...</span>';
                    html += '</div>';
                    html += '<div class="spinner-grow text-warning spinner-grow-sm" role="status" style="margin-right: 10px;">';
                    html += '<span class="sr-only">Loading...</span>';
                    html += '</div>';
                    $('#resultSearch').html(html);
                },
                error:function(){
                    $('#resultSearch').empty();
                    html = '';
                    html += '<div class="col-md-12 text-center" style="margin-top: 30px;">';
                    html += '<h5>Point <b>'+id+'</b> ditemukan, silahkan mencari kata kunci yang lain. </h5>';
                    html += '</div>';
                    $('#resultSearch').html(html);
                },
                success:function(data){
                    $('#resultSearch').empty();
                    console.log(data);
                    html = '';
                    if(data.length==0){
                        html += '<div class="col-md-12 text-center" style="margin-top: 30px;">';
                        html += '<h5>Point <b>'+id+'</b> ditemukan, silahkan mencari kata kunci yang lain. </h5>';
                        html += '</div>';
                        $('#resultSearch').html(html);
                    }else{
                        for(var i=0;i<data.length;i++){
                            var clausal = '-';
                            if(data[i].clausal!=null){
                                clausal = data[i].clausal;
                            }
                            html += '<div class="col-md-12" style="margin-top: 5px;">';
                            html += '<div class="list-group">';
                            html += '<div class="list-group-item">';
                            html += '<div class="row">';
                            html += '<div class="col px-4">';
                            html += '<div>';
                            html += '<div class="float-right"><b>Clausal : '+ clausal +'</b></div>';
                            if(data[i].title_cp.length > 60){
                                html += '<h3>'+data[i].title_cp.substring(0,60)+' ...</h3>';
                                html += '<p class="mb-0">'+data[i].title_cp+'</p>';
                            }else{
                                html += '<h3>'+data[i].title_cp+'</h3>';
                            }
                            html += '<p class="mb-0">'+data[i].description+'</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="list-group-item">';
                            html += '<div class="row">';
                            html += '<div class="col px-4">';
                            html += '<div>';
                            html += '<table class="table table-striped">';
                            html += '<thead>';
                            html += '<tr>';
                            html += '<th>#</th>';
                            html += '<th>Task</th>';
                            html += '<th>Category</th>';
                            html += '<th>Date</th>';
                            html += '<th>Status</th>';
                            html += '</tr>';
                            html += '<tbody>';
                            if(data[i].data.length!=0){
                                for(var a=0;a < data[i].data.length;a++){
                                    html += '<tr>';
                                    html += '<td>'+(a+1)+'</td>';
                                    html += '<td>'+data[i].data[a].task+'</td>';
                                    html += '<td>'+data[i].data[a].category+'</td>';
                                    html += '<td>'+data[i].data[a].date+'</td>';
                                    html += '<td>'+data[i].data[a].status+'</td>';
                                    html += '</tr>';    
                                }
                            }else{
                                html += '<tr>';
                                html += '<td></td>';
                                html += '<td></td>';
                                html += '<td style="text-align: center;">No Task Found ...</td>';
                                html += '<td></td>';
                                html += '<td></td>';
                                html += '</tr>';
                            }
                            html += '</tbody>';
                            html += '</table>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';                
                        }
                        $('#resultSearch').html(html);
                    }
                }
            });
         }




        return false;

    };

