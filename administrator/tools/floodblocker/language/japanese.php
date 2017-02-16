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
* @ Description: Japanese language for FloodBlocker tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


DEFINE ('_FLOODL_CONFIG', 'フラッドブロッカー設定'); //FloodBlocker Configuration
DEFINE ('_FLOODL_CONFPERMSUCC', 'フラッドブロッカー設定ファイルのパーミッションを次の通り設定しました:');
DEFINE ('_FLOODL_CONFPERMNO', 'フラッドブロッカー設定ファイルを書込み可能にできませんでした');
DEFINE ('_FLOODL_LOGSPERMSUCC', 'フラッドブロッカーログディレクトリのパーミッションを次の通り設定しました:');
DEFINE ('_FLOODL_LOGSPERMNO', 'フラッドブロッカーログディレクトリを書込み可能にできませんでした');
DEFINE ('_FLOODL_INVINTER', '不正なCron間隔です！');
DEFINE ('_FLOODL_INVTIME', '不正なログタイムアウトです！'); //Invalid Logs timeout!
DEFINE ('_FLOODL_ONEPAIR', '少なくとも1つ以上の有効な間隔制限のペアが必要です！');
DEFINE ('_FLOODL_CONFSAVESUCC', 'フラッドブロッカー設定ファイルの保存に成功しました！');
DEFINE ('_FLOODL_CONFSAVENO', 'フラッドブロッカー設定ファイルを保存できませんでした！');
DEFINE ('_FLOODL_ENABLEDESC', 'フラッド保護を有効にするかどうか(有効にする前に/tools/floodblocker/logsディレクトリを書込み可能にしてください)');
DEFINE ('_FLOODL_CRONINT', 'Cron間隔');
DEFINE ('_FLOODL_CRONINTDESC', 'Cronの実行間隔(秒)です。デフォルトで1800秒(30分)です');
DEFINE ('_FLOODL_LOGSTIME', 'ログタイムアウト'); //Logs timeout
DEFINE ('_FLOODL_LOGSTIMEDESC', 'どれだけの秒数が経過したらログを古いものとして考えますか？デフォルトではファイルは7200秒(2時間)後に古いものとして考えられます。');
DEFINE ('_FLOODL_FLOODRULES', 'フラッドブロッカーのルール');
DEFINE ('_FLOODL_INTSECS', '間隔(秒)');
DEFINE ('_FLOODL_LIMREQS', '制限(リクエスト)');
DEFINE ('_FLOODL_FLOODCONFIS', 'フラッドブロッカー設定ファイルは'); //FloodBlocker configuration file is
DEFINE ('_FLOODL_FLOODLOGSIS', 'フラッドブロッカーログディレクトリは'); //FloodBlocker logs directory is
DEFINE ('_FLOODL_MAKEWRITE', 'それを書込み可能にします'); //Make it writable
DEFINE ('_FLOODL_PAIRSDESC', '{INTERVAL} => {LIMIT}形式の連想配列で、どの{LIMIT}が{INTERVAL}秒間可能なリクエストであるかです。
	お望みと同じくらい多くの組み合わせを使用します。ルールの指示:<br />
	&nbsp; &nbsp; - ルール1: 10=>10 (10秒間に最大10リクエスト)<br />
	&nbsp; &nbsp; - ルール2: 60=>30 (60秒間に最大30リクエスト)<br />
	&nbsp; &nbsp; - ルール3: 300=>50 (300秒間に最大50リクエスト)<br />
	&nbsp; &nbsp; - ルール4: 3600=>200 (1時間に最大200リクエスト)<br /><br />
	最大6ルールです。');
DEFINE ('CX_LFLOODBD', 'フラッドブロッカーはサイトへのフラッドアタックを防ぎます。');

?>
