<?php

/*
 * The interface for a driver that implements the psr-7 interface.
 */

namespace Programster\Harvest;

interface InterfaceMessengerDriver
{
    /**
     * Create a barebones new request object that implements the Request Interface.
     * We will use the interface's methods to "build it up" before sending. 
     * @return \Psr\Http\Message\RequestInterface;
     */
    public function newRequest() : \Psr\Http\Message\RequestInterface;

    /**
     * Convert a URI string to an object that implements the UriInterface
     * @param string $uri - The URI to convert. E.g. https://www.google.com/search?q=programster
     * @return \Psr\Http\Message\UriInterface - an object that implements this interface.
     */
    public function convertStringToUri(string $uri) : \Psr\Http\Message\UriInterface;
}
