/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 5.7.9 : Database - recipe
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`recipe` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `recipe`;

/*Table structure for table `ratings` */

DROP TABLE IF EXISTS `ratings`;

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipe_id` int(11) DEFAULT NULL,
  `reg_id` int(11) DEFAULT NULL,
  `rating` varchar(50) DEFAULT NULL,
  `review_text` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rating_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ratings` */

insert  into `ratings`(`rating_id`,`recipe_id`,`reg_id`,`rating`,`review_text`,`created_at`) values 
(1,5,1,'3','good','2024-10-02 15:01:28');
insert  into `ratings`(`rating_id`,`recipe_id`,`reg_id`,`rating`,`review_text`,`created_at`) values 
(2,5,1,'3','good','2024-10-02 15:10:46');
insert  into `ratings`(`rating_id`,`recipe_id`,`reg_id`,`rating`,`review_text`,`created_at`) values 
(3,5,1,'2','idud','2024-10-02 15:14:22');
insert  into `ratings`(`rating_id`,`recipe_id`,`reg_id`,`rating`,`review_text`,`created_at`) values 
(4,6,3,'2','better','2024-10-02 16:58:02');
insert  into `ratings`(`rating_id`,`recipe_id`,`reg_id`,`rating`,`review_text`,`created_at`) values 
(5,6,5,'3','good','2024-10-03 20:16:42');

/*Table structure for table `recipes` */

DROP TABLE IF EXISTS `recipes`;

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_id` int(11) DEFAULT NULL,
  `recipename` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `ingredients` varchar(100) DEFAULT NULL,
  `directions` varchar(10000) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `cuisiens` varchar(100) DEFAULT NULL,
  `dietary_restrictions` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`recipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `recipes` */

