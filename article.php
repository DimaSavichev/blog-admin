<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php
if (isset($_GET['id'])){
//хост, логин, пароль
$connection = mysqli_connect('127.0.0.1', 'root', '');

//выбор БД и кодировки
mysqli_select_db($connection, 'blog');
mysqli_set_charset($connection, 'utf8');
$comment="";
$name="";
$query_result = mysqli_query($connection, "SELECT * FROM `posts` WHERE `id`=".$_GET["id"].";");
$article = mysqli_fetch_all($query_result);
echo "<h1>".$article[0][1]."</h1>
<p  class='time'>".$article[0][3]."</p>
<p class='text'>".$article[0][2]."</p>
<h3>Комментарии</h3>";
//добавляем новый коммент если он есть
if (isset($_POST["com"]) and isset($_POST["name"])){
if ($_POST["com"]==""){
    echo "<p>Введите текст комментария</p>";
}
else{
    $comment=$_POST["com"];
    if ($_POST["name"]==""){
        $name="Аноним";
    }
    else{
        $name=$_POST["name"];
    }
    $lol = mysqli_query($connection, "INSERT INTO `comments` (`author`, `text`, `post`) VALUES ('{$name}','{$comment}','{$_GET["id"]}');");
}
}
//запрашиваем все записи из таблицы comments
$query_result = mysqli_query($connection, 'SELECT * FROM `comments` where `post`='.$_GET["id"].' order by `time` desc');

//преобразуем результат в массив массивов = массив записей
$comments = mysqli_fetch_all($query_result);
echo "
<form action='article.php?id=".$_GET['id']."' method='post'>
    <input type='text' name='name' placeholder='Имя'>
    <input type='text' name='com' placeholder='Комментарий'>
    <input type='submit'>
</form>";
echo '<ul style="list-style:none">';
foreach ($comments as $comment)
{
    echo '<li>'.$comment[4].', '.$comment[2].': '.$comment[3].'</li>';
}
echo '</ul>';
$_POST = [];
}else{
    echo "
<h1 class='title'>Блог</h1>";
//хост, логин, пароль
$connection = mysqli_connect('127.0.0.1', 'root', '');

//выбор БД и кодировки
mysqli_select_db($connection, 'blog');
mysqli_set_charset($connection, 'utf8');

//запрашиваем все записи из таблицы comments
$query_result = mysqli_query($connection, 'SELECT * FROM posts order by `time` desc');

//преобразуем результат в массив массивов = массив записей
$posts = mysqli_fetch_all($query_result);

echo '<ul class="posts">';
foreach ($posts as $post)
{
    echo '<li class="text"><ul><li><a href="article.php?id='.$post[0].'">'.$post[1].'</a></li>
    <li>'.$post[3].'<li>
    <li>'.substr($post[2],0,200).'...'.'<li></ul></li>';
}
echo '</ul>';
}
?>