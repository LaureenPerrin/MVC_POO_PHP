<?php
//gestionnaire de post de blog :
namespace OpenClassrooms\Blog\Model;

//lien pour la class Manager dont hérite la class PostManager :
require_once("model/Manager.php");

//pour gérer les posts :
class PostManager extends Manager
{
    public function getPosts()//récupère tous les derniers posts de blog :
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId)//récupère un post précis en fonction de son id :
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
}
