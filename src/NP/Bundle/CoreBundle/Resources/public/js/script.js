jQuery(document).ready(function() {

    // Adapt the size of layout
    jQuery(window).on('resize', function() {
       var bcontent = jQuery('#bwrapper .bcontent');
       if (bcontent.length > 0) {
           var width = jQuery('#bwrapper').innerWidth();
           var bsidebar = jQuery('#bwrapper .bsidebar');
           if (bsidebar.length > 0) {
               width -= bsidebar.outerWidth(true);
           }
           bcontent.css('max-width', width);
       }
    });

    // Trigger on time the Window Resize
    jQuery(window).trigger('resize');

    // Twitter Bootstrap 2.0.1 | Alerts
    // ===============================
    jQuery(".alert").alert();

    // Twitter Bootstrap 2.0.1 | Dropdown
    // ===============================
    jQuery('.dropdown-toggle').dropdown();

    // Twitter Bootstrap 2.0.1 | Popover
    // ===============================
    jQuery('a[rel=popover]').popover();

    // Tinymce on textarea
    // Apply Tinymce on all the textarea wich active it
    // ===============================
    var initAllTiny = function(context) {
		jQuery('textarea', context).each(function() {
			var tinymce = new Array();
			tinymce['simple'] = {
				script_url: "/bundles/npcore/js/libs/tiny_mce/tiny_mce.js",
				mode: "textareas",
				theme: "advanced",
				language : "fr",
				theme_advanced_buttons1: "mylistbox,mysplitbutton,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,undo,redo,link,unlink,anchor,image,cleanup,code",
				theme_advanced_buttons2: "",
				theme_advanced_buttons3: "",
				theme_advanced_toolbar_location: "top",
				theme_advanced_toolbar_align: "left",
				theme_advanced_statusbar_location: "bottom",
				plugins: "imagemanager,advimage,advlink,fullscreen",
				theme_advanced_buttons1_add: "fullscreen",
				width : "600",
				height : "300"
			};
			tinymce['advanced'] = {
				script_url: "/bundles/npcore/js/libs/tiny_mce/tiny_mce.js",
				theme: "advanced",
				language : "fr",
				plugins: "imagemanager,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
				theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,cite,abbr,acronym",
				theme_advanced_buttons2: "bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,forecolor,backcolor,|,charmap,emotions,iespell,media,advhr",
				theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,del,ins,|,ltr,rtl",
				theme_advanced_toolbar_location: "top",
				theme_advanced_toolbar_align: "left",
				theme_advanced_statusbar_location: "bottom",
				theme_advanced_resizing: true,
				width : "600",
				height : "300"
			};

			var active = jQuery(this).data('richEditorActive');
			var theme = jQuery(this).data('richEditorTheme');
			theme = ('undefined' != typeof(tinymce[theme]))?theme:'simple';

			if (true == active || 'true' == active) {
				jQuery(this).tinymce(tinymce[theme]);
			}
		});
	},
	removeAllTiny = function(context) {
		jQuery('textarea', context).each(function() {
			var el = jQuery(this);
			if (el.tinymce()) {
				el.tinymce().execCommand('mceRemoveControl', true, this.id);
			}
		});
	}
	initAllTiny(document.body);

    // Twitter Bootstrap
    // add on logic
    // ============
    jQuery('.add-on :checkbox').on('click', function() {
        if (jquery(this).attr('checked')) {
          jQuery(this).parents('.add-on').addClass('active');
        } else {
          jQuery(this).parents('.add-on').removeClass('active');
        }
    });

    // Aside Navigation
    // .toplevelnav
    // Dropdown menu
    // ============
    jQuery('.toplevelnav li.withsubsections > a').on('click', function(event) {
        event.preventDefault();
        var $liParent = jQuery(this).parent();
        if ($liParent.hasClass('open')) {
            $liParent.find('.subsections').slideUp(400, function () {
                $liParent.toggleClass('open');
            });
        } else {
            $liParent.find('.subsections').slideDown(400, function () {
                $liParent.toggleClass('open');
            });
        }
    });

    // Selected all rows in table
    // ============
    jQuery('table').on('change', 'thead .groupCheckbox :checkbox', function() {
        var $table = jQuery(this).parentsUntil('table').parent();
        var selectAll = jQuery(this).is(':checked');

        $table.find('tbody .groupCheckbox :checkbox').each(function() {
            jQuery(this).prop('checked', selectAll);
            jQuery(this).trigger('change');
        });
    });

    // Add class 'selected' on TR when the user check the checkbox
    // ============
    jQuery('table').on('change', 'tbody .groupCheckbox :checkbox', function() {
        if ( jQuery(this).is(':checked') ) {
            jQuery(this).parentsUntil('tr').parent().addClass('selected');
        } else {
            jQuery(this).parentsUntil('tr').parent().removeClass('selected');
        }
    });

    // Way to load inline an partial of form from one entity
    // Example: To insert in Agency form several Address form
    // ============
    jQuery('.ajaxLinkAddItemInline').on('click', function() {
        var id = jQuery(this).attr('id');
        var idContainer = '#' + id + '-container';
        var num = jQuery(idContainer).data('countItems');
        num = (num > 0) ? num : 0;

        var text = jQuery.ajax({
            type: 'GET',
            url: Routing.generate(
                jQuery(this).data('route'),
                {num: num, entity: jQuery(this).data('targetEntity')}),
            async: false
        }).responseText;

        jQuery(idContainer).append(text);
        jQuery(idContainer).data('countItems', num + 1);
        jQuery('body').trigger('bsky_jqueryautocomplete_init');
    });

    // See above
    // ============
    jQuery('.ajaxLinkDeleteItem').on('click', function(e){
        e.preventDefault();
        jQuery(this).parents('.clearfix:first').remove();
    });

    // Twitter Popover Action
    // ============
    jQuery('.bui-confirm-popover, .bui-confirm-popover-left, .bui-confirm-popover-right, .bui-confirm-popover-above, .bui-confirm-popover-below').on('click', function(event) {
        event.preventDefault();
        // Variable initialization
        var title, $parent, parentSize, $popover, $bui;

        title = jQuery(this).data('popoverTitle');
        parentSize = {width: 0, height: 0};

        // Set link as disabled
        jQuery(this).addClass('disabled');

        // If the popover has already created
        if (jQuery(this).hasClass('wrapped-for-popover')) {
            jQuery(this).parents('.bui.btt-action-popover-wrapper').find('.popover').show();
            return;
        }

        // Retrieve the position of popover
        var positionPopoverClass = 'left';
        if (jQuery(this).hasClass('bui-confirm-popover-right')) {
            positionPopoverClass = "right";
        } else if (jQuery(this).hasClass('bui-confirm-popover-below')) {
            positionPopoverClass = "bottom";
        } else if (jQuery(this).hasClass('bui-confirm-popover-above')) {
            positionPopoverClass = "top";
        }

        // Wrap the link by the popover
        jQuery(this).wrap('<div class="bui btt-action-popover-wrapper"></div>');

        $parent = jQuery(this).parent();

        $parent.prepend('<div class="popover '
            + positionPopoverClass
            + '"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title">'
            + title
            + '</h3><div class="popover-content"><a class="btn btn-mini btn-danger" href="'
            + jQuery(this).attr('href')
            + '">Valider</a>&nbsp;<a class="btn btn-mini cancel">Annuler</a></div></div></div>');

        // Bind the cancel action
        $parent.find('.popover-inner .btn.cancel').on('click', function() {
            jQuery(this).parents('.popover').hide();
            jQuery(this).parents('.btt-action-popover-wrapper').find('.wrapped-for-popover').removeClass('disabled');
        });

        $popover = $parent.find('.popover');
        $bui = jQuery(this);

        // Custom the style of elements
        parentSize.width = parseInt($bui.outerWidth()) + parseInt($bui.css('margin-left').replace("px", "")) + parseInt($bui.css('margin-right').replace("px", "")) +3;
        parentSize.height = parseInt($bui.outerHeight()) + parseInt($bui.css('margin-top').replace("px", "")) + parseInt($bui.css('margin-bottom').replace("px", ""));
        $parent.css('width', parentSize.width + "px");
        $parent.css('height', parentSize.height + "px");

        $popover.css('height', $popover.height());
        $popover.css('width', $popover.width());

        if ("right" == positionPopoverClass) {
            $popover.css('top', "-" + Math.round(($popover.outerHeight() / 2) - $bui.height() / 2) + "px");
            $popover.css('right', "-" + ($popover.outerWidth() + 2) + "px");
            $popover.css('left', "auto");
            $popover.css('bottom', "auto");
        } else if ("bottom" == positionPopoverClass) {
            $popover.css('bottom', "-" + ($popover.outerHeight() + 2) + "px");
            $popover.css('right', "-" + Math.round(($popover.outerWidth() / 2) - ($bui.outerWidth() / 2)) + "px");
            $popover.css('top', "auto");
            $popover.css('left', "auto");
        } else if ("top" == positionPopoverClass) {
            $popover.css('left', "auto");
            $popover.css('bottom', "auto");
            $popover.css('top', "-" + ($popover.outerHeight() + 2) + "px");
            $popover.css('right', "-" + Math.round(($popover.outerWidth() / 2) - ($bui.outerWidth() / 2)) + "px");
        } else {
            $popover.css('top', "-" + Math.round(($popover.outerHeight() / 2) - $bui.height() / 2) + "px");
            $popover.css('right', ($bui.outerWidth() + 2) + "px");
            $popover.css('left', "auto");
            $popover.css('bottom', "auto");
        }

        // Mark the link as wrapped by the popover
        jQuery(this).addClass('wrapped-for-popover');

        // Show the popover
        $popover.show();
    });

    // Tree Sortable
    // ============
    jQuery('.bui.treesortable').nestedSortable({
        disableNesting: 'no-nest',
        forcePlaceholderSize: true,
        handle: 'div',
        helper:	'clone',
        items: 'li',
        maxLevels: 3,
        opacity: .6,
        placeholder: 'placeholder',
        revert: 250,
        tabSize: 25,
        tolerance: 'pointer',
        toleranceElement: '> div'
    });

    // Tree Sortable
    // See above
    // ============
    jQuery('.bui.treesortable').on('click', '.item-container .delete', function() {
        jQuery(this).parentsUntil('.item-global-container').parent()
            .slideUp('slow', function() {
                jQuery(this).remove();
            });
    });

    // Tree Sortable
    // See above
    // ============
    jQuery('.bui.treesortable').on('click', '.item-container .edit', function() {
        // Contain only the item informations
        var $itemContainer = jQuery(this).parentsUntil('.item-container').parent();
        // Contain the item and this children
        var $itemGlobalContainer = $itemContainer.parent();
        // Ajax URL
        var url = Routing.generate('ajax_ui_bsky_menu_item_edit', {
            'id': $itemGlobalContainer.data('entityId')
        });
        jQuery.get(url, function(data) {
            $itemContainer.find('.item-edit-container').html(data);
        });
    });

    // Tree Sortable
    // See above
    // ============
    /*
    jQuery('.bui.treesortable').on('click', '.item-container .item-edit-container .language-selector a', function(event) {
        event.preventDefault();
        var $itemEditContainer = jQuery(this).parentsUntil('.item-edit-container').parent();
        jQuery.get(jQuery(this).attr('href'), function(data) {
            $itemEditContainer.html(data);
            if ($itemEditContainer.is(':hidden')) {
                $itemEditContainer.slideDown();
            }
        });
    });
   ¨*/

    // Tree Sortable
    // See above
    // ============
    jQuery('.bui.treesortable').on('click', '.item-container .item-edit-container .actions .btn.edit-close', function(event) {
        event.preventDefault();
        var $itemEditContainer = jQuery(this).parentsUntil('.item-edit-container').parent();
        $itemEditContainer.find(':first-child').slideUp('slow', function() {
            $itemEditContainer.html('');
        });
    });

    // Tree Sortable
    // See above
    // ============
    jQuery('.bui.treesortable').on('submit', '.item-container .item-edit-container form', function(event) {
        event.preventDefault();
        var $itemEditContainer = jQuery(this).parentsUntil('.item-edit-container').parent();
        jQuery.ajax({
            type: 'POST',
            url: jQuery(this).attr('action'),
            data: jQuery(this).serialize(),
            success: function(data) {
                $itemEditContainer.html(data);
            }
        });
    });

    // Tree Sortable
    // See above
    // ============
    jQuery('.bui.treesortable-save').on('click', function() {
        var $sortable = jQuery( jQuery(this).data('treesortableSelector') );
        jQuery.ajax({
          type: 'POST',
          url: Routing.generate(jQuery(this).data('treesortableRoute'), {'menuId':jQuery(this).data('treesortableMenuId')}),
          data: $sortable.nestedSortable('serialize')
        });
    });

    // Collection fields
    // rendered with jQuery
    // ============
    jQuery('.collection-fields').each(function() {
        var index = 0,
            $c = jQuery(this),
            data_prototype = $c.parent().attr('data-prototype');
        /**
            * Add a new row to the collection
            *
            * @context null
            */
        var add_row = function() {
            var del_btn = jQuery('.delete-collection-row:first', $c.parent());
            if (del_btn) {
                    del_btn = del_btn.clone().css('display', 'inline-block');
            }
            var html = jQuery('<div class="collection-field-row new" />')
                    .append(data_prototype.replace(/__name__/g, index))
                    .append(del_btn);

            $c.append(html);
            del_btn.click(function(e) {
                    e.preventDefault();
                    del_row(jQuery(this));
            });
            index++;
            return html;
        };

        /**
            * del row to the collection
            *
            * @context DomNode
            * @param e Event fired
            */
        var del_row = function(el) {
            el.parent().remove();
            if ($c.children().length == 0) {
                    index = 0;
            }
        };

	index = $c.children().length;
        if( jQuery('#list-photos .thumbnail').size() ){
            index = jQuery('#list-photos .thumbnail').size() + 1;
        }

        jQuery('.add-collection-row', $c.parent()).click(function(e) {
            e.preventDefault();
            initAllTiny(add_row());
        });

        jQuery('.delete-collection-row', $c.parent()).click(function(e) {
            e.preventDefault();
            removeAllTiny(this);
            del_row(jQuery(this));
        });
    });

    //
    // On portion area
    // ============
    jQuery('.portion .portion-header').on('click', function() {
       var parent = jQuery(this).parent();
       parent.find('.portion-container').slideToggle(1000, function() {
           if (jQuery(this).is(':hidden')) {
               parent.removeClass('open');
           } else {
               parent.addClass('open');
           }
       });
    });

    //
    // On AJAX Waiting
    // ============
    var ajaxOnLoading;
    var elAjaxOnLoading = '#ajax-on-loading';
    jQuery(elAjaxOnLoading).ajaxStart(function() {
        clearTimeout(ajaxOnLoading);
        ajaxOnLoadignMessage('.loading');
        ajaxOnLoadingWidth();
        jQuery(elAjaxOnLoading).slideDown();
    });
    jQuery(elAjaxOnLoading).ajaxSuccess(function() {
        ajaxOnLoadingWidth();
        ajaxOnLoadignMessage('.success');
    });
    jQuery(elAjaxOnLoading).ajaxError(function() {
        ajaxOnLoadignMessage('.error');
        ajaxOnLoadingWidth();
    });
    jQuery(elAjaxOnLoading).ajaxStop(function() {
        clearTimeout(ajaxOnLoading);
        ajaxOnLoading = setTimeout(function() {
            jQuery(elAjaxOnLoading).slideUp();
        }, 2500);
    });

    function ajaxOnLoadingWidth() {
        var left = (jQuery(window).width() - jQuery(elAjaxOnLoading).innerWidth()) / 2;
        jQuery(elAjaxOnLoading).css('left', Math.round(left) + 'px');
    }
    function ajaxOnLoadignMessage(type) {
        var hide = '.success, .error';
        if (type == '.success') {
            hide = '.error, .loading';
        } else if (type == '.error') {
            hide = '.success, .loading';
        }
        jQuery(hide, elAjaxOnLoading).css('display', 'none');
        jQuery(type, elAjaxOnLoading).css('display', 'inline');
    }

});
