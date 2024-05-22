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

-- Drashti : 22-04-2024 10:21 AM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Our Locations', NULL, NULL, NULL);

-- Drashti : 23-04-2024 01:08 AM
ALTER TABLE `service_center` ADD `facility_image` VARCHAR(255) NOT NULL AFTER `why_choose_description`;
ALTER TABLE `service_center` ADD `customer_gallery_image` VARCHAR(255) NOT NULL AFTER `facility_image`;

-- Drashti : 25-04-2024 02:08 AM
ALTER TABLE `contact_uses` ADD `map_link` LONGTEXT NOT NULL AFTER `form_sub_title_font_family`;
ALTER TABLE `contact_uses` CHANGE `map_link` `map_link` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;


-- Disha : 23-04-2024 5:55 PM
ALTER TABLE `service_center` CHANGE `service_id` `service_id` VARCHAR(255) NULL DEFAULT NULL COMMENT '`id` of `service`';

-- Disha 24-04-2024 2:00 PM
ALTER TABLE `body_shops` ADD `business_id` INT(11) NULL DEFAULT NULL AFTER `id`;
ALTER TABLE `used_cars` ADD `business_id` INT(11) NULL DEFAULT NULL AFTER `id`;
ALTER TABLE `users` ADD `business_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `our_business`' AFTER `id`, ADD `showroom_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `showrooms`' AFTER `business_id`, ADD `service_center_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `service_center`' AFTER `showroom_id`, ADD `body_shop_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `body_shops`\r\n' AFTER `service_center_id`, ADD `used_car_id` INT(11) NULL DEFAULT NULL COMMENT '\r\n`id` of `used_cars`\r\n' AFTER `body_shop_id`;
ALTER TABLE `body_shops` CHANGE `business_id` `business_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `our_business`';
ALTER TABLE `used_cars` CHANGE `business_id` `business_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `our_business`';

-- Disha : 25-04-2024 11:40 Am
ALTER TABLE `users` CHANGE `role_id` `role_id` INT(11) NULL DEFAULT NULL;

-- Disha : 25-04-2024 5:44 PM
ALTER TABLE `our_business` ADD `used_car_title` VARCHAR(255) NULL DEFAULT NULL AFTER `body_shop_title_font_family`, ADD `used_car_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `used_car_title`, ADD `used_car_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `used_car_title_color`, ADD `used_car_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `used_car_title_font_size`;

-- Disha : 26-04-2024 2:51 PM
ALTER TABLE `pages` CHANGE `description` `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

-- Disha : 27-04-2024 10:50 AM
--
-- Table structure for table `faq_title`
--

CREATE TABLE `faq_title` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `title_color` varchar(255) DEFAULT NULL,
  `title_font_size` varchar(255) DEFAULT NULL,
  `title_font_family` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `faq_title` (`id`, `title`, `title_color`, `title_font_size`, `title_font_family`, `created_at`, `updated_at`) VALUES
(1, 'Frequently Asked Questions', '#e01818', '26px', 'sans-serif', '2024-04-27 04:53:54', '2024-04-26 23:42:43');

ALTER TABLE `faq_title`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `faq_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 01-05-2024 10:19 AM
ALTER TABLE `award_and_recognition` CHANGE `showroom_id` `business_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `our_business`';
ALTER TABLE `service_center` ADD `slug` VARCHAR(255) NULL DEFAULT NULL AFTER `name`;

-- Disha : 01-05-2024 6:03 PM
ALTER TABLE `service_center` ADD `facility_title` VARCHAR(255) NULL DEFAULT NULL AFTER `email_font_color`, ADD `facility_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `facility_title`, ADD `facility_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `facility_title_color`, ADD `facility_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `facility_title_font_size`, ADD `customer_gallery_title` VARCHAR(255) NULL DEFAULT NULL AFTER `facility_title_font_family`, ADD `customer_gallery_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `customer_gallery_title`, ADD `customer_gallery_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `customer_gallery_title_color`, ADD `customer_gallery_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `customer_gallery_title_font_size`, ADD `testimonial_title` VARCHAR(255) NULL DEFAULT NULL AFTER `customer_gallery_title_font_family`, ADD `testimonial_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `testimonial_title`;

