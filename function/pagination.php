<?php

$query = "select * from posts";
$result = mysqli_query($con,$query);

//count the total records

$total_posts = mysqli_num_rows($result);

//using ceil function to divide the total records on per page

$total_pages =ceil($total_posts/ $per_page=5);

//going to first page

echo " <center>
<div id ='pagination'>
<a href='home.php?page=1'>First Page&nbsp</a>
";

for ($i=1; $i<=$total_pages;$i++) {
	echo "<a href ='home.php?page=$i'>&nbsp       $i</a>";
}
// going to last page
echo "<a href ='home.php?page=$total_pages'>&nbspLast Page</a></center></div>";

?>