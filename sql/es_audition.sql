-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2018 at 06:19 PM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `es_audition`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `cart_hash` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `cart_hash` varchar(255) NOT NULL,
  `timecode` varchar(12) NOT NULL,
  `cash_value` float(11,2) NOT NULL,
  `tax_value` float(11,2) NOT NULL,
  `dicounts_value` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(7000) NOT NULL,
  `product_sku` varchar(500) NOT NULL,
  `base_price` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_description`, `product_sku`, `base_price`) VALUES
(1, 'Cloaking Device', 'Worried about detection on your covert mission? Confuse mission-threatening forces with this cloaking device. Powerful new features include string-activated pre-programmed phrases such as \"Danger! Danger!\", \"Reach for the sky!\", and other anti-enemy expressions. Hyper-reactive karate chop action deters even the most persistent villain.', 'dk14', 59.99),
(2, 'Umbrella Rocket', 'Looks like an ordinary bumbershoot, but don\'t be fooled! Simply place Rain Racer\'s tip on the ground and press the release latch. Within seconds, this ordinary rain umbrella converts into a two-wheeled gas-powered mini-scooter. Goes from 0 to 60 in 7.5 seconds - even in a driving rain! Comes in black, blue, and candy-apple red.', 'n31', 199.99),
(3, 'Edible Tape', 'The latest in personal survival gear, the STKY1 looks like a roll of ordinary office tape, but can save your life in an emergency.  Just remove the tape roll and place in a kettle of boiling water with mixed vegetables and a ham shank. In just 90 minutes you have a great tasking soup that really sticks to your ribs! Herbs and spices not included.', 'dk15', 12.99),
(4, 'Escape Vehicle (Air)', 'In a jam, need a quick escape? Just whip out a sheet of our patented P38 paper and, with a few quick folds, it converts into a lighter-than-air escape vehicle! Especially effective on windy days - no fuel required. Comes in several sizes including letter, legal, A10, and B52.', 'p38', 29.99),
(5, 'Extracting Tool', 'High-tech miniaturized extracting tool. Excellent for extricating foreign objects from your person. Good for picking up really tiny stuff, too! Cleverly disguised as a pair of tweezers. ', 'NOZ119', 199.99),
(6, 'Escape Vehicle (Water)', 'Camouflaged as stylish wing tips, these \'shoes\' get you out of a jam on the high seas instantly. exposed to water, the pair transforms into speedy miniature inflatable rafts. complete with 76 hp outboard motor, these hip heels will whisk you to safety even in the roughest of seas. warning: not recommended for beachwear.', 'PT109', 1299.99),
(7, 'Communications Device', 'Persuade anyone to see your point of view!  captivate your friends and enemies alike!  draw the crime-scene or map out the chain of events.  all you need is several years of training or copious amounts of natural talent. you\'re halfway there with the persuasive pencil. purchase this item with the retro pocket protector rocket pack for optimum disguise.', 'RED1', 81.99),
(8, 'Multi-Purpose Rubber Band', 'One of our most popular items!  A band of rubber that stretches  20 times the original size. Uses include silent one-to-one communication across a crowded room, holding together a pack of Persuasive Pencils, and powering lightweight aircraft. Beware, stretching past 20 feet results in a painful snap and a rubber strip.', 'NTMBS1', 299.99),
(9, 'Universal Repair System', 'Few people appreciate the awesome power contained in a single roll of duct tape. In fact, some houses in the Midwest are made entirely out of the miracle material contained in every roll! Can be safely used to repair cars, computers, people, dams, and a host of other items.', 'NE1RPR', 49.99),
(10, 'Effective Flashlight', 'The most powerful darkness-removal device offered to creatures of this world.  Rather than amplifying existing/secondary light, this handy product actually REMOVES darkness allowing you to see with your own eyes.  Must-have for nighttime operations. An affordable alternative to the Night Vision Goggles.', 'BRTLGT1', 399.99),
(11, 'The Incredible Versatile Paperclip', 'this 0. 01 oz piece of metal is the most versatile item in any respectable spy\'s toolbox and will come in handy in all sorts of situations. serves as a wily lock pick, aerodynamic projectile (used in conjunction with multi-purpose rubber band), or escape-proof finger cuffs.  best of all, small size and pliability means it fits anywhere undetected.  order several today!', 'INCPPRCLP', 29.99),
(12, 'Mighty Mighty Pen', 'Some spies claim this item is more powerful than a sword. After examining the titanium frame, built-in blowtorch, and Nerf dart-launcher, we tend to agree! ', 'WOWPEN', 899.99),
(13, 'Pocket Protector Rocket Pack', 'Any debonair spy knows that this accoutrement is coming back in style. flawlessly protects the pockets of your short-sleeved oxford from unsightly ink and pencil marks. but there\'s more! strap it on your back and it doubles as a rocket pack. provides enough turbo-thrust for a 250-pound spy or a passel of small children. maximum travel radius: 3000 miles.', 'LKARCKT', 19.99),
(14, 'Counterfeit Creation Wallet', 'Don\'t be caught penniless in Prague without this hot item! instantly creates replicas of most common currencies! simply place rocks and water in the wallet, close, open up again, and remove your legal tender! (Cutlery not included)', 'DNTGCGHT', 1295.59);

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` int(11) NOT NULL,
  `promo_level` enum('order','product') NOT NULL,
  `promo_type` enum('discount','bogo') NOT NULL,
  `product_id` int(11) NOT NULL,
  `state_filter` varchar(2) NOT NULL,
  `discount_percentage` float(11,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_states`
--

CREATE TABLE `user_states` (
  `id` int(11) NOT NULL,
  `state_full` varchar(20) DEFAULT NULL,
  `state_abbrev` varchar(2) DEFAULT NULL,
  `tax_rate` decimal(5,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_states`
--

INSERT INTO `user_states` (`id`, `state_full`, `state_abbrev`, `tax_rate`) VALUES
(1, 'Alabama', 'AL', '0.0400'),
(2, 'Alaska', 'AK', '0.0000'),
(3, 'Arizona', 'AZ', '0.0560'),
(4, 'Arkansas', 'AR', '0.0650'),
(5, 'California', 'CA', '0.0725'),
(6, 'Colorado', 'CO', '0.0290'),
(7, 'Connecticut', 'CT', '0.0635'),
(8, 'Delaware', 'DE', '0.0000'),
(9, 'District of Columbia', 'DC', '0.0600'),
(10, 'Florida', 'FL', '0.0600'),
(11, 'Georgia', 'GA', '0.0400'),
(12, 'Hawaii', 'HI', '0.0400'),
(13, 'Idaho', 'ID', '0.0600'),
(14, 'Illinois', 'IL', '0.0625'),
(15, 'Indiana', 'IN', '0.0700'),
(16, 'Iowa', 'IA', '0.0600'),
(17, 'Kansas', 'KS', '0.0650'),
(18, 'Kentucky', 'KY', '0.0600'),
(19, 'Louisiana', 'LA', '0.0500'),
(20, 'Maine', 'ME', '0.0600'),
(21, 'Maryland', 'MD', '0.0600'),
(22, 'Massachusetts', 'MA', '0.0600'),
(23, 'Michigan', 'MI', '0.0600'),
(24, 'Minnesota', 'MN', '0.0700'),
(25, 'Mississippi', 'MS', '0.0700'),
(26, 'Missouri', 'MO', '0.0500'),
(27, 'Montana', 'MT', '0.0000'),
(28, 'Nebraska', 'NE', '0.0550'),
(29, 'Nevada', 'NV', '0.0685'),
(30, 'New Hampshire', 'NH', '0.0000'),
(31, 'New Jersey', 'NJ', '0.0663'),
(32, 'New Mexico', 'NM', '0.0513'),
(33, 'New York', 'NY', '0.0400'),
(34, 'North Carolina', 'NC', '0.0500'),
(35, 'North Dakota', 'ND', '0.0500'),
(36, 'Ohio', 'OH', '0.0600'),
(37, 'Oklahoma', 'OK', '0.0450'),
(38, 'Oregon', 'OR', '0.0000'),
(39, 'Pennsylvania', 'PA', '0.0600'),
(40, 'Puerto Rico', 'PR', '0.0120'),
(41, 'Rhode Island', 'RI', '0.0700'),
(42, 'South Carolina', 'SC', '0.0600'),
(43, 'South Dakota', 'SD', '0.0450'),
(44, 'Tennessee', 'TN', '0.0700'),
(45, 'Texas', 'TX', '0.0650'),
(46, 'Utah', 'UT', '0.0470'),
(47, 'Vermont', 'VT', '0.0600'),
(48, 'Virginia', 'VA', '0.0450'),
(49, 'Washington', 'WA', '0.0650'),
(50, 'West Virginia', 'WV', '0.0600'),
(51, 'Wisconsin', 'WI', '0.0500'),
(52, 'Wyoming', 'WY', '0.0400');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_sku` (`product_sku`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_states`
--
ALTER TABLE `user_states`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_states`
--
ALTER TABLE `user_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
