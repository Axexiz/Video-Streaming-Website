<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>222635N</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/videoPlayer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <main>
    <?php       
                require("dbInfo.php");
                $mysqli = new mysqli($hostname,$dbUser,$dbPass,$db);
                session_start();
                if(!isset($_SESSION['fullname']))
                {
                    header("Location: login.php?Error=2");
                    exit();
                }
                $userID = $_SESSION['userID'];
                $pass = $_SESSION['password'];
                $AccountID = $_SESSION['accountID'];
                // echo $AccountID;

                if(!isset($_GET['id']))
                {
                    header("Location: meow");
                }
                $videoID = $_GET['id'];
                $TypeOfShow = $_GET['type_of_show'];
                // echo $TypeOfShow;

                $sqlStatement = "SELECT * FROM user_watch_history where video_id = $videoID AND user_id = $AccountID";
                $result = $mysqli -> query($sqlStatement);
                $count = $result -> num_rows;


                if($count == 0 && $TypeOfShow == "movie")
                {
                $sqlStatement = "INSERT INTO user_watch_history (video_id,last_watched_time,user_id,total_time) VALUES ($videoID,1,$AccountID,50)";
                $mysqli -> query($sqlStatement);
                }
                
                $sqlStatement = "SELECT * FROM shows WHERE shows.id = $videoID";
                $result = $mysqli -> query($sqlStatement);
                $record = $result -> fetch_assoc();
                if($TypeOfShow == "movie")
                {
                ?>
    <section>
      <?php 
                require_once('nav.php'); ?>
      <div class="nav-slider">
        <nav>
          <ul>
            <li><a href="Index.php">Home</a></li>
            <li><a href="Movies.php">Movies</a></li>
            <!-- <li><a href="Upcoming.php">upcoming</a></li> -->
          </ul>
        </nav>
      </div>
    </section>

    <section class="BIG-CONTAINER">
      <div class="section-videoContainer">

        <div class="section1">

          <div class="video-container">
            <video src="videos/<?= $record['videoFile'] ?>" id="myVideo" controls></video>
          </div>
        </div>

        <?php
          $sqlStatement = "SELECT * FROM shows where id = '$videoID'";
          $result = $mysqli -> query($sqlStatement);
          $record = $result -> fetch_assoc();
        ?>
        <div class="video-description">
          <div class="desc-imgbox">
            <img src="images_poster/<?=$record['posterIMG']?>">
          </div>

          <div class="videodesc-text-container">
            <span style="font-size:2.8em; font-weight:600px;">
              <?=$record['Title']?>
            </span>
            <div class="videoDesc-icons">
              <div class="desc-logo">
                <?=$TypeOfShow?>
              </div>
              <div class="desc-logo">
                <?=$record['releaseYear']?>
              </div>
              <div class="desc-logo">
                <?=$record['Duration']?>
              </div>
              <div class="desc-logo" style="background:red">En</div>
            </div>
            <div class="overview">
              <span style="font-size:1.8em;font-weight:800px;">Overview</span>
              <div class="overview-desc">
                <?=$record['showsDesc']?>
              </div>
            </div>

            <div id="category_desc" class="overview">
              <span style="font-size:1.6em;font-weight:1000px;">Genre</span>
              <div class="videoDesc-icons">
                <?php 
                  $sqlStatement = "SELECT * FROM shows INNER JOIN movie_cat ON shows.id = movie_cat.movieID_FK INNER JOIN categories ON movie_cat.catID_FK = categories.id WHERE shows.id = '$videoID';";
                  $result = $mysqli -> query($sqlStatement);
                  while($record = $result -> fetch_assoc())
                  {
                ?>
                <div class="desc-logo">
                  <?= $record['name'] ?>
                </div>
                <?php
                  }
                ?>
              </div>
            </div>
          </div>
        </div>


      </div>

      <div class="section-featured">
        <span class="featured-title">Featured</span>
        <div class="feature-container">
          <?php
            $sqlStatement = "SELECT * FROM shows WHERE rating >= 7 ORDER BY rating DESC LIMIT 5;";
            $result = $mysqli -> query($sqlStatement);
            while($record = $result -> fetch_assoc())
            {
          ?>
          <a href="show.php?id=<?= $record['id'] ?>&type_of_show=<?= $record['type_of_show'] ?>" class="feature-link">
            <div class="feature-items">
              <div class="feature-img-container">
                <img src="images_poster/<?= $record['posterIMG'] ?>" alt="">
              </div>
              <div class="feature-text">
                <?= $record['Title'] ?>
              </div>
            </div>
          </a>
          <?php
          }
        ?>
        </div>
      </div>
    </section>


    <?php 
    require_once("footer.php");
    ?>




    <?php }
    ?>


  </main>
  <script src="js/jquery.js"></script>
  <script src="js/main.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {


      const myVideo = document.getElementById("myVideo");
      let hasStarted = false;

      function retrieveTimestampAndSetVideoTime() {
        const AID = "<?php echo $AccountID ?>";
        const VID = getVideoIDFromURL();

        // Fetch the saved timestamp as before
        $.ajax({
          url: 'get_saved_timestamp.php',
          method: 'GET',
          data: { videoID: VID, accountID: AID },
          dataType: 'json',
          success: function (data) {
            if (data.timestamp >= 0 && data.timestamp <= myVideo.duration) {
              myVideo.currentTime = data.timestamp;
            }
            hasStarted = true;
          },
          error: function (xhr, status, error) {
            console.log('Error fetching saved timestamp: ', error);
            hasStarted = true;
          }
        });
      }

      retrieveTimestampAndSetVideoTime();

      // Trigger the timestamp retrieval and video time setting logic when the page loads
      retrieveTimestampAndSetVideoTime();

      myVideo.addEventListener("canplaythrough", function () {
        if (!hasStarted) {
          const TT = myVideo.duration;
          const AID = "<?php echo $AccountID ?>";
          const VID = getVideoIDFromURL();

          // Save the total time to the database
          $.ajax({
            url: 'save_total_time.php',
            method: 'POST',
            data: { videoID: VID, totalTime: TT, accountID: AID },
            dataType: 'json',
            error: function (xhr, status, error) {
              console.log('Error saving total time: ', error);
            }
          });

          // Call the timestamp retrieval function
          retrieveTimestampAndSetVideoTime();
        }
      });

      myVideo.addEventListener('pause', saveTimestamp);
      myVideo.addEventListener('beforeunload', saveTimestamp);

      function saveTimestamp() {
        if (hasStarted) {
          const CT = myVideo.currentTime;
          const TT = myVideo.duration;
          const AID = "<?php echo $AccountID ?>";
          const VID = getVideoIDFromURL();

          $.ajax({
            url: 'save_timestamp.php',
            method: 'POST',
            data: { videoID: VID, timestamp: CT, totalTime: TT, accountID: AID },
            dataType: 'json',
            error: function (xhr, status, error) {
              console.log('Error saving timestamp: ', error);
            }
          });
        }
      }

      function getVideoIDFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('id');
      }
    });
  </script>

</body>

</html>