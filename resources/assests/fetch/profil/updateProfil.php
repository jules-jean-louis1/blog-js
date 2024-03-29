<?php // ajoute check login
session_start();
require_once '../../Classes/Users.php';

if (empty($_POST['login']) && empty($_POST['password']) && empty($_POST['passwordConfirm'])) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'empty', 'message' => 'Veuillez remplir au moins un champ']);
    die();
}
if (!empty($_POST['login'])) {
    $login = htmlspecialchars($_POST['login']);
    if (strlen($login) < 3) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Votre login doit contenir au moins 5 caractères']);
        die();
    }
    if (strlen($login) > 18) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Votre login ne doit pas dépasser 20 caractères']);
        die();
    }
    if ($login == $_SESSION['login']) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Votre login est déjà celui-ci']);
        die();
    }
    if ($login === 'admin' || $login === 'moderateur' || $login === 'utilisateur' || $login === 'Admin') {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Vous ne pouvez pas utiliser ce login']);
        die();
    }
    $user = new Users();
    if ($user->checkLogin($login) == true) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Ce login est déjà utilisé']);
        die();
    } else {
        $user->updateLogin($login, $_SESSION['id']);
        $_SESSION['login'] = $login;
        header('Content-Type: application/json');
        echo json_encode(['status' => 'loginUp', 'message' => 'Votre login a bien été modifié']);
        die();
    }
}

if (isset($_POST['password']) && isset($_POST['passwordConfirm'])) {
    $password = htmlspecialchars($_POST['password']);
    $passwordConfirm = htmlspecialchars($_POST['passwordConfirm']);

    if (!empty($password) && !empty($passwordConfirm)) {
        if ($password == $passwordConfirm) {
            $user = new Users();
            if ($user->checkPassword($password) == false) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Votre mot de passe doit contenir au moins 5 caractères dont 1 chiffre']);
            } else {
                $user->updatePassword($password, $_SESSION['id']);
                header('Content-Type: application/json');
                echo json_encode(['status' => 'passwordUp', 'message' => 'Votre mot de passe a bien été modifié']);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Les mots de passe ne correspondent pas']);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'empty', 'message' => 'Veuillez remplir les 2 champs du mot de passe']);
    }
    die();
}


?>
