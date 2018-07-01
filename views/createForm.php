<?php require_once 'layouts/header.php' ?>
<form action="/news/create" method="post" enctype="multipart/form-data">
    <p>Заголовок новости: <input type="text" name="title" required/></p>
    <div class="textArea">
        <p>Текст: <textarea rows="10" name="content"></textarea></p>
    </div>
    <input type="hidden" name="max_size" value="1000000">
    <p>Изображение: <input name="preview_image" type="file" accept=".svg, .jpg, .jpeg, .png, .gif, .bmp"/></p>
    <?php if (!empty($errorMessage)) { ?>
        <p><?php echo $errorMessage; ?></p>
    <?php } ?>
    <p><input type="submit" value="Добавить новость"/></p>
</form>