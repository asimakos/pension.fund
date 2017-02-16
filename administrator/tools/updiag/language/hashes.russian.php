<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Coursar
* @ Translator URL: http://www.elxis.ru
* # Translator E-mail: info@elxis.ru
* @ Description: Russian language for Updiag tool (hashes help)
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );

?>

<p align="justify">Хэш является уникальным отпечатком файла. Он позволяет обнаружить даже малозаметные изменения файла.
Таким образом, мы можем определить, что файлы Elxis не нарушены или доступны обновления некоторых файлов, после обновления/патча.
Хэши помогают восстановить Elxis сайт после атаки хакеров или других изменений файловой системы Elxis.
В Elxis мы используем специальный метод расчёта MD5 хэшей.
Так, для каждого файла Elxis существует два хэша. Если сравнение первого хеша даёт ошибку, мы проверяем второй хэш.
Если сравнение второго хэша тоже выдаёт ошибку, значит Elxis файл был изменён.</p>

<p align="justify">Для каждой версии Elxis существует 3 хэш файла <b>обычный</b> (идеальный для функциональных сайтов),
<b>расширенный</b> (идеально подходит для сайтов, сразу же после чистой установки Elxis) и <b>полный</b> (полезно только
для особых целей ). <u>Вы должны использовать нормальный хэш файл для функционирующих он-лайн сайтов.</u>
Только <b>Elxis Team</b> создаёт верные хэш файлы для Elxis. Не используйте другие хэш файлы.
Не изменяйте и не переименовывайте хэш файлы. Вы можете загрузить хэш файлы для вашей версии Elxis
с сайта <a href="http://www.elxis.org" target="blank">elxis.org</a>.</p>

<p align="justify">Для установки хэш файлов просто закачайте их в хэш каталог (/administrator/tool/updiag/data/hashes).
Вы можете выполнить проверку целостности файловой системы в любой момент, нажав кнопку "Выполнить".</p>
