<?php
require_once __DIR__ . "/../header.php"; ?>
    <div>
    <h1>Регистрация нового пользователя</h1>
    <?php if (!empty($error)): ?>
        <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
    <?php endif; ?>
    <form action="/studyPHPZone/user/register" method="post">
        <label>Inter Nickname <input type="text" name="nickname"value="<?= $_POST['nickname'] ?? '' ?>"></label><br>
        <label>Inter Email <input type="text" name="email"value="<?= $_POST['email'] ?? '' ?>"></label><br>
        <label>Inter Password <input type="password" name="password"value="<?= $_POST['password'] ?? '' ?>"></label><br>
        <input type="submit" value="register">
    </form>
<?php require_once __DIR__ . "/../footer.php"; ?>