<?php require_once 'layouts/header.php' ?>
<form action="/news/edit/<?php echo $itemNew['id'] ?>" method="post" enctype="multipart/form-data">
    <p>Заголовок новости: <input type="text" name="title" value="<?php echo $itemNew['title'] ?>" required/></p>
    <div class="textArea">
        <p>Текст: <textarea rows="10" cols="45" name="content"><?php echo $itemNew['content'] ?></textarea></p>
    </div>
    <?php if ($itemNew['preview_image_slug']) { ?>
        <img src="<?php echo $itemNew['preview_image_slug'] ?>" alt=""/>
    <?php } ?>
    <p>Изображение: <input name="preview_image" type="file" accept=".svg, .jpg, .jpeg, .png, .gif, .bmp"/></p>

    <?php if (!empty($errorMessage)) { ?>
        <p><?php echo $errorMessage; ?></p>
    <?php } ?>
    <p><input type="submit" value="Сохранить новость"/></p>
</form>