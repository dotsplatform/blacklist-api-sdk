<?php
/**
 * Description of BlacklistClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist;

use Dotsplatform\Blacklist\DTO\BannedPhonesList;
use Dotsplatform\Blacklist\DTO\Phone;
use Dotsplatform\Blacklist\DTO\PhoneFiltersDTO;
use Dotsplatform\Blacklist\DTO\StorePhonesDTO;

interface BlacklistClient
{
    public function storePhones(StorePhonesDTO $dto): void;

    public function findPhone(string $accountId, string $phone): ?Phone;

    public function isPhoneBanned(string $accountId, string $phone): bool;

    public function deletePhone(string $accountId, string $phone): void;

    public function getPhonesByAccount(PhoneFiltersDTO $dto): BannedPhonesList;
}
