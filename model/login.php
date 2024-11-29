<?php

	if (isset($_POST['connect'])) {

		$username=htmlspecialchars($_POST['username']);

		$password=md5($_POST['password']);

		if (!empty($username) AND !empty($password)) {

			// Vérification si l'utilisateur existe vraiment
			$requiser=$pdo->prepare("SELECT * FROM user WHERE username=? AND password=?");
			$requiser->execute(array($username,$password));
			// rowCount permet de compter le usernamebre saisie par le user
			$userexist=$requiser->rowCount();
			if ($userexist==1) {
				$userinfo=$requiser->fetch();
				$_SESSION['id_user']=$userinfo['id'];
				$_SESSION['username']=$userinfo['username'];
				$_SESSION['password']=$userinfo['password'];
				header("Location: rapport.php");		
			}
			else
			{
				$erreur="Mauvais Pseudo ou mauvais mot de passe! ";
			}
			
		}
		else
		{
			$erreur="Tous les champs doivent etre completés";
		}

	}