<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Redirect http to https.
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}

// Determine base url and current page.
//$baseUrl = dirname(htmlentities($_SERVER['PHP_SELF']));
$baseUrl = "";
$requestUri = trim(substr($_SERVER["REQUEST_URI"], strlen( $baseUrl)), "/");

$path = explode("/", $requestUri);
$lastUrlPart = $path[count($path)-1];

$pages = array("home", "bio", "gallery", "video", "media");
$page = $lastUrlPart;

if (!in_array($lastUrlPart, $pages)) {
	$page = "home";
}

// Get default language from HTTP_ACCEPT_LANGUAGE.
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);
$acceptLang = ['bg', 'en']; 
$lang = in_array($lang, $acceptLang) ? $lang : 'en';

// Check if language is specified in url.
if(count($path) > 0 && in_array($path[0], $acceptLang))
    $lang = $path[0];


define("LANG", $lang);

// Build body file path
$bodyFile = "$page.$lang.php";

//echo($bodyFile);

// If path is NULL, set to home
if (!file_exists($bodyFile)){
    $bodyFile = "home.en.php";
} else


// BG text translations.
$texts_bg = [
    "HOME" => "НАЧАЛО",
    "ABOUT" => "ВАСИЛ ТОСЕВ",
    "YAMA" => "ЙОГА ЦЕНТЪР ЯМА",
    "AYLYAK" => "ЙОГА КЛУБ АЙЛЯЦИТЕ",
    "SARAFOVO" => "ЙОГА ЛАГЕР САРАФОВО",
    "DERVISH" => "ДЕРВИШКИ ТАНЦ",
    "SUFI" => "МЪДРОСТТА НА СУФИТЕ",
    "VIDEO" => "ВИДЕО",
    "BOOK" => "КНИГА",
    "CONTACTS" => "КОНТАКТИ"
];

function txt($key)
{
    $texts = $GLOBALS["texts_".LANG] ?? null;
    if($texts)
    {
        return $texts[$key] ?? $key;
    } 
    return $key;
}

function ln($key)
{
    echo(txt($key));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	
    <title>Васил Тосев - йога инструктор и дервиш</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Elgora">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" /> 
    <meta http-equiv="Pragma" content="no-cache" /> 
    <meta http-equiv="Expires" content="0" />
	<meta name="google-site-verification" content="pU5qnf3xborXFDjgnYjNWBZzU3XYCN8LTAmNR1xmaJ0" />
	<base href="/" />
	
<!-- menu -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<!-- gallery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

	<!-- bootstrap-icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

	<!-- our -->
    <link rel="stylesheet" href="css/img-styles.css?v=2">
	<link rel="stylesheet" href="css/video-styles.css?v=2">
    <link rel="stylesheet" href="css/socicon/style.css?v=2">
    <link rel="stylesheet" href="css/styles.css?v=3">
	<link rel="stylesheet" href="css/font/stylesheet.css?v=2">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

	  <div class="container">

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		  <ul class="navbar-nav mb-2 mb-lg-0 justify-content-center w-100">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="home">НАЧАЛО</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="vasiltosev">ВАСИЛ ТОСЕВ</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="yama">ЙОГА ЦЕНТЪР ЯМА</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="aylyaci">ЙОГА КЛУБ АЙЛЯЦИТЕ</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="sarafovo">ЙОГА ЛАГЕР САРАФОВО</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="dervish">ДЕРВИШКИ ТАНЦ</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="sufi">МЪДРОСТТА НА СУФИТЕ</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="video">ВИДЕО</a></li>
				<li class="nav-item"><a class="nav-link active" aria-current="page" href="gallery">ГАЛЕРИЯ</a></li>
				<li class="nav-item"><a class="nav-link active" aria-current="page" href="book">КНИГА</a></li>
				<li class="nav-item"><a class="nav-link active" aria-current="page" href="health">ЗДРАВЕ</a></li>
				<li class="nav-item"><a class="nav-link active" aria-current="page" href="contact">КОНТАКТИ</a></li>
				
		  </ul>
		</div>
	  </div>
	</nav>

    <div class="header">
        <div class="container">
            <div class="header-container">
                <img src="Vasil-Tosev-home.jpg">
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="main">



				<!-- BODY -->
				<?php
				include($bodyFile); 
				?>
				<!-- END BODY -->
            



			    <div class="d-flex justify-content-center">
				    <img class="img-divider" src="images/div.png"/>
				</div>
                
				<!--contacts-->
                <a name="contacts"></a>
                <br/>
				
                <h2 class="mb-0"><?php ln("CONTACTS"); ?></h2>


                <div class="clear"></div>
                <div id="footer" class="fluid text-align-center">
                    <script type="text/javascript">
                        //<!-- 
                        var emailname = "sabinayordanova";
                        var emailserver = "protonmail";

                        document.write('<a href="mailto:' + emailname + '@' + emailserver + '.com" target="_blank">');
                        //document.write(emailname + '@' + emailserver + '.com');
                        document.write('<span class="socicon socicon-mail"></span></a>');
                        //-->
                    </script>
					<br/>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

	<script src="js/gal.js"></script>
</body>

</html>