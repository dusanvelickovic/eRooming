<?php include "includes/database.php" ?>
<?php include "includes/init.php" ?>
<?php include "includes/header.php" ?>
<?php include "includes/nav.php" ?>
<?php include "includes/functions.php" ?>
<?php 
  isLoggedIn() ? true : header("Location: ../index.php");
?>
    <div class="main">
        <?php include "includes/menu.php" ?>
        <div class="employees-main">
            <div class="table">
                <div class="title">
                    <h2>Dodaj novog gosta</h2>
                </div>
                <form class="add-form" method="POST" action="addGuest.php">
                    <div class="flex-group">
                        <div class="input-form">
                            <label for="firstName">Ime</label>
                            <input type="text" name="firstName" required>
                        </div>
                        <div class="input-form">
                            <label for="lastName">Prezime</label>
                            <input type="text" name="lastName" required>
                        </div>
                    </div>
                    <div class="flex-group">
                        <div class="input-form">
                            <label for="surname">Broj telefona</label>
                            <input type="phone" minlength="10" maxlength="12" name="phone" required>
                        </div>
                        <div class="input-form">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="" required>
                        </div>
                    </div>
                    <div class="flex-group last">
                        <div class="input-form">
                            <label for="submit">Dodaj gosta</label>
                            <input type="submit" class="submit" name="addGuest" value="Submit">
                        </div>
                    </div>
                </form>
                <?php
                try{
                    if(isset($_POST['addGuest'])){
                        $firstName = $_POST['firstName'];
                        $lastName = $_POST['lastName'];
                        $phone = trim($_POST['phone']);
                        $email = $_POST['email'];
                        $hotelId = $_SESSION['id'];

                        $query = "INSERT INTO gosti(imeGosta, prezimeGosta, telefonskiBroj, emailAdresa, idHotela) VALUES 
                        (:firstName, :lastName, :phone, :email, :hotelId)";
                        $stmt = $connection->prepare($query);
                        $stmt->bindParam(":firstName", $firstName);
                        $stmt->bindParam(":lastName", $lastName);
                        $stmt->bindParam(":phone", $phone);
                        $stmt->bindParam(":email", $email);
                        $stmt->bindParam(":hotelId", $hotelId);
                        $stmt->execute();
                        header("Location: guests.php");
                    }
                } catch(PDOException $e){
                    die("Error: " . $e->getMessage());
                }
                ?>
            </div>
        </div>
    </div>
<?php include "includes/footer.php" ?>