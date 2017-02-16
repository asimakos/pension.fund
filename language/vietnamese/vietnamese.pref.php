<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Nguyen Viet Thang ( ELPVN )
* @link: http://www.cgezine.com
* @email: elpvn@inbox.com
* @description: Vietnamese user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_vietnamese {

	public $_ON_NEW_CONTENT = "Một nội dung mới đã được gửi bởi [ %s ] với tiêu đề [ %s ] đăng ở phần [ %s ] và phân mục [ %s ]";
	public $_E_COMMENTS = 'Nhận xét';
	public $_DATE = 'Ngày';
	public $_E_SUBCONWAIT = 'Các bài gửi đang chờ phê duyệt:';
	public $_E_CONTENTSUB = 'Nội dung gửi';
	public $_MAIL_SUB = 'Thanh vien da gui bai';
	public $_E_HI = 'Xin chào';
	public $_E_NEWSUBBY = "Mot bai viet moi da duoc gui boi thanh vien %s";
	public $_E_TYPESUB = 'Loai bai:';
	public $_E_TITLE = 'Tiêu đề';
	public $_E_LOGINAPPR = 'Hay dang nhap vao he quan tri de phe duyet bai gui nay.';
	public $_E_DONTRESPOND = 'Vui long khong phan hoi e-mail nay, day la e-mail tu dong.';
	public $_E_NEWPASS_SUB = "Mat khau moi danh cho %s";
	public $_E_RPASS_NADMIN = "Thành viên %s đã gửi mẫu lấy lại mật khẩu. Một mật khẩu mới đã được khởi tạo và gửi tới e-mail của họ. 
	Nếu bạn không muốn bị làm phiền bởi các tin nhắn này, hãy chuyển tùy chọn ở phần USERS_RPASSMAIL trên SoftDisk sang tùy chọn No.";
	public $_E_SEND_SUB = "Chi tiet tai khoan cua %s tai %s";
	public $_ASEND_MSG = "Xin chao %s,
Hien co mot nguoi da dang ky thanh vien moi tai %s.
E-mail nay chua cac thong tin chi tiet cua nguoi nay:

Ho ten - %s
e-mail - %s
Ten truy cap - %s

Vui long khong phan hoi lai e-mail nay, boi vi day la mot e-mail tu dong duoc tao ra nham gui cac thong tin dang ky va xac nhan tai khoan cho thanh vien.";
	public $_NEW_MESSAGE = 'Có một tin nhắn mới';
	public $_NEW_PRMSGF = "A new private message has arrived from %s";
	public $_LOG_READMSG = 'Please login to the administration console to read the message.';
	public $_SUBCON_APPRNTF = 'Submitted content approval notification';
	public $_SUBCON_ATAPPR = 'Your submitted content at %s was approved.';
	public $_SECTION = 'Khu vực';
	public $_CATEGORY = 'Phân mục';

	//elxis 2008.1
	public $_MANAPPROVE = 'In order for the new user to be able to login you must manually approve his registration!';
	public $_ACCUNBLOCK = "Your account at %s has been activated by a site administrator. You may now login as %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'New comment notification';
	public $_E_NEWCOMBYTITLE = "A new comment has been posted by %s on an article of yours titled %s";
	public $_E_COMSTAYUNPUB = 'This comment will stay unpublished until you or a super administrator publish it.';
	public $_E_ACCEXPDATE = 'Account expiration date';

	public function __construct() {
	}

}

?>