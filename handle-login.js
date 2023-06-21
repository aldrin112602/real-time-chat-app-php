$(document).ready(() => {
  $('form').on('submit', e => {
   e.preventDefault()
   $('#submit').val('Loading, please wait..');
   $('#submit').attr('disabled', true);
   $.post('handle login request.php', $('form').serialize(), res => {
          $('.err-msg').html(res);
          $('#submit').val('Continue to Chat');
          $('#submit').attr('disabled', false);
          const dat = res.toLowerCase().trim();
          if(dat.search(atob('bG9nZ2Vk')) >= 0) {
             location.href = 'start conversation.php';
          }
   });
 });
  
})
