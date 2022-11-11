$(document).ready(function () {
  validateLogin()
})

function validateLogin() {
  $('#loginForm').on('submit', function (evt) {
    $.ajax({
      url: 'api/login.php',
      method: 'POST',
      data: $('#loginForm').serialize(),
      success: function (result) {
        window.location.href = 'index.php'
      },
      error: function (response) {
        const json = JSON.parse(response.responseText)
        $('#loginFormHeader').html(json.message)
      }
    })

    evt.preventDefault()
  })
}
