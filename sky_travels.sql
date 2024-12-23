-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 04:17 PM
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
-- Database: `sky_travels`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `user_id`, `admin_id`, `message`, `created_at`) VALUES
(1, 1, NULL, 'good', '2024-11-25 14:36:35'),
(2, 1, NULL, 'hi', '2024-11-25 15:15:01'),
(3, 1, NULL, 'hello', '2024-11-25 16:53:34'),
(4, 1, NULL, 'y', '2024-11-25 16:59:10'),
(5, 1, NULL, 'p', '2024-11-25 17:14:19'),
(6, 4, NULL, 'hi', '2024-11-25 17:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `user_id`, `message`, `timestamp`) VALUES
(1, 4, 'Hi', '2024-11-25 14:39:20');

-- --------------------------------------------------------

--
-- Table structure for table `chat_replies`
--

CREATE TABLE `chat_replies` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `reply` text NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_replies`
--

INSERT INTO `chat_replies` (`id`, `message_id`, `reply`, `admin_id`, `timestamp`) VALUES
(1, 1, 'hello', 1, '2024-11-25 13:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `flight_no` varchar(50) NOT NULL,
  `departure` varchar(100) NOT NULL,
  `arrival` varchar(100) NOT NULL,
  `departure_time` datetime NOT NULL,
  `arrival_time` datetime NOT NULL,
  `duration` varchar(50) NOT NULL,
  `stops` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `flight_no`, `departure`, `arrival`, `departure_time`, `arrival_time`, `duration`, `stops`, `price`, `image`) VALUES
(3, 'UL315', 'Colombo (CMB)', 'Singapore (SIN)', '2024-11-26 11:34:00', '2024-12-09 11:34:00', '4 hours 30 minutes', 1, 55000.00, 'b1.jpg'),
(4, 'EK123', 'Colombo (CMB)', 'London (LHR)', '2024-12-12 11:37:00', '2024-12-11 11:37:00', '10 hours 45 minutes', 1, 120000.00, 'b2.jpg'),
(5, 'QR678', 'Colombo (CMB)', 'Doha (DOH)', '2024-11-27 11:49:00', '2024-12-25 11:49:00', '4 hours', 1, 40000.00, 'd3.jpg'),
(6, 'UL811', 'Colombo (CMB)', 'Kuala Lumpur (KUL)', '2024-12-10 11:50:00', '2024-12-28 11:51:00', '3 hours 30 minutes', 2, 50000.00, 'd4.jpg'),
(7, ' SQ467', 'Colombo (CMB)', 'Sydney (SYD)', '2024-11-13 11:52:00', '2024-11-26 11:52:00', '11 hours', 1, 150000.00, 'd5.jpg'),
(8, 'UL550', ' Colombo (CMB)', 'Tokyo (NRT)', '2024-12-11 11:54:00', '2024-11-27 11:54:00', '10 hours 15 minutes', 1, 135000.00, 'd6.jpg'),
(9, ' EK654', 'Colombo (CMB)', 'Paris (CDG)', '2024-11-28 11:55:00', '2024-12-10 11:55:00', '11 hours', 1, 145000.00, 'b7.jpg'),
(10, 'QR319', 'Colombo (CMB)', 'New York (JFK)', '2024-11-28 11:57:00', '2024-12-12 11:57:00', '18 hours', 1, 225000.00, 'd8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `flight_bookings`
--

CREATE TABLE `flight_bookings` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reference_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight_bookings`
--

INSERT INTO `flight_bookings` (`id`, `flight_id`, `user_id`, `payment_status`, `total_amount`, `booking_date`, `reference_number`) VALUES
(1, 1, 1, '0', 0, '2024-11-25 04:22:46', ''),
(2, 1, 1, '0', 0, '2024-11-25 04:25:57', ''),
(3, 1, 1, '0', 40000000, '2024-11-25 04:29:14', ''),
(4, 1, 1, '0', 40000000, '2024-11-25 04:30:51', ''),
(5, 1, 1, '0', 40000000, '2024-11-25 04:32:48', ''),
(6, 1, 1, '0', 40000000, '2024-11-25 04:34:40', ''),
(7, 1, 1, '0', 60000000, '2024-11-25 04:36:18', ''),
(8, 1, 1, '0', 20000000, '2024-11-25 04:38:04', 'REF17325094849672'),
(9, 1, 1, '0', 20000000, '2024-11-25 04:39:55', 'REF17325095954165'),
(10, 1, NULL, NULL, 40000000, '2024-11-25 04:42:03', 'REF17325097233232'),
(11, 1, 1, 'completed', 20000000, '2024-11-25 04:44:39', 'REF17325098795517'),
(12, 1, 1, 'completed', 40000000, '2024-11-25 04:45:58', 'REF17325099585804'),
(13, 1, 16, 'completed', 60000000, '2024-11-25 04:47:59', 'REF17325100792646'),
(14, 1, 16, 'completed', 40000000, '2024-11-25 04:54:07', 'REF17325104471275'),
(15, 1, 16, 'completed', 40000000, '2024-11-25 04:55:12', 'REF17325105124943'),
(16, 1, 16, 'completed', 40000000, '2024-11-25 04:55:37', 'REF17325105376829'),
(17, 1, 16, 'completed', 40000000, '2024-11-25 04:57:20', 'REF17325106404575'),
(18, 1, 16, 'completed', 40000000, '2024-11-25 04:57:55', 'REF17325106753023'),
(19, 1, 21, 'completed', 40000000, '2024-11-25 05:12:24', 'REF17325115442794'),
(20, 3, 21, 'completed', 11000000, '2024-11-25 06:29:25', 'REF17325161651698');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `destination` text NOT NULL,
  `duration` varchar(50) NOT NULL,
  `ideal_for` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `description`, `destination`, `duration`, `ideal_for`, `image`, `price`) VALUES
