<h2>Пользователи</h2>
<div><?=$message?></div>
Добавить нового пользователя:<br>
<form action="/?c=users&a=save" method="post">
    <input type="text" name="name"><br>
    <input type="text" name="surname"><br>
    <input type="submit" value="Добавить">

</form>

<?php foreach ($users as $user):?>
    <div id="">
        <h3><a href="/?c=users&a=show&id=<?=$user['id']?>"><?=$user['name']?></a>
            <a href="/?c=users&a=delete&id=<?=$user['id']?>">[X]</a>
        </h3>

    </div>

<?php endforeach; ?>