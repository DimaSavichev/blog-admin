<?php
    session_start();
    if (isset($_SESSION['auth'])){
        if ($_SESSION['auth']==true){
            if (isset($_GET['id'])){
            if (is_numeric($_GET['id'])){
                $connection = mysqli_connect('127.0.0.1', 'root', '');
                //выбор БД и кодировки
                mysqli_select_db($connection, 'blog');
                mysqli_set_charset($connection, 'utf8');
                //запрашиваем все записи из таблицы comments
                $query_result = mysqli_query($connection, 'DELETE FROM `posts` where `id`='.$_GET['id']);
                $query_result = mysqli_query($connection, 'DELETE FROM `comments` where `post`='.$_GET['id']);
            }
            }
        }
    }else{
        $_SESSION['auth']=false;
    }
        header("Location: /posts.php");

    
?>