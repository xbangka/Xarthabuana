<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


function judul_seo($string){$c = array (' '); $d = array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+'); $string = str_replace($d, '', $string);
 $string = strtolower(str_replace($c, '-', $string)); return $string;}
///============================================================
function floattostr($val){ preg_match( "#^([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)$#", trim($val), $o ); return $o[1].sprintf('%d',$o[2]).($o[3]!='.'?$o[3]:''); }
///============================================================

function nama_bulan($num_bulan)
{
	$arr_bln = array('','Januari','Pebruari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
	$num_bulan = $arr_bln[ floattostr($num_bulan) ];
	return $num_bulan;
}

function waktu_lalu($timestamp)
{
    $selisih = time() - strtotime($timestamp) ;

    $detik = $selisih ;
    $menit = round($selisih / 60 );
    $jam = round($selisih / 3600 );
    $hari = round($selisih / 86400 );

    $k = explode('-',substr($timestamp,0,10) );
    $k[1] = substr(nama_bulan($k[1]),0,3) ;
    $tgl = floattostr($k[2]).' '.$k[1].' '.$k[0] ;

    if ($detik <= 30) {
        $waktu = 'Baru Saja';
    } else if ($detik <= 60) {
        $waktu = $detik.' detik';
    } else if ($menit <= 60) {
        $waktu = $menit.' menit';
    } else if ($jam <= 24) {
        $waktu = $jam.' jam';
    } else if ($hari <= 1) {
        $waktu = 'Kemarin';
    } else if ($hari <= 3) {
        $waktu = $hari.' hari';
    } else if ($hari >= 4) {
        $waktu = $tgl;
    }
    
    return $waktu;
}





?>