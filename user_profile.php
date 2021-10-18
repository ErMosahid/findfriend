<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");

if(!isset($_SESSION['user_email'])) {
	
	header("location: index.php");
}

else {
	?>
<!DOCTYPE html>
	<html>
		<head>
			<title>Welcome User!</title>
			<link rel="stylesheet" href="styles/home_style.css" media="all"/>
			</head>

<body>

<!--Container starts-->
	<div class ="container">
		<!--Header wrapper starts-->
		<div id="head_wrap">
			<!--Header Starts-->
			<div id="header">
				<ul id="menu">
					<li><a href="home.php">Home</a></li>
					<li><a href="members.php">Members</a></li>
					<strong>Topics:</strong>
					<?php
					
					
					$get_topics ="select * from topics";
					$run_topics = mysqli_query($con,$get_topics);
				
					
					while($row=mysqli_fetch_array($run_topics)) {
						
						$topic_id =$row['topic_id'];
						$topic_title =$row['topic_name'];
						
						echo "<li><a href ='topic.php?topic=$topic_id'>$topic_title</a></li>";
					}
					?>
					</ul>
					<form method="get" action="results.php" id="form1">
						<input type="text" name="user_query"placeholder="search a topic"/>
						<input type ="submit" name="search"value="Search"/>
						</form>
						</div>
						<!--Header ends-->
						</div>
						<!--Header wrapper ends-->
							<!--Content area starts-->
							<div class ="content">
							<!--user timeline starts-->
							<div id="user_timeline">
								<div id="user_details">
								<?php 
								$user =$_SESSION['user_email'];
								$get_user ="select * from users where user_email='$user'";
								$run_user =mysqli_query($con,$get_user);
								$row=mysqli_fetch_array($run_user);
								
								$user_id =$row['user_id'];
								$user_name =$row['user_name'];
								$user_country =$row['user_country'];
								$user_image =$row['user_image'];
								$register_date =$row['user_reg_date'];
								$last_login =$row['user_last_login'];
								
								$user_posts ="select * from posts where user_id='$user_id'";
								$run_posts =mysqli_query($con,$user_posts);
								$posts =mysqli_num_rows($run_posts);
								
								//getting the number of unread messages
								$sel_msg ="select * from messages where receiver ='$user_id' AND status='unread' ORDER by 1 DESC";
								$run_msg =mysqli_query($con,$sel_msg);
								
								$count_msg =mysqli_num_rows($run_msg);
								
								echo "
									<center>
									<img src='users/$user_image'width='200' height='200'/>
									</center>
									<div id='user_mention'>
									<p><strong>Name:</strong>$user_name</p>
								
									<p><strong>Country:</strong>$user_country</p>
									<p><strong>Last login:</strong>$last_login</p>
									<p><strong>Members Since:</strong>$register_date</p>
									
									<p><a href='my_message.php?u_id=$user_id'>Messages ($count_msg)</a></p>
									<p><a href='my_posts.php?u_id=$user_id'>My Posts($posts)</a></p>
									<p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
									<p><a href='logout.php'>Logout</a></p>
									</div>
									";
									?>
									</div>
									</div>
									<!--user timeline ends-->
									<!--content timeline starts-->
									<div id="user_p">
									
										<h2 align="center">Info About This user:</h2>
										
											<?php user_profile();?>
											
											</div>
											<!--content timeline ends-->
											</div>
											<!--content area ends-->
										</div>
										<!--Container ends-->
										
										</body>
										</html>
<?php } ?>
										