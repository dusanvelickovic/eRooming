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
            $query = "SELECT * FROM rezervacije INNER JOIN gosti
            on rezervacije.idGosta = gosti.idGosta
            INNER join sobe
            on rezervacije.idSobe = sobe.idSobe
            INNER join tipovisoba
            on sobe.idTipaSobe = tipovisoba.idTipaSobe
            WHERE rezervacije.idRezervacije = :editId";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(":editId", $editId);
            $stmt->execute(); 
            while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $guestId = $row->idGosta;
                $firstName = $row->imeGosta;
                $lastName = $row->prezimeGosta;
                $guestName = $firstName . ' ' . $lastName;
                $start_date = $row->datumRezervacije;
                $end_date = $row->krajRezervacije;
                $roomTypeId = $row->idTipaSobe;
                $roomName = $row->imeTipaSobe;
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
                    <h2>Izmeni konfiguraciju rezervacije</h2>
                </div>
                <form class="add-form" method="POST" action="">
                    <div class="flex-group">
                    <div class="input-form">
                            <label for="guest">Ime gosta</label>
                            <select name="guest" id="" required>
                                <option value="<?php echo $guestId ?>"><?php echo $guestName ?></option>
                            <?php 
                                $query = "SELECT idGosta, concat(imeGosta,' ',prezimeGosta) as gost FROM gosti
                                WHERE idHotela = :idHotela && idGosta <> :guestId";
                                $stmt = $connection->prepare($query);
                                $stmt->bindParam(":idHotela", $_SESSION['id']);
                                $stmt->bindParam(":guestId", $guestId);
                                $stmt->execute();
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    $guestId = $row['idGosta'];
                                    $guestName = $row['gost'];
                            ?>
                                <option value="<?php echo $guestId ?>"><?php echo $guestName ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="input-form">
                            <label for="room">Soba</label>
                            <select name="room" id="" required>
                                <option value="<?php echo $roomTypeId ?>"><?php echo $roomName ?></option>
                            <?php 
                                $query = "SELECT * 
                                FROM sobe 
                                INNER JOIN tipovisoba
                                on sobe.idTipaSobe = tipovisoba.idTipaSobe
                                WHERE idHotela = :idHotela and statusRezervisanosti = 0";
                                $stmt = $connection->prepare($query);
                                $stmt->bindParam(":idHotela", $_SESSION['id']);
                                $stmt->execute();
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    $id = $row['idSobe'];
                                    $roomType = $row['imeTipaSobe'];
                            ?>
                                <option value="<?php echo $id ?>"><?php echo $roomType ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="flex-group">
                        <div class="input-form">
                            <label for="start-date">Pocetak rezervacije</label>
                            <input type="date" name="start-date" id="" required value="<?php echo $start_date ?>">
                        </div>
                        <div class="input-form">
                            <label for="end-date">Kraj rezervacije</label>
                            <input type="date" name="end-date" id="" required value="<?php echo $end_date ?>">
                        </div>
                    </div>
                    <div class="flex-group">
                        <div class="input-form">
                            <label for="submit">Izmeni rezervaciju</label>
                            <input type="submit" class="submit" name="editReservation" value="Submit">
                        </div>
                    </div>
                </form>
                <?php
                try{
                    if(isset($_POST['editReservation'])){
                        $guestId = $_POST['guest'];
                        $start_date = $_POST['start-date'];
                        $end_date = $_POST['end-date'];
                        $roomId = $_POST['room'];

                        $query = "UPDATE rezervacije SET
                        idGosta = :guestId,
                        datumRezervacije = :start_date,
                        krajRezervacije = :end_date,
                        idSobe = :roomId 
                        WHERE idRezervacije = :editId";
                        $stmt = $connection->prepare($query);
                        $stmt->bindParam(":guestId", $guestId);
                        $stmt->bindParam(":start_date", $start_date);
                        $stmt->bindParam(":end_date", $end_date);
                        $stmt->bindParam(":roomId", $roomId);
                        $stmt->bindParam(":editId", $editId);
                        $stmt->execute();
                        header("Location: reservations.php");
                    }
                } catch(PDOException $e){
                    die("Error: " . $e->getMessage());
                }
                ?>
            </div>
        </div>
    </div>
<?php include "includes/footer.php" ?>