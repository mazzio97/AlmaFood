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
function getDateFromUTC(utc) {
    var date = new Date();
    date.setTime(utc * 1000);
    return date;
}
function getUTCFromDate(date) {
    return Math.floor(date.getTime() / 1000);
}
function getHoursMin(utc) {
    console.log(getDateFromUTC(utc));
    return getDateFromUTC(utc).getHours() + ":" + getDateFromUTC(utc).getMinutes();
}
$(document).ready(function() {
    $("ul.notifications").on("click","a.text-success" ,function() {
        showNotification("Richiesta accettata", "success");
        $(this).parentsUntil(".notification-panel").slideUp("slow");
    });
    $("ul.notifications").on("click","a.text-danger" ,function() {
        showNotification("Richiesta declinata", "danger");
        $(this).parentsUntil(".notification-panel").slideUp("slow");
    });
    $.getJSON("php/dashboard.php?request=orders", function(output) {
        var html_code = "";
        if(output["error"]["class"] == "SERVER" && output["error"]["source"] == "QUERY") {
            html_code += '<li><p align="center" style="color: red">' + output["error"]["description"] + '</p></li>';
            $("ul.notifications").html(html_code);
            return;
        }
        for (var i = 0; i < output["order"].length; i++) {
                html_code += `<li>
                              <div class="notification-panel">
                                <div class="card">
                                  <div class="card-header">
                                    <div class="row">
                                      <div class="col-6 text-left">` + output["order"][i]["cognomeCliente"] + " " + output["order"][i]["nomeCliente"] +`</div>
                                      <div class="col-6 text-right text-muted">` + output["order"][i]["ordine"] +`</div>
                                    </div>
                                  </div>
                                  <div class="card-body text-left">
                                    <div class="row">
                                      <div class="col-6 text-left text-muted">Orario consegna</div>
                                      <div class="col-6 text-right">` + getHoursMin(output["order"][i]["oraConsegna"]) + `</div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6 text-left text-muted">Stato pagamento</div>
                                      <div class="col-6 text-right">&euro;` + output["order"][i]["costo"] + `</div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6 text-left text-muted">Luogo consegna</div>
                                      <div class="col-6 text-right">` + output["order"][i]["aula"] + `</div>
                                    </div>
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Dettagli ordine</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <ul>`;
                    $.getJSON("php/dashboard.php?request=dishes_in_order&orderId=" +
                        output["order"][i]["ordine"], function(output) {
                        var html_code_inner = "";
                        for(var k = 0; k < output["dish"].length; k++){
                            html_code_inner += `<li>` + output["dish"][k]["nomePietanza"] + `</li>`;
                        }
                        $("div.modal-body>ul").html(html_code_inner);
                    });
                    html_code += `</ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer text-center">
                            <div class="row">
                              <div class="col-4"><a href="#" class="text-info" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-info"></i> Dettagli</a></div>
                              <div class="col-4"><a href="#" class="text-success"><i class="fa fa-check"></i> Accetta</a></div>
                              <div class="col-4"><a href="#" class="text-danger"><i class="fa fa-times"></i> Rifiuta</a></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>`;
            }
        $("ul.notifications").html(html_code);
    });
});
