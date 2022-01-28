CREATE TABLE `star_rating` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` smallint(6) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `star_rating`
  ADD PRIMARY KEY (`product_id`,`user_id`);

INSERT INTO `star_rating` (`product_id`, `user_id`, `rating`) VALUES
(1, 900, 1),
(1, 901, 2),
(1, 902, 5),
(2, 901, 3),
(2, 902, 4),
(2, 903, 5),
(2, 904, 2),
(3, 902, 5),
(3, 904, 4),
(4, 901, 4),
(4, 902, 1),
(4, 903, 3),
(4, 904, 4);


CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` varchar(1280) NOT NULL,
  `price` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `products` (`name`, `description`, `price`) VALUES
('Fourchette ', 'Une belle fourchette en métal', 12),
('Couteau', 'Un beau couteau en métal', 8),
('Rateau', 'Un beau rateau vert', 25);

