<?php require_once 'layouts/header.php' ?>
<form action="/news/edit/<?php echo $itemNew['id'] ?>" method="post" enctype="multipart/form-data">
    <p>Заголовок новости: <input type="text" name="title" value="<?php echo $itemNew['title'] ?>"/></p>
    <div class="textArea">
        <p>Текст: <textarea rows="10" cols="45" name="content"><?php echo $itemNew['content'] ?></textarea></p>
    </div>
    <?php if ($itemNew['preview_image_slug']) { ?>
        <img src="<?php echo $itemNew['preview_image_slug'] ?>" alt=""/>
    <?php } ?>
    <p>Изображение: <input name="preview_image" type="file"/></p>

    <?php if (!empty($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    <p><input type="submit" value="Сохранить новость"/></p>
</form>