<?php ob_start(); ?>

<p>
    <a href="index.php">Retour aux commentaires</a>
</p>

<h2>Modifier le commentaire</h2>

<form action="index.php?action=editComment&amp;id=<?= $comment['id'] ?>" method="post">
    <div>
        <p>Auteur :
            <?= $comment['author'] ?>
        </p>
        <label for="comment">Commentaire</label>
        <br />
        <textarea id="comment" name="comment"><?= $comment['comment'] ?></textarea>
    </div>
    <div>
        <input type="submit" value="Modifier" />
    </div>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php');
