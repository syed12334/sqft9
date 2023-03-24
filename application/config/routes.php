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
$route['register'] = 'Home/register';
$route['about'] = 'Home/aboutus';
$route['terms'] = 'Home/terms';
$route['privacy-policy'] = 'Home/privacy';
$route['refund-policy'] = 'Home/returnpolicy';
$route['v1/addreviews'] = 'v1/App/addreviews';
$route['v1/autocomplete'] = 'v1/App/autocomplete';
$route['v1/razorpayResponse'] = 'v1/App/razorpayResponse';
$route['settings'] = 'backend';
$route['propertyview'] = 'property/propertyview/';
$route['v1/apilist'] = 'v1/App/apilist/';
$route['propertydetails/(:any)'] = 'dashboard/propertyview/$1';
$route['v1/register'] = 'v1/App/register';
$route['v1/login'] = 'v1/App/login';
$route['v1/city'] = 'v1/App/city';
$route['v1/states'] = 'v1/App/states';
$route['v1/packages'] = 'v1/App/packages';
$route['v1/homepage'] = 'v1/App/homepage';
$route['v1/propertycategory'] = 'v1/App/propertycategory';
$route['v1/subscriptionplan'] = 'v1/App/subscriptionplan';
$route['v1/propertysearch'] = 'v1/App/propertysearch';
$route['v1/properties'] = 'v1/App/properties';
$route['v1/propertyfilters'] = 'v1/App/propertyfilters';
$route['v1/reviews'] = 'v1/App/reviews';
$route['v1/propertydetails'] = 'v1/App/propertydetails';
$route['v1/profile'] = 'v1/App/profile';
$route['v1/updateprofile'] = 'v1/App/updateprofile';
$route['v1/subscriptionplanlist'] = 'v1/App/subscriptionplanlist';
$route['v1/addsubscriptionpackage'] = 'v1/App/addsubscriptionpackage';
$route['v1/renewpackage'] = 'v1/App/renewpackage';
$route['v1/favouriteproperties'] = 'v1/App/favouriteproperties';
$route['v1/deletefavouriteproperty'] = 'v1/App/deletefavouriteproperty';
$route['v1/contactlist'] = 'v1/App/contactlist';
$route['v1/addpackage'] = 'v1/App/addpackage';
$route['v1/forgotpassword'] = 'v1/App/forgotpassword';
$route['v1/changepassword'] = 'v1/App/changepassword';
$route['v1/wishlist'] = 'v1/App/wishlist';
$route['categorylist'] = 'Home/categorylist';
$route['login'] = 'Home/login';
$route['(:any)'] = 'home/propertyview/$1';

// $route['(:any)'] = 'dashboard/propertyview/$1';


$route['login'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
