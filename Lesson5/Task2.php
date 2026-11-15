<?php
$name   = "สมชาย";       // String
$age    = 30;              // Integer
$gpa    = 3.75;            // Float
$active = true;            // Boolean
$note   = null;            // NULL

echo gettype($name);       // string
var_dump($age);            // int(30)

// String interpolation (ใส่ตัวแปรใน "")
echo "ชื่อ: $name อายุ: $age ปี";

// Constants
define("PI", 3.14159);
echo PI;
