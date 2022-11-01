<?php
/**
 * Description of BlacklistClient.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dotsplatform\Blacklist;

use Dotsplatform\Blacklist\DTO\BannedUsersList;
use Dotsplatform\Blacklist\DTO\UserDTO;
use Dotsplatform\Blacklist\Exceptions\BlackListException;
use Illuminate\Support\Facades\Log;

class BlacklistHttpClient extends HttpClient
{
    private const STORE_USER_URL_TEMPLATE = '/accounts/%s/phones/%s';
    private const DELETE_USER_URL_TEMPLATE = '/accounts/%s/phones/%s';
    private const INDEX_USERS_URL_TEMPLATE = '/accounts/%s/phones';

    public function storeUser(UserDTO $dto): void
    {
        $url = $this->getStoreUserUrlTemplate($dto->getAccountId(), $dto->getPhone());
        $body = [
            'note' => $dto->getNote(),
        ];
        try {
            $this->post($url, $body);
        } catch (BlackListException $e) {
            $data = $this->generateErrorData($e, $body);
            Log::error('Store user blacklist exception', $data);
        }
    }

    public function deleteUser(string $accountId, string $phone): void
    {
        $url = $this->getDeleteUserUrlTemplate($accountId, $phone);
        try {
            $this->delete($url);
        } catch (BlackListException $e) {
            $data = $this->generateErrorData($e);
            Log::error('Delete user blacklist exception', $data);
        }
    }

    public function getUsersByAccount(string $accountId): BannedUsersList
    {
        $url = $this->getIndexUsersUrlTemplate($accountId);
        try {
            $response = $this->get($url);
            return BannedUsersList::fromArray($response);
        } catch (BlackListException $e) {
            $data = $this->generateErrorData($e);
            Log::error('Index blacklist exception', $data);
            return BannedUsersList::empty();
        }
    }

    private function getStoreUserUrlTemplate(string $accountId, string $phone): string
    {
        return sprintf(self::STORE_USER_URL_TEMPLATE, $accountId, $phone);
    }

    private function getDeleteUserUrlTemplate(string $accountId, string $phone): string
    {
        return sprintf(self::DELETE_USER_URL_TEMPLATE, $accountId, $phone);
    }

    private function getIndexUsersUrlTemplate(string $accountId): string
    {
        return sprintf(self::INDEX_USERS_URL_TEMPLATE, $accountId);
    }

    private function generateErrorData(
        BlackListException $e,
        array $body = [],
    ): array {
        return [
            json_encode([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'body' => $body,
            ])
        ];
    }
}
