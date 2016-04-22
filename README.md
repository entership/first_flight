first_flight
============

A Symfony project created on October 5, 2015, 3:05 am.

## Debug in Console

Set up the following config in `/private/etc/php.ini` (Mac OS) at the end of the file.

```
[XDebug]
zend_extension=/usr/lib/php/extensions/no-debug-non-zts-20121212/xdebug.so
xdebug.remote_enable = 1
xdebug.remote_host = 127.0.0.1
xdebug.remote_port = 9000
xdebug.idekey = PHPSTORM
xdebug.remote_autostart = 1
```
Create new **PHP-Script** configuration in **Run\Debug Configuration** window.
 
```
Configuration:
    File: `~/Documents/Repositories/first_flight/app/console`
```

Run command

```
php app/console coppermine_parser:parse
```
