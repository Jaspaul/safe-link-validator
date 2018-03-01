<?php

namespace Jaspaul\SafeLinkValidator;

use Google_Client;
use GuzzleHttp\Psr7\Uri;
use Google_Service_Safebrowsing;
use Google_Service_Safebrowsing_ThreatInfo;
use Google_Service_Safebrowsing_ThreatEntry;
use Google_Service_Safebrowsing_FindThreatMatchesRequest;

class Link
{
    /**
     * The link to test
     *
     * @var \GuzzleHttp\Psr7\Uri
     */
    private $uri;

    /**
     * Creates a new link from the provided url string.
     *
     * @param string $url
     *
     * @return \Jaspaul\SafeLinkValidator\Link
     */
    public static function fromString(string $url): Link
    {
        return new Link(new Uri($url));
    }

    /**
     * Creates a new link.
     *
     * @param \GuzzleHttp\Psr7\Uri $uri
     */
    private function __construct(Uri $uri)
    {
        $this->uri = $uri;
    }

    /**
     * Determines if the link is safe or not.
     *
     * @return boolean
     */
    public function isSafe(): bool
    {
        $client = new Google_Client();
        $client->setDeveloperKey(config('safe-links.api-key'));

        $threatEntry = new Google_Service_Safebrowsing_ThreatEntry();
        $threatEntry->setUrl((string) $this->uri);

        $threatInfo = new Google_Service_Safebrowsing_ThreatInfo();
        $threatInfo->setThreatTypes(config('safe-links.types'));
        $threatInfo->setPlatformTypes(config('safe-links.platforms'));
        $threatInfo->setThreatEntryTypes(config('safe-links.entry-types'));
        $threatInfo->setThreatEntries([$threatEntry]);

        $request = new Google_Service_Safebrowsing_FindThreatMatchesRequest();
        $request->setThreatInfo($threatInfo);

        $service = new Google_Service_Safebrowsing($client);
        $matches = $service->threatMatches->find($request)->getMatches();

        return empty($matches);
    }
}
