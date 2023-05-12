<?php
/**
 * Description of SuccessBlackListStubClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist;

use Dotsplatform\Blacklist\DTO\BannedPhonesList;
use Dotsplatform\Blacklist\DTO\PhoneDTO;
use Dotsplatform\Blacklist\DTO\PhoneFiltersDTO;
use Dotsplatform\Blacklist\DTO\StorePhonesDTO;

class SuccessBlacklistStubHttpClient implements BlacklistClient
{
    public function isPhoneBanned(string $accountId, string $phone): bool
    {
        return false;
    }

    public function storePhones(StorePhonesDTO $dto): void
    {
        // TODO: Implement storeUser() method.
    }

    public function findPhone(string $accountId, string $phone): ?PhoneDTO
    {
        return null;
    }

    public function deletePhone(string $accountId, string $phone): void
    {
        // TODO: Implement deleteUser() method.
    }

    public function getPhonesByAccount(PhoneFiltersDTO $dto): BannedPhonesList
    {
        return BannedPhonesList::fromArray([
            [
                'accountId' => $dto->getAccountId(),
                'phone' => 'phone',
                'note' => 'note'
            ]
        ]);
    }

    public function storePhone(PhoneDTO $dto): void
    {
        // TODO: Implement storePhone() method.
    }
}
