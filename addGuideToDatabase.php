<?php
	include 'php/databaseConnectionAdmin.php';

	$successAdd = $successAdd_err = "";

	if(isset($_POST['insertGuide'])){
		$fullname = $_POST['insertFullName'];
		$sex = $_POST['insertSex'];

		$query = "INSERT INTO guide (fullname, sex) VALUES ('$fullname', '$sex')";

		$statement = $pdo->prepare($query);
		if($statement->execute()){
			$successAdd = "<p class='w-responsive mx-auto mb-5 font-weight-bold text-center text-success'>Gids is toegevoegd!</p>";
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
		<link rel="stylesheet" href="css/feathericon/css/feathericon.css">
		
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
		
		<!-- website attributen -->
		<title>Gids toevoegen</title>
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
		
		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h2">Gids toevoegen aan database</h1>
			</div>
			
			<section class="mb-4">
				<form method="post">
					<div class="form-row">
						<div class="form-group col-sm-12 col-md-7">
							<label>Voor- en Achternaam</label>
							<input class="form-control" type="text" name="insertFullName" maxlength="50" />
						</div>

						<div class="form-group col-sm-12 col-md-5">
							<label>Geslacht</label>
							<select class="form-control" type="text" name="insertSex"/>
								<option value="male">Man</option>
								<option value="female">Vrouw</option>
							</select>
						</div>
					</div>

					<div class="form-row justify-content-center">
						<div class="form-group col-md-12">
							<button class="btn btn-outline-dark" type="submit" name="insertGuide">Send it!</button>
						</div>
						<?php echo $successAdd ?> <?php echo $successAdd_err; ?>
					</div>
				</form>
			</section>
					
			<h1 class="h2">Accounts</h1>
			<div class="table-responsive">
				<table style="table-layout: inherit" class="table table-striped table-sm">
					<thead>
						<tr>
							<th>#</th>
							<th>Voornaam</th>
							<th>Geslacht</th>
							<th>Aangemaakt op</th>
							<th class="text-right">Bewerk</th>
							<th class="text-right">Verwijder</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sGuide = "select * from guide";
							$stm = $pdo->prepare($sGuide);
							$stm->execute();
							if($stm->execute()){
							$sGuide = $stm->fetchAll(PDO::FETCH_OBJ);
								foreach ($sGuide as $sGuide){
									echo "<tr>";
									echo "<td>$sGuide->id</td>";
									echo "<td>$sGuide->fullname</td>";
									echo "<td>$sGuide->sex</td>";
									echo "<td>$sGuide->created_at</td>";
									echo "<td class='text-right'><a href='php/editSelectedGuide.php?edit=$sGuide->id'><i class='feather fe fe-pencil'></i></a></td>";
									echo "<td class='text-right'><a href='php/deleteSelectedGuide.php?del=$sGuide->id'><i class='feather fe fe-trash'></i></a></td>";
									echo "</tr>";
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</main>
	</body>
</html>