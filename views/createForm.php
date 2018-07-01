<?php require_once 'layouts/header.php' ?>
<div class="wrapper">
    <div class="content">
<form action="/news/create" method="post" enctype="multipart/form-data">
    <p>Заголовок новости: </p><input type="text" name="title" required/>
    <div class="textArea">
        <p>Текст: </p><textarea rows="10" name="content"></textarea>
    </div>
    <input type="hidden" name="max_size" value="1000000">
    <p>Изображение: <input name="preview_image" type="file" accept=".svg, .jpg, .jpeg, .png, .gif, .bmp"/></p>
    <?php if (!empty($errorMessage)) { ?>
        <p><?php echo $errorMessage; ?></p>
    <?php } ?>
    <p><input type="submit" value="Добавить новость"/></p>
</form>
    </div>
</div>
