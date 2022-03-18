<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagination</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <?php
    include_once 'movies.php';

    $movies = new Movie(2);

    ?>
    <div id="container">
        <div id="paginas">
            <?php
                $movies->showPages();
            ?>
        </div>

        <div id="peliculas">
            <?php
                $movies->showMovies();
            ?>
        </div>
    </div>

</body>

</html>