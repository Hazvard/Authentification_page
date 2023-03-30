<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Connexion" content="width=device-width, initial-scale=1.0">
    <title>Exemple d'Authentification</title>
    <link href="style.css" rel="stylesheet" type="text/css"/>
</head>


<?php
    
    // Rentrer vos identifiants
    $login = "root"; 
    $password = "";
    //-------------------------

    $mysqli = new mysqli("localhost",$login,$password,"authentification_page"); //connexion à la BDD mysql sur localhost, user root et mdp password sur la table boissons.
        //attention : la table boissons n'est pas créée lors de la connexion, si elle n'existe pas c'est cassé

    //Verif connexion
    if ($mysqli -> connect_errno) 
        echo "Connexion à la base de données impossible: " . $mysqli -> connect_error;
        


    
    if(isset($_POST["submit_signin"])){ // Les tests ne se font que si l'on valide le formulaire
        global $erreur_mdp_signin, $erreur_username_signin, $erreur_signin;
        $erreur_signin = $erreur_login_signin = $erreur_mdp_signin = false;

        // Verifictation du login
        $login_signin = trim($_POST["username_signin"]); // trim() retire les espace inutiles
        if (strlen($login_signin) < 0 || strlen($login_signin) > 49 )
            $erreur_username_signin = true;

        // Verifictation du login
        $password_signin = trim($_POST["password_signin"]); // trim() retire les espace inutiles
        if (strlen($password_signin) < 0 || strlen($password_signin) > 59 )
            $erreur_mdp_signin = true;

        if($erreur_username_signin || $erreur_mdp_signin)
            $erreur_signin = true;
    }

    if (isset($_POST["submit_signin"]) && !$erreur_signin) {
        // S'il n'y a pas d'erreurs on enregistre dans la base de donnee
        
        //BDD
        $sql = "INSERT INTO `utilisateur` (`username`, `password`) VALUES (?, ?)";
	    $query = $mysqli->prepare($sql);

        $username = $_POST["username_signin"];
	    $password =  $_POST["password_signin"];

	    $query->bind_param("ss", $username, $password); //s = string, i = int
	    $query->execute();

    }
?>

<body>
    <div>
        <h1>Connexion</h1>
        <form class="login_form" method="post" action="#">
            <p><label for="Username">Login</label></p>
            <p><input type="texte" id="username" name="username" placeholder="Entrer votre nom d'utilisateur" required="required"
                value="<?php if (isset($_POST['login'])) echo $_POST['login']; ?>">
                <?php global $erreur_login; if ($erreur_login) echo "erreur";?> </p>

            <p><label for="password">mot de passe</label></p>
            <p><input type="password" value="" id="password_login" name="password" placeholder="Entrer votre mot de passe" required="required">
            <button class="unmask" type="button" onclick="changer_login()" title="Masque/Démasque le mot de passe">démasquer</button>
            <?php global $erreur_login; if ($erreur_login) echo "erreur";?></p>

            <p><button type="submit" id="submit_identification" name="submit_identification">s'identifier</button></p>
            
        </form>
    </div>
    <div>
        <h1>Création d'utilisateur</h1>
        <form class="submit_signin" method="post" action="#">
            <p><label for="Username">Login</label></p>
            <p><input type="texte" id="username_signin" name="username_signin" placeholder="Entrer votre nom d'utilisateur" required="required"
                value="<?php if (isset($_POST['login'])) echo $_POST['login']; ?>">
                <?php global $erreur_username_signin; if ($erreur_username_signin) echo "Trop de caractères";?></p>

            <p><label for="password">mot de passe</label></p>
            <p><input type="password" value="" id="password_signin" name="password_signin" placeholder="Entrer votre mot de passe" required="required">
            <button class="unmask" type="button" onclick="changer_signin()" title="Masque/Démasque le mot de passe">démasquer</button>
            <?php global $erreur_mdp_signin; if ($erreur_mdp_signin) echo "Trop de caractères";?></p>

            <p><button type="submit" id="submit_signin" name="submit_signin">s'inscrire</button></p>
            
        </form>
    </div>
</body>

<!-- Script permettant de masquer/demasque le mot de passe -->
<script>
        mdp_login=true;
        mdp_signin=true;
        function changer_login(){
            if(mdp_login){
                document.getElementById("password_login").setAttribute("type", "text");
                mdp_login=false;
            }else{
                document.getElementById("password_login").setAttribute("type", "password");
                mdp_login=true;
            }
        }
        function changer_signin(){
            if(mdp_signin){
                document.getElementById("password_signin").setAttribute("type", "text");
                mdp_signin=false;
            }else{
                document.getElementById("password_signin").setAttribute("type", "password");
                mdp_signin=true;
            }
        }
</script>