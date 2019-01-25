var refreshTime = 10;

function getOrderId(e) {
  return e.closest(".notification-panel").data("id");
}

function loadOrders() {
  // REMOVE PREVIOUS TIMEOUT IF PRESENT
  $.post("php/sessionAPI.php", { req: "get", var: "currentTimeout" }, function(timeoutId) {
      clearTimeout(timeoutId);
  }, "json");
  // RETRIEVE ORDERS
  $.post("php/vendor_orders.php", { request: "orders" }, function(output) {
    if(output["error"]["class"] != "NONE") {
      $(".instance-orders").html(getNoResultsHtml());
      return;
    }
    var html_code = "";
    var template = retrieveTemplate("template-orders");
    for(key in output.orders) {
      var details = "";
      var order = output.orders[key];
      for (key in order.dishes)
        details += "<li>" + order.dishes[key] + "</li>";
      html_code += bindArgs(template, order.ordine, order.nominativo, details, order.aula, getHoursMin(order.oraConsegna));
    }
    $(".instance-orders").html(html_code);
  }, "json")
  // SET NEW TIMEOUT
    .always(function() {
      $.post("php/sessionAPI.php", { req: "set", var: "currentTimeout", val: setTimeout(loadOrders, refreshTime * 1000) });
    });
}
$(function() {
  loadOrders();

  $(".instance-orders").on("click", ".send-order", function() {
    var panel = $(this).closest(".notification-panel");
    $.post("php/vendor_orders.php", { request: "send", orderId: getOrderId($(this)) }, function(output) {
      if (output["error"]["class"] != "NONE")
        alert(output["error"]["description"]);
      else {
        showNotification("Ordine spedito", "success");
        panel.fadeOut(function() {
          loadOrders();
        });
      }
    }, "json");
  });
});
