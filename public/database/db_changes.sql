-- Disha : 19-03-2024 12:40 PM
INSERT INTO `roles` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Super Admin', NULL, NULL, NULL), (NULL, 'Manager', NULL, NULL, NULL), (NULL, 'HR', NULL, NULL, NULL);
INSERT INTO `modules` (`id`, `module`, `deleted_at`, `created_at`, `updated_at`) VALUES (NULL, 'Home Slider', NULL, NULL, NULL), (NULL, 'Home Our Businesses', NULL, NULL, NULL), (NULL, 'Home Detail', NULL, NULL, NULL), (NULL, 'Testimonials', NULL, NULL, NULL), (NULL, 'Setting', NULL, NULL, NULL),(NULL, 'Brand', NULL, NULL, NULL),(NULL, 'Car', NULL, NULL, NULL),(NULL, 'Showroom', NULL, NULL, NULL);

ALTER TABLE `user_role_permission` CHANGE `user_type_id` `role_id` INT(11) NULL DEFAULT NULL COMMENT '1=SuperAdmin,2=Admin,3=HR,4=Manager';

-- Disha : 19-03-2024 05:56 PM
ALTER TABLE `module_permission` CHANGE `title` `role_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `module_permission` ADD `read_permission` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0=no;1=yes;' AFTER `module_id`, ADD `full_permission` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0=no;1=yes;' AFTER `read_permission`;
ALTER TABLE `module_permission` CHANGE `module_id` `module_id` INT(11) NULL DEFAULT NULL COMMENT '`id` of `modules`';
