<!DOCTYPE html>
<html>
<head>
	<title>Reputation</title>
</head>
<body>
<form action="" method="post">
	<table border="1">
	<tr><td>Virustotal API</td><td><input type="text" name="vt_api"></td></tr>
	<tr><td>IP ler</td><td><textarea name="ipler"></textarea></td></tr>
	<tr><td colspan="2"><input type="submit" name="submit">gönder</td></tr>
	</table>

</form>

<?php 
if (isset($_POST["submit"])) {

$urlimiz="https://www.virustotal.com/api/v3/ip_addresses/"
$iplist=$_POST["ipler"];
$gonder=$urlimiz+$iplist;

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => $gonder,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "x-apikey: cd9fb9ccc4c738c932f37b893933762f3eaf2b57c0ee0444f0171b3371a155ca"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
}
 ?>
</body>
</html>

