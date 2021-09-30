<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
    <title></title>
    <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" 
          rel = "stylesheet" 
          integrity = "sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" 
          crossorigin = "anonymous" />
    <link rel = "stylesheet" 
          href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" 
          integrity = "sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" 
          crossorigin = "anonymous" 
          referrerpolicy = "no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Akaya Kanadaka', cursive;
            background-image: url(img/history.jpg);
            background-size: cover;
            width: 100%;
        }

        a {
            text-decoration: none;
            color: initial;
        }

        a:hover {
            color: initial;
        }

        .navbarnav {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            height: 15vh;
        }

        footer {
            text-align: center;
            padding: 2vh 0vh 0.5vh;
            background-color: black;
            color: white;
            height: 10vh;
        }
    </style>
</head>
<body>
<nav class="bg-success">
        <ul class="navbarnav">
            <li class="nav-item" type="none">
                <a class="navbar-brand" href="index.html"><img src="img/logo.png" alt="logo" height="90 vh"></a>
            </li>
            <li class="nav-item text-white fs-1 p-3" type="none">
                Basic Banking System
            </li>
            <li class="nav-item" type="none">
                <img src="img/bank-building.png" alt="bank logo" height="80 vh">
            </li>
        </ul>
    </nav>  
    <main class = "container">
    <div class = "container mt-4">
    <span><button type="button" class="btn btn-info"><a href = "index.html"><i class="fas fa-home text-dark"> Home</i></a></button></span>
    <span><button type="button" class="btn btn-success"><a href = "users.php"><i class="fas fa-users text-light"> All Users</i></a></button></span>
        <span><button type="button" class="btn btn-primary"><a href = "transact.php"><i class="fas fa-exchange-alt text-light"> Transfer Money</i></a></button></span>
        </div>
        <p class = "text-decoration-underline fs-4 mx-5 mt-2 pt-4"><b>Transaction History:-</b></p>
        <table class = "bg-white table table-info table-striped table-hover w-75 mx-5 mt-5 fs-5">
            <thead class="table-dark">
                <tr>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $servername = "localhost";
                  $username = "root";
                  $password = "";
                  
                  $conn = mysqli_connect($servername, $username, $password, "basic_banking_system");
                  
                  if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                  } 
                  
                  $sql = "SELECT debtor, creditor, amount FROM history";
                  $result = mysqli_query($conn, $sql);

                  if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                          $debtor = explode(" ", $row["debtor"])[0];
                          $creditor = explode(" ", $row["creditor"])[0];

                          $sender = getBalance($conn, $debtor, $creditor)[0];
                          $receiver = getBalance($conn, $debtor, $creditor)[1];

                          echo "<tr>";
                          echo "<td>" . $row["debtor"] . " (Remaining balance is " . $sender . ")" . "</td>";
                          echo "<td>" . $row["creditor"] . " (Remaining balance is " . $receiver . ")" . "</td>";
                          echo "<td>" . $row["amount"] . "</td>";
                          echo "</tr>";
                      }
                  }

                  function getBalance($conn, $debtor, $creditor) {
                      $changes = array();
                      $sql = "SELECT balance FROM users WHERE fname = '$debtor'";
                      $result = mysqli_query($conn, $sql);

                      if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) {
                              array_push($changes, $row["balance"]);
                        }
                      }

                      $sql = "SELECT balance FROM users WHERE fname = '$creditor'";
                      $result = mysqli_query($conn, $sql);

                      if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) {
                              array_push($changes, $row["balance"]);
                         }
                      }

                      return $changes;
                  }

                  mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>
            &copy; Developed by Srinjoy Banerjee | All rights reserved
        </p>
    </footer>
</body>
</html>