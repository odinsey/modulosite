<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $PARAM_hote = 'localhost'; // le chemin vers le serveur
        $PARAM_port = '3306';
        $PARAM_nom_bd = 'modulosite'; // le nom de votre base de données
        $PARAM_utilisateur = 'modulosite'; // nom d'utilisateur pour se connecter
        $PARAM_mot_passe = 'fCe2KxdrdTnLEDLm'; // mot de passe de l'utilisateur pour se connecter
        try {
            $connexion = new PDO('mysql:host=' . $PARAM_hote . ';dbname=' . $PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
        }
        ?>
    </body>
</html>
