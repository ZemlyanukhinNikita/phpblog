<?php session_start(); ?>
<?php require_once 'layouts/header.php' ?>

<div class="wrapper">

    <div class="content">
        <?php if ($_SESSION['logged_user']['isAdmin'] == 1) { ?>
            <span class="addNew"><h3><a href="/news/addNew">Добавить новость</a></h3></span>
        <?php } ?>
        <?php foreach ($newsList as $item): ?>
            <div class="itemNew">
                <?php if ($item['preview_image_slug']) { ?>
                    <img src="<?php echo $item['preview_image_slug'] ?>" alt=""/>
                <?php } ?>
                <h3><a href="/news/<?php echo $item['id'] ?>"> <?php echo $item['title'] ?></a></h3>
                <p><?php
                    $text = strip_tags($item['content']);
                    echo substr($text, 0, 300) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="weekPosts">
        <span class="posts"><h3>Посты недели </h3></span>
        <ul>
            <?php
            //берем дату ровно неделю назад
            $weekAgo = date("Y-m-d H:i:s", mktime(date('h'), date('i'), date('s'), date('m'), date('d') - 7, date('Y')));
            //создаем новый массив новостей опубликованных за эту неделю
            $newArrayList = [];
            foreach ($newsList as $item) {
                if ($item['created_at'] > $weekAgo)
                    $newArrayList[] = $item;
            }
            //сортируем полученный массив, по полю 'просмотры'
            usort($newArrayList, function ($a, $b) {
                if ($a['views'] == $b['views']) {
                    return 0;
                }
                return ($a['views'] < $b['views']) ? +1 : -1;
            });
            $i = 0;
            //выводим 10 самых просматриваемых новостей за эту неделю
            foreach ($newArrayList as $item): ?>
                <?php if ($i++ == 10) break; ?>
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
