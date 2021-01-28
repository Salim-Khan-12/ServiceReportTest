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
  <h2 style="margin-top: 10px;">laravel 6 Ajax</h2>
  <br>
    <form id="contact_us" method="post" action="javascript:void(0)">
      @csrf
      <form method="post" id="sus_add_user" data-toogle="validator">
        {{-- @csrf {{ method_field('POST') }} --}}
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
                    <button type="submit" id="btnsave" class="btn btn-primary">save</button>
                    <button type="button" class="btn btn-danger cancle" data-dismiss="modal" >ยกเลิก</button>
                </div>
            </div>
        </div>
    </form>

  

</div>

<script>

  if ($("#contact_us").length > 0) {
    $("#contact_us").validate({
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
        required: "Please enter name",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      nickname: {
        required: "Please enter nickname",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      level: {
        required: "Please enter level",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      phone: {
        required: "Please enter contact phone",
        minlength: "The contact number should be 9 digits",
        maxlength: "The contact number should be 12 digits",
      },
      email: {
          required: "Please enter valid email",
          email: "Please enter valid email",
          maxlength: "The email name should less than or equal to 50 characters",
      },
      username: {
        required: "Please enter contact username",
        maxlength: "Your last name maxlength should be 50 characters long.",
      },
      password: {
        required: "Please enter contact number",
        maxlength: "Your last name maxlength should be 50 characters long.",
      },
    },
    submitHandler: function(form) {
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        url: "{{ url('user') }}",
        type: "POST",
        data: new FormData($("#contact_us")[0]),
        contentType: false,
        processData: false,
        success : function (data) {
          // $('#modal-form').modal('hide');
          // $('.data-table').DataTable().ajax.reload()
          swal({
            title:"Good job",
            text:"you clicked the button!",
            icon: "success",
            button: "Great!",
          });
        },
        error: function (data) {
          swal({
            title:"Oops...",
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

</script>
@endsection
