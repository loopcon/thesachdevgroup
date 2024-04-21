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

  
-- Drashti : 27-03-2024 02:09 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES ('11', 'Mission Vision', NULL, NULL, NULL);


-- Disha : 27-03-2024 11:39 AM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Showroom Testimonial', NULL, NULL, NULL);
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Showroom Model', NULL, NULL, NULL);
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Service Center', NULL, NULL, NULL);

-- Drashti : 28-03-2024 11:16 AM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES ('14', 'Header Menu Social Media Icon', NULL, NULL, NULL);

-- Disha : 29-03-2024 12:06 PM
ALTER TABLE `service` CHANGE `service_center_id` `service_center_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `service_center`';
ALTER TABLE `service` ADD `name_font_color` VARCHAR(255) NULL DEFAULT NULL AFTER `name`, ADD `name_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `name_font_color`, ADD `name_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `name_font_size`;

-- Disha : 29-03-2024 12:26 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Service', NULL, NULL, NULL);

-- Disha : 29-03-2024 3:11 PM
ALTER TABLE `service` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`;


-- Drashti : 30-03-2024 1:54 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Count', NULL, NULL, NULL);

-- Disha : 30-03-2024 10:58 AM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Service Center Facility Customer Gallery', NULL, NULL, NULL);

-- Disha : 30-03-2024 1:26
RENAME TABLE `tsgautomotive`.`service_testimonial` TO `tsgautomotive`.`service_center_testimonial`;
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Service Center Testimonial', NULL, NULL, NULL);

-- Disha : 01-04-2024 10:08 AM
ALTER TABLE `service_center_testimonial` ADD `description_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `description_text_color`;

-- Disha : 01-04-2024 2:34 PM
ALTER TABLE `service_center` ADD `service_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `service`' AFTER `id`;

-- Disha : 01-04-2024 4:16 PM
ALTER TABLE `users` ADD `visible_password` VARCHAR(255) NULL DEFAULT NULL AFTER `password`;
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Users', NULL, NULL, NULL);

-- Disha : 02-04-2024 12:17 PM
ALTER TABLE `users` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`;

-- Disha : 02-04-2024 04:04 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Faqs', NULL, NULL, NULL);

-- Drashti : 04-04-2024 01:59 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Showroom Facility Customer Gallery', NULL, NULL, NULL);

-- Disha : 03-04-2024 10:00 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Pages', NULL, NULL, NULL);

-- Disha : 03-04-2024 2:26 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Awards', NULL, NULL, NULL);

-- Disha : 04-04-2024 1:50 PM
--
-- Table structure for table `award_and_recognition`
--

CREATE TABLE `award_and_recognition` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL COMMENT '`id` of `brands`',
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `award_and_recognition`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `award_and_recognition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 04-04-2024 04:17 PM
ALTER TABLE `service` ADD `slug` VARCHAR(255) NULL DEFAULT NULL AFTER `service_center_id`;
ALTER TABLE `service_center` ADD `why_choose_title` VARCHAR(255) NULL DEFAULT NULL AFTER `email_font_color`, ADD `why_choose_image` VARCHAR(255) NULL DEFAULT NULL AFTER `why_choose_title`, ADD `why_choose_description` TEXT NULL DEFAULT NULL AFTER `why_choose_image`;

-- Disha : 05-04-2024 12:47 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Our Business', NULL, NULL, NULL);

-- Disha : 05-04-2024 3:50 PM
--
-- Table structure for table `our_business`
--

CREATE TABLE `our_business` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `page_link` tinyint(1) DEFAULT NULL COMMENT '0=no;1=yes;',
  `title_font_size` varchar(255) DEFAULT NULL,
  `title_font_color` varchar(255) DEFAULT NULL,
  `title_font_family` varchar(255) DEFAULT NULL,
  `description_font_size` varchar(255) DEFAULT NULL,
  `description_font_color` varchar(255) DEFAULT NULL,
  `description_font_family` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `our_business`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `our_business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `service` ADD `business_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `our_business`' AFTER `service_center_id`;
ALTER TABLE `service_center` ADD `business_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `our_business`' AFTER `service_id`;
UPDATE `modules` SET `module` = 'Business', `deleted_at` = NULL, `created_at` = NULL, `updated_at` = NULL WHERE `modules`.`id` = 23;
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Business Insurance', NULL, NULL, NULL);

-- Disha : 06-04-2024 11:16 AM
ALTER TABLE `our_business` ADD `why_choose_title` VARCHAR(255) NULL DEFAULT NULL AFTER `description_font_family`, ADD `why_choose_image` VARCHAR(255) NULL DEFAULT NULL AFTER `why_choose_title`, ADD `why_choose_description` TEXT NULL DEFAULT NULL AFTER `why_choose_image`;
ALTER TABLE `our_business` ADD `why_choose_title_color` INT NOT NULL AFTER `why_choose_title`, ADD `why_choose_title_font_size` INT NOT NULL AFTER `why_choose_title_color`, ADD `why_choose_title_font_family` INT NOT NULL AFTER `why_choose_title_font_size`;
ALTER TABLE `our_business` CHANGE `why_choose_title_color` `why_choose_title_color` VARCHAR(255) NULL DEFAULT NULL, CHANGE `why_choose_title_font_size` `why_choose_title_font_size` VARCHAR(255) NULL DEFAULT NULL, CHANGE `why_choose_title_font_family` `why_choose_title_font_family` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `our_business` ADD `why_choose_description_color` VARCHAR(255) NULL DEFAULT NULL AFTER `why_choose_description`, ADD `why_choose_description_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `why_choose_description_color`, ADD `why_choose_description_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `why_choose_description_font_size`;

-- Disha : 06-04-2024 1:20 AM
--
-- Table structure for table `our_business_insurance`
--

CREATE TABLE `our_business_insurance` (
  `id` int(11) NOT NULL,
  `business_id` int(11) DEFAULT NULL COMMENT '`id` of `our_business`',
  `name` varchar(255) DEFAULT NULL,
  `name_font_size` varchar(255) DEFAULT NULL,
  `name_font_family` varchar(255) DEFAULT NULL,
  `name_font_color` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `our_business_insurance`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `our_business_insurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 09-04-2024 9:48 AM
