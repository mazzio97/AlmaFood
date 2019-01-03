$(document).ready(function() {
    $(".carousel-control a").click(function() {
        $(".carousel-control").remove();
    });

    $("#loginBtn").click(function(event) {
      event.preventDefault();

      var input = {
        user: $("#inputUser").val(),
        password: $("#inputLoginPassword").val(),
        remember: $("#rememberPassword").prop("checked")
      };

      $.post("php/login.php", input, function(output) {
        switch(output["error"]["class"]) {
          case "NONE":
            $(location).attr("href", "/almafood/dashboard.php");
            break;
          case "USER":
            $("#loginErr").show();
            $("#loginErr").html(output["error"]["description"]);
            $("#inputLogiPassword").val("");
            if (output["error"]["source"] === "USERNAME")
              $("#inputUser").val("");
            break;
          default:
            $("#loginErr").show();
            $("#loginErr").html("internal error");
        }
      }, "json");
    });

    $("#registerBtn").click(function(event) {
      event.preventDefault();

      if(!$("#acceptTerms").prop("checked")) {
        $("#registerErr").show();
        $("#registerErr").html("accept the terms to go on");
        return;
      }
      if($("#inputRegisterPassword").val() != $("#inputConfirmPassword").val()) {
        $("#registerErr").show();
        $("#registerErr").html("passwords are not the same");
        return;
      }

      var input = {
        name: $("#inputName").val(),
        surname: $("#inputSurname").val(),
        email: $("#inputEmail").val(),
        username: $("#inputUsername").val(),
        userRole: $("#client").prop("checked") ? "cliente" : "fornitore",
        restaurant: $("#inputRestaurant").val(),
        password: $("#inputRegisterPassword").val()
      };

      $.post("php/signup.php", input, function(output) {
        switch(output["error"]["class"]) {
          case "NONE":
            $(location).attr("href", "/almafood/dashboard.php");
            break;
          case "USER":
            $("#registerErr").show();
            $("#registerErr").html(output["error"]["description"]);
            if(output["error"]["source"] === "USERNAME")
              $("#inputUsername").val("");
            else
              $("#inputEmail").val("");
            break;
          default:
            $("#registerErr").show();
            $("#registerErr").html("internal error");
        }
      }, "json");
    });
});
