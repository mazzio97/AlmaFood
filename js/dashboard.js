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
  $(".instance-orders").on("click","a.text-success" ,function() {
    var orderId = $(this).parentsUntil(".instance-orders").find(".order-id").text();
    var newState = 2;
    showNotification("Richiesta accettata", "success");
    $(this).parentsUntil(".notification-panel").slideUp("slow");
    $.getJSON("php/dashboard.php?request=modify_order&orderId=" + orderId + "&state=" + newState);
  });
  $(".instance-orders").on("click", "a.text-danger", function() {
    var orderId = $(this).parentsUntil(".instance-orders").find(".order-id").text();
    var newState = 3;
    showNotification("Richiesta declinata", "danger");
    $(this).parentsUntil(".notification-panel").slideUp("slow");
    $.getJSON("php/dashboard.php?request=modify_order&orderId=" + orderId + "&state=" + newState);
  });
  $(".instance-orders").on("click", "a.order-details", function() {
    var orderId = getOrderId($(this));
    $.getJSON("php/dashboard.php?request=dishes_in_order&orderId=" + orderId, function(output) {
      var html_code = "";
      var template = retrieveTemplate("template-details");
      for(var i = 0; i < output["dish"].length; i++)
        html_code += bindArgs(template, output["dish"][i]["nomePietanza"]);
      $(".instance-details").html(html_code);
   });
  })

  $.getJSON("php/dashboard.php?request=orders", function(output) {
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
  });
});
