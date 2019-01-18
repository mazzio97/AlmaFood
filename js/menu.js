function fillDishInfo(container, piatto) {
  $.post("php/menu/getIngredientsInDish.php", { dish: piatto["idPietanza"] }, function(output) {
    var template = retrieveTemplate("template-dishes");
    var ingredientsList = "";
    for (var i = 0; i < output["ingredient"].length; i++) {
      var ingrediente = output["ingredient"][i];
      ingredientsList += ingrediente["nome"] + ", ";
    }
    container.html(bindArgs(template, piatto["nome"], ingredientsList.slice(0, -2), piatto["idPietanza"], piatto["costo"]));
  }, "json");
}
function getCategoryDishes(container, categoryId) {
  $.post("php/menu/getDishesInCategory.php", { category: categoryId }, function(output) {
    for (var i = 0; i < output["dish"].length; i++) {
      fillDishInfo(container, output["dish"][i]);
    }
  }, "json");
}
$(function() {
    $.post("php/menu/getMenuCategories.php", function(output) {
      var template = retrieveTemplate("template-categories");
      for (var i = 0; i < output["category"].length; i++) {
        var categoria = output["category"][i];
        $(".instance-categories").append(bindArgs(template, categoria["nome"]));
        getCategoryDishes($(".instance-categories .instance-dishes").last(), categoria["idCategoria"]);
      }
    }, "json");
    // TO FIX
    $(".instance-categories").on("click", ".fa-edit", function() {
      console.log($(this).parent().attr("id"));
      $("#pageContainer").load("html/dish.html", function(responseTxt, statusTxt, xhr) {
        if(statusTxt === "error" && page !== "html/exit.html")
          $("#pageContainer").html("<h1>ERROR 404</h1><br/><h4>page " + page + " not found</h4>");
      });
    });
})
