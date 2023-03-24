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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Home';
$route['subscription'] = 'Master/subscription';
$route['addsubscription'] = 'Master/addsubscription';
$route['sliders'] = 'Master/sliders';
$route['slideradd'] = 'Master/slideradd';
$route['propertycategory'] = 'Master/propertycategory';
$route['propertyaddcategory'] = 'Master/propertyaddcategory';
$route['amenities'] = 'Master/propertyamenity';
$route['addamenity'] = 'Master/propertyaddamenity';
$route['propertylist'] = 'Master/propertyList';
$route['users'] = 'Master/users';
$route['statesadd'] = 'Master/stateadd';
$route['states'] = 'Master/states';
$route['cities'] = 'Master/city';
$route['area'] = 'Master/area';
$route['areaadd'] = 'Master/areaadd';
$route['cityadd'] = 'Master/cityadd';
$route['testimonials'] = 'Master/testimonials';
$route['testimonialsadd'] = 'Master/testimonialsadd';
$route['partners'] = 'Master/partners';
$route['partnersadd'] = 'Master/partnersadd';
$route['pincodes'] = 'Master/pincodes';
$route['pincodeadd'] = 'Master/pincodeadd';
$route['aboutus'] = 'Master/about';
$route['privacy'] = 'Master/privacy';
$route['terms'] = 'Master/terms';
$route['brochure'] = 'Master/brochure';
$route['cancellationpolicy'] = 'Master/cancellationpolicy';
$route['refundpolicy'] = 'Master/returnpolicy';
$route['contactus'] = 'Master/contactus';
$route['newsletter'] = 'Master/newsletter';
$route['faq'] = 'Master/faq';
$route['faqadd'] = 'Master/faqadd';
$route['sociallinks'] = 'Master/sociallinks';
$route['propertyreporty'] = 'Reports/propertyReports';
$route['customerreport'] = 'Reports/customerReports';
$route['customerreviewreport'] = 'Reports/customerreviewReport';
$route['expiryreports'] = 'Reports/expiryreports';
$route['visitors'] = 'Reports/visitors';
$route['revenue'] = 'Reports/revenueReports';
$route['zonewisereport'] = 'Reports/zonewisereport';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
