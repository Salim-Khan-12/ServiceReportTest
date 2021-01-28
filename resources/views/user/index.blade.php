@extends('layouts.main')

@section('content')
    <!-- Main content -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        error=false
    </script>
    <style>
        .error{ color:red; } 
    </style>
    <div class="container">
        <h1 align="center">จัดการสมาชิก</h1>
        <br/>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a onclick="addForm()" class="btn btn-primary mb-2" >เพิ่มสมาชิก</a>
                </div>
            </div>
        </div>

        <table id="table_user" class="table table-bordered table-striped" >
            <thead>
                <tr id="">
                    <th width="5%"><center/>ลำดับ</th>
                    <th width="25%"><center/>ชื่อ - สกุล</th>
                    <th width="15%"><center/>ชื่อเล่น</th>
                    <th width="20%"><center/>ระดับผู้ใช้งาน</th>
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
                    <h4 class="modal-title" id="userCrudModal"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="user_form" action="javascript:void(0)">
                        @csrf {{ method_field('POST') }}
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ชื่อ - สกุล : </strong>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="ชื่อ - สกุล" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ชื่อเล่น : </strong>
                                        <input type="text" name="nickname" id="nickname" class="form-control" placeholder="ชื่อเล่น">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ระดับผู้ใช้งาน : </strong>
                                        <select name="level" id="level" class="form-control" placeholder="-- กรุณาเลือก ระดับผู้ใช้งาน --">
                                            <option value="" disabled selected>-- กรุณาเลือก ระดับผู้ใช้งาน --</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Supervisor">Supervisor</option>
                                            <option value="Technical Support">Technical Support</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>เบอร์โทรศัพท์ : </strong>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="088-8888888">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>อีเมลล์ : </strong>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="อีเมลล์">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>ชื่อผู้ใช้ : </strong>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="ชื่อผู้ใช้">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>รหัสผ่าน : </strong>
                                        <input type="text" name="password" id="password" class="form-control" placeholder="รหัสผ่าน" value="11111111">
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
    <div class="modal fade" id="crud-modal-show" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="userCrudModal-show"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2"></div>
                        <div class="col-xs-10 col-sm-10 col-md-10 ">
                            <table class="table-responsive">
                                <tr height="50px"><td><strong>ชื่อ - สกุล : </strong></td><td id="sname"></td></tr>
                                <tr height="50px"><td><strong>ชื่อเล่น : </strong></td><td id="snickname"></td></tr>
                                <tr height="50px"><td><strong>ระดับผู้ใช้งาน : </strong></td><td id="slevel"></td></tr>
                                <tr height="50px"><td><strong>เบอร์โทรศัพท์ : </strong></td><td id="sphone"></td></tr>
                                <tr height="50px"><td><strong>อีเมลล์ : </strong></td><td id="semail"></td></tr>
                                <tr height="50px"><td><strong>ชื่อผู้ใช้ : </strong></td><td id="susername"></td></tr>
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
                    "sPrevious": "<< ก่อนหน้า ",
                    "sNext": " ถัดไป >>",
                    "sLast": "สุดท้าย"
                }
            }
        });
        $(document).ready(function () {
            // var table = $('#table_user').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: "{{ route('user.index') }}",
            //     columns: [
            //         {data: 'DT_RowIndex', name: 'DT_RowIndex',className:"text-center"},
            //         {data: 'name', name: 'name'},
            //         {data: 'nickname', name: 'nickname',className:"text-center"}, 
            //         {data: 'level', name: 'level',className:"text-center"},
            //         {data: 'action', name: 'action', orderable: false, searchable: false},
            //     ]
            // });

            $(function () {
                $("#table_user").DataTable({
                    responsive : true, 
                    lengthChange: true, 
                    autoWidth: false,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('user.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex',className:"text-center"},
                        {data: 'name', name: 'name'},
                        {data: 'nickname', name: 'nickname',className:"text-center"}, 
                        {data: 'level', name: 'level',className:"text-center"},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });

            /* Show customer */
            $('body').on('click', '#show-user', function () {
                var user_id = $(this).data('id');
                $.get('user/'+user_id, function (data) {
                    $('#sname').html(data.name);
                    $('#snickname').html(data.nickname);
                    $('#slevel').html(data.level);
                    $('#sphone').html(data.phone);
                    $('#semail').html(data.email);
                    $('#susername').html(data.username);
                })
                $('#userCrudModal-show').html("รายละเอียด");
                $('#crud-modal-show').modal('show');
            });
        });

        /* When click New customer button */
        function addForm(){
            save_method= 'add';
            $('input[name_method]') .val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('เพิ่มสมาชิก');
            $('#btnsave').text('บันทึก');
        } 

        /* insert data by ajax */
        $(function(){
            if ($("#user_form").length > 0) {
                $("#user_form").validate({
                    rules: {
                        name: {
                            required: true,
                            maxlength: 50
                        },
                        nickname: {
                            required: true,
                            maxlength: 50
                        },
                        level: {
                            required: true,
                            maxlength: 50
                        },
                        phone: {
                            required: true,
                            minlength: 9,
                            maxlength:12,
                        },
                        email: {
                            required: true,
                            maxlength: 50
                        },
                        username: {
                            required: true,
                            maxlength: 50
                        },
                        password: {
                            required: true,
                            maxlength: 50
                        },
                    },

                    messages: {
                        name: {
                            required: "กรุณากรอก ชื่อ - สกุล",
                            maxlength: "รหัสโครงการสูงสุดต้องไม่เกิน 50 อักขระ"
                        },
                        nickname: {
                            required: "กรุณากรอก ชื่อเล่น",
                            maxlength: "รหัสโครงการสูงสุดต้องไม่เกิน 50 อักขระ"
                        },
                        level: {
                            required: "กรุณากรอก ระดับผู้ใช้งาน",
                            maxlength: "รหัสโครงการสูงสุดต้องไม่เกิน 50 อักขระ"
                        },
                        phone: {
                            required: "กรุณากรอก รหัสโครงการ",
                            minlength: "The contact number should be 9 digits",
                            maxlength: "The contact number should be 12 digits",
                        },
                        email: {
                            required: "กรุณากรอก อีเมลล์",
                            email: "กรุณากรอกให้อยู่ในรูปแบบของอีเมลล์",
                            maxlength: "The email name should less than or equal to 50 characters",
                        },
                        username: {
                            required: "กรุณากรอก ชื่อผู้ใช้",
                            maxlength: "รหัสโครงการสูงสุดต้องไม่เกิน 50 อักขระ",
                        },
                        password: {
                            required: "กรุณากรอก รหัสผ่าน",
                            maxlength: "รหัสโครงการสูงสุดต้องไม่เกิน 50 อักขระ",
                        },
                    },
                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var id =$('#id').val();
                        if (save_method == 'add') url = "{{ url('user') }}";
                        else url = "{{ url('user') }}"+ '/' + id+ '/update';
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: new FormData($("#modal-form form")[0]),
                            contentType: false,
                            processData: false,
                            success : function (data) {
                                $('#modal-form').modal('hide');
                                $('#table_user').DataTable().ajax.reload()
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
                url: "{{ url('user') }}"+ '/' + id +"/edit",
                type: "GET",
                dataType: "JSON",
                success : function (data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('แก้ไขข้อมูลสมาชิก');
                    $('#btnsave').text('บันทึก');
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#nickname').val(data.nickname);
                    $('#level').val(data.level);
                    $('#phone').val(data.phone);
                    $('#email').val(data.email);
                    $('#username').val(data.username);
                    $('#password').val('11111111');
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
                    text: "คุณต้องการลบข้อมูลนี้ใช่หรือไม่",
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                    buttons: ["ยกเลิก", "ตกลง"],
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('user') }}"+ '/' +id,
                            type: "POST",
                            data: {'_method' : 'DELETE', '_token' : csrf_token},
                            success : function (data) {
                                $('#table_user').DataTable().ajax.reload()
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
