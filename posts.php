<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php
    session_start();
    echo "<h1 class='title'>Блог</h1>";
    if (!isset($_SESSION['auth'])){
      $_SESSION['auth']=false;
    }else{
      if ($_SESSION['auth']){
        echo "<a href='add.php'><button class='btn btn-primary add'>+</button></a>";
      }
    }
    
    //хост, логин, пароль
    $connection = mysqli_connect('127.0.0.1', 'root', '');
    //выбор БД и кодировки
    mysqli_select_db($connection, 'blog');
    mysqli_set_charset($connection, 'utf8');
    //запрашиваем все записи из таблицы comments
    $query_result = mysqli_query($connection, 'SELECT * FROM posts order by `time` desc');
    //преобразуем результат в массив массивов = массив записей
    $posts = mysqli_fetch_all($query_result);
    foreach ($posts as $post){
        echo '<div class="card offset-1 col-10"><ul><li><a href="article.php?id='.$post[0].'">'.$post[1].'</a></li>
        <li>'.$post[3].'<li>
        <li>'.substr($post[2],0,200).'...'.'</ul>';
        if (isset($_SESSION['auth'])){
            if ($_SESSION['auth']==true){
                echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                Удалить
              </button>
              
              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Удаление статьи</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Вы действительно хотите удалить эту статью?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                      <a href="delete.php?id='.$post[0].'"><button type="button" class="btn btn-danger">Удалить</button></a>
                    </div>
                  </div>
                </div>
              </div>
                <a href="edit.php?id='.$post[0].'"><button class="btn btn-warning col-12">Редактировать</button></a></div>';
            }
        }else{
          $_SESSION['auth']=false;
        }
        echo '</div></li>';
    }
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>