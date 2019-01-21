function ratingInfo(upperBound, color, icon) {
  return { upperBound: upperBound, color: color, icon: icon };
}
function sliderInfo(quality, price) {
  return { quality: quality, price: price };
}

var restaurants = [];
var filters = {
  getSubstring: () => $("#searchFilter").val().toLowerCase(),
  getSliderValue: () => $("#sliderFilter").val(),
  getCategories: () => {
    ret = [];
    $(".instance-filter-categories input[type='checkbox']").each(function() {
      if ($(this).prop("checked"))
        ret.push($(this).attr("id").replace("Category", ""));
    });
    return ret;
  }
}
var ratingMap = [ ratingInfo(-2.5, "e06666", "sad-cry"), ratingInfo(-1, "ea9999", "frown"), ratingInfo(1, "dddddd", "meh"),
                  ratingInfo(2.5, "b6d7a8", "smile"), ratingInfo(5.5, "93c47d", "grin-hearts") ];
var sliderMap = [ sliderInfo(1.5, -2), sliderInfo(0, -2), sliderInfo(-3, -2), sliderInfo(-3, 0), sliderInfo(-3, 1) ];

function getRatingInfo(rating) {
  for (var i = 0; i < ratingMap.length; i++)
    if (rating < ratingMap[i].upperBound)
      return ratingMap[i];
}
function getCategoryMatch(rest, filt) {
  if (filt.length == 0)
    return true;

  for (var i = 0; i < rest.length; i++)
    if (filt.includes(rest[i]))
      return true;
  return false;
}
function filterRestaurants() {
  $(".instance-restaurants .restaurant").each(function() {
    var restaurant = restaurants[$(this).attr("id").replace("Restaurant", "")];
    $(this).toggle(restaurant.name.toLowerCase().includes(filters.getSubstring()) &&
                   restaurant.quality >= sliderMap[filters.getSliderValue()].quality &&
                   restaurant.price >= sliderMap[filters.getSliderValue()].price &&
                   getCategoryMatch(restaurant.categories, filters.getCategories()));
  });
}

$(function() {
  $.getJSON("php/restaurants/getData.php", function(output) {
    restaurants = output["restaurants"];

    var html_code = "";
    var template = retrieveTemplate("template-filter-categories");
    output["categories"].forEach(function(category) {
      html_code += bindArgs(template, category, category, category);
    });
    $(".instance-filter-categories").html(html_code);

    var html_code = "";
    for(key in restaurants) {
      var restaurant = restaurants[key];
      var restaurantTemplate = retrieveTemplate("template-restaurants");
      var categoryTemplate = retrieveTemplate("template-restaurant-categories");
      categories_code = "";
      info = getRatingInfo(restaurant.quality + restaurant.price);
      restaurant.categories.forEach(function(category) {
        categories_code += bindArgs(categoryTemplate, category);
      });
      html_code += bindArgs(restaurantTemplate, key, info.color, restaurant.name, categories_code, info.icon);
    }
    $(".instance-restaurants").html(html_code == "" ? "Nessun Ristorante" : html_code);
  });

  $("#searchFilter").keyup(() => filterRestaurants());
  $("#sliderFilter").change(() => filterRestaurants());
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
    filterRestaurants();
  });

  $(".instance-restaurants").on("click", ".vendor", function() {
    $.post("php/jsAPI/sessionAPI.php", { req : "set", var : "choosenRest", val : $(this).find(".restaurant-name").text() });
    var page = "html/client_menu.html";
    $("#pageContainer").load(page, function(responseTxt, statusTxt, xhr) {
      if(statusTxt === "error" && page !== "html/exit.html")
        $("#pageContainer").html("<h1>ERROR 404</h1><br/><h4>page " + page + " not found</h4>");
    });
  });
});