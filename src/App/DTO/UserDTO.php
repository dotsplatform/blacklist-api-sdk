<?php
/**
 * Description of UserDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist\DTO;


use Dots\Data\DTO;

class UserDTO extends DTO
{
    protected string $phone;
    protected string $accountId;
    protected ?string $note = null;

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
}