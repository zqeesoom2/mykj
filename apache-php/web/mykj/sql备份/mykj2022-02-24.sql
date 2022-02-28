/*
SQLyog Ultimate v8.32 
MySQL - 8.0.23 : Database - mykj
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mykj` /*!40100 DEFAULT CHARACTER SET gbk */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `mykj`;

/*Table structure for table `pre_answer` */

DROP TABLE IF EXISTS `pre_answer`;

CREATE TABLE `pre_answer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL COMMENT '回答的用户',
  `answer` varchar(2000) NOT NULL COMMENT '回答内容',
  `newstime` int NOT NULL COMMENT '回复时间',
  `qid` int NOT NULL COMMENT '回复那条提问',
  `imgs` varchar(500) DEFAULT '0' COMMENT '回答的图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=gbk COMMENT='回复表';

/*Data for the table `pre_answer` */

insert  into `pre_answer`(`id`,`uid`,`answer`,`newstime`,`qid`,`imgs`) values (1,2,'我是谢xx你有什么问题呢？',1624807698,1,'//wx.schoolxt.cn/static/upload/image/2021/06/232819583375.jpg'),(5,2,'你好，有什么问题啊?',1624891691,1,'//wx.schoolxt.cn/static/upload/image/2021/06/224811150705.jpg'),(6,2,'只是一个模拟调试的结果',1624891761,1,'//wx.schoolxt.cn/static/upload/image/2021/06/224921768034.jpg'),(7,2,'请问一下你的问题是什么',1624891916,1,'//wx.schoolxt.cn/static/upload/image/2021/06/22515652824.jpg'),(8,2,'请问一下你的问题是什么',1624891959,1,'//wx.schoolxt.cn/static/upload/image/2021/06/225239817632.jpg'),(9,1,'只是一个模拟调试的结果',1624892533,1,'//wx.schoolxt.cn/static/upload/image/2021/06/230213707594.jpg'),(10,2,'我去',1624892977,1,'//wx.schoolxt.cn/static/upload/image/2021/06/20210628230937449425.jpg'),(11,2,'非常不错',1625153438,1,'0'),(12,2,'你还有问题吗？',1625154749,1,'0'),(13,2,'你在干什么？',1625154962,1,'0');

/*Table structure for table `pre_column` */

DROP TABLE IF EXISTS `pre_column`;

CREATE TABLE `pre_column` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `text` char(8) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL,
  `pid` smallint NOT NULL,
  `level` tinyint NOT NULL,
  `url` varchar(55) CHARACTER SET gbk COLLATE gbk_chinese_ci DEFAULT NULL,
  `deleteTime` int DEFAULT NULL,
  `softDelete` tinyint(1) DEFAULT '0' COMMENT '1代表删除',
  `img` varchar(16) CHARACTER SET gbk COLLATE gbk_chinese_ci DEFAULT NULL COMMENT '栏目图标',
  `weight` int DEFAULT '0' COMMENT '重权',
  PRIMARY KEY (`id`),
  UNIQUE KEY `text` (`text`,`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=gbk COMMENT='功能栏目表';

/*Data for the table `pre_column` */

insert  into `pre_column`(`id`,`text`,`pid`,`level`,`url`,`deleteTime`,`softDelete`,`img`,`weight`) values (1,'在线学法',-1,0,NULL,1623938569,1,NULL,0),(2,'法治看点',1,1,NULL,1623938565,1,NULL,0),(3,'3',1,1,NULL,1621532829,1,NULL,0),(5,'管理',-1,0,'',NULL,0,NULL,0),(6,'角色管理',5,1,'Role/tree.html',NULL,0,'incon_qzfk',0),(8,'7',5,1,NULL,1621533215,1,NULL,0),(9,'4',1,1,NULL,1621532936,1,NULL,0),(10,'功能栏目',5,1,'ColumnTree/tree.html',NULL,0,'incon_column',0),(12,'9',5,1,NULL,1621611753,1,NULL,0),(13,'8',18,1,NULL,1621611757,1,NULL,0),(16,'查看会员',5,1,'Member/member.html',NULL,0,'incon_ckgg',0),(18,'法律法规',-1,0,'0',1621871340,1,NULL,0),(24,'新闻栏目',5,1,'NewsColumn/tree.html',NULL,0,'incon_column',0),(25,'发布新闻',5,1,'News/add.html',NULL,0,'incon_yjjb',0),(35,'账户管理',-1,0,NULL,1623938866,1,NULL,0),(36,'修改密码',35,1,NULL,1623938863,1,NULL,0),(57,'查看新闻',5,1,'News/list.html',NULL,0,'incon_ckgg',0);

