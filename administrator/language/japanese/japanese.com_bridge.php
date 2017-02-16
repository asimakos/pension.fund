<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: momo-i
* @link: http://www.elxis.jp
* @email: webmaster@elxis.jp
* @description: Japanese language for component bridge
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class adminLanguage extends standardLanguage {

public $A_CMP_BRI_SYSDISABLED = 'ブリッジシステムは無効です！';
public $A_CMP_BRI_INVBRIDGE = '不正なブリッジ';
public $A_CMP_BRI_BRISUCPUB = 'ブリッジの公開に成功しました';
public $A_CMP_BRI_BRISUCUNPUB = 'ブリッジの非公開に成功しました';
public $A_CMP_BRI_CNOTPUBBRI = 'ブリッジを公開にできませんでした';
public $A_CMP_BRI_CNOTUNPUBRI = 'ブリッジを非公開にできませんでした';
public $A_CMP_BRI_CNOTSAVESETS = '設定を保存できませんでした！';
public $A_CMP_BRI_UNPUBBRIFIRST = 'はじめにブリッジを非公開にしてください！';
public $A_CMP_BRI_BRIUNISTSUC = 'ブリッジのアンインストールに成功しました';
public $A_CMP_BRI_CNOTUNISTBRI = 'ブリッジをアンインストールできませんでした。ブリッジフォルダの権限を確認してください。';
public $A_CMP_BRI_CNOTDETREGV = '現在のレジストリバージョンを決定できませんでした！'; //Could not determine current registry version!
public $A_CMP_BRI_CNOTUPDREG = 'レジストリを更新できませんでした！';
public $A_CMP_BRI_REGSUCUPTO = 'レジストリバージョンの更新に成功しました';
public $A_CMP_BRI_REGINIUNWR = 'registry.iniは書込み不可です！';
public $A_CMP_BRI_REGUPTODATE = 'レジストリは既に更新されています！';
public $A_CMP_BRI_BRIUNPUB = 'ブリッジは非公開です！';
public $A_CMP_BRI_CNOTLOCXML = 'ブリッジXMLファイルを置けませんでした！';
public $A_CMP_BRI_BNOTHAVECFI = 'ブリッジ%sの設定ファイルがありません';
public $A_CMP_BRI_BNOTHAVECPA = 'ブリッジ%sの設定パラメータがありません！';
public $A_CMP_BRI_DETINVPARAMS = '不正なパラメータを検出しました！';
public $A_CMP_BRI_INSTBRI = 'インストール済みブリッジ';
public $A_CMP_BRI_SYSENABLED = 'ブリッジシステムは有効です';
public $A_CMP_BRI_REGVERSION = 'レジストリバージョン';
public $A_CMP_BRI_DETREGERRUP = 'レジストリエラーを検出しました。ブリッジレジストリを更新してください！';
public $A_CMP_BRI_UPDATE = '更新';
public $A_CMP_BRI_REGERR = 'レジストリエラー';
public $A_CMP_BRI_LICENSE = 'ライセンス';
public $A_CMP_BRI_UNIST = 'アンインストール';
public $A_CMP_BRI_DISBRISYS = 'ブリッジシステムを無効にする';
public $A_CMP_BRI_ENBRISYS = 'ブリッジシステムを有効にする';
public $A_CMP_BRI_REGMOD = '登録モジュール';
public $A_CMP_BRI_REGMODHELP = 'プライマリのユーザログイン/登録システムとして使用したいアプリケーションを選択します。';
public $A_CMP_BRI_REGMODHELP2 = 'Elxisと公開済みブリッジの間を選択できます。';
public $A_CMP_BRI_REGMODHELP3 = 'いくつかのブリッジはユーザログイン/登録手続きをすることができません。';
public $A_CMP_BRI_REGMODHELP4 = 'クラシックなものに代わってブリッジされたログインモジュールを使用することを忘れないでください';
public $A_CMP_BRI_NOTE = '注意';

}

?>
