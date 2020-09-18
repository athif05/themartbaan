<?php
session_start();
require_once 'admin/core/core.php';
@extract($_REQUEST);

$save_date=date('Y-m-d');
$ipAddress=$_SERVER['REMOTE_ADDR'];
$curDateTime=date('y-m-d H:i:s');

if(isset($_POST['send'])){

	$from=strip_tags(trim(mysqli_real_escape_string($con, $_POST['from'])));

    $username 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['username'])));
    $mailTo 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['email'])));
    $number 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['number'])));
    $password 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['password'])));

    $pass_encode=base64_encode($password);

    $username=ucwords($username);

    $chckSql=mysqli_query($con, "SELECT email from `clients` where email='$mailTo'");
    $chckNum=mysqli_num_rows($chckSql);
    if($chckNum==0) {
    	mysqli_query($con, "INSERT into `clients` set fname='".ucwords($username)."',email='$mailTo',phone='$number',password='$pass_encode',status='0',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime'");
    	$myid=mysqli_insert_id($con);

    	$VerificationLink=$urlForBE.'?clnt_id='.base64_encode($myid);

    	if($myid){
    		$subject = "Account Verification mail";
		    
		    $body = "<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Transitional//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd>
                    <html xmlns=http://www.w3.org/1999/xhtml>
                    <head>
                    <meta http-equiv=Content-Type content=text/html; charset=iso-8859-1 />
                    </head>
                    <body><table width='490' border='0' cellspacing='0' cellpadding='0' style='border:3px dotted #CCCCCC'>       
                          <tr>
                    	   <td width='646'><table width='490' border='0' cellspacing='5' cellpadding='5'>
                           
                             <tr bgcolor='#ededed'>
                               <td height='20' style='color:#000;font-family:calibri;text-align:center' valign='top' colspan='3'><strong>Dear ".$username." ! Thank You very much for Register with us.</strong></td>
                             </tr>
                             
                             <tr bgcolor='#ededed'>
                               <td height='20' style='color:#000;font-family:calibri;font-size:18px; background-color:#25b1ff; color:#fff; font-weight:200; text-align:center;' valign='top' colspan='3'><strong>Login Details</strong>
                    		   </td>
                    		   </tr>
                    		   <tr bgcolor='#ededed'>
                    		   <td height='20' style='color:#000;font-family:calibri; background-color:#ededed; color:#fff; font-weight:200' valign='top' colspan='3'>
                    		      <table colspan='3' style='color:#000'>
                    		 
                    		   <tr>
                    		  <td style='font-weight:bold'>User Name:</td><td>".$mailTo."</td>
                    		  </tr>
                    		  <tr>
                    		  <td style='font-weight:bold'>Password:</td><td>".$password."</td>
                    		  </tr>
                    		  </table>
                    		   </td>
                             </tr>
                    		 
                    		 <tr bgcolor='#ededed'>
                               <td height='20' style='color:#000;font-family:calibri;text-align:center' valign='top' colspan='3'>
                                    <p>Your account has be created, please verify your e-mail account.</p>
                                    <p> <a href=".$VerificationLink." target='_blank'>Click here</a> for verify an account or paste this URL in browser.</p>
                    				<p>".$VerificationLink."</p>
                               </td>
                             </tr>
                             
                           </td>
                    		
                              </tr>
                    	 			
                    				
                    		     </table>
                    
                    </body>
                    </html>"; 
		    
		 
		    //mail($email,$subject,$body,$header);
		    mail($mailTo,$subject,$body, "From: <$from>\r\nContent-type: text/html\r\n");
    	}

    	$_SESSION['sess_msg']='Thanks for registering, check your mail for verify the account.';
    } else {
    	$_SESSION['sess_msg_err']='Sorry, username or e-mail is already exist.';
    }

    header('Location:register.php');
}
?>