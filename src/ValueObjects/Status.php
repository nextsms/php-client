<?php

namespace Nextsms\Nextsms\ValueObjects;

use Nextsms\Nextsms\Enums;

/**
 * @author Alphs Olomi
 * @version 2.0
 */
class Status
{
    protected int $id;
    protected int $groupId;
    protected Enums\GroupName $groupName;
    protected Enums\StatusName $name;
    protected string $description;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? 0;
        $this->groupId = $data['groupId'] ?? 0;
        $this->groupName = Enums\GroupName::from($data['groupName']) ?? Enums\GroupName::from('');
        $this->name = Enums\StatusName::from($data['name']) ?? Enums\StatusName::from('');
        $this->description = $data['description'] ?? '';
    }

    public static function create(array $data): self
    {
        return new self($data);
    }

    // tostring
}
