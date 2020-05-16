document.addEventListener('DOMContentLoaded', () => {
  var myInit = {
    headers: { "Content-type": "application/json"},
    method: 'POST',
    body: JSON.stringify({"email": email.value, "password": password.value})
  };
  setInterval(function () {

    fetch("http://localhost:8000/api/invited", myInit)
    .then((res) =>  {
      res.json()
      .then((json) =>  {
        if (json == true) {
          $.notify.addStyle('foo', {
            html:
              "<div>" +
                "<div class='clearfix'>" +
                  "<span data-notify-text='speudo'></span><p data-notify-text='msg'></p>" +
                  "<div class='buttons'>" +
                    "<button class='no'>Refuser</button>" +
                    "<button id='" + json.id + "' class='yes' data-notify-text='button'></button>" +
                  "</div>" +
                "</div>" +
              "</div>"
          });

          $(document).on('click', '.notifyjs-foo-base .no', function() {
            $(this).trigger('notify-hide');
          });

          $(document).on('click', '.notifyjs-foo-base .yes', function() {
            alert(json.id + " clicked!");
            $(this).trigger('notify-hide');
          });

          $.notify({
            button: 'Jouer !',
            msg: 'vous a invité à jouer !',
            speudo: 'Michel',
          }, {
            style: 'foo',
            autoHide: false,
            clickToHide: false,
          });
        }
      });
    });

  }, 3000);

});
