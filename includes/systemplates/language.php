<?php 
/** 
* @version: $Id: language.php 47 2010-06-09 16:47:38Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: System Templates
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info [at] elxis [dot] org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ATTENTION: THIS FILE MUST BE SAVED AS UTF-8 WITHOUT BOM
* 
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


if ($elxislang == 'greek') {
	define('ELX_SYSTPL_OFFLINE', 'Εκτός λειτουργίας');
	define('ELX_SYSTPL_OFFLINED', 'Ο ιστότοπος δεν είναι διαθέσιμος');
	define('ELX_SYSTPL_SUPLOG', 'Αν έχετε έναν λογαριασμό υπέρ-διαχειριστή συνδεθείτε παρακάτω.');
	define('ELX_SYSTPL_ERRD', 'Παρουσιάστηκε ένα σφάλμα');
	define('ELX_SYSTPL_ERRDBD', 'Παρουσιάστηκε ένα σφάλμα σχετικό με τη βάση δεδομένων');
	define('ELX_SYSTPL_ERRDB', 'Αν το πρόβλημα επιμένει ελέγξτε τα στοιχεία σύνδεσης στη βάση στο αρχείο ρυθμίσεων.');
} else if ($elxislang == 'german') {
	define('ELX_SYSTPL_OFFLINE', 'Offline');
	define('ELX_SYSTPL_OFFLINED', 'Die Webseite ist nicht verfügbar');
	define('ELX_SYSTPL_SUPLOG', 'Wenn Sie ein Super-Administrator-Konto anmelden brüllen.');
	define('ELX_SYSTPL_ERRD', 'Ein Fehler ist aufgetreten');
	define('ELX_SYSTPL_ERRDBD', 'Eine Datenbank verbundenen Fehler aufgetreten');
	define('ELX_SYSTPL_ERRDB', 'Wenn das Problem fortbesteht überprüfen Sie die Datenbank-Verbindung Einstellungen in der Konfigurationsdatei.');
} else if ($elxislang == 'french') {
	define('ELX_SYSTPL_OFFLINE', 'Offline');
	define('ELX_SYSTPL_OFFLINED', 'Le site web n est pas disponible');
	define('ELX_SYSTPL_SUPLOG', 'Si vous possédez une connexion super administrateur de compte ci-dessous.');
	define('ELX_SYSTPL_ERRD', 'Une erreur s est produite');
	define('ELX_SYSTPL_ERRDBD', 'Une base de données d erreur est survenue');
	define('ELX_SYSTPL_ERRDB', 'Si le problème persiste vérifier les paramètres de connexion de base de données dans le fichier de configuration.');
} else if ($elxislang == 'spanish') {
	define('ELX_SYSTPL_OFFLINE', 'Offline');
	define('ELX_SYSTPL_OFFLINED', 'El sitio web no está disponible');
	define('ELX_SYSTPL_SUPLOG', 'Si usted es dueño de un inicio de sesión de cuenta de administrador super abajo.');
	define('ELX_SYSTPL_ERRD', 'Se produjo un error');
	define('ELX_SYSTPL_ERRDBD', 'Una base de datos de error relacionados ocurrido');
	define('ELX_SYSTPL_ERRDB', 'Si el problema persiste comprobar la configuración de la conexión de base de datos en el archivo de configuración.');
} else if ($elxislang == 'italian') {
	define('ELX_SYSTPL_OFFLINE', 'Offline');
	define('ELX_SYSTPL_OFFLINED', 'Il sito non è disponibile');
	define('ELX_SYSTPL_SUPLOG', 'Se sei proprietario di un account come super amministratore, esegui il login qua sotto.');
	define('ELX_SYSTPL_ERRD', 'Si è verificato un errore');
	define('ELX_SYSTPL_ERRDBD', 'Si è verificato un errore al database correlato');
	define('ELX_SYSTPL_ERRDB', 'Se il problema persiste, controlla nel file di configurazione le impostazioni della connessione al databse.');
} else if ($elxislang == 'russian') {
	define('ELX_SYSTPL_OFFLINE', 'Автономном режиме');
	define('ELX_SYSTPL_OFFLINED', 'Сайт недоступен');
	define('ELX_SYSTPL_SUPLOG', 'Если у вас есть супер Логин учетной записи администратора ниже.');
	define('ELX_SYSTPL_ERRD', 'Произошла ошибка');
	define('ELX_SYSTPL_ERRDBD', 'Относящиеся к базе данных произошла ошибка');
	define('ELX_SYSTPL_ERRDB', 'Если проблема не устраняется проверить настройки соединения с базой данных в конфигурационный файл.');
} else if ($elxislang == 'srpski') {
	define('ELX_SYSTPL_OFFLINE', 'Недоступно');
	define('ELX_SYSTPL_OFFLINED', 'Сајт је недоступан');
	define('ELX_SYSTPL_SUPLOG', 'Уколико имате суперадминистраторски налог, пријавите се.');
	define('ELX_SYSTPL_ERRD', 'Дошло је до грешке');
	define('ELX_SYSTPL_ERRDBD', 'Дошло је до грешке у бази');
	define('ELX_SYSTPL_ERRDB', 'Уколико се проблем понови, проверите подешавања везе са баѕом у конфигурационом фајлу.');
} else if ($elxislang == 'serbian') {
	define('ELX_SYSTPL_OFFLINE', 'Nedostupno');
	define('ELX_SYSTPL_OFFLINED', 'Sajt je nedostupan');
	define('ELX_SYSTPL_SUPLOG', 'Ukoliko imate superadministratorski nalog, prijavite se.');
	define('ELX_SYSTPL_ERRD', 'Došlo je do greške');
	define('ELX_SYSTPL_ERRDBD', 'Došlo je do greške u bazi');
	define('ELX_SYSTPL_ERRDB', 'Ukoliko se problem ponovi, proverite podešavanja veze sa baѕom u konfiguracionom fajlu.');
} else if ($elxislang == 'turkish') {
	define('ELX_SYSTPL_OFFLINE', 'Offline');
	define('ELX_SYSTPL_OFFLINED', 'Web sitesi kullanılamaz');
	define('ELX_SYSTPL_SUPLOG', 'Eğer bir süper yönetici hesabıyla giriş feryat varsa.');
	define('ELX_SYSTPL_ERRD', 'Bir hata oluştu');
	define('ELX_SYSTPL_ERRDBD', 'Bir veri tabanı ile ilgili bir hata oluştu');
	define('ELX_SYSTPL_ERRDB', 'Problem yapılandırma dosyasında veritabanı bağlantısı ayarlarını kontrol devam ederse.');
} else if ($elxislang == 'czech') {
	define('ELX_SYSTPL_OFFLINE', 'Offline');
	define('ELX_SYSTPL_OFFLINED', 'Na webových stránkách je k dispozici');
	define('ELX_SYSTPL_SUPLOG', 'Máte-li vlastní super účtu správce přihlášení níže.');
	define('ELX_SYSTPL_ERRD', 'Došlo k chybě');
	define('ELX_SYSTPL_ERRDBD', 'Databázové chybě');
	define('ELX_SYSTPL_ERRDB', 'Pokud problém přetrvává zkontrolujte nastavení připojení k databázi v konfiguračním souboru.');
} else if ($elxislang == 'polish') {
	define('ELX_SYSTPL_OFFLINE', 'W trybie offline');
	define('ELX_SYSTPL_OFFLINED', 'Strona jest niedostępna');
	define('ELX_SYSTPL_SUPLOG', 'Jeśli posiadasz super logowania na konto administratora poniżej.');
	define('ELX_SYSTPL_ERRD', 'Wystąpił błąd');
	define('ELX_SYSTPL_ERRDBD', 'Baza danych związanych błąd');
	define('ELX_SYSTPL_ERRDB', 'Jeśli problem będzie się powtarzał należy sprawdzić ustawienia połączenia z bazą danych w pliku konfiguracyjnym.');
} else if ($elxislang == 'dutch') {
	define('ELX_SYSTPL_OFFLINE', 'Offline');
	define('ELX_SYSTPL_OFFLINED', 'De website is niet beschikbaar');
	define('ELX_SYSTPL_SUPLOG', 'Als je een super administrator account ingelogd blaten.');
	define('ELX_SYSTPL_ERRD', 'Er is een fout opgetreden');
	define('ELX_SYSTPL_ERRDBD', 'Een database gerelateerde fout opgetreden');
	define('ELX_SYSTPL_ERRDB', 'Als het probleem aanhoudt controleren van de database connectie instellingen in het configuratiebestand.');
} else if ($elxislang == 'bulgarian') {
	define('ELX_SYSTPL_OFFLINE', 'Офлайн');
	define('ELX_SYSTPL_OFFLINED', 'Уеб сайтът е недостъпен');
	define('ELX_SYSTPL_SUPLOG', 'Ако сте собственик на супер вход администраторски акаунт-долу.');
	define('ELX_SYSTPL_ERRD', 'Възникна грешка');
	define('ELX_SYSTPL_ERRDBD', 'База данни, свързани с грешка');
	define('ELX_SYSTPL_ERRDB', 'Ако проблемът продължава проверете настройките база данни връзка в конфигурационния файл.');
} else { //english
	define('ELX_SYSTPL_OFFLINE', 'Offline');
	define('ELX_SYSTPL_OFFLINED', 'The web site is unavailable');
	define('ELX_SYSTPL_SUPLOG', 'If you own a super administrator account login bellow.');
	define('ELX_SYSTPL_ERRD', 'An error occured');
	define('ELX_SYSTPL_ERRDBD', 'A database related error occured');
	define('ELX_SYSTPL_ERRDB', 'If the problem persists check the database connection settings in the configuration file.');
}

?>