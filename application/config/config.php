<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
| WARNING: You MUST set this value!
|
| If it is not set, then CodeIgniter will try guess the protocol and path
| your installation, but due to security concerns the hostname will be set
| to $_SERVER['SERVER_ADDR'] if available, or localhost otherwise.
| The auto-detection mechanism exists only for convenience during
| development and MUST NOT be used in production!
|
| If you need to allow multiple domains, remember that this file is still
| a PHP script and you can easily do that on your own.
|
*/




if ($_SERVER['HTTP_HOST'] == "panamannasankaranarayanatemple.in" || $_SERVER['HTTP_HOST'] == "www.panamannasankaranarayanatemple.in") {
    $baseurl = 'http://panamannasankaranarayanatemple.in/';
}

if ($_SERVER['HTTP_HOST'] == "panamanna.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.panamanna.templesoftware.in") {
    $baseurl = 'http://panamanna.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "keralakasi.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.keralakasi.templesoftware.in") {
    $baseurl = 'http://keralakasi.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "pundareekapuram.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.pundareekapuram.templesoftware.in") {
    $baseurl = 'http://pundareekapuram.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "nkavu.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.nkavu.templesoftware.in") {
    $baseurl = 'http://nkavu.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "parammal.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.parammal.templesoftware.in") {
    $baseurl = 'http://parammal.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "puthookkavu.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.puthookkavu.templesoftware.in") {
    $baseurl = 'http://puthookkavu.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "vasishtanadi.com" || $_SERVER['HTTP_HOST'] == "www.vasishtanadi.com") {
    $baseurl = 'http://vasishtanadi.com/';
}
if ($_SERVER['HTTP_HOST'] == "dwarakamandirdelhi.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.dwarakamandirdelhi.templesoftware.in") {
    $baseurl = 'http://dwarakamandirdelhi.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "chempallilvalyachankavu.in" || $_SERVER['HTTP_HOST'] == "www.chempallilvalyachankavu.in") {
    $baseurl = 'http://chempallilvalyachankavu.in/';
}
if ($_SERVER['HTTP_HOST'] == "chempallilvalyachankavu.com" || $_SERVER['HTTP_HOST'] == "www.chempallilvalyachankavu.com") {
    $baseurl = 'http://chempallilvalyachankavu.com/';
}
if ($_SERVER['HTTP_HOST'] == "vkavu.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.vkavu.templesoftware,in") {
    $baseurl = 'http://vkavu.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "puliyambillynambooriyachan.in" || $_SERVER['HTTP_HOST'] == "www.puliyambillynambooriyachan.in") {
    $baseurl = 'http://puliyambillynambooriyachan.in';
}
if ($_SERVER['HTTP_HOST'] == "ks.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.ks.templesoftware.in") {
    $baseurl = 'http://ks.templesoftware.in/';
}


if ($_SERVER['HTTP_HOST'] == "kalleri.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.kalleri.templesoftware.in") {
    $baseurl = 'http://kalleri.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "idimuzhikkaltheruganapathitemple.com" || $_SERVER['HTTP_HOST'] == "www.idimuzhikkaltheruganapathitemple.com") {
    $baseurl = 'https://idimuzhikkaltheruganapathitemple.com/';
}
if ($_SERVER['HTTP_HOST'] == "parthasarathi.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.parthasarathi.templesoftware.in") {
    $baseurl = 'http://parthasarathi.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "test.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.test.templesoftware.in") {
    $baseurl = 'http://test.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "eswaramangalam.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.eswaramangalam.templesoftware.in") {
    $baseurl = 'http://eswaramangalam.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "kanjooli.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.kanjooli.templesoftware.in") {
    $baseurl = 'http://kanjooli.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "kanjoorpuliyambillymahakaali.in" || $_SERVER['HTTP_HOST'] == "www.kanjoorpuliyambillymahakaali.in") {
    $baseurl = 'http://kanjoorpuliyambillymahakaali.in';
}
if ($_SERVER['HTTP_HOST'] == "eroorgurumaheswaram.com" || $_SERVER['HTTP_HOST'] == "www.eroorgurumaheswaram.com") {
    $baseurl = 'http://eroorgurumaheswaram.com';
}
if ($_SERVER['HTTP_HOST'] == "sreeardhanareeswaratemplejalavasam.com" || $_SERVER['HTTP_HOST'] == "www.sreeardhanareeswaratemplejalavasam.com") {
    $baseurl = 'http://sreeardhanareeswaratemplejalavasam.com/';
}
if ($_SERVER['HTTP_HOST'] == "kattakambal.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.kattakambal.templesoftware.in") {
    $baseurl = 'http://kattakambal.templesoftware.in/';
}
if ($_SERVER['HTTP_HOST'] == "http://kattakampalbhagavathikshethram.com" || $_SERVER['HTTP_HOST'] == "www.kattakampalbhagavathikshethram.com") {
    $baseurl = 'http://kattakampalbhagavathikshethram.com/';
}
else if ($_SERVER['HTTP_HOST'] == "udayamangalamsreekrishna.com" || $_SERVER['HTTP_HOST'] == "www.udayamangalamsreekrishna.com") {
    $baseurl = 'http://udayamangalamsreekrishna.com/';
}
////http://rishipuramsivakshethram.in/
else if ($_SERVER['HTTP_HOST'] == "thrikaikat.templesoftware.in" || $_SERVER['HTTP_HOST'] == "thrikaikat.templesoftware.in") {
    $baseurl = 'http://thrikaikat.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "mankuzhikavu.templesoftware.in" ||$_SERVER['HTTP_HOST'] == "mankuzhikavu.templesoftware.in") {
    $baseurl = 'http://mankuzhikavu.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "vasai.templesoftware.in" || $_SERVER['HTTP_HOST'] == "vasai.templesoftware.in") {
    $baseurl = 'http://vasai.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "thayat.templesoftware.in" || $_SERVER['HTTP_HOST'] == "thayat.templesoftware.in") {
    $baseurl = 'http://thayat.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "kalpathy.templesoftware.in" || $_SERVER['HTTP_HOST'] == "kalpathy.templesoftware.in") {
    $baseurl = 'http://kalpathy.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "parambil.templesoftware.in" || $_SERVER['HTTP_HOST'] == "parambil.templesoftware.in") {
    $baseurl = 'http://parambil.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "akra.templesoftware.in" || $_SERVER['HTTP_HOST'] == "akra.templesoftware.in") {
    $baseurl = 'http://akra.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "kovoor.templesoftware.in" || $_SERVER['HTTP_HOST'] == "kovoor.templesoftware.in") {
    $baseurl = 'http://kovoor.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "sobhaparamba.templesoftware.in" || $_SERVER['HTTP_HOST'] == "sobhaparamba.templesoftware.in") {
    $baseurl = 'http://sobhaparamba.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "kaithara.templesoftware.in" || $_SERVER['HTTP_HOST'] == "kaithara.templesoftware.in") {
    $baseurl = 'http://kaithara.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "vaikathur.templesoftware.in" || $_SERVER['HTTP_HOST'] == "vaikathur.templesoftware.in") {
    $baseurl = 'http://vaikathur.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "areekulangara.templesoftware.in" || $_SERVER['HTTP_HOST'] == "areekulangara.templesoftware.in") {
    $baseurl = 'http://areekulangara.templesoftware.in';

}
else if ($_SERVER['HTTP_HOST'] == "pp.templesoftware.in" || $_SERVER['HTTP_HOST'] == "pp.templesoftware.in") {
    $baseurl = 'http://pp.templesoftware.in';

}

