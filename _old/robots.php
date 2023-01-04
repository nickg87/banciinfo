<?php
include('settings/s_settings.php');
header('Content-Type:text/plain');
echo "User-agent: *" . "\r\n";
echo "Disallow: /admin/*" . "\r\n";

echo "Sitemap: ".SITE_URL."sitemap.xml " . "\r\n";
echo "Sitemap: ".SITE_URL."sitemap-institutii.xml " . "\r\n";
echo "Sitemap: ".SITE_URL."sitemap-filiale.xml " . "\r\n";
?>