<?
require 'includes/config.php';

if (isset($_POST['do_com'])) {
    $comt =  R::dispense('coments');
    $comt['id_user']  =  $_SESSION['logged_user']->id;
    $comt['artil_id'] =$_GET['id'];
    $comt['comment'] = ($_POST['text']);
    $comt['date'] = date('Y-m-d'); 
    R::store($comt);
  
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Блог IT_Минималиста!</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">


  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="/media/css/style.css">
</head>
<body>

  <div id="wrapper">

    <? include 'includes/header.php'?>
    
   <?
   $articl=mysqli_query($con,"SELECT * from articls where id =". (int)$_GET['id']);
   if ( mysqli_num_rows($articl) == 0) {
   ?>
   <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <h3>Статья не найдена</h3>
              <div class="block__content">
                <div class="full-text">
                  Статья не сушкествует
                 </div>
              </div>
            </div>
          </section>
          <section class="content__right col-md-4">
           <? include 'includes/sidebar.php'?>
        </section>
        </div>
      </div>
    </div>
    <?
  } else
   {
  $art= mysqli_fetch_assoc($articl);
  mysqli_query($con,"UPDATE articls set views=views+1 where id =" . (int) $art['id']) 
   ?>
 
    <div id="content">
    <div class="container">
      <div class="row">
        <section class="content__left col-md-8">
          <div class="block">
            <a><? echo $art['views']?> просмотров </a>          
            <h3><? echo $art['title']?> </h3>
            <div class="block__content">
            <img src="/static/img/<? echo $art['image']?> " style = "max-width:100%;"> 
            
            <div class="full-text">
                <?php 
                 echo nl2br($art['text']);
                ?>
              </div>
               
            </div>
          </div>


            <div class="block">
              <h3>Комментарии</h3>
              <div class="block__content">
                <div class="articles articles__vertical">
                    
                  <? $comments = mysqli_query($con, "SELECT *,coments.id as f  FROM coments join users on users.id=coments.id_user where artil_id = ".$art['id']." order by coments.id desc"  ); 
                  if(mysqli_num_rows($comments)==0){

                  echo "net comenta"; 
                  }
                  $delcom = array();
                  ?>
                  <? while ($com =mysqli_fetch_assoc($comments))
                  { 
                    $delcom[] = $com['f'];                    
                  ?>
                   <article class="article">
                    <form action="" method = 'post'>
                        <button style="float:right; border:none" name = 'del_com<?echo $com['f']?>'><i class="fas fa-times"></i></button>
                    </form>
                    <div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/<? echo md5($com['mail'])?>);"></div>
                    <div class="article__info">
                      <a href="/article.php?id=<?echo $com['artil_id']?>"><? echo $com['nickname']?></a>
                      <div class="article__info__meta">
                      <div class="article__info__preview"><? echo $com['comment'] ?>
                      </div>
                    </div>
                    <div>
                  </article>
                  <?
                  }
                  /* print_r($delcom);
                    exit(); */
                  for ($i=0; $i <count($delcom) ; $i++) { 
                    $n = $delcom[$i];
                    if(isset($_POST['del_com'.$n])){
                      $del = R::findOne('coments','id = ? ', array($n));
                      R::trash($del);
                      
                    }  
                   }
            
                  ?>        
                </div>
              </div>
            </div>



           <div class="block" id="comment-add-form">
              <h3>Добавить комментарий</h3>
              <div class="block__content">
                <form class="form" method = "post">
                
                  
                   <? if (isset($_SESSION['logged_user'])):?>
                   
                   <div class="form__group">
                    <textarea name="text" required="" class="form__control" placeholder="Текст комментария ..."></textarea>
                  </div>

                   <div class="form__group">
                    <input type="submit" class="form__control" name="do_com" value="Добавить комментарий">
                  </div>
             
                  <?else: ?>
                      <p>Чтобы оставить комментарий зарегестрируйтесь</p>
                   <? endif; ?> 

                
                  
                   
                  
                </form>
              </div>
            </div>


        </section>
        <section class="content__right col-md-4">
           <? include 'includes/sidebar.php'?>
        </section>
      </div>
    </div>
      </div>  
      <?
      }
       
      ?>

   <? include 'includes/footer.php'?>
  </div>

</body>
</html>