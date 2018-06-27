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
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller']                       = 'home';
$route['siswa/(:num)']                             = 'siswa/index/$1';
$route['judul/(:num)']                             = 'judul/index/$1';
$route['peminjaman/(:num)']                        = 'peminjaman/index/$1';
$route['laporan-buku']                             = 'laporan/laporan_buku';
$route['cetak-laporan-buku']                       = 'laporan/cetak_laporan_buku';
$route['laporan-peminjaman']                       = 'laporan/laporan_peminjaman';
$route['cetak-laporan-peminjaman/(:any)/(:any)']   = 'laporan/cetak_laporan_peminjaman/$1/$2';
$route['laporan-pengembalian']                     = 'laporan/laporan_pengembalian';
$route['cetak-laporan-pengembalian/(:any)/(:any)'] = 'laporan/cetak_laporan_pengembalian/$1/$2';
$route['laporan-denda']                            = 'laporan/laporan_denda';
$route['cetak-laporan-denda/(:any)/(:any)']        = 'laporan/cetak_laporan_denda/$1/$2';
$route['logout']                                   = 'login/logout';