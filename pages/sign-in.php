<?
require '../includes/config.php';


$data = $_POST;      
if (isset($data['signUp'])) {
    $erorrs =array();
    if (trim($data['nick']) == '') {
        $erorrs[] = 'Введите логин';
    }
    if (trim($data['email']) == '') {
        $erorrs[] = 'Введите Email';
    }
    if (($data['password'] )== '') {
        $erorrs[] = 'Введите пароль';
    }
    if (($data['password_2']) != ($data['password'])) {
        $erorrs[] = 'Пароли не совпадают';
    }

    if (R::count('users', "nickname = ?  ",array (
        $data['nick'] 
    )) > 0) {
        $erorrs[] = 'Такой логин уже занят';
    }

    if (R::count('users', "mail = ? ",  array (
        $data['email']
    )) > 0) {
        $erorrs[] = 'Такой Email уже eсть';
    }
    
    
    if ( empty($erorrs)) {
        
         $users =  R::dispense('users');

         $users->mail= $data['email'];
         $users->nickname = $data['nick'];
        $users -> password =password_hash( $data['password'],   PASSWORD_DEFAULT);
        R::store($users);
    }else {
        echo '<div style= "color:red;">' . array_shift($erorrs) . '</div>';
    }

}

  
  if( isset($data['do_login'])){
    $erorrss =array();
    $user = R::findOne('users','nickname = ? ', array(
        $data['login']
    ));
    if($user){
        if(password_verify($data['s_password'],$user->password)){

        }else{
            $erorrss [] = 'Неверный пароль';
        }
    }else{
        $erorrss[] = 'Пользователь не найден';
    }

    if ( empty($erorrss)) {
        
        $_SESSION['logged_user']  = $user;
        header("Location: /");
        
   }else {
       echo '<div style= "color:red;">' . array_shift($erorrss) . '</div>';
   }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <? echo $config['title'] ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" typenn="text/css" href="/media/css/style.css">
</head>
<body>

    <div class="container_singup">
        <div class="left">

                   <form action="../pages/sign-in.php" method = "POST">
                 <h1>Регистрация</h1>
                    
                     <div class="textbox">
                      
                      <i class="fas fa-user"></i>
                      <input type="text" name='nick' placeholder='Ваш логин' value = <? echo @$data['nick']; ?>>
                    </div>

                    <div class="textbox">
                    <i class="fas fa-envelope"></i>
                      <input type="text" name='email' placeholder='Email' value = <? echo @$data['email']; ?>>
                    </div>


                     <div class="textbox">
                            <i class="fas fa-unlock"></i>
                            <input type="password" name='password' placeholder='Ваш пароль'>
                    </div>

                    <div class="textbox">
                            <i class="fas fa-unlock"></i>
                            <input type="password" name='password_2' placeholder='Подтвердите пароль'>
                    </div>
                              
                    <button class = "btn" name= "signUp" >Зарегестрироваться</button>



                 </form>

        </div>
        <div class="right">
             <div class="formBox">
                 <form action="../pages/sign-in.php" method = "POST">
                 <h1>Вход в аккаунт</h1>
                     <div class="textbox">
                      
                            <i class="fas fa-user"></i>
                            <input type="text" name='login' placeholder='Ваш логин'>
                     </div>

                     <div class="textbox">
                            <i class="fas fa-unlock"></i>
                            <input type="password" name='s_password' placeholder='Ваш пароль'>
                    </div>
                      
                    <button class = "btn" name= "do_login" >Вход</button>

                 </form>
             </div>
        </div>
    </div>
</body>
</html>