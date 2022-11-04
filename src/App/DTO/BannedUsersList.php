<?php
/**
 * Description of BannedUsersList.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist\DTO;

use Illuminate\Support\Collection;

/**
 * @extends Collection<int, UserDTO>
 */
class BannedUsersList extends Collection
{
    public static function fromArray(array $data): static
    {
        return new static (
            array_map(fn($item) => UserDTO::fromArray([
                'accountId' => $item['account_id'],
                'phone' => $item['phone'],
                'note' => $item['note'] ?? null,
                'createdAt' => $item['created_at'] ?? null,
            ]), $data)
        );
    }
}
