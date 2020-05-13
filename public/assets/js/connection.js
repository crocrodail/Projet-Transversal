document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');
  form.addEventListener('submit', (Event) => {

    Event.preventDefault();
    const email = document.querySelector('input[type="email"]');
    const password = document.querySelector('input[type="password"]');
    var myInit = {
      headers: { "Content-type": "application/json"},
      method: 'POST',
      body: JSON.stringify({"email": email.value, "password": password.value})
    };

    fetch("http://localhost:8000/api/login", myInit)
    .then((res) =>  {
      res.json()
      .then((json) =>  {
          if (json == true) {
            localStorage.setItem('Connexion', 'true');
            window.location = './home.html';
          }
      });
    });

  });
});
