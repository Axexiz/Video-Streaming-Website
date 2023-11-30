<?php
    require("dbInfo.php");
    $mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selectedGenre = $_POST["selected_genre"];
    
    $sql = "SELECT shows.id, shows.type_of_show, shows.Title, shows.titleDesc, shows.posterIMG FROM shows INNER JOIN movie_cat ON shows.id = movie_cat.movieID_FK INNER JOIN categories ON movie_cat.catID_FK = categories.id WHERE categories.id = '$selectedGenre';";

    $result = $mysqli -> query($sql);

    $filteredData = array();
    
    while($record = $result -> fetch_assoc())
    {
        $filteredData[] = $record;
    }

    session_start();
    $_SESSION['category_data'] = $filteredData;

    header('Location: Movies.php');
    exit();

}
?>
