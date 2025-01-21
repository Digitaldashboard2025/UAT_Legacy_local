

<html>
    <head>
        <title>Login</title>
		<link rel="icon" type="image/x-icon" href="https://www3.tecnotree.com/wp-content/uploads/2019/05/favicon.ico">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body style="background-color:#cfffff">
		<nav style="background-color:#1c00c8; padding:0;" class="navbar">
  			<div class="container">
    			<a style="color: white;" class="navbar-brand" href="#">
				<img class="img-fluid" src="<?php print HTTP_ASSETS_PATH; ?>images/tt_logo.jpg" style="height:3rem;" alt="Theme-Logo" />
    			Digital Dashboard
				</a>
  			</div>
		</nav>

		<div style="position: relative; top: 40%; transform: translateY(-50%)">
        <form class="form-signin w-25 m-auto" action="<?php echo base_url('login/do_login'); ?>" method="post">
			<h1 class="h3 mb-3 fw-normal">Login</h1>
			<div class="form-floating">
            	<input class="form-control" type="text" name="username" id="username" required>
				<label for="username" >Username:</label>
			</div>
            
			<div class="form-floating">
            <input class="form-control" type="password" name="password" id="password" required>
			<label for="password">Password:</label>
			</div>
			<div class="checkbox mb-3" style="margin: 10px 0">
        		<a href="#">Forgot password</a> 
    		</div>
            <input class="w-100 btn btn-primary" type="submit" value="Login">
			<div>
			<?php if ($this->session->flashdata('error')): ?>
            <p><?php echo $this->session->flashdata('error'); ?></p>
			</div>
        <?php endif; ?>
        </form>
		</div>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>

