<?php
include_once 'DBConnector.php';
include_once 'user.php';
include_once 'fileUploader.php';

ini_set('display_errors',1);
$conn=new DBConnector;
if(isset($_POST['btn-save'])){
	//$usr= new User("","","","","");
	//$exists=$usr->isUserExist();
	//if($exists=="false"){
		
            
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$city=$_POST['city_name'];
$username=$_POST['username'];
$password=$_POST['password'];
$utc_timestamp=$_POST['utc_timestamp'];
$offset=$_POST['time_zone_offset'];

$file_name = $_FILES['fileToUpload']['name'];
$file_size = $_FILES['fileToUpload']['size'];
$file_tmp = $_FILES['fileToUpload']['tmp_name'];
$file_type = $_FILES['fileToUpload']['type'];



$user= new User($first_name,$last_name,$city,$username,$password,$utc_timestamp,$offset);
//$uploader=new FIleUploader();

if(!$user->validateForm()){
	$user->createFormErrorSessions();
	header("Refresh:0");
	die();
}

$FileUpload = new FileUploader();
            $FileUpload->setUsername($username);
            $FileUpload->setOriginalName($file_name);
            $FileUpload->setFileSize($file_size);
            $FileUpload->setFileTempName($file_tmp);
            $FileUpload->setFileType($file_type);
           if( $FileUpload->fileWasSelected()){

//$file_upload_response=$uploader->uploadFile();
if($user->isUserExist()==false){
	$res= $user->save();
if($res){
			
			    if($FileUpload-> uploadFile()){
	echo "<br>Save Operation was Successful<br>";
			 }
}
else
{
	echo "An Error Occured!";
}
}
else
{
	echo "The user already exists!";
}
		   }
		   else
		   {
			   echo "User must select a file first!";
		   }
//}
//else  if ($exists=="true"){
	//echo "User Already exists";
//}
//else{
	//echo "Error";
//}
}/*
if(isset($_POST['btn-display'])){

$user= new User($first_name,$last_name,$city);
$res= $user->readAll($conn->conn);

if($res){
	echo $res;
}
else
{
	echo "An Error 2 Occured!";
}
}*/
//$selectAll=User::readAll($conn->conn)
?>
<hmtl>
<head>

<title>Sign up
</title>
<script type="text/javascript" src="validate.js"></script>
<link rel="stylesheet" type="text/css" href="validate.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="timezone.js"></script>
</head>
<body background="d2.jpeg">
<form method="post" name="user_details" id="user_details" onsubmit="return validateForm()" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>">
<table align="center">
<tr>
<td>
<div id="form_errors">
<?php
session_start();
if(!empty($_SESSION['form_errors'])){
echo " " . $_SESSION['form_errors'];
unset($_SESSION['form_errors']);
}
?>
</div>
</td>
</tr>
<tr>
<td><input type="text" name="first_name" placeholder="First Name"></td>
</tr>
<tr>
<td><input type="text" name="last_name"  placeholder="Last Name"></td>
</tr>
<tr>
<td><input type="text" name="username"  placeholder="Username"></td>
</tr>
<tr>
<td><input type="password" name="password"  placeholder="Password"></td>
</tr>
<tr>
<td>Profile image:<input type="file" name="fileToUpload" id="fileToUpload"  placeholder="Profile Picture"></td>
</tr>
<tr>
<td><input type="text" name="city_name"  placeholder="City"></td>
</tr>

<tr>
<td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
</tr>
<tr>
<td><a href="login.php">Login</a></td>
</tr>
<tr>
<td><input type="text" hidden name="utc_timestamp" id="utc_timestamp" value=""></td>
</tr>
<tr>
<td><input type="text" hidden name="time_zone_offset" id="time_zone_offset" value=""></td>
</tr>
<!--<tr>
<td><button type="submit" name="btn-display"><strong>DISPLAY</strong></button></td>
</tr>
-->
</table>
</form>
</body>
</html>