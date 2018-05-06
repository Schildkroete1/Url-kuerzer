<?php
$head="
<!doctype html>
<meta charset=\"utf-8\">
<html>
<head>
        <title>URL k&uuml;rzer</title>
        <meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0\">

        <style>
                div, input, form {
                        text-align:left; font-family:monospace;font-size:14px;
                }
                input {
                        border: 1px solid #444444; padding:10px;margin:10px;
                }
        </style>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WJJPPX7');</script>
<!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id=GTM-WJJPPX7\"
height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
";
$html="
<P>&nbsp;</P>

<div style=\"width:100%; height:100%; margin:0 auto;\" class=\"box v1\">

<form action=\"$self\" method=post>
        <input type=url placeholder=\"URL z.B. https://example.com\" autocomplete=off style=\"text-align:left;background-color:$bgcolor;width:95%;\" value=\"\" name=url id=url>
        <input style=\"margin-left:1%;\" type=submit value='k&uuml;rzen'>&nbsp;
</form>
<p>Zum testen k&ouml;nnen sie folgenden link ausprobieren: <a target=\"_blank\" href=\"https://kurz.ml/kRfO\">kurz.ml/kRfO</a><br>
Dieser sollte sie auf die Seite <a target=\"_blank\" href=\"http://example.com\">example.com</a> weiterleiten</p>
</div>
<div class=\"a2a_kit a2a_kit_size_32 a2a_default_style\">
<a class=\"a2a_dd\" href=\"https://www.addtoany.com/share\"></a>
<a class=\"a2a_button_whatsapp\"></a>
<a class=\"a2a_button_email\"></a>
<a class=\"a2a_button_sms\"></a>
<a class=\"a2a_button_facebook\"></a>
<a class=\"a2a_button_twitter\"></a>
<a class=\"a2a_button_google_plus\"></a>
</div>
<script>
var a2a_config = a2a_config || {};
a2a_config.linkname = \"Ich habe einen neuen URL K&uuml;rzer gefunden:\";
a2a_config.linkurl = \"kurz.ml\";
a2a_config.locale = \"de\";
</script>
<script async src=\"https://static.addtoany.com/menu/page.js\"></script>
<!-- AddToAny END -->

            <div style=\"position: relative\">
                <p style=\"position: fixed; bottom: 0; width:100%; text-align: center\">
		<a href=\"https://jonasled.tk/haftungsausschluss.html\">Haftungsausschluss</a>
		<a href=\"https://jonasled.tk/datenschutzerklaerung.html\">Datenschutzerkl&auml;rung</a>
                </p>
            </div>
</body>
</html>
";

$url =  $_SERVER['PHP_SELF'];
$self = $_SERVER['PHP_SELF'];
$url = ltrim($url, "/");
if ($_POST[url] != "") {
	$hash = exec("python id.py");
        echo($head);
	echo ("<h2>Dein gek&uuml;rzter URL lautet: kurz.ml/$hash</h2>");
	echo ("<script>\n\n  var _gaq = _gaq || [];\n  _gaq.push(['_setAccount', 'UA-116990591-2']);\n\n  _gaq.push(['_setCustomVar', 1, 'URL', '$_POST[url]', 2]);\n\n  _gaq.push(['_trackPageview']);\n\n  (function() {\n    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;\n    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';\n    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);\n  })();\n\n</script>");
	echo("<br>\n</body>\n</html>");
	exec("python add.py $hash $_POST[url]");
} else {
if($url != ""){
$redirect = exec("python get.py $url");
if(strlen (exec("python get.py $url")) == 0){
        http_response_code(404);
	header("HTTP/1.0 404 Not Found");
        echo($head);
	echo("<h1>Not Found</h1>\n");
	echo("<p>The requested URL /$url was not found on this server.</p>");
	echo("</body></html>");
} else if(strlen (exec("python get.py $url")) != 0){

if(strpos($redirect, "http") === false){
$redirect = "http://$redirect";
}
header("Location: $redirect");

echo($head);
echo("<noscript>\n        <meta http-equiv=\"refresh\" content=\"0;URL=\"$redirect\">\n</noscript>\n");
echo("<script type=\"text/javascript\"><!--\nsetTimeout('Redirect()',0);\nfunction Redirect()\n{\n  location.href = '$redirect';\n}\n// --></script>");
echo ("<p>Sie werden weitergeleitet, falls dies nicht funktionieren sollte klicken sie bitte  <a href='$redirect'>hier</a> ($redirect) oder geben sie folgenden Link im Browser ein: <a href=\"$redirect\">$redirect</a></p>");
}} else {
        echo($head);
        echo $html;
}}
?>
