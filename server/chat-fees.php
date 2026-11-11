<?php
/**
 * chat-fees.php : the fee table of ONE campus as JSON, for the help chatbot.
 *
 * Put this file in the root folder of a campus website (next to index.php).
 * When a parent types "class 5 fee", "kg fees" or "5 class ki fee", the chatbot calls
 *   https://<campus website>/chat-fees.php
 * and answers with the exact amounts for that class.
 *
 * This is a stand-alone example: the fees are written in the array below.
 * In a real site, fill $fees from the same place your Fee Structure page uses
 * (database or settings), so the chat and the page always show the same numbers.
 *
 * Without this file the chatbot still works: it reads the <table class="sk-table">
 * on the campus Fee Structure page, or just shows the Fee Structure link.
 */

$fees = [
    'campus'   => 'Demo Campus',
    'session'  => '2026–2027',
    'currency' => 'Rs.',
    // key => [label, period]. Known keys: registration, admission, security, annual, tuition, lab.
    // registration + admission + security + tuition are added up as "First payment at admission".
    'columns'  => [
        'registration' => ['Registration Fee', 'one time'],
        'admission'    => ['Admission Fee', 'one time'],
        'security'     => ['Security Fee', 'refundable'],
        'annual'       => ['Annual Charges', 'per year'],
        'tuition'      => ['Tuition Fee', 'per month'],
    ],
    // one row per class; null = not offered / not published
    'classes'  => [
        ['class' => 'Playgroup',    'registration' => 5000, 'admission' => 15000, 'security' => 10000, 'annual' => 8000,  'tuition' => 12000],
        ['class' => 'Nursery',      'registration' => 5000, 'admission' => 15000, 'security' => 10000, 'annual' => 8000,  'tuition' => 12000],
        ['class' => 'Kindergarten', 'registration' => 5000, 'admission' => 15000, 'security' => 10000, 'annual' => 8000,  'tuition' => 12500],
        ['class' => 'Class 1',      'registration' => 5000, 'admission' => 18000, 'security' => 12000, 'annual' => 9000,  'tuition' => 13500],
        ['class' => 'Class 5',      'registration' => 5000, 'admission' => 18000, 'security' => 12000, 'annual' => 9000,  'tuition' => 14500],
        ['class' => 'Class 9',      'registration' => 5000, 'admission' => 20000, 'security' => 15000, 'annual' => 10000, 'tuition' => 17000],
    ],
];

$columns = [];
foreach ($fees['columns'] as $key => [$label, $period]) {
    $columns[] = ['key' => $key, 'label' => $label, 'period' => $period];
}
$classes = [];
foreach ($fees['classes'] as $row) {
    $item = ['class' => (string) $row['class']];
    foreach ($fees['columns'] as $key => $_) {
        $item[$key] = isset($row[$key]) && is_numeric($row[$key]) ? (int) $row[$key] : null;
    }
    $classes[] = $item;
}

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');   // public data: lets the chat on the main website read it too
header('Cache-Control: public, max-age=600');
header('X-Content-Type-Options: nosniff');
echo json_encode([
    'campus'   => $fees['campus'],
    'session'  => $fees['session'],
    'currency' => $fees['currency'],
    'columns'  => $columns,
    'classes'  => $classes,
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
