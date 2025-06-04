<?php
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $vpassNo = "";
    if(isset($_POST["vpassNo"])){
      $vpassNo = $_POST["vpassNo"];
    }

    $status = "";
    if(isset($_POST["status"])){
      $status = $_POST["status"];
    }

    $url = "http://157.184.222.76:8181";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
     
    $result = curl_exec($ch);
    $info = (curl_getinfo($ch));
    curl_close($ch);

    if ($info['http_code'] == 401 || $info['http_code'] == 403 || $info['http_code'] == 500 || $info['http_code'] == 404) {
      echo "<script> alert('Invalid login'); window.location.href = 'index.php'; </script>";
    } else {
      // success login
      $_SESSION["username"] = strtolower($username);
      session_write_close();
      
      header("Location: pages/index.php" . "?vpassNo=$vpassNo");
      die();
    }
?>