<?php
session_start();

?>
<?php if (isset($_SESSION['login']) != null) :?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="resources/js/profil.js"></script>
    <link rel="stylesheet" href="resources/style/index.css">
    <title><?= $_SESSION['login']?> - Profil</title>
</head>
<body>
<header>
    <?php include_once 'resources/assests/import/header.php' ?>
</header>
<main>
    <section class="flex flex-col items-center justify-center ">
        <div id="containerProfile">
            <h2 class="text-2xl font-bold text-center">Profil</h2>
        </div>
        <div id="formProfil" class="flex justify-center w-1/2">
            <div id="formUpdateInfos">
                <form action="resources/assests/fetch/profil/updateProfil.php" method="post" id="updateprofil-form"
                      class="flex flex-col space-y-2">
                    <div class="flex flex-col space-y-2">
                        <label for="login">Login</label>
                        <input type="text" name="login" id="login" placeholder="<?= $_SESSION['login'] ?>"
                               class="p-2 rounded-lg bg-slate-100">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" class="p-2 rounded-lg bg-slate-100">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="passwordConfirm">Confirmation du mot de passe</label>
                        <input type="password" name="passwordConfirm" id="passwordConfirm"
                               class="p-2 rounded-lg bg-slate-100">
                    </div>
                    <div id="containerMessageProfil" class="h-[65px] max-w-[330px]">
                        <div id="errorMsg"></div>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <button type="submit" id="update" name="update" class="p-2 rounded-lg bg-green-500 text-white">
                            Update
                        </button>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <button type="submit" id="delete" name="delete" class="p-2 rounded-lg bg-red-500 text-white">
                            Supprimer Compte
                        </button>
                    </div>
                </form>
            </div>
            <div id="containerFormUpdateAvatar">
                <form action="resources/assests/fetch/profil/updateAvatar.php" method="post" id="formUpdateAvatar" class="flex flex-col space-y-2" enctype="multipart/form-data">
                    <div>
                        <label for="avatar">Avatar</label>
                        <img src="resources/images/avatar/<?=$_SESSION['user_avatar']?>">
                        <input type="file" name="uploadfile" id="uploadfile" class="p-2 rounded-lg bg-slate-100" value="">
                    </div>
                    <div id="containerMessageProfil" class="h-[65px] max-w-[330px]">
                        <div id="errorMsgAvatar"></div>
                    </div>
                    <div>
                        <button type="submit" id="upload" name="upload" class="p-2 rounded-lg bg-green-500 text-white">
                            Update Avatar
                        </button>
                </form>
            </div>
        </div>
    </section>
</main>
</body>
</html>
<?php else : ?>
    <?php header('Location: index.php') ?>
<?php endif; ?>
