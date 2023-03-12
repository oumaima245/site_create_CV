<?php
					session_start();
          if (!isset($_SESSION['user_id'])) {
            header("Location: etatcivil.php");
            exit;
        }
// Check if the form has been submitted
if(isset($_POST['submit'])){
  // Connect to the database
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'php_projet';
  $conn = mysqli_connect($host, $username, $password, $dbname);
  
  // Check for errors
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
  
  // Insert data into the database
  if(isset($_POST['submit'])) {
    $education = $_POST['education'];
    $degree = $_POST['degree'];
    $years = $_POST['year'];
      $user_id=$_SESSION['user_id'];
      $_SESSION['education'] = $education;
      $_SESSION['degree'] = $degree;
      $_SESSION['year'] = $years;
      // Insert data into the database
      for($i=0; $i<count($education); $i++) {
        $sql = "INSERT INTO education (education, degree, year, user_id) VALUES ('$education[$i]', '$degree[$i]', '$years[$i]', '$user_id')";
  
          if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
      }// Close the database connection
  mysqli_close($conn);
  header("Location: experience.php");

  }
  
  
}
?>

<!-- Display the form -->
<h1>Formulaire de CV - Formation</h1>
<form action="formation.php" method="post">
    <div id="formation"><label for="education">Education:</label>
    <input type="text" name="education[]" required><br>

    <label for="degree">Degree:</label>
    <input type="text" name="degree[]" required><br>

    <label for="year">Year:</label>
    <input type="text" name="year[]" required><br></div>
    <button type='button' id='add-experience'>+</button>

    <input type="submit" value="Suivant" name="submit">
</form>
<script>
    const addButton = document.getElementById('add-experience');
    const experiences = document.getElementById('formation');
    addButton.addEventListener('click', () => {
        const newExperience = document.createElement('div');
        newExperience.className = 'experience';

        newExperience.innerHTML = `
        <label for="education">education:</label>
        <input type="text" name="education[]"><br>

        <label for="degree">Degree:</label>
        <input type="text" name="degree[]"><br>

        <label for="year">Year:</label>
        <input type="text" name="year[]"><br>
        `;

        experiences.appendChild(newExperience);
    });
</script>




<?php 
                echo" <style>
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

                </style>";
 
?>
	
