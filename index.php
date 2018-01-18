<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="Datatables/js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="Datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <header class=" container-fluid row">
    <h1 class="col-sm-3" >My Cinema</h1>
        <nav style="margin-top: 37px" class='row col-sm-9'>
            <a class="col-sm-3 col-xs-12" href="moviesearch.php">Rechercher film</a>
            <a class="col-sm-3 col-xs-12" href="next.php">Prochaine seance</a>
            <a class="col-sm-3 col-xs-12" href="login.php">Connection</a>
            <a class="col-sm-3 col-xs-12" href="subcribe.php">Inscription</a>
            <a class="col-sm-3 col-xs-12" href="reduction.php">Réduction</a>
        </nav>
    </header>
    <section style="margin-top: 50px">
    <article>
        <header>Dernier films projeter</header>
        <?php
            $bd = new PDO('mysql:dbname=base_tp;host=127.0.0.1', 'phpmyadmin', '080176');
            $bd->query("select titre, date from tp_film ");
            echo crypt("admin");
        ?>
    </article>
    </section>
</body>
</html>
