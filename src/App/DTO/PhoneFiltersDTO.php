<?php
/**
 * Description of PhoneFiltersDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist\DTO;

use Dots\Data\DTO;

class PhoneFiltersDTO extends DTO
{
    protected string $accountId;
    protected int $limit = 50;
    protected int $offset = 0;
    protected ?string $phone = null;
    protected ?int $dateFrom = null;
    protected ?int $dateTo = null;

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getDateFrom(): ?int
    {
        return $this->dateFrom;
    }

    public function getDateTo(): ?int
    {
        return $this->dateTo;
    }
}