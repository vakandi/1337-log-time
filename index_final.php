<!DOCTYPE html>
<html>
<head>
    <title>API call</title>
</head>
<body>
    <form action="index.php" method="post">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login">
        <input type="submit" value="Submit">
    </form>

<?php
if(isset($_POST["login"])) {
    require "vendor/autoload.php";

    $provider = new League\OAuth2\Client\Provider\GenericProvider([
        'clientId'                => '5f098420ac985c69454de207c0ed775aa09f12c7e1e2dc7d7070dd6ec27d49da',   
        'clientSecret'            => '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',
        'redirectUri'             => 'https://example.com/callback-url',
        'urlAuthorize'            => 'https://api.intra.42.fr/oauth/authorize',
        'urlAccessToken'          => 'https://api.intra.42.fr/oauth/token',
        'urlResourceOwnerDetails' => 'https://api.intra.42.fr/v2/me'
    ]);

    try {
        $accessToken = $provider->getAccessToken('client_credentials');
        $user = $provider->getResourceOwner($accessToken);
        $request = $provider->getAuthenticatedRequest(
            'GET',
            'https://api.intra.42.fr/v2/users/' . $_POST["login"] . '/locations_stats',
            $accessToken
        );
        $response = $provider->getResponse($request);
        echo "<pre>";
        print_r($response->getBody()->getContents());
        echo "</pre>";
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        echo "Error: " . $e->getMessage();
    }
	$api_output_json = json_decode($response->getBody(), true);                 $daily_hours = array();                                                     foreach ($api_output_json as $date => $time_string) {
        list($hours, $minutes, $seconds) = explode(':', $time_string);              $daily_hours[$date] = $hours + ($minutes / 60.0) + ($seconds / 3600.0);                                                                             }
    $total_hours = 0;                                                           foreach ($daily_hours as $date => $hours) {                                     $total_hours += $hours;
        $minutes = ($hours - floor($hours)) * 60;                                   echo "<p>$date: $hours h and $minutes min</p>";                    
    	echo "<p>Total hours: $total_hours h</p>";
}
?>
</body>
</html>

