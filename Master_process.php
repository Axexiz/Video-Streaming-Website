<?php
    session_start();
    if(!isset($_SESSION['fullname']))
    {
        header("Location: login.php?Error=2");
        exit();
    }
    require("dbInfo.php");
    $mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["Title"];
    $desc = $_POST["Desc"];
    $releaseYear = $_POST["releaseYear"];
    $duration = $_POST["duration"];
    $titleDesc = $_POST["titleDesc"];
    $heroIMG = $_POST["heroIMG"];
    $posterIMG = $_POST["posterIMG"];
    $videoFile = $_POST["videoFile"];
    $categories = $_POST["categories"];
    $rating = $_POST['rating'];

        // Insert data into the movie table
        $sql = "INSERT INTO shows (Title, showsDesc, releaseYear, Duration, titleDesc, heroIMG, posterIMG, videoFile, type_of_show,rating)
                VALUES ('$title', '$desc', '$releaseYear', '$duration', '$titleDesc', '$heroIMG', '$posterIMG.jpg', '$videoFile.mp4', 'movie',$rating)";
        $result = $mysqli->query($sql);

        if ($result) {
            $movieID = $mysqli->insert_id;

            // Insert data into the movie_cat table to link categories with the movie
            foreach ($categories as $categoryID) {
                $sql = "INSERT INTO movie_cat (movieID_FK, 	catID_FK)
                        VALUES ('$movieID', '$categoryID')";
                $mysqli->query($sql);
            }

            // Redirect to a success page or the main page after successful insertion
            header("Location: MasterList.php");
            exit();
        } else {
            // Handle insertion errors here
            echo "Error inserting data: " . $mysqli->error;
        }

    }
    $mysqli->close();
?>
