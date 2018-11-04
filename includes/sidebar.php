 <div class="block">
              <h3>Мы_знаем</h3>
              <div class="block__content">
                <script type="text/javascript" src="//ra.revolvermaps.com/0/0/6.js?i=02op3nb0crr&amp;m=7&amp;s=320&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80" async="async"></script>
              </div>
            </div>

            <div class="block">
              <h3>Топ читаемых статей</h3>
              <div class="block__content">
                <div class="articles articles__vertical">
                    
                   <? $articles = mysqli_query($con, "SELECT * FROM articls  order by views desc limit 5"  ); ?>
                  <? while ($art =mysqli_fetch_assoc($articles))
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
              <h3>Комментарии</h3>
              <div class="block__content">
                <div class="articles articles__vertical">

                  <? $comments = mysqli_query($con, "SELECT * FROM coments join users on users.id=coments.id_user order by coments.id desc limit 5"  ); ?>
                  <? while ($com =mysqli_fetch_assoc($comments))
                  { 
                  ?>
                   <article class="article">
                    <div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/<? echo md5($com['mail'])?>);"></div>
                    <div class="article__info">
                      <a href="/article.php?id=<?echo $com['artil_id']?>"><? echo $com['nickname']?></a>
                      <div class="article__info__meta">
                      <div class="article__info__preview"><? echo mb_substr(strip_tags($com['comment']),0,100,'utf-8') . ' ...'?>
                      </div>
                    </div>
                    <div>
                  </article>
                  <?
                  }
                  
                  ?>
                

                </div>
              </div>
            </div>