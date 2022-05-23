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
            $query = "SELECT * 
            FROM sobe INNER JOIN tipovisoba
            on sobe.idTipaSobe = tipovisoba.idTipaSobe
            WHERE sobe.idSobe = :editId";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(":editId", $editId);
            $stmt->execute(); 
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $roomId = $row['idSobe'];
                $roomType = $row['imeTipaSobe'];
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
                    <h2>Izmeni konfiguraciju sobe</h2>
                </div>
                <form class="add-form" method="POST" action="">
                    <div class="flex-group">
                        <div class="input-form">
                            <label for="roomType">Tip sobe</label>
                            <select name="roomType" id="" required>
                            <?php 
                                $query = "SELECT * FROM tipoviSoba";
                                $stmt = $connection->prepare($query);
                                $stmt->execute();
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    $id = $row['idTipaSobe'];
                                    $roomType = $row['imeTipaSobe'];
                            ?>
                                <option value="<?php echo $id ?>"><?php echo $roomType ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="input-form">
                            <label for="submit">Izmeni sobu</label>
                            <input type="submit" class="submit" name="editRoom" value="Submit">
                        </div>
                    </div>
                </form>
                <?php
                try{
                    if(isset($_POST['editRoom'])){
                        $roomType = $_POST['roomType'];

                        $query = "UPDATE sobe SET sobe.idTipaSobe = :roomType WHERE sobe.idSobe = :editId";
                        $stmt = $connection->prepare($query);
                        $stmt->bindParam(":roomType", $roomType);
                        $stmt->bindParam(":editId", $editId);
                        $stmt->execute();
                        header("Location: rooms.php");
                    }
                } catch(PDOException $e){
                    die("Error: " . $e->getMessage());
                }
                ?>
            </div>
        </div>
    </div>
<?php include "includes/footer.php" ?>