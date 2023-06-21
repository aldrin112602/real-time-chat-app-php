$(document).ready(function () {
  $('i').on('click', e => {
   if($('#pswd').prop('type') == 'password') {
     $('i').removeClass('fa-eye-slash');
     $('i').addClass('fa-eye');
     $('#pswd').prop('type', 'text');
   }
   else {
     $('i').addClass('fa-eye-slash');
     $('i').removeClass('fa-eye');
     $('#pswd').prop('type', 'password');
   }
  
  });
});