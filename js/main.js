$(function() {
  $.post("php/sessionAPI.php", { req: "get", var: "all" }, function(output) {
    if (output["tipo"] === "cliente") {
      $(".client-nav").show();
      loadPage("restaurants");
    } else {
      $(".vendor-nav").show();
      loadPage("dashboard");
    }
  }, "json");

  $("nav li").click(function() {
    loadPage($(this).attr("name"));
  });
});
