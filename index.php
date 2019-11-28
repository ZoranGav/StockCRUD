<!DOCTYPE html>
<?php  include('php_code.php'); ?>

<!--edit button code-->
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM users WHERE id=$id");

		if (mysqli_num_rows($record) === 1 ) {
			$n = mysqli_fetch_array($record);
			$firstName = $n['firstName'];
            $lastName = $n['lastName'];
            $phoneNumber = $n['phoneNumber'];
            $dateOfCreation = $n['dateOfCreation'];
		}
	}
?>
<!-- endoff edit button code-->

<html>
<head>
	<title>CRUD: CReate, Update, Delete PHP MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>


<?php $results = mysqli_query($db, "SELECT * FROM users"); ?>
        <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Date of Creation</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row['firstName']; ?></td>
                        <td><?php echo $row['lastName']; ?></td>
                        <td><?php echo $row['phoneNumber']; ?></td>
                        <td><?php echo $row['dateOfCreation']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
                        </td>
                        <td>
                            <a href="php_code.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>

	<form method="post" action="php_code.php">
        <div class="input-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </div>
        <div class="input-group">
            <input type="hidden" name="dateOfCreation" value="<?php echo $dateOfCreation; ?>">
        </div>
		<div class="input-group">
			<label>First Name</label>
			<input type="text" name="firstName" value="<?php echo $firstName; ?>">
		</div>
		<div class="input-group">
			<label>Last Name</label>
			<input type="text" name="lastName" value="<?php echo $lastName; ?>">
        </div>
        <div class="input-group">
			<label>Phone Number</label>
			<input type="tel" name="phoneNumber" value="<?php echo $phoneNumber; ?>">
        </div>
        
		<div class="input-group">
			<?php if ($update == true): ?>
            <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
            <?php else: ?>
            <button class="btn" type="submit" name="save" >Save</button>
            <?php endif ?>
		</div>
	</form>
</body>
</html>