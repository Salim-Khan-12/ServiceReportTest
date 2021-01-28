var UserManage = function(){
    var manage = function(){
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }
    
    var init = function(){
      manage();
    }

    return {
      init:init,
    }
  }();
  
  $(document).ready(function(){
    UserManage.init()
  })
 
