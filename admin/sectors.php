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
                    <h2>Spisak svih sektora</h2>
                    <a class="add-room" href="addSector.php">Dodaj sektor</a>
                </div>
                <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tip sektora</th>
                        <th>Izmeni</th>
                        <th>Ukloni</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM sektori";
                            $stmt = $connection->prepare($query);
                            $stmt->execute();

                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                $id = $row['idSektora'];
                                $name = $row['imeSektora'];
                        ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $name ?></td>
                                <td><a href="editSectors.php?editId=<?php echo $id ?>" class="edit">Izmeni</a></td>
                                <td><a href="javascript:remove('sectors', <?php echo $id ?>)" class="remove">Ukloni</a></td>
                            </tr>
                        <?php
                            }
                        ?>
                    <tbody>
                        <?php
                            removeDataFromTable('deleteId', 'sektori', 'sektori.idSektora', 'sectors');
                        ?>
                </table>
            </div>
            <div class="table">
                <div class="title">
                    <h2>Broj radnika po sektorima</h2>
                </div>
                <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tip sektora</th>
                        <th>Broj radnika</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT COUNT(*) as brojRadnikaSektora, sektori.imeSektora, sektori.idSektora
                            FROM radnici INNER JOIN sektori
                            on radnici.idSektora = sektori.idSektora
                            WHERE radnici.idHotela = :hotelId
                            GROUP by radnici.idSektora";
                            $stmt = $connection->prepare($query);
                            $stmt->bindParam(":hotelId", $_SESSION['id']);
                            $stmt->execute();

                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                $id = $row['idSektora'];
                                $name = $row['imeSektora'];
                                $numOfEmp = $row['brojRadnikaSektora'];
                        ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $name ?></td>
                                <td><?php echo $numOfEmp ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                    <tbody>
                </table>
            </div>
        </div>
    </div>
<?php include "includes/footer.php" ?>