/*Table structure for table `pre_contents` */

DROP TABLE IF EXISTS `pre_contents`;

CREATE TABLE `pre_contents` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nid` int unsigned NOT NULL COMMENT '新闻ID',
  `content` varchar(6000) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL COMMENT '新闻内容',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=gbk COMMENT='新闻内容表';

/*Data for the table `pre_contents` */

insert  into `pre_contents`(`id`,`nid`,`content`) values (1,9,'<p>测试标题11111 测试标题1111 测试标题11111 1111</p>'),(2,10,'<p>测试标题2&nbsp;测试标题2&nbsp;测试标题 2</p>'),(3,11,''),(4,12,'<p>测试6<img src=\"/static/upload/image/202107/1625851699235546.jpg\" title=\".jpg \"/></p>');

/*Table structure for table `pre_jssdk` */

DROP TABLE IF EXISTS `pre_jssdk`;

CREATE TABLE `pre_jssdk` (
  `access_token` varchar(512) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL COMMENT 'js-sdk调用凭证',
  `expires` int NOT NULL,
  `id` tinyint(1) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `ticket` varchar(512) DEFAULT NULL COMMENT 'jsapi_ticket票据',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

/*Data for the table `pre_jssdk` */

insert  into `pre_jssdk`(`access_token`,`expires`,`id`,`ticket`) values ('54_M69iq2C163jVhrscbYryAPWk-XlB2mO6ey8Vasb-Dve9TssIRzdmojMZBDkBAFXsabWpIOVoCVws3vGENERsJlgU7RRb6j9UrA03_O-FYPEIpTI22Wb6BGDZHwEMDi2dvKlV55yHpHz-a8jWVQKgAIAQLF',1645644696,1,'O3SMpm8bG7kJnF36aXbe8xo2crj6YpamOZdd4MBclV-55Kl1JaZgXZjP-aVoltoTv8NXsFO_-MtjhE7yNEUqGg');

/*Table structure for table `pre_member` */

DROP TABLE IF EXISTS `pre_member`;

CREATE TABLE `pre_member` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL DEFAULT '0',
  `password` varchar(16) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL DEFAULT '0',
  `master` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0普通会员，2律师，1超级管理员，3普通管理员,4法律工作者',
  `openid` varchar(255) NOT NULL DEFAULT '0',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '值为1时是男性，值为2时是女性，值为0时是未知',
  `headimgurl` varchar(255) NOT NULL DEFAULT '0',
  `softDelete` tinyint(1) DEFAULT '0' COMMENT '0正常',
  `contact` varchar(11) CHARACTER SET gbk COLLATE gbk_chinese_ci DEFAULT '0' COMMENT '联系电话',
  `address` varchar(33) CHARACTER SET gbk COLLATE gbk_chinese_ci DEFAULT '0' COMMENT '地址',
  `company` varchar(33) DEFAULT '0' COMMENT '工作单位',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

/*Data for the table `pre_member` */

insert  into `pre_member`(`id`,`username`,`password`,`master`,`openid`,`sex`,`headimgurl`,`softDelete`,`contact`,`address`,`company`) values (1,'adminstro','654321',1,'0',0,'https://img0.baidu.com/it/u=2387147864,2361571229&fm=26&fmt=auto&gp=0.jpg',0,'0','0','0'),(2,'青山绿水','123',0,'oKyNS6gUqmO2bmmwm2AkEwjQEvxk',1,'https://thirdwx.qlogo.cn/mmopen/vi_32/cic7P7FONGsIJ2CUw0E5bY2a3baaVIpeLGrUlicdLSGCyTR8ekbu368IaANicdnNjfY1oL9ce2QNGERfMicd7qgsfw/132',0,'13974398571','阿拉地区','0');

/*Table structure for table `pre_news` */

DROP TABLE IF EXISTS `pre_news`;

CREATE TABLE `pre_news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `source` varchar(20) NOT NULL DEFAULT '0' COMMENT '来源',
  `author` varchar(10) NOT NULL DEFAULT '0',
  `column` int NOT NULL COMMENT '栏目类型',
  `newstime` int NOT NULL COMMENT '发布时间',
  `attr` varchar(3) NOT NULL DEFAULT '0' COMMENT '1加粗，2加红',
  `cover` varchar(65) NOT NULL DEFAULT '0' COMMENT '封面',
  `deleteTime` int NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '2' COMMENT '0不通过，1通过，2待审核',
  `softDelete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0正常 ',
  `url` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL DEFAULT '0' COMMENT '外链',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=gbk;

/*Data for the table `pre_news` */

insert  into `pre_news`(`id`,`title`,`source`,`author`,`column`,`newstime`,`attr`,`cover`,`deleteTime`,`status`,`softDelete`,`url`) values (9,'测试标题 1','测试标题 ','测试标题 ',1,1625587200,'','',0,2,0,'0'),(10,'测试标题 2','测试标题 2','测试标题 2',1,1625587200,'','',0,1,0,'0'),(11,'测试5','测试5','测试5',1,1625673600,'1','',0,2,0,'https://mp.weixin.qq.com/s/rCn9j2pYW-_3MtzMc7tEuw'),(12,'测试6','测试6','测试6',5,1625673600,'','/static/upload/image/2021/cover/20210710012813588459.jpg',0,2,0,'');

/*Table structure for table `pre_newscolumn` */

DROP TABLE IF EXISTS `pre_newscolumn`;

CREATE TABLE `pre_newscolumn` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `text` char(8) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL,
  `pid` smallint NOT NULL,
  `level` tinyint NOT NULL,
  `url` varchar(55) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL DEFAULT '0' COMMENT '外链',
  `deleteTime` int NOT NULL DEFAULT '0',
  `softDelete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1代表删除',
  `img` varchar(16) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL DEFAULT '0' COMMENT '栏目图标',
  `weight` int NOT NULL DEFAULT '0' COMMENT '重权排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `text` (`text`,`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=gbk COMMENT='新闻栏目表';

