<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $client = new Client([
        'base_uri' => 'https://api.intra.42.fr',
        'timeout'  => 2.0,
    ]);
    $response = $client->request('POST', '/oauth/token', [
        'form_params' => [
            'grant_type' => 'client_credentials',
            'client_id' => '5f098420ac985c69454de207c0ed775aa09f12c7e1e2dc7d7070dd6ec27d49da',
            'client_secret' => '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',
        ]
    ]);
    $access_token = json_decode($response->getBody())->access_token;
    $client = new Client([
        'base_uri' => 'https://api.intra.42.fr',
        'headers' => [
            'Authorization' => 'Bearer ' . $access_token,
        ],
    ]);
    $d = new DateTime();
    $response = $client->request('GET', '/v2/users/' . $login . '/locations_stats?begin_at=' . $d->modify('-1 month')->format('Y-m-28'));
    $api_output_json = json_decode($response->getBody(), true);
    $daily_hours = array();
    foreach ($api_output_json as $date => $time_string) {
        list($hours, $minutes, $seconds) = explode(':', $time_string);
        $daily_hours[$date] = $hours + ($minutes / 60.0) + ($seconds / 3600.0);
    }
    $total_hours = 0;
    foreach ($daily_hours as $date => $hours) {
        $total_hours += $hours;
        $minutes = ($hours - floor($hours)) * 60;
        echo "<p>$date: $hours h and $minutes min</p>";
    }
    echo "<p>Total hours: $total_hours h</p>";
} else {
	echo '
<style>
form {
  /* center the form horizontally */
  margin: 0 auto;
  /* increase the size of the form */
  width: 300px;
  height: 200px;
  /* add a background color */
  background-color: #f1f1f1;
  /* add some padding */
  padding: 20px;
  /* add some border */
  border: 1px solid #ccc;
}

input {
  /* increase the size of the input */
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
}

button {
  /* increase the size of the button */
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  /* add animation */
  transition: background-color 0.3s ease;
}

/* change the button color on hover */
button:hover {
  background-color: #45a049;
}

</style>
    <form method="post">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login">
        <input type="submit" value="Submit">
    </form>
    ';
}

