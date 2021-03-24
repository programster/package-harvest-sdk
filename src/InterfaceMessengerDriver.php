<?php

/*
 * The interface for a driver that implements the psr-7 interface.
 */

namespace Programster\Harvest;

interface InterfaceMessengerDriver
{
    public function newRequest() : \Psr\Http\Message\RequestInterface;

    public function convertStringToUri(string $uri) : \Psr\Http\Message\UriInterface;
}