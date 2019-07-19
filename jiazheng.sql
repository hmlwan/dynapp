
--
-- 表的结构 `blue_job_type` 工作类型
--
drop table IF EXISTS blue_job_type;
CREATE TABLE IF NOT EXISTS `blue_job_type` (
  `type_id` int(10) unsigned NOT NULL auto_increment comment '--自增--', 
  `type_name` varchar(128) NULL DEFAULT '' comment ' --默认标题名称',
  `status` int(10) unsigned NOT NULL DEFAULT '1' comment '--状态1：开启 0：关闭', 
  `op_time` int(10) unsigned  NOT NULL DEFAULT '0' comment '--操作人--', 
  `op_man` varchar(64)  NOT NULL DEFAULT '' comment '--操作时间--', 
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的结构 `blue_jober` 工作阿姨
--
drop table IF EXISTS blue_jober;
CREATE TABLE IF NOT EXISTS `blue_jober` (
  `id` int(10) unsigned NOT NULL auto_increment comment '--自增--',
  `type_id` int(10) unsigned NOT NULL comment '工作类型',  
  `name` varchar(128) NULL DEFAULT '' comment ' 姓名',
  `head_img` varchar(200)  NULL DEFAULT '' comment '头像', 
  `life_img` varchar(200)  NULL DEFAULT '' comment '生活照片', 
  `age` varchar(20)  NULL DEFAULT '' comment '年龄',
  `lang` varchar(20)  NULL DEFAULT '' comment '语言',
  `edu` varchar(20)  NULL DEFAULT '' comment '教育',
  `area` varchar(100)  NULL DEFAULT '' comment '区域',
  `place` varchar(50)  NULL DEFAULT '' comment '籍贯', 
  `zodiac` varchar(50)  NULL DEFAULT '' comment '属相', 
  `work_years` varchar(50)  NULL DEFAULT '' comment '工作年限', 
  `certificate` varchar(1024)  NULL DEFAULT '' comment '资质证书',
  `work_exp` varchar(2048)  NULL DEFAULT '' comment '工作经历',   
  `work_skill` varchar(1024)  NULL DEFAULT '' comment '专业技巧',   
  `evaluate` varchar(1024)  NULL DEFAULT '' comment '自我评价',   
  `op_time` int(10) unsigned  NOT NULL DEFAULT '0' comment '--操作人--', 
  `op_man` varchar(64)  NOT NULL DEFAULT '' comment '--操作时间--', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 表的结构 `blue_train_course` 培训课程
--
drop table IF EXISTS blue_train_course;
CREATE TABLE IF NOT EXISTS `blue_train_course` (
  `id` int(10) unsigned NOT NULL auto_increment comment '--自增--',
  `course_name` varchar(128) NULL DEFAULT '' comment '课程姓名',
  `course_img` varchar(200)  NULL DEFAULT '' comment '课程图片', 
  `introduce` varchar(1024)  NULL DEFAULT '' comment '介绍', 
  `op_time` int(10) unsigned  NOT NULL DEFAULT '0' comment '--操作人--', 
  `op_man` varchar(64)  NOT NULL DEFAULT '' comment '--操作时间--', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 表的结构 `blue_teacher_power` 师资力量
--
drop table IF EXISTS blue_teacher_power;
CREATE TABLE IF NOT EXISTS `blue_teacher_power` (
  `id` int(10) unsigned NOT NULL auto_increment comment '--自增--',
  `name` varchar(128) NULL DEFAULT '' comment '姓名',
  `img` varchar(200)  NULL DEFAULT '' comment '头像',
  `position` varchar(100)  NULL DEFAULT '' comment '职位', 
  `introduce` varchar(1024)  NULL DEFAULT '' comment '介绍', 
  `op_time` int(10) unsigned  NOT NULL DEFAULT '0' comment '--操作人--', 
  `op_man` varchar(64)  NOT NULL DEFAULT '' comment '--操作时间--', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 表的结构 `blue_join_train` 我要培训
--
drop table IF EXISTS blue_join_train;
CREATE TABLE IF NOT EXISTS `blue_join_train` (
  `id` int(10) unsigned NOT NULL auto_increment comment '--自增--',
  `name` varchar(128) NULL DEFAULT '' comment '姓名',
  `phone` varchar(50) NULL DEFAULT '' comment '手机号码',
  `courses` varchar(1024)  NULL DEFAULT '' comment '意向课程', 
  `create_time` int(10) unsigned  NOT NULL DEFAULT '0' comment '--提交时间--', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 表的结构 `blue_order_ayi` 预约阿姨
--
drop table IF EXISTS blue_order_ayi;
CREATE TABLE IF NOT EXISTS `blue_order_ayi` (
  `id` int(10) unsigned NOT NULL auto_increment comment '--自增--',
  `name` varchar(128) NULL DEFAULT '' comment '姓名',
  `phone` varchar(50) NULL DEFAULT '' comment '手机号码',
  `jober_id` int(10) unsigned NOT NULL comment '预约阿姨id',  
  `create_time` int(10) unsigned  NOT NULL DEFAULT '0' comment '--提交时间--', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 表的结构 `blue_sub_company` 分公司
--
drop table IF EXISTS blue_sub_company;
CREATE TABLE IF NOT EXISTS `blue_sub_company` (
  `id` int(10) unsigned NOT NULL auto_increment comment '--自增--',
  `name` varchar(128) NULL DEFAULT '' comment '名称',
  `address` varchar(200) NULL DEFAULT '' comment '地址',
  `contact` varchar(50)  NOT NULL DEFAULT '联系人',  
  `phone` varchar(50)   NOT NULL DEFAULT '' comment '联系电话', 
  `op_time` int(10) unsigned  NOT NULL DEFAULT '0' comment '--操作人--', 
  `op_man` varchar(64)  NOT NULL DEFAULT '' comment '--操作时间--',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的结构 `blue_company_info` 公司信息
--
drop table IF EXISTS blue_company_info;
CREATE TABLE IF NOT EXISTS `blue_company_info` (
  `id` int(10) unsigned NOT NULL auto_increment comment '--自增--',
  `name` varchar(128) NULL DEFAULT '' comment '名称',
  `introduce` text  DEFAULT '' comment '简介',
  `culture` varchar(200) NULL DEFAULT '' comment '企业文化',
  `service` varchar(1024)  NOT NULL DEFAULT '企业服务',  
  `img` varchar(2048)   NOT NULL DEFAULT '' comment '服务图片', 
  `op_time` int(10) unsigned  NOT NULL DEFAULT '0' comment '--操作人--', 
  `op_man` varchar(64)  NOT NULL DEFAULT '' comment '--操作时间--',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的结构 `blue_special_service` 特色服务内容
--
drop table IF EXISTS blue_special_service;
CREATE TABLE IF NOT EXISTS `blue_special_service` (
  `id` int(10) unsigned NOT NULL auto_increment comment '--自增--',
  `name` varchar(128) NULL DEFAULT '' comment '名称',
  `img` varchar(2048)   NOT NULL DEFAULT '' comment '图片', 
  `op_time` int(10) unsigned  NOT NULL DEFAULT '0' comment '--操作人--', 
  `op_man` varchar(64)  NOT NULL DEFAULT '' comment '--操作时间--',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 表的结构 `blue_pub_task` 高单发布
--
drop table IF EXISTS blue_pub_task;
CREATE TABLE IF NOT EXISTS `blue_pub_task` (
  `id` int(10) unsigned NOT NULL auto_increment comment '--自增--',
  `title` varchar(150) NULL DEFAULT '' comment '标题',  
  `work_years` varchar(150) NULL DEFAULT '' comment '工作年限',  
  `live_ask` varchar(100) NULL DEFAULT '' comment '居住要求',  
  `city` varchar(50) NULL DEFAULT '' comment '城市',  
  `content` varchar(200) NULL DEFAULT '' comment '工作内容',
  `ask_skill` varchar(200) NULL DEFAULT '' comment '阿姨要求',
  `salary` varchar(200) NULL DEFAULT '' comment '薪资待遇',
  `contact_person` varchar(100) NULL DEFAULT '' comment '联系人',
  `address` varchar(200) NULL DEFAULT '' comment '总部地址',
  `bus_route` varchar(200) NULL DEFAULT '' comment '乘车路线',
  `contact_phone` varchar(50) NULL DEFAULT '' comment '联系电话',
  `status` tinyint(4)   NOT NULL DEFAULT '1' comment '状态 1：开启 0 关闭', 
  `create_time` int(10) unsigned  NOT NULL DEFAULT '0' comment '发布时间', 
  `op_man` varchar(64)  NOT NULL DEFAULT '' comment '--操作时间--',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 表的结构 `blue_apply_task` 我要应聘
--
drop table IF EXISTS blue_apply_task;
CREATE TABLE IF NOT EXISTS `blue_apply_task` (
  `id` int(10) unsigned NOT NULL auto_increment comment '--自增--',
  `task_id` int(10) unsigned NOT NULL comment '高单id',
  `name` varchar(128) NULL DEFAULT '' comment '姓名',
  `phone` varchar(50) NULL DEFAULT '' comment '手机号码',
  `create_time` int(10) unsigned  NOT NULL DEFAULT '0' comment '--提交时间--', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




















