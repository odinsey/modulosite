// JavaScript Document

$(document).ready(function(){
						   
	Shadowbox.init({
		animate: "false",
		continuous: "true",
		counterType: "skip",
		enableKeys: "false",
		overlayColor: "#000000",
		slideshowDelay:"4",
		overlayOpacity: 0.9,
		players: ["img", "swf" , "html" , "php"],
		flashParams: { bgcolor: '#ffffff' }
	});
						   
// Paragraphe-On-Off

	$(".paragrapheOnOff").addClass("close");
	$(".close").next().hide();
	
	$(".paragrapheOnOff").each(function(){
		$(this).click(function(){
			
			if ($(this).hasClass("close")){			
				$(this).removeClass("close").addClass("open");
				$(".paragrapheOnOff").not(this).removeClass("open").addClass("close");
			}
			else{
				$(this).removeClass("open").addClass("close");
			}
			
			$(".close").next().hide("slow");
			$(".open").next().show("slow");
			
		});	
	});


// Lire la suite

	$(".lire-suite").addClass("actu-masquee");
	$(".actu-masquee").next().hide();
	
	$(".lire-suite").each(function(){
		$(this).click(function(){
			
			if ($(this).hasClass("actu-masquee")){			
				$(this).removeClass("actu-masquee").addClass("actu-visible");
				$(".lire-suite").not(this).removeClass("actu-visible").addClass("actu-masquee");
			}
			else{
				$(this).removeClass("actu-visible").addClass("actu-masquee");
			}
			
			$(".actu-masquee").next().hide("slow");
			$(".actu-visible").next().show("slow");
			
		});	
	});

// Scrolling 

	$(document).ready(function(){
		$("html,body").animate({scrollTop:$("#header").offset().top+0},1000);
	});

}); //ready

