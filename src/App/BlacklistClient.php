<?php
/**
 * Description of BlacklistClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist;

use Dotsplatform\Blacklist\DTO\BannedUsersList;
use Dotsplatform\Blacklist\DTO\PhoneFiltersDTO;
use Dotsplatform\Blacklist\DTO\UserDTO;

interface BlacklistClient
{
    public function storeUser(UserDTO $dto): void;

    public function findUser(string $accountId, string $phone): ?UserDTO;

    public function isPhoneBanned(string $accountId, string $phone): bool;

    public function deleteUser(string $accountId, string $phone): void;

    public function getUsersByAccount(PhoneFiltersDTO $dto): BannedUsersList;
}
