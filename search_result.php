<?php
    session_start();
    if(!isset($_SESSION['fullname']))
    {
        header("Location: login.php?Error=2");
        exit();
    }
    $userID = $_SESSION['userID'];
    $pass = $_SESSION['password'];
    $AccountID = $_SESSION['accountID'];

    $searchResult = '';

    if (isset($_POST['search'])) {
        $searchResult = $_POST['search'];
    }


    require("dbInfo.php");
    $mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>222635N</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/movie_list.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <main>
        <section>
            <?php 
        require_once('nav.php'); ?>
            <div class="nav-slider">
                <nav>
                    <ul>
                        <li><a href="Index.php">Home</a></li>
                        <li><a href="Movies.php">Movies</a></li>
                        <li><a href="Upcoming.php">upcoming</a></li>
                    </ul>
                </nav>
            </div>
        </section>

        <section id="movies">
            <div class="movie-heading">
                <span style="font-size:2.5em;font-weight:500;">Results</span>
            </div>

            <div>

            </div>
            <div class="post-container">
                <?php
                    if(isset($_POST['search']))
                    {
                        $searchResult = $_POST['search'];
                    }
                    ini_set("Errors",0);
                    $statement = "SELECT * FROM shows where Title like '$searchResult%'";
                    $result = $mysqli -> query($statement);
                    while($record = $result -> fetch_assoc())
                    {
                ?>

                <div class="slider-box" id="SB">
                    <div href="#" class="cat-slider-overlay">
                        <div class="cat-info-container">
                            <a href="show.php?id=<?= $record['id'] ?>&type_of_show=<?= $record['type_of_show'] ?>"><img
                                    src="icons/play-button (1).png" alt="" class="cat-playBTN"></a>
                            <div class="overlay-text">
                                <span>
                                    <?= $record['Title'] ?>
                                </span> <br><br>
                                <em>Produced by
                                    <?= $record['titleDesc'] ?>
                                </em>
                            </div>
                            <div class="more-options-dot">
                                <div class="select-menu">
                                    <div class="select-btn">
                                        <img class="sBtn-text" src="icons/dots (1).png">
                                    </div>
    <?php
                                            $showId = $record['id'];

                                            $meow = "SELECT * FROM playlist_show 
                                                    INNER JOIN playlist ON playlist_show.playlist_id = playlist.id 
                                                    INNER JOIN users ON users.id = playlist_show.userID 
                                                    WHERE playlist_show.show_id = ? AND users.id = ?";

                                            $stmt = $mysqli->prepare($meow);
                                            $stmt->bind_param("ii", $showId, $AccountID);
                                            $stmt->execute();
                                            $resultOption = $stmt->get_result();
                                            $existingPlaylists = array();

                                            while ($recordOption = $resultOption->fetch_assoc()) {
                                                $existingPlaylists[] = $recordOption['name'];
                                            }

                                            $allPlaylists = "SELECT * FROM playlist WHERE userid_FK = $AccountID";
                                            $allPlaylistsResult = $mysqli->query($allPlaylists);
                                            $unaddedPlaylists = array();

                                            while ($playlist = $allPlaylistsResult->fetch_assoc()) {
                                                if (!in_array($playlist['name'], $existingPlaylists)) {
                                                    $unaddedPlaylists[] = $playlist;
                                                }
                                            }
                                            ?>
                                                <ul class="options">
                                                    <?php foreach ($unaddedPlaylists as $unaddedPlaylist) {?>
                                                    <li class="option">
                                                        <a
                                                            href="insert_playlist_process.php?vidID=<?= $showId ?>&AccountID=<?= $AccountID ?>&PID=<?= $unaddedPlaylist['id'] ?>&page=SearchPage"><span
                                                                class="option-text">Add to
                                                                <?= $unaddedPlaylist['name'] ?>
                                                            </span></a>
                                                    </li>
                                                    <?php }; ?>
                                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-img">
                        <img src="images_poster/<?= $record['posterIMG'] ?>" alt="poster">
                    </div>
                    <div class="cat-slider-text"></div>
                </div>

                <?php
                }  
                ?>
            </div>
        </section>

        <?php 
    require_once("footer.php");
    ?>
    </main>
    <script src='js/jquery.js'></script>
    <script src="js/main.js"></script>
</body>

</html>