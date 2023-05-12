-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.33 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para nailhair
CREATE DATABASE IF NOT EXISTS `nailhair` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `nailhair`;

-- Volcando estructura para tabla nailhair.citas
CREATE TABLE IF NOT EXISTS `citas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_cita` datetime NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `user_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `citas_user_id_foreign` (`user_id`),
  KEY `citas_post_id_foreign` (`post_id`),
  CONSTRAINT `citas_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `citas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nailhair.citas: ~11 rows (aproximadamente)
DELETE FROM `citas`;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` (`id`, `fecha_cita`, `ubicacion`, `estado`, `active`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
	(1, '2022-05-27 08:29:00', 'Carrera 00 # 00 D 00', 'cancelada', 'yes', 4, 1, '2022-04-26 08:29:36', '2022-05-24 01:31:34'),
	(2, '2022-04-28 11:29:00', 'Carrera 00 # 00 D 00', 'descartada', 'yes', 4, 1, '2022-04-26 08:30:02', '2022-06-21 07:44:40'),
	(3, '2022-05-20 21:00:00', 'Sabaneta, Antioquia', 'confirmada', 'yes', 3, 2, '2022-05-02 18:11:10', '2022-05-24 01:17:01'),
	(4, '2022-05-27 22:00:00', 'Sabaneta, Antioquia', 'pendiente', 'yes', 3, 2, '2022-05-09 09:16:27', '2022-05-24 01:17:47'),
	(5, '2022-05-25 22:00:00', 'Sabaneta, Antioquia', 'descartada', 'yes', 1, 2, '2022-05-17 08:44:15', '2022-06-21 07:47:59'),
	(6, '2022-05-25 04:00:00', 'Itagui', 'descartada', 'yes', 4, 3, '2022-05-18 00:24:31', '2022-06-21 00:22:08'),
	(7, '2022-06-14 09:00:00', 'Sabaneta, Antioquia', 'pendiente', 'yes', 3, 2, '2022-05-26 09:30:07', '2022-05-26 09:30:07'),
	(8, '2022-06-20 00:00:00', 'Carrera 00 # 00 D 00', 'descartada', 'yes', 4, 1, '2022-05-26 09:31:01', '2022-06-21 00:22:11'),
	(9, '2022-06-30 15:10:00', 'Carrera 00 # 00 D 00', 'confirmada', 'yes', 10, 1, '2022-06-20 21:46:04', '2022-06-28 09:30:26'),
	(10, '2022-06-30 10:00:00', 'Sabaneta, Antioquia', 'cancelada', 'yes', 1, 2, '2022-06-21 07:46:48', '2022-06-21 07:48:11'),
	(11, '2022-06-23 15:52:00', 'Sabaneta, Antioquia', 'pendiente', 'yes', 1, 2, '2022-06-21 15:52:18', '2022-06-21 15:52:18'),
	(12, '2022-07-01 11:30:00', 'Sabaneta, Antioquia', 'pendiente', 'yes', 3, 2, '2022-06-28 09:26:28', '2022-06-28 09:26:28');
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;

-- Volcando estructura para tabla nailhair.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nailhair.failed_jobs: ~0 rows (aproximadamente)
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Volcando estructura para tabla nailhair.likes
CREATE TABLE IF NOT EXISTS `likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `user_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `likes_user_id_foreign` (`user_id`),
  KEY `likes_post_id_foreign` (`post_id`),
  CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nailhair.likes: ~11 rows (aproximadamente)
DELETE FROM `likes`;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` (`id`, `active`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
	(1, 'yes', 3, 2, '2022-04-02 18:10:51', '2022-05-26 11:39:53'),
	(2, 'yes', 3, 1, '2022-05-08 22:43:01', '2022-05-18 21:01:00'),
	(3, 'yes', 4, 1, '2022-05-08 22:43:22', '2022-05-08 22:43:29'),
	(4, 'yes', 3, 3, '2022-05-09 09:14:20', '2022-05-18 21:00:25'),
	(5, 'no', 5, 3, '2022-05-26 09:44:07', '2022-05-26 09:44:24'),
	(6, 'yes', 5, 2, '2022-06-05 01:16:18', '2022-06-05 01:19:47'),
	(7, 'yes', 5, 4, '2022-06-20 21:55:00', '2022-06-20 21:55:00'),
	(8, 'yes', 3, 10, '2022-06-21 07:07:09', '2022-06-21 07:07:09'),
	(9, 'yes', 1, 2, '2022-06-21 15:51:27', '2022-06-21 15:51:27'),
	(10, 'yes', 4, 9, '2022-06-28 00:06:29', '2022-06-28 00:06:29'),
	(11, 'yes', 11, 9, '2022-06-28 00:06:35', '2022-06-28 00:06:35'),
	(12, 'yes', 3, 9, '2022-06-28 00:06:52', '2022-06-28 00:06:52'),
	(13, 'yes', 5, 9, '2022-06-28 00:07:07', '2022-06-28 00:07:07'),
	(14, 'yes', 5, 1, '2022-06-28 09:42:07', '2022-06-28 09:42:07');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;

-- Volcando estructura para tabla nailhair.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nailhair.migrations: ~8 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_03_04_023947_create_posts_table', 1),
	(6, '2022_03_20_001611_create_citas_table', 1),
	(7, '2022_03_21_194005_create_ratings_table', 1),
	(8, '2022_03_23_235050_create_likes_table', 1),
	(9, '2022_05_03_005208_create_supports_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla nailhair.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nailhair.password_resets: ~2 rows (aproximadamente)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('tinalaur14@gmail.com', '$2y$10$lyijDuzHm9GtzGfE9i4cEudrb2ppd54H6pz6184UrvC4LFLfM7Zki', '2022-06-21 06:31:39'),
	('mateocifuentes612@gmail.com', '$2y$10$SzvWg/VL4Um53VAdwJa/pe6E0/mQE2xN7vIznnlxgHkIT9aMZlDtu', '2022-06-28 09:28:33');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla nailhair.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nailhair.personal_access_tokens: ~0 rows (aproximadamente)
DELETE FROM `personal_access_tokens`;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Volcando estructura para tabla nailhair.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `banner1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'banner1.jpg',
  `banner2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'banner1.jpg',
  `banner3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'banner1.jpg',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nailhair.posts: ~21 rows (aproximadamente)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `banner1`, `banner2`, `banner3`, `title`, `body`, `address`, `likes`, `active`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'giorgio-trovato-gb6gtiTZKB8-unsplash_1656388914.jpg', 'banner1.jpg', 'banner1.jpg', 'Uñas en promocion, ven ya, no tardes!!', 'Promocion 2 x 1 en todo tipo de manicura a tu gusto', 'Carrera 00 # 00 D 00', 3, 'yes', 3, '2022-04-06 08:23:04', '2022-06-28 09:42:07'),
	(2, 'adam-winger-FkAZqQJTbXM-unsplash_1656389105.jpg', 'suheyl-burak-N85JOkU3DW0-unsplash_1656389107.jpg', 'banner1.jpg', 'Peluquería al gusto', 'Cortes a todo gusto, ubicados en sabaneta', 'Sabaneta, Antioquia', 3, 'yes', 4, '2022-04-11 08:26:07', '2022-06-27 23:05:08'),
	(3, 'rune-enstad-W0_shKarGCk-unsplash (1)_1656389525.jpg', 'imani-bahati-L1kLSwdclYQ-unsplash_1656389526.jpg', 'juja-han-Z8-6EI2tYtw-unsplash_1656389526.jpg', 'Pedicura en promocion', 'Hay descuentos', 'Itagui', 1, 'yes', 3, '2022-05-05 22:13:55', '2022-06-28 00:43:17'),
	(4, 'jesse-donoghoe-2aiP_wxNrfU-unsplash_1656388945.jpg', 'banner1.jpg', 'ellie-eshaghi-DtoWpHt2_d8-unsplash_1656388946.jpg', 'UÑAS ACRÍLICAS, SEMIPERMANENTE Y MUCHO MÁS', 'Te ofrecemos amplia variedad en tipos de arreglo de uñas, pregunta por el que más te guste.', 'carrera 48b #108-99', 1, 'yes', 10, '2022-06-20 21:42:48', '2022-06-27 23:02:27'),
	(5, 'manicura_1655811406.jpg', 'banner1.jpg', 'banner1.jpg', 'Todo tipo de procedimientos de uñas', 'Ven a nuestra sede en aranjuez donde podrás acceder a todo tipo de procedimientos de uñas, manicura y pedicura.', 'Cra. 47 #93-2 a 93-118', 0, 'yes', 10, '2022-06-21 06:36:46', '2022-06-21 15:57:19'),
	(6, 'pedicura-1280x720x80xX_1655811562.jpg', 'banner1.jpg', 'banner1.jpg', 'Pedicura en descuento, hasta el 50%!!', 'Acércate a nuestra sede en sabaneta, donde todos los procedimientos de pies y pedicura están al hasta 50%', 'Cra. 40 #38a Sur-72 a 38a Sur-2', 0, 'yes', 10, '2022-06-21 06:39:22', '2022-06-21 15:57:19'),
	(7, 'images_1655811841.jpg', 'banner1.jpg', 'banner1.jpg', 'Se realizan todo tipo de trabajos en peluquería como cambios de tono, keratina, alisado, etc, -Peluquería Gomez', 'Accede a nuestros servicios, estamos ubicados por el playon de los comuneros, si deseas ver mas informacion ve a nuestros instagram', 'Cl. 125 #50e-49 a 50e-1', 0, 'yes', 3, '2022-06-21 06:44:01', '2022-06-28 00:39:10'),
	(8, 'secador-cabello2_1655812099.jpg', 'banner1.jpg', 'banner1.jpg', 'Servicio de keratinas', 'Vendemos y aplicamos todo tipo de queratinas de diferentes marcas y precio al gusto, acércate a nuestra sede en el parque Berrio', 'Av. Ayacucho #51-129 a 51-1', 0, 'yes', 4, '2022-06-21 06:48:19', '2022-06-21 06:48:19'),
	(9, 'maxresdefault_1655812182.jpg', 'banner1.jpg', 'banner1.jpg', 'Diseños en uñas, Distintos precios', 'Nos especializamos en realizar diseños en uñas al gusto de todo tipo y como la persona lo desee,  animate! agenda una cita', 'Av. Ayacucho #51-129 a 51-1', 4, 'yes', 4, '2022-06-21 06:49:42', '2022-06-28 00:07:07'),
	(10, 'descarga_1655812308.jpg', 'descarga_1655812569.jpg', 'banner1.jpg', 'Aplicación de tintes con 25% de descuento en nuestra nueva sede! Ven a conocernos', 'Tenemos muy buenas ofertas  en los tintes y aplicación de ellos en nuestra sede recién inaugurada, que esperas, ven y cambia tu look!', 'Cra. 50 #45-144', 1, 'yes', 3, '2022-06-21 06:51:48', '2022-06-28 00:39:10'),
	(11, 'images_1655844832.jpg', 'banner1.jpg', 'banner1.jpg', 'Prueba Editada', 'Probando el sistema de anuncios editado', 'Sena Pedregal', 0, 'yes', 3, '2022-06-21 15:53:52', '2022-06-28 00:39:10'),
	(12, 'lindsay-cash-Md_DhaFsnCQ-unsplash_1656390513.jpg', 'adam-winger-WXmHwPcFamo-unsplash_1656390513.jpg', 'banner1.jpg', 'Peluquería las Juanas, ubicada en Aranjuez, Ven!!', 'Peluquería recién inaugurada en el sector del parque de Aranjuez, hay promociones de apertura, ven y ahorra mientras te pones mas bella', 'Calle 44 #66 d 45, Aranjuez', 0, 'yes', 11, '2022-06-27 23:28:33', '2022-06-27 23:43:17'),
	(13, 'giorgio-trovato-wSpkThmoZQc-unsplash_1656391530.jpg', 'banner1.jpg', 'banner1.jpg', 'Rizos perfectos con nuestro tratamiento en descuento!', 'Tenemos un nuevo tratamiento de descuento importado para darte rizos perfectos, Agenda!', 'Calle 44 #66 d 45, Aranjuez', 0, 'yes', 11, '2022-06-27 23:45:30', '2022-06-27 23:45:30'),
	(14, 'guilherme-petri-PtOfbGkU3uI-unsplash_1656391642.jpg', 'valeriia-kogan-CIrRI0ujiRo-unsplash_1656391642.jpg', 'banner1.jpg', 'Peluqueria El buen toque', 'Nuestra peluqueria esta ubicada a 200 mts del parque del playon en bello, nuestras peluqueras son las mejores ven', 'carrera 44 #20D42, Bello', 0, 'yes', 3, '2022-06-27 23:47:22', '2022-06-28 00:39:10'),
	(15, 'engin-akyurt-Ix4D4-8cQUU-unsplash_1656391818.jpg', 'banner1.jpg', 'banner1.jpg', 'Peinados para ocasiones especiales!', 'Brindamos servicio de peinado para todas las ocasiones que requiera, precios economicos', 'Sena Pedregal', 0, 'yes', 11, '2022-06-27 23:50:18', '2022-06-27 23:50:18'),
	(16, 'anabelle-carite-_wofGSSFb1Q-unsplash_1656391917.jpg', 'adam-winger-HEde-a_T4E8-unsplash_1656391918.jpg', 'banner1.jpg', 'Tratamiento para el crecimiento del cabello', 'Aplicamos un tratamiento para crecimiento del cabello, agenda para resolver todas tus dudas', 'carrera 48b #108-74', 0, 'yes', 3, '2022-06-27 23:51:58', '2022-06-28 00:39:10'),
	(17, 'felicia-montenegro-gF97mkC3NGo-unsplash_1656392096.jpg', 'banner1.jpg', 'banner1.jpg', 'Las mejores uñas acrilicas', 'Aplicamos uñas acrilicas al mejor precio y con las mejor calidad, agenda para tener tu cita', 'carrera 44 #20D22', 0, 'yes', 4, '2022-06-27 23:54:57', '2022-06-27 23:54:57'),
	(18, 'felicia-montenegro-JYV-mh4Ss9w-unsplash_1656392217.jpg', 'banner1.jpg', 'banner1.jpg', 'Relizamos arte en las uñas de todo tipo', 'Realizamos ilustraciones, incrustaciones, flores, etc. en tus uñas, Agenda', 'Itagui, Ditaires', 0, 'yes', 4, '2022-06-27 23:56:57', '2022-06-27 23:56:57'),
	(19, 'maksim-chernishev-PaEFID0r2yo-unsplash_1656392334.jpg', 'jessie-dee-dabrowski-www-jessiedee-net-TETR8YLSqt4-unsplash_1656392334.jpg', 'banner1.jpg', 'Cotizacion y aplicacion de todo tipo de tintes y tonos', 'Nos especializamos en la aplicacion de tintes y tonos en el pelo como se ve en las imagenes, Si deseas puedes agendar una cita con nosotros por este medio', 'Carrera 00 # 00 D 07', 0, 'yes', 4, '2022-06-27 23:58:54', '2022-06-27 23:58:54'),
	(20, 'giorgio-trovato-XQlRnx0nfAs-unsplash_1656392470.jpg', 'banner1.jpg', 'banner1.jpg', 'Alisados para el pelo 2x1', 'Estamos en promoción!, todos los procedimientos de alisado para el cabello se encuentras en 2x1.', 'Carrera 070 # 10 D 00', 0, 'yes', 4, '2022-06-28 00:01:10', '2022-06-28 00:01:10'),
	(21, 'budka-damdinsuren-jRXxNpA6d_k-unsplash_1656392609.jpg', 'kartik-gada--4iMX-4MIZ8-unsplash_1656392609.jpg', 'banner1.jpg', 'Nuevas tonalidades para manicura!', 'Llegaron nuevos diseños para nuestros procedimientos de manicura, Agenda para poder acceder a estos', 'Carrera 00 # 70 D 80', 0, 'yes', 11, '2022-06-28 00:03:29', '2022-06-28 00:03:29'),
	(22, 'sq-lim-FsSg3fURJMI-unsplash_1656392701.jpg', 'priscilla-du-preez-e6fcNpur53A-unsplash_1656392701.jpg', 'banner1.jpg', 'Nuevo servicio de pedicura', 'Ofrecemos nuevo servicio de pedicura en nuestro local en Aranjuez, Agenda una cita!', 'Calle 44 #66 d 45, Aranjuez', 0, 'yes', 11, '2022-06-28 00:05:01', '2022-06-28 00:05:01'),
	(23, 'priscilla-du-preez-e6fcNpur53A-unsplash_1656426306.jpg', 'banner1.jpg', 'banner1.jpg', 'pppp', 'probando el sistema de posts', 'Sena Pedregal', 0, 'yes', 3, '2022-06-28 09:25:07', '2022-06-28 09:25:07');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Volcando estructura para tabla nailhair.ratings
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comentario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estrellas` decimal(4,2) NOT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_user_id_foreign` (`user_id`),
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nailhair.ratings: ~9 rows (aproximadamente)
DELETE FROM `ratings`;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` (`id`, `nombre`, `usuario`, `avatar`, `comentario`, `estrellas`, `active`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Diego Cardenas', 'diego11', '1655813155.jpg', 'Gran servicio, aunque llego tarde', 1.00, 'yes', 3, '2022-04-26 08:27:52', '2022-06-21 07:05:55'),
	(2, 'Mateo Cifuentes Gomez', 'mate11', '1656388372.jpg', 'Gran servicio', 4.00, 'yes', 4, '2022-05-09 09:14:57', '2022-06-27 22:52:53'),
	(3, 'Pedro Paramo', 'pedro45', '1656388568.jpg', 'No me gusto su trabajo', 1.00, 'yes', 4, '2022-06-04 23:35:13', '2022-06-27 22:56:08'),
	(4, 'Pedro Paramo', 'pedro45', '1656388568.jpg', 'Genial atencion', 4.00, 'yes', 3, '2022-06-05 02:18:00', '2022-06-27 22:56:08'),
	(5, 'Laura Guzman', 'estrellita22', '1655779676.jpg', NULL, 5.00, 'yes', 3, '2022-06-20 21:44:11', '2022-06-27 22:56:50'),
	(6, 'Cliente Juan', 'Cliente0', '1656388465.jpg', 'Genial Servicio', 4.00, 'yes', 4, '2022-06-21 07:48:38', '2022-06-27 22:54:26'),
	(7, 'Cliente Juan', 'Cliente0', '1656388465.jpg', 'Genial atencion', 4.00, 'yes', 3, '2022-06-21 15:51:49', '2022-06-27 22:54:26'),
	(8, 'Estefania Arco', 'estefa44', '1656389913.jpg', 'Definitivamente, tiene un gran talento para la cosmetica! Muy satisfecha', 5.00, 'yes', 4, '2022-06-28 00:08:15', '2022-06-28 00:08:15'),
	(9, 'Laura Guzman', 'estrellita22', '1655779676.jpg', 'No me agrado su actitud en el trabajo, debe mejorar eso', 2.00, 'yes', 4, '2022-06-28 00:14:46', '2022-06-28 00:14:46');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;

-- Volcando estructura para tabla nailhair.supports
CREATE TABLE IF NOT EXISTS `supports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asunto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respuesta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `asesor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supports_user_id_foreign` (`user_id`),
  CONSTRAINT `supports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nailhair.supports: ~2 rows (aproximadamente)
DELETE FROM `supports`;
/*!40000 ALTER TABLE `supports` DISABLE KEYS */;
INSERT INTO `supports` (`id`, `image`, `asunto`, `descripcion`, `respuesta`, `active`, `asesor`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Test', 'this is a test of the PQRS system', 'the PQRS system works perfectly', 'resolved', 'pedro45', 3, '2022-05-03 01:52:54', '2022-05-08 22:18:57'),
	(2, '1651636534.jpg', 'Prueba del PQRS', 'Ayuda mi cuyenta no funciona,\r\nAyudaaaaaaaaaaaaaa', 'No me mandaste suficiente informacioón, mandame x,y,z y crea otro ticket.', 'finished', 'pedro45', 3, '2022-05-03 22:55:34', '2022-05-09 09:28:02'),
	(3, '1652067203.jpg', 'Problema al enviar una cita', 'No funciono el sistema de envio de citas, ayuda por favor', 'No me das suficientes detalles para poder resolver tu inquietud, lo siento.', 'finished', 'pedro45', 4, '2022-05-08 22:33:24', '2022-05-08 22:39:41'),
	(4, '1652106338.png', 'Problema al enviar una cita', 'No se guardo mi cita para mañana', 'Debes darle click en el botón agendar para que se guarde la cita.', 'resolved', 'pedro45', 3, '2022-05-09 09:25:39', '2022-06-21 00:16:28'),
	(5, '1653530091.png', 'Ayuda mi imagen no se envió correctamente', 'Mi imagen esta corrupta al enviarla.', 'Solucion de ejemplo', 'resolved', 'pedro45', 3, '2022-05-25 20:54:51', '2022-06-21 15:59:01'),
	(6, '1655788877.jpg', 'Problema con un cliente', 'Un cliente envío demasiadas citas que se acumularon en mi interfaz, podrian porfavor eliminarlas, Muchas gracias.', 'Solucion equis', 'resolved', 'pedro45', 3, '2022-06-21 00:21:17', '2022-06-28 09:39:13'),
	(7, '1655815787.jpg', 'Problema al enviar una cita', 'Mi cita no se guardo correctamente por que se fue la luz', 'Esto es un problema ajeno a la pagina web, agende de nuevo su cita y de click en el botón agendar para que se guarde', 'resolved', 'asesorJuan', 3, '2022-06-21 07:49:47', '2022-06-21 07:52:38'),
	(8, '1655845190.jpg', 'Prueba del PQRS', 'Prueba de error', NULL, 'pending', NULL, 3, '2022-06-21 15:59:50', '2022-06-21 15:59:50'),
	(9, NULL, 'Problema No se confirman mis citas', 'No me deja confirmar mis citas, Ayuda por favor, me dice error 414.', NULL, 'pending', NULL, 3, '2022-06-28 00:28:10', '2022-06-28 00:28:10');
/*!40000 ALTER TABLE `supports` ENABLE KEYS */;

-- Volcando estructura para tabla nailhair.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `cedula` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_cel_unique` (`cel`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nailhair.users: ~11 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `email`, `cel`, `email_verified_at`, `avatar`, `cedula`, `password`, `tipo`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Cliente Juan', 'Cliente0', 'ejemplos@gmail.com', '30000000', NULL, '1656388465.jpg', NULL, '$2y$10$k6aaDQxpdoMr33VU6o/s1O/VGSXHlntZTtbN6cbrRnTX8LfKKowq.', 'cliente', 'yes', NULL, '2022-04-25 23:08:20', '2022-06-27 22:54:26'),
	(3, 'Mateo Cifuentes Gomez', 'mate11', 'mateocifuentes612@gmail.com', '3002533498', NULL, '1656388372.jpg', '1650979480.pdf', '$2y$10$uc45FYUGPgioIdnsHwfoYurb4obPQ6jd.YDoqTRPPktByyBM69tcG', 'trabajador', 'yes', NULL, '2022-04-25 23:36:23', '2022-06-28 00:39:10'),
	(4, 'Diego Cardenas', 'diego11', 'dantetest@gmail.com', '3002541521', NULL, '1655813155.jpg', '1650979480.pdf', '$2y$10$CEQ/cMZp1SoBeGCxmoNp9.9isxCL/MdmWqLvb.d3rL.onoJeHANMW', 'trabajador', 'yes', NULL, '2022-04-26 08:24:40', '2022-06-21 07:05:55'),
	(5, 'Pedro Paramo', 'pedro45', 'ejemplos45@gmail.com', '3014413415', NULL, '1656388568.jpg', NULL, '$2y$10$LNMyDlkVb/h0R2ZmkABmK.z3f/qTOUm55ou8sSRG0W8O0V7J8z06K', 'admin', 'yes', NULL, '2022-04-28 02:25:00', '2022-06-27 22:56:08'),
	(6, 'PruebaBorrar', 'prueba475', 'ejemplos11@gmail.com', '3074444444', NULL, '1652106085.jpg', '1650979480.pdf', '$2y$10$3wYhoGZk7bJjuwHd38UVuuGVYyyNV6Mk27oaAW7dcAGjarGjMkKHe', 'trabajador', 'yes', NULL, '2022-05-09 09:21:25', '2022-05-09 09:23:52'),
	(8, 'Random', 'randomdude1130', 'dantetest11@gmail.com', '3000000000', NULL, '1652794902.jpg', '1652794902.pdf', '$2y$10$i5KgvemgS7IYF7.KKYPfM.sfOJko2nqWIZ6TJO4EQSGVjA1EwAI/G', 'trabajador', 'pending', NULL, '2022-05-17 08:41:42', '2022-06-21 07:51:34'),
	(9, 'Asesor', 'asesorJuan', 'cujando4@gmail.com', '3005241022', NULL, 'default.jpg', NULL, '$2y$10$0Ut9RE8h6XejisMx2R.l5Oy/A9zfTljXkyNMa86Ls3PmpcRyZcdGe', 'asesor', 'yes', 'wz1VaemfZNcGfQHB42pE36nybl3WIWy3hmmSqJNMlPPWRw9rG6du4tlciCSm', '2022-06-10 13:30:28', '2022-06-28 01:05:46'),
	(10, 'Laura Guzman', 'estrellita22', 'tinalaur14@gmail.com', '3014413416', NULL, '1655779676.jpg', '1655778842.pdf', '$2y$10$wmYRwwftLSMGoB7mpMYMHeXxwYpRe4ft2CbLsCK6SbL3t3UFbfgV2', 'trabajador', 'yes', 'M7ADehpDu5x8jhIfjaXQnsvNPkojVWXS6uNhCvDKhxKDjpareeXj58mQ3Ioq', '2022-06-20 21:34:02', '2022-06-27 22:56:50'),
	(11, 'Estefania Arco', 'estefa44', 'ejemplos2@gmail.com', '300000000', NULL, '1656389913.jpg', '1656389913.jpg', '$2y$10$23DXOfjeCxyEGBMb2iz5MOTqy7N9V6CBwQNLXrVVAlZOMC5i3UDNW', 'trabajador', 'yes', NULL, '2022-06-27 23:18:33', '2022-06-27 23:21:12'),
	(13, '<script>alert("Hackeado")</script>', 'prueba2000', 'ejemplos4@gmail.com', '3230000000', NULL, 'default.jpg', NULL, '$2y$10$xQlvV4ktuiug4Komrg2Jvu6iubQz71Ui8yTd1Vmql8MdWyiiwX0gW', 'asesor', 'yes', NULL, '2022-06-28 09:12:48', '2022-06-28 09:41:47'),
	(14, 'Mateo', 'mate12', 'dantetes2t@gmail.com', '300000008', NULL, '1656426856.jpg', '1656426856.jpg', '$2y$10$/do92vKhSB1O2iNMwySD1.12EXM9rtRhP8D55oMtjsmYe5T7kgJZy', 'trabajador', 'no', NULL, '2022-06-28 09:34:16', '2022-06-28 09:41:06');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
