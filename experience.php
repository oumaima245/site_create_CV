<?php
					session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: etatcivil.php");
    exit;
}

                            // Server-side validation and verification
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
        $company = $_POST['company'];
        $position = $_POST['position'];
        $duration = $_POST['duration'];
        $_SESSION['company'] = $company;
      $_SESSION['position'] = $position;
      $_SESSION['duration'] = $duration;
        $user_id=$_SESSION['user_id'];
    
        // Insert data into the database
        for($i=0; $i<count($company); $i++) {
            $sql = "INSERT INTO experiences (user_id,company, position, duration) 
                    VALUES ('$user_id','$company[$i]', '$position[$i]', '$duration[$i]')";
    
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }// Close the database connection
    mysqli_close($conn);
    header("Location: hobies.php");

    }
    
    
}
    ?>
    
<h1>Formulaire de CV - Experiences </h1>

<form action='experience.php' method='post' id='experience-form'>
    <div id='experiences'>
        <div class='experience' >
            <label for='company'>Company:</label>
            <input type='text' name='company[]' required><br>

            <label for='position'>Position:</label>
            <input type='text'  name='position[]' required><br>

            <label for='duration'>Duration:</label>
            <input type='text'  name='duration[]' required><br>
        </div>
    </div>

    <button type='button' id='add-experience'>+</button>

    <input type='submit' value='Submit' name='submit'>
</form>

<script>
    const addButton = document.getElementById('add-experience');
    const experiences = document.getElementById('experiences');
    addButton.addEventListener('click', () => {
        const newExperience = document.createElement('div');
        newExperience.className = 'experience';

        newExperience.innerHTML = `
            <label for='company'>Company:</label>
            <input type='text' name='company[]' required><br>

            <label for='position'>Position:</label>
            <input type='text'  name='position[]' required><br>

            <label for='duration'>Duration:</label>
            <input type='text'  name='duration[]' required ><br>
        `;

        experiences.appendChild(newExperience);
    });
</script><script>
    const addButton = document.getElementById('add-experience');
    const experiences = document.getElementById('experiences');
    addButton.addEventListener('click', () => {
        const newExperience = document.createElement('div');
        newExperience.className = 'experience';

        newExperience.innerHTML = `
            <label for='company'>Company:</label>
            <input type='text' name='company[]' ><br>

            <label for='position'>Position:</label>
            <input type='text'  name='position[]' ><br>

            <label for='duration'>Duration:</label>
            <input type='text'  name='duration[]' ><br>
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


