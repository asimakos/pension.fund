<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Mustafa Aydemir
* @link: http://www.elxisturkiye.org
* @email: ahdes@elxisturkiye.org
* @description: Turkish language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Bu alana doğrudan erişim engellenmiştir.' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'Tablo Adı';
public $A_CMP_DB_ACTIONS = 'Eylemler';
public $A_CMP_DB_TDESCR = 'Tablo Tanımları';
public $A_CMP_DB_BROWSE = 'Tarama';
public $A_CMP_DB_STRUCTURE = 'Yapı';
public $A_CMP_DB_INFO = 'Bilgi';
public $A_CMP_DB_DUMPDB = 'Veritabanı Dump';
public $A_CMP_DB_XDUMPDB = 'XML/SQL Veritabanı Dump';
public $A_CMP_DB_BACTYPE = 'Yedek Türü';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'Bir XML yedeği oluştur';
public $A_CMP_DB_XFULL = 'Structure &amp; Data';
public $A_CMP_DB_XSTRUONL = 'Sadece Yapı';
public $A_CMP_DB_XSAVSERV = 'Sunucuda Kaydet';
public $A_CMP_DB_DOWNLD = 'İndir';
public $A_CMP_DB_XMLBACK = 'XML Yedek';
public $A_CMP_DB_SCRBACK = 'Bir SQL yedeği oluştur';
public $A_CMP_DB_SFULL = 'Yapı &amp; Veri';
public $A_CMP_DB_SDATAONL = 'Sadece Veri';
public $A_CMP_DB_SLOCTBL = 'Tablo Kitle';
public $A_CMP_DB_SFSYNTX = 'Tam söz dizimi';
public $A_CMP_DB_SDRTBL = 'Drop Table';
public $A_CMP_DB_STBLS = 'Tables';
public $A_CMP_DB_ATBLS = 'Hepsi';
public $A_CMP_DB_SELTBLS = 'Seçilen';
public $A_CMP_DB_SQLBACK = 'SQL Yedek';
public $A_CMP_DB_TDESC = 'Tablo Tanımlama';
public $A_CMP_DB_CLNAME = 'Sütun Adı';
public $A_CMP_DB_CLTYPE = 'Sütun Tipi';
public $A_CMP_DB_ADOTYPE = 'ADOdb Type';
public $A_CMP_DB_MAXLEN = 'Azami Uzunluk';
public $A_CMP_DB_BRTBL = 'Browse Table';
public $A_CMP_DB_BCKDB = 'Back to DataBase';
public $A_CMP_DB_DBTYPE = 'Veritabanı Türü';
public $A_CMP_DB_DBDESCR = 'Veritabanı Tanımlama';
public $A_CMP_DB_DBVER = 'Veritabanı Sürümü';
public $A_CMP_DB_DBHOST = 'Veritabanı Sunucusu';
public $A_CMP_DB_DBNAME = 'Veritabanı Adı';
public $A_CMP_DB_DBUSER = 'Kullanıcı';
public $A_CMP_DB_DBERRF = 'Raise Error FN';
public $A_CMP_DB_DBDBG = 'Hata';
public $A_CMP_DB_TBLSTR = 'Tablo Yapısı';
public $A_CMP_DB_DBBACK = 'Veritabanı Yedeği';
public $A_CMP_DB_NOEXISTS = 'No Backups exist';
public $A_CMP_DB_FOOTER= "<u>Note</u>: Right-click a filename and select 'Save Target as' to download. <strong>Attention</strong>: UTF-8 dosyalar.";
public $A_CMP_DB_DBMONIT = 'Database Monitor';
public $A_CMP_DB_TBLNOT = 'Tablo Bulunamadı!';
public $A_CMP_DB_BACKSUCC = 'Veritabanı yedeği başarıyla oluşturuldu';
public $A_CMP_DB_NOTSUPPO = 'SQL Dump is not supported for';
public $A_CMP_DB_NOTBLSEL = 'No table selected!';
public $A_CMP_DB_NOTDWNL = 'Could not create/download SQL Dump';
public $A_CMP_DB_NOTCRSV = 'Could not create/save SQL Dump';
public $A_CMP_DB_DUMPSUCC = 'SQL dump created successfully';
public $A_CMP_DB_DTUNKN = 'Unknown'; // Translate as: Unknown Date
public $A_CMP_DB_TXMLSCHEM = 'XML Schema';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = 'Unknown'; // Translate as: Unknown Type
public $A_CMP_DB_UNKOWN = 'Unknown'; // Translate as: Unknown Size
public $A_CMP_DB_NOFSELDEL = 'No file selected to delete!';
public $A_CMP_DB_FSDELETED = 'dosyalar başarıyla silindi';
public $A_CMP_DB_FDELETED = 'Dosya başarıyla silindi';
public $A_CMP_DB_TLMANBACK = 'Yedekleme Yöneticisi';
public $A_CMP_DB_TLDELSLBCK = 'Seçilen yedekleri sil';
public $A_CMP_DB_TLNEWFXML = 'Yeni tam XML yedeği';
public $A_CMP_DB_TLNEWFSQL = 'Yeni tam SQL yedeği';
public $A_CMP_DB_MAINTEN = 'Bakım';
public $A_CMP_DB_MAINTEND = 'Veritabanı Bakımı';
public $A_CMP_DB_OPTIM = 'Uygunlaştırma';
public $A_CMP_DB_REPAIR = 'Tamir';
public $A_CMP_DB_TBLOPTED = 'tablolar uygunlaştırıldı';
public $A_CMP_DB_FRUOPTINCP = 'Sık kullanıma <strong>uygun</strong>, artan veritabanı performansı.';
public $A_CMP_DB_RRERRDBTAB = '<strong>Tamir</strong>, tamir edilen veritabanı tablolarında her hangi bir hata yok.';
public $A_CMP_DB_FAVMYSQL = 'Bu özellik sadece MySQL veritabanları için uygundur!';
public $A_CMP_DB_TBLREPED = 'tablolar tamir edildi';
public $A_CMP_DB_SIZE = 'Ölçü';

}

?>