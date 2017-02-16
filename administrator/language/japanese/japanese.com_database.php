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
* @description: Japanese language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'テーブル名';
public $A_CMP_DB_ACTIONS = '操作'; //Actions
public $A_CMP_DB_TDESCR = 'テーブル説明';
public $A_CMP_DB_BROWSE = '見る'; // Browse
public $A_CMP_DB_STRUCTURE = '構造';
public $A_CMP_DB_INFO = '情報';
public $A_CMP_DB_DUMPDB = 'データベースのダンプ'; //Dump Database
public $A_CMP_DB_XDUMPDB = 'XML/SQLデータベースのダンプ'; //XML/SQL Database Dump';
public $A_CMP_DB_BACTYPE = 'バックアップタイプ';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'XMLバックアップの作成';
public $A_CMP_DB_XFULL = '構造とデータ';
public $A_CMP_DB_XSTRUONL = '構造のみ';
public $A_CMP_DB_XSAVSERV = 'サーバ上に保存';
public $A_CMP_DB_DOWNLD = 'ダウンロード';
public $A_CMP_DB_XMLBACK = 'XMLバックアップ';
public $A_CMP_DB_SCRBACK = 'SQLバックアップの作成';
public $A_CMP_DB_SFULL = '構造とデータ';
public $A_CMP_DB_SDATAONL = 'データのみ';
public $A_CMP_DB_SLOCTBL = 'テーブルのロック';
public $A_CMP_DB_SFSYNTX = '全ての構文';
public $A_CMP_DB_SDRTBL = 'テーブルの削除'; // Drop Table
public $A_CMP_DB_STBLS = 'テーブル';
public $A_CMP_DB_ATBLS = '全て';
public $A_CMP_DB_SELTBLS = '選択した物';
public $A_CMP_DB_SQLBACK = 'SQLバックアップ';
public $A_CMP_DB_TDESC = 'テーブル説明';
public $A_CMP_DB_CLNAME = 'カラム名';
public $A_CMP_DB_CLTYPE = 'カラムタイプ';
public $A_CMP_DB_ADOTYPE = 'ADOdbタイプ';
public $A_CMP_DB_MAXLEN = '最大長';
public $A_CMP_DB_BRTBL = 'テーブルを見る'; //Browse Table
public $A_CMP_DB_BCKDB = 'データベースへ戻る';
public $A_CMP_DB_DBTYPE = 'データベースのタイプ';
public $A_CMP_DB_DBDESCR = 'データベースの説明';
public $A_CMP_DB_DBVER = 'データベースのバージョン';
public $A_CMP_DB_DBHOST = 'データベースのホスト';
public $A_CMP_DB_DBNAME = 'データベース名';
public $A_CMP_DB_DBUSER = 'ユーザ';
public $A_CMP_DB_DBERRF = 'Raise Error FN';
public $A_CMP_DB_DBDBG = 'デバッグ';
public $A_CMP_DB_TBLSTR = 'テーブル構造';
public $A_CMP_DB_DBBACK = 'データベースのバックアップ';
public $A_CMP_DB_NOEXISTS = 'バックアップは存在しません';
public $A_CMP_DB_FOOTER= "<u>注</u>: ファイルを右クリックして「対象をファイルに保存」でダウンロードできます。<strong>注意</strong>: ファイルはUTF-8でエンコードされています。";
public $A_CMP_DB_DBMONIT = 'データベースモニタ';
public $A_CMP_DB_TBLNOT = 'テーブルは存在しません！';
public $A_CMP_DB_BACKSUCC = 'データベースのバックアップの作成に成功しました';
public $A_CMP_DB_NOTSUPPO = 'SQLのダンプは次のデータベースでサポートしていません:'; //SQL Dump is not supported for
public $A_CMP_DB_NOTBLSEL = 'テーブルが選択されていません！';
public $A_CMP_DB_NOTDWNL = 'SQLダンプを作成/ダウンロードできませんでした';
public $A_CMP_DB_NOTCRSV = 'SQLダンプを作成/保存できませんでした';
public $A_CMP_DB_DUMPSUCC = 'SQLダンプの作成に成功しました';
public $A_CMP_DB_DTUNKN = '不明'; // Translate as: Unknown Date
public $A_CMP_DB_TXMLSCHEM = 'XMLスキーマ';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = '不明'; // Translate as: Unknown Type
public $A_CMP_DB_UNKOWN = '不明'; // Translate as: Unknown Size
public $A_CMP_DB_NOFSELDEL = '削除するファイルが選択されていません！'; //No file selected to delete!
public $A_CMP_DB_FSDELETED = 'ファイルの削除に成功しました';
public $A_CMP_DB_FDELETED = 'ファイルの削除に成功しました';
public $A_CMP_DB_TLMANBACK = 'バックアップ管理';
public $A_CMP_DB_TLDELSLBCK = '選択したバックアップの削除';
public $A_CMP_DB_TLNEWFXML = '新しいXMLフルバックアップ';
public $A_CMP_DB_TLNEWFSQL = '新しいSQLフルバックアップ';
public $A_CMP_DB_MAINTEN = 'メンテナンス';
public $A_CMP_DB_MAINTEND = 'データベースメンテナンス';
public $A_CMP_DB_OPTIM = '最適化';
public $A_CMP_DB_REPAIR = '修復';
public $A_CMP_DB_TBLOPTED = 'テーブルが最適化されました';
public $A_CMP_DB_FRUOPTINCP = '<strong>最適化</strong>を頻繁にすることで、データベースのパフォーマンスを向上させます。';
public $A_CMP_DB_RRERRDBTAB = '<strong>修復</strong>はデータベーステーブルのどんな既存のエラーも修復します。';
public $A_CMP_DB_FAVMYSQL = 'この機能はMySQLデータベースでのみ利用可能です！';
public $A_CMP_DB_TBLREPED = 'テーブルが修復されました';
public $A_CMP_DB_SIZE = 'サイズ';

}

?>
