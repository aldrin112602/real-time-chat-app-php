$(document).ready(() => {
  setInterval(() => {
    fetch('users.php')
    .then(res => res.text())
    .then(res => {
       $('.users').html(res);
       if($('#search').val().length > 0) {
         w3.filterHTML('.users', '.user', $('#search').val());
     }
    });
  }, 300);
})