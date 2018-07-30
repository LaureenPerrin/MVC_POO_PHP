<?php

namespace OpenClassrooms\Blog\Model;

class Manager //implémentaion de la class Manager pour factorisation du code car $db commun aux deux managers (CommentManager et PostManager):
{
    protected function dbConnect()//connexion à la bdd :
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'laureenperrin', 'Gnite2932');
        return $db;
    }
}
