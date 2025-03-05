<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--=============== REMIXICONS ===============-->
   <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

   <!--=============== CSS ===============-->
   <link rel="stylesheet" href="../../../public/assets/css/login.css">

   <title>Sign Up</title>
   <style>
      body {
         background: url('../../../public/assets/img/registration.jpg') no-repeat center center fixed;
         background-size: cover;
         color: white;
      }
      .login__form {
         background: rgba(255, 255, 255, 0.1);
         padding: 20px;
         border-radius: 10px;
      }
   </style>
</head>
<body>
   <div class="login">
   <form action="<?php echo PATH . "/auth/register"; ?>" method="POST"  class="login__form" enctype="multipart/form-data">

      <!-- <form action="../../../app/controllers/AuthController.php" method="POST" class="login__form"> -->
         <h1 class="login__title">Sign Up</h1>
         <div class="login__content">
            <div class="login__box">
               <i class="ri-user-line login__icon"></i>
               <div class="login__box-input">
                  <input type="text" name="first_name" required class="login__input" placeholder=" ">
                  <label class="login__label">First Name</label>
               </div>
            </div>
            
            <div class="login__box">
               <i class="ri-user-line login__icon"></i>
               <div class="login__box-input">
                  <input type="text" name="last_name" required class="login__input" placeholder=" ">
                  <label class="login__label">Last Name</label>
               </div>
            </div>
            
            <div class="login__box">
               <i class="ri-mail-line login__icon"></i>
               <div class="login__box-input">
                  <input type="email" name="email" required class="login__input" placeholder=" ">
                  <label class="login__label">Email</label>
               </div>
            </div>
            
            <div class="login__box">
               <i class="ri-lock-2-line login__icon"></i>
               <div class="login__box-input">
                  <input type="password" name="password" required class="login__input" placeholder=" ">
                  <label class="login__label">Password</label>
                  <i class="ri-eye-off-line login__eye" id="login-eye"></i>
               </div>
            </div>
            
            <div class="login__box">
               <i class="ri-calendar-line login__icon"></i>
               <div class="login__box-input">
                  <input type="date" name="birth_date" required class="login__input">
                  <label class="login__label">Date of Birth</label>
               </div>
            </div>
            
            <div class="login__box">
               <i class="ri-phone-line login__icon"></i>
               <div class="login__box-input">
                  <input type="text" name="phone" required pattern="(77|78|73|70|71)\d{7}" class="login__input" placeholder=" ">
                  <label class="login__label">Phone Number</label>
               </div>
            </div>
         </div>

         <div class="login__check">
            <div class="login__check-group">
               <input type="checkbox" name="remember_me" class="login__check-input">
               <label class="login__check-label">Remember me</label>
            </div>
         </div>

         <button type="submit" class="login__button">Sign Up</button>

         <p class="login__register">
            Already have an account? <a href="login.php">Login</a>
         </p>
      </form>
   </div>
</body>
</html>
