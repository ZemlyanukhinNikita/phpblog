<?php require_once 'layouts/header.php'?>
<form action="/login/authorize" method="post">
    <p>Имя пользователя: <input type="text" name="login" /></p>
    <p>Пароль: <input type="password" name="password" /></p>
    <?php if(!empty($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    <p><input type="submit" value="Войти" /></p>
</form>