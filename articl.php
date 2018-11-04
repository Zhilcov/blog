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
              
              <h3>Все статьи</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">
                <? 
                $per_page = 6;
                $page = 1;
                if( isset($_GET['page']))
                {
                 $page =(int)$_GET['page'];
                }
                if(isset($_GET['categorie'])){
                  $total_count_q = mysqli_query($con, "SELECT count('id') as tot FROM `articls` where id_categorie = ".$_GET['categorie'] );
                }else{
                  $total_count_q = mysqli_query($con, "SELECT count('id') as tot FROM `articls`" );
                }
                
                $total_count = mysqli_fetch_assoc($total_count_q);
                $total_count = $total_count['tot'];

                $total_pages = ceil($total_count / $per_page);
                if($page<1 || $page>$total_pages){
                    $page=1;
                }

                $offset = ($per_page * $page) - $per_page;
                if(isset($_GET['categorie'])){
                  $articles = mysqli_query($con, "SELECT * FROM `articls` where id_categorie = ".$_GET['categorie']." order by id desc limit $offset,$per_page" );
                }else{
                $articles = mysqli_query($con, "SELECT * FROM `articls`  order by id desc limit $offset,$per_page" ); }?>
                  <? 
                  $articles_ex = true;
                       if(mysqli_num_rows($articles<=0)){
                        echo 'not exist!';
                        $articles_ex = false;
                       }
                  while ($art =mysqli_fetch_assoc($articles))
                  {
                  ?>
                     <article class="article">
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
                        <small>Категория:<a href="/categorie.php?categorie=<?echo $art_cat['id_categorise']?>"><?echo $art_cat['title']?></a></small>
                      </div>
                      <div class="article__info__preview"><? echo mb_substr(strip_tags($art['text']),0,100,'utf-8') . ' ...'?>
                      </div>
                    </div>
                  </article>
                  <?
                  }
                  ?>
                
                </div>
                <?$start = $page - 2 ;
                  $end = $page + 2; 

                  if(isset($_GET['categorie'])){

                    if ($articles_ex){
                      echo '<div class="paginator" style="display:flex; justify-content:center">';
                       if ($page > 1 ){
                        echo '<a href="/articl.php?page='.($page - 1) .'&categorie='.$_GET['categorie'].'">  <i class="fas fa-caret-left fa-lg"></i>  </a>';
                       }
                       if($start<1){$start = 1;}
                       if($end>$total_pages){$end= $total_pages;}
                       for($pag = $start; $pag <=  $end; $pag++){
                         echo '<a href="/articl.php?page='. $pag  .'&categorie='.$_GET['categorie'].'" style = "margin: 0 10px"> '.$pag .'</a>';
                       }
                       if($page < $total_pages)
                       {
                        echo '<a href="/articl.php?page='.($page + 1) .'&categorie='.$_GET['categorie'].'">  <i class="fas fa-caret-right fa-lg"></i>  </a>';
                       }
                     }
                      echo '</div>'; 

                  }else{
                    if ($articles_ex){
                      echo '<div class="paginator" style="display:flex; justify-content:center">';
                       if ($page > 1 ){
                        echo '<a href="/articl.php?page='.($page - 1) .'">  <i class="fas fa-caret-left fa-lg"></i>  </a>';
                       }
                       if($start<1){$start = 1;}
                       if($end>$total_pages){$end= $total_pages;}
                       for($pag = $start; $pag <=  $end; $pag++){
                         echo '<a href="/articl.php?page='. $pag  .'" style = "margin: 0 10px"> '.$pag .'</a>';
                       }
                       if($page < $total_pages)
                       {
                        echo '<a href="/articl.php?page='.($page + 1) .'">  <i class="fas fa-caret-right fa-lg"></i>  </a>';
                       }
                     }
                      echo '</div>'; 
                  }
                
                ?>
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

</body>
</html>