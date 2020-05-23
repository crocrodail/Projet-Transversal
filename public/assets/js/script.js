document.addEventListener('DOMContentLoaded', () => {

  setInterval(function () {

    if (localStorage.getItem('Connexion') == "true"){

    $.ajax({
        url : config.web_server+'api/invited',
        type : 'POST',
        dataType : 'json',
        data: JSON.stringify({"userId": localStorage.getItem('id')}),
        success : function(code_html, statut){
        },

        error : function(resultat, statut, erreur){
          console.log('erroe');
        },

        complete : function(resultat, statut){
          if (resultat.responseJSON.length != 0) {
            $.notify.addStyle('foo', {
              html:
                "<div>" +
                  "<div class='clearfix'>" +
                    "<span data-notify-text='speudo'></span><p data-notify-text='msg'></p>" +
                    "<div class='buttons'>" +
                      "<button class='no'>Refuser</button>" +
                      "<button id='3' class='yes' data-notify-text='button'></button>" +
                    "</div>" +
                  "</div>" +
                "</div>"
            });

            $(document).on('click', '.notifyjs-foo-base .no', function() {
              $(this).trigger('notify-hide');
            });

            $(document).on('click', '.notifyjs-foo-base .yes', function() {
              localStorage.setItem('statut', 'invite');
              localStorage.setItem('gameid', resultat.responseJSON[0].id_sender_player);
              window.location = './game.html';
              $(this).trigger('notify-hide');
            });

            $.notify({
              button: 'Jouer !',
              msg: 'vous a invité à jouer !',
              speudo: resultat.responseJSON[0].pseudo,
            }, {
              style: 'foo',
              autoHide: false,
              clickToHide: false,
            });
          }
        }
      });
    }
  }, 3000);


  var play = document.querySelector('.play');
  if (play) {
    play.addEventListener('click', (e) => {
      window.location = './newGame.html';
    });
  }

  var newGame = document.querySelector('#newgame');
  var inviteFriend = document.querySelector('#invite');
  if (newGame && inviteFriend){
    newGame.addEventListener('click', (e) => {
      e.preventDefault();
      trySocket(() => {
        if (localStorage.getItem('id') != null){
          localStorage.setItem('statut', 'newGame');
          window.location = './game.html';
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Vous devez etre connecter',
          });
        }
      });
    });

    inviteFriend.addEventListener('click', (e) => {
      e.preventDefault();
      trySocket(() => {
        if (localStorage.getItem('id') != null){
          localStorage.setItem('statut', 'inviteFriend');
          window.location = './game.html';
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Vous devez etre connecter',
          });
        }
      });
    });


    $.ajax({
      url : config.web_server+'api/historique',
      type : 'POST',
      dataType : 'json',
      data: JSON.stringify({"userId": localStorage.getItem('id')}),

      error : function(resultat, statut, erreur){
        console.log(erreur);
      },

      complete : function(resultat, statut){
        Object.keys(resultat.responseJSON).forEach((item, i) => {
          var div = document.createElement("div");
          var p1 = document.createElement("p");
          var p2 = document.createElement("p");
          var p3 = document.createElement("p");
          document.querySelector('.Historique').appendChild(div);
          div.appendChild(p1);
          div.appendChild(p2);
          div.appendChild(p3);
          div.setAttribute("class", "historique");
          if (resultat.responseJSON[item].victory == 1) {
            resultat.responseJSON[item].victory = "Victory";
          } else {
            div.setAttribute("class", "historique defaite");
            resultat.responseJSON[item].victory = "Defaite";
          }
          p1.innerHTML = resultat.responseJSON[item].score;
          p2.innerHTML = resultat.responseJSON[item].victory;
          p3.innerHTML = resultat.responseJSON[item].name;
        });
      }
    });


    $.ajax({
      url : config.web_server+'api/classement',
      type : 'POST',
      dataType : 'json',

      error : function(resultat, statut, erreur){
        console.log(erreur);
      },

      complete : function(resultat, statut){
        console.log(resultat.responseJSON);
        Object.keys(resultat.responseJSON).forEach((item, i) => {
          if (resultat.responseJSON[item].id == localStorage.getItem('id')) {
            var mypoints = document.querySelector('.pointss');
            mypoints.innerHTML = "<span>"+resultat.responseJSON[item].points+"</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='assets/img/newgame/points.svg' alt='points'>";
          }
          var div = document.createElement("div");
          var h1 = document.createElement("h1");
          var img = document.createElement("IMG");
          var child_div = document.createElement("div");
          var p1 = document.createElement("p");
          var p2 = document.createElement("p");
          document.querySelector('.Classement').appendChild(div);
          div.appendChild(h1);
          div.appendChild(img);
          div.appendChild(child_div);
          child_div.appendChild(p1);
          child_div.appendChild(p2);
          div.setAttribute("class", "classement");
          img.setAttribute("class", "userpp");
          child_div.setAttribute("class", "info");
          h1.innerHTML = i+1;
          img.setAttribute("src", resultat.responseJSON[item].picture_profile);
          p1.setAttribute("class", "pseudo");
          p1.innerHTML = resultat.responseJSON[item].pseudo;
          p2.innerHTML = "<span>"+resultat.responseJSON[item].points+"</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='assets/img/newgame/points.svg' alt='points'>";
        });
      }
    });




  }

  function trySocket(cb) {
    var websocket = new WebSocket(config.game_server);
    setTimeout(() => {
      if (websocket.readyState !== 1) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Les serveurs du Quizz sont hors ligne',
        });
      } else {
        websocket.close();
        return cb();
      }
    }, 1000);
  }



});
