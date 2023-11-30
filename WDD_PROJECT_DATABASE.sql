-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2023 at 05:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videostreaming_project`
--
CREATE DATABASE IF NOT EXISTS `videostreaming_project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `videostreaming_project`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Animation'),
(4, 'Biography'),
(5, 'Comedy'),
(6, 'Comedy'),
(7, 'Crime'),
(8, 'Documentry'),
(9, 'Drama'),
(10, 'Family'),
(11, 'Fantasy'),
(12, 'Film Noir'),
(13, 'History'),
(14, 'Horror'),
(15, 'Music'),
(16, 'Musical'),
(17, 'Mystery'),
(18, 'Romance'),
(19, 'Sci-Fi'),
(20, 'Short'),
(21, 'Sport'),
(22, 'Thriller'),
(23, 'War'),
(24, 'Western');

-- --------------------------------------------------------

--
-- Table structure for table `movie_cat`
--

CREATE TABLE `movie_cat` (
  `id` int(11) NOT NULL,
  `movieID_FK` int(11) NOT NULL,
  `catID_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_cat`
--

INSERT INTO `movie_cat` (`id`, `movieID_FK`, `catID_FK`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 19),
(4, 2, 1),
(5, 2, 2),
(6, 2, 3),
(7, 3, 1),
(8, 3, 2),
(9, 3, 3),
(10, 3, 19),
(11, 4, 1),
(12, 4, 2),
(13, 4, 11),
(14, 5, 1),
(15, 5, 2),
(16, 5, 5),
(17, 6, 1),
(18, 6, 9),
(19, 6, 21),
(20, 7, 1),
(21, 7, 2),
(22, 7, 3),
(23, 7, 9),
(24, 7, 11),
(25, 8, 3),
(26, 8, 9),
(27, 8, 18),
(28, 9, 5),
(29, 9, 9),
(30, 10, 2),
(31, 10, 6),
(32, 10, 11),
(33, 11, 2),
(34, 11, 3),
(35, 11, 6),
(36, 11, 10),
(37, 11, 11),
(38, 12, 1),
(39, 12, 7),
(40, 12, 22),
(41, 13, 14),
(42, 13, 22),
(43, 14, 2),
(44, 14, 6),
(45, 14, 11);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `userid_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `name`, `userid_FK`) VALUES
(8, '', 0),
(19, 'Favourite', 1),
(20, 'hello', 1);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_show`
--

CREATE TABLE `playlist_show` (
  `id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist_show`
--

INSERT INTO `playlist_show` (`id`, `playlist_id`, `show_id`, `userID`) VALUES
(36, 19, 5, 1),
(37, 20, 7, 1),
(38, 19, 12, 1),
(39, 20, 4, 1),
(40, 19, 4, 1),
(41, 19, 9, 1),
(42, 20, 5, 1),
(43, 20, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `id` int(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `showsDesc` varchar(255) NOT NULL,
  `releaseYear` varchar(255) NOT NULL,
  `Duration` varchar(11) NOT NULL,
  `titleDesc` varchar(255) NOT NULL,
  `heroIMG` varchar(255) NOT NULL,
  `posterIMG` varchar(255) NOT NULL,
  `videoFile` varchar(255) NOT NULL,
  `type_of_show` varchar(255) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`id`, `Title`, `showsDesc`, `releaseYear`, `Duration`, `titleDesc`, `heroIMG`, `posterIMG`, `videoFile`, `type_of_show`, `rating`) VALUES
(1, 'Transformers: Rise of the Beasts', 'Optimus Prime and the Autobots take on their biggest challenge yet. When a new threat capable of destroying the entire planet emerges, they must team up with a powerful faction of Transformers known as the Maximals to save Earth.', '2023', '2h 7m', ' Steven Caple Jr.', 'Transformers_ROB.jpg', 'Poster1.jpg', 'movie1.mp4', 'movie', 6.1),
(2, 'Raya and the Last Dragon', 'Raya, a warrior, sets out to track down Sisu, a dragon, who transferred all her powers into a magical gem which is now scattered all over the kingdom of Kumandra, dividing its people.', '2021', '1h47m', ' Don Hall, Carlos López Estrada, Paul Briggs', 'Hero1.jpg', 'Poster3.jpg', 'movie2.mp4', 'movie', 7.3),
(3, 'Spider-Man: Across the Spider-Verse', 'Miles Morales catapults across the Multiverse, where he encounters a team of Spider-People charged with protecting its very existence. When the heroes clash on how to handle a new threat, Miles must redefine what it means to be a hero.', '2023', '2h20m', 'Joaquim Dos Santos, Kemp Powers, Justin K. Thompson', 'Hero2.jpg', 'Poster4.jpg', 'movie3.mp4', 'movie', 7),
(4, 'Avatar: The Way of Water', 'The Way of Water follows the journey of Jake Sully and Neytiri\'s newfound family of children. Despite their best efforts to keep their family together, a familiar threat resurfaces because Earth is dying, and forces the Sully family to become refugees and', '2022', '3h12m', 'James Cameron', 'Avatar_WOW.jpg', 'Poster5.jpg', 'movie4.mp4', 'movie', 7.6),
(5, 'Guardians of the Galaxy Vol. 3', 'Still reeling from the loss of Gamora, Peter Quill must rally his team to defend the universe and protect one of their own. If the mission is not completely successful, it could possibly lead to the end of the Guardians as we know them.', '2023', '2h30m', ' James Gunn', 'Hero4.jpg', 'Poster6.jpg', 'movie5.mp4', 'movie', 8),
(6, 'Creed III', 'Still dominating the boxing world, Adonis Creed is thriving in his career and family life. When Damian, a childhood friend and former boxing prodigy resurfaces after serving time in prison, he\'s eager to prove that he deserves his shot in the ring. The fa', '2023', '1h 56m', 'Michael B. Jordan', 'Hero5.jpg', 'Poster7.jpg', 'movie6.mp4', 'movie', 6.3),
(7, 'Suzume', 'Suzume, 17, lost her mother as a little girl. On her way to school, she meets a mysterious young man. But her curiosity unleashes a calamity that endangers the entire population of Japan, and so Suzume embarks on a journey to set things right.', '2022', '2h 2m', ' Makoto Shinkai', 'Hero6.jpg', 'Poster8.jpg', 'movie7.mp4', 'movie', 7.7),
(8, 'Your Name', 'High schoolers Mitsuha and Taki are complete strangers living separate lives. But one night, they suddenly switch places. Mitsuha wakes up in Taki’s body, and he in hers. This bizarre occurrence continues to happen randomly, and the two must adjust their ', '2016', '1h 46m', 'Makoto Shinkai', 'your_name.jpg', 'Poster11.jpg', 'movie8.mp4', 'movie', 8.4),
(9, 'A Man Called Otto', 'When a lively young family moves in next door, grumpy widower Otto Anderson meets his match in a quick-witted, pregnant woman named Marisol, leading to an unlikely friendship that turns his world upside down.', '2022', '2h 6m', 'Marc Forster', 'A_man_called_otto.jpg', 'AMCO_Poster.jpg', 'AMCO.mp4', 'movie', 7.4),
(10, 'Barbie', 'Barbie and Ken are having the time of their lives in the colorful and seemingly perfect world of Barbie Land. However, when they get a chance to go to the real world, they soon discover the joys and perils of living among humans.', '2023', '1h 54m', 'Greta Gerwig', 'barbie.jpg', 'barbie.jpg', 'barbie.mp4', 'movie', 7.4),
(11, 'The Super Mario Bros. Movie', 'While working underground to fix a water main, Brooklyn plumbers—and brothers—Mario and Luigi are transported down a mysterious pipe and wander into a magical new world. But when the brothers are separated, Mario embarks on an epic quest to find Luigi.', '2023', '1h 33m', 'Shigeru Miyamoto', 'Mario.jpg', 'Mario.jpg', 'mario.mp4', 'movie', 7.1),
(12, 'John Wick: Chapter 4', 'With the price on his head ever increasing, John Wick uncovers a path to defeating The High Table. But before he can earn his freedom, Wick must face off against a new enemy with powerful alliances across the globe and forces that turn old friends into fo', '2023', '2h 50m', 'Chad Stahelski', 'johnwick.jpg', 'johnwick.jpg', 'john_wick.mp4', 'movie', 7.8),
(13, 'The Exorcist: Believer', 'When his daughter, Angela, and her friend Katherine, show signs of demonic possession, it unleashes a chain of events that forces single father Victor Fielding to confront the nadir of evil. Terrified and desperate, he seeks out Chris MacNeil, the only pe', '2023', '2h 1m', 'David Gordon Green', 'exorcist.jpg', 'exorcist.jpg', 'exorcist.mp4', 'movie', 6.2),
(14, 'Dungeons & Dragons: Honor Among Thieves', 'A charming thief and a band of unlikely adventurers undertake an epic heist to retrieve a lost relic, but things go dangerously awry when they run afoul of the wrong people.', '2023', '2h 14m', 'John Francis Daley', 'D&D.jpg', 'D&D.jpg', 'D&D.mp4', 'movie', 7.3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `pass`) VALUES
(1, 'axexiz', 'admin', 'Dylan123@gmail.com', '123'),
(6, 'Ang Yujie', 'Yujie', 'angyujie2005@gmail.com', 'AngYujie222'),
(7, 'Kenji wanabe', 'KJWB', 'angyujie9@gmail.com', 'axexiz12345'),
(8, 'renee', 'ren', 'dad@gmail.com', 'Reneekok123');

-- --------------------------------------------------------

--
-- Table structure for table `user_watch_history`
--

CREATE TABLE `user_watch_history` (
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `last_watched_time` int(11) NOT NULL,
  `total_time` int(11) NOT NULL,
  `updated_timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_watch_history`
--

INSERT INTO `user_watch_history` (`user_id`, `video_id`, `last_watched_time`, `total_time`, `updated_timestamp`) VALUES
(7, 11, 1, 92, '2023-08-10 02:37:12'),
(7, 2, 1, 145, '2023-08-10 02:40:00'),
(8, 7, 1, 122, '2023-08-11 16:29:16'),
(8, 12, 2, 89, '2023-08-11 16:29:23'),
(8, 10, 1, 161, '2023-08-11 16:31:58'),
(1, 7, 1, 122, '2023-08-11 19:27:59'),
(1, 10, 120, 160, '2023-08-11 19:38:27'),
(1, 8, 1, 99, '2023-08-11 19:56:21'),
(1, 12, 1, 50, '2023-08-11 23:12:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_cat`
--
ALTER TABLE `movie_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist_show`
--
ALTER TABLE `playlist_show`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `movie_cat`
--
ALTER TABLE `movie_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `playlist_show`
--
ALTER TABLE `playlist_show`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
