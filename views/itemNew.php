<?php session_start(); ?>
<?php require_once 'layouts/header.php' ?>
    <p><?php echo $itemNew['title'] ?></p>
    <p><?php echo $itemNew['content'] ?></p>
<?php if ($itemNew['preview_image_slug']) { ?>
    <img src="<?php echo $itemNew['preview_image_slug'] ?>" alt=""/>
<?php } ?>
<?php if (isset($_SESSION['logged_user'])) { ?>
    <a href="/news/editNew/<?php echo $itemNew['id'] ?>">Редактировать новость</a>
<?php } ?>