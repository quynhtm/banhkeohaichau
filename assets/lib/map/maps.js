  

function initialize() {
	 
	var myLatlng = new google.maps.LatLng(21.03026, 105.80089);
    var myOptions = {
      zoom: 16,
      center: myLatlng,
      scrollwheel: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    
    var map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);

    var contentString = 'Shop: SanPhamReDep.COM';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'SanPhamReDep.COM'
    });
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });
  }

google.maps.event.addDomListener(window, 'load', initialize);