<?php

    include("includes/connection.php");
    
    if(isset($_GET['code'])) {
        
        $get_code=$_GET['code'];
        
        $get_user = "select * from users where ver_code='$get_code'";
        
        $run_user = mysqli_query($con,$get_user);
        
        $check_user =mysqli_num_rows($run_user);
        
        $row_user=mysqli_fetch_array($run_user);
        
        $user_id =$row_user['user_id'];
        
        if($check_user==1) {
            
            $update_user = "update users set status='verified' where user_id='$user_id'";
            $run_update =mysqli_query($con,$update_user);
            
            echo "<h2> Thanks, your email is verified!</h2> Please <a href='http://findfriends.rf.gd'>Login to website</a>";
            
        }
        else
        {
            echo "<h2>Sorry,Email not verified,try again!</h2>";
        }
    }
	?>