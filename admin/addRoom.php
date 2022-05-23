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
                    <h2>Dodaj novu sobu</h2>
                </div>
                <form class="add-form" method="POST" action="addRoom.php">
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
                            <label for="submit">Dodaj novu sobu</label>
                            <input type="submit" class="submit" name="addRoom" value="Submit">
                        </div>
                    </div>
                </form>
                <?php
                try{
                    if(isset($_POST['addRoom'])){
                        $roomType = $_POST['roomType'];

                        $query = "INSERT INTO sobe(idHotela, idTipaSobe) VALUES 
                        (:idHotela, :roomType)";
                        $stmt = $connection->prepare($query);
                        $stmt->bindParam(":idHotela", $_SESSION['id']);
                        $stmt->bindParam(":roomType", $roomType);
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