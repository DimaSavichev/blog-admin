<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php
function BlockSQLInjection($str)
{
return str_replace(array("'",'"'),array("&quot;","&quot;"),$str);
}
?>
<?php
    session_start();
    if (isset($_SESSION['auth'])){
        if ($_SESSION['auth']==true){
            if (isset($_GET['id'])){
                if (is_numeric($_GET['id'])){
                $connection = mysqli_connect('127.0.0.1', 'root', '');
                mysqli_select_db($connection, 'blog');
                mysqli_set_charset($connection, 'utf8');
                if((!isset($_POST['heading'])) and (!isset($_POST['text']))){
                    $query_result = mysqli_query($connection, "SELECT * FROM `posts` WHERE `id`=".$_GET["id"].";");
                    $article = mysqli_fetch_all($query_result);
                    echo '<form action="edit.php?id='.$_GET['id'].'" method="POST" class="col-10 offset-1">
                        <p><input type="text" value="'.$article[0][1].'" name="heading" class="col-12"></p>
                        <p><textarea class="form-control col-12" name="text">'.$article[0][2].'</textarea></p>
                        <p><input type="submit" value="Сохранить" class="btn btn-success col-4 offset-4"></p>
                    </form>';
                }else{
                    $id=$_GET['id'];
                    $text=BlockSQLInjection($_POST['text']);
                    $heading=BlockSQLInjection($_POST['heading']);
                    $query_result = mysqli_query($connection, "UPDATE `posts` SET `heading`='".$heading."', `text`='".$text."' WHERE `id`=".$id.";");
                    header("Location: /posts.php");
                }
                }
            }else{
                echo "<div class='card col-6 offset-3' style='text-align:center;'><h2 class='card-title'>Вы не туда попали :)</h2>
                <img class='card-img-top' src='nope.png'>
                </div>";
            }
            
        }else{
            echo "<div class='card col-6 offset-3' style='text-align:center;'><h2 class='card-title'>Извините, но тут вы бесправны</h2>
            <img class='card-img-top' src='heh.jpg'>
            </div>";
        }
    }else{
        $_SESSION['auth']=false;
        header("Location: /posts.php");
    }
    
?>