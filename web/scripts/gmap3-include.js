
      $(function(){
      
        $('#atelier-45')
          .gmap3(
          { action:'init',
            options:{
              center:[47.874934, 1.945104],
              zoom: 11
            }
          },
          { action: 'addMarkers',
            markers:[

              {lat:47.874934, lng:1.945104, data:'<p class="gris"><img src="images/logo-contact.jpg" alt="Coraloisirs"/><br /><br />700 rue de la Cornaillère<br />45560 ST DENIS EN VAL</p>'},
			  
            ],
            marker:{
              options:{
                draggable: false
              },
              events:{
                mouseover: function(marker, event, data){
                  var map = $(this).gmap3('get'),
                      infowindow = $(this).gmap3({action:'get', name:'infowindow'});
                  if (infowindow){
                    infowindow.open(map, marker);
                    infowindow.setContent(data);
                  } else {
                    $(this).gmap3({action:'addinfowindow', anchor:marker, options:{content: data}});
                  }
                },
                mouseout: function(){
                  var infowindow = $(this).gmap3({action:'get', name:'infowindow'});
                  if (infowindow){
                    infowindow.close();
                  }
                }
              }
            }
          }
        );
      });

