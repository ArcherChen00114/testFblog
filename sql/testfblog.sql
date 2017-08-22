-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-08-22 16:56:31
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testfblog`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `tg_id` mediumint(8) NOT NULL,
  `tg_username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `tg_title` varchar(40) CHARACTER SET utf8 NOT NULL,
  `tg_content` varchar(200) NOT NULL,
  `tg_type` tinyint(2) unsigned NOT NULL,
  `tg_readcount` smallint(5) unsigned NOT NULL,
  `tg_commentcount` smallint(5) unsigned NOT NULL,
  `tg_nice` tinyint(1) NOT NULL,
  `tg_last_modifydate` datetime NOT NULL,
  `tg_date` datetime NOT NULL,
  `tg_reid` mediumint(8) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`tg_id`, `tg_username`, `tg_title`, `tg_content`, `tg_type`, `tg_readcount`, `tg_commentcount`, `tg_nice`, `tg_last_modifydate`, `tg_date`, `tg_reid`) VALUES
(1, 'root', 'checkPostTitle', 'checkPostTitlecheckPostTitle', 1, 0, 0, 0, '0000-00-00 00:00:00', '2017-08-11 14:32:10', 0),
(2, 'root', 'checkPostTitle', 'checkPostTitlecheckPostTitlecheckPostTitle', 1, 13, 0, 0, '0000-00-00 00:00:00', '2017-08-11 14:34:04', 0),
(3, 'root', 'checkPostTitlecheckPostTitle', 'checkPostTitlecheckPostTitlecheckPostTitle', 1, 96, 0, 0, '0000-00-00 00:00:00', '2017-08-11 14:36:10', 0),
(4, 'root', 'to test timelimt', 'to test timelimtto test timelimtto test timelimt', 1, 1, 0, 0, '0000-00-00 00:00:00', '2017-08-14 17:15:57', 0);

-- --------------------------------------------------------

--
-- 表的结构 `dir`
--

