<?
require 'includes/config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
 <title> <? echo $config['title'] ?></title> 
 
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
<?
    require 'includes/header.php'
?>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">

            <div class="block">
              <a href="articl.php">Все записи</a>
              <h3>Новейшее_в_блоге</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">
                <? $articles = mysqli_query($con, "SELECT * FROM `articls`  order by id desc limit 10" ); 
                
                ?>
                  <? while ($art =mysqli_fetch_assoc($articles))
                  {
                   
                  ?>
                     <article class="article">
                     <? if ($_SESSION['logged_user']->nickname == 'root'):?>
                     <form  >
                        <button class = "del" style="float:right; border:none" name = '<?echo $art['id']?>' ><i class="fas fa-times"></i></button>
                    </form>
                    <a href="/pages/admin/edit.php?id=<?echo $art['id']?>" style="float:right; border:none"  ><i class="fas fa-pen fa-xs"></i></a>
                    <? endif; ?> 
                    <div class="article__image" style="background-image: url(/static/img/<? echo $art['image']?>);"></div>
                    <div class="article__info">
                      <a href="/article.php?id=<?echo $art['id']?>"><? echo $art['title']?></a>
                      <div class="article__info__meta">
                      <?
                      $art_cat=false;
                      foreach ( $categoris as $cat){
                        if ($art['id_categorie'] ==  $cat['id_categorise']){
                          $art_cat=$cat;
                          break;
                        }
                      }



                      ?>
                        <small>Категория:<a href="/articl.php?categorie=<?echo $art_cat['id_categorise']?>"><?echo $art_cat['title']?></a></small>
                      </div>
                      <div class="article__info__preview"><? echo mb_substr(strip_tags($art['text']),0,100,'utf-8') . ' ...'?>
                      </div>
                    </div>
                  </article>
                  <?
                  }
                  
                  ?>
                
                </div>
              </div>
            </div>

            <div class="block">
              <a href="/articl.php?categorie=1">Все записи</a>
              <h3>Трансферы [Новейшее]</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">

                <? $articles = mysqli_query($con, "SELECT * FROM articls where id_categorie = 1  order by id desc limit 10 " ); ?>
                  <? while ($art =mysqli_fetch_assoc($articles))
                  { 
                  ?>
                     <article class="article">
                     <? if ($_SESSION['logged_user']->nickname == 'root'):?>
                     <form  >
                        <button class = "del" style="float:right; border:none" name = '<?echo $art['id']?>' ><i class="fas fa-times"></i></button>
                    </form>
                    <a href="/pages/admin/edit.php?id=<?echo $art['id']?>" style="float:right; border:none"  ><i class="fas fa-pen fa-xs"></i></a>
                    <? endif; ?> 
                    <div class="article__image" style="background-image: url(/static/img/<? echo $art['image']?>);"></div>
                    <div class="article__info">
                      <a href="/article.php?id=<?echo $art['id']?>"><? echo $art['title']?></a>
                      <div class="article__info__meta">
                      <?
                      $art_cat=false;
                      foreach ( $categoris as $cat){
                        if ($art['id_categorie'] ==  $cat['id_categorise']){
                          $art_cat=$cat;
                          break;
                        }
                      }
                      ?>
                        <small>Категория:<a href="/articl.php?categorie=<?echo $art_cat['id_categorise']?>"><?echo $art_cat['title']?></a></small>
                      </div>
                      <div class="article__info__preview"><? echo mb_substr(strip_tags($art['text']),0,100,'utf-8') . ' ...'?>
                      </div>
                    </div>
                  </article>
                  <?
                  }
                  
                  ?>
                </div>
              </div>
            </div>

            <div class="block">
              <a href="/articl.php?categorie=2">Все записи</a>
              <h3>Результаты игр [Новейшее]</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">

                <? $articles = mysqli_query($con, "SELECT * FROM articls where id_categorie = 2 order by id desc limit 10"  ); ?>
                  <? while ($art =mysqli_fetch_assoc($articles))
                  { 
                  ?>
                     <article class="article">
                     <? if ($_SESSION['logged_user']->nickname == 'root'):?>
                     <form  >
                        <button class = "del" style="float:right; border:none" name = '<?echo $art['id']?>' ><i class="fas fa-times"></i></button>
                    </form>
                    <a href="/pages/admin/edit.php?id=<?echo $art['id']?>" style="float:right; border:none"  ><i class="fas fa-pen fa-xs"></i></a>
                    <? endif; ?> 
                    <div class="article__image" style="background-image: url(/static/img/<? echo $art['image']?>);"></div>
                    <div class="article__info">
                      <a href="/article.php?id=<?echo $art['id']?>"><? echo $art['title']?></a>
                      <div class="article__info__meta">
                      <?
                      $art_cat=false;
                      foreach ( $categoris as $cat){
                        if ($art['id_categorie'] ==  $cat['id_categorise']){
                          $art_cat=$cat;
                          break;
                        }
                      }
                      ?>
                        <small>Категория:<a href="/articl.php?categorie=<?echo $art_cat['id_categorise']?>"><?echo $art_cat['title']?></a></small>
                      </div>
                      <div class="article__info__preview"><? echo mb_substr(strip_tags($art['text']),0,100,'utf-8') . ' ...'?>
                      </div>
                    </div>
                  </article>
                  <?
                  }
                  
                  ?>

                </div>
              </div>
            </div>


            <div class="block">
              <a href="/articl.php?categorie=3">Все записи</a>
              <h3>Разное [Новейшее]</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">

                <? $articles = mysqli_query($con, "SELECT * FROM articls where id_categorie = 3  order by id desc limit 10 " ); ?>
                  <? while ($art =mysqli_fetch_assoc($articles))
                  { 
                  ?>
                     <article class="article">
                     <? if ($_SESSION['logged_user']->nickname == 'root'):?>
                     <form  >
                        <button class = "del" style="float:right; border:none" name = '<?echo $art['id']?>' ><i class="fas fa-times"></i></button>
                    </form>
                    <a href="/pages/admin/edit.php?id=<?echo $art['id']?>" style="float:right; border:none"  ><i class="fas fa-pen fa-xs"></i></a>
                    <? endif; ?> 
                    <div class="article__image" style="background-image: url(/static/img/<? echo $art['image']?>);"></div>
                    <div class="article__info">
                      <a href="/article.php?id=<?echo $art['id']?>"><? echo $art['title']?></a>
                      <div class="article__info__meta">
                      <?
                      $art_cat=false;
                      foreach ( $categoris as $cat){
                        if ($art['id_categorie'] ==  $cat['id_categorise']){
                          $art_cat=$cat;
                          break;
                        }
                      }
                      ?>
                        <small>Категория:<a href="/articl.php?categorie=<?echo $art_cat['id_categorise']?>"><?echo $art_cat['title']?></a></small>
                      </div>
                      <div class="article__info__preview"><? echo mb_substr(strip_tags($art['text']),0,100,'utf-8') . ' ...'?>
                      </div>
                    </div>
                  </article>
                  <?
                  }
                  
                  ?>
                </div>
              </div>
            </div>
          </section>
          <section class="content__right col-md-4">
            
                 <? include 'includes/sidebar.php'?>   

        

                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>

    <? include 'includes/footer.php';?>

  </div>
  <script src="/pages/admin/js/jquery-3.1.1.js"></script>
<script src="/index.js"></script>
</body>
</html>