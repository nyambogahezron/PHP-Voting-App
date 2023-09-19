<?php require_once "../controlers/adminController.php"; ?>
<?php require_once "../controlers/adminLogin.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>admin-login</title>
    
    <link rel="stylesheet" href="../../assets/css/login.css">
   
  </head>
  <body>

    <div class="container">
      <header>Admin</header>
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
      <form action="../admin/login.php" method="post">
        <div class="input-field">
          <input type="text" name="username" required>
          <label>Username</label>
        </div>
        <div class="input-field">
          <input class="pswrd" name="password" type="password" required>
          <span class="show">SHOW</span>
          <label>Password</label>
        </div>
        <div class="button">
          <div class="inner"></div>
          <button type="submit" name="login-admin">LOGIN</button>
        </div>
      </form>
   
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
