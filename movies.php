<?php

include_once 'db.php';

class Movie extends DB
{
    private $actualPage;
    private $totalPages;
    private $nResults;
    private $resultsPerPage;
    private $index;

    private $error = false;


    function __construct($nPerPage)
    {
        parent::__construct();

        $this->resultsPerPage = $nPerPage;
        $this->index = 0;
        $this->actualPage = 1;

        $this->calcPages();
    }

    function calcPages()
    {        
        $query = $this->connect()->query('SELECT COUNT(*) AS total FROM movie');
        $this->nResults = $query->fetch(PDO::FETCH_OBJ)->total;
        $this->totalPages = $this->nResults / $this->resultsPerPage;

        if (isset($_GET['pagina'])) {
            if (is_numeric($_GET['pagina'])) {
                if ($_GET['pagina'] >= 1 && $_GET['pagina'] < $this->totalPages+1) {
                    $this->actualPage = $_GET['pagina'];
                    $this->index = ($this->actualPage - 1) * $this->resultsPerPage;
                } else {
                    echo "The page doesn't exist";
                    $this->error = true;
                }
            } else {
                echo "Error displaying the page";
                $this->error = true;
            }
        }
    }

    function showMovies()
    {
        if (!$this->error) {
            $query = $this->connect()->prepare('SELECT * FROM movie LIMIT :pos, :n');
            $query->bindValue(':pos', (int) $this->index, PDO::PARAM_INT);
            $query->bindValue(':n', (int) $this->resultsPerPage, PDO::PARAM_INT);
            $query->execute();

            foreach ($query as $movie) {
                include 'view-movie.php';
            }
        } else {
            echo "error";
        }
    }

    function showPages()
    {
        $actual = '';
        
        echo '<ul>';
        for ($i = 0; $i < $this->totalPages; $i++) {
            if (($i + 1) == $this->actualPage) {
                $actual = ' class="actual" ';
            } else {
                $actual = '';
            }
            echo '<li><a '. $actual . 'href="?pagina='. ($i + 1) .'">' . ($i + 1) . '</a></li>';
        }
        echo '</ul>';
    }
}
