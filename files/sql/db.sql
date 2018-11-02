-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- 생성 시간: 16-08-18 09:41
-- 서버 버전: 10.1.13-MariaDB
-- PHP 버전: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `web001`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `doctors`
--

CREATE TABLE `doctors` (
  `idx` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `manner` varchar(255) NOT NULL,
  `popular` int(11) NOT NULL,
  `popular_text` varchar(255) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `doctors`
--

INSERT INTO `doctors` (`idx`, `type`, `name`, `manner`, `popular`, `popular_text`, `x`, `y`, `image`) VALUES
(23, '내과', '김광원', 'Good', 45, 'Good', 50, 300, 'doc_1.jpg'),
(24, '내과', '홍영선', 'Great', 10, 'Bad', 150, 120, 'doc_2.jpg'),
(25, '내과', '하하호', 'Good', 45, 'Great', 200, 500, 'doc_3.jpg'),
(26, '정신건강의학과', '최명규', 'Bad', 22, 'Bad', 1000, 650, 'doc_4.jpg'),
(27, '정신건강의학과', '이규식', 'Bad', 5, 'Bad', 700, 500, 'doc_5.jpg'),
(28, '흉부외과', '장현규', 'Excellent', 5, 'Great', 300, 100, 'doc_6.jpg'),
(29, '흉부외과', '조건현', 'Excellent', 90, 'Excellent', 200, 600, 'doc_7.jpg'),
(30, '흉부외과', '송병주', 'Terrible', 5, 'Terrible', 650, 350, 'doc_8.png'),
(31, '소아청소년과', '후우카', 'Holy', 65, 'Bad', 1200, 300, 'doc_10.jpg'),
(32, '소아청소년과', '성공제', 'Great', 65, 'Excellent', 1500, 600, 'doc_13.jpg'),
(33, '소아청소년과', '주진양', 'Bad', 23, 'Bad', 1100, 120, 'doc_14.jpg');

-- --------------------------------------------------------

--
-- 테이블 구조 `major`
--

CREATE TABLE `major` (
  `idx` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `major`
--

INSERT INTO `major` (`idx`, `type`) VALUES
(1, '내과'),
(2, '신경과'),
(3, '정신건강의학과'),
(4, '외과'),
(5, '정형외과'),
(6, '신경외과'),
(7, '흉부외과'),
(8, '성형외과'),
(9, '마취통증의학과'),
(10, '산부인과'),
(11, '소아청소년과'),
(12, '안과'),
(13, '이비인후과'),
(14, '피부과'),
(15, '비뇨기과'),
(16, '영상의학과'),
(17, '방사선종양학과'),
(18, '병리과'),
(19, '진단검사의학과'),
(20, '결핵과'),
(21, '재활의학과'),
(22, '예방의학과'),
(23, '가정의학과'),
(24, '응급의학과'),
(25, '핵의학'),
(26, '직업환경의학과');

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `idx` int(11) NOT NULL,
  `id` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`idx`, `id`, `pw`) VALUES
(1, 'admin', '1234'),
(2, 'user', '1234'),
(3, 'rock', 'roll'),
(4, 'clzls123', 'qlenfrl'),
(5, 'ehlwl123', 'qnxk'),
(6, 'vlwkclzls', '1234'),
(7, 'tjdnftlwkd', 'tlwkd'),
(8, 'tjdnfehwltk', 'ehwltk');

-- --------------------------------------------------------

--
-- 테이블 구조 `reserve`
--

CREATE TABLE `reserve` (
  `idx` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `rdate` date NOT NULL,
  `ndate` date NOT NULL,
  `r_name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `reserve`
--

INSERT INTO `reserve` (`idx`, `type`, `doctor`, `rdate`, `ndate`, `r_name`, `code`) VALUES
(7, '내과', '김광원', '2016-08-20', '2016-08-18', 'admin', 'RJC');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `doctors`
--
ALTER TABLE `doctors`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- 테이블의 AUTO_INCREMENT `major`
--
ALTER TABLE `major`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 테이블의 AUTO_INCREMENT `reserve`
--
ALTER TABLE `reserve`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
