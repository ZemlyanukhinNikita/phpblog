<p><?php echo $itemNew['title'] ?></p>
<p><?php echo $itemNew['content'] ?></p>
<?php if ($itemNew['preview_image_slug']) { ?>
    <img src="/images/<?php echo $itemNew['preview_image_slug'] ?>" alt=""/>
<?php } ?>
<a href="/news/editNew/<?php echo $itemNew['id'] ?>">Редактировать новость</a>
