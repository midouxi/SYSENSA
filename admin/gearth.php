<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Les coop&eacute;rants au S&eacute;n&eacute;gal</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="fucntion.js"></script>

<!-- script du menu -->
<script type="text/javascript" src="dynMenu.js"></script>
 <!-- détéction du navigateur -->
<script type="text/javascript" src="browserdetect.js"></script>

<!-- important pour que les vieux navigateurs ne comprennent pas le CSS -->
<style type="text/css">
    @import "menu.css";
</style>

    <script src="http://maps.google.com/maps?file=api&amp;t=k&amp;v=2&amp;key=ABQIAAAAooxMzv7nuifpSiPg4ARKQhQx8-CuN1Vc-xHIhjlwyDtMNiJFGRStTvIUNLZuiQy8FYbvpNETWXavgQ"
      type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    function load() {
      if (GBrowserIsCompatible()) {
var map = new GMap2(document.getElementById("map"));
map.addControl(new GSmallMapControl());
map.addControl(new GMapTypeControl());
map.setCenter(new GLatLng(14.665107,-17.436354),16, G_SATELLITE_MAP);

function createMarker(point, number) {
  var marker = new GMarker(point);
  GEvent.addListener(marker, "click", function() {
    marker.openInfoWindowHtml("L'institution Sainte Jeanne d'Arc<br>Y travaille : <a href='#' onclick=\"ahah('page_info_perso.html','person');afficheId('perso_td');\">moi</a><br>Claire<br>Sabrina<br>Florence");
  });
  return marker;
}


// Create our "tiny" marker icon
var icon = new GIcon();
icon.image = "http://labs.google.com/ridefinder/images/mm_20_yellow.png";
icon.shadow = "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
icon.iconSize = new GSize(12, 20);
icon.shadowSize = new GSize(22, 20);
icon.iconAnchor = new GPoint(6, 20);
icon.infoWindowAnchor = new GPoint(5, 1);
var point = new GLatLng(14.665102,-17.436655);
  map.addOverlay(createMarker(point, icon));
      }
    }

    //]]>
    </script>
  </head>
  <body onload="load();cacheId('perso_td');">
  <table><tr border=0>
    <td>
    	<div id="map" style="width: 600px; height: 450px"></div>
    </td>
    <td id="perso_td" border=0>
    	<div id="Entete"><span class="Fermer"><a href="javascript:cacheId('perso_td')";>Fermer la fenetre</a></span></div>
    	<div id="person"></div>
    </td>
 </tr></table>

  </body>
</html>