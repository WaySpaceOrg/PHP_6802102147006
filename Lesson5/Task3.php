<?php
$a = 10; $b = 3;
echo $a + $b;    // 13
echo $a % $b;    // 1 (เศษ)
echo $a ** $b;   // 1000 (ยกกำลัง)

// String functions
$email = "  Hello@Email.COM  ";
$email = trim(strtolower($email));  // hello@email.com

$text = "Hello World";
echo strlen($text);           // 11
echo substr($text, 0, 5);    // Hello
echo str_replace("World","PHP",$text); // Hello PHP
echo strpos($text, "World"); // 6

// จัดรูปแบบตัวเลขสำหรับแสดงผล
$price = 1234567.891;
echo number_format($price);       // 1,234,568   (ปัดเป็นจำนวนเต็ม)
echo number_format($price, 2);    // 1,234,567.89

$area = 23.1;
echo $area;                       // 23.1   ← ทศนิยมไม่ครบ
echo number_format($area, 2);     // 23.10  ← ครบ 2 ตำแหน่งเสมอ
