<html>
<head>
<style>
.error {color: red;}
</style>
</head>
<body style="background-color:#ffcccc;font-family:'Chilanka';font-size:25px;">
<?php
$t = $t1 = $t2 = $t3 = $t4 = 0;
$nameErr = $emailErr = $genderErr = $conErr = $passErr = "";
$name = $email = $gender = $con = $pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

if (empty($_POST["name"]))
{ $nameErr = "Username is mandatory"; }
else
{ $name = test_input($_POST["name"]); $t=1;}

if (empty($_POST["email"])) 
{ $emailErr = "Email is mandatory"; }
else
{ $email = test_input($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
{ $emailErr = "Email is invalid"; } 
else $t4=1; }

if (empty($_POST["con"])) 
{ $conErr = "Contact is mandatory"; }
else
{ $con = test_input($_POST["con"]);
if (strlen($con)<10) 
{ $conErr = "Contact is invalid"; } 
else $t1=1; }

if (empty($_POST["gender"])) 
{ $genderErr = "Gender is mandatory"; }
else
{ $gender = test_input($_POST["gender"]); $t2=1; }

if (empty($_POST["pass"])) 
{ $passErr = "Password is mandatory"; }
else
{ $pass = test_input($_POST["pass"]);
if (strlen($pass)<5) 
{ $passErr = "Password length must be 6 character long"; }
else $t3=1; }

}

if($t==1 && $t1==1 && $t2==1 && $t3==1 && $t4==1 && isset($_POST["submit"]))
{ header("Location: d2.php?id=".$name);
include("d1.php");
$a=$_POST["name"];
$b=$_POST["email"];
$c=$_POST["con"];
$d=$_POST["gender"];
$e=$_POST["pass"];
$sql="INSERT INTO Form(username,email,contact,gender,password) VALUES('".$a."','".$b."','".$c."','".$d."','".$e."')";
if(mysqli_query($con,$sql))
	echo "Done";
else
	echo "Error";
}

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
<br><br><br><br>
<center>
<h1>Registration Form</h1>
<form method = "post" action = "<?php echo $_SERVER["PHP_SELF"];?>">
<table>
<tr>
<td style="font-size:25px;">Username:</td>
<td><input type = "text" name = "name" placeholder="Enter your username here" style="font-size:18px;">
<span class = "error">* <?php echo $nameErr;?></span>
</td>
</tr>
<tr>
<td style="font-size:25px;">E-mail: </td>
<td><input type = "text" name = "email" placeholder="Enter your email here" style="font-size:18px;">
<span class = "error">* <?php echo $emailErr;?></span>
</td>
</tr>
<tr>
<td style="font-size:25px;">Contact:</td>
<td> <input type = "text" name = "con" placeholder="Enter your contact here" style="font-size:18px;">
<span class = "error">* <?php echo $conErr;?></span>
</td>
</tr>
<tr>
<td style="font-size:25px;">Gender:</td>
<td>
<input type = "radio" name = "gender" value = "female">Female
<input type = "radio" name = "gender" value = "male">Male
<span class = "error">* <?php echo $genderErr;?></span>
</td>
</tr>
<tr>
<td style="font-size:25px;">Password:</td>
<td> <input type = "password" name = "pass" placeholder="Enter your password here" style="font-size:18px;">
<span class = "error">* <?php echo $passErr;?></span>
</td>
</tr>
<td>
<input type = "submit" name = "submit" value = "Submit">
<input type = "reset" name = "reset" value = "Reset">
</td>
</table>
</form>
</center>
</body>
</html>
