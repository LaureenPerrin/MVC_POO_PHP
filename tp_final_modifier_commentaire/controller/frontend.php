<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()//affiche la liste des posts :
{
    //intanciation objet $postManager :
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    //instanciation objet $post pour l'utiliser dans listPostsView :
    $posts = $postManager->getPosts();//récupère tous les derniers posts de blog :

    require('view/frontend/listPostsView.php');
}

function post()//affiche un post :
{
    //intanciation objet $postManager :
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    //intanciation objet $commentManager :
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    //instanciation des objets $post et $comment pour les utiliser dans postView :
    $post = $postManager->getPost($_GET['id']);//récupère un post précis en fonction de son id :
    $comments = $commentManager->getComments($_GET['id']);//récupère les commentaires associés à un ID de post.

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)//ajout un commentaire :
{
    //intanciation objet $commentManager :
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    
    //intanciation objet $affectedLines :
    $affectedLines = $commentManager->postComment($postId, $author, $comment);//insérer un commentaire :
    
    //si l'objet est false alors on lève un exception :
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        //sinon on redirige vers le début de cette action :
        header('Location: index.php?action=post&id=' . $postId);
    }
}

/*function editComment($comment, $idComment)
{
    //intanciation objet $commentManager :
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    //intanciation objet $affectedLines :
    $affectedComment = $commentManager->changeComment($comment, $idComment);//modifier un commentaire :

    require('view/frontend/editCommentView.php');
}*/
function editViewComment()
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $comment = $commentManager->getComment($_GET['id']);
 
    require('view/frontend/editCommentView.php');
}
 
 
function editComment($id, $comment)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
 
    $newComment = $commentManager->updateComment($id, $comment);
 
    if ($newComment === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    } else {
        echo 'commentaire : ' . $_POST['comment'];
        header('Location: index.php?action=listPosts&id=' . $id);
    }
}
