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
                    <h2>Dodaj novi sektor</h2>
                </div>
                <form class="add-form" method="POST" action="addSector.php">
                    <div class="flex-group">
                        <div class="input-form">
                            <label for="sectorName">Ime sektora</label>
                            <input type="text" name="sectorName" required>
                        </div>
                        <div class="input-form">
                            <label for="submit">Dodaj sektor</label>
                            <input type="submit" class="submit" name="addSector" value="Submit">
                        </div>
                    </div>
                </form>
                <?php
                try{
                    if(isset($_POST['addSector'])){
                        $sectorName = $_POST['sectorName'];

                        $query = "INSERT INTO sektori(imeSektora) VALUES (:sectorName)";
                        $stmt = $connection->prepare($query);
                        $stmt->bindParam(":sectorName", $sectorName);
                        $stmt->execute();
                        header("Location: sectors.php");
                    }
                } catch(PDOException $e){
                    die("Error: " . $e->getMessage());
                }
                ?>
            </div>
        </div>
    </div>
<?php include "includes/footer.php" ?>