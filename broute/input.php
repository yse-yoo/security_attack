<?php
function attack()
{
    $post = array(
        'name' => 'Test',
        'email' => 'test@test.com',
        'password' => 'pass1234',
    );

    $url = 'http://localhost/my_tweet/login/auth.php';
    // $url = 'http://localhost/my_tweet/regist/confirm.php';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

    $response = curl_exec($ch);

    $redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    echo $redirectedUrl;
    echo $response;

    preg_match('/Set-Cookie: (PHPSESSID=[^;]*)/', $response, $matches);
    if (isset($matches[1])) {
        $sessionId = $matches[1];
        echo 'セッションID: ' . $sessionId;
    } else {
        echo 'セッションIDが見つかりません。';
    }
    curl_close($ch);
}

attack();
