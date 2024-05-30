<?php
/* main_header(['Create_User']);*/
login_header();
// var_dump($session);
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

		.center-element {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 120vh;
			/* Adjust the height based on your requirements */
		}
	</style>
</head>
<header>
	<img src="<?= base_url() ?>assets/images/Logo/tuplogo.png" id="logo">
	<h1>Daily Time Record Portal System</h1>
</header>

<section class="center-element" style="zoom:100%;">
	<div class="container ">
		<div class="row justify-content-sm-center">
			<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
				<div class="card shadow-lg" style="margin-top:-50%;">
					<div class="card-body p-5">
						<h1 class="fs-4 card-title fw-bold mb-4">User Change Password</h1>

						<div class="mb-3">
							<label class="mb-2 text-muted" for="username">Username</label>
							<input type="text" class="form-control" id="username" value="<?= $session->Username ?>"
								disabled required autofocus>

						</div>

						<div class="mb-3">

							<label class="mb-2 text-muted" for="password">New Password</label>
							<input type="password" class="form-control" id="newPass" required>

						</div>

						<div class="mb-3">

							<label class="mb-2 text-muted" for="password">Re-type Password</label>
							<input type="password" class="form-control" id="reTypePass" required>

						</div>

						<div class="d-flex align-items-center">

							<button type="submit" id="save" class="btn btn-primary ms-auto">
								Save Password
							</button>
						</div>

					</div>
					<!-- <div class="card-footer py-3 border-0">
						<div class="text-center">
							Don't have an account? <a href="<?= base_url() ?>create_user" class="text-dark">Create
								One</a>
						</div>
					</div> -->
				</div>
				<div class="text-center mt-5 text-muted">
					Copyright &copy; 2024 &mdash; Daily Time Record Portal System
				</div>
			</div>
		</div>
	</div>
</section>

<input type="text" hidden id="userID" value="<?= $session->ID ?>">

<?php
login_footer();
?>

<script>
	$(document).on('click', '#save', function () {
		if ($('#newPass').val() != $('#reTypePass').val()) {
			toastr.error("Password doesn't match");
			return;
		}
		$.ajax({
			url: base_url + 'login/service/login_service/change_password',
			type: "POST",
			dataType: "JSON",
			data: {
				userID: $('#userID').val(),
				newPassword: $('#newPass').val(),
			},
			success: function (response) {
				if (response.has_error) {
					toastr.error(response.error_message);
				} else {
					toastr.success(response.message);
					setTimeout(function () {
						window.location = base_url + "login/authentication";
					}, 2000);
				}
			}
		});
	});
</script>