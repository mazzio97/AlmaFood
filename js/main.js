$(function() {
  $.getJSON("php/json/session.php", function(output) {
    if (output["tipo"] === "cliente") {
      $("#pageContainer").load("html/restaurants.html");
      $(".client-nav").show();
    } else {
      $("#pageContainer").load("html/dashboard.html");
      $(".vendor-nav").show();
    }
  });

  $("nav li").click(function() {
    var page = "html/" + $(this).attr("name") + ".html";
    $("#pageContainer").load(page, function(responseTxt, statusTxt, xhr) {
      if(statusTxt === "error" && page !== "html/exit.html")
        $("#pageContainer").html("<h1>ERROR 404</h1><br/><h4>page " + page + " not found</h4>");
    });
  });
});
