
<!doctype html>

<?php
    use App\Src\Methods;

    $m = new Methods();
    $data = $m->globalDataToday();
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="/css/main.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <!-- link to jquery and bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- link to jquery and bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2/dist/chart.min.js"></script>
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    
    <title>Covid19</title>
</head>

<body>

    <?php require_once 'partials/menu.php'; ?>

    <?php require_once 'sections/hero.php'; ?>
    <?php require_once 'sections/charts.php'; ?>
    <?php require_once 'sections/map.php'; ?>
    <?php require_once 'sections/regions.php'; ?>
    <?php require_once 'sections/cities.php'; ?>

    <?php require_once 'partials/footer.php'; ?>
</body>

</html>