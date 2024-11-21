<?php
require_once __DIR__ . '/../vendor/autoload.php';

ini_set('max_execution_time', 0);

use App\Services\CampaignService;

$campaignService = new CampaignService();
$pendingCampaigns = $campaignService->getPending();

foreach ($pendingCampaigns as $campaign) {
    echo "Sending: {$campaign->campaignName} to user ID {$campaign->userId}\n";
    $campaignService->markAsSent($campaign->id);
}

echo "Sent...";
