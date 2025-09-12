-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2025 at 01:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `essence_life`
--

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_name` varchar(255) NOT NULL,
  `content_type` varchar(500) NOT NULL,
  `content_url` varchar(500) NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `file_size` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `content_name`, `content_type`, `content_url`, `image_url`, `description`, `duration`, `file_size`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Acoustic Sunrise', 'meditation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3', 'https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=400', 'Meditation - Frank Hugin', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(2, 'City Nights', 'meditation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3', 'https://imageio.forbes.com/specials-images/imageserve/66a26836115f811da8d2554e/Dubai-marina-at-night/960x0.jpg?height=474&width=711&fit=bounds', 'Meditation - Frank Hugin', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(3, 'Ocean Waves', 'song', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400', 'Sleep - Frank Hugin', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:26:16', 'active'),
(4, 'Mountain Echoes', 'song', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3', 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400', 'Wisdom - Frank Hugin', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:26:25', 'active'),
(5, 'Calm Breeze', 'meditation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3', 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=400', 'Meditation - Frank Hugin', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(6, 'Evening Jazz', 'meditation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-6.mp3', 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=400', 'Meditation - Frank Hugin', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(7, 'Forest Whisper', 'story', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-7.mp3', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400', 'Story - Nature Tales', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(8, 'Morning Motivation', 'motivation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-8.mp3', 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?w=400', 'Motivation - Daily Inspiration', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(9, 'Rainy Day Relax', 'song', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-9.mp3', 'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=400', 'Sleep - Rain Sounds', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:26:55', 'active'),
(10, 'Starlight Dreams', 'meditation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-10.mp3', 'https://images.unsplash.com/photo-1519608487953-e999c86e7455?w=400', 'Meditation - Night Relaxation', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(11, 'Courage Story', 'story', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-11.mp3', 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=400', 'Story - Brave Adventures', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(12, 'Success Path', 'motivation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-12.mp3', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400', 'Motivation - Achieve Goals', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(13, 'Deep Forest', 'story', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-13.mp3', 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400', 'Relaxation - Nature Sounds', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:27:01', 'active'),
(14, 'Morning Dew', 'meditation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-14.mp3', 'https://images.unsplash.com/photo-1493244040629-496f6d136cc3?w=400', 'Meditation - Morning Calm', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(15, 'Thunderstorm', 'sleep', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-15.mp3', 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=400', 'Sleep - Thunderstorm Sounds', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:29:08', 'active'),
(16, 'Desert Winds', 'sleep', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-16.mp3', 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=400', 'Wisdom - Desert Reflections', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:29:13', 'active'),
(17, 'Sunset Harmony', 'song', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-17.mp3', 'https://images.unsplash.com/photo-1495567720989-cebdbdd97913?w=400', 'Song - Evening Chill', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(18, 'Gentle Rain', 'meditation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-18.mp3', 'https://images.unsplash.com/photo-1502082553048-f009c37129b9?w=400', 'Relaxation - Rainfall', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:27:40', 'active'),
(19, 'Twilight Thoughts', 'meditation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-19.mp3', 'https://images.unsplash.com/photo-1495567720989-cebdbdd97913?w=400', 'Meditation - Twilight Calm', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(20, 'Mindful Journey', 'motivation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-20.mp3', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400', 'Motivation - Self Improvement', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(21, 'Seaside Story', 'story', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-21.mp3', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400', 'Story - Ocean Adventures', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(22, 'Harmony Night', 'meditation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-22.mp3', 'https://images.unsplash.com/photo-1519608487953-e999c86e7455?w=400', 'Meditation - Night Harmony', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(23, 'Zen Garden', 'motivation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-23.mp3', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400', 'Relaxation - Zen Garden', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:27:28', 'active'),
(24, 'Motivation Boost', 'motivation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-24.mp3', 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?w=400', 'Motivation - Morning Boost', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(25, 'Forest Lullaby', 'song', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-25.mp3', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=400', 'Sleep - Forest Sounds', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:27:19', 'active'),
(26, 'Sunrise Meditation', 'meditation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-26.mp3', 'https://media.istockphoto.com/id/814423752/photo/eye-of-model-with-colorful-art-make-up-close-up.jpg?s=612x612&w=0&k=20&c=l15OdMWjgCKycMMShP8UK94ELVlEGvt7GmB_esHWPYE=', 'Meditation - Sunrise Calm', NULL, NULL, '2025-09-07 10:03:16', '2025-09-11 09:20:39', 'active'),
(27, 'Ocean Calm', 'story', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-27.mp3', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400', 'Relaxation - Ocean Waves', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:27:15', 'active'),
(28, 'Brave Heart', 'story', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-28.mp3', 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=400', 'Story - Courage Adventures', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(29, 'Evening Motivation', 'motivation', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-29.mp3', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400', 'Motivation - Evening Inspiration', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:03:16', 'active'),
(30, 'Silent Night', 'song', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-30.mp3', 'https://images.unsplash.com/photo-1519608487953-e999c86e7455?w=400', 'Sleep - Silent Night', NULL, NULL, '2025-09-07 10:03:16', '2025-09-07 10:27:09', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `user_id` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playlist_audio`
--

CREATE TABLE `playlist_audio` (
  `id` int(11) NOT NULL,
  `user_id` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `audio` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `email`, `phone`, `password`, `created_at`, `updated_at`) VALUES
(1, 'US1001', 'Samson', 'samson@yahoo.com', '0748847474', 'a8f5dea10f7504a0305998adef3a9c8c2f769c475ad5a3baf23acf9be81cea33', '2025-09-12 11:07:59', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist_audio`
--
ALTER TABLE `playlist_audio`
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
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `playlist_audio`
--
ALTER TABLE `playlist_audio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
