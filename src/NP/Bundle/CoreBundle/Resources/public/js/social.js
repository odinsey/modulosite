var socialUrl = function() {

    var serviceName = arguments[0];
    var url = arguments[1] || document.location;
    var title = arguments[2] || document.title;
    var socialurl = sharedUrl(serviceName, url, title);

    var width = 800;
    var height = 600;
    var left = parseInt((jQuery(window).width()/2)-(width/2));
    var top = parseInt((jQuery(window).height()/2)-(height/2));
    window.open(socialurl, serviceName, 'resizable=yes, location=yes, width='+width+', height='+height+', left='+left+', top='+top);

    return false;
}

var sharedUrl = function (serviceName, url, title) {

    url = encodeURI(url);
    title = encodeURI(title);
    var ret = '';
    switch (serviceName) {
        case 'facebook':
            ret = 'http://www.facebook.com/sharer.php?u='+url+'&t='+title;
            break;
        case 'twitter':
            ret = 'http://twitter.com/home?status='+title+' - '+url;
            break;
        case 'technorati':
            ret = 'http://technorati.com/faves/?add='+url;
            break;
        case 'gbookmarks':
            ret = 'http://www.google.com/bookmarks/mark?op=add&title='+title+'&bkmk='+url;
            break;
        case 'netvibes':
            ret = 'http://www.netvibes.com/share?autoclose=1&title='+title+'&url='+url;
            break;
        case 'digg':
            ret = 'http://digg.com/submit?phase=2&partner=[partner]&title='+title+'&url='+url;
            break;
        case 'buzz':
            ret = 'http://www.google.com/buzz/post?url='+url;
            break;
        default:
            break;
    }

    return ret;
}