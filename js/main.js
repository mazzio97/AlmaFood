var homepage = { "cliente": "html/restaurants.html", "fornitore": "html/dashboard.html" };

$(document).ready(function() {
  $.getJSON("php/json/session.php", function(output) {
    $.get(homepage[output["tipo"]], function(htmlCode) {
      $("#pageContainer").html(htmlCode);
    });
    var navbar = output["tipo"] === "cliente" ? $(".client-nav") : $(".vendor-nav");
    navbar.show();
  });

  $("nav li").click(function() {
    var page = "html/" + $(this).attr("name") + ".html";
    $.get(page)
     .done(function(htmlCode) {
       $("#pageContainer").html(htmlCode);
     })
     .fail(function(jqXHR, textStatus, errorThrown) {
       $("#pageContainer").html("ERROR 404<br/>page " + page + " not found");
     });
   });
});
