<?
require '../../includes/config.php';
if(isset($_POST['do_update'])){
    move_uploaded_file($_FILES["file"]["tmp_name"],'../../static/img/'.$_FILES["file"]["name"]);
    
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

    <? include '../../includes/header.php'?>
    
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
           <? include '../..//includes/sidebar.php'?>
          </section>
        </div>
      </div>
    </div>
    <?
  } else
   {
  $art= mysqli_fetch_assoc($articl);
  $articl_c = mysqli_query($con,"SELECT title FROM articls_categorie WHERE articls_categorie.id_categorise = (SELECT articls.id_categorie FROM articls WHERE articls.id = ".$_GET['id'].")");
 $c = mysqli_fetch_assoc($articl_c);
   ?>
    <div id="content">
    <div class="container">
      <div class="row">
        <section class="content__left col-md-8">
          <div class="block">
          
          <h3>Редактировать статью</h3>
              <div class="block__content">
                <form class="form" method = "post" enctype = "multipart/form-data">
                 
                 <div class="form__group">
                 <p> Категория выбранной статьи: <?echo $c['title']?></p>
                  </div>
                <div class="form__group">
                      <div class="categor"></div>
                  </div>
                  <img src="/static/img/<? echo $art['image']?> " style = "max-width:100%;"> 
                <div class="form__group">
                    <input type="file" name="file" id="file">
                  </div>
                  <div class="form__group">
                      <div class="row">
                          <div class="col-md-6">
                            <input type="text" class="form__control" id ="title" required="" name="" value = <? echo $art['title']?> >
                          </div>
                      </div>
                   </div>
                  <div class="form__group">
                    <textarea name="text" required=""id ="text" class="form__control" style = 'resize: vertical; '><? echo $art['text']?></textarea>
                  </div>
                  <div class="form__group">
                    <input type="submit" class="form__control"  id = "do_update" art_id = "<? echo(int)$_GET['id']?>" name="do_update" value="Сохранить">
                  </div>

                
                  
                   
                  
                </form>
              </div>



        </section>
        <section class="content__right col-md-4">
           <? include '../../includes/sidebar.php'?>
        </section>
      </div>
    </div>
      </div>  
      <?
      }
       
      ?>

   <? include '../../includes/footer.php'?>
  </div>
  <script src="/pages/admin/js/jquery-3.1.1.js"></script>
<script src="/pages/admin/js/admin.js"></script>
</body>
</html>