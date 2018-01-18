<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="Datatables/js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="Datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <?php
    if ($_GET['id_film'] != NULL) {
        $p="";
        $bd = new PDO('mysql:dbname=base_tp;host=127.0.0.1', 'phpmyadmin', '080176');
        $result = $bd->query("SELECT * FROM tp_film WHERE id_film = ".$_GET['id_film'])->fetchAll();
        foreach ($result as $val) {
            $p .= "<h1>".$val['titre']."</h1>";
            $p .= "<span>".$val['duree_min']." minute</span>";
            $p .= "<p>".$val['resum']."</p>";
            echo "<title> ".$val['titre']." - detail </title>";
        }
    }
    else {
        $p = 'Erreur pas de film selectioner';
        echo "<title> Erreur film non definit </title>";
    }
    ?>
</head>
<body>
<div>
    <?php echo $p; ?>
</div>
</body>
</html>
