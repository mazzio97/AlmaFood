$(function() {
  $.post("php/jsAPI/sessionAPI.php", { req: "get", var: "orderDetails" }, function(output) {
    var template = retrieveTemplate("template-basket");
    var totalPrice = 0;
    jQuery.each(output, function(dish, info) {
        var partialPrice = parseFloat(info["quantity"]) * parseFloat(info["price"]);
        totalPrice += partialPrice;
        $(".instance-basket").append(bindArgs(template, dish, info["quantity"], partialPrice));
    });
    $(".basket-total-price").text(totalPrice + "€");
  }, "json");
});
