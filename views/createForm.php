<?php require_once 'layouts/header.php' ?>
<form action="/news/create" method="post" enctype="multipart/form-data">
    <p>Заголовок новости: <input type="text" name="title"/></p>
    <div class="textArea">
        <p>Текст: <textarea rows="10" name="content"></textarea></p>
    </div>
    <p>Изображение: <input name="preview_image" type="file"/></p>

    <?php if (!empty($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    <p><input type="submit" value="Добавить новость"/></p>
</form>