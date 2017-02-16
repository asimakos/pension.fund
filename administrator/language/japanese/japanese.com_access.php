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
* @description: Japanese language for component access manager
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class adminLanguage extends standardLanguage {

public $A_CMP_ACC_GROUP = 'グループ';
public $A_CMP_ACC_GRUSR = 'ユーザ数';
public $A_CMP_ACC_BCKASS = 'バックエンドアクセス';
public $A_CMP_ACC_PHREN = 'リネームするには押したままにします'; //Press and hold to Rename
public $A_CMP_ACC_GRHIE = 'グループ階層';
public $A_CMP_ACC_GGRNM = 'グループ名が必要です';
public $A_CMP_ACC_GGNSO = '選択した親グループは選択できるオプションがありません';
public $A_CMP_ACC_MANG = 'グループ管理';
public $A_CMP_ACC_GDTL = 'グループ詳細';
public $A_CMP_ACC_GNAME = 'グループ名';
public $A_CMP_ACC_PRGR = '親グループ';
public $A_CMP_ACC_EXUG = '既存のユーザグループ';
public $A_CMP_ACC_PRMFOR = '権限の設定:'; //Permissions for
public $A_CMP_ACC_ACO = 'ACO';
public $A_CMP_ACC_ACOV = 'ACO 値';
public $A_CMP_ACC_AXO = 'AXO';
public $A_CMP_ACC_AXOV = 'AXO 値';
public $A_CMP_ACC_ADNP = '新しい権限の追加';
public $A_CMP_ACC_ARO = 'ARO';
public $A_CMP_ACC_AROV = 'ARO 値';
public $A_CMP_ACC_SEL = '-選択-';
public $A_CMP_ACC_ACT = '操作';
public $A_CMP_ACC_ADM = '管理';
public $A_CMP_ACC_WKF = 'ワークフロー';
public $A_CMP_ACC_YMSGR = 'リネームするグループを指定してください';
public $A_CMP_ACC_TSAGN = 'グループ名は既にあります';
public $A_CMP_ACC_YANARG = 'このグループをリネームする許可がありません！';
public $A_CMP_ACC_CNUTACL = '_core_acl_aro_groupsテーブルを更新できませんでした';
public $A_CMP_ACC_CNUTUS = '_usersテーブルを更新できませんでした';
public $A_CMP_ACC_CNUTCAL = '_core_acl_access_listsテーブルを更新できませんでした';
public $A_CMP_ACC_YHTLA = 'ログインしなおしてください！';
public $A_CMP_ACC_MFS = 'サーバからのメッセージ';
public $A_CMP_ACC_WID = '次のIDで'; //with id
public $A_CMP_ACC_UGWID = '次のIDでグループを使用:'; //Use Group with id
public $A_CMP_ACC_RNMTO = '次へリネームされました:'; //renamed to
public $A_CMP_ACC_YCNEDGR = 'このグループを編集する許可がありません！';
public $A_CMP_ACC_YMSPNGR = 'グループ名が必要です';
public $A_CMP_ACC_IPGR = '不正な親グループ';
public $A_CMP_ACC_YCCGPY = 'あなたのグループへの親グループを作成できません！'; //You Cannot Create a Group, parent to yours group!
public $A_CMP_ACC_YCNUSGR = '親としてそのグループを使用する許可がありません！'; //You are Not Allowed to Use that Group as Parent!
public $A_CMP_ACC_TIAGTN = 'この名前で別のグループがあります！';
public $A_CMP_ACC_GADDSUC = '次のIDのグループの追加に成功しました:'; //Group Added Successfully with id
public $A_CMP_ACC_CNADDNG = '新しいグループを追加できませんでした。';
public $A_CMP_ACC_THGRP = 'グループ';
public $A_CMP_ACC_UPSUCC = '更新に成功しました';
public $A_CMP_ACC_CNUPGR = 'グループを更新できませんでした';
public $A_CMP_ACC_GESLAG = 'グループの編集に成功しましたが、ログインしなおす必要があります！';
public $A_CMP_ACC_NGSDEL = '削除するグループが選択されていません';
public $A_CMP_ACC_YCNDELG = 'このグループは削除できません！';
public $A_CMP_ACC_YANALDG = 'このグループを削除する許可がありません！';
public $A_CMP_ACC_CNDLGR = 'グループを削除できませんでした';
public $A_CMP_ACC_GRSDEL = 'グループの削除に成功しました';
public $A_CMP_ACC_BCNDGP = 'がグループ権限を削除できませんでした！';
public $A_CMP_ACC_BCNDUS = 'がユーザを削除できませんでした！';
public $A_CMP_ACC_NOGRSEL = 'グループが選択されていません！';
public $A_CMP_ACC_PERMADD = '次の権限の追加に成功しました:'; //Permission Added Successfully for
public $A_CMP_ACC_PERDSUC = '権限の削除に成功しました';
public $A_CMP_ACC_CNDELPER = '権限を削除できませんでした！';
public $A_CMP_ACC_PERMEXIST = '権限は既に存在します！';
public $A_CMP_ACC_TEDITGR = 'グループの編集';
public $A_CMP_ACC_TGUPALD = 'グループユーザと権限も削除されました！';
public $A_CMP_ACC_TEDITPR = '権限の編集';
public $A_CMP_ACC_VIEW = '閲覧';
public $A_CMP_ACC_UPLOAD = 'アップロード';
public $A_CMP_ACC_CONTENT = 'コンテンツ';
public $A_CMP_ACC_OWN = '個人'; //Own
public $A_CMP_ACC_PROF = 'プロフィール';
public $A_CMP_ACC_FILES = 'ファイル';
public $A_CMP_ACC_AVATARS = 'アバター';
public $A_CMP_ACC_MANAGE = '管理';
public $A_CMP_ACC_USERP = 'プロパティ'; //User properties

}

?>
