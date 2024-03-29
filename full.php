<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Anonymous+Pro&display=swap" rel="stylesheet">
<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
    <title>LogTime 1337 | vakandi</title>
</head>
<style>

body {
    font-size: 50px;
    background: url('background.jpg') no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    text-align: center;
    height:100vh;
    overflow: hidden;
}

pre {
    position: absolute;
    bottom: 32%;
    width: 100%;
    text-align: center;
    font-family: 'Anonymous Pro';
    color: white;
    font-size: 50px;
}

form {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 70%;
    margin: 0 auto;
    background-size: cover;
    background-position: center;
}

label {
    font-size: 50px;
    color: white;
    font-family: 'Anonymous Pro';
}

input[type="text"] {
    font-size: 40px;
    padding: 20px;
    margin-bottom: 20px;
    width: 100%;
    border-radius: 15px;
    margin-right: 15px;
    margin-top: 20px;
    font-family: 'Anonymous Pro';
}

input[type="submit"] {
    background-color: green;
    color: white;
    font-size: 40px;
    padding: 20px;
    width: 100%;
    cursor: pointer;
    border-radius: 15px;
    margin-left: 15px;
    font-family: 'Anonymous Pro';
}

input[type="submit"]:active {
    background-color: #6600cc;
}

.title {
    font-family: 'Anonymous Pro';
    font-size: 50px;
    text-align: center;
    color: white;
    margin-top: 100px;
}
.github-repo {
    font-family: 'Anonymous Pro';
    font-size: 50px;
    text-align: center;
    color: white;
position: relative;
top: 65%; bottom: 100px;
} 

.purple-link {
    color: purple;
    text-decoration: none;
}
@media only screen and (min-width: 980px) {
pre {
font-size: 20px;
bottom: 30%;
}
form {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20%;
    margin: 0 auto;
    background-size: cover;
    background-position: center;
}

label {
    font-size: 25px;
    color: white;
    font-family: 'Anonymous Pro';
}

input[type="text"] {
    font-size: 20px;
    padding: 20px;
    margin-bottom: 20px;
    width: 60%;
    border-radius: 15px;
    margin-right: 15px;
    margin-top: 20px;
    font-family: 'Anonymous Pro';
}

input[type="submit"] {
    background-color: green;
    color: white;
    font-size: 20px;
    padding: 20px;
    width: 60%;
    cursor: pointer;
    border-radius: 15px;
    margin-left: 17%;
    font-family: 'Anonymous Pro';
    display: flex;
    justify-content: center;  
    align-items: center;
}

.title {
    font-size: 20px;
    margin-top: 100px;
}
.github-repo {
    font-size: 20px;
position: relative;
top: 65%; bottom: 100px;
}
}
@media only screen and (min-width: 1200px) {
pre {
font-size: 27px;
bottom: 30%;
}
</style>
<body>
<div class="title">1337 LOGTIME by <a href="https://github.com/vakandi" class="purple-link">wbousfir</a></div>
<form action="index.php" method="post">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login">
<input type="submit" id="submit-button" value="GET LOGTIME">
</form>


<?php
if(isset($_POST["login"])) {
    require "vendor/autoload.php";
$provider = new League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'u-s4t2ud-af5555210d8c85d721cd43108c3bf9a5dc5de78eb39730f91e0dfdd8ba4c5a21',
    'clientSecret'            => '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',
    'redirectUri'             => 'https://example.com/callback-url',            'urlAuthorize'            => 'https://api.intra.42.fr/oauth/authorize',                                                                                 'urlAccessToken'          => 'https://api.intra.42.fr/oauth/token',
    'urlResourceOwnerDetails' => 'https://api.intra.42.fr/v2/me'
]);                                                                     
try {                                                                           $accessToken = $provider->getAccessToken('client_credentials');
    $user = $provider->getResourceOwner($accessToken);
    $currentDay = date('d');
    if($currentDay >= 29 && $currentDay <= 31) {
    $date_final = date("Y-m") . '-28';
} else {
    $date_final = date("Y-m", strtotime("-1 month")) . '-28';
}

    $request = $provider->getAuthenticatedRequest(
        'GET',
	'https://api.intra.42.fr/v2/users/' . $_POST["login"] . '/locations_stats?begin_at=' . $date_final,
	$accessToken
    );
    $response = $provider->getResponse($request);
    echo "<pre>";
    $data = json_decode($response->getBody()->getContents(), true);
    $total_hours = 0;
    foreach($data as $day => $time) {
        $time = explode(':', $time);
        $hours = (int) $time[0];
        $total_hours += $hours;
    }
    //echo "Logtime for" . $date("m");
    echo $_POST["login"] . "\n";
    echo "Total hours: " . $total_hours . "h";
    echo "</pre>";
} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    echo "Error: " . $e->getMessage();
}
}
$username = $_POST["login"];
$file = fopen("history.txt", "a");
$txt = date("Y-m-d H:i:s") . " " . $username . $total_hours . "\n";
fwrite($file, $txt);
fclose($file);

?>

<div class="github-repo"><a href="https://github.com/vakandi/1337-log-time" class="purple-link">GitHub Repo</a></div>
</body>
</html>	
