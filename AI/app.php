<?php

function performOptionAnalysis($text)
{
    $model = file_get_contents('option_model.js');

    preg_match('/const OptionModel = (.*);/', $model, $matches);
    $OptiontModel = json_decode($matches[1], true);

    $words = explode(' ', $text);

    $score = 0;

    foreach ($words as $word) {
        if (isset($OptionModel[$word])) {
            $score += $OptionModel[$word];
        }
    }

    switch (true) {
        case ($score > 0):
            $option = "Positive";
            break;
        case ($score < 0):
            $option = "Negative";
            break;
        default:
            $option = "Neutral";
            break;
    }

    return $option;
}

// Příklad použití
$input = "I love this movie! It's amazing!";
$result = performOptionAnalysis($input);
echo "Option: " . $result;
