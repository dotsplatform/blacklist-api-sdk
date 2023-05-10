<?php
/**
 * Description of UserDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist\DTO;

use Dots\Data\DTO;

class StorePhonesDTO extends DTO
{
    protected string $accountId;
    protected array $phones;
    protected ?string $note = null;

    public function getPhones(): array
    {
        return $this->phones;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }
}
