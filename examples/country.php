<?php

require_once __DIR__ . '/include/bootstrap.php';

$analytics = new \Algolia\Analytics($credentials['application_id'], $credentials['api_key']);

$startDate = new \DateTime('-30 days');
$endDate   = new \DateTime();

try {
    $result = $analytics->countries->top('dev_pages', $startDate, $endDate);
    print_r($result);
} catch (Exception $e) {
    print_r($e->getMessage());
}
