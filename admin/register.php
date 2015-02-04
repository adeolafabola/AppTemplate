<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Register</title>
</head>

<body>
<div id="container">
		<div id="header">
        	<h1>Quest<span class="off">It</span></h1>
            <h2>An intelligent App creation service...</h2>
        </div>   
        
        <div id="menu">
        	<ul>
				
            </ul>
        </div>
        
        <div id="leftmenu">

        <div id="leftmenu_top"></div>

				<div id="leftmenu_main">
					<h3>An intelligent, multi-platform information dissemination system for the 
				cultural heritage sector. Register here or <a href='login.php'>login</a> to find out more.</h3>          
					<ul>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
					</ul>
				</div>
                
              <div id="leftmenu_bottom"></div>
        </div>
        
        
        
        
		<div id="content">
        
        
        <div id="content_top"></div>
        <div id="content_main">
			
        	<div align="center"> <h1>REGISTER</h1> </div>
			<table border="0" align="center" cellpadding=5>
				<tr>
					<td colspan="2" align="center">
						<h3>Please fill in the form below to register. Or <a href="login.php">login</a> here.</h3>
					</td>
				</tr>
			</table>
			
			
			<?php

				require_once "formvalidator.php";
				$show_form=true;

				if(isset($_POST['submit']))
				{
					$validator = new FormValidator();
					$validator->addValidation("username", "req", "Please enter a username");
					$validator->addValidation("password", "req", "Please enter a password");
					
					if($validator->ValidateForm())
					{						
						include("config.php"); 

						// connect to the mysql server 
						$link = mysql_connect($server, $db_user, $db_pass) 
						or die ("Could not connect to mysql because ".mysql_error()); 

						// select the database 
						mysql_select_db($database) 
						or die ("Could not select database because ".mysql_error()); 
						
						
						// check if the username is taken
						$username = $_POST['username'];
						$check = "select id from $adminusertable where username = '".$_POST['username']."';"; 
						$qry = mysql_query($check)
						or die ("Could not match data because ".mysql_error());
						$num_rows = mysql_num_rows($qry); 
						if ($num_rows != 0) 
						{ 
							echo "<b><p style='color:red;'>The username '$username' already exists. Please choose a different username!</p></b>"; 
						} 
						
						else 
						{
							$show_form=false;
							// insert the data
							$insert = mysql_query("insert into $adminusertable values ('NULL', '".$_POST['username']."', '".$_POST['password']."')")
							or die("Could not insert data because ".mysql_error());
							// print a success message
							echo "<b><p style='color:red;'>Your account has been created! You can now <a href=login.php>log in</a> here.</p></b>";
							echo "<p>&nbsp;</p>";
							echo "<p>&nbsp;</p>";
							echo "</div>";
						}
					}
					
					else
					{
						$error_hash = $validator->GetErrors();
						foreach($error_hash as $inpname => $inp_err)
						{
							echo "<b><p style='color:red;'>$inp_err</p></b>\n";
						}
					}
				}

				if(true==$show_form)
				{
				?>
			
				<form action="register.php" method="post">
					<table border="0" align="center" cellpadding=5>
						<tr>
							<td>
								Username
							</td>
							
							<td>
								<input type="text" pattern=".{8,}" required placeholder="Min 8 characters" name="username" id="username" size="20">
							</td>
						</tr>
						
						<tr>
							<td>
								Password
							</td>
							
							<td>
								<input type="password" pattern=".{8,}" required placeholder ="Min 8 characters" name="password" id="password" size="20">
							</td>
						</tr>
						
						<tr>
							<td>
								Confirm Password
							</td>
							
							<td>
								<input type="password" pattern=".{8,}" required placeholder ="Min 8 characters" name="password2" id="password2" size="20">
							</td>
						</tr>
						
						<tr>
							<td colspan="2" style="text-align:center;">
								<input type="submit" name="submit" id="submit" value="Sign Up" />
							</td>
						</tr>
					</table>
				</form>
			
        	<p>&nbsp;</p>
           	<p>&nbsp;</p>
		</div>
		
		
		<?PHP
		}
		?>
		
        <div id="content_bottom"></div>
            
            <div align="center" style="align:center;" id="footer"><h3 style="align:center;color:#ffffff">OVW Group</h3></div>
      </div>
   </div>
   
<script>
window.onload = function () {
    document.getElementById("password").onchange = validatePassword;
    document.getElementById("password2").onchange = validatePassword;
}
function validatePassword(){
var pass2=document.getElementById("password2").value;
var pass=document.getElementById("password").value;
if(pass!=pass2)
    document.getElementById("password2").setCustomValidity("Passwords don't match!");
else
    document.getElementById("password2").setCustomValidity('');  
//empty string means no validation error
}
</script>
   
</body>
</html>
