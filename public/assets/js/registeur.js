document.addEventListener('DOMContentLoaded', () => {
  const password = document.querySelector('#password');
  const confirmPassword = document.querySelector('#confirmPassword');
  password.addEventListener('focusout', function() {
    if (password.value == confirmPassword.value) {
      error.style.visibility = "hidden";
      confirmPassword.style.border = "green 2px solid"
      password.style.border = "green 2px solid"
    }else {
      error.style.visibility = "visible";
      confirmPassword.style.border = "red 2px solid"
      password.style.border = "red 2px solid"
    };
  });
  confirmPassword.addEventListener('focusout', function() {
    if (password.value == confirmPassword.value) {
      error.style.visibility = "hidden";
      confirmPassword.style.border = "green 2px solid"
      password.style.border = "green 2px solid"
    }else {
      error.style.visibility = "visible";
      confirmPassword.style.border = "red 2px solid"
      password.style.border = "red 2px solid"
    };
  });
  const form = document.querySelector('form');
  form.addEventListener('submit', (Event) => {

    Event.preventDefault();
    const pseudo = document.querySelector('#pseudo');
    const email = document.querySelector('#email');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirmPassword');
    const error = document.querySelector('#error');
    if (password.value == confirmPassword.value) {
      var myInit = {
        headers: {
          "Content-type": "application/json"
        },
        method: 'POST',
        body: JSON.stringify({
          "pseudo": pseudo.value,
          "email": email.value,
          "password": password.value
        })
      };
      fetch(config.web_server + "api/register", myInit)
        .then((res) => {
          res.json()
            .then((json) => {
              if (json) {
                Swal.fire({
                  icon: 'success',
                  text: "Votre compte à bien été créé",
                
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'ok'
                }).then((result) => {
                  if (result.value) {
                    Swal.fire(
                      window.location = './connexion.html'
                    )
                  }
                })
              }
            });
        });
    } else {
      error.style.visibility = "visible";
      confirmPassword.style.border = "red 2px solid"
      password.style.border = "red 2px solid"
    }
  });
});
