/*
MySQL Backup
Source Server Version: 5.5.8
Source Database: teste
Date: 09/08/2012 11:43:01
*/


-- ----------------------------
--  Table structure for `tbmatch`
-- ----------------------------
DROP TABLE IF EXISTS `tbmatch`;
CREATE TABLE `tbmatch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idHomeTeam` int(11) DEFAULT NULL,
  `idVisitorTeam` int(11) DEFAULT NULL,
  `goalHomeTeam` int(11) DEFAULT NULL,
  `goalVisitorTeam` int(11) DEFAULT NULL,
  `round` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Fk_idhomeTeam` (`idHomeTeam`),
  KEY `Fk_idvisitorTeam` (`idVisitorTeam`),
  CONSTRAINT `Fk_homeTeam` FOREIGN KEY (`idHomeTeam`) REFERENCES `tbteam` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Fk_visitorTeam` FOREIGN KEY (`idVisitorTeam`) REFERENCES `tbteam` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=806 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tbstadium`
-- ----------------------------
DROP TABLE IF EXISTS `tbstadium`;
CREATE TABLE `tbstadium` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stadium` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `tbteam`
-- ----------------------------
DROP TABLE IF EXISTS `tbteam`;
CREATE TABLE `tbteam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` varchar(255) CHARACTER SET latin1 NOT NULL,
  `points` int(11) DEFAULT NULL,
  `wins` int(11) DEFAULT NULL,
  `losses` int(11) DEFAULT NULL,
  `draws` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `tbmatch` VALUES ('666','8','9','1','1','1','2012-05-19');
