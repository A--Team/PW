<?php
	include 'config.php';
	if(isset($_SESSION[$session_name])
)	{
		if($_SESSION['username']=='agenzia')
		{
			echo "<br><br><h2>Benvenuto <a href='agenzia.php'>agenzia!</a></h2><br>";
		}
		else
		{
			echo "<br><br><h2>Benvenuto <a href='homepersonale.php'>" . $_SESSION['username'] . "!</a></h2><br>";
		}
?>
        <form method='POST' action='logout.php'>
                            <input type='submit' value='logout' class='btn_login'>
                 </form>  
<?php
	}
	else
	{
?>
	<form method="POST" action="login.php">
    <table>
		<tr>
			<td colspan='2'><h3>Login:</h3></td>	
		</tr>
		<tr>
			<td class="td_left">Username:</td><td><input type="text" name="username"></td>
		</tr>
		<tr>
			<td class="td_left">Password:</td><td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td colspan="2"><input class="btn_login" type="submit" value="Entra"></td>
		</tr>
		<tr>
			<td colspan="2">Non sei registrato? <a href="signup_form.php">Clicca qui!</a></td>
		</tr>
	</table>
</form>
<?php
	}
?>