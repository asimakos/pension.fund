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
* @description: Indonesian language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Situs Offline';
	public $A_COMP_CONF_OFFMESSAGE = 'Pesan Offline';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'Pesan yang ditampilkan jika situs Anda offline';
	public $A_COMP_CONF_ERR_MESSAGE = 'Pesan Kesalahan Sistem';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'Pesan yang ditampilkan jika Elxis tidak bisa menyambung ke database';
	public $A_COMP_CONF_SITE_NAME = 'Nama Situs';
	public $A_COMP_CONF_UN_LINKS = 'Tampilkan Link Tidak Diotorisasi';
	public $A_COMP_CONF_UN_TIP = 'Jika Ya, akan menampilkan link ke konten terdaftar meskipun Anda tidak masuk. Para pengguna perlu masuk untuk melihat item secara lengkap.';
	public $A_COMP_CONF_USER_REG = 'Ijinkan Registrasi Pengguna';
	public $A_COMP_CONF_TIP_USER_REG = 'Jika ya, mengijinkan para pengguna untuk mendaftarkan diri';
	public $A_COMP_CONF_REQ_EMAIL = 'Perlukan Email Unik';
	public $A_COMP_CONF_REQTIP = 'Jika ya, para pengguna tidak bisa berbagi alamat email yang sama';
	public $A_COMP_CONF_DEBUG = 'Debug Situs';
	public $A_COMP_CONF_DEBTIP = 'Jika ya, menampilkan informasi diagnostik dan kesalahan SQL jika ada';
	public $A_COMP_CONF_EDITOR = 'WYSIWYG Editor';
	public $A_COMP_CONF_LENGTH = 'Panjang Daftar';
	public $A_COMP_CONF_LENTIP = 'Setel panjang standar daftar dalam administrasi bagi seluruh pengguna';
	public $A_COMP_CONF_FAV_ICON = 'Ikon Situs Favorit';
	public $A_COMP_CONF_FAVTIP = 'Jika dibiarkan kosong atau file tidak bisa ditemukan, standar favicon.ico akan dipakai';
	public $A_COMP_CONF_CLINKACC = 'Komponen Dikaitkan dengan Sistem Akses';
	public $A_COMP_CONF_CLACCDESC = 'Pilih tipe komponen yang ingin Anda terapkan untuk Sistem Kontrol Akses di latar depan (nilai ACO = view). Baca bantuan jika Anda tidak yakin.';
	public $A_COMP_CONF_CORECOMPS = 'Komponen Inti';
	public $A_COMP_CONF_3RDCOMPS = 'Komponen Pihak Ketiga';
	public $A_COMP_CONF_ALLCOMPS = 'Semua Komponen';
	public $A_COMP_CONF_CAPTCHA = 'Gunakan Gambar Keamanan';
	public $A_COMP_CONF_CAPTCHATIP = 'Ya, jika Anda ingin gambar keamanan (Captcha) ditampilkan di dalam formulir situs web. Fitur ejaan kata juga tersedia guna membantu orang yang punya masalah pandangan.';
	public $A_COMP_CONF_LOCALE = 'Lokal';
	public $A_COMP_CONF_LANG = 'Bahasa Standar Latar-Depan';
	public $A_COMP_CONF_ALANG = 'Bahasa Standar Lata-Belakang';
	public $A_COMP_CONF_TIME_SET = 'Ofset Waktu';
	public $A_COMP_CONF_DATE = 'Tanggal/jam saat ini dikonfigurasi untuk ditampilkan';
	public $A_COMP_CONF_LOCAL = 'Lokal Negara';
	public $A_COMP_CONF_LOCRECOM = 'Kami merekomendasikan Anda untuk membiarkan Otomatis Memilih. Elxis akan mengambil lokal yang paling cocok untuk sistem O.S Anda dan memilih bahasa. Windows tidak mendukung lokal UTF-8.';
	public $A_COMP_CONF_LOCCHECK = 'Pemeriksaan Lokal';
	public $A_COMP_CONF_LOCCHECK2 = 'Jika Anda melihat tanggal ini diformat denganbaik, maka Lokal baik untuk sistem dan bahasa Anda.<br /><strong>Perhatian!</strong> Di bawah Windows Lokal disetel secara otomatis ke Inggris.';
	public $A_COMP_CONF_AUTOSEL = 'Otomatis Memilih';
	public $A_COMP_CONF_CONTROL = '* Parameter ini mengontrol elemen Output *';
	public $A_COMP_CONF_LINK_TITLES = 'Judul Di-link';
	public $A_COMP_CONF_LTITLES_TIP = 'Jika ya, judul item konten akan bertindak sebagai hiperlink ke item';
	public $A_COMP_CONF_MORE_LINK = 'Link Selengkapnya';
	public $A_COMP_CONF_MLINK_TIP = 'Jika disetel untuk ditampilkan, link selengkapnya akan muncul jika teks utama sudah disediakan untuk item';
	public $A_COMP_CONF_RATE_VOTE = 'Item Peringkat/Pemilihan';
	public $A_COMP_CONF_RVOTE_TIP = 'Jika disetel untuk ditampilkan, sistem pemilihan akan dihidupkan untuk item konten';
	public $A_COMP_CONF_AUTHOR = 'Nama Pembuat';
	public $A_COMP_CONF_AUTHORTIP = 'Jika disetel untuk ditampilkan, nama pembuat akan ditampilkan. Ini adalah setelan global tapi dapat diubah di menu dan tingkat item';
	public $A_COMP_CONF_CREATED = 'Tanggal dan Jam Dibuat';
	public $A_COMP_CONF_CREATEDTIP = 'Jika disetel untuk ditampilkan, tanggal dan jam item dibuat akan ditampilkan. Ini adalah setelan global tapi dapat diubah di menu dan tingkat item';
	public $A_COMP_CONF_MOD_DATE = 'Tanggal dan Jam Diubah';
	public $A_COMP_CONF_MDATETIP = 'Jika disetel untuk ditampilkan, tanggal dan jam item terakhir diubah akan ditampilkan. Ini adalah setelan global tapi dapat diubah di menu dan tingkat item';
	public $A_COMP_CONF_HITS = 'Kunjungan';
	public $A_COMP_CONF_HITSTIP = 'Jika disetel untuk ditampilkan, kunjungan untuk item tertentu akan ditampilkan. Ini adalah setelan global tapi dapat diubah di menu dan tingkat item';
	public $A_COMP_CONF_PDF = 'Ikon PDF';
	public $A_COMP_CONF_OPT_MEDIA = 'Opsi tidak tersedia karena direktori /tmpr tidak bisa ditulis';
	public $A_COMP_CONF_PRINT_ICON = 'Ikon Cetak';
	public $A_COMP_CONF_EMAIL_ICON = 'Ikon Email';
	public $A_COMP_CONF_ICONS = 'Ikon';
	public $A_COMP_CONF_USE_OR_TEXT = 'Cetak, RTF, PDF & Email akan menggunakan Ikon atau Teks';
	public $A_COMP_CONF_TBL_CONTENTS = 'Daftar Isi pada item multi-halaman';
	public $A_COMP_CONF_BACK_BUTTON = 'Tombol Kembali';
	public $A_COMP_CONF_CONTENT_NAV = 'Navigasi Item Konten';
	public $A_COMP_CONF_HYPER = 'Gunakan Judul Berhiperlink';
	public $A_COMP_CONF_DBTYPE = 'Jenis Database';
	public $A_COMP_CONF_DBWARN = 'Jangan diubah kecuali sistem Anda mendukung database ini dan duplikat data Elxis diinstalasi pada Database ini!';
	public $A_COMP_CONF_HOSTNAME = 'Nama host';
	public $A_COMP_CONF_DB_PW = 'Kata sandi';
	public $A_COMP_CONF_DB_NAME = 'Database';
	public $A_COMP_CONF_DB_PREFIX = 'Prefiks Database';
	public $A_COMP_CONF_NOT_CH = '!! JANGAN MENGUBAH KECUALI ANDA MEMILIKI DATABASE YANG DIBANGUN MENGGUNAKAN TABEL DENGAN PREFIKS YANG ANDA SETEL !!';
	public $A_COMP_CONF_ABS_PATH = 'Path Absolut';
	public $A_COMP_CONF_LIVE = 'Situs Langsung';
	public $A_COMP_CONF_SECRET = 'Kata Rahasia';
	public $A_COMP_CONF_GZIP = 'Kompresi GZIP Halaman';
	public $A_COMP_CONF_CP_BUFFER = 'Kompres output dibufer jika didukung';
	public $A_COMP_CONF_SESSION_TIME = 'Lama Sesi Masuk';
	public $A_COMP_CONF_SEC = 'detik';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Otomatis keluar setelah tidak aktif selama periode waktu ini';
	public $A_COMP_CONF_ERR_REPORT = 'Pelaporan Kesalahan';
	public $A_COMP_CONF_HELP_SERVER = 'Server Bantuan';
	public $A_COMP_CONF_META_PAGE = 'halaman-metadata';
	public $A_COMP_CONF_META_DESC = 'Deskripsi Meta Situs Global';
	public $A_COMP_CONF_META_KEY = 'Keyword Meta Situs Global';
	public $A_COMP_CONF_HPS1 = 'File Bantuan Lokal';
	public $A_COMP_CONF_HPS2 = 'Server Bantuan Remote Elxis';
	public $A_COMP_CONF_HPS3 = 'Server Bantuan Elxis Resmi';
	public $A_COMP_CONF_PERMFLES = 'Pilih opsi ini untuk mendefinisikan tanda perijinan untuk file baru';
	public $A_COMP_CONF_PERMDIRS = 'Pilih opsi ini untuk mendefinisikan tanda perijinan untuk direktori baru';
	public $A_COMP_CONF_NCHMODDIRS = 'Jangan CHMOD direktori baru (gunakan standar server)';
	public $A_COMP_CONF_CHAPFLAGS = 'Centang di sini, akan menerapkan tanda perijinan ke <em>seluruh file yang sudah ada</em> pada situs.<br/><strong>PENGGUNAAN TIDAK BENAR DARI OPSI INI DAPAT MENYEBABKAN SITUS TIDAK BEROPERASI!</strong>';
	public $A_COMP_CONF_CHAPDLAGS = 'Centang di sini, akan menerapkan tanda perijinan untuk <em>seluruh direktori yang sudah ada</em> pada situs.<br/><strong>PENGGUNAAN TIDAK BENAR DARI OPSI INI DAPAT MENYEBABKAN SITUS TIDAK BEROPERASI!</strong>';
	public $A_COMP_CONF_APPEXDIRS = 'Terapkan ke Direktori yang Sudah Ada';
	public $A_COMP_CONF_APPEXFILES = 'Terapkan ke File yang Sudah Ada';
	public $A_COMP_CONF_WORLD = 'Dunia';
	public $A_COMP_CONF_CHMODNDIRS = 'CHMOD direktori baru';
	public $A_COMP_CONF_MAIL = 'Mailer';
	public $A_COMP_CONF_MAIL_FROM = 'Surat Dari';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'Nama Dari';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP Auth';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'SMTP User';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTP Pass';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP Host';
	public $A_COMP_CONF_CACHE = 'Caching';
	public $A_COMP_CONF_CACHE_FOLDER = 'Folder Cache';
	public $A_COMP_CONF_CACHE_DIR = 'Direktori cache saat ini adalah';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'Direktori cache TIDAK BISA DITULSI - silahkan setel direktori ke CHMOD 777 sebelum menghidupkan cache';
	public $A_COMP_CONF_CACHE_TIME = 'Waktu Cache';
	public $A_COMP_CONF_STATS = 'Statistik';
	public $A_COMP_CONF_STATS_ENABLE = 'Hidupkan/matikan koleksi statistik situs';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Log Kunjungan Konten dengan Tanggal';
	public $A_COMP_CONF_STATS_WARN_DATA = 'PERINGATAN : Jumlah besar data akan dikumpulkan';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Log String Pencarian';
	public $A_COMP_CONF_SEO_LBL = 'SEO';
	public $A_COMP_CONF_SEO = 'Search Engine Optimization';
	public $A_COMP_CONF_SEO_SEFU = 'Search Engine Friendly URLs';
	public $A_COMP_CONF_SEOBASIC = 'SEO Dasar';
	public $A_COMP_CONF_SEOPRO = 'SEO Pro';
	public $A_COMP_CONF_SEOHELP = "Apache dan IIS. Apache: ganti nama htaccess.txt ke .htaccess sebelum mengaktifkan (mod_rewrite enabled). IIS: gunakan  filter Ionic Isapi Rewriter. Untuk performansi maksimum konten Anda sebelum beralih ke SEO PRO. Pilih SEO Dasar jika Anda ingin menggunakan komponen SEF pihak ketiga.";
	public $A_COMP_CONF_SERVER = 'Server';
	public $A_COMP_CONF_METADATA = 'Metadata';
	public $A_COMP_CONF_CACHE_TAB = 'Cache';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'Setelan FTP';
	public $A_COMP_CONF_FTP_ENB = 'Hidupkan FTP';
	public $A_COMP_CONF_FTP_HST = 'FTP Host';
	public $A_COMP_CONF_FTP_HSTTP = 'Paling mungkin';
	public $A_COMP_CONF_FTP_USR = 'Nama pengguna FTP';
	public $A_COMP_CONF_FTP_USRTP = 'Paling mungkin';
	public $A_COMP_CONF_FTP_PAS = 'Kata sandi FTP';
	public $A_COMP_CONF_FTP_PRT = 'FTP Port';
	public $A_COMP_CONF_FTP_PRTTP = 'Nilai standarnya adalah: 21';
	public $A_COMP_CONF_FTP_PTH = 'Path Root FTP';
	public $A_COMP_CONF_FTP_PTHTP = 'Path dari root FTP ke instalasi Elxis Anda. contoh /public_html/elxis';
	public $A_COMP_CONF_HIDE = 'Sembunyikan';
	public $A_COMP_CONF_SHOW = 'Tampilkan';
	public $A_COMP_CONF_DEFAULT = 'Standar Sistem';
	public $A_COMP_CONF_NONE = 'Tidak ada';
	public $A_COMP_CONF_SIMPLE = 'Sederhana';
	public $A_COMP_CONF_MAX = 'Maksimum';
	public $A_COMP_CONF_MAIL_FC = 'fungsi mail PHP';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Path Sendmail';
	public $A_COMP_CONF_SMTP = 'Server SMTP';
	public $A_COMP_CONF_UPDATED = 'Rincian konfigurasi sudah <strong>dimutakhirkan!</strong>';
	public $A_COMP_CONF_ERR_OCC = '<strong>Kesalahan Telah Terjadi!</strong> Tidak bisa membuka file config untuk ditulis!';
	public $A_COMP_CONF_READ = 'baca';
	public $A_COMP_CONF_WRITE = 'tulis';
	public $A_COMP_CONF_EXEC = 'jalankan';
	public $A_COMP_CONF_FCRE = 'Pembuatan File';
	public $A_COMP_CONF_FPERM = 'Perijinan File';
	public $A_COMP_CONF_DCRE = 'Pembuatan Direktori';
	public $A_COMP_CONF_DPERM = 'Perijinan Direktori';
	public $A_COMP_CONF_OFFEX = 'Ya (kecuali untuk Super Administrator)';
	public $A_COMP_CONF_RTF = 'Ikon RTF';

	//elxis 2008.1
	public $A_C_CONF_AC_ACT = 'Aktivasi Akun';
	public $A_C_CONF_NOACT = 'Tidak ada aktivasi';
	public $A_C_CONF_EMACT = 'Activasi via e-mail';
	public $A_C_CONF_MANACT = 'Aktivasi manual';
	public $A_C_CONF_AC_ACTD = 'Pilih b agaimana Anda ingin pengguna baru diaktivasi. Secara langsung, via link aktivasi dalam email atau secara manual oleh administrator situs.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Komentar';
	public $A_C_CONF_COMMENTSTIP = 'Jika disetel u8ntuk ditampilkan, jumlah komentar untuk item konten sebenarnya yang akan ditampilkan. Ini adalah setelan global tetapi masih bisa diubah di menu dan tingkat item';
	public $A_C_CONF_CHKFTP = 'Periksa setelan FTP';
	public $A_C_CONF_STDCACHE = 'Cache standar';
	public $A_C_CONF_STATCACHE = 'Cache statis';
	public $A_C_CONF_CACHED = 'Cache Standar akan men-cache sebagian blok halaman sementara Cache Statis akan men-chace seluruh halaman. Cache Statis direkomendasikan bagi situs yang memiliki beban berat. Untuk menggunakan cache statis, Anda harus menghidupkan SEO PRO.';
	public $A_C_CONF_SEODIS = 'SEO PRO dimatikan!';

	public function __construct() {	
	}

}

?>