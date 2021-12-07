<?php

use Illuminate\Support\Facades\Route;

//Trang chủ
Route::get('/', 'BuyerController\HomeController@welcomeBuyer');
Route::get('/welcome-seller','SellerController\HomeController@welcomeSeller');
Route::get('/welcome-admin','AdminController\HomeController@welcomeAdmin');
//đăng nhập, đăng ký
Route::get('/login','LoginController@login');
Route::get('/login-check','LoginController@login_check');
Route::get('/signup','LoginController@signup');
Route::get('/signup-check','LoginController@signup_check');
Route::get('/logout','LoginController@logout');


//Trang dành cho người mua
//hiển thị các sản phẩm theo main, branch, hiển thị chi tiết
Route::get('/all-news','BuyerController\ProductController@all_news');
Route::get('/branch-result-{id_main}','BuyerController\NewsController@ViewBranchList');
Route::get('/news-result-{id_branch}','BuyerController\NewsController@ViewNewsList');
Route::get('/news-detail-{id_news}','BuyerController\NewsController@ViewNewsDetail');

//Lưu, bỏ lưu bài viết
Route::get('/bookmark','BuyerController\BookmarkedController@bookmark');
Route::get('/unbookmark','BuyerController\BookmarkedController@unbookmark');
Route::get('/unbookmark-{id_news}','BuyerController\BookmarkedController@unbookmark2');
Route::get('/view-all-bookmark','BuyerController\BookmarkedController@viewAllUserBookmark');

//comment
Route::get('/view-all-comment','BuyerController\CommentReplyController@viewAllUserComment');
Route::get('/comment','BuyerController\CommentReplyController@comment');
Route::get('/reply','BuyerController\CommentReplyController@reply');

//tìm kiếm bài viết
Route::get('/search-news','BuyerController\NewsController@searchNews');

//notification
Route::get('/view-notification','BuyerController\NotificationController@viewAllNotification');
Route::get('/mark-as-read-notification-{id_notification}','BuyerController\NotificationController@markAsReadNotification');

//chat
Route::get('/view-all-chats','BuyerController\ChatController@ViewAllChats');
Route::get('/view-chat-detail-{id_chat}','BuyerController\ChatController@ViewChatDetail');
Route::post('/send-msg','BuyerController\ChatController@SendMsg');
//thay đổi thông tin cá nhân người dùng
Route::get('/change-user-information','BuyerController\UserController@changeUserInformation');
Route::get('/alter-user-information','BuyerController\UserController@alterUserInformation');


//Trang dành cho người bán
//quản lý tin
Route::get('/seller-add-news','SellerController\NewsController@addNews');
Route::post('/seller-save-news','SellerController\NewsController@saveNews');
Route::get('/seller-all-news','SellerController\NewsController@showAllNews');

Route::get('/seller-unactive-news/{id_news}','SellerController\NewsController@unactiveNews');
Route::get('/seller-active-news/{id_news}','SellerController\NewsController@activeNews');
Route::get('/seller-edit-news/{id_news}','SellerController\NewsController@editNews');
Route::post('/seller-submit-edit-news','SellerController\NewsController@submitEditNews');

//Quản lý ảnh và sản phẩm
Route::get('/seller-multimedia-management','SellerController\ProductController@multimedia_management');
Route::get('/seller-product-management','SellerController\ProductController@product_management');

Route::post('/seller-save-multimedia','SellerController\ProductController@save_multimedia');
Route::get('/seller-edit-multimedia/{id_multimedia}','SellerController\ProductController@edit_multimedia');
Route::post('/seller-submit-edit-multimedia','SellerController\ProductController@submit_edit_multimedia');

Route::post('/seller-save-product','SellerController\ProductController@save_product');
Route::get('/seller-edit-product/{id_product}','SellerController\ProductController@edit_product');
Route::post('/seller-submit-edit-product','SellerController\ProductController@submit_edit_product');

//thay đổi thông tin cá nhân người dùng
Route::get('/change-seller-information','SellerController\SellerInformationController@changeSellerInformation');
Route::post('/alter-seller-information','SellerController\SellerInformationController@alterSellerInformation');

//Trang dành cho Admin
//Xem tất cả Session
Route::get('/admin-view-all-session','AdminController\SessionController@viewAllSession');
//quản lý người dùng
Route::get('/admin-block-user/{id_user}','AdminController\PeopleController@blockUser');
Route::get('/admin-unblock-user/{id_user}','AdminController\PeopleController@unBlockUser');
//hiển thị danh sách người dùng
Route::get('/display-user','AdminController\PeopleController@displayUser');
//Xem tất cả bình luận và phản hồi của người dùng
Route::get('/admin-view-all-user-comment','AdminController\PeopleController@commentController');
//xóa comment
Route::get('/admin-delete-comment/{id_comment}','AdminController\PeopleController@deleteComment');
Route::get('/admin-delete-reply/{id_reply}','AdminController\PeopleController@deleteReply');


//sửa, xóa tin tức
Route::get('/admin-all-news','AdminController\NewsController@showAllNews');
Route::get('/admin-unactive-news/{id_news}','AdminController\NewsController@unactiveNews');
Route::get('/admin-active-news/{id_news}','AdminController\NewsController@activeNews');
Route::get('/admin-edit-news/{id_news}','AdminController\NewsController@editNews');
Route::post('/admin-submit-edit-news','AdminController\NewsController@submitEditNews');
//Thêm, sửa Branch, Main
Route::get('/add-branch-category','AdminController\NewsController@addBranchCategory');
Route::get('/save-branch-category','AdminController\NewsController@saveBranchCategory');
Route::get('/add-main-category','AdminController\NewsController@addMainCategory');
Route::get('/save-main-category','AdminController\NewsController@saveMainCategory');
Route::get('/all-branch-category','AdminController\NewsController@showAllBranchCategory');
Route::get('/edit-branch-category/{id_branch_category}','AdminController\NewsController@editBranchCategory');
Route::get('/submit-edit-branch','AdminController\NewsController@submitEditBranch');
Route::get('/all-main-category','AdminController\NewsController@showAllMainCategory');
Route::get('/edit-main-category/{id_main}','AdminController\NewsController@editMainCategory');
Route::get('/submit-edit-main','AdminController\NewsController@submitEditMain');
//thay đổi thông tin cá nhân admin
Route::get('/change-admin-information','AdminController\AdminController@changeAdminInformation');
Route::post('/alter-admin-information','AdminController\AdminController@alterAdminInformation');
//thêm admin
Route::get('/add-admin','AdminController\AdminController@addAdmin');
Route::post('/save-admin','AdminController\AdminController@saveAdmin');
//Thống kê
Route::get('/statistic','AdminController\NewsController@statistic');
