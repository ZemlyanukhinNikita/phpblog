<form action="/create" method="post" enctype="multipart/form-data">
    <p>Заголовок новости: <input type="text" name="title" /></p>
    <p>Текст: <textarea rows="10" cols="45" name="content"></textarea></p>
    <p>Изображение: <input name="preview_image" type="file"/></p>

    <?php if(!empty($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    <p><input type="submit" value="Добавить новость" /></p>
</form>