<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['name'];
    # $number = $_POST['number'];
    # $date = $_POST['date'];
    # $additional = $_POST['additional_food'];
    $message = $_POST['message'];

    if (empty($name) || empty($message) ) {
        echo "some info is missing ";
    } else {
        define("DB_HOST", "localhost");
        define("DB_USER", "root");
        define("DB_PASSWORD", "");
        define("DB_DATABASE", "comments");
    
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO comments (Message,  name)
                VALUES ('$message', '$name')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully ";

            $sql2 = "SELECT name, message FROM comments";
            $result = $conn->query($sql2);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  echo  $row["name"].  $row["message"].  "<br>";
                }
              } else {
                echo "0 results";
              }
            
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    
}
?>





