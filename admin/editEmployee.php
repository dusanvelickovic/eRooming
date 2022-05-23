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
            $query = "SELECT * FROM radnici INNER JOIN sektori
            on radnici.idSektora = sektori.idSektora
            WHERE radnici.idRadnika = :editId";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(":editId", $editId);
            $stmt->execute(); 
            while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $firstName = $row->imeRadnika;
                $lastName = $row->prezimeRadnika;
                $phone = $row->telefonskiBroj;
                $gender = $row->pol;
                if($gender = 'm'){
                    $fullGender = 'Musko';
                } else{
                    $fullGender = 'Zensko';
                }
                $dob = $row->datumRodjenja;
                $sectorId = $row->idSektora;
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
                    <h2>Izmeni zaposlenog</h2>
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
                            <input type="tel" minlength="10" maxlength="12" name="phone" required value="<?php echo $phone ?>">
                        </div>
                        <div class="input-form">
                            <label for="gender">Pol</label>
                            <select name="gender" id="" required>
                                <option value="<?php echo $gender ?>"><?php echo $fullGender ?></option>
                                <?php 
                                    if($gender == 'z'){
                                        echo "<option value='m'>Musko</option>";
                                    } else{
                                        echo "<option value='z'>Zensko</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="flex-group">
                        <div class="input-form">
                            <label for="dob">Datum rodjenja</label>
                            <input type="date" name="dob" required value="<?php echo $dob ?>">
                        </div>
                        <div class="input-form">
                            <label for="sector">Sektor</label>
                            <select name="sector" id="" required>
                                <option value="<?php echo $sectorId ?>"><?php echo $sectorName ?></option>
                            <?php 
                                $query = "SELECT * FROM sektori WHERE sektori.imeSektora <> ':sectorName'";
                                $stmt = $connection->prepare($query);
                                $stmt->bindParam(":sectorName", $sectorName);
                                $stmt->execute();
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    $sectorId = $row['idSektora'];
                                    $sectorName = $row['imeSektora'];
                            ?>
                                <option value="<?php echo $sectorId ?>"><?php echo $sectorName ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="flex-group last">
                        <div class="input-form">
                            <label for="submit">Izmeni zaposlenog</label>
                            <input type="submit" class="submit" name="editEmployee" value="Submit">
                        </div>
                    </div>
                </form>
                <?php
                try{
                    if(isset($_POST['editEmployee'])){
                        $firstName = $_POST['firstName'];
                        $lastName = $_POST['lastName'];
                        $phone = $_POST['phone'];
                        $gender = $_POST['gender'];
                        $dob = $_POST['dob'];
                        $sectorId = $_POST['sector'];

                        $query = "UPDATE radnici SET
                        imeRadnika = :firstName,
                        prezimeRadnika = :lastName,
                        telefonskiBroj = :phone,
                        pol = :gender,
                        datumRodjenja = :dob,
                        idSektora = :sectorId
                        WHERE idRadnika = :editId";
                        $stmt = $connection->prepare($query);
                        $stmt->bindParam(":firstName", $firstName);
                        $stmt->bindParam(":lastName", $lastName);
                        $stmt->bindParam(":phone", $phone);
                        $stmt->bindParam(":gender", $gender);
                        $stmt->bindParam(":dob", $dob);
                        $stmt->bindParam(":sectorId", $sectorId);
                        $stmt->bindParam(":editId", $editId);
                        $stmt->execute();
                        header("Location: employees.php");
                    }
                } catch(PDOException $e){
                    die("Error: " . $e->getMessage());
                }
                ?>
            </div>
        </div>
    </div>
<?php include "includes/footer.php" ?>