<?php
/**
 * Description of FailedBlackListStubHttpClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist;

use Dotsplatform\Blacklist\DTO\BannedUsersList;
use Dotsplatform\Blacklist\DTO\PhoneFiltersDTO;
use Dotsplatform\Blacklist\DTO\UserDTO;
use Dotsplatform\Blacklist\Exceptions\BlacklistException;

class FailedBlacklistStubHttpClient implements BlacklistClient
{
    public function isPhoneBanned(string $accountId, string $phone): bool
    {
        return true;
    }

    public function storeUser(UserDTO $dto): void
    {
        throw new BlacklistException('User cannon be stored');
    }

    public function findUser(string $accountId, string $phone): ?UserDTO
    {
        return UserDTO::fromArray([
            'accountId' => $accountId,
            'phone' => $phone,
            'note' => 'note'
        ]);
    }

    public function deleteUser(string $accountId, string $phone): void
    {
        throw new BlacklistException('User cannon be deleted');
    }

    public function getUsersByAccount(PhoneFiltersDTO $dto): BannedUsersList
    {
        return BannedUsersList::empty();
    }
}
