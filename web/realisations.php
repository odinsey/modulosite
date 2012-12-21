<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Coraloisirs - Réalisations - Fabricant de constructions en bois, Abris de jardin, Chalets - Orléans et Saint Denis en VAL</title>
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
	            <img src="images/titres/realisations.jpg" alt="CoraLoisir - Réalisations" width="904" height="57" />
            <!-- InstanceEndEditable -->
            </h1>
            <!-- InstanceBeginEditable name="Contenu" -->
            <script type="text/javascript">
                var title_element = 'h2';
                var desc_element = 'p';
                var html = '';
                jQuery(document).ready(function(){
                    jQuery.getJSON('/app.php/gallery.json', function(data){
                        jQuery.each(data, function(i, gallery) {
                            html += '<div class="actualite-gauche"><div class="vignette-actualites">';
                            jQuery.each(gallery['pictures'], function(i, picture) {
                               html += '<a href="'+picture['imgfull']+'" title="'+picture['title']+'" rel="shadowbox['+gallery['title']+']"></a>';
                               if(i==0){
                                    html += '<img src="'+picture['imgmedium']+'" alt="'+picture['title']+'" /></div>';
                               }
                            });
                            html += '</div><div class="actualites-droite">';
                            html += '<'+title_element+'>'+gallery['title']+'</'+title_element+'>';
                            html += '<'+desc_element+'>'+gallery['description']+'</'+desc_element+'>';
                            html += '</div>';
                        });
                        jQuery('#galleries')).html(html);
                    });
                });
            </script>
            <div id="galleries"></div>
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
