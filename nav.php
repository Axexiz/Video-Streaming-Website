<?php
    if(!isset($_SESSION['fullname']))
    {
        header("Location: login.php?Error=2");
    }
    $fullname = $_SESSION['fullname'];
    $email = $_SESSION['email'];

?>

<div class="nav-container">
    <div class="Sec1">
        <div class="logo">
            <a href="Index.php"><span style="color: red;">KEN</span>JI</a>
        </div>
        <form action="search_result.php" method="post" class="SearchBar1 one">
            <button type="submit"><i class="fa fa-search"></i></button>
            <input type="text" name="search" placeholder="Search" class="search-input" required autocomplete="off">
        </form>
    </div>

    <div class="Sec2">
        <ul id="nav">
            <li><a class="navlink" href="Index.php">Home</a></li>
            <li><a class="navlink" href="Movies.php">Movies</a></li>
            <!-- <li><a class="navlink" href="Upcoming.php">upcoming</a></li> -->
        </ul>

        <form action="search_result.php" method="post" class="SearchBar1 two">
            <button type="submit"><i class="fa fa-search"></i></button>
            <input type="text" name="search" placeholder="Search" class="search-input" required autocomplete="off">
        </form>

        <div id="ham-menu">
            <button class="hamburger" onclick="show(); showMenu()">
                <div id="bar1" class="bar"></div>
                <div id="bar2" class="bar"></div>
                <div id="bar3" class="bar"></div>
            </button>
        </div>

        <div class="PPC">
            <div class="profile-container">
                <div class="profile" onclick="menuToggle();">
                    <div>YJ</div>
                </div>
                <div class="menu">
                    <div class="p-desc-container">
                        <div class="profile">
                            <div class="p-text">YJ</div>
                        </div>
                        <h3>
                            <?php echo "$fullname"; ?>
                            <div id="menu-desc">
                                <?php echo "$email"; ?>
                            </div>
                        </h3>
                    </div>

                    <ul>
                        <li>
                            <img src="icons/profile.png" alt="">
                            <a href="profilePage.php">Profile</a>
                        </li>
                        <li>
                            <img src="icons/bookmark.png" alt="">
                            <a href="addPlaylist.php">Add list</a>
                        </li>
                        <li>
                            <img src="icons/continue.png" alt="">
                            <a href="Index.php#21">Continue watching</a>
                        </li>
                        <?php     if(isset($_SESSION['userID']) && $_SESSION['userID'] == 'axe'){
                                                ?>
                        <li>
                            <img src="icons/correct.png" alt="">
                            <a href="MasterList.php">MasterList</a>
                        </li>
                        <?php
                                            } ?>
                        <li>
                            <img src="icons/logout.png" alt="">
                            <a href="logout_process.php">Sign out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>