function loadPage(page) {
  if (page != "exit") {
    $("#pageContainer").load("html/" + page + ".html");
    $.getScript("js/" + page + ".js");
    $.getScript("js/utils/timeout.js");
  }
}
