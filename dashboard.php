<?php
session_start();
require_once 'resources/assests/Classes/Users.php';



?>
<?php if (isset($_SESSION['droits']) == 'administrateur') : ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer type="module" src="resources/js/dashboard.js"></script>
        <link rel="stylesheet" href="resources/style/index.css">
        <title><?= $_SESSION['login']?> - Dashboard</title>
    </head>
    <body>
    <header class="border-b-[1px] border-[#52586633] bg-white fixed top-0 w-full">
        <?php include_once 'resources/assests/import/header.php' ?>
    </header>
        <main class="mt-[10%] lg:mt-[6%]">
            <article>
                <section>
                    <div id="titleDashboard">
                        <h1 class="text-4xl text-center font-semibold">
                            Dashboard
                        </h1>
                    </div>
                    <div class="flex lg:flex-row flex-col justify-center py-4 space-x-2">
                        <button id="userFormAff" class="border-[1px] border-black px-4 py-2 rounded-lg font-bold hover:bg-[#EAEBEC] ease-in duration-50">Modifier les utilisateurs</button>
                        <button id="categoriesFormAff" class="border-[1px] border-black px-4 py-2 rounded-lg font-bold hover:bg-[#EAEBEC] ease-in duration-50">Modifier les catégories</button>
                        <button id="commentFormAff" class="border-[1px] border-black px-4 py-2 rounded-lg font-bold hover:bg-[#EAEBEC] ease-in duration-50">Modifier les commentaires</button>
                        <button id="articlesFormAff" class="border-[1px] border-black px-4 py-2 rounded-lg font-bold hover:bg-[#EAEBEC] ease-in duration-50">Modifier les articles</button>
                    </div>
                </section>
                <section id="displayAllUser">
                    <div id="containerDash">
                        <div id="containerMessage" class="flex justify-center p-2 h-[40px]">
                            <div id="errorMsg"></div>
                        </div>
                        <div id="tableauUser" class="flex justify-center">
                            <div class="w-[80%] flex flex-col items-center justify-center">
                                <table class="w-full border-[1px]">
                                    <thead class="rounded-t-lg">
                                    <tr>
                                        <th class="px-4 py-2 border-[1px]">ID</th>
                                        <th class="px-4 py-2 border-[1px]">Login</th>
                                        <th class="px-4 py-2 border-[1px]">Droits</th>
                                        <th class="px-4 py-2 border-[1px]">Action</th>
                                        <th class="px-4 py-2 border-[1px]">Articles</th>
                                        <th class="px-4 py-2 border-[1px]">Commentaires</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tableauTbody" class="w-full border-[1px]"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="hidden" id="displayCategories">
                    <div class="flex flex-col items-center pt-[2%] lg:py-[3%]">
                        <div id="categoriesWarp" class="flex flex-col lg:w-[80%] items-center border-[1px] border-[#D2D2D2] rounded-lg bg-[#F8F8F8]">
                            <div id="titleCategories" class="flex flex-col items-center space-x-2">
                                <h1 class="text-4xl text-semibold">
                                    Catégories
                                </h1>
                                <p>
                                    <span class="w-[130px]">Ici, vous pouvez renommer les catégories.</span>
                                </p>
                            </div>
                            <div id="containerCategory" class="flex flex-col items-center space-y-3"></div>
                        </div>
                    </div>
                </section>
                <section class="flex justify-center hidden" id="displayCommentaires">
                    <div class="flex flex-col items-center lg:w-[80%] border-[1px] border-[#D2D2D2] rounded-lg bg-[#F8F8F8]">
                        <div id="titleFiltre" class="flex flex-col items-center space-x-2 py-2">
                            <h1 class="text-4xl text-semibold">
                                Commentaires
                            </h1>
                            <p>
                                <span class="w-[130px]">Filtrer les commentaires de chaque utilisateurs par articles.</span>
                            </p>
                        </div>
                        <div id="containerFiltreUsers"></div>
                        <div class="h-[250px] overflow-scroll ">
                            <div id="containerUsers" class="w-full pt-2"></div>
                        </div>
                    </div>
                </section>
                <section class="flex justify-center hidden" id="displayArticles">
                    <div id="divContainerArticles" class="flex flex-col lg:my-[3%] lg:w-[80%] border-[1px] border-[#D2D2D2] rounded-lg bg-[#F8F8F8]">
                        <div id="titleArticles" class="flex flex-col items-center space-x-2 py-2">
                            <h1 class="text-4xl text-semibold">
                                Articles
                            </h1>
                            <p>
                                <span class="w-[130px]">Ici, vous pouvez supprimer les articles.</span>
                            </p>
                        </div>
                        <div class="flex flex-col item-center">
                            <div id="containerArticles" class="flex justify-center"></div>
                            <div id="DisplayerArticles" class="w-full h-[400px] rounded-lg"></div>
                        </div>
                    </div>
                </section>
            </article>
        </main>
    </body>
    </html>

<?php else: header('Location: ../index.php');   exit; ?>

<?php endif; ?>
