function showNotification(msg, type) {
    if ($(window).width() > 976) {
        $.bootstrapGrowl(msg, {
            ele: "body", // which element to append to
            type: type, // (null, 'info', 'danger', 'success')
            offset: {from: "bottom", amount: 20}, // 'top', or 'bottom'
            align: "left", // ('left', 'right', or 'center')
            width: 250, // (integer, or 'auto')
            delay: 3000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
        });
    }
}
function getRequiredDate(date, time) {
  return new Date(date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + "T" + (parseInt(time.slice(0, 2)) - 1) + ":" + time.slice(3) + ":00Z");
}
function dateDifference(from, to) {
  var fromDate = parseInt(from.getTime() / 1000);
  var toDate = parseInt(to.getTime() / 1000);
  return (toDate - fromDate) / 3600;
}
$(function() {
  var orderDetails = {
    date : 0,
    totalPrice : 0,
    placeName : "",
    dishes : []
  };
  var date = new Date();
  var maxHorsDifference = 1;
  $.post("php/jsAPI/sessionAPI.php", { req: "get", var: "orderDetails" }, function(output) {
    var template = retrieveTemplate("template-basket");
    orderDetails["dishes"] = output;
    jQuery.each(output, function(dish, info) {
      var partialPrice = parseFloat(info["quantity"]) * parseFloat(info["price"]);
      orderDetails["totalPrice"] += partialPrice;
      $(".instance-basket").append(bindArgs(template, dish, info["quantity"], partialPrice.toFixed(2)));
    });
    $(".basket-total-price").text(orderDetails["totalPrice"].toFixed(2) + "€");
  }, "json");
  $.post("php/checkout/checkout.php", { req: "places" }, function(output) {
    var template = retrieveTemplate("template-place");
    orderDetails["placeName"] = Object.keys(output["places"])[0];
    jQuery.each(output["places"], function(name, id) {
      $(".instance-place").append(bindArgs(template, name));
    });
  }, "json");
  $(document).on('change', "#deliveryPlace", function(){
    orderDetails["placeName"] = $(this).val();
  });
  $("#date").text(date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear());
  $("#cancel").click(function() {
    $.post("php/jsAPI/sessionAPI.php", { req: "del", var: "choosenRest" });
    $("[name*='restaurants']").click();
  });
  $("#save").click(function() {
    var time = $("#time").val();
    if (time.length == 0) {
      showNotification("Inserire orario di consegna", "danger");
      return;
    }
    var requiredDate = getRequiredDate(date, time);
    orderDetails["date"] = parseInt(requiredDate.getTime() / 1000);
    if (dateDifference(date, requiredDate) < maxHorsDifference) {
      showNotification("Ora inserita non corretta", "danger");
      return;
    }
    showNotification("Ordine inviato", "success");
    $.post("php/checkout/checkout.php", { req: "sendOrder", orderDetails : orderDetails });
    $("[name*='restaurants']").click();
  });
});
