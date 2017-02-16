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
* @ Description: Japanese language for Defender tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


DEFINE ('_DEFL_CONFIG', 'Elxisディフェンダー設定');
DEFINE ('_DEFL_CONFPERMSUCC', 'ディフェンダー設定ファイルの権限を次に設定しました:'); //Defender configuration file permissions set successfully to
DEFINE ('_DEFL_CONFPERMNO', 'ディフェンダー設定ファイルを書込可能にすることができませんでした');
DEFINE ('_DEFL_LOGSPERMSUCC', 'ディフェンダーログディレクトリの権限を次に設定しました:'); //Defender logs directory permissions set successfully to
DEFINE ('_DEFL_LOGSPERMNO', 'ディフェンダーログディレクトリを書込可能にすることができませんでした');
DEFINE ('_DEFL_ENABLEDESC', 'ディフェンダーを有効にするかどうか(有効にする前に/administrator/tools/defender/logsディレクトリを書込可能にしてください)');
DEFINE ('_DEFL_PROTVARS', '保護された変数');
DEFINE ('_DEFL_PROTVARSD', '保護される変数のタイプを選択(デフォルト: REQUEST)');
DEFINE ('_DEFL_LOGATTACKS', 'アタックの記録'); //Log Attacks
DEFINE ('_DEFL_LOGATTACKSD', '有効な場合、ディフェンダーはどんなアタックのレポートも作成、記録します。');
DEFINE ('_DEFL_MAILALERT', 'メール警告'); //Mail Alert
DEFINE ('_DEFL_MAILALERTD', '有効な場合、ディフェンダーはどんなアタックもメールでアラートを送信します。');
DEFINE ('_DEFL_MAILADDR', '通知先メールアドレス');
DEFINE ('_DEFL_SITEOFFFOR', 'サイトオフライン:'); //Site Offline for');
DEFINE ('_DEFL_SECONDS', '秒');
DEFINE ('_DEFL_SITEOFFD', 'アタック後X秒でサイトをオフラインにします。無効にするには0にします');
DEFINE ('_DEFL_BLOCKIP', 'ブロックIP');
DEFINE ('_DEFL_BLOCKIPD', '攻撃者のIPアドレスをブロックします。ディフェンダーはあなた自身でさえ攻撃者として平等にみなしてブロックすることに注意してください！');
DEFINE ('_DEFL_FILTERS', 'フィルタ');
DEFINE ('_DEFL_FILTHELP', '<strong>Elxisディフェンダーはフィルタ無しでは役に立ちません。</b><br />
	新しいフィルタを追加するには、<b>追加</b>をクリックして追加したフィールドにフィルタアウトしたい単語かフレーズを入力します。<br />
	わざわざ大文字や小文字で書く必要はありません。<br />
	一覧からフィルタを削除するには<b>削除</b>を押します。<br />
	Apacheの<b>mod_security</b>に精通しているなら、フィルタを追加する場合、Elxisディフェンダーは多かれ少なかれ同様の方法で
	機能することを覚えて置いてください。<br />
	終わったら、ディフェンダーの設定とフィルタを保存するために<b>保存</b>をクリックします。<br/>');
DEFINE ('_DEFL_SLOWDOWNT', 'スローダウン時間'); //Slow-down Time
DEFINE ('_DEFL_SLOWDOWN', 'ディフェンダーの使用は通常より遅くElxisを動作させます。
	大量のフィルタを追加することは同じくらいphpの実行時間が増えるかもしれません。15個以上のフィルタを追加しないことをお勧めしますが、
	さらにそれはウェブサイトとサーバに依存すると共に、これで確認することをお勧めします。
	苦労をしているならヘルプとは別に呼び出します。
	私たちのラボテストではフィルタ数(10以上から30まで)に依存して0.1から27ミリ秒のスローダウン時間と、ディフェンダーが対処しなければ
	ならなかった入力変数(通常のブラウズからPOST又はGETメソッドを経由して大きな記事を送信する)の数に依存することが示しました。');
DEFINE ('_DEFL_EXAMPLEFIL', 'フィルタ例');
DEFINE ('_DEFL_DEFCONFIS', 'ディフェンダー設定ファイルは');
DEFINE ('_DEFL_DEFLOGSIS', 'ディフェンダーログディレクトリは');
DEFINE ('_DEFL_MAKEWRITE', 'それを書込可能にします'); //Make it writable
DEFINE ('_DEFL_CONFSAVESUCC', 'ディフェンダー設定の保存に成功しました！');
DEFINE ('_DEFL_CONFSAVENO', 'ディフェンダー設定を保存できませんでした！');
DEFINE ('_DEFL_ERRONEFILT', 'エラー: 少なくとも1つのフィルタを追加してください！');
DEFINE ('_DEFL_ENCKEY', '暗号鍵'); //Encryption Key
DEFINE ('_DEFL_ENCKEYD', '暗号化したログ情報に使用されます。鍵の長さは8から32文字の間でなければなりません。暗号鍵を変更する前に全てのログ情報を削除してください！');
DEFINE ('_DEFL_ERRENCKEY', 'エラー: 暗号鍵の長さは8から32文字の間でなければなりません！');
DEFINE ('_DEFL_ENABLEDEF', 'ディフェンダーを有効にする');
DEFINE ('_DEFL_DISABLEDEF', 'ディフェンダーを無効にする');
DEFINE ('_DEFL_VIEWLOGS', 'ログの閲覧');
DEFINE ('_DEFL_CLEARLOGS', 'ログのクリア');
DEFINE ('_DEFL_VIEWBLOCK', 'ブロックされたIPの閲覧');
DEFINE ('_DEFL_CLEARBLOCK', 'ブロックされたIPのクリア');
DEFINE ('_DEFL_DEFENDER', 'Elxisディフェンダー');
DEFINE ('_DEFL_LOGSCLEARED', 'ログをクリアしました');
DEFINE ('_DEFL_CNOTCLLOGS', 'ログをクリアできませんでした。ファイルが書込み可能かを確認してください。');
DEFINE ('_DEFL_BLOCKCLEARED', '全てのブロックされたIPアドレスの削除に成功しました');
DEFINE ('_DEFL_CNOTCLBLOCK', 'ブロックされたIPアドレスをクリアできませんでした。ファイルが書込み可能かを確認してください。');
DEFINE ('_DEFL_SUBMITALERT', 'ディフェンダーが有効な間に送信しているフィルタはアタックとしてみなされます！最初にディフェンダーを無効にして変更後に再度有効にしてください。');
DEFINE ('_DEFL_GEOLOCATE', 'Geo Locate');
DEFINE ('_DEFL_PERMSUCC', 'パーミッションを次へ変更しました:'); //Permissions changed to
DEFINE ('_DEFL_PERMFAIL', '次のパーミッションを変更できませんでした:'); //Could not change permissions of
DEFINE ('_DEFL_ADDIP', 'IPを追加');
DEFINE ('_DEFL_DELETEIP', 'IPを削除');
DEFINE ('_DEFL_BLOCKEDIPS', 'ブロックされたIP');
DEFINE ('_DEFL_IPRANGES', 'IPの範囲');
DEFINE ('_DEFL_ADDRANGE', 'IPの範囲を追加');
DEFINE ('_DEFL_DELRANGE', 'IPの範囲を削除');
DEFINE ('_DEFL_RANGEHELP', '全体のネットワーク、ISP又は国さえもブロックするためにIPの範囲を追加するオプションをディフェンダーは与えます。
	各範囲はアンダースコア「_」で区切られた2つのものからなります。最初の部分はIPアドレスの開始であり、
	2番目はIPアドレスの終わりです。ディフェンダーはこれらの2つの間の値にある全てのIPをブロックします。');
DEFINE ('_DEFL_RANGEEXAMPLES', '使い方の例');
DEFINE ('_DEFL_BLOCKFROM', 'は次からIPをブロックします:'); //will block IPs from
DEFINE ('_DEFL_BLOCKTO', 'to');
DEFINE ('_DEFL_ALLOWIPS', '許可されたIPアドレス'); //Allowed IP addresses
DEFINE ('_DEFL_ALLOWIPSD', '有効な場合、サイトのバックエンド及び(又は)フロントエンドへアクセスすることを許可されただけのIPアドレスを設定することができます');
DEFINE ('_DEFL_FRONTBACK', 'フロントエンドと管理です。'); //Frontend and Admin.
DEFINE ('_DEFL_ALLOWDIS', '許可されたIPは無効です'); //Allowed IPs is disabled
DEFINE ('_DEFL_ONLACCADM', '以下のIPアドレスのみ管理へアクセスできます'); //Only the IP addresses bellow have access to Administration
DEFINE ('_DEFL_ONLACCSAD', '以下のIPアドレスのみサイトのフロントエンドと管理へアクセスできます'); //Only the IP addresses bellow have access to Site Frontend and Administration

?>
