$(function() {

	$(document).on("click", ".add", function() {
		var emptyInput = $(this).parents("table").find("tr").last().html();
		var input = $(this).parents("tr").find('input[type="text"]');
		input.each(function(){
			$(this).parent("td").html($(this).val());
		});
		$(this).parents("tbody").append("<tr>" + emptyInput + "</tr>");
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function() {
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function() {
		$(this).parents("tr").remove();
  });
});
