<?php
$str = "Vishv soni";
echo "main string: ". $str. "<br>";

$chopFun = chop($str, "soni"); //Remove characters from the right end of a string,alias of rtrim(). 
echo "chop: " . $chopFun. "<br>";

$lTrim = ltrim($str, "Vishv");
echo "ltrim: ". $lTrim. "<br>";

echo "trim: ". trim($str, "Vion "). "<br>";

$chunkSplit =  chunk_split($str, 2, "_") . "<br>";
echo "chunk split: " . $chunkSplit;

$encoded = convert_uuencode($str) . "<br>";
echo "uuencode: " . $encoded . "<br>";
$decoded = convert_uudecode($encoded);
echo "uudecode: " . $decoded . "<br>";

$countChars = count_chars($str, 3); // unique charachers
echo "coutnChars: ". $countChars. "<br>";

echo "explode: ". "<br>";
print_r(explode(" ", $str)); // str to arr
echo "<br>";
$arr = ["vishv", "soni"]; //arr to str
echo implode("_", $arr). "<br>";
echo join("_", $arr). "<br>"; //join() is an alternative name for implode()

$ord =  ord($str). "<br>";//ascii of first char
echo "ord: " . $ord. "<br>";

$lcFirst = lcfirst($str);
echo "lcfirst: " . $lcFirst. "<br>";
$ucFirst = ucfirst($str);
echo "ucfirst: " . $ucFirst. "<br>";
$ucWords = ucwords($str);
echo "ucwords: " . $ucWords. "<br>";
$strToLower = strtolower($str);
echo "strToLower: " . $strToLower. "<br>";
$strToUpper = strtoupper($str). "<br>";
echo "strToUpper: " . $strToUpper. "<br>";

$sha1 = sha1($str);
echo "sha1: ". $sha1. "<br>";

$number = 9;
$s = "india";
$txt = sprintf("There are %u million bicycles in %s.",$number,$s);
echo "sprintf: ". $txt. "<br>";//same as printf but use to store in var

$strContains = str_contains($str, "soni");
echo "str_contains: ". $strContains. "<br>";
$strEndsWith = str_ends_with($str, "ni");
echo "str_ends_with: ". $strEndsWith. "<br>";
$strIreplace = str_ireplace("SONI", "lavingiya", $str);//case insensitive
echo "str_ireplace: ". $strIreplace. "<br>";
$strReplace = str_replace("SONI", "lavingiya", $str);//case sensitive
echo "str_replace: ". $strReplace. "<br>";
$strPad = str_pad($str,20,"._",STR_PAD_BOTH);
echo "str_pad: ". $strPad. "<br>";
$strRepeat = str_repeat($str, 2);
echo "str_repeat: ". $strRepeat. "<br>";

echo "str_rot13: ". str_rot13($str). "<br>";//encoding string,shifts every letter 13 places 

echo "str_suffle: ". str_shuffle($str). "<br>";//like random

print_r(str_split($str));
echo "<br>";

echo "str_word_count: ". str_word_count($str). "<br>";

echo "strcasecmp: ". strcasecmp("vishv soni", $str). "<br>";//equal0, < -, > + caseinsens.
echo "strcmp: ". strcmp("Vishv soni", $str). "<br>";//case sens.
echo "strncasecmp: ". strncasecmp("vishv patel", $str,6). "<br>";//case sens.
echo "strncmp: ". strncmp("Vishv patel", $str,6). "<br>";//case sens.


echo "strchr: ". strchr("vishv soniabc! and","soni"). "<br>";

echo "strcspn: ". strcspn($str, "h"). "<br>";//count num before specific char

echo "stripos: ". stripos($str,"SONI"). "<br>";//pos of first occurence of word caseinses.
echo "strpos: ". strpos($str,"soni"). "<br>";//pos of first occurence of word caseinses.

echo "strlen: ". strlen($str). "<br>";

echo "strtr: ". strtr($str, "i", "s"). "<br>";//change specific chars
echo "substr: ". substr($str, 1,6). "<br>";