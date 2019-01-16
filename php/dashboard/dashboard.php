<?php
  require_once "../utils/errors.php";
  require_once "../utils/session.php";

  if(isset($_GET["request"]))
  {
    require_once "../utils/connection.php";
    $output = array();

    switch ($_GET["request"]) {
      case "orders":
        $query = $_SESSION["tipo"] === "cliente" ?
                 "SELECT fornitore.ristorante AS nominativo,
                         ordine.idOrdine AS ordine,
                         ordine.costoTot AS costo,
                         ordine.dataora AS oraConsegna,
                         aula.nome AS aula
                  FROM ordine, fornitore, aula
                  WHERE ordine.forn_user = fornitore.username
                  AND ordine.idAula = aula.idAula
                  AND ordine.idStato = 1
                  AND ordine.cli_user = ?
                  ORDER BY ordine.dataora ASC" :
                 "SELECT CONCAT(cliente.nome, ' ', cliente.cognome) AS nominativo,
                         ordine.idOrdine AS ordine,
                         ordine.costoTot AS costo,
                         ordine.dataora AS oraConsegna,
                         aula.nome AS aula
                  FROM ordine, cliente, aula
                  WHERE ordine.cli_user = cliente.username
                  AND ordine.idAula = aula.idAula
                  AND ordine.idStato = 1
                  AND ordine.forn_user = ?
                  ORDER BY ordine.dataora ASC";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $_SESSION["username"]);
        $stmt->execute();
        $result = $stmt->get_result();

        $output["order"] = array();
        while ($row = $result->fetch_assoc())
          $output["order"][] = $row;

        checkError(count($output["order"]) == 0, "SERVER", "QUERY", "Nessun ordine da visualizzare");
        break;

        case "dishes_in_order":
          $orderId = 0;
          if (isset($_GET["orderId"]))
            $orderId = $_GET["orderId"];

          $stmt = $connection->prepare("SELECT pietanza.nome AS nomePietanza
                                        FROM pietanza_in_ordine, pietanza
                                        WHERE pietanza_in_ordine.idPietanza = pietanza.idPietanza
                                        AND idOrdine = ?");
                  $stmt->bind_param("i", $orderId);
                  $stmt->execute();
                  $result = $stmt->get_result();

          $output["dish"] = array();
          while($row = $result->fetch_assoc())
            $output["dish"][] = $row;

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

    $stmt->close();
    $connection->close();
    closeWithoutErrors($output);
  }
?>
