<?php // config/helpers.php

function sprache($url_ar) {
    session_start();
    
    $lan = 'ru'; // Default language
    if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
        $lang = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
        $lan = substr($lang, 0, 2);
        $_SESSION["lan"] = $lan;
    }

    // Check if the URL has a language parameter
    if (isset($url_ar[2]) && in_array($url_ar[2], ['ru', 'de', 'en'])) {
        $lan = $url_ar[2];
        $_SESSION["lan"] = $lan;
    }

    return $lan;
}
############################################ 
function echo_r($x) {
    echo "<pre>" . print_r($x, true) . "</pre>";
}

########### END echo_r() ############### 
