<!DOCTYPE html>
<html lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Result</title>
</head>
<body>

<?php
  try   {

    $code = filter_input(INPUT_GET, 'code');

    $PDO = new PDO('mysql:host=localhost;dbname=xs854113_locationdb;charset=utf8', 'xs854113_ope1', 'Anser1981' );
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    $sql = "SELECT latitude, longitude, date FROM LocationTable WHERE code = :code"; 
    $stmt = $PDO->prepare($sql);
    $params = array(':code' => $code); 
    $stmt->execute($params);

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
      print("送付したリンクは次の時間にアクセスされました。<br>".$result['date']."<br>");
      print("リンクが開かれたのは以下の場所です。<br>");
      print("<a href=\"https://www.google.com/maps/search/?api=1&query=".$result['latitude'].",".$result['longitude']."\">"."Google maps</a>");

    }

 }catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
 }

?>
</body>
</html>