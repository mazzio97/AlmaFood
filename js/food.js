var categories;
var ingredients;

$(document).ready(function() {
  $.getJSON("php/food.php", function(output) {
    categories = output["categories"];
    ingredients = output["ingredients"];

    var template = retrieveTemplate("template-categories");
    var html_code = bindArgs(template, "selected", "Scegli...");
    for(key in categories)
      html_code += bindArgs(template, 'value="' + categories[key] + '"', key);
    $(".template-categories").html(html_code);

    var html_code = "";
    var template = retrieveTemplate("template-ingredients");
    for(key in ingredients)
      html_code += bindArgs(template, ingredients[key], ingredients[key], key);
    $(".template-ingredients").html(html_code);
  });
});
