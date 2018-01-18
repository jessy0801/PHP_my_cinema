<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$bd = new PDO('mysql:dbname=base_tp;host=127.0.0.1', 'phpmyadmin', '080176');
if ($_GET['id_membre'] != NULL && !isset($_GET['id_film'])) {
    $membre = $bd->query('select * from tp_membre m INNER JOIN tp_fiche_personne p on p.id_perso = m.id_fiche_perso WHERE id_membre = "' . $_GET['id_membre'] . '"')->fetch();
    echo '<h2>Ajouter un avis pour '.$membre['nom'].' '.$membre['prenom'].'</h2>';
    echo "<form method='post' action='http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'><label>Chercher un film<input type='text' name='titre'></label><input type='submit' name='submit'></form>";
    if ($_POST['titre']) {
        $result = $bd->query('select * from tp_film WHERE titre LIKE "%' . $_GET['titre'] . '%"');
        echo "<ul>";
        foreach ($result as $val) {
            echo "<li>" . $val['titre'] . " <a href='http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]&id_film=" . $val['id_film'] . "'>choisir</a></li>";
        }
        echo "</ul>";
    }

}
else if ($_GET['id_film'] != NULL && !isset($_GET['id_membre'])) {
    echo "<form action=\"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]\" method=\"post\">
        <label>Avis pour  : ";
    foreach ($bd->query('select titre from tp_film  WHERE id_film = "'.$_GET['id_film'].'"') as $val) {
        echo $val['titre'];
    }
    echo '</label>
        <label>En tant que : <select name="choix">
        <option value="prenom">Prenom</option>
        <option value="nom">Nom</option>
        <option value="other">Prenom ou Nom</option>
        </select>
        <input type="text" name="nom"></label>
        <input type="submit" value="Chercher">
    </form>';
    if ($_POST['nom'] != NULL ) {
        $result = $bd->query('select * from tp_membre m inner JOIN tp_fiche_personne p on p.id_perso = m.id_fiche_perso WHERE '.$_POST['choix'].' LIKE "%'.$_POST['nom'].'%"')->fetchAll();
        echo "<ul><form action=\"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]\" method=\"post\">";
        foreach ($result as $key) {
            echo "<li>Nom : ".$key['nom']." Prenom : ".$key['prenom']."<a href='http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]&id_membre=".$key['id_membre']."'>choisir</a></li>";
        }
        echo "</form></ul>";
    }
}
else if ($_GET['id_film'] != NULL && $_GET['id_membre'] != NULL) {
    echo "<form action=\"feedback.php?id_membre=".$_GET['id_membre']."&id_film=".$_GET['id_film']."\" method=\"post\">
        <label>Avis pour  : ";
    
    $membre = $bd->query('select * from tp_membre m INNER JOIN tp_fiche_personne p on p.id_perso = m.id_fiche_perso WHERE id_membre = "' . $_GET['id_membre'] . '"')->fetch();
    $film =$bd->query('select titre from tp_film  WHERE id_film = "' . $_GET['id_film'] . '"')->fetch();
    echo $film['titre'];
    echo '<select name="avis">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        </label>
        <label>En tant que : '.$membre['nom'].' '.$membre['prenom'].'
        <input type="submit" value="Comfirmer">
    </form>';
    if ($_POST['avis'] != NULL) {
        $bd->exec("INSERT INTO tp_avis (id_membre, value_avis, id_film) VALUES (".$_GET['id_membre'].", ".$_POST['avis'].", ".$_GET['id_film'].")");
        header('Location: ok_feedback.php');
    }
}
?>
</body>
</html>
