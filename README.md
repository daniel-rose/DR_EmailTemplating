DR_EmailTemplating
==================
This module allows to override email templates per theme.

For example:

To override the "account_new" template, copy the file "account_new.html" from "app/code/locale/en_US/template/email" to "app/design/PACKAGE/THEME/locale/en_US/template/email". Now the copyied file will be used for sending a mail after registration.

Installation
-------
For installing this module, it gives various ways:

```
modman
modman init 			    # if modman is not initialized
modman clone http://... 	# gets the latest code from the master branch and links it
```

composer
Add the following line to the file „composer.json“:
`'dr/email-templating': '>=1.0.0'`

copy/paste
Download the latest code from github and copy all files to the magento root directory.

By using modman or composer the setting "allow symlinks" must be enabled. After the module is installed, the cache has to be cleared.

Developer
---------
Daniel Rose
* Xing: http://www.xing.de/...

Licence
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Copyright
---------
(c) 2015 Daniel Rose