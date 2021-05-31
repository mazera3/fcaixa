DROP TABLE IF EXISTS adms_cads_usuarios;


CREATE TABLE `adms_cads_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `env_email_conf` int NOT NULL,
  `adms_niveis_acesso_id` int NOT NULL,
  `adms_sits_usuario_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_cads_usuarios VALUES("1","1","5","3","2018-06-23 00:00:00",NULL);


DROP TABLE IF EXISTS adms_confs_emails;


CREATE TABLE `adms_confs_emails` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `host` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `smtpsecure` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `porta` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_confs_emails VALUES("1","eu email","email@site.com.br","mail.site.com.br","email@site.com.br","12345678","PHPMailer::ENCRYPTION_STARTTLS","587","2020-02-01 00:00:00","2020-03-18 11:47:20");


DROP TABLE IF EXISTS adms_cors;


CREATE TABLE `adms_cors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cor` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_cors VALUES("1","Azul","primary","2018-05-23 00:00:00",NULL);
INSERT INTO adms_cors VALUES("2","Cinza","secondary","2018-05-23 00:00:00",NULL);
INSERT INTO adms_cors VALUES("3","Verde","success","2018-05-23 00:00:00",NULL);
INSERT INTO adms_cors VALUES("4","Vermelho","danger","2018-05-23 00:00:00",NULL);
INSERT INTO adms_cors VALUES("5","Laranjado","warning","2018-05-23 00:00:00",NULL);
INSERT INTO adms_cors VALUES("6","Azul Claro","info","2018-05-23 00:00:00","2020-03-13 11:26:19");
INSERT INTO adms_cors VALUES("7","Claro","light","2018-05-23 00:00:00",NULL);
INSERT INTO adms_cors VALUES("8","Cinza Escuro","dark","2018-05-23 00:00:00","2020-03-13 11:24:58");
INSERT INTO adms_cors VALUES("9","Mudo","muted","2020-03-13 13:41:02",NULL);
INSERT INTO adms_cors VALUES("11","Branco","white","2020-03-13 13:44:44",NULL);


DROP TABLE IF EXISTS adms_grps_pgs;


CREATE TABLE `adms_grps_pgs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_grps_pgs VALUES("1","Listar","1","2018-05-23 00:00:00",NULL);
INSERT INTO adms_grps_pgs VALUES("2","Cadastrar","2","2018-05-23 00:00:00",NULL);
INSERT INTO adms_grps_pgs VALUES("3","Editar","3","2018-05-23 00:00:00",NULL);
INSERT INTO adms_grps_pgs VALUES("4","Apagar","4","2018-05-23 00:00:00",NULL);
INSERT INTO adms_grps_pgs VALUES("5","Visualizar","5","2018-05-23 00:00:00",NULL);
INSERT INTO adms_grps_pgs VALUES("6","Outros","7","2018-05-23 00:00:00","2020-03-18 12:49:57");
INSERT INTO adms_grps_pgs VALUES("7","Acesso","6","2018-05-23 00:00:00","2020-03-18 12:49:57");
INSERT INTO adms_grps_pgs VALUES("11","Pesquisar","8","2020-03-21 23:04:55",NULL);


DROP TABLE IF EXISTS adms_menus;


CREATE TABLE `adms_menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icone` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int NOT NULL,
  `adms_sit_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_menus VALUES("1","Home","fas fa-tachometer-alt","2","1","2018-05-23 00:00:00","2021-04-01 15:40:37");
INSERT INTO adms_menus VALUES("2","Usuarios","fas fa-users","4","1","2018-05-23 00:00:00","2021-04-01 15:40:33");
INSERT INTO adms_menus VALUES("3","Sair","fas fa-sign-out-alt","9","1","2020-02-05 00:00:00","2021-04-01 15:39:49");
INSERT INTO adms_menus VALUES("4","Configuração","fas fa-cogs","3","1","2020-02-05 00:00:00","2021-04-01 15:40:35");
INSERT INTO adms_menus VALUES("5","Relatórios","fas fa-file","8","1","2020-03-07 20:34:33","2021-04-01 15:40:21");
INSERT INTO adms_menus VALUES("6","Catalogação","fas fa-bookmark","7","1","2020-03-17 22:23:16","2021-04-01 15:40:26");
INSERT INTO adms_menus VALUES("7","Circulação","fas fa-book","6","1","2020-03-18 23:18:55","2021-04-01 15:40:29");
INSERT INTO adms_menus VALUES("8","Login","fas fa-users","10","1","2021-01-25 21:15:10","2021-04-01 15:39:45");
INSERT INTO adms_menus VALUES("9","Administração","fas fa-edit","5","1","2021-02-04 20:43:17","2021-04-01 15:40:31");
INSERT INTO adms_menus VALUES("10","OPAC","fas fa-search","1","1","2021-04-01 14:33:57","2021-04-01 15:40:37");


DROP TABLE IF EXISTS adms_nivacs_pgs;


CREATE TABLE `adms_nivacs_pgs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `permissao` int NOT NULL,
  `ordem` int NOT NULL,
  `dropdown` int NOT NULL DEFAULT '2',
  `lib_menu` int NOT NULL DEFAULT '2',
  `adms_menu_id` int NOT NULL DEFAULT '4',
  `adms_niveis_acesso_id` int NOT NULL,
  `adms_pagina_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1639 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_nivacs_pgs VALUES("1","1","1","2","2","1","1","1","2018-05-23 00:00:00","2021-01-28 13:37:46");
