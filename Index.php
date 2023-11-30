<?php
    session_start();
    if(!isset($_SESSION['fullname']))
    {
        header("Location: login.php?Error=2");
        exit();
    }
    $userID = $_SESSION['userID'];
    $pass = $_SESSION['password'];
    require("dbInfo.php");
    $mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);

    $AccountID = $_SESSION['accountID'];

    if(isset($_GET['Sucess']) and $_GET['Sucess'] = '100')
    {
        echo "<script>aleart('Playlist has been added.')</script>";
    }

    $sqlStatement = "SELECT * FROM `shows` WHERE rating >=7 ORDER BY rating desc LIMIT 4;";
    $result = $mysqli -> query($sqlStatement);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>222635N</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body>
    <main>
        <!-- <div class="container"> -->
        <div class="navigation">
            <?php require_once('nav.php'); ?>
        </div>
        <div class="nav-slider">
            <nav>
                <ul>
                    <li><a href="Index.php">Home</a></li>
                    <li><a href="Movies.php">Movies</a></li>
                    <!-- <li><a href="Upcoming.php">upcoming</a></li> -->
                </ul>
            </nav>
        </div>

        <div class="slider-container">
            <div class="slider">
                <div class="swiper HeroSwiper">
                    <div class="swiper-wrapper">
                        <?php
                            while($record = $result -> fetch_assoc())
                            {
                            ?>
                        <div class="swiper-slide">
                            <div class="HeroSwipper-container">
                                <div class="slider-image">
                                    <img src="images/<?= $record['heroIMG'] ?>" alt="" class="banner-img">
                                </div>
                                <div class="slider-text">
                                    <div class="title desc-container">
                                        <span class="heroTitle">
                                            <?= $record['Title'] ?>
                                        </span>
                                    </div>
                                    <div class="desc title">Produced by
                                        <?= $record['titleDesc'] ?>
                                    </div>
                                    <div>
                                                                            <button class="watch-now-btn"
                                        onclick="location.href='show.php?id=<?= $record['id'] ?>&type_of_show=<?= $record['type_of_show'] ?>'">Watch
                                        now</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php
                            }
                            ?>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>


        <!-- -------------------------------------------------------------------------------- -->

        <section class="Category_Section">
            <div class="category-text">
                <span class="cat-title">Popular</span>
            </div>
            <div class="cat-slider">
                <div class="swiper CategorySwiper">
                    <div class="swiper-wrapper">
                        <!-- 1----------------------------- -->
                        <?php
                                $sqlStatement = "SELECT * FROM shows  order by rating desc limit 8";
                                $result = $mysqli -> query($sqlStatement);
                                while($record = $result -> fetch_assoc())
                                {
                            ?>
                        <div class="swiper-slide cat-slides">
                            <div class="slider-box">
                                <div href="#" class="cat-slider-overlay">
                                    <div class="cat-info-container">
                                        <a
                                            href="show.php?id=<?= $record['id'] ?>&type_of_show=<?= $record['type_of_show'] ?>"><img
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
                                                            href="insert_playlist_process.php?vidID=<?= $showId ?>&AccountID=<?= $AccountID ?>&PID=<?= $unaddedPlaylist['id'] ?>&page=index"><span
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
                        </div>
                        <?php
                                }
                            ?>

                    </div>
                </div>

            </div>

        </section>


        <!-- ------------------------------------------------------------------------------------------------- -->

        <section class="Continue_Watching_Container" id="21">
            <div class="category-text">
                <span class="cat-title">Continue watching</span>
            </div>
            <div class="swiper CW-Swiper">
                <div class="swiper-wrapper">
                    <?php 
                        $sqlStatement = "SELECT * FROM user_watch_history inner join shows on user_watch_history.video_id = shows.id WHERE user_watch_history.user_id = $AccountID  ORDER BY user_watch_history.updated_timestamp DESC";
                        $result = $mysqli ->query($sqlStatement);
                        $count = $result -> num_rows;

                        if($count <=0 )
                        {
                            echo "<div class='CW-statusNULL'>You have not watched anything yet.</div>";
                        }
                        else
                        {
                        
                        while($record = $result -> fetch_assoc()){
                        $percentage = ($record['last_watched_time'] / $record['total_time']) * 100;
                        $roundedPercentage = round($percentage, 1);
                        ?>
                    <div class="swiper-slide">
                        <div class="CW-Swipper-container">
                            <div class="CW-slider-overlay">
                                <div class="CW-container">
                                    <a
                                        href="show.php?id=<?= $record['id'] ?>&type_of_show=<?= $record['type_of_show'] ?>"><img
                                            src="icons/play-button (1).png" alt="" class="CW-playBTN"></a>
                                    <a href="remove_continueWatch.php?id=<?= $record['id'] ?>"><img src="icons/x.png"
                                            alt="" class="CW-removeBTN"></a>
                                </div>
                            </div>
                            <div class="CW-slider-box">
                                <div class="CW-slider-img">
                                    <img src="images/<?= $record['heroIMG'] ?>" alt="">//
                                    <div class="CV-img-overlay"></div>
                                </div>
                                <div class="CW-text">
                                    <span>
                                        <?= $record['Title'] ?>
                                    </span> <br><br>
                                    <em>Produced by
                                        <?= $record['titleDesc'] ?>
                                    </em>
                                </div>
                                <div class="progressBar" style="width:<?= $roundedPercentage?>%;"></div>
                                <div class="NO_progressBar"></div>
                            </div>
                            <!-- <div class="cat-slider-text"></div> -->

                        </div>
                    </div>
                    <?php } }?>
                </div>
            </div>
        </section>


        <!-- ------------------------------------------------------------------------------------------------------ -->
        <?php
            $S_statement = "SELECT * FROM playlist where userid_FK = $AccountID";
            $S_Result = $mysqli -> query($S_statement);
            while($S_Record = $S_Result -> fetch_assoc())
            {
       ?>
        <section class="Category_Section">
            <div class="category-text">
                <span class="cat-title">
                    <?= $S_Record['name'] ?>
                </span>
                <a href="remove_playlist.php?userid=<?= $AccountID ?>&PID=<?= $S_Record['id'] ?>" style="color:white;font-size:1.2em;font-weight:400;">
                    remove playlist
                </a>
            </div>
            <div class="cat-slider">
                <div class="swiper CategorySwiper">
                    <div class="swiper-wrapper">
                        <!-- 1----------------------------- -->
                        <?php
                                $sqlStatement = "SELECT shows.id,shows.type_of_show,shows.Title,shows.titleDesc,shows.posterIMG FROM playlist_show INNER JOIN playlist on playlist_show.playlist_id = playlist.id INNER JOIN users ON users.id = playlist_show.userID INNER JOIN shows ON shows.id = playlist_show.show_id WHERE users.id = $AccountID and playlist.id =" . $S_Record['id'] ." ;";
                                $result = $mysqli -> query($sqlStatement);
                                $count = $result -> num_rows;
                                if($count<=0)
                                {
                                    echo "<div class='CW-statusNULL'>You have not added anything yet.</div>";
                                }
                                while($record = $result -> fetch_assoc())
                                {
                            ?>
                        <div class="swiper-slide cat-slides">
                            <div class="slider-box">
                                <div class="cat-slider-overlay">
                                    <div class="cat-info-container">
                                        <a
                                            href="show.php?id=<?= $record['id'] ?>&type_of_show=<?= $record['type_of_show'] ?>"><img
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
                                                <div class="select-btn" style="width: 1.5em;">
                                                    <a
                                                        href="remove_playlist_items.php?userid=<?= $AccountID ?>&showid=<?= $record['id'] ?>&playlistid=<?= $S_Record['id'] ?>">
                                                        <img class="sBtn-text" src="icons/x.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider-img">
                                    <img src="images_poster/<?= $record['posterIMG'] ?>" alt="poster">
                                </div>
                                <div class="cat-slider-text"></div>
                            </div>
                        </div>
                        <?php
                                }
                        ?>

                    </div>
                </div>

            </div>

        </section>

        <?php
            }
            require_once("footer.php");
        ?>

    </main>


    <!-- Initialize Swiper -->
    <script src="js/main.js"></script>
    <script src="js/index.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        var categorySwiper = new Swiper(".CategorySwiper", {
            slidesPerView: 2,
            spaceBetween: 170,
            slidesOffsetAfter: 170, // Add extra space on the right end of the slides
            breakpoints: {
                520: {
                    slidesPerView: 2,
                    spaceBetween: 100,
                    slidesOffsetAfter: 70 // Reset the offset at this breakpoint if needed
                },
                600: {
                    slidesPerView: 3,
                    spaceBetween: 200,
                    slidesOffsetAfter: 160 // Reset the offset at this breakpoint if needed
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 100,
                    slidesOffsetAfter: 70 // Reset the offset at this breakpoint if needed
                },
                850: {
                    slidesPerView: 4,
                    spaceBetween: 250,
                    slidesOffsetAfter: 210 // Reset the offset at this breakpoint if needed
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 200,
                    slidesOffsetAfter: 150 // Reset the offset at this breakpoint if needed
                },
                1080: {
                    slidesPerView: 4,
                    spaceBetween: 80,
                    slidesOffsetAfter: 60 // Reset the offset at this breakpoint if needed
                },
                1100: {
                    slidesPerView: 5,
                    spaceBetween: 250,
                    slidesOffsetAfter: 215 // Reset the offset at this breakpoint if needed
                },
                1280: {
                    slidesPerView: 5,
                    spaceBetween: 100,
                    slidesOffsetAfter: 80 // Reset the offset at this breakpoint if needed
                },
                1360: {
                    slidesPerView: 5,
                    spaceBetween: 55,
                    slidesOffsetAfter: 20 // Reset the offset at this breakpoint if needed

                },
                1450: {
                    slidesPerView: 6,
                    spaceBetween: 200,
                    slidesOffsetAfter: 190 // Reset the offset at this breakpoint if needed

                },
                1520: {
                    slidesPerView: 6,
                    spaceBetween: 120,
                    slidesOffsetAfter: 100 // Reset the offset at this breakpoint if needed

                },
                1650: {
                    slidesPerView: 7,
                    spaceBetween: 255,
                    slidesOffsetAfter: 260 // Reset the offset at this breakpoint if needed

                },

            }

        });

        var heroSwiper = new Swiper(".HeroSwiper", {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: true,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            }
        });

        var swiper = new Swiper(".CW-Swiper", {
            slidesPerView: 1,
            spaceBetween: 50,
            breakpoints: {
                500: {
                    slidesPerView: 2,
                    spaceBetween: 300,
                    slidesOffsetAfter: 290,
                },
                570: {
                    slidesPerView: 1,
                    spaceBetween: 100,
                },
                600: {
                    slidesPerView: 2,
                    spaceBetween: 520,
                    slidesOffsetAfter: 520,
                },
                700: {
                    slidesPerView: 2,
                    spaceBetween: 470,
                    slidesOffsetAfter: 480,
                },
                794: {
                    slidesPerView: 2,
                    spaceBetween: 350,
                    slidesOffsetAfter: 330,
                },
                890: {
                    slidesPerView: 2,
                    spaceBetween: 270,
                    slidesOffsetAfter: 220,
                },
                950: {
                    slidesPerView: 2,
                    spaceBetween: 200,
                    slidesOffsetAfter: 180,
                },
                1024: {
                    slidesPerView: 2,
                    spaceBetween: 150,
                    slidesOffsetAfter: 140,
                },
                1200: {
                    slidesPerView: 2,
                    spaceBetween: 0,
                    slidesOffsetAfter: 1,
                },
                1300: {
                    slidesPerView: 3,
                    spaceBetween: 400,
                    slidesOffsetAfter: 370,
                },
                1400: {
                    slidesPerView: 3,
                    spaceBetween: 320,
                    slidesOffsetAfter: 300,
                },
                1555: {
                    slidesPerView: 3,
                    spaceBetween: 220,
                    slidesOffsetAfter: 200,
                },
                1655: {
                    slidesPerView: 3,
                    spaceBetween: 100,
                    slidesOffsetAfter: 90,
                },
                1755: {
                    slidesPerView: 3,
                    spaceBetween: 0,
                },
                1823: {
                    slidesPerView: 4,
                    spaceBetween: 500,
                    slidesOffsetAfter: 420,
                },
            },
        });
    </script>
</body>

</html>