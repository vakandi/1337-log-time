<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Anonymous+Pro&display=swap" rel="stylesheet">
    <title>API call</title>
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
    bottom: 30%;
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

.purple-link {
    color: purple;
    text-decoration: none;
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
    'clientId'                => '5f098420ac985c69454de207c0ed775aa09f12c7e1e2dc7d7070dd6ec27d49da',
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
?>

</body>
</html>
