document.addEventListener('DOMContentLoaded', () => {
  var configGame = {
    status: localStorage.getItem('statut'),
    gameid: null,
    theme: null,
    me : null,
    me_url: null,
    ennemy: null,
    ennemy_url: null,
    type: null,
    msg: null,
  };
  const theme = document.querySelector('.contenttheme');
  const choseEnemy = document.querySelector('.contentchoose');
  const choseFriend = document.querySelector('.invite');
  const waiting = document.querySelector('.waiting');
  const game = document.querySelector('.game');
  var conn = new WebSocket('ws://localhost:7080/');
  conn.onmessage = function(e) {
    console.log(JSON.parse(e.data));
    var info = JSON.parse(e.data);
    if (info.gameid == configGame.gameid){

      if (info.type != configGame.type){

      }
    }
  };


  document.addEventListener('click', (e) =>{
    var conn = new WebSocket('ws://localhost:7080/');
    conn.onopen = function(e) { conn.send(JSON.stringify(configGame));conn.close(); };
    console.log('click');
  });


  $.ajax({
    url : config.web_server+'api/getfriends',
    type : 'POST',
    dataType : 'json',
    data: JSON.stringify({"userId": localStorage.getItem('id')}),

    error : function(resultat, statut, erreur){
      console.log(erreur);
    },

    complete : function(resultat, statut){
      Object.keys(resultat.responseJSON).forEach((item, i) => {
        var div = document.createElement("div");
        var p = document.createElement("p");
        var img = document.createElement("IMG");
        choseFriend.appendChild(div);
        div.appendChild(p);
        div.appendChild(img);
        div.setAttribute("class", "ami");
        img.setAttribute("src", resultat.responseJSON[item].url);
        p.innerHTML = resultat.responseJSON[item].pseudo;
      });
    }
  });

  if (localStorage.getItem('Connexion') == "true") {

    updateGame();

  } else {

    window.location = './newGame.html';

  }

  // TODO: choseRandom

  function updateGame(){
    console.log(configGame.status);
    switch (configGame.status) {
      case "newGame":
        configGame.gameid = localStorage.getItem('id');
        theme.style.display = 'block';
        var themeButton = theme.querySelectorAll('button');
        themeButton.forEach((item, i) => {
          item.addEventListener('click', (e) =>{
            configGame.theme = item.value;
            configGame.status = "choseEnemy";
            updateGame();
          });
        });
        break;
      case "inviteFriend":
        configGame.gameid = localStorage.getItem('id');
        theme.style.display = 'block';
        var themeButton_ng = theme.querySelectorAll('button');
        themeButton_ng.forEach((item, i) => {
          item.addEventListener('click', (e) =>{
            configGame.theme = item.value;
            configGame.status = "choseFriend";
            updateGame();
          });
        });
        break;
      case "choseEnemy":
        theme.style.display = 'none';
        choseEnemy.style.display = 'block';
        var btn1 = choseEnemy.querySelector('#friend');
        btn1.addEventListener('click', (e) =>{
          configGame.status = "choseFriend";
          updateGame();
        });
        var btn2 = choseEnemy.querySelector('#random');
        btn1.addEventListener('click', (e) =>{
          configGame.status = "choseRandom";
          updateGame();
        });
        break;
      case "choseFriend":
        theme.style.display = 'none';
        choseEnemy.style.display = 'none';
        choseFriend.style.display = "block";
        var btn_friends = choseFriend.querySelectorAll('.ami');
        btn_friends.forEach((item, i) => {
          item.addEventListener('click', (e) =>{
            configGame.ennemy = item.innerText;
            configGame.ennemy_url = item.children[1].src;
            configGame.status = "waitingPlayer";
            console.log(localStorage.getItem('id'), configGame.ennemy);
            $.ajax({
              url : config.web_server+'api/sendInvite',
              type : 'POST',
              dataType : 'json',
              data: JSON.stringify({"userId": localStorage.getItem('id'), "pseudo_invite": configGame.ennemy}),

              error : function(resultat, statut, erreur){
                console.log(erreur);
              },

              complete : function(resultat, statut){
                console.log(resultat);
              }
            });
            updateGame();
          });
        });
        break;
      case "waitingPlayer":
        configGame.type = "host";
        choseFriend.style.display = "none";
        choseEnemy.style.display = 'none';
        waiting.style.display = 'block';
        var player = waiting.querySelector('.player');
        player.children[0].innerHTML = configGame.ennemy;
        player.children[1].src = configGame.ennemy_url;
        var msg = waiting.querySelector('#msg_waiting');
        msg.innerHTML = "en attente <span>"+ configGame.ennemy +"</span> ...";
        break;
      case "invite":
        waiting.style.display = 'block';
        configGame.gameid = localStorage.getItem('gameid');
        configGame.type = "guest";
        var msgg = waiting.querySelector('#msg_waiting');
        msgg.innerHTML = "l'hote vas bientot lancé la partie ...";
        var btnstart = waiting.querySelector('button');
        btnstart.style.display = "none";
        break;
      default:

    }

  }

});
