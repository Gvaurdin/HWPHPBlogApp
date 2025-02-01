<h2>Посты</h2>
<?php if($_SESSION['userType'] == 'Admin' || $_SESSION['userType'] == 'Author'): ?>
<div><?=$message?></div>
Добавить новый пост:<br>
<form action="/?c=posts&a=save" method="post">
    <input type="text" name="title"><br>
    <input type="text" name="text"><br>
    <input type="number" name="id_user"><br>
    <input type="submit" value="Добавить">

</form>
<?php endif; ?>
<?php if($_SESSION['userType'] == 'Admin'): ?>
    <?php foreach ($posts as $post):?>
         <div id="">
         <h3><a href="/?c=posts&a=show&id=<?=$post['id']?>"><?=$post['title']?></a>
            <a href="/?c=posts&a=delete&id=<?=$post['id']?>">[X]</a>
         </h3>
         </div>

     <?php endforeach; ?>
<?php elseif($_SESSION['userType'] == 'Author' || $_SESSION['userType'] == 'User'): ?>
     <?php foreach ($posts as $post):?>
          <div id="">
          <h3><a href="/?c=posts&a=show&id=<?=$post['id']?>"><?=$post['title']?></a>
          </h3>
          </div>
    <?php endforeach; ?>
<?php endif; ?>


