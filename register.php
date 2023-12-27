<?php
include "config.php";
include "navBar.php";
include "css.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt = mysqli_prepare($conn, "INSERT INTO registration_table (name, email, password)  VALUES (?, ?, ?) ");
    $stmt->bind_param("sss", $_POST['name'], $_POST['email'], $password);
    if ($stmt->execute()) {
        echo "<h1 class='alert_h1'> Data Inserted Succesfully You Register Succesfully
        <script>
        setTimeout(function() {
          window.location.href='login.php';
        }, 3000);
      </script>
        </h1>";
    } else {
        echo "<h1 class='alert_h1'>Failed to register /h1>";
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Register Yourself to Get a User ID</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div>
            <label for="name">Name</label><br>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <input type="submit" value="Register Yourself">
        </div>
    </form>
</body>

</html>