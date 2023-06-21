

$(document).ready(() => {
  $('#file').on('input', function() {
    let reader = new FileReader();
    reader.onload = e => $('#file_data').val(e.target.result);
    reader.readAsDataURL($('#file').prop('files')[0]);
  });
  
  
  
 $('form').on('submit', e => {
   e.preventDefault()
   $('#submit').val('Loading, please wait..');
   $('#submit').attr('disabled', true);
   window.fetch('handle signup request.php', {
     method: 'POST',
     body: new FormData(document.querySelector('form'))
   })
   .then(res => res.text())
   .then(res => {
     $('.err-msg').html(res);
     $('#submit').val('Continue to Chat');
     $('#submit').attr('disabled', false);
     const dat = res.toLowerCase().trim();
      if(dat.search(atob('Y29uZ3JhdHVsYXRpb25z')) >= 0) {
         location.href = 'start conversation.php';
      }
   });
   
 });
})
