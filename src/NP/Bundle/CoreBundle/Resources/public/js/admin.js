jQuery(document).ready(function(){
	jQuery('.form-horizontal .entity-collections .collection-field-row:before').css({
		'content': jQuery('input:first',this).val()
	});
//	jQuery('.collection-field-row > div').hide();
//	jQuery('.collection-field-row').bind('click',function(){
//		jQuery(this).children('div').show();
//		jQuery('.collection-field-row').not(this).children('div').hide();
//	});
	jQuery('input.colorpicker').colorpicker().on('changeColor', function(ev){
		jQuery(this).css( 'background-color', ev.color.toHex() );
	});;
});