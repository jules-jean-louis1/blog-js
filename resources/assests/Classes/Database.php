<?php

class Database
{
   private $bdd;
   public function __construct()
   {
       // Connexion a la base de données LOCAL
       /*try {
           $this->bdd = new PDO('mysql:host=localhost;dbname=blog-js;charset=utf8', 'root', '');
           $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch (PDOException $e) {
           echo 'Connexion échouée : ' . $e->getMessage();
           exit;
       }*/
       // Connexion a la base de données PLESK
       try {
           $this->bdd = new PDO('mysql:host=localhost;dbname=jules-jean-louis_blog-js;charset=utf8', 'blog-js', 'Viq1e172@');
           $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch (PDOException $e) {
           echo 'Connexion échouée : ' . $e->getMessage();
           exit;
       }

   }
   public function getBdd()
   {
       return $this->bdd;
   }
}