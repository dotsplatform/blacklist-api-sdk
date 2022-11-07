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
use Dotsplatform\Blacklist\Exceptions\BlacklistException;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class BlacklistHttpClient extends HttpClient
{
    private const STORE_USER_URL_TEMPLATE = '/api/%s/phones/%s';
    private const FIND_USER_URL_TEMPLATE = '/api/%s/phones/%s';
    private const DELETE_USER_URL_TEMPLATE = '/api/%s/phones/%s';
    private const INDEX_USERS_URL_TEMPLATE = '/api/%s/phones';

    /**
     * @throws GuzzleException
     * @throws BlacklistException
     */
    public function storeUser(UserDTO $dto): void
    {
        $url = $this->getStoreUserUrlTemplate($dto->getAccountId(), $dto->getPhone());
        $body = [
            'note' => $dto->getNote(),
        ];
        $this->post($url, $body);
    }

    public function findUser(string $accountId, string $phone): ?UserDTO
    {
        $url = $this->getFindUserUrlTemplate($accountId, $phone);
        try {
            $response = $this->get($url);
        } catch (Exception) {
            return null;
        }

        return UserDTO::fromArray([
            'accountId' => $response['account_id'],
            'phone' => $response['phone'],
            'note' => $response['note'] ?? null,
            'createdAt' => $response['created_at'] ?? null,
        ]);
    }

    public function isPhoneBanned(string $accountId, string $phone): bool
    {
        $user = $this->findUser($accountId, $phone);
        if ($user) {
            return true;
        }
        return false;
    }

    /**
     * @throws GuzzleException
     * @throws BlacklistException
     */
    public function deleteUser(string $accountId, string $phone): void
    {
        $url = $this->getDeleteUserUrlTemplate($accountId, $phone);
        $this->delete($url);
    }

    public function getUsersByAccount(PhoneFiltersDTO $dto): BannedUsersList
    {
        $url = $this->getIndexUsersUrlTemplate($dto->getAccountId());
        try {
            $response = $this->get($url, [
                'query' => $dto->toArray(),
            ]);
            return BannedUsersList::fromArray($response);
        } catch (Exception) {
            return BannedUsersList::empty();
        }
    }

    private function getStoreUserUrlTemplate(string $accountId, string $phone): string
    {
        return sprintf(self::STORE_USER_URL_TEMPLATE, $accountId, $phone);
    }

    private function getFindUserUrlTemplate(string $accountId, string $phone): string
    {
        return sprintf(self::FIND_USER_URL_TEMPLATE, $accountId, $phone);
    }

    private function getDeleteUserUrlTemplate(string $accountId, string $phone): string
    {
        return sprintf(self::DELETE_USER_URL_TEMPLATE, $accountId, $phone);
    }

    private function getIndexUsersUrlTemplate(string $accountId): string
    {
        return sprintf(self::INDEX_USERS_URL_TEMPLATE, $accountId);
    }
}
