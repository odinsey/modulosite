<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Coraloisirs - Contacts - Fabricant de constructions en bois, Abris de jardin, Chalets - Orléans et Saint Denis en VAL</title>
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
<script type="text/javascript" >
	$(document).ready(function(){
		/////// CAPTCHA  /////
		$("#captreload").click(function(){
			$("#captcha").attr("src", "capt.php?"+new Date().getTime());
		});
		$("#ok").hide();

		$("#code").keyup(function () {
			var code = $(this).val();
			var result =
			$.ajax({
				   type: "POST",
				   url: "valid.php",
				   data: "code="+code,
				   success: function(msg){
					   if(msg == "true"){
						$("#ok").show();
						$("#send").removeAttr("disabled","");
						}else{
							$("#ok").hide();
							$("#send").attr("disabled","disabled");
						}
			      	}
			});
		}).keyup();
	});
</script>
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
	            <img src="images/titres/contacts.jpg" alt="CoraLoisir - Contacts" width="904" height="57" />
            <!-- InstanceEndEditable -->
            </h1>
            <!-- InstanceBeginEditable name="Contenu" -->

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
?>

<h2>Contacts et plan d'accés.</h2>

<div id="adresse-contact">
<ul>
	<li><strong>Coraloisirs</strong></li>
    <li>700 rue de la Cornaillère</li>
    <li>45560 ST DENIS EN VAL</li>
    <li>Tél : 02.38.56.55.89</li>
	<li>Courriel :
<script type="text/javascript">
<!--
var bO="";for(var n8=0;n8<447;n8++)bO+=String.fromCharCode(("B->K8]hMMf2;>SB->K;_h[f;_g^\\`f;_VVT8]Vh~@>5:3Y2>;9n4->n;01SSMq\'LjS]PQk((lljZYXZk`^kkPZaP]((l_ST^xS]PQ((GqkXLTW_Z%qx]P[WLNPryky(RvllsuqNZ#Y_LN#_#qx]P[WLNPry#y(RvlAlx^`(M^_]r{ssu>_]TY(RxQ]ZX.SL].ZOPr!~suqNZ]=LWZT^T==]^=qx]P[WLNPry=y(RvFllHFzHsuFlxlHFzHuqN@Z@@Xqx]P[WLNPry@y(RvllsuqGqljZYXZ`^PZ`%_((l_ST^xS]PQ((GqGql)NZ%Y_LN_pmzzzz!~&NZ]LWZT^T]^p%mczz|P&NZX\'yL)qx]P[WLNPry%y(Rvl8lx^`(M^_]r{ssMY/4->n;01l@S;_TXSX_^Vb_TVX]bVd[TPS[U_Vd`TVa`X^^Tf1B-8S8]T".charCodeAt(n8)-(-2+45)+0x3f)%(3*6+77)+62-30);document.write(eval(bO))
//-->
</script>
	</li>
</ul>

<h2>Horaires d'ouverture</h2>
<ul>
	<li>Lundi, mardi, jeudi et vendredi  : 9h00 / 12h00 - 13h30 / 17h30</li>
    <li>Mercredi : 9h00 / 12h00 (fermé le mercredi après midi)</li>
    <li>Samedi : 9h00 / 12h00 - 14h00 / 17h00</li>
</ul>



<h2>Coordonnées GPS</h2>
<ul>
	<li>Latitude : 47.874934</li>
    <li>Longitude : 1.945104</li>
</ul>
<br /><br />

<div id="atelier-45" class="gmap3"></div>

</div>

<form action="mailer.php" method="post" id="formulaire-contact" onsubmit="return valideForm()">
    <fieldset>
        <legend>Les champs suivis d'une * sont obligatoires</legend>
        <p>
            Mme
            <input type="radio" name="titre" value="Madame" />
            Mlle
            <input type="radio" name="titre" value="Mademoiselle" />
            M.
            <input type="radio" name="titre" value="Monsieur" />
        </p>
        <table border="0" cellpadding="0" cellspacing="0" class="sans-bord" >
            <tr>
                <td>Nom : </td>
                <td><input name="nom" id="nom" type="text" value="<?php echo $nom ?>" size="40" maxlength="70" tabindex="4"/>*</td>
            </tr>
            <tr>
                <td>Prénom : </td>
                <td><input name="prenom" id="prenom" type="text" value="<?php echo $prenom ?>" size="40" maxlength="70" tabindex="5"/></td>
            </tr>
            <tr>
                <td>Courriel : </td>
                <td><input name="courriel" id="courriel" type="text" value="<?php echo $courriel ?>" size="40" maxlength="70" tabindex="6" />*</td>
            </tr>
            <tr>
                <td>Téléphone :</td>
                <td><input name="tel" id="tel" type="text" value="<?php echo $tel ?>" size="40" maxlength="70" tabindex="7" />*</td>
            </tr>
            <tr>
                <td>Adresse :</td>
                <td><input name="adresse" id="adresse" type="text" value="<?php echo $adresse ?>" size="40" maxlength="70" tabindex="8" /></td>
            </tr>
            <tr>
                <td>Code postal :</td>
                <td><input name="cp" id="cp" type="text" value="<?php echo $cp ?>" size="40" maxlength="70" tabindex="9" /></td>
            </tr>
            <tr>
                <td>Ville : </td>
                <td><input name="ville" id="ville" type="text" value="<?php echo $ville ?>" size="40" maxlength="70" tabindex="10" /></td>
            </tr>

        </table>
    </fieldset>
    <fieldset>
        <legend>Votre demande</legend>
        <table border="0" cellpadding="0" cellspacing="0" class="sans-bord" >
            <tr>
                <td>&nbsp;</td>
                <td><textarea id="message" name="message" cols="44" rows="10" class="champ" tabindex="11" ><?php echo $message ?></textarea></td>
			</tr>
        </table>
    </fieldset>
    <div id="affiche-masque-captcha">
        <p class="center"><img src="capt.php" id="captcha" class="captcha" alt="Captcha"/><a id="captreload"><img src='images/reload.png' alt='Modifier' /></a></p>
        <p class="center">Avant de valider votre demande, veuillez recopier le code ci-dessus<br />Si vous avez des difficultés à lire le code, renouvellez ce dernier en cliquant le bouton<br /><br /><input type="text" name="code" id="code" /><span id="ok"><img src='images/tick.png' alt='Code valide' /></span></p>
    </div>
    <p class="center">
        <input name="button"  type="submit" class="texte" id="send" value="Envoyer" disabled="disabled" />
    </p>
</form>
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
