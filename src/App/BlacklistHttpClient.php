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
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class BlacklistHttpClient extends HttpClient implements BlacklistClient
{
    private const STORE_PHONES_URL_TEMPLATE = '/api/%s/phones';
    private const STORE_PHONE_URL_TEMPLATE = '/api/%s/phones/%s';
    private const FIND_PHONE_URL_TEMPLATE = '/api/%s/phones/%s';
    private const DELETE_PHONES_URL_TEMPLATE = '/api/%s/phones';
    private const DELETE_PHONE_URL_TEMPLATE = '/api/%s/phones/%s';
    private const INDEX_PHONES_URL_TEMPLATE = '/api/%s/phones';

    /**
     * @throws GuzzleException
     * @throws BlacklistException
     */
    public function storePhones(StorePhonesDTO $dto): void
    {
        $url = $this->getStorePhonesUrlTemplate($dto->getAccountId());
        $body = [
            'note' => $dto->getNote(),
            'phones' => $dto->getPhones(),
        ];
        $this->post($url, $body);
    }

    /**
     * @throws GuzzleException
     * @throws BlacklistException
     */
    public function storePhone(PhoneDTO $dto): void
    {
        $url = $this->getStorePhoneUrlTemplate($dto->getAccountId(), $dto->getPhone());
        $body = [
            'note' => $dto->getNote(),
        ];
        $this->post($url, $body);
    }

    public function findPhone(string $accountId, string $phone): ?PhoneDTO
    {
        $url = $this->getFindPhoneUrlTemplate($accountId, $phone);
        try {
            $response = $this->get($url);
        } catch (Exception) {
            return null;
        }

        return PhoneDTO::fromArray([
            'accountId' => $response['account_id'],
            'phone' => $response['phone'],
            'note' => $response['note'] ?? null,
            'createdAt' => $response['created_at'] ?? null,
        ]);
    }

    public function isPhoneBanned(string $accountId, string $phone): bool
    {
        return (bool)$this->findPhone($accountId, $phone);
    }

    /**
     * @throws GuzzleException
     * @throws BlacklistException
     */
    public function deletePhones(string $accountId): void
    {
        $url = $this->getDeletePhonesUrlTemplate($accountId);
        $this->delete($url);
    }

    /**
     * @throws GuzzleException
     * @throws BlacklistException
     */
    public function deletePhone(string $accountId, string $phone): void
    {
        $url = $this->getDeletePhoneUrlTemplate($accountId, $phone);
        $this->delete($url);
    }

    public function getPhonesByAccount(PhoneFiltersDTO $dto): BannedPhonesList
    {
        $url = $this->getIndexPhonesUrlTemplate($dto->getAccountId());
        $response = $this->get($url, [
            'query' => $dto->toArray(),
        ]);
        return BannedPhonesList::fromArray($response);
    }

    private function getStorePhonesUrlTemplate(string $accountId): string
    {
        return sprintf(self::STORE_PHONES_URL_TEMPLATE, $accountId);
    }

    private function getStorePhoneUrlTemplate(string $accountId, string $phone): string
    {
        return sprintf(self::STORE_PHONE_URL_TEMPLATE, $accountId, $phone);
    }

    private function getFindPhoneUrlTemplate(string $accountId, string $phone): string
    {
        return sprintf(self::FIND_PHONE_URL_TEMPLATE, $accountId, $phone);
    }

    private function getDeletePhonesUrlTemplate(string $accountId): string
    {
        return sprintf(self::DELETE_PHONES_URL_TEMPLATE, $accountId);
    }

    private function getDeletePhoneUrlTemplate(string $accountId, string $phone): string
    {
        return sprintf(self::DELETE_PHONE_URL_TEMPLATE, $accountId, $phone);
    }

    private function getIndexPhonesUrlTemplate(string $accountId): string
    {
        return sprintf(self::INDEX_PHONES_URL_TEMPLATE, $accountId);
    }
}
