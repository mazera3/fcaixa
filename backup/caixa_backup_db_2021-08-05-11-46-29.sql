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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO adms_menus VALUES("1","Home","fas fa-tachometer-alt","1","1","2018-05-23 00:00:00","2021-07-05 18:28:31");
INSERT INTO adms_menus VALUES("2","Usuarios","fas fa-users","3","1","2018-05-23 00:00:00","2021-07-05 18:28:31");
INSERT INTO adms_menus VALUES("3","Sair","fas fa-sign-out-alt","8","1","2020-02-05 00:00:00","2021-08-03 21:34:28");
INSERT INTO adms_menus VALUES("4","Configuração","fas fa-cogs","2","1","2020-02-05 00:00:00","2021-07-05 18:28:31");
INSERT INTO adms_menus VALUES("6","Contas","fas fa-list-alt","5","1","2020-03-17 22:23:16","2021-08-02 09:31:05");
INSERT INTO adms_menus VALUES("7","Caixa","fas fa-box","7","1","2020-03-18 23:18:55","2021-08-03 21:34:43");
INSERT INTO adms_menus VALUES("8","Login","fas fa-users","9","1","2021-01-25 21:15:10","2021-08-03 21:34:23");
INSERT INTO adms_menus VALUES("9","Administração","fas fa-edit","4","1","2021-02-04 20:43:17","2021-07-05 18:28:31");
INSERT INTO adms_menus VALUES("11","Extras","fas fa-question-circle","6","1","2021-08-03 21:01:10","2021-08-03 21:34:43");


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
) ENGINE=MyISAM AUTO_INCREMENT=1730 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

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
INSERT INTO adms_nivacs_pgs VALUES("1729","1","171","2","2","11","1","346","2021-08-05 10:16:55",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1728","1","170","2","2","11","1","345","2021-08-05 10:16:55",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1727","1","169","2","2","11","1","344","2021-08-05 10:16:55",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1726","1","168","2","2","11","1","343","2021-08-05 10:16:55",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1725","1","167","1","1","11","1","342","2021-08-05 10:16:55",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1724","1","166","2","2","11","1","341","2021-08-04 20:00:50",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1723","1","165","2","2","11","1","340","2021-08-04 19:39:36",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1722","1","164","2","2","11","1","339","2021-08-04 19:06:47",NULL);
INSERT INTO adms_nivacs_pgs VALUES("26","1","15","2","2","2","1","18","2018-06-23 00:00:00","2020-03-14 09:47:01");
INSERT INTO adms_nivacs_pgs VALUES("27","1","16","2","2","2","1","19","2018-06-23 00:00:00","2020-03-14 09:46:59");
INSERT INTO adms_nivacs_pgs VALUES("28","1","17","2","2","2","1","20","2018-06-23 00:00:00","2020-03-14 09:46:57");
INSERT INTO adms_nivacs_pgs VALUES("29","1","18","2","2","2","1","21","2018-06-23 00:00:00","2020-03-14 09:46:55");
INSERT INTO adms_nivacs_pgs VALUES("30","1","19","2","2","2","1","22","2018-06-23 00:00:00","2020-03-14 09:46:52");
INSERT INTO adms_nivacs_pgs VALUES("1721","1","163","2","2","11","1","338","2021-08-04 15:15:47",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1720","1","162","1","1","11","1","337","2021-08-04 14:39:18",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1714","1","161","2","2","11","1","334","2021-08-02 12:16:09","2021-08-03 22:35:32");
INSERT INTO adms_nivacs_pgs VALUES("1713","1","160","2","2","4","1","333","2021-08-02 12:10:17",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1712","1","159","2","2","4","1","332","2021-08-02 11:08:26",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1711","1","158","1","1","9","1","331","2021-08-02 10:24:55","2021-08-02 10:25:31");
INSERT INTO adms_nivacs_pgs VALUES("37","1","20","1","1","4","1","23","2018-06-23 00:00:00","2020-03-14 09:46:49");
INSERT INTO adms_nivacs_pgs VALUES("38","1","21","2","2","4","1","24","2018-06-23 00:00:00","2020-03-14 09:46:41");
INSERT INTO adms_nivacs_pgs VALUES("39","1","22","2","2","4","1","25","2018-06-22 14:25:21","2020-03-14 09:46:40");
INSERT INTO adms_nivacs_pgs VALUES("1710","1","157","2","2","4","1","330","2021-08-01 19:09:42",NULL);
INSERT INTO adms_nivacs_pgs VALUES("44","1","23","2","2","4","1","26","2018-06-22 14:43:47","2020-03-14 09:46:38");
INSERT INTO adms_nivacs_pgs VALUES("1709","1","156","2","2","4","1","329","2021-08-01 19:08:16",NULL);
INSERT INTO adms_nivacs_pgs VALUES("49","1","24","2","2","4","1","27","2018-06-22 19:17:43","2020-03-14 09:46:35");
INSERT INTO adms_nivacs_pgs VALUES("1708","1","155","2","2","4","1","328","2021-08-01 19:06:37",NULL);
INSERT INTO adms_nivacs_pgs VALUES("54","1","25","2","2","4","1","28","2020-03-03 23:22:27","2020-03-14 09:46:30");
INSERT INTO adms_nivacs_pgs VALUES("1707","1","154","2","2","4","1","327","2021-08-01 12:32:36",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1706","1","111","1","1","6","1","326","2021-08-01 08:54:29","2021-08-02 09:32:54");
INSERT INTO adms_nivacs_pgs VALUES("191","1","43","2","2","4","1","50","2020-03-17 22:20:59","2020-03-18 11:51:38");
INSERT INTO adms_nivacs_pgs VALUES("68","1","26","2","2","4","1","33","2020-03-04 16:16:17","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1705","1","153","2","2","4","1","325","2021-08-01 08:42:24","2021-08-01 08:56:05");
INSERT INTO adms_nivacs_pgs VALUES("75","1","27","2","2","4","1","34","2020-03-04 16:24:24","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1704","1","152","2","2","4","1","324","2021-08-01 08:35:47","2021-08-01 08:56:05");
INSERT INTO adms_nivacs_pgs VALUES("82","1","28","2","2","4","1","35","2020-03-04 16:28:14","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1703","1","151","2","2","4","1","323","2021-08-01 08:29:05","2021-08-01 08:56:07");
INSERT INTO adms_nivacs_pgs VALUES("89","1","29","2","2","4","1","36","2020-03-04 16:34:13","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1702","1","150","2","2","4","1","322","2021-07-31 22:56:28","2021-08-01 08:56:17");
INSERT INTO adms_nivacs_pgs VALUES("96","1","30","2","2","4","1","37","2020-03-08 16:10:23","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1701","1","149","2","2","4","1","321","2021-07-31 22:50:40","2021-08-01 08:56:17");
INSERT INTO adms_nivacs_pgs VALUES("103","1","31","2","2","4","1","38","2020-03-08 18:22:01","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1700","1","148","2","2","4","1","320","2021-07-31 22:44:12","2021-08-01 08:56:18");
INSERT INTO adms_nivacs_pgs VALUES("110","1","32","2","2","4","1","39","2020-03-08 19:02:30","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1699","1","147","2","2","4","1","319","2021-07-31 22:38:28","2021-08-01 08:56:25");
INSERT INTO adms_nivacs_pgs VALUES("117","1","33","2","2","4","1","40","2020-03-08 20:19:47","2020-03-17 21:47:17");
INSERT INTO adms_nivacs_pgs VALUES("1698","1","110","1","1","6","1","318","2021-07-31 22:30:13","2021-08-02 09:32:49");
INSERT INTO adms_nivacs_pgs VALUES("1697","1","146","2","2","4","1","317","2021-07-31 21:58:53","2021-08-01 08:56:25");
INSERT INTO adms_nivacs_pgs VALUES("198","1","44","2","2","4","1","51","2020-03-17 22:22:50","2020-03-18 11:51:36");
INSERT INTO adms_nivacs_pgs VALUES("135","1","37","1","1","4","1","42","2020-03-13 08:41:57","2020-03-18 11:52:52");
INSERT INTO adms_nivacs_pgs VALUES("1696","1","109","1","1","6","1","316","2021-07-31 21:54:09","2021-08-02 09:32:44");
INSERT INTO adms_nivacs_pgs VALUES("142","1","38","2","2","4","1","43","2020-03-13 09:35:05","2020-03-18 11:52:44");
INSERT INTO adms_nivacs_pgs VALUES("1695","1","145","2","2","4","1","315","2021-07-31 19:22:15","2021-08-01 08:56:26");
INSERT INTO adms_nivacs_pgs VALUES("149","1","39","2","2","4","1","44","2020-03-13 12:42:28","2020-03-18 11:52:39");
INSERT INTO adms_nivacs_pgs VALUES("1694","1","144","2","2","4","1","314","2021-07-31 18:41:13","2021-08-01 08:56:32");
INSERT INTO adms_nivacs_pgs VALUES("1693","1","143","2","2","4","1","313","2021-07-31 18:36:31","2021-08-01 08:56:33");
INSERT INTO adms_nivacs_pgs VALUES("156","1","40","2","2","4","1","45","2020-03-13 13:14:48","2020-03-18 11:52:32");
INSERT INTO adms_nivacs_pgs VALUES("1692","1","142","2","2","4","1","312","2021-07-31 17:51:44","2021-08-01 08:56:39");
INSERT INTO adms_nivacs_pgs VALUES("1599","1","87","1","1","9","1","249","2021-04-02 10:01:56","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("163","1","41","2","2","4","1","46","2020-03-13 13:39:40","2021-02-04 21:49:59");
INSERT INTO adms_nivacs_pgs VALUES("1691","1","108","1","1","6","1","311","2021-07-31 17:41:48","2021-08-02 09:32:38");
INSERT INTO adms_nivacs_pgs VALUES("170","1","5","2","2","11","1","47","2020-03-14 09:39:46","2021-07-04 15:04:20");
INSERT INTO adms_nivacs_pgs VALUES("1690","1","141","2","2","4","1","310","2021-07-30 21:31:26","2021-08-01 08:56:39");
INSERT INTO adms_nivacs_pgs VALUES("177","1","42","2","2","4","1","48","2020-03-14 22:03:22","2020-03-18 11:51:57");
INSERT INTO adms_nivacs_pgs VALUES("1689","1","140","2","2","4","1","309","2021-07-30 21:24:55","2021-08-01 08:56:39");
INSERT INTO adms_nivacs_pgs VALUES("184","1","34","1","1","4","1","49","2020-03-17 20:52:20","2020-03-18 11:50:30");
INSERT INTO adms_nivacs_pgs VALUES("1688","1","139","2","2","4","1","308","2021-07-30 21:19:37","2021-08-01 08:56:43");
INSERT INTO adms_nivacs_pgs VALUES("205","1","45","2","2","4","1","52","2020-03-17 22:27:40","2020-03-18 11:51:34");
INSERT INTO adms_nivacs_pgs VALUES("1687","1","138","2","2","4","1","307","2021-07-30 21:06:49","2021-08-01 08:56:44");
INSERT INTO adms_nivacs_pgs VALUES("212","1","46","2","2","4","1","53","2020-03-17 22:48:23","2020-03-18 11:51:31");
INSERT INTO adms_nivacs_pgs VALUES("1686","1","107","1","1","6","1","306","2021-07-30 20:57:01","2021-08-02 09:32:34");
INSERT INTO adms_nivacs_pgs VALUES("219","1","35","1","1","4","1","54","2020-03-18 10:20:58","2020-03-18 11:52:49");
INSERT INTO adms_nivacs_pgs VALUES("1685","1","137","2","2","4","1","305","2021-07-30 20:43:16","2021-08-01 08:56:44");
INSERT INTO adms_nivacs_pgs VALUES("226","1","36","1","1","4","1","55","2020-03-18 10:30:25","2020-03-18 11:52:52");
INSERT INTO adms_nivacs_pgs VALUES("1684","1","136","2","2","4","1","304","2021-07-30 20:39:40","2021-08-01 08:56:44");
INSERT INTO adms_nivacs_pgs VALUES("1683","1","135","2","2","4","1","303","2021-07-30 20:33:30","2021-08-01 08:56:48");
INSERT INTO adms_nivacs_pgs VALUES("233","1","47","1","1","4","1","56","2020-03-18 11:58:09","2020-03-18 11:58:39");
INSERT INTO adms_nivacs_pgs VALUES("1682","1","134","2","2","4","1","302","2021-07-30 20:14:56","2021-08-01 08:56:49");
INSERT INTO adms_nivacs_pgs VALUES("1279","1","85","2","2","4","1","200","2021-02-12 20:57:39","2021-07-05 11:53:53");
INSERT INTO adms_nivacs_pgs VALUES("240","1","48","2","2","4","1","57","2020-03-18 12:02:48",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1681","1","106","1","1","6","1","301","2021-07-30 20:01:49","2021-08-02 09:32:30");
INSERT INTO adms_nivacs_pgs VALUES("247","1","49","2","2","4","1","58","2020-03-18 12:05:34",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1680","1","133","2","2","4","1","300","2021-07-30 18:55:54","2021-08-01 08:56:49");
INSERT INTO adms_nivacs_pgs VALUES("254","1","50","2","2","4","1","59","2020-03-18 12:09:20",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1679","1","132","2","2","4","1","299","2021-07-30 18:48:50","2021-08-01 08:56:53");
INSERT INTO adms_nivacs_pgs VALUES("261","1","51","2","2","4","1","60","2020-03-18 12:37:51",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1678","1","131","2","2","4","1","298","2021-07-30 17:02:30","2021-08-01 08:56:53");
INSERT INTO adms_nivacs_pgs VALUES("268","1","52","2","2","4","1","61","2020-03-18 12:48:40",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1677","1","130","2","2","4","1","297","2021-07-30 14:52:23","2021-08-01 08:56:53");
INSERT INTO adms_nivacs_pgs VALUES("275","1","54","1","1","4","1","62","2020-03-18 12:57:54","2020-03-18 14:31:32");
INSERT INTO adms_nivacs_pgs VALUES("1676","1","105","1","1","6","1","296","2021-07-30 14:34:24","2021-08-02 09:32:25");
INSERT INTO adms_nivacs_pgs VALUES("282","1","55","2","2","4","1","63","2020-03-18 13:00:33","2020-03-18 14:31:11");
INSERT INTO adms_nivacs_pgs VALUES("1675","1","129","2","2","4","1","295","2021-07-30 12:49:23","2021-08-01 08:56:56");
INSERT INTO adms_nivacs_pgs VALUES("289","1","56","2","2","4","1","64","2020-03-18 13:03:18","2020-03-18 14:31:08");
INSERT INTO adms_nivacs_pgs VALUES("1674","1","128","2","2","4","1","294","2021-07-30 12:42:51","2021-08-01 08:56:56");
INSERT INTO adms_nivacs_pgs VALUES("296","1","57","2","2","4","1","65","2020-03-18 13:05:56","2020-03-18 14:31:05");
INSERT INTO adms_nivacs_pgs VALUES("1673","1","127","2","2","4","1","293","2021-07-30 12:36:47","2021-08-01 08:56:56");
INSERT INTO adms_nivacs_pgs VALUES("303","1","58","2","2","4","1","66","2020-03-18 13:09:55","2020-03-18 14:31:00");
INSERT INTO adms_nivacs_pgs VALUES("1672","1","126","2","2","4","1","292","2021-07-30 12:17:29","2021-08-01 08:57:01");
INSERT INTO adms_nivacs_pgs VALUES("310","1","59","1","1","4","1","67","2020-03-18 13:14:38","2020-03-18 14:30:56");
INSERT INTO adms_nivacs_pgs VALUES("1671","1","104","1","1","6","1","291","2021-07-30 12:06:48","2021-08-02 09:32:21");
INSERT INTO adms_nivacs_pgs VALUES("317","1","60","2","2","4","1","68","2020-03-18 13:31:32","2020-03-18 14:30:49");
INSERT INTO adms_nivacs_pgs VALUES("1670","1","125","2","2","4","1","290","2021-07-30 11:54:38","2021-08-01 08:57:01");
INSERT INTO adms_nivacs_pgs VALUES("324","1","61","2","2","4","1","69","2020-03-18 13:36:26","2020-03-18 14:30:42");
INSERT INTO adms_nivacs_pgs VALUES("1669","1","124","2","2","4","1","289","2021-07-30 11:47:03","2021-08-01 08:57:04");
INSERT INTO adms_nivacs_pgs VALUES("331","1","62","2","2","4","1","70","2020-03-18 13:40:35","2020-03-18 14:30:40");
INSERT INTO adms_nivacs_pgs VALUES("1668","1","123","2","2","4","1","288","2021-07-30 11:41:09","2021-08-01 08:57:04");
INSERT INTO adms_nivacs_pgs VALUES("338","1","63","2","2","4","1","71","2020-03-18 13:43:37","2020-03-18 14:30:38");
INSERT INTO adms_nivacs_pgs VALUES("1667","1","122","2","2","4","1","287","2021-07-30 10:25:51","2021-08-01 08:57:04");
INSERT INTO adms_nivacs_pgs VALUES("345","1","64","1","1","4","1","72","2020-03-18 13:49:00","2020-03-18 14:29:56");
INSERT INTO adms_nivacs_pgs VALUES("1666","1","103","1","1","6","1","286","2021-07-30 09:36:03","2021-08-02 09:32:10");
INSERT INTO adms_nivacs_pgs VALUES("352","1","65","2","2","4","1","73","2020-03-18 13:57:22","2020-03-18 14:29:51");
INSERT INTO adms_nivacs_pgs VALUES("1663","1","119","2","2","4","1","283","2021-07-09 14:04:59","2021-08-01 08:57:16");
INSERT INTO adms_nivacs_pgs VALUES("359","1","66","2","2","4","1","74","2020-03-18 14:00:12","2020-03-18 14:29:47");
INSERT INTO adms_nivacs_pgs VALUES("1662","1","118","2","2","4","1","282","2021-07-09 12:46:26","2021-08-01 08:57:16");
INSERT INTO adms_nivacs_pgs VALUES("366","1","67","2","2","4","1","75","2020-03-18 14:22:20","2020-03-18 14:29:45");
INSERT INTO adms_nivacs_pgs VALUES("1661","1","117","2","2","4","1","281","2021-07-09 12:31:59","2021-08-01 08:57:20");
INSERT INTO adms_nivacs_pgs VALUES("373","1","68","2","2","4","1","76","2020-03-18 14:25:26","2020-03-18 14:29:42");
INSERT INTO adms_nivacs_pgs VALUES("1660","1","86","1","1","9","1","280","2021-07-09 12:21:02","2021-07-09 14:26:48");
INSERT INTO adms_nivacs_pgs VALUES("380","1","53","1","1","4","1","77","2020-03-18 14:28:48","2020-03-18 14:31:32");
INSERT INTO adms_nivacs_pgs VALUES("1659","1","116","2","2","4","1","279","2021-07-08 16:45:50","2021-08-01 08:57:20");
INSERT INTO adms_nivacs_pgs VALUES("387","1","69","2","2","4","1","78","2020-03-18 17:44:59",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1658","1","115","2","2","4","1","278","2021-07-08 15:36:49","2021-08-01 08:57:20");
INSERT INTO adms_nivacs_pgs VALUES("394","1","70","2","2","4","1","79","2020-03-18 17:49:19",NULL);
INSERT INTO adms_nivacs_pgs VALUES("1657","1","114","2","2","4","1","277","2021-07-08 14:25:35","2021-08-01 08:57:25");
INSERT INTO adms_nivacs_pgs VALUES("1656","1","113","2","2","4","1","276","2021-07-08 14:17:43","2021-08-01 08:57:25");
INSERT INTO adms_nivacs_pgs VALUES("1655","1","102","1","1","6","1","275","2021-07-08 13:24:43","2021-08-02 09:30:46");
INSERT INTO adms_nivacs_pgs VALUES("1654","1","112","1","1","7","1","274","2021-07-06 11:34:57","2021-08-01 08:57:33");
INSERT INTO adms_nivacs_pgs VALUES("929","1","79","2","2","4","1","8","2021-01-25 19:25:37","2021-07-04 15:01:30");
INSERT INTO adms_nivacs_pgs VALUES("928","1","78","2","2","4","1","7","2021-01-25 19:25:37","2021-07-04 15:01:30");
INSERT INTO adms_nivacs_pgs VALUES("927","1","77","2","2","4","1","6","2021-01-25 19:25:37","2021-07-04 15:01:30");
INSERT INTO adms_nivacs_pgs VALUES("926","1","76","2","2","4","1","3","2021-01-25 19:25:37","2021-07-04 15:01:30");
INSERT INTO adms_nivacs_pgs VALUES("1653","1","100","2","2","4","1","273","2021-07-05 20:39:47","2021-07-30 10:20:09");
INSERT INTO adms_nivacs_pgs VALUES("1652","1","101","2","2","4","1","272","2021-07-05 19:55:59","2021-07-30 10:20:09");
INSERT INTO adms_nivacs_pgs VALUES("1651","1","99","2","2","4","1","271","2021-07-05 18:46:39","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("1650","1","98","2","2","4","1","270","2021-07-05 18:41:20","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("1649","1","97","1","1","7","1","269","2021-07-05 18:27:48","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("1237","1","84","2","2","4","1","186","2021-02-09 11:04:17","2021-07-05 11:53:55");
INSERT INTO adms_nivacs_pgs VALUES("1648","1","96","2","2","4","1","268","2021-07-05 18:08:53","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("1225","1","83","2","2","4","1","182","2021-02-08 20:34:16","2021-07-05 11:53:59");
INSERT INTO adms_nivacs_pgs VALUES("1647","1","95","2","2","4","1","267","2021-07-05 17:30:04","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("1151","1","81","1","1","9","1","168","2021-02-05 19:04:11","2021-07-06 06:37:56");
INSERT INTO adms_nivacs_pgs VALUES("1646","1","94","2","2","4","1","266","2021-07-05 17:19:22","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("1158","1","82","2","2","4","1","169","2021-02-05 22:04:53","2021-07-05 11:54:02");
INSERT INTO adms_nivacs_pgs VALUES("1664","1","120","2","2","4","1","284","2021-07-13 06:56:41","2021-08-01 08:57:15");
INSERT INTO adms_nivacs_pgs VALUES("1645","1","93","2","2","4","1","265","2021-07-05 17:10:17","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("891","1","71","1","1","4","1","150","2020-03-21 23:04:26","2021-07-04 15:01:30");
INSERT INTO adms_nivacs_pgs VALUES("1644","1","92","1","1","7","1","264","2021-07-05 13:09:30","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("898","1","72","1","1","4","1","151","2020-03-23 20:58:03","2021-07-04 15:01:30");
INSERT INTO adms_nivacs_pgs VALUES("1643","1","91","2","2","4","1","263","2021-07-04 20:54:01","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("1642","1","90","2","2","4","1","262","2021-07-04 20:48:19","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("905","1","73","2","2","4","1","152","2020-03-24 13:21:34","2021-07-04 15:01:30");
INSERT INTO adms_nivacs_pgs VALUES("1641","1","89","2","2","4","1","261","2021-07-04 20:33:50","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("1665","1","121","2","2","4","1","285","2021-07-13 06:57:46","2021-08-01 08:57:06");
INSERT INTO adms_nivacs_pgs VALUES("912","1","74","2","2","4","1","153","2020-03-24 14:30:55","2021-07-04 15:01:30");
INSERT INTO adms_nivacs_pgs VALUES("1640","1","88","2","2","4","1","260","2021-07-04 20:26:56","2021-07-09 14:28:08");
INSERT INTO adms_nivacs_pgs VALUES("919","1","75","2","2","4","1","154","2020-03-25 20:00:54","2021-07-04 15:01:30");
INSERT INTO adms_nivacs_pgs VALUES("1639","1","80","1","1","9","1","259","2021-07-04 20:17:49","2021-07-06 06:37:44");


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
) ENGINE=MyISAM AUTO_INCREMENT=347 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

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
INSERT INTO adms_paginas VALUES("332","CadastrarConta","cadConta","cadastrar-conta","cad-conta","Cadastrar Conta","Página para Cadastrar uma nova Conta                                ","2",NULL,"2","5","1","2021-08-02 11:08:26","2021-08-02 11:55:35");
INSERT INTO adms_paginas VALUES("307","CadastrarContaEducacao","cadConta","cadastrar-conta-educacao","cad-conta","Cadastrar Conta Educacao","Página para Cadastrar Conta Educacao","2",NULL,"2","5","1","2021-07-30 21:06:49",NULL);
INSERT INTO adms_paginas VALUES("308","ApagarContaEducacao","apagarConta","apagar-conta-educacao","apagar-conta","Apagar Conta Educacao","Página para Apagar Conta Educação","2",NULL,"4","5","1","2021-07-30 21:19:37",NULL);
INSERT INTO adms_paginas VALUES("309","VerContaEducacao","verConta","ver-conta-educacao","ver-conta","Ver Conta Educacao","Página para Ver Conta Educação","2",NULL,"5","5","1","2021-07-30 21:24:55",NULL);
INSERT INTO adms_paginas VALUES("310","EditarContaEducacao","editConta","editar-conta-educacao","edit-conta","Editar Conta Educacao","Página para Editar Conta Educação","2",NULL,"3","5","1","2021-07-30 21:31:26",NULL);
INSERT INTO adms_paginas VALUES("311","ContaLoja","listar","conta-loja","listar","Conta Loja","Página para Conta Loja                                                ","2","fas fa-gifts","1","5","1","2021-07-31 17:41:48","2021-07-31 17:45:46");
INSERT INTO adms_paginas VALUES("312","CadastrarContaLoja","cadConta","cadastrar-conta-loja","cad-conta","Cadastrar Conta Loja","página para Cadastrar Conta Loja","2",NULL,"2","5","1","2021-07-31 17:51:44",NULL);
INSERT INTO adms_paginas VALUES("313","ApagarContaLoja","apagarConta","apagar-conta-loja","apagar-conta","Apagar Conta Loja","Página para Apagar Conta Loja","2",NULL,"4","5","1","2021-07-31 18:36:31",NULL);
INSERT INTO adms_paginas VALUES("314","VerContaLoja","verConta","ver-conta-loja","ver-conta","Ver Conta Loja","Página para Ver Conta Loja","2",NULL,"5","5","1","2021-07-31 18:41:13",NULL);
INSERT INTO adms_paginas VALUES("281","ApagarSaldo","apagarSaldo","apagar-saldo","apagar-saldo","Apagar Saldo","Página para Apagar Saldo","2",NULL,"4","5","1","2021-07-09 12:31:59",NULL);
INSERT INTO adms_paginas VALUES("282","CadastrarSaldo","cadSaldo","cadastrar-saldo","cad-saldo","Cadastrar Saldo","Página para Cadastrar Saldo","2",NULL,"2","5","1","2021-07-09 12:46:26",NULL);
INSERT INTO adms_paginas VALUES("283","EditarSaldo","editSaldo","editar-saldo","edit-saldo","Editar Saldo","Página para Editar Saldo","2",NULL,"3","5","1","2021-07-09 14:04:59",NULL);
INSERT INTO adms_paginas VALUES("288","ApagarContaCombustivel","apagarConta","apagar-conta-combustivel","apagar-conta","Apagar Conta Combustivel","Página para Apagar Conta Combustível","2",NULL,"4","5","1","2021-07-30 11:41:09",NULL);
INSERT INTO adms_paginas VALUES("289","VerContaCombustivel","verConta","ver-conta-combustivel","ver-conta","Ver Conta Combustivel","Página para Ver Conta Combustível","2",NULL,"5","5","1","2021-07-30 11:47:03",NULL);
INSERT INTO adms_paginas VALUES("290","EditarContaCombustivel","editConta","editar-conta-combustivel","edit-conta","Editar Conta Combustivel","Página para Editar Conta Combustível","2",NULL,"3","5","1","2021-07-30 11:54:38",NULL);
INSERT INTO adms_paginas VALUES("291","ContaEnergia","listar","conta-energia","listar","Conta Energia","Página para Conta Energia                ","2","fas fa-lightbulb","1","5","1","2021-07-30 12:06:48","2021-07-30 12:08:00");
INSERT INTO adms_paginas VALUES("292","CadastrarContaEnergia","cadConta","cadastrar-conta-energia","cad-conta","Cadastrar Conta Energia","página para Cadastrar Conta Energia","2",NULL,"2","5","1","2021-07-30 12:17:29",NULL);
INSERT INTO adms_paginas VALUES("293","ApagarContaEnergia","apagarConta","apagar-conta-energia","apagar-conta","Apagar Conta Energia","página para Apagar Conta Energia","2",NULL,"4","5","1","2021-07-30 12:36:47",NULL);
INSERT INTO adms_paginas VALUES("294","VerContaEnergia","verConta","ver-conta-energia","ver-conta","Ver Conta Energia","Página para Ver Conta Energia","2",NULL,"5","5","1","2021-07-30 12:42:51",NULL);
INSERT INTO adms_paginas VALUES("295","EditarContaEnergia","editConta","editar-conta-energia","edit-conta","Editar Conta Energia","Página para Editar Conta Energia","2",NULL,"3","5","1","2021-07-30 12:49:23",NULL);
INSERT INTO adms_paginas VALUES("296","ContaInformatica","listar","conta-informatica","listar","Conta Informatica","Página para Conta Informática                ","2","fas fa-desktop","1","5","1","2021-07-30 14:34:24","2021-07-30 14:36:06");
INSERT INTO adms_paginas VALUES("297","CadastrarContaInformatica","cadConta","cadastrar-conta-informatica","cad-conta","Cadastrar Conta Informatica","Página para Cadastrar Conta Informática","2",NULL,"2","5","1","2021-07-30 14:52:23",NULL);
INSERT INTO adms_paginas VALUES("168","Descricao","listar","descricao","listar","Descricao","Página para listar Descricao                ","2","fas fa-list","1","5","1","2021-02-05 19:04:11","2021-07-09 14:24:51");
INSERT INTO adms_paginas VALUES("169","CadastrarDescricao","cadDescricao","cadastrar-descricao","cad-descricao","Cadastrar Descricao","Página para cadastrar uma nova Descricao","2","fas fa-book","2","5","1","2021-02-05 22:04:53","2021-07-04 15:37:58");
INSERT INTO adms_paginas VALUES("301","ContaSaude","listar","conta-saude","listar","Conta Saude","página para Conta Saúde                ","2","fas fa-medkit","1","5","1","2021-07-30 20:01:49","2021-07-30 20:17:06");
INSERT INTO adms_paginas VALUES("302","CadastrarContaSaude","cadConta","cadastrar-conta-saude","cad-conta","Cadastrar Conta Saude","Página para Cadastrar Conta Saúde","2",NULL,"2","5","1","2021-07-30 20:14:56",NULL);
INSERT INTO adms_paginas VALUES("303","VerContaSaude","verConta","ver-conta-saude","ver-conta","Ver Conta Saude","Página para Ver Conta Saúde","2",NULL,"5","5","1","2021-07-30 20:33:30",NULL);
INSERT INTO adms_paginas VALUES("304","EditarContaSaude","editConta","editar-conta-saude","edit-conta","Editar Conta Saude","Página para Editar Conta Saúde","2",NULL,"3","5","1","2021-07-30 20:39:40",NULL);
INSERT INTO adms_paginas VALUES("305","ApagarContaSaude","apagarConta","apagar-conta-saude","apagar-conta","Apagar Conta Saude","Página para Apagar Conta Saude","2",NULL,"4","5","1","2021-07-30 20:43:16",NULL);
INSERT INTO adms_paginas VALUES("306","ContaEducacao","listar","conta-educacao","listar","Conta Educacao","Página para Conta Educacao                                ","2","fas fa-user-graduate","1","5","1","2021-07-30 20:57:01","2021-07-30 21:00:10");
INSERT INTO adms_paginas VALUES("298","ApagarContaInformatica","apagarConta","apagar-conta-informatica","apagar-conta","Apagar Conta Informatica","Página para Apagar Conta Informática","2",NULL,"4","5","1","2021-07-30 17:02:30",NULL);
INSERT INTO adms_paginas VALUES("299","VerContaInformatica","verConta","ver-conta-informatica","ver-conta","Ver Conta Informatica","Página para Ver Conta Informática","2",NULL,"5","5","1","2021-07-30 18:48:50",NULL);
INSERT INTO adms_paginas VALUES("300","EditarContaInformatica","editConta","editar-conta-informatica","edit-conta","Editar Conta Informatica","Página para Editar Conta Informática","2",NULL,"3","5","1","2021-07-30 18:55:54",NULL);
INSERT INTO adms_paginas VALUES("182","VerDescricao","verDescricao","ver-descricao","ver-descricao","Ver Descricao","Página para visualizar Descricao","2",NULL,"5","5","1","2021-02-08 20:34:16","2021-07-04 16:20:57");
INSERT INTO adms_paginas VALUES("279","EditarContaMercado","editConta","editar-conta-mercado","edit-conta","Editar Conta Mercado","Página para Editar Conta Mercado","2",NULL,"3","5","1","2021-07-08 16:45:50",NULL);
INSERT INTO adms_paginas VALUES("280","Saldo","listar","saldo","listar","Saldo","Página para listar Saldo                                                                                                                                                                                ","2","fas fa-money-bill-alt","1","5","1","2021-07-09 12:21:02","2021-07-09 12:26:16");
INSERT INTO adms_paginas VALUES("186","EditarDescricao","editDescricao","editar-descricao","edit-descricao","Editar Descricao","página para editar Descricao","2",NULL,"3","5","1","2021-02-09 11:04:17","2021-07-04 16:29:10");
INSERT INTO adms_paginas VALUES("267","EditarEntrada","editEntrada","editar-entrada","edit-entrada","Editar Entrada","Página para Editar Entrada","2",NULL,"3","5","1","2021-07-05 17:30:04",NULL);
INSERT INTO adms_paginas VALUES("268","ApagarEntrada","apagarEntrada","apagar-entrada","apagar-entrada","Apagar Entrada","Página para Apagar Entrada","2",NULL,"4","5","1","2021-07-05 18:08:53",NULL);
INSERT INTO adms_paginas VALUES("269","Saida","listar","saida","listar","Saídas","Página para listar saídas                ","2","fas fa-dollar-sign","1","5","1","2021-07-05 18:27:48","2021-07-05 18:29:15");
INSERT INTO adms_paginas VALUES("270","VerSaida","verSaida","ver-saida","ver-saida","Ver Saida","Página para Ver Saida","2",NULL,"5","5","1","2021-07-05 18:41:20",NULL);
INSERT INTO adms_paginas VALUES("271","CadastrarSaida","cadSaida","cadastrar-saida","cad-saida","Cadastrar Saida","Página para Cadastrar Saida","2",NULL,"2","5","1","2021-07-05 18:46:39",NULL);
INSERT INTO adms_paginas VALUES("272","EditarSaida","editSaida","editar-saida","edit-saida","Editar Saida","Página para Editar Saida","2",NULL,"3","5","1","2021-07-05 19:55:59",NULL);
INSERT INTO adms_paginas VALUES("273","ApagarSaida","apagarSaida","apagar-saida","apagar-saida","Apagar Saida","Página para Apagar Saída","2",NULL,"4","5","1","2021-07-05 20:39:47",NULL);
INSERT INTO adms_paginas VALUES("274","RelatorioMensal","listar","relatorio-mensal","listar","Relatorio Mensal","Página para listar Relatório Mensal                                                ","2","fas fa-balance-scale","1","5","1","2021-07-06 11:34:57","2021-07-09 14:23:55");
INSERT INTO adms_paginas VALUES("275","ContaMercado","listar","conta-mercado","listar","Conta Mercado","Página para listar Conta Mercado                ","2","fas fa-money-bill-alt","1","5","1","2021-07-08 13:24:43","2021-07-09 14:21:17");
INSERT INTO adms_paginas VALUES("276","VerContaMercado","verConta","ver-conta-mercado","ver-conta","Ver Conta Mercado","Página para Ver Conta Mercado","2",NULL,"5","5","1","2021-07-08 14:17:43",NULL);
INSERT INTO adms_paginas VALUES("277","ApagarContaMercado","apagarConta","apagar-conta-mercado","apagar-conta","Apagar Conta Mercado","Página para Apagar Conta Mercado","2",NULL,"4","5","1","2021-07-08 14:25:35",NULL);
INSERT INTO adms_paginas VALUES("278","CadastrarContaMercado","cadConta","cadastrar-conta-mercado","cad-conta","Cadastrar Conta Mercado","Página para Cadastrar Conta Mercado","2",NULL,"2","5","1","2021-07-08 15:36:49",NULL);
INSERT INTO adms_paginas VALUES("200","ApagarDescricao","apagarDescricao","apagar-descricao","apagar-descricao","Apagar Descricao","Página para apagar uma Descricao","2",NULL,"4","5","1","2021-02-12 20:57:39","2021-07-04 16:43:32");
INSERT INTO adms_paginas VALUES("259","Categoria","listar","categoria","listar","Categoria","Página para listar as categorias                                                ","2","fas fa-list","1","5","1","2021-07-04 20:17:49","2021-07-09 14:24:35");
INSERT INTO adms_paginas VALUES("260","VerCategoria","verCategoria","ver-categoria","ver-categoria","Ver Categoria","Página para ver uma Categoria","2",NULL,"5","5","1","2021-07-04 20:26:56",NULL);
INSERT INTO adms_paginas VALUES("261","CadastrarCategoria","cadCategoria","cadastrar-categoria","cad-categoria","Cadastrar Categoria","Página para cadastrar uma Categoria","2",NULL,"2","5","1","2021-07-04 20:33:50",NULL);
INSERT INTO adms_paginas VALUES("262","ApagarCategoria","apagarCategoria","apagar-categoria","apagar-categoria","Apagar Categoria","página para Apagar Categoria","2",NULL,"4","5","1","2021-07-04 20:48:19",NULL);
INSERT INTO adms_paginas VALUES("263","EditarCategoria","editCategoria","editar-categoria","edit-categoria","Editar Categoria","Página para Editar uma Categoria","2",NULL,"3","5","1","2021-07-04 20:54:01",NULL);
INSERT INTO adms_paginas VALUES("264","Entrada","listar","entrada","listar","Entradas","Página para Entrada                                                                ","2","fas fa-dollar-sign","1","5","1","2021-07-05 13:09:30","2021-07-05 18:26:41");
INSERT INTO adms_paginas VALUES("265","VerEntrada","verEntrada","ver-entrada","ver-entrada","Ver Entrada","Pagina para Ver Entrada","2",NULL,"5","5","1","2021-07-05 17:10:17",NULL);
INSERT INTO adms_paginas VALUES("266","CadastrarEntrada","cadEntrada","cadastrar-entrada","cad-entrada","Cadastrar Entrada","Página para Cadastrar Entrada","2",NULL,"2","5","1","2021-07-05 17:19:22",NULL);
INSERT INTO adms_paginas VALUES("150","PesqUsuarios","listar","pesq-usuarios","listar","Pesquisar Usuários JS","Página para pesquisar usuários                                                ","2","fas fa-users","11","6","1","2020-03-21 23:04:26","2021-01-29 23:21:12");
INSERT INTO adms_paginas VALUES("151","CarregarUsuariosJs","listar","carregar-usuarios-js","listar","Usuários com JS","Listar usuários com JS - complementos","2","fas fa-users","1","6","1","2020-03-23 20:58:03",NULL);
INSERT INTO adms_paginas VALUES("152","VerUsuarioModal","verUsuario","ver-usuario-modal","ver-usuario","Ver Usuario Modal","Ver Usuário Modal","2",NULL,"5","6","1","2020-03-24 13:21:34",NULL);
INSERT INTO adms_paginas VALUES("153","CadastrarUsuarioModal","cadUsuario","cadastrar-usuario-modal","cad-usuario","Cadastrar Usuario Modal","Cadastrar usuário com janela modal","2",NULL,"2","6","1","2020-03-24 14:30:55",NULL);
INSERT INTO adms_paginas VALUES("154","ApagarUsuarioModal","apagarUsuario","apagar-usuario-modal","apagar-usuario","Apagar Usuario Modal","Apagar Usuário Modal","2",NULL,"4","6","1","2020-03-25 20:00:54",NULL);
INSERT INTO adms_paginas VALUES("333","ApagarConta","apagarConta","apagar-conta","apagar-conta","Apagar Conta","Página para Apagar Conta","2",NULL,"4","5","1","2021-08-02 12:10:17",NULL);
INSERT INTO adms_paginas VALUES("334","GerarConta","gerar","gerar-conta","gerar","Gerar Conta","página para Gerar Conta","2",NULL,"6","5","1","2021-08-02 12:16:09",NULL);
INSERT INTO adms_paginas VALUES("315","EditarContaLoja","editConta","editar-conta-loja","edit-conta","Editar Conta Loja","Página para Editar Conta Loja","2",NULL,"3","5","1","2021-07-31 19:22:15",NULL);
INSERT INTO adms_paginas VALUES("316","ContaFone","listar","conta-fone","listar","Conta Telefone","Página para Conta Fone                                ","2","fas fa-phone","1","5","1","2021-07-31 21:54:09","2021-08-02 09:34:08");
INSERT INTO adms_paginas VALUES("317","CadastrarContaFone","cadConta","cadastrar-conta-fone","cad-conta","Cadastrar Conta Fone","Página para Cadastrar Conta Fone                ","2",NULL,"2","5","1","2021-07-31 21:58:53","2021-07-31 21:59:24");
INSERT INTO adms_paginas VALUES("318","ContaMecanica","listar","conta-mecanica","listar","Conta Mecanica","Página para Conta Mecânica","2","fas fa-car","1","5","1","2021-07-31 22:30:13",NULL);
INSERT INTO adms_paginas VALUES("319","ApagarContaFone","apagarConta","apagar-conta-fone","apagar-conta","Apagar Conta Fone","página para Apagar Conta Fone","2",NULL,"4","5","1","2021-07-31 22:38:28",NULL);
INSERT INTO adms_paginas VALUES("320","VerContaFone","verConta","ver-conta-fone","ver-conta","Ver Conta Fone","Página para Ver Conta Fone","2",NULL,"5","5","1","2021-07-31 22:44:12",NULL);
INSERT INTO adms_paginas VALUES("321","EditarContaFone","editConta","editar-conta-fone","edit-conta","Editar Conta Fone","Página para Editar Conta Fone","2",NULL,"3","5","1","2021-07-31 22:50:40",NULL);
INSERT INTO adms_paginas VALUES("322","CadastrarContaMecanica","cadConta","cadastrar-conta-mecanica","cad-conta","Cadastrar Conta Mecanica","Página para Cadastrar Conta Mecânica","2",NULL,"2","5","1","2021-07-31 22:56:28",NULL);
INSERT INTO adms_paginas VALUES("323","ApagarContaMecanica","apagarConta","apagar-conta-mecanica","apagar-conta","Apagar Conta Mecanica","Página para Apagar Conta Mecânica","2",NULL,"4","5","1","2021-08-01 08:29:05",NULL);
INSERT INTO adms_paginas VALUES("324","VerContaMecanica","verConta","ver-conta-mecanica","ver-conta","Ver Conta Mecanica","Página para Ver Conta Mecânica","2",NULL,"5","5","1","2021-08-01 08:35:47",NULL);
INSERT INTO adms_paginas VALUES("325","EditarContaMecanica","editConta","editar-conta-mecanica","edit-conta","Editar Conta Mecanica","Página para Editar Conta Mecânica","2",NULL,"3","5","1","2021-08-01 08:42:24",NULL);
INSERT INTO adms_paginas VALUES("326","ContaAgropecuaria","listar","conta-agropecuaria","listar","Conta Agropecuaria","Página para Conta Agropecuária","2","fas fa-tractor","1","5","1","2021-08-01 08:54:29",NULL);
INSERT INTO adms_paginas VALUES("327","CadastrarContaAgropecuaria","cadConta","cadastrar-conta-agropecuaria","cad-conta","Cadastrar Conta Agropecuaria","Página para Cadastrar Conta Agropecuária","2",NULL,"2","5","1","2021-08-01 12:32:36",NULL);
INSERT INTO adms_paginas VALUES("328","ApagarContaAgropecuaria","apagarConta","apagar-conta-agropecuaria","apagar-conta","Apagar Conta Agropecuaria","Página para Apagar Conta Agropecuária","2",NULL,"4","5","1","2021-08-01 19:06:37",NULL);
INSERT INTO adms_paginas VALUES("329","VerContaAgropecuaria","verConta","ver-conta-agropecuaria","ver-conta","Ver Conta Agropecuaria","Página para Ver Conta Agropecuária","2",NULL,"5","5","1","2021-08-01 19:08:16",NULL);
INSERT INTO adms_paginas VALUES("330","EditarContaAgropecuaria","editConta","editar-conta-agropecuaria","edit-conta","Editar Conta Agropecuaria","Página para Editar Conta Agropecuária","2",NULL,"3","5","1","2021-08-01 19:09:42",NULL);
INSERT INTO adms_paginas VALUES("331","Contas","listar","contas","listar","Contas","Página para Contas                                                                ","2","fas fa-dollar-sign","1","5","1","2021-08-02 10:24:55","2021-08-02 11:55:13");
INSERT INTO adms_paginas VALUES("287","CadastrarContaCombustivel","cadConta","cadastrar-conta-combustivel","cad-conta","Cadastrar Conta Combustivel","página para Cadastrar Conta Combustível                ","2",NULL,"2","5","1","2021-07-30 10:25:51","2021-07-30 10:39:44");
INSERT INTO adms_paginas VALUES("284","VerTipoPg","verTipoPg","ver-tipo-pg","ver-tipo-pg","Ver Tipo de Página","Página para Ver Tipo de Página","2",NULL,"5","1","1","2021-07-13 06:56:41",NULL);
INSERT INTO adms_paginas VALUES("285","ApagarTipoPg","apagarTipoPg","apagar-tipo-pg","apagar-tipo-pg","Apagar Tipo Página","página para Apagar Tipo Página","2",NULL,"4","1","1","2021-07-13 06:57:46",NULL);
INSERT INTO adms_paginas VALUES("286","ContaCombustivel","listar","conta-combustivel","listar","Conta Combustivel","Página para Conta Combustível ","2","fas fa-gas-pump","1","5","1","2021-07-30 09:36:03","2021-07-30 09:45:01");
INSERT INTO adms_paginas VALUES("249","Backup","backup","backup","backup","Backup","Página para fazer backup                ","2","fas fa-shield-alt","6","5","1","2021-04-02 10:01:56","2021-04-04 06:50:09");
INSERT INTO adms_paginas VALUES("337","ContaBanco","listar","conta-banco","listar","Conta Banco","Página para Listar Conta Banco","2","fas fa-at","1","5","1","2021-08-04 14:39:18",NULL);
INSERT INTO adms_paginas VALUES("338","ApagarContaBanco","apagarConta","apagar-conta-banco","apagar-conta","Apagar Conta Banco","Página para Apagar Conta Banco","2",NULL,"4","5","1","2021-08-04 15:11:10",NULL);
INSERT INTO adms_paginas VALUES("339","CadastrarContaBanco","cadConta","cadastrar-conta-banco","cad-conta","Cadastrar Conta Banco","Página para Cadastrar Conta Banco","2",NULL,"2","5","1","2021-08-04 19:06:47","2021-08-04 19:09:41");
INSERT INTO adms_paginas VALUES("340","EditarContaBanco","editConta","editar-conta-banco","edit-conta","Editar Conta Banco","Página para Editar Conta Banco","2",NULL,"3","5","1","2021-08-04 19:39:36",NULL);
INSERT INTO adms_paginas VALUES("341","VerContaBanco","verConta","ver-conta-banco","ver-conta","Ver Conta Banco","Página para Vizualizar Conta Banco","2",NULL,"5","5","1","2021-08-04 20:00:50",NULL);
INSERT INTO adms_paginas VALUES("342","ContaSocial","listar","conta-social","listar","Conta Social","Página para Listar Conta Social","2","fas fa-at","1","5","1","2021-08-05 10:16:55",NULL);
INSERT INTO adms_paginas VALUES("343","ApagarContaSocial","apagarConta","apagar-conta-social","apagar-conta","Apagar Conta Social","Página para Apagar Conta Social","2",NULL,"4","5","1","2021-08-05 10:16:55",NULL);
INSERT INTO adms_paginas VALUES("344","CadastrarContaSocial","cadConta","cadastrar-conta-social","cad-conta","Cadastrar Conta Social","Página para Cadastrar Conta Social","2",NULL,"2","5","1","2021-08-05 10:16:55",NULL);
INSERT INTO adms_paginas VALUES("345","EditarContaSocial","editConta","editar-conta-social","edit-conta","Editar Conta Social","Página para Editar Conta Social","2",NULL,"3","5","1","2021-08-05 10:16:55",NULL);
INSERT INTO adms_paginas VALUES("346","VerContaSocial","verConta","ver-conta-social","ver-conta","Ver Conta Social","Página para Vizualizar Conta Social","2",NULL,"5","5","1","2021-08-05 10:16:55",NULL);


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
INSERT INTO adms_tps_pgs VALUES("5","cx","Adminstrativo do caixa","Projeto para administrar o fluxo de caixa","2","2020-03-18 23:22:41","2021-07-04 14:41:37");
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

INSERT INTO adms_usuarios VALUES("1","SuperAdmininstrador","Admin","thmazzola@gmail.com","admin","$2y$10$dBd.b8qvGFoRwuAT4Tu5HeWS/WmGM5M63T08wKyj8XSdVEU3V.zoe",NULL,NULL,NULL,"tuxadmin.jpeg","1","1","2020-02-04 17:45:19","2021-07-04 12:31:32");
INSERT INTO adms_usuarios VALUES("4","Edio Mazera","Edio","mazera3@gmail.com","mazera","$2y$10$3f/tqTBJOhul0XV19VmTgeZ/csPXsbCL87gUI8IMtYHrYJWwFBr0a",NULL,NULL,NULL,"user.png","1","1","2020-02-25 20:13:47","2021-07-04 15:03:43");


DROP TABLE IF EXISTS cx_categoria;


CREATE TABLE `cx_categoria` (
  `id_cat` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `categoria` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cod_cat` int DEFAULT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_categoria VALUES("1","2021-07-04 18:10:34","2021-07-31 22:10:48","Telefone","1");
INSERT INTO cx_categoria VALUES("2","2021-07-04 18:35:41","2021-07-04 20:54:18","Salário","2");
INSERT INTO cx_categoria VALUES("4","2021-07-04 20:35:59",NULL,"Energia","4");
INSERT INTO cx_categoria VALUES("5","2021-07-04 20:36:19",NULL,"Lojas","5");
INSERT INTO cx_categoria VALUES("6","2021-07-04 20:36:31","2021-07-04 20:54:32","Agropecuárias","6");
INSERT INTO cx_categoria VALUES("7","2021-07-04 20:36:41",NULL,"Impostos","7");
INSERT INTO cx_categoria VALUES("8","2021-07-05 11:52:59",NULL,"Mercados","8");
INSERT INTO cx_categoria VALUES("9","2021-07-05 11:55:16","2021-08-01 08:50:10","Bancos","9");
INSERT INTO cx_categoria VALUES("10","2021-07-06 16:59:48",NULL,"Dinheiro","10");
INSERT INTO cx_categoria VALUES("11","2021-07-06 17:11:10",NULL,"Combustível","11");
INSERT INTO cx_categoria VALUES("12","2021-07-06 17:14:07",NULL,"Informática","12");
INSERT INTO cx_categoria VALUES("14","2021-07-06 21:08:54","2021-07-30 20:54:39","Educação","14");
INSERT INTO cx_categoria VALUES("15","2021-07-08 11:00:10",NULL,"Mecânica","15");
INSERT INTO cx_categoria VALUES("16","2021-07-19 20:34:53",NULL,"Saúde","16");
INSERT INTO cx_categoria VALUES("34","2021-08-04 14:33:51",NULL,"Banco","17");
INSERT INTO cx_categoria VALUES("42","2021-08-05 10:16:55",NULL,"Social","18");


DROP TABLE IF EXISTS cx_conta_agropecuaria;


CREATE TABLE `cx_conta_agropecuaria` (
  `id_agr` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `valor` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `codigo` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimento` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_agr`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_conta_agropecuaria VALUES("1","2021-08-01 12:34:00",NULL,"528.5","7","2021",NULL,"Agropecuária Popular","2021-07-01","1");
INSERT INTO cx_conta_agropecuaria VALUES("2","2021-08-01 12:35:30","2021-08-01 19:11:43","361.9","8","2021","555645","Agropecuária Popular","2021-08-01","1");


DROP TABLE IF EXISTS cx_conta_banco;


CREATE TABLE `cx_conta_banco` (
  `id_ban` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `valor` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `codigo` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimento` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ban`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_conta_banco VALUES("2","2021-08-04 19:23:21","2021-08-05 10:06:38","22.5","7","2021","841861201332624","Tarifas BB","2021-07-05","1");


DROP TABLE IF EXISTS cx_conta_combustivel;


CREATE TABLE `cx_conta_combustivel` (
  `id_comb` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `valor` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `codigo` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimento` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_comb`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_conta_combustivel VALUES("2","2021-07-30 10:45:35","2021-07-31 19:59:51","129.99","7","2021","811848","25L de gasolina - Ipanema","2021-07-29","1");
INSERT INTO cx_conta_combustivel VALUES("3","2021-07-30 10:50:02","2021-07-31 19:57:09","51.34","7","2021",NULL,"Gasolina + álcool - Roçadeira","2021-07-27","1");
INSERT INTO cx_conta_combustivel VALUES("4","2021-07-30 10:51:06","2021-07-31 19:57:47","100","7","2021",NULL,"Gasolina - Herik - Brusque","2021-07-17","1");
INSERT INTO cx_conta_combustivel VALUES("5","2021-07-30 10:51:42","2021-07-31 19:58:47","150","7","2021","533861","Gasolina+óleo - Ipanema","2021-07-13","1");
INSERT INTO cx_conta_combustivel VALUES("6","2021-07-30 10:52:32","2021-07-31 19:57:34","103.56","7","2021","261770","Gasolina - Ipanema","2021-07-05","1");


DROP TABLE IF EXISTS cx_conta_educacao;


CREATE TABLE `cx_conta_educacao` (
  `id_edu` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `valor` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `codigo` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimento` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_edu`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_conta_educacao VALUES("1","2021-07-30 21:11:15","2021-07-30 21:31:37","198","7","2021",NULL,"Funcional: Helena, Joana e Marcos","2021-07-06","1");
INSERT INTO cx_conta_educacao VALUES("2","2021-07-30 21:12:10","2021-07-31 20:17:45","60","7","2021",NULL,"Bilhetes - escola","2021-07-19","1");
INSERT INTO cx_conta_educacao VALUES("3","2021-07-30 21:13:09",NULL,"15","7","2021",NULL,"Doação Câncer","2021-07-23","1");
INSERT INTO cx_conta_educacao VALUES("5","2021-08-03 20:36:09",NULL,"52.64","8","2021","23793380296098313002696006333304287040000005264","Sensor De Umidade E Temperatura Dht11","2021-08-03","1");
INSERT INTO cx_conta_educacao VALUES("6","2021-08-04 20:22:29",NULL,"198","8","2021",NULL,"Funcional","2021-08-02","1");


DROP TABLE IF EXISTS cx_conta_energia;


CREATE TABLE `cx_conta_energia` (
  `id_ene` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `valor` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `codigo` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimento` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ene`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_conta_energia VALUES("1","2021-07-30 12:18:33","2021-07-31 20:02:11","333.23","7","2021","836500000036332301620008001010202172384204212508","Energia Elétrica","2021-07-11","1");
INSERT INTO cx_conta_energia VALUES("2","2021-07-30 12:20:04","2021-07-30 14:01:04","100","7","2021",NULL,"Gás - Caminhão","2021-07-24","1");
INSERT INTO cx_conta_energia VALUES("3","2021-07-30 12:20:39","2021-07-30 14:00:18","90","7","2021",NULL,"Gás - Mercadinho","2021-07-27","1");


DROP TABLE IF EXISTS cx_conta_fone;


CREATE TABLE `cx_conta_fone` (
  `id_fon` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `valor` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `codigo` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimento` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_fon`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_conta_fone VALUES("1","2021-07-31 22:03:08",NULL,"17.25","7","2021","846800000008172500207110145113202108701107003231","BRASIL TELECOM (PR)","2021-07-08","1");
INSERT INTO cx_conta_fone VALUES("2","2021-07-31 22:04:32",NULL,"20","7","2021","147806","Manutenção - ConectCell - Joana","2021-07-05","1");
INSERT INTO cx_conta_fone VALUES("3","2021-07-31 22:14:33","2021-07-31 22:51:02","20.08","8","2021","846800000008200800207116145113202108801101003235","Oi Fixo - BRASIL TELECOM (PR)","2021-08-05","1");


DROP TABLE IF EXISTS cx_conta_informatica;


CREATE TABLE `cx_conta_informatica` (
  `id_inf` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `valor` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `codigo` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimento` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_inf`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_conta_informatica VALUES("2","2021-07-30 16:51:47",NULL,"100","7","2021","127641","GIGA MAIS INFORMATICA","2021-07-05","1");
INSERT INTO cx_conta_informatica VALUES("3","2021-07-30 16:53:40",NULL,"80","7","2021","23792030099000029922373001040002986720000008000","Mirix Telecomunicações - Neorede","2021-07-05","1");
INSERT INTO cx_conta_informatica VALUES("4","2021-07-30 16:55:23","2021-07-31 20:14:45","34.14","7","2021","34191092220847263719172734800005686600000003414","Hostgator Hospedagem - nead.pro.br","2021-07-23","1");
INSERT INTO cx_conta_informatica VALUES("5","2021-07-30 16:57:00",NULL,"150","7","2021","787062","GIGA MAIS INFORMATIC","2021-07-01","1");
INSERT INTO cx_conta_informatica VALUES("6","2021-07-30 17:07:19","2021-07-31 20:14:18","424","8","2021","00190000090155102800200003623170486990000035000","Computador Marcos: Gabinete + acessórios","2021-08-01","1");
INSERT INTO cx_conta_informatica VALUES("7","2021-07-30 17:09:27","2021-07-30 18:56:59","80","8","2021","23792030099000029922374001040000487030000008000","Mirix Telecomunicações - Neorede","2021-08-05","1");
INSERT INTO cx_conta_informatica VALUES("8","2021-08-01 12:22:19",NULL,"80","9","2021","23792030099000029922375001040007187340000008000","Mirix Telecomunicações - Neorede","2021-09-05",NULL);
INSERT INTO cx_conta_informatica VALUES("9","2021-08-01 12:23:01",NULL,"80","10","2021","23792030099000029922376001040005387640000008000","Mirix Telecomunicações - Neorede","2021-10-05",NULL);
INSERT INTO cx_conta_informatica VALUES("10","2021-08-01 12:24:05",NULL,"80","11","2021","23792030099000029922377001040003187950000008000","Mirix Telecomunicações - Neorede","2021-11-05",NULL);
INSERT INTO cx_conta_informatica VALUES("11","2021-08-01 12:25:02",NULL,"80","12","2021","23792030099000029922378001040001188250000008000","Mirix Telecomunicações - Neorede","2021-12-05",NULL);


DROP TABLE IF EXISTS cx_conta_loja;


CREATE TABLE `cx_conta_loja` (
  `id_loj` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `valor` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `codigo` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimento` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_loj`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_conta_loja VALUES("1","2021-07-31 17:56:45","2021-07-31 19:22:46","359","7","2021","75691324210100420990202499800015386720000035900","PIFFER: 1ª/4 parc - Escrivanas","2021-07-05","1");
INSERT INTO cx_conta_loja VALUES("2","2021-07-31 17:58:51","2021-07-31 19:34:58","194.99","7","2021","23793380296098141321848006333305886710000019499","Mercado Livre - Diferença: Kit I5 3470 + Placa H61 1155 + 8 Gb Ddr3 + Ssd 240 Gb","2021-07-04","1");
INSERT INTO cx_conta_loja VALUES("3","2021-07-31 18:06:30",NULL,"89.89","7","2021","23793380296098249112299006333308786910000008989","Mercado Livre: Arma de Brinquedo","2021-07-21","1");
INSERT INTO cx_conta_loja VALUES("4","2021-07-31 18:23:30",NULL,"327.66","8","2021","75691324210100420990202499980015486950000032766","PIFFER: 01/03 Parc","2021-08-01","1");
INSERT INTO cx_conta_loja VALUES("5","2021-07-31 20:33:28","2021-07-31 20:35:01","403.3","8","2021","013521","Minatti - Pia Banheiro - Entrada - 1ºParc/3","2021-08-01","1");
INSERT INTO cx_conta_loja VALUES("6","2021-07-31 20:38:53",NULL,"471.53","7","2021","854684","Macris - edredoms","2021-07-19","1");
INSERT INTO cx_conta_loja VALUES("7","2021-08-01 12:13:38",NULL,"327.67","8","2021","75691324210100420990202500020025887260000032767","PIFFER: 2º/3 Parc.","2021-08-28",NULL);
INSERT INTO cx_conta_loja VALUES("8","2021-08-01 12:16:33",NULL,"327.67","9","2021","75691324210100420990202500100033987570000032767","PIFFER: 3º/3 Parc.","2021-09-28",NULL);
INSERT INTO cx_conta_loja VALUES("9","2021-08-01 12:18:57",NULL,"403.33","9","2021",NULL,"Minatti - Pia Banheiro - 2ºParc/3","2021-09-01",NULL);
INSERT INTO cx_conta_loja VALUES("10","2021-08-01 12:19:37",NULL,"403.34","10","2021",NULL,"Minatti - Pia Banheiro - 3ºParc/3","2021-10-01",NULL);
INSERT INTO cx_conta_loja VALUES("11","2021-08-04 20:20:57",NULL,"133.33","9","2021",NULL,"Minatti - Assento Sanitario","2021-09-01",NULL);


DROP TABLE IF EXISTS cx_conta_mecanica;


CREATE TABLE `cx_conta_mecanica` (
  `id_mec` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `valor` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `codigo` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimento` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_mec`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_conta_mecanica VALUES("1","2021-07-31 22:57:37","2021-08-01 08:42:34","340","7","2021",NULL,"Biz 110i - Ceccato","2021-07-07","1");


DROP TABLE IF EXISTS cx_conta_mercado;


CREATE TABLE `cx_conta_mercado` (
  `id_mer` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `valor` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `codigo` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimento` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_mer`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_conta_mercado VALUES("6","2021-07-09 09:48:43","2021-07-30 13:43:22","482.35","7","2021","368.804",NULL,"2021-07-05","1");
INSERT INTO cx_conta_mercado VALUES("7","2021-07-09 09:49:59","2021-07-09 09:50:01","18.9","7","2021","113.486",NULL,"2021-07-05","1");
INSERT INTO cx_conta_mercado VALUES("8","2021-07-09 09:51:05","2021-07-09 09:51:12","84.82","7","2021","659.171",NULL,"2021-07-02","1");
INSERT INTO cx_conta_mercado VALUES("9","2021-07-09 09:52:13","2021-07-09 09:52:15","10.85","7","2021","624649",NULL,"2021-07-06","1");
INSERT INTO cx_conta_mercado VALUES("10","2021-07-10 14:46:32",NULL,"508.31","7","2021","576289",NULL,"2021-07-10","1");
INSERT INTO cx_conta_mercado VALUES("13","2021-07-15 07:18:53",NULL,"5.5","7","2021",NULL,NULL,"2021-07-13","1");
INSERT INTO cx_conta_mercado VALUES("14","2021-07-16 14:54:06","2021-07-16 14:54:18","94.65","7","2021","985339",NULL,"2021-07-14","1");
INSERT INTO cx_conta_mercado VALUES("15","2021-07-19 17:36:07",NULL,"281.07","7","2021","716825",NULL,"2021-07-17","1");
INSERT INTO cx_conta_mercado VALUES("16","2021-07-19 17:38:27",NULL,"58.62","7","2021","860872",NULL,"2021-07-16","1");
INSERT INTO cx_conta_mercado VALUES("18","2021-07-22 17:39:12",NULL,"23.84","7","2021","303729",NULL,"2021-07-22","1");
INSERT INTO cx_conta_mercado VALUES("19","2021-07-24 17:19:39",NULL,"569.42","7","2021","053991",NULL,"2021-07-24","1");
INSERT INTO cx_conta_mercado VALUES("20","2021-07-24 17:23:13",NULL,"14.02","7","2021",NULL,NULL,"2021-07-20","1");
INSERT INTO cx_conta_mercado VALUES("21","2021-07-27 20:44:11",NULL,"46.49","7","2021","836332",NULL,"2021-07-27","1");
INSERT INTO cx_conta_mercado VALUES("22","2021-07-30 09:09:49",NULL,"80.38","7","2021",NULL,NULL,"2021-07-29","1");
INSERT INTO cx_conta_mercado VALUES("23","2021-07-31 13:09:17","2021-08-01 12:08:27","105.2","8","2021","207663","Compra Mercado Archer - Édio","2021-08-01","1");
INSERT INTO cx_conta_mercado VALUES("24","2021-07-31 21:43:17",NULL,"65","7","2021",NULL,"Produtos de Limpeza","2021-07-23","1");
INSERT INTO cx_conta_mercado VALUES("25","2021-07-31 21:44:13",NULL,"60","7","2021",NULL,"Pizza","2021-07-04","1");
INSERT INTO cx_conta_mercado VALUES("26","2021-08-01 12:07:57","2021-08-01 12:08:44","449.42","8","2021","089765","Compra Mercado Archer - Nadir & Edio","2021-08-01","1");
INSERT INTO cx_conta_mercado VALUES("27","2021-08-01 19:21:15",NULL,"172.59","8","2021","644919","Macris - Nadir - Monchila, etc...","2021-08-01","1");


DROP TABLE IF EXISTS cx_conta_saude;


CREATE TABLE `cx_conta_saude` (
  `id_sau` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `valor` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `codigo` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimento` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_sau`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_conta_saude VALUES("1","2021-07-30 20:18:30","2021-07-31 20:16:44","177","7","2021","733346","FARMAIS: sulfato de glicosamina + acido hialurônico","2021-07-05","1");
INSERT INTO cx_conta_saude VALUES("2","2021-07-30 20:21:00",NULL,"26","7","2021","281931","FARMAIS","2021-07-02","1");
INSERT INTO cx_conta_saude VALUES("3","2021-07-30 20:22:38","2021-07-31 20:15:36","40","7","2021",NULL,"Clinica Amor & Saúde - Ortopedista","2021-07-19","1");
INSERT INTO cx_conta_saude VALUES("4","2021-07-30 20:23:51","2021-07-31 20:15:18","192","7","2021",NULL,"Clinica Amor & saúde - Oftalmologista","2021-07-17","1");
INSERT INTO cx_conta_saude VALUES("6","2021-08-04 20:24:17",NULL,"180","8","2021",NULL,"FARMAIS: sulfato de glicosamina + Condroitina + acido hialurônico","2021-08-04","1");


DROP TABLE IF EXISTS cx_conta_social;


CREATE TABLE `cx_conta_social` (
  `id_soc` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `valor` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `codigo` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `vencimento` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_soc`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_conta_social VALUES("1","2021-08-05 10:18:34",NULL,"100","8","2021",NULL,"Helena","2021-08-04","1");


DROP TABLE IF EXISTS cx_contas;


CREATE TABLE `cx_contas` (
  `id_con` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `conta` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_con`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_contas VALUES("1","2021-08-02 10:23:07",NULL,"Banco");
INSERT INTO cx_contas VALUES("6","2021-08-05 10:16:49",NULL,"Social");


DROP TABLE IF EXISTS cx_descricao;


CREATE TABLE `cx_descricao` (
  `id_des` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `descricao` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `categoria_id` int DEFAULT '1',
  PRIMARY KEY (`id_des`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_descricao VALUES("1","2021-02-05 18:41:48","2021-02-11 14:18:25","Salário","2");
INSERT INTO cx_descricao VALUES("3","2021-07-04 15:40:06","2021-07-04 16:29:43","Salário da Professora - Nadir","2");
INSERT INTO cx_descricao VALUES("2","2021-07-04 15:39:48","2021-07-04 16:29:31","Salário do Professor - Édio","2");
INSERT INTO cx_descricao VALUES("5","2021-07-04 17:52:57","2021-07-30 12:22:42","Energia Elétrica & Gás","4");
INSERT INTO cx_descricao VALUES("6","2021-07-04 17:53:14","2021-07-31 22:18:25","Telefone & Celular","1");
INSERT INTO cx_descricao VALUES("9","2021-07-04 17:54:30","2021-07-31 17:38:43","Lojas","5");
INSERT INTO cx_descricao VALUES("10","2021-07-04 17:54:45","2021-08-01 08:46:25","Agropecuaria","6");
INSERT INTO cx_descricao VALUES("16","2021-07-04 17:56:37","2021-07-30 17:28:43","Saude&Farmácia&Clinica","16");
INSERT INTO cx_descricao VALUES("19","2021-07-05 11:56:09",NULL,"CC. B. Brasil","9");
INSERT INTO cx_descricao VALUES("22","2021-07-06 16:53:36",NULL,"Saldo Anterior","9");
INSERT INTO cx_descricao VALUES("23","2021-07-06 16:59:30","2021-07-06 16:59:58","Dinheiro em caixa","10");
INSERT INTO cx_descricao VALUES("50","2021-08-05 10:16:55",NULL,"Social","42");
INSERT INTO cx_descricao VALUES("25","2021-07-06 17:11:27","2021-07-30 10:54:46","Combustivel","11");
INSERT INTO cx_descricao VALUES("26","2021-07-06 17:14:59","2021-07-30 17:05:54","Informatica&Internet","12");
INSERT INTO cx_descricao VALUES("29","2021-07-08 11:00:37","2021-07-31 22:59:05","Mecanica&Motos&Veiculos","15");
INSERT INTO cx_descricao VALUES("30","2021-07-08 19:52:56",NULL,"Mercados","8");
INSERT INTO cx_descricao VALUES("32","2021-07-19 20:41:19","2021-07-30 20:54:18","Educação&Esporte&Lazer","14");
INSERT INTO cx_descricao VALUES("49","2021-08-04 14:33:51",NULL,"Banco","34");


DROP TABLE IF EXISTS cx_entrada;


CREATE TABLE `cx_entrada` (
  `id_ent` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `descricao_id` int NOT NULL,
  `valor` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `vencimento` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ent`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_entrada VALUES("6","2021-07-06 08:56:12","2021-07-08 10:40:43","2","2389.29","2021-07-01",NULL,"Pagamento: Junho/2021","2021","7","1");
INSERT INTO cx_entrada VALUES("7","2021-07-06 08:58:02","2021-07-08 10:40:49","3","2545.25","2021-07-01",NULL,NULL,"2021","7","1");
INSERT INTO cx_entrada VALUES("25","2021-07-09 10:23:48","2021-07-09 10:25:33","19","530.77","2021-06-30",NULL,"Saldo","2021","6","1");
INSERT INTO cx_entrada VALUES("26","2021-07-09 11:56:54","2021-07-09 11:57:39","23","660","2021-07-09",NULL,"Carro Alice","2021","7","1");
INSERT INTO cx_entrada VALUES("27","2021-07-11 13:34:53","2021-07-19 20:39:03","23","61","2021-07-18",NULL,"Energia do Sergio","2021","6","1");
INSERT INTO cx_entrada VALUES("28","2021-07-16 14:49:28","2021-07-16 14:50:34","2","2072.99","2021-07-16","948917","1ª Parcela 13º Salário","2021","7","1");
INSERT INTO cx_entrada VALUES("29","2021-07-16 14:50:19","2021-07-31 09:28:53","3","1354.51","2021-07-16","948917","1ª Parcela 13º Salário","2021","7","1");
INSERT INTO cx_entrada VALUES("30","2021-07-30 10:58:55","2021-07-30 11:27:31","2","2559.25","2021-08-01","948917","Salário - Édio","2021","8","1");
INSERT INTO cx_entrada VALUES("31","2021-07-30 10:59:50","2021-07-31 09:29:04","3","2419.29","2021-08-01","948917","Salário - Nadir","2021","8","1");
INSERT INTO cx_entrada VALUES("32","2021-08-01 19:13:05","2021-08-05 10:19:33","23","660","2021-08-08",NULL,"Pago Alice","2021","8","1");


DROP TABLE IF EXISTS cx_mes;


CREATE TABLE `cx_mes` (
  `id_mes` int NOT NULL AUTO_INCREMENT,
  `mes` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `extenso` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_mes`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_mes VALUES("1","jan","Janeiro");
INSERT INTO cx_mes VALUES("2","fev","Fevereiro");
INSERT INTO cx_mes VALUES("3","mar","Março");
INSERT INTO cx_mes VALUES("4","abr","Abril");
INSERT INTO cx_mes VALUES("5","mai","Maio");
INSERT INTO cx_mes VALUES("6","jun","Junho");
INSERT INTO cx_mes VALUES("7","jul","Julho");
INSERT INTO cx_mes VALUES("8","ago","Agosto");
INSERT INTO cx_mes VALUES("9","set","Setembro");
INSERT INTO cx_mes VALUES("10","out","Outubro");
INSERT INTO cx_mes VALUES("11","nov","Novembro");
INSERT INTO cx_mes VALUES("12","dez","Dezembro");


DROP TABLE IF EXISTS cx_saida;


CREATE TABLE `cx_saida` (
  `id_sai` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `descricao_id` int NOT NULL,
  `valor` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vencimento` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `mes_id` int DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_sai`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_saida VALUES("2","2021-07-06 08:59:49","2021-07-30 16:25:08","5","523.23","2021-07-11","836500000036332301620008001010202172384204212508","CELESC DISTRIBUICAO S.A","2021","7","1");
INSERT INTO cx_saida VALUES("31","2021-07-09 10:18:19","2021-07-31 21:44:25","30","2404.22",NULL,NULL,"IMPORTADO DE CONTA MERCADO","2021","7","1");
INSERT INTO cx_saida VALUES("49","2021-07-30 10:55:27","2021-07-30 10:56:01","25","534.89",NULL,NULL,NULL,"2021","7","1");
INSERT INTO cx_saida VALUES("50","2021-07-30 11:04:54","2021-07-30 11:27:56","5","333.49","2021-08-11","836300000038334901620008001010202172485576490786",NULL,"2021","8","1");
INSERT INTO cx_saida VALUES("56","2021-07-30 17:03:31",NULL,"26","364.14","2021-jul-01","****","IMPORTADO DE CONTA INFORMÁTICA","2021","7","1");
INSERT INTO cx_saida VALUES("58","2021-07-30 17:09:56","2021-07-31 09:32:49","26","504","2021-ago-01","****","IMPORTADO DE CONTA INFORMÁTICA","2021","8","1");
INSERT INTO cx_saida VALUES("62","2021-07-30 20:44:36","2021-07-30 20:46:06","16","435","2021-jul-01","****","IMPORTADO DE CONTA SAÚDE","2021","7","1");
INSERT INTO cx_saida VALUES("64","2021-07-30 21:14:21","2021-07-30 21:19:39","32","273","2021-jul-01","****","IMPORTADO DE CONTA MERCADO","2021","7","1");
INSERT INTO cx_saida VALUES("66","2021-07-31 13:14:19","2021-08-01 12:08:50","30","554.62","2021-8-01","****","IMPORTADO DE CONTA MERCADO","2021","8","1");
INSERT INTO cx_saida VALUES("69","2021-07-31 18:19:34","2021-07-31 20:39:34","9","1115.41","2021-7-01","****","IMPORTADO DE CONTA LOJA","2021","7","1");
INSERT INTO cx_saida VALUES("70","2021-07-31 18:23:57","2021-07-31 20:40:30","9","730.96","2021-8-01","****","IMPORTADO DE CONTA LOJA","2021","8","1");
INSERT INTO cx_saida VALUES("71","2021-07-31 22:20:15",NULL,"6","37.25","2021-7-01","****","IMPORTADO DE CONTA FONE","2021","7","1");
INSERT INTO cx_saida VALUES("72","2021-07-31 22:20:42",NULL,"6","20.08","2021-8-01","****","IMPORTADO DE CONTA FONE","2021","8","1");
INSERT INTO cx_saida VALUES("73","2021-07-31 22:58:04","2021-07-31 22:59:21","29","340","2021-7-01","****","IMPORTADO DE CONTA MECANICA","2021","7","1");
INSERT INTO cx_saida VALUES("74","2021-08-01 12:39:47",NULL,"10","528.5","2021-7-01","****","IMPORTADO DE CONTA AGROPECUARIA","2021","7","1");
INSERT INTO cx_saida VALUES("75","2021-08-01 12:40:00",NULL,"10","361.9","2021-8-01","****","IMPORTADO DE CONTA AGROPECUARIA","2021","8","1");
INSERT INTO cx_saida VALUES("76","2021-08-04 20:10:41",NULL,"46","250","2021-8-01","****","IMPORTADO DE CONTA Banco","2021","8","1");
INSERT INTO cx_saida VALUES("78","2021-08-04 20:24:25",NULL,"16","180","2021-8-01","****","IMPORTADO DE CONTA SAÚDE","2021","8","1");
INSERT INTO cx_saida VALUES("79","2021-08-05 10:07:08",NULL,"49","22.5","2021-7-01","****","IMPORTADO DE CONTA Banco","2021","7","1");
INSERT INTO cx_saida VALUES("80","2021-08-05 10:18:40",NULL,"50","100","2021-8-01","****","IMPORTADO DE CONTA Social","2021","8","1");


DROP TABLE IF EXISTS cx_saldo;


CREATE TABLE `cx_saldo` (
  `id_sal` int NOT NULL AUTO_INCREMENT,
  `saldo` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `ano` int NOT NULL,
  `mes_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sal`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO cx_saldo VALUES("1","0.00","2021","1","2021-07-07 10:09:06",NULL);
INSERT INTO cx_saldo VALUES("2","0.00","2021","2","2021-07-07 10:06:34",NULL);
INSERT INTO cx_saldo VALUES("3","0.00","2021","3","2021-07-07 10:06:34",NULL);
INSERT INTO cx_saldo VALUES("4","0.00","2021","4","2021-07-07 10:09:46",NULL);
INSERT INTO cx_saldo VALUES("5","0.00","2021","5","2021-07-07 10:09:46","2021-07-09 14:11:02");
INSERT INTO cx_saldo VALUES("6","530.77","2021","6","2021-07-06 21:14:09","2021-07-09 11:00:31");
INSERT INTO cx_saldo VALUES("7","2974.67","2021","7","2021-07-07 19:56:57","2021-08-05 10:08:08");
INSERT INTO cx_saldo VALUES("8","5828.16","2021","8","2021-07-07 19:56:57","2021-08-05 10:08:19");
INSERT INTO cx_saldo VALUES("9","6386","2021","9","2021-07-07 19:56:57","2021-07-31 09:35:46");
INSERT INTO cx_saldo VALUES("10","6386","2021","10","2021-07-07 19:56:57","2021-07-31 09:35:58");
INSERT INTO cx_saldo VALUES("11","6386","2021","11","2021-07-07 19:56:57","2021-07-31 09:36:06");
INSERT INTO cx_saldo VALUES("12","6386","2021","12","2021-07-07 19:56:57","2021-07-31 09:36:19");
INSERT INTO cx_saldo VALUES("13",NULL,"2020","12","2021-07-07 19:56:57",NULL);
INSERT INTO cx_saldo VALUES("14",NULL,"2022","1","2021-07-07 19:56:57",NULL);
INSERT INTO cx_saldo VALUES("17",NULL,"2020","11","2021-07-07 19:56:57","2021-07-11 13:46:34");


