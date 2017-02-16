<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Mustafa Aydemir
* @link: http://www.elxisturkiye.org
* @email: ahdes@elxisturkiye.org
* @description: Turkish language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Bu alana doğrudan erişim engellenmiştir.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Lütfen bir dizin seçin';
public $A_CMP_INS_UPF = 'Paket Dosya Yükle';
public $A_CMP_INS_PF = 'Paket Dosya';
public $A_CMP_INS_UFI = "Yükle &amp; Kur";
public $A_CMP_INS_FDIR = 'Dizinden Kur';
public $A_CMP_INS_IDIR = 'Yükleme Dizini';
public $A_CMP_INS_DOIN = 'Yükle';
public $A_CMP_INS_CONT = 'Devam...';
public $A_CMP_INS_NF = 'Yüklenecen bir öğe bulunamadı ';
public $A_CMP_INS_NA = 'Yüklenecen bir öğe bulunamadı';
public $A_CMP_INS_EFU = 'Dosya yüklemelerini açmadan kurulum devam edemez. Lütfen kurulumda dizin metodunu kullanın.';
public $A_CMP_INS_ERTL = 'Yükleyici - Hata';
public $A_CMP_INS_ERZL = 'Kurulum zlib desteği olmadan devam edemez';
public $A_CMP_INS_ERNF = 'Seçili dosya yok';
public $A_CMP_INS_ERUM = 'Yeni modül yükleme - Hata';
public $A_CMP_INS_UPTL = 'Yükle ';
public $A_CMP_INS_UPE1 = ' - Yükleme Hatası';
public $A_CMP_INS_UPE2 = ' -  Yükleme Hatası';
public $A_CMP_INS_SUCC = 'Başarılı';
public $A_CMP_INS_ER = 'Hata';
public $A_CMP_INS_ERFL = 'Başarısız';
public $A_CMP_INS_UPNW = 'Yeni Yükleme ';
public $A_CMP_INS_FP = 'Hata yazılabilirlik ayarlarını kontrol edin.';
public $A_CMP_INS_FM = 'Failed to move uploaded file to <code>/media</code> directory.';
public $A_CMP_INS_FW = 'Yükleme hatası <code>/media</code> dizini yazılabilir değil.';
public $A_CMP_INS_FE = 'Yükleme hatası <code>/media</code> dizini bulunamadı.';
public $A_CMP_INST_ERUNR = 'Unrecoverable Error';
public $A_CMP_INST_EREXT = 'Açma Hatası';
public $A_CMP_INST_ERMXM = '<strong>HATA:</strong> Elxis XML kurulum dosyası pakette bulunamadı';
public $A_CMP_INST_ERXML = '<strong>HATA:</strong> XML kurulum dosyası pakette bulunamadı';
public $A_CMP_INST_ERNFN = 'No filename specified';
public $A_CMP_INST_ERVLD = 'geçerli bir Elxis kurulum dosyası değil';
public $A_CMP_INST_ERINC = 'Method install cannot be called by class';
public $A_CMP_INST_ERUIC = 'Method uninstall cannot be called by class';
public $A_CMP_INST_ERIFN = 'Kurulum dosyası bulunamadı';
public $A_CMP_INST_ERSXM = 'XML setup file is not for a';
public $A_CMP_INST_ERCDR = 'Failed to create directory';
public $A_CMP_INST_FNOTE = 'does not exist!';
public $A_CMP_INST_TAFC = 'There is already a file called';
public $A_CMP_INST_AYIT = '- Are you trying to install the same CMT twice?';
public $A_CMP_INST_FCPF = 'Failed to copy file';
public $A_CMP_INST_CPTO = 'to';
public $A_CMP_INST_UNINSTALL = 'Kaldırma';
public $A_CMP_INST_CUDIR = 'Another component is already using directory';
public $A_CMP_INST_SQLER = 'SQL Hatası';
public $A_CMP_INST_CCPHP = 'PHP kurulum dosyası kopyalanamadı.';
public $A_CMP_INST_CCUNPHP = 'PHP kaldırma dosyası kopyalanamadı.';
public $A_CMP_INST_UNERR = 'Kaldırma -  Hatası';
public $A_CMP_INST_THCOM = 'Bileşen';
public $A_CMP_INST_ISCOR = 'is a core component, and can not be uninstalled.<br />You need to unpublish it if you don\'t want to use it';
public $A_CMP_INST_XMLINV = 'XML dosyası geçersiz';
public $A_CMP_INST_OFEMP = 'Tercih alanı boş, dosyalar taşınamaz';
public $A_CMP_INST_INCOM = 'Bileşenler Yüklendi';
public $A_CMP_INST_CURRE = 'Güncellemeler Yüklendi';
public $A_CMP_INST_MENL = 'Bileşen Menü Linki';
public $A_CMP_INST_AUURL = 'Yazar URL';
public $A_CMP_INST_NCOMP = 'There are no custom components installed';
public $A_CMP_INST_INSCO = 'Yeni bileşen kuruldu';
public $A_CMP_INST_DELE = 'Siliniyor';
public $A_CMP_INST_LIDE = 'Dil id boş, dosyalar taşınamaz';
public $A_CMP_INST_ALL = 'hepsi';
public $A_CMP_INST_BKLM = 'Back to Language Manager';
public $A_CMP_INST_NWLA = 'Yeni dil yüklendi';
public $A_CMP_INST_NFMM = 'No file is marked as bot file';
public $A_CMP_INST_MAMB = 'bot';
public $A_CMP_INST_AXST = 'already exists!';
public $A_CMP_INST_IOID = 'Invalid object id';
public $A_CMP_INST_FFEM = 'Klasör alanı boş, dosyalar taşınamaz';
public $A_CMP_INST_DXML = 'XML dosyası siliniyor';
public $A_CMP_INST_ICMO = 'is a core element, and cannot be uninstalled.<br />You need to unpublish it if you don\'t want to use it';
public $A_CMP_INST_IMBT = 'Botlar yüklendi';
public $A_CMP_INST_OMBT = 'Only those Bots that can be uninstalled are displayed - some Core Bots cannot be removed.';
public $A_CMP_INST_MBT = 'Bot';
public $A_CMP_INST_MTYP = 'Type';
public $A_CMP_INST_NMBT = 'There are no non-core, custom bots installed.';
public $A_CMP_INST_INMT = 'Yeni Botlar kuruldu';
public $A_CMP_INST_UCTP = 'Unknown client type';
public $A_CMP_INST_NFMD = 'No file is marked as module file';
public $A_CMP_INST_MODULE = 'Modül';
public $A_CMP_INST_ICMDL = 'is a core module, and can not be uninstalled.<br />You need to unpublish it if you don\'t want to use it';
public $A_CMP_INST_IMDL = 'Modüller Kuruldu';
public $A_CMP_INST_OMDL = 'Only those Modules that can be uninstalled are displayed - some Core Modules cannot be removed.';
public $A_CMP_INST_MDLF = 'Module File';
public $A_CMP_INST_NMDL = 'No custom modules installed';
public $A_CMP_INST_NWMDL = 'Install new Modules';
public $A_CMP_INST_ALLC = 'Hepsi';
public $A_CMP_INST_STMDL = 'Site Modülleri';
public $A_CMP_INST_ADMDL = 'Yönetim Modülleri';
public $A_CMP_INST_DDEX = 'Dizin bulunamadı, dosyalar taşınamaz';
public $A_CMP_INST_TIDE = 'Şablon id boş, dosyalar taşınamaz';
public $A_CMP_INST_TINS = 'Yeni şablon yükle';
public $A_CMP_INST_BATP = 'Back to Templates';
public $A_CMP_INST_INSBR = 'Yeni köprü yükle';
public $A_CMP_INST_BABR = 'Back to Bridges';
public $A_CMP_INST_ΒIDE = 'Köprü id boş, dosyalar taşınamaz';
public $A_INST_INCOM = 'Detected possible incompatibility between the Elxis version you use and the installed extension. 
Apart from that, the software may work good and without errors. This is just a notification.';
public $A_INST_INCOMJOO = 'Kurulum paketi Joomla CMS içindir!';
public $A_INST_INCOMMAM = 'Kurulum paketi Mambo CMS içindir!';
public $A_INST_OLDER = 'Installation package is for a prior Elxis version (%s) than yours (%s)';
public $A_INST_NEWER = 'Installation package is for a newer Elxis version (%s) than yours (%s)';
//2009.0
public $A_INST_DOINEDC = 'Elxis Download Merkezinden indir ve kur';
public $A_INST_FETCHAVEXTS = 'Uygun eklentilerin listesi';
public $A_INST_MORE = 'Daha çok';
public $A_INST_LESS = 'Daha az';
public $A_INST_SIZE = 'Ebat';
public $A_INST_DOWNLOAD = 'İndir';
public $A_INST_DOWNLOADS = 'İndirilenler';
public $A_INST_DOWNINST = 'İndir ve Kur';
public $A_INST_LICENSE = 'Lisans';
public $A_INST_COMPAT = 'Uyumluluk';
public $A_INST_DATESUB = 'Tarih ibraz edildi';
public $A_INST_SUREINST = '%s kurmak istediğinizden emin misiniz?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = 'Aktüel';
public $A_INST_OUTDATED = 'Modası geçmiş';
public $A_INST_INSTVERS = 'Yüklü sürüm';
public $A_INST_UNLOAD = 'Boşaltmak';
public $A_INST_EDCUPDESC = 'List of the installed third party extensions and their update status.<br />
	The information is taken live from the <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	In order for the versioning check to be successuful your web site must be able to connect to the <strong>EDC</strong> remote center.';
public $A_INST_EDCUPNOR = "Version check returned nothing.<br />
	Most probably you do not have any third party %s installed.";

}

?>