-- Disha : 02-05-2024 12:24 PM
ALTER TABLE `service_center` ADD `testimonial_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `testimonial_title_color`, ADD `testimonial_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `testimonial_title_font_size`, ADD `lets_connect_image` VARCHAR(255) NULL DEFAULT NULL AFTER `testimonial_title_font_family`, ADD `address_title` VARCHAR(255) NULL DEFAULT NULL AFTER `lets_connect_image`, ADD `address_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `address_title`, ADD `address_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `address_title_color`, ADD `address_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `address_title_font_size`, ADD `working_hour_title` VARCHAR(255) NULL DEFAULT NULL AFTER `address_title_font_family`, ADD `working_hour_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `working_hour_title`;
ALTER TABLE `service_center` ADD `working_hour_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `working_hour_title_color`, ADD `working_hour_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `working_hour_title_font_size`, ADD `contact_title` VARCHAR(255) NULL DEFAULT NULL AFTER `working_hour_title_font_family`, ADD `contact_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `contact_title`, ADD `contact_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `contact_title_color`, ADD `contact_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `contact_title_font_size`, ADD `email_title` VARCHAR(255) NULL DEFAULT NULL AFTER `contact_title_font_family`, ADD `email_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `email_title`, ADD `email_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `email_title_color`;
ALTER TABLE `service_center` ADD `email_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `email_title_font_size`;

-- Disha : 02-05-2024 4:55 PM
ALTER TABLE `showrooms` ADD `slug` VARCHAR(255) NULL DEFAULT NULL AFTER `id`;
ALTER TABLE `showrooms` CHANGE `our_business_id` `our_business_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `showrooms` CHANGE `slider_image` `slider_image` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `slider_showroom_name` `slider_showroom_name` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `slider_showroom_name_color` `slider_showroom_name_color` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `showrooms` ADD `facility_title` VARCHAR(255) NULL DEFAULT NULL AFTER `description_font_family`, ADD `facility_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `facility_title`, ADD `facility_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `facility_title_color`, ADD `facility_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `facility_title_font_size`, ADD `customer_gallery_title` VARCHAR(255) NULL DEFAULT NULL AFTER `facility_title_font_family`, ADD `customer_gallery_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `customer_gallery_title`, ADD `customer_gallery_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `customer_gallery_title_color`, ADD `customer_gallery_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `customer_gallery_title_font_size`, ADD `testimonial_title` VARCHAR(255) NULL DEFAULT NULL AFTER `customer_gallery_title_font_family`, ADD `testimonial_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `testimonial_title`, ADD `testimonial_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `testimonial_title_color`, ADD `testimonial_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `testimonial_title_font_size`, ADD `lets_connect_image` VARCHAR(255) NULL DEFAULT NULL AFTER `testimonial_title_font_family`, ADD `address_title` VARCHAR(255) NULL DEFAULT NULL AFTER `lets_connect_image`, ADD `address_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `address_title`, ADD `address_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `address_title_color`, ADD `address_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `address_title_font_size`, ADD `working_hour_title` VARCHAR(255) NULL DEFAULT NULL AFTER `address_title_font_family`, ADD `working_hour_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `working_hour_title`, ADD `working_hour_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `working_hour_title_color`, ADD `working_hour_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `working_hour_title_font_size`, ADD `contact_title` VARCHAR(255) NULL DEFAULT NULL AFTER `working_hour_title_font_family`, ADD `contact_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `contact_title`, ADD `contact_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `contact_title_color`, ADD `contact_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `contact_title_font_size`, ADD `email_title` VARCHAR(255) NULL DEFAULT NULL AFTER `contact_title_font_family`, ADD `email_title_color` VARCHAR(255) NULL DEFAULT NULL AFTER `email_title`, ADD `email_title_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `email_title_color`, ADD `email_title_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `email_title_font_size`;

-- Disha : 04-05-2024 1:08 PM
ALTER TABLE `vacancies` ADD `showroom_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `showrooms`' AFTER `business_id`, ADD `service_center_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `service_center`' AFTER `showroom_id`, ADD `body_shop_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `body_shops`' AFTER `service_center_id`, ADD `used_car_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `used_cars`' AFTER `body_shop_id`;

-- Disha : 09-05-2024 10:27 AM
ALTER TABLE `vacancies` ADD `icon_background_color` VARCHAR(255) NULL DEFAULT NULL AFTER `offer_salary`;
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'New Cars', NULL, NULL, NULL);

-- Disha : 09-05-2024 3:06 PM
--
-- Table structure for table `new_car`
--

