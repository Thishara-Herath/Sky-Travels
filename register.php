

<?php
include("dbconn.php");
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$mnumber=$_POST['mnumber'];
$email=$_POST['email'];
$password=$_POST['password'];
// echo $fname.$lname.$mnumber.$email.$password;
$sql="Insert into user(firstname,lastname,mobile,email,password)values('$fname','$lname','$mnumber','$email','$password')";

if(mysqli_query($conn,$sql)){
    echo"created!";
    header("Location:login.php");
}
else{
  echo"Error".$sql."<br>".mysqli_error($conn);  
}
?>