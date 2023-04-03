<!DOCTYPE html>
<html>
<head>
	<title>Example Form</title>
  <style>
    html,body{
      width:100%;
      height:100%
    }
    h1{
      font-size: x-large;
      color:blue;
    }
        .error{
            display: inline-block;
            font-weight: bold;
            color: red;
            padding-left: 20px;
            text-align: right;
        }
        label{
            width: 150px;
            font-weight: bold;
            display: inline-block;
        }
        *{
            text-align: center;
            font-size: large;
        }
        .select1{
            display: inline-block;
            width: 180px;
        }
        form{
          border:2px solid black;
          border-radius: 20px;
          margin: auto;
          width:60%;
          height: 70%;
        }
    </style>
</head>
<body>
	<h1>Form Validation</h1>

	<?php
	// define variables and set to empty values
	$nameErr = $ageErr = $dobErr = $emailErr = $continentErr = $coolErr = "";
	$name = $age = $dob = $email = $continent = $cool = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST["name"])) {
	    $nameErr = "Name is required";
	  } else {
	    $name = test_input($_POST["name"]);
	    // check if name only contains letters and whitespace
	    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
	      $nameErr = "Only letters and white space allowed";
	    }
	  }

	  if (empty($_POST["age"])) {
	    $ageErr = "Age is required";
	  } else {
	    $age = test_input($_POST["age"]);
	    // check if age is between 18 and 50
	    if ($age < 18 || $age > 50) {
	      $ageErr = "Age must be between 18 and 50";
	    }
	  }

	  if (empty($_POST["dob"])) {
	    $dobErr = "Date of birth is required";
	  } else {
	    $dob = test_input($_POST["dob"]);
	    // check if dob is in YYYY-MM-DD format
	    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/",$dob)) {
	      $dobErr = "Invalid date format. Please use YYYY-MM-DD";
	    }
	  }

	  if (empty($_POST["email"])) {
	    $emailErr = "Email is required";
	  } else {
	    $email = test_input($_POST["email"]);
	    // check if email address is well-formed
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	      $emailErr = "Invalid email format";
	    }
	  }

	  if ($_POST["continent"] == "select") {
	    $continentErr = "Continent is required";
	  } else {
	    $continent = test_input($_POST["continent"]);
	  }

	  if (empty($_POST["cool"])) {
	    $coolErr = "Are you cool is required";
	  } else {
	    $cool = test_input($_POST["cool"]);
	  }
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <br><br><br>
		<label>Name:</label><input type="text" name="name" value="<?php echo $name;?>">
		<span class="error">* <?php echo $nameErr;?></span>
		<br><br>
		<label>Age:</label><input type="text" name="age" value="<?php echo $age;?>">
		<span class="error">* <?php echo $ageErr;?></span>
		<br><br>
		<label>DOB:</label><input type="text" name="dob" value="<?php echo $dob;?>">
		<span class="error">* <?php echo $dobErr;?></span>
		<br><br>
		<label>Email:</label><input type="text" name="email" value="<?php echo $email;?>">
		<span class="error">* <?php echo $emailErr;?></span>
		<br><br>
    <label>Continent:</label>
	  <select name="continent" class="select1">
		<option value="select" <?php if ($continent == "select") echo "selected";?>>--Select--</option>
		<option value="asia" <?php if ($continent == "asia") echo "selected";?>>Asia</option>
		<option value="africa" <?php if ($continent == "africa") echo "selected";?>>Africa</option>
		<option value="north_america" <?php if ($continent == "north_america") echo "selected";?>>North America</option>
		<option value="south_america" <?php if ($continent == "south_america") echo "selected";?>>South America</option>
		<option value="antarctica" <?php if ($continent == "antarctica") echo "selected";?>>Antarctica</option>
		<option value="europe" <?php if ($continent == "europe") echo "selected";?>>Europe</option>
		<option value="australia" <?php if ($continent == "australia") echo "selected";?>>Australia</option>
	</select>
	<span class="error">* <?php echo $continentErr;?></span>
	<br><br>

	<label>Are you Cool?</label>
	<input type="radio" name="cool" <?php if (isset($cool) && $cool=="yes") echo "checked";?> value="yes">Yes
	<input type="radio" name="cool" <?php if (isset($cool) && $cool=="no") echo "checked";?> value="no">No
	<span class="error">* <?php echo $coolErr;?></span>
	<br><br>
	<input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
