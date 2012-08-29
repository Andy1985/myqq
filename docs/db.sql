set names utf8;
drop database chat;
create database chat;
use chat;

create table users
(
    userId int primary key,
    name varchar(64) not null,
    password varchar(32) not null,
    isLogin tinyint not null default 0
) engine=myisam default charset=utf8;

insert into users(userId,name,password,isLogin) 
    values(100,'李雪明',md5('lixm'),0);
insert into users(userId,name,password,isLogin) 
    values(101,'王小猪',md5('wangyf'),0);

create table messages
(
id int unsigned primary key auto_increment,
sender varchar(64) not null,
getter varchar(64) not null,
content varchar(3600) not null,
sendTime datetime not null,
isGet tinyint not null default 0
) engine=myisam default charset=utf8;

create table logs
(
    id int unsigned primary key auto_increment,
    type tinyint not null default 0,
    user varchar(64) not null,
    time datetime not null,
    option varchar(128) not null,
    remark varchar(128) not null
) engine=myisam default charset=utf8;
