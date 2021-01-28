@extends('layouts.main')

@section('content')
    <!-- Main content -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        error=false
    </script>
    <style>
        .error{ color:red;
         } 
    </style>
    <div class="container">
        <h1 align="center">จัดการสถานที่</h1>
        {{-- <br/> --}}
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a onclick="addForm()" class="btn btn-primary mb-2" >เพิ่มสถานที่</a>
                </div>
            </div>
        </div>
        {{-- <br/> --}}
        <div class="row">
            <div class="col-lg-4 margin-tb">
                <div class="pull-right">
                    <select name="DD_project" id="DD_project" class="form-control" placeholder="-- กรุณาเลือก โครงการ --">
                        <option value="" disabled selected>-- เลือกโครงการเพื่อดูข้อมูลเฉพาะ --</option>
                    </select>
                </div>
            </div>
        </div>
        
        <table id="table_location" class="table table-bordered table-striped" >
            <thead>
                <tr id="">
                    <th width="5%"><center/>ลำดับ</th>
                    <th width="25%"><center/>ชื่อสถานที่</th>
                    <th width="15%"><center/>รหัสโครงการ</th>
                    <th width="25%"><center/>ดู/แก้ไข/ลบ</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
          
    <!-- Add and Edit customer modal -->
    <div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-labelledby="exampleModalLeble" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="locationModal"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="location_form" action="javascript:void(0)">
                        @csrf {{ method_field('POST') }}
                        <input type="hidden" name="ID_location" id="ID_location">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ชื่อสถานที่ : </strong>
                                        <input type="text" name="name_location" id="name_location" class="form-control" placeholder="ชื่อสถานที่" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ชื่อโครงการ : </strong>
                                        <select name="ID_project" id="ID_project" class="form-control" placeholder="-- กรุณาเลือก โครงการ --">
                                            <option value="" disabled selected>-- กรุณาเลือก โครงการ --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" id="btnsave" class="btn btn-primary"></button>
                                    <button type="button" class="btn btn-danger cancle" data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        
    <!-- Show user modal -->
    <div class="modal fade" id="modal-show" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="locationModal-show"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2"></div>
                        <div class="col-xs-10 col-sm-10 col-md-10 ">
                            <table class="table-responsive">
                                <tr height="50px"><td><strong>ชื่อสถานที่ : </strong></td><td id="sname_location"></td></tr>
                                <tr height="50px"><td><strong>รหัสโครงการ : </strong></td><td id="sID_project"></td></tr>
                                <tr><td></td><td style="text-align: right "><button type="button" class="btn btn-danger cancle" data-dismiss="modal">ปิด</button></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <script type="text/javascript">
        $.extend(true, $.fn.dataTable.defaults, {
            "language": {
                "sProcessing": "กำลังดำเนินการ...",
                "sLengthMenu": "แสดง_MENU_ แถว",
                "sZeroRecords": "ไม่พบข้อมูล",
                "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                "sInfoPostFix": "",
                "sSearch": "ค้นหา:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "เริ่มต้น",
                    "sPrevious": "ก่อนหน้า ",
                    "sNext": " ถัดไป",
                    "sLast": "สุดท้าย"
                }
            }
        });
        $(document).ready(function () {
            $(function () {
                $("#table_location").DataTable({
                    responsive : true, 
                    lengthChange: true, 
                    autoWidth: false,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('location.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex',className:"text-center"},
                        {data: 'name_location', name: 'name_location'},
                        {data: 'code_project', name: 'code_project',className:"text-center"}, 
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });

            /* Show customer */
            $('body').on('click', '#show-location', function () {
                var ID_project  = $(this).data('id');
                $.get('location/'+ID_project, function (data) {
                    $('#sname_location').html(data.name_location);
                    $('#sID_project').html(data.ID_project);
                })
                $('#locationModal-show').html("รายละเอียด");
                $('#modal-show').modal('show');
            });

            $('#ID_project').empty();
            $("#ID_project").append('<option value="" disabled selected>-- กรุณาเลือก โครงการ --</option>');  
            var id = 2;
            $.ajax({
                type: "GET",
                url:"{{ url('location') }}"+ '/' + id +"/add",
                dataType: "json",
                success: function (response) {
                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }
                    if(len > 0){
                        // Read data and create <option >
                        for(var i=0; i<len; i++){
                            var id = response['data'][i].ID_project;
                            var code = response['data'][i].code_project;
                            var option =  "<option value='"+id+"'>"+code+"</option>"; 
                            $("#ID_project").append(option); 
                            $("#DD_project").append(option);
                        }
                    }
                },
                error: function(){
                    alert("not working property");
                }
            });
        });

        /* When click New button */
        function addForm(){
            save_method= 'add';
            $('input[name_method]') .val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('เพิ่มสถานที่');
            $('#btnsave').text('บันทึก');
        } 

        /* insert data by ajax */
        $(function(){
            if ($("#location_form").length > 0) {
                $("#location_form").validate({
                    rules: {
                        name_location: {
                            required: true,
                            maxlength: 50
                        },
                        ID_project: {
                            required: true,
                            maxlength: 200
                        },
                    },

                    messages: {
                        name_location: {
                            required: "กรุณากรอก ชื่อสถานที่",
                            maxlength: "ชื่อสถานที่รสูงสุดต้องไม่เกิน 50 อักขระ"
                        },
                        ID_project: {
                            required: "กรุณาเลือก รหัสโครงการ",
                            maxlength: "รหัสโครงการสูงสุดต้องไม่เกิน 200 อักขระ"
                        },
                    },
                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var ID_location =$('#ID_location').val();
                        if (save_method == 'add') url = "{{ url('location') }}";
                        else url = "{{ url('location') }}"+ '/' + ID_location  + '/update';
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: new FormData($("#modal-form form")[0]),
                            contentType: false,
                            processData: false,
                            success : function (data) {
                                $('#modal-form').modal('hide');
                                $('#table_location').DataTable().ajax.reload()
                                swal({
                                    title:"บันทึกข้อมูลเรียบร้อยแล้ว",
                                    text:"กรุณาคลิกที่ปุ่ม",
                                    icon: "success",
                                    button: "ตกลง",
                                });
                            },
                            error: function (data) {
                                swal({
                                    title:"อุปส์...ดูเหมือนมีบางอย่างผิดพลาด!",
                                    text:data.message,
                                    type: "error",
                                    timer: "1500",
                                });
                            }
                        });
                        return false;
                    }
                });
            }
        });

        /* When click edit button */
        function editForm(id){
            save_method='edit';
            $('input[name_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('location') }}"+ '/' + id +"/edit",
                type: "GET",
                dataType: "JSON",
                success : function (data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('แก้ไขข้อมูลโครงการ');
                    $('#btnsave').text('บันทึก');
                    $('#ID_location').val(data.ID_location);
                    $('#name_location').val(data.name_location);
                    $('#ID_project').val(data.ID_project);
                },
                error: function(){
                    alert("not working property");
                }
            });

        }

        /* When click delete button */
        function deleteData(id){
            var csrf_token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: 'คุณแน่ใจหรือไม่',
                text: "คุณต้องการลบข้อมูลนี้ใช่หรือไม่!",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
                buttons: ["ยกเลิก", "ตกลง"],
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('location') }}"+ '/' +id,
                        type: "POST",
                        data: {'_method' : 'DELETE', '_token' : csrf_token},
                        success : function (data) {
                            $('#table_location').DataTable().ajax.reload()
                            swal({
                                title:"ลบข้อมูลเรียบร้อยแล้ว",
                                text:"กรุณาคลิกที่ปุ่ม",
                                icon: "success",
                                button: "ตกลง",
                            });
                        },
                        error: function (data) {
                            swal({
                                title:"อุปส์...ดูเหมือนมีบางอย่างผิดพลาด!",
                                text:('Error:', data),
                                type: "error",
                                timer: "1500",
                            });
                        }
                    });
                } 
                else {
                    swal({
                        text: "ข้อมูลนี้ของคุณปลอดภัย",
                        button: "ตกลง",
                    });
                }
            });
        }
    </script>
@endsection
