<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Zaenal Mutaqin
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Indonesian language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Silahkan Pilih Direktori';
public $A_CMP_INS_UPF = 'Upload File Paket';
public $A_CMP_INS_PF = 'File Paket';
public $A_CMP_INS_UFI = "Upload File &amp; Instalasi";
public $A_CMP_INS_FDIR = 'Instalasi Dari Direktori';
public $A_CMP_INS_IDIR = 'Direktori Instalasi';
public $A_CMP_INS_DOIN = 'Instalasi';
public $A_CMP_INS_CONT = 'Lanjutkan...';
public $A_CMP_INS_NF = 'Instalator tidak ditemukan untuk elemen ';
public $A_CMP_INS_NA = 'Instalator tidak tersedia untuk elemen';
public $A_CMP_INS_EFU = 'Instalator tidak dapat melanjutkan sebelum upload file dihidupkan. Silahkan gunakan metode instalasi dari direktori.';
public $A_CMP_INS_ERTL = 'Instalator - Salah';
public $A_CMP_INS_ERZL = 'Instalator tidak dapat melanjutkan sebelum zlib diinstalasi';
public $A_CMP_INS_ERNF = 'Tidak ada file yang dipilih';
public $A_CMP_INS_ERUM = 'Upload modul baru - salah';
public $A_CMP_INS_UPTL = 'Upload ';
public $A_CMP_INS_UPE1 = ' - Upload Gagal';
public $A_CMP_INS_UPE2 = ' -  Upload Salah';
public $A_CMP_INS_SUCC = 'Sukses';
public $A_CMP_INS_ER = 'Salah';
public $A_CMP_INS_ERFL = 'Gagal';
public $A_CMP_INS_UPNW = 'Upload ';
public $A_CMP_INS_FP = 'Upload gagal mengubah perijinan atas file yang di-upload.';
public $A_CMP_INS_FM = 'Upload gagal memindahkan file yang di-upload ke direktori <code>/media</code>.';
public $A_CMP_INS_FW = 'Upload gagal karena direktori <code>/media</code> tidak dapat ditulis.';
public $A_CMP_INS_FE = 'Upload gagal karena direktori <code>/media</code> tidak ada.';
public $A_CMP_INST_ERUNR = 'Kesalahan Tidak Dikembalikan';
public $A_CMP_INST_EREXT = 'Penguraian Salah';
public $A_CMP_INST_ERMXM = '<strong>SALAH:</strong> Tidak dapat menemukan file setup Elxis XML dalam paket';
public $A_CMP_INST_ERXML = '<strong>SALAH:</strong> Tidak dapat menemukan file setup XML dalam paket';
public $A_CMP_INST_ERNFN = 'Tidak ada nama file yang ditetapkan';
public $A_CMP_INST_ERVLD = 'bukan file instalasi Elxis yang benar';
public $A_CMP_INST_ERINC = 'Metode instalasi tidak bisa dipanggil oleh kelas';
public $A_CMP_INST_ERUIC = 'Metode deinstalasi tidak bisa dipanggil oleh kelas';
public $A_CMP_INST_ERIFN = 'File instalasi tidak ditemukan';
public $A_CMP_INST_ERSXM = 'File setup XML bukan untuk';
public $A_CMP_INST_ERCDR = 'Gagal membuat direktori';
public $A_CMP_INST_FNOTE = 'tidak ada!';
public $A_CMP_INST_TAFC = 'Sudah ada file bernama';
public $A_CMP_INST_AYIT = '- Anda mencoba menginstalasi CMT yang sama dua kali?';
public $A_CMP_INST_FCPF = 'Gagal meng-copy file';
public $A_CMP_INST_CPTO = 'ke';
public $A_CMP_INST_UNINSTALL = 'Deninstalasi';
public $A_CMP_INST_CUDIR = 'Komponen lain sudah menggunakan direktori';
public $A_CMP_INST_SQLER = 'SQL Salah';
public $A_CMP_INST_CCPHP = 'Tidak bisa meng-copy file instalasi PHP.';
public $A_CMP_INST_CCUNPHP = 'Tidak bisa meng-copy file deinstalasi PHP.';
public $A_CMP_INST_UNERR = 'Dinninstalasi -  salah';
public $A_CMP_INST_THCOM = 'Komponen';
public $A_CMP_INST_ISCOR = 'adalah komponen inti, dan tidak di-deinstalasi.<br />Anda harus tidak menerbitkannya jika tidak ingin memakainya';
public $A_CMP_INST_XMLINV = 'File XML tidak benar';
public $A_CMP_INST_OFEMP = 'Field opsi kosong, tidak bisa menghapus file';
public $A_CMP_INST_INCOM = 'Komponen Diinstalasi';
public $A_CMP_INST_CURRE = 'Saat ini Diinstalasi';
public $A_CMP_INST_MENL = 'Link Menu Komponen';
public $A_CMP_INST_AUURL = 'URL Pembuat';
public $A_CMP_INST_NCOMP = 'Tidak ada komponen kustom yang diinstalasi';
public $A_CMP_INST_INSCO = 'Instalasi Komponen Baru';
public $A_CMP_INST_DELE = 'Menghapus';
public $A_CMP_INST_LIDE = 'ID bahasa kosong, tidak bisa menghapus file';
public $A_CMP_INST_ALL = 'semua';
public $A_CMP_INST_BKLM = 'Kembali ke Manajer Bahasa';
public $A_CMP_INST_NWLA = 'Instalasi Bahasa Baru';
public $A_CMP_INST_NFMM = 'Tidak ada file yang ditandai sebagai file bot';
public $A_CMP_INST_MAMB = 'bot';
public $A_CMP_INST_AXST = 'sudah ada!';
public $A_CMP_INST_IOID = 'ID obyek tidak benar';
public $A_CMP_INST_FFEM = 'Field folder kosong, tidak bisa menghapus file';
public $A_CMP_INST_DXML = 'Menghapus File XML';
public $A_CMP_INST_ICMO = 'adalah elemen inti, dan tidak bisa di-deinstalasi.<br />Anda harus tidak menerbitkannya jika Anda tidak ingin memakainya';
public $A_CMP_INST_IMBT = 'Bot Diinstalasi';
public $A_CMP_INST_OMBT = 'Hanya Bot tersebut yang bisia di deinstalasi yang ditampilkan - beberapa Bot Inti tidak bisa dihapus.';
public $A_CMP_INST_MBT = 'Bot';
public $A_CMP_INST_MTYP = 'Tipe';
public $A_CMP_INST_NMBT = 'Tidak ada yang non-inti, but kustom diinstalasi.';
public $A_CMP_INST_INMT = 'Instalasi Bot baru';
public $A_CMP_INST_UCTP = 'Tipe klien tidak dikenal';
public $A_CMP_INST_NFMD = 'Tidak ada file yang ditandai sebagai file modul';
public $A_CMP_INST_MODULE = 'Modul';
public $A_CMP_INST_ICMDL = 'adalah modul inti, dan tidak bisa di-deinstalasi.<br />Anda harus tidak menerbitkannya jika Anda tidak ingin memakainya';
public $A_CMP_INST_IMDL = 'Modul Diinstalasi';
public $A_CMP_INST_OMDL = 'Hanya Modul tersebut yang dapat di deinstalasi yang ditampilkan - beberapa Modul Inti tidak bisa dihapus.';
public $A_CMP_INST_MDLF = 'File Modul';
public $A_CMP_INST_NMDL = 'Tidak ada modul kustom diinstalasi';
public $A_CMP_INST_NWMDL = 'Instalasi Modul baru';
public $A_CMP_INST_ALLC = 'Semua';
public $A_CMP_INST_STMDL = 'Modul Situs';
public $A_CMP_INST_ADMDL = 'Modul Admin';
public $A_CMP_INST_DDEX = 'Direktori tidak ada, tidak bisa menghapus file';
public $A_CMP_INST_TIDE = 'ID template kosong, tidak bisa menghapus file';
public $A_CMP_INST_TINS = 'Instalasi Template baru';
public $A_CMP_INST_BATP = 'Kembali ke Template';
public $A_CMP_INST_INSBR = 'Instalasi Bridge baru';
public $A_CMP_INST_BABR = 'Kembali ke Bridges';
public $A_CMP_INST_ΒIDE = 'ID Bridge kosong, tidak bisa menghapus file';
public $A_INST_INCOM = 'Kemungkinan tidak kompatibilel terdeteksi diantara versi Elxis yang Anda pakai dan ekstensi yang diinstalasi.
Selain dari itu, software mungkin bekerja baik dan tanpa kesalahan, ini hanyalah sebuah pemberitahuan.';
public $A_INST_INCOMJOO = 'Paket instalasi untuk Joomla CMS!';
public $A_INST_INCOMMAM = 'Paket instalasi untuk Mambo CMS!';
public $A_INST_OLDER = 'Paket instalasi untuk versi Elxis lama (%s) daripada yang Anda miliki (%s)';
public $A_INST_NEWER = 'Paket instalasi untuk versi Elxis lebih baru (%s) daripada yang Anda miliki (%s)';
//2009.0
public $A_INST_DOINEDC = 'Download dan instalasi dari Elxis Downloads Center';
public $A_INST_FETCHAVEXTS = 'Mengambil daftar ekstensi yang tersedia';
public $A_INST_MORE = 'Lengkap';
public $A_INST_LESS = 'Ringkas';
public $A_INST_SIZE = 'Ukuran';
public $A_INST_DOWNLOAD = 'Download';
public $A_INST_DOWNLOADS = 'Downloads';
public $A_INST_DOWNINST = 'Download dan instalasi';
public $A_INST_LICENSE = 'Licensi';
public $A_INST_COMPAT = 'Kompatibilitas';
public $A_INST_DATESUB = 'Tanggal dikirimkan';
public $A_INST_SUREINST = 'Anda yakin ingin menginstalasi %s ?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = 'Mutakhir';
public $A_INST_OUTDATED = 'Ketinggalan jaman';
public $A_INST_INSTVERS = 'Dipasang versi';
public $A_INST_UNLOAD = 'Membongkar';
public $A_INST_EDCUPDESC = 'List of the installed third party extensions and their update status.<br />
	The information is taken live from the <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	In order for the versioning check to be successuful your web site must be able to connect to the <strong>EDC</strong> remote center.';
public $A_INST_EDCUPNOR = "Version check returned nothing.<br />
	Most probably you do not have any third party %s installed.";

}

?>