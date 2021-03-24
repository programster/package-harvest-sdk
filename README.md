# Harvest SDK
A PHP package to make it easy to interface with the [Harvest API (currently v2)](https://help.getharvest.com/api-v2/)

This was written to make use of the PSR-7 messaging interface, so that it could use an implementation of your choice. For now, I have only implemented [one driver using Guzzle](https://github.com/programster/package-harvest-sdk-guzzle-driver), that you will probably want to use if you don't wish to use your own.
