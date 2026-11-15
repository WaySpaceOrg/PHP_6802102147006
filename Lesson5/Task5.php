<?php
$vatRate = 0.07;

if (PHP_SAPI === 'cli') {
    // อ่านค่าจากผู้ใช้ทีละบรรทัด
    $price = (float) trim(fgets(STDIN));
    $qty = (int) trim(fgets(STDIN));
    $discount = (float) trim(fgets(STDIN));
} else {
    $priceInput = $_POST['price'] ?? '';
    $qtyInput = $_POST['qty'] ?? '';
    $discountInput = $_POST['discount'] ?? '';
    $error = '';
    $result = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $validatedPrice = filter_var($priceInput, FILTER_VALIDATE_FLOAT);
        $validatedQty = filter_var($qtyInput, FILTER_VALIDATE_INT);
        $validatedDiscount = filter_var($discountInput, FILTER_VALIDATE_FLOAT);

        if (
            $validatedPrice === false || $validatedPrice < 0 ||
            $validatedQty === false || $validatedQty < 1 ||
            $validatedDiscount === false || $validatedDiscount < 0
        ) {
            $error = 'กรุณากรอกราคาและส่วนลดเป็นเลขตั้งแต่ 0 ขึ้นไป และจำนวนเป็นจำนวนเต็มตั้งแต่ 1 ขึ้นไป';
        } else {
            $price = $validatedPrice;
            $qty = $validatedQty;
            $discount = $validatedDiscount;
        }
    }

    if ($error === '' && isset($price, $qty, $discount)) {
        $totalBeforeDiscount = $price * $qty;
        $totalAfterDiscount = $totalBeforeDiscount - $discount;
        $vat = $totalAfterDiscount * $vatRate;
        $netTotal = $totalAfterDiscount + $vat;
        $result = [
            'totalBeforeDiscount' => $totalBeforeDiscount,
            'totalAfterDiscount' => $totalAfterDiscount,
            'vat' => $vat,
            'netTotal' => $netTotal,
        ];
    }
    ?>
    <!DOCTYPE html>
    <html lang="th">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>คำนวณยอดสินค้า</title>
    </head>
    <body>
        <h1>คำนวณยอดสินค้า</h1>
        <form method="post">
            <p>
                <label for="price">ราคาต่อชิ้น</label>
                <input id="price" name="price" type="number" min="0" step="any" required
                    value="<?= htmlspecialchars((string) $priceInput, ENT_QUOTES, 'UTF-8') ?>">
            </p>
            <p>
                <label for="qty">จำนวน</label>
                <input id="qty" name="qty" type="number" min="1" step="1" required
                    value="<?= htmlspecialchars((string) $qtyInput, ENT_QUOTES, 'UTF-8') ?>">
            </p>
            <p>
                <label for="discount">ส่วนลด</label>
                <input id="discount" name="discount" type="number" min="0" step="any" required
                    value="<?= htmlspecialchars((string) $discountInput, ENT_QUOTES, 'UTF-8') ?>">
            </p>
            <button type="submit">คำนวณ</button>
        </form>

        <?php if ($error !== ''): ?>
            <p role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
        <?php elseif ($result !== null): ?>
            <p>ยอดก่อนลด = <?= number_format($result['totalBeforeDiscount'], 2) ?></p>
            <p>ยอดหลังลด = <?= number_format($result['totalAfterDiscount'], 2) ?></p>
            <p>VAT 7% = <?= number_format($result['vat'], 2) ?></p>
            <p>ยอดสุทธิ = <?= number_format($result['netTotal'], 2) ?></p>
        <?php endif; ?>
    </body>
    </html>
    <?php
    exit;
}

// คำนวณตามลำดับในโจทย์
$totalBeforeDiscount = $price * $qty;
$totalAfterDiscount = $totalBeforeDiscount - $discount;
$vat = $totalAfterDiscount * $vatRate;
$netTotal = $totalAfterDiscount + $vat;

// แสดงผลทศนิยม 2 ตำแหน่ง
printf("ยอดก่อนลด = %.2f\n", $totalBeforeDiscount);
printf("ยอดหลังลด = %.2f\n", $totalAfterDiscount);
printf("VAT 7%% = %.2f\n", $vat);
printf("ยอดสุทธิ = %.2f\n", $netTotal);
