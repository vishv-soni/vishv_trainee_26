<?php

$arr1 = ["A", "Cat", "Dog", "A", "Dog"];
$arr2 = ["frog", "cow"];

echo "array1: ";
print_r($arr1);
echo "<br>";

echo "count: " . count($arr1) . "<br>"; //alias of sizeof

echo "array_count_values: ";
print_r(array_count_values($arr1)); // each element how many times
echo "<br>";

echo "in_array: ";
if (in_array("Cat", $arr1)) {
    echo "match found" . "<br>";
} else {
    echo "match not found" . "<br>";
}

echo "array_merge: ";
print_r(array_merge($arr1, $arr2));
echo "<br>";

echo "array_slice: ";
print_r(array_slice($arr1, 1, 2, false)); //false ind. start from 0,Extracts a portion (a "slice") of an array, without modifying the original array.
echo "<br>";
echo "<br>";

//remove
$sp = ["one", "two", "three", "nothing"];
$sp2 = ["four", "five"];
$removed = array_splice($sp, 1, 2); //two, three removed in og array
echo "array_splice removed el: ";
print_r($removed);
echo "<br>";
echo "array_splice og arr: ";
print_r($sp);
echo "<br>";

//insert
echo "array_splice insert: ";
array_splice($sp, 0,1, $sp2);
print_r($sp);
echo "<br>";

//replace
echo "array_splice replace: ";
$fruits = ["apple", "banana", "orange", "mango"];
$replacement = ["lemon", "carrot"];
array_splice($fruits, 1, 2, $replacement);
print_r($fruits);
echo "<br>";
echo "<br>";


$addRemArr = ["hello", "world"];
echo "array_push: ";
array_push($addRemArr, "from", "earth");//add in last
print_r($addRemArr);
echo "<br>";
echo "array_push: ";
array_pop($addRemArr); //remove from last
print_r($addRemArr);
echo "<br>";

echo "array_shift: ";
array_shift($addRemArr);//Removes the first element. 
print_r($addRemArr);
echo "<br>";
echo "array_unshift: ";
array_unshift($addRemArr, "hie");//Adds elements to the beginning.
print_r($addRemArr);
echo "<br>";
echo "<br>";

echo "array_search: ";
echo array_search("from", $addRemArr);//search ele and give key
echo "<br>";

echo "array_key_exists: ";
$keyExists=["Volvo","BMW"];
if (array_key_exists(0,$keyExists))
  {
  echo "Key exists!". "<br>";
  }
else
  {
  echo "Key does not exist!". "<br>";
  }

//filter
$numbers = [1,2,3,4,5,6];

$oddNumbers = array_filter($numbers, function($numbers){
    return $numbers %2 !== 0;
});
echo "filter even nums: ";
print_r($oddNumbers);
echo "<br>";
echo "<br>";


//sorting
//sort
echo "sort: ";
$nums1 = [4, 6, 2, 22, 11];
sort($nums1);
foreach ($nums1 as $v) {
    echo $v. " ";
}
echo "<br>";
//rsort
echo "rsort: ";
rsort($nums1);
foreach ($nums1 as $v) {
    echo $v. " ";
}
echo "<br>";
//asort
echo "asort: ";
$assNum = ["Peter"=>"hi","Ben"=>"50","Joe"=>"43"];
asort($assNum);//associative arr in acending order according to value
foreach ($assNum as $k => $v) {
    echo "$k is $v  ";
}
echo "<br>";
//arsort//
echo "arsort: ";
arsort($assNum);//associative arr in decending order according to value
foreach ($assNum as $k => $v) {
    echo "$k is $v  ";
}
echo "<br>";
//ksort
echo "ksort: ";
  ksort($assNum);//sort by key in asc.
  foreach ($assNum as $k => $v) {
    echo "$k is $v  ";
}
echo "<br>";
//krsort
echo "krsort: ";
  krsort($assNum);//sort by key in asc.
  foreach ($assNum as $k => $v) {
    echo "$k is $v  ";
}
echo "<br>";

//keys values
echo "array_keys: ";
print_r(array_keys($assNum));//return keys
echo "<br>";
echo "array_keys: ";
print_r(array_values($assNum));//return values
echo "<br>";

//map
echo "map: ";
$nums2 = [1,2,3,4];
$mappedArr = array_map(function($nums2){
    return $nums2 * $nums2;
}, $nums2);
print_r($mappedArr);
