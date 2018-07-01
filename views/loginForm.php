<?php session_start(); ?>
<?php require_once 'layouts/header.php' ?>
<div class="wrapper">
    <div class="content">
        <form action="/login/authorize" method="post">
            <p>Имя пользователя: </p><input type="text" name="login" required/>
            <p>Пароль: </p><input type="password" name="password" required/>
            <?php if (!empty($errorMessage)) { ?>
                <p><?php echo $errorMessage; ?></p>
            <?php } ?>
            <p><input type="submit" value="Войти"/></p>
        </form>
    </div>
</div>