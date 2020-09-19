<html>
 <head>
     <style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin-top: 10px;
  margin-left:  50px;
  font-family: Arial;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: auto;
   padding-left: 50px;
   
}

td, th {
  border: 5px solid #dddddd;
  text-align: center;
  padding: auto;
 
}


.column {
  float: left;
  width: 28%;
}


.column2 {
  float: left;
  width: 40%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

</style>

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
        
    <h3>File Permission</h3>
    <p></P>
    <p>Read and write for owner, nothing for everybody else</P>
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
    <!-- permission one ends -->
     <br>
    <p>Read and write for owner, read for everybody else</P>
    <p></p>
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
    <!-- end permission 2 --> 
     <br>
      <p>Everything for owner, read and execute for everybody else</P>
      <p></p>
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
       <br>
    <!-- end permission 3 --> 
 <p>Everything for owner, read and execute for everybody else</P>
 <p></p>
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
