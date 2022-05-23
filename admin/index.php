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
      <div class="working">
        <div class="personal">
          <div class="id-card">
            <svg
              width="50"
              height="50"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M6 22.8787C4.34315 22.8787 3 21.5355 3 19.8787V9.87866C3 9.84477 3.00169 9.81126 3.00498 9.77823H3C3 9.20227 3.2288 8.64989 3.63607 8.24262L9.87868 2.00002C11.0502 0.828445 12.9497 0.828445 14.1213 2.00002L20.3639 8.24264C20.7712 8.6499 21 9.20227 21 9.77823H20.995C20.9983 9.81126 21 9.84477 21 9.87866V19.8787C21 21.5355 19.6569 22.8787 18 22.8787H6ZM12.7071 3.41423L19 9.70713V19.8787C19 20.4309 18.5523 20.8787 18 20.8787H15V15.8787C15 14.2218 13.6569 12.8787 12 12.8787C10.3431 12.8787 9 14.2218 9 15.8787V20.8787H6C5.44772 20.8787 5 20.4309 5 19.8787V9.7072L11.2929 3.41423C11.6834 3.02371 12.3166 3.02371 12.7071 3.41423Z"
                fill="currentColor"
              />
            </svg>
            <div class="data">
              <div class="location">
                <h1><?php echo $_SESSION['name'] ?>, </h1>
                <h2><?php echo $_SESSION['city'] ?></h2>
              </div>
              <p><?php echo $_SESSION['email'] ?></p>
            </div>
          </div>
          <div class="id-card">
            <svg
              width="50"
              height="50"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z"
                fill="currentColor"
              />
            </svg>
            <div class="data">
              <div class="location">
                <h1><?php echo $_SESSION['street'] . ', ' ?></h1>
                <h1><?php echo $_SESSION['number'] ?></h1>
              </div>
            </div>
          </div>
          <div class="id-card">
            <svg
              width="50"
              height="50"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path d="M14 11H10V13H14V11Z" fill="currentColor" />
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z"
                fill="currentColor"
              />
            </svg>
            <div class="data">
              <div class="location">
                <h1>Broj gostiju hotela: </h1>
                <h1>
                  <?php 
                    $query = "SELECT COUNT(*) as brojGostiju FROM gosti
                    WHERE idHotela = :hotelId";
                    try{
                      $stmt = $connection->prepare($query);
                      $stmt->bindParam(":hotelId", $_SESSION['id']);
                      $stmt->execute();
                      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $guestsTotal = $row['brojGostiju'];
                      }
                      echo $guestsTotal;
                    } catch(PDOException $e){
                      die("QUERY FAILED" . $e->getMessage());
                    }
                  ?>
                </h1>
              </div>
            </div>
          </div>
          <div class="id-card">
            <svg
                width="50"
                height="50"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7ZM14 7C14 8.10457 13.1046 9 12 9C10.8954 9 10 8.10457 10 7C10 5.89543 10.8954 5 12 5C13.1046 5 14 5.89543 14 7Z"
                  fill="currentColor"
                />
                <path
                  d="M16 15C16 14.4477 15.5523 14 15 14H9C8.44772 14 8 14.4477 8 15V21H6V15C6 13.3431 7.34315 12 9 12H15C16.6569 12 18 13.3431 18 15V21H16V15Z"
                  fill="currentColor"
                />
            </svg>
            <div class="data">
              <div class="location">
                <h1>Broj radnika hotela: </h1>
                <h1>
                <?php 
                    $query = "SELECT COUNT(*) as brojRadnika FROM radnici
                    WHERE idHotela = :hotelId";
                    try{
                      $stmt = $connection->prepare($query);
                      $stmt->bindParam(":hotelId", $_SESSION['id']);
                      $stmt->execute();
                      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $employeesTotal = $row['brojRadnika'];
                      }
                      echo $employeesTotal;
                    } catch(PDOException $e){
                      die("QUERY FAILED" . $e->getMessage());
                    }
                  ?>
                </h1>
              </div>
            </div>
          </div>
          <div class="id-card">
            <svg
              width="50"
              height="50"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M16 7C15.4477 7 15 7.44772 15 8C15 8.55228 15.4477 9 16 9H19C19.5523 9 20 8.55228 20 8C20 7.44772 19.5523 7 19 7H16Z"
                fill="currentColor"
              />
              <path
                d="M15 12C15 11.4477 15.4477 11 16 11H19C19.5523 11 20 11.4477 20 12C20 12.5523 19.5523 13 19 13H16C15.4477 13 15 12.5523 15 12Z"
                fill="currentColor"
              />
              <path
                d="M16 15C15.4477 15 15 15.4477 15 16C15 16.5523 15.4477 17 16 17H19C19.5523 17 20 16.5523 20 16C20 15.4477 19.5523 15 19 15H16Z"
                fill="currentColor"
              />
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M3 3C1.34315 3 0 4.34315 0 6V18C0 19.6569 1.34315 21 3 21H21C22.6569 21 24 19.6569 24 18V6C24 4.34315 22.6569 3 21 3H3ZM21 5H13V19H21C21.5523 19 22 18.5523 22 18V6C22 5.44772 21.5523 5 21 5ZM3 5H11V19H3C2.44772 19 2 18.5523 2 18V6C2 5.44772 2.44772 5 3 5Z"
                fill="currentColor"
              />
            </svg>
            <div class="data">
              <div class="location">
                <h1>Broj rezervisanih soba: </h1>
                <h1>
                <?php 
                    $query = "SELECT COUNT(*) as brojRezervisanihSoba FROM sobe
                    WHERE idHotela = :hotelId && sobe.statusRezervisanosti = '1'";
                    try{
                      $stmt = $connection->prepare($query);
                      $stmt->bindParam(":hotelId", $_SESSION['id']);
                      $stmt->execute();
                      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $occupiedRoomsTotal = $row['brojRezervisanihSoba'];
                      }
                      echo $occupiedRoomsTotal;
                    } catch(PDOException $e){
                      die("QUERY FAILED" . $e->getMessage());
                    }
                  ?>
                </h1>
              </div>
            </div>
          </div>
          <div class="id-card">
            <svg
              width="50"
              height="50"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M4 5.5H9C10.1046 5.5 11 6.39543 11 7.5V16.5C11 17.0523 10.5523 17.5 10 17.5H4C3.44772 17.5 3 17.0523 3 16.5V6.5C3 5.94772 3.44772 5.5 4 5.5ZM14 19.5C13.6494 19.5 13.3128 19.4398 13 19.3293V19.5C13 20.0523 12.5523 20.5 12 20.5C11.4477 20.5 11 20.0523 11 19.5V19.3293C10.6872 19.4398 10.3506 19.5 10 19.5H4C2.34315 19.5 1 18.1569 1 16.5V6.5C1 4.84315 2.34315 3.5 4 3.5H9C10.1947 3.5 11.2671 4.02376 12 4.85418C12.7329 4.02376 13.8053 3.5 15 3.5H20C21.6569 3.5 23 4.84315 23 6.5V16.5C23 18.1569 21.6569 19.5 20 19.5H14ZM13 7.5V16.5C13 17.0523 13.4477 17.5 14 17.5H20C20.5523 17.5 21 17.0523 21 16.5V6.5C21 5.94772 20.5523 5.5 20 5.5H15C13.8954 5.5 13 6.39543 13 7.5ZM5 7.5H9V9.5H5V7.5ZM15 7.5H19V9.5H15V7.5ZM19 10.5H15V12.5H19V10.5ZM5 10.5H9V12.5H5V10.5ZM19 13.5H15V15.5H19V13.5ZM5 13.5H9V15.5H5V13.5Z"
                fill="currentColor"
              />
            </svg>
            <div class="data">
              <div class="location">
                <h1>Broj soba hotela: </h1>
                <h1>
                <?php 
                    $query = "SELECT COUNT(*) as brojSoba FROM sobe
                    WHERE idHotela = :hotelId";
                    try{
                      $stmt = $connection->prepare($query);
                      $stmt->bindParam(":hotelId", $_SESSION['id']);
                      $stmt->execute();
                      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $roomsTotal = $row['brojSoba'];
                      }
                      echo $roomsTotal;
                    } catch(PDOException $e){
                      die("QUERY FAILED" . $e->getMessage());
                    }
                  ?>
                </h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include "includes/footer.php" ?>