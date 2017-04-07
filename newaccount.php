<!DOCTYPE  html>
<html>
	<head>
		<?php include "headInfo.php";?>
	</head>
	<body>
		<?php
			include "desktopheader.php";
			
			// Form input validation
			$newName = $newEmail = $newPwd = $confPwd = $newAcctType = "";
			$nameErr = $emailErr = $pwdErr = $confErr = $typeErr = "";
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				if(empty($_POST['username'])){
					$nameErr = "Name is required.";
				}else{
					$newName = test_input($_POST['username']);
					if (!preg_match("/^[a-zA-Z0-9]*$/",$newName)) {
						$nameErr = "Only letters and numbers allowed."; 
					}
				}
				if(empty($_POST['email'])){
					$emailErr = "Email is required.";
				}else{
					$newEmail = test_input($_POST['email']);
					if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
						$emailErr = "Invalid email format"; 
					}
				}
				if(empty($_POST['pwd'])){
					$pwdErr = "Password is required.";
				}else{
					$newPwd = test_input($_POST['pwd']);
				}
				if(empty($_POST['confirmpassword'])){
					$confErr = "Confirm Password is required.";
				}else{
					$confPwd = test_input($_POST['confirmpassword']);
					if ($confPwd != $newPwd){
						$confErr = "Passwords do not match.";
					}
				}
				if(empty($_POST['acctType'])){
					$typeErr = "Account type must be selected.";
				}else{
					$newAcctType = test_input($_POST['acctType']);
				}
				
				// if everything checks out, perform the insert
				if($nameErr == "" && $emailErr == "" && $pwdErr == "" && $confErr == "" && $typeErr == ""){
					$userQuery = "INSERT INTO `useraccounts`(`username`, `email`, `pwd`, `acctType`) VALUES ('".$newName."','".$newEmail."','".$newPwd."','".$newAcctType."')";
					$server = "localhost";
					$db = "chasingcravings";
					if(isset($_SESSION['username']) != null && isset($_SESSION['pwd']) != null){
						$user = $_SESSION['username'];
						$pw = $_SESSION['pwd'];
					}
					else{
						$user = "root";
						$pw = "";
					}
					$connect=mysqli_connect($server, $user, $pw, $db);
					if( !$connect) 
					{
						die("ERROR: Cannot connect to database $db on server $server 
						using user name $user (".mysqli_connect_errno().
						", ".mysqli_connect_error().")");
					}
					$result = mysqli_query($connect, $userQuery);
					if (!$result) 
					{
						$nameErr = "Username is already in use.";
					}
					else{
						$newName = $newEmail = $newPwd = $confPwd = $newAcctType = "";
						$specialMessage = "Account created successfully!";
						
					}
					mysqli_close($connect);
				}
			}
			function test_input($data){
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>
		<div>
			<h1> Create User Account</h1>
			<form method="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<table border=0>
				<div class="container">
					<tr>
						<td>
							<label><b>Username</b></label>
						</td>
						<td>
							<input type = "text" value="<?php echo $newName;?>" name ="username" required maxlength="20">
							<span class="error"><?php echo $nameErr;?></span>
						</td>
					</tr>
				</div>
				<div class="container">
					<tr>
						<td>
							<label><b>Email</b></label>
						</td>
						<td>
							<input type = "email" value="<?php echo $newEmail;?>" name ="email" required maxlength="50">
							<span class="error"><?php echo $emailErr;?></span>
						</td>
					</tr>
				</div>
				<div class="container">
					<tr>
						<td>
							<label><b>Password</b></label>
						</td>
						<td>
							<input type = "password" value="<?php echo $newPwd;?>" name ="pwd" required maxlength = "50">
							<span class="error"><?php echo $pwdErr;?></span>
						</td>
					</tr>
				</div>
				<div class="container">
					<tr>
						<td>
							<label><b>Confirm Password</b></label>
						</td>
						<td>
							<input type = "password" value="<?php echo $confPwd;?>" name ="confirmpassword" required maxlength="50">
							<span class="error"><?php echo $confErr;?></span>
						</td>
					</tr>
				</div>
				<div class="container">
					<tr>
						<td>
							<label><b>Account Type</b></label>
						</td>
						<td>
							<input type="radio" name="acctType" value="user" required>Normal User
							<input type="radio" name="acctType" value="truck" required>Food Truck
							<span class="error"><?php echo $typeErr;?></span>
						</td>
					</tr>
				</div>
			</table>
			<div class="container">
				<button type ="submit"> Submit</button>
			</div>
			</form>
		</div>
		<?php echo $specialMessage; ?>
		
	</body>
</html>
