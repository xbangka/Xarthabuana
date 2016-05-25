<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<meta http-equiv="Content-Language" content="pl">

<style type="text/css">
	 body {font-family: arial; background: #ffffff; font-size: 8px color: white;}
	 td { font-family: verdana; font-size: 11px;color: black; }
	 p { font-family: verdana; font-size: 18px; color: black; text-align: center;}

	 a:hover {text-decoration: none; color: white}
</style>
<title>404</title>
</head>
<body style="bgcolor: #FFFFFF">

<div style="text-align:center;">
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="align: center">
<tr><td style="width: 100%" align="center">
	<table width="574" style="background-image:url(http://localhost/_images/pasek.gif); height: 21px;" border="0" cellpadding="0" cellspacing="0" >
		<tr>
			<td style="text-align: left">
			<div style="margin-left:45px"><b>Error</b></div>
			</td>
		</tr>	
	</table>
	<table width="574" border="0" cellpadding="1" cellspacing="1" style="background-color: #9c9c9c;text-align:center;">
		<tr>
			<td style="background-color: #ffffff">
				<br>
				<table style="background-color: #ffffff">
					<tr>
						<td align="center" valign="top"><IMG SRC="http://localhost/_images/error.gif"  ALT="eroor"></td>
						<td colspan="2" align="center"><h3><?php echo $heading; ?></h3></td>
					</tr>
					<tr>
						<td align="center">
							&nbsp;
						</td><td align="center">
							<?php echo $message; ?>
						</td>
					</tr>
					<tr>
						<td align="center">
							&nbsp;
						</td><td align="left">
							&nbsp;
						</td>
					</tr>
					<tr>
						<td align="center">
							&nbsp;
						</td>
						<td align="center">
							&nbsp;
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

</td></tr></table>
<br>
</div>
</body>
</html>