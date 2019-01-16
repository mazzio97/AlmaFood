function showError(error, selector) {
  switch(error["class"]) {
    case "NONE":
      $(location).attr("href", "/almafood");
      return;
    case "SERVER":
      error["description"] = "internal error";
  }
  $(selector).show();
  $(selector).html(error["description"]);
}

function checkboxToggle() {
  $("#inputName").parent().toggle();
  $("#inputSurname").parent().toggle();
  $("#inputRestaurant").parent().toggle();
}

$(function() {
    $("#loginErr").hide();
    $("#registerErr").hide();
    $("#inputRestaurant").parent().hide();

    $(".carousel-control a").click(function() {
        $(".carousel-control").remove();
        $(".plate").remove();
    });

    $("#client").change(function() {
      checkboxToggle();
    });

    $("#vendor").change(function() {
      checkboxToggle();
    });

    $("#loginBtn").click(function(event) {
      event.preventDefault();
      // JSON DATA
      var input = {
        user: $("#inputUser").val().trim(),
        password: $("#inputLoginPassword").val(),
        remember: $("#rememberPassword").prop("checked")
      };
      // DATA
      $.post("php/enter/login.php", input, function(output) {
        showError(output["error"], "#loginErr");
      }, "json");
    });

    $("#registerBtn").click(function(event) {
      event.preventDefault();
      // TERMS CHECKS
      if(!$("#acceptTerms").prop("checked")) {
        $("#registerErr").show();
        $("#registerErr").html("accetta i termini per continuare");
        return;
      }
      // PASSWORDS CHECKS
      if($("#inputRegisterPassword").val() != $("#inputConfirmPassword").val()) {
        $("#registerErr").show();
        $("#registerErr").html("le password non corrispondono");
        return;
      }
      // JSON DATA
      var input = {
        name: $("#inputName").val().trim(),
        surname: $("#inputSurname").val().trim(),
        restaurant: $("#inputRestaurant").val().trim(),
        email: $("#inputEmail").val().trim(),
        username: $("#inputUsername").val().trim(),
        userRole: $("#client").prop("checked") ? "cliente" : "fornitore",
        password: $("#inputRegisterPassword").val()
      };
      // POST
      $.post("php/enter/signup.php", input, function(output) {
        showError(output["error"], "#registerErr");
      }, "json");
    });
});
