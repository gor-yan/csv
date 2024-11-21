<?php

namespace App\Models;

class Campaign
{
    public int $id;
    public string $campaign_name;
    public string $message;
    public string $status;

    public function __construct(string $campaign_name, string $message)
    {
        $this->campaign_name = $campaign_name;
        $this->message = $message;
        $this->status = 'pending';
    }
}
