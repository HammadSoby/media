<h4>All Users : </h4>
<?php

require '../core/connection.php';

$fetch_all_users=$pdo->prepare("SELECT * FROM users ORDER BY id DESC ");
$fetch_all_users->execute();
$getusers=$fetch_all_users->fetchAll();

foreach ($getusers as $user) {
	?>
	<link rel="stylesheet" type="text/css" href="style/style.css" />
	<div id="users">
		<ul>
			<li><?php echo $user['username']; ?>
				<li><?php echo $user['email']; ?>
					<li><?php echo $user['fullname']; ?>
						<li><?php echo $user['org_name']; ?>
							<li><?php echo $user['phone']; ?>
								<li><?php echo $user['landline']; ?>
									<li><?php echo $user['hearus']; ?>
										<li><?php echo $user['time']; ?>
		</ul>
	</div>
	<?php
}



 ?>
  <a href="manage.php">All orders here </a>