else if ($_SERVER['HTTP_HOST'] == "malaysia.templesoftware.in" || $_SERVER['HTTP_HOST'] == "malaysia.templesoftware.in") {
    $baseurl = 'http://malaysia.templesoftware.in';

}
else if ($_SERVER['HTTP_HOST'] == "anayedath.templesoftware.in" || $_SERVER['HTTP_HOST'] == "anayedath.templesoftware.in") {
    $baseurl = 'http://anayedath.templesoftware.in';

}
	
else if ($_SERVER['HTTP_HOST'] == "saligramam.templesoftware.in" || $_SERVER['HTTP_HOST'] == "saligramam.templesoftware.in") {
    $baseurl = 'http://saligramam.templesoftware.in/';

}

else if ($_SERVER['HTTP_HOST'] == "shaneshwaratemple.templesoftware.in" || $_SERVER['HTTP_HOST'] == "shaneshwaratemple.templesoftware.in") {
    $baseurl = 'http://shaneshwaratemple.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "puthiyakavu.templesoftware.in" || $_SERVER['HTTP_HOST'] == "puthiyakavu.templesoftware.in") {
    $baseurl = 'http://puthiyakavu.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "sreeollursivakshethram.com" || $_SERVER['HTTP_HOST'] == "sreeollursivakshethram.com") {
    $baseurl = 'http://sreeollursivakshethram.com/';

}
else if ($_SERVER['HTTP_HOST'] == "app.tirumoolarashram.org" || $_SERVER['HTTP_HOST'] == "app.tirumoolarashram.org") {
    $baseurl = 'http://app.tirumoolarashram.org/';

}
else if ($_SERVER['HTTP_HOST'] == "bharananganamtemple.in" || $_SERVER['HTTP_HOST'] == "www.bharananganamtemple.in") {
    $baseurl = 'http://bharananganamtemple.in/';

}

else if ($_SERVER['HTTP_HOST'] == "bharananganamtemple.com" || $_SERVER['HTTP_HOST'] == "www.bharananganamtemple.com") {
    $baseurl = 'http://bharananganamtemple.com/';

}

else if ($_SERVER['HTTP_HOST'] == "sdasds.org" || $_SERVER['HTTP_HOST'] == "www.sdasds.org") {
    $baseurl = 'http://sdasds.org/';

}
else if ($_SERVER['HTTP_HOST'] == "bst.templesoftware.in" || $_SERVER['HTTP_HOST'] == "bst.templesoftware.in") {
    $baseurl = 'http://bst.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "nblm.templesoftware.in" || $_SERVER['HTTP_HOST'] == "nblm.templesoftware.in") {
    $baseurl = 'http://nblm.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "k1.templesoftware.in" || $_SERVER['HTTP_HOST'] == "k1.templesoftware.in") {
    $baseurl = 'http://k1.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "cp.templesoftware.in" || $_SERVER['HTTP_HOST'] == "cp.templesoftware.in") {
    $baseurl = 'http://cp.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "puthoor.templesoftware.in" || $_SERVER['HTTP_HOST'] == "puthoor.templesoftware.in") {
    $baseurl = 'http://puthoor.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "ponekakvu.templesoftware.in" || $_SERVER['HTTP_HOST'] == "ponekkavu.templesoftware.in") {
    $baseurl = 'http://ponekkavu.templesoftware.in/';

}
////http://rishipuramsivakshethram.in/
else if ($_SERVER['HTTP_HOST'] == "nh2.templesoftware.in" || $_SERVER['HTTP_HOST'] == "mh2.templesoftware.in") {
    $baseurl = 'http://nh2.templesoftware.in/';

}
////http://rishipuramsivakshethram.in/
else if ($_SERVER['HTTP_HOST'] == "komangalamsivatemple.templesoftware.in" || $_SERVER['HTTP_HOST'] == "komangalamsivatemple.templesoftware.in") {
    $baseurl = 'http://komangalamsivatemple.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "hindidemo.templesoftware.in" || $_SERVER['HTTP_HOST'] == "hindidemo.templesoftware.in") {
    $baseurl = 'http://hindidemo.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "chennamkulangara.templesoftware.in" || $_SERVER['HTTP_HOST'] == "chennamkulangara.templesoftware.in") {
    $baseurl = 'http://chennamkulangara.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "mannursivatemple.templesoftware.in" || $_SERVER['HTTP_HOST'] == "mannursivatemple.templesoftware.in") {
    $baseurl = 'http://mannursivatemple.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "mannurmahadevatemple.com" || $_SERVER['HTTP_HOST'] == "mannurmahadevatemple.com") {
    $baseurl = 'http://mannurmahadevatemple.com/';

}
else if ($_SERVER['HTTP_HOST'] == "udayamangalam.templesoftware.in" || $_SERVER['HTTP_HOST'] == "udayamangalam.templesoftware.in") {
    $baseurl = 'http://udayamangalam.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "pavittameethal.templesoftware.in" || $_SERVER['HTTP_HOST'] == "pavittameethal.templesoftware.in") {
    $baseurl = 'http://pavittameethal.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "gokulam.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.gokulam.templesoftware.in") {
    $baseurl = 'http://gokulam.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "chelannursivatemple.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.chelannursivatemple.templesoftware.in") {
    $baseurl = 'http://chelannursivatemple.templesoftware.in/';

}

