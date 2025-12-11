<?php require_once 'connection_bdd.php' ?>

<?php

$cols = [[],[],[],[]];
$compteur = -1;

if ($isConnected) {
    $stmt = $mysqlConnection->prepare("SELECT contenus.id, contenus.description, contenus.chemin_image, COUNT(DISTINCT likes.id_utilisateur) FROM contenus JOIN utilisateurs ON utilisateurs.id = contenus.id_utilisateur LEFT JOIN likes ON likes.id_contenu = contenus.id WHERE utilisateurs.pseudo = ? GROUP BY contenus.id");
    $stmt->execute([$username]);
    $list_contenu = $stmt->fetchAll();

    for ($i=0 ; $i < count($list_contenu);$i++) {
        $compteur = $i % 4; // cycle sur 4 colonnes

    $cols[$compteur][] = "<li class=\"post\">"
        . "<div class=\"header-post\">"
        . "<a href=\"#\" class=\"username\">"
        . "<img class=\"pfp\" src=\"../image/pfp-ulysse.jpg\" alt=\"photo-profil\">"
        . "<strong>".$username."</strong></a>"
        . "</div>"
        . "<a href=\"generic-contenu.php?id_post=".$list_contenu[$i][0]."\">"
        . "<img class=\"post-image\" src=\"../images-post/".$list_contenu[$i][2]."\" alt=\"".$list_contenu[$i][2]."\">"
        . "</a>"
        . "<div class=\"contenu\">"
        . "<a href=\"../php/add_like.php?id_post=".$list_contenu[$i][0]."\" class=\"button-like-partage\">"
        . "<img class=\"like1 like-partage\" src=\"../image/like-vide.png\" alt=\"like-partage\">"
        . "</a>"
        . "<a href=\"add-contenu.php\" class=\"button-like-partage\">"
        . "<img class=\"like-partage\" src=\"../image/partage.png\" alt=\"like-partage\">"
        . "</a>"
        . "<hr>"
        . "<p class=\"showaime\"><strong>nombres de likes : </strong>".$list_contenu[$i][3]."</p>"
        . "<hr>"
        . "<p class=\"description\"><strong>description :</strong> ".$list_contenu[$i][1]."</p>"
        . "<hr>";

    // récupérer les commentaires du post courant
    $post_id = $list_contenu[$i][0];
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
        . "<form action=\"../php/post_comment.php?post_id=".$post_id."\" method=\"post\" class=\"formulaire\">"
        . "<textarea class=\"inputcom\" name=\"commente\" id=\"sendcommentaire\" placeholder=\"Qu'en pense tu ? donne ton avis !\"></textarea>"
        . "<button type=\"submit\" class=\"send\"><img class=\"commenter\" src=\"../image/commenter.png\" alt=\"commenter\"></button>"
        . "</form>"
        . "</div>"
        . "</li>";
    }
    $final = '';
    $compteur = -1;

    while ($cols != [[],[],[],[]]) {
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