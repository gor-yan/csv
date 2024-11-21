<?php

namespace App\Repositories;

use App\Models\Campaign;
use App\Database\Connection;
use PDO;

class CampaignRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    public function createCampaign(string $campaignName, string $message): void
    {
        $stmt = $this->connection->prepare("INSERT INTO campaigns (campaign_name, message) VALUES (:campaign_name, :message)");
        $stmt->bindParam(':campaign_name', $campaignName);
        $stmt->bindParam(':message', $message);
        $stmt->execute();
    }

    public function getPending(): array
    {
        $stmt = $this->connection->query("SELECT * FROM campaigns WHERE status = 'pending'");
        $stmt->setFetchMode(PDO::FETCH_CLASS, Campaign::class);
        return $stmt->fetchAll();
    }

    public function markAsSent(int $campaignId): void
    {
        $stmt = $this->connection->prepare("UPDATE campaigns SET status = 'sent' WHERE id = :id");
        $stmt->bindParam(':id', $campaignId);
        $stmt->execute();
    }
}
