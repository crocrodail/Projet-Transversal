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
