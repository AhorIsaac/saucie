-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2022 at 03:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saucie`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `telephone` varchar(100) DEFAULT NULL,
  `rel_status` varchar(100) DEFAULT NULL,
  `gender` enum('M','F','','') NOT NULL,
  `address` longtext NOT NULL DEFAULT 'Saucie Enterprise',
  `dob` date DEFAULT NULL,
  `salary` int(11) NOT NULL DEFAULT 1000,
  `role` varchar(80) NOT NULL DEFAULT 'admin',
  `status` int(11) DEFAULT 1,
  `profileimage` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`id`, `name`, `email`, `password`, `telephone`, `rel_status`, `gender`, `address`, `dob`, `salary`, `role`, `status`, `profileimage`) VALUES
(1, 'admin', 'admin@gmail.com', '1253208465b1efa876f982d8a9e73eef', NULL, NULL, 'M', 'Saucie Enterprise', NULL, 100000, 'super_admin', 1, 'super_admin.JPEG'),
(2, 'Queenie', 'aliconfidence@gmail.com', '58ed185d33725fcd178867ec00e1d4aa', '09061624314', 'Single', 'F', 'Saucie Enterprise', '1999-10-08', 100000, 'super_admin', 1, '1598805264_871560db6e6648c4a93a7ce83d272e97.jpg'),
(3, 'Prettymama', 'agenatonkeziah@gmail.com', 'cba994d135934946e899a3b0309ffc9d', '07062660214', 'Single', 'F', 'Saucie Enterprise', '1987-02-02', 100000, 'admin', 1, '1599603363_PrettyMama.jpg'),
(4, 'Chocho', 'chochomayoki@gmail.com', 'cb3cf324f6062aacfd485f1b17ec6070', '0813585957', 'Married', 'M', 'Federal University of Agriculture Makurdi', '1992-04-02', 100000, 'super_admin', 1, '1601315479_IMG_20191019_085155.jpg'),
(5, 'Queenie', 'ochanyaali2017@gmail.com', '6851434ca7db6f294e135ebdc0005e98', '09061624314', 'Engaged', 'F', 'Saucie Enterprise', '1999-10-08', 100000, 'admin', 1, '1601557841_FB_IMG_15901904033383896.jpg'),
(6, 'Cindy', 'cindy@gmail.com', 'cc4b2066cfef89f2475de1d4da4b29c7', '081000000000', 'Engaged', 'F', 'Saucie Enterprise', '1999-10-13', 100000, 'admin', 1, '1602626961_FB_IMG_15699176041890945.jpg'),
(7, 'Scarfy', 'scarfy@gmail.com', '151fa3c3ca57c94389a032c02507f330', '08000000000', 'Engaged', 'M', 'Federal University of Agriculture', '1998-12-20', 1000, 'admin', 1, '1602789738_Screenshot_20200206-150927.png');

-- --------------------------------------------------------

--
-- Table structure for table `assign_order_table`
--

CREATE TABLE `assign_order_table` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `ref_no` bigint(20) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `delivered` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_order_table`
--

