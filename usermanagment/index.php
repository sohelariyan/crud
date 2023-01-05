<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Management</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head> 
<body class="overflow-hidden">

	<div class="users m-4">
		<div class="row g-0">
			<div class="col-md-4">
				<h3>Add a new user</h3>	
				<form class="my-5" method="POST">
					<div class="mb-3">
					  <label for="username" class="form-label">Enter your name</label>
					  <input type="text" name="username" class="form-control" id="username" placeholder="Fullname*">
					<?php 
						echo '<small class="text-danger">'.$error_msg.'</small>';
					?>
					</div>
					<div class="mb-3">
					  <label for="exampleFormControlInput1" class="form-label">Email address</label>
					  <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
					</div>
					<div class="mb-3">
					  <label for="password" class="form-label">Password</label>
					  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
					  <small class="text-danger">Password should be minimum 6 char long</small>
					</div>
					<input type="submit" name="saveinfo" class="btn btn-md btn-info" value="Add new user" name="">
				</form>

				<!-- edit info -->
			<?php 

				if(isset($_GET['edit_id'])){

					$editid = $_GET['edit_id'];

					$sql = "SELECT * FROM users WHERE id='$editid'";
					$res = mysqli_query($db,$sql);

					$row = mysqli_fetch_assoc($res);
					$id 		= $row['ID'];
					$name 		= $row['name'];
					$email 		= $row['email'];
					$pass 		= $row['pass'];
					$role 		= $row['role'];
					$status 	= $row['status'];
	
					?>
					<h3>Update User</h3>	
					<form class="my-5" method="POST">
						<div class="mb-3">
						<label for="username" class="form-label">Enter your name</label>
						<input type="text" name="username" value="<?php echo $name;?>" class="form-control" id="username" placeholder="Fullname*">
						<?php 
							echo '<small class="text-danger">'.$error_msg.'</small>';
						?>
						</div>
						<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Email address</label>
						<input type="email" name="email" value="<?php echo $email;?>" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
						</div>
						<div class="mb-3">
						<label for="password" class="form-label">Set New Password</label>
						<input type="password" name="password" class="form-control mb-3" id="password" placeholder="Password">
						
						<label>Set your role</label>
						<select class="form-control" name="role">
							<option value="2" <?php if($role == 2)echo 'selected';?>>Admin</option>
							<option value="1" <?php if($role == 1)echo 'selected';?>>Editor</option>
							<option value="0" <?php if($role == 0)echo 'selected';?>>Subscriber</option>
						</select>

						<label>Set user status</label>
						<select class="form-control" name="status">
							<option value="1" <?php if($status == 1)echo 'selected';?>>Active</option>
							<option value="0" <?php if($status == 0)echo 'selected';?>>Inactive</option>
						</select>

						<input type="hidden" value="<?php echo $editid;?>" name="editid">

						</div>
						<input type="submit" name="updateinfo" class="btn btn-md btn-info" value="Add new user" name="">
					</form>
					<?php

					// edit code
				}

			?>

			</div>
			<div class="col-md-8">
				<h3 class="ms-5">All users information</h3>
				<table class="table m-5 table-striped">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Name</th>
				      <th scope="col">Email</th>
				      <th scope="col">UserRole</th>
				      <th scope="col">Status</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>

				<tbody>
					<tr>
						<th scope= "row">1</th>
						<td> Sohel</td>
						<td>Sohelariyan@gmail.com</td>
						<td>Admin </td>
						<td>Active</td>
						<td>
							<a href="" class="badge bg-success">Edit</td>
							<a href="" class="badge bg-danger">Delete</td>
					     </td>
					</tr>
					<tr>
						<th scope= "row">2</th>
						<td>Arif</td>
						<td>Sohelariyan13@gmail.com</td>
						<td>Admin </td>
						<td>Active</td>
						<td>
							<a href="" class="badge bg-success">Edit</td>
							<a href="" class="badge bg-danger">Delete</td>
					     </td>
					</tr>
					<tr>
						<th scope= "row">3</th>
						<td>Rakib</td>
						<td>Sohelariyan12@gmail.com</td>
						<td>Admin </td>
						<td>Active</td>
						<td>
							<a href="" class="badge bg-success">Edit</td>
							<a href="" class="badge bg-danger">Delete</td>
					     </td>
					</tr>

					<?php 

						$sql = "SELECT * FROM users";
						$res = mysqli_query($db,$sql);

						$serial = 0;

						while($row = mysqli_fetch_assoc($res)){
							$id 		= $row['ID'];
							$name 		= $row['name'];
							$email 		= $row['email'];
							$pass 		= $row['pass'];
							$role 		= $row['role'];
							$status 	= $row['status'];
							$serial++;
						?>
						<tr>
							<th scope="row"><?php echo $serial;?></th>
							<td><?php echo $name;?></td>
							<td><?php echo $email;?></td>
							<td><?php 
							 if($role == 0){
								echo '<span class="badge bg-info">Subscriber</span>';
							 }
							 if($role == 1){
								echo '<span class="badge bg-success">Editor</span>';
							 }
							 if($role == 2){
								echo '<span class="badge bg-danger">Admin</span>';
							 }
							?></td>
							<td><?php 
								if($status == 0){
									echo '<span class="badge bg-danger">Inactive</span>';
								}
								if($status == 1){
									echo '<span class="badge bg-success">Active</span>';
								}
							?></td>
							<td>
								<a href="index.php?edit_id=<?php echo $id;?>" class="badge bg-success">Edit</a>
								<a href="index.php?id=<?php echo $id;?>" class="badge bg-danger">Delete</a>
							</td>
						  </tr>	
						<?php
						}

						
					
					?>
			
				  </tbody>
				</table>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  
<?php ob_end_flush();?>
</body>
</html>