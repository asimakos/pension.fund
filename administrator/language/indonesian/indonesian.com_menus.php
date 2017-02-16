<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Zaenal Mutaqin
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Indonesian language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER = 'Manajer Menu';
public $A_CMP_MU_MXLVLS = 'Tingkat Maks';
public $A_CMP_MU_CANTDEL ='* Anda tidak bisa \'menghapus\' menu ini karena ia diperlukan agar operasi Elxis berjalan dengan baik *';
public $A_CMP_MU_MANHOME = '* Item pertama yang Diterbitkan dalam menu ini [mainmenu] adalah standar \'Halaman depan\' untuk situs *';
public $A_CMP_MU_MITEM = 'Item Menu';
public $A_CMP_MU_NSMTG = '* Catatan bahwa beberapa tipe menu muncul di lebih dari satu grup, tapi mereka masih tipe menu yang sama.';
public $A_CMP_MU_MITYP = 'Tipe Item Menu';
public $A_CMP_MU_WBLV = 'Seperti apa tampilan \'Blog\'';
public $A_CMP_MU_WTLV = 'Seperti apa tampilan \'Tabel\'';
public $A_CMP_MU_WLIV = 'Seperti apa tampilan \'Daftar\'';
public $A_CMP_MU_SMTAP = '* Beberapa \'Tipe Menu\' muncul di lebih dari satu grup *';
public $A_CMP_MU_MOVEITS = 'Pindahkan Item Menu';
public $A_CMP_MU_MOVEMEN = 'Pindahkan ke Menu';
public $A_CMP_MU_BEINMOV = 'Item Menu sedang dipindahkan';
public $A_CMP_MU_COPYITS = 'Copy Item Menu';
public $A_CMP_MU_COPYMEN = 'Copy ke Menu';
public $A_CMP_MU_BCOPIED = 'Item Menu sedang di-copy';
public $A_CMP_MU_EDNEWSF = 'Edit Newsfeed ini';
public $A_CMP_MU_EDCONTA = 'Edit Kontak ini';
public $A_CMP_MU_EDCONTE = 'Edit Konten ini';
public $A_CMP_MU_EDSTCONTE = 'Edit Halaman Tersendiri ini';
public $A_CMP_MU_MSGITSAV = 'Item Menu Disimpan';
public $A_CMP_MU_MOVEDTO = ' Item Menu dipindahkan ke ';
public $A_CMP_MU_COPITO = ' Item Menu di-copy ke ';
public $A_CMP_MU_THMOD = 'Modul';
public $A_CMP_MU_SCITLKT = 'Anda harus memilih Komponen untuk membuat link';
public $A_CMP_MU_COMPLLTO = 'Komponen untuk di-Link';
public $A_CMP_MU_ITEMNAME = 'Item harus mempunyai nama';
public $A_CMP_MU_PLSELCMP = 'Silahkan pilih Komponen';
public $A_CMP_MU_PARAVAI = 'Daftar parameter akan tersedia setelah Anda menyimpan item menu Baru ini';
public $A_CMP_MU_YSELCAT = 'Anda harus memilih kategori';
public $A_CMP_MU_TMHTITL = 'Item Menu ini harus mempunyai judul';
public $A_CMP_MU_TABLE = 'Tabel';
public $A_CMP_MU_CCTBLANK = 'Jika Anda membiarkan ini kosong, Nama Kategori akan secara otomatis dipakai';
public $A_CMP_MU_LNKHNAME = 'Link harus mempunyai nama';
public $A_CMP_MU_SELCONT = 'Anda harus memilih Kontak untuk di-link';
public $A_CMP_MU_CONLINK = 'Kontak untuk di-Link:';
public $A_CMP_MU_ONCLOPI = 'Saat Klik, Buka dalam';
public $A_CMP_MU_THETITL = 'Judul:';
public $A_CMP_MU_YMSSECT = 'Anda harus memilih Seksi';
public $A_CMP_MU_ILBLSEC = 'Jika Anda membiarkan ini kosong, nama Seksi akan secara otomatis dipakai';
public $A_CMP_MU_YCSMC = 'Anda dapat memilih multipel Kategori';
public $A_CMP_MU_YCSMS = 'Anda dapat memilih multipel Seksi';
public $A_CMP_MU_EDCOI = 'Edit Item Konten';
public $A_CMP_MU_YMSLT = 'Anda harus memilih Konten untuk di-link';
public $A_CMP_MU_STACONT = 'Konten Halaman Tersendiri';
public $A_CMP_MU_ONCLOP = 'Saat Klik, buka';
public $A_CMP_MU_YSNWLT = 'Anda harus memilih Newsfeed untuk di-link';
public $A_CMP_MU_NEWTL = 'Newsfeed untuk di-Link';
public $A_CMP_MU_SEPER = '- - - - - - -'; //Change this, if you want to change the symbols for seperator line
public $A_CMP_MU_PATNAM = 'Pola/Nama';
public $A_CMP_MU_WRURL = 'Anda harus menyediaka url.';
public $A_CMP_MU_WRLINK = 'Link Pelapis';
public $A_CMP_MU_MIBGCC = 'Blog - Kategori Konten';
public $A_CMP_MU_MITCG = 'Tabel - Kategori Kontak'; 
public $A_CMP_MU_MICOMP = 'Komponen';
public $A_CMP_MU_MIBGCS = 'Blog - Seksi Konten';
public $A_CMP_MU_MILCMPI = 'Link - Item Komponen';
public $A_CMP_MU_MILCI = 'Link - Item Kontak';
public $A_CMP_MU_MITBCC = 'Tabel - Kategori Konten';
public $A_CMP_MU_MILCEI = 'Link - Item Konten';
public $A_CMP_MU_COTLINK = 'Konten untuk di-Link';
public $A_CMP_MU_MITBCS = 'Tabel - Seksi Konten';
public $A_CMP_MU_MILSTC = 'Link - Halaman Tersendiri';
public $A_CMP_MU_MITBNFC = 'Tabel - Kategori Newsfeed';
public $A_CMP_MU_MILNEW = 'Link - Newsfeed';
public $A_CMP_MU_MISEP = 'Pemisah / Placeholder';
public $A_CMP_MU_MILIURL = 'Link - URL';
public $A_CMP_MU_MITBWC = 'Table - Kategori Weblink';
public $A_CMP_MU_MIWRAP = 'Pelapis';
public $A_CMP_MU_ITEM = 'Item';
public $A_CMP_MU_UMSBRI = 'Anda harus memilih Bridge';
public $A_CMP_MU_BRINOINS = 'Komponen Bridge tidak diinstalasi!';
public $A_CMP_MU_NOPUBBRI = 'Tidak ada Bridge yang publikasikan!';
public $A_CMP_MU_CLVSEO = 'Klik pada halaman tersendiri untuk melihat judul SEO-nya';
public $A_CMP_MU_SYSLINK = 'Link sistem';
public $A_CMP_MU_SYSLINKD = 'Link Sistem biasanya milik menu yang dipublikasikan dalam posisi modul yang TIDAK ada dalam template!';
public $A_CMP_MU_PASSR = 'Pengingat sandi';
public $A_CMP_MU_UREG = 'Registrasi pengguna';
public $A_CMP_MU_REGCOMP = 'Registrasi lengkap';
public $A_CMP_MU_ACCACT = 'Aktivasi akun';
public $A_CMP_MU_MSLINK = 'Anda harus memilih link sistem.';
public $A_CMP_MU_SELLINK = '- Pilih link -';
public $A_CMP_MU_DONTDEL ='* Jangan hapus menu ini karena ini membuat operasi Elxis lebih baik. Pastikan untuk diterbitkan dalam posisi modul yang TIDAK ada dalam template! *';
public $A_CMP_MU_EDPROF = 'Edit profil';
public $A_CMP_MU_SUBWEBL = 'Kirit weblink';
public $A_CMP_MU_CHECKIN = 'Periksa';
public $A_CMP_MU_USERLIST = 'Daftar pengguna';
public $A_CMP_MU_POLLS = 'Polling';
//elxis 2008.1
public $A_CMP_MU_SELBLOG = 'You must select a blog to link to';
public $A_CMP_MU_BLOGLINK = 'Blog to Link';

}

?>