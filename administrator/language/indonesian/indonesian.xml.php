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
* @description: Indonesian Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008/2009: values for custom language strings defined as php contants start with 'CX_' (not in this file!)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
* 
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class xmlLanguage extends standardLanguage {

public function get($a) {
	if ( is_numeric($a) ) { return $a; }
	$pref = strtoupper(substr($a,0,3));
    if ($pref == 'AX_') {
        return $this->$a;
    } elseif (($pref == 'CX_') && defined($a)) {
        return constant($a);
	} else { return $a; }
}

protected $AX_MENUIMGL = 'Gambar Menu';
protected $AX_MENUIMGD = 'Gambar kecil yang ditempatkan di kiri atau kanan item menu Anda. Gambar harus di dalam direktori images/stories/ .';
protected $AX_MENUIMGONLYL = 'Hanya menggunakan Gambar Menu';
protected $AX_MENUIMGONLYD = 'Jika Anda memilih <strong>Ya</strong> maka item menu akan disajikan HANYA dengan gambar yang sudah Anda pilih.<br /><br />Jika Anda memilih <strong>Tidak</strong> maka item menu akan disajikan dengan gambar yang Anda pilih PLUS teks.';
protected $AX_MENUIMG2D = 'Gambar kecil yang ditempatkan di kiri atau kanan item menu Anda. Gambar harus di dalam direktori /images .';
protected $AX_PAGCLASUFL = 'Sufiks Kelas Halaman';
protected $AX_PAGCLASUFD = 'Sufiks akan diterapkan ke kelas css untuk halaman, ini mengijinkan gaya halaman individual.';
protected $AX_TEXTPAGECL = 'Sufiks Artikel';
protected $AX_TEXTPAGECLD = 'Suffiks untuk diterapkan ke kelas css untuk artikel, ini mengijinkan gaya Item Artikel/Konten.';
protected $AX_BACKBUTL = 'Tombol Kembali';
protected $AX_BACKBUTD = 'Tampilkan/Sembunyikan Tombol Kembali, yang membawa Anda ke tampilan halaman sebelumnya.';
protected $AX_USEGLB = 'Gunakan Global';
protected $AX_HIDE = 'Sembunyikan';
protected $AX_SHOW = 'Tampilkan';
protected $AX_AUTO = 'Otomatis';
protected $AX_PAGTITLSL = 'Tampilkan Judul Halaman';
protected $AX_PAGTITLSD = 'Tampilkan/Sembunyikan Judul Halaman.';
protected $AX_PAGTITLL = 'Judul Halaman';
protected $AX_PAGTITLD = 'Teks untuk ditampilkan di atas halaman. Jika dibiarkan kosong, nama Menu yang akan dipakai.';
protected $AX_PAGTITL2D = 'Teks untuk ditampilkan di atas halaman.';
protected $AX_LEFT = 'Kiri';
protected $AX_RIGHT = 'Kanan';
protected $AX_PRNTICOL = 'Ikon Cetak';
protected $AX_PRNTICOD = 'Tampilkan/Sembunyikan item tombol cetak - hanya mempengaruhi halaman ini.';
protected $AX_YES = 'Ya';
protected $AX_NO = 'Tidak';
protected $AX_SECNML = 'Nama Seksi';
protected $AX_SECNMD = 'Tampilkan/Sembunyikan Seksi pemilik item.';
protected $AX_SECNMLL = 'Nama Seksi Linkable';
protected $AX_SECNMLD = 'Jadikan teks Seksi sebuah link ke halaman Seksi aktual.';
protected $AX_CATNML = 'Nama Kategori';
protected $AX_CATNMD = 'Tampilkan/Sembunyikan Kategori pemilik item.';
protected $AX_CATNMLL = 'Nama Kategori Linkable';
protected $AX_CATNMLD = 'Jadikan teks Kategori sebuah link ke halaman Kategori aktual.';
protected $AX_LNKTTLL = 'Judul Linked';
protected $AX_LNKTTLD = 'Jadikan Item judul anda bisa di-klik.';
protected $AX_ITMRATL = 'Peringkat Item';
protected $AX_ITMRATD = 'Tampilkan/Sembunyikan item peringkat - hanya mempengaruhi halaman ini.';
protected $AX_AUTNML = 'Nama Pembuat';
protected $AX_AUTNMD = 'Tampilkan/Sembunyikan item pembuat - hanya mempengaruhi halaman ini.';
protected $AX_CTDL = 'Tanggal dan Jam Dibuat';
protected $AX_CTDD = 'Tampilkan/Sembunyikan item tanggal pembuatan - hanya mempengaruhi halaman ini.';
protected $AX_MTDL = 'Tanggal dan Jam Diubah';
protected $AX_MTDD = 'Tampilkan/Sembunyikan item tanggal perubahan - hanya mempengaruhi halaman ini.';
protected $AX_PDFICL = 'Ikon PDF';
protected $AX_PDFICD = 'Tampilkan/Sembunyikan item tombol PDF - hanya mempengaruhi halaman ini.';
protected $AX_PRICL = 'Ikon Cetak';
protected $AX_PRICD = 'Tampilkan/Sembunyikan item tombol cetak - hanya mempengaruhi halaman ini.';
protected $AX_EMICL = 'Ikon Email';
protected $AX_EMICD = 'Tampilkan/Sembunyikan item tombol email - hanya mempengaruhi halaman ini.';
protected $AX_FTITLE = 'Judul';
protected $AX_FAUTH = 'Pembuat';
protected $AX_FHITS = 'Kunjungan';
protected $AX_DESCRL = 'Deskripsi';
protected $AX_DESCRD = 'Tampilkan/Sembunyikan Deskripsi di bawah.';
protected $AX_DESCRTXL = 'Teks Deskripsi';
protected $AX_DESCRTXD = 'Deskripsi untuk halaman, jika dibiarkan kosong ia akan mengambil _WEBLINKS_DESC dari file bahasa Anda';
protected $AX_IMAGEL = 'Gambar';
protected $AX_IMGFRPD = 'Gambar untuk halaman, harus ditempatkan di dalam direktori /images/stories . Standarnya akan mengambil web_links.jpg. -Jangan guanak gambar- berarti bahwa gambar tidak diambil.';
protected $AX_IMGALL = 'Jajar Gambar';
protected $AX_IMGALD = 'Penjajaran gambar.';
protected $AX_TBHEADL = 'Kepala Tabel';
protected $AX_TBHEADD = 'Tampilkan/Sembunyikan Kepala Tabel.';
protected $AX_POSCOLL = 'Kolom Posisi';
protected $AX_POSCOLD = 'Tampilkan/Sembunyikan kolom Posisi.';
protected $AX_EMAILCOLL = 'Kolom Email';
protected $AX_EMAILCOLD = 'Tampilkan/Sembunyikan kolom Email.';
protected $AX_TELCOLL = 'Kolom Telepon';
protected $AX_TELCOLD = 'Tampilkan/Sembunyikan kolom Telepon.';
protected $AX_FAXCOLL = 'Kolom Fax';
protected $AX_FAXCOLD = 'Tampilkan/Sembunyikan kolom Fax.';
protected $AX_LEADINGL = '# Lebar';
protected $AX_LEADINGD = 'Jumlah Item yang ditampilkan sebagai item lebar (panjang penuh). 0 berarti tidak ada item akan ditampilkan secara lebar.';
protected $AX_INTROL = '# Intro';
protected $AX_INTROD = 'Jumlah Item yang ditampilkan dengan teks pendahuluan.';
protected $AX_COLSL = 'Kolom';
protected $AX_COLSD = 'Pilih berapa banyak kolom untuk dipakai per baris saat menampilkan teks pendahuluan.';
protected $AX_LNKSL = '# Link';
protected $AX_LNKSD = 'Jumlah Item untuk ditampilkan sebagai sebuah Link.';
protected $AX_CATORL = 'Urutan Kategori';
protected $AX_CATORD = 'Item urutan dengan kategori.';
protected $AX_OCAT01 = 'Tidak, urut hanya dengan Urutan Primer';
protected $AX_OCAT02 = 'Judul Secara Alfabetif';
protected $AX_OCAT03 = 'Judul Alfabetis-Terbalik';
protected $AX_OCAT04 = 'Urutan';
protected $AX_PRMORL = 'Urutan Primer';
protected $AX_PRMORD = 'Urutan yang item-itemnya akan ditampilkan didalamnya.';
protected $AX_OPRM01 = 'Standar';
protected $AX_OPRM02 = 'Urutan Halaman depan';
protected $AX_OPRM03 = 'Terlama lebih dulu';
protected $AX_OPRM04 = 'Terbaru lebih dulu';
protected $AX_OPRM07 = 'Pembuat Alfabetis';
protected $AX_OPRM08 = 'Pembuat Alfabetis-Terbalik';
protected $AX_OPRM09 = 'Kunjungan Terbanyak';
protected $AX_OPRM10 = 'Kunjungan Terkecil';
protected $AX_PAGL = 'Paginasi';
protected $AX_PAGD = 'Tampilkan/Sembunyikan dukungan Paginasi.';
protected $AX_PAGRL = 'Hasil Paginasi';
protected $AX_PAGRD = 'Tampilkan/Sembunyikan info Hasil Paginasi ( e.g 1-4 of 4 ).';
protected $AX_MOSIL = 'MOSImages';
protected $AX_MOSID = 'Tampilkan {mosimages}.';
protected $AX_ITMTL = 'Judul Item';
protected $AX_ITMTD = 'Tampilkan/Sembunyikan judul item.';
protected $AX_REMRL = 'Selengkapnya';
protected $AX_REMRD = 'Tampilkan/Sembunyikan link Selengkapnya.';
protected $AX_OTHCATL = 'Kategori Lainnya';
protected $AX_OTHCATD = 'Ketika melihat sebuah Kategori, Tampilkan/Sembunyikan daftar Kategori lainnya.';
protected $AX_TDISTPD = 'Teks untuk ditampilkan di atas halaman.';
protected $AX_ORDBYL = 'Urut dengan';
protected $AX_ORDBYD = 'Ini menimpa urutan item.';
protected $AX_MCS_DESCL = 'Deskripsi';
protected $AX_SHCDESD = 'Tampilkan/Sembunyikan Deskripsi Kategori.';
protected $AX_DESCIL = 'Gambar Deskripsi';
protected $AX_MUDATFL = 'Format Tanggal';
protected $AX_MUDATFD = "Format tanggal yang ditampilkan, menggunakan Perintah Format PHP strftime - jika dibiarkan kosong ia akan mengambil format dari file bahasa Anda.";
protected $AX_MUDATCL = 'Kolom Tanggal';
protected $AX_MUDATCD = 'Tampilkan atau Sembunyikan kolom Tanggal.';
protected $AX_MUAUTCL = 'Kolom Pembuat';
protected $AX_MUAUTCD = 'Tampilkan/Sembunyikan kolom Pembuat.';
protected $AX_MUHITCL = 'Kolom Kunjungan';
protected $AX_MUHITCD = 'Tampilkan/Sembunyikan kolom Kunjungan.';
protected $AX_MUNAVBL = 'Bar Navigasi';
protected $AX_MUNAVBD = 'Tampilkan/Sembunyikan Bar Navigasi.';
protected $AX_MUORDSL = 'Urutan Memilih';
protected $AX_MUORDSD = 'Tampilkan/Sembunyikan Urutan Memilih dropdown.';
protected $AX_MUDSPSL = 'Tampilkan Pilih';
protected $AX_MUDSPSD = 'Tampilkan/Sembunyikan Tampilkan Pilih dropdown.';
protected $AX_MUDSPNL = 'Tampilkan Angka';
protected $AX_MUDSPND = 'Jumlah item untuk ditampilkan secara standar.';
protected $AX_MUFLTL = 'Filter';
protected $AX_MUFLTD = 'Tampilkan/Sembunyikan kemampuan Filter.';
protected $AX_MUFLTFL = 'Field Filter';
protected $AX_MUFLTFD = 'Field yang mana seharusnya menerapkan filter.';
protected $AX_MUOCATL = 'Kategori Lainnya';
protected $AX_MUOCATD = 'Tampilkan/Sembunyikan daftar Kategori lainnya.';
protected $AX_MUECATL = 'Kategori Kosong';
protected $AX_MUECATD = 'Tampilkan/Sembunyikan kategori kosong (tidak ada item).';
protected $AX_CATDSCL = 'Deskripsi Kategori';
protected $AX_CATDSBLND = 'Tampilkan/Sembunyikan Deskripsi Kategori, ia akan tampil di bawah Nama Kategori.';
protected $AX_NAMCOLL = 'Kolom Nama';
protected $AX_LINKDSCL = 'Deskripsi Link';
protected $AX_LINKDSCD = 'Tampilkan/Sembunyikan teks Deskripsi dari Link.';
//com_contact/contact.xml
protected $AX_CCT_CDESC = 'Komponen ini menampilkan daftar Informasi Kontak.';
protected $AX_CCT_CATLISTSL = 'Daftar Kategori - Seksi';
protected $AX_CCT_CATLISTSD = 'Tampilkan/Sembunyikan Daftar Kategori dalam halaman tampilan Daftar.';
protected $AX_CCT_CATLISTCL = 'Daftar Kategori - Kategori';
protected $AX_CCT_CATLISTCD = 'Tampilkan/Sembunyikan Daftar Kaegori dalam halaman tampilan Tabel.';
protected $AX_CCT_CATDSCD = 'Tampilkan/Sembunyikan Deskripsi untuk daftar kategori lainnya';
protected $AX_CCT_NOCATITL = '# Item Kategori';
protected $AX_CCT_NOCATITD = 'Tampilkan/Sembunyikan jumlah item dalam setiap kategori.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = 'Parameter untuk Item Kontak individual.';
protected $AX_CIT_NAMEL = 'Nama';
protected $AX_CIT_NAMED = 'Tampilkan/Sembunyikan info nama.';
protected $AX_CIT_POSITL = 'Posisi';
protected $AX_CIT_POSITD = 'Tampilkan/Sembunyikan info posisi.';
protected $AX_CIT_EMAILL = 'Email';
protected $AX_CIT_EMAILD = 'Tampilkan/Sembunyikan info email. Jika Anda menyetel untuk ditampilkan, alamat akan dilindungi dari spambots dengan javascript cloaking.';
protected $AX_CIT_SADDREL = 'Alamat Jalan';
protected $AX_CIT_SADDRED = 'Tampilkan/Sembunyikan info alamat jalan.';
protected $AX_CIT_TOWNL = 'Kota/Daerah';
protected $AX_CIT_TOWND = 'Tampilkan/Sembunyikan info kota/daerah.';
protected $AX_CIT_STATEL = 'Provinsi';
protected $AX_CIT_STATED = 'Tampilkan/Sembunyikan info provinsi.';
protected $AX_CIT_COUNTRL = 'Negara';
protected $AX_CIT_COUNTRD = 'Tampilkan/Sembunyikan info negara.';
protected $AX_CIT_ZIPL = 'Kode Pos';
protected $AX_CIT_ZIPD = 'Tampilkan/Sembunyikan info kode pos.';
protected $AX_CIT_TELL = 'Telepon';
protected $AX_CIT_TELD = 'Tampilkan/Sembunyikan info telepon.';
protected $AX_CIT_FAXL = 'Fax';
protected $AX_CIT_FAXD = 'Tampilkan/Sembunyikan info faks.';
protected $AX_CIT_MISCL = 'Info Lainnya';
protected $AX_CIT_MISCD = 'Tampilkan/Sembunyikan info lainnya.';
protected $AX_CIT_VCARDL = 'Vcard';
protected $AX_CIT_VCARDD = 'Tampilkan/Sembunyikan Vcard.';
protected $AX_CIT_CIMGL = 'Gambar';
protected $AX_CIT_CIMGD = 'Tampilkan/Sembunyikan gambar.';
protected $AX_CIT_DEMAILL = 'Deskripsi Email';
protected $AX_CIT_DEMAILD = 'Tampilkan/Sembunyikan Teks Deskripsi di bawah.';
protected $AX_CIT_DTXTL = 'Teks Deskripsi';
protected $AX_CIT_DTXTD = 'Teks Deskripsi untuk formulir Email. Jika dibiarkan kosong, ia akan menggunakan definisi bahasa _EMAIL_DESCRIPTION.';
protected $AX_CIT_EMFRML = 'Formulir Email';
protected $AX_CIT_EMFRMD = 'Tampilkan/Sembunyikan formulir email.';
protected $AX_CIT_EMCPYL = 'Duplikat Email';
protected $AX_CIT_EMCPYD = 'Tampilkan/Sembunyikan kotak centang untuk meng-copy email ke alamat pengirim.';
protected $AX_CIT_DDL = 'Drop Down';
protected $AX_CIT_DDD = 'Tampilkan/Sembunyikan pilihan daftar Drop Down dalam tampilan Kontak.';
protected $AX_CIT_ICONTXL = 'Ikon/teks';
protected $AX_CIT_ICONTXD = 'Gunakan Ikon, teks atau tidak ada di sebelah informsi kontak yang ditampilkan.';
protected $AX_CIT_ICONS = 'Ikon';
protected $AX_CIT_TEXT = 'Teks';
protected $AX_CIT_NONE = 'Tidak Ada';
protected $AX_CIT_ADICONL = 'Ikon Alamat';
protected $AX_CIT_ADICOND = 'Ikon untuk info Alamat.';
protected $AX_CIT_EMICONL = 'Ikon Email';
protected $AX_CIT_EMICOND = 'Ikon untuk info Email.';
protected $AX_CIT_TLICONL = 'Ikon Telepon';
protected $AX_CIT_TLICOND = 'Ikon untuk info Telepon.';
protected $AX_CIT_FXICONL = 'Ikon Fax';
protected $AX_CIT_FXICOND = 'Ikon untuk info Fax.';
protected $AX_CIT_MCICONL = 'Ikon Lainnya';
protected $AX_CIT_MCICOND = 'Ikon untuk info Lainnya.';
protected $AX_CCT_NAMEL = 'Nama';
protected $AX_CCT_NAMED = 'Tampilkan/Sembunyikan info nama.';
protected $AX_CCT_POSITL = 'Posisi';
protected $AX_CCT_POSITD = 'Tampilkan/Sembunyikan info posisi.';
protected $AX_CCT_EMAILL = 'Email';
protected $AX_CCT_EMAILD = 'Tampilkan/Sembunyikan info email. Jika Anda tetapkanuntuk ditampilkan, alamat akan dilindungi dari spambots dengan javascript cloaking.';
protected $AX_CCT_SADDREL = 'Alamat Jalan';
protected $AX_CCT_SADDRED = 'Tampilkan/Sembunyikan infor alamat jalan.';
protected $AX_CCT_TOWNL = 'Kota/Daerah';
protected $AX_CCT_TOWND = 'Tampilkan/Sembunyikan info daerah.';
protected $AX_CCT_STATEL = 'Provinsi';
protected $AX_CCT_STATED = 'Tampilkan/Sembunyikan info provinsi.';
protected $AX_CCT_COUNTRL = 'Negara';
protected $AX_CCT_COUNTRD = 'Tampilkan/Sembunyikan info negara.';
protected $AX_CCT_ZIPL = 'Kode Pos';
protected $AX_CCT_ZIPD = 'Tampilkan/Sembunyikan info kode pos.';
protected $AX_CCT_TELL = 'Telepon';
protected $AX_CCT_TELD = 'Tampilkan/Sembunyikan info telepon.';
protected $AX_CCT_FAXL = 'Fax';
protected $AX_CCT_FAXD = 'Tampilkan/Sembunyikan info fax.';
protected $AX_CCT_MISCL = 'Info Lainnya';
protected $AX_CCT_MISCD = 'Tampilkan/Sembunyikan info lainnya.';
protected $AX_CCT_VCARDL = 'Vcard';
protected $AX_CCT_VCARDD = 'Tampilkan/Sembunyikan Vcard.';
protected $AX_CCT_CIMGL = 'Gambar';
protected $AX_CCT_CIMGD = 'Tampilkan/Sembunyikan gambar.';
protected $AX_CCT_DEMAILL = 'Deskripsi Email';
protected $AX_CCT_DEMAILD = 'Tampilkan/Sembunyikan Teks Deskripsi di bawah.';
protected $AX_CCT_DTXTL = 'Teks Deskripsi';
protected $AX_CCT_DTXTD = 'Teks Deskripsi untuk formulir Email. Jika dibiarkan kosong, ia akan menggunakan definisi bahasa _EMAIL_DESCRIPTION.';
protected $AX_CCT_EMFRML = 'Formulir Email';
protected $AX_CCT_EMFRMD = 'Tampilkan/Sembunyikan email ke formulir.';
protected $AX_CCT_EMCPYL = 'Email Copy';
protected $AX_CCT_EMCPYD = 'Tampilkan/Sembunyikan kotak centang untuk mengemail duplikat ke alamat pengirim.';
protected $AX_CCT_DDL = 'Drop Down';
protected $AX_CCT_DDD = 'Tampilkan/Sembunyikan pilihan daftar Drop Down dalam tampilan Kontak.';
protected $AX_CCT_ICONTXL = 'Ikon/teks';
protected $AX_CCT_ICONTXD = 'Gunakan Ikon, teks, atau tidak ada di sebelah informasi kontak yang ditampilkan.';
protected $AX_CCT_ICONS = 'Ikon';
protected $AX_CCT_TEXT = 'Teks';
protected $AX_CCT_NONE = 'Tidak ada';
protected $AX_CCT_ADICONL = 'Ikon Alamat';
protected $AX_CCT_ADICOND = 'Ikon untuk info Alamat.';
protected $AX_CCT_EMICONL = 'Ikon Email';
protected $AX_CCT_EMICOND = 'Ikon untuk info Email.';
protected $AX_CCT_TLICONL = 'Ikon Telepon';
protected $AX_CCT_TLICOND = 'Ikon untuk info Telepon.';
protected $AX_CCT_FXICONL = 'Ikon Fax';
protected $AX_CCT_FXICOND = 'Ikon untuk info Fax.';
protected $AX_CCT_MCICONL = 'Ikon Lainnya';
protected $AX_CCT_MCICOND = 'Ikon untuk info Lainnya.';
//com_content/content.xml
protected $AX_CNT_CDESC = 'Ini menampilkan satu halaman konten.';
protected $AX_CNT_INTEXTL = 'Teks Intro';
protected $AX_CNT_INTEXTD = 'Tampilkan/Sembunyikan teks intro.';
protected $AX_CNT_KEYRL = 'Referensi Kunci';
protected $AX_CNT_KEYRD = 'Kunci teks yang bisa direferensi dengan item (seperti referensi bantuan).';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'Komponen ini menampilkan semua konten yang diterbitkan dari situs Anda yang ditandai Tampilkan di Halaman Depan.';
//com_login/login.xml
protected $AX_LG_CDESC = 'Parameter untuk Item Kontak individual.';
protected $AX_LG_LPTL = 'Judul Halaman Masuk';
protected $AX_LG_LPTD = 'Teks untuk ditampilkan di atas halaman. Jika dibiarkan kosong, nama Menu yang akan dipakai.';
protected $AX_LG_LRURLL = 'URL Pengalihan Masuk';
protected $AX_LG_LRURLD = 'Halaman apa untuk tempat pengalihan setelah masuk. Jika dibiarkan kosong, akan mengambil halaman depan.';
protected $AX_LG_LJSML = 'Pesan JS Masuk';
protected $AX_LG_LJSMD = 'Tampilkan/Sembunyikan javascript pop-up, yang menunjukan Sukses Masuk.';
protected $AX_LG_LDESCL = 'Deskripsi Masuk';
protected $AX_LG_LDESCD = 'Tampilkan/Sembunyikan Deskripsi Masuk di bawah.';
protected $AX_LG_LDESTL = 'Teks Deskripsi Masuk';
protected $AX_LG_LDESTD = 'Teks untuk ditampilkan pada Halaman Masuk. Jika dibiarkan kosong, _LOGIN_DESCRIPTION akan dipakai.';
protected $AX_LG_LIMGL = 'Gambar Masuk';
protected $AX_LG_LIMGD = 'Gambar untuk Halaman Masuk.';
protected $AX_LG_LIMGAL = 'Penjajaran Gambar Masuk';
protected $AX_LG_LIMGAD = 'Penjajaran untuk Gambar Masuk.';
protected $AX_LG_LOPTL = 'Judul Halaman Keluar';
protected $AX_LG_LOPTD = 'Teks untuk ditampilkan di atas halaman. Jika dibiarkan kosong, nama Menu yang akan dipakai.';
protected $AX_LG_LORURLL = 'URL Pengalihan Keluar';
protected $AX_LG_LORURLD = 'Halaman apa untuk tempat pengalihan setelah keluar. Jika dibiarkan kosong, akan mengambil halaman depan.';
protected $AX_LG_LOJSML = 'Pesan JS Keluar';
protected $AX_LG_LOJSMD = 'Tampilkan/Sembunyikan javascript pop-up, yang menunjukan Sukses Keluar.';
protected $AX_LG_LODSCL = 'Deskripsi Keluar';
protected $AX_LG_LODSCD = 'Tampilkan/Sembunyikan Deskripsi Keluar di bawah.';
protected $AX_LG_LODSTL = 'Teks Deskripsi Keluar';
protected $AX_LG_LODSTD = 'Teks untuk ditampilkan pada Halaman Keluar. Jika dibiarkan kosong, _LOGOUT_DESCRIPTION akan dipakai.';
protected $AX_LG_LOGOIL = 'Gambar Keluar';
protected $AX_LG_LOGOID = 'Gambar untuk Halaman Keluar.';
protected $AX_LG_LOGOIAL = 'Penjajaran Gambar Keluar';
protected $AX_LG_LOGOIAD = 'Penjajaran untuk Halaman Keluar.';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'Komponen ini membolehkan Anda untuk mengirimkan email massa ke grup pengguna tertentu.';
//com_media/media.xml
protected $AX_ME_CDESC = 'Komponen ini mengatur media situs.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'Komponen ini mengatur Menu Anda.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'Link - Item Komponen';
protected $AX_MUCIL_CDESC = 'Membuat link ke Komponen Elxis yang sudah ada.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'Komponen';
protected $AX_MUCOMP_CDESC = 'Menampilkan antarmuka latar depan untuk Komponen.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'Tabel - Kategori Kontak';
protected $AX_MUCCT_CDESC = 'Menampilkan tampilan Tabel item-item Kontak untuk Kategori tertentu.';
protected $AX_MUCCT_CATDL = 'Deskripsi Kategori';
protected $AX_MUCCT_CATDD = 'Tampilkan/Sembunyikan Deskripsi untuk daftar kategori lainnya.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'Link - Item Kontak';
protected $AX_MUCTIL_CDESC = 'Membuat link ke Item Kontak Diterbitkan';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Blog - Arsip Konten Kategori';
protected $AX_MUCAC_CDESC = 'Menampilkan daftar item-item Konten yang diarsipkan untuk kategori tertentu.';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME = 'Blog - Arsip Konten Seksi';
protected $AX_MUCAS_CDESC = 'Menampilkan daftar item-item Konten yang diarsipkan untuk seksi tertentu.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Blog - Kategori Konten';
protected $AX_MUCBC_CDESC = 'Menampilkan halaman item-item Konten dari multipel kategori menggunakan format blog.';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME = 'Blog - Seksi Konten';
protected $AX_MUCBS_CDESC = 'Menampilkan halaman item-item konten dari multipel seksi menggunakan format blog.';
protected $AX_MUCBS_SHSD = 'Tampilkan/Sembunyikan Deskripsi Seksi.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'Tabel - Kategori Konten';
protected $AX_MUCC_CDESC = 'Menampilkan tampilan Tabel item-item Konten untuk Kategori tertentu.';
protected $AX_MUCC_SHLOCD = 'Tampilkan/Sembunyikan daftar Kategori lainnya.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'Link - Item Konten';
protected $AX_MCIL_CDESC = 'Membuat link ke Item Konten yang diterbitkan dalam tampilan penuh.';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME = 'Tabel - Seksi Konten';
protected $AX_MCS_CDESC = 'Membuat daftar kategori Konten untuk seksi tertentu.';
protected $AX_MCS_STL = 'Judul Seksi';
protected $AX_MCS_STD = 'Tampilkan/Sembunyikan judul seksi.';
protected $AX_MCS_SHCTID = 'Tampilkan/Sembunyikan Gambar Deskripsi Kategori.';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'Link - Halaman Tersendiri';
protected $AX_MLSC_CDESC = 'Membuat link ke Item Halaman Tersendiri.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'Tabel - Kategori Newsfeed';
protected $AX_MNSFC_CDESC = 'Menampilkan tampilan Tabel item-item Newsfeed untuk Kategori tertentu.';
protected $AX_MNSFC_SHNCD = 'Tampilkan/Sembunyikan Kolom Nama.';
protected $AX_MNSFC_ACL = 'Kolom Artikel';
protected $AX_MNSFC_ACD = 'Tampilkan/Sembunyikan kolom Artikel.';
protected $AX_MNSFC_LCL = 'Kolom Link';
protected $AX_MNSFC_LCD = 'Tampilkan/Sembunyikan kolom Link.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'Link - Newsfeed';
protected $AX_MNSFL_CDESC = 'Membuat link ke satu Newsfeed yang diterbitkan.';
protected $AX_MNSFL_FDIML = 'Gambar Pasokan';
protected $AX_MNSFL_FDIMD = 'Tampilkan/Sembunyikan gambar pasokan (feed).';
protected $AX_MNSFL_FDDSL = 'Deskripsi Pasokan';
protected $AX_MNSFL_FDDSD = 'Tampilkan/Sembunyikan teks deskripsi pasokan berita.';
protected $AX_MNSFL_WDCL = 'Jumlah Kata';
protected $AX_MNSFL_WDCD = 'Mengijinkan Anda untuk membatasi jumlah item teks deskripsi yang terlihat. 0 akan menampilkan seluruh teks.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'Pemisah / Placeholder';
protected $AX_MSEP_CDESC = 'Membuat menu placeholder atau pemisah.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Link - Url';
protected $AX_MURL_CDESC = 'Membuat link ke sebuah URL.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'Tabel - Kategori Weblink';
protected $AX_MWLC_CDESC = 'Menampilkan tampilan Tabel item-item Weblink untuk Kategori Weblink tertentu.';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'Pelapis';
protected $AX_MWRP_CDESC = 'Membuat IFrame yang akan melapir halaman/situs eksternal ke dalam Elxis.';
protected $AX_MWRP_SCRBL = 'Scroll Bar';
protected $AX_MWRP_SCRBD = 'Tampilkan/Sembunyikan scroll bar Horisontal & Vertikal.';
protected $AX_MWRP_WDTL = 'Panjang';
protected $AX_MWRP_WDTD = 'Panjang jendela IFrame, Anda dapat memasukkan nilai absolut dalam pixel, atau nilai relatif dengan menambahkan %.';
protected $AX_MWRP_HEIL = 'Tinggi';
protected $AX_MWRP_HEID = 'Tinggi jendela IFrame.';
protected $AX_MWRP_AHL = 'Tinggi Otomatis';
protected $AX_MWRP_AHD = 'Tinggi akan secara otomatis disetel ke ukuran halaman eksternal. Ini hanya akan bekerja untuk halaman pada domain Anda sendiri.';
protected $AX_MWRP_AADL = 'Otomatis Menambah';
protected $AX_MWRP_AADD = 'Standarnya http:// akan ditambahkan kecuali http:// atau https:// terdeteksi dalam url link yang Anda berikan. Opsi ini mengijinkan Anda untuk mematikan fitur ini.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'Lini Sistem';
protected $AX_MSYS_CDESC = 'Membuat link ke fitur sistem';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'Komponen ini mengatur pasokan berita RSS/RDF.';
protected $AX_NFE_DPD = 'Deskripsi halaman';
protected $AX_NFE_SHFNCD = 'Tampilkan/Sembunyikan Kolom Nama Feed.';
protected $AX_NFE_NOACL = '# Kolom Artikel';
protected $AX_NFE_NOACD = 'Tampilkan/Sembunyikan # artikel dalam feed.';
protected $AX_NFE_LCL = 'Kolom Link';
protected $AX_NFE_LCD = 'Tampilkan/Sembunyikan kolom Feed Link.';
protected $AX_NFE_IDL = 'Deskripsi Item';
protected $AX_NFE_IDD = 'Tampilkan/Sembunyikan deskripsi atau teks intro dari sebuah item.';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'Komponen ini mengatur fungsionalitas Pencarian.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'Komponen ini mengontrol setelan Sindikasi.';
protected $AX_SYN_CACHL = 'Cache';
protected $AX_SYN_CACHD = 'Cache file-file pasokan berita.';
protected $AX_SYN_CACHTL = 'Cache Jam';
protected $AX_SYN_CACHTD = 'File Cache akan disegarkan setiap x detik.';
protected $AX_SYN_ITMSL = '# Item';
protected $AX_SYN_ITMSD = 'Jumlah Item untuk disindikasikan.';
protected $AX_SYN_ITMSDFLT = 'Sindikasi Elxis';
protected $AX_SYN_TITLE = 'Judul Sindikasi';
protected $AX_SYN_DESCD = 'Deskripsi Sindikasi.';
protected $AX_SYN_DESCDFLT = 'Sindikasi situs Elxis';
protected $AX_SYN_IMGD = 'Gambar untuk disertakan dalam pasokan.';
protected $AX_SYN_IMGAL = 'Alt Gambar';
protected $AX_SYN_IMGAD = 'Teks alternatif untuk gambar.';
protected $AX_SYN_IMGADFLT = 'Powered by Elxis';
protected $AX_SYN_LMTL = 'Batas Teks';
protected $AX_SYN_LMTD = 'Batasi teks artikel ke nilai yang ditunjukan di bawah.';
protected $AX_SYN_TLENL = 'Panjang Teks';
protected $AX_SYN_TLEND = 'Panjang kata teks artikel - 0 tidak akan menampilkan teks.';
protected $AX_SYN_LBL = 'Bookmark Langsung';
protected $AX_SYN_LBD = 'Aktifkan dukungan untuk fungsionalitas Bookmark Langsung Firefox.';
protected $AX_SYN_BFL = 'File Bookmark';
protected $AX_SYN_BFD = 'Nama file khusus. Jika kosong, maka yang standar yang akan dipakai.';
protected $AX_SYN_ORDL = 'Urutan';
protected $AX_SYN_ORDD = 'Urutan untuk menampilkan item.';
protected $AX_SYN_MULTIL = 'Pasokan berita Multi-lingual';
protected $AX_SYN_MULTILD = 'Jika ya, Elxis akan membuat pasokan berita bahasa tertentu.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'Komponen ini mengatur fungsionalitas Sampah.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'Ini menampilkan halaman konten tunggal.';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'Komponen ini menampilkan daftar Weblinks dengan foto layar situs.';
protected $AX_WBL_LDL = 'Deskripsi Link';
protected $AX_WBL_LDD = 'Tampilkan/Sembunyikan teks Deskripsi Link.';
protected $AX_WBL_ICL = 'Ikon';
protected $AX_WBL_ICD = 'Ikon yang dipakai di kiri url link dalam tampilan Tabel.';
protected $AX_WBL_SCSL = 'Foto layar';
protected $AX_WBL_SCSD = 'Menampilkan foto layar terkait situs. Jika dipakai, maka Ikon Weblinks di atas tidak akan ditampilkan.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'Jendela Target saat link di klik.';
protected $AX_WBLI_OT01 = 'Jendela Leluhur Dengan Navigasi Browser';
protected $AX_WBLI_OT02 = 'Jendela Baru Dengan Navigasi Browser';
protected $AX_WBLI_OT03 = 'Jendela Baru Tanpa Navigasi Browser';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'Modul ini menampilkan daftar Item-Item terbaru yang saat masih diterbitkan (beberapa diantaranya telah berakhir meskipun ada yang terbaru). Item yang ditampilkan pada komponen Halaman Depan tidak disertakan dalam daftar.'; 
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'Modul ini menampilkan daftar para pengguna yang masuk saat ini.'; 
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'Modul ini menampilkan daftar Item-Item populer yang diterbitkan yang masuk aktif saat ini (beberapa diantaranya telah berakhir meskipun ada yang terbaru). Item-Item yang ditampilkan pada komponen Halaman Depan tidak disertakan dalam daftar.'; 
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'Modul ini menampilkan statistik Item-Item yang masih aktif (beberapa diantaranya telah berakhir meskipun ada yang terbaru). Item-Item yang ditampilkan pada komponen Halaman Depan tidak disertakan dalam daftar.'; 
//SITE MODULES
//General
protected $AX_SM_MCSL = 'Sufiks Kelas Modul'; 
protected $AX_SM_MCSD = 'Sufiks untuk diterapkan pada kelas CSS suatu modul (table.moduletable), ini mengijinkan gaya individual modul.'; 
protected $AX_SM_MUCSL = 'Sufiks Kelas Menu'; 
protected $AX_SM_MUCSD = 'Sufiks untuk diterapkan ke kelas CSS suatu item menu.'; 
protected $AX_SM_ECL = 'Hidupkan Cache'; 
protected $AX_SM_ECD = 'Pilih apakah konten modul ini akan di-cache.'; 
protected $AX_SM_SMIL = 'Tampilkan Ikon Menu'; 
protected $AX_SM_SMID = 'Tampilkan Ikon Menu yang Anda pilih untuk item menu Anda.'; 
protected $AX_SM_MIAL = 'Penjajaran Ikon Menu'; 
protected $AX_SM_MIAD = 'Penjajaran Ikon Menu'; 
protected $AX_SM_MODL = 'Mode Modul'; 
protected $AX_SM_MODD = 'Mengijinkan Anda untuk mengontrol tipe Konten mana untuk ditampilkan dalam modul.'; 
protected $AX_SM_OP01 = 'Hanya Item Konten'; 
protected $AX_SM_OP02 = 'Hanya Halaman Tersendiri'; 
protected $AX_SM_OP03 = 'Keduanya'; 
//modules/custom.xml
protected $AX_SM_CU_DESC = 'Modul Kustom.'; 
protected $AX_SM_CU_RSURL = 'RSS URL'; 
protected $AX_SM_CU_RSURD = 'Masukkan URL pasokan berita RSS/RDF.'; 
protected $AX_SM_CU_FEDL = 'Deskripsi Pasokan'; 
protected $AX_SM_CU_FEDD = 'Tampilkan teks deskripsi untuk keseluruhan Pasokan.'; 
protected $AX_SM_CU_FEIL = 'Gambar Pasokan'; 
protected $AX_SM_CU_FEDID = 'Tampilkan gambar terkait dengan seluruh Pasokan.'; 
protected $AX_SM_CU_ITL = 'Item'; 
protected $AX_SM_CU_ITD = 'Masukkan jumlah item RSS untuk ditampilkan.'; 
protected $AX_SM_CU_ITDL = 'Deskripsi Item'; 
protected $AX_SM_CU_ITDD = 'Tampilkan deskripsi atau teks intro setiap item berita individual.'; 
protected $AX_SM_CU_WCL = 'Jumlah Kata'; 
protected $AX_SM_CU_WCD = 'Mengijinkan Anda untuk membatasi jumlah item teks deskripsi yang terlihat. 0 akan menampilkan seluruh teks.'; 
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'Modul ini menampilkan daftar kalender bulan, yang berisi item yang Diarsipkan. Setelah Anda mengubah status Item Konten ke \'Diarsipkan\' daftar ini akan dibuat secara otomatis.'; 
protected $AX_SM_AR_CNTL = 'Jumlah'; 
protected $AX_SM_AR_CNTD = 'Jumlah item untuk ditampilkan (standarnya 10).'; 
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'Modul banner mengijinkan Anda untuk menampilkan banner aktif di luar komponen di dalam situs Anda.'; 
protected $AX_SM_BN_CNTL = 'Klien Banner'; 
protected $AX_SM_BN_CNTD = "Referensi terhadap id klien banner. Masukkan dipisahkan dengan ','!"; 
protected $AX_SM_BN_NBSL = 'Jumlah Banner Ditampilkan';
protected $AX_SM_BN_NBPRL = 'Jumlah Banner Per Baris';
protected $AX_SM_BN_NBPRD = 'Jumlah banner per baris, untuk mematikan, setel menjadi 0. Untuk menampilkan banner secara vertikal, setel ini jadi 1';
protected $AX_SM_BN_UNQBL = 'Banner Unik';
protected $AX_SM_BN_UNQBD = 'Tidak ada banner yang ditampilkan lebih dari sekali (per sesi). Jika semua banner telah ditampilkan, maka histori dibersihkan dan dimulai lagi.';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'Modul ini menampilkan daftar semua Item yang akhir-akhir ini diterbitkan dan masih aktif (beberapa diantaranya sudah berakhir meskipun masih baru). Item-item yang ditampilkan pada komponen Halaman Depan tidak disertakan dalam daftar.'; 
protected $AX_SM_LN_FPIL = 'Item Halaman depan'; 
protected $AX_SM_LN_FPID = 'Tampilkan/Sembunyikan item yang disiapkan untuk Halaman depan - hanya bekerja saat dalam mode Item Konten.'; 
protected $AX_SM_AR_CNT5D = 'Jumlah item untuk ditampilkan (standarnya 5).'; 
protected $AX_SM_LN_CATIL = 'ID Kategori'; 
protected $AX_SM_LN_CATID = 'Memilih item dari Kategori tertentu atau set Kategori (untuk menetapkan lebih dari satu Kategori, pisahkan dengan , ).'; 
protected $AX_SM_LN_SECIL = 'ID Seksi'; 
protected $AX_SM_LN_SECID = 'Memilih item dari Seksi tertentu atau set Seksi (untuk menetapkan lebih dari satu Seksi, pisahkan dengan , ).'; 
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'Modul ini menampilkan formulir masuk Nama pengguna dan Kata sandi. Ia juga menampilkan link untuk mengambil kata sandi yang dilupakan. Jika registrasi pengguna dihidupkan, (lihat Setelan Konfigurasi), kemudian link lain akan ditampilkan untuk mengundang para pengguna mendaftarkan diri.'; 
protected $AX_SM_LF_PTL = 'Pra-teks'; 
protected $AX_SM_LF_PTD = 'Ini adalah Teks atau HTML yang ditampilkan di atas formulir masuk.'; 
protected $AX_SM_LF_PSTL = 'Post-teks'; 
protected $AX_SM_LF_PSTD = 'Ini adalah Teks atau HTML yang ditampilkan di bawah formulir masuk.'; 
protected $AX_SM_LF_LRUL = 'URL Pengalihan Masuk'; 
protected $AX_SM_LF_LRUD = 'Halaman apa untuk mengalihkan setelah masuk. Jika dibiarkan kosong akan mengambil halaman depan.'; 
protected $AX_SM_LF_LORUL = 'URL Pengalihan Keluar'; 
protected $AX_SM_LF_LORUD = 'Halaman apa untuk mengalihkan setelah keluar. Jika dibiarkan kosong akan mengambil halaman depan.'; 
protected $AX_SM_LF_LML = 'Pesan Masuk'; 
protected $AX_SM_LF_LMD = 'Tampilkan/Sembunyikan javascript pop-up yang menunjukan Sukses Masuk.'; 
protected $AX_SM_LF_LOML = 'Pesan Keluar'; 
protected $AX_SM_LF_LOMD = 'Tampilkan/Sembunyikan javascript pop-up yang menunjukan Sukses Keluar.'; 
protected $AX_SM_LF_GML = 'Penyambutan'; 
protected $AX_SM_LF_GMD = 'Tampilkan/Sembunyikan teks penyambutan sederhana.'; 
protected $AX_SM_LF_NUNL = 'Nama/Nama pengguna'; 
protected $AX_SM_LF_OP01 = 'Nama pengguna'; 
protected $AX_SM_LF_OP02 = 'Nama'; 
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'Menampilkan menu.'; 
protected $AX_SM_MNM_MNL = 'Nama Menu'; 
protected $AX_SM_MNM_MND = 'Nama menu (standarnya \'mainmenu\').'; 
protected $AX_SM_MNM_MSL = 'Gaya Menu'; 
protected $AX_SM_MNM_MSD = 'Gaya menu'; 
protected $AX_SM_MNM_OP1 = 'Vertikal'; 
protected $AX_SM_MNM_OP2 = 'Horisontal'; 
protected $AX_SM_MNM_OP3 = 'Daftar Flat'; 
protected $AX_SM_MNM_EML = 'Lebarkan Menu'; 
protected $AX_SM_MNM_EMD = 'Melebarkan menu dan menjadikan item sub-menunya selalu terlihat.'; 
protected $AX_SM_MNM_IIL = 'Gambar Indent'; 
protected $AX_SM_MNM_IID = 'Pilih sistem gambar indent mana yang akan dipakai.'; 
protected $AX_SM_MNM_OP4 = 'Template'; 
protected $AX_SM_MNM_OP5 = 'Gambar standar Elxis'; 
protected $AX_SM_MNM_OP6 = 'Gunakan parameter di bawah'; 
protected $AX_SM_MNM_OP7 = 'Tidak ada'; 
protected $AX_SM_MNM_II1L = 'Gambar Indent 1'; 
protected $AX_SM_MNM_II1D = 'Gambar untuk sub-level pertama.'; 
protected $AX_SM_MNM_II2L = 'Gambar Indent 2'; 
protected $AX_SM_MNM_II2D = 'Gambar untuk sub-level kedua.'; 
protected $AX_SM_MNM_II3L = 'Gambar Indent 3'; 
protected $AX_SM_MNM_II3D = 'Gambar untuk sub-level ketiga.'; 
protected $AX_SM_MNM_II4L = 'Gambar Indent 4'; 
protected $AX_SM_MNM_II4D = 'Gambar untuk sub-level keempat.'; 
protected $AX_SM_MNM_II5L = 'Gambar Indent 5'; 
protected $AX_SM_MNM_II5D = 'Gambar untuk sub-level kelima.'; 
protected $AX_SM_MNM_II6L = 'Gambar Indent 6'; 
protected $AX_SM_MNM_II6D = 'Gambar untuk sub-level keenam.'; 
protected $AX_SM_MNM_SPL = 'Spacer'; 
protected $AX_SM_MNM_SPD = 'Spacer untuk Menu Horisontal.'; 
protected $AX_SM_MNM_ESL = 'Spacer Akhir'; 
protected $AX_SM_MNM_ESD = 'Spacer Akhir untuk Menu Horisontal.';
protected $AX_SM_MNM_IDPR = 'SEO PRO Itemid preload';
protected $AX_SM_MNM_IDPRD = 'Menghidupkan AJAX preload atas Itemid yang memecahkan masalah setelan item menu tertentu saat memiliki lebih dari satu link menu yang merujuk ke halaman yang sama.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'Modul ini menampilkan daftar Item yang saat ini diterbitkan yang paling banyak dilihat - ditentukan oleh jumlah kali halaman sudah dilihat.'; 
protected $AX_SM_MRC_MNL = 'Nama Menu'; 
protected $AX_SM_MRC_MND = 'Nama menu (standarnya mainmenu).'; 
protected $AX_SM_MRC_FPIL = 'Item Halaman Depan'; 
protected $AX_SM_MRC_FPID = 'Tampilkan/Sembunyikan item-item yang disiapkan untuk Halaman depan - hanya bekerja saat dalam mode Item Konten.'; 
protected $AX_SM_MRC_CL = 'Jumlah'; 
protected $AX_SM_MRC_CD = 'Jumlah item untuk ditampilkan (standarnya 5).'; 
protected $AX_SM_MRC_CIDL = 'ID Kategori'; 
protected $AX_SM_MRC_CIDD = 'Memilih item-item dari Kategori atau set Kategori tertentu (untuk menetapkan lebih dari satu Kategori, pisahkan dengan , ).'; 
protected $AX_SM_MRC_SIDL = 'ID Seksi'; 
protected $AX_SM_MRC_SIDD = 'Memilih item-item dari Seksi atau set Seksi tertentu (untuk menetapkan lebih dari satu Seksi, pisahkan dengan , ).'; 
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'Modul Newsflash secara acak memilih satu dari item-item yang diterbitkan dari kategori setiap kali halaman disegarkan. Ia juga bisa menampilkan multipel item dalam konfigurasi horisontal atau vertikal.'; 
protected $AX_SM_NWF_CATL = 'Kategori'; 
protected $AX_SM_NWF_CATD = 'Kategori konten.'; 
protected $AX_SM_NWF_STL = 'Gaya'; 
protected $AX_SM_NWF_STD = 'Gaya untuk menampilkan kategori.'; 
protected $AX_SM_NWF_OP1 = 'Secara acak memilih satu per waktu'; 
protected $AX_SM_NWF_OP2 = 'Horisontal'; 
protected $AX_SM_NWF_OP3 = 'Vertikal'; 
protected $AX_SM_NWF_SIL = 'Tampilkan gambar'; 
protected $AX_SM_NWF_SID = 'Tampilkan gambar item konten.'; 
protected $AX_SM_NWF_LTL = 'Judul Di-Link'; 
protected $AX_SM_NWF_LTD = 'Jadikan judul Item sebuah link.'; 
protected $AX_SM_NWF_RML = 'Selengkapnya'; 
protected $AX_SM_NWF_RMD = 'Tampilkan/Sembunyikan tombol Selengkapnya.'; 
protected $AX_SM_NWF_ITL = 'Judul Item'; 
protected $AX_SM_NWF_ITD = 'Tampilkan judul item.'; 
protected $AX_SM_NWF_NOIL = 'Jumlah Item'; 
protected $AX_SM_NWF_NOID = 'Jumlah item untuk ditampilkan.'; 
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'Modul ini adalah tambahan komponen Polling. Ia dipakai untuk menampilkan polling yang dikonfigurasi. Modul berbeda dari modul lain sebanyak dukungan Komponen antara Item Menu dan Polling. Ini berarti bahwa modul hanya menampilkan Polling tersebut, yang dikonfigurasi untuk Item Menu tertentu.'; 
protected $AX_SM_POL_CATL = 'Kategori'; 
protected $AX_SM_POL_CATD = 'Kategori konten.'; 
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC = 'Modul ini menampilkan gambar acak dari direktori yang dipilih.'; 
protected $AX_SM_RNI_ITL = 'Jenis Gambar'; 
protected $AX_SM_RNI_ITD = 'Jenis gambar PNG/GIF/JPG dll. (standarnya JPG).'; 
protected $AX_SM_RNI_IFL = 'Folder Gambar'; 
protected $AX_SM_RNI_IFD = 'Path ke relatif folder gambar terhadap URL situs, contoh: images/stories.'; 
protected $AX_SM_RNI_LNL = 'Link'; 
protected $AX_SM_RNI_LND = 'URL untuk mengalihkan jika gambar di klik, contoh: http://www.goup.gr'; 
protected $AX_SM_RNI_WL = 'Panjang (px)'; 
protected $AX_SM_RNI_WD = 'Panjang gambar (memaksa semua gambar ditampilkan dengan panjang ini).'; 
protected $AX_SM_RNI_HL = 'Tinggi (px)'; 
protected $AX_SM_RNI_HD = 'Tinggi gambar (memaksa semua gambar ditampilkan dengan tinggi ini).'; 
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = "Modul ini menampilkan Item Konten lain yang terkait dengan Item yang saat ini ditampilkan. Ini didasarkan pada kata kunci Metadata. Semua kata kunci dari Item Konten saat ini dicari terhadap semua kata kunci semua item-item lain yang diterbitkan. Sebagai contoh, Anda mungkin memiliki Item pada 'Greece' dan Anda mungkin memiliki yang lain pada 'Parthenon'. Jika Anda menyertakan kata kunci 'Greece' di kedua Item, maka modul Item Terkait akan mendaftar Item 'Greece' saat melihat 'Parthenon' dan sebaliknya."; 
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = 'Modul Sindikasi akan menampilkan link dimana orang dapat mensindikasikan situs Anda untuk semua berita terbaru Anda. Ketika Anda mengklik pad ikon RSS, Anda akan dialihkan ke halaman baru yang akan mendaftar semua berita terbaru dalam format XML. Untuk menggunakan Newsfeed dalam situs Elxis lain atau pembaca Newsfeed, Anda perlu memotong dan paste URL.'; 
protected $AX_SM_RSS_TXL = 'Teks'; 
protected $AX_SM_RSS_TXD = 'Masukkan teks yang ditampilkan bersamaan dengan link RSS.'; 
protected $AX_SM_RSS_091D = 'Tampilkan/Sembunyikan Link RSS 0.91.'; 
protected $AX_SM_RSS_10D = 'Tampilkan/Sembunyikan Link RSS 1.0.'; 
protected $AX_SM_RSS_20D = 'Tampilkan/Sembunyikan Link RSS 2.0.'; 
protected $AX_SM_RSS_03D = 'Tampilkan/Sembunyikan Link Atom 0.3.'; 
protected $AX_SM_RSS_OPD = 'Tampilkan/Sembunyikan Link OPML.'; 
protected $AX_SM_RSS_I091L = 'Gambar RSS 0.91'; 
protected $AX_SM_RSS_I10L = 'Gambar RSS 1.0'; 
protected $AX_SM_RSS_I20L = 'Gambar RSS 2.0'; 
protected $AX_SM_RSS_I03L = 'Gambar Atom'; 
protected $AX_SM_RSS_IOPL = 'Gambar OPML'; 
protected $AX_SM_RSS_CHID = 'Pilih gambar yang akan dipakai.'; 
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'Modul ini akan menampilkan kotak pencarian.';
protected $AX_SM_SEM_TOP = 'Atas';
protected $AX_SM_SEM_BTM = 'Bawah';
protected $AX_SM_SEM_BWL = 'Panjang Kotak';
protected $AX_SM_SEM_BWD = 'Besar kotak teks pencarian.';
protected $AX_SM_SEM_TXL = 'Teks';
protected $AX_SM_SEM_TXD = 'Teks yang muncul dalam kotak teks, jika dibiarkan kosong ia akan mengambil _SEARCH_BOX dari file bahasa Anda.';
protected $AX_SM_SEM_BPL = 'Posisi Tombol';
protected $AX_SM_SEM_BPD = 'Posisi tombol relatif ke kotak pencarian.';
protected $AX_SM_SEM_BTXL = 'Teks Tombol';
protected $AX_SM_SEM_BTXD = 'Teks yang muncul dalam tombol pencarian, jika dibiarkan kosong ia akan mengambil _SEARCH_TITLE dari file bahasa Anda.'; 
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC = 'Modul Seksi menampilkan daftar semua Seksi yang dikonfigurasi dalam database Anda. Seksi di sini hanya merujuk ke Seksi Item. Jika konfigurasi \'Tampilkan Link Tidak Diotorisasi\' tidak disetel, daftar akan dibatasi ke seksi yang boleh dilihat oleh pengguna.'; 
protected $AX_SM_SEC_CL = 'Jumlah';
protected $AX_SM_SEC_CD = 'Jumlah item untuk ditampilkan (standarnya 5).';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = 'Modul Statistik menampilkan informasi mengenai statistik dan instalasi server Anda, jumlah konten dalam database Anda, dan jumlah link web yang Anda sediakan.';
protected $AX_SM_STA_SVIL = 'Info Server'; 
protected $AX_SM_STA_SVID = 'Menampilkan informasi server.'; 
protected $AX_SM_STA_SIL = 'Info Situs'; 
protected $AX_SM_STA_SID = 'Menampilkan informasi situs.'; 
protected $AX_SM_STA_HCL = 'Penghitung Kunjungan'; 
protected $AX_SM_STA_HCD = 'Menampilkan penghitung kunjungan.'; 
protected $AX_SM_STA_ICL = 'Naikkan Penghitung'; 
protected $AX_SM_STA_ICD = 'Masukkan jumlah kunjungan untuk meningkatkan penghitung.'; 
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'Modul Pemilih Template mengijinkan pengguna (pengunjung) untuk mengubah template situs secara langsung dari Latar-Depan melalui daftar pilihan drop down.'; 
protected $AX_SM_TMC_MNLL = 'Maks. Panjang Nama'; 
protected $AX_SM_TMC_MNLD = 'Ini adalah panjang maksimum nama template untuk ditampilkan (standarnya 20).'; 
protected $AX_SM_TMC_SPL = 'Tampilkan Tinjauan'; 
protected $AX_SM_TMC_SPD = 'Tinjauan Template untuk ditampilkan.'; 
protected $AX_SM_TMC_WL = 'Panjang'; 
protected $AX_SM_TMC_WD = 'Ini adalah panjang gambar tinjauan (standarnya 140 px).'; 
protected $AX_SM_TMC_HL = 'Tinggi'; 
protected $AX_SM_TMC_HD = 'Ini adalah tinggi gambar tinjauan (standarnya 90 px).'; 
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = 'Modul Siapa Online menampilkan jumlah pengguna anonim (tamu) dan pengguna terdaftar yang saat ini mengakses situs web.'; 
protected $AX_SM_WSO_DL = 'Tampilkan'; 
protected $AX_SM_WSO_DD = 'Pilih apa yang harus ditampilkan.'; 
protected $AX_SM_WSO_OP1 = '# Pengunjung/Anggota<br />'; 
protected $AX_SM_WSO_OP2 = 'Nama Anggota<br />'; 
protected $AX_SM_WSO_OP3 = 'Keduanya'; 
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'Modul ini menampilkan jendela IFrame ke lokasi yang telah ditetapkan.'; 
protected $AX_SM_WRM_URLL = 'URL'; 
protected $AX_SM_WRM_URLD = 'URL ke site/file yang ingin Anda tampilkan di dalam IFrame'; 
protected $AX_SM_WRM_SCBL = 'Scroll Bar'; 
protected $AX_SM_WRM_SCBD = 'Tampilkan/Sembunyikan scroll bar Horisontal & Vertikal.'; 
protected $AX_SM_WRM_WL = 'Panjang'; 
protected $AX_SM_WRM_WD = 'Panjang Jendela IFrame. Anda dapat memasukan nilai absolut dalam pixel, atau nilai relatif dengan menambahkan %.'; 
protected $AX_SM_WRM_HL = 'Tinggi'; 
protected $AX_SM_WRM_HD = 'Tinggi Jendela IFrame'; 
protected $AX_SM_WRM_AHL = 'Tinggi Otomatis'; 
protected $AX_SM_WRM_AHD = 'Tinggi akan disetel secara otomatis ke ukuran halaman eksternal. Ini hanya akan bekerja pada domain Anda sendiri.'; 
protected $AX_SM_WRM_ADL = 'Otomatis Tambah'; 
protected $AX_SM_WRM_ADD = 'Standarnya http:// akan ditambahkan kecuali terdeteksi http:// atau https:// dalam URL link yang Anda sediakan, ini mengijinkan Anda untuk mematikan kemampuan ini.'; 
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = 'Fungsionalitas'; 
protected $AX_ED_FUNCTD = 'Pilih fungsionalitas'; 
protected $AX_ED_FUNSIMPLE = 'Sederhana'; 
protected $AX_ED_FUNADV = 'Modern';
protected $AX_ED_EDITORWIDTHL = 'Panjang Editor';
protected $AX_ED_EDITORWIDTHD = 'Panjang Jendela Editor';
protected $AX_ED_EDITORHEIGHTL = 'Tinggi Editor';
protected $AX_ED_EDITORHEIGHTD = 'Tinggi Jendela Editor';
protected $AX_ED_COMPRESSEDVL = 'Versi Terkompresi';
protected $AX_ED_COMPRESSEDVD = 'TinyMCE dapat berjalan dalam mode terkompresi, menjadikan lebih cepat dalam pengambilan. Akan tetapi, mode ini tidak selalu bekerja, terutama dalam IE, maka standarnya mematikan ini.  Harap berhati-hati saat menghidupkan ini guna memastikan ia bekerja pada sistem Anda';
protected $AX_ED_OFF = 'Mati';
protected $AX_ED_ON = 'Hidup';
protected $AX_ED_COMPRESSL = 'Kompresi';
protected $AX_ED_COMPRESSD = 'Mengompres Editor TinyMCE menggunakan (pengambilan 75% lebih cepat)';
protected $AX_ED_CONVERTURLL = 'Ubah URL';
protected $AX_ED_CONVERTURLD = 'Ubah URL Absolut ke relatif.';
protected $AX_ED_ENTENCODL = 'Pengkodean Entitas';
protected $AX_ED_ENTENCODD = 'Opsi ini mengontrol bagaimana entitas/karakter diproses oleh TinyMCE. Nilai dapat disetel ke representasi numerik, entitas bernama arau raw, di mana tidak ada pengkodean yang dilakukan. Nilai standar dari opsi ini adalah bernama.';
protected $AX_ED_TXTDIRL = 'Arah Teks';
protected $AX_ED_TXTDIRD = 'Kemampuan untuk mengubah arah teks';
protected $AX_ED_CNVFONTSPANL = 'Ubah Font ke Span';
protected $AX_ED_CNVFONTSPAND = 'Ubah elemen Font ke elemen Span. Standarnya Ya sebagai elemen font yang tidak dipakai lagi.';
protected $AX_ED_FONTSIZETYPEL = 'Tipe Ukuran Font';
protected $AX_ED_FONTSIZETYPED = 'Pilih tipe ukuran font untuk dipakai, baik panjang misal: 10pt, atau ukuran-absolut misal: x-small.';
protected $AX_ED_INLTABLEDITL = 'Pengeditan Tabel Inline';
protected $AX_ED_INLTABLEDITD = 'Mengijinkan penyuntingan inline pada Tabel.';
protected $AX_ED_PROHELEMENTSL = 'Elemen Terlarang';
protected $AX_ED_PROHELEMENTSD = 'Elemen yang akan dibersihkan dari teks';
protected $AX_ED_EXTELEMENTSL = 'Elemen Diperluas';
protected $AX_ED_EXTELEMENTSD = 'Memperluas fungsionalitas TinyMCE dengan menambahkan elemen ekstra di sini. Format: elm[tag1|tag2]';
protected $AX_ED_EVELEMENTSL = 'Elemen Event';
protected $AX_ED_EVELEMENTSD = 'Oopsi ini harus berisi daftar dipisahkan koma atas elemen yang dapat memiliki atribut event seperti onclick dan semacamnya. Opsi ini diperlukan karena beberapa browser menjalankan event ini saat mengedit konten.';
protected $AX_ED_TCSSCLASSESL = 'Kelas CSS Template';
protected $AX_ED_TCSSCLASSESD = 'Mengambil kelas CSS dari template_css.css';
protected $AX_ED_CCSSCLASSESL = 'Kelas CSS Kustom';
protected $AX_ED_CCSSCLASSESD = 'Anda dapat menetapkan pengambilan file CSS kustom - cukup masukkan nama pengganti file CSS. File ini HARUS ditempatkan di folder yang sama seperti file CSS template Anda.';
protected $AX_ED_NEWLINESL = 'Baris baru';
protected $AX_ED_NEWLINESD = 'Baris baru akan dibuat ke dalam opsi yang dipilih';
protected $AX_ED_TOOLBARL = 'Toolbar';
protected $AX_ED_TOOLBARD = 'Posisi toolbar';
protected $AX_ED_HTMLHEIGHTL = 'Tinggi HTML';
protected $AX_ED_HTMLHEIGHTD = 'Tinggi jendela mode pop-up HTML.';
protected $AX_ED_HTMLWIDTHL = 'Panjang HTML';
protected $AX_ED_HTMLWIDTHD = 'Panjang jendela mode pop-up HTML.';
protected $AX_ED_PREVIEWHEIGHTL = 'Tinggi Tinjauan';
protected $AX_ED_PREVIEWHEIGHTD = 'Tinggi Tinjauan jendela mode pop-up HTML.';
protected $AX_ED_PREVIEWWIDTHL = 'Panjang Tinjauan';
protected $AX_ED_PREVIEWWIDTHD = 'Panjang Tinjauan jendela mode pop-up HTML.';
protected $AX_ED_IBROWSERL = 'iBrowser Plugin';
protected $AX_ED_IBROWSERD = 'iBrowser adalah pengatur gambar sangat maju';
protected $AX_ED_PLTABLESL = 'Tabel Plugin';
protected $AX_ED_PLTABLESD = 'Menghidupkan Editor Tabel dalam mode WYSIWYG.';
protected $AX_ED_PLPASTEL = 'Paste Plugin';
protected $AX_ED_PLPASTED = 'Menghidupkan Paste dari Word, Paste Teks Biasa dan Pilih Semua.';
protected $AX_ED_PLIMGPLUGINL = 'Adv. Image Plugin';
protected $AX_ED_PLIMGPLUGIND = 'Menghidupkan Pengatur Gambar Tingkat Lanjut. Standarnya Editor Gambar Sederhana yang dihidupkan.';
protected $AX_ED_PLSEARCHL = 'Plugin Cari/Ganti';
protected $AX_ED_PLSEARCHD = 'Menghidupkan plugin Cari dan Ganti.';
protected $AX_ED_PLLINKSL = 'Plugin Adv. Links';
protected $AX_ED_PLLINKSD = 'Menghidupkan Pengatur Link Tingkat Lanjut. Standarnya Editor Link Sederhana yang dihidupkan.';
protected $AX_ED_PLEMOTL = 'Plugin Emosi';
protected $AX_ED_PLEMOTD = 'Menghidupkan Plugin Emosi. Anda dapat menambah Emosi dengan mudah.';
protected $AX_ED_PLFLASHL = 'Plugin Flash';
protected $AX_ED_PLFLASHD = 'Menghidupkan Plugin Flash. Anda akan bisa menambah Flash multimedia dalam konten.';
protected $AX_ED_PLDTL = 'Plugin Tanggal/Jam';
protected $AX_ED_PLDTD = 'Menghidupkan Plugin Tanggal/Jam. Anda akan bisa menambah tanggal dan jam saat ini.';
protected $AX_ED_PLPREVL = 'Plugin Tinjauan';
protected $AX_ED_PLPREVD = 'Plugin ini menambah tombol tinjauan ke TinyMCE, menekan tombol akan membuka popup yang menampilkan konten saat ini.';
protected $AX_ED_PLZOOML = 'Plugin Zoom';
protected $AX_ED_PLZOOMD = 'Menambah zoom drop list dalam MSIE5.5+, plugin ini dibuat untuk menampilkan bagaimana untuk menambah droplist kustom sebagai plugin.';
protected $AX_ED_PLFSCRL = 'Plugin FullScreen';
protected $AX_ED_PLFSCRD = 'Plugin ini menambah mode edit layar penuh untuk TinyMCE.';
protected $AX_ED_PLPRINTL = 'Plugin Cetak';
protected $AX_ED_PLPRINTD = 'Plugin ini menambahkan tombol cetak ke TinyMCE.';
protected $AX_ED_PLDIRL = 'Plugin Direksionalitas';
protected $AX_ED_PLDIRD = 'Plugin ini menambah ikon direksionalitas ke TinyMCE yang menjadikan TinyMCE untuk lebih baik dalam menangani bahasa yang ditulis dari kanan ke kiri.';
protected $AX_ED_PLFONTSL = 'Daftar Pilihan Font';
protected $AX_ED_PLFONTSD = 'Plugin ini menambah daftar pilihan drop-down untuk font.';
protected $AX_ED_PLFONTSZL = 'Daftar Ukuran Font';
protected $AX_ED_PLFONTSZD = 'Plugin ini menambah daftar pilihan drop-down untuk ukuran font.';
protected $AX_ED_PLFORMLSL = 'Format Daftar';
protected $AX_ED_PLFORMLSD = 'Plugin ini menambah format daftar drop-down, misalnya H1, H2, dll.';
protected $AX_ED_PLSSLL = 'Daftar Pilihan Gaya';
protected $AX_ED_PLSSLD = 'Plugin ini menambah daftar pilihan gaya yang didasarkan pada template saat ini atau dari file CSS tergantung pilihan Anda.';
protected $AX_ED_NAMED = 'Bernama';
protected $AX_ED_NUMERIC = 'Numerik';
protected $AX_ED_RAW = 'Raw';
protected $AX_ED_LTR = 'Kiri ke Kanan';
protected $AX_ED_RTL = 'Kanan ke Kiri';
protected $AX_ED_LENGTH = 'Panjang';
protected $AX_ED_ABSSIZE = 'Ukuran-Absolut';
protected $AX_ED_BRELEMENTS = 'Elemen BR';
protected $AX_ED_PELEMENTS = 'Elemen P';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = 'Kalkulator';
protected $AX_TCAL_D = 'Kalkulator pintar javascript';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'Kosongkan Temporal';
protected $AX_TEMTEMP_D = 'Mengosongkan direktori temporal Elxis (/tmpr).';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = 'Betulkan Bahasa';
protected $AX_TFIXLANG_D = 'Melakukan pemeriksaan multilingual tabel database dan menerapkan pembetulan bila diperlukan.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'Pengatur';
protected $AX_TORGANIZ_D = 'Pengatur Elxis memelihara kontak, catatan, bookmark dan perjanjian Anda.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'Bersihkan Cache';
protected $AX_TCLEANCACHE_D = 'Membersihkan direktori cache dari item-item konten dan gambar yang di-cache';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'Ubah mode';
protected $AX_TCHMOD_D = 'Mengubah mode untuk file atau folder yang diberikan';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Betulkan Postgres Sequences';
protected $AX_TFPGSEQ_D = 'Membetulkan Postgres sequences jika diperlukan.';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Registrasi Elxis';
protected $AX_TELXREG_D = 'Mendaftarkan instalasi Elxis Anda ke GO UP Inc';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'Bridge';
protected $AX_BRIDGE_CDESC = 'Membuat link ke Bridge.';
//modules/mod_language.xml
protected $AX_NEW_LINE = 'Baris baru';
protected $AX_SAME_LINE = 'Baris yang sama';
protected $AX_INDICATOR = 'Indikator';
protected $AX_INDICATOR_D = 'Menampilkan kata Bahasa sebagai Indikator';
protected $AX_FLAG = 'Bendera';
//modules/mod_language.xml
protected $AX_MODLANGD = 'Menampilkan pemilih bahasa Latar-Depan sebagai daftar dropdown, link list, atau deretan bendera.';
protected $AX_FLAGS = 'Bendera';
protected $AX_SMARTSW = 'Peralihan Pintar';
protected $AX_SMARTSW_D = 'Mengijinkan Anda untuk mengganti bahasa dan tetap di halaman yang sama dalam beberapa keadaan';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'Menampilkan profil para pengguna secara acak';
protected $AX_DISPSTYLE = 'Tampilkan Gaya';
protected $AX_COMPACT = 'Sederhana';
protected $AX_EXTENDED = 'Diperluas';
protected $AX_GENDER = 'Jenis Kelamin';
protected $AX_GENDERDESC = 'Tampilkan Jenis Kelamin Pengguna?';
protected $AX_AGE = 'Usia';
protected $AX_AGEDESC = 'Tampilkan Usia Pengguna?';
protected $AX_REALUNAME = 'Tampilkan Nama Asli atau Nama Pengguna?';
//weblinks item
protected $AX_WBLI_TL = 'Target';
//content
protected $AX_RTFICL = 'Ikon RTF';
protected $AX_RTFICD = 'Tampilkan/Sembunyikan tombol RTF - hanya mempengaruhi halaman ini.';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'Grup Filter';
protected $AX_MODWHO_FILGRD = 'Jika ya, maka para pengguna dengan tingkat akses lebih rendah (misal pengunjung) tidak akan bisa melihat status masuk para pengguna dengan akses yang lebih tinggi.';
//search bots
protected $AX_SEARCH_LIMIT = 'Batas pencarian';
protected $AX_MAXNUM_SRES = 'Maksimum jumlah hasil pencarian';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'Menampilkan ringkasan tambahan situs terakhir. Ideal untuk halaman depan.'; 
protected $AX_SECTIONS = 'Seksi';
protected $AX_SECTIONSD = 'ID Seksi dipisahkan koma (,)';
protected $AX_CATEGORIES = 'Kategori';
protected $AX_CATEGORIESD = 'ID Kategori dipisahkan koma (,)';
protected $AX_NUMDAYS = 'Jumlah hari';
protected $AX_NUMDAYSD = 'Tampilkan item yang dibuat dalam X hari terakhir (nilai standarnya 900)';
protected $AX_SHOWTHUMBS = 'Tampilkan thumbnail';
protected $AX_SHOWTHUMBSD = 'Tampilkan/Sembunyikan gambar thumbnail dalam teks intro';
protected $AX_THUMBWIDTHD = 'Panjang gambar thumbnail dalam pixel';
protected $AX_THUMBHEIGHTD = 'Tinggi gambar thumbnail dalam pixel';
protected $AX_KEEPRATIO = 'Jaga rasio';
protected $AX_KEEPRATIOD = 'Tahan rasio aspek gambar. Jika Ya, maka parameter tinggi di atas tidak berpengaruh.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'Item eBlog';
protected $AX_EBLOGITEMD = 'Membuat link ke blog eBlog yang diterbitkan';
//2009.0
protected $AX_COMMENTARY = 'Komentar';
protected $AX_COMMENTARYD = 'Pilih siapa yang diijinkan untuk mengomentari artikel ini.';
protected $AX_NOONE = 'Tak seorangpun';
protected $AX_REGUSERS = 'Pengguna terdaftar';
protected $AX_ALL = 'Semu8a';
protected $AX_COMMENTS = 'Komentar';
protected $AX_COMMENTSD = 'Tampilkan jumlah komentar?';

}

?>