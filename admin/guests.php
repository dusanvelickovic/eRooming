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
                    <h2>Spisak svih gostiju</h2>
                    <a class="add-room" href="addGuest.php">Dodaj gosta</a>
                </div>
                <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Ime gosta</th>
                        <th>Prezime gosta</th>
                        <th>Broj telefona</th>
                        <th>Email</th>
                        <th>Izmeni</th>
                        <th>Ukloni</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM gosti WHERE idHotela = :idHotela";

                            $stmt = $connection->prepare($query);
                            $stmt->bindParam(":idHotela", $_SESSION['id']);
                            $stmt->execute();

                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                $id = $row['idGosta'];
                                $firstName = $row['imeGosta'];
                                $lastName = $row['prezimeGosta'];
                                $phone = $row['telefonskiBroj'];
                                $email = $row['emailAdresa'];
                        ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $firstName ?></td>
                                <td><?php echo $lastName ?></td>
                                <td><?php echo $phone ?></td>
                                <td><?php echo $email ?></td>
                                <td><a href="editGuest.php?editId=<?php echo $id ?>" class="edit">Izmeni</a></td>
                                <td><a href="javascript:remove('guests', <?php echo $id ?>)" class="remove">Ukloni</a></td>
                            </tr>
                        <?php
                            }
                        ?>
                    <tbody>
                        <?php
                            removeDataFromTable('deleteId', 'gosti', 'gosti.idGosta', 'guests');
                        ?>
                </table>
            </div>
            </div>
        </div>
    </div>
<?php include "includes/footer.php" ?>