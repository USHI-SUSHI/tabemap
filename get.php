<!DOCTYPE html>
<html lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>PostProcess</title>
</head>
<body>

<?php
  try   {

    $latitude = filter_input(INPUT_GET, 'Latitude');
    $longitude = filter_input(INPUT_GET, 'Longitude');
    $accuracy = filter_input(INPUT_GET, 'Accuracy');
    $date = filter_input(INPUT_GET, 'Date');
    $code = filter_input(INPUT_GET, 'Code');
    
    $PDO = new PDO('mysql:host=localhost;dbname=xs854113_locationdb;charset=utf8', 'xs854113_ope1', 'Anser1981' );
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    $sql = "UPDATE LocationTable SET latitude = :latitude, longitude = :longitude, date = :date WHERE code = :code"; 
    $stmt = $PDO->prepare($sql);
    $params = array(':code' => $code, ':latitude' => $latitude, ':longitude' => $longitude, ':date' => $date); 
    $stmt->execute($params);

    $sql2 = "SELECT foward FROM LocationTable WHERE code = :code";
    $stmt2 = $PDO->prepare($sql2);
    $params2 = array(':code' => $code); 
    $stmt2->execute($params2);

    while($result = $stmt2->fetch(PDO::FETCH_ASSOC)){
      $foward = $result['foward'];
    }

    header("Location: $foward");

 }catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
 }

?>
</body>
</html>