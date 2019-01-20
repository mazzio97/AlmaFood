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
function getUTCFromDate(date) {
    return Math.floor(date.getTime() / 1000);
}
function getHoursMin(utc) {
    return getDateFromUTC(utc).getHours() + ":" + getDateFromUTC(utc).getMinutes();
}
function getOrderId(e) {
  return e.parentsUntil(".instance-orders").find(".order-id").text();
}

$(function() {
  $.post("php/dashboard/getData.php", { request: "orders" }, function(output) {
    var html_code = "";
    if(output["error"]["class"] == "SERVER" && output["error"]["source"] == "QUERY") {
      html_code += '<li><p align="center" style="color: red">' + output["error"]["description"] + '</p></li>';
      $("ul.notifications").html(html_code);
      return;
    }
    var template = retrieveTemplate("template-orders");
    for (var i = 0; i < output["order"].length; i++) {
      var ordine = output["order"][i];
      html_code += bindArgs(template, ordine["nominativo"],
                                      ("00000" + ordine["ordine"]).slice(-6),
                                      getDateFromUTC(ordine["oraConsegna"]),
                                      ordine["aula"],
                                      ordine["costo"]);
    }
    $(".instance-orders").html(html_code);
  }, "json");

  $(".instance-orders").on("click", "a.text-success", function() {
    var id = getOrderId($(this));
    showNotification("Richiesta accettata", "success");
    $(this).parentsUntil(".notification-panel").slideUp("slow");
    $.post("php/dashboard/getData.php", { request: "modify_order", orderId: id, state: 2 });
  });
  $(".instance-orders").on("click", "a.text-danger", function() {
    var id = getOrderId($(this));
    showNotification("Richiesta declinata", "danger");
    $(this).parentsUntil(".notification-panel").slideUp("slow");
    $.post("php/dashboard/getData.php", { request: "modify_order", orderId: id, state: 3 });
  });
  $(".instance-orders").on("click", "a.order-details", function() {
    var id = getOrderId($(this));
    $.post("php/dashboard/getData.php", { request: "dishes_in_order", orderId: id }, function(output) {
      var html_code = "";
      var template = retrieveTemplate("template-details");
      for(var i = 0; i < output["dish"].length; i++)
        html_code += bindArgs(template, output["dish"][i]["pietanza"]);
      $(".instance-details").html(html_code);
   }, "json");
  })
});
