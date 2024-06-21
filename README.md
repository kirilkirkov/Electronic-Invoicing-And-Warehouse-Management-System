# Electronic Invoicing and Warehouse Management System

## Overview
A robust and versatile system for managing electronic invoices and warehouse operations. Built using CodeIgniter 3.1.13 and Bootstrap 3.3.7, this self-hosted solution allows for unlimited free invoicing, PDF downloads, and comprehensive management of clients, items, and employees.

### Key Features
- **Unlimited Electronic Invoices:** Create, manage, and download invoices as PDFs.
- **Multi-Company Support:** Manage multiple companies within a single account.
- **Client and Item Management:** Maintain detailed records of clients and items with pricing.
- **Protocol and Warranty Creation:** Generate and export protocols and warranties to PDF.
- **Invoice Status Tracking:** Easily monitor paid and unpaid invoices.
- **Multi-Language Support:** Available in English, French, and Bulgarian, with customizable translations.
- **Warehouse Operations:** Track warehouse movements, manage stock quantities, and generate bills of goods.
- **Employee Permissions:** Assign specific permissions to different employees.
- **Reports and Statistics:** Generate comprehensive reports and export invoices as XML or Excel files.
- **Responsive Design:** Optimized for mobile devices, tablets, and high-resolution monitors.
- **Customizable Settings:** Adjust settings for rounding prices, toner-saving PDF options, and more.

### Current Versions
- **CodeIgniter:** 3.1.13
- **Bootstrap:** 3.3.7

## Installation
1. Import `database.sql` to your MySQL database.
2. Set the database, username, and password in `application/config/database.php`.

If routing does not work automatically, set the base URL in `application/config/config.php`:
```php
$config['base_url'] = defined('BASE_URL') ? BASE_URL : 'https://your-website.com/';
```

## Usage
1. Visit the homepage and register a new account.
2. Log in with your new credentials to start issuing unlimited invoices, protocols, and warranties.

### Administration
- Access the admin panel at `/admin` (e.g., `https://yoursite.com/admin`).
- Default credentials:
  - **Username:** admin
  - **Password:** admin

## Download as WordPress Plugin
<a href="https://codecanyon.net/item/wp-invoices-pdf-electronic-invoicing-system/36891583">Available for integration with WordPress as a plugin.</a>

## Screenshots
- **PDF Invoice:** ![alt text](https://raw.githubusercontent.com/kirilkirkov/ei/master/design/user/design_of_invoice.png?token=ADQ0kH5ObqDK3l2H-K4gXn74aIeVi0fVks5acX1HwA%3D%3D "Logo Title Text 1")
- **Invoices List:** ![alt text](https://raw.githubusercontent.com/kirilkirkov/ei/master/design/user/design_of_invoices_list.png?token=ADQ0kGLfoXLmpNGV5HYZewfaZHzr3qA9ks5acX1IwA%3D%3D "Logo Title Text 1")
- **Create Invoice Page:** ![alt text](https://raw.githubusercontent.com/kirilkirkov/ei/master/design/user/create_invoice_page.png?token=ADQ0kGcYR3mBvj8ANBbPJ8wg8w69gpgPks5acX1FwA%3D%3D "Logo Title Text 1")
- **Statistics:** ![alt text](https://raw.githubusercontent.com/kirilkirkov/ei/master/design/user/stats.png?token=ADQ0kGcYR3mBvj8ANBbPJ8wg8w69gpgPks5acX1FwA%3D%3D "Logo Title Text 1")

## Donate
If this project helps you save time in development, consider buying me a cup of coffee to support its ongoing development. Thank you!

[![Donate](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/donate/?hosted_button_id=PF5ES4K748ZEY)