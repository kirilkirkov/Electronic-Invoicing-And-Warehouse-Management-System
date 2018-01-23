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
$route['(\w{2})?/?loadlanguage/(:any)'] = "Loader/jsFile/$2";
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* ADMIN PANEL ROUTES */
$route['admin'] = "admin/home/login";
$route['admin/logout'] = "admin/home/login/logout";
$route['admin/plans/requests'] = "admin/plans/requests";
$route['admin/plans/requests/(:num)'] = "admin/plans/requests/index/$1";
$route['admin/plans/individual/request'] = "admin/plans/requests/custom";
$route['admin/plans/individual/request/(:num)'] = "admin/plans/requests/custom/$1";
/* ADMIN PANEL ROUTES */
$route['bankpayment'] = "users/plans/PlansUsers/cardPayment";
/* AJAX CALLED */
/* USERS PANEL ROUTES */
$route['(\w{2})?/?user'] = "users/home";
$route['(\w{2})?/?user/logout'] = "home/logout";
$route['(\w{2})?/?user/managefirms'] = "users/managefirms/managefirms";
$route['(\w{2})?/?user/managefirms/edit/(:num)'] = "users/managefirms/managefirms/editCompany/$2";
$route['(\w{2})?/?user/managefirms/edit/(:num)/(:num)'] = "users/managefirms/managefirms/editCompany/$2/$3";
$route['(\w{2})?/?user/usecompany/(:num)'] = "users/home/home/useCompany/$2";
$route['(\w{2})?/?user/managefirms/delete-translation/(:num)/(:num)'] = "users/managefirms/managefirms/deleteTranslation/$2/$3";
$route['(\w{2})?/?user/managefirms/delete-company/(:num)'] = "users/managefirms/managefirms/deleteCompany/$2";
$route['(\w{2})?/?user/managefirms/make-default/(:num)'] = "users/managefirms/managefirms/makeDefaultFirm/$2";
$route['(\w{2})?/?user/managefirms/make-default-translation/(:num)/(:num)'] = "users/managefirms/managefirms/makeDefaultTranslation/$2/$3";
$route['(\w{2})?/?user/new/invoice'] = "users/invoices/newinvoice";
$route['(\w{2})?/?user/settings/invoices'] = "users/settings/invoices";
$route['(\w{2})?/?user/defaultcurrency'] = 'users/settings/invoices/defaultcurrency'; // ajax called
$route['(\w{2})?/?user/settings/invoices/delete/default/(:num)'] = 'users/settings/invoices/deletedefaultcurrency/$2';
$route['(\w{2})?/?user/settings/invoices/delete/currency/(:num)'] = 'users/settings/invoices/deletecurrency/$2';
$route['(\w{2})?/?user/addnewquantitytype'] = 'users/invoices/newinvoice/addnewquantitytype'; // ajax called
$route['(\w{2})?/?user/settings'] = "users/settings/settings";
$route['(\w{2})?/?user/settings/invoices/delete/quantitytype/(:num)'] = 'users/settings/invoices/deletequantitytype/$2';
$route['user/addnewpaymentmethod'] = 'users/invoices/newinvoice/addnewpaymentmethod'; // ajax called
$route['(\w{2})?/?user/settings/invoices/delete/paymentmethod/(:num)'] = 'users/settings/invoices/deletepaymentmethod/$2';
$route['(\w{2})?/?user/settings/invoices/delete/novatreason/(:num)'] = 'users/settings/invoices/deletenovatreason/$2';
$route['(\w{2})?/?user/modalselector'] = 'users/invoices/newinvoice/modalselector'; // ajax called
$route['(\w{2})?/?user/invoices'] = "users/invoices/invoices";
$route['(\w{2})?/?user/invoices/(:num)'] = "users/invoices/invoices/index/$2";
$route['(\w{2})?/?user/(invoice|pro-forma|debit-note|credit-note)/edit/(:num)'] = "users/invoices/newinvoice/index/$2/$3";
$route['(\w{2})?/?user/clients'] = "users/clients/clients";
$route['(\w{2})?/?user/clients/(:num)'] = "users/clients/clients/index/$2";
$route['(\w{2})?/?user/client/delete/(:num)'] = "users/clients/clients/deleteclient/$2";
$route['(\w{2})?/?user/client/edit/(:num)'] = "users/clients/clients/addclient/$2";
$route['(\w{2})?/?user/client/add'] = "users/clients/clients/addclient";
$route['(\w{2})?/?user/items'] = "users/items/items";
$route['(\w{2})?/?user/items/(:num)'] = "users/items/items/index/$2";
$route['(\w{2})?/?user/item/delete/(:num)'] = "users/items/items/deleteitem/$2";
$route['(\w{2})?/?user/item/edit/(:num)'] = "users/items/items/additem/$2";
$route['(\w{2})?/?user/item/add'] = "users/items/items/additem";
$route['(\w{2})?/?user/settings/employees'] = "users/settings/employees";
$route['(\w{2})?/?user/settings/employees/(:num)'] = "users/settings/employees/index/$2";
$route['(\w{2})?/?user/settings/employees/add'] = "users/settings/employees/addnew";
$route['(\w{2})?/?user/settings/employees/add/(:num)'] = "users/settings/employees/addnew/$2";
$route['(\w{2})?/?user/settings/employees/delete/(:num)'] = "users/settings/employees/deleteemployee/$2";
$route['(\w{2})?/?user/settings/employees/rights/(:num)'] = "users/settings/employees/managerights/$2";
$route['(\w{2})?/?user/admin'] = "users/settings/admin";
$route['(\w{2})?/?user/(invoice|pro-forma|debit-note|credit-note)/view/(:num)'] = "users/invoices/invoiceview/index/$2/$3";
$route['(\w{2})?/?user/(invoice|pro-forma|debit-note|credit-note)/print/(original|copy)/(:num)'] = "users/invoices/invoiceview/viewInvoiceAsPdf/$2/$3/$4";
$route['(\w{2})?/?user/invoice/delete/(:num)'] = "users/invoices/invoices/deleteInvoice/$2";
$route['(\w{2})?/?user/reports'] = "users/reports/reports";
$route['(\w{2})?/?user/settings/global'] = "users/settings/GlobalSettings";
$route['(\w{2})?/?user/changeinvoicestatus'] = 'users/invoices/invoices/changeinvoicepaymentstatus'; // ajax called
$route['(\w{2})?/?user/findresults'] = 'users/home/home/findresults'; // ajax called
$route['(\w{2})?/?user/client/view/(:num)'] = "users/clients/clients/viewclient/$2";
$route['(\w{2})?/?user/item/view/(:num)'] = "users/items/items/viewitem/$2";
$route['(\w{2})?/?user/import-export'] = "users/import_export/ImportExport";
$route['(\w{2})?/?user/store'] = "users/store/Store";
$route['(\w{2})?/?user/store/(:num)'] = "users/store/store/index/$2";
$route['(\w{2})?/?user/settings/stores'] = "users/settings/stores";
$route['(\w{2})?/?user/settings/stores/delete/store/(:num)'] = "users/settings/stores/deletestore/$2";
$route['(\w{2})?/?user/store/add-movement'] = "users/store/Store/addmovement";
$route['(\w{2})?/?user/movement/view/(:num)'] = "users/store/movementview/index/$2";
$route['(\w{2})?/?user/store-order/print/(:num)'] = "users/store/movementview/viewMovementAsPdf/$2";
$route['(\w{2})?/?user/store/stocks'] = "users/store/Store/stocks";
$route['(\w{2})?/?user/store/stocks/(:num)'] = "users/store/Store/stocks/$2";
$route['(\w{2})?/?user/warranties'] = "users/warranty/warranty";
$route['(\w{2})?/?user/warranties/(:num)'] = "users/warranty/warranty/index/$2";
$route['(\w{2})?/?user/warranties/add-warranty'] = "users/warranty/warranty/addwarranty";
$route['(\w{2})?/?user/warranty/print/(:num)'] = "users/warranty/warrantyview/viewWarrantyAsPdf/$2";
$route['(\w{2})?/?user/warranty/edit/(:num)'] = "users/warranty/warranty/addwarranty/$2";
$route['(\w{2})?/?user/settings/warranty'] = "users/settings/warranty";
$route['(\w{2})?/?user/settings/warranty/delete/condition/(:num)'] = "users/settings/warranty/deleteCondition/$2";
$route['(\w{2})?/?user/warranty/events/(:num)'] = "users/warranty/events/index/$2";
$route['(\w{2})?/?user/warranty/events/(:num)/add-event'] = "users/warranty/events/addevent/$2";
$route['(\w{2})?/?user/protocols'] = "users/protocols/protocols";
$route['(\w{2})?/?user/protocols/(:num)'] = "users/protocols/protocols/index/$2";
$route['(\w{2})?/?user/settings/protocols'] = "users/settings/protocols";
$route['(\w{2})?/?user/protocols/add-protocol'] = "users/protocols/protocols/addprotocol";
$route['(\w{2})?/?user/protocol/print/(:num)'] = "users/protocols/protocolview/viewProtocolAsPdf/$2";
$route['(\w{2})?/?user/protocol/edit/(:num)'] = "users/protocols/protocols/addprotocol/$2";
$route['(\w{2})?/?user/settings/protocols/delete/provider-transmit/(:num)'] = "users/settings/protocols/deleteProviderTransmitText/$2";
$route['(\w{2})?/?user/settings/protocols/delete/contract/(:num)'] = "users/settings/protocols/deleteContract/$2";
$route['(\w{2})?/?user/plans'] = "users/plans/PlansUsers";
$route['(\w{2})?/?user/plan/(:any)'] = "users/plans/PlansUsers/chooseperiod/$2";
$route['(\w{2})?/?user/myplan/request'] = "users/plans/PlansUsers/planrequest";
$route['pdffooter'] = 'home/getinvoicefooter';
/* USERS PANEL ROUTES */

$route['^(\w{2})$'] = $route['default_controller'];
$route['(\w{2})?/?login'] = "registration/login";
$route['(\w{2})?/?password-forgotten'] = "registration/forgotten";
$route['(\w{2})?/?choose-type-of-login'] = 'registration/choosetype';
$route['accept/invoice/(:any)'] = 'home/publicAcceptInvoice/$1';
$route['^(\w{2})/(:any)$'] = '$2';