INSERT INTO `tbmatch` VALUES ('667','10','7','1','1','1','2012-05-19');
INSERT INTO `tbmatch` VALUES ('668','3','16','2','1','1','2012-05-19');
INSERT INTO `tbmatch` VALUES ('669','1','19','4','2','1','2012-05-20');
INSERT INTO `tbmatch` VALUES ('670','17','6','0','1','1','2012-05-20');
INSERT INTO `tbmatch` VALUES ('671','2','20','2','0','1','2012-05-20');
INSERT INTO `tbmatch` VALUES ('672','18','5','0','1','1','2012-05-20');
INSERT INTO `tbmatch` VALUES ('673','4','15','2','1','1','2012-05-20');
INSERT INTO `tbmatch` VALUES ('674','13','11','0','0','1','2012-05-20');
INSERT INTO `tbmatch` VALUES ('675','12','14','0','0','1','2012-05-20');
INSERT INTO `tbmatch` VALUES ('676','7','2','3','3','2','2012-05-26');
INSERT INTO `tbmatch` VALUES ('677','9','4','0','1','2','2012-05-26');
INSERT INTO `tbmatch` VALUES ('678','11','18','1','1','2','2012-05-26');
INSERT INTO `tbmatch` VALUES ('679','16','13','0','0','2','2012-05-26');
INSERT INTO `tbmatch` VALUES ('680','14','10','0','0','2','2012-05-27');
INSERT INTO `tbmatch` VALUES ('681','19','12','1','0','2','2012-05-27');
INSERT INTO `tbmatch` VALUES ('682','5','17','1','0','2','2012-05-27');
INSERT INTO `tbmatch` VALUES ('683','20','1','2','3','2','2012-05-27');
INSERT INTO `tbmatch` VALUES ('684','6','3','2','2','2','2012-05-27');
INSERT INTO `tbmatch` VALUES ('685','15','8','1','0','2','2012-05-27');
INSERT INTO `tbmatch` VALUES ('686','10','8','2','1','3','2012-06-06');
INSERT INTO `tbmatch` VALUES ('687','11','15','0','1','3','2012-06-06');
INSERT INTO `tbmatch` VALUES ('688','4','16','4','2','3','2012-06-06');
INSERT INTO `tbmatch` VALUES ('689','5','12','1','1','3','2012-06-06');
INSERT INTO `tbmatch` VALUES ('690','20','9','2','0','3','2012-06-06');
INSERT INTO `tbmatch` VALUES ('691','14','6','1','1','3','2012-06-06');
INSERT INTO `tbmatch` VALUES ('692','2','19','1','0','3','2012-06-06');
INSERT INTO `tbmatch` VALUES ('693','18','7','2','2','3','2012-06-06');
INSERT INTO `tbmatch` VALUES ('694','1','13','2','3','3','2012-06-07');
INSERT INTO `tbmatch` VALUES ('695','17','3','1','1','3','2012-06-07');
INSERT INTO `tbmatch` VALUES ('696','7','20','3','1','4','2012-06-09');
INSERT INTO `tbmatch` VALUES ('697','8','5','0','1','4','2012-06-09');
INSERT INTO `tbmatch` VALUES ('698','9','11','2','0','4','2012-06-10');
INSERT INTO `tbmatch` VALUES ('699','6','2','0','0','4','2012-06-10');
INSERT INTO `tbmatch` VALUES ('700','15','17','2','0','4','2012-06-10');
INSERT INTO `tbmatch` VALUES ('701','12','4','1','2','4','2012-06-10');
INSERT INTO `tbmatch` VALUES ('702','19','14','1','0','4','2012-06-10');
INSERT INTO `tbmatch` VALUES ('703','13','10','1','0','4','2012-06-10');
INSERT INTO `tbmatch` VALUES ('704','3','18','0','0','4','2012-06-10');
INSERT INTO `tbmatch` VALUES ('705','16','1','3','2','4','2012-06-10');
INSERT INTO `tbmatch` VALUES ('706','2','1','1','2','5','2012-06-16');
INSERT INTO `tbmatch` VALUES ('707','13','3','1','0','5','2012-06-16');
INSERT INTO `tbmatch` VALUES ('708','6','9','4','1','5','2012-06-16');
INSERT INTO `tbmatch` VALUES ('709','7','14','1','0','5','2012-06-17');
INSERT INTO `tbmatch` VALUES ('710','8','4','1','1','5','2012-06-17');
INSERT INTO `tbmatch` VALUES ('711','19','5','1','0','5','2012-06-17');
INSERT INTO `tbmatch` VALUES ('712','12','10','2','1','5','2012-06-17');
INSERT INTO `tbmatch` VALUES ('713','18','17','1','0','5','2012-06-17');
INSERT INTO `tbmatch` VALUES ('714','20','11','3','0','5','2012-06-17');
INSERT INTO `tbmatch` VALUES ('715','16','15','1','0','5','2012-06-17');
INSERT INTO `tbmatch` VALUES ('716','4','13','1','3','6','2012-06-23');
INSERT INTO `tbmatch` VALUES ('717','9','19','1','0','6','2012-06-23');
INSERT INTO `tbmatch` VALUES ('718','5','16','5','1','6','2012-06-23');
INSERT INTO `tbmatch` VALUES ('719','17','8','2','1','6','2012-06-24');
INSERT INTO `tbmatch` VALUES ('720','15','7','2','0','6','2012-06-24');
INSERT INTO `tbmatch` VALUES ('721','3','12','1','1','6','2012-06-24');
INSERT INTO `tbmatch` VALUES ('722','1','18','1','2','6','2012-06-24');
INSERT INTO `tbmatch` VALUES ('723','14','20','2','2','6','2012-06-24');
INSERT INTO `tbmatch` VALUES ('724','10','2','0','2','6','2012-06-24');
INSERT INTO `tbmatch` VALUES ('725','11','6','1','4','6','2012-06-24');
INSERT INTO `tbmatch` VALUES ('726','13','19','2','3','7','2012-06-30');
INSERT INTO `tbmatch` VALUES ('727','16','6','0','2','7','2012-06-30');
INSERT INTO `tbmatch` VALUES ('728','4','18','3','2','7','2012-06-30');
INSERT INTO `tbmatch` VALUES ('729','9','14','0','0','7','2012-07-01');
INSERT INTO `tbmatch` VALUES ('730','20','10','2','3','7','2012-07-01');
INSERT INTO `tbmatch` VALUES ('731','12','2','1','1','7','2012-07-01');
INSERT INTO `tbmatch` VALUES ('732','7','11','3','2','7','2012-07-01');
INSERT INTO `tbmatch` VALUES ('733','8','3','3','1','7','2012-07-01');
INSERT INTO `tbmatch` VALUES ('734','15','5','0','1','7','2012-07-01');
INSERT INTO `tbmatch` VALUES ('735','17','1','1','3','7','2012-07-11');
INSERT INTO `tbmatch` VALUES ('736','1','12','3','0','8','2012-07-07');
INSERT INTO `tbmatch` VALUES ('737','2','13','2','1','8','2012-07-07');
INSERT INTO `tbmatch` VALUES ('738','11','16','0','1','8','2012-07-07');
INSERT INTO `tbmatch` VALUES ('739','6','7','1','0','8','2012-07-08');
INSERT INTO `tbmatch` VALUES ('740','14','15','4','2','8','2012-07-08');
INSERT INTO `tbmatch` VALUES ('741','19','20','3','1','8','2012-07-08');
INSERT INTO `tbmatch` VALUES ('742','3','4','1','1','8','2012-07-08');
INSERT INTO `tbmatch` VALUES ('743','5','9','2','0','8','2012-07-08');
INSERT INTO `tbmatch` VALUES ('744','18','8','1','0','8','2012-07-08');
INSERT INTO `tbmatch` VALUES ('745','10','17','1','1','8','2012-07-08');
INSERT INTO `tbmatch` VALUES ('746','17','16','2','1','9','2012-07-14');
INSERT INTO `tbmatch` VALUES ('747','3','5','3','4','9','2012-07-14');
INSERT INTO `tbmatch` VALUES ('748','18','20','4','1','9','2012-07-14');
INSERT INTO `tbmatch` VALUES ('749','1','6','1','1','9','2012-07-15');
INSERT INTO `tbmatch` VALUES ('750','2','14','0','0','9','2012-07-15');
INSERT INTO `tbmatch` VALUES ('751','13','15','1','3','9','2012-07-15');
INSERT INTO `tbmatch` VALUES ('752','12','7','1','2','9','2012-07-15');
INSERT INTO `tbmatch` VALUES ('753','4','11','1','0','9','2012-07-15');
INSERT INTO `tbmatch` VALUES ('754','8','19','1','1','9','2012-07-15');
INSERT INTO `tbmatch` VALUES ('755','10','9','2','1','9','2012-07-15');
INSERT INTO `tbmatch` VALUES ('756','14','1','0','0','10','2012-07-18');
INSERT INTO `tbmatch` VALUES ('757','15','10','3','1','10','2012-07-18');
INSERT INTO `tbmatch` VALUES ('758','9','13','0','2','10','2012-07-18');
INSERT INTO `tbmatch` VALUES ('759','16','18','3','0','10','2012-07-18');
INSERT INTO `tbmatch` VALUES ('760','7','17','0','3','10','2012-07-18');
INSERT INTO `tbmatch` VALUES ('761','19','4','0','1','10','2012-07-18');
INSERT INTO `tbmatch` VALUES ('762','5','2','3','1','10','2012-07-18');
INSERT INTO `tbmatch` VALUES ('763','6','12','4','0','10','2012-07-19');
INSERT INTO `tbmatch` VALUES ('764','20','8','1','1','10','2012-07-19');
INSERT INTO `tbmatch` VALUES ('765','11','3','3','2','10','2012-07-19');
INSERT INTO `tbmatch` VALUES ('766','4','14','2','0','11','2012-07-21');
INSERT INTO `tbmatch` VALUES ('767','10','5','1','4','11','2012-07-21');
INSERT INTO `tbmatch` VALUES ('768','17','9','1','1','11','2012-07-21');
INSERT INTO `tbmatch` VALUES ('769','8','16','3','0','11','2012-07-22');
INSERT INTO `tbmatch` VALUES ('770','2','11','4','1','11','2012-07-22');
INSERT INTO `tbmatch` VALUES ('771','13','7','1','0','11','2012-07-22');
INSERT INTO `tbmatch` VALUES ('772','3','19','0','2','11','2012-07-22');
INSERT INTO `tbmatch` VALUES ('773','1','15','0','1','11','2012-07-22');
INSERT INTO `tbmatch` VALUES ('774','18','6','1','2','11','2012-07-22');
INSERT INTO `tbmatch` VALUES ('775','12','20','2','2','11','2012-07-22');
INSERT INTO `tbmatch` VALUES ('776','18','10','1','1','12','2012-07-25');
INSERT INTO `tbmatch` VALUES ('777','3','2','0','1','12','2012-07-25');
INSERT INTO `tbmatch` VALUES ('778','4','1','1','0','12','2012-07-25');
INSERT INTO `tbmatch` VALUES ('779','16','20','3','4','12','2012-07-25');
INSERT INTO `tbmatch` VALUES ('780','17','13','2','0','12','2012-07-25');
INSERT INTO `tbmatch` VALUES ('781','15','6','1','0','12','2012-07-25');
INSERT INTO `tbmatch` VALUES ('782','11','19','4','3','12','2012-07-25');
INSERT INTO `tbmatch` VALUES ('783','7','9','0','0','12','2012-07-26');
INSERT INTO `tbmatch` VALUES ('784','8','12','0','2','12','2012-07-26');
INSERT INTO `tbmatch` VALUES ('785','5','14','2','0','12','2012-07-26');
INSERT INTO `tbmatch` VALUES ('786','2','4','0','0','13','2012-07-28');
INSERT INTO `tbmatch` VALUES ('787','20','15','2','1','13','2012-07-28');
INSERT INTO `tbmatch` VALUES ('788','1','3','1','0','13','2012-07-28');
INSERT INTO `tbmatch` VALUES ('789','6','5','0','0','13','2012-07-29');
INSERT INTO `tbmatch` VALUES ('790','19','7','4','1','13','2012-07-29');
INSERT INTO `tbmatch` VALUES ('791','10','11','0','0','13','2012-07-29');
INSERT INTO `tbmatch` VALUES ('792','12','17','0','0','13','2012-07-29');
INSERT INTO `tbmatch` VALUES ('793','14','18','2','1','13','2012-07-29');
INSERT INTO `tbmatch` VALUES ('794','13','8','2','1','13','2012-07-29');
INSERT INTO `tbmatch` VALUES ('795','9','16','3','1','13','2012-07-29');
INSERT INTO `tbmatch` VALUES ('796','8','2','0','1','14','2012-08-04');
INSERT INTO `tbmatch` VALUES ('797','11','1','1','2','14','2012-08-04');
INSERT INTO `tbmatch` VALUES ('798','9','3','2','0','14','2012-08-04');
INSERT INTO `tbmatch` VALUES ('799','4','17','0','0','14','2012-08-05');
INSERT INTO `tbmatch` VALUES ('800','19','10','1','0','14','2012-08-05');
INSERT INTO `tbmatch` VALUES ('801','15','12','3','1','14','2012-08-05');
INSERT INTO `tbmatch` VALUES ('802','20','6','0','2','14','2012-08-05');
INSERT INTO `tbmatch` VALUES ('803','13','18','1','2','14','2012-08-05');
INSERT INTO `tbmatch` VALUES ('804','16','14','3','0','14','2012-08-05');
INSERT INTO `tbmatch` VALUES ('805','7','5','0','0','14','2012-09-26');
INSERT INTO `tbteam` VALUES ('1','Botafogo','10','3','3','1');
INSERT INTO `tbteam` VALUES ('2','Internacional','14','4','1','2');
INSERT INTO `tbteam` VALUES ('3','Figueirense','6','1','3','3');
INSERT INTO `tbteam` VALUES ('4','Vasco','19','6','1','1');
INSERT INTO `tbteam` VALUES ('5','Atlético-MG','16','5','0','1');
INSERT INTO `tbteam` VALUES ('6','Fluminense','12','3','0','3');
INSERT INTO `tbteam` VALUES ('7','Flamengo','12','3','1','3');
INSERT INTO `tbteam` VALUES ('8','Palmeiras','9','2','3','3');
INSERT INTO `tbteam` VALUES ('9','Portuguesa','13','4','2','1');
INSERT INTO `tbteam` VALUES ('10','Sport','9','2','2','3');
INSERT INTO `tbteam` VALUES ('11','Atlético-GO','7','2','4','1');
INSERT INTO `tbteam` VALUES ('12','Bahia','7','1','2','4');
INSERT INTO `tbteam` VALUES ('13','Cruzeiro','13','4','3','1');
INSERT INTO `tbteam` VALUES ('14','Santos','10','2','0','4');
INSERT INTO `tbteam` VALUES ('15','Grêmio','18','6','1','0');
INSERT INTO `tbteam` VALUES ('16','Náutico','13','4','2','1');
INSERT INTO `tbteam` VALUES ('17','Corinthians','11','3','2','2');
INSERT INTO `tbteam` VALUES ('18','Ponte Preta','11','3','2','2');
INSERT INTO `tbteam` VALUES ('19','São Paulo','18','6','1','0');
INSERT INTO `tbteam` VALUES ('20','Coritiba','10','3','3','1');
