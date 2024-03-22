-- Disha : 19-03-2024 12:40 PM
INSERT INTO `roles` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Super Admin', NULL, NULL, NULL), (NULL, 'Manager', NULL, NULL, NULL), (NULL, 'HR', NULL, NULL, NULL);
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Home Slider', NULL, NULL, NULL), (NULL, 'Home Our Businesses', NULL, NULL, NULL), (NULL, 'Home Detail', NULL, NULL, NULL), (NULL, 'Testimonials', NULL, NULL, NULL), (NULL, 'Setting', NULL, NULL, NULL),(NULL, 'Brand', NULL, NULL, NULL),(NULL, 'Car', NULL, NULL, NULL),(NULL, 'Showroom', NULL, NULL, NULL);

ALTER TABLE `user_role_permission` CHANGE `user_type_id` `role_id` INT(11) NULL DEFAULT NULL COMMENT '1=SuperAdmin,2=Admin,3=HR,4=Manager';

-- Disha : 19-03-2024 05:56 PM
ALTER TABLE `module_permission` CHANGE `title` `role_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `module_permission` ADD `read_permission` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0=no;1=yes;' AFTER `module_id`, ADD `full_permission` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0=no;1=yes;' AFTER `read_permission`;
ALTER TABLE `module_permission` CHANGE `module_id` `module_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `modules`';

-- Disha : 21-03-2024 04:31 PM
ALTER TABLE `showrooms` ADD `name` VARCHAR(255) NULL DEFAULT NULL AFTER `id`;

-- Disha : 22-03-2024 11:58 PM
--
-- Table structure for table `showroom_testimonial`
--
CREATE TABLE `showroom_testimonial` (
  `id` int(11) NOT NULL,
  `showroom_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `showroom_testimonial`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `showroom_testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;