<?php
           

echo"
						<title>Formulaire de CV - Etat civil</title>
					<body>
						<h1 style= 'text-align:center ';>Formulaire de CV - Etat civil</h1>
						<form action='etatcivil.php' method='POST'>
							<label for='nom'>Nom :</label>
							<input type='text' id='nom' name='nom' ><br>
							<label for='prenom'>Prénom :</label>
							<input type='text' id='prenom' name='prenom' ><br>
							<label for='profil'>text profil  :</label>
							<input type='text' id='prenom' name='profil' ><br>
							<label for='date'>Date de naissance :</label>
							<input type='date' id='date' name='date_naissance' ><br>

							<label for='adress'>Adresse :</label>
							<textarea  name='adresse' ></textarea><br>

							<label for='telephone'>Téléphone :</label>
							<input type='tel' i name='telephone' ><br>

							<label for='email'>Email :</label>
							<input type='email' id='email' name='email' ><br>
							<label for='password'>Mot de passe :</label>
							<input type='text' id='password' name='password' ><br>
						  

							<input type='submit' value='Suivant' name='submit'>
						</form>
					</body>
					<style>
					body {
					font-family: Arial, sans-serif;
					margin: 0;
					padding: 0;
					}

					h1 {
					font-size: 2rem;
					margin-bottom: 1rem;
					}

					form {
					max-width: 500px;
					margin: 0 auto;
					padding: 2rem;
					background-color: #f7f7f7;
					border: 1px solid #ccc;
					border-radius: 10px;
					box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
					}

					label {
					display: block;
					margin-bottom: 0.5rem;
					font-weight: bold;
					}

					input[type='text'],
					input[type='date'],
					input[type='tel'],
					input[type='email'],
					input[type='password'],
					textarea {
					display: block;
					width: 100%;
					padding: 0.5rem;
					margin-bottom: 1rem;
					border: 1px solid #ccc;
					border-radius: 5px;
					}

					input[type='submit'] {
					background-color: black;
					color: #fff;
					padding: 0.5rem 1rem;
					border: none;
					border-radius: 5px;
					cursor: pointer;
					transition: background-color 0.3s ease;
					}

					input[type='submit']:hover {
					background-color: #3e8e41;
					}

					@media screen and (max-width: 600px) {
					form {
					padding: 1rem;
					}
					}

					</style>
					</html>";

?>
<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Check if the form has been submitted
        // Get the data from the form
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST['date_naissance'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $profil = $_POST['profil'];

        // Validate the data
        $errors = array();
        if (empty($nom)) {
            $errors[] = 'Le champ "Nom" est obligatoire.';
        }
        if (empty($prenom)) {
            $errors[] = 'Le champ "Prénom" est obligatoire.';
        }
        if (empty($date_naissance)) {
            $errors[] = 'Le champ "Date de naissance" est obligatoire.';
        } else {
            // Check if the date is valid
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_naissance) || !checkdate(substr($date_naissance, 5, 2), substr($date_naissance, 8, 2), substr($date_naissance, 0, 4))) {
                $errors[] = 'Le champ "Date de naissance" doit être une date valide au format AAAA-MM-JJ.';
            }
        }
        if (empty($adresse)) {
            $errors[] = 'Le champ "Adresse" est obligatoire.';
        }
        if (empty($telephone)) {
            $errors[] = 'Le champ "Téléphone" est obligatoire.';
        } 
        if (empty($email)) {
            $errors[] = 'Le champ "Email" est obligatoire.';
        } else {
            // Check if the email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Le champ "Email" doit être une adresse email valide.';
            }
        }
        if (empty($password)) {
            $errors[] = 'Le champ "Mot de passe" est obligatoire.';
        } else {
            // Check if the password is strong enough
            if (strlen($password) < 8 || !preg_match('/[0-9]/', $password)) {
                $errors[] = 'Le champ "Mot de passe" doit contenir au moins 8 caractères, dont au moins une majuscule, une minuscule et un chiffre.';
            }
        }

        // If there are errors, display them to the user
        if (count($errors) > 0) {
            echo '<div style="color: red;">';
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
            echo '</div>';}
// If there are no errors, process the data
if (count($errors) == 0) {
					// Save data in session
					session_start();
					$_SESSION['nom'] = $nom;
					$_SESSION['prenom'] = $prenom;
					$_SESSION['date'] = $date_naissance;
					$_SESSION['adress'] = $adresse;
					$_SESSION['telephone'] = $telephone;
					$_SESSION['email'] = $email;
					$_SESSION['password'] = $password;
					// Set database connection details
					$servername = "localhost";
					$username = "root";
					$db_password = "";
					$dbname = "php_projet";

					// Create connection
					$conn = new mysqli($servername, $username, $db_password, $dbname);
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					// Prepare and execute SQL query to insert data into the table
					// Prepare and execute SQL query to insert data into the table
$stmt = $conn->prepare("INSERT INTO users (nom, prenom, date_naissance, adresse, telephone, email, password, profil) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $nom, $prenom, $date_naissance, $adresse, $telephone, $email, $password, $profil);
$stmt->execute();
					$_SESSION['user_id'] = mysqli_insert_id($conn);


					//        $_SESSION['user_id'] = $conn->insert_id; Close statement and database connection
					$stmt->close();
					$conn->close();

				
				 header("Location: formation.php"); 
					}

        }

    ?>