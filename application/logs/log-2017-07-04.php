<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-07-04 09:02:46 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 09:02:47 --> 404 Page Not Found: /index
ERROR - 2017-07-04 09:02:47 --> 404 Page Not Found: /index
ERROR - 2017-07-04 09:02:56 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 09:08:54 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 09:09:31 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 09:11:51 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 09:11:52 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 09:12:06 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 09:33:15 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 09:47:56 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 09:48:41 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 10:02:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/inv/application/modules/users/controllers/store/Store.php:55) /var/www/html/inv/system/core/Common.php 570
ERROR - 2017-07-04 10:02:01 --> Severity: Error --> Call to undefined method NewInvoiceModel::setMovement() /var/www/html/inv/application/modules/users/controllers/store/Store.php 66
ERROR - 2017-07-04 10:02:11 --> Severity: Error --> Call to undefined method NewInvoiceModel::setMovement() /var/www/html/inv/application/modules/users/controllers/store/Store.php 65
ERROR - 2017-07-04 10:02:19 --> Severity: Error --> Call to undefined method NewInvoiceModel::setMovement() /var/www/html/inv/application/modules/users/controllers/store/Store.php 65
ERROR - 2017-07-04 10:02:36 --> Severity: Notice --> Undefined index: invoice_firm_translation /var/www/html/inv/application/modules/users/models/StoreModel.php 121
ERROR - 2017-07-04 10:02:36 --> Severity: Notice --> Undefined variable: invoiceId /var/www/html/inv/application/modules/users/models/StoreModel.php 129
ERROR - 2017-07-04 10:02:36 --> Query error: Column 'for_movement' cannot be null - Invalid query: INSERT INTO `movements_firms` (`for_movement`, `bulstat`, `name`, `address`, `city`, `accountable_person`, `image`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, '')
ERROR - 2017-07-04 10:03:04 --> Severity: Notice --> Undefined variable: invoiceId /var/www/html/inv/application/modules/users/models/StoreModel.php 153
ERROR - 2017-07-04 10:03:04 --> Query error: Unknown column 'for_user' in 'field list' - Invalid query: INSERT INTO `movements_translations` (`for_user`, `language_name`, `bill_of_goods`, `date`, `recipient`, `sender`, `bulstat`, `address`, `betrayed`, `accepted`, `amount`, `vat`, `vat_amount`, `no_vat_reason`, `final_amount`, `product_name`, `product_quantity`, `product_quantity_type`, `single_price`, `product_amount`, `payment_method`, `for_movement`) VALUES ('0', 'English', 'Bill of goods', 'Date', 'Recipient', 'Sender', 'Bulstat', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', NULL)
ERROR - 2017-07-04 10:03:15 --> Query error: Unknown column 'for_user' in 'field list' - Invalid query: INSERT INTO `movements_translations` (`for_user`, `language_name`, `bill_of_goods`, `date`, `recipient`, `sender`, `bulstat`, `address`, `betrayed`, `accepted`, `amount`, `vat`, `vat_amount`, `no_vat_reason`, `final_amount`, `product_name`, `product_quantity`, `product_quantity_type`, `single_price`, `product_amount`, `payment_method`, `for_movement`) VALUES ('0', 'English', 'Bill of goods', 'Date', 'Recipient', 'Sender', 'Bulstat', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '0')
ERROR - 2017-07-04 10:03:57 --> Query error: Unknown column 'for_invoice' in 'field list' - Invalid query: INSERT INTO `movement_items` (`for_invoice`, `name`, `quantity`, `quantity_type`, `single_price`, `total_price`, `position`) VALUES (4, 'Банани', '22', 'kilogram', '2', '0.00', 1)
ERROR - 2017-07-04 10:11:40 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 10:20:31 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 10:56:35 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 10:59:44 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:07:29 --> Severity: Error --> Call to undefined function float() /var/www/html/inv/application/modules/users/views/store/addmovement.php 16
ERROR - 2017-07-04 11:07:30 --> Severity: Error --> Call to undefined function float() /var/www/html/inv/application/modules/users/views/store/addmovement.php 16
ERROR - 2017-07-04 11:07:55 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:08:00 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:09:54 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:10:12 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:11:48 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:20:18 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:33:02 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:34:30 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:34:42 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:41:03 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:42:50 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:43:27 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:45:35 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:46:04 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:46:26 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:46:26 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:47:29 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:47:31 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:48:06 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:48:59 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:48:59 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:50:06 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:50:53 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:52:37 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:54:21 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 11:55:47 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 12:11:28 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 12:12:56 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 12:14:10 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 12:48:05 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 14:19:20 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 14:19:21 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 14:20:21 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 14:20:46 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 14:28:35 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 14:29:37 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 14:38:30 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 14:38:41 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 14:58:56 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:11:15 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:11:24 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:12:24 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:13:26 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:20:46 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:21:06 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:30:24 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:32:21 --> Could not find the language line "trans_date"
ERROR - 2017-07-04 15:32:46 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:33:05 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:33:15 --> Could not find the language line "trans_address"
ERROR - 2017-07-04 15:33:15 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:35:19 --> Could not find the language line "trans_vat"
ERROR - 2017-07-04 15:35:19 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:43:13 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:49:12 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:51:33 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:55:51 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:57:50 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 15:57:55 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:03:50 --> Severity: Error --> Call to a member function countItems() on null /var/www/html/inv/application/modules/users/controllers/store/Store.php 35
ERROR - 2017-07-04 16:03:51 --> Severity: Error --> Call to a member function countItems() on null /var/www/html/inv/application/modules/users/controllers/store/Store.php 35
ERROR - 2017-07-04 16:03:58 --> Severity: Notice --> Undefined property: CI::$ItemsModel /var/www/html/inv/application/third_party/MX/Controller.php 59
ERROR - 2017-07-04 16:03:58 --> Severity: Error --> Call to a member function countItems() on null /var/www/html/inv/application/modules/users/controllers/store/Store.php 35
ERROR - 2017-07-04 16:04:34 --> Severity: Error --> Call to undefined method StoreModel::countMovements() /var/www/html/inv/application/modules/users/controllers/store/Store.php 35
ERROR - 2017-07-04 16:14:33 --> Severity: Error --> Call to undefined method StoreModel::countMovements() /var/www/html/inv/application/modules/users/controllers/store/Store.php 35
ERROR - 2017-07-04 16:31:44 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:32:25 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:32:36 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 56
ERROR - 2017-07-04 16:32:46 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 56
ERROR - 2017-07-04 16:36:36 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 56
ERROR - 2017-07-04 16:36:39 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 56
ERROR - 2017-07-04 16:36:46 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 56
ERROR - 2017-07-04 16:36:46 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:36:55 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 56
ERROR - 2017-07-04 16:39:21 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 56
ERROR - 2017-07-04 16:39:49 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 56
ERROR - 2017-07-04 16:41:04 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 56
ERROR - 2017-07-04 16:42:10 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 56
ERROR - 2017-07-04 16:42:10 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:42:59 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 56
ERROR - 2017-07-04 16:43:32 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 58
ERROR - 2017-07-04 16:43:32 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:43:39 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/inv/application/modules/users/views/store/index.php 58
ERROR - 2017-07-04 16:43:39 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:44:02 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:44:38 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:44:47 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:44:50 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:46:01 --> Could not find the language line "movem_type_in"
ERROR - 2017-07-04 16:46:01 --> Could not find the language line "movem_type_in"
ERROR - 2017-07-04 16:46:01 --> Could not find the language line "movem_type_in"
ERROR - 2017-07-04 16:46:01 --> Could not find the language line "movem_type_in"
ERROR - 2017-07-04 16:46:01 --> Could not find the language line "movem_type_in"
ERROR - 2017-07-04 16:46:01 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:46:54 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:47:18 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:47:20 --> 404 Page Not Found: ../modules/users/controllers/items//index
ERROR - 2017-07-04 16:47:22 --> 404 Page Not Found: ../modules/users/controllers/items//index
ERROR - 2017-07-04 16:47:40 --> 404 Page Not Found: ../modules/users/controllers/items//index
ERROR - 2017-07-04 16:47:41 --> 404 Page Not Found: ../modules/users/controllers/items//index
ERROR - 2017-07-04 16:48:02 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:48:02 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:48:02 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:52:07 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:52:15 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:52:15 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:52:15 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:52:32 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:56:24 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:56:35 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:56:37 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:56:37 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:56:37 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:56:43 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:56:43 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:56:43 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 16:56:49 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 16:57:08 --> Query error: Unknown column 'for_user' in 'field list' - Invalid query: INSERT INTO `movements_translations` (`for_user`, `language_name`, `bill_of_goods`, `date`, `recipient`, `sender`, `bulstat`, `address`, `betrayed`, `accepted`, `amount`, `vat`, `vat_amount`, `no_vat_reason`, `final_amount`, `product_name`, `product_quantity`, `product_quantity_type`, `single_price`, `product_amount`, `payment_method`, `for_movement`) VALUES ('0', 'English', 'Bill of goods', 'Date', 'Recipient', 'Sender', 'Bulstat', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '0')
ERROR - 2017-07-04 16:57:08 --> Array
(
    [code] => 1054
    [message] => Unknown column 'for_user' in 'field list'
)

ERROR - 2017-07-04 16:57:20 --> Query error: Unknown column 'for_user' in 'field list' - Invalid query: INSERT INTO `movements_translations` (`for_user`, `language_name`, `bill_of_goods`, `date`, `recipient`, `sender`, `bulstat`, `address`, `betrayed`, `accepted`, `amount`, `vat`, `vat_amount`, `no_vat_reason`, `final_amount`, `product_name`, `product_quantity`, `product_quantity_type`, `single_price`, `product_amount`, `payment_method`, `for_movement`) VALUES ('0', 'English', 'Bill of goods', 'Date', 'Recipient', 'Sender', 'Bulstat', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '0')
ERROR - 2017-07-04 16:57:20 --> Array
(
    [code] => 1054
    [message] => Unknown column 'for_user' in 'field list'
)

ERROR - 2017-07-04 16:58:11 --> Query error: Unknown column 'for_user' in 'field list' - Invalid query: INSERT INTO `movements_translations` (`for_user`, `language_name`, `bill_of_goods`, `date`, `recipient`, `sender`, `bulstat`, `address`, `betrayed`, `accepted`, `amount`, `vat`, `vat_amount`, `no_vat_reason`, `final_amount`, `product_name`, `product_quantity`, `product_quantity_type`, `single_price`, `product_amount`, `payment_method`, `for_movement`) VALUES ('0', 'English', 'Bill of goods', 'Date', 'Recipient', 'Sender', 'Bulstat', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '0')
ERROR - 2017-07-04 16:58:11 --> Array
(
    [code] => 1054
    [message] => Unknown column 'for_user' in 'field list'
)

ERROR - 2017-07-04 16:58:58 --> Query error: Unknown column 'for_user' in 'field list' - Invalid query: INSERT INTO `movements_translations` (`for_user`, `language_name`, `bill_of_goods`, `date`, `recipient`, `sender`, `bulstat`, `address`, `betrayed`, `accepted`, `amount`, `vat`, `vat_amount`, `no_vat_reason`, `final_amount`, `product_name`, `product_quantity`, `product_quantity_type`, `single_price`, `product_amount`, `payment_method`, `for_movement`) VALUES ('0', 'English', 'Bill of goods', 'Date', 'Recipient', 'Sender', 'Bulstat', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '0')
ERROR - 2017-07-04 16:58:58 --> Array
(
    [code] => 1054
    [message] => Unknown column 'for_user' in 'field list'
)

ERROR - 2017-07-04 16:59:36 --> Query error: Unknown column 'for_user' in 'field list' - Invalid query: INSERT INTO `movements_translations` (`for_user`, `language_name`, `bill_of_goods`, `date`, `recipient`, `sender`, `bulstat`, `address`, `betrayed`, `accepted`, `amount`, `vat`, `vat_amount`, `no_vat_reason`, `final_amount`, `product_name`, `product_quantity`, `product_quantity_type`, `single_price`, `product_amount`, `payment_method`, `for_movement`) VALUES ('0', 'English', 'Bill of goods', 'Date', 'Recipient', 'Sender', 'Bulstat', 'Address', 'Betrayed', 'Accepted', 'Amount', 'Vat', 'Vat amount', 'No vat reason', 'Amount', 'Name', 'Quantity', 'Quantity type', 'Price', 'Amount', 'Payment method', '0')
ERROR - 2017-07-04 16:59:36 --> Array
(
    [code] => 1054
    [message] => Unknown column 'for_user' in 'field list'
)

ERROR - 2017-07-04 16:59:47 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 17:00:31 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 17:00:31 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 17:00:31 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 17:06:40 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 17:13:33 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 17:13:37 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 17:13:40 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 17:13:40 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 17:13:40 --> Could not find the language line "movem_type_revis"
ERROR - 2017-07-04 17:14:08 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 17:17:11 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 17:17:12 --> 404 Page Not Found: /index
ERROR - 2017-07-04 17:17:12 --> 404 Page Not Found: /index
ERROR - 2017-07-04 17:19:44 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 17:19:53 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 17:27:22 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
ERROR - 2017-07-04 17:54:18 --> Severity: Core Warning --> PHP Startup: Unable to load dynamic library '/usr/lib/php/20131226/php_intl.dll' - /usr/lib/php/20131226/php_intl.dll: cannot open shared object file: No such file or directory Unknown 0
