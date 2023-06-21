$(document).ready(() => {
  $('form').on('submit', e => {
    e.preventDefault();
    $.post('handle message.php', $('form').serialize(), res => {
      $('#msg-container').html(res);
    });
    setTimeout(() => {
      $('textarea').val('');
    }, 100)
  })
  
  setInterval(() => {
   fetch("get messages.php?"+$('form').serialize())
   .then(res => res.text())
   .then(res => $('#msg-container').html(res));
  }, 1000);
})