INSERT INTO `assign_order_table` (`id`, `staff_id`, `ref_no`, `admin_id`, `delivered`) VALUES
(25, 3, 59742, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_breakfast`
--

CREATE TABLE `cart_breakfast` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart_dinner`
--

CREATE TABLE `cart_dinner` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_dinner`
--

INSERT INTO `cart_dinner` (`id`, `food_id`, `user_id`, `quantity`) VALUES
(41, 11, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_drinks`
--

CREATE TABLE `cart_drinks` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart_lunch`
--

CREATE TABLE `cart_lunch` (
  `id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_table`
--

CREATE TABLE `customer_table` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telephone` varchar(80) DEFAULT NULL,
  `rel_status` varchar(100) DEFAULT NULL,
  `gender` enum('F','M') DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `role` varchar(70) NOT NULL DEFAULT 'customer',
  `profileimage` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_table`
--

INSERT INTO `customer_table` (`id`, `name`, `email`, `password`, `telephone`, `rel_status`, `gender`, `address`, `dob`, `status`, `role`, `profileimage`) VALUES
(3, 'Ecady', 'peverluper@gmail.com', '3cc75deb5eb94efa3b51242a3f660959', '08159806769', 'Married', 'M', 'Federal University of Agriculture', '1998-08-20', 1, 'customer', '1601294541_3f15a48e00b34a0fa8d4f72e3703d7b7.jpg'),
(4, 'Shidoon', 'shidoonmercy@gmail.com', '4c915782cdddcafd534f2cc379176809', '08062962519', 'Widow', 'F', 'Bishop Murray Medical Centre, Makurdi', '1980-03-14', 1, 'customer', '1598539775_me.jpg'),
(5, 'Angel', 'babyangel@gmail.com', 'f4f068e71e0d87bf0ad51e6214ab84e9', '+xxx-xxxx-xxxxx-xxxx', 'Single', 'F', 'Behind Kyabiz Hotel Judges Quarters Makurdi', '2019-03-19', 1, 'customer', '1598801821_FB_IMG_15846868264711581.jpg'),
(6, 'Kingdom', 'tartorkingdom@gmail.com', 'dc420563e5dd1c2f8f04c3e08993e948', '07088538014', 'Engaged', 'M', 'Federal University of Agriculture Makurdi', '1998-02-14', 1, 'customer', '1599416951_FB_IMG_15816394488508593.jpg'),
(7, 'Bella', 'christybella@gmail.com', 'e7e9ec3723447a642f762b2b6a15cfd7', '07060664664', 'Engaged', 'F', 'Maafs Extension South Core FUAM', '1996-06-20', 1, 'customer', '1599420273_IMG-20200619-WA0004.jpg'),
(8, 'wisdom', 'fab@gmail.com', 'f1f0081ae47118184909ef6b59be623f', '07060664664', 'Single', 'M', 'Api Makurdi Benue State', '2020-09-10', 1, 'customer', '1599735292_350x220 (1).png'),
(9, 'Enapeh', 'gabrieljen@gmail.com', '1660fe5c81c4ce64a2611494c439e1ba', '08135209385', 'Engaged', 'F', 'Federal University of Agriculture Makurdi', '1999-09-26', 1, 'customer', '1599751128_d62472f8598b4aa1ad9ae33c12b80957.jpg'),
(10, 'Trey', 'ahortrey@gmail.com', 'cbacbe1f0ca09bd50da766aba87a40bf', '08108629535', 'Single', 'M', 'Federal University of Agriculture Makurdi', '1980-09-20', 1, 'customer', '1600084774_trigga.jpg'),
(11, 'Trey', 'ahorsark@gmail.com', 'dd81a417012fb55d97a34a614be07f45', '08108629535', NULL, NULL, 'Federal University of Agriculture Makurdi', NULL, 1, 'customer', NULL),
(12, 'Quin Bliss', 'quinbliss@gmail.com', '2ccd89b67324dd915dd2d286f613332e', '08070675835', 'Engaged', 'F', 'North Bank Makurdi', '2001-03-01', 1, 'customer', '1601136642_FB_IMG_15696425192712153.jpg'),
(13, 'Ava', 'nyiishitimothy@gmail.com', 'ecb97d53d2d35b8ba98cf82a8d78cad9', '08103036638', 'Single', 'M', 'Main Island Lagos', '1997-09-17', 1, 'customer', '1600446507_Timochiks.jpg'),
(14, 'Currency', 'currency@gmail.com', '6c84cbd30cf9350a990bad2bcc1bec5f', '08130849271', 'Engaged', 'M', 'Federal University of Agriculture Makurdi', '1997-04-06', 1, 'customer', '1600784888_IMG-20200405-WA0000.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_table`
--

CREATE TABLE `feedback_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback_title` varchar(70) NOT NULL,
  `feedback_subject` varchar(40) NOT NULL,
  `feedback_message` longtext NOT NULL,
  `feedback_seen` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback_table`
--

INSERT INTO `feedback_table` (`id`, `user_id`, `feedback_title`, `feedback_subject`, `feedback_message`, `feedback_seen`) VALUES
(2, 3, 'Good Restaurant', 'Welldone', 'This is the best restaurant I have ever been to! The food is spicy, the drinks are juicy, the staff are extremely devoted, committed, attentive, dedicated and they work very smart. Just as the name implies it\'s Saucie!     ', 1),
(3, 5, 'The home of food', 'Welldone', 'This is the best restaurant I have ever been to. Hey guys, you need to try this one out!                         ', 1),
(4, 4, 'Kudos', 'Welldone', 'I always eat at Saucie because their food is amazing. 30% of my monthly earning goes to this Restaurant!                             ', 1),
(5, 6, 'Complaint', 'Complaint', 'Staff avadooter is always rude to customers! Please fire and employ a new staff!                            ', 1),
(7, 7, 'Suggestion', 'Recommendation', 'I recommend you add more food items to the lunch section.                  ', 1),
(8, 6, 'Welldone', 'Welldone', 'I love this Saucie! Just keep up the good work!                             ', 1),
(9, 10, 'Good Job', 'Welldone', 'Nice Saucie Restaurant                             ', 1),
(10, 12, 'Welldone Pipu', 'Welldone', 'Good Job Saucie Restarant!       ', 1),
(11, 14, 'Recommendation', 'Recommendation', 'Please employ new staff!                            ', 1),
(12, 7, 'Sad', 'Complaint', 'Staff 1 is very rude!                        ', 1),
(13, 3, 'Sad', 'Complaint', 'Salome is a very bad staff!                          ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_table`
--

CREATE TABLE `food_table` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `name` varchar(80) NOT NULL,
  `category` varchar(80) NOT NULL,
  `description` longtext NOT NULL,
  `price_tag` int(11) NOT NULL,
  `quantity` enum('Available','Not Available') NOT NULL DEFAULT 'Available',
  `image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_table`
--

INSERT INTO `food_table` (`id`, `staff_id`, `admin_id`, `name`, `category`, `description`, `price_tag`, `quantity`, `image`) VALUES
(1, NULL, 2, 'Italian Tea', 'Breakfast', 'Miami Italian Tea', 1500, 'Available', '1598878251_coffee_table_cup_glasses_119666_1920x1080.jpg'),
(2, NULL, 2, 'Classix Berry', 'Breakfast', 'The Breakfast Classix Berry made by Saucie Restaurant to light up your day!             ', 2300, 'Available', '1598646271_berries3.png'),
(3, NULL, 2, 'Complexium Saucie Butter', 'Breakfast', 'One of the world\'s best breakfast meals!           ', 4000, 'Available', '1598646417_sweet-food.jpg'),
(4, NULL, 2, 'Bosh Indian Jollof Rice', 'Breakfast', 'If you want to boost your immunity with just a single saucie dish then you should definitely try this one!                ', 15000, 'Available', '1598646684_4000.jpg'),
(5, NULL, 2, 'Buet White Rice', 'Lunch', 'German\'s Best! Made of imported carnula rice.', 1400, 'Available', '1598646770_rice3.jpg'),
(6, NULL, 2, 'Germanium Lunch Meal', 'Lunch', 'Made of Eggs and Germanium lectural mixture!               ', 1650, 'Available', '1598646943_eggs.jpg'),
(7, NULL, 2, 'Lunchia', 'Lunch', 'The lunchia meal! Fats & Oil Free! Chemical Free! Purely Organic.                     ', 2650, 'Available', '1598647151_bg-5.jpg'),
(8, NULL, 2, 'Sweetli', 'Lunch', 'The Sweetli Saucie Lunch! People never get enough of this one, they always come back for more!', 4000, 'Available', '1598647307_sweetli-food.jpg'),
(9, NULL, 2, 'Tasty Noodles', 'Lunch', 'Very proteinous in nature!           ', 2800, 'Available', '1598647466_noodles.jpg'),
(10, 2, NULL, 'Saucie Dinner Fruits', 'Dinner', 'You can choose to end your day by these energizing fruits!                       ', 6500, 'Available', '1598647752_fruit1.jpg'),
(11, 2, NULL, 'Hen Fuet Tere', 'Dinner', 'One of the world\'s best dinner meals!             ', 2500, 'Available', '1598648014_upload1.jpg'),
(12, 2, NULL, 'Saucie Dinush', 'Dinner', 'The Complete Saucie Dinush.                      ', 3650, 'Available', '1598648152_zz.jpg'),
(13, 2, NULL, 'H S By', 'Breakfast', 'Hot Spicy Burgery      ', 3000, 'Available', '1598648255_hot-spicy-burger-ys.jpg'),
(14, 2, NULL, 'Healthy B-Oat Meal', 'Breakfast', 'Healthy Breakfast and Oatmeal       ', 2500, 'Available', '1598648499_Healthy_Breakfast_Fruit_and_Oatmeal_5K_Images.jpg'),
(15, 2, NULL, 'StrawPaw', 'Dinner', 'Berry & Pawpaw for Dinner.                      ', 4000, 'Available', '1598648629_fruit3.jpeg'),
(19, NULL, 2, 'Black Spix', 'Drinks', 'The Black Spix Wine           ', 10000, 'Available', '1598717737_marta-filipczyk-oU5fTsTkklg-unsplash.jpg'),
(20, NULL, 2, 'Violet Saucie Wine', 'Drinks', 'The Violet Saucie Wine              ', 8000, 'Available', '1598717906_morning-brew-3Bl-1qIKp5E-unsplash.jpg'),
(23, NULL, 2, 'Berry Wine', 'Drinks', 'Saucie Berry Wine!                         ', 9500, 'Available', '1598719775_4bRFG1X-red-wine-wallpaper.jpg'),
(24, NULL, 2, 'Inferium Wine', 'Drinks', 'The Inferium Wine                 ', 10000, 'Available', '1598719919_S2c742T-red-wine-wallpaper.jpg'),
(25, NULL, 2, 'G-Red', 'Drinks', 'The Best Don McDonalds Wine                   ', 6000, 'Available', '1598747305_pdm40aG-red-wine-wallpaper.jpg'),
(26, 3, NULL, 'Fire Frost', 'Drinks', 'The fire frost italian wine                      ', 9500, 'Available', '1598801583_ztzH27M-red-wine-wallpaper.jpg'),
(27, NULL, 3, 'Hyper', 'Drinks', 'The Hyper Wine                        ', 8000, 'Available', '1598866979_IKobaJ0-red-wine-wallpaper.jpg'),
(28, NULL, 3, 'Cirflu Wine', 'Drinks', 'Californian Best Juicy Wine. Non-Alcoholic                 ', 10000, 'Available', '1598867189_hfpe9TT-red-wine-wallpaper.jpg'),
(29, NULL, 3, 'Lunchy Cake', 'Lunch', 'Lunchy Cake                         ', 3700, 'Available', '1598867396_350x220 (1).png'),
(30, NULL, 3, 'Combinia', 'Dinner', 'The Combinia Dinner Meal!                     ', 2700, 'Available', '1598867549_alexander-mils-5X8oLkzZ1fI-unsplash.jpg'),
(31, NULL, 2, 'Vegg', 'Breakfast', 'Vegg Breakfast Meal                              ', 3700, 'Available', '1599679777_chicken-soup-vegetables-plate-spoon-food-41155-thumb.jpeg'),
(32, NULL, 2, 'Inferium Mixia Choppy', 'Dinner', 'Inferium Mixia Choppy          ', 10000, 'Available', '1598878565_bg-17.jpg'),
(33, NULL, 2, 'Pancake Honey', 'Breakfast', 'Pancake Honey                              ', 1500, 'Available', '1599680209_pancake-honey-strawberries-fruits-dessert-raspberries-food-41081-thumb - Copy - Copy.jpeg'),
(34, NULL, 2, 'Chinese Chop Chop', 'Breakfast', 'Chinese Chop Chop                              ', 3700, 'Available', '1599680151_amirali-mirhashemian-v2z6Yhp_6Gc-unsplash.jpg'),
(35, NULL, 2, 'Maltrom Wine', 'Drinks', 'The Maltrom Wine                      ', 700, 'Available', '1598911578_T9pEkKE-red-wine-wallpaper.jpg'),
(36, NULL, 2, 'Morning Indomie', 'Breakfast', 'Morning Indomie                              ', 2500, 'Available', '1599680085_aa (4).jpg'),
(37, NULL, 2, 'Sweetest Food', 'Breakfast', 'Sweetest Breakfast Food                             ', 5000, 'Available', '1599680041_aa (6).jpg'),
(38, NULL, 2, 'Strout', 'Breakfast', 'Strout Breakfast Meal                              ', 2000, 'Available', '1599679983_tth (3).jpg'),
(39, NULL, 2, 'Freezer Wine', 'Drinks', 'A very good wine                             ', 7500, 'Available', '1599577695_0m1bE2q-red-wine-wallpaper.jpg'),
(40, NULL, 3, 'Pancake Honey Strawberries', 'Lunch', 'A very good meal to light up your day!                           ', 3700, 'Available', '1599662295_pancake-honey-strawberries-fruits-dessert-raspberries-food-41081-thumb - Copy - Copy.jpeg'),
(41, NULL, 3, 'Pizza Baked Cheese Spicy', 'Lunch', 'Pizza Baked Cheese Spicy                              ', 6300, 'Available', '1599662626_pizza-baked-chesse-spicy-7t.jpg'),
(42, NULL, 3, 'Green Lunch', 'Lunch', 'Nice food                              ', 4200, 'Available', '1599662726_gettyimages-1018199524-2048x2048.jpg'),
(43, NULL, 3, 'The Red Plate Meal', 'Breakfast', 'Good breakfast meal                             ', 5000, 'Available', '1599663046_gettyimages-1131248644-2048x2048.jpg'),
(44, NULL, 3, 'Meal Meat', 'Breakfast', 'Very saucy                              ', 5900, 'Available', '1599663122_bg-14.jpg'),
(45, NULL, 3, 'Simply', 'Breakfast', 'Simply Breakfast Meal                              ', 7500, 'Available', '1599663184_ben-neale-cARNiGpmf70-unsplash.jpg'),
(46, NULL, 3, 'Raw Breakfast Meal', 'Breakfast', 'Raw Breakfast Meal                      ', 1200, 'Available', '1599663301_anna-pelzer-IGfIGP5ONV0-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_table_breakfast`
--

CREATE TABLE `order_table_breakfast` (
  `id` int(11) NOT NULL,
  `ref` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delivered` int(11) NOT NULL DEFAULT 0,
  `staff_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `delivery_address` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table_breakfast`
--

INSERT INTO `order_table_breakfast` (`id`, `ref`, `user_id`, `food_id`, `quantity`, `price`, `total_price`, `order_time`, `delivered`, `staff_id`, `admin_id`, `delivery_address`) VALUES
(1, 49409, 3, 1, 2, 600, 1200, '2020-09-08 13:48:01', 1, 2, NULL, NULL),
(2, 49409, 3, 2, 1, 650, 650, '2020-09-08 13:48:20', 1, 2, NULL, NULL),
(3, 49409, 3, 3, 3, 800, 2400, '2020-09-08 13:48:28', 1, 3, NULL, NULL),
(4, 49409, 3, 4, 2, 950, 1900, '2020-09-08 13:48:55', 1, 3, NULL, NULL),
(5, 49409, 3, 13, 1, 100, 100, '2020-09-08 13:20:38', 1, 2, NULL, NULL),
(6, 49409, 3, 34, 1, 650, 650, '2020-09-08 13:20:45', 1, 2, NULL, NULL),
(7, 49409, 3, 37, 1, 650, 650, '2020-09-08 13:23:13', 1, 3, NULL, NULL),
(17, 47925, 6, 1, 1, 600, 600, '2020-09-09 13:11:31', 1, 2, NULL, NULL),
(18, 47925, 6, 2, 1, 650, 650, '2020-09-12 20:51:01', 1, 1, NULL, NULL),
(19, 47925, 6, 3, 3, 800, 2400, '2020-09-09 21:21:00', 1, 2, NULL, NULL),
(20, 47925, 6, 36, 1, 400, 400, '2020-09-09 21:21:06', 1, 2, NULL, NULL),
(21, 47925, 6, 37, 1, 650, 650, '2020-09-12 20:49:31', 1, 1, NULL, NULL),
(22, 26233, 6, 13, 1, 100, 100, '2020-09-12 20:50:13', 1, 1, NULL, NULL),
(23, 26233, 6, 31, 1, 500, 500, '2020-09-28 16:01:11', 1, 3, NULL, NULL),
(24, 35291, 9, 4, 1, 15000, 15000, '2020-09-12 20:49:43', 1, 1, NULL, NULL),
(25, 35291, 9, 3, 2, 4000, 8000, '2020-09-14 11:41:55', 1, 1, 3, NULL),
(26, 35291, 9, 36, 3, 2500, 7500, '2020-10-10 17:25:46', 1, 2, 3, NULL),
(27, 61186, 9, 1, 1, 1500, 1500, '2020-09-14 11:42:09', 1, 2, 3, NULL),
(28, 5279, 6, 31, 1, 3700, 3700, '2020-09-11 13:46:07', 1, 2, NULL, NULL),
(29, 5279, 6, 2, 1, 2300, 2300, '2020-10-10 17:25:34', 1, 2, NULL, NULL),
(30, 5279, 6, 3, 2, 4000, 8000, '2020-09-17 16:56:06', 1, 2, NULL, NULL),
(31, 41127, 4, 2, 1, 2300, 2300, '2020-09-12 20:48:53', 1, 1, NULL, NULL),
(32, 41127, 4, 3, 1, 4000, 4000, '2020-09-12 20:49:01', 1, 1, NULL, NULL),
(33, 41127, 4, 4, 1, 15000, 15000, '2020-09-12 20:49:07', 1, 1, NULL, NULL),
(34, 41127, 4, 13, 1, 3000, 3000, '2020-09-28 09:04:57', 1, 3, NULL, NULL),
(35, 66560, 3, 1, 1, 1500, 1500, '2020-09-16 21:55:57', 1, 2, NULL, NULL),
(36, 66560, 3, 2, 1, 2300, 2300, '2020-10-01 13:05:53', 1, 3, NULL, NULL),
(37, 66560, 3, 4, 1, 15000, 15000, '2020-09-28 16:00:04', 1, 3, NULL, NULL),
(38, 41409, 4, 4, 1, 15000, 15000, '2020-09-18 16:50:45', 1, 2, NULL, NULL),
(39, 41409, 4, 36, 1, 2500, 2500, '2020-10-10 17:25:21', 1, 2, NULL, NULL),
(40, 10911, 4, 4, 1, 15000, 15000, '2020-09-28 15:59:57', 1, 3, NULL, 'ValueBeam Makurdi'),
(41, 10911, 4, 36, 1, 2500, 2500, '2020-09-28 15:59:51', 1, 3, NULL, 'ValueBeam Makurdi'),
(42, 67344, 10, 13, 1, 3000, 3000, '2020-09-18 16:50:18', 1, 2, NULL, 'ValueBeam Makurdi'),
(43, 67344, 10, 37, 1, 5000, 5000, '2020-09-17 16:55:25', 1, 2, NULL, 'ValueBeam Makurdi'),
(44, 26520, 10, 13, 1, 3000, 3000, '2020-09-18 16:50:10', 1, 2, NULL, NULL),
(45, 26520, 10, 37, 1, 5000, 5000, '2020-09-18 16:50:32', 1, 2, NULL, NULL),
(46, 81183, 10, 13, 1, 3000, 3000, '2020-09-17 16:55:18', 1, 2, NULL, 'ValueBeam Makurdi'),
(47, 81183, 10, 37, 1, 5000, 5000, '2020-09-17 16:55:51', 1, 2, NULL, 'ValueBeam Makurdi'),
(48, 3122, 10, 13, 1, 3000, 3000, '2020-09-16 21:32:19', 0, NULL, NULL, 'ValueBeam Makurdi'),
(49, 3122, 10, 37, 1, 5000, 5000, '2020-09-28 15:59:43', 1, 3, NULL, 'ValueBeam Makurdi'),
(50, 94657, 10, 13, 1, 3000, 3000, '2020-09-18 16:50:01', 1, 2, NULL, 'ValueBeam Makurdi'),
(51, 59742, 7, 43, 1, 5000, 5000, '2020-10-14 07:25:49', 1, 2, NULL, 'Federal University of Agriculture Makurdi'),
(52, 59742, 7, 38, 1, 2000, 2000, '2020-09-20 21:17:40', 1, 2, NULL, 'Federal University of Agriculture Makurdi'),
(53, 40542, 6, 31, 1, 3700, 3700, '2020-10-11 21:48:51', 1, 4, NULL, 'Federal University of Agriculture Makurdi'),
(54, 92707, 12, 43, 1, 5000, 5000, '2020-10-13 14:35:10', 1, 2, NULL, 'North Bank Makurdi'),
(55, 2982, 13, 31, 1, 3700, 3700, '2020-09-28 15:57:51', 1, 3, NULL, ''),
(56, 2982, 13, 3, 1, 4000, 4000, '2020-09-20 21:09:59', 1, 2, NULL, ''),
(57, 85526, 12, 3, 1, 4000, 4000, '2020-09-28 15:59:33', 1, 3, NULL, ''),
(58, 85526, 12, 36, 1, 2500, 2500, '2020-09-28 15:59:24', 1, 3, NULL, ''),
(59, 94085, 12, 31, 1, 3700, 3700, '2020-09-28 15:59:17', 1, 3, NULL, 'ValueBeam Makurdi'),
(60, 94085, 12, 4, 1, 15000, 15000, '2020-09-28 15:58:00', 1, 3, NULL, 'ValueBeam Makurdi'),
(61, 73561, 13, 1, 1, 1500, 1500, '2020-10-14 07:12:11', 1, 2, NULL, 'Main Island Lagos'),
(62, 49421, 7, 1, 1, 1500, 1500, '2020-10-14 07:17:23', 1, 3, NULL, 'Federal University of Agric'),
(63, 49421, 7, 31, 1, 3700, 3700, '2020-10-14 07:17:23', 1, 3, NULL, 'Federal University of Agric'),
(64, 60064, 12, 2, 1, 2300, 2300, '2020-12-02 13:18:02', 1, 2, NULL, ''),
(65, 60064, 12, 3, 1, 4000, 4000, '2020-12-02 13:18:02', 1, 2, NULL, ''),
(66, 60064, 12, 1, 1, 1500, 1500, '2020-12-02 13:18:02', 1, 2, NULL, ''),
(67, 22704, 3, 13, 1, 3000, 3000, '2020-12-02 13:15:04', 0, NULL, NULL, 'Bishop Murray Medical Centre, Makurdi'),
(68, 22704, 3, 2, 1, 2300, 2300, '2020-12-02 13:15:04', 0, NULL, NULL, 'Bishop Murray Medical Centre, Makurdi'),
(69, 22704, 3, 1, 1, 1500, 1500, '2020-12-02 13:15:04', 0, NULL, NULL, 'Bishop Murray Medical Centre, Makurdi'),
(70, 22704, 3, 3, 1, 4000, 4000, '2020-12-02 13:15:04', 0, NULL, NULL, 'Bishop Murray Medical Centre, Makurdi');

-- --------------------------------------------------------

--
-- Table structure for table `order_table_dinner`
--

CREATE TABLE `order_table_dinner` (
  `id` int(11) NOT NULL,
  `ref` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delivered` int(11) NOT NULL DEFAULT 0,
  `staff_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `delivery_address` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table_dinner`
--

INSERT INTO `order_table_dinner` (`id`, `ref`, `user_id`, `food_id`, `quantity`, `price`, `total_price`, `order_time`, `delivered`, `staff_id`, `admin_id`, `delivery_address`) VALUES
(8, 57223, 4, 10, 1, 650, 650, '2020-09-08 14:45:04', 1, 3, NULL, NULL),
(9, 57223, 4, 11, 2, 250, 500, '2020-09-08 14:01:59', 1, 2, NULL, NULL),
(10, 57223, 4, 12, 2, 650, 1300, '2020-09-08 14:45:27', 1, 1, NULL, NULL),
(11, 57223, 4, 15, 2, 400, 800, '2020-09-09 21:20:45', 1, 2, NULL, NULL),
(12, 57857, 3, 32, 1, 1000, 1000, '2020-09-08 14:02:10', 1, 2, NULL, NULL),
(13, 57857, 3, 11, 1, 250, 250, '2020-09-08 14:02:17', 1, 2, NULL, NULL),
(14, 57857, 3, 12, 1, 650, 650, '2020-09-09 21:21:37', 1, 2, NULL, NULL),
(15, 57857, 3, 10, 1, 650, 650, '2020-09-08 14:02:23', 1, 2, NULL, NULL),
(16, 96325, 6, 32, 1, 1000, 1000, '2020-09-12 20:49:55', 1, 1, NULL, NULL),
(17, 40923, 9, 10, 2, 6500, 13000, '2020-09-11 13:46:40', 1, 2, NULL, NULL),
(18, 40923, 9, 11, 1, 2500, 2500, '2020-09-12 20:51:01', 1, 1, NULL, NULL),
(19, 60560, 6, 10, 1, 6500, 6500, '2020-09-11 13:46:47', 1, 2, NULL, NULL),
(20, 60560, 6, 11, 1, 2500, 2500, '2020-09-11 13:47:00', 1, 2, NULL, NULL),
(21, 60560, 6, 12, 1, 3650, 3650, '2020-09-12 20:49:31', 1, 1, NULL, NULL),
(22, 42886, 4, 30, 1, 2700, 2700, '2020-09-12 20:50:13', 1, 1, NULL, NULL),
(23, 42886, 4, 11, 1, 2500, 2500, '2020-09-28 16:01:11', 1, 3, NULL, NULL),
(24, 42886, 4, 10, 1, 6500, 6500, '2020-09-12 20:49:43', 1, 1, NULL, NULL),
(25, 42886, 4, 12, 1, 3650, 3650, '2020-09-14 11:41:55', 1, 1, 3, NULL),
(26, 45381, 3, 12, 1, 3650, 3650, '2020-10-10 17:25:46', 1, 2, NULL, 'Federal University of Agriculture Makurdi'),
(27, 45381, 3, 32, 1, 1000, 1000, '2020-10-10 17:25:59', 1, 2, NULL, 'Federal University of Agriculture Makurdi'),
(28, 76120, 3, 12, 1, 3650, 3650, '2020-10-10 17:25:15', 1, 2, NULL, 'Federal University of Agriculture Makurdi'),
(29, 76120, 3, 32, 1, 1000, 1000, '2020-10-10 17:25:34', 1, 2, NULL, 'Federal University of Agriculture Makurdi'),
(30, 16379, 6, 10, 1, 6500, 6500, '2020-09-17 16:56:06', 1, 2, NULL, 'ValueBeam Makurdi'),
(31, 54075, 5, 30, 1, 2700, 2700, '2020-10-14 07:26:44', 1, 2, NULL, 'Behind Kyabiz Hotel Judges Quarters'),
(32, 54075, 5, 11, 1, 2500, 2500, '2020-10-14 07:26:44', 1, 2, NULL, 'Behind Kyabiz Hotel Judges Quarters'),
(33, 54075, 5, 12, 1, 3650, 3650, '2020-10-14 07:26:44', 1, 2, NULL, 'Behind Kyabiz Hotel Judges Quarters'),
(34, 43154, 14, 11, 3, 2500, 7500, '2020-09-28 09:04:57', 1, 3, NULL, ''),
(35, 43154, 14, 10, 1, 6500, 6500, '2020-10-11 22:00:35', 1, 3, NULL, ''),
(36, 52211, 12, 32, 1, 10000, 10000, '2020-10-01 13:05:53', 1, 3, NULL, 'Federal University of Agriculture Makurdi'),
(37, 94627, 3, 42, 1, 4200, 4200, '2020-09-28 16:00:04', 1, 3, NULL, 'ValueBeam Makurdi'),
(38, 63269, 7, 11, 1, 2500, 2500, '2020-10-11 21:51:37', 1, 4, NULL, ''),
(39, 63269, 7, 12, 1, 3650, 3650, '2020-10-11 21:51:37', 1, 4, NULL, ''),
(40, 69779, 12, 11, 1, 2500, 2500, '2020-10-11 21:24:08', 0, NULL, NULL, 'North Bank Makurdi'),
(41, 69779, 12, 32, 1, 10000, 10000, '2020-10-11 21:24:08', 0, NULL, NULL, 'North Bank Makurdi'),
(42, 82870, 5, 30, 1, 2700, 2700, '2020-10-13 14:39:17', 1, 3, NULL, 'Behind Kyabiz Hotel Judges Quarters'),
(43, 82870, 5, 11, 1, 2500, 2500, '2020-10-13 14:39:17', 1, 3, NULL, 'Behind Kyabiz Hotel Judges Quarters'),
(44, 82870, 5, 15, 1, 4000, 4000, '2020-10-13 14:39:17', 1, 3, NULL, 'Behind Kyabiz Hotel Judges Quarters'),
(45, 16200, 7, 11, 1, 2500, 2500, '2020-10-14 13:09:16', 0, NULL, NULL, 'Federal University of Agric'),
(46, 16200, 7, 12, 1, 3650, 3650, '2020-10-14 13:09:16', 0, NULL, NULL, 'Federal University of Agric'),
(47, 60207, 3, 11, 1, 2500, 2500, '2020-10-15 19:44:24', 1, 2, NULL, 'ValueBeam Ltd'),
(48, 60207, 3, 12, 1, 3650, 3650, '2020-10-15 19:44:24', 1, 2, NULL, 'ValueBeam Ltd'),
(49, 72901, 3, 11, 1, 2500, 2500, '2021-02-12 20:51:06', 0, NULL, NULL, 'Temfest Hostel UAM'),
(50, 60066, 7, 12, 1, 3650, 3650, '2021-09-18 17:12:42', 0, NULL, NULL, 'Temfest Hostel UAM'),
(51, 60066, 7, 32, 1, 10000, 10000, '2021-09-18 17:12:42', 0, NULL, NULL, 'Temfest Hostel UAM'),
(52, 56948, 7, 11, 2, 2500, 5000, '2022-02-24 20:28:39', 1, 1, NULL, 'Federal University Agriculture, Makurdi '),
(53, 56948, 7, 32, 1, 10000, 10000, '2022-02-24 20:28:39', 1, 1, NULL, 'Federal University Agriculture, Makurdi ');

-- --------------------------------------------------------

--
-- Table structure for table `order_table_drinks`
--

CREATE TABLE `order_table_drinks` (
  `id` int(11) NOT NULL,
  `ref` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delivered` int(11) NOT NULL DEFAULT 0,
  `staff_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `delivery_address` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table_drinks`
--

INSERT INTO `order_table_drinks` (`id`, `ref`, `user_id`, `food_id`, `quantity`, `price`, `total_price`, `order_time`, `delivered`, `staff_id`, `admin_id`, `delivery_address`) VALUES
(7, 38104, 4, 24, 2, 1000, 2000, '2020-09-08 13:23:13', 1, 3, NULL, NULL),
(8, 38104, 4, 19, 2, 1000, 2000, '2020-09-08 14:47:07', 1, 1, NULL, NULL),
(9, 38104, 4, 20, 2, 800, 1600, '2020-09-08 14:01:59', 1, 2, NULL, NULL),
(10, 38104, 4, 23, 1, 950, 950, '2020-09-08 14:47:18', 1, 3, NULL, NULL),
(11, 55412, 3, 27, 1, 800, 800, '2020-09-09 21:20:45', 1, 2, NULL, NULL),
(12, 5711, 6, 28, 2, 10000, 20000, '2020-09-09 21:20:52', 1, 2, NULL, NULL),
(13, 5711, 6, 24, 1, 10000, 10000, '2020-09-09 21:21:23', 1, 2, NULL, NULL),
(14, 5711, 6, 26, 1, 9500, 9500, '2020-09-09 21:21:37', 1, 2, NULL, NULL),
(15, 5711, 6, 39, 1, 7500, 7500, '2020-09-09 21:21:31', 1, 2, NULL, NULL),
(16, 17385, 4, 19, 1, 10000, 10000, '2020-09-12 20:49:55', 1, 1, NULL, NULL),
(17, 17385, 4, 26, 1, 9500, 9500, '2020-09-11 13:46:41', 1, 2, NULL, NULL),
(18, 17385, 4, 20, 2, 8000, 16000, '2020-09-12 20:51:01', 1, 1, NULL, NULL),
(19, 60229, 6, 24, 1, 10000, 10000, '2020-09-11 13:46:47', 1, 2, NULL, NULL),
(20, 60229, 6, 23, 1, 9500, 9500, '2020-09-11 13:47:01', 1, 2, NULL, NULL),
(21, 60229, 6, 28, 1, 10000, 10000, '2020-09-12 20:49:31', 1, 1, NULL, NULL),
(22, 34498, 4, 19, 1, 10000, 10000, '2020-09-12 20:50:13', 1, 1, NULL, NULL),
(23, 34498, 4, 23, 1, 9500, 9500, '2020-09-28 16:01:11', 1, 3, NULL, NULL),
(24, 34498, 4, 25, 1, 6000, 6000, '2020-09-12 20:49:43', 1, 1, NULL, NULL),
(25, 60599, 10, 19, 1, 10000, 10000, '2020-10-11 21:53:46', 1, 4, NULL, NULL),
(26, 60599, 10, 23, 1, 9500, 9500, '2020-10-11 21:53:46', 1, 4, NULL, NULL),
(27, 25486, 3, 20, 1, 8000, 8000, '2020-10-10 17:25:59', 1, 2, NULL, 'ValueBeam Makurdi'),
(28, 25486, 3, 23, 1, 9500, 9500, '2020-10-10 17:25:15', 1, 2, NULL, 'ValueBeam Makurdi'),
(29, 25486, 3, 24, 1, 10000, 10000, '2020-10-10 17:25:35', 1, 2, NULL, 'ValueBeam Makurdi'),
(30, 13575, 3, 19, 1, 10000, 10000, '2020-09-17 16:56:06', 1, 2, NULL, 'ValueBeam Makurdi'),
(31, 43704, 6, 23, 1, 9500, 9500, '2020-09-16 23:18:07', 0, NULL, NULL, 'Blue Roof Opposite CASE FUAM'),
(32, 30209, 12, 24, 1, 10000, 10000, '2020-09-26 15:59:35', 0, NULL, NULL, ''),
(33, 30209, 12, 26, 1, 9500, 9500, '2020-09-26 15:59:35', 0, NULL, NULL, ''),
(34, 55648, 3, 24, 1, 10000, 10000, '2020-09-28 09:04:58', 1, 3, NULL, 'ValueBeam Company Ltd Makurdi'),
(35, 80380, 3, 19, 1, 10000, 10000, '2020-09-28 12:03:14', 0, NULL, NULL, 'ValueBeam Makurdi'),
(36, 18257, 13, 19, 1, 10000, 10000, '2020-10-01 13:05:53', 1, 3, NULL, 'Federal University of Agriculture Makurdi'),
(37, 11412, 7, 20, 1, 8000, 8000, '2021-04-26 14:02:33', 1, 2, NULL, 'Federal University of Agric'),
(38, 11412, 7, 23, 1, 9500, 9500, '2021-04-26 14:02:33', 1, 2, NULL, 'Federal University of Agric'),
(39, 763, 4, 19, 1, 10000, 10000, '2020-10-11 22:00:08', 1, 3, NULL, 'Bishop Murray Medical Centre, Makurdi'),
(40, 763, 4, 23, 1, 9500, 9500, '2020-10-11 22:00:08', 1, 3, NULL, 'Bishop Murray Medical Centre, Makurdi'),
(41, 763, 4, 20, 1, 8000, 8000, '2020-10-11 22:00:08', 1, 3, NULL, 'Bishop Murray Medical Centre, Makurdi'),
(42, 763, 4, 25, 1, 6000, 6000, '2020-10-11 22:00:08', 1, 3, NULL, 'Bishop Murray Medical Centre, Makurdi'),
(43, 65047, 3, 19, 2, 10000, 20000, '2020-11-16 12:07:52', 0, NULL, NULL, 'ValueBeam Ltd'),
(44, 65047, 3, 20, 1, 8000, 8000, '2020-11-16 12:07:52', 0, NULL, NULL, 'ValueBeam Ltd'),
(45, 25742, 7, 23, 1, 9500, 9500, '2022-01-27 20:33:36', 1, 1, NULL, 'Federal University Agriculture, Makurdi '),
(46, 25742, 7, 24, 2, 10000, 20000, '2022-01-27 20:33:36', 1, 1, NULL, 'Federal University Agriculture, Makurdi '),
(47, 25742, 7, 35, 1, 700, 700, '2022-01-27 20:33:36', 1, 1, NULL, 'Federal University Agriculture, Makurdi ');

-- --------------------------------------------------------

--
-- Table structure for table `order_table_lunch`
--

CREATE TABLE `order_table_lunch` (
  `id` int(11) NOT NULL,
  `ref` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delivered` int(11) NOT NULL DEFAULT 0,
  `staff_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `delivery_address` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table_lunch`
--

INSERT INTO `order_table_lunch` (`id`, `ref`, `user_id`, `food_id`, `quantity`, `price`, `total_price`, `order_time`, `delivered`, `staff_id`, `admin_id`, `delivery_address`) VALUES
(5, 46944, 4, 5, 5, 400, 2000, '2020-09-08 13:20:38', 1, 2, NULL, NULL),
(6, 46944, 4, 6, 2, 650, 1300, '2020-09-08 13:54:35', 1, 2, NULL, NULL),
(7, 43096, 3, 5, 2, 400, 800, '2020-09-08 13:23:13', 1, 3, NULL, NULL),
(8, 43096, 3, 6, 1, 650, 650, '2020-09-08 13:54:26', 1, 3, NULL, NULL),
(9, 43096, 3, 8, 1, 400, 400, '2020-09-08 14:01:59', 1, 2, NULL, NULL),
(10, 43096, 3, 9, 1, 800, 800, '2020-09-08 14:47:42', 1, 3, NULL, NULL),
(11, 82515, 3, 9, 1, 2800, 2800, '2020-09-09 21:20:45', 1, 2, NULL, NULL),
(12, 82515, 3, 5, 1, 1400, 1400, '2020-09-09 21:20:52', 1, 2, NULL, NULL),
(13, 82515, 3, 7, 1, 2650, 2650, '2020-09-09 21:21:23', 1, 2, NULL, NULL),
(14, 82515, 3, 29, 1, 3700, 3700, '2020-09-09 21:21:37', 1, 2, NULL, NULL),
(15, 75763, 6, 5, 1, 1400, 1400, '2020-09-11 13:46:35', 1, 2, NULL, NULL),
(16, 75763, 6, 6, 1, 1650, 1650, '2020-09-12 20:49:55', 1, 1, NULL, NULL),
(17, 79880, 6, 42, 1, 4200, 4200, '2020-09-11 13:46:40', 1, 2, NULL, NULL),
(18, 79880, 6, 5, 1, 1400, 1400, '2020-09-12 20:51:01', 1, 1, NULL, NULL),
(19, 79880, 6, 9, 1, 2800, 2800, '2020-09-11 13:46:47', 1, 2, NULL, NULL),
(20, 79880, 6, 41, 1, 6300, 6300, '2020-09-11 13:47:00', 1, 2, NULL, NULL),
(21, 71837, 4, 8, 1, 4000, 4000, '2020-09-12 20:49:31', 1, 1, NULL, NULL),
(22, 71837, 4, 6, 1, 1650, 1650, '2020-09-12 20:50:13', 1, 1, NULL, NULL),
(23, 71837, 4, 5, 1, 1400, 1400, '2020-09-28 16:01:11', 1, 3, NULL, NULL),
(24, 71837, 4, 7, 1, 2650, 2650, '2020-09-12 20:49:43', 1, 1, NULL, NULL),
(25, 44404, 10, 29, 1, 3700, 3700, '2020-09-14 11:41:55', 1, NULL, 3, NULL),
(26, 44404, 10, 8, 1, 4000, 4000, '2020-10-10 17:25:46', 1, 2, 3, NULL),
(27, 44404, 10, 9, 1, 2800, 2800, '2020-10-10 17:25:59', 1, 2, 3, NULL),
(28, 1702, 4, 42, 1, 4200, 4200, '2020-10-10 17:25:15', 1, 2, NULL, NULL),
(29, 1702, 4, 5, 1, 1400, 1400, '2020-10-10 17:25:34', 1, 2, NULL, NULL),
(30, 1702, 4, 7, 1, 2650, 2650, '2020-09-17 16:56:06', 1, 2, NULL, NULL),
(31, 15140, 4, 42, 1, 4200, 4200, '2020-09-16 22:07:24', 0, NULL, NULL, 'Maafs Extension South Core FUAM'),
(32, 15140, 4, 5, 1, 1400, 1400, '2020-09-16 22:07:24', 0, NULL, NULL, 'Maafs Extension South Core FUAM'),
(33, 15140, 4, 7, 1, 2650, 2650, '2020-09-16 22:07:24', 0, NULL, NULL, 'Maafs Extension South Core FUAM'),
(34, 93968, 6, 41, 1, 6300, 6300, '2020-09-28 09:04:57', 1, 3, NULL, 'Federal University of Agriculture Makurdi'),
(35, 46263, 12, 8, 1, 4000, 4000, '2020-10-14 07:29:06', 1, 2, NULL, 'Federal University of Agriculture Makurdi'),
(36, 34899, 12, 5, 1, 1400, 1400, '2020-10-01 13:05:53', 1, 3, NULL, 'ValueBeam Makurdi'),
(37, 51506, 6, 29, 1, 3700, 3700, '2020-10-14 07:28:48', 1, 2, NULL, ''),
(38, 51506, 6, 6, 1, 1650, 1650, '2020-10-14 07:28:48', 1, 2, NULL, ''),
(39, 2880, 6, 29, 1, 3700, 3700, '2020-10-10 17:25:21', 1, 2, NULL, ''),
(40, 2880, 6, 6, 1, 1650, 1650, '2020-09-28 15:59:57', 1, 3, NULL, ''),
(41, 90977, 6, 29, 1, 3700, 3700, '2020-11-16 11:54:03', 1, 2, NULL, ''),
(42, 90977, 6, 6, 1, 1650, 1650, '2020-11-16 11:54:03', 1, 2, NULL, ''),
(43, 42596, 6, 8, 1, 4000, 4000, '2020-09-28 08:53:12', 0, NULL, NULL, ''),
(44, 47245, 4, 41, 1, 6300, 6300, '2020-10-11 14:05:45', 1, 2, NULL, 'Bishop Murray Medical Centre, Makurdi'),
(45, 78907, 14, 40, 1, 3700, 3700, '2020-12-18 10:32:09', 1, 2, NULL, 'Federal University of Agriculture Makurdi'),
(46, 26689, 5, 40, 1, 3700, 3700, '2020-10-13 15:21:47', 1, 3, NULL, 'Behind Kyabiz Hotel Judges Quarters'),
(47, 26689, 5, 7, 1, 2650, 2650, '2020-10-13 15:21:47', 1, 3, NULL, 'Behind Kyabiz Hotel Judges Quarters'),
(48, 26689, 5, 5, 1, 1400, 1400, '2020-10-13 15:21:47', 1, 3, NULL, 'Behind Kyabiz Hotel Judges Quarters'),
(49, 26689, 5, 8, 1, 4000, 4000, '2020-10-13 15:21:47', 1, 3, NULL, 'Behind Kyabiz Hotel Judges Quarters'),
(50, 26745, 3, 42, 1, 4200, 4200, '2020-12-02 11:19:28', 0, NULL, NULL, 'Federal University of Agric'),
(51, 26745, 3, 6, 1, 1650, 1650, '2020-12-02 11:19:28', 0, NULL, NULL, 'Federal University of Agric'),
(52, 26745, 3, 7, 1, 2650, 2650, '2020-12-02 11:19:28', 0, NULL, NULL, 'Federal University of Agric'),
(53, 86451, 3, 5, 1, 1400, 1400, '2020-12-09 12:56:10', 0, NULL, NULL, 'North Bank Makurdi'),
(54, 86451, 3, 9, 1, 2800, 2800, '2020-12-09 12:56:10', 0, NULL, NULL, 'North Bank Makurdi'),
(55, 86451, 3, 42, 1, 4200, 4200, '2020-12-09 12:56:10', 0, NULL, NULL, 'North Bank Makurdi'),
(56, 41899, 7, 6, 1, 1650, 1650, '2021-04-26 14:00:56', 0, NULL, NULL, 'Temfest Hostel UAM'),
(57, 41899, 7, 7, 1, 2650, 2650, '2021-04-26 14:00:56', 0, NULL, NULL, 'Temfest Hostel UAM'),
(58, 50024, 3, 6, 1, 1650, 1650, '2021-08-08 10:30:07', 0, NULL, NULL, ''),
(59, 50024, 3, 41, 2, 6300, 12600, '2021-08-08 10:30:07', 0, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `staff_table`
--

CREATE TABLE `staff_table` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telephone` varchar(80) DEFAULT NULL,
  `rel_status` varchar(100) DEFAULT NULL,
  `gender` enum('F','M') DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `role` varchar(40) NOT NULL DEFAULT 'staff',
  `status` int(11) NOT NULL DEFAULT 1,
  `SALARY` bigint(80) NOT NULL DEFAULT 45000,
  `profileimage` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_table`
--

INSERT INTO `staff_table` (`id`, `name`, `email`, `password`, `telephone`, `rel_status`, `gender`, `address`, `dob`, `role`, `status`, `SALARY`, `profileimage`) VALUES
(1, 'staff', 'staff@gmail.com', '1253208465b1efa876f982d8a9e73eef', '+234-810-8629-535', 'Single', 'F', '123 Main Street Virginia', '2020-08-26', 'staff', 1, 45000, '1598435786_chef.png'),
(2, 'Saraphine', 'sarahedeh@gmail.com', '58ed185d33725fcd178867ec00e1d4aa', '07067446460', 'Married', 'F', 'North Bank Makurdi', '1999-09-13', 'staff', 1, 45000, '1601306226_Saraphine.png'),
(3, 'Ella', 'ahulaella@gmail.com', '480859f57869e8754ec25951c0a59a8e', '+234-0000-000-0000', 'Single', 'F', 'Api Makurdi Benue State', '2002-12-23', 'staff', 1, 45000, '1598801123_IMG_20190827_112039_471.jpg'),
(4, 'Mercy', 'mercystephen@gmail.com', '994ea83e8ed26cf85a27f013ed261afb', '08050316332', 'Engaged', 'F', 'Federal University of Agriculture Makurdi', '1999-12-01', 'staff', 1, 45000, '1600363060_IMG_20200719_085623_577.jpg'),
(5, 'Rolex', 'agajirobert@gmail.com', '684c851af59965b680086b7b4896ff98', '', 'Engaged', 'M', 'Federal University of Agriculture Makurdi', '0000-00-00', 'staff', 1, 45000, '1601395345_IMG-20200123-WA0000.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('admin','super_admin','staff','super_staff','customer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '1253208465b1efa876f982d8a9e73eef', 'super_admin'),
(2, 'Queenie', 'aliconfidence@gmail.com', '58ed185d33725fcd178867ec00e1d4aa', 'super_admin'),
(3, 'Prettymama', 'agenatonkeziah@gmail.com', 'cba994d135934946e899a3b0309ffc9d', 'admin'),
(4, 'Chocho', 'chochomayoki@gmail.com', 'cb3cf324f6062aacfd485f1b17ec6070', 'admin'),
(8, 'staff', 'staff@gmail.com', '1253208465b1efa876f982d8a9e73eef', 'staff'),
(9, 'Saraphine', 'sarahedeh@gmail.com', '58ed185d33725fcd178867ec00e1d4aa', 'staff'),
(10, 'Ella', 'ahulaella@gmail.com', '480859f57869e8754ec25951c0a59a8e', 'staff'),
(11, 'Mercy', 'mercystephen@gmail.com', '994ea83e8ed26cf85a27f013ed261afb', 'staff'),
(15, 'Ecady', 'peverluper@gmail.com', '3cc75deb5eb94efa3b51242a3f660959', 'customer'),
(16, 'Shidoon', 'shidoonmercy@gmail.com', '4c915782cdddcafd534f2cc379176809', 'customer'),
(17, 'Angel', 'babyangel@gmail.com', 'f4f068e71e0d87bf0ad51e6214ab84e9', 'customer'),
(18, 'Kingdom', 'tartorkingdom@gmail.com', 'dc420563e5dd1c2f8f04c3e08993e948', 'customer'),
(19, 'Bella', 'christybella@gmail.com', 'e7e9ec3723447a642f762b2b6a15cfd7', 'customer'),
(20, 'wisdom', 'fab@gmail.com', 'f1f0081ae47118184909ef6b59be623f', 'customer'),
(21, 'Enapeh', 'gabrieljen@gmail.com', '1660fe5c81c4ce64a2611494c439e1ba', 'customer'),
(22, 'Trey', 'ahortrey@gmail.com', 'cbacbe1f0ca09bd50da766aba87a40bf', 'customer'),
(23, 'Trey', 'ahorsark@gmail.com', 'dd81a417012fb55d97a34a614be07f45', 'customer'),
(24, 'Quin Bliss', 'quinbliss@gmail.com', '2ccd89b67324dd915dd2d286f613332e', 'customer'),
(25, 'Ava', 'nyiishitimothy@gmail.com', 'ecb97d53d2d35b8ba98cf82a8d78cad9', 'customer'),
(26, 'Currency', 'currency@gmail.com', '6c84cbd30cf9350a990bad2bcc1bec5f', 'customer'),
(30, 'Rolex', 'agajirobert@gmail.com', '684c851af59965b680086b7b4896ff98', 'staff'),
(31, 'Queenie', 'ochanyaali2017@gmail.com', '6851434ca7db6f294e135ebdc0005e98', 'admin'),
(32, 'Cindy', 'cindy@gmail.com', 'cc4b2066cfef89f2475de1d4da4b29c7', 'admin'),
(33, 'Scarfy', 'scarfy@gmail.com', '151fa3c3ca57c94389a032c02507f330', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_order_table`
--
ALTER TABLE `assign_order_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `cart_breakfast`
--
ALTER TABLE `cart_breakfast`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_dinner`
--
ALTER TABLE `cart_dinner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_drinks`
--
ALTER TABLE `cart_drinks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_lunch`
--
ALTER TABLE `cart_lunch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_table`
--
ALTER TABLE `feedback_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `food_table`
--
ALTER TABLE `food_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `order_table_breakfast`
--
ALTER TABLE `order_table_breakfast`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `order_table_dinner`
--
ALTER TABLE `order_table_dinner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `order_table_drinks`
--
ALTER TABLE `order_table_drinks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `order_table_lunch`
--
ALTER TABLE `order_table_lunch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `staff_table`
--
ALTER TABLE `staff_table`
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
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `assign_order_table`
--
ALTER TABLE `assign_order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cart_breakfast`
--
ALTER TABLE `cart_breakfast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `cart_dinner`
--
ALTER TABLE `cart_dinner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `cart_drinks`
--
ALTER TABLE `cart_drinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `cart_lunch`
--
ALTER TABLE `cart_lunch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feedback_table`
--
ALTER TABLE `feedback_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `food_table`
--
ALTER TABLE `food_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `order_table_breakfast`
--
ALTER TABLE `order_table_breakfast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `order_table_dinner`
--
ALTER TABLE `order_table_dinner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `order_table_drinks`
--
ALTER TABLE `order_table_drinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `order_table_lunch`
--
ALTER TABLE `order_table_lunch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `staff_table`
--
ALTER TABLE `staff_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_order_table`
--
ALTER TABLE `assign_order_table`
  ADD CONSTRAINT `assign_order_table_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`id`),
  ADD CONSTRAINT `assign_order_table_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin_table` (`id`);

--
-- Constraints for table `cart_breakfast`
--
ALTER TABLE `cart_breakfast`
  ADD CONSTRAINT `cart_breakfast_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food_table` (`id`),
  ADD CONSTRAINT `cart_breakfast_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `customer_table` (`id`);

--
-- Constraints for table `cart_dinner`
--
ALTER TABLE `cart_dinner`
  ADD CONSTRAINT `cart_dinner_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food_table` (`id`),
  ADD CONSTRAINT `cart_dinner_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `customer_table` (`id`);

--
-- Constraints for table `cart_drinks`
--
ALTER TABLE `cart_drinks`
  ADD CONSTRAINT `cart_drinks_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food_table` (`id`),
  ADD CONSTRAINT `cart_drinks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `customer_table` (`id`);

--
-- Constraints for table `cart_lunch`
--
ALTER TABLE `cart_lunch`
  ADD CONSTRAINT `cart_lunch_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food_table` (`id`),
  ADD CONSTRAINT `cart_lunch_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `customer_table` (`id`);

--
-- Constraints for table `feedback_table`
--
ALTER TABLE `feedback_table`
  ADD CONSTRAINT `feedback_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer_table` (`id`);

--
-- Constraints for table `food_table`
--
ALTER TABLE `food_table`
  ADD CONSTRAINT `food_table_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`id`),
  ADD CONSTRAINT `food_table_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin_table` (`id`);

--
-- Constraints for table `order_table_breakfast`
--
ALTER TABLE `order_table_breakfast`
  ADD CONSTRAINT `order_table_breakfast_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer_table` (`id`),
  ADD CONSTRAINT `order_table_breakfast_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food_table` (`id`),
  ADD CONSTRAINT `order_table_breakfast_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`id`),
  ADD CONSTRAINT `order_table_breakfast_ibfk_4` FOREIGN KEY (`admin_id`) REFERENCES `admin_table` (`id`),
  ADD CONSTRAINT `order_table_breakfast_ibfk_5` FOREIGN KEY (`admin_id`) REFERENCES `admin_table` (`id`);

--
-- Constraints for table `order_table_dinner`
--
ALTER TABLE `order_table_dinner`
  ADD CONSTRAINT `order_table_dinner_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food_table` (`id`),
  ADD CONSTRAINT `order_table_dinner_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `customer_table` (`id`),
  ADD CONSTRAINT `order_table_dinner_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`id`),
  ADD CONSTRAINT `order_table_dinner_ibfk_4` FOREIGN KEY (`admin_id`) REFERENCES `admin_table` (`id`);

--
-- Constraints for table `order_table_drinks`
--
ALTER TABLE `order_table_drinks`
  ADD CONSTRAINT `order_table_drinks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer_table` (`id`),
  ADD CONSTRAINT `order_table_drinks_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food_table` (`id`),
  ADD CONSTRAINT `order_table_drinks_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`id`),
  ADD CONSTRAINT `order_table_drinks_ibfk_4` FOREIGN KEY (`admin_id`) REFERENCES `admin_table` (`id`);

--
-- Constraints for table `order_table_lunch`
--
ALTER TABLE `order_table_lunch`
  ADD CONSTRAINT `order_table_lunch_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer_table` (`id`),
  ADD CONSTRAINT `order_table_lunch_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food_table` (`id`),
  ADD CONSTRAINT `order_table_lunch_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`id`),
  ADD CONSTRAINT `order_table_lunch_ibfk_4` FOREIGN KEY (`admin_id`) REFERENCES `admin_table` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
