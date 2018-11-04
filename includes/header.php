<header id="header">
      <div class="header__top">
        <div class="container">
          <div class="header__top__logo">
            <h1><? echo $config['title'] ?>
            </h1>
          </div>
          <nav class="header__top__menu">
            <ul>
              <li><a href="/">Главная</a></li>
              <li><a href="/pages/about_me.php">Обо мне</a></li>
              <li><a href="<? echo $config['vk']?> " target="blank">Я Вконтакте</a></li>
            </ul>
          </nav>
        </div>
      </div>
      
      <div class="header__bottom">
        <div class="container">
          <nav>
            <ul>
            <?
            $categoris = array(); 
            $categoris_q = mysqli_query($con, "SELECT * FROM `articls_categorie`" ); 
            while ($cat = mysqli_fetch_assoc($categoris_q)){
            $categoris[] = $cat;
          }
            ?>
      <div class="header__bottom">
        <div class="container">
          <nav>
            <ul>
              <?php
              foreach( $categoris as $cat){
               ?>
                <li><a href="/articl.php?categorie=<?echo $cat['id_categorise'] ;?>"><? echo($cat['title']);?></a></li>
                
              <?php
              }
              ?>
  
              <? if (isset($_SESSION['logged_user'])):?>
                        <? if ($_SESSION['logged_user']->nickname == 'root'):?>
                        <li style="float:right"><a href="/pages/log_out.php">Выход</a></li>
                        <li style="float:right"><a href="/pages/admin/admin.php">root</a></li> 
                        <?else: ?>
                       
              <li style="float:right"><a href="/pages/log_out.php">Выход</a></li>
              <li style="float:right"> <p style = "color:white"><? echo $_SESSION['logged_user']->nickname?></p> </li>
              <? endif; ?> 
            <?else: ?>
            <li style="float:right"><a href="/pages/sign-in.php">Вход</a></li>
            <? endif; ?> 
           
              
            </ul>
           
          </nav>
         
        </div>
      </div>
    </header>