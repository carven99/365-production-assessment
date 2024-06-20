<?php
function checkDiscount($purchaseValue, $discountRates, $discountThresholds) {
    $discount = 0;

    foreach ($discountThresholds as $index => $threshold) {
        if ($purchaseValue >= $threshold) {
            $discount = $discountRates[$index];
            break;
        }
    }

    return $discount;
}

echo "Please enter the purchase value: ";
$purchaseValue = trim(fgets(STDIN));

if (!is_numeric($purchaseValue)) {
    echo "Error: The entered value is not a valid number.\n";
    exit;
}

$purchaseValue = floatval($purchaseValue);
$discountRates = [0.10, 0.05, 0]; // 10%, 5%, and 0% discount rates
$discountThresholds = [500, 100, 0]; // Thresholds for the discounts
$discountRate = checkDiscount($purchaseValue, $discountRates, $discountThresholds);

if ($discountRate > 0) {
    $discountAmount = $purchaseValue * $discountRate;
    $finalPrice = $purchaseValue - $discountAmount;
    echo "Discount: " . ($discountRate * 100) . "%\n";
    echo "Discount Amount: " . $discountAmount . "\n";
    echo "Final Price: " . $finalPrice . "\n";
} else {
    echo "No discount applied.\n";
}
?>