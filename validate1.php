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
        } else {
            // Check if the phone number is valid
            if (!preg_match('/^0[1-68]([-. ]?[0-9]{2}){4}$/', $telephone)) {
                $errors[] = 'Le champ "Téléphone" doit être un numéro de téléphone valide.';
            }
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
            if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
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
            echo '</div>';
// If there are no errors, process the data
if (count($errors) === 0) {
    // TODO: insert the data into the database, send confirmation email, etc.
            // Display a success message to the user
            echo '<div style="color: green;">';
            echo 'Le formulaire a été envoyé avec succès !';
            echo '</div>';
        }
    }
}
    ?>