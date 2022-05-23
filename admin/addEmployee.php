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
                    <h2>Dodaj novog zaposlenog</h2>
                </div>
                <form class="add-form" method="POST" action="addEmployee.php">
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
                            <label for="gender">Pol</label>
                            <select name="gender" id="" required>
                                <option value="m">Musko</option>
                                <option value="z">Zensko</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex-group">
                        <div class="input-form">
                            <label for="dob">Datum rodjenja</label>
                            <input type="date" id="employeeDoB" name="dob" id="" required>
                        </div>
                        <div class="input-form">
                            <label for="sector">Sektor</label>
                            <select name="sector" id="" required>
                            <?php 
                                $query = "SELECT * FROM sektori";
                                $stmt = $connection->prepare($query);
                                $stmt->execute();
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    $id = $row['idSektora'];
                                    $sectorName = $row['imeSektora'];
                            ?>
                                <option value="<?php echo $id ?>"><?php echo $sectorName ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="flex-group last">
                        <div class="input-form">
                            <label for="submit">Dodaj zaposlenog</label>
                            <input type="submit" class="submit" name="addEmployee" value="Submit">
                        </div>
                    </div>
                </form>
                <?php
                try{
                    if(isset($_POST['addEmployee'])){
                        $firstName = $_POST['firstName'];
                        $lastName = $_POST['lastName'];
                        $phone = $_POST['phone'];
                        $gender = $_POST['gender'];
                        $dob = $_POST['dob'];
                        $hotel = $_SESSION['id'];
                        $sector = $_POST['sector'];

                        $query = "INSERT INTO radnici(imeRadnika, prezimeRadnika, telefonskiBroj, 
                        pol, datumRodjenja, idHotela, idSektora) VALUES 
                        (:firstName, :lastName, :phone, :gender, :dob, :hotel, :sector)";
                        $stmt = $connection->prepare($query);
                        $stmt->bindParam(":firstName", $firstName);
                        $stmt->bindParam(":lastName", $lastName);
                        $stmt->bindParam(":phone", $phone);
                        $stmt->bindParam(":gender", $gender);
                        $stmt->bindParam(":dob", $dob);
                        $stmt->bindParam(":hotel", $hotel);
                        $stmt->bindParam(":sector", $sector);
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
    <script src="js/employee.js"></script>
<?php include "includes/footer.php" ?>