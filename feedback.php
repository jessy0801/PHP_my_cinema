<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter un avis</title>
</head>
<body>
<?php if ($_GET['id_film'] != NULL) {
    echo "<form action=\"feedback.php\" method=\"post\">
        <label>Avis pour  : ";
    $nd = new PDO('mysql:dbname=base_tp;host=127.0.0.1', 'phpmyadmin', '080176');
    foreach ($nd->query('select titre from tp_film where id_film = "' . $_GET['id_film'] . '"') as $val) {
        echo $val['titre'];
    }
    echo '<select name="avis">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        </label>
        <label>En tant que : <select name="choix">
        <option value="prenom">Prenom</option>
        <option value="nom">Nom</option>
        <option value="other">Prenom ou Nom</option>
        </select>
        <input type="text" name="nom"></label>
        <input type="submit" value="Comfirmer">
    </form>';
} else {
    echo "<h1>Erreur pas de film selectioner</h1>";
}
if ($_POST['avis'] != NULL) {
    $nd->exec("INSERT INTO tp_avis(id_film, id_membre, value_avis) VALUES('".$_GET['id_membre']."')");
    echo "<strong>Comfirmer !</strong>";
}
?>
</body>
</html>