<h2>Пост</h2>



<?php if ($post): ?>
    <div>
        <h3><?=$post->title?></h3>
        <p><?=$post->text?></p>

    </div>

<?php else: ?>
    Нет такого поста
<?php endif;?>