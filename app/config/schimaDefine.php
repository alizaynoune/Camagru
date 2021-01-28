<?php
// Name of tables
define("_users_", "Users");
define("_comment_", "Comments");
define("_posts_", "Posts");
define("_Postlike_", "PostLikes");
define("_Commentlike_", "CommentLikes");


$DB_SELECT = array (
    "_user"         => "SELECT  login FROM Users WHERE id = ?",
    "_passowrd"     => "SELECT `pwd` FROM Users WHERE id = ?",
    "_email"        => "SELECT `email` FROM Users WHERE id = ?",
    "_userinfo"     => "SELECT `login`, `email`,`frestname`, `lastname`, `potoid`, `notif` FROM Users WHERE id = ?",
    "_posts"        => "SELECT `url`, `id` FROM Posts WHERE uid = ?",
    "_photoProfile" => "SELECT `url` FROM Posts WHERE id = ?",
    "_comment"      => "SELECT `login`, `id` FROM Users WHERE id = ?",
    "_allposts"     => "SELECT `login`, `id` FROM Users WHERE id = ?",
    "_notif"  => "SELECT `login`, `id` FROM Users WHERE id = ?"
);

$DB_INSERT = array(
    "_user"         => "INSERT INTO Users (login, firstname, lastname, email, pwd) VALUES (?, ?, ?, ?, ?)",
    "_post"         => "Posts (uid, url, Date) VALUES(?, ?, NOW());",
    "_comment"      => "Comment (uid, pid, Comment, Date) VALUES(?, ?, ?, NOW());",
    "_like_post"    => "PostLikes (pid, uid, Date) VALUES(?, ?, NOW());",
    "_like_comment" => "CommentLikes (cid, uid, Date) VALUES(?, ?, NOW());",

);

$DB_UPDATE = array(

    "_photoProfile" => "UPDATE Users SET photoid = ? WHERE id = ?;",
    "_activeEmail"  => "UPDATE Users SET active = 'true' WHERE id = ?;",
    "_changePasswd" => "UPDATE Users SET pwd = ? WHERE id = ?;",
    "_email"        => "UPDATE Users SET email = ? WHERE id = ?;",
    "_notif"        => "UPDATE Users SET notif = 'false' WHERE id = ?;",
);

$DB_DELETE = array(
    "_user"         => "",
    "_post"         => "",
    "_like_comment" => "",
    "_like_post"    => "",
);

// DELETE

