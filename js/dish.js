var numIngredients;

$(function() {
  $.getJSON("php/dish/getData.php", function(output) {
    var template = retrieveTemplate("template-dish-categories");
    var html_code = bindArgs(template, "value='0' selected", "Scegli...");
    for(key in output["categories"])
      html_code += bindArgs(template, 'value="' + output["categories"][key] + '"', key);
    $(".instance-dish-categories").html(html_code);

    var html_code = "";
    var template = retrieveTemplate("template-ingredients");
    for(key in output["ingredients"]) {
      var status = "unchecked";
      if (output["dishIngredients"] !== undefined && output["dishIngredients"].indexOf(key) > -1)
        status = "checked";
      html_code += bindArgs(template, output["ingredients"][key], status, output["ingredients"][key], key);
    }
    $(".instance-ingredients").html(html_code);
    if (output["dishIngredients"] !== undefined) {
      $("#plateName").val(output["dishInfo"]["nome"]);
      $("#coin").val(output["dishInfo"]["costo"]);
      $("#plateCategory").val(output["dishInfo"]["idCategoria"]);
    }
  });

  $("#cancel").click(function() {
    $.post("php/dish/unsetCurrentDish.php");
    $("[name*='vendor_menu']").click();
  });

  $("#save").click(function() {
    var input = {
      name: $("#plateName").val().trim(),
      price: $("#coin").val(),
      category: $("#plateCategory").val(),
      ingredients: []
    };
    $(".instance-ingredients [type*='checkbox']").each(function() {
      if ($(this).prop("checked"))
        input.ingredients.push($(this).attr("id").replace("ingredient", ""));
    })
    // DATA CHECK
    var ok = true;
    if (input.name === "") {
      $("#plateName").val("");
      $("#plateName").css("border-color", "red");
      ok = false;
    }
    if (input.price === "" || (10 * input.price) % 1 !== 0) {
      $("#coin").val("");
      $("#coin").css("border-color", "red");
      ok = false;
    }
    if (input.category === "0") {
      $("#plateCategory").css("border-color", "red");
      ok = false;
    }

    // POST
    if (ok) {
      $.post("php/dish/saveDish.php", input, function(output) {
        if(output["error"]["class"] === "NONE")
          $("[name*='vendor_menu']").click();
        else
          alert(output["error"]["description"]);
      }, "json");
    }
  });
});
