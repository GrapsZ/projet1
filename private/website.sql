/*
Navicat MySQL Data Transfer

Source Server         : LOCALE
Source Server Version : 100137
Source Host           : localhost:3306
Source Database       : website

Target Server Type    : MYSQL
Target Server Version : 100137
File Encoding         : 65001

Date: 2019-02-12 14:18:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for albums
-- ----------------------------
DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id chanson',
  `nom` text NOT NULL COMMENT 'nom de la hanson',
  `jaquette` longtext,
  `date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of albums
-- ----------------------------
INSERT INTO `albums` VALUES ('24', 'Johnny Classics', 'johnny.jpg', '2019-02-07 11:39:18');
INSERT INTO `albums` VALUES ('25', 'Madonna Hits', 'madonnaalbum.jpg', '2019-02-07 11:39:18');
INSERT INTO `albums` VALUES ('26', 'Babyonce', 'beyoncealbum.jpg', '2019-02-07 11:39:18');
INSERT INTO `albums` VALUES ('27', 'Star 80', 'annees80.jpg', '2019-02-07 11:39:18');

-- ----------------------------
-- Table structure for artistes
-- ----------------------------
DROP TABLE IF EXISTS `artistes`;
CREATE TABLE `artistes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id artiste',
  `nom` text NOT NULL COMMENT 'nom artiste',
  `description` longtext,
  `photo` tinytext,
  `genre` varchar(2) NOT NULL DEFAULT 'M' COMMENT 'genre artiste',
  `age` int(11) NOT NULL COMMENT 'age artiste',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of artistes
-- ----------------------------
INSERT INTO `artistes` VALUES ('1', 'J.J. Lionel', 'Haec igitur lex in amicitia sanciatur, ut neque rogemus res turpes nec faciamus rogati. Turpis enim excusatio est et minime accipienda cum in ceteris peccatis, tum si quis contra rem publicam se amici causa fecisse fateatur. Etenim eo loco, Fanni et Scaevola, locati sumus ut nos longe prospicere oporteat futuros casus rei publicae. Deflexit iam aliquantum de spatio curriculoque consuetudo maiorum.', 'jjlionel.jpg', 'M', '71');
INSERT INTO `artistes` VALUES ('2', 'Bourvil', 'Altera sententia est, quae definit amicitiam paribus officiis ac voluntatibus. Hoc quidem est nimis exigue et exiliter ad calculos vocare amicitiam, ut par sit ratio acceptorum et datorum. Divitior mihi et affluentior videtur esse vera amicitia nec observare restricte, ne plus reddat quam acceperit; neque enim verendum est, ne quid excidat, aut ne quid in terram defluat, aut ne plus aequo quid in amicitiam congeratur.', 'bourvil.jpg', 'm', '53');
INSERT INTO `artistes` VALUES ('3', 'John Lennon', 'Sed quid est quod in hac causa maxime homines admirentur et reprehendant meum consilium, cum ego idem antea multa decreverim, que magis ad hominis dignitatem quam ad rei publicae necessitatem pertinerent? Supplicationem quindecim dierum decrevi sententia mea. Rei publicae satis erat tot dierum quot C. Mario ; dis immortalibus non erat exigua eadem gratulatio quae ex maximis bellis. Ergo ille cumulus dierum hominis est dignitati tributus.', 'lennon.jpg', 'm', '1');
INSERT INTO `artistes` VALUES ('4', 'Beyonce', 'Ciliciam vero, quae Cydno amni exultat, Tarsus nobilitat, urbs perspicabilis hanc condidisse Perseus memoratur, Iovis filius et Danaes, vel certe ex Aethiopia profectus Sandan quidam nomine vir opulentus et nobilis et Anazarbus auctoris vocabulum referens, et Mopsuestia vatis illius domicilium Mopsi, quem a conmilitio Argonautarum cum aureo vellere direpto redirent, errore abstractum delatumque ad Africae litus mors repentina consumpsit, et ex eo cespite punico tecti manes eius heroici dolorum varietati medentur plerumque sospitales.', 'beyonce.jpg', 'F', '20');
INSERT INTO `artistes` VALUES ('5', 'Edith Piaf', 'Has autem provincias, quas Orontes ambiens amnis imosque pedes Cassii montis illius celsi praetermeans funditur in Parthenium mare, Gnaeus Pompeius superato Tigrane regnis Armeniorum abstractas dicioni Romanae coniunxit.', 'piaf.jpg', 'f', '47');
INSERT INTO `artistes` VALUES ('6', 'Madonna', 'Quod si rectum statuerimus vel concedere amicis, quidquid velint, vel impetrare ab iis, quidquid velimus, perfecta quidem sapientia si simus, nihil habeat res vitii; sed loquimur de iis amicis qui ante oculos sunt, quos vidimus aut de quibus memoriam accepimus, quos novit vita communis. Ex hoc numero nobis exempla sumenda sunt, et eorum quidem maxime qui ad sapientiam proxime accedunt.', 'madonna.jpg', 'F', '53');
INSERT INTO `artistes` VALUES ('7', 'Johnny Hallyday', 'Cum haec taliaque sollicitas eius aures everberarent expositas semper eius modi rumoribus et patentes, varia animo tum miscente consilia, tandem id ut optimum factu elegit: et Vrsicinum primum ad se venire summo cum honore mandavit ea specie ut pro rerum tunc urgentium captu disponeretur concordi consilio, quibus virium incrementis Parthicarum gentium a arma minantium impetus frangerentur.', 'hallyday.jpg', 'M', '73');
INSERT INTO `artistes` VALUES ('8', 'Jennifer Lopez', 'Auxerunt haec vulgi sordidioris audaciam, quod cum ingravesceret penuria commeatuum, famis et furoris inpulsu Eubuli cuiusdam inter suos clari domum ambitiosam ignibus subditis inflammavit rectoremque ut sibi iudicio imperiali addictum calcibus incessens et pugnis conculcans seminecem laniatu miserando discerpsit. post cuius lacrimosum interitum in unius exitio quisque imaginem periculi sui considerans documento recenti similia formidabat.', 'jlopez.jpg', 'f', '32');

-- ----------------------------
-- Table structure for chansons
-- ----------------------------
DROP TABLE IF EXISTS `chansons`;
CREATE TABLE `chansons` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id chanson',
  `nom` text NOT NULL COMMENT 'nom de la hanson',
  `jaquette` longtext,
  `date_realisation` date NOT NULL COMMENT 'date réalisation chanson',
  `id_artist` int(11) NOT NULL COMMENT 'id artiste',
  `id_album` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_artist` (`id_artist`),
  CONSTRAINT `chansons_ibfk_1` FOREIGN KEY (`id_artist`) REFERENCES `artistes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chansons
-- ----------------------------
INSERT INTO `chansons` VALUES ('1', 'La danse des canards', 'dansedescanards.jpg', '1981-06-02', '1', '27');
INSERT INTO `chansons` VALUES ('2', 'Pouet pouet', 'pouetpouet.jpg', '2018-10-03', '2', '27');
INSERT INTO `chansons` VALUES ('3', 'Imagine', 'imagine.jpg', '2009-11-27', '3', '27');
INSERT INTO `chansons` VALUES ('4', 'Halo', 'halo.jpg', '2019-01-16', '4', '26');
INSERT INTO `chansons` VALUES ('5', 'Crazy in Love', 'crazyinlove.jpg', '2010-11-11', '4', '26');
INSERT INTO `chansons` VALUES ('6', 'Baby Boy', 'babyboy.jpg', '1978-06-20', '4', '26');
INSERT INTO `chansons` VALUES ('7', 'Je te promets', 'jetepromets.jpg', '2017-06-01', '7', '24');
INSERT INTO `chansons` VALUES ('9', 'J\'en parlerai au diable', 'parleraiaudiable.jpg', '2006-06-29', '7', '24');
INSERT INTO `chansons` VALUES ('10', 'Le penitencier', 'penitencier.jpg', '1986-06-18', '7', '24');
INSERT INTO `chansons` VALUES ('12', 'Retiens la nuit', 'retienslanuit.jpg', '1994-04-28', '7', '24');
INSERT INTO `chansons` VALUES ('13', 'Like a virgin', 'likeavirgin.jpg', '2004-06-11', '6', '25');
INSERT INTO `chansons` VALUES ('15', 'Like a prayer', 'likeaprayer.jpg', '2009-06-25', '6', '25');
INSERT INTO `chansons` VALUES ('16', 'La isla Bonita', 'islabonita.jpg', '2006-06-03', '6', '25');
INSERT INTO `chansons` VALUES ('17', 'Love Don\'t Cost a Thing', 'lovedont.jpg', '2019-02-12', '8', null);
INSERT INTO `chansons` VALUES ('18', 'Papi', 'papi.jpg', '2018-06-14', '8', null);
INSERT INTO `chansons` VALUES ('19', 'All i have', 'allihave.jpg', '2019-02-12', '8', null);
INSERT INTO `chansons` VALUES ('21', 'Milord', 'milord.jpg', '2019-02-06', '5', null);
INSERT INTO `chansons` VALUES ('22', 'L\'hymne a l\'amour', 'hymneamour.jpg', '2019-02-05', '5', null);
INSERT INTO `chansons` VALUES ('23', 'La vie en rose', 'vieenrose.jpg', '2019-01-11', '5', null);

-- ----------------------------
-- Table structure for contenu_playlist
-- ----------------------------
DROP TABLE IF EXISTS `contenu_playlist`;
CREATE TABLE `contenu_playlist` (
  `id_playlist` int(11) NOT NULL COMMENT 'id de la playlist',
  `id_chanson` int(11) NOT NULL COMMENT 'id de la chanson',
  KEY `id_chanson` (`id_chanson`),
  KEY `id_playlist` (`id_playlist`),
  CONSTRAINT `contenu_playlist_ibfk_1` FOREIGN KEY (`id_chanson`) REFERENCES `chansons` (`id`),
  CONSTRAINT `contenu_playlist_ibfk_2` FOREIGN KEY (`id_playlist`) REFERENCES `playlists` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contenu_playlist
-- ----------------------------
INSERT INTO `contenu_playlist` VALUES ('11', '6');
INSERT INTO `contenu_playlist` VALUES ('11', '4');
INSERT INTO `contenu_playlist` VALUES ('11', '17');

-- ----------------------------
-- Table structure for infos
-- ----------------------------
DROP TABLE IF EXISTS `infos`;
CREATE TABLE `infos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id info',
  `titre` text NOT NULL COMMENT 'titre information',
  `contenu` longtext NOT NULL COMMENT 'contenu information',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date de publication',
  `image` tinytext CHARACTER SET latin1 NOT NULL COMMENT 'lien image de presentation',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of infos
-- ----------------------------
INSERT INTO `infos` VALUES ('1', 'Bienvenue ici', 'salutations et bienvenue sur le site de projet 1. Ce texte est inutile mais je n\'avais pas envie d\'y mettre du lorem ipsum. Bref. Je complète pour pas grand chose mais j\'aime le faire. Merci encore d\'avoir lu ce super txte inutile ^^. Des bisous \'/xD.', '2019-01-31 14:16:05', '');
INSERT INTO `infos` VALUES ('2', 'suite logique', 'message à la con de suite logique.', '2019-01-31 14:16:05', '');

-- ----------------------------
-- Table structure for likes_musiques
-- ----------------------------
DROP TABLE IF EXISTS `likes_musiques`;
CREATE TABLE `likes_musiques` (
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_chanson` int(11) DEFAULT NULL,
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_chanson` (`id_chanson`),
  CONSTRAINT `likes_musiques_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`),
  CONSTRAINT `likes_musiques_ibfk_2` FOREIGN KEY (`id_chanson`) REFERENCES `chansons` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of likes_musiques
-- ----------------------------
INSERT INTO `likes_musiques` VALUES ('9', '6');
INSERT INTO `likes_musiques` VALUES ('9', '4');
INSERT INTO `likes_musiques` VALUES ('9', '17');
INSERT INTO `likes_musiques` VALUES ('9', '19');

-- ----------------------------
-- Table structure for playlists
-- ----------------------------
DROP TABLE IF EXISTS `playlists`;
CREATE TABLE `playlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id playlist',
  `nom` varchar(30) NOT NULL COMMENT 'nom de la playlist',
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date de création playlist',
  `id_users` int(11) NOT NULL COMMENT 'id utilisateur',
  PRIMARY KEY (`id`),
  KEY `id_users` (`id_users`),
  CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `utilisateurs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of playlists
-- ----------------------------
INSERT INTO `playlists` VALUES ('11', 'RNB', '2019-02-08 16:10:12', '9');

-- ----------------------------
-- Table structure for utilisateurs
-- ----------------------------
DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id utilisateur',
  `username` varchar(10) NOT NULL COMMENT 'nom de compte utilisateur',
  `password` varchar(100) NOT NULL COMMENT 'mot de passe utilisateur',
  `email` varchar(255) NOT NULL COMMENT 'email utilisateur',
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar` tinytext NOT NULL COMMENT 'avatar utilisateur',
  `isAdmin` int(11) DEFAULT '0',
  `ip` varchar(15) DEFAULT '127.0.0.1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of utilisateurs
-- ----------------------------
INSERT INTO `utilisateurs` VALUES ('1', 'admin', 'admin', 'admin@admin', '2019-02-06 19:42:46', 'https://avatarfiles.alphacoders.com/516/51684.png', '1', '127.0.0.1');
INSERT INTO `utilisateurs` VALUES ('2', 'user', 'user', 'user@user', '2019-02-06 19:42:46', 'http://img10.xooimage.com/files/2/3/1/tortue-g-niale-avatar-forum-2276db7.jpg', '0', '127.0.0.1');
INSERT INTO `utilisateurs` VALUES ('7', 'jean', 'Password123', 'charles@mouloud.fr', '2019-02-06 19:42:46', 'http://img10.xooimage.com/files/2/3/1/tortue-g-niale-avatar-forum-2276db7.jpg', '0', '127.0.0.1');
INSERT INTO `utilisateurs` VALUES ('8', 'Robert', '5f4dcc3b5aa765d61d8327deb882cf99', 'robert@robert', '2019-02-06 19:42:46', 'http://img10.xooimage.com/files/2/3/1/tortue-g-niale-avatar-forum-2276db7.jpg', '0', '127.0.0.1');
INSERT INTO `utilisateurs` VALUES ('9', 'GrapsZ', '76e4875e763a475c199aef3c77ab9769', 'mickael.thaize@hotmail.fr', '2019-02-07 01:06:47', 'http://img10.xooimage.com/files/2/3/1/tortue-g-niale-avatar-forum-2276db7.jpg', '0', '127.0.0.1');
INSERT INTO `utilisateurs` VALUES ('10', 'username', '14c4b06b824ec593239362517f538b29', 'username@username', '2019-02-08 00:29:44', 'http://img10.xooimage.com/files/2/3/1/tortue-g-niale-avatar-forum-2276db7.jpg', '0', '127.0.0.1');
INSERT INTO `utilisateurs` VALUES ('11', 'michael', 'b6edd10559b20cb0a3ddaeb15e5267cc', 'michael@michael', '2019-02-12 13:30:50', 'http://img10.xooimage.com/files/2/3/1/tortue-g-niale-avatar-forum-2276db7.jpg', '0', '127.0.0.1');
SET FOREIGN_KEY_CHECKS=1;
