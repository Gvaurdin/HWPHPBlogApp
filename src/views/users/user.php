<h2>Пользователь</h2>



<?php if ($user): ?>
    <div>
        <h3><?=$user->name?></h3>
        <p><?=$user->surname?></p>

    </div>

<?php else: ?>
    Нет такого пользователя
<?php endif;?>
