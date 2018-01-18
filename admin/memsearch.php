<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Rechercher menbre</h1>
<form action="memsearch.php" method="post" >
    <label>Prenom :<input type="text" name="prenom" value="<?php echo $_POST['prenom']; ?>"></label>
    <label>Nom :<input type="text" name="nom" value="<?php echo $_POST['nom']; ?>"></label>
    <label>Nom et Prenom associer : <input type="checkbox" <?php if($_POST['assoc']){echo "checked";} ?> name="assoc"></label>
    <input type="submit" title="submit" value="Chercher">
</form>
<?php
$i= 0;
if ($_POST['nom'] != NULL && $_POST['prenom'] != NULL && !$_POST['assoc']) {
    $nd = new PDO('mysql:dbname=base_tp;host=127.0.0.1', 'phpmyadmin', '080176');
    $tb = '<table>
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Email</th>
        <th>Code Postal</th>
        <th colspan="2">Avis</th>
    </tr>';
    $arr = $nd->query('select * from tp_membre m INNER JOIN tp_fiche_personne p on p.id_perso = m.id_fiche_perso WHERE (p.nom LIKE "%' . $_POST['nom'] . '%" OR p.prenom LIKE "%' . $_POST['prenom'] . '%") OR (p.nom LIKE "' . $_POST['nom'] . '" OR p.prenom LIKE "' . $_POST['prenom'] . '")')->fetchAll();
    foreach ($arr as $ndi) {
        $i++;
        $tb .= '<tr>';
        $tb .= '<td>' . ucfirst(strtolower($ndi['nom'])) . '</td>';
        $tb .= '<td>' . ucfirst(strtolower($ndi['prenom'])) . '</td>';
        $tb .= '<td>' . $ndi['email'] . '</td>';
        $tb .= '<td>' . $ndi['cpostal'] . '</td>';
        $tb .= '<td><a href="feedback.php?id_membre=' . $ndi['id_membre'] . '" >Voir les avis</a></td>';
        $tb .= '<td><a href="feedback.php?id_membre=' . $ndi['id_membre'] . '" >Ajouter avis</a></td>';
        $tb .= '</tr>';
    }
    $tb .= '</table>';
    if ($i >= 1) {
        echo $tb;
    } else {
        echo "<span>Aucun Resultat</span>";
    }
}
elseif ($_POST['nom'] != NULL && $_POST['prenom'] != NULL && $_POST['assoc']) {
    $nd = new PDO('mysql:dbname=base_tp;host=127.0.0.1', 'phpmyadmin', '080176');
    $tb = '<table>
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Email</th>
        <th>Code Postal</th>
        <th colspan="2">Avis</th>
    </tr>';
    $arr = $nd->query('select * from tp_membre m INNER JOIN tp_fiche_personne p on p.id_perso = m.id_fiche_perso WHERE (p.nom LIKE "%' . $_POST['nom'] . '%" AND p.prenom LIKE "%' . $_POST['prenom'] . '%") OR (p.nom LIKE "' . $_POST['nom'] . '" AND p.prenom LIKE "' . $_POST['prenom'] . '")')->fetchAll();
    foreach ($arr as $ndi) {
        $i++;
        $tb .= '<tr>';
        $tb .= '<td>' . ucfirst(strtolower($ndi['nom'])) . '</td>';
        $tb .= '<td>' . ucfirst(strtolower($ndi['prenom'])) . '</td>';
        $tb .= '<td>' . $ndi['email'] . '</td>';
        $tb .= '<td>' . $ndi['cpostal'] . '</td>';
        $tb .= '<td><a href="feedback.php?id_membre=' . $ndi['id_membre'] . '" >Voir les avis</a></td>';
        $tb .= '<td><a href="feedback.php?id_membre=' . $ndi['id_membre'] . '" >Ajouter avis</a></td>';
        $tb .= '</tr>';
    }
    $tb .= '</table>';
    if ($i >= 1) {
        echo $tb;
    } else {
        echo "<span>Aucun Resultat</span>";
    }
}

elseif ($_POST['nom'] != NULL && $_POST['prenom'] == NULL) {
    $nd = new PDO('mysql:dbname=base_tp;host=127.0.0.1', 'phpmyadmin', '080176');
    $tb = '<table>
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Email</th>
        <th>Code Postal</th>
        <th colspan="2">Avis</th>
    </tr>';
    $arr = $nd->query('select * from tp_membre m INNER JOIN tp_fiche_personne p on p.id_perso = m.id_fiche_perso WHERE (p.nom LIKE "%' . $_POST['nom'] . '%") OR (p.nom LIKE "' . $_POST['nom'] . '")')->fetchAll();
    foreach ($arr as $ndi) {
        $i++;
        $tb .= '<tr>';
        $tb .= '<td>' . ucfirst(strtolower($ndi['nom'])) . '</td>';
        $tb .= '<td>' . ucfirst(strtolower($ndi['prenom'])) . '</td>';
        $tb .= '<td>' . $ndi['email'] . '</td>';
        $tb .= '<td>' . $ndi['cpostal'] . '</td>';
        $tb .= '<td><a href="feedback.php?id_membre=' . $ndi['id_membre'] . '" >Voir les avis</a></td>';
        $tb .= '<td><a href="feedback.php?id_membre=' . $ndi['id_membre'] . '" >Ajouter avis</a></td>';
        $tb .= '</tr>';
    }
    $tb .= '</table>';
    if ($i >= 1) {
        echo $tb;
    } else {
        echo "<span>Aucun Resultat</span>";
    }
}
elseif ($_POST['nom'] == NULL && $_POST['prenom'] != NULL) {
    $nd = new PDO('mysql:dbname=base_tp;host=127.0.0.1', 'phpmyadmin', '080176');
    $tb = '<table>
    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Email</th>
        <th>Code Postal</th>
        <th colspan="2">Avis</th>
    </tr>';
    $arr = $nd->query('select * from tp_membre m INNER JOIN tp_fiche_personne p on p.id_perso = m.id_fiche_perso WHERE (p.prenom LIKE "%'.$_POST['prenom'].'%") OR (p.prenom LIKE "'.$_POST['prenom'].'")')->fetchAll();
    foreach ($arr as $ndi) {
        $i++;
        $tb .= '<tr>';
        $tb .= '<td>' . ucfirst(strtolower($ndi['nom'])) . '</td>';
        $tb .= '<td>' . ucfirst(strtolower($ndi['prenom'])) . '</td>';
        $tb .= '<td>' . $ndi['email'] . '</td>';
        $tb .= '<td>' . $ndi['cpostal'] . '</td>';
        $tb .= '<td><a href="feedback.php?id_membre=' . $ndi['id_membre'] . '" >Voir les avis</a></td>';
        $tb .= '<td><a href="feedback.php?id_membre=' . $ndi['id_membre'] . '" >Ajouter avis</a></td>';
        $tb .= '</tr>';
    }
    $tb .= '</table>';
    if ($i >= 1) {
        echo $tb;
    } else {
        echo "<span>Aucun Resultat</span>";
    }
}
?>
</body>
</html>