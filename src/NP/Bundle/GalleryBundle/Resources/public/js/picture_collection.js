/************
DEBUT DU SCRIPT POUR LE DRAG'N'DROP
************/
jQuery(document).ready( function(){
  jQuery("#list-photos").sortable({
		placeholder: 'highlight',
		update: function() {
			var order = jQuery('#list-photos').sortable('serialize');
			console.info(order);
		}
	});
  jQuery("#list-photos").disableSelection();
});