CREATE TABLE IF NOT EXISTS `dir` (
  `tg_id` mediumint(8) NOT NULL,
  `tg_name` varchar(20) NOT NULL,
  `tg_type` tinyint(1) NOT NULL,
  `tg_password` char(40) NOT NULL,
  `tg_content` varchar(200) NOT NULL,
  `tg_face` varchar(200) NOT NULL,
  `tg_dir` varchar(200) NOT NULL,
  `tg_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `tg_id` int(8) NOT NULL COMMENT 'ID',
  `tg_touser` int(20) NOT NULL,
  `tg_fromuser` int(20) NOT NULL,
  `tg_content` varchar(200) NOT NULL,
  `tg_state` tinyint(1) NOT NULL DEFAULT '0',
  `tg_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `gift`
--

CREATE TABLE IF NOT EXISTS `gift` (
  `tg_id` mediumint(8) unsigned NOT NULL COMMENT '//id',
  `tg_touser` varchar(10) NOT NULL COMMENT '//who get gift',
  `tg_fromuser` varchar(10) NOT NULL COMMENT '//who sent gift',
  `tg_number` mediumint(8) unsigned NOT NULL COMMENT '//number of gift',
  `tg_content` varchar(200) NOT NULL COMMENT '//left message',
  `tg_date` datetime NOT NULL COMMENT '//time'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `tg_id` mediumint(8) unsigned NOT NULL,
  `tg_touser` varchar(20) NOT NULL COMMENT 'send to',
  `tg_fromuser` varchar(20) NOT NULL COMMENT 'who send',
  `tg_content` varchar(200) NOT NULL COMMENT 'cant more than 200 chars',
  `tg_date` datetime NOT NULL COMMENT 'sendtime',
  `tg_state` tinyint(1) NOT NULL COMMENT 'message statement'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`tg_id`, `tg_touser`, `tg_fromuser`, `tg_content`, `tg_date`, `tg_state`) VALUES
(1, 'root', 'root', '23333333333333333', '2017-08-02 14:30:05', 1),
(2, 'qwe537238', 'root', 'for testtttttttttt', '2017-08-02 14:31:20', 1),
(3, 'log1024', 'root', 'guess it should wokkkkkkkkkkkkkkkkkkkkkr', '2017-08-02 14:31:33', 1),
(4, '1034900424', 'root', 'guess waht? its for test', '2017-08-03 10:44:19', 1),
(5, '1034900424', 'root', 'nice to seeeee youuuuuu', '2017-08-03 19:47:15', 0);

-- --------------------------------------------------------

--
-- 表的结构 `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `tg_id` mediumint(8) NOT NULL,
  `tg_name` varchar(20) NOT NULL,
  `tg_url` varchar(200) NOT NULL,
  `tg_content` varchar(200) NOT NULL,
  `tg_sid` mediumint(8) NOT NULL,
  `tg_date` datetime NOT NULL,
  `tg_username` varchar(20) NOT NULL,
  `tg_readcount` smallint(5) NOT NULL,
  `tg_commentcount` smallint(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `photo_comment`
--

CREATE TABLE IF NOT EXISTS `photo_comment` (
  `tg_id` mediumint(8) unsigned NOT NULL,
  `tg_title` varchar(20) NOT NULL,
  `tg_content` text NOT NULL,
  `tg_sid` mediumint(8) unsigned NOT NULL,
  `tg_username` varchar(20) NOT NULL,
  `tg_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system`
--

CREATE TABLE IF NOT EXISTS `system` (
  `tg_id` mediumint(8) unsigned NOT NULL,
  `tg_webname` varchar(20) NOT NULL,
  `tg_article` tinyint(2) unsigned NOT NULL,
  `tg_blog` tinyint(2) unsigned NOT NULL,
  `tg_photo` tinyint(2) unsigned NOT NULL,
  `tg_skin` tinyint(1) unsigned NOT NULL,
  `tg_banstring` varchar(200) NOT NULL,
  `tg_post` tinyint(3) unsigned NOT NULL,
  `tg_re` tinyint(3) unsigned NOT NULL,
  `tg_code` tinyint(1) unsigned NOT NULL,
  `tg_register` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system`
--

INSERT INTO `system` (`tg_id`, `tg_webname`, `tg_article`, `tg_blog`, `tg_photo`, `tg_skin`, `tg_banstring`, `tg_post`, `tg_re`, `tg_code`, `tg_register`) VALUES
(1, 'Blog Of A Pathfinder', 10, 10, 8, 1, 'fuck|shit', 60, 15, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `tg_id` mediumint(8) NOT NULL COMMENT '用户编号(自动）',
  `tg_uniqid` char(40) NOT NULL COMMENT '用户辨识码',
  `tg_active` char(40) NOT NULL COMMENT '用户激活码',
  `tg_password` char(40) NOT NULL COMMENT '密码',
  `tg_username` varchar(20) NOT NULL COMMENT '用户名',
  `tg_answer` char(40) NOT NULL COMMENT '密码寻回回答',
  `tg_hint` varchar(20) NOT NULL COMMENT '密码寻回问题',
  `tg_qq` varchar(10) DEFAULT NULL COMMENT '用户QQ',
  `tg_email` varchar(40) DEFAULT NULL COMMENT '用户email',
  `tg_sex` char(1) NOT NULL COMMENT '用户性别',
  `tg_face` char(12) NOT NULL COMMENT '头像',
  `tg_switch` tinyint(1) NOT NULL,
  `tg_autograph` varchar(200) NOT NULL,
  `tg_register_date` datetime NOT NULL COMMENT '注册时间',
  `tg_last_logtime` datetime DEFAULT NULL COMMENT '最后登录时间',
  `tg_last_ip` varchar(20) NOT NULL COMMENT '最后登录IP',
  `tg_level` tinyint(1) unsigned NOT NULL COMMENT 'administer',
  `tg_login_count` smallint(4) NOT NULL COMMENT 'how many time you login',
  `tg_post_time` varchar(20) NOT NULL,
  `tg_reply_time` varchar(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`tg_id`, `tg_uniqid`, `tg_active`, `tg_password`, `tg_username`, `tg_answer`, `tg_hint`, `tg_qq`, `tg_email`, `tg_sex`, `tg_face`, `tg_switch`, `tg_autograph`, `tg_register_date`, `tg_last_logtime`, `tg_last_ip`, `tg_level`, `tg_login_count`, `tg_post_time`, `tg_reply_time`) VALUES
(2, 'af7f35cf529efe29f5243af939e5fe4b204a8253', '', 'b48cf1964734b7280e65b97b763a49a3a04dfe04', 'log1024', 'aaaaaa', 'aaaaaaa', '1034900424', '1034900424@qq.com', 'm', 'face/003.jpg', 0, '', '2017-07-31 11:14:41', '2017-08-16 14:29:27', '::1', 1, 10, '', ''),
(3, 'c46c2c62cb4b887a643f9d4b403f6c802f2af465', '', '8d21a6e47ee3c7a44fce2ba4bf44dc40149aebc4', 'qwe537238', 'aaaaa', 'aaaaaaa', '133121231', '133121231@qq.com', 'm', 'face/011.jpg', 0, '', '2017-07-31 11:15:30', '2017-07-31 11:15:30', '::1', 0, 0, '', ''),
(4, '65db8361cb229eba7c571956a94a99e5828ea715', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'root', 'aaaaa', 'aaaaaaa', '', '17730589066@qq.com', 'm', 'face/001.jpg', 1, '77777777777', '2017-07-31 11:30:17', '2017-08-14 19:32:18', '::1', 1, 12, '', ''),
(5, '3bddafed9c022266d12e85d53498f24074f0fc31', '', 'b48cf1964734b7280e65b97b763a49a3a04dfe04', '1034900424', 'aaaaaaa', 'aaaaaaa', '17652354', '1765234@qq.com', 'm', 'face/006.jpg', 0, '', '2017-08-02 15:34:14', '2017-08-02 15:34:14', '::1', 0, 0, '', ''),
(6, '794c31d0e538e3b446a364109720f3cb6f4f0cc1', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'newone', 'aaaaa', 'aaaaaaa', '177765424', '11778987@qq.com', 'm', 'face/001.jpg', 0, '', '2017-08-04 16:01:45', '2017-08-04 16:02:02', '::1', 0, 1, '', ''),
(7, 'f9bf5dfd173daf4a196ce0bbb4d96b1c4a831999', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'root123', 'aaaaa', 'aaaaaaa', '176523487', '178657657@qq.com', 'm', 'face/001.jpg', 0, '', '2017-08-04 16:06:28', '2017-08-04 16:06:28', '::1', 0, 0, '', ''),
(8, '55486952d9320e6d7362210381a2dbc898312ce2', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'new777', 'aaaaa', 'aaaaaaa', '777665558', '77766555@qq.com', 'm', 'face/001.jpg', 0, '', '2017-08-04 16:08:31', '2017-08-04 16:08:31', '::1', 0, 0, '', ''),
(9, '735e8508e913346b22275be89059eee3c968d2fd', '1f9969a1b743e36a3f62c8bdf7533caa435062ac', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'new123', 'aaaaa', 'aaaaaaa', '12345789', '789545652@qq.com', 'm', 'face/001.jpg', 0, '', '2017-08-04 16:10:53', '2017-08-04 16:10:53', '::1', 0, 0, '', ''),
(10, '96c5a8d380fb000e68db96f20d577cd25bad466d', '122abb2198dc10d98c739ed8a5ae1085ab1a12e3', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'new888', 'aaaaa', 'aaaaaaa', '12345789', '7895456512@qq.com', 'm', 'face/001.jpg', 0, '', '2017-08-04 16:11:40', '2017-08-04 16:11:40', '::1', 0, 0, '', ''),
(11, 'a8b687ffb667211e4755a16ac1e190dcbc0395e3', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'new8887', 'aaaaa', 'aaaaaaa', '12345789', '785456512@qq.com', 'm', 'face/001.jpg', 0, '', '2017-08-04 16:12:05', '2017-08-04 16:12:05', '::1', 0, 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `dir`
--
ALTER TABLE `dir`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `photo_comment`
--
ALTER TABLE `photo_comment`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`tg_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`tg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `tg_id` mediumint(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dir`
--
ALTER TABLE `dir`
  MODIFY `tg_id` mediumint(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `tg_id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `gift`
--
ALTER TABLE `gift`
  MODIFY `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//id';
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `tg_id` mediumint(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photo_comment`
--
ALTER TABLE `photo_comment`
  MODIFY `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `tg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `tg_id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '用户编号(自动）',AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
