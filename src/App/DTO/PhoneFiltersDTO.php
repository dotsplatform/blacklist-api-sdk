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
    protected ?string $phone;
    protected array $phones = [];
    protected ?int $dateFrom;
    protected ?int $dateTo;

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

    public function getPhones(): array
    {
        return $this->phones;
    }

    public function getDateFrom(): ?int
    {
        return $this->dateFrom;
    }

    public function getDateTo(): ?int
    {
        return $this->dateTo;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }
}