////http://rishipuramsivakshethram.in/
else if ($_SERVER['HTTP_HOST'] == "mithranandapuram.templesoftware.in" || $_SERVER['HTTP_HOST'] == "mithranandapuram.templesoftware.in") {
    $baseurl = 'http://mithranandapuram.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "pantheerankavuvishnu.templesoftware.in" || $_SERVER['HTTP_HOST'] == "mithranandapuram.templesoftware.in") {
    $baseurl = 'http://pantheerankavuvishnu.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "mithranandapuramvamanamoorthytemple.in" || $_SERVER['HTTP_HOST'] == "mithranandapuramvamanamoorthytemple.in") {
    $baseurl = 'http://mithranandapuramvamanamoorthytemple.in/';

}
else if ($_SERVER['HTTP_HOST'] == "punnyam.encloudconsulting.com" || $_SERVER['HTTP_HOST'] == "punnyam.encloudconsulting.com") {
    $baseurl = 'http://punnyam.encloudconsulting.com/';

}

else if ($_SERVER['HTTP_HOST'] == "samithi.kattakampalbhagavathikshethram.com" || $_SERVER['HTTP_HOST'] == "samithi.kattakampalbhagavathikshethram.com") {
    $baseurl = 'http://samithi.kattakampalbhagavathikshethram.com/';

}
	
else if ($_SERVER['HTTP_HOST'] == "arulipuram.templesoftware.in" || $_SERVER['HTTP_HOST'] == "arulipuram.templesoftware.in") {
    $baseurl = 'http://arulipuram.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "thayamkulangara.templesoftware.in" || $_SERVER['HTTP_HOST'] == "thayamkulangara.templesoftware.in") {
    $baseurl = 'http://thayamkulangara.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "manikandeswaram.templesoftware.in" || $_SERVER['HTTP_HOST'] == "manikandeswaram.templesoftware.in") {
    $baseurl = 'http://manikandeswaram.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "nottanalukkalbhagavathi.com" || $_SERVER['HTTP_HOST'] == "nottanalukkalbhagavathi.com") {
    $baseurl = 'http://nottanalukkalbhagavathi.com/';

}
else if ($_SERVER['HTTP_HOST'] == "thaneerbhagavathi.templesoftware.in" || $_SERVER['HTTP_HOST'] == "arulipuram.templesoftware.in") {
    $baseurl = 'http://thaneerbhagavathi.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "kizhekkavu.templesoftware.in" || $_SERVER['HTTP_HOST'] == "kizhekkavu.templesoftware.in") {
    $baseurl = 'http://kizhekkavu.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "trikkulam.templesoftware.in" || $_SERVER['HTTP_HOST'] == "trikkulam.templesoftware.in") {
    $baseurl = 'http://trikkulam.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "shirdi.templesoftware.in" || $_SERVER['HTTP_HOST'] == "shirdi.templesoftware.in") {
    $baseurl = 'http://shirdi.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "kattakampalbhagavathikshethram.com" || $_SERVER['HTTP_HOST'] == "kattakampalbhagavathikshethram.com") {
    $baseurl = 'http://kattakampalbhagavathikshethram.com/';

}
else if ($_SERVER['HTTP_HOST'] == "tripuranthaka.templesoftware.in" || $_SERVER['HTTP_HOST'] == "thrikaikat.templesoftware.in") {
    $baseurl = 'http://tripuranthaka.templesoftware.in/';

}
	 	
