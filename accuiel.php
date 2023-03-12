<!DOCTYPE html>
<html>
<head>
	<title>Homepage</title>
    <link rel="website icon" type="png" sizes="100x100" height="50px" href="./logo.png">
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
			font-size: 16px;
			background-color: #f5f5f5;
		}
		nav {
			background-color: #333;
			color: #fff;
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 10px;
		}
		nav h1 {
			margin: 0;
			padding: 0;
			font-size: 24px;
			font-weight: 400;
			text-transform: uppercase;
			letter-spacing: 2px;
		}
		nav ul {
			list-style: none;
			margin: 0;
			padding: 0;
			display: flex;
			align-items: center;
		}
		nav li {
			margin: 0 10px;
		}
		nav li a {
			color: #fff;
			text-decoration: none;
			font-size: 18px;
			text-transform: uppercase;
			letter-spacing: 1px;
		}
		nav li a:hover {
			color: #cecfcf;
		}
		.container {
			margin: 20px auto;
			padding: 20px;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
			max-width: 600px;
			text-align: center;
		}
		.container h2 {
			font-size: 28px;
			font-weight: 400;
			margin: 0 0 20px;
		}
		.container p {
			font-size: 18px;
			margin-bottom: 20px;
		}
		.container button {
			padding: 10px 20px;
			background-color: #cecfcf;
			border: none;
			color: #fff;
			font-size: 18px;
			font-weight: 400;
			border-radius: 5px;
			cursor: pointer;
			transition: all 0.2s ease-in-out;
		}
		.container button:hover {
			background-color: #333;
		}
		.footer {
			background-color: #333;
			color: #fff;
			text-align: center;
			padding: 10px;
			position: fixed;
			bottom: 0;
			left: 0;
			width: 100%;
		}
	</style>
</head>
<body>
	<nav>
    <img src="./logo.png" alt="Website logo" width="110" height="50">
		<h1>My Website</h1>
		<ul>
			<?php session_start();
            if(isset($_SESSION['user_id'])) {?>
				<li>Welcome, <?php echo $_SESSION['username']; ?>..</li>
				<li><a href="logout.php">Logout</a></li>
			<?php }else { ?>
				<li><a href="connexion.html">Login</a></li>
			<?php } ?>
		</ul>
	</nav>
	<div class="container">
		<h2>Welcome to your Profile</h2>
		<p><?php  if(isset($_SESSION['user_id'])) { $text=$_SESSION['profil'];
         $shortened_text = substr($text, 0, 100);
echo $shortened_text;}
else{echo'Hello for show your cv with personnelle dessign please login !';}?>
        .</p>
        <a href="myresume.php"><button>View CV</button></a>
<a href=".html"><button>Update CV</button>
<button>Save CV</button>
</div>
<footer class="footer">
<p>Copyright © 2023 | All rights reserved.</p>
</footer>

</body>
</html>