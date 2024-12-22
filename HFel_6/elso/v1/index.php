<!DOCTYPE html>
<html>
<head>
    <title>Első verzió</title>

</head>
<body>

<?php
$savedFilePath = "";
$firstName = $lastName = $email = $attend = $tshirt = $abstract = $terms = "";
$firstNameErr = $lastNameErr = $emailErr = $attendErr = $abstractErr = $termsErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstName"])) {
        $firstNameErr = "First name is required";
    } else {
        $firstName = test_input($_POST["firstName"]);
    }

    if (empty($_POST["lastName"])) {
        $lastNameErr = "Last name is required";
    } else {
        $lastName = test_input($_POST["lastName"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    if (!isset($_POST["attend"]) || count($_POST["attend"]) < 1) {
        $attendErr = "At least one event must be selected";
    } else {
        $attend = $_POST["attend"];
    }

    if ($_POST["tshirt"] == "P") {
        $tshirt = "(You did not provide a t-shirt size) ";
    } else {
        $tshirt = test_input($_POST["tshirt"]);
    }

    if (empty($_FILES["abstract"]["name"])) {
        $abstractErr = "Abstract file is required";
    } else {
        $file_name = $_FILES["abstract"]["name"];
        $file_size = $_FILES["abstract"]["size"];
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION); // lekérem a kiterjesztést
        if ($file_type != "pdf" || $file_size > 3145728 ) { // 3MB = 3 * 1024 * 1024 = 3 145 728 bájt
            $abstractErr = "Invalid abstract file. Only PDF files up to 3MB are allowed.";
        } else {
            $abstract = $file_name;
            $upload_directory = __DIR__ . "/../uploaded"; // a fájlok elmentését ki szerettem volna próbálni, hogy egy külün mappába másolom a temporális fájlt
            $uploaded_file_tmp = $_FILES["abstract"]["tmp_name"];
            $uploaded_file_name = $_FILES["abstract"]["name"];
            $savedFilePath = $upload_directory . "/" . $uploaded_file_name;
            move_uploaded_file($uploaded_file_tmp, $savedFilePath);
        }
    }

    if (!isset($_POST["terms"])) {
        $termsErr = "You must agree to terms & conditions";
    } else {
        $terms = "Terms & conditions accepted";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($firstNameErr == "" && $lastNameErr == "" && $emailErr == "" && $attendErr == "" && $abstractErr == "" && $termsErr == "") {

        echo "<h2 style='color: green'> Thank you, your registration was successfull </h2>";
        echo "<p>Name: " .$firstName . " ".$lastName ."</p>";
        echo "<p>Email: " . $email . "</p>";
        echo "<p>Events to Attend:  </p>";
        echo "<ol>";
        foreach ($attend as $event){
            echo "<li>".$event."</li>";
        }
        echo "</ol>";
        echo "<p>T-Shirt Size: " . $tshirt . "</p>";
        echo "<p>Abstract File: <a href='".$savedFilePath."'>" . $abstract . "</a></p>";
        echo"<hr>";
    }
}
?>

<h3>Online conference registration</h3>

<input method="post" action="" enctype="multipart/form-data">
    <label for="fname"> First name:
        <input type="text" name="firstName" value="<?php echo $firstName; ?>">
        <span style="color: red;"><?php echo $firstNameErr; ?></span> <!-- A hibaüzeneteket megjelenítem a megfelelő helyen -->
    </label>
    <br><br>
    <label for="lname"> Last name:
        <input type="text" name="lastName" value="<?php echo $lastName; ?>">
        <span style="color: red;"><?php echo $lastNameErr; ?></span>
    </label>
    <br><br>
    <label for="email"> E-mail:
        <input type="text" name="email" value="<?php echo $email; ?>">
        <span style="color: red;"><?php echo $emailErr; ?></span>
    </label>
    <br><br>
    <label for="attend"> I will attend:<br>
        <input type="checkbox" name="attend[]" value="Event1" <?php if (isset($_POST["attend"]) && in_array("Event1", $_POST["attend"])) echo "checked"; ?>>Event 1<br>
        <input type="checkbox" name="attend[]" value="Event2" <?php if (isset($_POST["attend"]) && in_array("Event2", $_POST["attend"])) echo "checked"; ?>>Event2<br>
        <input type="checkbox" name="attend[]" value="Event3" <?php if (isset($_POST["attend"]) && in_array("Event3", $_POST["attend"])) echo "checked"; ?>>Event3<br>
        <input type="checkbox" name="attend[]" value="Event4" <?php if (isset($_POST["attend"]) && in_array("Event4", $_POST["attend"])) echo "checked"; ?>>Event4<br>
        <span style="color: red;"><?php echo $attendErr; ?></span>
    </label>
    <br><br>
    <label for="tshirt"> What's your T-Shirt size?<br>
        <select name="tshirt"
        <option value="P" <?php if ($tshirt == "Please select") echo "selected"; ?>>Please select</option>
        <option value="S" <?php if ($tshirt == "S") echo "selected"; ?>>S</option>
        <option value="M" <?php if ($tshirt == "M") echo "selected"; ?>>M</option>
        <option value="L" <?php if ($tshirt == "L") echo "selected"; ?>>L</option>
        <option value="XL" <?php if ($tshirt == "XL") echo "selected"; ?>>XL</option>
        </select>
    </label>
    <br><br>
    <label for="abstract"> Upload your abstract<br>
        <input type="file" name="abstract">
        <span style="color: red;"><?php echo $abstractErr; ?></span>
    </label>
    <br><br>
    <input type="checkbox" name="terms" value="" <?php if (isset($_POST['terms'])) echo "checked"; ?>>I agree to terms & conditions.
    <span style="color: red;"><?php echo $termsErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Send registration">
</form>


</body>
</html>
