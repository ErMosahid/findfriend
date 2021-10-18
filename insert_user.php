<?php

include("includes/connection.php");

	if(isset($_POST['sign_up'])){
		
	$name = $_POST['u_name']; 
	$pass = $_POST['u_pass']; 
	$email = $_POST['u_email']; 
	$country = $_POST['u_country']; 
	$gender = $_POST['u_gender']; 
	$birthday = $_POST['u_birthday']; 
	
	$status="unverified";
	$posts="no";
	
	$ver_code=mt_rand();
		
		if(strlen($pass)<8) {
			echo "<script>alert('Password should be minimum 8 character!')</script>";
			exit();
		}
		
		$check_email="select * from users where user_email='$email'";
		$run_email=mysqli_query($con,$check_email);
		
		$check=mysqli_num_rows($run_email);
		if($check==1)
		{
			echo "<script>alert('email all ready!')</script>";
			exit();
		}
			
		
		$insert ="insert into users(user_name,user_pass,user_email,user_country,user_gender,user_birthday,user_image,user_reg_date,status,ver_code,posts ) values('$name','$pass','$email','$country','$gender','$birthday','default.jpg',NOW(),'$status','$ver_code','$posts')";
		
		$query = mysqli_query($con,$insert);
		
		if($query) 
		{
			
			
			echo "<h3 style='width:400px; text-align:justify;'>check your email for verification</h3>";
			
			
		}
			else
			{
				echo "Registration failed,try again";
			}
		
		
	}


?>