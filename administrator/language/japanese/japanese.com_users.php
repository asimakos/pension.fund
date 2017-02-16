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
* @description: Japanese language for component users
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class adminLanguage extends standardLanguage {

public $A_CMP_USS_LOGIN = 'ログイン済み'; //Logged In
public $A_CMP_USS_ALL = '全て';
public $A_CMP_USS_ID = 'ユーザID';
public $A_CMP_USS_LSTV = '最終訪問'; //Last Visit
public $A_CMP_USS_ENBLD = '有効';
public $A_CMP_USS_BLCKD = 'ブロック'; //Blocked
public $A_CMP_USS_LVDATE = '%Y-%m-%d %H:%M:%S'; //Last visit Date
public $A_CMP_USS_PFISNOT = '「公開フロントエンド」は選択可能なオプションではないので別のグループを選択してください。';
public $A_CMP_USS_PBISNOT = '「公開バックエンド」は選択可能なオプションではないので別のグループを選択してください。';
public $A_CMP_USS_DETAILS = 'ユーザ詳細';
public $A_CMP_USS_EMAIL = 'メールアドレス';
public $A_CMP_USS_PASS = '新しいパスワード';
public $A_CMP_USS_VERIFY = 'パスワードの確認';
public $A_CMP_USS_BLOCK = 'ブロックユーザ';
public $A_CMP_USS_SUBMI = '送信メールを受け取る'; //Receive Submission Emails
public $A_CMP_USS_REGDATE = '登録日';
public $A_CMP_USS_VISDTE = '最終訪問日';
public $A_CMP_USS_CONTCT = '連絡先情報';
public $A_CMP_USS_NDETL = 'このユーザにリンクされた連絡先の詳細はありません：<br />詳細については「コンポーネント→r連絡先→連絡先管理」を見てください';
public $A_CMP_USS_SUCCH = 'ユーザへの変更の保存に成功しました';
public $A_CMP_USS_SUCUSR = 'ユーザの保存に成功しました';
public $A_CMP_USS_CANNOT = '最高管理者は削除できません';
public $A_CMP_USS_CANNYO = '自分自身は削除できません！';
public $A_CMP_USS_CANNUS = 'このユーザを削除するための許可がありません';
public $A_CMP_USS_SLUSER = 'ユーザを選択してください';
public $A_CMP_USS_FLGOUT = '強制ログアウト';
public $A_CMP_USS_UMUST = 'ユーザのログイン名が必要です。';
public $A_CMP_USS_ULOGIN = 'ログイン名に不正な文字列が含まれているか短すぎます。';
public $A_CMP_USS_MSTEMAIL = 'メールアドレスが必要です。';
public $A_CMP_USS_ASSIGN = 'グループへユーザを割り当てる必要があります。';
public $A_CMP_USS_NOMATC = 'パスワードが一致しません。';
public $A_CMP_USS_FLOGD = 'ログフィルタ'; //Filter Logged
public $A_CMP_USS_FACST = 'アクティブフィルタ'; //Filter Active
public $A_CMP_USS_PHONE = '電話番号';
public $A_CMP_USS_FAX = 'Fax番号';
public $A_CMP_USS_NOEXTRA = '拡張ユーザフィールドは設定されていないか公開されていません';
public $A_CMP_USS_VERTICAL = '垂直にする'; //Horizontal
public $A_CMP_USS_HORIZONT = '水平にする'; //Horizontal
public $A_CMP_USS_CHECKED = 'チェック済み'; //checked
public $A_CMP_USS_1OPTVLEAST = '少なくとも1つのオプションと有効な選択されたオプションを与えなければなりません';
public $A_CMP_USS_1OPTLEAST = '少なくとも1つのオプションを与えなければなりません';
public $A_CMP_USS_EXTRASAVED = '拡張フィールドの保存に成功しました';
public $A_CMP_USS_CHACONDET = '連絡先詳細の変更';
public $A_CMP_USS_REQUIRED = '必須';
public $A_CMP_USS_REGISTR = '登録';
public $A_CMP_USS_PROFILE = 'プロフィール';
public $A_CMP_USS_RONLY = '読込のみ';
public $A_CMP_USS_HIDDEN = 'Hidden';
public $A_CMP_USS_SHOWREG = '登録に表示';
public $A_CMP_USS_SHOWPROF = 'プロフィールに表示';
public $A_CMP_USS_OPTALIGN = 'オプションの位置'; //Options Alignment
public $A_CMP_USS_PREVNOTE = '注: プレビューするには変更を保存する必要があります。';
public $A_CMP_USS_OPTIONS = 'オプション';
public $A_CMP_USS_OPTIONSFOR = 'オプション'; //Options for
public $A_CMP_USS_MUSTFNAME = 'フィールド名が必要です';
public $A_CMP_USS_MAXLENINV = 'フィールドの最大長の値が不正です';
public $A_CMP_USS_HIDMUSTVAL = 'Hiddenフィールドは値が必要です！';
public $A_CMP_USS_DEFVAL = 'デフォルトの値';
public $A_CMP_USS_MAXLEN = '最大長';
public $A_CMP_USS_REQFLDSNO = '1つ以上の必須フィールドが記入されていません！';
public $A_CMP_USS_HIDNOREQ = 'Hiddenフィールドは必須にできません！';
public $A_CMP_USS_HIDNOPROF = 'Hiddenフィールドはプロフィールに表示できません！';
public $A_CMP_USS_PREFLANG = 'お望みの言語'; //Preferable language
public $A_CMP_USS_AVATAR = 'アバター';
public $A_CMP_USS_WEBSITE = 'ウェブサイト';
public $A_CMP_USS_AIM = 'AIM';
public $A_CMP_USS_YIM = 'YIM';
public $A_CMP_USS_MSN = 'MSN';
public $A_CMP_USS_ICQ = 'ICQ';
public $A_CMP_USS_MOBILE = '携帯電話';
public $A_CMP_USS_BIRTHDATE = '誕生日';
public $A_CMP_USS_GENDER = '性別';
public $A_CMP_USS_LOCATION = '所在地'; //Location
public $A_CMP_USS_OCCUPATION = '職業';
public $A_CMP_USS_SIGNATURE = '署名';
public $A_CMP_USS_MALE = '男性';
public $A_CMP_USS_FEMALE = '女性';
public $A_CMP_USS_YEAR = '年';
public $A_CMP_USS_MONTH = '月';
public $A_CMP_USS_DAY = '日';
public $A_CMP_USS_BOLDINDIC = '太字の要素はユーザプロフィールで有効です。'; //Elements in bold are enabled in users profile.
public $A_CMP_USS_ENDISSOFT = 'SoftDiskからプロフィール要素を有効/無効にすることができます。'; //You can enable/disable profile elements from SoftDisk.

//2009.0
public $A_USERS_EXPDATE = 'Expiration date';
public $A_USERS_ACCEXPIRED = 'Account expired';
public $A_USERS_ACCNACTIVE = 'Account active';

}

?>