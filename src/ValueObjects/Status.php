<?php

namespace Nextsms\Nextsms\ValueObjects;

use Nextsms\Nextsms\Enums;

/**
 * @author Alphs Olomi
 * @version 2.0
 */
class Status
{
    protected ?int $id;
    protected ?int $groupId;
    protected ?Enums\GroupName $groupName;
    protected ?Enums\StatusName $name;
    protected ?string $description;

    public function __construct()
    {
    }

    public static function make(array $data): self
    {
        $status = new self();
        $status->id = $data['id'] ?? null;
        $status->groupId = $data['groupId'] ?? null;
        $status->groupName = Enums\GroupName::from($data['groupName'] ?? null);
        $status->name = Enums\StatusName::from($data['name'] ?? null);
        $status->description = $data['description'] ?? null;

        return $status;
    }

    public function __toString()
    {
        return json_encode([
            'id' => $this->id,
            'groupId' => $this->groupId,
            'groupName' => (string) $this->groupName,
            'name' => (string) $this->name,
            'description' => $this->description,
        ], JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
