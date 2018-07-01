<?php session_start(); ?>
<?php require_once 'layouts/header.php' ?>
<div class="wrapper">
    <div class="content">
        <?php if ($_SESSION['logged_user']['isAdmin'] == 1) { ?>
            <span class="addNew"><h3><a href="/news/editNew/<?php echo $itemNew['id'] ?>">Редактировать новость</a></h3></span>
        <?php } ?>
        <p><?php echo $itemNew['title'] ?></p>
        <p><?php echo $itemNew['content'] ?></p>
        <?php if ($itemNew['preview_image_slug']) { ?>
            <img src="<?php echo $itemNew['preview_image_slug'] ?>" alt=""/>
        <?php } ?>
    </div>
</div>
