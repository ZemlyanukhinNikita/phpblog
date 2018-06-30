<?php
ini_set('display_errors',1);
error_reporting(E_ALL);?>
﻿<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>News</title>
    <link href="/views/assets/css/styles.css" rel="stylesheet" type="text/css"/>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({
            selector:'textarea',
            plugins: 'print preview directionality  image link media template  table  hr  anchor toc  lists  help',
            menubar: true

        });</script>
</head>
<body>
<div class="header">
    <h1><a href="/">News</a></h1>
    <div class="login">
        <?php if(isset($_SESSION['logged_user'])) { echo 'Вы вошли,как '. $_SESSION['logged_user']['login'].
            '<form method="post" action="/logout">
            <input type="submit" value="Выход"/>
        </form>';}
        else { ?>
        <form method="post" action="/login">
            <input type="submit" value="Войти"/>
        </form>
        <?php } ?>
    </div>
</div>