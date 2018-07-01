<?php require_once 'layouts/header.php' ?>
<div class="wrapper">
    <div class="content">
<form action="/news/edit/<?php echo $itemNew['id'] ?>" method="post" enctype="multipart/form-data">
    <p>Заголовок новости: </p><input type="text" name="title" value="<?php echo $itemNew['title'] ?>" required/>
    <div class="textArea">
        <p>Текст: </p><textarea rows="10" cols="45" name="content"><?php echo $itemNew['content'] ?></textarea>
    </div>
    <?php if ($itemNew['preview_image_slug']) { ?>
        <img src="<?php echo $itemNew['preview_image_slug'] ?>" alt=""/>
    <?php } ?>
    <input type="hidden" name="max_size" value="1000000">
    <p>Изображение: <input name="preview_image" type="file" accept=".svg, .jpg, .jpeg, .png, .gif, .bmp"/></p>

    <?php if (!empty($errorMessage)) { ?>
        <p><?php echo $errorMessage; ?></p>
    <?php } ?>
    <p><input type="submit" value="Сохранить новость"/></p>
</form>
    </div>
</div>