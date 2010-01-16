<?php

return array(
    "DROP TABLE IF EXISTS `categories`;",
    "CREATE TABLE `categories` (
       `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
       `name` varchar(100) NOT NULL,
       PRIMARY KEY (`id`)
     ) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;",
    "INSERT INTO `categories` VALUES (1,'Programming'),(2,'Miscelanous');",

    "DROP TABLE IF EXISTS `posts`;",
    "CREATE TABLE `posts` (
     `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
       `category_id` int(10) unsigned NOT NULL,
       `title` varchar(100) NOT NULL,
       `content` text NOT NULL,
       `created` datetime NOT NULL,
       PRIMARY KEY (`id`),
       KEY `category_id` (`category_id`)
     ) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;",

    "INSERT INTO `posts` VALUES (1,1,'My programming article','This is an article about über-1337 programming.','2010-01-01 00:00:01'),(2,2,'My private article','This is a private article.','2010-01-31 12:31:56');",

    "DROP TABLE IF EXISTS `posts_tags`;",
    "CREATE TABLE `posts_tags` (
       `post_id` int(10) NOT NULL,
       `tag_id` int(10) NOT NULL,
       PRIMARY KEY (`post_id`,`tag_id`)
     ) ENGINE=MyISAM DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `sphinx`;",
    "CREATE TABLE `sphinx` (
       `id` int(10) unsigned NOT NULL,
       `weight` int(11) NOT NULL,
       `query` varchar(3072) NOT NULL,
       KEY `query` (`query`(1024))
     ) ENGINE=SPHINX DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `tags`;",
    "CREATE TABLE `tags` (
       `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
       `tag` varchar(255) NOT NULL,
       PRIMARY KEY (`id`),
       UNIQUE KEY `tag` (`tag`)
     ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;",
    "INSERT INTO `tags` VALUES (1,'computer'),(2,'php'),(3,'home'),(4,'sunday');",
);

