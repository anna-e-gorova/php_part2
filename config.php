<?php

const SERVER = "localhost";
const DB = "shop";
const LOGIN = "root";
const PASS = "root";

$con = mysqli_connect(SERVER,LOGIN,PASS,DB) or die("Ошибка соединения с базой данных");