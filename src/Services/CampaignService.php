<?php

namespace App\Services;

use App\Repositories\CampaignRepository;

class CampaignService
{
    private CampaignRepository $campaignRepository;

    public function __construct()
    {
        $this->campaignRepository = new CampaignRepository();
    }

    public function createCampaign(string $campaignName, string $message): void
    {
        $this->campaignRepository->createCampaign($campaignName, $message);
    }

    public function getPending(): array
    {
        return $this->campaignRepository->getPending();
    }

    public function markAsSent(int $campaignId): void
    {
        $this->campaignRepository->markAsSent($campaignId);
    }
}
