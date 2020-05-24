document.addEventListener('DOMContentLoaded', () => {
  const password = document.querySelector('input[type="password"]');
  password.addEventListener('focusout', function() {
    error.style.visibility = "hidden";
    password.style.border = "#4AC3DB 2px solid"
  });
  const form = document.querySelector('form');
  form.addEventListener('submit', (Event) => {

    Event.preventDefault();
    const email = document.querySelector('input[type="email"]');
    const password = document.querySelector('input[type="password"]');
    const error = document.querySelector('#error');
    // fetch("https://venato.fr/supinternet/pt/index.php/api/login", myInit)
    $.ajax({
        url : config.web_server+'api/login',
        type : 'POST',
        dataType : 'json',
        data: JSON.stringify({"email": email.value, "password": password.value}),

        error : function(resultat, statut, erreur){
          console.log(erreur);
        },

        complete : function(resultat, statut){
          if(typeof resultat.responseJSON == "object") {
            localStorage.setItem('Connexion', 'true');
            localStorage.setItem('id', resultat.responseJSON.id);
            window.location = './home.html';
          } else{
            error.style.visibility = "visible";
            password.style.border = "red 2px solid"
          }
        }

    });
    // fetch("http://localhost:8000/api/login", myInit)
    // .then((res) =>  {
    //   res.json()
    //   .then((json) =>  {
    //     console.log(json);
    //     if (json) {
    //       localStorage.setItem('Connexion', 'true');
    //       localStorage.setItem('id', json.id);
    //       //window.location = './home.html';
    //     }
    //   });
    // });
  });
});