insert  into `recipes`(`recipe_id`,`reg_id`,`recipename`,`description`,`ingredients`,`directions`,`image`,`cuisiens`,`dietary_restrictions`) values 
(5,1,'avocdo','riue','riuuqo','Set oven to 350F To make the sauce, put all the ingredients in a sauce pan and stir to combine. Bring to a boil lower the heat and simmer/boil gently, uncovered, for about 10 minutes until thickened. If you used a chunky jam you may want to use an immersion blender to puree the glaze. Put the meats in a large mixing bowl, breaking them apart into small pieces as you add them. Add the egg, breadcrumbs, onion and salt and pepper to the bowl. Mix everything well with your fingertips. You want to thoroughly incorporate all the elements without over-doing it. Form the meat into a loaf, not too tall and not too wide. You want it to cook evenly, so try to get it even from end to end. You can set it directly in a pan or on a baking sheet, or set it on a rack if you have one. Whatever you do, be sure to line the pan with foil since the glaze will drip and make a mess. Spread a layer of glaze all over the meatloaf and bake it for about 60 minutes, or until a thermometer inserted in the center reads 160F. I baste another layer of sauce on the meat halfway through the cooking. Remove the meat and let it rest for a few minutes before slicing. Slather on a final coat of glaze just before serving, (heat it up on the stove so it is hot) and serve extra sauce on the side.','img/image_66fcc93a98832.webp','indian','calorie-restricted diet');
insert  into `recipes`(`recipe_id`,`reg_id`,`recipename`,`description`,`ingredients`,`directions`,`image`,`cuisiens`,`dietary_restrictions`) values 
(6,1,'Spaghetti Carbonara','A classic Italian pasta dish made with eggs, cheese, pancetta, and black pepper.','eggs, cheese, pancetta, and black pepper.','Set oven to 350F To make the sauce, put all the ingredients in a sauce pan and stir to combine. Bring to a boil lower the heat and simmer/boil gently, uncovered, for about 10 minutes until thickened. If you used a chunky jam you may want to use an immersion blender to puree the glaze. Put the meats in a large mixing bowl, breaking them apart into small pieces as you add them. Add the egg, breadcrumbs, onion and salt and pepper to the bowl. Mix everything well with your fingertips. You want to thoroughly incorporate all the elements without over-doing it. Form the meat into a loaf, not too tall and not too wide. You want it to cook evenly, so try to get it even from end to end. You can set it directly in a pan or on a baking sheet, or set it on a rack if you have one. Whatever you do, be sure to line the pan with foil since the glaze will drip and make a mess. Spread a layer of glaze all over the meatloaf and bake it for about 60 minutes, or until a thermometer inserted in the center reads 160F. I baste another layer of sauce on the meat halfway through the cooking. Remove the meat and let it rest for a few minutes before slicing. Slather on a final coat of glaze just before serving, (heat it up on the stove so it is hot) and serve extra sauce on the side.','img/image_66fce26490d5e.webp','british','egg free, vegiterian,lower-fat and lower-salt');
insert  into `recipes`(`recipe_id`,`reg_id`,`recipename`,`description`,`ingredients`,`directions`,`image`,`cuisiens`,`dietary_restrictions`) values 
(7,1,'Vegan Buddha Bowl','A nutritious and colorful bowl featuring quinoa, roasted vegetables, and avocado.','featuring quinoa, roasted vegetables, and avocado','Set oven to 350F To make the sauce, put all the ingredients in a sauce pan and stir to combine. Bring to a boil lower the heat and simmer/boil gently, uncovered, for about 10 minutes until thickened. If you used a chunky jam you may want to use an immersion blender to puree the glaze. Put the meats in a large mixing bowl, breaking them apart into small pieces as you add them. Add the egg, breadcrumbs, onion and salt and pepper to the bowl. Mix everything well with your fingertips. You want to thoroughly incorporate all the elements without over-doing it. Form the meat into a loaf, not too tall and not too wide. You want it to cook evenly, so try to get it even from end to end. You can set it directly in a pan or on a baking sheet, or set it on a rack if you have one. Whatever you do, be sure to line the pan with foil since the glaze will drip and make a mess. Spread a layer of glaze all over the meatloaf and bake it for about 60 minutes, or until a thermometer inserted in the center reads 160F. I baste another layer of sauce on the meat halfway through the cooking. Remove the meat and let it rest for a few minutes before slicing. Slather on a final coat of glaze just before serving, (heat it up on the stove so it is hot) and serve extra sauce on the side.','img/image_66fce2a01fe1c.jpg','italian','diary free');
insert  into `recipes`(`recipe_id`,`reg_id`,`recipename`,`description`,`ingredients`,`directions`,`image`,`cuisiens`,`dietary_restrictions`) values 
(8,1,'Greek Salad','A refreshing salad with tomatoes, cucumbers, olives, feta cheese, and a tangy dressing.','tomatoes, cucumbers, olives, feta cheese, and a tangy dressing','Set oven to 350F To make the sauce, put all the ingredients in a sauce pan and stir to combine. Bring to a boil lower the heat and simmer/boil gently, uncovered, for about 10 minutes until thickened. If you used a chunky jam you may want to use an immersion blender to puree the glaze. Put the meats in a large mixing bowl, breaking them apart into small pieces as you add them. Add the egg, breadcrumbs, onion and salt and pepper to the bowl. Mix everything well with your fingertips. You want to thoroughly incorporate all the elements without over-doing it. Form the meat into a loaf, not too tall and not too wide. You want it to cook evenly, so try to get it even from end to end. You can set it directly in a pan or on a baking sheet, or set it on a rack if you have one. Whatever you do, be sure to line the pan with foil since the glaze will drip and make a mess. Spread a layer of glaze all over the meatloaf and bake it for about 60 minutes, or until a thermometer inserted in the center reads 160F. I baste another layer of sauce on the meat halfway through the cooking. Remove the meat and let it rest for a few minutes before slicing. Slather on a final coat of glaze just before serving, (heat it up on the stove so it is hot) and serve extra sauce on the side.','img/image_66fce2d85b6d5.jpg','american','egg free');
insert  into `recipes`(`recipe_id`,`reg_id`,`recipename`,`description`,`ingredients`,`directions`,`image`,`cuisiens`,`dietary_restrictions`) values 
(9,1,'Chicken Curry','A flavorful curry made with tender chicken, coconut milk, and aromatic spices.','tender chicken, coconut milk, and aromatic spices','Set oven to 350F To make the sauce, put all the ingredients in a sauce pan and stir to combine. Bring to a boil lower the heat and simmer/boil gently, uncovered, for about 10 minutes until thickened. If you used a chunky jam you may want to use an immersion blender to puree the glaze. Put the meats in a large mixing bowl, breaking them apart into small pieces as you add them. Add the egg, breadcrumbs, onion and salt and pepper to the bowl. Mix everything well with your fingertips. You want to thoroughly incorporate all the elements without over-doing it. Form the meat into a loaf, not too tall and not too wide. You want it to cook evenly, so try to get it even from end to end. You can set it directly in a pan or on a baking sheet, or set it on a rack if you have one. Whatever you do, be sure to line the pan with foil since the glaze will drip and make a mess. Spread a layer of glaze all over the meatloaf and bake it for about 60 minutes, or until a thermometer inserted in the center reads 160F. I baste another layer of sauce on the meat halfway through the cooking. Remove the meat and let it rest for a few minutes before slicing. Slather on a final coat of glaze just before serving, (heat it up on the stove so it is hot) and serve extra sauce on the side.','img/image_66fce3133ad7e.jpg','indian','protien rich');
insert  into `recipes`(`recipe_id`,`reg_id`,`recipename`,`description`,`ingredients`,`directions`,`image`,`cuisiens`,`dietary_restrictions`) values 
(10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `registration` */

DROP TABLE IF EXISTS `registration`;

CREATE TABLE `registration` (
  `reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `usertype` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `registration` */

insert  into `registration`(`reg_id`,`firstname`,`lastname`,`email`,`password`,`usertype`) values 
(1,'alice','mv','alice@gmail.com','alice','user');
insert  into `registration`(`reg_id`,`firstname`,`lastname`,`email`,`password`,`usertype`) values 
(3,'ann','s','ann@gmail.com','ann','user');
insert  into `registration`(`reg_id`,`firstname`,`lastname`,`email`,`password`,`usertype`) values 
(4,'Ram','Krishna','ram@gmail.com','ram','user');
insert  into `registration`(`reg_id`,`firstname`,`lastname`,`email`,`password`,`usertype`) values 
(5,'sanal','ps','sanal@gmail.com','sanal','user');
insert  into `registration`(`reg_id`,`firstname`,`lastname`,`email`,`password`,`usertype`) values 
(6,'admin','admin','admin@gmail.com','admin','admin');
insert  into `registration`(`reg_id`,`firstname`,`lastname`,`email`,`password`,`usertype`) values 
(7,'anu','lakshmi','anu@gmail.com','anu','user');
insert  into `registration`(`reg_id`,`firstname`,`lastname`,`email`,`password`,`usertype`) values 
(8,'akku','PS','akku@gmail.com','akku','user');

/*Table structure for table `user_preferences` */

DROP TABLE IF EXISTS `user_preferences`;

CREATE TABLE `user_preferences` (
  `userp_id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_id` int(11) DEFAULT NULL,
  `selected_cuisines` varchar(100) DEFAULT NULL,
  `selected_dietary` varchar(100) DEFAULT NULL,
  `selected_disliked` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `user_preferences` */

insert  into `user_preferences`(`userp_id`,`reg_id`,`selected_cuisines`,`selected_dietary`,`selected_disliked`) values 
(1,4,'Italian','Dairy-Free','Onion,Tomato');
insert  into `user_preferences`(`userp_id`,`reg_id`,`selected_cuisines`,`selected_dietary`,`selected_disliked`) values 
(2,4,'Italian','Dairy-Free','Onion,Tomato');
insert  into `user_preferences`(`userp_id`,`reg_id`,`selected_cuisines`,`selected_dietary`,`selected_disliked`) values 
(3,4,'Italian','Dairy-Free','Onion,Tomato');
insert  into `user_preferences`(`userp_id`,`reg_id`,`selected_cuisines`,`selected_dietary`,`selected_disliked`) values 
(4,4,'Italian','Dairy-Free','Onion');
insert  into `user_preferences`(`userp_id`,`reg_id`,`selected_cuisines`,`selected_dietary`,`selected_disliked`) values 
(5,4,'Indian','Gluten-Free','Egg');
insert  into `user_preferences`(`userp_id`,`reg_id`,`selected_cuisines`,`selected_dietary`,`selected_disliked`) values 
(6,4,'Italian','Dairy-Free','Onion,Tomato');
insert  into `user_preferences`(`userp_id`,`reg_id`,`selected_cuisines`,`selected_dietary`,`selected_disliked`) values 
(7,1,'Indian','Dairy-Free',NULL);
insert  into `user_preferences`(`userp_id`,`reg_id`,`selected_cuisines`,`selected_dietary`,`selected_disliked`) values 
(8,1,'Italian','Gluten-Free','Onion');
insert  into `user_preferences`(`userp_id`,`reg_id`,`selected_cuisines`,`selected_dietary`,`selected_disliked`) values 
(9,1,'Italian','Gluten-Free','Tomato');
insert  into `user_preferences`(`userp_id`,`reg_id`,`selected_cuisines`,`selected_dietary`,`selected_disliked`) values 
(10,5,'Italian','Gluten-Free','Egg');
insert  into `user_preferences`(`userp_id`,`reg_id`,`selected_cuisines`,`selected_dietary`,`selected_disliked`) values 
(11,5,'Indian','Dairy-Free','Tomato');
insert  into `user_preferences`(`userp_id`,`reg_id`,`selected_cuisines`,`selected_dietary`,`selected_disliked`) values 
(12,5,'Indian','Dairy-Free','Onion');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
