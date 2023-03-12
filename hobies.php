<?php
session_start();
          if (!isset($_SESSION['user_id'])) {
            header("Location: etatcivil.php");
            exit;
        }
        if(isset($_POST['submit'])){
            // Connect to the database
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'php_projet';
            $conn = mysqli_connect($host, $username, $password, $dbname);
            $user_id=$_SESSION['user_id'];
            
            // Check for errors
            if (mysqli_connect_errno()) {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              exit();
            }
            
            // Insert data into the database
            if(isset($_POST['submit'])) {
                $hobies = $_POST['H'];
                $_SESSION['H'] = $Hobies;


   
                // Insert data into the database
                for($i=0; $i<count($hobies); $i++) {
                    $sql = "INSERT INTO hobbies (user_id,hobby) 
                            VALUES ('$user_id','$hobies[$i]')";
            
                    if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }// Close the database connection
            mysqli_close($conn);
            header("Location: myresume.php");
        
            }
        }
            ?>
        
<!DOCTYPE html>
<html>
<head>
	<title>Formulaire de CV - HOBBies</title>
</head>
<body>
	<h1>Formulaire de CV - HOBBies</h1>
	<form action="hobies.php" method="post">
        <div id="cv">
		<label for="hobies1">Hobby 1 :</label>
		<input type="text" name="H[]" required><br>
		<label for="hobies2">Hobby 2:</label>
		<input type="text" name="H[]" required><br>
		<label for="hobies3">Hobby 3 :</label>
		<input type="text" name="H[]" required><br></div>
        <button type='button' id='add-experience'>+</button>
		<input type="submit" value="suivant" name="submit">
	</form>
</body>
</html>
<script>
    const addButton = document.getElementById('add-experience');
    const experiences = document.getElementById('cv');
    addButton.addEventListener('click', () => {
        const newExperience = document.createElement('div');
        newExperience.className = 'experience';

        newExperience.innerHTML = `
            <label for='company'>hobby:</label>
            <input type='text' name='H[]' required ><br>

            
        `;

        experiences.appendChild(newExperience);
    });
</script>
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
            input[type='text'],
            input[type='tel'],
            input[type='email'],
            textarea {
            display: block;
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            }input[type='submit'] {
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

            </style>";