INSERT INTO adms_nivacs_pgs VALUES("2","1","2","1","1","4","1","2","2018-05-23 00:00:00","2021-02-07 22:28:08");
INSERT INTO adms_nivacs_pgs VALUES("3","1","6","2","1","3","1","4","2020-01-30 00:00:00","2020-03-14 09:47:32");
INSERT INTO adms_nivacs_pgs VALUES("4","1","9","2","2","4","1","5","2020-01-30 00:00:00","2020-03-18 17:43:07");
INSERT INTO adms_nivacs_pgs VALUES("5","1","3","2","2","2","1","9","2020-02-06 00:00:00","2020-03-18 17:39:00");
INSERT INTO adms_nivacs_pgs VALUES("6","1","7","2","2","2","1","10","2020-02-06 00:00:00","2020-03-14 09:47:29");
INSERT INTO adms_nivacs_pgs VALUES("7","1","8","2","2","2","1","11","2020-02-06 00:00:00","2020-03-08 20:39:35");
INSERT INTO adms_nivacs_pgs VALUES("8","1","10","2","2","2","1","12","2020-02-13 00:00:00","2020-03-14 09:47:18");
INSERT INTO adms_nivacs_pgs VALUES("9","1","11","2","2","2","1","13","2020-02-14 00:00:00","2020-03-14 09:47:12");
INSERT INTO adms_nivacs_pgs VALUES("10","1","12","2","2","2","1","14","2020-02-14 00:00:00","2020-03-14 09:47:10");
INSERT INTO adms_nivacs_pgs VALUES("11","1","13","2","2","2","1","15","2020-02-14 00:00:00","2020-03-14 09:47:07");
INSERT INTO adms_nivacs_pgs VALUES("12","1","14","2","2","2","1","16","2020-02-25 00:00:00","2020-03-14 09:47:04");
INSERT INTO adms_nivacs_pgs VALUES("25","1","4","1","1","4","1","17","2018-06-23 00:00:00","2021-02-07 22:31:29");
INSERT INTO adms_nivacs_pgs VALUES("14","1","1","2","2","1","2","1","2018-06-23 00:00:00","2021-04-01 15:40:57");
INSERT INTO adms_nivacs_pgs VALUES("15","1","2","2","2","2","2","9","2018-06-23 00:00:00",NULL);
INSERT INTO adms_nivacs_pgs VALUES("16","1","3","2","2","2","2","10","2018-06-23 00:00:00",NULL);
INSERT INTO adms_nivacs_pgs VALUES("17","1","4","2","2","2","2","11","2018-06-23 00:00:00","2021-04-01 14:40:55");
INSERT INTO adms_nivacs_pgs VALUES("18","2","173","2","2","2","2","2","2018-06-23 00:00:00","2021-04-01 14:40:36");
INSERT INTO adms_nivacs_pgs VALUES("19","1","7","2","2","2","2","12","2018-06-23 00:00:00","2021-04-01 14:40:23");
INSERT INTO adms_nivacs_pgs VALUES("20","1","8","2","2","2","2","13","2018-06-23 00:00:00","2021-04-01 14:40:19");
INSERT INTO adms_nivacs_pgs VALUES("21","1","9","2","2","2","2","14","2018-06-23 00:00:00","2021-04-01 14:40:15");
INSERT INTO adms_nivacs_pgs VALUES("22","1","10","2","2","2","2","15","2018-06-23 00:00:00","2021-04-01 14:40:12");
INSERT INTO adms_nivacs_pgs VALUES("23","1","11","2","2","2","2","16","2018-06-23 00:00:00","2021-04-01 14:40:09");
INSERT INTO adms_nivacs_pgs VALUES("24","1","6","2","1","3","2","4","2018-06-23 00:00:00","2021-04-01 15:03:45");
INSERT INTO adms_nivacs_pgs VALUES("26","1","15","2","2","2","1","18","2018-06-23 00:00:00","2020-03-14 09:47:01");
INSERT INTO adms_nivacs_pgs VALUES("27","1","16","2","2","2","1","19","2018-06-23 00:00:00","2020-03-14 09:46:59");
INSERT INTO adms_nivacs_pgs VALUES("28","1","17","2","2","2","1","20","2018-06-23 00:00:00","2020-03-14 09:46:57");
INSERT INTO adms_nivacs_pgs VALUES("29","1","18","2","2","2","1","21","2018-06-23 00:00:00","2020-03-14 09:46:55");
INSERT INTO adms_nivacs_pgs VALUES("30","1","19","2","2","2","1","22","2018-06-23 00:00:00","2020-03-14 09:46:52");
INSERT INTO adms_nivacs_pgs VALUES("31","2","13","2","2","4","2","17","2018-06-23 00:00:00","2021-04-01 14:39:57");
INSERT INTO adms_nivacs_pgs VALUES("32","2","14","2","2","2","2","18","2018-06-23 00:00:00","2021-04-01 14:39:54");
INSERT INTO adms_nivacs_pgs VALUES("33","2","15","2","2","2","2","19","2018-06-23 00:00:00","2021-04-01 14:39:51");
INSERT INTO adms_nivacs_pgs VALUES("34","2","16","2","2","2","2","20","2018-06-23 00:00:00","2021-04-01 14:39:48");
INSERT INTO adms_nivacs_pgs VALUES("35","2","17","2","2","2","2","21","2018-06-23 00:00:00","2021-04-01 14:39:46");
INSERT INTO adms_nivacs_pgs VALUES("36","2","18","2","2","2","2","22","2018-06-23 00:00:00","2021-04-01 14:39:43");
INSERT INTO adms_nivacs_pgs VALUES("37","1","20","1","1","4","1","23","2018-06-23 00:00:00","2020-03-14 09:46:49");
INSERT INTO adms_nivacs_pgs VALUES("38","1","21","2","2","4","1","24","2018-06-23 00:00:00","2020-03-14 09:46:41");
INSERT INTO adms_nivacs_pgs VALUES("39","1","22","2","2","4","1","25","2018-06-22 14:25:21","2020-03-14 09:46:40");
INSERT INTO adms_nivacs_pgs VALUES("40","2","19","2","2","4","2","23","2018-06-22 14:25:21","2021-04-01 14:39:40");
INSERT INTO adms_nivacs_pgs VALUES("1307","1","135","2","2","4","2","209","2021-02-13 23:57:27","2021-04-01 14:14:55");
INSERT INTO adms_nivacs_pgs VALUES("1408","1","169","1","1","9","1","243","2021-03-15 19:19:34","2021-03-15 19:20:33");
INSERT INTO adms_nivacs_pgs VALUES("43","2","1","2","2","4","5","25","2018-06-22 14:25:21","2021-02-20 16:44:15");
INSERT INTO adms_nivacs_pgs VALUES("44","1","23","2","2","4","1","26","2018-06-22 14:43:47","2020-03-14 09:46:38");
INSERT INTO adms_nivacs_pgs VALUES("45","2","20","2","2","4","2","26","2018-06-22 14:43:47","2021-04-01 14:39:37");
INSERT INTO adms_nivacs_pgs VALUES("1306","1","135","2","2","4","1","209","2021-02-13 23:57:27",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1407","2","167","2","2","4","5","242","2021-03-14 11:59:53","2021-05-31 14:38:18");
INSERT INTO adms_nivacs_pgs VALUES("48","2","2","2","2","4","5","26","2018-06-22 14:43:47",NULL);
INSERT INTO adms_nivacs_pgs VALUES("49","1","24","2","2","4","1","27","2018-06-22 19:17:43","2020-03-14 09:46:35");
INSERT INTO adms_nivacs_pgs VALUES("50","2","21","2","2","4","2","27","2018-06-22 19:17:43","2021-04-01 14:39:34");
INSERT INTO adms_nivacs_pgs VALUES("1305","1","133","2","2","4","5","208","2021-02-13 23:42:08","2021-04-01 16:02:42");
INSERT INTO adms_nivacs_pgs VALUES("1406","1","168","2","2","4","2","242","2021-03-14 11:59:53","2021-04-01 14:12:22");
INSERT INTO adms_nivacs_pgs VALUES("53","2","3","2","2","4","5","27","2018-06-22 19:17:43",NULL);
INSERT INTO adms_nivacs_pgs VALUES("54","1","25","2","2","4","1","28","2020-03-03 23:22:27","2020-03-14 09:46:30");
INSERT INTO adms_nivacs_pgs VALUES("55","2","22","2","2","4","2","28","2020-03-03 23:22:27","2021-04-01 14:39:30");
INSERT INTO adms_nivacs_pgs VALUES("1304","1","134","2","2","4","2","208","2021-02-13 23:42:08","2021-04-01 14:14:58");
INSERT INTO adms_nivacs_pgs VALUES("1405","1","168","2","2","4","1","242","2021-03-14 11:59:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("58","2","4","2","2","4","5","28","2020-03-03 23:22:27",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1512","2","90","2","2","4","11","160","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1511","2","89","2","2","4","11","159","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("195","2","21","2","2","4","5","50","2020-03-17 22:20:59",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1404","2","166","2","2","4","5","241","2021-03-11 14:45:05","2021-05-31 14:38:23");
INSERT INTO adms_nivacs_pgs VALUES("1303","1","134","2","2","4","1","208","2021-02-13 23:42:08",NULL);
INSERT INTO adms_nivacs_pgs VALUES("192","2","39","2","2","4","2","50","2020-03-17 22:20:59","2021-04-01 14:38:37");
INSERT INTO adms_nivacs_pgs VALUES("191","1","43","2","2","4","1","50","2020-03-17 22:20:59","2020-03-18 11:51:38");
INSERT INTO adms_nivacs_pgs VALUES("68","1","26","2","2","4","1","33","2020-03-04 16:16:17","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("69","2","23","2","2","4","2","33","2020-03-04 16:16:17","2021-04-01 14:39:26");
INSERT INTO adms_nivacs_pgs VALUES("1302","1","132","2","2","4","5","207","2021-02-13 23:05:29","2021-04-01 16:02:38");
INSERT INTO adms_nivacs_pgs VALUES("1403","1","167","2","2","4","2","241","2021-03-11 14:45:05","2021-04-01 14:12:25");
INSERT INTO adms_nivacs_pgs VALUES("72","2","5","2","2","4","5","33","2020-03-04 16:16:17","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1510","2","88","2","2","4","11","158","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("75","1","27","2","2","4","1","34","2020-03-04 16:24:24","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("76","2","24","2","2","4","2","34","2020-03-04 16:24:24","2021-04-01 14:39:21");
INSERT INTO adms_nivacs_pgs VALUES("1301","1","133","2","2","4","2","207","2021-02-13 23:05:29","2021-04-01 14:15:01");
INSERT INTO adms_nivacs_pgs VALUES("1402","1","167","2","2","9","1","241","2021-03-11 14:45:05","2021-03-13 16:22:18");
INSERT INTO adms_nivacs_pgs VALUES("79","2","6","2","2","4","5","34","2020-03-04 16:24:24","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1509","2","87","2","2","4","11","157","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("82","1","28","2","2","4","1","35","2020-03-04 16:28:14","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("83","2","25","2","2","4","2","35","2020-03-04 16:28:14","2021-04-01 14:39:17");
INSERT INTO adms_nivacs_pgs VALUES("1300","1","133","2","2","4","1","207","2021-02-13 23:05:29",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1401","1","165","1","1","5","5","240","2021-03-11 10:50:06","2021-04-01 16:11:59");
INSERT INTO adms_nivacs_pgs VALUES("86","2","7","2","2","4","5","35","2020-03-04 16:28:14","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1508","1","86","2","1","10","11","156","2021-04-01 22:29:53","2021-04-01 22:34:45");
INSERT INTO adms_nivacs_pgs VALUES("89","1","29","2","2","4","1","36","2020-03-04 16:34:13","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("90","2","26","2","2","4","2","36","2020-03-04 16:34:13","2021-04-01 14:39:14");
INSERT INTO adms_nivacs_pgs VALUES("1299","1","131","2","2","4","5","206","2021-02-13 22:55:16","2021-04-01 15:52:29");
INSERT INTO adms_nivacs_pgs VALUES("1400","1","166","1","1","5","2","240","2021-03-11 10:50:06","2021-04-01 14:20:02");
INSERT INTO adms_nivacs_pgs VALUES("93","2","8","2","2","4","5","36","2020-03-04 16:34:13","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1507","1","85","1","1","7","11","155","2021-04-01 22:29:53","2021-04-01 22:34:34");
INSERT INTO adms_nivacs_pgs VALUES("96","1","30","2","2","4","1","37","2020-03-08 16:10:23","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("97","2","27","2","2","4","2","37","2020-03-08 16:10:23","2021-04-01 14:39:10");
INSERT INTO adms_nivacs_pgs VALUES("1298","1","132","1","1","9","2","206","2021-02-13 22:55:16","2021-05-31 14:32:48");
INSERT INTO adms_nivacs_pgs VALUES("1399","1","166","1","1","5","1","240","2021-03-11 10:50:06","2021-03-11 10:50:33");
INSERT INTO adms_nivacs_pgs VALUES("100","2","9","2","2","4","5","37","2020-03-08 16:10:23","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1506","1","84","1","1","6","11","92","2021-04-01 22:29:53","2021-04-01 22:34:23");
INSERT INTO adms_nivacs_pgs VALUES("103","1","31","2","2","4","1","38","2020-03-08 18:22:01","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("104","2","28","2","2","4","2","38","2020-03-08 18:22:01","2021-04-01 14:39:06");
INSERT INTO adms_nivacs_pgs VALUES("1297","1","92","1","1","9","1","206","2021-02-13 22:55:16","2021-04-04 07:06:17");
INSERT INTO adms_nivacs_pgs VALUES("1398","1","164","1","1","5","5","239","2021-03-11 10:29:59","2021-04-01 16:11:45");
INSERT INTO adms_nivacs_pgs VALUES("107","2","10","2","2","4","5","38","2020-03-08 18:22:01","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1505","2","83","2","2","4","11","215","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("110","1","32","2","2","4","1","39","2020-03-08 19:02:30","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("111","2","29","2","2","4","2","39","2020-03-08 19:02:30","2021-04-01 14:39:03");
INSERT INTO adms_nivacs_pgs VALUES("1296","1","130","2","2","4","5","205","2021-02-13 16:12:05","2021-05-31 14:40:04");
INSERT INTO adms_nivacs_pgs VALUES("1397","1","165","1","1","5","2","239","2021-03-11 10:29:59","2021-04-01 14:20:14");
INSERT INTO adms_nivacs_pgs VALUES("114","2","11","2","2","4","5","39","2020-03-08 19:02:30","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1504","2","82","2","2","4","11","214","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("117","1","33","2","2","4","1","40","2020-03-08 20:19:47","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("118","2","30","2","2","4","2","40","2020-03-08 20:19:47","2021-04-01 14:38:59");
INSERT INTO adms_nivacs_pgs VALUES("1295","1","131","2","2","4","2","205","2021-02-13 16:12:05","2021-04-01 14:15:06");
INSERT INTO adms_nivacs_pgs VALUES("1396","1","164","1","1","5","1","239","2021-03-11 10:29:59","2021-03-11 10:44:42");
INSERT INTO adms_nivacs_pgs VALUES("121","2","12","2","2","4","5","40","2020-03-08 20:19:47","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1503","2","81","2","2","4","11","213","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1502","2","80","2","2","4","11","212","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("202","2","22","2","2","4","5","51","2020-03-17 22:22:50",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1395","1","163","2","2","4","5","238","2021-03-11 09:49:52","2021-04-01 15:54:28");
INSERT INTO adms_nivacs_pgs VALUES("1294","1","132","2","2","4","1","205","2021-02-13 16:12:05","2021-04-04 07:02:57");
INSERT INTO adms_nivacs_pgs VALUES("199","2","40","2","2","4","2","51","2020-03-17 22:22:50","2021-04-01 14:38:32");
INSERT INTO adms_nivacs_pgs VALUES("198","1","44","2","2","4","1","51","2020-03-17 22:22:50","2020-03-18 11:51:36");
INSERT INTO adms_nivacs_pgs VALUES("1293","1","129","2","2","4","5","204","2021-02-13 16:05:27","2021-05-31 14:40:20");
INSERT INTO adms_nivacs_pgs VALUES("1292","1","130","2","2","4","2","204","2021-02-13 16:05:27","2021-04-01 14:15:09");
INSERT INTO adms_nivacs_pgs VALUES("1394","1","164","2","2","4","2","238","2021-03-11 09:49:52","2021-04-01 14:12:33");
INSERT INTO adms_nivacs_pgs VALUES("134","1","10","2","2","3","5","4","2018-06-23 00:00:00","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("135","1","37","1","1","4","1","42","2020-03-13 08:41:57","2020-03-18 11:52:52");
INSERT INTO adms_nivacs_pgs VALUES("136","2","31","2","2","4","2","42","2020-03-13 08:41:57","2021-04-01 14:38:56");
INSERT INTO adms_nivacs_pgs VALUES("1291","1","131","2","2","4","1","204","2021-02-13 16:05:27","2021-04-04 07:03:02");
INSERT INTO adms_nivacs_pgs VALUES("1393","1","165","1","1","9","1","238","2021-03-11 09:49:52","2021-03-25 08:09:37");
INSERT INTO adms_nivacs_pgs VALUES("139","2","13","2","2","4","5","42","2020-03-13 08:41:57","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1501","2","79","2","2","4","11","211","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1602","2","174","2","2","4","11","249","2021-04-02 10:01:56",NULL);
INSERT INTO adms_nivacs_pgs VALUES("142","1","38","2","2","4","1","43","2020-03-13 09:35:05","2020-03-18 11:52:44");
INSERT INTO adms_nivacs_pgs VALUES("143","2","32","2","2","4","2","43","2020-03-13 09:35:05","2021-04-01 14:38:54");
INSERT INTO adms_nivacs_pgs VALUES("1290","1","128","2","2","4","5","203","2021-02-13 15:47:37","2021-05-31 14:40:23");
INSERT INTO adms_nivacs_pgs VALUES("1392","1","162","1","1","5","5","237","2021-03-11 09:18:09","2021-04-01 15:54:20");
INSERT INTO adms_nivacs_pgs VALUES("146","2","14","2","2","4","5","43","2020-03-13 09:35:05","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1500","2","78","2","2","4","11","210","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1601","2","173","2","2","4","5","249","2021-04-02 10:01:56",NULL);
INSERT INTO adms_nivacs_pgs VALUES("149","1","39","2","2","4","1","44","2020-03-13 12:42:28","2020-03-18 11:52:39");
INSERT INTO adms_nivacs_pgs VALUES("150","2","33","2","2","4","2","44","2020-03-13 12:42:28","2021-04-01 14:38:50");
INSERT INTO adms_nivacs_pgs VALUES("1289","1","129","2","2","4","2","203","2021-02-13 15:47:37","2021-04-01 14:15:12");
INSERT INTO adms_nivacs_pgs VALUES("1391","1","163","1","1","5","2","237","2021-03-11 09:18:09","2021-04-01 14:20:20");
INSERT INTO adms_nivacs_pgs VALUES("153","2","15","2","2","4","5","44","2020-03-13 12:42:28","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1499","2","77","2","2","4","11","209","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1600","1","175","1","1","9","2","249","2021-04-02 10:01:56","2021-05-31 14:30:20");
INSERT INTO adms_nivacs_pgs VALUES("156","1","40","2","2","4","1","45","2020-03-13 13:14:48","2020-03-18 11:52:32");
INSERT INTO adms_nivacs_pgs VALUES("157","2","34","2","2","4","2","45","2020-03-13 13:14:48","2021-04-01 14:38:48");
INSERT INTO adms_nivacs_pgs VALUES("1288","1","130","2","2","4","1","203","2021-02-13 15:47:37","2021-04-04 07:03:05");
INSERT INTO adms_nivacs_pgs VALUES("1390","1","160","1","1","5","1","237","2021-03-11 09:18:09","2021-03-11 10:44:17");
INSERT INTO adms_nivacs_pgs VALUES("160","2","16","2","2","4","5","45","2020-03-13 13:14:48","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1498","2","76","2","2","4","11","217","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1599","1","174","1","1","9","1","249","2021-04-02 10:01:56","2021-04-02 10:02:27");
INSERT INTO adms_nivacs_pgs VALUES("163","1","41","2","2","4","1","46","2020-03-13 13:39:40","2021-02-04 21:49:59");
INSERT INTO adms_nivacs_pgs VALUES("164","2","35","2","2","4","2","46","2020-03-13 13:39:40","2021-04-01 14:38:46");
INSERT INTO adms_nivacs_pgs VALUES("1287","2","127","2","2","4","5","202","2021-02-13 11:23:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1389","1","161","1","1","5","5","236","2021-03-10 11:46:49","2021-04-01 15:54:09");
INSERT INTO adms_nivacs_pgs VALUES("167","2","17","2","2","4","5","46","2020-03-13 13:39:40","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1497","2","75","2","2","4","11","216","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1598","2","173","2","2","4","11","248","2021-04-01 22:48:17",NULL);
INSERT INTO adms_nivacs_pgs VALUES("170","1","5","1","1","11","1","47","2020-03-14 09:39:46","2020-03-17 23:04:59");
INSERT INTO adms_nivacs_pgs VALUES("171","2","36","2","2","7","2","47","2020-03-14 09:39:46","2021-04-01 14:38:44");
INSERT INTO adms_nivacs_pgs VALUES("1286","1","128","2","2","4","2","202","2021-02-13 11:23:52","2021-04-01 14:15:14");
INSERT INTO adms_nivacs_pgs VALUES("1388","1","162","1","1","5","2","236","2021-03-10 11:46:49","2021-04-01 14:20:25");
INSERT INTO adms_nivacs_pgs VALUES("174","2","18","2","2","5","5","47","2020-03-14 09:39:46","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1496","2","74","2","2","4","11","79","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("177","1","42","2","2","4","1","48","2020-03-14 22:03:22","2020-03-18 11:51:57");
INSERT INTO adms_nivacs_pgs VALUES("178","2","37","2","2","4","2","48","2020-03-14 22:03:22","2021-04-01 14:38:42");
INSERT INTO adms_nivacs_pgs VALUES("1285","1","129","2","2","4","1","202","2021-02-13 11:23:52","2021-04-04 07:03:08");
INSERT INTO adms_nivacs_pgs VALUES("1387","1","163","1","1","5","1","236","2021-03-10 11:46:49","2021-03-11 10:44:03");
INSERT INTO adms_nivacs_pgs VALUES("181","2","19","2","2","4","5","48","2020-03-14 22:03:22","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1495","2","73","2","2","4","11","78","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1597","1","172","2","2","4","5","248","2021-04-01 22:48:17","2021-05-31 14:37:35");
INSERT INTO adms_nivacs_pgs VALUES("184","1","34","1","1","4","1","49","2020-03-17 20:52:20","2020-03-18 11:50:30");
INSERT INTO adms_nivacs_pgs VALUES("185","2","38","2","2","4","2","49","2020-03-17 20:52:20","2021-04-01 14:38:39");
INSERT INTO adms_nivacs_pgs VALUES("1284","2","126","2","2","4","5","201","2021-02-13 09:39:11",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1386","1","160","2","2","4","5","235","2021-03-10 09:20:28","2021-04-01 15:53:55");
INSERT INTO adms_nivacs_pgs VALUES("188","2","20","2","2","4","5","49","2020-03-17 20:52:20","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1494","2","72","2","2","4","11","77","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1596","1","174","2","2","4","2","248","2021-04-01 22:48:17","2021-05-31 14:25:52");
INSERT INTO adms_nivacs_pgs VALUES("205","1","45","2","2","4","1","52","2020-03-17 22:27:40","2020-03-18 11:51:34");
INSERT INTO adms_nivacs_pgs VALUES("206","2","41","2","2","4","2","52","2020-03-17 22:27:40","2021-04-01 14:38:19");
INSERT INTO adms_nivacs_pgs VALUES("1283","1","127","2","2","4","2","201","2021-02-13 09:39:11","2021-04-01 14:15:16");
INSERT INTO adms_nivacs_pgs VALUES("1385","1","161","2","2","4","2","235","2021-03-10 09:20:28","2021-04-01 14:12:40");
INSERT INTO adms_nivacs_pgs VALUES("209","2","23","2","2","4","5","52","2020-03-17 22:27:40",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1493","2","71","2","2","4","11","76","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1595","1","173","2","2","4","1","248","2021-04-01 22:48:17",NULL);
INSERT INTO adms_nivacs_pgs VALUES("212","1","46","2","2","4","1","53","2020-03-17 22:48:23","2020-03-18 11:51:31");
INSERT INTO adms_nivacs_pgs VALUES("213","2","42","2","2","4","2","53","2020-03-17 22:48:23","2021-04-01 14:38:18");
INSERT INTO adms_nivacs_pgs VALUES("1282","1","128","2","2","4","1","201","2021-02-13 09:39:11","2021-04-04 07:03:10");
INSERT INTO adms_nivacs_pgs VALUES("1384","1","162","2","2","4","1","235","2021-03-10 09:20:28","2021-03-11 10:44:06");
INSERT INTO adms_nivacs_pgs VALUES("216","2","24","2","2","4","5","53","2020-03-17 22:48:23",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1492","2","70","2","2","4","11","75","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1594","2","172","2","2","4","11","247","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("219","1","35","1","1","4","1","54","2020-03-18 10:20:58","2020-03-18 11:52:49");
INSERT INTO adms_nivacs_pgs VALUES("220","2","43","2","2","2","2","54","2020-03-18 10:20:58","2021-04-01 14:38:17");
INSERT INTO adms_nivacs_pgs VALUES("1281","2","125","2","2","4","5","200","2021-02-12 20:57:39",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1383","1","159","2","2","4","5","234","2021-03-08 19:47:54","2021-04-01 16:03:26");
INSERT INTO adms_nivacs_pgs VALUES("223","2","25","2","2","4","5","54","2020-03-18 10:20:58",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1491","2","69","2","2","4","11","74","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1593","2","171","2","2","4","11","246","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("226","1","36","1","1","4","1","55","2020-03-18 10:30:25","2020-03-18 11:52:52");
INSERT INTO adms_nivacs_pgs VALUES("227","2","44","2","2","4","2","55","2020-03-18 10:30:25","2021-04-01 14:38:16");
INSERT INTO adms_nivacs_pgs VALUES("1280","1","126","2","2","4","2","200","2021-02-12 20:57:39","2021-04-01 14:15:18");
INSERT INTO adms_nivacs_pgs VALUES("1382","1","160","2","2","4","2","234","2021-03-08 19:47:54","2021-04-01 14:12:58");
INSERT INTO adms_nivacs_pgs VALUES("230","2","26","2","2","4","5","55","2020-03-18 10:30:25",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1490","2","68","2","2","4","11","73","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1592","2","170","2","2","4","11","244","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("233","1","47","1","1","4","1","56","2020-03-18 11:58:09","2020-03-18 11:58:39");
INSERT INTO adms_nivacs_pgs VALUES("234","2","45","2","2","4","2","56","2020-03-18 11:58:09","2021-04-01 14:38:15");
INSERT INTO adms_nivacs_pgs VALUES("1279","1","127","2","2","4","1","200","2021-02-12 20:57:39","2021-04-04 07:03:12");
INSERT INTO adms_nivacs_pgs VALUES("1381","1","161","2","2","4","1","234","2021-03-08 19:47:54","2021-03-11 10:44:17");
INSERT INTO adms_nivacs_pgs VALUES("237","2","27","2","2","4","5","56","2020-03-18 11:58:09",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1489","2","67","2","2","4","11","72","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1591","2","169","2","2","4","11","243","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("240","1","48","2","2","4","1","57","2020-03-18 12:02:48",NULL);
INSERT INTO adms_nivacs_pgs VALUES("241","2","46","2","2","4","2","57","2020-03-18 12:02:48","2021-04-01 14:38:14");
INSERT INTO adms_nivacs_pgs VALUES("1278","2","124","2","2","4","5","199","2021-02-12 20:42:26",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1380","2","158","2","2","4","5","233","2021-03-08 16:43:16",NULL);
INSERT INTO adms_nivacs_pgs VALUES("244","2","28","2","2","4","5","57","2020-03-18 12:02:48",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1488","2","66","2","2","4","11","71","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1590","2","168","2","2","4","11","242","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("247","1","49","2","2","4","1","58","2020-03-18 12:05:34",NULL);
INSERT INTO adms_nivacs_pgs VALUES("248","2","47","2","2","4","2","58","2020-03-18 12:05:34","2021-04-01 14:38:12");
INSERT INTO adms_nivacs_pgs VALUES("1277","1","125","2","2","4","2","199","2021-02-12 20:42:26","2021-04-01 14:15:20");
INSERT INTO adms_nivacs_pgs VALUES("1379","1","159","2","2","4","2","233","2021-03-08 16:43:16","2021-04-01 14:13:02");
INSERT INTO adms_nivacs_pgs VALUES("251","2","29","2","2","4","5","58","2020-03-18 12:05:34",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1487","2","65","2","2","4","11","70","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1589","2","167","2","2","4","11","241","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("254","1","50","2","2","4","1","59","2020-03-18 12:09:20",NULL);
INSERT INTO adms_nivacs_pgs VALUES("255","2","48","2","2","4","2","59","2020-03-18 12:09:20","2021-04-01 14:38:10");
INSERT INTO adms_nivacs_pgs VALUES("1276","1","126","2","2","4","1","199","2021-02-12 20:42:26","2021-04-04 07:03:14");
INSERT INTO adms_nivacs_pgs VALUES("1378","1","159","2","2","4","1","233","2021-03-08 16:43:16",NULL);
INSERT INTO adms_nivacs_pgs VALUES("258","2","30","2","2","4","5","59","2020-03-18 12:09:20",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1486","2","64","2","2","4","11","69","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1588","2","166","2","2","4","11","240","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("261","1","51","2","2","4","1","60","2020-03-18 12:37:51",NULL);
INSERT INTO adms_nivacs_pgs VALUES("262","2","49","2","2","4","2","60","2020-03-18 12:37:51","2021-04-01 14:38:08");
INSERT INTO adms_nivacs_pgs VALUES("1275","2","123","2","2","4","5","198","2021-02-12 20:29:20",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1377","2","157","2","2","4","5","232","2021-03-06 21:27:22",NULL);
INSERT INTO adms_nivacs_pgs VALUES("265","2","31","2","2","4","5","60","2020-03-18 12:37:51",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1485","2","63","2","2","4","11","68","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1587","2","165","2","2","4","11","239","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("268","1","52","2","2","4","1","61","2020-03-18 12:48:40",NULL);
INSERT INTO adms_nivacs_pgs VALUES("269","2","50","2","2","4","2","61","2020-03-18 12:48:40","2021-04-01 14:38:06");
INSERT INTO adms_nivacs_pgs VALUES("1274","1","124","2","2","4","2","198","2021-02-12 20:29:20","2021-04-01 14:15:22");
INSERT INTO adms_nivacs_pgs VALUES("1376","1","158","2","2","4","2","232","2021-03-06 21:27:22","2021-04-01 14:13:08");
INSERT INTO adms_nivacs_pgs VALUES("272","2","32","2","2","4","5","61","2020-03-18 12:48:40",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1484","2","62","2","2","4","11","67","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1586","2","164","2","2","4","11","238","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("275","1","54","1","1","4","1","62","2020-03-18 12:57:54","2020-03-18 14:31:32");
INSERT INTO adms_nivacs_pgs VALUES("276","2","51","2","2","4","2","62","2020-03-18 12:57:54","2021-04-01 14:38:04");
INSERT INTO adms_nivacs_pgs VALUES("1273","1","125","2","2","4","1","198","2021-02-12 20:29:20","2021-04-04 07:03:16");
INSERT INTO adms_nivacs_pgs VALUES("1375","1","158","2","2","4","1","232","2021-03-06 21:27:22",NULL);
INSERT INTO adms_nivacs_pgs VALUES("279","2","33","2","2","4","5","62","2020-03-18 12:57:54",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1483","2","61","2","2","4","11","66","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1585","1","163","1","1","5","11","237","2021-04-01 22:29:53","2021-04-01 22:33:57");
INSERT INTO adms_nivacs_pgs VALUES("282","1","55","2","2","4","1","63","2020-03-18 13:00:33","2020-03-18 14:31:11");
INSERT INTO adms_nivacs_pgs VALUES("283","2","52","2","2","4","2","63","2020-03-18 13:00:33","2021-04-01 14:38:01");
INSERT INTO adms_nivacs_pgs VALUES("1272","2","122","2","2","4","5","197","2021-02-11 14:49:46",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1374","2","156","2","2","4","5","231","2021-03-06 15:29:01",NULL);
INSERT INTO adms_nivacs_pgs VALUES("286","2","34","2","2","4","5","63","2020-03-18 13:00:33",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1482","2","60","2","2","4","11","65","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1584","2","162","2","2","4","11","236","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("289","1","56","2","2","4","1","64","2020-03-18 13:03:18","2020-03-18 14:31:08");
INSERT INTO adms_nivacs_pgs VALUES("290","2","53","2","2","4","2","64","2020-03-18 13:03:18","2021-04-01 14:37:59");
INSERT INTO adms_nivacs_pgs VALUES("1271","1","123","2","2","4","2","197","2021-02-11 14:49:46","2021-04-01 14:15:26");
INSERT INTO adms_nivacs_pgs VALUES("1373","1","157","2","2","4","2","231","2021-03-06 15:29:01","2021-04-01 14:13:13");
INSERT INTO adms_nivacs_pgs VALUES("293","2","35","2","2","4","5","64","2020-03-18 13:03:18",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1481","2","59","2","2","4","11","64","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1583","2","161","2","2","4","11","235","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("296","1","57","2","2","4","1","65","2020-03-18 13:05:56","2020-03-18 14:31:05");
INSERT INTO adms_nivacs_pgs VALUES("297","2","54","2","2","4","2","65","2020-03-18 13:05:56","2021-04-01 14:37:57");
INSERT INTO adms_nivacs_pgs VALUES("1270","1","124","2","2","4","1","197","2021-02-11 14:49:46","2021-04-04 07:03:18");
INSERT INTO adms_nivacs_pgs VALUES("1372","1","157","2","2","4","1","231","2021-03-06 15:29:01",NULL);
INSERT INTO adms_nivacs_pgs VALUES("300","2","36","2","2","4","5","65","2020-03-18 13:05:56",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1480","2","58","2","2","4","11","63","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1582","2","160","2","2","4","11","234","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("303","1","58","2","2","4","1","66","2020-03-18 13:09:55","2020-03-18 14:31:00");
INSERT INTO adms_nivacs_pgs VALUES("304","2","55","2","2","4","2","66","2020-03-18 13:09:55","2021-04-01 14:37:54");
INSERT INTO adms_nivacs_pgs VALUES("1269","1","121","2","2","4","5","196","2021-02-11 13:41:41","2021-04-01 16:02:30");
INSERT INTO adms_nivacs_pgs VALUES("1371","1","155","2","2","4","5","230","2021-03-06 13:26:06","2021-04-01 15:53:42");
INSERT INTO adms_nivacs_pgs VALUES("307","2","37","2","2","4","5","66","2020-03-18 13:09:55",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1479","2","57","2","2","4","11","62","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1581","2","159","2","2","4","11","233","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("310","1","59","1","1","4","1","67","2020-03-18 13:14:38","2020-03-18 14:30:56");
INSERT INTO adms_nivacs_pgs VALUES("311","2","56","2","2","4","2","67","2020-03-18 13:14:38","2021-04-01 14:37:51");
INSERT INTO adms_nivacs_pgs VALUES("1268","1","122","2","2","4","2","196","2021-02-11 13:41:41","2021-04-01 14:15:28");
INSERT INTO adms_nivacs_pgs VALUES("1370","1","156","1","1","9","2","230","2021-03-06 13:26:06","2021-05-31 14:31:54");
INSERT INTO adms_nivacs_pgs VALUES("314","2","38","2","2","4","5","67","2020-03-18 13:14:38",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1478","2","56","2","2","4","11","61","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1580","2","158","2","2","4","11","232","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("317","1","60","2","2","4","1","68","2020-03-18 13:31:32","2020-03-18 14:30:49");
INSERT INTO adms_nivacs_pgs VALUES("318","2","57","2","2","4","2","68","2020-03-18 13:31:32","2021-04-01 14:37:48");
INSERT INTO adms_nivacs_pgs VALUES("1267","1","123","2","2","4","1","196","2021-02-11 13:41:41","2021-04-04 07:03:20");
INSERT INTO adms_nivacs_pgs VALUES("1369","1","156","1","1","9","1","230","2021-03-06 13:26:06","2021-03-09 20:59:36");
INSERT INTO adms_nivacs_pgs VALUES("321","2","39","2","2","4","5","68","2020-03-18 13:31:32",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1477","2","55","2","2","4","11","60","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1579","2","157","2","2","4","11","231","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("324","1","61","2","2","4","1","69","2020-03-18 13:36:26","2020-03-18 14:30:42");
INSERT INTO adms_nivacs_pgs VALUES("325","2","58","2","2","4","2","69","2020-03-18 13:36:26","2021-04-01 14:37:46");
INSERT INTO adms_nivacs_pgs VALUES("1266","1","120","2","2","4","5","195","2021-02-10 22:25:16","2021-04-01 16:02:28");
INSERT INTO adms_nivacs_pgs VALUES("1368","1","154","2","2","4","5","229","2021-03-05 10:57:19","2021-04-01 15:53:33");
INSERT INTO adms_nivacs_pgs VALUES("328","2","40","2","2","4","5","69","2020-03-18 13:36:26",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1476","2","54","2","2","4","11","59","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1578","2","156","2","2","4","11","230","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("331","1","62","2","2","4","1","70","2020-03-18 13:40:35","2020-03-18 14:30:40");
INSERT INTO adms_nivacs_pgs VALUES("332","2","59","2","2","4","2","70","2020-03-18 13:40:35","2021-04-01 14:37:43");
INSERT INTO adms_nivacs_pgs VALUES("1265","1","121","2","2","4","2","195","2021-02-10 22:25:16","2021-04-01 14:15:30");
INSERT INTO adms_nivacs_pgs VALUES("1367","1","155","2","2","4","2","229","2021-03-05 10:57:19","2021-04-01 14:13:23");
INSERT INTO adms_nivacs_pgs VALUES("335","2","41","2","2","4","5","70","2020-03-18 13:40:35",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1475","2","53","2","2","4","11","58","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1577","2","155","2","2","4","11","229","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("338","1","63","2","2","4","1","71","2020-03-18 13:43:37","2020-03-18 14:30:38");
INSERT INTO adms_nivacs_pgs VALUES("339","2","60","2","2","4","2","71","2020-03-18 13:43:37","2021-04-01 14:37:40");
INSERT INTO adms_nivacs_pgs VALUES("1264","1","122","2","2","4","1","195","2021-02-10 22:25:16","2021-04-04 07:03:22");
INSERT INTO adms_nivacs_pgs VALUES("1366","1","155","2","2","4","1","229","2021-03-05 10:57:19",NULL);
INSERT INTO adms_nivacs_pgs VALUES("342","2","42","2","2","4","5","71","2020-03-18 13:43:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1474","2","52","2","2","4","11","57","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1576","2","154","2","2","4","11","228","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("345","1","64","1","1","4","1","72","2020-03-18 13:49:00","2020-03-18 14:29:56");
INSERT INTO adms_nivacs_pgs VALUES("346","2","61","2","2","4","2","72","2020-03-18 13:49:00","2021-04-01 14:37:37");
INSERT INTO adms_nivacs_pgs VALUES("1263","1","119","2","2","4","5","194","2021-02-10 21:28:16","2021-04-01 16:02:23");
INSERT INTO adms_nivacs_pgs VALUES("1365","1","153","2","2","4","5","228","2021-02-28 13:56:26","2021-04-01 15:53:27");
INSERT INTO adms_nivacs_pgs VALUES("349","2","43","2","2","4","5","72","2020-03-18 13:49:00",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1473","2","51","2","2","4","11","56","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1575","2","153","2","2","4","11","227","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("352","1","65","2","2","4","1","73","2020-03-18 13:57:22","2020-03-18 14:29:51");
INSERT INTO adms_nivacs_pgs VALUES("353","2","62","2","2","4","2","73","2020-03-18 13:57:22","2021-04-01 14:37:33");
INSERT INTO adms_nivacs_pgs VALUES("1262","1","120","2","2","4","2","194","2021-02-10 21:28:16","2021-04-01 14:17:14");
INSERT INTO adms_nivacs_pgs VALUES("1364","1","154","2","2","4","2","228","2021-02-28 13:56:26","2021-04-01 14:13:27");
INSERT INTO adms_nivacs_pgs VALUES("356","2","44","2","2","4","5","73","2020-03-18 13:57:22",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1472","2","50","2","2","4","11","55","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1574","2","152","2","2","4","11","226","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("359","1","66","2","2","4","1","74","2020-03-18 14:00:12","2020-03-18 14:29:47");
INSERT INTO adms_nivacs_pgs VALUES("360","2","63","2","2","4","2","74","2020-03-18 14:00:12","2021-04-01 14:37:30");
INSERT INTO adms_nivacs_pgs VALUES("1261","1","121","2","2","4","1","194","2021-02-10 21:28:16","2021-04-04 07:03:25");
INSERT INTO adms_nivacs_pgs VALUES("1363","1","154","2","2","4","1","228","2021-02-28 13:56:26",NULL);
INSERT INTO adms_nivacs_pgs VALUES("363","2","45","2","2","4","5","74","2020-03-18 14:00:12",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1471","2","49","2","2","4","11","54","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1573","2","151","2","2","4","11","225","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("366","1","67","2","2","4","1","75","2020-03-18 14:22:20","2020-03-18 14:29:45");
INSERT INTO adms_nivacs_pgs VALUES("367","2","64","2","2","4","2","75","2020-03-18 14:22:20","2021-04-01 14:37:27");
INSERT INTO adms_nivacs_pgs VALUES("1260","1","118","2","2","4","5","193","2021-02-10 16:01:03","2021-04-01 16:02:20");
INSERT INTO adms_nivacs_pgs VALUES("1362","1","152","2","2","4","5","227","2021-02-28 13:54:17","2021-04-01 15:53:21");
INSERT INTO adms_nivacs_pgs VALUES("370","2","46","2","2","4","5","75","2020-03-18 14:22:20",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1470","2","48","2","2","4","11","53","2021-04-01 22:29:53","2021-04-01 22:31:30");
INSERT INTO adms_nivacs_pgs VALUES("1572","2","150","2","2","4","11","224","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("373","1","68","2","2","4","1","76","2020-03-18 14:25:26","2020-03-18 14:29:42");
INSERT INTO adms_nivacs_pgs VALUES("374","2","65","2","2","4","2","76","2020-03-18 14:25:26","2021-04-01 14:37:23");
INSERT INTO adms_nivacs_pgs VALUES("1259","1","119","2","2","4","2","193","2021-02-10 16:01:03","2021-04-01 14:17:18");
INSERT INTO adms_nivacs_pgs VALUES("1361","1","153","2","2","4","2","227","2021-02-28 13:54:17","2021-04-01 14:13:32");
INSERT INTO adms_nivacs_pgs VALUES("377","2","47","2","2","4","5","76","2020-03-18 14:25:26",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1469","2","47","2","2","4","11","49","2021-04-01 22:29:53","2021-04-01 22:31:28");
INSERT INTO adms_nivacs_pgs VALUES("1571","2","149","2","2","4","11","223","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("380","1","53","1","1","4","1","77","2020-03-18 14:28:48","2020-03-18 14:31:32");
INSERT INTO adms_nivacs_pgs VALUES("381","2","66","2","2","4","2","77","2020-03-18 14:28:48","2021-04-01 14:37:20");
INSERT INTO adms_nivacs_pgs VALUES("1258","1","120","2","2","4","1","193","2021-02-10 16:01:03","2021-04-04 07:03:45");
INSERT INTO adms_nivacs_pgs VALUES("1360","1","153","2","2","4","1","227","2021-02-28 13:54:17",NULL);
INSERT INTO adms_nivacs_pgs VALUES("384","2","48","2","2","4","5","77","2020-03-18 14:28:48",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1468","2","46","2","2","4","11","48","2021-04-01 22:29:53","2021-04-01 22:31:25");
INSERT INTO adms_nivacs_pgs VALUES("1570","2","148","2","2","4","11","222","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("387","1","69","2","2","4","1","78","2020-03-18 17:44:59",NULL);
INSERT INTO adms_nivacs_pgs VALUES("388","2","67","2","2","4","2","78","2020-03-18 17:44:59","2021-04-01 14:37:15");
INSERT INTO adms_nivacs_pgs VALUES("1257","1","117","2","2","4","5","192","2021-02-09 20:03:20","2021-04-01 15:51:55");
INSERT INTO adms_nivacs_pgs VALUES("1359","1","151","2","2","4","5","226","2021-02-26 11:29:43","2021-04-01 15:53:13");
INSERT INTO adms_nivacs_pgs VALUES("391","2","49","2","2","4","5","78","2020-03-18 17:44:59",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1467","2","45","2","2","4","11","47","2021-04-01 22:29:53","2021-04-01 22:31:21");
INSERT INTO adms_nivacs_pgs VALUES("1569","2","147","2","2","4","11","221","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("394","1","70","2","2","4","1","79","2020-03-18 17:49:19",NULL);
INSERT INTO adms_nivacs_pgs VALUES("395","2","68","2","2","4","2","79","2020-03-18 17:49:19","2021-04-01 14:37:11");
INSERT INTO adms_nivacs_pgs VALUES("1256","1","118","2","2","4","2","192","2021-02-09 20:03:20","2021-04-01 14:17:21");
INSERT INTO adms_nivacs_pgs VALUES("1358","1","152","2","2","4","2","226","2021-02-26 11:29:43","2021-04-01 14:13:36");
INSERT INTO adms_nivacs_pgs VALUES("398","2","50","2","2","4","5","79","2020-03-18 17:49:19",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1466","2","44","2","2","4","11","50","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1568","2","146","2","2","4","11","220","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1255","1","119","2","2","4","1","192","2021-02-09 20:03:20","2021-04-04 07:03:50");
INSERT INTO adms_nivacs_pgs VALUES("1254","1","116","2","2","4","5","191","2021-02-09 17:24:15","2021-04-01 16:02:16");
INSERT INTO adms_nivacs_pgs VALUES("1253","1","117","2","2","4","2","191","2021-02-09 17:24:15","2021-04-01 14:17:24");
INSERT INTO adms_nivacs_pgs VALUES("1252","1","118","2","2","4","1","191","2021-02-09 17:24:15","2021-04-04 07:03:55");
INSERT INTO adms_nivacs_pgs VALUES("1251","1","115","2","2","4","5","190","2021-02-09 17:19:38","2021-04-01 16:02:13");
INSERT INTO adms_nivacs_pgs VALUES("1250","1","116","2","2","4","2","190","2021-02-09 17:19:38","2021-04-01 14:17:27");
INSERT INTO adms_nivacs_pgs VALUES("1249","1","117","2","2","4","1","190","2021-02-09 17:19:38","2021-04-04 07:03:57");
INSERT INTO adms_nivacs_pgs VALUES("1248","1","114","2","2","4","5","189","2021-02-09 14:00:42","2021-04-01 16:02:11");
INSERT INTO adms_nivacs_pgs VALUES("1247","1","115","2","2","4","2","189","2021-02-09 14:00:42","2021-04-01 14:17:30");
INSERT INTO adms_nivacs_pgs VALUES("1246","1","116","2","2","4","1","189","2021-02-09 14:00:42","2021-04-04 07:03:59");
INSERT INTO adms_nivacs_pgs VALUES("1245","1","113","2","2","4","5","188","2021-02-09 13:36:18","2021-04-01 16:02:07");
INSERT INTO adms_nivacs_pgs VALUES("1244","1","114","1","1","9","2","188","2021-02-09 13:36:18","2021-05-31 14:33:18");
INSERT INTO adms_nivacs_pgs VALUES("1243","1","115","1","1","9","1","188","2021-02-09 13:36:18","2021-04-04 07:04:04");
INSERT INTO adms_nivacs_pgs VALUES("1242","1","112","2","2","4","5","187","2021-02-09 12:48:51","2021-04-01 16:02:04");
INSERT INTO adms_nivacs_pgs VALUES("932","1","77","2","2","4","2","6","2021-01-25 19:25:37","2021-04-01 14:36:26");
INSERT INTO adms_nivacs_pgs VALUES("931","2","76","2","2","2","2","5","2021-01-25 19:25:37","2021-04-01 14:36:31");
INSERT INTO adms_nivacs_pgs VALUES("930","1","75","2","2","4","2","3","2021-01-25 19:25:37","2021-04-01 14:36:39");
INSERT INTO adms_nivacs_pgs VALUES("929","1","81","2","2","4","1","8","2021-01-25 19:25:37","2021-01-27 14:37:35");
INSERT INTO adms_nivacs_pgs VALUES("928","1","80","2","2","4","1","7","2021-01-25 19:25:37","2021-01-27 14:37:44");
INSERT INTO adms_nivacs_pgs VALUES("927","1","79","2","2","4","1","6","2021-01-25 19:25:37","2021-01-27 14:37:48");
INSERT INTO adms_nivacs_pgs VALUES("926","1","78","2","2","4","1","3","2021-01-25 19:25:37","2021-01-27 14:37:56");
INSERT INTO adms_nivacs_pgs VALUES("1465","2","43","2","2","4","11","46","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1464","2","42","2","2","4","11","45","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1463","2","41","2","2","4","11","44","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1462","2","40","2","2","4","11","43","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1461","2","39","2","2","4","11","42","2021-04-01 22:29:52","2021-04-01 22:31:12");
INSERT INTO adms_nivacs_pgs VALUES("1460","2","38","2","2","4","11","51","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1459","2","37","2","2","4","11","40","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1241","1","113","2","2","4","2","187","2021-02-09 12:48:51","2021-04-01 14:17:37");
INSERT INTO adms_nivacs_pgs VALUES("1240","1","114","2","2","4","1","187","2021-02-09 12:48:51","2021-04-04 07:04:08");
INSERT INTO adms_nivacs_pgs VALUES("1239","1","111","2","2","4","5","186","2021-02-09 11:04:17","2021-04-01 16:02:00");
INSERT INTO adms_nivacs_pgs VALUES("936","2","81","2","2","4","2","25","2021-01-25 19:25:37","2021-04-01 14:35:54");
INSERT INTO adms_nivacs_pgs VALUES("935","2","80","2","2","4","2","24","2021-01-25 19:25:37","2021-04-01 14:36:07");
INSERT INTO adms_nivacs_pgs VALUES("934","1","79","2","2","4","2","8","2021-01-25 19:25:37","2021-04-01 14:36:13");
INSERT INTO adms_nivacs_pgs VALUES("933","1","78","2","2","4","2","7","2021-01-25 19:25:37","2021-04-01 14:36:18");
INSERT INTO adms_nivacs_pgs VALUES("1357","1","152","2","2","4","1","226","2021-02-26 11:29:43",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1356","1","150","2","2","4","5","225","2021-02-20 11:54:18","2021-04-01 15:53:07");
INSERT INTO adms_nivacs_pgs VALUES("1238","1","112","2","2","4","2","186","2021-02-09 11:04:17","2021-04-01 14:17:10");
INSERT INTO adms_nivacs_pgs VALUES("1237","1","113","2","2","4","1","186","2021-02-09 11:04:17","2021-04-04 07:04:11");
INSERT INTO adms_nivacs_pgs VALUES("1236","1","110","2","2","4","5","185","2021-02-09 10:42:40","2021-04-01 16:01:57");
INSERT INTO adms_nivacs_pgs VALUES("1235","1","111","2","2","4","2","185","2021-02-09 10:42:40","2021-04-01 14:17:07");
INSERT INTO adms_nivacs_pgs VALUES("1234","1","112","2","2","4","1","185","2021-02-09 10:42:40","2021-04-04 07:04:15");
INSERT INTO adms_nivacs_pgs VALUES("1355","1","151","2","2","4","2","225","2021-02-20 11:54:18","2021-04-01 14:13:41");
INSERT INTO adms_nivacs_pgs VALUES("1354","1","151","2","2","4","1","225","2021-02-20 11:54:18",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1353","2","149","2","2","4","5","224","2021-02-19 22:14:09",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1352","1","150","2","2","4","2","224","2021-02-19 22:14:09","2021-04-01 14:13:46");
INSERT INTO adms_nivacs_pgs VALUES("1351","1","150","2","2","4","1","224","2021-02-19 22:14:09",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1350","1","148","2","2","4","5","223","2021-02-18 22:16:45","2021-04-01 15:52:57");
INSERT INTO adms_nivacs_pgs VALUES("1349","1","149","2","2","4","2","223","2021-02-18 22:16:45","2021-04-01 14:13:51");
INSERT INTO adms_nivacs_pgs VALUES("1348","1","149","2","2","4","1","223","2021-02-18 22:16:45",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1347","1","147","2","2","4","5","222","2021-02-16 17:04:05","2021-05-31 14:39:23");
INSERT INTO adms_nivacs_pgs VALUES("1346","1","148","2","2","4","2","222","2021-02-16 17:04:05","2021-04-01 14:14:00");
INSERT INTO adms_nivacs_pgs VALUES("1345","1","148","2","2","4","1","222","2021-02-16 17:04:05",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1344","1","146","2","2","4","5","221","2021-02-16 14:41:56","2021-04-01 16:03:03");
INSERT INTO adms_nivacs_pgs VALUES("1343","1","147","2","2","4","2","221","2021-02-16 14:41:56","2021-04-01 14:14:05");
INSERT INTO adms_nivacs_pgs VALUES("1342","1","147","2","2","4","1","221","2021-02-16 14:41:56",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1341","1","145","1","1","6","5","220","2021-02-15 10:02:36","2021-04-01 16:10:10");
INSERT INTO adms_nivacs_pgs VALUES("1340","1","146","1","1","6","2","220","2021-02-15 10:02:36","2021-04-01 14:23:54");
INSERT INTO adms_nivacs_pgs VALUES("1339","1","146","1","1","6","1","220","2021-02-15 10:02:36","2021-02-15 10:02:59");
INSERT INTO adms_nivacs_pgs VALUES("1338","2","144","2","2","4","5","219","2021-02-14 21:05:58",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1337","1","145","2","2","4","2","219","2021-02-14 21:05:58","2021-04-01 14:14:17");
INSERT INTO adms_nivacs_pgs VALUES("1336","1","145","2","2","4","1","219","2021-02-14 21:05:58",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1335","2","143","2","2","4","5","218","2021-02-14 20:57:21",NULL);
INSERT INTO adms_nivacs_pgs VALUES("988","1","63","2","2","4","5","8","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("987","1","62","2","2","4","5","7","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("986","1","61","2","2","4","5","6","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("985","2","60","2","2","4","5","5","2021-01-25 19:25:37","2021-04-01 15:57:24");
INSERT INTO adms_nivacs_pgs VALUES("984","1","59","2","2","4","5","3","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("983","2","58","2","2","2","5","2","2021-01-25 19:25:37","2021-05-31 14:42:56");
INSERT INTO adms_nivacs_pgs VALUES("982","1","57","2","2","1","5","1","2021-01-25 19:25:37","2021-04-01 15:43:28");
INSERT INTO adms_nivacs_pgs VALUES("995","2","70","2","2","4","5","15","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("994","1","69","2","2","4","5","14","2021-01-25 19:25:37","2021-04-01 15:59:35");
INSERT INTO adms_nivacs_pgs VALUES("993","1","68","2","2","4","5","13","2021-01-25 19:25:37","2021-04-01 15:58:57");
INSERT INTO adms_nivacs_pgs VALUES("992","1","67","2","2","4","5","12","2021-01-25 19:25:37","2021-04-01 15:58:06");
INSERT INTO adms_nivacs_pgs VALUES("991","1","66","2","2","4","5","11","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("990","1","65","2","2","4","5","10","2021-01-25 19:25:37","2021-02-07 22:46:02");
INSERT INTO adms_nivacs_pgs VALUES("989","1","64","2","2","4","5","9","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1002","2","77","2","2","4","5","22","2021-01-25 19:25:37","2021-04-01 16:00:20");
INSERT INTO adms_nivacs_pgs VALUES("1001","2","76","2","2","4","5","21","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1000","2","75","2","2","4","5","20","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("999","2","74","2","2","4","5","19","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("998","2","73","2","2","4","5","18","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("997","2","72","2","2","4","5","17","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("996","2","71","2","2","4","5","16","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("485","1","71","1","1","6","1","92","2020-03-19 19:51:23","2021-02-02 23:34:05");
INSERT INTO adms_nivacs_pgs VALUES("486","1","69","1","1","6","2","92","2020-03-19 19:51:23","2021-04-01 14:37:07");
INSERT INTO adms_nivacs_pgs VALUES("1233","1","109","2","2","4","5","184","2021-02-09 07:47:05","2021-04-01 16:01:53");
INSERT INTO adms_nivacs_pgs VALUES("1334","1","144","2","2","4","2","218","2021-02-14 20:57:21","2021-04-01 14:14:21");
INSERT INTO adms_nivacs_pgs VALUES("489","1","51","1","1","6","5","92","2020-03-19 19:51:23","2021-02-07 22:47:20");
INSERT INTO adms_nivacs_pgs VALUES("1458","2","36","2","2","4","11","39","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1567","2","145","2","2","4","11","219","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1457","2","35","2","2","4","11","38","2021-04-01 22:29:52","2021-04-01 22:31:05");
INSERT INTO adms_nivacs_pgs VALUES("1456","2","34","2","2","4","11","37","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1455","2","33","2","2","4","11","36","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1454","2","32","2","2","4","11","35","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1453","2","31","2","2","4","11","34","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1004","2","79","2","2","4","5","24","2021-01-25 19:25:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1003","2","78","2","2","4","5","23","2021-01-25 19:25:37","2021-04-01 16:00:24");
INSERT INTO adms_nivacs_pgs VALUES("1452","2","30","2","2","4","11","33","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1451","2","29","2","2","4","11","52","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1450","2","28","2","2","4","11","28","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1449","2","27","2","2","4","11","27","2021-04-01 22:29:52","2021-04-01 22:30:23");
INSERT INTO adms_nivacs_pgs VALUES("1448","2","26","2","2","4","11","26","2021-04-01 22:29:52","2021-04-01 22:30:59");
INSERT INTO adms_nivacs_pgs VALUES("1447","2","25","2","2","4","11","25","2021-04-01 22:29:52","2021-04-01 22:30:55");
INSERT INTO adms_nivacs_pgs VALUES("1446","2","24","2","2","4","11","24","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1445","2","23","2","2","4","11","23","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1444","2","22","2","2","4","11","22","2021-04-01 22:29:52","2021-04-01 22:30:28");
INSERT INTO adms_nivacs_pgs VALUES("1443","2","21","2","2","4","11","21","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1442","2","20","2","2","4","11","20","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1441","2","19","2","2","4","11","19","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1440","2","18","2","2","4","11","18","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1439","2","17","2","2","4","11","17","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1566","2","144","2","2","4","11","218","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1565","2","143","2","2","4","11","154","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1564","2","142","2","2","4","11","153","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1563","2","141","2","2","4","11","152","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1562","2","140","2","2","4","11","151","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1561","2","139","2","2","4","11","150","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1438","2","16","2","2","4","11","16","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1560","2","138","2","2","4","11","208","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1559","2","137","2","2","4","11","207","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1558","2","136","2","2","4","11","206","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1557","2","135","2","2","4","11","205","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1556","2","134","2","2","4","11","204","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1555","2","133","2","2","4","11","203","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1554","2","132","2","2","4","11","202","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1553","2","131","2","2","4","11","201","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1552","2","130","2","2","4","11","200","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1551","2","129","2","2","4","11","199","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1550","2","128","2","2","4","11","198","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1549","2","127","2","2","4","11","197","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1548","2","126","2","2","4","11","196","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1547","2","125","2","2","4","11","195","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1546","2","124","2","2","4","11","194","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1545","2","123","2","2","4","11","193","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1544","2","122","2","2","4","11","192","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1543","2","121","2","2","4","11","191","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1542","2","120","2","2","4","11","190","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1541","2","119","2","2","4","11","189","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1540","2","118","2","2","4","11","188","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1437","2","15","2","2","4","11","15","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1064","1","80","1","1","7","5","155","2021-01-27 13:13:06","2021-02-07 22:45:30");
INSERT INTO adms_nivacs_pgs VALUES("1333","1","144","2","2","4","1","218","2021-02-14 20:57:21",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1232","1","110","2","2","4","2","184","2021-02-09 07:47:05","2021-04-01 14:16:59");
INSERT INTO adms_nivacs_pgs VALUES("1061","1","82","1","1","7","2","155","2021-01-27 13:13:06","2021-04-01 14:35:53");
INSERT INTO adms_nivacs_pgs VALUES("1060","1","72","1","1","7","1","155","2021-01-27 13:13:06","2021-02-02 23:22:28");
INSERT INTO adms_nivacs_pgs VALUES("1539","2","117","2","2","4","11","187","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1436","2","14","2","2","4","11","14","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1071","1","83","2","1","10","5","156","2021-01-28 13:36:22","2021-04-01 15:43:59");
INSERT INTO adms_nivacs_pgs VALUES("1332","2","142","2","2","4","5","217","2021-02-14 20:35:45",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1231","1","111","2","2","4","1","184","2021-02-09 07:47:05","2021-04-04 07:04:19");
INSERT INTO adms_nivacs_pgs VALUES("1068","1","5","2","1","10","2","156","2021-01-28 13:36:22","2021-04-01 15:03:45");
INSERT INTO adms_nivacs_pgs VALUES("1067","1","85","2","1","10","1","156","2021-01-28 13:36:22","2021-04-01 16:08:07");
INSERT INTO adms_nivacs_pgs VALUES("1538","2","116","2","2","4","11","186","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1435","2","13","2","2","4","11","13","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1078","1","84","1","1","5","5","157","2021-01-30 23:27:43","2021-04-01 15:50:28");
INSERT INTO adms_nivacs_pgs VALUES("1331","1","143","2","2","4","2","217","2021-02-14 20:35:45","2021-04-01 14:14:25");
INSERT INTO adms_nivacs_pgs VALUES("1230","1","108","2","2","4","5","183","2021-02-08 21:46:11","2021-04-01 16:01:46");
INSERT INTO adms_nivacs_pgs VALUES("1075","1","83","1","1","5","2","157","2021-01-30 23:27:43","2021-04-01 14:21:08");
INSERT INTO adms_nivacs_pgs VALUES("1074","1","82","1","1","5","1","157","2021-01-30 23:27:43","2021-03-10 09:55:23");
INSERT INTO adms_nivacs_pgs VALUES("1537","2","115","2","2","4","11","185","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1434","2","12","2","2","4","11","12","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1085","1","85","2","2","4","5","158","2021-02-03 11:27:45","2021-02-07 22:54:29");
INSERT INTO adms_nivacs_pgs VALUES("1330","1","143","2","2","4","1","217","2021-02-14 20:35:45",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1229","1","109","2","2","4","2","183","2021-02-08 21:46:11","2021-04-01 14:16:55");
INSERT INTO adms_nivacs_pgs VALUES("1082","1","84","2","2","4","2","158","2021-02-03 11:27:45","2021-04-01 14:15:42");
INSERT INTO adms_nivacs_pgs VALUES("1081","1","86","2","2","4","1","158","2021-02-03 11:27:45","2021-02-07 20:24:57");
INSERT INTO adms_nivacs_pgs VALUES("1536","2","114","2","2","4","11","184","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1433","2","11","2","2","4","11","11","2021-04-01 22:29:52","2021-04-01 22:30:50");
INSERT INTO adms_nivacs_pgs VALUES("1092","1","86","2","2","4","5","159","2021-02-04 12:33:26","2021-02-07 22:54:26");
INSERT INTO adms_nivacs_pgs VALUES("1329","2","141","2","2","4","5","216","2021-02-14 20:13:46",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1228","1","110","2","2","4","1","183","2021-02-08 21:46:11","2021-04-04 07:04:23");
INSERT INTO adms_nivacs_pgs VALUES("1089","1","85","2","2","4","2","159","2021-02-04 12:33:26","2021-04-01 14:15:43");
INSERT INTO adms_nivacs_pgs VALUES("1088","1","87","2","2","4","1","159","2021-02-04 12:33:26","2021-02-07 20:24:53");
INSERT INTO adms_nivacs_pgs VALUES("1535","2","113","2","2","4","11","183","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1534","2","112","2","2","4","11","182","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1095","1","88","1","1","5","1","160","2021-02-04 14:24:07","2021-03-10 18:12:16");
INSERT INTO adms_nivacs_pgs VALUES("1096","1","86","1","1","5","2","160","2021-02-04 14:24:07","2021-04-01 14:20:57");
INSERT INTO adms_nivacs_pgs VALUES("1227","1","107","2","2","4","5","182","2021-02-08 20:34:16","2021-02-09 07:21:22");
INSERT INTO adms_nivacs_pgs VALUES("1328","1","142","2","2","4","2","216","2021-02-14 20:13:46","2021-04-01 14:14:33");
INSERT INTO adms_nivacs_pgs VALUES("1099","1","87","1","1","5","5","160","2021-02-04 14:24:07","2021-04-01 15:50:45");
INSERT INTO adms_nivacs_pgs VALUES("1432","2","10","2","2","4","11","10","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1431","1","9","2","2","4","11","9","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1106","1","88","2","2","4","5","161","2021-02-04 15:41:18","2021-02-07 22:54:22");
INSERT INTO adms_nivacs_pgs VALUES("1327","1","142","2","2","4","1","216","2021-02-14 20:13:46",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1226","1","108","2","2","4","2","182","2021-02-08 20:34:16","2021-04-01 14:16:52");
INSERT INTO adms_nivacs_pgs VALUES("1103","1","87","2","2","4","2","161","2021-02-04 15:41:18","2021-04-01 14:15:47");
INSERT INTO adms_nivacs_pgs VALUES("1102","1","89","2","2","4","1","161","2021-02-04 15:41:18","2021-02-07 20:24:45");
INSERT INTO adms_nivacs_pgs VALUES("1533","2","111","2","2","4","11","181","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1430","2","8","2","2","4","11","8","2021-04-01 22:29:52","2021-04-01 22:30:45");
INSERT INTO adms_nivacs_pgs VALUES("1113","1","89","2","2","9","5","162","2021-02-04 21:48:39","2021-04-01 15:49:03");
INSERT INTO adms_nivacs_pgs VALUES("1326","2","140","2","2","4","5","215","2021-02-14 19:21:18",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1225","1","109","2","2","4","1","182","2021-02-08 20:34:16","2021-04-04 07:04:26");
INSERT INTO adms_nivacs_pgs VALUES("1110","1","88","1","1","9","2","162","2021-02-04 21:48:39","2021-05-31 14:34:49");
INSERT INTO adms_nivacs_pgs VALUES("1109","1","94","1","1","9","1","162","2021-02-04 21:48:39","2021-04-04 07:06:11");
INSERT INTO adms_nivacs_pgs VALUES("1532","2","110","2","2","4","11","180","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1429","2","7","2","2","4","11","7","2021-04-01 22:29:52","2021-04-01 22:30:43");
INSERT INTO adms_nivacs_pgs VALUES("1120","1","90","2","2","4","5","163","2021-02-04 22:03:27","2021-02-07 22:54:14");
INSERT INTO adms_nivacs_pgs VALUES("1325","1","141","2","2","4","2","215","2021-02-14 19:21:18","2021-04-01 14:14:37");
INSERT INTO adms_nivacs_pgs VALUES("1224","1","106","2","2","4","5","181","2021-02-08 15:40:02","2021-02-09 07:21:20");
INSERT INTO adms_nivacs_pgs VALUES("1117","1","89","2","2","4","2","163","2021-02-04 22:03:27","2021-04-01 14:15:51");
INSERT INTO adms_nivacs_pgs VALUES("1116","1","95","2","2","4","1","163","2021-02-04 22:03:27","2021-04-04 07:06:04");
INSERT INTO adms_nivacs_pgs VALUES("1531","2","109","2","2","4","11","179","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1428","2","6","2","2","4","11","6","2021-04-01 22:29:52","2021-04-01 22:30:40");
INSERT INTO adms_nivacs_pgs VALUES("1127","1","91","2","2","9","5","164","2021-02-05 10:01:13","2021-04-01 15:49:17");
INSERT INTO adms_nivacs_pgs VALUES("1324","1","141","2","2","4","1","215","2021-02-14 19:21:18",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1223","1","107","2","2","4","2","181","2021-02-08 15:40:02","2021-04-01 14:16:49");
INSERT INTO adms_nivacs_pgs VALUES("1124","1","90","1","1","9","2","164","2021-02-05 10:01:13","2021-05-31 14:34:34");
INSERT INTO adms_nivacs_pgs VALUES("1123","1","93","1","1","9","1","164","2021-02-05 10:01:13","2021-04-04 07:06:17");
INSERT INTO adms_nivacs_pgs VALUES("1530","2","108","2","2","4","11","178","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1427","2","5","2","2","4","11","5","2021-04-01 22:29:52","2021-04-01 22:30:38");
INSERT INTO adms_nivacs_pgs VALUES("1134","1","92","2","2","4","5","165","2021-02-05 10:05:41","2021-02-07 22:54:11");
INSERT INTO adms_nivacs_pgs VALUES("1323","2","139","2","2","4","5","214","2021-02-14 19:07:31",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1222","1","108","2","2","4","1","181","2021-02-08 15:40:02","2021-04-04 07:04:41");
INSERT INTO adms_nivacs_pgs VALUES("1131","1","91","2","2","4","2","165","2021-02-05 10:05:41","2021-04-01 14:15:56");
INSERT INTO adms_nivacs_pgs VALUES("1130","1","96","2","2","4","1","165","2021-02-05 10:05:41","2021-04-04 07:05:59");
INSERT INTO adms_nivacs_pgs VALUES("1529","1","107","2","2","4","11","177","2021-04-01 22:29:53","2021-04-01 22:32:46");
INSERT INTO adms_nivacs_pgs VALUES("1426","1","4","2","2","4","11","4","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1141","1","93","2","2","9","5","166","2021-02-05 12:22:19","2021-04-01 15:49:35");
INSERT INTO adms_nivacs_pgs VALUES("1322","1","140","2","2","4","2","214","2021-02-14 19:07:31","2021-04-01 14:14:40");
INSERT INTO adms_nivacs_pgs VALUES("1221","1","105","2","2","4","5","180","2021-02-08 15:24:18","2021-02-09 07:21:18");
INSERT INTO adms_nivacs_pgs VALUES("1138","1","92","1","1","9","2","166","2021-02-05 12:22:19","2021-05-31 14:34:20");
INSERT INTO adms_nivacs_pgs VALUES("1137","1","91","1","1","9","1","166","2021-02-05 12:22:19","2021-02-13 15:31:20");
INSERT INTO adms_nivacs_pgs VALUES("1528","1","106","2","2","4","11","176","2021-04-01 22:29:53","2021-04-01 22:32:39");
INSERT INTO adms_nivacs_pgs VALUES("1425","1","3","2","2","4","11","3","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1148","1","94","2","2","4","5","167","2021-02-05 13:56:30","2021-02-07 22:54:05");
INSERT INTO adms_nivacs_pgs VALUES("1321","1","140","2","2","4","1","214","2021-02-14 19:07:31",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1220","1","106","2","2","4","2","180","2021-02-08 15:24:18","2021-04-01 14:16:44");
INSERT INTO adms_nivacs_pgs VALUES("1145","1","93","2","2","4","2","167","2021-02-05 13:56:30","2021-04-01 14:16:02");
INSERT INTO adms_nivacs_pgs VALUES("1144","1","97","2","2","4","1","167","2021-02-05 13:56:30","2021-04-04 07:05:55");
INSERT INTO adms_nivacs_pgs VALUES("1527","2","105","2","2","4","11","175","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1424","2","2","2","2","4","11","2","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1155","1","95","2","2","9","5","168","2021-02-05 19:04:11","2021-04-01 15:49:45");
INSERT INTO adms_nivacs_pgs VALUES("1320","2","138","2","2","4","5","213","2021-02-14 18:59:47",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1219","1","107","2","2","4","1","180","2021-02-08 15:24:18","2021-04-04 07:04:48");
INSERT INTO adms_nivacs_pgs VALUES("1152","1","94","1","1","9","2","168","2021-02-05 19:04:11","2021-05-31 14:34:09");
INSERT INTO adms_nivacs_pgs VALUES("1151","1","90","1","1","9","1","168","2021-02-05 19:04:11","2021-02-13 15:31:17");
INSERT INTO adms_nivacs_pgs VALUES("1526","1","104","1","1","6","11","174","2021-04-01 22:29:53","2021-04-01 22:35:29");
INSERT INTO adms_nivacs_pgs VALUES("1423","1","1","2","2","4","11","1","2021-04-01 22:29:52",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1162","1","96","2","2","4","5","169","2021-02-05 22:04:53","2021-02-07 22:54:00");
INSERT INTO adms_nivacs_pgs VALUES("1319","1","139","2","2","4","2","213","2021-02-14 18:59:47","2021-04-01 14:14:43");
INSERT INTO adms_nivacs_pgs VALUES("1218","1","104","2","2","4","5","179","2021-02-08 14:12:40","2021-02-09 07:21:15");
INSERT INTO adms_nivacs_pgs VALUES("1159","1","95","2","2","4","2","169","2021-02-05 22:04:53","2021-04-01 14:16:08");
INSERT INTO adms_nivacs_pgs VALUES("1158","1","98","2","2","4","1","169","2021-02-05 22:04:53","2021-04-04 07:05:51");
INSERT INTO adms_nivacs_pgs VALUES("1525","2","103","2","2","4","11","173","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1422","1","171","2","2","4","5","247","2021-03-28 20:27:50","2021-04-01 15:55:00");
INSERT INTO adms_nivacs_pgs VALUES("1169","1","81","1","1","6","5","170","2021-02-07 11:53:13","2021-02-07 22:53:50");
INSERT INTO adms_nivacs_pgs VALUES("1318","1","139","2","2","4","1","213","2021-02-14 18:59:47",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1217","1","105","2","2","4","2","179","2021-02-08 14:12:40","2021-04-01 14:16:39");
INSERT INTO adms_nivacs_pgs VALUES("1166","1","96","1","1","6","2","170","2021-02-07 11:53:13","2021-04-01 14:22:40");
INSERT INTO adms_nivacs_pgs VALUES("1165","1","83","1","1","6","1","170","2021-02-07 11:53:13","2021-02-07 11:54:50");
INSERT INTO adms_nivacs_pgs VALUES("1524","2","102","2","2","4","11","172","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1421","1","172","2","2","4","2","247","2021-03-28 20:27:50","2021-04-01 14:12:06");
INSERT INTO adms_nivacs_pgs VALUES("1176","1","97","2","2","4","5","171","2021-02-07 13:01:14","2021-02-07 22:52:36");
INSERT INTO adms_nivacs_pgs VALUES("1317","2","137","2","2","4","5","212","2021-02-14 18:39:22",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1216","1","106","2","2","4","1","179","2021-02-08 14:12:40","2021-04-04 07:04:53");
INSERT INTO adms_nivacs_pgs VALUES("1173","1","97","2","2","4","2","171","2021-02-07 13:01:14","2021-04-01 14:16:16");
INSERT INTO adms_nivacs_pgs VALUES("1172","1","99","2","2","4","1","171","2021-02-07 13:01:14","2021-04-04 07:05:46");
INSERT INTO adms_nivacs_pgs VALUES("1523","2","101","2","2","4","11","171","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1420","1","172","2","2","4","1","247","2021-03-28 20:27:50",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1183","1","98","2","2","9","5","172","2021-02-07 15:56:26","2021-04-01 15:49:59");
INSERT INTO adms_nivacs_pgs VALUES("1316","1","138","2","2","4","2","212","2021-02-14 18:39:22","2021-04-01 14:14:46");
INSERT INTO adms_nivacs_pgs VALUES("1215","1","103","2","2","4","5","178","2021-02-08 13:42:18","2021-02-09 07:21:13");
INSERT INTO adms_nivacs_pgs VALUES("1180","1","98","1","1","9","2","172","2021-02-07 15:56:26","2021-05-31 14:33:53");
INSERT INTO adms_nivacs_pgs VALUES("1179","1","100","1","1","9","1","172","2021-02-07 15:56:26","2021-04-04 07:05:38");
INSERT INTO adms_nivacs_pgs VALUES("1522","1","100","1","1","6","11","170","2021-04-01 22:29:53","2021-04-01 22:35:05");
INSERT INTO adms_nivacs_pgs VALUES("1417","1","171","1","1","9","1","246","2021-03-28 11:22:23","2021-03-28 11:22:46");
INSERT INTO adms_nivacs_pgs VALUES("1190","1","99","2","2","4","5","173","2021-02-07 16:12:57","2021-02-07 22:52:27");
INSERT INTO adms_nivacs_pgs VALUES("1315","1","138","2","2","4","1","212","2021-02-14 18:39:22",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1214","1","104","2","2","4","2","178","2021-02-08 13:42:18","2021-04-01 14:16:37");
INSERT INTO adms_nivacs_pgs VALUES("1187","1","99","2","2","4","2","173","2021-02-07 16:12:57","2021-04-01 14:16:21");
INSERT INTO adms_nivacs_pgs VALUES("1186","1","101","2","2","9","1","173","2021-02-07 16:12:57","2021-04-04 07:05:33");
INSERT INTO adms_nivacs_pgs VALUES("1521","2","99","2","2","4","11","169","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1418","1","171","1","1","9","2","246","2021-03-28 11:22:23","2021-05-31 14:30:48");
INSERT INTO adms_nivacs_pgs VALUES("1197","1","82","1","1","6","5","174","2021-02-07 16:43:26","2021-02-07 22:54:38");
INSERT INTO adms_nivacs_pgs VALUES("1314","2","136","2","2","4","5","211","2021-02-14 17:40:54",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1213","1","105","2","2","4","1","178","2021-02-08 13:42:18","2021-04-04 07:05:01");
INSERT INTO adms_nivacs_pgs VALUES("1194","1","100","1","1","6","2","174","2021-02-07 16:43:26","2021-04-01 14:22:24");
INSERT INTO adms_nivacs_pgs VALUES("1193","1","84","1","1","6","1","174","2021-02-07 16:43:26","2021-02-07 20:25:01");
INSERT INTO adms_nivacs_pgs VALUES("1520","2","98","2","2","4","11","168","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1419","1","170","2","2","4","5","246","2021-03-28 11:22:23","2021-04-01 16:03:51");
INSERT INTO adms_nivacs_pgs VALUES("1204","1","100","2","2","4","5","175","2021-02-07 20:59:53","2021-02-07 22:41:16");
INSERT INTO adms_nivacs_pgs VALUES("1313","1","137","2","2","4","2","211","2021-02-14 17:40:54","2021-04-01 14:14:49");
INSERT INTO adms_nivacs_pgs VALUES("1212","1","102","2","2","4","5","177","2021-02-08 12:06:46","2021-02-09 07:21:10");
INSERT INTO adms_nivacs_pgs VALUES("1201","1","101","2","2","4","2","175","2021-02-07 20:59:53","2021-04-01 14:16:27");
INSERT INTO adms_nivacs_pgs VALUES("1200","1","102","2","2","4","1","175","2021-02-07 20:59:53","2021-04-04 07:05:32");
INSERT INTO adms_nivacs_pgs VALUES("1519","2","97","2","2","4","11","167","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1518","2","96","2","2","4","11","166","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("891","1","73","1","1","4","1","150","2020-03-21 23:04:26","2021-02-07 22:29:47");
INSERT INTO adms_nivacs_pgs VALUES("892","2","70","2","2","2","2","150","2020-03-21 23:04:26","2021-04-01 14:37:03");
INSERT INTO adms_nivacs_pgs VALUES("1211","1","103","2","2","4","2","177","2021-02-08 12:06:46","2021-04-01 14:16:33");
INSERT INTO adms_nivacs_pgs VALUES("1312","1","137","2","2","4","1","211","2021-02-14 17:40:54",NULL);
INSERT INTO adms_nivacs_pgs VALUES("895","2","52","2","2","4","5","150","2020-03-21 23:04:26","2021-01-25 19:21:54");
INSERT INTO adms_nivacs_pgs VALUES("1413","1","169","2","2","4","5","244","2021-03-18 14:25:27","2021-04-01 16:03:48");
INSERT INTO adms_nivacs_pgs VALUES("1517","2","95","2","2","4","11","165","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("898","1","74","1","1","4","1","151","2020-03-23 20:58:03","2021-02-07 22:29:58");
INSERT INTO adms_nivacs_pgs VALUES("899","2","71","2","2","4","2","151","2020-03-23 20:58:03","2021-04-01 14:36:59");
INSERT INTO adms_nivacs_pgs VALUES("1210","1","103","2","2","4","1","177","2021-02-08 12:06:46","2021-04-04 07:05:25");
INSERT INTO adms_nivacs_pgs VALUES("1311","2","135","2","2","4","5","210","2021-02-14 10:36:20","2021-04-01 16:02:50");
INSERT INTO adms_nivacs_pgs VALUES("902","2","53","2","2","4","5","151","2020-03-23 20:58:03","2021-01-25 19:21:54");
INSERT INTO adms_nivacs_pgs VALUES("1412","1","170","1","1","9","2","244","2021-03-18 14:25:27","2021-05-31 14:30:58");
INSERT INTO adms_nivacs_pgs VALUES("1516","2","94","2","2","4","11","164","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("905","1","75","2","2","4","1","152","2020-03-24 13:21:34","2021-01-27 14:38:05");
INSERT INTO adms_nivacs_pgs VALUES("906","2","72","2","2","4","2","152","2020-03-24 13:21:34","2021-04-01 14:36:55");
INSERT INTO adms_nivacs_pgs VALUES("1209","1","101","2","2","4","5","176","2021-02-08 10:35:04","2021-02-09 07:21:07");
INSERT INTO adms_nivacs_pgs VALUES("1310","1","136","1","1","9","2","210","2021-02-14 10:36:20","2021-05-31 14:32:30");
INSERT INTO adms_nivacs_pgs VALUES("909","2","54","2","2","4","5","152","2020-03-24 13:21:34","2021-01-25 19:21:54");
INSERT INTO adms_nivacs_pgs VALUES("1411","1","170","1","1","9","1","244","2021-03-18 14:25:27","2021-03-25 10:26:18");
INSERT INTO adms_nivacs_pgs VALUES("1515","2","93","2","2","4","11","163","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("912","1","76","2","2","4","1","153","2020-03-24 14:30:55","2021-01-27 14:38:02");
INSERT INTO adms_nivacs_pgs VALUES("913","2","73","2","2","4","2","153","2020-03-24 14:30:55","2021-04-01 14:36:51");
INSERT INTO adms_nivacs_pgs VALUES("1208","1","102","2","2","4","2","176","2021-02-08 10:35:04","2021-04-01 14:16:30");
INSERT INTO adms_nivacs_pgs VALUES("1309","1","136","1","1","9","1","210","2021-02-14 10:36:20","2021-02-14 10:36:43");
INSERT INTO adms_nivacs_pgs VALUES("916","2","55","2","2","4","5","153","2020-03-24 14:30:55","2021-01-25 19:21:54");
INSERT INTO adms_nivacs_pgs VALUES("1410","2","168","2","2","4","5","243","2021-03-15 19:19:34","2021-05-31 14:38:04");
INSERT INTO adms_nivacs_pgs VALUES("1514","2","92","2","2","4","11","162","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("919","1","77","2","2","4","1","154","2020-03-25 20:00:54","2021-01-27 14:37:59");
INSERT INTO adms_nivacs_pgs VALUES("920","2","74","2","2","4","2","154","2020-03-25 20:00:54","2021-04-01 14:36:47");
INSERT INTO adms_nivacs_pgs VALUES("1207","1","104","2","2","4","1","176","2021-02-08 10:35:04","2021-04-04 07:05:19");
INSERT INTO adms_nivacs_pgs VALUES("1308","1","134","2","2","4","5","209","2021-02-13 23:57:27","2021-05-31 14:40:08");
INSERT INTO adms_nivacs_pgs VALUES("923","2","56","2","2","4","5","154","2020-03-25 20:00:54","2021-01-25 19:21:54");
INSERT INTO adms_nivacs_pgs VALUES("1409","1","169","1","1","9","2","243","2021-03-15 19:19:34","2021-05-31 14:31:09");
INSERT INTO adms_nivacs_pgs VALUES("1513","1","91","2","2","4","11","161","2021-04-01 22:29:53",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1603","1","175","2","2","9","1","250","2021-04-03 10:03:09","2021-04-03 12:55:04");
INSERT INTO adms_nivacs_pgs VALUES("1604","1","176","2","2","4","2","250","2021-04-03 10:03:09","2021-05-31 14:25:44");
INSERT INTO adms_nivacs_pgs VALUES("1605","2","174","2","2","4","5","250","2021-04-03 10:03:09",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1606","2","175","2","2","4","11","250","2021-04-03 10:03:09",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1607","1","176","1","1","9","1","251","2021-04-03 12:22:14","2021-04-03 12:55:20");
INSERT INTO adms_nivacs_pgs VALUES("1608","1","177","1","1","9","2","251","2021-04-03 12:22:14","2021-05-31 14:30:00");
INSERT INTO adms_nivacs_pgs VALUES("1609","2","175","2","2","4","5","251","2021-04-03 12:22:14",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1610","2","176","2","2","4","11","251","2021-04-03 12:22:14",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1611","1","177","2","2","4","1","252","2021-04-03 12:52:35",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1612","1","178","2","2","4","2","252","2021-04-03 12:52:35","2021-05-31 14:25:39");
INSERT INTO adms_nivacs_pgs VALUES("1613","2","176","2","2","4","5","252","2021-04-03 12:52:35",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1614","2","177","2","2","4","11","252","2021-04-03 12:52:35",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1615","1","178","2","2","4","1","253","2021-04-03 13:00:32",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1616","1","179","2","2","4","2","253","2021-04-03 13:00:32","2021-05-31 14:25:34");
INSERT INTO adms_nivacs_pgs VALUES("1617","2","177","2","2","4","5","253","2021-04-03 13:00:32",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1618","2","178","2","2","4","11","253","2021-04-03 13:00:32",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1619","1","179","2","2","4","1","254","2021-04-03 13:51:08",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1620","1","180","2","2","4","2","254","2021-04-03 13:51:08","2021-05-31 14:25:30");
INSERT INTO adms_nivacs_pgs VALUES("1621","2","178","2","2","4","5","254","2021-04-03 13:51:08",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1622","2","179","2","2","4","11","254","2021-04-03 13:51:08",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1623","1","180","1","1","9","1","255","2021-04-03 20:11:03","2021-04-03 20:11:27");
INSERT INTO adms_nivacs_pgs VALUES("1624","1","181","2","2","4","2","255","2021-04-03 20:11:03","2021-05-31 14:25:28");
INSERT INTO adms_nivacs_pgs VALUES("1625","2","179","2","2","4","5","255","2021-04-03 20:11:03",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1626","2","180","2","2","4","11","255","2021-04-03 20:11:03",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1627","1","181","1","1","6","1","256","2021-04-04 12:04:46","2021-04-18 12:47:14");
INSERT INTO adms_nivacs_pgs VALUES("1628","2","182","2","2","4","2","256","2021-04-04 12:04:46",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1629","2","180","2","2","4","5","256","2021-04-04 12:04:46",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1630","2","181","2","2","4","11","256","2021-04-04 12:04:46",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1631","1","182","1","1","9","1","257","2021-04-07 11:58:22","2021-05-17 21:09:13");
INSERT INTO adms_nivacs_pgs VALUES("1632","2","183","2","2","4","2","257","2021-04-07 11:58:22",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1633","2","181","2","2","4","5","257","2021-04-07 11:58:22",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1634","2","182","2","2","4","11","257","2021-04-07 11:58:22",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1635","1","183","1","1","4","1","258","2021-04-25 11:31:38","2021-04-25 11:32:01");
INSERT INTO adms_nivacs_pgs VALUES("1636","2","184","2","2","4","2","258","2021-04-25 11:31:38",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1637","2","182","2","2","4","5","258","2021-04-25 11:31:38",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1638","2","183","2","2","4","11","258","2021-04-25 11:31:38",NULL);


DROP TABLE IF EXISTS adms_niveis_acessos;


CREATE TABLE `adms_niveis_acessos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_niveis_acessos VALUES("1","Super Administrador","1","2018-05-23 00:00:00",NULL);
INSERT INTO adms_niveis_acessos VALUES("2","Administrador","2","2018-05-23 00:00:00","2020-03-10 20:09:06");
INSERT INTO adms_niveis_acessos VALUES("5","Funcionário","3","2018-05-23 00:00:00","2021-02-07 22:33:45");
INSERT INTO adms_niveis_acessos VALUES("11","Estagiário","4","2021-04-01 22:28:40","2021-04-01 22:28:51");


DROP TABLE IF EXISTS adms_paginas;


CREATE TABLE `adms_paginas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `controller` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `metodo` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_controller` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_metodo` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nome_pagina` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `obs` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lib_pub` int NOT NULL DEFAULT '2',
  `icone` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `adms_grps_pg_id` int NOT NULL,
  `adms_tps_pg_id` int NOT NULL,
  `adms_sits_pg_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=259 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_paginas VALUES("1","Home","index","home","index","Home","Pagina inicial                                                                ","1","fas fa-tachometer-alt","1","1","1","2018-05-23 00:00:00","2021-01-28 13:32:12");
INSERT INTO adms_paginas VALUES("2","Usuarios","listar","usuarios","listar","Usuários","Pagina para listar os usuarios                                ","2","fas fa-users","1","1","1","2018-05-23 00:00:00","2021-05-31 13:40:19");
INSERT INTO adms_paginas VALUES("3","Login","acesso","login","acesso","Acesso","Pagina de login","1","fas fa-users","7","1","1","2020-01-30 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("4","Login","logout","login","logout","Sair","pagina para sair do administrativo","1",NULL,"7","1","1","2020-01-30 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("5","NovoUsuario","novoUsuario","novo-usuario","novo-usuario","Novo Usuário","pagina para cadastrar novo usuário","1","fas fa-users","2","1","1","2020-01-30 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("6","Confirmar","confirmarEmail","confirmar","confirmar-email","Confirmar Email","pagina para confirmar email","1",NULL,"7","1","1","2020-02-02 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("7","EsqueceuSenha","esqueceuSenha","esqueceu-senha","esqueceu-senha","Esqueceu a senha","pagina para recuperar a senha","1",NULL,"7","1","1","2020-02-03 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("8","AtualSenha","atualSenha","atual-senha","atual-senha","Atualizar a senha","pagina para atualizar a senha","1",NULL,"7","1","1","2020-02-04 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("9","VerPerfil","perfil","ver-perfil","perfil","Ver o Perfil","Página para ver o perfil do usuário","1","fas fa-id-card","5","1","1","2020-02-06 00:00:00","2020-03-11 08:11:44");
INSERT INTO adms_paginas VALUES("10","AlterarSenha","altSenha","alterar-senha","alt-senha","Alterar a senha","pagina para alterar a senha","2",NULL,"3","1","1","2020-02-06 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("11","EditarPerfil","altPerfil","editar-perfil","alt-perfil","Editar perfil","pagina para editar perfil                                                                ","1",NULL,"3","1","1","2020-02-08 00:00:00","2020-03-11 09:03:33");
INSERT INTO adms_paginas VALUES("12","VerUsuario","verUsuario","ver-usuario","ver-usuario","Ver o Usuario","pagina para ver detalhes do usuario","2",NULL,"5","1","1","2020-02-13 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("13","EditarSenha","editSenha","editar-senha","edit-senha","Editar a senha","pagina para o administrador editar a senha do usuario","2",NULL,"3","1","1","2020-02-14 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("14","EditarUsuario","editUsuario","editar-usuario","edit-usuario","Editar o usuário","pagina para o administrador editar os dados do usuário","2",NULL,"3","1","1","2020-02-14 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("15","CadastrarUsuario","cadUsuario","cadastrar-usuario","cad-usuario","Cadastrar o usuário","pagina para o administrador cadastrar os dados do usuário","2",NULL,"2","1","1","2020-02-25 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("16","ApagarUsuario","apagarUsuario","apagar-usuario","apagar-usuario","Apagar o usuário","pagina para o administrador apagar o usuário","2",NULL,"4","1","1","2020-02-25 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("17","NivelAcesso","listar","nivel-acesso","listar","Nível de Acesso","pagina para listar o nível de acesso","2","fas fa-key","1","1","1","2020-02-27 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("18","CadastrarNivAc","cadNivAc","cadastrar-niv-ac","cad-niv-ac","Cadastrar Nivel de Acesso","Pagina para Cadastrar Nivel de Acesso","2",NULL,"2","1","1","2018-06-23 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("19","VerNivAc","VerNivAc","ver-niv-ac","ver-niv-ac","Detalhes do Nivel de Acesso","Pagina para ver detalhes do Nivel de Acesso","2",NULL,"5","1","1","2018-06-23 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("20","EditarNivAc","editNivAc","editar-niv-ac","edit-niv-ac","Editar Nivel de Acesso","Pagina para Editar Nivel de Acesso","2",NULL,"3","1","1","2018-06-23 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("21","ApagarNivAc","apagarNivAc","apagar-niv-ac","apagar-niv-ac","Apagar Nivel de Acesso","Pagina para Apagar Nivel de Acesso","2",NULL,"4","1","1","2018-06-23 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("22","AltOrdemNivAc","altOrdemNivAc","alt-ordem-niv-ac","alt-ordem-niv-ac","Alterar ordem nivel de acesso","Pagina para alterar ordem nivel de acesso                ","1",NULL,"3","1","1","2018-06-23 00:00:00","2020-03-18 12:45:17");
INSERT INTO adms_paginas VALUES("23","Pagina","listar","pagina","listar","Listar Paginas","Página para listar as páginas do administrativo                                ","2","fas fa-file-alt","1","1","1","2018-06-23 00:00:00","2021-02-05 12:20:32");
INSERT INTO adms_paginas VALUES("24","CadastrarPagina","cadPagina","cadastrar-pagina","cad-pagina","Cadastrar Pagina","Formulario para cadastrar pagina","2",NULL,"2","1","1","2018-06-23 00:00:00",NULL);
INSERT INTO adms_paginas VALUES("25","VerPagina","verPagina","ver-pagina","ver-pagina","Visualizar Página","Página para ver detalhes da página","1",NULL,"5","1","1","2018-06-22 14:25:21",NULL);
INSERT INTO adms_paginas VALUES("26","EditarPagina","editPagina","editar-pagina","edit-pagina","Editar Página","Formulário para editar a página                                                                                ","1",NULL,"3","1","1","2018-06-22 14:43:47","2018-06-22 15:40:01");
INSERT INTO adms_paginas VALUES("27","ApagarPagina","apagarPagina","apagar-pagina","apagar-pagina","Apagar Página","Página para apagar página                ","1",NULL,"4","1","1","2018-06-22 19:17:43",NULL);
INSERT INTO adms_paginas VALUES("28","Permissoes","listar","permissoes","listar","Permissão","Página para listar permissões","2",NULL,"1","1","1","2020-03-03 23:22:27",NULL);
INSERT INTO adms_paginas VALUES("52","VerMenu","verMenu","ver-menu","ver-menu","Ver Menu","Página para ver um menu","2",NULL,"5","1","1","2020-03-17 22:27:40",NULL);
INSERT INTO adms_paginas VALUES("33","VerMenu","verMenu","ver-menu","ver-menu","Visualizar Menus","Página para visualizar menu","2",NULL,"5","1","1","2020-03-04 16:16:17",NULL);
INSERT INTO adms_paginas VALUES("34","EditarMenu","editMenu","editar-menu","edit-menu","Editar Menu","Página para editar o menu","2",NULL,"3","1","1","2020-03-04 16:24:24",NULL);
INSERT INTO adms_paginas VALUES("35","ApagarMenu","apagarMenu","apagar-menu","apagar-menu","Apagar menu","Página para apagar um menu","2",NULL,"4","1","1","2020-03-04 16:28:14",NULL);
INSERT INTO adms_paginas VALUES("36","CadastrarMenu","cadMenu","cadastrar-menu","cad-menu","Cadastrar Menu","Página para cadastrar um menu","2",NULL,"2","1","1","2020-03-04 16:34:13",NULL);
INSERT INTO adms_paginas VALUES("37","LibPermi","libPermi","lib-permi","lib-permi","Liberar Permisões","Página para liberar permissões","2",NULL,"2","1","1","2020-03-08 16:10:23",NULL);
INSERT INTO adms_paginas VALUES("38","LibMenu","libMenu","lib-menu","lib-menu","Liberar Menu","Página para liberar o menu                ","1",NULL,"3","1","1","2020-03-08 18:22:01","2020-03-08 18:39:50");
INSERT INTO adms_paginas VALUES("39","LibDropdown","libDropdown","lib-dropdown","lib-dropdown","Liberar Dropdown","Página para Liberar Dropdown","2",NULL,"3","1","1","2020-03-08 19:02:30",NULL);
INSERT INTO adms_paginas VALUES("40","AltOrdemMenu","altOrdemMenu","alt-ordem-menu","alt-ordem-menu","Alterar Ordem do Menu","Página para Alterar Ordem do Menu","2",NULL,"3","1","1","2020-03-08 20:19:47",NULL);
INSERT INTO adms_paginas VALUES("51","ApagarMenu","apagarMenu","apagar-menu","apagar-menu","Apagar Menu","Página para apagar um menu","2",NULL,"4","1","1","2020-03-17 22:22:50",NULL);
INSERT INTO adms_paginas VALUES("42","Cor","listar","cor","listar","Cores","Página para alterar a cor                                ","1","fas fa-tint","3","1","1","2020-03-13 08:41:57","2020-03-18 11:54:51");
INSERT INTO adms_paginas VALUES("43","EditarCor","editCor","editar-cor","edit-cor","Editar Cores","Página para Editar Cores","2","fas fa-paint-brush","3","1","1","2020-03-13 09:35:05",NULL);
INSERT INTO adms_paginas VALUES("44","VerCor","verCor","ver-cor","ver-cor","Ver Cor","Página para ver uma cor","2","fas fa-paint-brush","5","1","1","2020-03-13 12:42:28",NULL);
INSERT INTO adms_paginas VALUES("45","ApagarCor","apagarCor","apagar-cor","apagar-cor","Apagar Cor","Página para Apagar Cor","2","fas fa-del","4","1","1","2020-03-13 13:14:48",NULL);
INSERT INTO adms_paginas VALUES("46","CadastrarCor","cadCor","cadastrar-cor","cad-cor","Cadastrar Cor","Página para Cadastrar uma Cor                ","2","fas fa-paint-brush","2","1","1","2020-03-13 13:39:40","2021-02-04 20:52:09");
INSERT INTO adms_paginas VALUES("50","SincroPgNivAc","sincroPgNivAc","sincro-pg-niv-ac","sincro-pg-niv-ac","SincroPgNivAc","Página para sincronizar nível de acesso","2",NULL,"3","1","1","2020-03-17 22:20:59",NULL);
INSERT INTO adms_paginas VALUES("47","Professor","index","professor","index","Professor","Página do professor                                                ","1","fas fa-school","5","1","1","2020-03-14 09:39:46","2020-03-14 09:53:15");
INSERT INTO adms_paginas VALUES("48","EditarNivAcPgMenu","editNivAcPgMenu","editar-niv-ac-pg-menu","edit-niv-ac-pg-menu","Editar Item de Menu da Página","Página para Editar Item de Menu da Página                               ","1",NULL,"3","1","1","2020-03-14 22:03:22","2020-03-14 22:11:11");
INSERT INTO adms_paginas VALUES("49","Menu","listar","menu","listar","Itens de menu","ágina para listar os itens do menu                ","1","fas fa-edit","1","1","1","2020-03-17 20:52:20","2020-03-17 20:59:52");
INSERT INTO adms_paginas VALUES("53","AltOrdemItemMenu","altOrdemItemMenu","alt-ordem-item-menu","alt-ordem-item-menu","Alterar Ordem Item Menu","Página para Alterar Ordem Item Menu                                ","1",NULL,"3","1","1","2020-03-17 22:48:23","2020-03-17 23:01:51");
INSERT INTO adms_paginas VALUES("54","EditarFormCadUsuario","editFormCadUsuario","editar-form-cad-usuario","edit-form-cad-usuario","Cadastro de Login","Formulário para editar as informações do formuário cadastrar usuário na página de login","2","fas fa-edit","3","1","1","2020-03-18 10:20:58",NULL);
INSERT INTO adms_paginas VALUES("55","EditarConfEmail","editConfEmail","editar-conf-email","edit-conf-email","Configuração de E-mail","Formulário para editar as configuração do servidor de envio de e-mail","2","fas fa-at","3","1","1","2020-03-18 10:30:25",NULL);
INSERT INTO adms_paginas VALUES("56","GrupoPg","listar","grupo-pg","listar","Grupo de Página","Listar os grupos das páginas","2","fas fa-file-alt","2","1","1","2020-03-18 11:58:09",NULL);
INSERT INTO adms_paginas VALUES("57","VerGrupoPg","verGrupoPg","ver-grupo-pg","ver-grupo-pg","Ver Grupo de Página","Página para ver detalhes do grupo de página","2",NULL,"5","1","1","2020-03-18 12:02:48",NULL);
INSERT INTO adms_paginas VALUES("58","CadastrarGrupoPg","cadGrupoPg","cadastrar-grupo-pg","cad-grupo-pg","Cadastro Grupo de Página","Formulário para cadastrar novo grupo de página","2",NULL,"2","1","1","2020-03-18 12:05:34",NULL);
INSERT INTO adms_paginas VALUES("59","EditarGrupoPg","editGrupoPg","editar-grupo-pg","edit-grupo-pg","Editar Grupo de Página","Formulário para editar os dados do grupo de página","2",NULL,"3","1","1","2020-03-18 12:09:20",NULL);
INSERT INTO adms_paginas VALUES("60","ApagarGrupoPg","apagarGrupoPg","apagar-grupo-pg","apagar-grupo-pg","Apagar Grupo de Página","Página para apagar grupo de página","2",NULL,"4","1","1","2020-03-18 12:37:51",NULL);
INSERT INTO adms_paginas VALUES("61","AltOrdemGrupoPg","altOrdemGrupoPg","alt-ordem-grupo-pg","alt-ordem-grupo-pg","Alterar Ordem Grupo Pg","Altera a ordem do grupo de página","2",NULL,"3","1","1","2020-03-18 12:48:40",NULL);
INSERT INTO adms_paginas VALUES("62","Situacao","listar","situacao","listar","Situação","Página para listar as situações ","2","fas fa-exclamation-triangle","1","1","1","2020-03-18 12:57:54",NULL);
INSERT INTO adms_paginas VALUES("63","VerSit","verSit","ver-sit","ver-sit","Ver Situação","Página para ver detalhes da situação","2",NULL,"5","1","1","2020-03-18 13:00:33",NULL);
INSERT INTO adms_paginas VALUES("64","CadastrarSit","cadSit","cadastrar-sit","cad-sit","Cadastrar Situação","Formulário para cadastrar situação","2",NULL,"2","1","1","2020-03-18 13:03:18",NULL);
INSERT INTO adms_paginas VALUES("65","EditarSit","editSit","editar-sit","edit-sit","Editar a situação","Formulário para editar a situação","2",NULL,"3","1","1","2020-03-18 13:05:56",NULL);
INSERT INTO adms_paginas VALUES("66","ApagarSit","apagarSit","apagar-sit","apagar-sit","Apagar Situação","Página para apagar situação","2",NULL,"4","1","1","2020-03-18 13:09:55",NULL);
INSERT INTO adms_paginas VALUES("67","SituacaoUser","listar","situacao-user","listar","Situação dos Usuários","Listar as situação de usuário","2","far fa-id-badge","1","1","1","2020-03-18 13:14:38",NULL);
INSERT INTO adms_paginas VALUES("68","VerSitUser","verSitUser","ver-sit-user","ver-sit-user","Ver Situação de Usuário","Página para ver detalhes da situação de usuário","2",NULL,"5","1","1","2020-03-18 13:31:32",NULL);
INSERT INTO adms_paginas VALUES("69","CadastrarSitUser","cadSitUser","cadastrar-sit-user","cad-sit-user","Cadastrar Situação de Usuário","Página para cadastrar situação de usuário","2",NULL,"2","1","1","2020-03-18 13:36:26",NULL);
INSERT INTO adms_paginas VALUES("70","EditarSitUser","editSitUser","editar-sit-user","edit-sit-user","Editar Situação de Usuário","Formulário para editar situação de usuário","2",NULL,"3","1","1","2020-03-18 13:40:35",NULL);
INSERT INTO adms_paginas VALUES("71","ApagarSitUser","apagarSitUser","apagar-sit-user","apagar-sit-user","Apagar Situação de Usuário","Página para apagar situação de usuário","2",NULL,"4","1","1","2020-03-18 13:43:37",NULL);
INSERT INTO adms_paginas VALUES("72","SituacaoPg","listar","situacao-pg","listar","Situação de Página","Listar as situações de páginas","2","fas fa-exclamation","1","1","1","2020-03-18 13:49:00",NULL);
INSERT INTO adms_paginas VALUES("73","VerSitPg","verSitPg","ver-sit-pg","ver-sit-pg","Ver Situação de Página","Página para ver detalhes da situação de página","2",NULL,"5","1","1","2020-03-18 13:57:22",NULL);
INSERT INTO adms_paginas VALUES("74","CadastrarSitPg","cadSitPg","cadastrar-sit-pg","cad-sit-pg","Cadastrar Situação de Página","Formulário para cadastrar situação de página","2",NULL,"2","1","1","2020-03-18 14:00:12",NULL);
INSERT INTO adms_paginas VALUES("75","EditarSitPg","editSitPg","editar-sit-pg","edit-sit-pg","Editar situação de página","Formulário para editar situação de página","2",NULL,"3","1","1","2020-03-18 14:22:20",NULL);
INSERT INTO adms_paginas VALUES("76","ApagarSitPg","apagarSitPg","apagar-sit-pg","apagar-sit-pg","Apagar Situação de Página","Página para apagar situação de página","2",NULL,"4","1","1","2020-03-18 14:25:26",NULL);
INSERT INTO adms_paginas VALUES("77","TipoPg","listar","tipo-pg","listar","Tipo de Página","Listar os tipos de páginas","2","fas fa-list-ol","1","1","1","2020-03-18 14:28:48",NULL);
INSERT INTO adms_paginas VALUES("78","CadastrarTipoPg","cadTipoPg","cadastrar-tipo-pg","cad-tipo-pg","Cadastrar Tipo de Página","Formulário para cadastrar o tipo de página","2",NULL,"2","1","1","2020-03-18 17:44:59",NULL);
INSERT INTO adms_paginas VALUES("79","EditarTipoPg","editTipoPg","editar-tipo-pg","edit-tipo-pg","Editar Tipo de Página","Formulário para editar o tipo de página","2",NULL,"3","1","1","2020-03-18 17:49:19",NULL);
INSERT INTO adms_paginas VALUES("216","ApagarStLeitor","apagarStLeitor","apagar-st-leitor","apagar-st-leitor","Apagar StLeitor","Página para apagar uma situação de leitor","2",NULL,"4","5","1","2021-02-14 20:13:46",NULL);
INSERT INTO adms_paginas VALUES("217","EditarStBiblio","editStBiblio","editar-st-biblio","edit-st-biblio","Editar StBiblio","Página para editar uma situação de bibliografia","2",NULL,"3","5","1","2021-02-14 20:35:45",NULL);
INSERT INTO adms_paginas VALUES("209","ApagarClassificacao","apagarClassificacao","apagar-classificacao","apagar-classificacao","Apagar Classificação","Página para apagar classificação","2",NULL,"4","5","1","2021-02-13 23:57:27",NULL);
INSERT INTO adms_paginas VALUES("210","Situacoes","listar","situacoes","listar","Listar Situações","Página para listar as situações: bib_sits_biblio, bib_sits_copia e  bib_sits_leitores                                                                                                                ","2","fas fa-list","1","5","1","2021-02-14 10:36:20","2021-04-04 06:56:24");
INSERT INTO adms_paginas VALUES("211","CadastrarStBiblio","cadStBiblio","cadastrar-st-biblio","cad-st-biblio","Cadastrar StBiblio","página para cadastrar uma nova situação de bibliografia","2",NULL,"2","5","1","2021-02-14 17:40:54",NULL);
INSERT INTO adms_paginas VALUES("212","CadastrarStCopia","cadStCopia","cadastrar-st-copia","cad-st-copia","Cadastrar StCopia","Página para cadastrar uma situação da cópia","2",NULL,"2","5","1","2021-02-14 18:39:22",NULL);
INSERT INTO adms_paginas VALUES("213","CadastrarStLeitor","cadStLeitor","cadastrar-st-leitor","cad-st-leitor","Cadastrar StLeitor","Página para cadastrar uma situação de leitor","2",NULL,"2","5","1","2021-02-14 18:59:47",NULL);
INSERT INTO adms_paginas VALUES("214","ApagarStBiblio","apagarStBiblio","apagar-st-biblio","apagar-st-biblio","Apagar StBiblio","Página para apagar uma situação de bibliografia","2",NULL,"4","5","1","2021-02-14 19:07:31",NULL);
INSERT INTO adms_paginas VALUES("215","ApagarStCopia","apagarStCopia","apagar-st-copia","apagar-st-copia","Apagar StCopia","página para apagar uma situação de cópia","2",NULL,"4","5","1","2021-02-14 19:21:18",NULL);
INSERT INTO adms_paginas VALUES("92","Bibliografias","listar","bibliografias","listar","Bibliografias","Acervo de bibliografias                                                                                                                                                                                                         ","1","fas fa-book","1","5","1","2020-03-19 19:51:23","2021-04-23 10:51:50");
INSERT INTO adms_paginas VALUES("155","Leitores","listar","leitores","listar","Leitores","Página para listar leitores                                                ","2","fas fa-users","1","5","1","2021-01-27 13:13:06","2021-03-21 09:06:51");
INSERT INTO adms_paginas VALUES("156","Opac","listar","opac","listar","Opac","Pesquisar bibliografias OPAC                                                ","1","fas fa-search","11","5","1","2021-01-28 13:36:22","2021-01-28 14:32:37");
INSERT INTO adms_paginas VALUES("157","PesquisarCopias","listar","pesquisar-copias","listar","Localizar Cópias","Página para localizar cópias                                                                                                ","2","fas fa-search","11","5","1","2021-01-30 23:27:43","2021-03-10 09:57:01");
INSERT INTO adms_paginas VALUES("158","CadastrarLeitor","cadLeitor","cadastrar-leitor","cad-leitor","Cadastrar Leitor","Cadastrar leitores","2","fas fa-users","2","5","1","2021-02-03 11:27:45",NULL);
INSERT INTO adms_paginas VALUES("159","VerLeitor","verLeitor","ver-leitor","ver-leitor","Ver leitor","Página para visualizar um leitor","2",NULL,"5","5","1","2021-02-04 12:33:26",NULL);
INSERT INTO adms_paginas VALUES("160","PesqLeitor","listar","pesq-leitor","listar","Localizar Leitor","Página para pesquisar leitores                ","2","fas fa-search","11","5","1","2021-02-04 14:24:07","2021-03-11 08:53:06");
INSERT INTO adms_paginas VALUES("161","VerBibliografia","verBibliografia","ver-bibliografia","ver-bibliografia","Ver Bibliografia","Página para visualizar bibliografia","1",NULL,"5","5","1","2021-02-04 15:41:18",NULL);
INSERT INTO adms_paginas VALUES("162","Municipio","listar","municipio","listar","Listar Municipios","Página para listar municípios                ","2","fas fa-flag","1","5","1","2021-02-04 21:48:39","2021-04-04 07:01:05");
INSERT INTO adms_paginas VALUES("163","CadastrarMunicipio","cadMunicipio","cadastrar-municipio","cad-municipio","Cadastrar Municipio","Página para cadastrar um municipio","2","fas fa-county","2","5","1","2021-02-04 22:03:27",NULL);
INSERT INTO adms_paginas VALUES("164","Bairros","listar","bairros","listar","Listar Bairros","Página para listar bairros                                                                ","2","fas fa-flag","1","5","1","2021-02-05 10:01:13","2021-04-04 07:00:02");
INSERT INTO adms_paginas VALUES("165","CadastrarBairro","cadBairro","cadastrar-bairro","cad-bairro","Cadastrar Bairro","Página para cadastrar bairros","2","fas fa-district","2","5","1","2021-02-05 10:05:41",NULL);
INSERT INTO adms_paginas VALUES("166","Material","listar","material","listar","Listar Material","Página para listar tipos de materiais","2","fas fa-book","1","5","1","2021-02-05 12:22:19",NULL);
INSERT INTO adms_paginas VALUES("167","CadastrarMaterial","cadMaterial","cadastrar-material","cad-material","Cadastrar Material","página para cadastrar novos materiais","2",NULL,"2","5","1","2021-02-05 13:56:30",NULL);
INSERT INTO adms_paginas VALUES("168","Colecao","listar","colecao","listar","Listar Coleção","Página para listar colecões                ","2","fas fa-book","1","5","1","2021-02-05 19:04:11","2021-02-05 22:05:38");
INSERT INTO adms_paginas VALUES("169","CadastrarColecao","cadColecao","cadastrar-colecao","cad-colecao","Cadastrar Coleção","Página para cadastrar uma nova coleção                                ","2","fas fa-book","2","5","1","2021-02-05 22:04:53","2021-02-05 22:22:24");
INSERT INTO adms_paginas VALUES("170","Autores","listar","autores","listar","Autores","Página para listar autores.                                ","2","fas fa-book","1","5","1","2021-02-07 11:53:13","2021-04-23 10:52:15");
INSERT INTO adms_paginas VALUES("171","CadastrarAutor","cadAutor","cadastrar-autor","cad-autor","Cadastrar Autor","Página para cadastrar autores","2","fas fa-users","2","5","1","2021-02-07 13:01:14",NULL);
INSERT INTO adms_paginas VALUES("172","Uf","listar","uf","listar","Listar Estado","Página para listar estados                                ","2","fas fa-flag","1","5","1","2021-02-07 15:56:26","2021-04-04 07:01:51");
INSERT INTO adms_paginas VALUES("173","CadastrarUf","cadUf","cadastrar-uf","cad-uf","Cadastrar Estado","Página para cadastrar um estado                ","2","fas fa-book","2","5","1","2021-02-07 16:12:57","2021-02-07 16:21:26");
INSERT INTO adms_paginas VALUES("174","Editoras","listar","editoras","listar","Editora","Página para listar editoras                                                ","2","fas fa-book","1","5","1","2021-02-07 16:43:26","2021-04-23 10:52:33");
INSERT INTO adms_paginas VALUES("175","CadastrarEditora","cadEditora","cadastrar-editora","cad-editora","Cadastrar Editora","Página para cadastrar a editora","2",NULL,"2","5","1","2021-02-07 20:59:53",NULL);
INSERT INTO adms_paginas VALUES("176","VerAutor","verAutor","ver-autor","ver-autor","Ver Autor","Página para ver o autor","2",NULL,"5","5","1","2021-02-08 10:35:04",NULL);
INSERT INTO adms_paginas VALUES("177","VerEditora","verEditora","ver-editora","ver-editora","Ver Editora","Página para visualizar a editora","2",NULL,"5","5","1","2021-02-08 12:06:46",NULL);
INSERT INTO adms_paginas VALUES("178","VerMunicipio","verMunicipio","ver-municipio","ver-municipio","Ver Municipio","página para visualizar município                ","2",NULL,"5","5","1","2021-02-08 13:42:18","2021-02-08 13:46:39");
INSERT INTO adms_paginas VALUES("179","VerBairro","verBairro","ver-bairro","ver-bairro","Ver Bairro","Página para visualizar bairro                ","2",NULL,"5","5","1","2021-02-08 14:12:40","2021-02-08 14:18:00");
INSERT INTO adms_paginas VALUES("180","VerMaterial","verMaterial","ver-material","ver-material","Ver Material","Página para visualizar material","2",NULL,"5","5","1","2021-02-08 15:24:18",NULL);
INSERT INTO adms_paginas VALUES("181","VerUf","verUf","ver-uf","ver-uf","Ver Estado","Página para visualizar o Estado                ","2",NULL,"5","5","1","2021-02-08 15:40:02","2021-02-09 12:47:38");
INSERT INTO adms_paginas VALUES("182","VerColecao","verColecao","ver-colecao","ver-colecao","Ver Coleção","Página para visualizar coleção","2",NULL,"5","5","1","2021-02-08 20:34:16",NULL);
INSERT INTO adms_paginas VALUES("183","EditarMunicipio","editMunicipio","editar-municipio","edit-municipio","Editar Municipio","Página para editar o municipio","2",NULL,"3","5","1","2021-02-08 21:46:11",NULL);
INSERT INTO adms_paginas VALUES("184","EditarBairro","editBairro","editar-bairro","edit-bairro","Editar Bairro","Página para editar bairro                ","2",NULL,"3","5","1","2021-02-09 07:47:05","2021-02-09 07:48:23");
INSERT INTO adms_paginas VALUES("185","EditarMaterial","editMaterial","editar-material","edit-material","Editar Material","Página para editar tipo de material","2",NULL,"3","5","1","2021-02-09 10:42:40",NULL);
INSERT INTO adms_paginas VALUES("186","EditarColecao","editColecao","editar-colecao","edit-colecao","Editar Coleção","página para editar coleção","2",NULL,"3","5","1","2021-02-09 11:04:17",NULL);
INSERT INTO adms_paginas VALUES("187","EditarUf","editUf","editar-uf","edit-uf","Editar Estado","Página para editar o Estado","2",NULL,"3","5","1","2021-02-09 12:48:51",NULL);
INSERT INTO adms_paginas VALUES("188","Pais","listar","pais","listar","Listar País","Página para listar Países                ","2","fas fa-flag","1","5","1","2021-02-09 13:36:18","2021-04-04 06:58:55");
INSERT INTO adms_paginas VALUES("189","VerPais","verPais","ver-pais","ver-pais","Ver País","Página para visualizar um país","2",NULL,"5","5","1","2021-02-09 14:00:42",NULL);
INSERT INTO adms_paginas VALUES("190","CadastrarPais","cadPais","cadastrar-pais","cad-pais","Cadastrar País","Página para cadastrar um país","2",NULL,"2","5","1","2021-02-09 17:19:38",NULL);
INSERT INTO adms_paginas VALUES("191","EditarPais","editPais","editar-pais","edit-pais","Editar País","Página para editar um país","2",NULL,"3","5","1","2021-02-09 17:24:15",NULL);
INSERT INTO adms_paginas VALUES("192","CadastrarBibliografia","cadBibliografia","cadastrar-bibliografia","cad-bibliografia","Cadastrar Bibliografia","Página para cadastrar uma bibliografia","2",NULL,"2","5","1","2021-02-09 20:03:20",NULL);
INSERT INTO adms_paginas VALUES("193","EditarBibliografia","editBibliografia","editar-bibliografia","edit-bibliografia","Editar Bibliografia","Página para editar bibliografia","2",NULL,"3","5","1","2021-02-10 16:01:03",NULL);
INSERT INTO adms_paginas VALUES("194","EditarAutor","editAutor","editar-autor","edit-autor","Editar Autor","Página para editar um autor","2",NULL,"3","5","1","2021-02-10 21:28:16",NULL);
INSERT INTO adms_paginas VALUES("195","EditarEditora","editEditora","editar-editora","edit-editora","Editar Editora","Página para editar uma editora","2",NULL,"3","5","1","2021-02-10 22:25:16",NULL);
INSERT INTO adms_paginas VALUES("196","EditarLeitor","editLeitor","editar-leitor","edit-leitor","Editar leitor","Página para editar um leitor","2",NULL,"3","5","1","2021-02-11 13:41:41",NULL);
INSERT INTO adms_paginas VALUES("197","ApagarMunicipio","apagarMunicipio","apagar-municipio","apagar-municipio","Apagar Municipio","Página para apagar um municipio","2",NULL,"4","5","1","2021-02-11 14:49:46",NULL);
INSERT INTO adms_paginas VALUES("198","ApagarBairro","apagarBairro","apagar-bairro","apagar-bairro","Apagar Bairro","Página para apagar um bairro","2",NULL,"4","5","1","2021-02-12 20:29:20",NULL);
INSERT INTO adms_paginas VALUES("199","ApagarMaterial","apagarMaterial","apagar-material","apagar-material","Apagar Material","Página para apagar um tipo de material","2",NULL,"4","5","1","2021-02-12 20:42:26",NULL);
INSERT INTO adms_paginas VALUES("200","ApagarColecao","apagarColecao","apagar-colecao","apagar-colecao","Apagar Coleção","Página para apagar uma coleção","2",NULL,"4","5","1","2021-02-12 20:57:39",NULL);
INSERT INTO adms_paginas VALUES("201","ApagarUf","apagarUf","apagar-uf","apagar-uf","Apagar Estado","Página para apagar um Estado","2",NULL,"4","5","1","2021-02-13 09:39:11",NULL);
INSERT INTO adms_paginas VALUES("202","ApagarPais","apagarPais","apagar-pais","apagar-pais","Apagar País","Página para apagar um País","2",NULL,"4","5","1","2021-02-13 11:23:52",NULL);
INSERT INTO adms_paginas VALUES("203","ApagarEditora","apagarEditora","apagar-editora","apagar-editora","Apagar Editora","Página para apagar uma editora","2",NULL,"4","5","1","2021-02-13 15:47:37",NULL);
INSERT INTO adms_paginas VALUES("204","ApagarAutor","apagarAutor","apagar-autor","apagar-autor","Apagar Autor","página para apagar um autor","2",NULL,"4","5","1","2021-02-13 16:05:27",NULL);
INSERT INTO adms_paginas VALUES("205","ApagarBibliografia","apagarBibliografia","apagar-bibliografia","apagar-bibliografia","Apagar Bibliografia","Página para apagar uma bibliografia","2",NULL,"4","5","1","2021-02-13 16:12:05",NULL);
INSERT INTO adms_paginas VALUES("206","Classificacao","listar","classificacao","listar","Listar Classificação","Página para listar classificação                                                                                                                ","2","fas fa-users","1","5","1","2021-02-13 22:55:16","2021-04-04 07:22:52");
INSERT INTO adms_paginas VALUES("207","EditarClassificacao","editClassificacao","editar-classificacao","edit-classificacao","Editar Classificação","Página para editar classificação","2",NULL,"3","5","1","2021-02-13 23:05:29",NULL);
INSERT INTO adms_paginas VALUES("208","CadastrarClassificacao","cadClassificacao","cadastrar-classificacao","cad-classificacao","Cadastrar Classificação","Página para cadastrar uma classificação","2",NULL,"2","5","1","2021-02-13 23:42:08",NULL);
INSERT INTO adms_paginas VALUES("150","PesqUsuarios","listar","pesq-usuarios","listar","Pesquisar Usuários JS","Página para pesquisar usuários                                                ","2","fas fa-users","11","6","1","2020-03-21 23:04:26","2021-01-29 23:21:12");
INSERT INTO adms_paginas VALUES("151","CarregarUsuariosJs","listar","carregar-usuarios-js","listar","Usuários com JS","Listar usuários com JS - complementos","2","fas fa-users","1","6","1","2020-03-23 20:58:03",NULL);
INSERT INTO adms_paginas VALUES("152","VerUsuarioModal","verUsuario","ver-usuario-modal","ver-usuario","Ver Usuario Modal","Ver Usuário Modal","2",NULL,"5","6","1","2020-03-24 13:21:34",NULL);
INSERT INTO adms_paginas VALUES("153","CadastrarUsuarioModal","cadUsuario","cadastrar-usuario-modal","cad-usuario","Cadastrar Usuario Modal","Cadastrar usuário com janela modal","2",NULL,"2","6","1","2020-03-24 14:30:55",NULL);
INSERT INTO adms_paginas VALUES("154","ApagarUsuarioModal","apagarUsuario","apagar-usuario-modal","apagar-usuario","Apagar Usuario Modal","Apagar Usuário Modal","2",NULL,"4","6","1","2020-03-25 20:00:54",NULL);
INSERT INTO adms_paginas VALUES("218","EditarStCopia","editStCopia","editar-st-copia","edit-st-copia","Editar StCopia","Página para editar uma situação de cópia","2",NULL,"3","5","1","2021-02-14 20:57:21",NULL);
INSERT INTO adms_paginas VALUES("219","EditarStLeitor","editStLeitor","editar-st-leitor","edit-st-leitor","Editar StLeitor","Página para editar uma situação de leitor","2",NULL,"3","5","1","2021-02-14 21:05:58",NULL);
INSERT INTO adms_paginas VALUES("220","Copias","listar","copias","listar","Copias","página para listar cópias                                ","2","fas fa-book","1","5","1","2021-02-15 10:02:36","2021-04-23 10:52:54");
INSERT INTO adms_paginas VALUES("221","EditarCopia","editCopia","editar-copia","edit-copia","Editar Cópia","Página para editar cópias","2",NULL,"3","5","1","2021-02-16 14:41:56",NULL);
INSERT INTO adms_paginas VALUES("222","ApagarCopia","apagarCopia","apagar-copia","apagar-copia","Apagar Cópia","Página para apagar uma cópia","2",NULL,"4","5","1","2021-02-16 17:04:05",NULL);
INSERT INTO adms_paginas VALUES("223","CadastrarCopia","cadCopia","cadastrar-copia","cad-copia","Cadastrar Cópia","página para cadastrar uma cópia","2",NULL,"2","5","1","2021-02-18 22:16:45",NULL);
INSERT INTO adms_paginas VALUES("224","ApagarLeitor","apagarLeitor","apagar-leitor","apagar-leitor","Excluir Leitor","Página para excluir um leitor","2",NULL,"4","5","1","2021-02-19 22:14:09",NULL);
INSERT INTO adms_paginas VALUES("225","RetirarCopia","retirarCopia","retirar-copia","retirar-copia","Retirar cópia","Página para retirada de cópias                ","2",NULL,"3","5","1","2021-02-20 11:54:18","2021-02-24 17:24:56");
INSERT INTO adms_paginas VALUES("226","ListarEmprestimos","listarEmprestimos","listar-emprestimos","listar-emprestimos","Listar Empréstimos","Página para listar empréstimos","2",NULL,"1","5","1","2021-02-26 11:29:43",NULL);
INSERT INTO adms_paginas VALUES("227","CadastrarAutorModal","cadAutor","cadastrar-autor-modal","cad-autor","Cadastrar Autor Modal","Cadastrar Autor Modal","2",NULL,"2","5","1","2021-02-28 13:54:17",NULL);
INSERT INTO adms_paginas VALUES("228","CadastrarEditoraModal","cadEditora","cadastrar-editora-modal","cad-editora","Cadastrar Editora Modal","Cadastrar Editora Modal","2",NULL,"2","5","1","2021-02-28 13:56:26",NULL);
INSERT INTO adms_paginas VALUES("229","ReservarCopia","reservarCopia","reservar-copia","reservar-copia","Reservar Cópia","Página para reservar uma cópia","2",NULL,"2","5","1","2021-03-05 10:57:19",NULL);
INSERT INTO adms_paginas VALUES("230","Instituicao","listar","instituicao","listar","Listar Instituicao","Página para listar dados da instituição                                                                ","2","fas fa-graduation-cap","1","5","1","2021-03-06 13:26:06","2021-04-03 09:24:19");
INSERT INTO adms_paginas VALUES("231","CadastrarInstituicao","cadInstituicao","cadastrar-instituicao","cad-instituicao","Cadastrar Instituição","Página para cadastrar uma Instituição                ","2",NULL,"2","5","1","2021-03-06 15:29:01","2021-04-03 11:28:26");
INSERT INTO adms_paginas VALUES("232","ApagarInstituicao","apagarInstituicao","apagar-instituicao","apagar-instituicao","Apagar Instituicao","Página para apagar a Instituição                ","2",NULL,"4","5","1","2021-03-06 21:27:22","2021-04-03 09:54:28");
INSERT INTO adms_paginas VALUES("233","EditarInstituicao","editInstituicao","editar-instituicao","edit-instituicao","Editar Instituicao","Página para editar a instituição                ","2",NULL,"3","5","1","2021-03-08 16:43:16","2021-04-03 09:25:10");
INSERT INTO adms_paginas VALUES("234","VerInstituicao","verInstituicao","ver-instituicao","ver-instituicao","Ver Instituicao","Página para visualizar a instituição                                ","2",NULL,"5","5","1","2021-03-08 19:47:54","2021-04-03 09:42:27");
INSERT INTO adms_paginas VALUES("235","ListarHistorico","listarHistorico","listar-historico","listar-historico","Listar Historico","Página para listar historico","2",NULL,"1","5","1","2021-03-10 09:20:28",NULL);
INSERT INTO adms_paginas VALUES("236","RelatorioAtrasos","listar","relatorio-atrasos","listar","Relatorio Atrasos","Página para listar relatórios                                                                ","2","fas fa-clock","1","5","1","2021-03-10 11:46:49","2021-03-11 11:23:42");
INSERT INTO adms_paginas VALUES("237","Estatisticas","listar","estatisticas","listar","Estatisticas","Página para listar estatísticas","2","fas fa-chart-line","1","5","1","2021-03-11 09:18:09",NULL);
INSERT INTO adms_paginas VALUES("238","Pdf","pdf","pdf","pdf","PDF de Relatórios","Imprime                                                                                                ","2","fas fa-file-pdf","5","5","1","2021-03-11 09:49:52","2021-04-04 06:50:58");
INSERT INTO adms_paginas VALUES("239","RelatorioBibliografias","listar","relatorio-bibliografias","listar","Relatorio Bibliografico","relatório de bibliografias                ","2","fas fa-book","1","5","1","2021-03-11 10:29:59","2021-03-11 10:42:05");
INSERT INTO adms_paginas VALUES("240","RelatorioHistorico","listar","relatorio-historico","listar","Relatorio Historico","Relatório do Histórico","2","fas fa-history","1","5","1","2021-03-11 10:50:06",NULL);
INSERT INTO adms_paginas VALUES("241","ImportarLeitor","importar","importar-leitor","importar","Importar Leitor","Página para Importa Leitor       ","2","fas fa-edit","2","5","1","2021-03-11 14:45:05","2021-03-13 12:02:29");
INSERT INTO adms_paginas VALUES("242","ImportarBibliografia","importar","importar-bibliografia","importar","Importar Bibliografia","Página para importar bibliografias","2",NULL,"2","5","1","2021-03-14 11:59:53",NULL);
INSERT INTO adms_paginas VALUES("243","Camera","camera","camera","camera","Tirar Fotos","Página para listar camera                ","2","fas fa-camera","5","5","1","2021-03-15 19:19:34","2021-03-25 08:10:35");
INSERT INTO adms_paginas VALUES("244","QrCodigo","listar","qr-codigo","listar","Gerar QrCode","Página para listar qrcode                                                                                                ","2","fas fa-qrcode","5","5","1","2021-03-18 14:25:27","2021-03-25 10:24:36");
INSERT INTO adms_paginas VALUES("246","CodigoBar","codigoBar","codigo-bar","codigo-bar","Gerar CodBar","Página para gerar código de barras                                ","2","fas fa-barcode","1","5","1","2021-03-28 11:22:23","2021-03-28 18:27:59");
INSERT INTO adms_paginas VALUES("247","VerCopia","verCopia","ver-copia","ver-copia","Visualizar Copia","Pagina para visualizar a cópia","2",NULL,"5","5","1","2021-03-28 20:27:50",NULL);
INSERT INTO adms_paginas VALUES("248","Sincronizar","sincronizar","sincronizar","sincronizar","Sincronizar","Sincronizar","2",NULL,"3","5","1","2021-04-01 22:48:17",NULL);
INSERT INTO adms_paginas VALUES("249","Backup","backup","backup","backup","Backup","Página para fazer backup                ","2","fas fa-shield-alt","6","5","1","2021-04-02 10:01:56","2021-04-04 06:50:09");
INSERT INTO adms_paginas VALUES("250","CadastrarBiblioteca","cadBiblioteca","cadastrar-biblioteca","cad-biblioteca","Cadastrar Biblioteca","Página para Cadastrar Biblioteca                ","2","fas fa-tachometer-alt","5","5","1","2021-04-03 10:03:09","2021-04-03 12:44:10");
INSERT INTO adms_paginas VALUES("251","ListarBiblioteca","listar","listar-biblioteca","listar","Listar Biblioteca","Página para Listar Biblioteca                                                                                                ","2","fas fa-list-alt","1","5","1","2021-04-03 12:22:14","2021-04-04 06:54:51");
INSERT INTO adms_paginas VALUES("252","ApagarBiblioteca","apagarBiblioteca","apagar-biblioteca","apagar-biblioteca","Apagar Biblioteca","Página para Apagar Biblioteca","2",NULL,"4","5","1","2021-04-03 12:52:35",NULL);
INSERT INTO adms_paginas VALUES("253","VerBiblioteca","verBiblioteca","ver-biblioteca","ver-biblioteca","Ver Biblioteca","Página para Ver Biblioteca","2",NULL,"5","5","1","2021-04-03 13:00:32",NULL);
INSERT INTO adms_paginas VALUES("254","EditarBiblioteca","editBiblioteca","editar-biblioteca","edit-biblioteca","Editar Biblioteca","Página para Editar Biblioteca","2",NULL,"2","5","1","2021-04-03 13:51:08",NULL);
INSERT INTO adms_paginas VALUES("255","Configurar","config","configurar","config","Configurar","Página para configurar o site                ","2","fas fa-cogs","2","5","1","2021-04-03 20:11:03","2021-04-04 06:47:11");
INSERT INTO adms_paginas VALUES("256","Marc21","ler","marc21","ler","Marc21","Página para listar avisos                ","2","fas fa-list-alt","1","5","1","2021-04-04 12:04:46","2021-04-18 12:46:27");
INSERT INTO adms_paginas VALUES("257","CadastrarMarc21","marc21","cadastrar-marc21","marc21","CadastrarMarc21","CadastrarMarc21","2","fas fa-flag","2","5","1","2021-04-07 11:58:22",NULL);
INSERT INTO adms_paginas VALUES("258","Info","info","info","info","Informações PHP","Página para listar informações do site                                ","2","fas fa-info","1","1","1","2021-04-25 11:31:38","2021-04-25 13:47:27");


DROP TABLE IF EXISTS adms_robots;


CREATE TABLE `adms_robots` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_robots VALUES("1","Indexar a pÃ¡gina e seguir os links","index,follow","2018-02-23 00:00:00",NULL);
INSERT INTO adms_robots VALUES("2","NÃ£o indexar a pÃ¡gina mas seguir os links","noindex,follow","2018-02-23 00:00:00",NULL);
INSERT INTO adms_robots VALUES("3","Indexar a pÃ¡gina mas nÃ£o seguir os links","index,nofollow","2018-02-23 00:00:00",NULL);
INSERT INTO adms_robots VALUES("4","NÃ£o indexar a pÃ¡gina e nem seguir os links","noindex,nofollow","2018-02-23 00:00:00",NULL);
INSERT INTO adms_robots VALUES("5","NÃ£o exibir a versÃ£o em cache da pÃ¡gina","noarchive","2018-02-23 00:00:00",NULL);


DROP TABLE IF EXISTS adms_sits;


CREATE TABLE `adms_sits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adms_cor_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_sits VALUES("1","Ativo","3","2018-05-23 00:00:00",NULL);
INSERT INTO adms_sits VALUES("2","Inativo","4","2018-05-23 00:00:00",NULL);
INSERT INTO adms_sits VALUES("3","Analise","5","2018-05-23 00:00:00","2020-03-18 13:07:15");


DROP TABLE IF EXISTS adms_sits_pgs;


CREATE TABLE `adms_sits_pgs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_sits_pgs VALUES("1","Ativo","success","2018-03-23 00:00:00",NULL);
INSERT INTO adms_sits_pgs VALUES("2","Inativo","danger","2018-03-23 00:00:00",NULL);
INSERT INTO adms_sits_pgs VALUES("3","Analise","primary","2018-03-23 00:00:00",NULL);


DROP TABLE IF EXISTS adms_sits_usuarios;


CREATE TABLE `adms_sits_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adms_cor_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_sits_usuarios VALUES("1","Ativo","3","2018-05-23 00:00:00",NULL);
INSERT INTO adms_sits_usuarios VALUES("2","Inativo","5","2018-05-23 00:00:00",NULL);
INSERT INTO adms_sits_usuarios VALUES("3","Aguardando...","1","2018-05-23 00:00:00",NULL);
INSERT INTO adms_sits_usuarios VALUES("4","Spam","4","2018-05-23 00:00:00",NULL);


DROP TABLE IF EXISTS adms_tps_pgs;


CREATE TABLE `adms_tps_pgs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `obs` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_tps_pgs VALUES("1","adms","Administrativo","Core do Administrativo","1","2018-05-23 00:00:00",NULL);
INSERT INTO adms_tps_pgs VALUES("5","bib","Adminstrativo da biblioteca","Projeto para administrar a biblioteca                ","2","2020-03-18 23:22:41","2021-01-26 18:01:15");
INSERT INTO adms_tps_pgs VALUES("6","cpadms","Complemento do Administrativo","Complemento do administrativo","3","2020-03-21 23:01:53",NULL);


DROP TABLE IF EXISTS adms_usuarios;


CREATE TABLE `adms_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `apelido` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `recuperar_senha` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `chave_descadastro` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `conf_email` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagem` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `adms_niveis_acesso_id` int NOT NULL,
  `adms_sits_usuario_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_usuarios VALUES("1","SuperAdmininstrador","Admin","admin@gmail.com","admin","$2y$10$8g564yjTzvdT6iZnLo3Rm.VD74fm5OnFOxp2XqtAAEh1aGLOz0ZiS",NULL,NULL,NULL,"tuxadmin.jpeg","1","1","2020-02-04 17:45:19","2021-05-31 14:11:32");
INSERT INTO adms_usuarios VALUES("25","Estagiário","Estagiário","estagiário@emal.br","estagio","$2y$10$wXMI1DsVHvWTButleQ9xauCjyugIo1FIMxFpRoNvaJ9iQEyFq6/BO",NULL,NULL,NULL,"graduado.png","11","1","2021-02-28 19:57:21","2021-05-31 14:17:35");
INSERT INTO adms_usuarios VALUES("4","Edio Mazera","Edio","mazera3@gmail.com","mazera","$2y$10$V3nEkKCAcru/zIdhjH6aWOWJS4RZwPVLt.EsJv0KeQsLcc7QIq3he",NULL,NULL,NULL,"user.png","2","1","2020-02-25 20:13:47","2021-04-01 14:26:30");
INSERT INTO adms_usuarios VALUES("23","Administrador","bibelivre","bibelivre@gmail.com","bibelivre","$2y$10$3UBQAk6u./2hpF88ZNT3e.9kZ4mua3OAKDoUUptUkmN8ssxstkfwe",NULL,NULL,NULL,"administrativo.png","2","1","2021-02-11 19:25:35","2021-05-31 14:27:21");
INSERT INTO adms_usuarios VALUES("24","Funcionario","funcionario","funcionario@gmail.com","funcionario","$2y$10$1//u9NBM7uD4E7yPLXQO/OHVcXN7KQBYiDdgGKy4Ng6P04mcmIuy2",NULL,NULL,NULL,"bibliotecario.png","5","1","2021-02-28 19:34:34","2021-05-31 14:22:52");


DROP TABLE IF EXISTS bib_autores;


CREATE TABLE `bib_autores` (
  `aut_id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `autor` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `id_uf` int DEFAULT NULL,
  `id_pais` int DEFAULT NULL,
  `foto_imagem` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`aut_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_autores VALUES("29","2021-01-28 12:03:24",NULL,"Monteiro Lobato","lobato@email.com.br","SP","1","1","monteiro_lobato.png");
INSERT INTO bib_autores VALUES("2","2021-01-28 12:03:24",NULL,"José de Alencar","alencar@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("3","2021-01-28 12:03:24",NULL,"Cecília Meireles ","meireles@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("4","2021-01-28 12:03:24",NULL,"Carlos Drummond de Andrade","drummond@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("5","2021-01-28 12:03:24",NULL,"Machado de Assis","assis@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("6","2021-01-28 12:03:24",NULL,"Clarice Lispector","lispector@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("7","2021-01-28 12:03:24",NULL,"Graciliano Ramos","graciliano@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("8","2021-01-28 12:03:24",NULL,"Mario Quintana","quintana@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("9","2021-01-28 12:03:24",NULL,"João Cabral de Melo Neto","cabral@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("10","2021-01-28 12:03:24",NULL,"Guimarães Rosa","rosa@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("11","2021-01-28 12:03:24",NULL,"Luis Fernando Veríssimo","verissimo@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("12","2021-01-28 12:03:24",NULL,"Ana Maria Machado","machado@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("13","2021-01-28 12:03:24",NULL,"Chico Buarque de Holanda","chico@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("14","2021-01-28 12:03:24","2021-02-11 14:19:04","Adélia Prado","prado@email.com.br","SP                                        ","1","1","adelia-prado.jpeg");
INSERT INTO bib_autores VALUES("15","2021-01-28 12:03:24",NULL,"Eva Furnari","furnari@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("16","2021-01-28 12:03:24",NULL,"Martha Medeiros","martha@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("17","2021-01-28 12:03:24",NULL,"Conceição Evaristo","evaristo@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("18","2021-01-28 12:03:24",NULL,"André Dahmer","dahmer@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("19","2021-01-28 12:03:24",NULL,"Marcelino Freire","freire@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("20","2021-01-28 12:03:24",NULL,"Marçal Aquino","aquino@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("21","2021-01-28 12:03:24",NULL,"Antônio Prata","prata@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("22","2021-01-28 12:03:24",NULL,"Ana Maria Gonçalves","anamaria@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("23","2021-01-28 12:03:24",NULL,"Veronica Stigger","veronica@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("24","2021-01-28 12:03:24",NULL,"Luisa Geisler","luisa@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("25","2021-01-28 12:03:24",NULL,"Raphael Montes","montes@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("26","2021-01-28 12:03:24",NULL,"Daniel Galera","galera@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("27","2021-01-28 12:03:24",NULL,"Ricardo Terto","terto@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("28","2021-01-28 12:03:24",NULL,"Ruth Rocha","ruti@email.com.br","SP","1","1",NULL);
INSERT INTO bib_autores VALUES("36","2021-02-09 22:36:35","2021-02-26 16:11:10","Autor Desconhecido","email desconhecido","endereço desconhecido                                                            ","6","2","php-logo.png");
INSERT INTO bib_autores VALUES("30","2021-02-07 13:57:15",NULL,"Paulo Coelho","coelho@email.com","Rio de Janeiro","1","1","paulo-coelho.jpg");
INSERT INTO bib_autores VALUES("37","2021-02-09 22:36:59",NULL,"Autor Desconhecido","email desconhecido","endereço desconhecido","1","1",NULL);
INSERT INTO bib_autores VALUES("38","2021-02-09 22:38:17",NULL,"Autor Desconhecido","email desconhecido","endereço desconhecido","1","1",NULL);
INSERT INTO bib_autores VALUES("39","2021-02-09 22:39:53",NULL,"Autor Desconhecido","email desconhecido","endereço desconhecido","1","1",NULL);
INSERT INTO bib_autores VALUES("40","2021-02-13 12:39:48",NULL,"Teste 1","teste@gmail.com","xxx                                        ","11","3",NULL);
INSERT INTO bib_autores VALUES("43","2021-02-26 13:33:00",NULL,"Julien Danjou","JulienDanjou@email.br","                                                            ","2","1","julien-danjou.jpg");
INSERT INTO bib_autores VALUES("1","2021-03-03 11:16:29","2021-03-14 11:43:56","Outro","outro@email.br","Endereço aqui","1","1","autor.jpeg");
INSERT INTO bib_autores VALUES("52","2021-03-02 20:50:00",NULL,"Teste 2","teste2@emal.br","                    ","1","1","grupo-companhia-das-letras.png");


DROP TABLE IF EXISTS bib_bairro;


CREATE TABLE `bib_bairro` (
  `br_id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `bairro` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_mun` int DEFAULT NULL,
  `logo_imagem` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`br_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_bairro VALUES("1","2021-02-05 00:00:00",NULL,"Centro","1","centro_NT.jpg");
INSERT INTO bib_bairro VALUES("2","2021-02-05 00:00:00","2021-03-04 11:53:30","Trinta Réis","1","trinta-reis-nt.png");
INSERT INTO bib_bairro VALUES("3","2021-02-05 00:00:00","2021-03-04 11:56:40","Ponta Fina Sul","1","ponta-fina-sul-nt.png");
INSERT INTO bib_bairro VALUES("4","2021-02-05 00:00:00",NULL,"Claraiba","1",NULL);
INSERT INTO bib_bairro VALUES("5","2021-02-05 10:06:36",NULL,"Ponta Fina Norte","1",NULL);
INSERT INTO bib_bairro VALUES("6","2021-02-05 10:07:08","2021-02-11 14:18:12","Aguti","1",NULL);
INSERT INTO bib_bairro VALUES("7","2021-02-05 10:07:46",NULL,"Alto Salto","1",NULL);
INSERT INTO bib_bairro VALUES("8","2021-02-05 10:08:09",NULL,"Alto Pitanga","1",NULL);
INSERT INTO bib_bairro VALUES("9","2021-02-05 10:08:41",NULL,"Baixo Pitanga","1",NULL);
INSERT INTO bib_bairro VALUES("10","2021-02-05 10:08:57",NULL,"Baixo Salto","1",NULL);
INSERT INTO bib_bairro VALUES("11","2021-02-05 10:09:10",NULL,"Bela Vista","1",NULL);
INSERT INTO bib_bairro VALUES("12","2021-02-05 10:09:23",NULL,"Besenello","1",NULL);
INSERT INTO bib_bairro VALUES("13","2021-02-05 10:09:50",NULL,"Cascata","1",NULL);
INSERT INTO bib_bairro VALUES("14","2021-02-05 10:10:08",NULL,"Espraiado","1",NULL);
INSERT INTO bib_bairro VALUES("15","2021-02-05 10:10:35",NULL,"Indaiá","1",NULL);
INSERT INTO bib_bairro VALUES("16","2021-02-05 10:11:50",NULL,"Mato Queimado","1",NULL);
INSERT INTO bib_bairro VALUES("17","2021-02-05 10:12:04",NULL,"Morro da Onça","1",NULL);
INSERT INTO bib_bairro VALUES("18","2021-02-05 10:12:45",NULL,"Ribeirão da Velha","1",NULL);
INSERT INTO bib_bairro VALUES("19","2021-02-05 10:13:46",NULL,"Rio do Braço","1",NULL);
INSERT INTO bib_bairro VALUES("20","2021-02-05 10:14:09",NULL,"São Roque","1",NULL);
INSERT INTO bib_bairro VALUES("21","2021-02-05 10:14:20",NULL,"Salto","1",NULL);
INSERT INTO bib_bairro VALUES("22","2021-02-05 10:14:35",NULL,"São Luiz","1",NULL);
INSERT INTO bib_bairro VALUES("23","2021-02-05 10:14:51",NULL,"São Valentim","1",NULL);
INSERT INTO bib_bairro VALUES("24","2021-02-05 10:15:17",NULL,"Valsugana","1",NULL);
INSERT INTO bib_bairro VALUES("25","2021-02-05 10:15:30",NULL,"Velha","1",NULL);
INSERT INTO bib_bairro VALUES("26","2021-02-05 10:15:41","2021-03-04 11:50:39","Vigolo","1","vigolo-nova-trento.jpg");
INSERT INTO bib_bairro VALUES("31","2021-02-08 15:05:08","2021-03-04 11:46:51","Cardoso","249","cardoso.png");


DROP TABLE IF EXISTS bib_biblio;


CREATE TABLE `bib_biblio` (
  `bib_id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `ultimo_leitor_id` int DEFAULT NULL,
  `tipo_material_id` int NOT NULL,
  `colecao_id` int NOT NULL,
  `chamada` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `isbn` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sub_titulo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ano` char(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `editora_id` int NOT NULL DEFAULT '1',
  `autor_id` int NOT NULL,
  `topicos` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `sit_id` int DEFAULT '1',
  `opac_flag` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'S',
  `capa_imagem` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`bib_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_biblio VALUES("1","2021-01-27 22:17:10","2021-02-13 12:15:19","1","1","1","9788506047348","9788506047348","A Estrela De Índigo","Quando a cor muda de tom","2014","1","1","topicos aqui ...                                                                                                ","1","S","9788506047348.jpeg");
INSERT INTO bib_biblio VALUES("2","2021-01-27 22:17:10",NULL,"2","2","3","9788506047349",NULL,"A Estrela Da Tempestade","Um dia de tempestade ruin","1998","2","2","topicos aqui ...","1","S",NULL);
INSERT INTO bib_biblio VALUES("3","2021-01-27 22:17:10",NULL,"3","3","7","9788506047350",NULL,"A Escrita Na Historia","Historia - ensino medio","2019","3","3","topicos aqui ...","3","S",NULL);
INSERT INTO bib_biblio VALUES("4","2021-01-27 22:17:10",NULL,"1","4","7","9788506047351",NULL,"A Escrita Infantil","O Caminho Da Construção","2015","4","4","topicos aqui ...","1","S",NULL);
INSERT INTO bib_biblio VALUES("5","2021-01-27 22:17:10",NULL,"2","5","14","9788506047352",NULL,"A Escolha - Livro 3","Mais uma escolha aqui","1974","5","5","topicos aqui ...","1","S",NULL);
INSERT INTO bib_biblio VALUES("6","2021-01-27 22:17:10",NULL,"3","6","22","9788506047353",NULL,"A Escrava Isaura","Ficção Brasileira - romance","1969","6","6","topicos aqui ...","2","S",NULL);
INSERT INTO bib_biblio VALUES("7","2021-01-27 22:17:10",NULL,"1","1","22","9788506047354",NULL,"A Escolha de Nadir","Uma desisão importante","2012","7","7","topicos aqui ...","1","S",NULL);
INSERT INTO bib_biblio VALUES("8","2021-01-27 22:17:10","2021-02-16 14:17:07",NULL,"1","22","9788506047355",NULL,"A Escolha de Edio","Ser ou não ser","2005","8","8","topicos aqui ...                                ","1","S",NULL);
INSERT INTO bib_biblio VALUES("9","2021-02-09 21:01:17","2021-03-28 14:24:35",NULL,"1","2","p101f","1234567890","Teste 1 - Didatco","Teste, teste 1","2021","12","30","testes e mais testes                                                                                                                                                                                ","1","S",NULL);
INSERT INTO bib_biblio VALUES("10","2021-02-09 21:13:02",NULL,NULL,"8","21","p001","987654","A turma da mônica",NULL,"2021","1","13","mônica","2","S","gibi.png");
INSERT INTO bib_biblio VALUES("14","2021-02-26 13:43:36",NULL,NULL,"1","35","9786586057171","9786586057171","Python Levado a Sério","Conselhos de um faixa-preta sobre implantação, escalabilidade, teste e outros assuntos","2020","12","43","Aborda Python 2 e 3                                ","1","S","python-levado-a-serio.jpeg");
INSERT INTO bib_biblio VALUES("12","2021-02-10 14:20:38","2021-02-14 19:17:57",NULL,"1","16","p5A","789456123","Minhas memórias","memórias de mim mesmo","2021","11","21","minhas memórias aqui...                                                                                                ","4","S","medalha-de-bronze.png");
INSERT INTO bib_biblio VALUES("15","2021-03-02 20:39:16","2021-03-04 15:49:22",NULL,"6","2","11111",NULL,"Outros",NULL,NULL,"15","40","                                                                                                ","1","S",NULL);
INSERT INTO bib_biblio VALUES("17","2021-03-14 12:22:05",NULL,NULL,"1","1","p100","99887760","Titulo 01","Subtitulo 01","2021","1","1","Titulo 01","1","S",NULL);
INSERT INTO bib_biblio VALUES("18","2021-03-14 12:22:05",NULL,NULL,"1","1","p101","99887761","Titulo 02","Subtitulo 02","2021","1","1","Titulo 02","1","S",NULL);
INSERT INTO bib_biblio VALUES("19","2021-03-14 12:22:05",NULL,NULL,"1","1","p102","99887762","Titulo 03","Subtitulo 03","2021","1","1","Titulo 03","1","S",NULL);
INSERT INTO bib_biblio VALUES("20","2021-03-14 12:22:05",NULL,NULL,"1","1","p103","99887763","Titulo 04","Subtitulo 04","2021","1","1","Titulo 04","1","S",NULL);
INSERT INTO bib_biblio VALUES("21","2021-03-14 12:22:05",NULL,NULL,"1","1","p104","99887764","Titulo 05","Subtitulo 05","2021","1","1","Titulo 05","1","S",NULL);
INSERT INTO bib_biblio VALUES("22","2021-03-14 12:22:05",NULL,NULL,"1","1","p105","99887765","Titulo 06","Subtitulo 06","2021","1","1","Titulo 06","1","S",NULL);
INSERT INTO bib_biblio VALUES("23","2021-03-14 12:22:05",NULL,NULL,"1","1","p106","99887766","Titulo 07","Subtitulo 07","2021","1","1","Titulo 07","1","S",NULL);
INSERT INTO bib_biblio VALUES("24","2021-03-14 12:22:05",NULL,NULL,"1","1","p107","99887767","Titulo 08","Subtitulo 08","2021","1","1","Titulo 08","1","S",NULL);
INSERT INTO bib_biblio VALUES("25","2021-03-14 12:22:05",NULL,NULL,"1","1","p108","99887768","Titulo 09","Subtitulo 09","2021","1","1","Titulo 09","1","S",NULL);
INSERT INTO bib_biblio VALUES("26","2021-03-14 12:22:05",NULL,NULL,"1","1","p109","99887769","Titulo 10","Subtitulo 10","2021","1","1","Titulo 10","1","S",NULL);
INSERT INTO bib_biblio VALUES("27","2021-03-14 12:22:05",NULL,NULL,"1","1","p110","99887770","Titulo 11","Subtitulo 11","2021","1","1","Titulo 11","1","S",NULL);
INSERT INTO bib_biblio VALUES("28","2021-03-14 12:22:05",NULL,NULL,"1","1","p111","99887771","Titulo 12","Subtitulo 12","2021","1","1","Titulo 12","1","S",NULL);
INSERT INTO bib_biblio VALUES("29","2021-03-14 12:22:05",NULL,NULL,"1","1","p112","99887772","Titulo 13","Subtitulo 13","2021","1","1","Titulo 13","1","S",NULL);
INSERT INTO bib_biblio VALUES("30","2021-03-14 12:22:05",NULL,NULL,"1","1","p113","99887773","Titulo 14","Subtitulo 14","2021","1","1","Titulo 14","1","S",NULL);
INSERT INTO bib_biblio VALUES("31","2021-03-14 12:22:05",NULL,NULL,"1","1","p114","99887774","Titulo 15","Subtitulo 15","2021","1","1","Titulo 15","1","S",NULL);
INSERT INTO bib_biblio VALUES("32","2021-03-14 12:22:05",NULL,NULL,"1","1","p115","99887775","Titulo 16","Subtitulo 16","2021","1","1","Titulo 16","1","S",NULL);
INSERT INTO bib_biblio VALUES("33","2021-03-14 12:22:05",NULL,NULL,"1","1","p116","99887776","Titulo 17","Subtitulo 17","2021","1","1","Titulo 17","1","S",NULL);
INSERT INTO bib_biblio VALUES("34","2021-03-14 12:22:05",NULL,NULL,"1","1","p117","99887777","Titulo 18","Subtitulo 18","2021","1","1","Titulo 18","1","S",NULL);
INSERT INTO bib_biblio VALUES("35","2021-03-14 12:22:05",NULL,NULL,"1","1","p118","99887778","Titulo 19","Subtitulo 19","2021","1","1","Titulo 19","1","S",NULL);
INSERT INTO bib_biblio VALUES("36","2021-03-14 12:25:29",NULL,NULL,"1","1","p119","99887779","Titulo 20","Subtitulo 20","2021","1","1","Titulo 20","1","S",NULL);
INSERT INTO bib_biblio VALUES("37","2021-03-14 12:25:29",NULL,NULL,"1","1","p120","99887780","Titulo 21","Subtitulo 21","2021","1","1","Titulo 21","1","S",NULL);
INSERT INTO bib_biblio VALUES("38","2021-03-14 12:25:29",NULL,NULL,"1","1","p121","99887781","Titulo 22","Subtitulo 22","2021","1","1","Titulo 22","1","S",NULL);
INSERT INTO bib_biblio VALUES("39","2021-03-14 12:25:29",NULL,NULL,"1","1","p122","99887782","Titulo 23","Subtitulo 23","2021","1","1","Titulo 23","1","S",NULL);
INSERT INTO bib_biblio VALUES("40","2021-03-14 12:25:29",NULL,NULL,"1","1","p123","99887783","Titulo 24","Subtitulo 24","2021","1","1","Titulo 24","1","S",NULL);
INSERT INTO bib_biblio VALUES("41","2021-03-14 12:25:29",NULL,NULL,"1","1","p124","99887784","Titulo 25","Subtitulo 25","2021","1","1","Titulo 25","1","S",NULL);
INSERT INTO bib_biblio VALUES("42","2021-03-14 12:25:29",NULL,NULL,"1","1","p125","99887785","Titulo 26","Subtitulo 26","2021","1","1","Titulo 26","1","S",NULL);
INSERT INTO bib_biblio VALUES("43","2021-03-14 12:25:29",NULL,NULL,"1","1","p126","99887786","Titulo 27","Subtitulo 27","2021","1","1","Titulo 27","1","S",NULL);
INSERT INTO bib_biblio VALUES("44","2021-03-14 12:25:29",NULL,NULL,"1","1","p127","99887787","Titulo 28","Subtitulo 28","2021","1","1","Titulo 28","1","S",NULL);
INSERT INTO bib_biblio VALUES("45","2021-03-14 12:25:29",NULL,NULL,"1","1","p128","99887788","Titulo 29","Subtitulo 29","2021","1","1","Titulo 29","1","S",NULL);
INSERT INTO bib_biblio VALUES("46","2021-03-14 12:25:29",NULL,NULL,"1","1","p129","99887789","Titulo 30","Subtitulo 30","2021","1","1","Titulo 30","1","S",NULL);
INSERT INTO bib_biblio VALUES("47","2021-03-14 12:25:29",NULL,NULL,"1","1","p130","99887790","Titulo 31","Subtitulo 31","2021","1","1","Titulo 31","1","S",NULL);
INSERT INTO bib_biblio VALUES("48","2021-03-14 12:25:29",NULL,NULL,"1","1","p131","99887791","Titulo 32","Subtitulo 32","2021","1","1","Titulo 32","1","S",NULL);
INSERT INTO bib_biblio VALUES("49","2021-03-14 12:25:29",NULL,NULL,"1","1","p132","99887792","Titulo 33","Subtitulo 33","2021","1","1","Titulo 33","1","S",NULL);
INSERT INTO bib_biblio VALUES("50","2021-03-14 12:25:29",NULL,NULL,"1","1","p133","99887793","Titulo 34","Subtitulo 34","2021","1","1","Titulo 34","1","S",NULL);
INSERT INTO bib_biblio VALUES("51","2021-03-14 12:25:29",NULL,NULL,"1","1","p134","99887794","Titulo 35","Subtitulo 35","2021","1","1","Titulo 35","1","S",NULL);
INSERT INTO bib_biblio VALUES("16","2021-03-14 12:25:29",NULL,NULL,"1","1","p135","99887795","Titulo 36","Subtitulo 36","2021","1","1","Titulo 36","1","S",NULL);
INSERT INTO bib_biblio VALUES("11","2021-03-14 12:25:29",NULL,NULL,"1","1","p136","99887796","Titulo 37","Subtitulo 37","2021","1","1","Titulo 37","1","S",NULL);
INSERT INTO bib_biblio VALUES("13","2021-03-14 12:25:29",NULL,NULL,"1","1","p137","99887797","Titulo 38","Subtitulo 38","2021","1","1","Titulo 38","1","S",NULL);


DROP TABLE IF EXISTS bib_biblioteca;


CREATE TABLE `bib_biblioteca` (
  `id_biblioteca` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `nome_bib` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nome_inst` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `resp_bib_1` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `email_res_1` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `resp_bib_2` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_res_2` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horario_bib` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `horario_esp` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco_bib` varchar(280) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fone_bib` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_bib` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tema` int DEFAULT NULL,
  `logo_biblioteca` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_biblioteca`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_biblioteca VALUES("1","2021-04-03 12:15:56","2021-04-03 19:35:34","Biblioteca Francisco Mazzola","Escola De Educação Básica Francisco Mazzola","Profº Édio Mazera","mazera3@gmail.com",NULL,NULL,"De segunda a sexta das 8:00 as 22:00",NULL,"Rua Santo Inácio - Centro - Nova Trento","(48) 3267-2155","biblivre@nead.pro.br","(48)99100-0000","8","livros.jpeg");
INSERT INTO bib_biblioteca VALUES("2","2021-04-03 19:27:27","2021-04-03 19:34:24","Biblioteca João Francisco Valle","EEB João Francisco Valle","Profº Édio Mazera","mazera3@gmail.com",NULL,NULL,"De segunda a sexta das 8:00 as 17:00",NULL,"Rua Trinta Réis - Nova Trento","(48) 3267-2000","eebjfv@email.br",NULL,"8","bandeira-nt.png");


DROP TABLE IF EXISTS bib_classificacao;


CREATE TABLE `bib_classificacao` (
  `clas_id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `classificacao` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`clas_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_classificacao VALUES("1","2021-02-13 23:10:38","2021-02-13 23:33:17","Aluno");
INSERT INTO bib_classificacao VALUES("2","2021-02-13 23:10:46","2021-02-13 23:32:52","Professor");
INSERT INTO bib_classificacao VALUES("3","2021-02-13 23:10:52",NULL,"Fundamental (1º ao 5º ano)");
INSERT INTO bib_classificacao VALUES("4","2021-02-13 23:10:57",NULL,"Fundamental (6º ao 9º ano)");
INSERT INTO bib_classificacao VALUES("5","2021-02-13 23:11:03","2021-02-13 23:32:44","E. Médio (1ª ao 3ª Série)");


DROP TABLE IF EXISTS bib_colecao;


CREATE TABLE `bib_colecao` (
  `col_id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `descricao` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `flag` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dias_retorno` int unsigned NOT NULL,
  `taxa_diaria_atraso` int unsigned NOT NULL,
  `logo_imagem` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`col_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_colecao VALUES("1","2021-02-05 18:41:48","2021-02-11 14:18:25","Outros","N","3","10","outros.jpeg");
INSERT INTO bib_colecao VALUES("2","2021-02-05 18:42:56","2021-02-09 11:23:32","Livros Didáticos","N","365","5","livros_didaticos.jpg");
INSERT INTO bib_colecao VALUES("3","2021-02-05 18:43:17","2021-03-05 09:07:43","Química, Física, Biologia, Matetática","N","90","15","qmc-fis-bio-mat.jpeg");
INSERT INTO bib_colecao VALUES("4","2021-02-05 18:43:25",NULL,"Línguas - Inglês, Espanhol, Italiano","N","30","10",NULL);
INSERT INTO bib_colecao VALUES("5","2021-02-05 18:43:33",NULL,"Artes, Educação Física","N","30","10",NULL);
INSERT INTO bib_colecao VALUES("6","2021-02-05 18:43:46",NULL,"Poesias Infantis","N","30","10",NULL);
INSERT INTO bib_colecao VALUES("7","2021-02-05 18:43:56",NULL,"Literatura Infantojuvenil","N","30","10",NULL);
INSERT INTO bib_colecao VALUES("8","2021-02-05 18:44:05",NULL,"Literatura Infantil","N","30","10",NULL);
INSERT INTO bib_colecao VALUES("9","2021-02-05 18:44:16",NULL,"Romances","N","30","5",NULL);
INSERT INTO bib_colecao VALUES("10","2021-02-05 18:44:25",NULL,"Língua Portuguesa","N","30","20",NULL);
INSERT INTO bib_colecao VALUES("11","2021-02-05 18:44:35",NULL,"Dicionários, Enciclopédias, Referências","N","7","1",NULL);
INSERT INTO bib_colecao VALUES("12","2021-02-05 18:46:17",NULL,"CDs e DVDs, Equipamentos","N","7","2",NULL);
INSERT INTO bib_colecao VALUES("13","2021-02-05 18:46:27",NULL,"Adulto","N","30","10",NULL);
INSERT INTO bib_colecao VALUES("14","2021-02-05 18:46:36",NULL,"Auto Ajuda, Cohecimento, Comportamento","N","30","20",NULL);
INSERT INTO bib_colecao VALUES("15","2021-02-05 18:46:48",NULL,"Religião e Espiritualidade","N","30","5",NULL);
INSERT INTO bib_colecao VALUES("16","2021-02-05 18:47:41",NULL,"Biografia, Memórias","N","30","10",NULL);
INSERT INTO bib_colecao VALUES("17","2021-02-05 18:47:49",NULL,"Contos e Crônicas","N","30","1",NULL);
INSERT INTO bib_colecao VALUES("18","2021-02-05 18:53:07",NULL,"Educação, Psicologia","N","30","5",NULL);
INSERT INTO bib_colecao VALUES("19","2021-02-05 18:53:16",NULL,"História, Geografia","N","30","15",NULL);
INSERT INTO bib_colecao VALUES("20","2021-02-05 18:53:25",NULL,"Ciências Sociais, Sociologia, Filosofia","N","30","5",NULL);
INSERT INTO bib_colecao VALUES("21","2021-02-05 18:53:34",NULL,"Quadrinhos","N","30","10",NULL);
INSERT INTO bib_colecao VALUES("22","2021-02-05 18:53:43",NULL,"Direito e Legislação","N","30","5",NULL);
INSERT INTO bib_colecao VALUES("23","2021-02-05 18:53:52",NULL,"Literatura Brasileira","N","30","1",NULL);
INSERT INTO bib_colecao VALUES("24","2021-02-05 18:54:00",NULL,"Literatura Estrangeira","N","30","5",NULL);
INSERT INTO bib_colecao VALUES("25","2021-02-05 18:54:08",NULL,"Poesias, Poemas, Tetros","N","30","20",NULL);
INSERT INTO bib_colecao VALUES("26","2021-02-05 18:54:16",NULL,"Política","N","30","5",NULL);
INSERT INTO bib_colecao VALUES("27","2021-02-05 18:54:28",NULL,"Redação","N","30","1",NULL);
INSERT INTO bib_colecao VALUES("28","2021-02-05 18:54:42",NULL,"Revistas","S","30","5",NULL);
INSERT INTO bib_colecao VALUES("29","2021-02-05 18:54:53",NULL,"Turismo, Hospitalidade e Lazer","N","30","2",NULL);
INSERT INTO bib_colecao VALUES("30","2021-02-05 22:32:58",NULL,"Mapas","N","7","5",NULL);
INSERT INTO bib_colecao VALUES("35","2021-02-26 13:27:47",NULL,"Informática & programação","N","7","5","informatica.jpeg");


DROP TABLE IF EXISTS bib_confs_site;


CREATE TABLE `bib_confs_site` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_site` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_confs_site VALUES("1","1","2021-04-05 15:50:03","2021-04-05 15:50:03");


DROP TABLE IF EXISTS bib_copia;


CREATE TABLE `bib_copia` (
  `cop_id` int NOT NULL AUTO_INCREMENT,
  `cop_bib_id` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  `data_emp` date DEFAULT NULL,
  `descricao` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cod_bar` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0000',
  `cont_renov` tinyint unsigned DEFAULT '0',
  `sit_copia` int NOT NULL DEFAULT '1',
  `id_leitor` int DEFAULT NULL,
  `data_dev` date DEFAULT NULL,
  `data_res` date DEFAULT NULL,
  `data_lib` date DEFAULT NULL,
  `sit_res` int DEFAULT '1',
  `id_res` int DEFAULT NULL,
  PRIMARY KEY (`cop_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_copia VALUES("8","2","2021-02-02 11:03:32","2021-03-29 22:41:24",NULL,"Volume 1","45d1",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("7","5","2021-02-02 11:03:32","2021-02-20 22:15:51",NULL,"Volume 1","45c9",NULL,"4",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("6","2","2021-02-02 11:03:32","2021-02-20 22:15:40",NULL,"Volume 1","45c8",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("3","2","2021-02-02 11:03:32","2021-04-04 09:14:45",NULL,"Volume 1","45c5",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("1","1","2021-02-02 11:03:32","2021-03-30 21:30:53","2021-01-30","Volume 1","45c3",NULL,"2","7","2021-03-28",NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("2","2","2021-02-02 11:03:32","2021-04-04 09:14:47",NULL,"Volume 1","45c5",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("12","3","2021-02-02 11:03:32","2021-03-10 09:36:23",NULL,"Volume 1","38d1",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("4","2","2021-02-02 11:03:32","2021-03-30 21:37:09","2021-01-30","Volume 1","45c6",NULL,"2","9","2021-04-01",NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("5","5","2021-02-02 11:03:32","2021-03-10 09:36:24",NULL,"Volume 1","45c7",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("19","7","2021-02-02 11:03:32","2021-03-13 16:19:31",NULL,"Volume 1","45d2",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("20","4","2021-02-19 09:16:49","2021-03-10 09:36:21",NULL,"aaaa","1111",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("21","4","2021-02-19 09:17:53","2021-03-04 17:51:37",NULL,"bbb","2222",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("22","4","2021-02-19 10:02:06","2021-03-28 19:55:54",NULL,"cccc","2223",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("23","1","2021-02-19 10:03:31","2021-03-10 09:36:19",NULL,"ddd","46c3",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("24","6","2021-02-19 10:04:59","2021-03-13 16:19:29",NULL,"eeee","47353",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("25","8","2021-02-19 10:09:09","2021-03-05 13:12:26",NULL,"FFFFFFFF","47355",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("27","1","2021-02-19 11:47:25","2021-03-05 09:03:28",NULL,"gggg","47cd",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("28","1","2021-02-19 11:48:33","2021-03-04 12:16:40",NULL,"hhhhhhhh","48fg",NULL,"6",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("26","9","2021-02-19 11:49:16","2021-03-28 16:38:15",NULL,"teste 1-teste 1","did2021",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("18","10","2021-02-19 11:51:19",NULL,NULL,"Volume 7","777x",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("17","1","2021-02-19 14:42:03","2021-03-05 10:08:26",NULL,"ab14 teste","ab14",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("16","12","2021-02-19 17:06:14",NULL,NULL,"146592","146592",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("15","12","2021-02-19 17:06:21",NULL,NULL,"334099","334099",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("14","12","2021-02-19 17:06:29",NULL,NULL,"925819","925819",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("13","3","2021-02-19 17:42:32","2021-03-04 12:18:59",NULL,"557067","557067",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("11","3","2021-02-19 18:00:05","2021-03-13 16:19:26",NULL,"898241","898241",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("10","2","2021-02-02 11:03:32","2021-04-04 09:14:42",NULL,"Volume 1","45c5",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("9","15","2021-03-04 15:49:39","2021-03-30 19:30:07",NULL,"didatico","5555",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("41","10","2021-03-29 18:12:56",NULL,NULL,"livro da monica","239915",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("40","1","2021-03-29 13:08:06","2021-03-29 13:08:29",NULL,"Descrição: 915482","915482",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);
INSERT INTO bib_copia VALUES("42","11","2021-05-31 15:24:05",NULL,NULL,"titulo 37 - subtitulo 37","321064",NULL,"1",NULL,NULL,NULL,NULL,"1",NULL);


DROP TABLE IF EXISTS bib_editora;


CREATE TABLE `bib_editora` (
  `ed_id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `editora` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `endereco` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `id_uf` int DEFAULT NULL,
  `id_pais` int NOT NULL DEFAULT '1',
  `logo_imagem` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ed_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_editora VALUES("18","2021-01-27 22:45:35",NULL,"Companhia das Letras","São Paulo ...","2","1",NULL);
INSERT INTO bib_editora VALUES("2","2021-01-27 22:45:35",NULL,"Editora Rocco","Rio de Janeiro ...","3","1",NULL);
INSERT INTO bib_editora VALUES("3","2021-01-27 22:45:35",NULL,"Editora Arqueiro","São Paulo ...","2","1",NULL);
INSERT INTO bib_editora VALUES("4","2021-01-27 22:45:35",NULL,"Editora Intrínseca","Rio de Janeiro ...","3","1",NULL);
INSERT INTO bib_editora VALUES("5","2021-01-27 22:45:35",NULL,"Editora Sextante","Rio de Janeiro ...","3","1",NULL);
INSERT INTO bib_editora VALUES("6","2021-01-27 22:45:35",NULL,"Ediouro","Rio de Janeiro ...","3","1",NULL);
INSERT INTO bib_editora VALUES("7","2021-01-27 22:45:35",NULL,"Panda Books","Panda Books / Editora Original – A/C Departamento Editorial Rua Henrique Schaumann, 286 cj. 41 – Cerqueira César. CEP 05413-010 – São Paulo/SP. - editorial@pandabooks.com.br","2","1",NULL);
INSERT INTO bib_editora VALUES("8","2021-01-27 22:45:35",NULL,"FTD","São Paulo ...","2","1",NULL);
INSERT INTO bib_editora VALUES("9","2021-01-27 22:45:35",NULL,"Edições Loyola","São Paulo - editorial@loyola.com.br ...","2","1",NULL);
INSERT INTO bib_editora VALUES("10","2021-01-27 22:45:35",NULL,"Editora Record","Rio de Janeiro - originais@record.com.br ...","3","1",NULL);
INSERT INTO bib_editora VALUES("11","2021-01-27 22:45:35",NULL,"Editora Moderna","São Paulo  ...","2","1",NULL);
INSERT INTO bib_editora VALUES("12","2021-02-07 21:23:52",NULL,"Novatec Editora Ltda","Rua Luis Antônio dos Santos, 110, CEP 02460-000 - Fone (011) 2959-6529.","2","1","novatec.jpg");
INSERT INTO bib_editora VALUES("13","2021-02-09 22:44:08",NULL,"Editora desconhecida","endereço descohecido","11","1",NULL);
INSERT INTO bib_editora VALUES("14","2021-02-09 22:46:39",NULL,"Editora desconhecida","endereço aqui ...","11","1",NULL);
INSERT INTO bib_editora VALUES("15","2021-02-09 22:53:37","2021-02-13 12:09:35","Teste 1","endereço aqui                                                            ","5","1","phplot.png");
INSERT INTO bib_editora VALUES("17","2021-03-01 18:23:04",NULL,"Teste 2","teste 2, teste 2","2","2","71et38cvwwl.-ac-sx466-.jpg");
INSERT INTO bib_editora VALUES("20","2021-03-01 19:22:36",NULL,"Teste 3","teste 3               ","1","1",NULL);
INSERT INTO bib_editora VALUES("1","2021-03-03 11:17:06","2021-03-14 11:37:39","Outra","Outro                    ","1","1","editora.png");


DROP TABLE IF EXISTS bib_historico;


CREATE TABLE `bib_historico` (
  `id_hist` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `id_lt` int NOT NULL,
  `cp_id` int NOT NULL,
  PRIMARY KEY (`id_hist`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_historico VALUES("1","2021-03-09 21:55:56","75","36");
INSERT INTO bib_historico VALUES("2","2021-03-09 21:57:32","75","24");
INSERT INTO bib_historico VALUES("3","2021-03-09 21:59:30","75","3");
INSERT INTO bib_historico VALUES("4","2021-03-10 08:47:24","1","12");
INSERT INTO bib_historico VALUES("5","2021-03-10 08:47:32","1","20");
INSERT INTO bib_historico VALUES("6","2021-03-10 09:35:31","1","23");
INSERT INTO bib_historico VALUES("7","2021-03-10 09:36:39","1","4");
INSERT INTO bib_historico VALUES("8","2021-03-10 09:49:33","43","8");
INSERT INTO bib_historico VALUES("9","2021-03-28 14:16:37","1","4");
INSERT INTO bib_historico VALUES("10","2021-03-28 14:16:47","1","4");
INSERT INTO bib_historico VALUES("11","2021-03-28 14:17:28","1","4");
INSERT INTO bib_historico VALUES("12","2021-03-28 14:17:28","1","4");
INSERT INTO bib_historico VALUES("13","2021-03-28 14:26:29","1","26");
INSERT INTO bib_historico VALUES("14","2021-03-29 18:11:42","1","9");
INSERT INTO bib_historico VALUES("15","2021-03-29 22:42:14","3","2");
INSERT INTO bib_historico VALUES("16","2021-03-30 21:26:33","3","3");
INSERT INTO bib_historico VALUES("17","2021-03-30 21:30:40","7","1");
INSERT INTO bib_historico VALUES("18","2021-03-30 21:36:34","9","4");


DROP TABLE IF EXISTS bib_instituicao;


CREATE TABLE `bib_instituicao` (
  `id_instituicao` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `nome_instituicao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sigla_instituicao` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `inep` int DEFAULT NULL,
  `horario_instituicao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco_instituicao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fone_instituicao` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_instituicao` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoria_instituicao` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_ensino` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `logo_instituicao` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_instituicao`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_instituicao VALUES("1","2021-03-06 23:38:28","2021-03-08 19:28:56","EEB Francisco Mazzola","EEBFM","42083060","Segunda a Sexta das 7:45 as 22:00","Rua Francisco Valle, 27 - Centro, Nova Trento - SC, 88270-000","(48) 3267-2155","eebfm@sed.sc.gov.br","Pública","João 05:24 - Em verdade, em verdade vos digo que quem ouve a minha palavra, e crê naquele que me enviou, tem a vida eterna e não entra em juízo, mas já passou da morte para a vida.\n                                                        ","logo-escola.png");
INSERT INTO bib_instituicao VALUES("2","2021-03-08 20:21:34",NULL," ESCOLA MUNICIPAL DE EDUCACAO BASICA PROFº FRANCISCO JOAO VALLE","EEBFJV","42082668","Segunda a sábado das 7:30 as 17:00","RUA FRANCISCO DALSENTER, 32 TRINTA REIS. 88270-000 Nova Trento - SC.","(48) 32673253",NULL,"Pública","Pré-Escola, Anos Iniciais do Ensino Fundamental, Anos Finais do Ensino Fundamental, Atendimento Educacional Especializado","eemfjv.jpg");


DROP TABLE IF EXISTS bib_leitor;


CREATE TABLE `bib_leitor` (
  `leitor_id` int NOT NULL AUTO_INCREMENT,
  `cod_barras_leitor` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `primeiro_nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ultimo_nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_mun` int DEFAULT '1',
  `bairro_id` int DEFAULT '1',
  `endereco` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fone` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `classificacao_id` int NOT NULL,
  `sits_leitor_id` int NOT NULL,
  `foto_leitor` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`leitor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=378 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci COMMENT='Cadastro de leitores';

INSERT INTO bib_leitor VALUES("1","253855502","2021-03-13 15:02:33",NULL,"Édio","Mazera","1","3","Rua Felipe Shmidt, 4079","(48) 3267-1590","(48) 9913-43508","mazera3@gmail.com","2","1","tuxadmin.jpeg");
INSERT INTO bib_leitor VALUES("2","4549199279","2021-03-13 16:13:21","2021-03-19 12:08:14","Alisson","Dalla Brida","1","1","                            ",NULL,NULL,"4549199279@estudante.sed.sc.gov.br","1","3",NULL);
INSERT INTO bib_leitor VALUES("3","4541668482","2021-03-13 16:13:21",NULL,"Antonio","Leonel Paixao","1","1",NULL,NULL,NULL,"4541668482@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("4","4500481248","2021-03-13 16:13:21","2021-03-19 12:08:36","Bianca","Bonecher","1","1","                            ",NULL,NULL,"4500481248@estudante.sed.sc.gov.br","1","2",NULL);
INSERT INTO bib_leitor VALUES("5","4540675892","2021-03-13 16:13:21",NULL,"Bianca","Marchi","1","1",NULL,NULL,NULL,"4540675892@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("6","1001217788","2021-03-13 16:13:21","2021-03-30 21:24:43","Bruno","Raupp Chell","1","1","                                                        ",NULL,NULL,"1001217788@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("7","4546610539","2021-03-13 16:13:21","2021-04-04 14:36:39","Camila","Meoqui","1","1","Rua dos Imigrantes, s/n",NULL,NULL,"4546610539@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("8","4541930330","2021-03-13 16:13:21",NULL,"Camile","Marchi","1","1",NULL,NULL,NULL,"4541930330@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("9","4544394600","2021-03-13 16:13:21",NULL,"Camilly","Vitoria Piva","1","1",NULL,NULL,NULL,"4544394600@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("10","4549540868","2021-03-13 16:13:21",NULL,"Cleidir","Hillesheim","1","1",NULL,NULL,NULL,"4549540868@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("11","4500480500","2021-03-13 16:13:21",NULL,"Davi","Borgonha Dalla Brida","1","1",NULL,NULL,NULL,"4500480500@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("12","4545103552","2021-03-13 16:13:21",NULL,"Deivison","Dos Santos","1","1",NULL,NULL,NULL,"4545103552@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("13","4547192153","2021-03-13 16:13:21",NULL,"Eduarda","Minatti Piazza","1","1",NULL,NULL,NULL,"4547192153@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("14","4500478751","2021-03-13 16:13:21",NULL,"Georgea","Garcia Giacomelli","1","1",NULL,NULL,NULL,"4500478751@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("15","4549324570","2021-03-13 16:13:21",NULL,"Guilherme","De Andrade Lofy","1","1",NULL,NULL,NULL,"4549324570@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("16","4500483798","2021-03-13 16:13:21",NULL,"Gustavo","Daltroso","1","1",NULL,NULL,NULL,"4500483798@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("17","4500480802","2021-03-13 16:13:21",NULL,"Gustavo","Elias Darossi","1","1",NULL,NULL,NULL,"4500480802@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("18","4540440453","2021-03-13 16:13:21",NULL,"Hellen","Cristina Capraro Dalla Brida","1","1",NULL,NULL,NULL,"4540440453@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("19","4500479294","2021-03-13 16:13:21",NULL,"Heloysa","Smaniotto","1","1",NULL,NULL,NULL,"4500479294@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("20","4500479111","2021-03-13 16:13:21",NULL,"Herika","Smaniotto","1","1",NULL,NULL,NULL,"4500479111@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("21","1001255191","2021-03-13 16:13:21",NULL,"Ismael","Montibeller","1","1",NULL,NULL,NULL,"1001255191@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("22","4500480969","2021-03-13 16:13:21",NULL,"Johney","Lucas Tedesco","1","1",NULL,NULL,NULL,"4500480969@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("23","4549239181","2021-03-13 16:13:21",NULL,"Larissa","Lofy Michalski","1","1",NULL,NULL,NULL,"4549239181@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("24","4541214813","2021-03-13 16:13:21",NULL,"Lizie","Demonti Rover","1","1",NULL,NULL,NULL,"4541214813@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("25","4500480870","2021-03-13 16:13:21",NULL,"Luiza","Facchini Raizer","1","1",NULL,NULL,NULL,"4500480870@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("26","4500479502","2021-03-13 16:13:21",NULL,"Maria","Julia Mazzola Hoffmann","1","1",NULL,NULL,NULL,"4500479502@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("27","4500480438","2021-03-13 16:13:21",NULL,"Maria","Luiza Demonti","1","1",NULL,NULL,NULL,"4500480438@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("28","4540388443","2021-03-13 16:13:21",NULL,"Maria","Luiza Schmitz Fraga","1","1",NULL,NULL,NULL,"4540388443@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("29","4500481051","2021-03-13 16:13:21",NULL,"Matheus","Speranzini","1","1",NULL,NULL,NULL,"4500481051@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("30","4500482767","2021-03-13 16:13:21",NULL,"Natalia","Michalski","1","1",NULL,NULL,NULL,"4500482767@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("31","4541226650","2021-03-13 16:13:21",NULL,"Nicoly","Anselmini","1","1",NULL,NULL,NULL,"4541226650@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("32","4546080149","2021-03-13 16:13:21",NULL,"Pamela","Michele Neves","1","1",NULL,NULL,NULL,"4546080149@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("33","4500483461","2021-03-13 16:13:21",NULL,"Pedro","Henrique Gon Feller","1","1",NULL,NULL,NULL,"4500483461@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("34","4500478832","2021-03-13 16:13:21",NULL,"Rhian","Girardi","1","1",NULL,NULL,NULL,"4500478832@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("35","4549324090","2021-03-13 16:13:21",NULL,"Sandi","Meurer","1","1",NULL,NULL,NULL,"4549324090@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("36","4549018819","2021-03-13 16:13:21",NULL,"Thiago","Rotta De Souza","1","1",NULL,NULL,NULL,"4549018819@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("37","4500479430","2021-03-13 16:13:21",NULL,"Vitor","Cadorin Dalsasso","1","1",NULL,NULL,NULL,"4500479430@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("38","4500483631","2021-03-13 16:13:21",NULL,"Amanda","Paiva Da Rosa","1","1",NULL,NULL,NULL,"4500483631@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("39","4547239656","2021-03-13 16:13:21",NULL,"Amelie","Carvalho Pimenta","1","1",NULL,NULL,NULL,"4547239656@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("40","4501312482","2021-03-13 16:13:21",NULL,"Andrey","Pereira Buzim","1","1",NULL,NULL,NULL,"4501312482@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("41","4544593858","2021-03-13 16:13:21",NULL,"Anthony","Rafael Huchak Kirst","1","1",NULL,NULL,NULL,"4544593858@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("42","4541182504","2021-03-13 16:13:21",NULL,"Bruno","Dalbosco Rover","1","1",NULL,NULL,NULL,"4541182504@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("43","4542309079","2021-03-13 16:13:21",NULL,"Chaiane","Kamilly Veber","1","1",NULL,NULL,NULL,"4542309079@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("44","4549566808","2021-03-13 16:13:21",NULL,"Cristiano","Burgrever Júnior","1","1",NULL,NULL,NULL,"4549566808@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("45","4549333447","2021-03-13 16:13:21",NULL,"Débora","Mulaski Pereira","1","1",NULL,NULL,NULL,"4549333447@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("46","4548923429","2021-03-13 16:13:21",NULL,"Eduarda","Gomes Da Silva","1","1",NULL,NULL,NULL,"4548923429@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("47","4541199725","2021-03-13 16:13:21",NULL,"Eduardo","Jacson Henrich","1","1",NULL,NULL,NULL,"4541199725@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("48","4500483399","2021-03-13 16:13:21",NULL,"Eloisa","Costa Cucco","1","1",NULL,NULL,NULL,"4500483399@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("49","4500479022","2021-03-13 16:13:21",NULL,"Evellyn","Nascimento Dos Santos","1","1",NULL,NULL,NULL,"4500479022@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("50","4547192145","2021-03-13 16:13:21",NULL,"Franciely","Franzoi","1","1",NULL,NULL,NULL,"4547192145@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("51","4549325479","2021-03-13 16:13:21",NULL,"Gabriel","Tomazi","1","1",NULL,NULL,NULL,"4549325479@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("52","4549451504","2021-03-13 16:13:21",NULL,"Guilherme","Francisco Sanches Garcia","1","1",NULL,NULL,NULL,"4549451504@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("53","4500482864","2021-03-13 16:13:21",NULL,"Iasmin","Motta","1","1",NULL,NULL,NULL,"4500482864@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("54","4541929758","2021-03-13 16:13:21",NULL,"Ilana","Dalla Brida","1","1",NULL,NULL,NULL,"4541929758@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("55","4549139969","2021-03-13 16:13:21",NULL,"Kamili","Tomio","1","1",NULL,NULL,NULL,"4549139969@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("56","4549142765","2021-03-13 16:13:21",NULL,"Kayky","Licheski","1","1",NULL,NULL,NULL,"4549142765@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("57","4549141530","2021-03-13 16:13:21",NULL,"Lilian","Leticia Kniss Da Cunha","1","1",NULL,NULL,NULL,"4549141530@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("58","4500483887","2021-03-13 16:13:21",NULL,"Maria","Luiza Voltolini","1","1",NULL,NULL,NULL,"4500483887@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("59","1001222102","2021-03-13 16:13:21",NULL,"Misael","Oliveira Fernandes","1","1",NULL,NULL,NULL,"1001222102@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("60","4500484115","2021-03-13 16:13:21",NULL,"Nicoli","Dalbosco","1","1",NULL,NULL,NULL,"4500484115@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("61","4500484697","2021-03-13 16:13:21",NULL,"Pedro","Henrique Fantini","1","1",NULL,NULL,NULL,"4500484697@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("62","4546884760","2021-03-13 16:13:21",NULL,"Poliana","Raiser","1","1",NULL,NULL,NULL,"4546884760@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("63","4500483216","2021-03-13 16:13:21",NULL,"Ronnie","Jose Tomasi Junior","1","1",NULL,NULL,NULL,"4500483216@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("64","4500484433","2021-03-13 16:13:21",NULL,"Suelen","Cristina Marchi","1","1",NULL,NULL,NULL,"4500484433@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("65","4549326912","2021-03-13 16:13:21",NULL,"Tonielson","Barbosa Gomes","1","1",NULL,NULL,NULL,"4549326912@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("66","4549172141","2021-03-13 16:13:21",NULL,"Victoria","Colussi Nascimento","1","1",NULL,NULL,NULL,"4549172141@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("67","4549452012","2021-03-13 16:13:21",NULL,"Vitoria","Carolina França Majoni","1","1",NULL,NULL,NULL,"4549452012@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("68","4500482635","2021-03-13 16:13:21",NULL,"Willian","Bonetti Ferrari","1","1",NULL,NULL,NULL,"4500482635@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("69","4549327897","2021-03-13 16:13:21",NULL,"Alyson","Araújo Cardoso","1","1",NULL,NULL,NULL,"4549327897@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("70","4549147546","2021-03-13 16:13:21",NULL,"Amanda","Gomes Da Rosa","1","1",NULL,NULL,NULL,"4549147546@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("71","4546892143","2021-03-13 16:13:21",NULL,"Amanda","Venancio Casemiro","1","1",NULL,NULL,NULL,"4546892143@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("72","4549208871","2021-03-13 16:13:21",NULL,"Ana","Paula Da Silva","1","1",NULL,NULL,NULL,"4549208871@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("73","4549245726","2021-03-13 16:13:21",NULL,"Antonio","Veber","1","1",NULL,NULL,NULL,"4549245726@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("74","4549163185","2021-03-13 16:13:21",NULL,"Bianca","Lunardi","1","1",NULL,NULL,NULL,"4549163185@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("75","4549332300","2021-03-13 16:13:21",NULL,"Brenda","Almeida Borges","1","1",NULL,NULL,NULL,"4549332300@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("76","4549142692","2021-03-13 16:13:21",NULL,"Cíntia","Veneri","1","1",NULL,NULL,NULL,"4549142692@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("77","4549331410","2021-03-13 16:13:21",NULL,"Elizandra","Kricinski","1","1",NULL,NULL,NULL,"4549331410@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("78","4549569050","2021-03-13 16:13:21",NULL,"Everton","Rodrigues De Morais","1","1",NULL,NULL,NULL,"4549569050@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("79","4549235577","2021-03-13 16:13:21",NULL,"Fernando","Paulo Pereira","1","1",NULL,NULL,NULL,"4549235577@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("80","4549247958","2021-03-13 16:13:21",NULL,"Guilherme","Veber","1","1",NULL,NULL,NULL,"4549247958@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("81","4549203772","2021-03-13 16:13:21",NULL,"Guilherme","Vignoli Pinheiro","1","1",NULL,NULL,NULL,"4549203772@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("82","4549197799","2021-03-13 16:13:21",NULL,"Izadora","Costa","1","1",NULL,NULL,NULL,"4549197799@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("83","4549331576","2021-03-13 16:13:21",NULL,"Janaina","Raiser","1","1",NULL,NULL,NULL,"4549331576@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("84","4549671067","2021-03-13 16:13:21",NULL,"Jhelison","Vinicius Aroucha Dos Santos","1","1",NULL,NULL,NULL,"4549671067@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("85","4549535015","2021-03-13 16:13:21",NULL,"Jheniffer","Ketlen Da Silva Szymanski","1","1",NULL,NULL,NULL,"4549535015@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("86","4549230664","2021-03-13 16:13:21",NULL,"Jocimara","Dalagnoli Marchi","1","1",NULL,NULL,NULL,"4549230664@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("87","4544799260","2021-03-13 16:13:21",NULL,"Kaua","Salles Da Silva","1","1",NULL,NULL,NULL,"4544799260@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("88","4549144962","2021-03-13 16:13:21",NULL,"Keren","Sofia Sampaio Rodrigues","1","1",NULL,NULL,NULL,"4549144962@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("89","4549216173","2021-03-13 16:13:21",NULL,"Letícia","Donzelli","1","1",NULL,NULL,NULL,"4549216173@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("90","4549176465","2021-03-13 16:13:21",NULL,"Lurdes","Maria De Oliveira Bonecher","1","1",NULL,NULL,NULL,"4549176465@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("91","4549202458","2021-03-13 16:13:21",NULL,"Maria","Eduarda De Oliveira Da Silva","1","1",NULL,NULL,NULL,"4549202458@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("92","4549226500","2021-03-13 16:13:21",NULL,"Maria","Eduarda Haubert Lindemann","1","1",NULL,NULL,NULL,"4549226500@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("93","4549325207","2021-03-13 16:13:21",NULL,"Mateus","Melzi","1","1",NULL,NULL,NULL,"4549325207@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("94","4549168764","2021-03-13 16:13:21",NULL,"Natanael","Bernardi De Souza","1","1",NULL,NULL,NULL,"4549168764@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("95","4549325614","2021-03-13 16:13:21",NULL,"Natanael","Valczak","1","1",NULL,NULL,NULL,"4549325614@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("96","4549178212","2021-03-13 16:13:21",NULL,"Natasha","Galvan Zonta","1","1",NULL,NULL,NULL,"4549178212@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("97","4549534493","2021-03-13 16:13:21",NULL,"Paula","França De Oliveira","1","1",NULL,NULL,NULL,"4549534493@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("98","4549144270","2021-03-13 16:13:21",NULL,"Tainara","Edelberg Gastler","1","1",NULL,NULL,NULL,"4549144270@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("99","4549234260","2021-03-13 16:13:21",NULL,"Teodoro","Santos Do Nascimento","1","1",NULL,NULL,NULL,"4549234260@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("100","4541334185","2021-03-13 16:13:21",NULL,"Thais","Lacerda Lucianer","1","1",NULL,NULL,NULL,"4541334185@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("101","4501147422","2021-03-13 16:13:21",NULL,"Thayna","Marques Felipe","1","1",NULL,NULL,NULL,"4501147422@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("102","4549657927","2021-03-13 16:13:21",NULL,"Vitoria","Paula Oliveira","1","1",NULL,NULL,NULL,"4549657927@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("103","4549335369","2021-03-13 16:13:21",NULL,"Adriel","Murceski","1","1",NULL,NULL,NULL,"4549335369@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("104","4500611540","2021-03-13 16:13:21",NULL,"Alayse","Campos Gonçalves","1","1",NULL,NULL,NULL,"4500611540@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("105","4549324243","2021-03-13 16:13:21",NULL,"Alexis","Kauan Gomes De Oliveira","1","1",NULL,NULL,NULL,"4549324243@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("106","4545677087","2021-03-13 16:13:21",NULL,"Aline","Bianca Izidoro Nizer","1","1",NULL,NULL,NULL,"4545677087@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("107","4549297319","2021-03-13 16:13:21",NULL,"Alisson","Venicio Eleoterio","1","1",NULL,NULL,NULL,"4549297319@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("108","4549333056","2021-03-13 16:13:21",NULL,"Amanda","Cristina De Oliveira","1","1",NULL,NULL,NULL,"4549333056@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("109","4546890965","2021-03-13 16:13:21",NULL,"Anderson","Oliveira Xavier","1","1",NULL,NULL,NULL,"4546890965@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("110","4547471672","2021-03-13 16:13:21",NULL,"Angélica","Eduarda De Lima","1","1",NULL,NULL,NULL,"4547471672@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("111","1001372120","2021-03-13 16:13:21",NULL,"Ariani","Taisa Jacinto","1","1",NULL,NULL,NULL,"1001372120@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("112","4549331770","2021-03-13 16:13:21",NULL,"Arthur","Maffezzoli","1","1",NULL,NULL,NULL,"4549331770@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("113","4541186461","2021-03-13 16:13:21",NULL,"Beatriz","Da Cruz Da Silva","1","1",NULL,NULL,NULL,"4541186461@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("114","4548724027","2021-03-13 16:13:21",NULL,"Caique","Gabriel Bernardi","1","1",NULL,NULL,NULL,"4548724027@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("115","4549576013","2021-03-13 16:13:21",NULL,"Camilli","Pinot","1","1",NULL,NULL,NULL,"4549576013@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("116","4542344222","2021-03-13 16:13:21",NULL,"Caua","Bottamedi","1","1",NULL,NULL,NULL,"4542344222@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("117","4544593971","2021-03-13 16:13:21",NULL,"Eduardo","Marchi Rodrigues","1","1",NULL,NULL,NULL,"4544593971@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("118","4549227710","2021-03-13 16:13:21",NULL,"Felipe","Da Silva Montoani","1","1",NULL,NULL,NULL,"4549227710@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("119","4549161450","2021-03-13 16:13:21",NULL,"Felipe","Derengoski Fernandes","1","1",NULL,NULL,NULL,"4549161450@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("120","4548211550","2021-03-13 16:13:21",NULL,"Flávia","Vitoria De Azevedo De Chaves","1","1",NULL,NULL,NULL,"4548211550@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("121","4500483747","2021-03-13 16:13:21",NULL,"Flavio","Bosio","1","1",NULL,NULL,NULL,"4500483747@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("122","4549448899","2021-03-13 16:13:21",NULL,"Gabrieli","Padilha Mendonça","1","1",NULL,NULL,NULL,"4549448899@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("123","4546871251","2021-03-13 16:13:21",NULL,"Gylliard","De Souza Silveira","1","1",NULL,NULL,NULL,"4546871251@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("124","4549323824","2021-03-13 16:13:21",NULL,"Janaina","Luiza Heck","1","1",NULL,NULL,NULL,"4549323824@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("125","4549143788","2021-03-13 16:13:21",NULL,"Jeferson","Dalla Brida","1","1",NULL,NULL,NULL,"4549143788@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("126","4500483950","2021-03-13 16:13:21",NULL,"Kaique","Costa Zucatelli","1","1",NULL,NULL,NULL,"4500483950@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("127","4547605172","2021-03-13 16:13:21",NULL,"Kauan","Vinicius Batista Da Silva","1","1",NULL,NULL,NULL,"4547605172@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("128","4501513852","2021-03-13 16:13:21",NULL,"Laura","Cristina Hoffmann","1","1",NULL,NULL,NULL,"4501513852@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("129","4549227582","2021-03-13 16:13:21",NULL,"Lucas","Enes Dos Santos","1","1",NULL,NULL,NULL,"4549227582@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("130","4540668551","2021-03-13 16:13:21",NULL,"Magdhjelly","Fiama Arraujo Pereira Da Cruz","1","1",NULL,NULL,NULL,"4540668551@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("131","4549328818","2021-03-13 16:13:21",NULL,"Marciel","Martinelli","1","1",NULL,NULL,NULL,"4549328818@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("132","4548055842","2021-03-13 16:13:21",NULL,"Marcus","Vinicius Alves","1","1",NULL,NULL,NULL,"4548055842@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("133","4500484492","2021-03-13 16:13:21",NULL,"Maria","Carolina Esmala","1","1",NULL,NULL,NULL,"4500484492@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("134","4549296002","2021-03-13 16:13:21",NULL,"Maria","Eduarda Cruziniani Rodrigues","1","1",NULL,NULL,NULL,"4549296002@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("135","4549151152","2021-03-13 16:13:21",NULL,"Maria","Isabelly De Abrantes Marques","1","1",NULL,NULL,NULL,"4549151152@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("136","4549326688","2021-03-13 16:13:21",NULL,"Mateus","Marchi","1","1",NULL,NULL,NULL,"4549326688@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("137","4546140524","2021-03-13 16:13:21",NULL,"Mauricio","Rodrigues Norberto","1","1",NULL,NULL,NULL,"4546140524@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("138","4549463766","2021-03-13 16:13:21",NULL,"Melissa","Baeta Faria De Souza","1","1",NULL,NULL,NULL,"4549463766@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("139","4549271506","2021-03-13 16:13:21",NULL,"Nataly","Alice Zuchetti","1","1",NULL,NULL,NULL,"4549271506@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("140","4547799732","2021-03-13 16:13:21",NULL,"Nathalia","Ferreira Morais","1","1",NULL,NULL,NULL,"4547799732@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("141","4549332050","2021-03-13 16:13:21",NULL,"Nathan","Meschke Veiga","1","1",NULL,NULL,NULL,"4549332050@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("142","4500482481","2021-03-13 16:13:21",NULL,"Rayssa","Schneider","1","1",NULL,NULL,NULL,"4500482481@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("143","4549133561","2021-03-13 16:13:21",NULL,"Ricardo","Dellagnolo","1","1",NULL,NULL,NULL,"4549133561@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("144","4544593777","2021-03-13 16:13:21",NULL,"Vinicius","Schavarski","1","1",NULL,NULL,NULL,"4544593777@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("145","4549225806","2021-03-13 16:13:21",NULL,"Adrian","De Castro Lino","1","1",NULL,NULL,NULL,"4549225806@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("146","4549226926","2021-03-13 16:13:21",NULL,"Agnês","Lofy","1","1",NULL,NULL,NULL,"4549226926@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("147","4548559506","2021-03-13 16:13:21",NULL,"André","Luiz Lacerda","1","1",NULL,NULL,NULL,"4548559506@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("148","4549241160","2021-03-13 16:13:21",NULL,"Andrei","Bertoldi","1","1",NULL,NULL,NULL,"4549241160@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("149","4547222478","2021-03-13 16:13:21",NULL,"Andrieli","Bunn","1","1",NULL,NULL,NULL,"4547222478@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("150","4549421931","2021-03-13 16:13:21",NULL,"Andrieli","Martinelli","1","1",NULL,NULL,NULL,"4549421931@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("151","4549193637","2021-03-13 16:13:21",NULL,"Ariani","Manoela Dalla Brida","1","1",NULL,NULL,NULL,"4549193637@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("152","4541497556","2021-03-13 16:13:21",NULL,"Barbara","Cristina Goedert","1","1",NULL,NULL,NULL,"4541497556@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("153","4549212100","2021-03-13 16:13:21",NULL,"Camili","Veloso","1","1",NULL,NULL,NULL,"4549212100@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("154","4549333838","2021-03-13 16:13:21",NULL,"Débora","Fernanda De Souza","1","1",NULL,NULL,NULL,"4549333838@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("155","4546894626","2021-03-13 16:13:21",NULL,"Erik","Junior Bernardi","1","1",NULL,NULL,NULL,"4546894626@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("156","4549272154","2021-03-13 16:13:21",NULL,"Felipe","Zuchetti","1","1",NULL,NULL,NULL,"4549272154@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("157","4549326785","2021-03-13 16:13:21",NULL,"Gabriela","Venscke","1","1",NULL,NULL,NULL,"4549326785@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("158","4549288832","2021-03-13 16:13:21",NULL,"Gabriely","Detz De Oliveira","1","1",NULL,NULL,NULL,"4549288832@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("159","4549135874","2021-03-13 16:13:21",NULL,"Guilherme","Soares Neres","1","1",NULL,NULL,NULL,"4549135874@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("160","4548127240","2021-03-13 16:13:21",NULL,"Gustavo","Hames","1","1",NULL,NULL,NULL,"4548127240@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("161","4549247320","2021-03-13 16:13:21",NULL,"Hellen","Cristhiny Pereira Davi","1","1",NULL,NULL,NULL,"4549247320@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("162","4549227183","2021-03-13 16:13:21",NULL,"Igor","Cauã Schutz","1","1",NULL,NULL,NULL,"4549227183@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("163","4549224222","2021-03-13 16:13:21",NULL,"Jarmelli","Melzi","1","1",NULL,NULL,NULL,"4549224222@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("164","4549449666","2021-03-13 16:13:21",NULL,"Jean","Vitor Reichardt","1","1",NULL,NULL,NULL,"4549449666@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("165","4501002769","2021-03-13 16:13:21",NULL,"Jennifer","Angeli","1","1",NULL,NULL,NULL,"4501002769@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("166","4500466516","2021-03-13 16:13:21",NULL,"Joao","Gustavo Nascimento","1","1",NULL,NULL,NULL,"4500466516@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("167","4549227396","2021-03-13 16:13:21",NULL,"Kamily","Vitória Cordeiro Bernardino","1","1",NULL,NULL,NULL,"4549227396@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("168","4549448066","2021-03-13 16:13:21",NULL,"Karine","Baron","1","1",NULL,NULL,NULL,"4549448066@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("169","4549325347","2021-03-13 16:13:21",NULL,"Leandro","Daniel Bernardi","1","1",NULL,NULL,NULL,"4549325347@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("170","4549170610","2021-03-13 16:13:21",NULL,"Maria","Eduarda Barbosa","1","1",NULL,NULL,NULL,"4549170610@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("171","4549192851","2021-03-13 16:13:21",NULL,"Maria","Eduarda Giacomossi","1","1",NULL,NULL,NULL,"4549192851@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("172","4549214677","2021-03-13 16:13:21",NULL,"Maria","Eduarda Meurer Mafra","1","1",NULL,NULL,NULL,"4549214677@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("173","4549175116","2021-03-13 16:13:21",NULL,"Maria","Emanueli Armelini Seitler","1","1",NULL,NULL,NULL,"4549175116@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("174","4549159676","2021-03-13 16:13:21",NULL,"Mariana","Muller","1","1",NULL,NULL,NULL,"4549159676@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("175","4548249353","2021-03-13 16:13:21",NULL,"Mateus","Do Prado Hoffmann","1","1",NULL,NULL,NULL,"4548249353@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("176","4546883632","2021-03-13 16:13:21",NULL,"Mateus","Inácio","1","1",NULL,NULL,NULL,"4546883632@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("177","4549259697","2021-03-13 16:13:21",NULL,"Mirta","Isabely Nascimento De Jesus","1","1",NULL,NULL,NULL,"4549259697@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("178","4540411712","2021-03-13 16:13:21",NULL,"Paulo","Cesar Massaneiro Martinho","1","1",NULL,NULL,NULL,"4540411712@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("179","4549450249","2021-03-13 16:13:21",NULL,"Ramon","Reichardt","1","1",NULL,NULL,NULL,"4549450249@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("180","4549450842","2021-03-13 16:13:21",NULL,"Renan","Reichardt","1","1",NULL,NULL,NULL,"4549450842@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("181","4549330715","2021-03-13 16:13:21",NULL,"Roger","Antônio Lacerda Bunn","1","1",NULL,NULL,NULL,"4549330715@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("182","4541666129","2021-03-13 16:13:21",NULL,"Romulo","Nicolas Da Silva","1","1",NULL,NULL,NULL,"4541666129@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("183","4549279345","2021-03-13 16:13:21",NULL,"Tiani","Raissa Schmidt","1","1",NULL,NULL,NULL,"4549279345@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("184","4549145470","2021-03-13 16:13:21",NULL,"Vinícius","Mayer Rover","1","1",NULL,NULL,NULL,"4549145470@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("185","4549194641","2021-03-13 16:13:21",NULL,"Vitoria","Postai","1","1",NULL,NULL,NULL,"4549194641@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("186","4543105329","2021-03-14 10:47:20",NULL,"Andriely","Melim","1","1","Rua …","(48) 3267-","(48) 9-","4543105329@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("187","1001230237","2021-03-14 10:47:20",NULL,"Bianca","Vitoria Homem","1","1","Rua …","(48) 3267-","(48) 9-","1001230237@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("188","4500096107","2021-03-14 10:47:20",NULL,"Daniela","Miranda De Lima","1","1","Rua …","(48) 3267-","(48) 9-","4500096107@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("189","4500330215","2021-03-14 10:47:20",NULL,"Davi","Emanuel Szulczewski","1","1","Rua …","(48) 3267-","(48) 9-","4500330215@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("190","4548190030","2021-03-14 10:47:20",NULL,"Emanueli","Murceski","1","1","Rua …","(48) 3267-","(48) 9-","4548190030@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("191","4548249663","2021-03-14 10:47:20",NULL,"Gabriel","Pereira Battisti","1","1","Rua …","(48) 3267-","(48) 9-","4548249663@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("192","1001261221","2021-03-14 10:47:20",NULL,"Gabriel","Rodrigues","1","1","Rua …","(48) 3267-","(48) 9-","1001261221@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("193","4546727657","2021-03-14 10:47:20",NULL,"Gabrielle","De Sousa Rudolf","1","1","Rua …","(48) 3267-","(48) 9-","4546727657@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("194","4542584606","2021-03-14 10:47:20",NULL,"Gabrielli","Eccher","1","1","Rua …","(48) 3267-","(48) 9-","4542584606@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("195","4540679146","2021-03-14 10:47:20",NULL,"Gabrielly","Dos Santos Deolindo","1","1","Rua …","(48) 3267-","(48) 9-","4540679146@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("196","900242094","2021-03-14 10:47:20",NULL,"Guilherme","Dorr","1","1","Rua …","(48) 3267-","(48) 9-","900242094@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("197","4548556523","2021-03-14 10:47:20",NULL,"Gustavo","Henrique Duarte","1","1","Rua …","(48) 3267-","(48) 9-","4548556523@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("198","4548296653","2021-03-14 10:47:20",NULL,"Kannã","Silvério Venter","1","1","Rua …","(48) 3267-","(48) 9-","4548296653@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("199","4548934218","2021-03-14 10:47:20",NULL,"Karine","Bianca Baptista","1","1","Rua …","(48) 3267-","(48) 9-","4548934218@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("200","4548525210","2021-03-14 10:47:20",NULL,"Kimberly","Gabrieli Delmondes Oliveira","1","1","Rua …","(48) 3267-","(48) 9-","4548525210@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("201","4541266805","2021-03-14 10:47:20",NULL,"Lana","Picoli","1","1","Rua …","(48) 3267-","(48) 9-","4541266805@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("202","4543077465","2021-03-14 10:47:20",NULL,"Leticia","Costa","1","1","Rua …","(48) 3267-","(48) 9-","4543077465@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("203","4543109472","2021-03-14 10:47:20",NULL,"Luiz","Felipe Gonzaga Machado","1","1","Rua …","(48) 3267-","(48) 9-","4543109472@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("204","4548292208","2021-03-14 10:47:20",NULL,"Manuela","Garcia Da Silva","1","1","Rua …","(48) 3267-","(48) 9-","4548292208@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("205","4548081819","2021-03-14 10:47:20",NULL,"Maria","Beatriz Bezerra Batista","1","1","Rua …","(48) 3267-","(48) 9-","4548081819@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("206","4543085018","2021-03-14 10:47:20",NULL,"Maria","Eduarda Peixer","1","1","Rua …","(48) 3267-","(48) 9-","4543085018@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("207","4548291619","2021-03-14 10:47:20",NULL,"Vitoria","Carolina Hilleshein","1","1","Rua …","(48) 3267-","(48) 9-","4548291619@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("208","4549696663","2021-03-14 10:47:20",NULL,"Acsa","Martins Machado","1","1","Rua …","(48) 3267-","(48) 9-","4549696663@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("209","1001261981","2021-03-14 10:47:20",NULL,"Amabile","Cristina Gerber","1","1","Rua …","(48) 3267-","(48) 9-","1001261981@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("210","1001230245","2021-03-14 10:47:20",NULL,"Ana","Clara Vicentini","1","1","Rua …","(48) 3267-","(48) 9-","1001230245@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("211","4541568623","2021-03-14 10:47:20",NULL,"Ana","Francisca Roedel","1","1","Rua …","(48) 3267-","(48) 9-","4541568623@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("212","1100022527","2021-03-14 10:47:20",NULL,"Aryana","Gularte Dos Santos","1","1","Rua …","(48) 3267-","(48) 9-","1100022527@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("213","1001372147","2021-03-14 10:47:20",NULL,"Axol","Dalsasso Compiani","1","1","Rua …","(48) 3267-","(48) 9-","1001372147@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("214","4543161946","2021-03-14 10:47:20",NULL,"Bruna","Bertuol Staudt","1","1","Rua …","(48) 3267-","(48) 9-","4543161946@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("215","1001281583","2021-03-14 10:47:20",NULL,"Cauã","Motta","1","1","Rua …","(48) 3267-","(48) 9-","1001281583@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("216","1001405134","2021-03-14 10:47:20",NULL,"Emerson","Bastiani Filho","1","1","Rua …","(48) 3267-","(48) 9-","1001405134@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("217","1001272584","2021-03-14 10:47:20",NULL,"Felipe","Montibeller","1","1","Rua …","(48) 3267-","(48) 9-","1001272584@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("218","1001222625","2021-03-14 10:47:20",NULL,"Filipi","Tell","1","1","Rua …","(48) 3267-","(48) 9-","1001222625@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("219","1001217826","2021-03-14 10:47:20",NULL,"Gabriel","Jose Pedrotti","1","1","Rua …","(48) 3267-","(48) 9-","1001217826@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("220","1001232507","2021-03-14 10:47:20",NULL,"Gabriel","Trainotti Tirloni","1","1","Rua …","(48) 3267-","(48) 9-","1001232507@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("221","4500078346","2021-03-14 10:47:20",NULL,"Giovanna","Casett","1","1","Rua …","(48) 3267-","(48) 9-","4500078346@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("222","4500096077","2021-03-14 10:47:20",NULL,"Gustavo","Elias Hugen","1","1","Rua …","(48) 3267-","(48) 9-","4500096077@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("223","4548249175","2021-03-14 10:47:20",NULL,"Jackson","Leandro Siqueira","1","1","Rua …","(48) 3267-","(48) 9-","4548249175@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("224","4543494783","2021-03-14 10:47:20",NULL,"Jeyciane","Kelly Reis Ferreira","1","1","Rua …","(48) 3267-","(48) 9-","4543494783@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("225","4543495542","2021-03-14 10:47:20",NULL,"Jeycinara","Kaylla Reis Ferreira","1","1","Rua …","(48) 3267-","(48) 9-","4543495542@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("226","4548560660","2021-03-14 10:47:20",NULL,"Joelson","Meyer","1","1","Rua …","(48) 3267-","(48) 9-","4548560660@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("227","1001272800","2021-03-14 10:47:20",NULL,"Julia","Valle Michelli","1","1","Rua …","(48) 3267-","(48) 9-","1001272800@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("228","4549332700","2021-03-14 10:47:20",NULL,"Juliana","De Oliveira Ferreira","1","1","Rua …","(48) 3267-","(48) 9-","4549332700@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("229","4545370313","2021-03-14 10:47:20",NULL,"Juliane","Caroline Santos Rocha","1","1","Rua …","(48) 3267-","(48) 9-","4545370313@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("230","4548050387","2021-03-14 10:47:20",NULL,"Leonardo","Alessandro Kinis","1","1","Rua …","(48) 3267-","(48) 9-","4548050387@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("231","4548557937","2021-03-14 10:47:20",NULL,"Luana","Maria Muller","1","1","Rua …","(48) 3267-","(48) 9-","4548557937@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("232","1100022551","2021-03-14 10:47:20",NULL,"Luiz","Fernando Tomasi","1","1","Rua …","(48) 3267-","(48) 9-","1100022551@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("233","4541215178","2021-03-14 10:47:20",NULL,"Luiza","Demonti Rover","1","1","Rua …","(48) 3267-","(48) 9-","4541215178@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("234","4544017156","2021-03-14 10:47:20",NULL,"Marcos","Aurelio Sgrott Filho","1","1","Rua …","(48) 3267-","(48) 9-","4544017156@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("235","1001405150","2021-03-14 10:47:20",NULL,"Maria","Eduarda Dutra","1","1","Rua …","(48) 3267-","(48) 9-","1001405150@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("236","1001230474","2021-03-14 10:47:20",NULL,"Maria","Rafaela Conhaqui","1","1","Rua …","(48) 3267-","(48) 9-","1001230474@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("237","1001222358","2021-03-14 10:47:20",NULL,"Mateus","Battisti","1","1","Rua …","(48) 3267-","(48) 9-","1001222358@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("238","1001217818","2021-03-14 10:47:20",NULL,"Matheus","Bassi","1","1","Rua …","(48) 3267-","(48) 9-","1001217818@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("239","1001461220","2021-03-14 10:47:20",NULL,"Rafael","Alexandre Boso Motta","1","1","Rua …","(48) 3267-","(48) 9-","1001461220@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("240","1001405207","2021-03-14 10:47:20",NULL,"Renan","Furquin","1","1","Rua …","(48) 3267-","(48) 9-","1001405207@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("241","4548545505","2021-03-14 10:47:20",NULL,"Wellinton","Caua De Souza","1","1","Rua …","(48) 3267-","(48) 9-","4548545505@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("242","4548030033","2021-03-14 10:47:20",NULL,"Alexandre","Meyer","1","1","Rua …","(48) 3267-","(48) 9-","4548030033@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("243","4548046304","2021-03-14 10:47:20",NULL,"Ana","Paula De Souza","1","1","Rua …","(48) 3267-","(48) 9-","4548046304@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("244","4548308082","2021-03-14 10:47:20",NULL,"Aquilis","Adrian Visintainer","1","1","Rua …","(48) 3267-","(48) 9-","4548308082@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("245","1001405169","2021-03-14 10:47:20",NULL,"Barbara","Barauna","1","1","Rua …","(48) 3267-","(48) 9-","1001405169@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("246","4548209130","2021-03-14 10:47:20",NULL,"Carlos","Reinaldo Berlanda","1","1","Rua …","(48) 3267-","(48) 9-","4548209130@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("247","4548291287","2021-03-14 10:47:20",NULL,"Daniel","Melo Kaipper","1","1","Rua …","(48) 3267-","(48) 9-","4548291287@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("248","4548126189","2021-03-14 10:47:20",NULL,"Dian","Carlos Pereira Junior","1","1","Rua …","(48) 3267-","(48) 9-","4548126189@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("249","4548114407","2021-03-14 10:47:20",NULL,"Eduardo","Coelho","1","1","Rua …","(48) 3267-","(48) 9-","4548114407@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("250","4548544320","2021-03-14 10:47:20",NULL,"Estela","Domingues Chaves","1","1","Rua …","(48) 3267-","(48) 9-","4548544320@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("251","4548278396","2021-03-14 10:47:20",NULL,"Fatima","Paulina Garbari","1","1","Rua …","(48) 3267-","(48) 9-","4548278396@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("252","4548126898","2021-03-14 10:47:20",NULL,"Gabriela","Estevam Sá","1","1","Rua …","(48) 3267-","(48) 9-","4548126898@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("253","4548139744","2021-03-14 10:47:20",NULL,"Gabriela","Fernanda Moraes","1","1","Rua …","(48) 3267-","(48) 9-","4548139744@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("254","4548138675","2021-03-14 10:47:20",NULL,"Gabrieli","Batisti","1","1","Rua …","(48) 3267-","(48) 9-","4548138675@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("255","1001281990","2021-03-14 10:47:20",NULL,"Heriki","Nicollas Sapelli","1","1","Rua …","(48) 3267-","(48) 9-","1001281990@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("256","4541291630","2021-03-14 10:47:20",NULL,"João","Vitor Caetano","1","1","Rua …","(48) 3267-","(48) 9-","4541291630@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("257","4548307310","2021-03-14 10:47:20",NULL,"Joao","Vitor Mila","1","1","Rua …","(48) 3267-","(48) 9-","4548307310@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("258","4548049206","2021-03-14 10:47:20",NULL,"Joyce","Fernanda Steniski Cabral","1","1","Rua …","(48) 3267-","(48) 9-","4548049206@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("259","4548224466","2021-03-14 10:47:20",NULL,"Kainã","Linden Teixeira Dos Santos","1","1","Rua …","(48) 3267-","(48) 9-","4548224466@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("260","4548081614","2021-03-14 10:47:20",NULL,"Kaio","Yori Tomasi Da Silva","1","1","Rua …","(48) 3267-","(48) 9-","4548081614@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("261","4548291783","2021-03-14 10:47:20",NULL,"Kauan","Cruz De Oliveira","1","1","Rua …","(48) 3267-","(48) 9-","4548291783@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("262","4546885562","2021-03-14 10:47:20",NULL,"Kayque","Miguel Da Fonseca Reis Galvão","1","1","Rua …","(48) 3267-","(48) 9-","4546885562@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("263","4548052533","2021-03-14 10:47:20",NULL,"Luiz","Otavio Battisti","1","1","Rua …","(48) 3267-","(48) 9-","4548052533@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("264","4544017130","2021-03-14 10:47:20",NULL,"Marciel","Abelino Dallabrida","1","1","Rua …","(48) 3267-","(48) 9-","4544017130@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("265","1001275575","2021-03-14 10:47:20",NULL,"Maria","Eduarda Facchini","1","1","Rua …","(48) 3267-","(48) 9-","1001275575@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("266","4500185070","2021-03-14 10:47:20",NULL,"Maria","Eduarda Souza Peres","1","1","Rua …","(48) 3267-","(48) 9-","4500185070@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("267","4548185622","2021-03-14 10:47:20",NULL,"Maria","Heloisa Corsi","1","1","Rua …","(48) 3267-","(48) 9-","4548185622@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("268","1001412130","2021-03-14 10:47:20",NULL,"Maria","Vitoria Piazza Maçaneiro","1","1","Rua …","(48) 3267-","(48) 9-","1001412130@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("269","4548185584","2021-03-14 10:47:20",NULL,"Marilson","De Barros Abelino","1","1","Rua …","(48) 3267-","(48) 9-","4548185584@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("270","4548052584","2021-03-14 10:47:20",NULL,"Matheus","Muraro","1","1","Rua …","(48) 3267-","(48) 9-","4548052584@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("271","4548185347","2021-03-14 10:47:20",NULL,"Michael","Jesus Millnitz","1","1","Rua …","(48) 3267-","(48) 9-","4548185347@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("272","4548208690","2021-03-14 10:47:20",NULL,"Michel","Meurer","1","1","Rua …","(48) 3267-","(48) 9-","4548208690@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("273","4548052657","2021-03-14 10:47:20",NULL,"Naeli","Perola Eccher","1","1","Rua …","(48) 3267-","(48) 9-","4548052657@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("274","4548116230","2021-03-14 10:47:20",NULL,"Nicoli","Wolf","1","1","Rua …","(48) 3267-","(48) 9-","4548116230@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("275","4500078362","2021-03-14 10:47:20",NULL,"Paola","Gabrieli Garcez Dos Santos","1","1","Rua …","(48) 3267-","(48) 9-","4500078362@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("276","4548055532","2021-03-14 10:47:20",NULL,"Paulo","Ricardo Klann Mendes","1","1","Rua …","(48) 3267-","(48) 9-","4548055532@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("277","4548209475","2021-03-14 10:47:20",NULL,"Pedro","Antonio Miranda Botelho","1","1","Rua …","(48) 3267-","(48) 9-","4548209475@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("278","4543246658","2021-03-14 10:47:20",NULL,"Rafaella","Vicentini","1","1","Rua …","(48) 3267-","(48) 9-","4543246658@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("279","4548539947","2021-03-14 10:47:20",NULL,"Silas","Farias Ferreira","1","1","Rua …","(48) 3267-","(48) 9-","4548539947@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("280","4548292356","2021-03-14 10:47:20",NULL,"Tuiane","Inacio","1","1","Rua …","(48) 3267-","(48) 9-","4548292356@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("281","4548185452","2021-03-14 10:47:20",NULL,"Vinicius","Joao Cardoso","1","1","Rua …","(48) 3267-","(48) 9-","4548185452@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("282","4548187471","2021-03-14 10:47:20",NULL,"Vitor","Daicampi","1","1","Rua …","(48) 3267-","(48) 9-","4548187471@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("283","4548086039","2021-03-14 10:47:20",NULL,"Vitor","Voitena","1","1","Rua …","(48) 3267-","(48) 9-","4548086039@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("284","1001236898","2021-03-14 10:47:20",NULL,"Vitória","Voltolini","1","1","Rua …","(48) 3267-","(48) 9-","1001236898@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("285","4548053394","2021-03-14 10:47:20",NULL,"Viviane","Vinotti","1","1","Rua …","(48) 3267-","(48) 9-","4548053394@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("286","4548593127","2021-03-14 10:47:20",NULL,"Alejandro","Da Silva","1","1","Rua …","(48) 3267-","(48) 9-","4548593127@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("287","4546840739","2021-03-14 10:47:20",NULL,"Alexandre","Venicio Montibeller","1","1","Rua …","(48) 3267-","(48) 9-","4546840739@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("288","4548028063","2021-03-14 10:47:20",NULL,"Aline","Iatzac","1","1","Rua …","(48) 3267-","(48) 9-","4548028063@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("289","4548343961","2021-03-14 10:47:20",NULL,"Alisson","Antunes Da Silva","1","1","Rua …","(48) 3267-","(48) 9-","4548343961@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("290","4548039022","2021-03-14 10:47:20",NULL,"Alisson","Till","1","1","Rua …","(48) 3267-","(48) 9-","4548039022@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("291","4543886207","2021-03-14 10:47:20",NULL,"Amanda","Cristina Evaristo De Araújo","1","1","Rua …","(48) 3267-","(48) 9-","4543886207@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("292","1100355828","2021-03-14 10:47:20",NULL,"Ana","Beatriz Faustino","1","1","Rua …","(48) 3267-","(48) 9-","1100355828@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("293","4548114903","2021-03-14 10:47:20",NULL,"Ana","Carolina Meurer","1","1","Rua …","(48) 3267-","(48) 9-","4548114903@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("294","4548045740","2021-03-14 10:47:20",NULL,"Ana","Caroline Motta","1","1","Rua …","(48) 3267-","(48) 9-","4548045740@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("295","4546840283","2021-03-14 10:47:20",NULL,"André","Luiz Ceccato","1","1","Rua …","(48) 3267-","(48) 9-","4546840283@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("296","1001217761","2021-03-14 10:47:20",NULL,"Andre","Marchi Sezerino","1","1","Rua …","(48) 3267-","(48) 9-","1001217761@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("297","4547437709","2021-03-14 10:47:20",NULL,"Antonio","Carlos Wilcke Peixe","1","1","Rua …","(48) 3267-","(48) 9-","4547437709@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("298","4542678970","2021-03-14 10:47:20",NULL,"Danieli","Greef","1","1","Rua …","(48) 3267-","(48) 9-","4542678970@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("299","4548121055","2021-03-14 10:47:20",NULL,"Estanislau","João Vinotti Neto","1","1","Rua …","(48) 3267-","(48) 9-","4548121055@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("300","4548211941","2021-03-14 10:47:20",NULL,"Francieli","Martinelli","1","1","Rua …","(48) 3267-","(48) 9-","4548211941@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("301","4543281585","2021-03-14 10:47:20",NULL,"Gabriel","Bento Veber","1","1","Rua …","(48) 3267-","(48) 9-","4543281585@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("302","4540446931","2021-03-14 10:47:20",NULL,"Gabriel","Da Rosa Voltolini","1","1","Rua …","(48) 3267-","(48) 9-","4540446931@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("303","1001217745","2021-03-14 10:47:20",NULL,"Gabriel","Fetter Piva","1","1","Rua …","(48) 3267-","(48) 9-","1001217745@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("304","1001461263","2021-03-14 10:47:20",NULL,"Gabrieli","Alexandra Battisti","1","1","Rua …","(48) 3267-","(48) 9-","1001461263@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("305","4548625100","2021-03-14 10:47:20",NULL,"Giseli","Marchi","1","1","Rua …","(48) 3267-","(48) 9-","4548625100@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("306","4548187927","2021-03-14 10:47:20",NULL,"Hellen","Martinelli","1","1","Rua …","(48) 3267-","(48) 9-","4548187927@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("307","4548766854","2021-03-14 10:47:20",NULL,"Jheymerson","Makay Lisboa Barreto","1","1","Rua …","(48) 3267-","(48) 9-","4548766854@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("308","4500780148","2021-03-14 10:47:20",NULL,"Joao","Victor Giacomini","1","1","Rua …","(48) 3267-","(48) 9-","4500780148@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("309","4548345182","2021-03-14 10:47:20",NULL,"Luan","Carlos Motta","1","1","Rua …","(48) 3267-","(48) 9-","4548345182@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("310","4546840259","2021-03-14 10:47:20",NULL,"Luciano","Venske Melzi","1","1","Rua …","(48) 3267-","(48) 9-","4546840259@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("311","1100258415","2021-03-14 10:47:20",NULL,"Luiz","Henrique Ascari","1","1","Rua …","(48) 3267-","(48) 9-","1100258415@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("312","4500780172","2021-03-14 10:47:20",NULL,"Marco","Antonio Giacomini","1","1","Rua …","(48) 3267-","(48) 9-","4500780172@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("313","4547291844","2021-03-14 10:47:20",NULL,"Mariana","Da Luz Giacomini","1","1","Rua …","(48) 3267-","(48) 9-","4547291844@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("314","1100022543","2021-03-14 10:47:20",NULL,"Matheus","Trainotti Barauna","1","1","Rua …","(48) 3267-","(48) 9-","1100022543@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("315","4548121411","2021-03-14 10:47:20",NULL,"Mikhael","Felipe Dos Santos","1","1","Rua …","(48) 3267-","(48) 9-","4548121411@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("316","1000073260","2021-03-14 10:47:20",NULL,"Milene","Chaiane Jacinto","1","1","Rua …","(48) 3267-","(48) 9-","1000073260@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("317","4548790755","2021-03-14 10:47:20",NULL,"Monique","Faria De Cristo","1","1","Rua …","(48) 3267-","(48) 9-","4548790755@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("318","4548292542","2021-03-14 10:47:20",NULL,"Natalia","Bertolini","1","1","Rua …","(48) 3267-","(48) 9-","4548292542@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("319","4500322484","2021-03-14 10:47:20",NULL,"Natan","Valtersdolf De Souza","1","1","Rua …","(48) 3267-","(48) 9-","4500322484@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("320","800113683","2021-03-14 10:47:20",NULL,"Pablo","Miguel Minatti","1","1","Rua …","(48) 3267-","(48) 9-","800113683@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("321","4548344526","2021-03-14 10:47:20",NULL,"Pedro","Augusto Kammer","1","1","Rua …","(48) 3267-","(48) 9-","4548344526@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("322","4548180809","2021-03-14 10:47:20",NULL,"Pietro","Henrique Voltolini","1","1","Rua …","(48) 3267-","(48) 9-","4548180809@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("323","1001217770","2021-03-14 10:47:20",NULL,"Sabrina","De Oliveira","1","1","Rua …","(48) 3267-","(48) 9-","1001217770@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("324","4500353118","2021-03-14 10:47:20",NULL,"Sabrina","Eduarda Steniski De Oliveira","1","1","Rua …","(48) 3267-","(48) 9-","4500353118@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("325","4548082327","2021-03-14 10:47:20",NULL,"Sara","Amabille De Abreu","1","1","Rua …","(48) 3267-","(48) 9-","4548082327@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("326","4546984269","2021-03-14 10:47:20",NULL,"Tatiane","De Quadros De Oliveira","1","1","Rua …","(48) 3267-","(48) 9-","4546984269@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("327","4549524099","2021-03-14 10:47:20",NULL,"Thaís","De Oliveira Magalhães De Souza","1","1","Rua …","(48) 3267-","(48) 9-","4549524099@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("328","4548185495","2021-03-14 10:47:20",NULL,"Venicio","Minatti","1","1","Rua …","(48) 3267-","(48) 9-","4548185495@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("329","4548291953","2021-03-14 10:47:20",NULL,"Wilian","Guilherme Hugen","1","1","Rua …","(48) 3267-","(48) 9-","4548291953@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("330","4548138888","2021-03-14 10:47:20",NULL,"Ana","Júlia Boa Nova Volpato","1","1","Rua …","(48) 3267-","(48) 9-","4548138888@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("331","4542425931","2021-03-14 10:47:20",NULL,"Andriely","Gambeta","1","1","Rua …","(48) 3267-","(48) 9-","4542425931@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("332","4548192491","2021-03-14 10:47:20",NULL,"Carlos","Eduardo Schmidt","1","1","Rua …","(48) 3267-","(48) 9-","4548192491@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("333","4548126634","2021-03-14 10:47:20",NULL,"Cristian","Pinot","1","1","Rua …","(48) 3267-","(48) 9-","4548126634@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("334","700158332","2021-03-14 10:47:20",NULL,"Djenifer","Lopes","1","1","Rua …","(48) 3267-","(48) 9-","700158332@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("335","800113489","2021-03-14 10:47:20",NULL,"Emanoel","Montibeller","1","1","Rua …","(48) 3267-","(48) 9-","800113489@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("336","4548121195","2021-03-14 10:47:20",NULL,"Érick","Da Silva","1","1","Rua …","(48) 3267-","(48) 9-","4548121195@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("337","4548120601","2021-03-14 10:47:20",NULL,"Gabriel","Garbari","1","1","Rua …","(48) 3267-","(48) 9-","4548120601@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("338","4548073166","2021-03-14 10:47:20",NULL,"Guilherme","Cararo","1","1","Rua …","(48) 3267-","(48) 9-","4548073166@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("339","4548249507","2021-03-14 10:47:20",NULL,"Helem","Cristina Eleotério","1","1","Rua …","(48) 3267-","(48) 9-","4548249507@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("340","4501898118","2021-03-14 10:47:20",NULL,"Heloisa","Marchi","1","1","Rua …","(48) 3267-","(48) 9-","4501898118@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("341","4545538940","2021-03-14 10:47:20",NULL,"Jhon","Vitor Custodio","1","1","Rua …","(48) 3267-","(48) 9-","4545538940@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("342","4548128319","2021-03-14 10:47:20",NULL,"João","Carlos Cunha","1","1","Rua …","(48) 3267-","(48) 9-","4548128319@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("343","1001372104","2021-03-14 10:47:20",NULL,"Kaio","Henrique Motta","1","1","Rua …","(48) 3267-","(48) 9-","1001372104@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("344","1001405118","2021-03-14 10:47:20",NULL,"Karla","Giovanna Zandonai","1","1","Rua …","(48) 3267-","(48) 9-","1001405118@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("345","1000067030","2021-03-14 10:47:20",NULL,"Khauan","Kepka","1","1","Rua …","(48) 3267-","(48) 9-","1000067030@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("346","4548189172","2021-03-14 10:47:20",NULL,"Letícia","Mines","1","1","Rua …","(48) 3267-","(48) 9-","4548189172@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("347","4548115780","2021-03-14 10:47:20",NULL,"Livia","Paulina Mulaski","1","1","Rua …","(48) 3267-","(48) 9-","4548115780@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("348","4548192190","2021-03-14 10:47:20",NULL,"Luan","Matheus Cristovo","1","1","Rua …","(48) 3267-","(48) 9-","4548192190@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("349","4546885627","2021-03-14 10:47:20",NULL,"Luiz","Henrique Montibeller Cognacco","1","1","Rua …","(48) 3267-","(48) 9-","4546885627@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("350","4546840194","2021-03-14 10:47:20",NULL,"Mábili","Kotarski","1","1","Rua …","(48) 3267-","(48) 9-","4546840194@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("351","4548120229","2021-03-14 10:47:20",NULL,"Mariane","De Fatima Messias","1","1","Rua …","(48) 3267-","(48) 9-","4548120229@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("352","700076158","2021-03-14 10:47:20",NULL,"Mario","Antonio Reis Neto","1","1","Rua …","(48) 3267-","(48) 9-","700076158@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("353","4546840780","2021-03-14 10:47:20",NULL,"Miliele","Vieira Franco","1","1","Rua …","(48) 3267-","(48) 9-","4546840780@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("354","1001492525","2021-03-14 10:47:20",NULL,"Mirele","De Souza Motta","1","1","Rua …","(48) 3267-","(48) 9-","1001492525@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("355","4548120806","2021-03-14 10:47:20",NULL,"Murilo","Minatti","1","1","Rua …","(48) 3267-","(48) 9-","4548120806@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("356","4548119476","2021-03-14 10:47:20",NULL,"Natacha","Aparecida Veber","1","1","Rua …","(48) 3267-","(48) 9-","4548119476@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("357","4501252811","2021-03-14 10:47:20",NULL,"Nicollas","Silvano Zandonai","1","1","Rua …","(48) 3267-","(48) 9-","4501252811@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("358","4548137970","2021-03-14 10:47:20",NULL,"Ricardo","Franzoi","1","1","Rua …","(48) 3267-","(48) 9-","4548137970@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("359","4546840305","2021-03-14 10:47:20",NULL,"Rodrigo","Cecílio Pereira","1","1","Rua …","(48) 3267-","(48) 9-","4546840305@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("360","4548052789","2021-03-14 10:47:20",NULL,"Rodrigo","Luiz Veneri","1","1","Rua …","(48) 3267-","(48) 9-","4548052789@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("361","4541240865","2021-03-14 10:47:20",NULL,"Shaiane","Veneri","1","1","Rua …","(48) 3267-","(48) 9-","4541240865@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("362","4543463438","2021-03-14 10:47:20",NULL,"Taina","Frontino","1","1","Rua …","(48) 3267-","(48) 9-","4543463438@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("363","4548249868","2021-03-14 10:47:20",NULL,"Tamara","De Lima Batista","1","1","Rua …","(48) 3267-","(48) 9-","4548249868@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("364","4548212166","2021-03-14 10:47:20",NULL,"Uilian","Veneri","1","1","Rua …","(48) 3267-","(48) 9-","4548212166@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("365","4544783045","2021-03-14 10:47:20",NULL,"Valéria","Matia De Souza","1","1","Rua …","(48) 3267-","(48) 9-","4544783045@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("366","4542694401","2021-03-14 10:47:20",NULL,"Victor","Augusto Poli","1","1","Rua …","(48) 3267-","(48) 9-","4542694401@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("367","4548191720","2021-03-14 10:47:20",NULL,"Vitor","Hugo Rover Da Cunha","1","1","Rua …","(48) 3267-","(48) 9-","4548191720@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("368","4548053297","2021-03-14 10:47:20",NULL,"Vitor","Veber","1","1","Rua …","(48) 3267-","(48) 9-","4548053297@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("369","4548121314","2021-03-14 10:47:20",NULL,"Viviane","Vitória Battisti","1","1","Rua …","(48) 3267-","(48) 9-","4548121314@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("370","4546704088","2021-03-14 10:47:20",NULL,"Weliton","Veneri","1","1","Rua …","(48) 3267-","(48) 9-","4546704088@estudante.sed.sc.gov.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("372","4540588400","2021-03-28 14:06:02",NULL,"Joana","Mazera","1","3","R. Felipe Schmid, 4079","(48) 3267-1590","(48) 9913-43508","joana.mazera@gmail.com","1","1","small-joana.jpg");
INSERT INTO bib_leitor VALUES("376","8549199279","2021-03-29 20:28:18",NULL," João"," Silva","1","1"," rua...","48-32670000","9-9100","joao@email.com.br","1","1",NULL);
INSERT INTO bib_leitor VALUES("377","8549199279","2021-03-29 20:42:34",NULL," João"," Silva","1","1"," rua...","48-32670000","9-9100","joao@email.com.br","1","1",NULL);


DROP TABLE IF EXISTS bib_marc21;


CREATE TABLE `bib_marc21` (
  `id` int NOT NULL AUTO_INCREMENT,
  `campo` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ind1` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ind2` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subcampos` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_marc21 VALUES("2","245",NULL,"2","$a Teste 2","TÍTULO PRINCIPAL (NR)");
INSERT INTO bib_marc21 VALUES("3","100","#","2","$b teste 2","ENTRADA PRINCIPAL - NOME PESSOAL (NR)");
INSERT INTO bib_marc21 VALUES("4","245","3","2","2","Titulo Principal (NR)");


DROP TABLE IF EXISTS bib_municipio;


CREATE TABLE `bib_municipio` (
  `mun_id` int NOT NULL AUTO_INCREMENT,
  `municipio` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_uf` int NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  `bandeira` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`mun_id`)
) ENGINE=InnoDB AUTO_INCREMENT=300 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_municipio VALUES("1","Nova Trento","1","2021-02-02 23:10:51","2021-02-11 14:18:04","bandeira-nt.png");
INSERT INTO bib_municipio VALUES("3","Canelinha","1","2021-02-02 23:11:30","2021-02-19 11:45:31","bandeira-canelinha.png");
INSERT INTO bib_municipio VALUES("7","Abdon Batista","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("8","Abelardo Luz","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("9","Agrolandia","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("10","Agronomica","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("11","Agua Doce","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("12","Aguas De Chapeco","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("13","Aguas Frias","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("14","Aguas Mornas","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("15","Alfredo Wagner","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("16","Alto Bela Vista","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("17","Anchieta","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("18","Angelina","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("19","Anita Garibaldi","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("20","Anitapolis","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("21","Antonio Carlos","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("22","Apiuna","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("23","Arabuta","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("24","Araquari","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("25","Ararangua","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("26","Armazem","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("27","Arroio Trinta","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("28","Arvoredo","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("29","Ascurra","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("30","Atalanta","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("31","Aurora","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("32","Balneario Arroio Do Silva","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("33","Balneario Barra Do Sul","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("34","Balneario Camboriu","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("35","Balneario De Picarras","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("36","Balneario Gaivota","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("37","Bandeirante","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("38","Barra Bonita","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("39","Barra Velha","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("40","Bela Vista Do Toldo","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("41","Belmonte","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("42","Benedito Novo","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("43","Biguacu","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("44","Blumenau","1","2021-03-04 11:19:22","2021-03-04 11:26:22","bandeira-sc-blumenau.png");
INSERT INTO bib_municipio VALUES("45","Bocaina Do Sul","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("46","Bom Jardim Da Serra","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("47","Bom Jesus","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("48","Bom Jesus Do Oeste","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("49","Bom Retiro","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("50","Bombinhas","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("51","Botuvera","1","2021-03-04 11:19:22","2021-03-04 11:44:02","bandeira-botuvera.jpg");
INSERT INTO bib_municipio VALUES("52","Braco Do Norte","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("53","Braco Do Trombudo","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("54","Brunopolis","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("55","Brusque","1","2021-03-04 11:19:22","2021-03-04 11:29:08","bandeira-sc-brusque.png");
INSERT INTO bib_municipio VALUES("56","Cacador","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("57","Caibi","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("58","Calmon","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("59","Camboriu","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("60","Campo Alegre","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("61","Campo Belo Do Sul","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("62","Campo Ere","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("63","Campos Novos","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("65","Canoinhas","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("66","Capao Alto","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("67","Capinzal","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("68","Capivari De Baixo","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("69","Catanduvas","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("70","Caxambu Do Sul","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("71","Celso Ramos","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("72","Cerro Negro","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("73","Chapadao Do Lageado","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("74","Chapeco","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("75","Cocal Do Sul","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("76","Concordia","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("77","Cordilheira Alta","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("78","Coronel Freitas","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("79","Coronel Martins","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("80","Correia Pinto","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("81","Corupa","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("82","Criciuma","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("83","Cunha Pora","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("84","Cunhatai","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("85","Curitibanos","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("86","Descanso","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("87","Dionisio Cerqueira","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("88","Dona Emma","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("89","Doutor Pedrinho","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("90","Entre Rios","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("91","Ermo","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("92","Erval Velho","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("93","Faxinal Dos Guedes","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("94","Flor Do Sertao","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("95","Florianopolis","1","2021-03-04 11:19:22","2021-03-04 11:30:24","bandeira-sc-florianopolis.png");
INSERT INTO bib_municipio VALUES("96","Formosa Do Sul","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("97","Forquilhinha","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("98","Fraiburgo","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("99","Frei Rogerio","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("100","Galvao","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("101","Garopaba","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("102","Garuva","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("103","Gaspar","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("104","Governador Celso Ramos","1","2021-03-04 11:19:22",NULL,NULL);
INSERT INTO bib_municipio VALUES("105","Grao Para","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("106","Gravatal","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("107","Guabiruba","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("108","Guaraciaba","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("109","Guaramirim","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("110","Guaruja Do Sul","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("111","Guatambu","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("112","Herval D\'oeste","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("113","Ibiam","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("114","Ibicare","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("115","Ibirama","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("116","Icara","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("117","Ilhota","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("118","Imarui","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("119","Imbituba","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("120","Imbuia","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("121","Indaial","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("122","Iomere","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("123","Ipira","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("124","Ipora Do Oeste","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("125","Ipuacu","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("126","Ipumirim","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("127","Iraceminha","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("128","Irani","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("129","Irati","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("130","Irineopolis","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("131","Ita","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("132","Itaiopolis","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("133","Itajai","1","2021-03-04 11:19:23","2021-03-04 11:31:27","bandeira-sc-itajai.png");
INSERT INTO bib_municipio VALUES("134","Itapema","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("135","Itapiranga","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("136","Itapoa","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("137","Ituporanga","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("138","Jabora","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("139","Jacinto Machado","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("140","Jaguaruna","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("141","Jaragua Do Sul","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("142","Jardinopolis","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("143","Joacaba","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("144","Joinville","1","2021-03-04 11:19:23","2021-03-04 11:32:27","bandeira-sc-joinville.png");
INSERT INTO bib_municipio VALUES("145","Jose Boiteux","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("146","Jupia","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("147","Lacerdopolis","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("148","Lageado Grande","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("149","Lages","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("150","Laguna","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("151","Laurentino","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("152","Lauro Muller","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("153","Lebon Regis","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("154","Leoberto Leal","1","2021-03-04 11:19:23","2021-03-04 11:45:23","bandeira-leoberto-leal.jpeg");
INSERT INTO bib_municipio VALUES("155","Lindoia Do Sul","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("156","Lontras","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("157","Luiz Alves","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("158","Luzerna","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("159","Macieira","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("160","Mafra","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("161","Major Gercino","1","2021-03-04 11:19:23","2021-03-04 11:34:45","bandeira-sc-majos-gercino.png");
INSERT INTO bib_municipio VALUES("162","Major Vieira","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("163","Maracaja","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("164","Maravilha","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("165","Marema","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("166","Massaranduba","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("167","Matos Costa","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("168","Meleiro","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("169","Mirim Doce","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("170","Modelo","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("171","Mondai","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("172","Monte Carlo","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("173","Monte Castelo","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("174","Morro Da Fumaca","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("175","Morro Grande","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("176","Navegantes","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("177","Nova Erechim","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("178","Nova Itaberaba","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("180","Nova Veneza","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("181","Novo Horizonte","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("182","Orleans","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("183","Otacilio Costa","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("184","Ouro","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("185","Ouro Verde","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("186","Paial","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("187","Painel","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("188","Palhoca","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("189","Palma Sola","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("190","Palmeira","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("191","Palmitos","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("192","Papanduva","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("193","Paraiso","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("194","Passo De Torres","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("195","Passos Maia","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("196","Paulo Lopes","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("197","Pedras Grandes","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("198","Penha","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("199","Peritiba","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("200","Petrolandia","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("201","Pinhalzinho","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("202","Pinheiro Preto","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("203","Piratuba","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("204","Planalto Alegre","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("205","Pomerode","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("206","Ponte Alta","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("207","Ponte Alta Do Norte","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("208","Ponte Serrada","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("209","Porto Belo","1","2021-03-04 11:19:23","2021-03-04 11:36:07","bandeira-sc-porto-belo.png");
INSERT INTO bib_municipio VALUES("210","Porto Uniao","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("211","Pouso Redondo","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("212","Praia Grande","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("213","Presidente Castelo Branco","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("214","Presidente Getulio","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("215","Presidente Nereu","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("216","Princesa","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("217","Quilombo","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("218","Rancho Queimado","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("219","Rio Das Antas","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("220","Rio Do Campo","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("221","Rio Do Oeste","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("222","Rio Do Sul","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("223","Rio Dos Cedros","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("224","Rio Fortuna","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("225","Rio Negrinho","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("226","Rio Rufino","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("227","Riqueza","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("228","Rodeio","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("229","Romelandia","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("230","Salete","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("231","Saltinho","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("232","Salto Veloso","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("233","Sangao","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("234","Santa Cecilia","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("235","Santa Helena","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("236","Santa Rosa De Lima","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("237","Santa Rosa Do Sul","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("238","Santa Terezinha","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("239","Santa Terezinha Do Progresso","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("240","Santiago Do Sul","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("241","Santo Amaro Da Imperatriz","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("242","Sao Bento Do Sul","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("243","Sao Bernardino","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("244","Sao Bonifacio","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("245","Sao Carlos","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("246","Sao Cristovao Do Sul","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("247","Sao Domingos","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("248","Sao Francisco Do Sul","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("249","Sao Joao Batista","1","2021-03-04 11:19:23","2021-03-04 11:39:31","bandeira-sjb.png");
INSERT INTO bib_municipio VALUES("250","Sao Joao Do Itaperiu","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("251","Sao Joao Do Oeste","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("252","Sao Joao Do Sul","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("253","Sao Joaquim","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("254","Sao Jose","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("255","Sao Jose Do Cedro","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("256","Sao Jose Do Cerrito","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("257","Sao Lourenco D\'oeste","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("258","Sao Ludgero","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("259","Sao Martinho","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("260","Sao Miguel Da Boa Vista","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("261","Sao Miguel D\'oeste","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("262","Sao Pedro De Alcantara","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("263","Saudades","1","2021-03-04 11:19:23",NULL,NULL);
INSERT INTO bib_municipio VALUES("264","Schroeder","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("265","Seara","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("266","Serra Alta","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("267","Sideropolis","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("268","Sombrio","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("269","Sul Brasil","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("270","Taio","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("271","Tangara","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("272","Tigrinhos","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("273","Tijucas","1","2021-03-04 11:19:24","2021-03-04 11:40:01","bandeira-tijucas.jpeg");
INSERT INTO bib_municipio VALUES("274","Timbe Do Sul","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("275","Timbo","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("276","Timbo Grande","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("277","Tres Barras","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("278","Treviso","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("279","Treze De Maio","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("280","Treze Tilias","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("281","Trombudo Central","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("282","Tubarao","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("283","Tunapolis","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("284","Turvo","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("285","Uniao Do Oeste","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("286","Urubici","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("287","Urupema","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("288","Urussanga","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("289","Vargeao","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("290","Vargem","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("291","Vargem Bonita","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("292","Vidal Ramos","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("293","Videira","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("294","Vitor Meireles","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("295","Witmarsum","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("296","Xanxere","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("297","Xavantina","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("298","Xaxim","1","2021-03-04 11:19:24",NULL,NULL);
INSERT INTO bib_municipio VALUES("299","Zortea","1","2021-03-04 11:19:24",NULL,NULL);


DROP TABLE IF EXISTS bib_pais;


CREATE TABLE `bib_pais` (
  `pais_id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `nome_pais` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sigla` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bandeira` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pais_id`)
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_pais VALUES("1","2021-02-09 12:58:21",NULL,"Brasil","BR","bandeira_br.jpg");
INSERT INTO bib_pais VALUES("2","2021-02-09 13:06:17",NULL,"Estados Unidos","USA","bandeira_usa.jpg");
INSERT INTO bib_pais VALUES("3","2021-02-09 17:21:04","2021-03-04 10:53:30","Argentina","AR","bandeira-uf-ag.png");
INSERT INTO bib_pais VALUES("6","2021-03-04 10:51:35",NULL,"nome_pais","sigla",NULL);
INSERT INTO bib_pais VALUES("7","2021-03-04 10:51:35",NULL,"Aruba","AA",NULL);
INSERT INTO bib_pais VALUES("8","2021-03-04 10:51:35",NULL,"Antígua e Barbuda","AC",NULL);
INSERT INTO bib_pais VALUES("9","2021-03-04 10:51:35",NULL,"Emirados Árabes Unidos","AE",NULL);
INSERT INTO bib_pais VALUES("10","2021-03-04 10:51:35",NULL,"Afeganistão","AF",NULL);
INSERT INTO bib_pais VALUES("11","2021-03-04 10:51:35",NULL,"Argélia","AG",NULL);
INSERT INTO bib_pais VALUES("12","2021-03-04 10:51:35",NULL,"Azerbaijão","AJ",NULL);
INSERT INTO bib_pais VALUES("13","2021-03-04 10:51:35",NULL,"Albânia","AL",NULL);
INSERT INTO bib_pais VALUES("14","2021-03-04 10:51:35",NULL,"Armênia","AM",NULL);
INSERT INTO bib_pais VALUES("15","2021-03-04 10:51:35",NULL,"Andorra","AN",NULL);
INSERT INTO bib_pais VALUES("16","2021-03-04 10:51:35",NULL,"Angola","AO",NULL);
INSERT INTO bib_pais VALUES("17","2021-03-04 10:51:35",NULL,"Samoa Americana","AQ",NULL);
INSERT INTO bib_pais VALUES("19","2021-03-04 10:51:35",NULL,"Austrália","AS",NULL);
INSERT INTO bib_pais VALUES("20","2021-03-04 10:51:35",NULL,"Ilhas Ashmore e Cartier","AT",NULL);
INSERT INTO bib_pais VALUES("21","2021-03-04 10:51:35",NULL,"Áustria","AU",NULL);
INSERT INTO bib_pais VALUES("22","2021-03-04 10:51:35",NULL,"Anguilla","AV",NULL);
INSERT INTO bib_pais VALUES("23","2021-03-04 10:51:35",NULL,"Acrotíri","AX",NULL);
INSERT INTO bib_pais VALUES("24","2021-03-04 10:51:35",NULL,"Antártica","AY",NULL);
INSERT INTO bib_pais VALUES("25","2021-03-04 10:51:35",NULL,"açores","AZ",NULL);
INSERT INTO bib_pais VALUES("26","2021-03-04 10:51:35",NULL,"Barém","BA",NULL);
INSERT INTO bib_pais VALUES("27","2021-03-04 10:51:35",NULL,"Barbados","BB",NULL);
INSERT INTO bib_pais VALUES("28","2021-03-04 10:51:35",NULL,"Botsuana","BC",NULL);
INSERT INTO bib_pais VALUES("29","2021-03-04 10:51:35",NULL,"Bermudas","BD",NULL);
INSERT INTO bib_pais VALUES("30","2021-03-04 10:51:35",NULL,"Bélgica","BE",NULL);
INSERT INTO bib_pais VALUES("31","2021-03-04 10:51:35",NULL,"Bahamas","BF",NULL);
INSERT INTO bib_pais VALUES("32","2021-03-04 10:51:35",NULL,"Bangladesh","BG",NULL);
INSERT INTO bib_pais VALUES("33","2021-03-04 10:51:35",NULL,"Belize","BH",NULL);
INSERT INTO bib_pais VALUES("34","2021-03-04 10:51:35",NULL,"Bósnia e Herzegovina","BK",NULL);
INSERT INTO bib_pais VALUES("35","2021-03-04 10:51:35",NULL,"Bolívia","BL",NULL);
INSERT INTO bib_pais VALUES("36","2021-03-04 10:51:35",NULL,"Birmânia Mianmar","BM",NULL);
INSERT INTO bib_pais VALUES("37","2021-03-04 10:51:35",NULL,"Benim","BN",NULL);
INSERT INTO bib_pais VALUES("38","2021-03-04 10:51:35",NULL,"Bielorrússia","BO",NULL);
INSERT INTO bib_pais VALUES("39","2021-03-04 10:51:35",NULL,"Ilhas Salomão","BP",NULL);
INSERT INTO bib_pais VALUES("40","2021-03-04 10:51:35",NULL,"Ilha Navassa","BQ",NULL);
INSERT INTO bib_pais VALUES("42","2021-03-04 10:51:35",NULL,"Butão","BT",NULL);
INSERT INTO bib_pais VALUES("43","2021-03-04 10:51:35",NULL,"Bulgária","BU",NULL);
INSERT INTO bib_pais VALUES("44","2021-03-04 10:51:35",NULL,"Ilha Bouvet","BV",NULL);
INSERT INTO bib_pais VALUES("45","2021-03-04 10:51:35",NULL,"Brunei","BX",NULL);
INSERT INTO bib_pais VALUES("46","2021-03-04 10:51:35",NULL,"Burundi","BY",NULL);
INSERT INTO bib_pais VALUES("47","2021-03-04 10:51:35",NULL,"Canadá","CA",NULL);
INSERT INTO bib_pais VALUES("48","2021-03-04 10:51:35",NULL,"Camboja","CB",NULL);
INSERT INTO bib_pais VALUES("49","2021-03-04 10:51:35",NULL,"Chade","CD",NULL);
INSERT INTO bib_pais VALUES("50","2021-03-04 10:51:35",NULL,"Sri Lanka","CE",NULL);
INSERT INTO bib_pais VALUES("51","2021-03-04 10:51:35",NULL,"República do Congo","CF",NULL);
INSERT INTO bib_pais VALUES("52","2021-03-04 10:51:35",NULL,"República Democrática do Congo","CG",NULL);
INSERT INTO bib_pais VALUES("53","2021-03-04 10:51:35",NULL,"República Popular da China","CH",NULL);
INSERT INTO bib_pais VALUES("54","2021-03-04 10:51:35",NULL,"Chile","CL",NULL);
INSERT INTO bib_pais VALUES("55","2021-03-04 10:51:35",NULL,"Ilhas Cayman","CJ",NULL);
INSERT INTO bib_pais VALUES("56","2021-03-04 10:51:35",NULL,"Ilhas Cocos Keeling","CK",NULL);
INSERT INTO bib_pais VALUES("57","2021-03-04 10:51:35",NULL,"Camarões","CM",NULL);
INSERT INTO bib_pais VALUES("58","2021-03-04 10:51:35",NULL,"Comores","CN",NULL);
INSERT INTO bib_pais VALUES("59","2021-03-04 10:51:35",NULL,"Colômbia","CO",NULL);
INSERT INTO bib_pais VALUES("60","2021-03-04 10:51:35",NULL,"Ilhas Marianas do Norte","CQ",NULL);
INSERT INTO bib_pais VALUES("61","2021-03-04 10:51:35",NULL,"Ilhas do Mar de Coral","CR",NULL);
INSERT INTO bib_pais VALUES("62","2021-03-04 10:51:35",NULL,"Costa Rica","CS",NULL);
INSERT INTO bib_pais VALUES("63","2021-03-04 10:51:35",NULL,"República Centro-Africana","CT",NULL);
INSERT INTO bib_pais VALUES("64","2021-03-04 10:51:35",NULL,"Cuba","CU",NULL);
INSERT INTO bib_pais VALUES("65","2021-03-04 10:51:36",NULL,"Cabo Verde","CV",NULL);
INSERT INTO bib_pais VALUES("66","2021-03-04 10:51:36",NULL,"Ilhas Cook","CW",NULL);
INSERT INTO bib_pais VALUES("67","2021-03-04 10:51:36",NULL,"Chipre","CY",NULL);
INSERT INTO bib_pais VALUES("68","2021-03-04 10:51:36",NULL,"Dinamarca","DA",NULL);
INSERT INTO bib_pais VALUES("69","2021-03-04 10:51:36",NULL,"Djibouti","DJ",NULL);
INSERT INTO bib_pais VALUES("70","2021-03-04 10:51:36",NULL,"Dominica","DO",NULL);
INSERT INTO bib_pais VALUES("71","2021-03-04 10:51:36",NULL,"Ilha Jarvis","DQ",NULL);
INSERT INTO bib_pais VALUES("72","2021-03-04 10:51:36",NULL,"República Dominicana","DR",NULL);
INSERT INTO bib_pais VALUES("73","2021-03-04 10:51:36",NULL,"Deceleia","DX",NULL);
INSERT INTO bib_pais VALUES("74","2021-03-04 10:51:36",NULL,"Equador","EC",NULL);
INSERT INTO bib_pais VALUES("75","2021-03-04 10:51:36",NULL,"Egito","EG",NULL);
INSERT INTO bib_pais VALUES("76","2021-03-04 10:51:36",NULL,"Irlanda","EI",NULL);
INSERT INTO bib_pais VALUES("77","2021-03-04 10:51:36",NULL,"Guiné Equatorial","EK",NULL);
INSERT INTO bib_pais VALUES("78","2021-03-04 10:51:36",NULL,"Estónia","EN",NULL);
INSERT INTO bib_pais VALUES("79","2021-03-04 10:51:36",NULL,"Eritreia","ER",NULL);
INSERT INTO bib_pais VALUES("80","2021-03-04 10:51:36",NULL,"El Salvador","ES",NULL);
INSERT INTO bib_pais VALUES("81","2021-03-04 10:51:36",NULL,"Etiópia","ET",NULL);
INSERT INTO bib_pais VALUES("82","2021-03-04 10:51:36",NULL,"República Checa","EZ",NULL);
INSERT INTO bib_pais VALUES("83","2021-03-04 10:51:36",NULL,"Guiana Francesa","FG",NULL);
INSERT INTO bib_pais VALUES("84","2021-03-04 10:51:36",NULL,"Finlândia","FI",NULL);
INSERT INTO bib_pais VALUES("85","2021-03-04 10:51:36",NULL,"Fiji","FJ",NULL);
INSERT INTO bib_pais VALUES("86","2021-03-04 10:51:36",NULL,"Ilhas Falkland Ilhas Malvinas","FK",NULL);
INSERT INTO bib_pais VALUES("87","2021-03-04 10:51:36",NULL,"Estados Federados da Micronésia","FM",NULL);
INSERT INTO bib_pais VALUES("88","2021-03-04 10:51:36",NULL,"Ilhas Feroe","FO",NULL);
INSERT INTO bib_pais VALUES("89","2021-03-04 10:51:36",NULL,"Polinésia Francesa","FP",NULL);
INSERT INTO bib_pais VALUES("90","2021-03-04 10:51:36",NULL,"Ilha Baker","FQ",NULL);
INSERT INTO bib_pais VALUES("91","2021-03-04 10:51:36",NULL,"França","FR",NULL);
INSERT INTO bib_pais VALUES("92","2021-03-04 10:51:36",NULL,"Terras Austrais e Antárticas Francesas","FS",NULL);
INSERT INTO bib_pais VALUES("93","2021-03-04 10:51:36",NULL,"Gâmbia","GA",NULL);
INSERT INTO bib_pais VALUES("94","2021-03-04 10:51:36",NULL,"Gabão","GB",NULL);
INSERT INTO bib_pais VALUES("95","2021-03-04 10:51:36",NULL,"Guiana francesa","GF",NULL);
INSERT INTO bib_pais VALUES("96","2021-03-04 10:51:36",NULL,"Geórgia","GG",NULL);
INSERT INTO bib_pais VALUES("97","2021-03-04 10:51:36",NULL,"Gana","GH",NULL);
INSERT INTO bib_pais VALUES("98","2021-03-04 10:51:36",NULL,"Gibraltar","GI",NULL);
INSERT INTO bib_pais VALUES("99","2021-03-04 10:51:36",NULL,"Granada","GJ",NULL);
INSERT INTO bib_pais VALUES("100","2021-03-04 10:51:36",NULL,"Guernsey","GK",NULL);
INSERT INTO bib_pais VALUES("101","2021-03-04 10:51:36",NULL,"Gronelândia","GL",NULL);
INSERT INTO bib_pais VALUES("102","2021-03-04 10:51:36",NULL,"Alemanha","GM",NULL);
INSERT INTO bib_pais VALUES("103","2021-03-04 10:51:36",NULL,"Guadalupe","GP",NULL);
INSERT INTO bib_pais VALUES("104","2021-03-04 10:51:36",NULL,"Guam","GQ",NULL);
INSERT INTO bib_pais VALUES("105","2021-03-04 10:51:36",NULL,"Grécia","GR",NULL);
INSERT INTO bib_pais VALUES("106","2021-03-04 10:51:36",NULL,"Guatemala","GT",NULL);
INSERT INTO bib_pais VALUES("107","2021-03-04 10:51:36",NULL,"Guiné","GV",NULL);
INSERT INTO bib_pais VALUES("108","2021-03-04 10:51:36",NULL,"Guiné-Bissau","GW",NULL);
INSERT INTO bib_pais VALUES("109","2021-03-04 10:51:36",NULL,"Guiana","GY",NULL);
INSERT INTO bib_pais VALUES("110","2021-03-04 10:51:36",NULL,"Faixa de Gaza","GZ",NULL);
INSERT INTO bib_pais VALUES("111","2021-03-04 10:51:36",NULL,"Haiti","HA",NULL);
INSERT INTO bib_pais VALUES("112","2021-03-04 10:51:36",NULL,"Hong Kong","HK",NULL);
INSERT INTO bib_pais VALUES("113","2021-03-04 10:51:36",NULL,"Ilha Heard e Ilhas McDonald","HM",NULL);
INSERT INTO bib_pais VALUES("114","2021-03-04 10:51:36",NULL,"Honduras","HO",NULL);
INSERT INTO bib_pais VALUES("115","2021-03-04 10:51:36",NULL,"Ilha Howland","HQ",NULL);
INSERT INTO bib_pais VALUES("116","2021-03-04 10:51:36",NULL,"Croácia","HR",NULL);
INSERT INTO bib_pais VALUES("117","2021-03-04 10:51:36",NULL,"Hungria","HU",NULL);
INSERT INTO bib_pais VALUES("118","2021-03-04 10:51:36",NULL,"Islândia","IC",NULL);
INSERT INTO bib_pais VALUES("119","2021-03-04 10:51:36",NULL,"Indonésia","ID",NULL);
INSERT INTO bib_pais VALUES("120","2021-03-04 10:51:36",NULL,"Ilha de Man","IM",NULL);
INSERT INTO bib_pais VALUES("121","2021-03-04 10:51:36",NULL,"Índia","IN",NULL);
INSERT INTO bib_pais VALUES("122","2021-03-04 10:51:36",NULL,"Território Britânico do Oceano Índico","IO",NULL);
INSERT INTO bib_pais VALUES("123","2021-03-04 10:51:36",NULL,"Ilha de Clipperton","IP",NULL);
INSERT INTO bib_pais VALUES("124","2021-03-04 10:51:36",NULL,"Irão","IR",NULL);
INSERT INTO bib_pais VALUES("125","2021-03-04 10:51:36",NULL,"Israel","IS",NULL);
INSERT INTO bib_pais VALUES("126","2021-03-04 10:51:36",NULL,"Itália","IT",NULL);
INSERT INTO bib_pais VALUES("127","2021-03-04 10:51:36",NULL,"Costa do Marfim","CI",NULL);
INSERT INTO bib_pais VALUES("128","2021-03-04 10:51:36",NULL,"Iraque","IZ",NULL);
INSERT INTO bib_pais VALUES("129","2021-03-04 10:51:36",NULL,"Japão","JP",NULL);
INSERT INTO bib_pais VALUES("130","2021-03-04 10:51:36",NULL,"Jersey","JE",NULL);
INSERT INTO bib_pais VALUES("131","2021-03-04 10:51:36",NULL,"Jamaica","JM",NULL);
INSERT INTO bib_pais VALUES("132","2021-03-04 10:51:36",NULL,"Jan Mayen","JN",NULL);
INSERT INTO bib_pais VALUES("133","2021-03-04 10:51:36",NULL,"Jordânia","JO",NULL);
INSERT INTO bib_pais VALUES("134","2021-03-04 10:51:36",NULL,"Atol Johnston","JQ",NULL);
INSERT INTO bib_pais VALUES("135","2021-03-04 10:51:36",NULL,"Quénia","KE",NULL);
INSERT INTO bib_pais VALUES("136","2021-03-04 10:51:36",NULL,"Quirguistão","KG",NULL);
INSERT INTO bib_pais VALUES("137","2021-03-04 10:51:36",NULL,"Coreia do Norte","KN",NULL);
INSERT INTO bib_pais VALUES("138","2021-03-04 10:51:36",NULL,"Recife Kingman","KQ",NULL);
INSERT INTO bib_pais VALUES("139","2021-03-04 10:51:36",NULL,"Kiribati","KR",NULL);
INSERT INTO bib_pais VALUES("140","2021-03-04 10:51:36",NULL,"Coreia do Sul","KS",NULL);
INSERT INTO bib_pais VALUES("141","2021-03-04 10:51:36",NULL,"Ilha Christmas","KT",NULL);
INSERT INTO bib_pais VALUES("142","2021-03-04 10:51:36",NULL,"Kuwait","KU",NULL);
INSERT INTO bib_pais VALUES("143","2021-03-04 10:51:36",NULL,"Cazaquistão","KV",NULL);
INSERT INTO bib_pais VALUES("144","2021-03-04 10:51:36",NULL,"Laos","LA",NULL);
INSERT INTO bib_pais VALUES("145","2021-03-04 10:51:36",NULL,"Líbano","LE",NULL);
INSERT INTO bib_pais VALUES("146","2021-03-04 10:51:36",NULL,"Letónia","LG",NULL);
INSERT INTO bib_pais VALUES("147","2021-03-04 10:51:36",NULL,"Lituânia","LH",NULL);
INSERT INTO bib_pais VALUES("148","2021-03-04 10:51:36",NULL,"Libéria","LI",NULL);
INSERT INTO bib_pais VALUES("149","2021-03-04 10:51:36",NULL,"Eslováquia","LO",NULL);
INSERT INTO bib_pais VALUES("150","2021-03-04 10:51:36",NULL,"Latin Purificado","LP",NULL);
INSERT INTO bib_pais VALUES("151","2021-03-04 10:51:36",NULL,"Atol Palmyra","LQ",NULL);
INSERT INTO bib_pais VALUES("152","2021-03-04 10:51:36",NULL,"Liechtenstein","LS",NULL);
INSERT INTO bib_pais VALUES("153","2021-03-04 10:51:36",NULL,"Lesoto","LT",NULL);
INSERT INTO bib_pais VALUES("154","2021-03-04 10:51:36",NULL,"Luxemburgo","LU",NULL);
INSERT INTO bib_pais VALUES("155","2021-03-04 10:51:36",NULL,"Líbia","LY",NULL);
INSERT INTO bib_pais VALUES("156","2021-03-04 10:51:36",NULL,"Marrocos","MA",NULL);
INSERT INTO bib_pais VALUES("157","2021-03-04 10:51:36",NULL,"Martinica","MB",NULL);
INSERT INTO bib_pais VALUES("158","2021-03-04 10:51:36",NULL,"Macau","MC",NULL);
INSERT INTO bib_pais VALUES("159","2021-03-04 10:51:36",NULL,"Moldávia","MD",NULL);
INSERT INTO bib_pais VALUES("160","2021-03-04 10:51:36",NULL,"Madeira","ME",NULL);
INSERT INTO bib_pais VALUES("161","2021-03-04 10:51:36",NULL,"Mayotte","MF",NULL);
INSERT INTO bib_pais VALUES("162","2021-03-04 10:51:36",NULL,"Mongólia","MG",NULL);
INSERT INTO bib_pais VALUES("163","2021-03-04 10:51:36",NULL,"Montserrat","MH",NULL);
INSERT INTO bib_pais VALUES("164","2021-03-04 10:51:36",NULL,"Maláui","MI",NULL);
INSERT INTO bib_pais VALUES("165","2021-03-04 10:51:36",NULL,"Montenegro","MJ",NULL);
INSERT INTO bib_pais VALUES("166","2021-03-04 10:51:36",NULL,"Macedônia do Norte","MK",NULL);
INSERT INTO bib_pais VALUES("167","2021-03-04 10:51:36",NULL,"Mali","ML",NULL);
INSERT INTO bib_pais VALUES("168","2021-03-04 10:51:36",NULL,"Mônaco","MN",NULL);
INSERT INTO bib_pais VALUES("169","2021-03-04 10:51:36",NULL,"Maurícia","MP",NULL);
INSERT INTO bib_pais VALUES("170","2021-03-04 10:51:36",NULL,"Atol de Midway","MQ",NULL);
INSERT INTO bib_pais VALUES("171","2021-03-04 10:51:36",NULL,"Mauritânia","MR",NULL);
INSERT INTO bib_pais VALUES("172","2021-03-04 10:51:36",NULL,"Malta","MT",NULL);
INSERT INTO bib_pais VALUES("173","2021-03-04 10:51:36",NULL,"Omã","MU",NULL);
INSERT INTO bib_pais VALUES("174","2021-03-04 10:51:36",NULL,"Maldivas","MV",NULL);
INSERT INTO bib_pais VALUES("175","2021-03-04 10:51:36",NULL,"México","MX",NULL);
INSERT INTO bib_pais VALUES("176","2021-03-04 10:51:36",NULL,"Malásia","MY",NULL);
INSERT INTO bib_pais VALUES("177","2021-03-04 10:51:36",NULL,"Moçambique","MZ",NULL);
INSERT INTO bib_pais VALUES("178","2021-03-04 10:51:36",NULL,"Nova Caledônia","NC",NULL);
INSERT INTO bib_pais VALUES("179","2021-03-04 10:51:36",NULL,"Niue","NE",NULL);
INSERT INTO bib_pais VALUES("180","2021-03-04 10:51:36",NULL,"Ilha Norfolk","NF",NULL);
INSERT INTO bib_pais VALUES("181","2021-03-04 10:51:36",NULL,"Níger","NG",NULL);
INSERT INTO bib_pais VALUES("182","2021-03-04 10:51:36",NULL,"Vanuatu","NH",NULL);
INSERT INTO bib_pais VALUES("183","2021-03-04 10:51:36",NULL,"Nigéria","NI",NULL);
INSERT INTO bib_pais VALUES("184","2021-03-04 10:51:36",NULL,"Países Baixos","NL",NULL);
INSERT INTO bib_pais VALUES("185","2021-03-04 10:51:36",NULL,"Noruega","NO",NULL);
INSERT INTO bib_pais VALUES("186","2021-03-04 10:51:36",NULL,"Nepal","NP",NULL);
INSERT INTO bib_pais VALUES("187","2021-03-04 10:51:36",NULL,"Nauru","NR",NULL);
INSERT INTO bib_pais VALUES("188","2021-03-04 10:51:36",NULL,"Suriname","NS",NULL);
INSERT INTO bib_pais VALUES("189","2021-03-04 10:51:36",NULL,"Antilhas Holandesas","NT",NULL);
INSERT INTO bib_pais VALUES("190","2021-03-04 10:51:36",NULL,"Nicarágua","NU",NULL);
INSERT INTO bib_pais VALUES("191","2021-03-04 10:51:36",NULL,"Nova Zelândia","NZ",NULL);
INSERT INTO bib_pais VALUES("192","2021-03-04 10:51:36",NULL,"Paraguai","PA",NULL);
INSERT INTO bib_pais VALUES("193","2021-03-04 10:51:36",NULL,"Ilhas Pitcairn","PC",NULL);
INSERT INTO bib_pais VALUES("194","2021-03-04 10:51:36",NULL,"Peru","PE",NULL);
INSERT INTO bib_pais VALUES("195","2021-03-04 10:51:36",NULL,"Ilhas Paracel","PF",NULL);
INSERT INTO bib_pais VALUES("196","2021-03-04 10:51:36",NULL,"Ilhas Spratly","PG",NULL);
INSERT INTO bib_pais VALUES("197","2021-03-04 10:51:36",NULL,"Paquistão","PK",NULL);
INSERT INTO bib_pais VALUES("198","2021-03-04 10:51:36",NULL,"Polônia","PL",NULL);
INSERT INTO bib_pais VALUES("199","2021-03-04 10:51:36",NULL,"Panamá","PM",NULL);
INSERT INTO bib_pais VALUES("200","2021-03-04 10:51:36",NULL,"Portugal","PT",NULL);
INSERT INTO bib_pais VALUES("201","2021-03-04 10:51:36",NULL,"Papua-Nova Guiné","PP",NULL);
INSERT INTO bib_pais VALUES("202","2021-03-04 10:51:36",NULL,"Palau","PS",NULL);
INSERT INTO bib_pais VALUES("203","2021-03-04 10:51:37",NULL,"Guiné-Bissau","PU",NULL);
INSERT INTO bib_pais VALUES("204","2021-03-04 10:51:37",NULL,"Catar","QA",NULL);
INSERT INTO bib_pais VALUES("205","2021-03-04 10:51:37",NULL,"Reunião","RE",NULL);
INSERT INTO bib_pais VALUES("206","2021-03-04 10:51:37",NULL,"Sérvia","RI",NULL);
INSERT INTO bib_pais VALUES("207","2021-03-04 10:51:37",NULL,"Ilhas Marshall","RM",NULL);
INSERT INTO bib_pais VALUES("208","2021-03-04 10:51:37",NULL,"Saint Martin","RN",NULL);
INSERT INTO bib_pais VALUES("209","2021-03-04 10:51:37",NULL,"Roménia","RO",NULL);
INSERT INTO bib_pais VALUES("210","2021-03-04 10:51:37",NULL,"Filipinas","RP",NULL);
INSERT INTO bib_pais VALUES("211","2021-03-04 10:51:37",NULL,"Porto Rico","RQ",NULL);
INSERT INTO bib_pais VALUES("212","2021-03-04 10:51:37",NULL,"Rússia","RS",NULL);
INSERT INTO bib_pais VALUES("213","2021-03-04 10:51:37",NULL,"Ruanda","RW",NULL);
INSERT INTO bib_pais VALUES("214","2021-03-04 10:51:37",NULL,"Arábia Saudita","SA",NULL);
INSERT INTO bib_pais VALUES("215","2021-03-04 10:51:37",NULL,"Saint Pierre e Miquelon","SB",NULL);
INSERT INTO bib_pais VALUES("216","2021-03-04 10:51:37",NULL,"São Cristóvão e Nevis","SC",NULL);
INSERT INTO bib_pais VALUES("217","2021-03-04 10:51:37",NULL,"Seychelles","SE",NULL);
INSERT INTO bib_pais VALUES("218","2021-03-04 10:51:37",NULL,"África do Sul","SF",NULL);
INSERT INTO bib_pais VALUES("219","2021-03-04 10:51:37",NULL,"Senegal","SG",NULL);
INSERT INTO bib_pais VALUES("220","2021-03-04 10:51:37",NULL,"Santa Helena território","SH",NULL);
INSERT INTO bib_pais VALUES("221","2021-03-04 10:51:37",NULL,"Eslovénia","SI",NULL);
INSERT INTO bib_pais VALUES("222","2021-03-04 10:51:37",NULL,"Serra Leoa","SL",NULL);
INSERT INTO bib_pais VALUES("223","2021-03-04 10:51:37",NULL,"San Marino","SM",NULL);
INSERT INTO bib_pais VALUES("224","2021-03-04 10:51:37",NULL,"Singapura","SN",NULL);
INSERT INTO bib_pais VALUES("225","2021-03-04 10:51:37",NULL,"Somália","SO",NULL);
INSERT INTO bib_pais VALUES("226","2021-03-04 10:51:37",NULL,"Espanha","SP",NULL);
INSERT INTO bib_pais VALUES("227","2021-03-04 10:51:37",NULL,"Santa Lúcia","ST",NULL);
INSERT INTO bib_pais VALUES("228","2021-03-04 10:51:37",NULL,"Sudão","SU",NULL);
INSERT INTO bib_pais VALUES("229","2021-03-04 10:51:37",NULL,"Svalbard","SV",NULL);
INSERT INTO bib_pais VALUES("230","2021-03-04 10:51:37",NULL,"Suécia","SW",NULL);
INSERT INTO bib_pais VALUES("231","2021-03-04 10:51:37",NULL,"Ilhas Geórgia do Sul e Sandwich do Sul","SX",NULL);
INSERT INTO bib_pais VALUES("232","2021-03-04 10:51:37",NULL,"Síria","SY",NULL);
INSERT INTO bib_pais VALUES("233","2021-03-04 10:51:37",NULL,"Suiça","SZ",NULL);
INSERT INTO bib_pais VALUES("234","2021-03-04 10:51:37",NULL,"Saint-Barthélemy Antilhas francesas","TB",NULL);
INSERT INTO bib_pais VALUES("235","2021-03-04 10:51:37",NULL,"Trinidad e Tobago","TD",NULL);
INSERT INTO bib_pais VALUES("236","2021-03-04 10:51:37",NULL,"Tailândia","TH",NULL);
INSERT INTO bib_pais VALUES("237","2021-03-04 10:51:37",NULL,"Tadjiquistão","TI",NULL);
INSERT INTO bib_pais VALUES("238","2021-03-04 10:51:37",NULL,"Ilhas Turks e Caicos","TK",NULL);
INSERT INTO bib_pais VALUES("239","2021-03-04 10:51:37",NULL,"Tokelau","TL",NULL);
INSERT INTO bib_pais VALUES("240","2021-03-04 10:51:37",NULL,"Tonga","TN",NULL);
INSERT INTO bib_pais VALUES("241","2021-03-04 10:51:37",NULL,"Togo","TO",NULL);
INSERT INTO bib_pais VALUES("242","2021-03-04 10:51:37",NULL,"São Tomé e Príncipe","TP",NULL);
INSERT INTO bib_pais VALUES("243","2021-03-04 10:51:37",NULL,"Tunísia","TS",NULL);
INSERT INTO bib_pais VALUES("244","2021-03-04 10:51:37",NULL,"Timor-Leste","TT",NULL);
INSERT INTO bib_pais VALUES("245","2021-03-04 10:51:37",NULL,"Turquia","TR",NULL);
INSERT INTO bib_pais VALUES("246","2021-03-04 10:51:37",NULL,"Tuvalu","TV",NULL);
INSERT INTO bib_pais VALUES("247","2021-03-04 10:51:37",NULL,"Taiwan","TW",NULL);
INSERT INTO bib_pais VALUES("248","2021-03-04 10:51:37",NULL,"Turquemenistão","TX",NULL);
INSERT INTO bib_pais VALUES("249","2021-03-04 10:51:37",NULL,"Tanzânia","TZ",NULL);
INSERT INTO bib_pais VALUES("250","2021-03-04 10:51:37",NULL,"Uganda","UG",NULL);
INSERT INTO bib_pais VALUES("251","2021-03-04 10:51:37",NULL,"Reino Unido","UK",NULL);
INSERT INTO bib_pais VALUES("252","2021-03-04 10:51:37",NULL,"Ucrânia","UP",NULL);
INSERT INTO bib_pais VALUES("253","2021-03-04 10:51:37",NULL,"Estados Unidos","US",NULL);
INSERT INTO bib_pais VALUES("254","2021-03-04 10:51:37",NULL,"Burkina Faso","UV",NULL);
INSERT INTO bib_pais VALUES("255","2021-03-04 10:51:37",NULL,"Uruguai","UY",NULL);
INSERT INTO bib_pais VALUES("256","2021-03-04 10:51:37",NULL,"Uzbequistão","UZ",NULL);
INSERT INTO bib_pais VALUES("257","2021-03-04 10:51:37",NULL,"São Vicente e Granadinas","VC",NULL);
INSERT INTO bib_pais VALUES("258","2021-03-04 10:51:37",NULL,"Venezuela","VE",NULL);
INSERT INTO bib_pais VALUES("259","2021-03-04 10:51:37",NULL,"Ilhas Virgens Britânicas","VI",NULL);
INSERT INTO bib_pais VALUES("260","2021-03-04 10:51:37",NULL,"Vietname","VM",NULL);
INSERT INTO bib_pais VALUES("261","2021-03-04 10:51:37",NULL,"Ilhas Virgens Americanas","VQ",NULL);
INSERT INTO bib_pais VALUES("262","2021-03-04 10:51:37",NULL,"Vaticano","VT",NULL);
INSERT INTO bib_pais VALUES("263","2021-03-04 10:51:37",NULL,"Namíbia","WA",NULL);
INSERT INTO bib_pais VALUES("264","2021-03-04 10:51:37",NULL,"Cisjordânia","WE",NULL);
INSERT INTO bib_pais VALUES("265","2021-03-04 10:51:37",NULL,"Wallis e Futuna","WF",NULL);
INSERT INTO bib_pais VALUES("266","2021-03-04 10:51:37",NULL,"Saara Ocidental","WI",NULL);
INSERT INTO bib_pais VALUES("267","2021-03-04 10:51:37",NULL,"Ilha Wake","WQ",NULL);
INSERT INTO bib_pais VALUES("268","2021-03-04 10:51:37",NULL,"Samoa","WS",NULL);
INSERT INTO bib_pais VALUES("269","2021-03-04 10:51:37",NULL,"Essuatíni","WZ",NULL);
INSERT INTO bib_pais VALUES("270","2021-03-04 10:51:37",NULL,"Iémen","YM",NULL);
INSERT INTO bib_pais VALUES("271","2021-03-04 10:51:37",NULL,"Zâmbia","ZA",NULL);
INSERT INTO bib_pais VALUES("272","2021-03-04 10:51:37",NULL,"Zimbabwe","ZI",NULL);


DROP TABLE IF EXISTS bib_produtos;


CREATE TABLE `bib_produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_prod` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `quant` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_produtos VALUES("3","25","23");
INSERT INTO bib_produtos VALUES("4","25","7");


DROP TABLE IF EXISTS bib_sits_biblio;


CREATE TABLE `bib_sits_biblio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adms_cor_id` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_sits_biblio VALUES("1","Circulação","3","2018-05-23 00:00:00",NULL);
INSERT INTO bib_sits_biblio VALUES("2","Adquirir","5","2018-05-23 00:00:00",NULL);
INSERT INTO bib_sits_biblio VALUES("3","Interno","1","2018-05-23 00:00:00",NULL);
INSERT INTO bib_sits_biblio VALUES("4","Manutenção","8","2021-01-31 17:48:28","2021-02-14 20:46:25");


DROP TABLE IF EXISTS bib_sits_copia;


CREATE TABLE `bib_sits_copia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cod` char(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adms_cor_id` int NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_sits_copia VALUES("1","dis","Disponivel","3","2018-05-23 00:00:00",NULL);
INSERT INTO bib_sits_copia VALUES("2","emp","Emprestado","5","2018-05-23 00:00:00",NULL);
INSERT INTO bib_sits_copia VALUES("3","res","Reserva","1","2018-05-23 00:00:00",NULL);
INSERT INTO bib_sits_copia VALUES("4","man","Manutenção","4","2018-05-23 00:00:00",NULL);
INSERT INTO bib_sits_copia VALUES("5","per","Perdido","8","2018-05-23 00:00:00",NULL);
INSERT INTO bib_sits_copia VALUES("6","exb","Exibição","6","2021-01-31 14:49:50","2021-02-14 20:58:52");


DROP TABLE IF EXISTS bib_sits_leitores;


CREATE TABLE `bib_sits_leitores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adms_cor_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_sits_leitores VALUES("1","Leitor","3","2018-05-23 00:00:00",NULL);
INSERT INTO bib_sits_leitores VALUES("2","Inativo","1","2018-05-23 00:00:00",NULL);
INSERT INTO bib_sits_leitores VALUES("3","Aguardando","5","2018-05-23 00:00:00","2021-02-14 21:06:21");
INSERT INTO bib_sits_leitores VALUES("4","Bloqueado","4","2018-05-23 00:00:00",NULL);


DROP TABLE IF EXISTS bib_tipo_material;


CREATE TABLE `bib_tipo_material` (
  `cod_id` int NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `descricao` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `flag` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `arq_imagem` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cod_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_tipo_material VALUES("1","2021-02-05 12:50:19","2021-02-11 14:18:18","livros","N","book.png");
INSERT INTO bib_tipo_material VALUES("2","2021-02-05 12:50:32",NULL,"cd/dvd","N","cd.png");
INSERT INTO bib_tipo_material VALUES("3","2021-02-05 12:50:40",NULL,"equipamentos","N","case.png");
INSERT INTO bib_tipo_material VALUES("4","2021-02-05 12:50:48",NULL,"revistas","N","mag.png");
INSERT INTO bib_tipo_material VALUES("5","2021-02-05 12:50:56",NULL,"mapas","N","map.png");
INSERT INTO bib_tipo_material VALUES("6","2021-02-05 12:51:05","2021-02-09 10:47:44","outros","N","outros.png");
INSERT INTO bib_tipo_material VALUES("8","2021-02-05 15:57:06",NULL,"Gibi","N","gibi.png");
INSERT INTO bib_tipo_material VALUES("9","2021-02-05 15:59:51",NULL,"DataShow","S","datashow.png");


DROP TABLE IF EXISTS bib_uf;


CREATE TABLE `bib_uf` (
  `uf_id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `nome` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf` char(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_pais` int DEFAULT '1',
  `logo_imagem` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`uf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO bib_uf VALUES("1","2021-02-07 15:08:48","2021-03-04 11:27:09","Santa Catarina","SC","1","bandeira_SC.jpg");
INSERT INTO bib_uf VALUES("2","2021-02-07 15:08:48","2021-03-04 09:33:25","São Paulo","SP","1","bandeira-uf-sp.png");
INSERT INTO bib_uf VALUES("3","2021-02-07 15:09:23","2021-02-09 13:21:10","Rio de Janeiro","RJ","1","bandeira-uf-rj.png");
INSERT INTO bib_uf VALUES("4","2021-02-07 15:09:23","2021-03-04 09:34:18","Rio Grande Do Sul","RS","1","bandeira-uf-rgs.png");
INSERT INTO bib_uf VALUES("5","2021-02-07 16:16:47","2021-03-04 09:35:00","Amazonas","AM","1","bandeira-uf-am.png");
INSERT INTO bib_uf VALUES("6","2021-02-07 16:17:38","2021-03-04 09:35:43","Paraná","PR","1","bandeira-uf-pr.png");
INSERT INTO bib_uf VALUES("11","2021-02-07 20:13:44",NULL,"Acre","AC","1","bandeira-acre.png");
INSERT INTO bib_uf VALUES("12","2021-02-07 20:14:07",NULL,"Alagoas","AL","1","bandeira-alagoas.jpg");
INSERT INTO bib_uf VALUES("18","2021-03-04 09:37:38",NULL,"Espírito Santo","ES","1","bandeira-uf-es.png");
INSERT INTO bib_uf VALUES("19","2021-03-04 09:38:57",NULL,"Sergipe","SE","1","bandeira-uf-se.png");
INSERT INTO bib_uf VALUES("20","2021-03-04 09:39:45",NULL,"Tocantins","TO","1","bandeira-uf-to.png");
INSERT INTO bib_uf VALUES("21","2021-03-04 09:40:41",NULL,"Rio Grande Do Norte","RN","1","bandeira-uf-rn.png");
INSERT INTO bib_uf VALUES("22","2021-03-04 09:41:45",NULL,"Rondônia","RO","1","bandeira-uf-ro.png");
INSERT INTO bib_uf VALUES("23","2021-03-04 09:42:35",NULL,"Roraima","RR","1","bandeira-uf-rr.png");
INSERT INTO bib_uf VALUES("24","2021-03-04 09:43:29",NULL,"Piauí","PI","1","bandeira-uf-pi.png");
INSERT INTO bib_uf VALUES("25","2021-03-04 09:44:12",NULL,"Pernambuco","PE","1","bandeira-uf-pe.png");
INSERT INTO bib_uf VALUES("26","2021-03-04 09:45:34",NULL,"Paraíba","PB","1","bandeira-uf-pb.png");
INSERT INTO bib_uf VALUES("27","2021-03-04 09:46:27",NULL,"Pará","PA","1","bandeira-uf-pa.png");
INSERT INTO bib_uf VALUES("28","2021-03-04 09:48:06",NULL,"Minas Gerais","MG","1","bandeira-uf-mg.png");
INSERT INTO bib_uf VALUES("29","2021-03-04 09:49:05",NULL,"Mato Grosso Do Sul ","MS","1","bandeira-uf-ms.png");
INSERT INTO bib_uf VALUES("30","2021-03-04 09:50:01",NULL,"Mato Grosso","MT","1","bandeira-uf-mt.png");
INSERT INTO bib_uf VALUES("31","2021-03-04 09:50:32","2021-03-04 09:51:37","Maranhão","MA","1","bandeira-uf-ma.png");
INSERT INTO bib_uf VALUES("32","2021-03-04 09:53:00",NULL,"Goiás","GO","1","bandeira-uf-go.png");
INSERT INTO bib_uf VALUES("33","2021-03-04 09:54:24","2021-03-04 09:56:10","Distrito Federal","DF","1","bandeira-df.png");
INSERT INTO bib_uf VALUES("34","2021-03-04 09:57:01",NULL,"Ceará","CE","1","bandeira-uf-ce.png");
INSERT INTO bib_uf VALUES("35","2021-03-04 09:58:43",NULL,"Bahia","BA","1","bandeira-uf-ba.png");
INSERT INTO bib_uf VALUES("36","2021-03-04 09:59:29",NULL,"Amapá","AP","1","bandeira-uf-ap.png");


DROP TABLE IF EXISTS teste;


CREATE TABLE `teste` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` date NOT NULL,
  `campos` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;



