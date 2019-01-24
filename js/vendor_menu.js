function fillDishInfo(container, piatto) {
  $.post("php/menu.php", { request: "ingredients", dish: piatto["idPietanza"] }, function(output) {
    var template = retrieveTemplate("template-dishes");
    var ingredientsList = "";
    for (var i = 0; i < output["ingredient"].length; i++) {
      var ingrediente = output["ingredient"][i];
      ingredientsList += ingrediente["nome"] + ", ";
    }
    container.append(bindArgs(template, piatto["nome"], ingredientsList.slice(0, -2), piatto["idPietanza"], piatto["costo"]));
  }, "json");
}
function getCategoryDishes(container, categoryId) {
  $.post("php/menu.php", { request: "dishes", category: categoryId }, function(output) {
    for (var i = 0; i < output["dish"].length; i++) {
      fillDishInfo(container, output["dish"][i]);
    }
  }, "json");
}
$(function() {
    $.post("php/menu.php", { request: "categories" }, function(output) {
      var template = retrieveTemplate("template-categories");
      for (var i = 0; i < output["category"].length; i++) {
        var categoria = output["category"][i];
        $(".instance-categories").append(bindArgs(template, categoria["nome"]));
        getCategoryDishes($(".instance-categories .instance-dishes").last(), categoria["idCategoria"]);
      }
    }, "json");
    $(".instance-categories").on("click", ".fa-edit", function() {
      var dishId = $(this).parent().attr("id");
      $.post("php/sessionAPI.php", { req : "set", var : "currentDish", val : dishId });
      loadPage("dish");
    });
    $(".instance-categories").on("click", ".fa-trash", function() {
      var dishId = $(this).parent().attr("id");
      $.post("php/menu.php", { request: "delete", dish : dishId});
      loadPage("vendor_menu");
    });
    $(".fa-plus").parent().click(function() {
      $.post("php/sessionAPI.php", { req: "del", var: "currentDish" });
      loadPage("dish");
    });
})
