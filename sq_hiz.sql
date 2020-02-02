create database sq_hiz;
use sq_hiz;

/* --------------------------------------文章-------------------------------------- */

-- 固定文章信息
create table main(
id int(11) not null,
name varchar(30) not null,
other longtext,
primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
insert into main (id,name) value(1,'公司简介');

-- 信息
create table info_cate(
id int(11) not null auto_increment,
name varchar(60),
sort_order int(11) default 100,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
insert into info_cate (id,name) values(1,'新闻动态');

create table info(
id int(11) not null auto_increment,
ic_id int(11),#info_cate
name varchar(255),
other longtext,
hit int(11) default 0,
sort_order int(11) default 100,
createtime timestamp default CURRENT_TIMESTAMP,
primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 图文
create table photo_cate(
id int(11) not null auto_increment,
name varchar(60),
sort_order int(11) default 100,
pid int(11) default 0,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

create table photo(
id int(11) not null auto_increment,
pc_id int(11),
name varchar(60),
photo varchar(30),
fun text,	-- 内容摘要
other longtext,
up tinyint(1) default 0, -- 0=>不是推荐 1=>推荐
sort_order int(11) default 100,
createtime timestamp default CURRENT_TIMESTAMP,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 成功案例
create table example_cate(
id int(11) not null auto_increment,
name varchar(40),
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
insert into example_cate (id,name) values(1,'成功案例');

create table example(
id int(11) not null auto_increment,
ec_id int(11) not null,
name varchar(60),
photo varchar(30),
other longtext,
up tinyint(1) default 0, -- 0=>不是推荐 1=>推荐
sort_order int(11) default 100,
createtime timestamp default CURRENT_TIMESTAMP,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 文件管理
create table file(
id int(11) not null auto_increment,
name varchar(60),
file varchar(30),
createtime timestamp default CURRENT_TIMESTAMP,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 视频
create table vo_cate(
id int(11) not null auto_increment,
name varchar(40),
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
insert into vo_cate (id,name) values(1,'视频管理1');

create table vo(
id int(11) not null auto_increment,
vc_id int(11) not null,
name varchar(60),
photo varchar(30),
url varchar(255),-- 视频flash地址
other longtext,
up tinyint(1) default 0, -- 0=>不是推荐 1=>推荐
hit int(11) default 0,
sort_order int(11) default 100,
createtime timestamp default CURRENT_TIMESTAMP,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


/* ---------------------------其他----------------------------- */

-- 留言
create table message(
id int(11) not null auto_increment,
company varchar(100),
realname varchar(50),
mail varchar(200),
tel varchar(50),
name varchar(50), -- 主题
other text, -- 留言内容
createtime timestamp default CURRENT_TIMESTAMP,
reother varchar(200),
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 职位
create table job(
id int(11) not null auto_increment,
name varchar(50),
number varchar(10),		-- 招聘人数
educ varchar(20),		-- 学历要求
job varchar(200),		-- 工作经验
sex varchar(20),		-- 性别要求
money varchar(60),		-- 薪资待遇
other text,				-- 具体要求
createtime timestamp default CURRENT_TIMESTAMP, -- 发布时间
endtime timestamp,		-- 截止时间
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 简历
create table resume(
id int(11) not null auto_increment,
job varchar(100),
name varchar(10),		-- 姓名
sex varchar(4),			-- 性别
birthday varchar(20),	-- 生日
marriage varchar(10),	-- 婚姻
school varchar(200),	-- 毕业学校
edue varchar(20),		-- 学历
schooltime varchar(20),	-- 毕业时间
phone varchar(40),		-- 联系电话
mail varchar(100),		-- 邮箱
addr varchar(200),		-- 地址
other text,				-- 水平能力
info text,				-- 个人简历
createtime timestamp default CURRENT_TIMESTAMP,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 文字友情链接
create table url_cate(
id int(11) not null auto_increment,
name varchar(40),
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
insert into url_cate (id,name) values(1, '底部导航');
insert into url_cate (id,name) values(2, '友情链接');

create table url(
id int(11) not null auto_increment,
uc_id int(11),
name varchar(40),
url varchar(100),
sort_order int(11) default 100,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 图文友情链接
create table url_p(
id int(11) not null auto_increment,
name varchar(40),
url varchar(100),
photo varchar(30),
sort_order int(11) default 100,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 幻灯片图片管理
create table dimg_cate(
id int(11) not null auto_increment,
name varchar(60),
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
insert into dimg_cate (id,name) values(1,'幻灯片1');

create table dimg(
id int(11) not null auto_increment,
dc_id int(11),
name varchar(50),
url varchar(150),
photo varchar(30),
sort_order int(11) default 100,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* ---------------------------------- 商城 start ----------------------------------------- */
-- 商品
create table goods_cate(
id int(11) not null auto_increment,
name varchar(60),
pid int(11) default 0,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

create table goods(
id int(11) not null auto_increment,
name varchar(60),			-- 商品名称
gc_id int(11),
photo varchar(30),			-- 图片名称
model varchar(80),			-- 商品类型
price varchar(20),			-- 商品价格
other longtext,
sort_order int(11) default 100,
ilock tinyint(1) default 0,	-- 0->上架 1->下架
up tinyint(1) default 0,	-- 0->未推荐 1->推荐
new tinyint(1) default 0,	-- 0->不是最新 1->是最新
hot tinyint(1) default 0,	-- 0->不是热门 1->是热门
createtime timestamp default CURRENT_TIMESTAMP,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/* ---------------------------------- 商城 end ----------------------------------------- */

/* ----------------------------------- 会员 start ------------------------------------ */
-- 会员
create table user(
id int(11) not null auto_increment,
name varchar(60),		-- 用户名
pass varchar(60),		-- 密码
mail varchar(100),		-- 邮箱
tel varchar(50),		-- 电话
addr varchar(255),		-- 地址
birthday varchar(40),	-- 生日
number varchar(60),		-- 证件号码
createtime timestamp default CURRENT_TIMESTAMP,
islock tinyint(1) default 0, -- 0->锁定 1->未锁
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 搜藏夹
create table user_favorite(
id int(11) not null auto_increment,
us_id int(11),
name varchar(60),	-- 标题
url varchar(255),	-- 地址
createtime timestamp default CURRENT_TIMESTAMP,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/* ----------------------------------- 会员 end ------------------------------------ */

/* ----------------------------------- 系统 start ------------------------------------ */

-- 图片管理配置
create table picture(
id int(11) not null auto_increment,
name varchar(50),	-- 标题
width varchar(10),	-- 宽
height varchar(10),	-- 高
file varchar(50),	-- 文件名称
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 系统配置
create table config(
id int(11) not null auto_increment,
name varchar(40),
value text,
primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 管理员
create table admin(
id int(11) not null auto_increment,
name varchar(20) not null,
pass varchar(35) not null,
lasttime datetime,
lastip varchar(20),
primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

insert into admin (id,name,pass) values (1,'admin','01a575ac6d56d53f0fe32d32c64309af');

/* ----------------------------------- 系统 end ------------------------------------ */