/*Data for the table `pre_newscolumn` */

insert  into `pre_newscolumn`(`id`,`text`,`pid`,`level`,`url`,`deleteTime`,`softDelete`,`img`,`weight`) values (1,'法治宣传',-1,0,'',0,0,'',0),(2,'普法活动',-1,0,'',0,0,'',0),(3,'民法典',1,1,'',0,0,'',1),(4,'法治看点',1,1,'',0,0,'',2),(5,'法治热点',1,1,'',0,0,'',3),(6,'以案释法',1,1,'',0,0,'',4);

/*Table structure for table `pre_power` */

DROP TABLE IF EXISTS `pre_power`;

CREATE TABLE `pre_power` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `power` varchar(25) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL COMMENT '权限',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=gbk;

/*Data for the table `pre_power` */

insert  into `pre_power`(`id`,`uid`,`power`) values (7,2,'4');

/*Table structure for table `pre_questing` */

DROP TABLE IF EXISTS `pre_questing`;

CREATE TABLE `pre_questing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` varchar(2000) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL COMMENT '追问内容',
  `newstime` int NOT NULL DEFAULT '0' COMMENT '追问时间',
  `aid` int NOT NULL COMMENT '追问那条回答',
  `imgs` varchar(500) DEFAULT NULL COMMENT '追问的图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=gbk COMMENT='追问表只能被追问的律师看见，其他人看不见追问';

/*Data for the table `pre_questing` */

insert  into `pre_questing`(`id`,`question`,`newstime`,`aid`,`imgs`) values (5,'我可以这样操作吗？',1625047903,10,'0'),(6,'嗯。八九十',1625048098,9,'//wx.schoolxt.cn/static/upload/image/2021/06/20210630181458372361.jpg'),(10,'如何看',1625168737,13,'0');

/*Table structure for table `pre_quiz` */

DROP TABLE IF EXISTS `pre_quiz`;

