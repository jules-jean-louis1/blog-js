<?php
session_start();
require_once 'resources/assests/Classes/Articles.php';



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer type="module" src="resources/js/article.js"></script>
    <link rel="stylesheet" href="resources/style/articles.css">
    <title>Article</title>
</head>
<body>
<header class="border-b-[1px] border-[#52586633] bg-white fixed top-0 w-full">
    <?php include_once 'resources/assests/import/header.php' ?>
</header>
<main class="mt-[20%] sm:mt-[5%] lg:mt-[3%]">
    <section>
        <div id="formDisplayer"></div>
    </section>
    <section>
        <div id="containerCreateArticle" class="flex flex-row justify-center items-center lg:py-[2%]">
            <?php if (isset($_SESSION['droits']) && ($_SESSION['droits'] == 'administrateur' || $_SESSION['droits'] == 'moderateur')) { ?>
            <!-- Le code pour afficher l'interface d'écriture d'article -->
            <div id="ContainerWriteArticle" class="flex flex-col lg:flex-row justify-center items-center space-x-2 border-[1px] border-[#0e1217] rounded-lg py-[3px] w-[20%]">
                <div id="titleArticlePage">
                    <h1 class="text-lg ">Ecrire un article</h1>
                </div>
                <div id="btncreeArticle">
                    <button data-modal-target="#modal" type="button" id="buttonCreateArticle"
                            class="p-[6px] text-white bg-[#0e1217] ease-in duration-100  hover:bg-[#2d313a] font-semibold rounded-lg flex items-center">
                            <img src="resources/images/icon/plusRounded.svg" class="filter-white" alt="plusIcon">
                            <span>Article</span>
                    </button>
                </div>
                <div id="containerFormArticle">
                    <div class="modal px-4 py-5 rounded-lg bg-[#fff] w-[85%] border-2 border-slate-200" id="modal">
                        <div id="modal-header" class="flex justify-between items-center">
                            <div id="modal-title">
                                <h3 class="text-2xl font-bold">
                                    <span>Créer un article</span>
                                </h3>
                            </div>
                            <button data-close-button type="button" id="closeModal"
                                    class="text-slate-600 hover:bg-slate-100 rounded-lg font-semibold p-2">
                                Fermer
                            </button>
                        </div>
                        <div class="modal-content">
                            <form action="resources/assests/fetch/createArticle.php" method="post"
                                  id="form-modal-article" enctype="multipart/form-data">
                                <div id="warpperArticleDialog">
                                    <div class="flex flex-col">
                                        <input type="text" name="title" id="title"
                                               class="bg-slate-100 p-2 rounded-t-lg" placeholder="Titre">
                                    </div>
                                    <div class="flex flex-col">
                                                <textarea name="content" id="content" cols="30" rows="10"
                                                          class="bg-slate-100 p-2 rounded-b-lg"
                                                          placeholder="Contenu de l'article"></textarea>
                                    </div>
                                    <div class="flex justify-around py-2">
                                        <div class="flex items-center">
                                            <label for="category" class="font-semibold text-lg">Catégorie -</label>
                                            <select name="category" id="category" class="bg-slate-100 p-2 rounded-lg">
                                            </select>
                                        </div>
                                        <div class="flex items-center">
                                            <label for="image" class="font-semibold text-lg">Image -</label>
                                            <input type="file" name="imageHeader" id="image"
                                                   class="bg-slate-100 p-2 rounded-lg">
                                        </div>
                                    </div>
                                    <div class="h-[45px]">
                                        <div id="errorMsg"></div>
                                    </div>
                                    <div class="flex flex-col py-2">
                                        <button type="submit" id="buttonCreateArticle"
                                                class="p-2 bg-blue-400 rounded-lg text-white">Poster cette Article
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="overlay"></div>
            </div>
        </div>
        <?php } elseif (isset($_SESSION['droits']) && $_SESSION['droits'] == 'utilisateur') { ?>
            <!-- Le code pour afficher un message indiquant que l'utilisateur n'a pas les droits pour écrire un article -->
        <?php } else { ?>
        <?php } ?>
    </section>
    <section>
        <div id="containerArticle">
            <div id="containerSelectCategory" class="flex justify-center items-center">
                <div class="flex flex-col lg:flex-row items-start rounded-lg p-2 lg:space-x-3 border-[1px] border-[#ac1de4]" id="zone_recherche">
                    <form action="" method="post">
                        <div class="flex items-center space-x-2">
                            <input type="search" name="search" id="searchInput"
                                                               placeholder="Rechecher un article" autofocus
                                                               autocomplete="off" required
                                                               class="rounded-lg bg-slate-100 p-2 py-3">
                            <button type="submit" class="p-2 bg-[#ce3df3] rounded-lg">
                                <img src="resources/images/icon/search.svg" class="filter-white">
                            </button>
                        </div>
                        <ul id="results" class="z-index-50 fixed bg-[#FFFFFFF4] rounded-lg min-w-max lg:max-w-[15%] w-full"></ul>
                    </form>
                    <form action="resources/assests/fetch/articles/getArticles.php" method="post" id="FormFilterArticles"
                            >
                        <div class="flex space-x-2">
                            <div class="py-2">
                                <label for="category2" class="font-light text-sm">Filtrer -</label>
                                <select name="category2" id="category2" class="bg-slate-100 p-2 rounded-lg font-light text-sm">
                                    <option value="all">Aucun</option>
                                </select>
                            </div>
                            <div class="py-2">
                                <label for="order" class="font-light text-sm">Date -</label>
                                <select name="order" id="order" class="bg-slate-100 p-2 rounded-lg font-light text-sm">
                                    <option value="DESC">+ récents</option>
                                    <option value="ASC">+ anciens</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="flex justify-center">
        <div id="containerArticlePage" class="w-[98%] mt-[2%] lg:w-[85%] lg:mt-[3%]">
            <div class="">
                <div class="flex flex-row items-center justify-between">
                    <h1 class="text-xl font-bold">Articles</h1>
                    <div id="containerPagination">
                        <div id="Paginations">
                            <ul id="pages" class="flex space-x-2 m-w-[50px]"></ul>
                        </div>
                    </div>
                </div>
                <div id="articlesContainerDisplay" class="flex flex-wrap justify-around"></div>
            </div>
        </div>
    </section>
</main>
<footer>
    <?php include_once 'resources/assests/import/footer.php' ?>
</footer>
</body>
</html>
