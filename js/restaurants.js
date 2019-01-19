function pair(first, second) {
  return { "first": first, "second": second };
}
var restaurants = [];
var filters = {
  getSubstring: () => $("#searchFilter").val().toLowerCase(),
  getSliderValue: () => $("#sliderFilter").val(),
  getCategories: () => {
    ret = [];
    $(".instance-filter-category input[type='checkbox']").each(function() {
      if ($(this).prop("checked"))
        ret.push($(this).attr("id").replace("Category", ""));
    });
    return ret;
  }
}
var ratingMap = {
  "-2.5": pair("e06666", "sad-cry"),
  "-1": pair("ea9999", "frown"),
  "1": pair("dddddd", "meh"),
  "2.5": pair("b6d7a8", "smile"),
  "5.5": pair("93c47d", "grin-hearts")
};
var sliderMap = [pair(1.5, -2), pair(0, -2), pair(-3, -2), pair(-3, 0), pair(-3, 1)];
function getRatingInfo(rating) {
  for (upperBound in ratingMap)
    if (rating < upperBound)
      return ratingMap[upperBound];
}
function getCategoryMatch(rest, filt) {
  if (filt.length == 0)
    return true;

  for (var i = 0; i < rest.length; i++)
    if (filt.includes(rest[i]))
      return true;
  return false;
}
function printRestaurants() {
  var html_code = "";
  restaurants.forEach(function(restaurant) {
    var restaurantTemplate = retrieveTemplate("template-restaurant");
    var categoryTemplate = retrieveTemplate("template-restaurant-category");
    // FILTER CHECK
    var filter = restaurant.name.toLowerCase().includes(filters.getSubstring());
    filter = filter && restaurant.quality >= sliderMap[filters.getSliderValue()].first;
    filter = filter && restaurant.price >= sliderMap[filters.getSliderValue()].second;
    filter = filter && getCategoryMatch(restaurant.categories, filters.getCategories());
    // DATA BINDING
    if (filter) {
      categories_code = "";
      ratingInfo = getRatingInfo(restaurant.quality + restaurant.price);
      restaurant.categories.forEach(function(category) {
        categories_code += bindArgs(categoryTemplate, category);
      });
      html_code += bindArgs(restaurantTemplate, ratingInfo.first, restaurant.name, categories_code, ratingInfo.second);
    }
  });
  $(".instance-restaurant").html(html_code == "" ? "Nessun Ristorante" : html_code);
}

$(function() {
  $.getJSON("php/restaurants/getData.php", function(output) {
    for(key in output["restaurants"])
      restaurants.push(output["restaurants"][key]);
    restaurants.sort(function(a, b) {
      return (a.quality + a.price) < (b.quality + b.price);
    });

    var html_code = "";
    var template = retrieveTemplate("template-filter-category");
    output["categories"].forEach(function(category) {
      html_code += bindArgs(template, category, category, category);
    });
    $(".instance-filter-category").html(html_code);

    printRestaurants();
  });

  $("#searchFilter").keyup(() => printRestaurants());
  $("#sliderFilter").change(() => printRestaurants());
  $(".category-filter").on("click", "input[type='checkbox']", function() {
    var category = $(this).attr("id").replace("Category", "");
    var allChecked;
    if (category == "all") {
      allChecked = true;
      $("input[type='checkbox']").prop("checked", false);
    } else {
      allChecked = filters.getCategories().length == 0;
    }
    $("#allCategory").prop("checked", allChecked);
    $("#allCategory").prop("disabled", allChecked);
    printRestaurants();
  });

  $(".instance-restaurant").on("click", ".vendor", function() {
    var page = "html/client_menu.html";
    $("#pageContainer").load(page, function(responseTxt, statusTxt, xhr) {
      if(statusTxt === "error" && page !== "html/exit.html")
        $("#pageContainer").html("<h1>ERROR 404</h1><br/><h4>page " + page + " not found</h4>");
    });
  });
});