else if ($_SERVER['HTTP_HOST'] == "pallathamkulangara.templesoftware.in" || $_SERVER['HTTP_HOST'] == "pallathamkulangara.templesoftware.inn") {
    $baseurl = 'http://pallathamkulangara.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "asokapuram.templesoftware.in" || $_SERVER['HTTP_HOST'] == "asokapuram.templesoftware.in") {
    $baseurl = 'http://asokapuram.templesoftware.in/';

}
else if ($_SERVER['HTTP_HOST'] == "narakathshribhagawathi.com" || $_SERVER['HTTP_HOST'] == "narakathshribhagawathi.com") {
    $baseurl = 'http://narakathshribhagawathi.com/';

}
else if ($_SERVER['HTTP_HOST'] == "kamakshiambaltrust.org" || $_SERVER['HTTP_HOST'] == "www.kamakshiambaltrust.org") {
    $baseurl = 'https://kamakshiambaltrust.org/';
}
else if ($_SERVER['HTTP_HOST'] == "alathiyoor.templesoftware.in" || $_SERVER['HTTP_HOST'] == "alathiyoor.templesoftware.in") {
    $baseurl = 'http://alathiyoor.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "peringavu.templesoftware.in" || $_SERVER['HTTP_HOST'] == "peringavu.templesoftware.in") {
    $baseurl = 'http://peringavu.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "alathiyoor.templesoftware.in" || $_SERVER['HTTP_HOST'] == "alathiyoor.templesoftware.in") 
{
    $baseurl = 'http://alathiyoor.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "kalady.templesoftware.in" || $_SERVER['HTTP_HOST'] == "kalady.templesoftware.in") {
    $baseurl = 'http://kalady.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "kakkad.templesoftware.in" || $_SERVER['HTTP_HOST'] == "kakkad.templesoftware.in") {
    $baseurl = 'http://kakkad.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "kaiparambu.templesoftware.in" || $_SERVER['HTTP_HOST'] == "kaiparambu.templesoftware.in") {
    $baseurl = 'http://kaiparambu.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org" || $_SERVER['HTTP_HOST'] == "kaladyshankaramadomts.org") {
    $baseurl = 'https://kaladyshankaramadomts.org/';
}
else if ($_SERVER['HTTP_HOST'] == "ayb.kaladyshankaramadomts.org" || $_SERVER['HTTP_HOST'] == "ayb.kaladyshankaramadomts.org") {
    $baseurl = 'https://ayb.kaladyshankaramadomts.org/';
}
else if ($_SERVER['HTTP_HOST'] == "areekulangaradevitemple.com" || $_SERVER['HTTP_HOST'] == "www.areekulangaradevitemple.com") {
    $baseurl = 'http://areekulangaradevitemple.com/';

}
else if ($_SERVER['HTTP_HOST'] == "perumparambasiva.com" || $_SERVER['HTTP_HOST'] == "www.perumparambasiva.com") {
    $baseurl = 'http://perumparambasiva.com/';

}
else if ($_SERVER['HTTP_HOST'] == "parambilmahavishnutemple.com" || $_SERVER['HTTP_HOST'] == "www.parambilmahavishnutemple.com") {
    $baseurl = 'http://parambilmahavishnutemple.com/';

}
else if ($_SERVER['HTTP_HOST'] == "sreepariharapuramsubrahmaniyatemple.in" || $_SERVER['HTTP_HOST'] == "www.sreepariharapuramsubrahmaniyatemple.in") {
    $baseurl = 'http://sreepariharapuramsubrahmaniyatemple.in/';

}
else if ($_SERVER['HTTP_HOST'] == "sreerameswaramsivatemple.in" || $_SERVER['HTTP_HOST'] == "www.sreerameswaramsivatemple.in") {
    $baseurl = 'http://sreerameswaramsivatemple.in';

}
else if ($_SERVER['HTTP_HOST'] == "rishipuramsivakshethram.in" || $_SERVER['HTTP_HOST'] == "www.rishipuramsivakshethram.in") {
    $baseurl = 'http://rishipuramsivakshethram.in/';
}
else if ($_SERVER['HTTP_HOST'] == "sreemahadevamangalam.com" || $_SERVER['HTTP_HOST'] == "www.sreemahadevamangalam.com") {
    $baseurl = 'http://sreemahadevamangalam.com/';
}
else if ($_SERVER['HTTP_HOST'] == "sreevalliyoorkavubhagavathi.com" || $_SERVER['HTTP_HOST'] == "www.sreevalliyoorkavubhagavathi.com") {
    $baseurl = 'http://sreevalliyoorkavubhagavathi.com/';
}
else if ($_SERVER['HTTP_HOST'] == "rishipuramsivakshethram.in" || $_SERVER['HTTP_HOST'] == "www.rishipuramsivakshethram.inm") {
    $baseurl = 'http://rishipuramsivakshethram.in/';
}
else if ($_SERVER['HTTP_HOST'] == "manjerisreearukizhayasivakshethram.com" || $_SERVER['HTTP_HOST'] == "www.manjerisreearukizhayasivakshethram.com
") {
    $baseurl = 'http://manjerisreearukizhayasivakshethram.com/';
}

else if ($_SERVER['HTTP_HOST'] == "azhathrikkovil.com" || $_SERVER['HTTP_HOST'] == "www.azhathrikkovil.com

") {
    $baseurl = 'http://azhathrikkovil.com/';
}
else if ($_SERVER['HTTP_HOST'] == "sankaramkulangara.com" || $_SERVER['HTTP_HOST'] == "www.sankaramkulangara.com") {
    $baseurl = 'http://sankaramkulangara.com/';
}
else if ($_SERVER['HTTP_HOST'] == "parakkunnathtemple.com" || $_SERVER['HTTP_HOST'] == "www.parakkunnathtemple.com")
{
    $baseurl = 'http://parakkunnathtemple.com/';
}

else if ($_SERVER['HTTP_HOST'] == "vallikkadmahadevatemple.com" || $_SERVER['HTTP_HOST'] == "www.vallikkadmahadevatemple.com")
{
    $baseurl = 'http://vallikkadmahadevatemple.com/';
}
else if ($_SERVER['HTTP_HOST'] == "pallathamkulangarebhagavathytemple.com" || $_SERVER['HTTP_HOST'] == "www.pallathamkulangarebhagavathytemple.com")
{
    $baseurl = 'http://pallathamkulangarebhagavathytemple.com/';
}
else if ($_SERVER['HTTP_HOST'] == "punnyampos.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.punnyampos.templesoftware.in")
{
    $baseurl = 'http://punnyampos.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "karulai.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.karulai.templesoftware.in")
{
    $baseurl = 'http://karulai.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "nenmara.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.nenmara.templesoftware.in")
{
    $baseurl = 'http://nenmara.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "annanagarayyappatemple.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.punnyampos.templesoftware.in")
{
    $baseurl = 'http://annanagarayyappatemple.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "ayt.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.ayt.templesoftware.in")
{
    $baseurl = 'http://ayt.templesoftware.in';
}
else if ($_SERVER['HTTP_HOST'] == "ayt.kaladyshankaramadomts.org" || $_SERVER['HTTP_HOST'] == "www.ayt.kaladyshankaramadomts.org")
{
    $baseurl = 'https://ayt.kaladyshankaramadomts.org';
}

else if ($_SERVER['HTTP_HOST'] == "pandamangalam.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.punnyampos.templesoftware.in")
{
    $baseurl = 'http://pandamangalam.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "thiruvullakavu.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.thiruvullakavu.templesoftware.in")
{
    $baseurl = 'http://thiruvullakavu.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "puthiyakavubhagavathitemple.com" || $_SERVER['HTTP_HOST'] == "www.puthiyakavubhagavathitemple.com")
{
    $baseurl = 'http://puthiyakavubhagavathitemple.com/';
}
else if ($_SERVER['HTTP_HOST'] == "karukaputhursrenarasimhamurthitemple.com" || $_SERVER['HTTP_HOST'] == "www.karukaputhursrenarasimhamurthitemple.com")
{
    $baseurl = 'http://karukaputhursrenarasimhamurthitemple.com/';
}

else if ($_SERVER['HTTP_HOST'] == "telungu.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.telungu.templesoftware.in")
{
    $baseurl = 'http://telungu.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "kanchepuram.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.kanchepuram.templesoftware.in")
{
    $baseurl = 'http://kanchepuram.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "kadampuzha.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.kadampuzha.templesoftware.in")
{
    $baseurl = 'http://kadampuzha.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "chelur.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.chelur.templesoftware.in")
{
    $baseurl = 'http://chelur.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "amruthamangalam.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.amruthamangalam.templesoftware.in")
{
    $baseurl = 'http://amruthamangalam.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "sreevadakurumbakavu.com" || $_SERVER['HTTP_HOST'] == "www.sreevadakurumbakavu.com") {
    $baseurl = 'http://sreevadakurumbakavu.com';
}
else if ($_SERVER['HTTP_HOST'] == "panniyankaradurgatemple.com" || $_SERVER['HTTP_HOST'] == "www.panniyankaradurgatemple.com") {
    $baseurl = 'http://panniyankaradurgatemple.com';
}

else if ($_SERVER['HTTP_HOST'] == "kachamkurissi.in" || $_SERVER['HTTP_HOST'] == "www.kachamkurissi.in") {
    $baseurl = 'http://kachamkurissi.in';
}

else if ($_SERVER['HTTP_HOST'] == "sreeoottukulangarabhagavathidevaswom.in" || $_SERVER['HTTP_HOST'] == "www.sreeoottukulangarabhagavathidevaswom.in") {
    $baseurl = 'https://sreeoottukulangarabhagavathidevaswom.in';
}
else if ($_SERVER['HTTP_HOST'] == "vadakkantharatemple.in" || $_SERVER['HTTP_HOST'] == "www.vadakkantharatemple.in
") {
    $baseurl = 'http://vadakkantharatemple.in/';
}
else if ($_SERVER['HTTP_HOST'] == "lucknow.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.lucknow.templesoftware.in
") {
    $baseurl = 'http://lucknow.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "mookuthala.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.mookuthala.templesoftware.in
") {
    $baseurl = 'http://mookuthala.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "cherursreenarasimhamoorthy.in" || $_SERVER['HTTP_HOST'] == "www.cherursreenarasimhamoorthy.in") {
    $baseurl = 'http://cherursreenarasimhamoorthy.in/';
}
else if ($_SERVER['HTTP_HOST'] == "vaikathursreemahadevatemple.com" || $_SERVER['HTTP_HOST'] == "www.vaikathursreemahadevatemple.com" || $_SERVER['HTTP_HOST'] == "https://vaikathursreemahadevatemple.com") {
    $baseurl = 'http://vaikathursreemahadevatemple.com/';
}
else if ($_SERVER['HTTP_HOST'] == "sreeramapuramvishnudevaswom.com" || $_SERVER['HTTP_HOST'] == "www.sreeramapuramvishnudevaswom.com") {
    $baseurl = 'http://sreeramapuramvishnudevaswom.com/';
}
else if ($_SERVER['HTTP_HOST'] == "mukkannamsivatemple.in" || $_SERVER['HTTP_HOST'] == "www.mukkannamsivatemple.in
") {
    $baseurl = 'http://mukkannamsivatemple.in/';
}
else if ($_SERVER['HTTP_HOST'] == "eyyalkarthyayanidurgadevitemple.in" || $_SERVER['HTTP_HOST'] == "www.eyyalkarthyayanidurgadevitemple.in") {
    $baseurl = 'http://eyyalkarthyayanidurgadevitemple.in/';
}
else if ($_SERVER['HTTP_HOST'] == "eyyal.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.eyyal.templesoftware.in") {
    $baseurl = 'http://eyyal.templesoftware.in';
}
else if ($_SERVER['HTTP_HOST'] == "rameswaram.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.rameswaram.templesoftware.in") {
    $baseurl = 'http://rameswaram.templesoftware.in';
}
else if ($_SERVER['HTTP_HOST'] == "pariharapuram.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.pariharapuram.templesoftware.in") {
    $baseurl = 'http://pariharapuram.templesoftware.in';
}


else if ($_SERVER['HTTP_HOST'] == "illathbhadhrakalitemple.com" || $_SERVER['HTTP_HOST'] == "www.illathbhadhrakalitemple.com") {
    $baseurl = 'http://illathbhadhrakalitemple.com/';
}
else if ($_SERVER['HTTP_HOST'] == "cochin.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.cochin.templesoftware.in
") {
    $baseurl = 'http://cochin.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "sakaleswari.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.sakaleswari.templesoftware.in
") {
    $baseurl = 'http://sakaleswari.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "manathalasivaparvathitemple.com" || $_SERVER['HTTP_HOST'] == "www.manathalasivaparvathitemple.com") {
    $baseurl = 'http://manathalasivaparvathitemple.com/';
}
else if ($_SERVER['HTTP_HOST'] == "sreesakaleswaritemple.in" || $_SERVER['HTTP_HOST'] == "www.sreesakaleswaritemple.in") {
    $baseurl = 'http://sreesakaleswaritemple.in/';
}
else if ($_SERVER['HTTP_HOST'] == "sreerayiramangalamsivaksethram.com" || $_SERVER['HTTP_HOST'] == "www.sreerayiramangalamsivaksethram.com") {
    $baseurl = 'http://sreerayiramangalamsivaksethram.com/';
}
else if ($_SERVER['HTTP_HOST'] == "sreesivadurgadevitemple.in" || $_SERVER['HTTP_HOST'] == "www.sreesivadurgadevitemple.in") {
    $baseurl = 'http://sreesivadurgadevitemple.in/';
}
else if ($_SERVER['HTTP_HOST'] == "elanjikkaldevikshetram.com" || $_SERVER['HTTP_HOST'] == "www.elanjikkaldevikshetram.com") {
    $baseurl = 'http://elanjikkaldevikshetram.com/';
}
else if ($_SERVER['HTTP_HOST'] == "sreeudayakurumbabhagavathikshethram.com" || $_SERVER['HTTP_HOST'] == "www.sreeudayakurumbabhagavathikshethram.com") {
    $baseurl = 'http://sreeudayakurumbabhagavathikshethram.com/';
}
else if ($_SERVER['HTTP_HOST'] == "chenthalavishnutemple.com" || $_SERVER['HTTP_HOST'] == "www.chenthalavishnutemple.com") {
    $baseurl = 'http://chenthalavishnutemple.com/';
}
else if ($_SERVER['HTTP_HOST'] == "chenthala.templesoftware.in" || $_SERVER['HTTP_HOST'] == "www.chenthala.templesoftware.in") {
    $baseurl = 'http://chenthala.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "sreethiruvangattemple.in" || $_SERVER['HTTP_HOST'] == "www.sreethiruvangattemple.in") {
    $baseurl = 'http://sreethiruvangattemple.in/';
}
else if ($_SERVER['HTTP_HOST'] == "sreelakshminarasimhamoorthytemple.com" || $_SERVER['HTTP_HOST'] == "www.sreelakshminarasimhamoorthytemple.com") {
    $baseurl = 'http://sreelakshminarasimhamoorthytemple.com/';
}
else if ($_SERVER['HTTP_HOST'] == "nellikodesreevishnu.in" || $_SERVER['HTTP_HOST'] == "www.nellikodesreevishnu.in") {
    $baseurl = 'http://nellikodesreevishnu.in/';
}
else if ($_SERVER['HTTP_HOST'] == "vadakkemanaliyarkavu.in" || $_SERVER['HTTP_HOST'] == "www.vadakkemanaliyarkavu.in") {
    $baseurl = 'http://vadakkemanaliyarkavu.in/';
}
else if ($_SERVER['HTTP_HOST'] == "kallursreemahavishnu.com" || $_SERVER['HTTP_HOST'] == "www.kallursreemahavishnu.com") {
    $baseurl = 'http://kallursreemahavishnu.com/';
}
else if ($_SERVER['HTTP_HOST'] == "kodikkunnubhagavathi.com" || $_SERVER['HTTP_HOST'] == "www.kodikkunnubhagavathi.com") {
    $baseurl = 'http://kodikkunnubhagavathi.com/';
}
else if ($_SERVER['HTTP_HOST'] == "trikkulamsivatemple.in" || $_SERVER['HTTP_HOST'] == "www.trikkulamsivatemple.in") {
    $baseurl = 'http://trikkulamsivatemple.in/';
}
else if ($_SERVER['HTTP_HOST'] == "sobhaparambubhagavathi.com" || $_SERVER['HTTP_HOST'] == "www.sobhaparambubhagavathi.com") {
    $baseurl = 'http://sobhaparambubhagavathi.com/';
}
else if ($_SERVER['HTTP_HOST'] == "mankuzhikavubhagavathi.com" ||$_SERVER['HTTP_HOST'] == "www.mankuzhikavubhagavathi.com") {
    $baseurl = 'http://mankuzhikavubhagavathi.com/';
}
else if ($_SERVER['HTTP_HOST'] == "www.mankuzhikavubhagavathi.com") {
    $baseurl = 'http://mankuzhikavubhagavathi.com/';
}
else if ($_SERVER['HTTP_HOST'] == "kovoorvishnutemple.com"||$_SERVER['HTTP_HOST'] == "www.kovoorvishnutemple.com") {
    $baseurl = 'http://kovoorvishnutemple.com/';
}
else if ($_SERVER['HTTP_HOST'] == "skptclt.in"||$_SERVER['HTTP_HOST'] == "www.skptclt.in") {
    $baseurl = 'http://skptclt.in/';
}
else if ($_SERVER['HTTP_HOST'] == "sreevayambattavishnutemple.in"||$_SERVER['HTTP_HOST'] == "www.sreevayambattavishnutemple.in") {
    $baseurl = 'https://sreevayambattavishnutemple.in/';
}
else if ($_SERVER['HTTP_HOST'] == "ponnanitrikkavubhagavathi.com"||$_SERVER['HTTP_HOST'] == "www.ponnanitrikkavubhagavathi.com") {
    $baseurl = 'http://ponnanitrikkavubhagavathi.com/';
}

	 	
else if ($_SERVER['HTTP_HOST'] == "thalikunnumahasivatemple.in"||$_SERVER['HTTP_HOST'] == "www.thalikunnumahasivatemple.in") {
    $baseurl = 'http://thalikunnumahasivatemple.in/';
}
else if ($_SERVER['HTTP_HOST'] == "trikkandiyurambalakulangarabhagavathi.com"||$_SERVER['HTTP_HOST'] == "www.trikkandiyurambalakulangarabhagavathi.com") {
    $baseurl = 'http://trikkandiyurambalakulangarabhagavathi.com/';
}
else if ($_SERVER['HTTP_HOST'] == "sreevyramahakalikavukshethramkarad.in"||$_SERVER['HTTP_HOST'] == "www.sreevyramahakalikavukshethramkarad.in") {
    $baseurl = 'http://sreevyramahakalikavukshethramkarad.in/';
}
else if ($_SERVER['HTTP_HOST'] == "mookkuthalabhagavathitemple.com"||$_SERVER['HTTP_HOST'] == "www.mookkuthalabhagavathitemple.com") {
    $baseurl = 'http://mookkuthalabhagavathitemple.com/';
}
else if ($_SERVER['HTTP_HOST'] == "brahmatemple.in"||$_SERVER['HTTP_HOST'] == "www.brahmatemple.in") {
    $baseurl = 'http://brahmatemple.in/';
}
else if ($_SERVER['HTTP_HOST'] == "nhangattiribhagavathydevsawom.com"||$_SERVER['HTTP_HOST'] == "www.nhangattiribhagavathydevsawom.com") {
    $baseurl = 'http://nhangattiribhagavathydevsawom.com/';
}
else if ($_SERVER['HTTP_HOST'] == "azhinhilamthalimahavishnukshethram.com"  || $_SERVER['HTTP_HOST'] == "www.azhinhilamthalimahavishnukshethram.com") {
    $baseurl = 'http://azhinhilamthalimahavishnukshethram.com/';
} 
else if ($_SERVER['HTTP_HOST'] == "idimuzhikkal.templesoftware.in"  || $_SERVER['HTTP_HOST'] == "www.idimuzhikkal.templesoftware.in") {
    $baseurl = 'http://idimuzhikkal.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "idm2.templesoftware.in"  || $_SERVER['HTTP_HOST'] == "www.idm2.templesoftware.in") {
    $baseurl = 'http://idm2.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "narakath.templesoftware.in"  || $_SERVER['HTTP_HOST'] == "www.narakath.templesoftware.in") {
    $baseurl = 'http://narakath.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "balusserykotta.templesoftware.in"  || $_SERVER['HTTP_HOST'] == "www.balusserykotta.templesoftware.in") {
    $baseurl = 'http://balusserykotta.templesoftware.in/';
}
else if ($_SERVER['HTTP_HOST'] == "balusserykotta.com"  || $_SERVER['HTTP_HOST'] == "www.balusserykotta.com") {
    $baseurl = 'http://balusserykotta.com';
}
if ($_SERVER['HTTP_HOST'] == "demo.punnyamtemplesuite.in"||$_SERVER['HTTP_HOST'] == "www.demo.punnyamtemplesuite.in") {
    $baseurl = 'http://demo.punnyamtemplesuite.in/';
}
$baseurl='http://localhost/vyra';
$config['base_url'] = $baseurl;

/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
| Typically this will be your index.php file, unless you've renamed it to
| something else. If you are using mod_rewrite to remove the page set this
| variable so that it is blank.
|
*/
$config['index_page'] = 'index.php';

/*
|--------------------------------------------------------------------------
| URI PROTOCOL
|--------------------------------------------------------------------------
|
| This item determines which server global should be used to retrieve the
| URI string.  The default setting of 'REQUEST_URI' works for most servers.
| If your links do not seem to work, try one of the other delicious flavors:
|
| 'REQUEST_URI'    Uses $_SERVER['REQUEST_URI']
| 'QUERY_STRING'   Uses $_SERVER['QUERY_STRING']
| 'PATH_INFO'      Uses $_SERVER['PATH_INFO']
|
| WARNING: If you set this to 'PATH_INFO', URIs will always be URL-decoded!
*/
$config['uri_protocol']	= 'REQUEST_URI';

/*
|--------------------------------------------------------------------------
| URL suffix
|--------------------------------------------------------------------------
|
| This option allows you to add a suffix to all URLs generated by CodeIgniter.
| For more information please see the user guide:
|
| https://codeigniter.com/user_guide/general/urls.html
*/
$config['url_suffix'] = '';

/*
|--------------------------------------------------------------------------
| Default Language
|--------------------------------------------------------------------------
|
| This determines which set of language files should be used. Make sure
| there is an available translation if you intend to use something other
| than english.
|
*/
$config['language']	= 'english';

/*
|--------------------------------------------------------------------------
| Default Character Set
|--------------------------------------------------------------------------
|
| This determines which character set is used by default in various methods
| that require a character set to be provided.
|
| See http://php.net/htmlspecialchars for a list of supported charsets.
|
*/
$config['charset'] = 'UTF-8';

/*
|--------------------------------------------------------------------------
| Enable/Disable System Hooks
|--------------------------------------------------------------------------
|
| If you would like to use the 'hooks' feature you must enable it by
| setting this variable to TRUE (boolean).  See the user guide for details.
|
*/
$config['enable_hooks'] = FALSE;

/*
|--------------------------------------------------------------------------
| Class Extension Prefix
|--------------------------------------------------------------------------
|
| This item allows you to set the filename/classname prefix when extending
| native libraries.  For more information please see the user guide:
|
| https://codeigniter.com/user_guide/general/core_classes.html
| https://codeigniter.com/user_guide/general/creating_libraries.html
|
*/
$config['subclass_prefix'] = 'MY_';

/*
|--------------------------------------------------------------------------
| Composer auto-loading
|--------------------------------------------------------------------------
|
| Enabling this setting will tell CodeIgniter to look for a Composer
| package auto-loader script in application/vendor/autoload.php.
|
|	$config['composer_autoload'] = TRUE;
|
| Or if you have your vendor/ directory located somewhere else, you
| can opt to set a specific path as well:
|
|	$config['composer_autoload'] = '/path/to/vendor/autoload.php';
|
| For more information about Composer, please visit http://getcomposer.org/
|
| Note: This will NOT disable or override the CodeIgniter-specific
|	autoloading (application/config/autoload.php)
*/
$config['composer_autoload'] = "vendor/autoload.php";

/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
|
| This lets you specify which characters are permitted within your URLs.
| When someone tries to submit a URL with disallowed characters they will
| get a warning message.
|
| As a security measure you are STRONGLY encouraged to restrict URLs to
| as few characters as possible.  By default only these are allowed: a-z 0-9~%.:_-
|
| Leave blank to allow all characters -- but only if you are insane.
|
| The configured value is actually a regular expression character group
| and it will be executed as: ! preg_match('/^[<permitted_uri_chars>]+$/i
|
| DO NOT CHANGE THIS UNLESS YOU FULLY UNDERSTAND THE REPERCUSSIONS!!
|
*/
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';

/*
|--------------------------------------------------------------------------
| Enable Query Strings
|--------------------------------------------------------------------------
|
| By default CodeIgniter uses search-engine friendly segment based URLs:
| example.com/who/what/where/
|
| You can optionally enable standard query string based URLs:
| example.com?who=me&what=something&where=here
|
| Options are: TRUE or FALSE (boolean)
|
| The other items let you set the query string 'words' that will
| invoke your controllers and its functions:
| example.com/index.php?c=controller&m=function
|
| Please note that some of the helpers won't work as expected when
| this feature is enabled, since CodeIgniter is designed primarily to
| use segment based URLs.
|
*/
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';

/*
|--------------------------------------------------------------------------
| Allow $_GET array
|--------------------------------------------------------------------------
|
| By default CodeIgniter enables access to the $_GET array.  If for some
| reason you would like to disable it, set 'allow_get_array' to FALSE.
|
| WARNING: This feature is DEPRECATED and currently available only
|          for backwards compatibility purposes!
|
*/
$config['allow_get_array'] = TRUE;

/*
|--------------------------------------------------------------------------
| Error Logging Threshold
|--------------------------------------------------------------------------
|
| You can enable error logging by setting a threshold over zero. The
| threshold determines what gets logged. Threshold options are:
|
|	0 = Disables logging, Error logging TURNED OFF
|	1 = Error Messages (including PHP errors)
|	2 = Debug Messages
|	3 = Informational Messages
|	4 = All Messages
|
| You can also pass an array with threshold levels to show individual error types
|
| 	array(2) = Debug Messages, without Error Messages
|
| For a live site you'll usually only enable Errors (1) to be logged otherwise
| your log files will fill up very fast.
|
*/
$config['log_threshold'] = 0;

/*
|--------------------------------------------------------------------------
| Error Logging Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/logs/ directory. Use a full server path with trailing slash.
|
*/
$config['log_path'] = '';

/*
|--------------------------------------------------------------------------
| Log File Extension
|--------------------------------------------------------------------------
|
| The default filename extension for log files. The default 'php' allows for
| protecting the log files via basic scripting, when they are to be stored
| under a publicly accessible directory.
|
| Note: Leaving it blank will default to 'php'.
|
*/
$config['log_file_extension'] = '';

/*
|--------------------------------------------------------------------------
| Log File Permissions
|--------------------------------------------------------------------------
|
| The file system permissions to be applied on newly created log files.
|
| IMPORTANT: This MUST be an integer (no quotes) and you MUST use octal
|            integer notation (i.e. 0700, 0644, etc.)
*/
$config['log_file_permissions'] = 0644;

/*
|--------------------------------------------------------------------------
| Date Format for Logs
|--------------------------------------------------------------------------
|
| Each item that is logged has an associated date. You can use PHP date
| codes to set your own date formatting
|
*/
$config['log_date_format'] = 'Y-m-d H:i:s';

/*
|--------------------------------------------------------------------------
| Error Views Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/views/errors/ directory.  Use a full server path with trailing slash.
|
*/
$config['error_views_path'] = '';

/*
|--------------------------------------------------------------------------
| Cache Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/cache/ directory.  Use a full server path with trailing slash.
|
*/
$config['cache_path'] = '';

/*
|--------------------------------------------------------------------------
| Cache Include Query String
|--------------------------------------------------------------------------
|
| Whether to take the URL query string into consideration when generating
| output cache files. Valid options are:
|
|	FALSE      = Disabled
|	TRUE       = Enabled, take all query parameters into account.
|	             Please be aware that this may result in numerous cache
|	             files generated for the same page over and over again.
|	array('q') = Enabled, but only take into account the specified list
|	             of query parameters.
|
*/
$config['cache_query_string'] = FALSE;

/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
| If you use the Encryption class, you must set an encryption key.
| See the user guide for more info.
|
| https://codeigniter.com/user_guide/libraries/encryption.html
|
*/
$config['encryption_key'] = '';

/*
|--------------------------------------------------------------------------
| Session Variables
|--------------------------------------------------------------------------
|
| 'sess_driver'
|
|	The storage driver to use: files, database, redis, memcached
|
| 'sess_cookie_name'
|
|	The session cookie name, must contain only [0-9a-z_-] characters
|
| 'sess_expiration'
|
|	The number of SECONDS you want the session to last.
|	Setting to 0 (zero) means expire when the browser is closed.
|
| 'sess_save_path'
|
|	The location to save sessions to, driver dependent.
|
|	For the 'files' driver, it's a path to a writable directory.
|	WARNING: Only absolute paths are supported!
|
|	For the 'database' driver, it's a table name.
|	Please read up the manual for the format with other session drivers.
|
|	IMPORTANT: You are REQUIRED to set a valid save path!
|
| 'sess_match_ip'
|
|	Whether to match the user's IP address when reading the session data.
|
|	WARNING: If you're using the database driver, don't forget to update
|	         your session table's PRIMARY KEY when changing this setting.
|
| 'sess_time_to_update'
|
|	How many seconds between CI regenerating the session ID.
|
| 'sess_regenerate_destroy'
|
|	Whether to destroy session data associated with the old session ID
|	when auto-regenerating the session ID. When set to FALSE, the data
|	will be later deleted by the garbage collector.
|
| Other session cookie settings are shared with the rest of the application,
| except for 'cookie_prefix' and 'cookie_httponly', which are ignored here.
|
*/
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

/*
|--------------------------------------------------------------------------
| Cookie Related Variables
|--------------------------------------------------------------------------
|
| 'cookie_prefix'   = Set a cookie name prefix if you need to avoid collisions
| 'cookie_domain'   = Set to .your-domain.com for site-wide cookies
| 'cookie_path'     = Typically will be a forward slash
| 'cookie_secure'   = Cookie will only be set if a secure HTTPS connection exists.
| 'cookie_httponly' = Cookie will only be accessible via HTTP(S) (no javascript)
|
| Note: These settings (with the exception of 'cookie_prefix' and
|       'cookie_httponly') will also affect sessions.
|
*/
$config['cookie_prefix']	= '';
$config['cookie_domain']	= '';
$config['cookie_path']		= '/';
$config['cookie_secure']	= FALSE;
$config['cookie_httponly'] 	= FALSE;

/*
|--------------------------------------------------------------------------
| Standardize newlines
|--------------------------------------------------------------------------
|
| Determines whether to standardize newline characters in input data,
| meaning to replace \r\n, \r, \n occurrences with the PHP_EOL value.
|
| WARNING: This feature is DEPRECATED and currently available only
|          for backwards compatibility purposes!
|
*/
$config['standardize_newlines'] = FALSE;

/*
|--------------------------------------------------------------------------
| Global XSS Filtering
|--------------------------------------------------------------------------
|
| Determines whether the XSS filter is always active when GET, POST or
| COOKIE data is encountered
|
| WARNING: This feature is DEPRECATED and currently available only
|          for backwards compatibility purposes!
|
*/
$config['global_xss_filtering'] = FALSE;

/*
|--------------------------------------------------------------------------
| Cross Site Request Forgery
|--------------------------------------------------------------------------
| Enables a CSRF cookie token to be set. When set to TRUE, token will be
| checked on a submitted form. If you are accepting user data, it is strongly
| recommended CSRF protection be enabled.
|
| 'csrf_token_name' = The token name
| 'csrf_cookie_name' = The cookie name
| 'csrf_expire' = The number in seconds the token should expire.
| 'csrf_regenerate' = Regenerate token on every submission
| 'csrf_exclude_uris' = Array of URIs which ignore CSRF checks
*/
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();

/*
|--------------------------------------------------------------------------
| Output Compression
|--------------------------------------------------------------------------
|
| Enables Gzip output compression for faster page loads.  When enabled,
| the output class will test whether your server supports Gzip.
| Even if it does, however, not all browsers support compression
| so enable only if you are reasonably sure your visitors can handle it.
|
| Only used if zlib.output_compression is turned off in your php.ini.
| Please do not use it together with httpd-level output compression.
|
| VERY IMPORTANT:  If you are getting a blank page when compression is enabled it
| means you are prematurely outputting something to your browser. It could
| even be a line of whitespace at the end of one of your scripts.  For
| compression to work, nothing can be sent before the output buffer is called
| by the output class.  Do not 'echo' any values with compression enabled.
|
*/
$config['compress_output'] = FALSE;

/*
|--------------------------------------------------------------------------
| Master Time Reference
|--------------------------------------------------------------------------
|
| Options are 'local' or any PHP supported timezone. This preference tells
| the system whether to use your server's local time as the master 'now'
| reference, or convert it to the configured one timezone. See the 'date
| helper' page of the user guide for information regarding date handling.
|
*/
$config['time_reference'] = 'local';

/*
|--------------------------------------------------------------------------
| Rewrite PHP Short Tags
|--------------------------------------------------------------------------
|
| If your PHP installation does not have short tag support enabled CI
| can rewrite the tags on-the-fly, enabling you to utilize that syntax
| in your view files.  Options are TRUE or FALSE (boolean)
|
| Note: You need to have eval() enabled for this to work.
|
*/
$config['rewrite_short_tags'] = FALSE;

/*
|--------------------------------------------------------------------------
| Reverse Proxy IPs
|--------------------------------------------------------------------------
|
| If your server is behind a reverse proxy, you must whitelist the proxy
| IP addresses from which CodeIgniter should trust headers such as
| HTTP_X_FORWARDED_FOR and HTTP_CLIENT_IP in order to properly identify
| the visitor's IP address.
|
| You can use both an array or a comma-separated list of proxy addresses,
| as well as specifying whole subnets. Here are a few examples:
|
| Comma-separated:	'10.0.1.200,192.168.5.0/24'
| Array:		array('10.0.1.200', '192.168.5.0/24')
*/
$config['proxy_ips'] = '';

$keyId = '<Enter your key id>';
$keySecret = '<Enter your key secret>';
$displayCurrency = 'INR';
error_reporting(E_ALL);
ini_set('display_errors', 1);
