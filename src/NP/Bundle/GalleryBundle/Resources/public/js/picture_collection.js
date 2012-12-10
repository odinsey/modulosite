/************
 DEBUT DU SCRIPT POUR LE DRAG'N'DROP
 ************/
jQuery(document).ready(function() {
    var ul = jQuery("#list-photos");
    ul.sortable({
	placeholder: 'highlight',
	update: function() {
	    jQuery('li', this).each(function(i){
		jQuery("input[id$=_position]", this).val(i);
	    });
	}
    });
    jQuery("#list-photos").disableSelection();
});
