<?php
	include 'databaseConnectionAdmin.php';

	$editGuide_err = "";

	if(empty($_GET['edit'])){
		echo "Er is iets mis gegaan, geen ID";
	} else {
		$id = $_GET['edit'];
		if(isset($_POST['editGuide'])){
			$fullname = $_POST['editFullName'];
			$sex = $_POST['editSex'];
			$query = "UPDATE guide SET fullname = '$fullname', sex = '$sex' WHERE id = $id";
			$stm = $pdo->prepare($query);
			if($stm->execute()){
				header("location: ../addGuideToDatabase.php");
			} else {
				$editGuide_err = "<p class='w-responsive mx-auto mb-5 font-weight-bold text-center text-danger'>Err: Er is een fout opgetreden!</p>";
			}
		}
		$query = "SELECT * FROM guide WHERE id = $id LIMIT 1";
		$stm = $pdo->prepare($query);
		if($stm->execute()){
			$sGuide = $stm->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="nl">
	<head>
		<title>Planning Tool</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<!-- Stylsheets -->
		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/dashboard/">

		<!-- Custom Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/slc/css/simple-line-icons.css">
		<link rel="stylesheet" href="css/fa/css/fontawesome.min.css">
		
		<!-- Font facing -->
		<link rel="stylesheet" href="css/font-face.css">

		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/sp/stylish-portfolio.min.css">
		<link rel="stylesheet" href="css/sp/stylish-portfolio.css">
	
		<!-- Feather Icons -->
		<link rel="stylesheet" href="css/fi/css/feathericon.min.css">
		
		<!-- Inner Styling -->
		<style>
			clicker{-moz-transition:1.0s ease-in;-o-transition:1.0s ease-in;-webkit-transition:1.0s ease-in;transition:1.0s ease-in}clicker:hover{color: black}.header-text{color:white;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:0;width:80%;padding:20px;text-align:center;}.header{width:100%;display:block;background-size:100%;}.overlay{background:rgba(0,0,0,0.6)}@media screen and (max-width:991px){.showNoneMax{display:none !important}}::-webkit-scrollbar{display:none}::-moz-scrollbar{display:none}::-o-scrollbar{display:none}::scrollbar{display:none}#wrapper{max-width:100%;margin:0 auto;text-align:center}#gallery{overflow:hidden}#gallery a{display:block;float:left}#gallery a img{display:block;border:0}.modal-dialog{min-width:50%}.fa-facebook{background:#3B5998;color:white;}.fa-youtube{background:#bb0000;color:white;}.fa-instagram{background:#125688;color:white;}.fa{padding:20px;font-size:30px;width:100px;text-align:center;text-decoration:none;margin:5px 2px;}a:hover{text-decoration:none}.container{width:100%}@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}
		</style>
		
		<!-- Datatables -->
		<link rel="stylesheet" href="css/dt/jqeurty.dataTables.min.css">

		<!-- Custom styles for this template -->
		<link href="https://getbootstrap.com/docs/4.1/examples/dashboard/dashboard.css" rel="stylesheet">
	</head>

	<body>
		<!-- Navbar -->
		<nav class="navbar navbar-expand-xl navbar-dark fixed-top bg-dark p-0 shadow">
			<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="adminEdit.php?id=1">Teiland-1</a>
			<div class="collapse navbar-collapse" id="navbarToggler">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
				<div class="">
					<a class="text-light">
						Welkom terug, admin					</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</div>
		</nav>
		
		<nav class="col-md-2 d-none d-md-block bg-light sidebar">
			<div class="sidebar-sticky">
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link" href="../addGameToDatabase.php">
						<i class="feather fe fe-gamepad"></i>
						Voeg game toe</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../addGuideToDatabase.php">
						<i class="feather fe fe-beginner"></i>
						Voeg gids toe</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../addPlayersToDatabase.php">
						<i class="feather fe fe-user"></i>
						Voeg spelers toe</a>
					</li>
				</ul>
						
				<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
					<span>Welkom terug, admin</span>
				</h6>
				<ul class="nav flex-column mb-2">
					<li class="nav-item">
						<div class="nav-link">
							<a class="text-muted" onclick="location.reload()" style="cursor:pointer">Refresh</a>
						</div>
					</li>
					<li class="nav-item">
						<div class="nav-link">
							<a class="text-muted" href="adminIndex.php">View site</a>
					</div>
					</li>
					<li class="nav-item">
						<div class="nav-link">
							<a class="text-muted" href="http://localhost/phpmyadmin/db_structure.php?server=1&amp;db=teiland-1">PHPMA Panel</a>
						</div>
					</li>
					<li class="nav-item">
						<div class="nav-link">
							<a class="text-muted" href="adminRegister.php">Add admin</a>
						</div>
					</li>
					<div class="dropdown-divider"></div>
					<li class="nav-item">
						<div class="nav-link">
							<a class="text-muted" href="logout.php">Log uit</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h2">Gebruiker bijwerken</h1>
			</div>

			<!-- Edit table -->
					<section class="mb-4">
						<h2 class="h1-responsive font-weight-normal my-4">Bewerk <b><?php echo $sGuide->fullname ?></b>, met id <b><?php echo $sGuide->id ?></</h2>
						<br />
						<?php
//							echo $userUpdated;
//							echo $userUpdated_err;
						?>
						<form method="post">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Gebruikersnaam</label>
									<input class="form-control" name="editFullName" value="<?php echo $sGuide->fullname ?>" />
								</div>
								
								<div class="form-group col-md-6">
									<label>Geslacht</label>
									<select class="form-control" name="editSex">
										<option value="male">Man</option>
										<option value="female">Vrouw</option>
									</select>
								</div>
								<div class="form-group col-md-2">
									<label>Aangemaakt op</label>
									<label class="form-control"><?php echo $sGuide->created_at ?></label>
								</div>
								<div class="form-group col-md-12">
									<button class="btn btn-outline-dark" type="submit" name="editGuide">Werk <?php echo "$sGuide->fullname" ?> bij</button>
								</div>
								
								<?= $editGuide_err ?>
							</div>
						</form>
					</section>
				</main>

		<!-- Bootstrap core JavaScript -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
		<script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/popper.min.js"></script>
		<script src="https://getbootstrap.com/docs/4.1/dist/js/bootstrap.min.js"></script>

		<!-- Icons -->
		<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
		<script>
			feather.replace()
		</script>

	</body>
</html>
<?php
		}}