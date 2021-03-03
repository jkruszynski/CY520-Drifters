<html>
 <head>
  <link rel="stylesheet" href="Style.css">
  <meta name="viewport" content="width=device-width, initial-scale=0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>Admin Management</title>
 </head>
 <body>
     
<div class="row">
<div id="SystemInformation">
  
  <?php  
 $dir = "/var/www/reports";//preconfigured directory for the assignment
 $length = shell_exec('find /var/www/reports -type f -print | wc -l'); //number of files in the folder
 $length2 =shell_exec('cut -d: -f1 /etc/passwd | wc -l');//number of users in the system
 $length3 = shell_exec('getent group | cut -d: -f1 |wc -l');
 ?>
  <div class="column" > 
  <h2>Shared Directory Files</h2>

<table>
  <tr>
    <th>File List</th>
  </tr>
  <tr>
    <td>
        
        <?php
// Sort in descending order
$files = scandir($dir,1);

for($i = 0; $i < $length; $i++) {
    "<td></td>";
    print $files[$i]."<br>";
     "<td></td>";
}
?>
</td>
  </tr>
</table>
 
  <br></br><!-- comment -->

  <h2>All Users System Users</h2>

<table>
  <tr>
    <th>Users</th>
  </tr>
  <tr>
    <td>
  
  <?php  
 


//working to get all the users in the system
exec('cut -d: -f1 /etc/passwd | sort',$users);

for($i = 0; $i < $length2; $i++) {
   "<tr></tr>";
   print $users[$i]."<br>";
   "<tr></tr>";
}

?>
        </td>
  </tr>
</table>
 
  
  </div>
  
 <div class="column" > 
 
<h2>All System Groups</h2>

<table>
  <tr>
    <th>Group</th>
  </tr>
  <tr>
    <td>
  
  <?php  
 
//working to get all the users in the system
exec('getent group | cut -d: -f1 | sort',$groups);

for($i = 0; $i < $length3; $i++) {
   "<tr></tr>";
   print $groups[$i]."<br>";
   "<tr></tr>";
}
?>
  
        </td>
  </tr>
</table>
  
  <br></br><!-- comment -->
   <br></br><!-- comment -->
 </div>
  
    <div class="column2" > 
        
        <h3>Create New File</h3>

   <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname"/>
  <input  type="submit" >
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_POST['fname'];
  if (empty($name)) {
    echo "File name is empty";
  } else {
   echo $name;
   echo " named file created";
  }
 
   touch ("/var/www/reports/".$name);
  echo "<meta http-equiv='refresh' content='0'>";
  
}

?>
        <!-- End of file create -->
        
    <p></P>
   <div class="container " >
  <h2>File Permission</h2>
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Everything for owner, read for owner's group</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
		<div class="panel-body">
			 <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			File Name: <input type="text" name="fname"/>
			<input  type="submit" >
			</form>
			<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// collect value of input field
			$name4 = $_POST['fname'];
			if (empty($name4)) {
			echo "File name is empty";
			} else {
			}
			chmod("/var/www/reports/".$name4,0740);
			echo "<meta http-equiv='refresh' content='0'>";
			}
			?>     
		</div>
      </div>
    </div>
	
	
	
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Everything for owner, read and execute for everybody else</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			File Name: <input type="text" name="fname"/>
			<input  type="submit" >
			</form>
			<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// collect value of input field
			$name3 = $_POST['fname'];
			if (empty($name3)) {
			echo "File name is empty";
			} else {
			}
			chmod("/var/www/reports/".$name3,0755);
			echo "<meta http-equiv='refresh' content='0'>";
			}
			?>    
		</div>
      </div>
    </div>
	
	
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Read and write for owner, read for everybody else</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">
		
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			File Name: <input type="text" name="fname"/>
			<input  type="submit" >
			</form>
			<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// collect value of input field
			$name2 = $_POST['fname'];
			if (empty($name2)) {
			echo "File name is empty";
			} else {
			}
			chmod("/var/www/reports/".$name2,0644);
			echo "<meta http-equiv='refresh' content='0'>";
			}
			?>     

		</div>
      </div>
    </div>
	
	
	  <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Read and write for owner, nothing for everybody else</a>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			File Name: <input type="text" name="fname"/>
			<input  type="submit" >
			</form>

			<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// collect value of input field
			$name1 = $_POST['fname'];
			if (empty($name1)) {
			echo "File name is empty";
			} else {
			}
			chmod("/var/www/reports/".$name1,0600);
			echo "<meta http-equiv='refresh' content='0'>";
			}
			?>  
		</div>
      </div>
    </div>
	
	
	
  </div> 
</div>
     <br>     
        <h2>Shared folder file permissions</h2>
<?php
$currentstatus = shell_exec('ls -l');
$output = shell_exec("cd /var/www/reports/; ls -l");
echo "<pre>$output</pre>";
?>
         
  </div>  
  </div>
        

     
     
     
     
 
    
 </body>
</html>
