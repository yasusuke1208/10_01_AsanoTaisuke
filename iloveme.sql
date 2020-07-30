-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-07-30 15:47:26
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `iloveme`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `project_table`
--

CREATE TABLE `project_table` (
  `id` int(12) NOT NULL,
  `higai_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `kagai_namae` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `kagai_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `jidan_money` int(12) DEFAULT NULL,
  `budget` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `project_table`
--

INSERT INTO `project_table` (`id`, `higai_name`, `kagai_namae`, `kagai_name`, `detail`, `jidan_money`, `budget`) VALUES
(6, '@higan1208', '誹謗中傷ツイート実験', '@Z5TEGjgWE4EQ5O0', '@higan1208 \r\nおまえなんていなくなればいい', 100000, 80000),
(9, '@higan1208', '誹謗中傷ツイート実験', '@Z5TEGjgWE4EQ5O0', '@higan1208 はい、人生そこまで。\r\nよくできました、そのまま死んでください。', 1000000, 200000),
(10, '@Becky_bekiko', 'peco', '@peco65232741', '@Becky_bekiko やべえのは貴方の下半身', 300000, 150000);

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `is_higai` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `username`, `password`, `is_admin`, `is_deleted`, `is_higai`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 0, 0, 0, '2020-07-23 14:10:33', '2020-07-23 14:47:03'),
(2, 'hoge', 'hoge', 0, 0, 0, '2020-07-23 15:35:00', '2020-07-23 15:35:00'),
(3, 'koji', 'koji', 0, 0, 0, '2020-07-23 16:49:00', '2020-07-23 16:49:00'),
(4, 'bengo1', 'bengo1', 1, 0, 0, '2020-07-23 17:03:42', '2020-07-23 17:03:42'),
(5, '@Becky_bekiko', '@Becky_bekiko', 0, 0, 1, '2020-07-23 17:52:29', '2020-07-23 17:52:29'),
(6, 'fujii', 'fujii', 0, 0, 0, '2020-07-23 23:44:57', '2020-07-23 23:44:57'),
(7, '@higan1208', '@higan1208', 0, 0, 1, '2020-07-24 11:29:10', '2020-07-24 11:29:10');

-- --------------------------------------------------------

--
-- テーブルの構造 `yell_table`
--

CREATE TABLE `yell_table` (
  `id` int(12) NOT NULL,
  `p_id` int(12) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `money` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `yell_table`
--

INSERT INTO `yell_table` (`id`, `p_id`, `username`, `message`, `money`) VALUES
(1, 1, 'test', 'ベッキーは悪くないよ！私は味方だよ。一緒に戦おう！', 1000),
(2, 1, 'hoge', 'ベッキーの頑張りはいつも見てきたよ！ベッキーは悪いことしてないよ！悪意ある人に負けないで！', 3000),
(3, 2, 'hoge', 'はるかぜちゃん、がんばれ！誹謗中傷が真っ向から向き合って戦っている姿に感動しました！！', 8000),
(4, 2, 'koji', '春風ちゃんの提言に感動しました。自分も誹謗中傷がない世界をつくるために応援します。', 25000),
(5, 1, 'fujii', 'ベッキー大好き！いつまでもその笑顔を見ていたいです！', 30000),
(6, 6, 'test', 'そんなことないよ！', 6000),
(7, 6, 'test', 'いつもラジオ聴いています。突然中止になってとても寂しいです。\r\nはやく戻ってきてください。', 50000),
(8, 6, 'test', '毎朝歌を聴いて励まされています。ライブ、楽しみにしていました。福岡にきてくれるのを待っています。', 10000),
(9, 6, 'test', '俺たちがいつも味方だぜ！心配するな。待ってるぜ。', 20000),
(10, 6, 'test', 'あいしてるーーーーーーーー❤️', 50000),
(11, 6, 'test', 'またテレビで元気な姿が見れるのを信じてるよ。', 5000),
(12, 6, 'test', '勝手なことをいっているヤツ、腹立つわ！\r\nあいつこそいなくなればいいのに。\r\n', 1000),
(13, 2, 'test', 'ひどい！失礼にもほどがある。\r\n許せない。', 1000),
(14, 6, 'test', 'どんな失敗をしても、ヒガンさんは、ヒガンさん。なにがあっても私たちがそばにいます。', 8000),
(15, 6, 'test', '負けないで！\r\n一緒に戦おう！\r\n', 1000),
(16, 6, 'test', '私がいじめられていた時、ヒガンさんのラジオで励まされていました。これからも応援しています。', 5000),
(17, 9, 'bengo1', 'ファイト', 48000);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `project_table`
--
ALTER TABLE `project_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `yell_table`
--
ALTER TABLE `yell_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `project_table`
--
ALTER TABLE `project_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルのAUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルのAUTO_INCREMENT `yell_table`
--
ALTER TABLE `yell_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
