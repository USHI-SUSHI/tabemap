<!DOCTYPE html>
<html lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>PostProcess</title>
</head>
<body>

<?php
  try   {

    $foward = filter_input(INPUT_POST, 'URL');

    //genarate random code
    $str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPUQRSTUVWXYZ';
    $code = substr(str_shuffle($str), 0, 16);
    
    $PDO = new PDO('mysql:host=localhost;dbname=xs854113_locationdb;charset=utf8', 'xs854113_ope1', 'Anser1981' );
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    $sql = "INSERT INTO LocationTable (code, foward) VALUES (:code, :foward)"; 
    $stmt = $PDO->prepare($sql);
    $params = array(':code' => $code, ':foward' => $foward); 
    $stmt->execute($params);

 }catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
 }

echo "以下のURLを送付してください。<br>https://tabemap.net/serch.php?code=";
echo $code;
echo "<br><br>";
echo "以下のURLから現在地を確認できます。<br>https://tabemap.net/result.php?code=";
echo $code;
echo "<br>";


?>
</body>
</html>