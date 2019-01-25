var refreshTime = 10;

function showNotification(msg, type) {
  if ($(window).width() > 976) {
      $.bootstrapGrowl(msg, {
        ele: "body", // which element to append to
        type: type, // (null, 'info', 'danger', 'success')
        offset: {from: "bottom", amount: 20}, // 'top', or 'bottom'
        align: "left", // ('left', 'right', or 'center')
        width: 240, // (integer, or 'auto')
        delay: 3000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: true, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
      });
  }
}
function getDateFromUTC(utc) {
    var date = new Date();
    date.setTime(utc * 1000);
    return date.toLocaleString();
}
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
      html_code += bindArgs(template, order.ordine, order.nominativo, details, order.aula, getDateFromUTC(order.oraConsegna));
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
