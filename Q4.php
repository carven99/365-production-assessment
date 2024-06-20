<?php

$item_tier_rarity = [1, 2, 3, 4, 5];  
$vip_ranks = ['v1', 'v2', 'v3', 'v4', 'v5'];  
$rarity_probabilities = [
    'v1' => [0.7, 0.2, 0.1, 0.0, 0.0],
    'v2' => [0.4, 0.3, 0.2, 0.1, 0.0],
    'v3' => [0.2, 0.4, 0.3, 0.1, 0.1],
    'v4' => [0.1, 0.2, 0.3, 0.4, 0.1],
    'v5' => [0.0, 0.1, 0.2, 0.3, 0.4],
];

function roll_item($vip_rank) {
    global $item_tier_rarity, $rarity_probabilities;
    $probabilities = $rarity_probabilities[$vip_rank];
    $item = weighted_random($item_tier_rarity, $probabilities);
    return $item;
}

function weighted_random($values, $weights) {
    $total_weight = array_sum($weights);
    $random_value = mt_rand() / mt_getrandmax() * $total_weight;
    foreach ($values as $i => $value) {
        if ($random_value < $weights[$i]) {
            return $value;
        }
        $random_value -= $weights[$i];
    }
    return end($values);
}

function simulate_rolls() {
    global $vip_ranks;
    $results = [];

    foreach ($vip_ranks as $vip) {
        $results[$vip] = array_fill_keys(range(1, 5), 0);
        for ($i = 0; $i < 100; $i++) {
            $item = roll_item($vip);
            $results[$vip][$item]++;
        }
    }

    print_results($results);
}

function print_results($results) {
    global $rarity_probabilities;

    foreach ($results as $vip => $distribution) {
        echo "[$vip] => Array\n(\n";
        foreach ($distribution as $item => $count) {
            echo "    [Rarity $item] => $count\n";
        }
        echo ")";

        $probabilities = $rarity_probabilities[$vip];
        $max_prob_index = array_keys($probabilities, max($probabilities));
        $highest_rarity = $max_prob_index[0] + 1;

        echo " - Highest chance for tier $highest_rarity items\n\n";
    }
}

simulate_rolls();

?>