<?php
/**
 * Description of Phone.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist\DTO;

use Dots\Data\DTO;

class PhoneDTO extends DTO
{
    protected string $phone;
    protected string $accountId;
    protected ?string $note = null;
    protected ?int $createdAt = null;

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function getCreatedAt(): ?int
    {
        return $this->createdAt;
    }
}