CREATE TABLE `new_car` (
  `id` int(11) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `title_color` varchar(255) DEFAULT NULL,
  `title_font_size` varchar(255) DEFAULT NULL,
  `title_font_family` varchar(255) DEFAULT NULL,
  `brand_id` varchar(255) DEFAULT NULL COMMENT '`id` of `brands`',
  `car_id` varchar(255) DEFAULT NULL COMMENT '`id` of `cars`',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `new_car` (`id`, `banner_image`, `title`, `title_color`, `title_font_size`, `title_font_family`, `brand_id`, `car_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'th116908913591715236733.jfif', 'sa', '#3f0a0a', '26px', 'sans-serif', NULL, NULL, '2024-05-09 01:08:53', '2024-05-09 07:35:46', NULL);

ALTER TABLE `new_car`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `new_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 09-05-2024 4:25 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'After Sales Service', NULL, NULL, NULL);

-- Disha : 09-05-2024 5:07 PM
--
-- Table structure for table `after_sales_service`
--

CREATE TABLE `after_sales_service` (
  `id` int(11) NOT NULL,
  `brand_id` varchar(255) DEFAULT NULL COMMENT '`id` of `brands`',
  `banner_image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `title_color` varchar(255) NOT NULL,
  `title_font_size` varchar(255) DEFAULT NULL,
  `title_font_family` varchar(255) DEFAULT NULL,
  `book_service_form_title` varchar(255) DEFAULT NULL,
  `book_service_form_title_color` varchar(255) DEFAULT NULL,
  `book_service_form_title_font_size` varchar(255) DEFAULT NULL,
  `book_service_form_title_font_family` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `description_font_color` varchar(255) DEFAULT NULL,
  `description_font_size` varchar(255) DEFAULT NULL,
  `description_font_family` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `after_sales_service`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `after_sales_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 10-05-2024 10:18 AM
ALTER TABLE `brands` ADD `link` VARCHAR(255) NULL DEFAULT NULL AFTER `font_family`;

-- Disha : 10-05-2024 10:53 AM
ALTER TABLE `cars` ADD `driven` VARCHAR(255) NULL DEFAULT NULL AFTER `price_font_family`, ADD `driven_color` VARCHAR(255) NULL DEFAULT NULL AFTER `driven`, ADD `driven_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `driven_color`, ADD `driven_fon_family` VARCHAR(255) NULL DEFAULT NULL AFTER `driven_font_size`, ADD `fuel_type` VARCHAR(255) NULL DEFAULT NULL AFTER `driven_fon_family`, ADD `fuel_type_color` VARCHAR(255) NULL DEFAULT NULL AFTER `fuel_type`, ADD `fuel_type_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `fuel_type_color`, ADD `fuel_type_font_family` INT NOT NULL AFTER `fuel_type_font_size`;
ALTER TABLE `cars` ADD `year` INT(11) NULL DEFAULT NULL AFTER `fuel_type_font_family`, ADD `year_color` VARCHAR(255) NULL DEFAULT NULL AFTER `year`, ADD `year_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `year_color`, ADD `year_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `year_font_size`, ADD `body_style` VARCHAR(255) NOT NULL AFTER `year_font_family`, ADD `body_style_color` VARCHAR(255) NULL DEFAULT NULL AFTER `body_style`, ADD `body_style_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `body_style_color`, ADD `body_style_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `body_style_font_size`;
ALTER TABLE `cars` CHANGE `fuel_type_font_family` `fuel_type_font_family` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `cars` CHANGE `driven_fon_family` `driven_font_family` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

-- Disha : 10-05-2024 3:41 PM
ALTER TABLE `new_car` ADD `used_car_banner_image` VARCHAR(255) NULL DEFAULT NULL AFTER `title_font_family`;
ALTER TABLE `after_sales_service` CHANGE `title_color` `title_color` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

-- Disha : 11-05-2024 11:09 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Car Insurance', NULL, NULL, NULL);

-- Disha : 11-05-2024 12:05 PM
--
-- Table structure for table `car_insurance`
--

CREATE TABLE `car_insurance` (
  `id` int(11) NOT NULL,
  `brand_id` varchar(255) DEFAULT NULL COMMENT '`id` of `brands`',
  `banner_image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `title_color` varchar(255) DEFAULT NULL,
  `title_font_size` varchar(255) DEFAULT NULL,
  `title_font_family` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `description_font_color` varchar(255) DEFAULT NULL,
  `description_font_size` varchar(255) DEFAULT NULL,
  `description_font_family` varchar(255) DEFAULT NULL,
  `insurance_form_title` varchar(255) DEFAULT NULL,
  `insurance_form_title_color` varchar(255) DEFAULT NULL,
  `insurance_form_title_font_size` varchar(255) NOT NULL,
  `insurance_form_title_font_family` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `car_insurance`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `car_insurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `car_insurance` CHANGE `insurance_form_title_font_size` `insurance_form_title_font_size` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `insurance_form_title_font_family` `insurance_form_title_font_family` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

-- Drashti
--
-- Table structure for table `our_locations`
--

CREATE TABLE `our_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_font_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_font_family` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `our_locations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `our_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

-- Disha : 14-05-2024 12:42 PM
ALTER TABLE `body_shops` ADD `address` TEXT NULL DEFAULT NULL AFTER `number_of_rating`, ADD `address_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `address`, ADD `address_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `address_font_size`, ADD `address_font_color` VARCHAR(255) NULL DEFAULT NULL AFTER `address_font_family`, ADD `email` VARCHAR(255) NULL DEFAULT NULL AFTER `address_font_color`, ADD `email_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `email`, ADD `email_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `email_font_size`, ADD `email_font_color` VARCHAR(255) NULL DEFAULT NULL AFTER `email_font_family`, ADD `contact_number` VARCHAR(255) NULL DEFAULT NULL AFTER `email_font_color`, ADD `contact_font_size` VARCHAR(255) NULL DEFAULT NULL AFTER `contact_number`, ADD `contact_font_family` VARCHAR(255) NULL DEFAULT NULL AFTER `contact_font_size`, ADD `contact_font_color` VARCHAR(255) NULL DEFAULT NULL AFTER `contact_font_family`;

-- Disha : 14-05-2024 3:38 PM
ALTER TABLE `our_business` ADD `map_link` VARCHAR(255) NULL DEFAULT NULL AFTER `insurance_title_font_family`;
ALTER TABLE `our_business` CHANGE `map_link` `map_link` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

-- Disha : 14-05-2024 5:55 PM
ALTER TABLE `showrooms` ADD `map_link` LONGTEXT NULL DEFAULT NULL AFTER `email_title_font_family`;
ALTER TABLE `service_center` ADD `map_link` LONGTEXT NULL DEFAULT NULL AFTER `slider_service_center_name_font_family`;

-- Disha : 15-05-2024 12:02 PM
ALTER TABLE `body_shops` ADD `map_link` LONGTEXT NULL DEFAULT NULL AFTER `contact_font_color`;

-- Disha : 16-05-2024 10:38 AM
ALTER TABLE `our_business` ADD `car_id` VARCHAR(255) NULL DEFAULT NULL COMMENT '`id` of `cars`' AFTER `id`;

-- Disha : 16-05-2024 3:24 AM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Company CSR', NULL, NULL, NULL);

--
-- Table structure for table `company_csr`
--

CREATE TABLE `company_csr` (
  `id` int(11) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `title_color` varchar(255) DEFAULT NULL,
  `title_font_size` varchar(255) DEFAULT NULL,
  `title_font_family` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `description_font_color` varchar(255) DEFAULT NULL,
  `description_font_size` varchar(255) DEFAULT NULL,
  `description_font_family` varchar(255) DEFAULT NULL,
  `left_title` varchar(255) DEFAULT NULL,
  `left_title_color` varchar(255) DEFAULT NULL,
  `left_title_font_size` varchar(255) DEFAULT NULL,
  `left_title_font_family` varchar(255) DEFAULT NULL,
  `left_description` text DEFAULT NULL,
  `left_description_font_color` varchar(255) DEFAULT NULL,
  `left_description_font_size` varchar(255) DEFAULT NULL,
  `left_description_font_family` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `company_csr`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `company_csr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 17-05-2024 3:36 AM
--
-- Table structure for table `book_car_service`
--

CREATE TABLE `book_car_service` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL COMMENT '`id` of `brands`',
  `first_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `book_car_service`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `book_car_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Booked Car Service', NULL, NULL, NULL);

-- Disha : 17-05-2024 05:26 PM
--
-- Table structure for table `book_insurance`
--
CREATE TABLE `book_insurance` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL COMMENT '`id` of `brands`',
  `first_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `book_insurance`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `book_insurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Booked Insurance', NULL, NULL, NULL);

-- Disha : 18-05-2024 10:09 AM
ALTER TABLE `our_business` ADD `service_id` VARCHAR(255) NULL DEFAULT NULL COMMENT '`id` of `service`' AFTER `car_id`;

-- Disha : 18-05-2024 1:27 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Career Form', NULL, NULL, NULL);

-- Disha : 20-05-2024 4:00 PM
--
-- Table structure for table `career_form`
--

CREATE TABLE `career_form` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `post_apply_for` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `career_form`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `career_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 21-05-2024 01:14 PM
-- Table structure for table `showroom_contact_query`
--
CREATE TABLE `showroom_contact_query` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `our_service` varchar(255) DEFAULT NULL COMMENT '`our_service` of `header_menus`',
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `showroom_contact_query`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `showroom_contact_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 21-05-2024 06:42 PM
--
-- Table structure for table `service_center_contact_query`
--

CREATE TABLE `service_center_contact_query` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `our_service` varchar(255) DEFAULT NULL COMMENT '`our_service` of `header_menus`',
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `service_center_contact_query`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `service_center_contact_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Disha : 22-05-2024 11:50 PM
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Showroom Contact Query', NULL, NULL, NULL);