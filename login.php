<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php
    session_start();
    echo "<div class=' card offset-2 col-8' style='text-align:center; '><h1>Авторизуйтесь, чтобы получить права администратора</h1>
        <form action='login.php' method='POST'>
            <input type='text' class='form-control' name='login' placeholder='Логин'>
            <input type='password'  class='form-control' name='password' placeholder='Пароль'>
            <input type='submit' class='btn btn-success' style='margin-top:10px;'>
        </form>";
    $_SESSION['auth'] = false;
    if (isset($_POST['login']) and isset($_POST['password']))
    {
        if ($_POST['login'] == "Dima" and $_POST['password'] == "dima_02")
        {
            $_SESSION['auth'] = true;
            header("Location: /posts.php");
        }
        else {
            $_SESSION['auth'] = false;
            echo "<strong>Неверный пароль</strong>";
        }
    }
?>