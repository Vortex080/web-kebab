<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amigo KEBAB</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="../../assets/js/script.js"></script>
</head>

<body>
    <?php
    $dr = $_SERVER['DOCUMENT_ROOT'];
    require_once $dr . '/views/partials/header.php';
    ?>

    <section>
        <div id="cuerpo">
            <?php
            $dr = $_SERVER['DOCUMENT_ROOT'];
            require_once $dr . '/routes/route.php';
            ?>
        </div>
    </section>

    <?php
    $dr = $_SERVER['DOCUMENT_ROOT'];
    require_once $dr . '/views/partials/footer.php';
    ?>
</body>

</html>