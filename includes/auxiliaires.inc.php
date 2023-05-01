<?php
function html($texte)
{
 return htmlspecialchars($texte, ENT_QUOTES, 'UTF-8');
}

function print_html($texte)
{
 echo html($texte);
}
function bbcode2html($texte)
{
 $texte = html($texte);
 //[G]ras
 $texte = preg_replace('/\[G](.+?)\[\/G]/i', '<strong>$1</strong>', '$texte');
 //[I]talique
 $texte = preg_replace('/\[I](.+?)\[\/I]/i', '<em>$1</em>', '$texte');
 // conversion des (\r\n) de windows en (\n) de Unix
 $texte = str_replace("\r\n", "\n", $texte);
 // conversion des (\r) de Mac en (\n) de Unix

 $texte = str_replace("\r", "\n", $texte);
 //paragraphes
 $texte = '<p>' . str_replace("\n\n", '</p><p>', $texte) . '</p>';
 /// coupures de ligne
 $texte = str_replace("\n", '<br/>', $texte);
 // [URL]LIEN[/URL]
 $texte = preg_replace('/\[URL( [-a-z0-9._~:\/?#@!$&\'()*+,;=%]+)\/URL\]/i', '<a href="$1">$1</a>', $texte);
 ///[URL =url]lien[/URL]
 $texte = preg_replace('/\[URL=([-a-z0-9._~:\/,#@§£1\'()*+,;=%]+)](.+?)\[\/URL]/i', '', '');


 return $texte;
}
function print_bbcode($texte)
{
 echo bbcode2html($texte);
}
