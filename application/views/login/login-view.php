<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Zoky Manoro - Login</title>
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
<link href="<?php echo base_url('assets/zoky_manoro.jpg'); ?>" rel="icon">


<style>
	body {font-family: Arial, Helvetica, sans-serif;}

	/* Full-width input fields */
	input[type=text], input[type=password] {
	width: 100%;
	padding: 12px 20px;
	margin: 8px 0;
	display: inline-block;
	border: 1px solid #ccc;
	box-sizing: border-box;
	}

	/* Set a style for all se connecter */
	.btn-connecter{
	background-color: #2C4D6A; /*couleur bleu */
	color: white;
	padding: 14px 20px;
	margin: 8px 0;
	border: none;
	cursor: pointer;
	width: 100%;
	}
	/* Set a style for annuler */
	.btn-annuler  {
	background-color: #CE5E10; /*couleur orange */
	color: white;
	padding: 14px 20px;
	margin: 8px 0;
	border: none;
	cursor: pointer;
	width: 100%;
	}

	button:hover {
	opacity: 0.8;
	}

	/* Extra styles for the cancel button */
	.cancelbtn {
	width: auto;
	padding: 10px 18px;
	background-color: #f44336;
	}

	/* Center the image and position the close button */
	.imgcontainer {
	text-align: center;
	margin: 24px 0 12px 0;
	position: relative;
	}

	img.avatar {
	width: 40%;
	border-radius: 50%;
	}

	.container {
	padding: 16px;
	}

	span.psw {
	float: right;
	padding-top: 16px;
	}

	/* The Modal (background) */
	.modal {
	position: fixed; /* Stay in place */
	z-index: 1; /* Sit on top */
	left: 0;
	top: 0;
	width: 100%; /* Full width */
	height: 100%; /* Full height */
	overflow: auto; /* Enable scroll if needed */
	background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	padding-top: 60px;
	}

	/* Modal Content/Box */
	.modal-content {
	background-color: #fefefe;
	margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
	border: 1px solid #888;
	width: 80%; /* Could be more or less, depending on screen size */
	}

	/* The Close Button (x) */
	.close {
	position: absolute;
	right: 25px;
	top: 0;
	color: #000;
	font-size: 35px;
	font-weight: bold;
	}

	.close:hover,
	.close:focus {
	color: red;
	cursor: pointer;
	}

	/* Add Zoom Animation */
	.animate {
	-webkit-animation: animatezoom 0.6s;
	animation: animatezoom 0.6s
	}

	@-webkit-keyframes animatezoom {
	from {-webkit-transform: scale(0)} 
	to {-webkit-transform: scale(1)}
	}
	
	@keyframes animatezoom {
	from {transform: scale(0)} 
	to {transform: scale(1)}
	}

	/* Change styles for span and cancel button on extra small screens */
	@media screen and (max-width: 300px) {
	span.psw {
		display: block;
		float: none;
	}
	.cancelbtn {
		width: 100%;
	}
	}
</style>
</head>
<body>

<!-- <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button> -->

<div id="id01" class="modal">  
	<form class="modal-content animate" action="<?php echo site_url("verifier-login") ?>" method="POST">
		<div class="imgcontainer">
            <!-- <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span> -->
            <img src="<?= base_url('assets/zoky_manoro.jpg')?>" alt="Avatar" class="">
		</div>

		<?php echo $this->session->flashdata('errorMessage') ?>

		<div class="container">
            <label for="uname"><b>Nom utilsateur</b></label>
            <input type="text" placeholder="nom utilisateur"  name="login" required>

            <label for="psw"><b>Mot de passe</b></label>
            <input type="password" placeholder="mot de passe" name="pass" required>
                
            <button type="submit" class="btn-connecter">Se connecter</button>
			<a href="#" onclick="location.href='<?php echo site_url('accueil') ?>'"><input class="btn-annuler" type="button" value="Annuler"></a>
			<!-- <label>
				<input type="checkbox" checked="checked" name="remember"> Remember me
            </label> -->
		</div>
        <!-- 
			<div class="container" style="background-color:#f1f1f1">
				<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
				<span class="psw">Forgot <a href="#">password?</a></span>
			</div> -->
		</form>
</div>

<script>
	// Get the modal
	// var modal = document.getElementById('id01');

	// When the user clicks anywhere outside of the modal, close it
	// window.onclick = function(event) {
		// if (event.target == modal) {
		// 	modal.style.display = "block";
		// }
	// }
</script>

</body>

</html>
