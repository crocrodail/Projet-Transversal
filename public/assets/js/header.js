document.addEventListener('DOMContentLoaded', () => {
  const button = document.querySelector('.login');
  if (localStorage.getItem('Connexion') == "true"){
    button.innerHTML = "Se déconnecter";
  } else {
    button.innerHTML = "Se connecter";
  }
  const connection = document.querySelector('header a[href="./connexion.html"]');
  connection.addEventListener('click', (event) => {
    event.preventDefault();
    if (localStorage.getItem('Connexion') == "true"){
      localStorage.removeItem('Connexion');
      localStorage.removeItem('id');
      button.innerHTML = "Se connecter";
    } else {
      window.location = './connexion.html';
    }
  });
  const monCompte = document.querySelector('header a[href="./MyAccount.html"]');
  monCompte.addEventListener('click', (event) => {
    if (localStorage.getItem('Connexion') != "true"){
      event.preventDefault();
      window.location = './connexion.html';
    }
  });
});
