<?php
$DB_CREAT = array(
    _table => "CREATE TABLE",
    _database => "CREATE DATABASE",
    _uid => "ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    _id => "",
    _password => "",
    _firstname => "VARCHAR(10) NOT NULL",
    _lastname => "VARCAHR(10) NOT NULL",
    _email => "VARCHAR(50) NOT NULL",
    _string => "VARCHAR(120)",
    _date => "DATETIME NOT NULL",
    _active => "ENUMM (`true`, `false`)",
    _notif => "ENUMM (`true`, `false`)"
);

$NAME_TABLE = array (
    _users => "",
    _usersinfo => "",
    _userPasswd => "",
    _comment => "",
    _photos => "",
    _posts => ""
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