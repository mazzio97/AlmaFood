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
var ratingMap = [ ratingInfo(-2.5, "ea9999", "sad-cry"), ratingInfo(-1, "ea9999", "frown"), ratingInfo(1, "dddddd", "meh"),
                  ratingInfo(2.5, "b6d7a8", "smile"), ratingInfo(5.5, "b6d7a8", "grin-hearts") ];
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
  var atLeastOnce = false;
  $(".instance-restaurants .vendor").each(function() {
    var restaurant = restaurants[$(this).attr("id").replace("restaurant", "")];
    var filter = restaurant.name.toLowerCase().includes(filters.getSubstring()) &&
                 restaurant.quality >= sliderMap[filters.getSliderValue()].quality &&
                 restaurant.price >= sliderMap[filters.getSliderValue()].price &&
                 getCategoryMatch(restaurant.categories, filters.getCategories());
    $(this).toggle(filter);
    atLeastOnce = atLeastOnce || filter;
  });
  $(".nothing-found").toggle(!atLeastOnce);
}

$(function() {
  $.getJSON("php/restaurants.php", function(output) {
    restaurants = output["restaurants"].filter(function (value) {
      return value["enabled"] == 1;
    });
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
    $(".instance-restaurants").html(html_code + getNoResultsHtml());
    $(".nothing-found").hide();
  });

  $("#searchFilter").keyup(() => filterRestaurants());
  $("#sliderFilter").change(() => filterRestaurants());
  $(".filter").on("click", "input[type='checkbox']", function() {
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
    var username = restaurants[$(this).attr("id").replace("restaurant", "")].username;
    $.post("php/sessionAPI.php", { req: "set", var: "chosenRest", val: username });
    loadPage("client_menu");
  });
});
