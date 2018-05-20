<?php

require_once __DIR__ . '/include/bootstrap.php';

$analytics = new \Algolia\Analytics($credentials['application_id'], $credentials['api_key']);

$startDate = new \DateTime('-30 days');
$endDate   = new \DateTime();

try {
    //$result = $analytics->filters->top('dev_pages', $startDate, $endDate);
    //$result = $analytics->filters->search('dev_pages', $startDate, $endDate, 'attribute');
    //$result = $analytics->filters->noResults('dev_pages', $startDate, $endDate, 'attribute');
    $result = $analytics->filters->topFiltersForAttributes('dev_pages', ['brand', 'price'], $startDate, $endDate, 'attribute');
    print_r($result);
} catch (Exception $e) {
    print_r($e->getMessage());
}
