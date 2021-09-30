<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
                  
    $conn = mysqli_connect($servername, $username, $password, "basic_banking_system");
                  
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } 

    $debtor = $_POST["debtor"];
    $creditor = $_POST["creditor"];
    $amount = $_POST["amount"];
                  
    $sql = "SELECT ID, fname, lname, balance FROM users WHERE fname = '$debtor'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row["ID"];
            $sender = $row["fname"] . " " . $row["lname"];      

            if($amount >= $row["balance"]) {
                echo "500";
            } else {
                $change = $row["balance"] - $amount;
                $sql = "UPDATE users SET balance = $change WHERE ID = $id";
                
                if(mysqli_query($conn, $sql)) {
                    $sql = "SELECT ID, fname, lname, balance FROM users WHERE fname = '$creditor'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $id = $row["ID"];
                            $receiver = $row["fname"] . " " . $row["lname"];
                            $change = $row["balance"] + $amount;
                            $sql = "UPDATE users SET balance = $change WHERE ID = $id";

                            if(mysqli_query($conn, $sql)) {
                                $sql = "INSERT INTO history (debtor, creditor, amount) VALUES ('$sender', '$receiver', $amount)";

                                if (mysqli_query($conn, $sql)) {
                                    echo "200";
                                }
                            }
                        }                     
                    }
                }
            }
        }
    }

    mysqli_close($conn);  
?>