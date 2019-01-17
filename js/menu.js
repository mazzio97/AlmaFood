function fillIngredients(dishId) {
  $.post("php/menu/getIngredientsInDish.php", { dish: dishId }, function(output) {
    var template = retrieveTemplate("template-dish-ingredients");
    var ingredientsList = "";
    for (var i = 0; i < output["ingredient"].length; i++) {
      var ingrediente = output["ingredient"][i];
      ingredientsList += ingrediente["nome"] + ", ";
    }
    //ingredientHTML.html(ingredientsList.slice(0, -2));
  }, "json");
}
function fillDishes(categoryHTML, categoryId) {
  $.post("php/menu/getDishesInCategory.php", { category: categoryId }, function(output) {
    var template = retrieveTemplate("template-dishes");
    for (var i = 0; i < output["dish"].length; i++) {
      var piatto = output["dish"][i];

      // console.log(fillIngredients(piatto["idPietanza"]));

      categoryHTML.append(bindArgs(template, piatto["nome"], fillIngredients(piatto["idPietanza"]), piatto["costo"]));
      // fillIngredients(categoryHTML.find(".instance-dish-ingredients").last(), piatto["idPietanza"]);
      // categoryHTML.append(bindArgs(template, piatto["costo"]));
    }
  }, "json");
}
$(function() {
    $.post("php/menu/getMenuCategories.php", function(output) {
      var template = retrieveTemplate("template-categories");
      for (var i = 0; i < output["category"].length; i++) {
        var categoria = output["category"][i];
        $(".instance-categories").append(bindArgs(template, categoria["nome"]));
        fillDishes($(".instance-categories .instance-dishes").last(), categoria["idCategoria"]);
      }
    }, "json");
})
