<!DOCTYPE html>
<html>
<head>
    <!-- jQuery -->
    <script src="{{ asset('/dashboard/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('/dashboard/plugins/jquery-validation/jquery.validate.js')}}"></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
/* Styles */
* {
  margin: 0;
  padding: 0;
}

body {
  font-family: "Open Sans";
  font-size: 14px;
}

.container {
  width: 500px;
  margin: 25px auto;
}

form {
  padding: 20px;
  background: #2c3e50;
  color: #fff;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
}
form label,
form input,
form button {
  border: 0;
  margin-bottom: 3px;
  display: block;
  width: 100%;
}
form input {
  height: 25px;
  line-height: 25px;
  background: #fff;
  color: #000;
  padding: 0 6px;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
form button {
  height: 30px;
  line-height: 30px;
  background: #e67e22;
  color: #fff;
  margin-top: 10px;
  cursor: pointer;
}
form .error {
  color: #ff0000;
}
    </style>

</head>

<body>

<h1>The onclick Event</h1>

<div class="container">
    <h2>Registration</h2>
    <form action="" name="registration">
  
      <label for="firstname">First Name</label>
      <input type="text" name="firstname" id="firstname" placeholder="John"/>
  
      <label for="lastname">Last Name</label>
      <input type="text" name="lastname" id="lastname" placeholder="Doe"/>
  
      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="john@doe.com"/>
  
      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;"/>
  
      <button type="submit">Register</button>
  
    </form>
</div>

<button onclick="myFunction(1111)">Click me</button>

<p id="demo"></p>

<script>


function myFunction(id) {
    swal("Here's the title!", "...and here's the text!"+id);
}


$(function() {
  $("form[name='registration']").validate({
    rules: {
      firstname: "required",
      lastname: "required",
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    messages: {
      firstname: "Please enter your firstname",
      lastname: "Please enter your lastname",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

var ContactUs = function(){

var createElement = function () {
    validateForm()
    /*$("#contact_form").submit(function(){
        var data = {
            contact_name : $('#contact_name').val(),
            phone_contact: $('#phone_contact').val(),
            email_contact : $('#email_contact').val(),
            topic_contact : $('#topic_contact').val(),
            message_contact :$('#message_contact').val()
        }
        console.table(data)
        //alert('Sucess');




        /!*App.confirm('Are you sure to contact us ?',null,true,function () {
            $.when(App.getService('/services/contactus/sendcontacttus', data)).done(function (data) {
               App.alert('testtt')
            }).fail(function (data) {
                App.pageLoading(false);
                App.alert(data, '', 'error')
            })
        })*!/
    });*/
}

var validateForm = function () {
    $('#contact_form').validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            contact_name: {
                required: true,
                maxlength: 100
            },
            phone_contact: {
                required: true,
                maxlength: 100
            },
            email_contact: {
                required: true,
            },
            topic_contact:{
                required: true,
            },
            message_contact:{
                required: true,
            }
        },

        errorPlacement: function (error, element) {
            var icon = $(element).parent('.input-icon').children('i');
            icon.addClass("fa-warning");
            icon.attr("data-original-title", error.text()).tooltip({ container: 'body', placement: 'left' });
            //console.log(icon);
        },

        invalidHandler: function (event, validator) { //display error alert on form submit

            var errors = validator.numberOfInvalids();
            if (errors) {
                validator.errorList[0].element.focus();
            }
        },

        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group

            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
            }
        },

        unhighlight: function (element) { // revert the change done by hightlight
            $(element)
                .closest('.form-group').removeClass('has-error'); // set error class to the control group

            var elem = $(element);
            if (elem.hasClass("select2-offscreen")) {
                $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
            }
        },

        success: function (label, element) {

            var icon = $(element).parent('.input-icon').children('i');
            $(element).closest('.form-group').removeClass('has-error');
            icon.removeClass("fa-warning");
        },

        submitHandler: function (form) {
            var data = {
                contact_name : $('#contact_name').val(),
                phone_contact: $('#phone_contact').val(),
                email_contact : $('#email_contact').val(),
                topic_contact : $('#topic_contact').val(),
                message_contact :$('#message_contact').val()
            }
            $.ajax({
                url: '/services/contactus/sendcontacttus',
                method: 'POST',
                data:data,
                success:function(data){
                    //'data' is the value returned.
                    var alert = document.getElementById('alert_contact');
                    alert.style.display = 'block'
                    $('#alert_contact').html("<strong>Success!</strong> Send contact us.")
                    setTimeout(function () {
                        location.reload();
                    },3000)
                },
                error:function(){
                    alert('An error was encountered.');
                }
            });
        }
    });
};
var init = function () {
    createElement();
};
return{
    init:init,

}
}();

$(document).ready(function () {
ContactUs.init();
});
</script>

</body>
</html>