(14, 'Magical Maldives Escape', 'scape to the idyllic Maldives for a luxurious and relaxing getaway. Enjoy breathtaking views from your private overwater villa, immerse yourself in the vibrant underwater world with snorkeling and diving, and indulge in peaceful spa treatments that rejuvenate both body and mind.', ' Maldives', '5 days / 4 nights', 'Honeymooners and relaxation seekers', 'img1.jfif', 875000.00),
(15, 'Wonders of South Asia', 'Journey through four fascinating countries, blending rich cultures and stunning landscapes, perfect for history and adventure lovers.\r\n', 'India, Nepal, Bhutan, Sri Lanka', '14 days / 13 nights', 'Culture enthusiasts and adventure lovers', 'img2.jfif', 1740000.00),
(17, 'Luxury in the Arabian Gulf', 'Experience the opulence of the Arabian Gulf with world-class hotels, modern marvels, and rich cultural heritage.', 'UAE, Oman, Qatar', '8 days / 7 nights', 'Luxury travelers', 'img3.jfif', 1000000.00),
(18, 'Enchanting Southeast Asia', 'A vibrant journey through Southeast Asia, exploring ancient temples, bustling cities, and stunning landscapes.', 'Thailand, Vietnam, Cambodia, Laos', '12 days / 11 nights', 'Culture and food explorers', 'thailand.jpg', 960000.00),
(19, 'The Great Silk Road Adventure', ' Embark on an unforgettable journey along the ancient Silk Road, discovering historical cities, vast deserts, and towering mountains.\r\n', ' Kazakhstan, Uzbekistan, Kyrgyzstan, Turkmenistan', '14 days / 13 nights', 'History buffs and explorers', 'Kazakhstan.jfif', 1140000.00),
(20, 'Island Paradise Tour', 'Explore Southeast Asia’s tropical paradise, with pristine beaches, cultural experiences, and natural wonders.\r\n', 'Indonesia (Bali), Philippines, Malaysia', '10 days / 9 nights', 'Beach lovers and nature enthusiasts', 'bali.jfif', 1050000.00),
(23, 'Himalayan Serenity', 'Explore the tranquil beauty of the Himalayas, with treks, monasteries, and serene landscapes.', 'Nepal, Bhutan, Northern India', '10 days / 9 nights', 'Adventure seekers and nature lovers', 'nepal.jfif', 1125000.00),
(24, 'Exotic Far East', 'Discover the modern and traditional wonders of East Asia, with a balance of adventure, culture, and family fun.\r\n', 'Japan, South Korea, Hong Kong', '9 days / 8 nights', 'Families and solo travelers', 'south korea.jpg', 1000000.00),
(25, 'Cultural Delights of Central Asia', 'Venture through Central Asia’s ancient cultures, stunning landscapes, and rich history, perfect for those seeking an authentic adventure.', 'Uzbekistan, Kyrgyzstan, Tajikistan', '10 days / 9 nights', 'Off-the-beaten-path adventurers', 'Kyrgyzstan.jfif', 1140000.00);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `package_id`, `reference_number`, `payment_status`, `created_at`) VALUES
(1, 16, 15, 'REF74CBF156', 'completed', '2024-11-23 07:34:17'),
(2, 21, 20, 'REF5353DE35', 'completed', '2024-11-23 07:44:44'),
(3, 21, 15, 'REFF77AA429', 'completed', '2024-11-23 07:48:55'),
(4, 16, 23, 'REF4F761FC7', 'completed', '2024-11-23 07:50:51'),
(5, 21, 20, 'REFB1353DD8', 'completed', '2024-11-24 05:34:22'),
(6, 21, 25, 'REF2B476092', 'completed', '2024-11-24 06:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `profile_photo` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `confirmed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `designation`, `profile_photo`, `message`, `created_at`, `confirmed`) VALUES
(11, 'David Wilson', 'Entrepreneur', './uploaded_photos/ae5566cb85d2bc6978cd9bde94312e91.jpg', 'Excellent service, will book again!', '2024-11-24 12:47:40', 1),
(12, 'Anne Merry', 'Entrepreneur', './uploaded_photos/03af5b0a935d49690749116c3bd02a24.jpg', 'Best travel agency ever!', '2024-11-24 12:50:04', 1),
(13, 'Rayan Fonseka', 'Entrepreneur', './uploaded_photos/5d33689d6f760659875cfaa4e6575dd7.jpg', 'Perfect trip! Highly recommend.', '2024-11-24 12:51:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `story_likes`
--

CREATE TABLE `story_likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `story_likes`
--

INSERT INTO `story_likes` (`id`, `user_id`, `story_id`) VALUES
(11, 5, 7),
(13, 5, 8),
(14, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `traveler_stories`
--

CREATE TABLE `traveler_stories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `story_text` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `travel_tips` text DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `traveler_stories`
--

INSERT INTO `traveler_stories` (`id`, `user_id`, `destination`, `story_text`, `image_path`, `travel_tips`, `likes`, `created_at`, `status`) VALUES
(7, 1, 'Sigiriya Rock Fortress, Sri Lanka', 'Climbing Sigiriya Rock Fortress was a thrilling adventure. As I ascended the ancient steps, the frescoes of the Sigiriya Maidens left me in awe. The view from the top, overlooking the surrounding forest and water gardens, was worth every step. It’s a journey through history and nature combined.', 'uploads/p1.jfif', 'Wear sturdy shoes as the climb can be steep in some places.\r\nVisit early in the morning or late afternoon to avoid the midday heat.\r\nExplore nearby Pidurangala Rock for a less crowded hike and stunning views of Sigiriya itself.', 2, '2024-11-24 15:11:03', 'approved'),
(8, 1, 'Kerala, India', 'Kerala’s backwaters were the highlight of my trip to India. Drifting on a houseboat in Alleppey, I was surrounded by coconut trees and tranquil waters. Watching the sunset from the deck while enjoying freshly cooked seafood was pure bliss.', 'uploads/p2.jfif', 'Travel between November and February for the best weather.\r\nPack light, breathable clothing as it can get humid.\r\nDon’t miss a traditional Ayurvedic massage for a relaxing experience.', 1, '2024-11-24 15:16:42', 'approved'),
(9, 1, 'Kyoto, Japan', 'Walking through the Arashiyama Bamboo Grove felt like stepping into another world. The towering bamboo stalks swayed gently with the wind, creating a soothing melody. My favorite moment was sipping matcha tea at a traditional teahouse overlooking the Katsura River. Kyoto\'s blend of ancient temples and modern culture left me in awe.', 'uploads/Kyoto.jpg', 'Visit the bamboo grove early in the morning to avoid crowds.\r\nPurchase a day pass for Kyoto’s buses to easily explore the city.\r\nTry the local Kyoto-style sushi, a delightful twist on traditional sushi.', 0, '2024-11-24 15:29:25', 'approved'),
(10, 1, 'Galle Fort, Sri Lanka', 'Strolling through the cobblestone streets of Galle Fort felt like stepping back in time. The colonial architecture, colorful boutiques, and ocean views were captivating. I loved watching the sunset from the fort walls while savoring a scoop of locally-made ice cream.', 'uploads/p4.jfif', 'Rent a bicycle to explore the fort and its surroundings at your own pace.\r\nVisit the Maritime Museum for a glimpse into the area’s rich history.\r\nDon’t miss the iconic lighthouse for some great photo opportunities.', 0, '2024-11-24 15:31:41', 'rejected'),
(11, 1, 'Ella, Sri Lanka', 'The train ride to Ella from Kandy was a highlight of my trip. The breathtaking views of tea plantations, misty hills, and lush greenery felt like a scene from a painting. Climbing Little Adam’s Peak at sunrise was unforgettable, with panoramic views that stretched for miles. The town itself had a laid-back vibe, perfect for relaxing after a day of exploration.', 'uploads/p3.jfif', 'Book train tickets in advance for the scenic Kandy-to-Ella route.\r\nStart your hike to Little Adam’s Peak early to catch the sunrise.\r\nTry local snacks like coconut roti and curd with treacle from roadside stalls.', 0, '2024-11-24 15:38:46', 'pending'),
(12, 1, 'Chiang Mai, Thailand', 'I joined the Loy Krathong Festival in Chiang Mai, and it was magical. Thousands of lanterns lit up the night sky, and I floated my own krathong on the Ping River as a symbol of letting go of negativity. It was a heartwarming experience that I’ll cherish forever.', 'uploads/p5.jfif', 'Book accommodations early during festival times.\r\nRent a scooter for a day to explore nearby temples and waterfalls.\r\nTry Khao Soi, a spicy coconut noodle soup unique to Northern Thailand.', 0, '2024-11-24 15:42:40', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `mobile`, `email`, `password`) VALUES
(4, 'David', 'Wilson', '0712345678', 'david.wilson@example.com', '123'),
(5, 'Anne', 'Merry', '0723456789', 'anne.merry@example.com', '1234'),
(6, 'Rayan', 'Fonseka', '0734567890', 'rayan.fonseka@example.com', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `chat_replies`
--
ALTER TABLE `chat_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flight_bookings`
--
ALTER TABLE `flight_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `story_likes`
--
ALTER TABLE `story_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `story_id` (`story_id`);

--
-- Indexes for table `traveler_stories`
--
ALTER TABLE `traveler_stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat_replies`
--
ALTER TABLE `chat_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `flight_bookings`
--
ALTER TABLE `flight_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `story_likes`
--
ALTER TABLE `story_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `traveler_stories`
--
ALTER TABLE `traveler_stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_replies`
--
ALTER TABLE `chat_replies`
  ADD CONSTRAINT `chat_replies_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `chat_messages` (`id`),
  ADD CONSTRAINT `chat_replies_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
