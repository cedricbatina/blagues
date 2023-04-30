<?php
function html($texte_blague)
{
 return htmlspecialchars($texte_blague, ENT_QUOTES, 'UTF-8');
}

function print_html($texte_blague)
{
 echo html($texte_blague);
}
