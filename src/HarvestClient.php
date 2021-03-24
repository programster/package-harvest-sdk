<?php

/*
 * The client for interfacing with the Harvest API.
 */

namespace Programster\Harvest;


class HarvestClient
{
    private InterfaceMessengerDriver $m_driver;
    private string $m_accountId;
    private string $m_authToken;
    const BASE_URL = "https://api.harvestapp.com/api/v2";


    /**
     * Create a client for interfacing with the Harvest API.
     * @param string $accountId - Your account ID from https://id.getharvest.com/developers
     * @param string $authToken - Your auth token from https://id.getharvest.com/developers
     * @param InterfaceMessengerDriver $driver - The driver that will be handling the sending/receiving of messages
     */
    public function __construct(string $accountId, string $authToken, InterfaceMessengerDriver $driver)
    {
        $this->m_driver = $driver;
        $this->m_accountId = $accountId;
        $this->m_authToken = $authToken;
    }


    /**
     * Fetches details about your account. E.g. what permissions you have etc.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function getMyInfo() : \Psr\Http\Message\ResponseInterface
    {
        $request = $this->createBaseRequest();
        $request = $request->withMethod("GET");
        $uri = $this->m_driver->convertStringToUri(self::BASE_URL . '/users/me');
        $request = $request->withUri($uri);
        $response = $this->m_driver->send($request);
        return $response;
    }


    /**
     * Fetches all of your time entries in Harvest.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function getTimeEntries() : \Psr\Http\Message\ResponseInterface
    {
        $request = $this->createBaseRequest();
        $request = $request->withMethod("GET");
        $uri = $this->m_driver->convertStringToUri(self::BASE_URL . '/time_entries');
        $request = $request->withUri($uri);
        $response = $this->m_driver->send($request);
        return $response;
    }


    /**
     * Fetches a specific time entry by its ID.
     * @param int $timeEntryId - the ID of the time entry you wish to fetch.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function getTimeEntryById(int $timeEntryId) : \Psr\Http\Message\ResponseInterface
    {
        $request = $this->createBaseRequest();
        $request = $request->withMethod("GET");
        $uri = $this->m_driver->convertStringToUri(self::BASE_URL . '/time_entries/{$timeEntryId}');
        $request = $request->withUri($uri);
        $response = $this->m_driver->send($request);
        return $response;
    }


    /**
     * Create a time entry
     * @param int $projectId - the ID of the project the time entry belongs to.
     * @param int $taskId - the ID of the task being performed.
     * @param int $startTime - the unix timestamp of when you started the task
     * @param int $endTime - the unix timestamp of when you finished the task (should be within same day).
     * @return Psr\Http\Message\ResponseInterface
     */
    public function createTimeEntryByStartAndEndTime(
        int $projectId,
        int $taskId,
        int $startTime,
        int $endTime,
        ?string $notes = null
    ) : \Psr\Http\Message\ResponseInterface
    {
        $request = $this->createBaseRequest();
        $request->withMethod("POST");
        $uri = $this->m_driver->convertStringToUri(self::BASE_URL . '/time_entries');
        $body = $request->getBody();

        $params = [];
        throw new \Exception("createTimeEntryByStartAndEndTime as not yet been completed.");

        $newBody = $body->write(http_build_query($params));
        $request = $request->withBody($newBody);
        $request = $request->withHeader('Content-Type', 'application/x-www-form-urlencoded');
        $request = $request->withUri($uri);
        $response = $this->m_driver->send($request);
        return $response;
    }


    /**
     * Fetch a list of projects in Harvest.
     * Admin or Project Manager permissions required.
     * @return Psr\Http\Message\RequestInterface
     */
    public function getProjects() : \Psr\Http\Message\RequestInterface
    {
        $request = $this->createBaseRequest();
        $request->withMethod("GET");
        $uri = $this->m_driver->convertStringToUri(self::BASE_URL . '/projects');
        $request = $request->withUri($uri);
        $response = $this->m_driver->send($request);
        return $response;
    }


    /**
     * Helper method that takes care of always adding the authentication headers.
     * @return Psr\Http\Message\RequestInterface
     */
    private function createBaseRequest() : \Psr\Http\Message\RequestInterface
    {
        $request = $this->m_driver->newRequest();
        $request = $request->withAddedHeader("Harvest-Account-ID", $this->m_accountId);
        $request = $request->withAddedHeader("Authorization", "Bearer {$this->m_authToken}");
        $request = $request->withAddedHeader("User-Agent", "Harvest PHP SDK");
        return $request;
    }
}
