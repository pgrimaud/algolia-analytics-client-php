<?php

require_once __DIR__ . '/include/bootstrap.php';

$analytics = new \Algolia\Analytics($credentials['application_id'], $credentials['api_key']);

$startDate = new \DateTime('-30 days');
$endDate   = new \DateTime();

try {
    //$result = $analytics->hits->top('dev_pages', $startDate, $endDate);
    $result = $analytics->hits->search('dev_pages', $startDate, $endDate, 'page');
    print_r($result);
} catch (Exception $e) {
    print_r($e->getMessage());
}
