document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');
  form.addEventListener('submit', (Event) => {

    Event.preventDefault();
    const pseudo = document.querySelector('#pseudo');
    const email = document.querySelector('#email');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirmPassword');
    if(password.value == confirmPassword.value){
      var myInit = {
        headers: { "Content-type": "application/json"},
        method: 'POST',
        body: JSON.stringify({"pseudo": pseudo.value, "email": email.value, "password": password.value})
      };

      fetch("http://localhost:8000/api/register", myInit)
      .then((res) =>  {
        res.json()
        .then((json) =>  {
            if (json){
              alert("votre compte a bien été créer");
              window.location = './connexion.html';
            }
        });
      });
    }
  });
});
