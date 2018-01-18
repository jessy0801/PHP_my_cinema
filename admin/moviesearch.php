<!doctype html>
<html lang="fr">
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
<h1>Rechercher Film</h1>

<form action="moviesearch.php" method="post" >
    <label id="wherelab" > Rechercher par :
        <select id="where" name="where" >
            <option value="titre">Titre</option>
            <option value="id_genre">Genre</option>
            <option value="id_distrib">Distributeur</option>
        </select>
    </label>
    <label id="genre" style="display: none" >
        <?php
        $nd = new PDO('mysql:dbname=base_tp;host=127.0.0.1', 'phpmyadmin', '080176');
        $arr1 = $nd->query('SELECT * FROM tp_genre ORDER BY nom');
        echo '<select id="test" name="test">';
        foreach ($arr1->fetchAll() as $val) {
            echo '<option value="' . $val['id_genre'] . '">' . $val['nom'] . '</option>';
        }
        echo '</select>';
        ?>
    </label>
    <label id="dist" style="display: none">
        <select id="test1" name="tes">
            <?php

            $arr1 = $nd->query('SELECT * FROM tp_distrib ORDER BY nom')->fetchAll();
            foreach ($arr1 as $val) {
                echo '<option value=' . $val['id_distrib'] . '>' . $val['nom'] . '</option>';
            }
            ?>

            ?>
        </select>
    </label>
    <label id="query">Rechercher :
        <input type="text" name="query" value="<?php echo $_POST['query']; ?>">
    </label>
    <script>
        $('#where').on('change', function() {
            var genre = $('#genre').style.display = 'none';
            var dist = $('#dist').style.display = 'none';
            var query = $('#query').style.display = 'none';
            if(this.value === 'id_genre') {
                genre = 'inline-block';
            }
            else if(this.value === 'id_dist') {
                dist = 'inline-block';
            }
            else if(this.value === 'titre' ) {
                query = 'inline-block';
            }
        });
    </script>
    <input type="submit" title="submit" value="Chercher">
</form>
<?php
if ($_POST['query'] != NULL) {
    $nd = new PDO('mysql:dbname=base_tp;host=127.0.0.1', 'phpmyadmin', '080176');
    $tb = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="table">
    <tr>
        <th>Titre</th>
        <th>Distribution</th>
        <th>Genre</th>
        <th>Durée en minute</th>
        <th colspan="2">Avis</th>
    </tr>';
    switch ($_POST['where']) {
        case "titre":
            $i= 0;
            $arr = $nd->query('select f.* , g.nom as \'nom_genre\', d.nom as \'nom_distrib\' from tp_film f left join tp_genre g on g.id_genre = f.id_genre  left join tp_distrib d on d.id_distrib = f.id_distrib WHERE f.titre LIKE "%'.$_POST['query'].'%"')->fetchAll();
            foreach ($arr as $ndi) {
                $i++;
                $tb .= '<tr>';
                $tb .= '<td><a href="movie.php?id_film='.$ndi['id_film'].'">'.$ndi['titre'].'</a></td>';
                if ($ndi['nom_distrib'] != NULL) {
                    $tb .= '<td>' . $ndi['nom_distrib'] . '</td>';
                } else {
                    $tb .= '<td>Distributeur Inconnu</td>'; //LIEN WIKI &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                }
                if ($ndi['nom_genre'] != NULL) {
                    $tb .= '<td>' . $ndi['nom_genre'] . '</td>';
                } else {
                    $tb .= '<td>Genre Inconnu</td>'; //LIEN WIKI &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                }

                $tb .= '<td>' . $ndi['duree_min'] . '</td>';
                $tb .= '<td><a href="feedback.php?id_film=' . $ndi['id_film'] . '" >Ajouter un avis</a></td>';
                $tb .= '<td><a href="feedback.php?id_film=' . $ndi['id_film'] . '" >Voir les avis</a></td>';
                $tb .= '</tr>';
            }
            $tb .= '</table>';
            if ($i >= 1) {
                echo $tb;
            } else {
                echo "<span>Aucun Resultat</span>";
            }
            break;
        case "id_genre":
            $i = 0;
            $arr = $nd->query('select f.* , g.nom as \'nom_genre\', d.nom as \'nom_distrib\' from tp_film f left join tp_genre g on g.id_genre = f.id_genre  left join tp_distrib d on d.id_distrib = f.id_distrib WHERE g.nom LIKE "%'.$_POST['query'].'%"')->fetchAll();
            foreach ($arr as $ndi) {
                $i++;
                $tb .= '<td><a href="movie.php?id_film='.$ndi['id_film'].'">'.$ndi['titre'].'</a></td>';
                if ($ndi['nom_distrib'] != NULL) {
                    $tb .= '<td>' . utf8_encode($ndi['nom_distrib']) . '</td>';
                } else {
                    $tb .= '<td>Distributeur Inconnu</td>'; //LIEN WIKI &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                }
                if ($ndi['nom_genre'] != NULL) {
                    $tb .= '<td>' . utf8_encode($ndi['nom_genre']) . '</td>';
                } else {
                    $tb .= '<td>Genre Inconnu</td>'; //LIEN WIKI &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                }
                $tb .= '<td>' . $ndi['resum'] . '</td>';
                $tb .= '<td>' . $ndi['duree_min'] . '</td>';
                $tb .= '<td><a href="feedback.php?id_film=' . $ndi['id_film'] . '" >Ajouter un avis</a></td>';
                $tb .= '<td><a href="feedback.php?id_film=' . $ndi['id_film'] . '" >Voir les avis</a></td>';
                $tb .= '</tr>';
            }
            $tb .= '</table>';
            if ($i >= 1) {
                echo $tb;
            } else {
                echo "<span>Aucun Resultat</span>";
            }
            break;
        case 'id_distrib':
            $i = 0;
            $arr = $nd->query('select f.* , g.nom as \'nom_genre\', d.nom as \'nom_distrib\' from tp_film f left join tp_genre g on g.id_genre = f.id_genre  left join tp_distrib d on d.id_distrib = f.id_distrib WHERE d.nom LIKE "%'.$_POST['query'].'%"')->fetchAll();
            foreach ($arr as $ndi) {
                $i++;
                $tb .= '<td><a href="movie.php?id_film='.$ndi['id_film'].'">'.$ndi['titre'].'</a></td>';
                if ($ndi['nom_distrib'] != NULL) {
                    $tb .= '<td>' . mb_convert_encoding(html_entity_decode($ndi['nom_distrib']), "UTF-8", "auto") . '</td>';
                } else {
                    $tb .= '<td>Distributeur Inconnu</td>'; //LIEN WIKI &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                }
                if ($ndi['nom_genre'] != NULL) {
                    $tb .= '<td>' . utf8_encode($ndi['nom_genre']) . '</td>';
                } else {
                    $tb .= '<td>Genre Inconnu</td>'; //LIEN WIKI &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                }
                $tb .= '<td>' . $ndi['resum'] . '</td>';
                $tb .= '<td>' . $ndi['duree_min'] . '</td>';
                $tb .= '<td><a href="feedback.php?id_film=' . $ndi['id_film'] . '" >Ajouter un avis</a></td>';
                $tb .= '</tr>';
            }
            $tb .= '</table>';
            if ($i >= 1) {
                echo $tb;
            } else {
                echo "<span>Aucun Resultat</span>";
            }
            break;

        default:
            break;
    }
}
?>
<script>
    $(document).ready(function(){
        $('#table').DataTable();
    });
</script>
</body>
</html>