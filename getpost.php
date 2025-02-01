<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_POST['title'];
    $text = $_POST['text'];

    //insert

    header('Location: /');
    exit;
}
?>

<form action="" method="post">
    <label>
        <input type="text" name="title">
    </label><br>
    <label>
        <input type="text" name="text">
    </label><br>
    <input type="submit">
</form>
<?php
//// Теперь можно вывести $_POST после отправки формы (для отладки)
//var_dump($_POST);
//?>