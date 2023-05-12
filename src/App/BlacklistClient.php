<?php
/**
 * Description of BlacklistClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist;

use Dotsplatform\Blacklist\DTO\BannedPhonesList;
use Dotsplatform\Blacklist\DTO\PhoneDTO;
use Dotsplatform\Blacklist\DTO\PhoneFiltersDTO;
use Dotsplatform\Blacklist\DTO\StorePhonesDTO;
use Dotsplatform\Blacklist\Exceptions\BlacklistException;
use GuzzleHttp\Exception\GuzzleException;

interface BlacklistClient
{
    /**
     * @throws GuzzleException
     * @throws BlacklistException
     */
    public function storePhones(StorePhonesDTO $dto): void;

    /**
     * @throws GuzzleException
     * @throws BlacklistException
     */
    public function storePhone(PhoneDTO $dto): void;

    public function findPhone(string $accountId, string $phone): ?PhoneDTO;

    public function isPhoneBanned(string $accountId, string $phone): bool;

    public function deletePhone(string $accountId, string $phone): void;

    public function getPhonesByAccount(PhoneFiltersDTO $dto): BannedPhonesList;
}
