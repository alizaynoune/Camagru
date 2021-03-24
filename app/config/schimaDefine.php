<?php
// Name of tables
// define("_users_", "Users");
// define("_comment_", "Comments");
// define("_posts_", "Posts");
// define("_Postlike_", "PostLikes");
// define("_Commentlike_", "CommentLikes");

$PARAM = array(
    'int'   => PDO::PARAM_INT,
    'str'   => PDO::PARAM_STR,
    'bool'  => PDO::PARAM_BOOL,
    'null'  => PDO::PARAM_NULL, 
);

$DB_SELECT = array (
    "_id"       => "SELECT :select: FROM :table: WHERE id = ?",
    "_login"    => "SELECT :select: FROM :table: WHERE login = ?",
    "_email"    => "SELECT :select: FROM :table: WHERE email = ?",
    "_uid"      => "SELECT :select: FROM :table: WHERE uid = ?",
    "_pid"      => "SELECT :select: FROM :table: WHERE pid = ?",
    
    
    // "_userinfo"     => "SELECT `login`, `email`,`frestname`, `lastname`, `potoid`, `notif` FROM Users WHERE id = ?",
    // "_posts"        => "SELECT `url`, `id` FROM Posts WHERE uid = ?",
    // "_photoProfile" => "SELECT `url` FROM Posts WHERE id = ?",
    // "_comment"      => "SELECT `login`, `id` FROM Users WHERE id = ?",
    // "_allposts"     => "SELECT `login`, `id` FROM Users WHERE id = ?",
    // "_notif"  => "SELECT `login`, `id` FROM Users WHERE id = ?"
);

$DB_INSERT = array(
    "_user"         => "INSERT INTO Users (login, firstname, lastname, pwd) VALUES (?, ?, ?, ?)",
    "_email_user"   => "INSERT INTO tempemail (uid, email, token) VALUES (?, ?, ?)",
    "_avatar"       => "INSERT INTO Avatar (uid, url) VALUES(?, ?)",
    "_post"         => "INSERT INTO Posts (uid, url) VALUES(?, ?);",
    "_post_title"   => "INSERT INTO Posts (uid, url, title) VALUES(?, ?, ?);",
    "_comment"      => "INSERT INTO Comments (uid, pid, Comment) VALUES(?, ?, ?);",
    "_like_post"    => "INSERT INTO PostLikes (pid, uid) VALUES(?, ?);",
    "_like_comment" => "INSERT INTO CommentLikes (cid, uid) VALUES (?, ?);",

);

$DB_UPDATE = array(

    "_id"           => "UPDATE :table: SET :set: WHERE id = ?",
    "_uid"          => "UPDATE :table: SET :set: WHERE uid = ?",
    // "_photoProfile" => "UPDATE Users SET avatar = ? WHERE id = ?;",
    // "_activeEmail"  => "UPDATE Users SET active = ? WHERE id = ?;",
    // "_changePasswd" => "UPDATE Users SET pwd = ? WHERE id = ?;",
    // "_email"        => "UPDATE Users SET email = ? WHERE id = ?;",
    // "_notif"        => "UPDATE Users SET notif = ? WHERE id = ?;",
);

$DB_DELETE = array(
    "_active_email"         => "DELETE FROM :table: WHERE :where: = ? ",
    "_drop"                  => "DELETE FROM :table: WHERE :where: = ? ",
    // "_isactive"              => "",
    // "_post"         => "",
    // "_like_comment" => "",
    // "_like_post"    => "",
);

// DELETE

