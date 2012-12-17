<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Coraloisirs - Merci - Fabricant de constructions en bois, Abris de jardin, Chalets - Orléans et Saint Denis en VAL</title>
<!-- InstanceEndEditable -->
<meta name="description" content="Fabricant de constructions en bois. Abris de jardin, Chalets de loisirs, garages, appentis, préaux, buchers, abris bus, Orléans, Saint Denis en VAL." />
<meta name="language" content="FR" />
<meta name="site-languages" content="French" />
<meta name="Content-Language" content="fr-FR" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css" />
<link rel="icon" type="image/ico" href="images/favicon.ico" />
<script src="scripts/veriform.js" type="text/javascript"></script>
<script src="scripts/jquery.1.8.3.min.js" type="text/javascript"></script>
<script type="text/javascript" src="shadowbox/shadowbox.js"></script>
<script type="text/javascript" src="scripts/routines.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript" src="scripts/gmap3.js"></script> 
<script type="text/javascript" src="scripts/gmap3-include.js"></script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
	<div id="ombre-wrapper">
    	<div id="menu">
        	<ul>
            	<li id="logo"><a href="index.php"></a></li>
            	<li id="menu-produits"><a href="produits.php"></a></li>
                <li id="menu-histoirique"><a href="historique.php"></a></li>
                <li id="menu-savoir"><a href="savoir-faire.php"></a></li>
                <li id="menu-realisations"><a href="realisations.php"></a></li>
			</ul>                
        </div>
		<div id="header">
            <object type="application/x-shockwave-flash" data="swf/coraloisir-slide.swf" width="1067" height="446">
            <param name="movie" value="swf/coraloisir-slide.swf" />
            <param name="allowFullScreen" value="true" />
            <param name="wmode" value="transparent" />
            <img src="images/header.png" width="1067" height="446" alt="Coraloisirs - Abris de jardin - Orléans, Saint Denis en VAL" />
            </object>
        </div>            
	</div> 
    <div id="site">   
    	<div id="menu2">
        	<ul>
            	<li id="menu-actualites"><a href="index.php"></a></li>
                <li id="menu-livre"><a href="livre-or.php"></a></li>
                <li id="menu-contact"><a href="contacts.php"></a></li>
			</ul>                
        </div>
        
        <div id="contenu">
            <h1><!-- InstanceBeginEditable name="Titre" -->
	            <img src="images/titres/savoir-faire.jpg" alt="CoraLoisir - Savoir faire" width="904" height="52" />
            <!-- InstanceEndEditable -->
            </h1>
            <!-- InstanceBeginEditable name="Contenu" -->
<h1>Traitement de votre demande ...</h1>
<br />
<br />

		
			<?php 
			
			$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
			$prenom= isset($_POST['prenom']) ? $_POST['prenom'] : '';
			$courriel= isset($_POST['courriel']) ? $_POST['courriel'] : '';
			$tel= isset($_POST['tel']) ? $_POST['tel'] : '';
			$adresse= isset($_POST['adresse']) ? $_POST['adresse'] : '';
			$cp= isset($_POST['cp']) ? $_POST['cp'] : '';
			$ville = isset($_POST['ville']) ? $_POST['ville'] : '';
			$titre= isset($_POST['titre']) ? $_POST['titre'] : '';			
			$message= isset($_POST['message']) ? $_POST['message'] : '';			
		
			$destinataire = "info@atelier-45.fr";
						
				// APPEL DE LA CLASS MAIL*
				require ("./scripts/class.phpmailer.php");
				
				$sujet = "Contact à partir du site Coraloisirs";
				
				$body = "********** CLIENT(E) **********\n\n";
				
				$body .= "$titre $prenom $nom .\n";
				$body .= "$adresse - $cp - $ville.\n";
				
				if ($tel !="") { $body .= "Téléphone : $tel \n";}
				if ($courriel !="") { $body .= "Courriel : $courriel \n";}
							
				$body .= "\n\n";
							
				$body .= "*********** DEMANDE ***********\n\n";
	
				$body .= "$message .\n";			
			
				$body .= "\n\n";
							
				$body .= "****** FIN DU TRAITEMENT  *****\n\n";	
	
				$body .= "\n\n";						
							
				$mail = new PHPmailer();
				$mail->CharSet="UTF-8";
				$mail->From=$courriel;
				$mail->AddAddress($destinataire);
				$mail->FromName=$nom;
				$mail->AddReplyTo($courriel);	
				$mail->Subject=$sujet;
				$mail->Body=$body;
							
				if(!$mail->Send()){ //Teste le return code de la fonction
				  echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
				}
				else{	  
				  echo 'Votre demande a été envoyée avec succès et sera traitée dans les plus brefs délais.<br /><br />';			  
				}
				$mail->SmtpClose();
				unset($mail);
				
		  	?>
		  	
			<form action="contacts.php" method="POST">    
            	<?php foreach($_POST as $key => $element){
					print "<input type='hidden' name='$key' value='$element' />";
				}?>
			  	<input type="submit" value="Retour au formulaire" id="bouton-envoyer" />
		  	</form>	

            <h2>Accédez aux autres pages du site ...</h2>
            
		<ul class="center">
        	<li><a href="index.php">Actualités</a></li>
        	<li><a href="produits.php">Produits</a></li>
        	<li><a href="historique.php">Historique</a></li>
        	<li><a href="savoir-faire.php">Savoir-faire</a></li>
        	<li><a href="realisations.php">Réalisations</a></li>
        	<li><a href="livre-or.php">Livre d'or</a></li>
        	<li><a href="contacts.php">Contactez-nous</a></li>
        	<li><a href="mentions.php">Mentions légales</a></li>
            <li><a href="reglementation.php">Réglementation</a></li>
		</ul>  	            
            <!-- InstanceEndEditable -->
            <br class="clearer" />
        </div>
        <div id="footer">
            <ul>
                <li id="adresse-coraloisirs"><a href="contacts.php"></a></li>		
                <li id="menu-mentions"><a href="mentions.php"></a></li>	
                <li id="menu-reglementation"><a href="reglementation.php"></a></li>	
<!--                <li id="menu-reglementation"><a href="../reglementation.php"></a></li>	
-->            </ul>            
        </div>
        <div id="w3c">
            <p>
                <a href="http://validator.w3.org/check?uri=referer" onclick="window.open('http://validator.w3.org/check?uri=referer');return false">
                <img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
            </p>
            <p>
                <a href="http://jigsaw.w3.org/css-validator/check/referer" onclick="window.open('http://jigsaw.w3.org/css-validator/check/referer');return false">
                <img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="CSS Valide !" /></a>
            </p>
        </div>        
	</div>        
</body>
<!-- InstanceEnd --></html>
