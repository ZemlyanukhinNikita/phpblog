﻿<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Blog</title>
    <link href="../views/assets/css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="header">
    <h1><a href="#">My Blog</a></h1>
    <div class="login">
        <form method="post" action="/login">
            <input type="submit" value="Войти"/>
        </form>
    </div>
</div>
<div class="wrapper">
    <div class="content">
        <?php foreach ($newsList as $item): ?>
            <div class="itemNew">
                <?php if ($item['preview_image_slug']) { ?>
                    <img src="/images/<?php echo $item['preview_image_slug'] ?>" alt=""/>
                <?php } ?>
                <h3><a href="/news/<?php echo $item['id'] ?>"> <?php echo $item['title'] ?></a></h3>
                <p><?php echo $item['content'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="posts">
        <h3>Посты недели </h3>
    </div>
    <ul>
        <?php foreach ($newsList as $item): ?>
            <div class="right">
                <li><a href="/news/<?php echo $item['id'] ?>"> <?php echo $item['title'] ?></a></li>
            </div>
        <?php endforeach; ?>
    </ul>

    <div class="clear"></div>
    <a href="/addNew">Добавить новость</a>
</div>
</body>
</html>