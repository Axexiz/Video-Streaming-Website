<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>222635N</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/MasterList.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <main>
        <?php 
        session_start();
        if(!isset($_SESSION['fullname']))
        {
            header("Location: login.php?Error=2");
            exit();
        }
        require_once('nav.php'); ?>
        <form action="Master_process.php" method="post" class="Master-container">

            <label for="Title">Title:</label>
            <input type="text" name="Title" autocomplete="off"><br>

            <label for="Desc">Description:</label>
            <input type="text" name="Desc" autocomplete="off"><br>

            <label for="releaseYear">Release Year:</label>
            <input type="text" name="releaseYear" autocomplete="off"><br>

            <label for="duration">Duration:</label>
            <input type="text" name="duration" autocomplete="off"><br>

            <label for="titleDesc">Title Description:</label>
            <input type="text" name="titleDesc" autocomplete="off"><br>

            <label for="heroIMG">Hero Image URL(Optional):</label>
            <input type="text" name="heroIMG" autocomplete="off"><br>

            <label for="posterIMG">Poster Image URL:</label>
            <input type="text" name="posterIMG" autocomplete="off"><br>

            <label for="videoFile">videoFile URL:</label>
            <input type="text" name="videoFile" autocomplete="off"><br>

            <label for="rating">Rating:</label>
            <input type="text" name="rating" autocomplete="off"><br>

            <label for="categories">Select Categories:</label><br>
            <div>
                <?php
                require("dbInfo.php"); // Include your database connection details

                $mysqli = new mysqli($hostname, $dbUser, $dbPass, $db);
                $sqlStatement = "SELECT * FROM categories";
                $result = $mysqli->query($sqlStatement);

                if ($result->num_rows > 0) {
                    ?>
                <div id="category-container">
                    <?php
                    while ($record = $result->fetch_assoc()) {
                        echo '<input type="checkbox" name="categories[]" value="' . $record["id"] . '">' . $record["name"] . '<br>';
                    }
                    ?>
                </div>
                <?php
                }
                ?>
            </div>

            <br>
            <input type="submit" name="submit" id="createMovieBTN">
        </form>

    </main>
    <script src="js/main.js"></script>
    <script src="js/masterList.js"></script>
</body>

</html>