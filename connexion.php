<?php
// Vérifier si le formulaire a été soumis
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si l'utilisateur existe dans la base de données
    // Remplacer ces lignes par votre propre code de vérification de l'utilisateur

    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "php_projet";

    // Établir la connexion à la base de données
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    // Vérifier la connexion
    if(!$conn){
        die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }

    // Requête SQL pour récupérer l'utilisateur
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    
    // Vérifier si l'utilisateur existe dans la base de données
    if(mysqli_num_rows($result) == 1){
         // Récupérer l'ID de l'utilisateur
         $row = mysqli_fetch_assoc($result);
         $user_id = $row['id'];
         $username = $row['nom'];
         $profil = $row['profil'];
         // Ajouter l'ID de l'utilisateur à la session
         session_start();
         $_SESSION['user_id'] = $user_id;
         $_SESSION['username']=$username;
         $_SESSION['profil']=$profil;
            header("Location: accuiel.php");

                // Rediriger vers la page d'accueil ou une autre page sécurisée
      exit;
    }else{
        // L'utilisateur n'existe pas ou le mot de passe est incorrect
        echo"Adresse e-mail ou mot de passe incorrect";
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
}
?>
