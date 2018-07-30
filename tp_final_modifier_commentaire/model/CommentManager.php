<?php
//gestionnaire de commentaire :
namespace OpenClassrooms\Blog\Model;

//lien pour la class Manager dont hérite la class CommentManager :
require_once("model/Manager.php");

//pour gérer les commentaires :
class CommentManager extends Manager
{
    public function getComments($postId)//récupère les commentaires associés à un ID de post.
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)//insérer un commentaire :
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function getComment($id)//obtenir un commentaire selon un id donné:
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $req->execute(array($id));
        $comment = $req->fetch();
 
        return $comment;
    }
 
 
    public function updateComment($id, $comment)//modifier un commantaire :
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?');
        $newComment = $req->execute(array($comment, $id));
 
        return $newComment;
    }
}
