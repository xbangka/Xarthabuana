<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Web_page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['lojin'] = 'lojin' ;
$route['news']  = 'post/s/news' ;
$route['tips']  = 'post/s/tips' ;
$route['page/(:any)'] = 'page/s/$1' ;

$route['news/page/(:any)'] = 'post/s/news/xpage/$1' ;
$route['tips/page/(:any)'] = 'post/s/tips/xpage/$1' ;

$route['news/(:any)'] = 'post/s/news/$1' ;
$route['tips/(:any)'] = 'post/s/tips/$1' ;

$route['gallery/page/(:any)'] = 'gallery/page/$1' ;
$route['gallery/(:any)'] = 'gallery/detailfoto/$1' ;

$route['cabang/page/(:any)'] = 'cabang/page/$1' ;
$route['cabang/peta'] = 'cabang/peta' ;
$route['cabang/(:any)'] = 'cabang/detailcabang/$1' ;
