<?php

  //error_reporting(E_ALL);

  include_once dirname(__FILE__).'/filter.class.php';  
  include_once dirname(__FILE__).'/error.class.php';

  class captcha
  {

    public $Length;
    public $CaptchaString;
    public $fontpath = './fonts/';
    public $fonts;
	public $sCoockieName = "cryptcookie";
	public $cryptwidth  = 120;  	// Largeur du cryptogramme (en pixels)
	public $cryptheight = 40;   	// Hauteur du cryptogramme (en pixels)
	public $bgR  = 255;         	// Couleur du fond au format RGB: Red (0->255)
	public $bgG  = 255;         	// Couleur du fond au format RGB: Green (0->255)
	public $bgB  = 255;         	// Couleur du fond au format RGB: Blue (0->255)
	public $bgclear = true;    	// Fond transparent (true/false)
                     			// Uniquement valable pour le format PNG
	public $bgimg = '';            // Le fond du cryptogramme peut-etre une image PNG, GIF ou JPG. Indiquer le fichier image
                             	// Exemple: $fondimage = 'photo.gif'; (L'image sera redimensionnee si necessaire pour tenir dans le cryptogramme.)
                             	// Si vous indiquez un repertoire plutot qu'un fichier l'image sera prise au hasard parmi celles disponibles dans le repertoire
	public $bgframe = true;    	// Ajoute un cadre a l'image (true/false)

			// ----------------------------
			// Configuration des caracteres
			// ----------------------------

								// Couleur de base des caracteres
	public $charR = 0;     		// Couleur des caracteres au format RGB: Red (0->255)
	public $charG = 0;     		// Couleur des caracteres au format RGB: Green (0->255)
	public $charB = 0;     		// Couleur des caracteres au format RGB: Blue (0->255)
	public $charcolorrnd = true;   // Choix aleatoire de la couleur.
	public $charcolorrndlevel = 2; // Niveau de clarte des caracteres si choix aleatoire (0->4)
                           		// 0: Aucune selection
                           		// 1: Couleurs tres sombres (surtout pour les fonds clairs)
                           		// 2: Couleurs sombres
                           		// 3: Couleurs claires
                           		// 4: Couleurs tres claires (surtout pour fonds sombres)
	public $charclear = 0;   		// Intensite de la transparence des caracteres (0->127)
                  				// 0=opaques; 127=invisibles
	public $charel = 'ABCDEFGHKLMNPRTWXYZ234569';       	// Caracteres autorises
	public $charspace = 22;        						// Espace entre les caracteres (en pixels)
	public $charsizemin = 20;      						// Taille minimum des caracteres
	public $charsizemax = 22;      						// Taille maximum des caracteres
	public $charanglemax  = 0;     						// Angle maximum de rotation des caracteres (0-360)
	public $charup   = true;        						// Deplacement vertical aleatoire des caracteres (true/false)

	public $cryptgaussianblur = false; 						// Transforme l'image finale en brouillant: methode Gauss (true/false) uniquement si PHP >= 5.0.0
	public $cryptgrayscal = false;     						// Transforme l'image finale en degrade de gris (true/false) uniquement si PHP >= 5.0.0

			// ----------------------
			// Configuration du bruit
			// ----------------------
	public $noisepxmin = 0;      		// Bruit: Nb minimum de pixels aleatoires
	public $noisepxmax = 400;      	// Bruit: Nb maximum de pixels aleatoires
	public $noiselinemin = 0;     		// Bruit: Nb minimum de lignes aleatoires
	public $noiselinemax = 10;     	// Bruit: Nb maximum de lignes aleatoires
	public $nbcirclemin = 0;      		// Bruit: Nb minimum de cercles aleatoires 
	public $nbcirclemax = 0;      		// Bruit: Nb maximim de cercles aleatoires
	public $noisecolorchar  = 3;  		// Bruit: Couleur d'ecriture des pixels, lignes, cercles: 
	                       			// 1: Couleur d'ecriture des caracteres
	                       			// 2: Couleur du fond
	                       			// 3: Couleur aleatoire                       
	public $brushsize = 1;        		// Taille d'ecriture du princeaiu (en pixels) 
	                       			// de 1 a 25 (les valeurs plus importantes peuvent provoquer un 
	                       			// Internal Server Error sur certaines versions de PHP/GD)
	                       			// Ne fonctionne pas sur les anciennes configurations PHP/GD
	public $noiseup = false;      		// Le bruit est-il par dessus l'ecriture (true) ou en dessous (false) 

			// --------------------------------
			// Configuration systeme & securite
			// --------------------------------

	public $cryptformat = "png";   	// Format du fichier image genere "GIF", "PNG" ou "JPG"
	public $cryptsecure = "md5";   	// Methode de crytpage utilisee: "md5", "sha1" ou "" (aucune)                       
	public $cryptusetimer = 0;        	// Temps (en seconde) avant d'avoir le droit de regenerer un cryptogramme
	public $cryptusertimererror = 3;  	// Action a realiser si le temps minimum n'est pas respecte:
	                           		// 1: Ne rien faire, ne pas renvoyer d'image.
	                           		// 2: L'image renvoyee est "images/erreur2.png" (vous pouvez la modifier)
	                           		// 3: Le script se met en pause le temps correspondant (attention au timeout
	                           		//    par defaut qui coupe les scripts PHP au bout de 30 secondes)
	                           		//    voir la variable "max_execution_time" de votre configuration PHP
	public $cryptusemax = 1000;  		// Nb maximum de fois que l'utilisateur peut generer le cryptogramme
	                      			// Si depassement, l'image renvoyee est "images/erreur1.png"
	                      			// PS: Par defaut, la duree d'une session PHP est de 180 mn, sauf si 
	                      			// l'hebergeur ou le developpeur du site en ont decide autrement... 
	                      			// Cette limite est effective pour toute la duree de la session. 
	                      
	public $cryptoneuse = false;  		// Si vous souhaitez que la page de verification ne valide qu'une seule fois la saisie en cas de rechargement de la page indiquer "true".
	                       			// Sinon, le rechargement de la page confirmera toujours la saisie.                          
    

	
	public function __construct()
    {
    	session_start();
    	header('Content-type: image/'.$this->cryptformat);
    	SetCookie($this->sCoockieName, "1");
    	$_SESSION['cryptcptuse'] = 0;
    }

    
    public function captcha ($length = 6)
    {
      header('Content-type: image/'.$this->cryptformat);
      
      $this->Length   = $length;      
      $this->fontpath = dirname(__FILE__).'/fonts/';
      //$this->fontpath = 'libs/fonts/';      
      $this->fonts    = $this->getFonts();
      $errormgr       = new error();

      if ($this->fonts == FALSE)
      {
      	//$errormgr = new error;
      	$errormgr->addError('No fonts available!');
      	$errormgr->displayError();
      	die();      	
      }

      if (function_exists('imagettftext') == FALSE)
      {
        $errormgr->addError('');
        $errormgr->displayError();
        die();
      }
      $this->stringGen();
      $this->makeCaptcha();  
    } //captcha
    
    
    private function getFonts ()
    {    
      $fonts = array();
          
      if ($handle = @opendir($this->fontpath)){   
        while (($file = readdir($handle)) !== FALSE){       
          $extension = strtolower(substr($file, strlen($file) - 3, 3));
       
          if ($extension == 'ttf'){ $fonts[] = $file; }        
        }        
        closedir($handle);
      }else{ return FALSE; }
            
      if (count($fonts) == 0){ return FALSE; }else{ return $fonts; }    
    } //getFonts
    
    
    private function getRandFont ()
    {    
      return $this->fontpath . $this->fonts[mt_rand(0, count($this->fonts) - 1)];    
    } //getRandFont
    
    

    private function stringGen ()
    {
      $CharPool   = str_split($this->charel);
      $PoolLength = count($CharPool) - 1;

      for ($i = 0; $i < $this->Length; $i++)
      {
        $this->CaptchaString .= $CharPool[mt_rand(0, $PoolLength)];
      }
    } //StringGen

    private function makeCaptcha ()
    {
      $imagelength = $this->Length * 25 + 16;
      $imageheight = $this->cryptheight;
      $image       = imagecreate($imagelength, $imageheight);
      
      $bgcolor = imagecolorallocate($image, $this->bgR, $this->bgG, $this->bgB);


      $stringcolor = imagecolorallocate($image, $this->charR, $this->charG, $this->charB);
      $filter      = new filters;

      //$filter->signs($image, $this->getRandFont());

      for ($i = 0; $i < strlen($this->CaptchaString); $i++)
      {      
        imagettftext($image, $this->charsizemin, mt_rand(0, 15), $i * 25 + 10,
                     mt_rand($this->charsizemin,$imageheight), //$imagelength $imageheight
                     $stringcolor,
                     $this->getRandFont(),
                     $this->CaptchaString{$i});      
      }

      if($this->noiseup){$filter->noise($image, 4);}
      if($this->cryptgaussianblur){$filter->blur($image, 2);}
      if($this->cryptgrayscal){ imagefilter ( $image,IMG_FILTER_GRAYSCALE);}
      
      switch (strtoupper($this->cryptsecure)) {    
       case "MD5"  : $_SESSION['cryptcode'] = md5($this->CaptchaString); break;
       case "SHA1" : $_SESSION['cryptcode'] = sha1($this->CaptchaString); break;
       default     : $_SESSION['cryptcode'] = $this->CaptchaString; break;
      }
			$_SESSION['crypttime'] = time();
			$_SESSION['cryptcptuse']++;       
      
      // Envoi de l'image finale au navigateur 
	  switch (strtoupper($this->cryptformat)) {  
       case "JPG"  :
	     case "JPEG" : if (imagetypes() & IMG_JPG)  {
                        imagejpeg($image, "", 80);
                        }
                     break;
	     case "GIF"  : if (imagetypes() & IMG_GIF)  {
                        imagegif($image);
                        }
                     break;
	     case "PNG"  : 
	     default     : if (imagetypes() & IMG_PNG)  {
								if($this->bgclear){imagecolortransparent($image, $bgcolor);}
                                imagepng($image);
                        }
       }

		imagedestroy ($image);
		unset ($_SESSION['cryptreload']);
		/*
      imagepng($image);      
      imagedestroy($image);
      */
    } //MakeCaptcha

    private function getCaptchaString ()
    {
      return $this->CaptchaString;
    } //GetCaptchaString
    
  } //class: captcha

?>
