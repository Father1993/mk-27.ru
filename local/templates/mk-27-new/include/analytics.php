<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;

// Проверяем подключение модуля main
if (!Loader::includeModule('main')) {
    return [];
}

// Получаем ID счетчиков из настроек
$counters = [
    'yandex' => [
        'id' => Option::get('main', 'yandex_counter_id', '84934894'),
        'template' => '<!-- Yandex.Metrika counter -->
<script>
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
   ym(%s, "init", {
       clickmap:true,
       trackLinks:true,
       accurateTrackBounce:true,
       webvisor:true,
       ecommerce:"dataLayer"
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/%s" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->'
    ],
    'google' => [
        'id' => Option::get('main', 'google_counter_id', 'G-GGCR8WCW8N'),
        'template' => '<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=%s"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag("js", new Date());
gtag("config", "%s");
</script>'
    ],
    'mailru' => [
        'id' => Option::get('main', 'mailru_counter_id', '3300765'),
        'template' => '<!-- Top.Mail.Ru counter -->
<script>
var _tmr = window._tmr || (window._tmr = []);
_tmr.push({id: "%s", type: "pageView", start: (new Date()).getTime()});
(function(d,w,id){
    if (d.getElementById(id)) return;
    var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
    ts.src = "https://top-fwz1.mail.ru/js/code.js";
    var f = function(){var s = d.getElementsByTagName("script")[0];s.parentNode.insertBefore(ts,s);};
    if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
})(document, window, "tmr-code");
</script>
<noscript><div><img src="https://top-fwz1.mail.ru/counter?id=%s;js=na" style="position:absolute;left:-9999px;" alt="Top.Mail.Ru"></div></noscript>
<!-- /Top.Mail.Ru counter -->'
    ]
];

$analytics = [];

// Формируем код счетчиков
foreach ($counters as $type => $counter) {
    $id = trim($counter['id']);
    if (!empty($id)) {
        $analytics[] = sprintf($counter['template'], $id, $id);
    }
}

return $analytics; 