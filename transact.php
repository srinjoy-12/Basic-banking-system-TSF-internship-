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
    <script src = "https://code.jquery.com/jquery-3.6.0.min.js"
            integrity = "sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin = "anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Akaya Kanadaka', cursive;
            background-image: url(img/transact.JPG);
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
        <span><button type="button" class="btn btn-danger"><a href = "history.php"><i class="fas fa-history text-light"> View History</i></a></button></span>
        </div>
        <p class = "text-decoration-underline text-light fs-4 mx-5 mt-2 pt-4"><b>Transact Amount :-</b></p>
        <div id = "alert"></div>
        <form class = "w-75 mx-5 mt-4" id = "lend-fund" onsubmit = "doTransfer(event);">
            <label class = "form-label text-info bg-dark mb-3 fs-4"><u>Debtor:- </u></label>
            <select class = "form-select mb-4 fs-5" onchange = "getDebtor(this.value);" required>
                <option value = "">Select from whoose account you want to transfer money!</option>
                <?php
                  $servername = "localhost";
                  $username = "root";
                  $password = "";
                  
                  $conn = mysqli_connect($servername, $username, $password, "basic_banking_system");
                  
                  if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                  } 
                  
                  $sql = "SELECT fname, lname, balance FROM users";
                  $result = mysqli_query($conn, $sql);

                  if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                          echo "<option value = '" . $row["fname"] . "'>" . $row["fname"] . " " . $row["lname"] . " (Remaining balance is " . $row["balance"] . ")" . "</option>";
                      }
                  }

                  mysqli_close($conn);  
                ?>
            </select>
            <label class = "form-label text-info bg-dark mb-3 fs-4">Creditor:- </label>
            <select class = "form-select mb-4 fs-5" onchange = "getCreditor(this.value);" required>
                <option value = "">Select to whom you want to send money!</option>
                <?php
                  $servername = "localhost";
                  $username = "root";
                  $password = "";
                  
                  $conn = mysqli_connect($servername, $username, $password, "basic_banking_system");
                  
                  if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                  } 
                  
                  $sql = "SELECT fname, lname, balance FROM users";
                  $result = mysqli_query($conn, $sql);

                  if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                          echo "<option value = '" . $row["fname"] . "'>" . $row["fname"] . " " . $row["lname"] . " (Remaining balance is " . $row["balance"] . ")" . "</option>";
                      }
                  }

                  mysqli_close($conn);  
                ?>
            </select>
            <div class = "form-floating mb-4 fs-5">
                <input type = "number" class = "form-control" id = "floatingInput" required>
                <label for = "floatingInput" class="text-dark fs-5">Fund Amount</label>
            </div>
            <button type = "submit" class = "btn btn-info mb-4 "><b>Transact money</b></button>
        </form>
    </main>
    <script>
        let debtor = "";
        let creditor = "";
        let error = "";

        var reference = document.getElementById("alert");
        var form = document.getElementById("lend-fund");

        function getDebtor(value) {
            debtor = value;
        }
        
        function getCreditor(value) {
            creditor = value;
        }

        function doTransfer(event) {
            event.preventDefault();

            if(debtor == creditor) {
                error = "<span class = 'alert alert-danger mx-5 mt-5'>Select two different accounts!</span>";
                reference.innerHTML = error;
            } else if(form["floatingInput"].value <=0 ) {
                error = "<span class = 'alert alert-danger mx-5 mt-5'>Value must be positive!</span>";
                reference.innerHTML = error;
            } else {
                $.ajax({
                    type: "POST",
                    url: "fund.php",
                    data: "debtor=" + debtor + "&creditor=" + creditor + "&amount=" + form["floatingInput"].value,
                    success: function(status) {
                        if(status == "200") {
                            error = "<span class = 'alert alert-success mx-5 mt-5'>Transaction successful!</span>";
                            reference.innerHTML = error;

                        } else if(status == "500") {
                            error = "<span class = 'alert alert-danger mx-5 mt-5'>Insufficient balance in debtor's account for a valid transaction!</span>";
                            reference.innerHTML = error;
                        } else {
                            error = "<span class = 'alert alert-danger mx-5 mt-5'>Some error occurred! retry</span>";
                            reference.innerHTML = error;
                        }
                    }
                });
            }
        }
    </script>
    <footer>
        <p>
            &copy; Developed by Srinjoy Banerjee | All rights reserved
        </p>
    </footer>
</body>
</html>