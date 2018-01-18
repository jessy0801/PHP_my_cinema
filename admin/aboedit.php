<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="../Datatables/js/jquery.dataTables.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../Datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="../Bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Modifier Abonnement</h1>
        <a href="aboedit.php">Retour</a>
    </header>
    <?php
    $bd = new PDO('mysql:dbname=base_tp;host=127.0.0.1', 'phpmyadmin', '080176');
        if (!isset($_GET['id_abo'])) {
            echo "<table>
                <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Durée de l'abonnement</th>
                </tr>";
            $result = $bd->query("SELECT * FROM tp_abonnement")->fetchAll();
            echo "<tr><td colspan='4'><a href='aboedit.php?add=true'>Ajouter</a></td></tr>";
            foreach ($result as $val) {
                echo "<tr>
                    <td>" . $val['nom'] . "</td>
                    <td>" . $val['prix'] . "</td>
                    <td>" . $val['resum'] . "</td>
                    <td>" . $val['duree_abo'] . "</td>
                    <td><a href='aboedit.php?id_abo=" . $val['id_abo'] . "'>Modifier</a></td>
                    <td><a href='aboedit.php?id_abo=" . $val['id_abo'] . "&rm=true'>Suprimer</a></td>
                  </tr>";
            }
            echo "</table>";
        }
        elseif ($_GET['id_abo'] > -1 ) {
            echo "<table>
                <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Durée de l'abonnement</th>
                </tr>";
            $result = $bd->query("SELECT * FROM tp_abonnement WHERE id_abo = ".$_GET['id_abo'])->fetchAll();
            foreach ($result as $val) {
                echo "<tr>
                    <td>" . $val['nom'] . "</td>
                    <td>" . $val['prix'] . "</td>
                    <td>" . $val['resum'] . "</td>
                    <td>" . $val['duree_abo'] . "</td>
                  </tr>";
            }
            echo "</table><form onsubmit=\"return confirm('Do you really want to submit the form?');\" method=\"post\" action=\"aboedit.php?edit=true&id_abo=".$_GET['id_abo']."\">
        <label>Nom <input type=\"text\" name=\"nom\"></label>
        <label>Prix <input type=\"text\" name=\"prix\"></label>
        <label>Description <input type=\"text\" name=\"resum\"></label>
        <label>Durée de l'abonnement (en jours)<input type=\"text\" name=\"duree_abo\"></label>
        <input type=\"submit\" id='valid'>
    </form>";
            if($_GET['edit'] != NULL) {
                if ($_POST['nom'] != NULL) {
                    $bd->exec("UPDATE tp_abonnement SET nom = ".$_POST['nom']." WHERE id_abo = ".$_GET['id_abo']);
                }
                if ($_POST['prix'] != NULL) {
                    $bd->exec("UPDATE tp_abonnement SET prix = ".$_POST['prix']." WHERE id_abo = ".$_GET['id_abo']);
                }
                if ($_POST['resum'] != NULL) {
                    $bd->exec("UPDATE tp_abonnement SET resum = ".$_POST['resum']." WHERE id_abo = ".$_GET['id_abo']);
                }
                if ($_POST['duree_abo'] != NULL) {
                    $bd->exec("UPDATE tp_abonnement SET duree_abo = ".$_POST['duree_abo']." WHERE id_abo = ".$_GET['id_abo']);
                }

            }
        }

    ?>
</body>
</html>