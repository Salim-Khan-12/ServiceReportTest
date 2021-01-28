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
        <h1 align="center">จัดการโครงการ</h1>
        <br/>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a onclick="addForm()" class="btn btn-primary mb-2" >เพิ่มโครงการ</a>
                </div>
            </div>
        </div>

        <table id="table_project" class="table table-bordered table-striped" >
            <thead>
                <tr id="">
                    <th width="5%"><center/>ลำดับ</th>
                    <th width="25%"><center/>รหัสโครงการ</th>
                    <th width="15%"><center/>ชื่อโครงการ</th>
                    <th width="20%"><center/>ชื่อหน่วยงาน</th>
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
                    <h4 class="modal-title" id="projectModal"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="project_form" action="javascript:void(0)">
                        @csrf {{ method_field('POST') }}
                        <input type="hidden" name="ID_project " id="ID_project">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>รหัสโครงการ : </strong>
                                        <input type="text" name="code_project" id="code_project" class="form-control" placeholder="รหัสโครงการ" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ชื่อโครงการ : </strong>
                                        <input type="text" name="name_project" id="name_project" class="form-control" placeholder="ชื่อโครงการ">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ชื่อหน่วยงาน : </strong>
                                        <input type="text" name="name_office" id="name_office" class="form-control" placeholder="ชื่อหน่วยงาน">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" id="btnsave" class="btn btn-primary"></button>
                                    <button type="button" class="btn btn-danger cancle" data-dismiss="modal" >ยกเลิก</button>
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
                    <h4 class="modal-title" id="projectModal-show"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2"></div>
                        <div class="col-xs-10 col-sm-10 col-md-10 ">
                            <table class="table-responsive">
                                <tr height="50px"><td><strong>รหัสโครงการ : </strong></td><td id="scode_project"></td></tr>
                                <tr height="50px"><td><strong>ชื่อโครงการ : </strong></td><td id="sname_project"></td></tr>
                                <tr height="50px"><td><strong>ชื่อหน่วยงาน : </strong></td><td id="sname_office"></td></tr>
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
                $("#table_project").DataTable({
                    responsive : true, 
                    lengthChange: true, 
                    autoWidth: false,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('project.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex',className:"text-center"},
                        {data: 'code_project', name: 'code_project'},
                        {data: 'name_project', name: 'name_project',className:"text-center"}, 
                        {data: 'name_office', name: 'name_office',className:"text-center"},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });

            /* Show customer */
            $('body').on('click', '#show-project', function () {
                var ID_project  = $(this).data('id');
                $.get('project/'+ID_project, function (data) {
                    $('#scode_project').html(data.code_project);
                    $('#sname_project').html(data.name_project);
                    $('#sname_office').html(data.name_office);
                })
                $('#projectModal-show').html("รายละเอียด");
                $('#modal-show').modal('show');
            });
        });

        /* When click New customer button */
        function addForm(){
            save_method= 'add';
            $('input[name_method]') .val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('เพิ่มโครงการ');
            $('#btnsave').text('บันทึก');
        } 

        /* insert data by ajax */
        $(function(){
            if ($("#project_form").length > 0) {
                $("#project_form").validate({
                    rules: {
                        code_project: {
                            required: true,
                            maxlength: 50
                        },
                        name_project: {
                            required: true,
                            maxlength: 200
                        },
                        name_office: {
                            required: true,
                            maxlength: 200
                        },
                    },

                    messages: {
                        code_project: {
                            required: "กรุณากรอก รหัสโครงการ",
                            maxlength: "รหัสโครงการสูงสุดต้องไม่เกิน 50 อักขระ"
                        },
                        name_project: {
                            required: "กรุณากรอก ชื่อโครงการ",
                            maxlength: "ชื่อโครงการสูงสุดต้องไม่เกิน 200 อักขระ"
                        },
                        name_office: {
                            required: "กรุณากรอก ชื่อหน่วยงาน",
                            maxlength: "ชื่อหน่วยงานสูงสุดต้องไม่เกิน 200 อักขระ"
                        },
                    },
                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var ID_project =$('#ID_project').val();
                        if (save_method == 'add') url = "{{ url('project') }}";
                        else url = "{{ url('project') }}"+ '/' + ID_project  + '/update';
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: new FormData($("#modal-form form")[0]),
                            contentType: false,
                            processData: false,
                            success : function (data) {
                                $('#modal-form').modal('hide');
                                $('#table_project').DataTable().ajax.reload()
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
                url: "{{ url('project') }}"+ '/' + id +"/edit",
                type: "GET",
                dataType: "JSON",
                success : function (data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('แก้ไขข้อมูลโครงการ');
                    $('#btnsave').text('บันทึก');
                    $('#ID_project').val(data.ID_project);
                    $('#code_project').val(data.code_project);
                    $('#name_project').val(data.name_project);
                    $('#name_office').val(data.name_office);
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
                            url: "{{ url('project') }}"+ '/' +id,
                            type: "POST",
                            data: {'_method' : 'DELETE', '_token' : csrf_token},
                            success : function (data) {
                                $('#table_project').DataTable().ajax.reload()
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
                    } else {
                        swal({
                            text: "ข้อมูลนี้ของคุณปลอดภัย",
                            button: "ตกลง",
                        });
                    }
                });
            }
    </script>
@endsection
