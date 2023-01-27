<!DOCTYPE html>
<html>
<head>
    <title>API call</title>
</head>
<body>                                                                          <form action="index.php" method="post">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login">
        <input type="submit" value="Submit">                                    </form>
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
    $request = $provider->getAuthenticatedRequest(
        'GET',
        'https://api.intra.42.fr/v2/users/' . $_POST["login"] . '/locations_stats',                                                                             $accessToken
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
    echo "Total hours: " . $total_hours;
    echo "</pre>";                                                          } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    echo "Error: " . $e->getMessage();
}
}
?>

</body>
</html>
