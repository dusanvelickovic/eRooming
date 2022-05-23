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
                    <h2>Dodaj novu rezervaciju</h2>
                </div>
                <form class="add-form" method="POST" action="addReservation.php">
                    <div class="flex-group">
                    <div class="input-form">
                            <label for="guest">Ime gosta</label>
                            <select name="guest" id="" required>
                            <?php 
                                $query = "SELECT idGosta, concat(imeGosta,' ',prezimeGosta) as gost FROM gosti
                                WHERE idHotela = :idHotela";
                                $stmt = $connection->prepare($query);
                                $stmt->bindParam(":idHotela", $_SESSION['id']);
                                $stmt->execute();
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    $id = $row['idGosta'];
                                    $guest = $row['gost'];
                            ?>
                                <option value="<?php echo $id ?>"><?php echo $guest ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="input-form">
                            <label for="room">Soba</label>
                            <select name="room" id="" required>
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
                            <input type="date" name="start-date" id="reservationStartDate" required>
                        </div>
                        <div class="input-form">
                            <label for="end-date">Kraj rezervacije</label>
                            <input type="date" name="end-date" id="" required>
                        </div>
                    </div>
                    <div class="flex-group">
                        <div class="input-form">
                            <label for="submit">Napravi rezervaciju</label>
                            <input type="submit" class="submit" name="addReservation" value="Submit">
                            <p><?php echo isset($errors['date']) ? $errors['date'] : '' ?></p>
                        </div>
                    </div>
                </form>
                <?php
                try{
                    if(isset($_POST['addReservation'])){
                        $guestId = $_POST['guest'];
                        $start_date = $_POST['start-date'];
                        $end_date = $_POST['end-date'];
                        $roomId = $_POST['room'];

                        $errors = [
                            'date' => ''
                        ];
                        if($start_date > $end_date){
                            $errors['date'] = 'Pogresan unos datuma!';
                            echo '<script language="javascript">';
                            echo 'alert("Pogresan unos datuma")';
                            echo '</script>';
                        }
                        foreach($errors as $key => $item){
                            if(empty($item)){
                              unset($errors[$key]);
                            }
                        }
                        if(empty($errors)){    
                            $query = "INSERT INTO rezervacije(idGosta, datumRezervacije, krajRezervacije, idSobe) VALUES 
                            (:guestId, :start_date, :end_date, :roomId)";
                            $stmt = $connection->prepare($query);
                            $stmt->bindParam(":guestId", $guestId);
                            $stmt->bindParam(":start_date", $start_date);
                            $stmt->bindParam(":end_date", $end_date);
                            $stmt->bindParam(":roomId", $roomId);
                            $stmt->execute();
                            header("Location: reservations.php");
                        }
                    }
                } catch(PDOException $e){
                    die("Error: " . $e->getMessage());
                }
                ?>
            </div>
        </div>
    </div>
    <script src="js/reservation.js"></script>
<?php include "includes/footer.php" ?>