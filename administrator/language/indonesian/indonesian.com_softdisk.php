<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Zaenal Mutaqin
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Indonesian language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Inti';
public $A_ASTATS = 'Statistik Administrasi';
public $A_VALUE = 'Nilai';
public $A_LASTMOD = 'Terakhir diubah';
public $A_OS = 'Sistem Operasi';
public $A_ELXIS_VERSION = 'Versi Elxis';
public $A_SELECT = 'Pilih';
public $NOEDITSYS = 'Anda tidak diijinkan untuk mengedit entri sistem';
public $A_RESTORE = 'Kembalikan';
public $SOFTDISK_HELP = 'SoftDisk adalah area penyimpanan virtual untuk variabel dan parameter dari berbagai jenis.<br />
  	Anda dapat menambah atau mengedit/menghapus entri SoftDisk yang sudah ada kecuali yang berlabel dimiliki sistem. 
	Juga entri yang ditandai "Tidak bisa dihapus" hanya bisa diedit. Untuk penamaan seksi SoftDisk dan nama nilainya 
	Anda hanya diijinkan untuk menggunakan <strong>huruf latin kapital, digit dan garis bawah (_)</strong>.';
public $YCNOTEDITP = 'Anda tidak bisa mengedit parameter';
public $UNDELETABLE = 'Tidak bisa dihapus';
public $SOFTENTRYEXIST = 'Sudah ada entri SoftDisk dengan nama itu!';
public $INVSECTNAME = 'Nama seksi tidak benar!';
public $INVNAME = 'Nama tidak benar!';
public $INVEMAIL = 'Nilai yang disertakan bukan alamat email yang benar!';
public $INVURL = 'Nilai yang disertakan bukan URL yang benar!';
public $INVDEC = 'Nilai yang disertakan bukan angka desimal yang benar!';
public $INVTSTAMP = 'Nilai yang disertakan bukan cap waktu UNIX yang benar!';
public $UPSYSTEM = 'Mutakhirkan sistem';
public $A_USERPROFILE = 'Profil Pengguna';
public $UPROF_WEBSITE = 'Website';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'E-mail';
public $UPROF_PHONE = 'Telepon';
public $UPROF_MOBILE = 'Cell phone';
public $UPROF_BIRTHDATE = 'Tanggal lahir';
public $UPROF_GENDER = 'Kelamin';
public $UPROF_LOCATION = 'Lokasi';
public $UPROF_OCCUPATION = 'Pekerjaan';
public $UPROF_SIGNATURE = 'Tanda tangan';
public $UPROF_ARTICLES = 'Jumlah artikel';
public $UPROF_USERGROUP = 'Grup pengguna';
public $UPROF_RANDUSERS = 'Tampilkan pengguna secara acak dalam halaman profil';
public $USERS_RPASSMAIL = 'Beritahu administrator saat pengiriman pengingat kata sandi';
public $SUBMIT_CATEGORIES = 'Kategori yang mengijinkan pengiriman konten (disarankan). Jika kosong, semua diperbolehkan. (ID Kategori, dipisahkan koma)';
public $SUBMIT_SECTIONS = 'Seksi yang mengijinkan pengiriman konten (disarankan). Jika kosong, semua diperbolehkan. (ID Seksi, dipisahkan koma)';
public $REG_AGREE = 'ID halaman tersendiri perjanjian registrasi. Nol (0) untuk mematikan. Untuk perjanjian bahasa tertentu buat entri SoftDisk di seksi PENGGUNA untuk setiap bahasa bernama REG_AGREE_LANGUAGE-HERE dengan tipe integer';
public $A_WEBLINKS = 'Weblinks';
public $TOP_WEBLINK = 'Mengontrol tampilan atau tidak, dari modul Weblinks Teratara di dalam komponen weblinks';
public $A_USERSLIST = 'Daftar Pengguna';
public $ULIST_ONLINE = 'Status Online';
public $ULIST_USERNAME = 'Nama pengguna';
public $ULIST_NAME = 'Nama';
public $ULIST_REGDATE = 'Tanggal Registrasi';
public $ULIST_PREFLANG = 'Bahasa yang diinginkan';
//2009.0
public $STATICCACHE = 'Cache statis';

}

?>