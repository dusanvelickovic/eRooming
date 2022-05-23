<?php
    // Check if user if logged in
    function isLoggedIn(){
        if(isset($_SESSION['id'])){
            return true;
        }
        return false;
    }
    // Remove data from certain table and redirect
    function removeDataFromTable($tag, $table, $id, $redirectPage){
        global $connection;
        if(isset($_GET[$tag])){
            try{
                $deleteId = $_GET[$tag];
                $query = "DELETE FROM $table WHERE $id = :deleteId";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(":deleteId", $deleteId);
                $stmt->execute();
                header("Location: $redirectPage.php");
            } catch(PDOException $e){
                die("ERROR" . $e->getMessage());
            }
        }
    }
    // Register user
    function registerUser($name, $email, $password, $phone, $city, $street, $number){
        try{
            global $connection;
            if(isset($_POST['register'])){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone = trim($_POST['phone']);
                $city = $_POST['city'];
                $street = $_POST['street'];
                $number = $_POST['number'];

                $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
                
                $query = "INSERT INTO hoteli(imeHotela, grad, ulica, broj, telefonskiBroj, emailAdresa, lozinka) 
                VALUES (:name, :city, :street, :number, :phone, :email,:password)";
                
                $stmt = $connection->prepare($query);
                
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":city", $city);
                $stmt->bindParam(":street", $street);
                $stmt->bindParam(":number", $number);
                $stmt->bindParam(":phone", $phone);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":password", $password);
                
                $stmt->execute();
                header("Location: index.php");
            }
        } catch(PDOException $e){
            die("ERROR" . $e->getMessage());
        }
    }
    // Check if email already exists in db
    function emailExists($email){
        try{
            global $connection;
            $query = "SELECT COUNT(hoteli.emailAdresa) as brojEmaila FROM hoteli WHERE emailAdresa = :email ";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $num = $row['brojEmaila'];
            }
            return $num > 0 ? true : false;
        } catch(PDOException $e){
            die("ERROR" . $e->getMessage());
        }
    }
    // Check if password and email do not match when logging in
    function passwordNotCorrect($email, $password){
        global $connection;
        $query = "SELECT * FROM hoteli WHERE emailAdresa = :email";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $pwd = $row['lozinka'];
        }
        $password = password_verify($password, $pwd);
        if($password != $pwd or $password == null){
            return true;
        }
        return false;
    }   
    // Log in user
    function loginUser($email, $password){
        try{
            global $connection;
            if(isset($_POST['login'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                $query = "SELECT * FROM hoteli WHERE emailAdresa = :email";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
    
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $id = $row['idHotela'];
                    $name = $row['imeHotela'];
                    $city = $row['grad'];
                    $street = $row['ulica'];
                    $number = $row['broj'];
                    $phone = $row['telefonskiBroj'];
                    $dbEmail = $row['emailAdresa'];
                    $pwd = $row['lozinka'];
                }
                $password = password_verify($password, $pwd);
                if($email == $dbEmail && $password == $pwd){
                    $_SESSION['id'] = $id;
                    $_SESSION['name'] = $name;
                    $_SESSION['city'] = $city;
                    $_SESSION['street'] = $street;
                    $_SESSION['number'] = $number;
                    $_SESSION['phone'] = $phone;
                    $_SESSION['email'] = $dbEmail;
                    header("Location: admin/index.php");
                } 
            }
        } catch(PDOException $e){
            die("ERROR" . $e->getMessage());
        }
    }
?>