ALTER TABLE `award_and_recognition` CHANGE `brand_id` `showroom_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `brands`';

-- Disha : 09-04-2024 3:34 PM
ALTER TABLE `service_center` ADD `rating` FLOAT(8,2) NULL DEFAULT NULL AFTER `email_font_color`, ADD `number_of_rating` INT(11) NULL DEFAULT NULL AFTER `rating`;

-- Disha : 09-04-2024 5:56 PM
--
-- Table structure for table `award_banner`
--

CREATE TABLE `award_banner` (
  `id` int(11) NOT NULL,
  `award_title` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `award_title_font_size` varchar(255) DEFAULT NULL,
  `award_title_font_color` varchar(255) DEFAULT NULL,
  `award_title_font_family` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `award_banner` (`id`, `award_title`, `banner_image`, `award_title_font_size`, `award_title_font_color`, `award_title_font_family`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AWARDS', '3-2-car-free-download-png1712665456.png', '24px', '#655353', 'poppins', '2024-04-09 12:21:01', '2024-04-09 06:54:27', NULL);

ALTER TABLE `award_banner`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `award_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 10-04-2024 2:20 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Vacancies', NULL, NULL, NULL);

-- Disha : 11-04-2024 10:30 AM
--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `id` int(11) NOT NULL,
  `business_id` int(11) DEFAULT NULL COMMENT '`id` of `our_business`',
  `name` varchar(255) DEFAULT NULL,
  `name_font_color` varchar(255) DEFAULT NULL,
  `name_font_size` varchar(255) DEFAULT NULL,
  `name_font_family` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `description_font_color` varchar(255) DEFAULT NULL,
  `description_font_family` varchar(255) DEFAULT NULL,
  `description_font_size` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `work_level` varchar(255) DEFAULT NULL,
  `employee_type` varchar(255) DEFAULT NULL,
  `offer_salary` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `vacancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 11-04-2024 06:16 AM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Career', NULL, NULL, NULL);

-- Disha : 15-04-2023 9:41 AM
ALTER TABLE `service_center` ADD `slider_image` VARCHAR(255) NULL DEFAULT NULL AFTER `number_of_rating`, ADD `slider_service_center_name` VARCHAR(255) NULL DEFAULT NULL AFTER `slider_image`;
ALTER TABLE `service_center` ADD `slider_service_center_name_color` VARCHAR(255) NULL DEFAULT NULL AFTER `slider_service_center_name`, ADD `slider_service_center_name_size` VARCHAR(255) NULL DEFAULT NULL AFTER `slider_service_center_name_color`, ADD `slider_service_center_name_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `slider_service_center_name_size`;

-- Disha : 15-04-2023 12:08 AM
ALTER TABLE `our_business` ADD `shwroom_title` VARCHAR(255) NULL DEFAULT NULL AFTER `why_choose_description_font_family`, ADD `shwroom_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `shwroom_title`, ADD `shwroom_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `shwroom_title_color`, ADD `shwroom_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `shwroom_title_font_size`, ADD `service_center_title` VARCHAR(255) NULL DEFAULT NULL AFTER `shwroom_title_font_family`, ADD `service_center_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `service_center_title`, ADD `service_center_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `service_center_title_color`, ADD `service_center_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `service_center_title_font_size`, ADD `body_shop_title` VARCHAR(255) NULL DEFAULT NULL AFTER `service_center_title_font_family`, ADD `body_shop_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `body_shop_title`;
ALTER TABLE `our_business` ADD `body_shop_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `body_shop_title_color`, ADD `body_shop_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `body_shop_title_font_size`, ADD `insurance_title` VARCHAR(255) NULL DEFAULT NULL AFTER `body_shop_title_font_family`, ADD `insurance_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `insurance_title`, ADD `insurance_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `insurance_title_color`, ADD `insurance_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `insurance_title_font_size`;
ALTER TABLE `our_business` CHANGE `shwroom_title` `showroom_title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `shwroom_title_color` `showroom_title_color` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `shwroom_title_font_size` `showroom_title_font_size` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `shwroom_title_font_family` `showroom_title_font_family` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

-- Disha : 16-04-2023 3:09 AM
ALTER TABLE `showrooms` CHANGE `slider_showroom_color` `slider_showroom_name_color` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `slider_showroom_font_size` `slider_showroom_name_font_size` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `slider_showroom_font_family` `slider_showroom_name_font_family` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

-- Drashti : 16-04-2024 12:53 AM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Body Shops', NULL, NULL, NULL);

-- Drashti : 16-04-2024 03:17 AM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Used Car', NULL, NULL, NULL);

-- Drashti : 19-04-2024 12:53 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Contact Us', NULL, NULL, NULL);