<?
require '../../includes/config.php';
if(isset($_POST['do_title'])){
  move_uploaded_file($_FILES["file"]["tmp_name"],'../../static/img/'.$_FILES["file"]["name"]);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
 <title> <? echo $config['title'] ?></title> 

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="../../media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="/media/css/style.css">
</head>
<body>

  <div id="wrapper">
<?
    require '../../includes/header.php'
?>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
          <div class="block" id="comment-add-form">
              <h3>Добавить статью</h3>
              <div class="block__content">
              <form class="form" method = "post" enctype = "multipart/form-data" >
                  <div class="form__group">
                      <div class="categor"></div>
                  </div>
                  <div class="form__group">
                    <input type="file" name="file" id="file">
                  </div>
                  <div class="form__group">
                      <div class="row">
                          <div class="col-md-6">
                            <input type="text" class="form__control" id ="title" required="" name="" placeholder="Заголовок">
                          </div>
                      </div>
                   </div>
                  <div class="form__group">
                    <textarea name="text" required=""id ="text" class="form__control" placeholder="Текст статьи ..."></textarea>
                  </div>
                  <div class="form__group">
                    <input type="submit" class="form__control"  id = "do_title"name="do_title" value="Добавить статью">
                  </div>
                  </form>
            </div>
            
          </section>
          <section class="content__right col-md-4">
            
                 <? include '../../includes/sidebar.php'?>   

        

                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>

    <? include '../../includes/footer.php';?>

  </div>
  <script src="/pages/admin/js/jquery-3.1.1.js"></script>
<script src="/pages/admin/js/admin.js"></script>
</body>
</html>