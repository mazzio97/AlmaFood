function getRequiredDate(date, time) {
  return new Date(date.getFullYear(), date.getMonth(), date.getDate(), parseInt(time.slice(0, 2)), parseInt(time.slice(3)), 0);
}
function dateDifference(from, to) {
  var fromDate = parseInt(from.getTime() / 1000);
  var toDate = parseInt(to.getTime() / 1000);
  return (toDate - fromDate) / 3600;
}
function updateButtonState(date, requiredDate, maxHorsDifference) {
  if (dateDifference(date, requiredDate) > maxHorsDifference)
    $("#order").removeClass("disabled");
  else
    $("#order").addClass("disabled");
}
function pressable(button) {
  return button.attr("class").indexOf("disabled") < 0;
}
$(function() {
  var orderDetails = {
    date : 0,
    totalPrice : 0,
    place : "",
    dishes : []
  };
  var date = new Date();
  var maxHorsDifference = 1;
  $.post("php/sessionAPI.php", { req: "get", var: "orderDetails" }, function(output) {
    var template = retrieveTemplate("template-basket");
    orderDetails["dishes"] = output;
    jQuery.each(output, function(dish, info) {
      var partialPrice = parseFloat(info["quantity"]) * parseFloat(info["price"]);
      orderDetails["totalPrice"] += partialPrice;
      $(".instance-basket").append(bindArgs(template, info["quantity"], info["name"], partialPrice.toFixed(2)));
    });
    orderDetails["totalPrice"] = orderDetails["totalPrice"].toFixed(2);
    $(".basket-total-price").text(orderDetails["totalPrice"] + "€");
  }, "json");
  $.post("php/checkout.php", { req: "places" }, function(output) {
    var template = retrieveTemplate("template-place");
    orderDetails["place"] = (Object.values(output["places"])[0]).toString();
    jQuery.each(output["places"], function(name, id) {
      $(".instance-place").append(bindArgs(template, id, name));
    });
  }, "json");
  $(document).on('change', "#deliveryPlace", function() {
    orderDetails["place"] = $(this).find(":selected").attr("id");
  });
  $("#deliveryTime").focusout(function() {
    var requiredDate = getRequiredDate(date, $(this).val());
    orderDetails["date"] = parseInt(requiredDate.getTime() / 1000);
    updateButtonState(date, requiredDate, maxHorsDifference);
  });
  $("#cancel").click(function() {
    $.post("php/sessionAPI.php", { req: "del", var: "chosenRest" });
    loadPage("restaurants");
  });
  $("#order").click(function() {
    if (!pressable($(this)))
      return;
    $.post("php/checkout.php", { req: "sendOrder", orderDetails: orderDetails });
    loadPage("restaurants");
  });
});
