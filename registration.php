<?php include "includes/header.php" ?>
<?php include "admin/includes/init.php" ?>
<?php include "admin/includes/functions.php" ?>
<?php
  isLoggedIn() ? header("Location: admin/index.php") : false;
?>
<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $number = $_POST['number'];

        $errors = [
            'name' => '',
            'email' => '',
            'password' => '',
            'phone' => ''
        ];
        if(strlen($name) < 2){
            $errors['name'] = 'Ime mora imati vise od 2 karaktera';
        }
        if(emailExists($email)){
            $errors['email'] = 'Korisnik sa ovom email adresom vec postoji';
        }
        if(strlen($password) < 5){
            $errors['password'] = 'Lozinka mora imati vise od 5 karaktera';
        }
        if(strlen($phone) < 10){
            $errors['phone'] = 'Broj telefona mora imati vise od 10 cifara';
        }
        if(strlen($phone) > 12){
            $errors['phone'] = 'Broj telefona ne sme imati vise od 12 cifara';
        }
        foreach($errors as $key => $value){
            if(empty($value)){
                unset($errors[$key]);
            }
        }
        if(empty($errors)){
            registerUser($name, $email, $password, $phone, $city, $street, $number);
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
        <form action="registration.php" class="form reg-form" autocomplete="off" method="POST">
        <!-- <form action="admin/includes/register.php" class="form reg-form" autocomplete="off" method="POST"> -->
          <div class="form-group">
            <label for="name">Ime hotela</label>
            <input type="text" placeholder="Unesite ime hotela"
            value="<?php echo isset($name) ? $name : '' ?>" required name="name"/>
            <p><?php echo isset($errors['name']) ? $errors['name'] : '' ?></p>
          </div>
          <div class="inline-group">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" placeholder="Unesite email"
              value="<?php echo isset($email) ? $email : '' ?>" required name="email"/>
              <p><?php echo isset($errors['email']) ? $errors['email'] : '' ?></p>
            </div>
            <div class="form-group">
              <label for="password">Lozinka</label>
              <input type="password" placeholder="Unesite lozinku" required name="password"/>
              <p><?php echo isset($errors['password']) ? $errors['password'] : '' ?></p>
            </div>
          </div>
          <div class="form-group">
            <label for="">Broj telefona</label>
            <input type="tel"
            value="<?php echo isset($phone) ? $phone : '' ?>" placeholder="Unesite broj telefona" required name="phone"/>
            <p><?php echo isset($errors['phone']) ? $errors['phone'] : '' ?></p>
          </div>
          <div class="inline-group">
            <div class="form-group">
              <label for="city">Grad</label>
              <input type="text"
              value="<?php echo isset($city) ? $city : '' ?>" placeholder="Unesite grad" required name="city"/>
            </div>
            <div class="form-group street">
              <label for="street">Ulica</label>
              <input type="text"
              value="<?php echo isset($street) ? $street : '' ?>" placeholder="Unesite ulicu" required name="street"/>
            </div>
            <div class="form-group">
              <label for="number">Broj</label>
              <input
                type="number"
                min="1"
                placeholder="Unesite broj"
                required
                value="<?php echo isset($number) ? $number : '' ?>"
                name="number"
              />
            </div>
          </div>
          <div class="form-group">
            <input type="submit" value="Registruj se" class="login-btn" name="register"/>
          </div>
        </form>
      </div>
    </div>
<?php include "includes/footer.php" ?>
