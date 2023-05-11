<?php
/**
 * Description of FailedBlackListStubHttpClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist;

use Dotsplatform\Blacklist\DTO\BannedPhonesList;
use Dotsplatform\Blacklist\DTO\PhoneDTO;
use Dotsplatform\Blacklist\DTO\PhoneFiltersDTO;
use Dotsplatform\Blacklist\DTO\StorePhonesDTO;
use Dotsplatform\Blacklist\Exceptions\BlacklistException;

class FailedBlacklistStubHttpClient implements BlacklistClient
{
    public function isPhoneBanned(string $accountId, string $phone): bool
    {
        return true;
    }

    public function storePhones(StorePhonesDTO $dto): void
    {
        throw new BlacklistException('User cannon be stored');
    }

    public function findPhone(string $accountId, string $phone): ?PhoneDTO
    {
        return PhoneDTO::fromArray([
            'accountId' => $accountId,
            'phone' => $phone,
            'note' => 'note'
        ]);
    }

    public function deletePhone(string $accountId, string $phone): void
    {
        throw new BlacklistException('User cannon be deleted');
    }

    public function getPhonesByAccount(PhoneFiltersDTO $dto): BannedPhonesList
    {
        return BannedPhonesList::empty();
    }

    public function storePhone(PhoneDTO $dto): void
    {
        // TODO: Implement storePhone() method.
    }
}