CREATE TABLE `pre_quiz` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quiz` varchar(2000) NOT NULL COMMENT '问题',
  `mobile` char(11) NOT NULL,
  `newstime` int NOT NULL COMMENT '发布时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 1结束 0正在进行中',
  `imgs` varchar(500) CHARACTER SET gbk COLLATE gbk_chinese_ci DEFAULT NULL,
  `uid` int DEFAULT NULL COMMENT '提问者的用户ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=gbk COMMENT='用户提问表';

/*Data for the table `pre_quiz` */

insert  into `pre_quiz`(`id`,`quiz`,`mobile`,`newstime`,`status`,`imgs`,`uid`) values (1,'只是一个模拟调试的结果','13974396666',1623335198,0,'//wx.schoolxt.cn/static/upload/image/2021/06/010943995592.jpg.bak|//wx.schoolxt.cn/static/upload/image/2021/06/010943217073.jpg.bak',2),(14,'什么情况？','13974398571',1623344982,0,'//wx.schoolxt.cn/static/2021/06/010943995592.jpg|//wx.schoolxt.cn/static/2021/06/010943217073.jpg|//wx.schoolxt.cn/static/2021/06/010944387729.jpg|',2);

/*Table structure for table `pre_role` */

DROP TABLE IF EXISTS `pre_role`;

CREATE TABLE `pre_role` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `text` char(8) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL,
  `pid` smallint NOT NULL,
  `level` tinyint NOT NULL,
  `url` varchar(55) CHARACTER SET gbk COLLATE gbk_chinese_ci DEFAULT NULL COMMENT '权限',
  `deleteTime` int DEFAULT NULL,
  `softDelete` tinyint(1) DEFAULT '0' COMMENT '1代表删除',
  `img` varchar(16) DEFAULT NULL COMMENT '小图标',
  `weight` int DEFAULT '0' COMMENT '重权',
  PRIMARY KEY (`id`),
  UNIQUE KEY `text` (`text`,`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=gbk COMMENT='角色表';

/*Data for the table `pre_role` */

insert  into `pre_role`(`id`,`text`,`pid`,`level`,`url`,`deleteTime`,`softDelete`,`img`,`weight`) values (3,'编辑人员',17,1,'25,57',1624096768,1,'0',0),(4,'管理人员',17,1,'25,57',NULL,0,'0',0),(7,'财务',-1,0,NULL,1624016823,1,'0',0),(9,'超级管理人员',17,1,'5,6,10,16,25,57',NULL,0,'0',0),(17,'岗位角色',-1,0,'',NULL,0,'',0);

/*Table structure for table `pre_session` */

DROP TABLE IF EXISTS `pre_session`;

CREATE TABLE `pre_session` (
  `sid` char(26) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL DEFAULT '',
  `ip` char(15) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL DEFAULT '' COMMENT '客户端ip',
  `update_time` int unsigned NOT NULL DEFAULT '0',
  `data` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `sid` (`sid`)
) ENGINE=MEMORY DEFAULT CHARSET=gbk;

/*Data for the table `pre_session` */

/*Table structure for table `pre_supplement` */

DROP TABLE IF EXISTS `pre_supplement`;

CREATE TABLE `pre_supplement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quizId` int NOT NULL COMMENT '咨询的ID',
  `supplement` varchar(2000) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL COMMENT '补充的问题',
  `imgs` varchar(500) DEFAULT NULL COMMENT '补充的图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=gbk COMMENT='补充问题表';

/*Data for the table `pre_supplement` */

insert  into `pre_supplement`(`id`,`quizId`,`supplement`,`imgs`) values (1,1,'我的电话是13974398571','//wx.schoolxt.cn/static/upload/image/2021/06/20210629215336804050.jpg|//wx.schoolxt.cn/static/upload/image/2021/06/20210629215339168511.jpg'),(2,1,'我补充一个问题',''),(3,1,'衬寺地','');

/*Table structure for table `pre_valuation` */

DROP TABLE IF EXISTS `pre_valuation`;

CREATE TABLE `pre_valuation` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL COMMENT '发起评价的用户',
  `byuid` int NOT NULL COMMENT '被评论的律师',
  `star` tinyint(1) NOT NULL DEFAULT '5' COMMENT '星级最高是5星',
  `valuation` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL DEFAULT '0' COMMENT '评价的内容',
  `newstime` int NOT NULL COMMENT '什么时候评论的',
  `quizId` int NOT NULL COMMENT '咨询ID',
  `platform` varchar(255) CHARACTER SET gbk COLLATE gbk_chinese_ci NOT NULL DEFAULT '0' COMMENT '平台的评价',
  `win` tinyint(1) DEFAULT '0' COMMENT '中标',
  `like` tinyint(1) DEFAULT '0' COMMENT '点赞',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=gbk COMMENT='咨询结束时对律师的回答评价表';

/*Data for the table `pre_valuation` */

insert  into `pre_valuation`(`id`,`uid`,`byuid`,`star`,`valuation`,`newstime`,`quizId`,`platform`,`win`,`like`) values (7,2,2,5,'非常不错，赞，谢谢',1625672890,1,'司法局为人民办实事赞，谢谢',0,1),(8,2,1,5,'0',1625593383,1,'0',0,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
