<?php if($user): ?>
    <p>Привет <?= $user ?> (Роль: <?= $_SESSION['userType'] ?>), <a href="/?c=auth&a=logout">Выйти</a></p>
    <p>Вы зашли в свой аккаунт <?= $_COOKIE['visitCount' . $user] ?? 1 ?> раз(а)</p>
    <br>
    <?php if($_SESSION['userType'] == 'Admin'): ?>
         <a href="/">Главная</a>
         <a href="/?c=posts">Посты</a>
         <a href="/?c=users">Пользователи</a>
    <?php elseif ($_SESSION['userType'] == 'Author' || $_SESSION['userType'] == 'User'): ?>
         <a href="/">Главная</a>
         <a href="/?c=posts">Посты</a>
    <?php endif; ?>
<?php else: ?>
    <?php if(isset($_SESSION['error'])): ?>
         <p style="color: red;"><?= $_SESSION['error'] ?></p>
         <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
     <form action="/?c=auth&a=login" method="post">
         <label>
             <input type="text" name="login" required>
         </label>
         <label>
             <input type="password" name="pass" required>
         </label>
         <label>
             <input type="submit" value="Войти">
         </label>
     </form>
    <br>
    <a href="/">Главная</a>
<?php endif; ?>