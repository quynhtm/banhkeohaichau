  

function initialize() {
	 
	var myLatlng = new google.maps.LatLng(21.00034, 105.86934);
    var myOptions = {
      zoom: 16,
      center: myLatlng,
      scrollwheel: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    
    var map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);

    var contentString = 'Công ty cổ phần bánh kẹo Hải Châu<br/>Địa chỉ: 15 Mạc Thị Bưởi, Quận Hai Bà Trưng, Hà Nội ';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Haichau.com.vn'
    });
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });
  }

google.maps.event.addDomListener(window, 'load', initialize);