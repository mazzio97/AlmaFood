$(document).ready(function() {
    $("a.btn-success").click(function() {
        showNotification("Richiesta accettata", "success");
        $(this).parent().parent().parent().parent().slideUp("slow");
    });

    $("a.btn-danger").click(function() {
        showNotification("Richiesta declinata", "danger");
        $(this).parent().parent().parent().parent().slideUp("slow");
    });
});

function showNotification(msg, type) {
    if ($(window).width() > 976) {
        $.bootstrapGrowl(msg, {
            ele: "body", // which element to append to
            type: type, // (null, 'info', 'danger', 'success')
            offset: {from: "bottom", amount: 20}, // 'top', or 'bottom'
            align: "left", // ('left', 'right', or 'center')
            width: 240, // (integer, or 'auto')
            delay: 3000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
        });
    }
}
