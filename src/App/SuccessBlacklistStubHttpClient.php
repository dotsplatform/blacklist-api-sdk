<?php
/**
 * Description of SuccessBlackListStubClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist;

use Dotsplatform\Blacklist\DTO\BannedUsersList;
use Dotsplatform\Blacklist\DTO\PhoneFiltersDTO;
use Dotsplatform\Blacklist\DTO\UserDTO;

class SuccessBlacklistStubHttpClient implements BlacklistClient
{
    public function isPhoneBanned(string $accountId, string $phone): bool
    {
        return false;
    }

    public function storeUser(UserDTO $dto): void
    {
        // TODO: Implement storeUser() method.
    }

    public function findUser(string $accountId, string $phone): ?UserDTO
    {
        return null;
    }

    public function deleteUser(string $accountId, string $phone): void
    {
        // TODO: Implement deleteUser() method.
    }

    public function getUsersByAccount(PhoneFiltersDTO $dto): BannedUsersList
    {
        return BannedUsersList::fromArray([
            [
                'accountId' => $dto->getAccountId(),
                'phone' => 'phone',
                'note' => 'note'
            ]
        ]);
    }
}
