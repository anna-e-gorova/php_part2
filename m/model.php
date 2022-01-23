<?php
function text_get()
{
	return file_get_contents('data/text.txt');
}

function text_set($text)
{
	file_put_contents('data/text.txt', $text);
}

const DRIVER = "mysql";
const HOST = "localhost";
const DB = "shop";
const LOGIN = "root";
const PASS = "root";

function db() {
    static $pdo;

    if ($pdo === null) {
        $connect_str = DRIVER . ':host='. HOST . ';dbname=' . DB;
        $pdo = new PDO($connect_str,LOGIN,PASS);
    }

    return $pdo;
}