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
            $query = "SELECT * FROM sektori WHERE sektori.idSektora = :editId";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(":editId", $editId);
            $stmt->execute(); 
            while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $sectorName = $row->imeSektora;
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
                    <h2>Izmeni konfiguraciju sektora</h2>
                </div>
                <form class="add-form" method="POST" action="">
                    <div class="flex-group">
                        <div class="input-form">
                            <label for="sectorName">Ime sektora</label>
                            <input type="text" name="sectorName" required value="<?php echo $sectorName ?>">
                        </div>
                        <div class="input-form">
                            <label for="submit">Izmeni sektor</label>
                            <input type="submit" class="submit" name="updateSector" value="Submit">
                        </div>
                    </div>
                </form>
                <?php
                try{
                    if(isset($_POST['updateSector'])){
                        $sectorName = $_POST['sectorName'];

                        $query = "UPDATE sektori SET sektori.imeSektora = :sectorName WHERE sektori.idSektora = :sectorId";
                        $stmt = $connection->prepare($query);
                        $stmt->bindParam(":sectorName", $sectorName);
                        $stmt->bindParam(":sectorId", $editId);
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