function loadPage(pageName) {
  var page = "html/" + pageName + ".html";
  $("#pageContainer").load(page, function(responseTxt, statusTxt, xhr) {
    if(statusTxt === "error" && page !== "html/exit.html")
      $("#pageContainer").html("<h1>ERROR 404</h1><br/><h4>page " + page + " not found</h4>");
  });
}

$(function() {
  $.getJSON("php/json/getSession.php", function(output) {
    if (output["tipo"] === "cliente") {
      $(".client-nav").show();
      loadPage("restaurants");
    } else {
      $(".vendor-nav").show();
      loadPage("dashboard");
    }
  });

  $("nav li").click(function() {
    loadPage($(this).attr("name"));
  });
});
