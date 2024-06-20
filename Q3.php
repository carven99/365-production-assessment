<?php

function isNumberOfDaysBetweenDatesOddOrEven($date1, $date2) {
    $dateTime1 = new DateTime($date1);
    $dateTime2 = new DateTime($date2);

    $interval = $dateTime1->diff($dateTime2);
    $days = $interval->days;
    $oddOrEven = ($days % 2 === 0) ? "even" : "odd";

    return [
        "number_of_days" => $days,
        "odd_or_even" => $oddOrEven
    ];
}

// Enter first date
echo "Enter the first date (YYYY-MM-DD): ";
$date1 = trim(fgets(STDIN));

// Enter second date
echo "Enter the second date (YYYY-MM-DD): ";
$date2 = trim(fgets(STDIN));

// Validate input dates
if (!$dateTime1 = DateTime::createFromFormat('Y-m-d', $date1)) {
    echo "The first date is not valid.\n";
    exit;
}

if (!$dateTime2 = DateTime::createFromFormat('Y-m-d', $date2)) {
    echo "The second date is not valid.\n";
    exit;
}


$result = isNumberOfDaysBetweenDatesOddOrEven($date1, $date2);
echo "Number of days between the two dates: " . $result['number_of_days'] . "\n";
echo "The number of days is " . $result['odd_or_even'] . ".\n";

?>