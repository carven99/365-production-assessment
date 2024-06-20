<?php
$lastDownloadTime = 0;
$downloadCount = 0;

function checkDownload($memberType) {
    global $lastDownloadTime, $downloadCount;
    $currentTime = getCurrentTimeInSeconds();
    $timeSinceLastDownload = $currentTime - $lastDownloadTime;

    //non-member
    if ($memberType === 'non-member') {
        if ($timeSinceLastDownload < 5) {
            return "Too many downloads";
        } else {
            $lastDownloadTime = $currentTime;
            $downloadCount = 1; // Reset count
            return "Your download is starting...";
        }
    }

    //member
    if ($memberType === 'member') {
        if ($downloadCount < 2) {
            $downloadCount++;
            $lastDownloadTime = $currentTime;
            return "Your download is starting...";
        } elseif ($timeSinceLastDownload < 5) {
            return "Too many downloads";
        } else {
            $downloadCount = 1; // Reset count
            $lastDownloadTime = $currentTime;
            return "Your download is starting...";
        }
    }
}

function getCurrentTimeInSeconds() {
    return time();
}

function printWithTimestamp($message) {
    $timestamp = date("[H:i:s]");
    echo "$timestamp $message\n";
}

//input
while (true) {
    echo "Enter 'member' or 'non-member' to check download status (or 'exit' to finish): ";
    $input = readline();

    if (strtolower($input) === 'exit') {
        break;
    }

    if (strtolower($input) === 'member' || strtolower($input) === 'non-member') {
        printWithTimestamp(checkDownload(strtolower($input)));
    } else {
        echo "Invalid input. Please type 'member' or 'non-member'.\n";
    }
}

echo "Thank you for using the download service. Goodbye!\n";
?>