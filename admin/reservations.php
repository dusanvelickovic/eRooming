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
                    <h2>Spisak svih rezervacija</h2>
                    <a class="add-room" href="addReservation.php">Dodaj rezervaciju</a>
                </div>
                <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                    <tr>
                        <th>Id rezervacije</th>
                        <th>Id gosta</th>
                        <th>Ime gosta</th>
                        <th>Prezime gosta</th>
                        <th>Datum rezervacije</th>
                        <th>Kraj rezervacije</th>
                        <th>Id sobe</th>
                        <th>Tip sobe</th>
                        <th>Izmeni</th>
                        <th>Ukloni</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT *
                            FROM rezervacije INNER JOIN gosti
                            on rezervacije.idGosta = gosti.idGosta
                            INNER JOIN sobe 
                            ON rezervacije.idSobe = sobe.idSobe 
                            INNER JOIN hoteli
                            on sobe.idHotela = hoteli.idHotela
                            INNER join tipovisoba
                            on sobe.idTipaSobe = tipovisoba.idTipaSobe
                            WHERE hoteli.idHotela = :id";

                            $stmt = $connection->prepare($query);
                            $stmt->bindParam(':id', $_SESSION['id']);
                            $stmt->execute();

                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                $id = $row['idRezervacije'];
                                $date = $row['datumRezervacije'];
                                $date = date("d-m-Y", strtotime($date));
                                $checkout = $row['krajRezervacije'];
                                $checkout = date("d-m-Y", strtotime($checkout));
                                $roomId = $row['idSobe'];
                                $roomType = $row['imeTipaSobe'];
                                $guestId = $row['idGosta'];
                                $firstname = $row['imeGosta'];
                                $lastName = $row['prezimeGosta'];
                        ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $guestId ?></td>
                                <td><?php echo $firstname ?></td>
                                <td><?php echo $lastName ?></td>
                                <td><?php echo $date ?></td>
                                <td><?php echo $checkout ?></td>
                                <td><?php echo $roomId ?></td>
                                <td><?php echo $roomType ?></td>
                                <td><a href="editReservation.php?editId=<?php echo $id ?>" class="edit">Izmeni</a></td>
                                <td><a href="javascript:remove('reservations', <?php echo $id ?>)" class="remove">Ukloni</a></td>
                            </tr>
                        <?php
                            }
                        ?>
                    <tbody>
                        <?php
                            removeDataFromTable('deleteId', 'rezervacije', 'rezervacije.idRezervacije', 'reservations');
                        ?>
                </table>
            </div>
            </div>
        </div>
    </div>
<?php include "includes/footer.php" ?>