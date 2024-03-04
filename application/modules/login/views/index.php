<?php
/* main_header(['Create_User']);*/
login_header(); 
?>
<head>
    
    <title>d5erg</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #9F3A3B;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
            
        }

        #logo {
            max-width: 80px;
            margin-right: 20px;
        }
    </style>
</head>
  <header>
        <img src="http://192.168.1.30/tup_project/assets/images/Logo/tuplogo.png" id="logo">
        <h1>Daily Time Record Portal System</h1>
    </header>

<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="card shadow-lg" style="margin-top:-35%;">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">User Authentication</h1>
					
								<div class="mb-3">
									<label class="mb-2 text-muted" for="username">Username</label>
									  <input type="text" class="form-control" id="username" required autofocus>

								</div>

								<div class="mb-3">
								
                                    <label class="mb-2 text-muted" for="password">Password</label>
								 <input type="password" class="form-control" id="password" required>
								  
								</div>

								<div class="d-flex align-items-center">
								
									<button type="submit" id="Login" class="btn btn-primary ms-auto">
										Login
									</button>
								</div>
							
						</div>
						<div class="card-footer py-3 border-0">
								 <div class="text-center">
								Don't have an account? <a href="http://192.168.1.30/tup_project/" class="text-dark">Create One</a>
							</div>
						</div>
					</div>
				<div class="text-center mt-5 text-muted">
						Copyright &copy; 2024 &mdash; Daily Time Record Portal System 
					</div> 
				</div>
			</div>
		</div>
	</section>

<?php
login_footer();
?>