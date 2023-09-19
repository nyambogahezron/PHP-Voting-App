<?php require_once "../controlers/user.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>VottingApp</title>
    
    <link rel="stylesheet" href="../../assets/css/login.css">
   
  </head>
  <body>

    <div class="container">
      <header>VottingApp</header>
      <?php if(count($errors) > 0){ ?>
         <div class="errorsMsg">
             <?php
             foreach($errors as $errorsItem){
               echo "<span class ='eItem'> $errorsItem</span>"  .'<br>' .'<br>';
             }
             ?>
         </div>
             <?php
     }
   ?>
      <form action="" method="post">
        <div class="input-field">
          <input type="text" name="user_name" required>
          <label>Email or Username</label>
        </div>
        <div class="input-field">
          <input class="pswrd" type="password" name="user_password" required>
          <span class="show">SHOW</span>
          <label>Password</label>
        </div>
        <div class="button">
          <div class="inner"></div>
          <button type="submit" name="login_user">LOGIN</button>
        </div>
      </form>
            
      <div class="signup">
        Don't Have Account? <a href="register.php">Signup now</a>
      </div>
    </div>
    <script>
      var input = document.querySelector('.pswrd');
      var show = document.querySelector('.show');
      show.addEventListener('click', active);
      function active(){
        if(input.type === "password"){
          input.type = "text";
          show.style.color = "#1DA1F2";
          show.textContent = "HIDE";
        }else{
          input.type = "password";
          show.textContent = "SHOW";
          show.style.color = "#111";
        }
      }
    </script>

  </body>
</html>
