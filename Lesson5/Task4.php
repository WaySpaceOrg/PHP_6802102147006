<?php
$item  = "ลาเต้";
$price = 45;
$qty   = 3;
$total = $price * $qty;          // PHP คิดบน server
?>
<p>ลาเต้ x <?= $qty ?></p>
<p>รวม <?= $total ?> บาท</p>
<button id="tip">เพิ่มทิป 10%</button>
<p id="grand"></p>

<script>
    // PHP เขียนตัวเลขลงมาให้ตอนสร้างหน้า — browser เห็นเป็น const total = 135;
    const total = <?= $total ?>;

    document.getElementById("tip").addEventListener("click", function () {
        document.getElementById("grand").textContent = "รวมทิป " + (total * 1.1).toFixed(2) + " บาท";
    });
</script>
