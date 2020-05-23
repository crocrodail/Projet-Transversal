document.addEventListener('DOMContentLoaded', () => {
  var configGame = {
    status: localStorage.getItem('statut'),
    gameid: null,
    theme: null,
    me : null,
    me_url: null,
    me_points: 0,
    ennemy: null,
    ennemy_url: null,
    ennemy_points: 0,
    type: null,
    msg: null,
    questions: {},
    actualQuestion: 0,
    actualResponsePlay: null,
    canPlay: false,
  };
  const theme = document.querySelector('.contenttheme');
  const choseEnemy = document.querySelector('.contentchoose');
  const choseFriend = document.querySelector('.invite');
  const waiting = document.querySelector('.waiting');
  const loading = document.querySelector('.loading');
  const game = document.querySelector('.game');
  const end = document.querySelector('.end');
  var conn = new WebSocket(config.game_server);
  conn.onmessage = function(e) {
    var info = JSON.parse(e.data);
    if (info.gameid == configGame.gameid){
      console.log("same id");

      switch (info.msg) {
        case "start":
          configGame.status = "start";
          updateGame();
          break;
        case "nextQuestion":
          console.log(configGame.actualQuestion, configGame.questions.length);
          if (configGame.actualQuestion >= configGame.questions.length){
            configGame.status = "end";
            console.log("ENDDDDDDDDD");
            updateGame();
          } else {
            configGame.status = "nextQuestion";
            console.log("NEXTQUESTION");
            updateGame();
          }
          break;
        default:

      }

      if (info.type != configGame.type){
        console.log("not same type");
        console.log(info.msg);
        switch (info.msg) {
          case "accepted":
            var conn = new WebSocket(config.game_server);
            configGame.msg = "confirmAccept";
            conn.onopen = function(e) { conn.send(JSON.stringify(configGame));conn.close(); };
            var btn_launch = waiting.querySelector('button');
            var loading = waiting.querySelector('.loader');
            var msg3 = waiting.querySelector('#msg_waiting');
            btn_launch.classList.remove("disabled");
            btn_launch.addEventListener('click', (e) =>{
              var conn = new WebSocket(config.game_server);
              configGame.msg = "start";
              conn.onopen = function(e) { conn.send(JSON.stringify(configGame));conn.close(); };
            });
            loading.style.display = "none";
            msg3.innerHTML = "<span>"+ configGame.ennemy + "</span> est prèt, vous pouvez lancer !";
            break;
          case "confirmAccept":
          console.log("actu");
            configGame.theme = info.theme;
            configGame.me = info.ennemy;
            configGame.me_url = info.ennemy_url;
            configGame.ennemy = info.me;
            configGame.ennemy_url = info.me_url;
            configGame.questions = info.questions;
            var player = waiting.querySelector('.player');
            player.children[0].innerHTML = configGame.ennemy;
            player.children[1].src = configGame.ennemy_url;
            break;
          case "showResult":
            var resp = game.querySelectorAll('.reponse button');
            if (info.actualResponsePlay != null) {
              resp[info.actualResponsePlay-1].children[1].src = configGame.ennemy_url;
              resp[info.actualResponsePlay-1].children[1].style.display = "block";
            }
            var correction = Number(configGame.questions[configGame.actualQuestion].corrected);
            setTimeout(function () {
              resp[correction-1].classList.add("correct");
              if ((info.actualResponsePlay != correction) && (info.actualResponsePlay != null)) {
                resp[info.actualResponsePlay-1].classList.add("error");
              } else if ((info.actualResponsePlay != null)) {
                configGame.ennemy_points = configGame.ennemy_points + 100;
              }
              if ((configGame.actualResponsePlay != correction) && (configGame.actualResponsePlay != null)) {
                resp[configGame.actualResponsePlay-1].classList.add("error");
              } else if (configGame.actualResponsePlay != null) {
                configGame.me_points = configGame.me_points + 100;
              }
              configGame.actualResponsePlay = null;
              configGame.actualQuestion = configGame.actualQuestion + 1;
              var playerInfo = game.querySelector('.center');
              playerInfo.children[0].children[1].children[0].innerText = configGame.me_points;
              playerInfo.children[2].children[1].children[0].innerText = configGame.ennemy_points;
              setTimeout(function () {
                if (configGame.type == "host"){
                  var conn = new WebSocket(config.game_server);
                  configGame.msg = "nextQuestion";
                  conn.onopen = function(e) { conn.send(JSON.stringify(configGame));conn.close(); };
                }
              }, 2000);
            }, 2000);
            break;
          default:
        }
      }
    }
  };

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
        $.ajax({
          url : config.web_server+'api/getMyInfo',
          type : 'POST',
          dataType : 'json',
          data: JSON.stringify({"userId": localStorage.getItem('id')}),

          error : function(resultat, statut, erreur){
            console.log(erreur);
          },

          complete : function(resultat, statut){
            configGame.me = resultat.responseJSON.pseudo;
            configGame.me_url = resultat.responseJSON.picture_profile;
          }
        });
        $.ajax({
          url : config.web_server+'api/getQuestions',
          type : 'POST',
          dataType : 'json',
          data: JSON.stringify({"theme": configGame.theme}),

          error : function(resultat, statut, erreur){
            console.log(erreur);
          },

          complete : function(resultat, statut){
            configGame.questions = resultat.responseJSON;
          }
        });
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
        var conn = new WebSocket(config.game_server);
        configGame.msg = "accepted";
        conn.onopen = function(e) { conn.send(JSON.stringify(configGame));conn.close(); };
        break;
      case "start":
        var loader = loading.querySelector('.center');
        var a = 0;
        loader.children[0].src = configGame.me_url;
        loader.children[1].ldBar.set(a);
        loader.children[2].src = configGame.ennemy_url;
        waiting.style.display = 'none';
        loading.style.display = "block";
        refreshLoader();
        function refreshLoader(){
          if (a <= 100){
            setTimeout(function () {
              loader.children[1].ldBar.set(a);
              a++;
              refreshLoader();
            }, 10);
          } else {
            console.log('start the game');
            configGame.status = "Gamelaunch";
            updateGame();
          }
        }
        break;
      case "Gamelaunch":
        var playerInfo = game.querySelector('.center');
        playerInfo.children[0].children[0].src = configGame.me_url;
        playerInfo.children[1].innerHTML = configGame.theme;
        playerInfo.children[2].children[0].src = configGame.ennemy_url;
        var nb_question = game.querySelector('h1');
        var question = game.querySelector('h2');
        nb_question.innerHTML = "Question "+ (Number(configGame.actualQuestion)+1) +"/"+configGame.questions.length;
        question.innerHTML = configGame.questions[configGame.actualQuestion].question;
        var resp = game.querySelectorAll('.reponse button');
        resp[0].children[2].innerText = configGame.questions[configGame.actualQuestion].response_1;
        resp[1].children[2].innerText = configGame.questions[configGame.actualQuestion].response_2;
        resp[2].children[2].innerText = configGame.questions[configGame.actualQuestion].response_3;
        resp[3].children[2].innerText = configGame.questions[configGame.actualQuestion].response_4;
        resp.forEach((item, i) => {
          item.addEventListener('click', (e) =>{
            if (configGame.canPlay){
              resp[0].children[0].style.display = "none";
              resp[1].children[0].style.display = "none";
              resp[2].children[0].style.display = "none";
              resp[3].children[0].style.display = "none";
              resp[i].children[0].src = configGame.me_url;
              resp[i].children[0].style.display = "block";
              configGame.actualResponsePlay = Number(i)+1;
            }
          });
        });
        var b = 100;
        var timer = game.querySelector('#myBar');
        timer.style.width = "100%";
        configGame.canPlay = true;
        starttimer();
        function starttimer(){
          if (b > -1){
            setTimeout(function () {
              timer.style.width = b+"%";
              if (b < 20){
                timer.style.backgroundColor = "#FE6153";
              } else if (b < 40) {
                timer.style.backgroundColor = "#FFAF56";
              }
              b--;
              starttimer();
            }, 150);
          } else {
            configGame.canPlay = false;
            var conn = new WebSocket(config.game_server);
            configGame.msg = "showResult";
            conn.onopen = function(e) { conn.send(JSON.stringify(configGame));conn.close(); };
          }
        }
        loading.style.display = 'none';
        game.style.display = 'block';
        break;

      case "nextQuestion":
        var nb_question = game.querySelector('h1');
        var question = game.querySelector('h2');
        nb_question.innerHTML = "Question "+ (Number(configGame.actualQuestion)+1) +"/"+configGame.questions.length;
        question.innerHTML = configGame.questions[configGame.actualQuestion].question;
        var resp1 = game.querySelectorAll('.reponse button');
        resp1.forEach((item, i) => {
          item.children[0].style.display = "none";
          item.children[1].style.display = "none";
          item.removeAttribute("class");
        });
        resp1[0].children[2].innerText = configGame.questions[configGame.actualQuestion].response_1;
        resp1[1].children[2].innerText = configGame.questions[configGame.actualQuestion].response_2;
        resp1[2].children[2].innerText = configGame.questions[configGame.actualQuestion].response_3;
        resp1[3].children[2].innerText = configGame.questions[configGame.actualQuestion].response_4;
        var b = 100;
        var timer = game.querySelector('#myBar');
        timer.style.backgroundColor = "#03D055";
        timer.style.width = "100%";
        configGame.canPlay = true;
        starttimer();
        function starttimer(){
          if (b > -1){
            setTimeout(function () {
              timer.style.width = b+"%";
              if (b < 20){
                timer.style.backgroundColor = "#FE6153";
              } else if (b < 40) {
                timer.style.backgroundColor = "#FFAF56";
              }
              b--;
              starttimer();
            }, 150);
          } else {
            configGame.canPlay = false;
            var conn = new WebSocket(config.game_server);
            configGame.msg = "showResult";
            conn.onopen = function(e) { conn.send(JSON.stringify(configGame));conn.close(); };
          }
        }
        break;

      case "end":
        var result = "";
        if (configGame.ennemy_points > configGame.me_points) {
          result = "loose";
        } else if (configGame.ennemy_points == configGame.me_points) {
          result = "draw";
        } else {
          result = "win";
        }
        var content = end.querySelector('.content');
        content.children[0].children[2].src = configGame.me_url;
        content.children[2].children[2].src = configGame.ennemy_url;
        switch (result) {
          case "loose":
            content.children[0].children[0].innerHTML = "Perdant";
            content.children[0].children[1].style.display = "none";
            content.children[0].children[3].children[0].innerHTML = configGame.me_points;
            content.children[2].children[0].innerHTML = "Vainqueur";
            content.children[2].children[1].style.display = "block";
            content.children[2].children[3].children[0].innerHTML = configGame.ennemy_points;
            break;
          case "draw":
            content.children[0].children[0].innerHTML = "Egalité";
            content.children[0].children[1].style.display = "none";
            content.children[0].children[3].children[0].innerHTML = configGame.me_points;
            content.children[2].children[0].innerHTML = "Egalité";
            content.children[2].children[1].style.display = "none";
            content.children[2].children[3].children[0].innerHTML = configGame.ennemy_points;
            break;
          case "win":
            content.children[2].children[0].innerHTML = "Perdant";
            content.children[2].children[1].style.display = "none";
            content.children[2].children[3].children[0].innerHTML = configGame.ennemy_points;
            content.children[0].children[0].innerHTML = "Vainqueur";
            content.children[0].children[1].style.display = "block";
            content.children[0].children[3].children[0].innerHTML = configGame.me_points;
            break;
        }
        game.style.display = 'none';
        end.style.display = 'block';
        $.ajax({
          url : config.web_server+'api/addGame',
          type : 'POST',
          dataType : 'json',
          data: JSON.stringify({"user": configGame.me, "points": configGame.me_points, "victory": result, 'theme': configGame.theme, "score": configGame.me_points/100+'/'+configGame.ennemy_points/100}),

          error : function(resultat, statut, erreur){
            console.log(erreur);
          },

        });
        break;
      default:

    }

  }

});
