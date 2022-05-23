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
                    <h2>Spisak svih zaposlenih</h2>
                    <a class="add-room" href="addEmployee.php">Dodaj radnika</a>
                </div>
                <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Ime radnika</th>
                        <th>Prezime radnika</th>
                        <th>Broj telefona</th>
                        <th>Datum rodjenja</th>
                        <th>Pol</th>
                        <th>Sektor</th>
                        <th>Izmeni</th>
                        <th>Ukloni</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM 
                            radnici INNER join sektori
                            on radnici.idSektora = sektori.idSektora
                            INNER join hoteli
                            on radnici.idHotela = hoteli.idHotela 
                            WHERE hoteli.idHotela = :id
                            ORDER BY radnici.idRadnika ASC";

                            $stmt = $connection->prepare($query);
                            $stmt->bindParam(':id', $_SESSION['id']);
                            $stmt->execute();

                            while($row = $stmt->fetch(PDO::FETCH_NUM)){
                                $id = $row['0'];
                                $firstname = $row['1'];
                                $lastName = $row['2'];
                                $phone = $row['3'];
                                $dob = $row['5'];
                                $dob = date('d-m-Y', strtotime($dob));
                                $gender = $row['4'];
                                $hotel = $row['11'];
                                $sector = $row['9'];
                        ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $firstname ?></td>
                                <td><?php echo $lastName ?></td>
                                <td><?php echo $phone?></td>
                                <td><?php echo $dob?></td>
                                <td><?php echo $gender?></td>
                                <td><?php echo $sector?></td>
                                <td><a href="editEmployee.php?editId=<?php echo $id ?>" class="edit">Izmeni</a></td>
                                <td><a href="javascript:remove('employees', <?php echo $id ?>)" class="remove">Ukloni</a></td>
                            </tr>
                        <?php
                            }
                        ?>
                    <tbody>
                        <?php
                            removeDataFromTable('deleteId', 'radnici', 'radnici.idRadnika', 'employees');
                        ?>
                </table>
            </div>
            </div>
        </div>
    </div>
<?php include "includes/footer.php" ?>