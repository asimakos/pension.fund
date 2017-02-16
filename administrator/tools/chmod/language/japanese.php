<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: momo-i
* @ Translator URL: http://www.elxis.jp
* # Translator E-mail: webmaster@elxis.jp
* @ Description: Japanese language for Chmod tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


define('_CMOD_CHMOD', 'モードの変更');
define('_CMOD_PATH', 'パス');
define('_CMOD_MSGSERVER', 'サーバからのメッセージ');
define('_CMOD_PATHNOTEXIST', 'パスは存在しません！');
define('_CMOD_PATHNOTELXIS', '与えられたパスはElxisに属していません！');
define('_CMOD_NOTALLOWED1', '次のモードを変更する許可がありません:'); //You are not allowed to change mode to
define('_CMOD_NOTALLOWED2FI', ':ファイル<br />問題はファイルへのアクセス中に発生します。');
define('_CMOD_NOTALLOWED2FO', ':フォルダ<br />問題はフォルダへのアクセス中に発生します。');
define('_CMOD_CHMODSUCC', '次のモードの変更に成功しました:'); //Mode changed successfully to
define('_CMOD_CHMODCNOT', '次のモードの変更ができませんでした:'); //Could not change mode to
define('_CMOD_ONLYUNIX', 'UNIXでのみ利用可能'); //available only for UNIX
define('_CMOD_LOAD', 'ロード');
define('_CMOD_CHMODTO', 'モード変更:'); //Chmod to
define('_CMOD_OWNER', '所有者');
define('_CMOD_READ', '読込');
define('_CMOD_WRITE', '書込');
define('_CMOD_EXECUTE', '実行');
define('_CMOD_USER', 'ユーザ');
define('_CMOD_GROUP', 'グループ');
define('_CMOD_WORLD', 'その他'); //world
define('_CMOD_SHOWHELP', 'ヘルプを表示');
define('_CMOD_HIDEHELP', 'ヘルプを非表示');
define('_CMOD_HELPTEXT', '既存のElxisのファイル又はフォルダへのフルパスを書きます。
	既存のパスや与えられたパスの所有者を見たい場合はロードを押します。
	CHMODボタンを押すことで与えられたパスのモードを変更します。この機能はUNIXシステムでのみ利用可能です。
	<br /><br />以下の権限を使用することをお勧めします:<br />
	フォルダへの書込みを可能にする: 0777、フォルダへの書込みを不可能にする: 0755、
	ファイルへの書込みを可能にする: 0666、ファイルへの書込みを不可能にする: 0644');

?>
