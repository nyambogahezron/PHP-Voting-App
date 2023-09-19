<?php require_once "../controlers/user.php"; ?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>VottingApp</title>
    
    <link rel="stylesheet" href="../../assets/css/login.css">
   
  </head>
  <body>

    <div class="reg-form-container container">
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
      <form action="register.php" method="POST" id="reg-form">
        <div class="input-field">
          <input type="text" name="user-email" required>
          <label>Email</label>
        </div>
        <div class="input-field">
          <input type="text" name="user-name" required>
          <label>User Name</label>
        </div>
        <div class="input-field">
          <input type="number" name="voter-number" id="voter-number" required>
          <label>Voter Number</label>
        </div>
        
        <div class="input-field">
          <input class="pswrd" type="password" name="user-password" required>
          <span class="show">SHOW</span>
          <label>Password</label>
        </div>
        <div class="input-field">
          <input class="pswrd" type="password" name="re-enter-user-password" required>
           <label>Confirm Password</label>
        </div>
        <div class="button">
          <div class="inner"></div>
          <button type="submit" name="sign-up-user">Sign Up</button>
        </div>
                
      </form>
            
      <div class="signup">
        Have Account? <a href="login.php">Login</a>
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
