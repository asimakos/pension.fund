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
* @description: Indonesian language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'Nama Tabel';
public $A_CMP_DB_ACTIONS = 'Aksi';
public $A_CMP_DB_TDESCR = 'Deskripsi Tabel';
public $A_CMP_DB_BROWSE = 'Browse';
public $A_CMP_DB_STRUCTURE = 'Struktur';
public $A_CMP_DB_INFO = 'Informasi';
public $A_CMP_DB_DUMPDB = 'Dump Database';
public $A_CMP_DB_XDUMPDB = 'XML/SQL Database Dump';
public $A_CMP_DB_BACTYPE = 'Tipe Backup';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'Buat XML Backup';
public $A_CMP_DB_XFULL = 'Struktur &amp; Data';
public $A_CMP_DB_XSTRUONL = 'Hanya Struktur';
public $A_CMP_DB_XSAVSERV = 'Simpan pada Server';
public $A_CMP_DB_DOWNLD = 'Download';
public $A_CMP_DB_XMLBACK = 'XML Backup';
public $A_CMP_DB_SCRBACK = 'Buat SQL Backup';
public $A_CMP_DB_SFULL = 'Struktur &amp; Data';
public $A_CMP_DB_SDATAONL = 'Hanya Data';
public $A_CMP_DB_SLOCTBL = 'Kunci Tabel';
public $A_CMP_DB_SFSYNTX = 'Sintaks Lengkap';
public $A_CMP_DB_SDRTBL = 'Buang Tabel';
public $A_CMP_DB_STBLS = 'Tabel';
public $A_CMP_DB_ATBLS = 'Semua';
public $A_CMP_DB_SELTBLS = 'Dipilih';
public $A_CMP_DB_SQLBACK = 'SQL Backup';
public $A_CMP_DB_TDESC = 'Deskripsi Tabel';
public $A_CMP_DB_CLNAME = 'Nama Kolom';
public $A_CMP_DB_CLTYPE = 'Tipe Kolom';
public $A_CMP_DB_ADOTYPE = 'Tipe ADOdb';
public $A_CMP_DB_MAXLEN = 'Panjang Maks';
public $A_CMP_DB_BRTBL = 'Browse Tabel';
public $A_CMP_DB_BCKDB = 'Kembali ke Database';
public $A_CMP_DB_DBTYPE = 'Tipe Database';
public $A_CMP_DB_DBDESCR = 'Deskripsi Database';
public $A_CMP_DB_DBVER = 'Versi Database';
public $A_CMP_DB_DBHOST = 'Host Database';
public $A_CMP_DB_DBNAME = 'Nama Database';
public $A_CMP_DB_DBUSER = 'Pengguna ';
public $A_CMP_DB_DBERRF = 'Munculkan Kesalahan FN';
public $A_CMP_DB_DBDBG = 'Debug';
public $A_CMP_DB_TBLSTR = 'Struktur Tabel';
public $A_CMP_DB_DBBACK = 'Database Backup';
public $A_CMP_DB_NOEXISTS = 'Tidak ada Backup';
public $A_CMP_DB_FOOTER= "<u>Catatan</u>: Klik-kanan nama file dan pilih 'Save Target as' untuk di-download. <strong>Perhatian</strong>: File dikodekan UTF-8.";
public $A_CMP_DB_DBMONIT = 'Monitor Database';
public $A_CMP_DB_TBLNOT = 'Tabel tidak ada!';
public $A_CMP_DB_BACKSUCC = 'Database backup sukses dibuat';
public $A_CMP_DB_NOTSUPPO = 'SQL Dump tidak didukung untuk';
public $A_CMP_DB_NOTBLSEL = 'Tidak ada tabel yang dipilih!';
public $A_CMP_DB_NOTDWNL = 'Tidak bisa membuat/download SQL Dump';
public $A_CMP_DB_NOTCRSV = 'Tidak bisa membuat/menyimpan SQL Dump';
public $A_CMP_DB_DUMPSUCC = 'SQL dump sukses dibuat';
public $A_CMP_DB_DTUNKN = 'Tanggal Tidak Dikenal'; // Translate as: Unknown Date
public $A_CMP_DB_TXMLSCHEM = 'Skema XML';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = 'Tipe Tidak Dikenal'; // Translate as: Unknown Type
public $A_CMP_DB_UNKOWN = 'Ukuran Tidak Dikenal'; // Translate as: Unknown Size
public $A_CMP_DB_NOFSELDEL = 'Tidak ada file yang dipilih untuk dihapus!';
public $A_CMP_DB_FSDELETED = 'file sukses dihapus';
public $A_CMP_DB_FDELETED = 'File sukses dihapus';
public $A_CMP_DB_TLMANBACK = 'Atur Backup';
public $A_CMP_DB_TLDELSLBCK = 'Hapus Backups yang Dipilih';
public $A_CMP_DB_TLNEWFXML = 'Backup XML Lengkap Baru';
public $A_CMP_DB_TLNEWFSQL = 'Backup SQL Lengkap Baru';
public $A_CMP_DB_MAINTEN = 'Pemeliharaan';
public $A_CMP_DB_MAINTEND = 'Pemeliharaan Database';
public $A_CMP_DB_OPTIM = 'Optimasi';
public $A_CMP_DB_REPAIR = 'Betulkan';
public $A_CMP_DB_TBLOPTED = 'tabel dioptimasi';
public $A_CMP_DB_FRUOPTINCP = 'Penggunaan berkala <strong>optimasi</strong>, meningkatkan performansi database.';
public $A_CMP_DB_RRERRDBTAB = '<strong>Betulkan</strong>, membetulkan setiap kesalahan dalam tabel database.';
public $A_CMP_DB_FAVMYSQL = 'Fitur ini hanya tersedia untuk database MySQL!';
public $A_CMP_DB_TBLREPED = 'tabel dibetulkan';
public $A_CMP_DB_SIZE = 'Ukuran';

}

?>
