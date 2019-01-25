var newElementRow = `<tr>
                       <td>
                         <input type="text" autocomplete="off" class="form-control form-control-sm" name="name" id="name">
                       </td>
                       <td>
                         <a class="add ?" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
                       </td>
                    </tr>`;
function fillTable(type, data) {
  var template = retrieveTemplate("template-table-" + type);
  jQuery.each(data, function(name, id) {
    $(".instance-table-" + type).append(bindArgs(template, type + id, name));
  });
  $(".instance-table-" + type).append(bindArgs(newElementRow, type));
}
function updateRow(lastValue, currValue) {
  if (lastValue["name"] == currValue || currValue == "")
    return;
  $.post("php/admin.php", { request: lastValue["type"] + "Update", id: lastValue["id"], value: currValue });
}
function deleteRow(lastValue) {
  $.post("php/admin.php", { request: lastValue["type"] + "Update", id: lastValue["id"] });
}
function updateState(restId, state) {
  $.post("php/admin.php", { request: "stateUpdate", id: restId, state: state });
}
$(function() {
  $.post("php/admin.php", { request: "getData" }, function(output) {
    fillTable("ingredients", output["ingredients"]);
    fillTable("categories", output["categories"]);
    fillTable("places", output["places"]);
    jQuery.each(output["vendors"], function(user, info) {
      $(".instance-table-restaurants").append(bindArgs(retrieveTemplate("template-table-restaurants"),
                                                       info["name"],
                                                       user,
                                                       user,
                                                       info["enabled"] ? "checked" : "",
                                                       user));
    });
  }, "json");
	$(document).on("click", ".add", function() {
		var input = $(this).parents("tr").find('input[type="text"]');
    var type = $(this).attr("class").slice(4);
    if (input.val().trim() == "")
      return;
    $.post("php/admin.php", { request: type + "Insertion", name: input.val().trim() }, function(output) {
      var template = retrieveTemplate("template-table-" + type);
      input.parents("tbody").append(bindArgs(template, type + output["id"], input.val().trim()));
      input.parents("tbody").append(bindArgs(newElementRow, type));
      input.parents("tr").remove();
    }, "json");
  });
  var lastValue = {};
	$(document).on("click", ".edit", function() {
    lastValue["name"] = $(this).parents("tr").find("td:not(:last-child)").text();
    lastValue["type"] = $(this).parents("tbody").attr("class").replace("instance-table-", "");
    lastValue["id"] = $(this).parent().prev().attr("id").replace(lastValue["type"], "");
    $(this).parents("tr").find("td:not(:last-child)").each(function() {
	    $(this).html('<input id="editRow" type="text" class="form-control form-control-sm" value="' + $(this).text() + '">');
    });
    $('#editRow').focus();
  });
  $(document).on("focusout", "#editRow", function() {
    var currValue = $(this).val().trim();
    updateRow(lastValue, currValue);
    if (currValue != "")
      $(this).parents("td").html(currValue);
    else
      $(this).parents("td").html(lastValue["name"]);
  });
	$(document).on("click", ".delete", function() {
    lastValue["type"] = $(this).parents("tbody").attr("class").replace("instance-table-", "");
    lastValue["id"] = $(this).parent().prev().attr("id").replace(lastValue["type"], "");
    deleteRow(lastValue);
    $(this).parents("tr").remove();
  });
  $(document).on("click", ".custom-switch .custom-control-input", function() {
    updateState($(this).attr("id"), $(this).prop("checked") ? 1 : 0);
  });
});
