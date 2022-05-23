<?php include "includes/header.php" ?>
<?php include "admin/includes/init.php" ?>
<?php include "admin/includes/functions.php" ?>
<?php
  isLoggedIn() ? header("Location: admin/index.php") : false;
?>
<?php
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [
      'email' => '',
      'password' => ''
    ];
    if(!emailExists($email)){
      $errors['email'] = 'Pogresna lozinka ili email adresa';
      $errors['password'] = 'Pogresna lozinka ili email adresa';
    }
    if(emailExists($email)){
      if(passwordNotCorrect($email, $password)){
        $errors['password'] = 'Pogresna lozinka ili email adresa';
      }
    }
    foreach($errors as $key => $item){
      if(empty($item)){
        unset($errors[$key]);
      }
    }
    if(empty($errors)){
      loginUser($email, $password);
    }
}
?>
    <div class="login-page">
      <img src="images/backgroundindex.jpg" alt="" class="img-bg" />
      <div class="brand">eRooming</div>
      <div class="login">
        <svg
          width="30"
          height="30"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          class="logo"
        >
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7ZM14 7C14 8.10457 13.1046 9 12 9C10.8954 9 10 8.10457 10 7C10 5.89543 10.8954 5 12 5C13.1046 5 14 5.89543 14 7Z"
            fill="currentColor"
          />
          <path
            d="M16 15C16 14.4477 15.5523 14 15 14H9C8.44772 14 8 14.4477 8 15V21H6V15C6 13.3431 7.34315 12 9 12H15C16.6569 12 18 13.3431 18 15V21H16V15Z"
            fill="currentColor"
          />
        </svg>
        <form action="index.php" class="form" autocomplete="off" method="POST">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" placeholder="Unesite email" required name="email" autocomplete="on"
            value="<?php echo isset($email) ? $email : '' ?>"/>
            <p><?php echo isset($errors['email']) ? $errors['email'] : '' ?></p>
          </div>
          <div class="form-group">
            <label for="password">Lozinka</label>
            <input type="password" placeholder="Unesite lozinku" required name="password"/>
            <p><?php echo isset($errors['password']) ? $errors['password'] : '' ?></p>
          </div>
          <div class="form-group">
            <input type="submit" value="Prijavi se" class="login-btn" name="login"/>
          </div>
          <div class="form-group register">
            <h5>
              Nemaš nalog?
              <a href="registration.php">Registruj se</a>
            </h5>
          </div>
        </form>
      </div>
    </div>
<?php include "includes/footer.php" ?>