<?php require_once 'layouts/header.php' ?>

<div class="wrapper">

    <div class="content">
        <?php if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']['isAdmin'] == 1) { ?>
            <span class="addNew"><h3><a href="/news/addNew">Добавить новость</a></h3></span>
        <?php } ?>
        <?php foreach ($newsList as $item): ?>
            <div class="itemNew">
                <?php if ($item['preview_image_slug']) { ?>
                    <img src="<?php echo $item['preview_image_slug'] ?>" alt=""/>
                <?php } ?>
                <h3><a href="/news/<?php echo $item['id'] ?>"> <?php echo $item['title'] ?></a></h3>
                <p><?php
                    $text = html_entity_decode($item['content']);
                    echo mb_substr($text, 0, 300) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="weekPosts">
        <span class="posts"><h3>Посты недели </h3></span>
        <ul>
            <?php foreach ($topNewsList as $item): ?>
                <div class="right">
                    <li><a href="/news/<?php echo $item['id'] ?>"> <?php echo $item['title'] ?></a></li>
                </div>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="clear"></div>
</div>
</body>
</html>
