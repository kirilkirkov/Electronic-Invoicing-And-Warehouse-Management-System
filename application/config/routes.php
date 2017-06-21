<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['loadlanguage/(:any)'] = "Loader/jsFile/$1";
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* ADMIN PANEL ROUTES */
$route['admin'] = "admin/home/login";
$route['admin/logout'] = "admin/home/login/logout";
// BLOG GROUP
$route['admin/blogpublish'] = "admin/blog/BlogPublish";
$route['admin/blogpublish/(:num)'] = "admin/blog/BlogPublish/index/$1";
$route['admin/blog'] = "admin/blog/blog";
$route['admin/blog/(:num)'] = "admin/blog/blog/index/$1";
// BLOG GROUP FINISH
$route['admin/texts'] = "admin/texts/texts";
$route['admin/addquestion'] = "admin/texts/addquestion";
$route['admin/questions'] = "admin/texts/questions";
$route['admin/addfeature'] = "admin/features/addfeature";
$route['admin/features'] = "admin/features/features";
$route['admin/features/(:num)'] = "admin/features/features/index/$1";
/* ADMIN PANEL ROUTES */

/* USERS PANEL ROUTES */
$route['user'] = "users/home";
$route['user/logout'] = "home/logout";
$route['user/managefirms'] = "users/managefirms/managefirms";
$route['user/managefirms/edit/(:num)'] = "users/managefirms/managefirms/editCompany/$1";
$route['user/managefirms/edit/(:num)/(:num)'] = "users/managefirms/managefirms/editCompany/$1/$2";
$route['user/usecompany/(:num)'] = "users/home/home/useCompany/$1";
$route['user/managefirms/delete-translation/(:num)/(:num)'] = "users/managefirms/managefirms/deleteTranslation/$1/$2";
$route['user/managefirms/delete-company/(:num)'] = "users/managefirms/managefirms/deleteCompany/$1";
$route['user/managefirms/make-default/(:num)'] = "users/managefirms/managefirms/makeDefaultFirm/$1";
$route['user/managefirms/make-default-translation/(:num)/(:num)'] = "users/managefirms/managefirms/makeDefaultTranslation/$1/$2";
$route['user/new/invoice'] = "users/invoices/newinvoice";
$route['user/settings/invoices'] = "users/settings/invoices";
$route['user/defaultcurrency'] = 'users/settings/invoices/defaultcurrency';
$route['user/settings/invoices/delete/default/(:num)'] = 'users/settings/invoices/deletedefaultcurrency/$1';
$route['user/settings/invoices/delete/currency/(:num)'] = 'users/settings/invoices/deletecurrency/$1';
$route['user/addnewquantitytype'] = 'users/invoices/newinvoice/addnewquantitytype';
$route['user/settings'] = "users/settings/settings";
$route['user/settings/invoices/delete/quantitytype/(:num)'] = 'users/settings/invoices/deletequantitytype/$1';
$route['user/addnewpaymentmethod'] = 'users/invoices/newinvoice/addnewpaymentmethod';
$route['user/settings/invoices/delete/paymentmethod/(:num)'] = 'users/settings/invoices/deletepaymentmethod/$1';
$route['user/settings/invoices/delete/novatreason/(:num)'] = 'users/settings/invoices/deletenovatreason/$1';
$route['user/modalselector'] = 'users/invoices/newinvoice/modalselector';
$route['user/invoices'] = "users/invoices/invoices";
$route['user/invoices/(:num)'] = "users/invoices/invoices/index/$1";
$route['user/(invoice|pro-forma|debit-note|credit-note)/edit/(:num)'] = "users/invoices/newinvoice/index/$1/$2";
$route['user/clients'] = "users/clients/clients";
$route['user/clients/(:num)'] = "users/clients/clients/index/$1";
$route['user/client/delete/(:num)'] = "users/clients/clients/deleteclient/$1";
$route['user/client/edit/(:num)'] = "users/clients/clients/addclient/$1";
$route['user/client/add'] = "users/clients/clients/addclient";
$route['user/items'] = "users/items/items";
$route['user/items/(:num)'] = "users/items/items/index/$1";
$route['user/item/delete/(:num)'] = "users/items/items/deleteitem/$1";
$route['user/item/edit/(:num)'] = "users/items/items/additem/$1";
$route['user/item/add'] = "users/items/items/additem";
$route['user/settings/employees'] = "users/settings/employees";
$route['user/settings/employees/(:num)'] = "users/settings/employees/index/$1";
$route['user/settings/employees/add'] = "users/settings/employees/addnew";
$route['user/settings/employees/add/(:num)'] = "users/settings/employees/addnew/$1";
$route['user/settings/employees/delete/(:num)'] = "users/settings/employees/deleteemployee/$1";
$route['user/settings/employees/rights/(:num)'] = "users/settings/employees/managerights/$1";
$route['user/admin'] = "users/settings/admin";
$route['user/(invoice|pro-forma|debit-note|credit-note)/view/(:num)'] = "users/invoices/invoiceview/index/$1/$2";
$route['user/(invoice|pro-forma|debit-note|credit-note)/print/(:num)'] = "users/invoices/invoiceview/viewInvoiceAsPdf/$1/$2";
$route['user/invoice/delete/(:num)'] = "users/invoices/invoices/deleteInvoice/$1";
$route['user/reports'] = "users/reports/reports";
$route['user/settings/global'] = "users/settings/GlobalSettings";
$route['user/changeinvoicestatus'] = 'users/invoices/invoices/changeinvoicestatus';
$route['user/findresults'] = 'users/home/home/findresults';
$route['user/client/view/(:num)'] = "users/clients/clients/viewclient/$1";
$route['user/item/view/(:num)'] = "users/items/items/viewitem/$1";
$route['user/import-export'] = "users/import_export/ImportExport";
$route['pdffooter'] = 'home/getinvoicefooter';
/* USERS PANEL ROUTES */

$route['^(\w{2})$'] = $route['default_controller'];
$route['^(\w{2})/(:any)$'] = '$2';

$route['blog/(:num)'] = "blog/index/$1";
$route['blog/(:any)_(:num)'] = "blog/viewArticle/$2";

$route['rules'] = "help/rules";

$route['login'] = "registration/login";
$route['password-forgotten'] = "registration/forgotten";
$route['choose-type-of-login'] = 'registration/choosetype';
