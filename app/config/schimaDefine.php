<?php
// Name of tables
define("_users_", "Users");
define("_comment_", "Comments");
define("_posts_", "Posts");
define("_Postlike_", "PostLikes");
define("_Commentlike_", "CommentLikes");

$DB_CREATE = array(
    "_table"        => " CREATE TABLE ",
    "_aid"          => "INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "_id"           => "INT(6) UNSIGNED NOT NULL",
    "_id_0"         => "INT(6) UNSIGNED NOT NULL DEFAULT 0",
    "_login"        => "VARCHAR(15) NOT NULL",
    "_name"         => "VARCHAR(10) NOT NULL",
    "_email"        => "email VARCHAR(50) NOT NULL",
    "_pwd"          => "pwd VARCHAR(150) NOT NULL",
    "_string"       => "VARCHAR(200) NOT NULL",
    "_comment"      => "VARCHAR(255) NOT NULL",
    "_date"         => "DATETIME NOT NULL",
    "_true_false"   => "ENUM ('true', 'false') NOT NULL DEFAULT 'false'",
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
    "_user"         => "Users (login, firstname, lastname, email, pwd, dateCreate) VALUES ",
    "_post"         => "Posts (uid, path, dateCreate) VALUES ",
    "_comment"      => "",
    "_like_post"    => "",
    "_like_comment" => "",

);

$DB_UPDATE = array(

    "_photoProfile" => "UPDATE Users SET photoid = photo? WHERE id = id?",
    "_activeEmail"  => "UPDATE Users SET active_email = 'true' WHERE id = id?",
    "_changePasswd" => "UPDATE Users SET pwd = pwd? WHERE id = id?",
    "_email"        => "",
    "_notif"        => "",
);

$DB_DELETE = array(
    "_user"         => "",
    "_post"         => "",
    "_like_comment" => "",
    "_like_post"    => "",
);

// DELETE

?>