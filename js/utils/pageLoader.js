function loadPage(page) {
  $("#pageContainer").load("html/" + page + ".html", function(responseTxt, statusTxt, xhr) {
    if(statusTxt === "error" && page !== "exit")
      $("#pageContainer").html("<h1>ERROR 404</h1><br/><h4>page html/" + page + ".html not found</h4>");
  });
  $.getScript("js/" + page + ".js");
  $.getScript("js/utils/timeout.js");
}
