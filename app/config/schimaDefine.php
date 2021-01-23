<?php
// Name of tables
define("_users_", "Users");
define("_usersinfo_", "UsersInfo");
define("_passwd_", "UserPasswd");
define("_comment_", "Comments");
define("_posts_", "Posts");
define("_Postlike_", "PostLikes");
define("_Commentlike_", "CommentLikes");

$DB_CREATE = array(
    "_table"        => " CREATE TABLE ",
    "_aid"          => "INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "_id"           => "INT(6) UNSIGNED NOT NULL",
    "_id_0"         => "INT(6) UNSIGNED NOT NULL DEFAULT 0",
    "_login"        => "VARCHAR(8) NOT NULL",
    "_name"         => "VARCHAR(10) NOT NULL",
    "_email"        => "email VARCHAR(20) NOT NULL",
    "_pwd"          => "pwd VARCHAR(100) NOT NULL",
    "_string"       => "VARCHAR(200) NOT NULL",
    "_comment"      => "VARCHAR(255) NOT NULL",
    "_date"         => "DATETIME NOT NULL",
    "_true_false"   => "ENUM ('true', 'false') NOT NULL",
);

$DB_GET = array (
    "_login"        => "",
    "_passowrd"     => "",
    "_email"        => "",
    "_userinfo"     => "",
    "_photo"        => "",
    "_photoProfile" => "",
    "_comment"      => "",
    "_allposts"     => "",
    "_sedNotif"     => "",
    "_activeNotif"  => ""
);

$DB_INSERT = array(
    "_user"         => "",
    "_photoProfile" => "",
    "_photo"        => "",
    "_comment"      => "",
    "_activeEmail"  => "",
    "_changePasswd" => ""
);

?>