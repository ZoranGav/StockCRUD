<?php 

#region establish connection
session_start();
$db = mysqli_connect('localhost', 'root', '1234', 'phonebook');
    if (!$db->connect_error) 
      {
        echo "connection successful";
      } 
      else 
      {
        echo $db->connect_error;
      }
#endregion
#region initialize variables
$firstName = "";
$lastName = "";
$phoneNumber = "";
$dateOfCreation = 0;
$id = 0;
$update = false;
#endregion
#region save code      
if (isset($_POST['save'])) 
{
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phoneNumber = $_POST['phoneNumber'];

mysqli_query($db, "INSERT INTO users (firstName, lastName, phoneNumber) VALUES ('$firstName', '$lastName', '$phoneNumber')");

$_SESSION['message'] = "Address saved";

header('location: index.php');
}
#endregion
#region edit code


  if (isset($_POST['update'])) 
  {
  $id = $_POST['id'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $phoneNumber = $_POST['phoneNumber'];
              
  mysqli_query($db, "UPDATE users SET firstName='$firstName', lastName='$lastName', phoneNumber='$phoneNumber' WHERE id=$id");

  $_SESSION['message'] = "Address updated!"; 
  header('location: index.php');
  }

#endregion
#region delete code
if (isset($_GET['del'])) 
{
$id = $_GET['del'];

mysqli_query($db, "DELETE FROM users WHERE id=$id");

$_SESSION['message'] = "Address deleted!"; 
header('location: index.php');
}
#endregion

        
        