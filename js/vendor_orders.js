var refreshTime = 10;

function getDateFromUTC(utc) {
    var date = new Date();
    date.setTime(utc * 1000);
    return date.toLocaleString();
}
function getOrderId(e) {
  return e.closest(".notification-panel").data("id");
}

function loadOrders() {
  $.post("php/vendor_orders/getData.php", { request: "orders" }, function(output) {
    if(output["error"]["class"] == "SERVER" && output["error"]["source"] == "QUERY") {
      $(".instance-orders").html(output["error"]["description"]);
      return;
    }
    var html_code = "";
    var template = retrieveTemplate("template-orders");
    for(key in output.orders) {
      var details = "";
      var order = output.orders[key];
      for (key in order.dishes)
        details += "<li>" + order.dishes[key] + "</li>";
      html_code += bindArgs(template, order.ordine, order.nominativo, details, order.aula, getDateFromUTC(order.oraConsegna));
    }
    $(".instance-orders").html(html_code);
  }, "json")
    .always(function() {
      setTimeout(loadOrders, refreshTime * 1000);
    });
}
$(function() {
  loadOrders();

  $(".instance-orders").on("click", ".send-order", function() {
    var panel = $(this).closest(".notification-panel");
    $.post("php/vendor_orders/getData.php", { request: "send", orderId: getOrderId($(this)) }, function(output) {
      if (output["error"]["class"] == "NONE")
        panel.fadeOut();
      else
        alert(output["error"]["description"]);
    }, "json");
  });
});
