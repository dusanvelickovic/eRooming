<?php include "includes/database.php" ?>
<?php include "includes/init.php" ?>
<?php include "includes/header.php" ?>
<?php include "includes/nav.php" ?>
<?php include "includes/functions.php" ?>
<?php 
  isLoggedIn() ? true : header("Location: ../index.php");
?>
<?php 
    if(isset($_GET['editId'])){
        try{
            $editId = $_GET['editId'];   
            $query = "SELECT * FROM gosti 
            WHERE gosti.idGosta = :editId";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(":editId", $editId);
            $stmt->execute(); 
            while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $firstName = $row->imeGosta;
                $lastName = $row->prezimeGosta;
                $phone = $row->telefonskiBroj;
                $email = $row->emailAdresa;
            }
        } catch(PDOException $e){
            die("ERROR" . $e->getMessage());
        }
    }
?>
    <div class="main">
        <?php include "includes/menu.php" ?>
        <div class="employees-main">
            <div class="table">
                <div class="title">
                    <h2>Izmeni konfiguraciju gosta</h2>
                </div>
                <form class="add-form" method="POST" action="">
                    <div class="flex-group">
                        <div class="input-form">
                            <label for="firstName">Ime</label>
                            <input type="text" name="firstName" required value="<?php echo $firstName ?>">
                        </div>
                        <div class="input-form">
                            <label for="lastName">Prezime</label>
                            <input type="text" name="lastName" required value="<?php echo $lastName ?>">
                        </div>
                    </div>
                    <div class="flex-group">
                        <div class="input-form">
                            <label for="surname">Broj telefona</label>
                            <input type="phone" minlength="10" maxlength="12" name="phone" required value="<?php echo $phone ?>">
                        </div>
                        <div class="input-form">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="" value="<?php echo $email ?>">
                        </div>
                    </div>
                    <div class="flex-group last">
                        <div class="input-form">
                            <label for="submit">Izmeni gosta</label>
                            <input type="submit" class="submit" name="editGuest" value="Submit">
                        </div>
                    </div>
                </form>
                <?php
                try{
                    if(isset($_POST['editGuest'])){
                        $firstName = $_POST['firstName'];
                        $lastName = $_POST['lastName'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];

                        $query = "UPDATE gosti SET gosti.imeGosta = :firstName, 
                        gosti.prezimeGosta = :lastName, gosti.telefonskiBroj = :phone, 
                        gosti.emailAdresa = :email WHERE gosti.idGosta = :id";
                        $stmt = $connection->prepare($query);
                        $stmt->bindParam(":firstName", $firstName);
                        $stmt->bindParam(":lastName", $lastName);
                        $stmt->bindParam(":phone", $phone);
                        $stmt->bindParam(":email", $email);
                        $stmt->bindParam(":id", $editId);
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