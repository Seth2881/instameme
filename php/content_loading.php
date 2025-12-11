<?php require_once 'session_check.php' ?>

<?php require_once 'connection_bdd.php' ?>

<?php
$id = $_SESSION['id'];
$username = $_SESSION['pseudo'];

$cols = [[],[],[]];
$compteur = -1;

if ($isConnected) {
    $stmt = $mysqlConnection->prepare("SELECT utilisateurs.pseudo,contenus.id, contenus.description,contenus.chemin_image ,COUNT(DISTINCT likes.id_utilisateur) FROM contenus JOIN utilisateurs ON utilisateurs.id = contenus.id_utilisateur LEFT JOIN likes ON likes.id_contenu = contenus.id GROUP BY contenus.id, contenus.description, utilisateurs.pseudo");
    $stmt->execute();
    $list_contenu = $stmt->fetchAll();

    shuffle($list_contenu);

    for ($i=0 ; $i < count($list_contenu);$i++) {
        $compteur = $i % 3; // cycle sur 3 colonnes

    $cols[$compteur][] = "<li class=\"post\">"
        . "<div class=\"header-post\">"
        . "<a href=\"page/generic-user.php?pseudo=".$list_contenu[$i][0]."\" class=\"username\">"
        . "<img class=\"pfp\" src=\"image/pfp-ulysse.jpg\" alt=\"photo-profil\">"
        . "<strong>".$list_contenu[$i][0]."</strong></a>"
        . "</div>"
        . "<a href='page/generic-contenu.php?id_post=".$list_contenu[$i][1]."'>"
        . "<img class=\"post-image\" src=\"images-post/".$list_contenu[$i][3]."\" alt=\"".$list_contenu[$i][3]."\">"
        . "</a>"
        . "<div class=\"contenu\">"
        . "<a href=\"php/add_like.php?id_post=".$list_contenu[$i][1]."\" class=\"button-like-partage\">"
        . "<img class=\"like1 like-partage\" src=\"image/like-vide.png\" alt=\"like-partage\">"
        . "</a>"
        . "<a href=\"page/add-contenu.php\" class=\"button-like-partage\">"
        . "<img class=\"like-partage\" src=\"image/partage.png\" alt=\"like-partage\">"
        . "</a>"
        . "<hr>"
        . "<p class=\"showaime\"><strong>nombres de likes : </strong>".$list_contenu[$i][4]."</p>"
        . "<hr>"
        . "<p class=\"description\"><strong>description :</strong> ".$list_contenu[$i][2]."</p>"
        . "<hr>";

    // récupérer les commentaires du post courant
    $post_id = $list_contenu[$i][1];
    $stmt = $mysqlConnection->prepare("
        SELECT commentaires.message, utilisateurs.pseudo
        FROM commentaires
        JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur
        WHERE commentaires.id_contenu = ?
        ORDER BY commentaires.id ASC
    ");
    $stmt->execute([$post_id]);
    $list_commentaire = $stmt->fetchAll();

    foreach ($list_commentaire as $commentaire) {
        $cols[$compteur][count($cols[$compteur])-1] .= "<p class=\"com\"><strong>".$commentaire['pseudo']." : </strong>".$commentaire['message']."</p>";
    }

    $cols[$compteur][count($cols[$compteur])-1] .= "<hr>"
        . "<form action=\"php/post_comment.php?post_id=".$post_id."\" method=\"post\" class=\"formulaire\">"
        . "<textarea class=\"inputcom\" name=\"commente\" id=\"sendcommentaire\" placeholder=\"Qu'en pense tu ? donne ton avis !\"></textarea>"
        . "<button type=\"submit\" class=\"send\"><img class=\"commenter\" src=\"image/commenter.png\" alt=\"commenter\"></button>"
        . "</form>"
        . "</div>"
        . "</li>";
    }
    $final = '';
    $compteur = -1;

    while ($cols != [[],[],[]]) {
        $compteur += 1;
        $final .= '<ul class="colonne">';
        for ($i=0 ; $i<count($cols[$compteur]) ; $i++){
            $final .= $cols[$compteur][$i];
        }
        $cols[$compteur] = [];
        $final .= '</ul>';
    }
    echo $final;
}
?>