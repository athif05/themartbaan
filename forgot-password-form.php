<?php
session_start();
require_once 'admin/core/core.php';
@extract($_REQUEST);

if(isset($_POST['send'])){

	$from=strip_tags(trim(mysqli_real_escape_string($con, $_POST['from'])));

    $email = strip_tags(trim(mysqli_real_escape_string($con, $_POST['email'])));
    
    $chckSql=mysqli_query($con, "SELECT * from `clients` where email='$email'");
    $chckNum=mysqli_num_rows($chckSql);
    if($chckNum>0) {

    	$chckLine=mysqli_fetch_array($chckSql);
    	$password=$chckLine['password'];
    	
    	if(!empty($password)){
    		$subject = "Account Recover mail";
		    
		    $body = "<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Transitional//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd>
                    <html xmlns=http://www.w3.org/1999/xhtml>
                    <head>
                    <meta http-equiv=Content-Type content=text/html; charset=iso-8859-1 />
                    </head>
                    <body><table width='490' border='0' cellspacing='0' cellpadding='0' style='border:3px dotted #CCCCCC'>       
                          <tr>
                    	   <td width='646'><table width='490' border='0' cellspacing='5' cellpadding='5'>
                           
                             <tr bgcolor='#ededed'>
                               <td height='20' style='color:#000;font-family:calibri;text-align:center' valign='top' colspan='3'><strong>Dear ".$email." ! Your account details are below:.</strong></td>
                             </tr>
                             
                             <tr bgcolor='#ededed'>
                               <td height='20' style='color:#000;font-family:calibri;font-size:18px; background-color:#25b1ff; color:#fff; font-weight:200; text-align:center;' valign='top' colspan='3'><strong>Login Details</strong>
                    		   </td>
                    		   </tr>
                    		   <tr bgcolor='#ededed'>
                    		   <td height='20' style='color:#000;font-family:calibri; background-color:#ededed; color:#fff; font-weight:200' valign='top' colspan='3'>
                    		      <table colspan='3' style='color:#000'>
                    		 
                    		   <tr>
                    		  <td style='font-weight:bold'>User Name:</td><td>".$email."</td>
                    		  </tr>
                    		  <tr>
                    		  <td style='font-weight:bold'>Password:</td><td>".$password."</td>
                    		  </tr>
                    		  </table>
                    		   </td>
                             </tr>
                           </td>
                        </tr>
                    </table>
                </body>
            </html>"; 
		    
		    mail($email,$subject,$body, "From: <$from>\r\nContent-type: text/html\r\n");
    	}

        $_SESSION['sess_msg']="Password sent on your registred email. Check your mail for pasword.";

    } else {
    	$_SESSION['sess_msg_err']='Sorry, E-mail not exist.';
    }
    header('Location:forgotpassword.php');
}
?>