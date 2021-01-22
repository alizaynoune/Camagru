<?php
// Name of tables
define("_users_", "Users");
define("_usersinfo_", "UsersInfo");
define("_passwd_", "UserPasswd");
define("_comment_", "UserComment");
define("_posts_", "UserPosts");
define("_Plike_", "PhotoLikes");
define("_Clike_", "CommentLikes");

$DB_CREATE = array(
    _table => " CREATE TABLE ",
    _database => " CREATE DATABASE ",
    _aid => " INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ",
    _id =>  " INT(6) UNSIGNED NOT NULL",
    _idphoto => " INT(6) UNSIGNED NOT NULL DEFAULT 0",
    _upwd => " upwd VARCHAR(100) NOT NULL ",
    _login => " login VARCHAR(8) NOT NULL ",
    _firstname => " firstname VARCHAR(10) NOT NULL ",
    _lastname => " lastname VARCHAR(10) NOT NULL ",
    _email => " email VARCHAR(50) NOT NULL ",
    _string => " comment VARCHAR(120) ",
    _date => " date DATETIME NOT NULL ",
    _active => " active ENUM ('true', 'false') NOT NULL ",
    _notif => " notif ENUMM (`true`, `false`) ",
);

$DB_GET = array (
    _login => "",
    _passowrd => "",
    _email => "",
    _userinfo => "",
    _photo => "",
    _photoProfile => "",
    _comment => "",
    _allposts => "",
    _sedNotif => "",
    _activeNotif => ""
);

$DB_INSERT = array(
    _user => "",
    _photoProfile => "",
    _photo => "",
    _comment => "",
    _activeEmail => "",
    _changePasswd => ""
);

?>