<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 
<?php
// define variables and set to empty values
$First_NameErr = $SurnameErr = $emailErr = $websiteErr = $genderErr ="";
$First_Name = $Surname = $email = $website = $gender  = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["First_Name"])) {
        $First_NameErr = "First name is required";
      } else {
        $First_Name = test_input($_POST["First_Name"]);
        // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$First_Name)) {
        $First_NameErr = "Only letters and white space allowed";
      }
      }
      if (empty($_POST["Surname"])) {
        $SurnameErr = "Surname is required";
      } else {
        $Surname = test_input($_POST["Surname"]);
        // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$Surname)) {
        $SurnameErr = "Only letters and white space allowed";
      }
      }
    
      if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
      }
      if (empty($_POST["website"])) {
        $website = "";
      } else {
        $website = test_input($_POST["website"]);
        // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
        $websiteErr = "Invalid URL";
      }
    }
      if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
      } else {
        $gender = test_input($_POST["gender"]);
      }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
  ?>
<h2>PHP User Form</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<!-- the htmlspecialchars is to make sure someone doesnt change the form and the SELF is to make the 
input display on the same page
POST will not make all  the input display at the URL side-->
<!-- the php echo tag is to keep the values in the input fields when the user hitst the submit button--->
First Name: <input type="text" name="First_Name" value = "<?php echo $First_Name;?>">
<span class="error">* <?php echo $First_NameErr;?></span>
<br><br>
Surname: <input type="text" name="Surname" value = "<?php echo $Surname;?>">
<span class="error">* <?php echo $SurnameErr;?></span>
<br><br>
E-mail: <input type="text" name="email" value="<?php echo $email;?>">
<span class="error">* <?php echo $emailErr;?></span>
<br><br>

Website: <input type="text" name="website" value="<?php echo $website;?>">
<span class="error"><?php echo $websiteErr;?></span>
<br><br>

<input type="radio" name="gender" value="Female" <?php if (isset($gender) && $gender=="female") echo "checked";?>
value="female">Female
<input type="radio" name="gender" value="Male" <?php if (isset($gender) && $gender=="male") echo "checked";?>
value="male">Male
<input type="radio" name="gender" value="Other" <?php if (isset($gender) && $gender=="other") echo "checked";?>
value="other">Other
<span class="error">* <?php echo $genderErr;?></span>
<br><br>

<input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $First_Name;
echo "<br>";
echo $Surname;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $gender;
?>
</body>
</html>