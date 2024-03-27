-- Disha : 19-03-2024 12:40 PM
INSERT INTO `roles` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Super Admin', NULL, NULL, NULL), (NULL, 'Manager', NULL, NULL, NULL), (NULL, 'HR', NULL, NULL, NULL);
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Home Slider', NULL, NULL, NULL), (NULL, 'Home Our Businesses', NULL, NULL, NULL), (NULL, 'Home Detail', NULL, NULL, NULL), (NULL, 'Testimonials', NULL, NULL, NULL), (NULL, 'Setting', NULL, NULL, NULL),(NULL, 'Brand', NULL, NULL, NULL),(NULL, 'Car', NULL, NULL, NULL),(NULL, 'Showroom', NULL, NULL, NULL);

ALTER TABLE `user_role_permission` CHANGE `user_type_id` `role_id` INT(11) NULL DEFAULT NULL COMMENT '1=SuperAdmin,2=Admin,3=HR,4=Manager';

-- Disha : 19-03-2024 05:56 PM
ALTER TABLE `module_permission` CHANGE `title` `role_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `module_permission` ADD `read_permission` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0=no;1=yes;' AFTER `module_id`, ADD `full_permission` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0=no;1=yes;' AFTER `read_permission`;
ALTER TABLE `module_permission` CHANGE `module_id` `module_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `modules`';

--Drashti : 21-03-2024 06:1 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES ('9', 'Header Menu', NULL, NULL, NULL);

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

-- Disha : 21-03-2024 04:25 PM
ALTER TABLE `showroom_testimonial` ADD `name_text_size` INT NOT NULL AFTER `description`, ADD `name_text_color` INT NOT NULL AFTER `name_text_size`, ADD `name_font_family` INT NOT NULL AFTER `name_text_color`, ADD `name_background_color` INT NOT NULL AFTER `name_font_family`, ADD `address_text_size` INT NOT NULL AFTER `name_background_color`, ADD `address_text_color` INT NOT NULL AFTER `address_text_size`, ADD `address_font_family` INT NOT NULL AFTER `address_text_color`;
ALTER TABLE `showroom_testimonial` CHANGE `name_text_size` `name_text_size` VARCHAR(255) NULL DEFAULT NULL, CHANGE `name_text_color` `name_text_color` VARCHAR(255) NULL DEFAULT NULL, CHANGE `name_font_family` `name_font_family` VARCHAR(255) NULL DEFAULT NULL, CHANGE `name_background_color` `name_background_color` VARCHAR(255) NULL DEFAULT NULL, CHANGE `address_text_size` `address_text_size` VARCHAR(255) NULL DEFAULT NULL, CHANGE `address_text_color` `address_text_color` VARCHAR(255) NULL DEFAULT NULL, CHANGE `address_font_family` `address_font_family` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `showroom_testimonial` CHANGE `address_text_size` `description_text_size` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `address_text_color` `description_text_color` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `address_font_family` `description_font_family` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

-- Disha : 23-03-2024 12:40 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Showroom Testimonial', NULL, NULL, NULL);
ALTER TABLE `showroom_model` ADD `title_text_size` VARCHAR(255) NULL DEFAULT NULL AFTER `image`, ADD `title_text_color` VARCHAR(255) NULL DEFAULT NULL AFTER `title_text_size`, ADD `title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `title_text_color`, ADD `image_size` VARCHAR(255) NULL DEFAULT NULL AFTER `title_font_family`;

-- Drashti : 23-03-2024 01:11 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES ('10', 'Footer Menu', NULL, NULL, NULL);

-- Disha : 27-03-2024 10:15 AM
--
-- Table structure for table `showroom_model`
--

CREATE TABLE `showroom_model` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `showroom_id` int(11) DEFAULT NULL COMMENT '`id` of `showroom`',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_text_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_font_family` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `showroom_model`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `showroom_model`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

-- Disha : 27-03-2024 11:39 AM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Showroom Testimonial', NULL, NULL, NULL);
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Showroom Model', NULL, NULL, NULL);
