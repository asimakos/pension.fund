<?php
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Zaenal Mutaqin
* @link: http://www.bobotoh.com
* @email: ade999@gmail.com
* @description: Indonesian user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_indonesian {

	public $_ON_NEW_CONTENT = "Item konten baru sudah dikirimkan oleh [ %s ] berjudul [ %s ] untuk seksi [ %s ] dan kategori [ %s ]";
	public $_E_COMMENTS = 'Komentar';
	public $_DATE = 'Tanggal';
	public $_E_SUBCONWAIT = 'Artikel yang dikirimkan menunggu persetujuan:';
	public $_E_CONTENTSUB = 'Pengiriman konten';
	public $_MAIL_SUB = 'Dikirimkan Pengguna';
	public $_E_HI = 'Hai';
	public $_E_NEWSUBBY = "Pengiriman baru sudah dilakukan oleh pengguna %s";
	public $_E_TYPESUB = 'Jenis pengiriman:';
	public $_E_TITLE = 'Judul';
	public $_E_LOGINAPPR = 'Masuk ke administrasi situs Anda untuk melihat dan menyetujui pengiriman ini.';
	public $_E_DONTRESPOND = 'Harap tidak merespon pesan ini karena secara otomatis dibuat dan hanya untuk keperluan informasi saja.';
	public $_E_NEWPASS_SUB = "Sandi baru untuk %s";
	public $_E_RPASS_NADMIN = "Pengguna %s mengirimkan formulir pengingat kata sandi. Kata sandi baru sudah dibuat dan dikirimkan kepadanya.
	Jika Anda tidak ingin diberitahu lagi untuk tindakan seperti ini, ubah parameter USERS_RPASSMAIL pada SoftDisk menjadi Tidak.";
	public $_E_SEND_SUB = "Rincian akun untuk %s di %s";
	public $_ASEND_MSG = "Halo %s,
Seorang pengguna baru sudah mendaftar di %s.
Email ini berisi rinciannya:

Nama - %s
e-mail - %s
Nama pengguna - %s

Harap tidak merespon pesan ini karena secara otomatis dibuat dan hanya untuk keperluan informasi saja.";
	public $_NEW_MESSAGE = 'Pesan baru sudah masuk';
	public $_NEW_PRMSGF = "Sebuah pesan baru sudah masuk dari %s";
	public $_LOG_READMSG = 'Silahkan masuk ke konsol administrasi untuk membaca pesan.';
	public $_SUBCON_APPRNTF = 'Pemberitahuan persetujuan konten yang dikirimkan';
	public $_SUBCON_ATAPPR = 'Konten yang Anda kirimkan di %s sudah disetujui.';
	public $_SECTION = 'Seksi';
	public $_CATEGORY = 'Kategori';

	//elxis 2008.1
	public $_MANAPPROVE = 'Agar pengguna bisa masuk Anda harus menyetujui registrasinya secara manual!';
	public $_ACCUNBLOCK = "Akun Anda di %s sudah diaktifkan oleh administrator situs. Sekarang ada bisa masuk sebagai %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Pemberithuan komentar baru';
	public $_E_NEWCOMBYTITLE = "Komentar baru sudah dituliskan oleh %s pada artikel Anda yang berjudul %s";
	public $_E_COMSTAYUNPUB = 'Komentar ini akan tetap tidak diterbitkan sampai Anda atau super administrator menerbitkannya.';
	public $_E_ACCEXPDATE = 'Tanggal masa berakhir akun';

	public function __construct() {
	}

}

?>