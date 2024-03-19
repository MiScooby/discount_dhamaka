<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEPH7olpEltXbeZaoclKRKI-MppKsTPb0&libraries=places&callback=initMap" async defer></script>
<script>
var icons = { parking: { icon: 'https://tarantelleromane.files.wordpress.com/2016/10/map-marker.png?w=50' } };

var airports = [
    {
        title: 'Manchester Airport',
        position: {
            lat: 53.3588026,
            lng: -2.274919 },
        icon: 'parking',    
        content: '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Manchester Airport - from £30</h1><div id="bodyContent"><p><b>Manchester Airport</b> - 3 terminal airport offering flights to Europe and around the world with national rail connections.</p> <p><a href="https://www.google.co.uk">BOOK</a></p></div></div>'
    },
    {
        title: 'Leeds Airport',
        position: {
            lat: 53.8679434,
            lng: -1.6637193 },
        icon: 'parking',    
        content: '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Leeds Airport - from £30</h1><div id="bodyContent"><p><b>Leeds Airport</b> - 3 terminal airport offering flights to Europe and around the world with national rail connections.</p> <p><a href="https://www.google.co.uk">BOOK</a></p></div></div>'
    },
    {
        title: 'Belfast Airport',
        position: {
            lat: 54.661781,
            lng: -6.2184331 },
        icon: 'parking',    
        content: '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Belfast Airport - from £30</h1><div id="bodyContent"><p><b>Belfast Airport</b> - 3 terminal airport offering flights to Europe and around the world with national rail connections.</p> <p><a href="https://www.google.co.uk">BOOK</a></p></div></div>'
    },
    {
        title: 'Edinburgh Airport',
        position: {
            lat: 55.950785,
            lng: -3.3636419 },
        icon: 'parking',    
        content: '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Edinburgh Airport - from £30</h1><div id="bodyContent"><p><b>Edinburgh Airport</b> - 3 terminal airport offering flights to Europe and around the world with national rail connections.</p> <p><a href="https://www.google.co.uk">BOOK</a></p></div></div>'
    },
    {
        title: 'Cardiff Airport',
        position: {
            lat: 51.3985498,
            lng: -3.3416461 },
        icon: 'parking',    
        content: '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Cardiff Airport - from £30</h1><div id="bodyContent"><p><b>Cardiff Airport</b> - 3 terminal airport offering flights to Europe and around the world with national rail connections.</p> <p><a href="https://www.google.co.uk">BOOK</a></p></div></div>'
    },
    {
        title: 'Heathrow Airport',
        position: {
            // 28.692350717194092, 77.15334288606914
            lat: 28.692350717194092,
            lng: 77.15334288606914 },
        icon: 'parking',    
        content: '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Heathrow Airport - from £50</h1><div id="bodyContent"><p><b>Heathrow Airport</b> - 3 terminal airport offering flights to Europe and around the world with national rail connections.</p> <p><a href="https://www.google.co.uk">BOOK</a></p></div></div>'}
];

function initMap() {
   
    var india = {
        lat: 28.7041,
        lng: 77.1025
    };
   
    var map = new google.maps.Map( document.getElementById('map'), {
      zoom: 6,
      center: india,
      disableDefaultUI: true,    
    });
         
    var InfoWindows = new google.maps.InfoWindow({});
   
    airports.forEach(function(airport) {    
        var marker = new google.maps.Marker({
          position: { lat: airport.position.lat, lng: airport.position.lng },
          map: map,
          icon: icons[airport.icon].icon,
          title: airport.title
        });
        marker.addListener('mouseover', function() {
          InfoWindows.open(map, this);
          InfoWindows.setContent(airport.content);
        });
    });
}
</script>