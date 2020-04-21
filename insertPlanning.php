<?php
	include 'php/databaseConfigAdministrator.php';

	$successAdd = $successAdd_err = "";

	if(isset($_POST['addGuide'])){
		$selectGame = $_POST['selectGame'];
		$selectGuide = $_POST['selectGuide'];
		$selectStartTime = $_POST['selectStartTime'];
		$selectPlayers = $_POST['selectPlayers'];

		$query = "INSERT INTO planning (game, time, guide, players) VALUES ('$selectGame', '$selectGuide', '$selectStartTime', '$selectPlayers')";

		$statement = $pdo->prepare($query);
		if($statement->execute()){
			$successAdd = "<p class='w-responsive mx-auto mb-5 font-weight-bold text-center text-success'>Artiest is toegevoegd!</p>";
		}
		else {
			$successAdd_err = "<p class='w-responsive mx-auto mb-5 font-weight-bold text-center text-danger'>Er is iets niet goed gegaan, probeer het opnieuw!</p>";
		}
	}
?>

<!doctype html>
<html>
	<head>
		<!-- bootstrap en font-awesome stylesheet / do not touch! -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link href="https://getbootstrap.com/docs/4.1/examples/dashboard/dashboard.css" rel="stylesheet">
		
		<!-- local css / change if needed! -->
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/stylish-portfolio.min.css">
		<link rel="stylesheet" href="css/fi/css/feathericon.css">
		
		<!-- website attributen -->
		<title>Planning toevoegen</title>
	</head>
	
	<body>
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
						<a class="nav-link" href="addGameToDatabase.php">
						<i class="feather fe fe-gamepad"></i>
						Voeg game toe</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="addGuideToDatabase.php">
						<i class="feather fe fe-beginner"></i>
						Voeg gids toe</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="addPlayersToDatabase.php">
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

		<div class="container-fluid">
			<div class="row">
				<!-- Sidebar -->

		<form method="post">
			<div class="form-row centered">
				<div class="form-group col-sm-12 col-md-6">
					<label>Selecteer Spel</label>
					<select class="form-control" name="selectGame">
						<?php 
							$viewGameName = "select name from games";
							$stm = $pdo->prepare($viewGameName);
							$stm->execute();
							if($stm->execute()){
								$viewGameName = $stm->fetchAll(PDO::FETCH_OBJ);
								foreach ($viewGameName as $viewGameName){ ?>
						<option><?php echo $viewGameName->name; ?></option>
						<?php }} ?>
					</select>
				</div>
				
				<div class="form-group col-sm-4 col-md-2">
					<label>Start tijd</label>
					<input class="form-control" type="time" name="selectStartTime" />
				</div>
				
				<div class="form-group col-sm-8 col-md-2">
					<label>Gids</label>
					<select class="form-control" name="selectGuide">
						<?php 
							$viewGuideName = "select name from guide";
							$stm = $pdo->prepare($viewGuideName);
							$stm->execute();
							if($stm->execute()){
								$viewGuideName = $stm->fetchAll(PDO::FETCH_OBJ);
								foreach ($viewGuideName as $viewGuideName){ ?>
						<option><?php echo $viewGuideName->name; ?></option>
						<?php }} ?>
					</select>
				</div>
		
				<div class="form-group col-md-2">
					<label>Spelers</label>
					<input class="form-control" type="text" name="selectPlayers">
				</div>
				
				<div class="form-group col-md-1">
					<input class="btn btn-outline-dark" type="submit" name="insertPlanning"></button>
				</div>
				<?= $successAdd, $successAdd_err; ?>
			</div>
		</form>
	</body>
</html>