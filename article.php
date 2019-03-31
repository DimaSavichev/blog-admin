<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php
session_start();
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
    //запрашиваем все записи из таблицы comments
    if (isset($_POST["com"]) and isset($_POST["name"])){
        if ($_POST["com"]==""){
            echo "<p>Введите текст комментария</p>";
        }else{
            $comment=$_POST["com"];
            if ($_POST["name"]==""){
                $name="Аноним";
            }else{
                $name=$_POST["name"];
            }
            $lol = mysqli_query($connection, "INSERT INTO `comments` (`author`, `text`, `post`) VALUES ('{$name}','{$comment}','{$_GET["id"]}');");
        }
    }
    $query_result = mysqli_query($connection, 'SELECT * FROM `comments` where `post`='.$_GET["id"].' order by `time` desc');
    //преобразуем результат в массив массивов = массив записей
    $comments = mysqli_fetch_all($query_result);
    echo "<div class='card offset-1 col-10'><h1>".htmlspecialchars($article[0][1], ENT_QUOTES, 'UTF-8' )."</h1>
    <p  class='time'>".htmlspecialchars($article[0][3], ENT_QUOTES, 'UTF-8' )."</p>
    <p class='text'>".htmlspecialchars($article[0][2], ENT_QUOTES, 'UTF-8' )."</p>
    <hr>
    <h3>Комментарии  <span class='badge badge-success'>".count($comments)."</span></h3>";
    //добавляем новый коммент если он есть

    echo "
    <form action='article.php?id=".$_GET['id']."' method='post'>
        <input type='text' name='name' placeholder='Имя'>
        <input type='text' name='com' placeholder='Комментарий'>
        <input type='submit' class='btn btn-success'>
    </form>";
    echo '<ul style="list-style:none">';
    foreach ($comments as $comment){
        if (isset($_SESSION['auth'])){
            if ($_SESSION['auth']==true){
                echo '<li>'.htmlspecialchars($comment[4], ENT_QUOTES, 'UTF-8' ).', '.htmlspecialchars($comment[2], ENT_QUOTES, 'UTF-8' ).': '.htmlspecialchars($comment[3], ENT_QUOTES, 'UTF-8' ).'      <a href="delete_comment.php?post='.$_GET['id'].'&id='.$comment[0].'" class="badge badge-danger">Удалить</a></li>';
            }else{
                echo '<li>'.htmlspecialchars($comment[4], ENT_QUOTES, 'UTF-8' ).', '.htmlspecialchars($comment[2], ENT_QUOTES, 'UTF-8' ).': '.htmlspecialchars($comment[3], ENT_QUOTES, 'UTF-8' ).'</li>';
            }
        }else{
            $_SESSION['auth']=false;
            echo '<li>'.htmlspecialchars($comment[4], ENT_QUOTES, 'UTF-8' ).', '.htmlspecialchars($comment[2], ENT_QUOTES, 'UTF-8' ).': '.htmlspecialchars($comment[3], ENT_QUOTES, 'UTF-8' ).'</li>';
        }
        
    }
    echo '</ul></div>';
    $_POST = [];
}else{
    echo "<div class='card col-6 offset-3' style='text-align:center;'><h2 class='card-title'>Вы не туда попали :)</h2>
    <img class='card-img-top' src='nope.png'>
    </div>";
}
?>