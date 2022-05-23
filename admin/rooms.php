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
                    <h2>Spisak svih soba</h2>
                    <a class="add-room" href="addRoom.php">Dodaj sobu</a>
                </div>
                <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tip sobe</th>
                        <th>Status rezervisanosti</th>
                        <th>Izmeni</th>
                        <th>Ukloni</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * 
                            from sobe INNER JOIN hoteli
                            on sobe.idHotela = hoteli.idHotela
                            INNER join tipovisoba
                            on sobe.idTipaSobe = tipovisoba.idTipaSobe
                            WHERE hoteli.idHotela = :id
                            ORDER BY tipovisoba.idTipaSobe";

                            $stmt = $connection->prepare($query);
                            $stmt->bindParam(':id', $_SESSION['id']);
                            $stmt->execute();

                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                $id = $row['idSobe'];
                                $roomType = $row['imeTipaSobe'];
                                $status = $row['statusRezervisanosti'];
                                if($status == null || 0){
                                    $status = 'slobodna';
                                } else if($status == 1){
                                    $status = 'rezervisana';
                                }
                        ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $roomType ?></td>
                                <td><?php echo $status ?></td>
                                <td><a href="editRoom.php?editId=<?php echo $id ?>" class="edit">Izmeni</a></td>
                                <td><a href="javascript:remove('rooms', <?php echo $id ?>)" class="remove">Ukloni</a></td>
                            </tr>
                        <?php
                            }
                        ?>
                    <tbody>
                        <?php
                            removeDataFromTable('deleteId', 'sobe', 'sobe.idSobe', 'rooms');
                        ?>
                </table>
            </div>
            <div class="table">
                <div class="title">
                    <h2>Raspolozivost soba</h2>
                </div>
                <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                    <tr>
                        <th>Id tipa sobe</th>
                        <th>Tip sobe</th>
                        <th>Broj rezervisanih soba / Ukupan broj soba</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT tipovisoba.idTipaSobe, tipovisoba.imeTipaSobe, 
                            COUNT(sobe.idSobe) as ukupanBrojSoba, 
                            SUM(sobe.statusRezervisanosti) as brojRezervisanihSoba 
                            FROM sobe INNER JOIN tipovisoba 
                            on sobe.idTipaSobe = tipovisoba.idTipaSobe 
                            WHERE sobe.idHotela = :hotelId 
                            GROUP by tipovisoba.idTipaSobe;";

                            $stmt = $connection->prepare($query);
                            $stmt->bindParam(':hotelId', $_SESSION['id']);
                            $stmt->execute();

                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                $roomTypeId = $row['idTipaSobe'];
                                $roomType = $row['imeTipaSobe'];
                                $roomsTotal = $row['ukupanBrojSoba'];
                                $occupiedRoomsNum = $row['brojRezervisanihSoba'];
                        ?>
                            <tr>
                                <td><?php echo $roomTypeId ?></td>
                                <td><?php echo $roomType ?></td>
                                <td><?php echo $occupiedRoomsNum . ' / ' . $roomsTotal ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                    <tbody>
                        <?php
                            removeDataFromTable('deleteId', 'sobe', 'sobe.idSobe', 'rooms');
                        ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php" ?>