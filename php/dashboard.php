<?php
function checkError($condition, $errorClass, $errorSource, $errorDescription) {
  if ($condition) {
    $output["error"] = array(
      "class" => $errorClass,
      "source" => $errorSource,
      "description" => $errorDescription
    );
    print json_encode($output);
    die();
  }
}
// SESSION
session_start();

$output = array();
if(isset($_GET["request"]))
{
    //CONNECTION
    $connection = new mysqli("localhost", "root", "", "almafood");
	checkError($connection->connect_error, "SERVER", "CONNECTION", $connection->connect_error);

	switch ($_GET["request"]) {
		case "orders":
            $stmt = $connection->prepare("SELECT cliente.nome AS nomeCliente,
                                                 cliente.cognome AS cognomeCliente,
                                                 ordine.idOrdine AS ordine,
                                                 ordine.costoTot AS costo,
                                                 ordine.dataora AS oraConsegna,
                                                 aula.nome AS aula
                                      FROM ordine, cliente, aula
                                      WHERE ordine.cli_user = cliente.username
                                      AND  ordine.idAula = aula.idAula
                                      AND ordine.idStato = 1
                                      AND " . $_SESSION["tipo"] . ".username = ?
                                      ORDER BY ordine.dataora ASC");
            $stmt->bind_param("s", $_SESSION["username"]);
			$stmt->execute();
			$result = $stmt->get_result();

            $output["order"] = array();
			while ($row = $result->fetch_assoc()) {
				$output["order"][] = $row;
			}
            checkError(count($output["order"]) == 0, "SERVER", "QUERY", "Nessun ordine da visualizzare");
			break;

		case "dishes_in_order":
            $orderId = 0;
			if (isset($_GET["orderId"])) {
				$orderId = $_GET["orderId"];
			}
            $stmt = $connection->prepare("SELECT pietanza.nome AS nomePietanza
                                          FROM pietanza_in_ordine, pietanza
                                          WHERE pietanza_in_ordine.idPietanza = pietanza.idPietanza
                                          AND idOrdine = ?");
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $result = $stmt->get_result();

            $output["dish"] = array();
            while($row = $result->fetch_assoc()) {
                $output["dish"][] = $row;
            }
            checkError(count($output["dish"]) == 0, "SERVER", "QUERY", "Nessun risultato");
            break;
        case "modify_order":
            $orderId = 0;
            $state = 0;
			if (isset($_GET["orderId"]) && isset($_GET["state"])) {
				$orderId = $_GET["orderId"];
                $state = $_GET["state"];
			}
            $stmt = $connection->prepare("UPDATE ordine SET idStato = ? WHERE idOrdine = ?");
            $stmt->bind_param("ii", $state, $orderId);
            $stmt->execute();
            break;
	}
    $output["error"] = array("class" => "NONE");
    print json_encode($output);
    $stmt->close();
    $connection->close();
}
?>
