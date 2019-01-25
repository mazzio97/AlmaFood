function fillDishInfo(container, piatto) {
  $.post("php/menu.php", { request: "ingredients", dish: piatto["idPietanza"] }, function(output) {
    var template = retrieveTemplate("template-dishes");
    var ingredientsList = "";
    if (output["ingredient"] == undefined) {
      ingredientsList = "  ";
    } else {
      for (var i = 0; i < output["ingredient"].length; i++) {
        var ingrediente = output["ingredient"][i];
        ingredientsList += ingrediente["nome"] + ", ";
      }
    }
    container.append(bindArgs(template, piatto["nome"], ingredientsList.slice(0, -2), piatto["idPietanza"], piatto["costo"]));
  }, "json");
}
function getCategoryDishes(container, categoryId) {
  $.post("php/menu.php", { request: "dishes", category: categoryId }, function(output) {
    for (var i = 0; i < output["dish"].length; i++)
      fillDishInfo(container, output["dish"][i]);
  }, "json");
}
function getNextVal(button) {
  var val = button.attr("class").indexOf("plus") > -1 ? 1 : -1;
  return parseInt(button.siblings("span").text()) + val;
}
function pressable(button) {
  return button.attr("class").indexOf("disabled") < 0;
}
function updateButtonsState(button, orderDetails) {
  $("#checkout").prop('disabled', $.isEmptyObject(orderDetails));

  if (button.attr("class").indexOf("plus") > -1 && getNextVal(button) == 1)
    button.siblings(".fa-minus-square").removeClass("disabled");

  if (button.attr("class").indexOf("minus") > -1 && getNextVal(button) == 0)
    button.addClass("disabled");
}
function updateOrderDetails(orderDetails , dishId, dishName, quantity, price) {
  orderDetails[dishId] = { name: dishName, quantity: quantity, price: price.slice(1) };
  if (quantity == 0)
    delete orderDetails[dishId];
  return orderDetails;
}
$(function() {
  var orderDetails = {};
  $.post("php/menu.php", { request: "categories" }, function(output) {
    var template = retrieveTemplate("template-categories");
    if (output["error"]["class"] != "NONE") {
      $("#pageContainer").html(getNoResultsHtml());
      return;
    }
    for (var i = 0; i < output["category"].length; i++) {
      var categoria = output["category"][i];
      $(".instance-categories").append(bindArgs(template, "data-target='#collapseCategory" + categoria["idCategoria"] + "'", categoria["nome"],
                                                categoria["idCategoria"]));
      getCategoryDishes($(".instance-categories .instance-dishes").last(), categoria["idCategoria"]);
    }
  }, "json");
  $(".instance-categories").on("click", ".collapse .fas", function() {
    if (!pressable($(this)))
      return;
    var plate = $(this).parents(".menu-plate");
    orderDetails = updateOrderDetails(orderDetails, plate.find(".select-quantity").attr("id"),
                                      plate.find(".dish-name").text(),
                                      getNextVal($(this)), plate.find(".dish-price").text());
    updateButtonsState($(this), orderDetails);
    $(this).siblings("span").text(getNextVal($(this)));
  });
  $("#checkout").click(function() {
    if (!pressable($(this)))
      return;
    $.post("php/sessionAPI.php", { req: "set", var: "orderDetails" , val: orderDetails });
    loadPage("checkout");
  });
  $("#cancel").click(function() {
    $.post("php/sessionAPI.php", { req: "del", var: "chosenRest" });
    loadPage("restaurants");
  });
});
