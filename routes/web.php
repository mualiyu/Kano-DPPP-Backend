<?php

use App\Exports\ApplicationExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Disabled root route
// Route::get('/', function () {
//     return view('dashboard');
// })->domain('admin.localhost:8000');

// Citizen Portal Route
Route::get('/citizen', function () {
    return view('citizen-portal');
})->name('citizen_portal');

Route::prefix('/')->group(function () {

    // Disabled root route
    // Route::get('', [App\Http\Controllers\Main\MainController::class, 'index'])->name('main_index');

    // Route::get('', [App\Http\Controllers\Main\MainController::class, 'index'])->name('main_index');
    Route::get('/about-us', [App\Http\Controllers\Main\MainController::class, 'about_us'])->name('main_about_us');
    Route::get('/energising-agriculture-programme', [App\Http\Controllers\Main\MainController::class, 'eap'])->name('main_eap');
    Route::get('/work-with-us', [App\Http\Controllers\Main\MainController::class, 'wwu_test'])->name('main_wwu');
    Route::get('/work-with-us-test', [App\Http\Controllers\Main\MainController::class, 'wwu_test'])->name('main_wwu_test');
    Route::get('/job/{job}/info', [App\Http\Controllers\Main\MainController::class, 'job_info'])->name('main_job_info');
    Route::get('/news', [App\Http\Controllers\Main\MainController::class, 'news'])->name('main_news');
    Route::get('/news/{news}', [App\Http\Controllers\Main\MainController::class, 'single_news'])->name('main_single_news');
    Route::get('/press-release', [App\Http\Controllers\Main\MainController::class, 'press'])->name('main_press');
    Route::get('/press-release/{press}', [App\Http\Controllers\Main\MainController::class, 'single_press'])->name('main_single_press');
    Route::get('/gallery', [App\Http\Controllers\Main\MainController::class, 'gallery'])->name('main_gallery');
    Route::get('/gallery/{gallery}', [App\Http\Controllers\Main\MainController::class, 'single_gallery'])->name('main_single_gallery');
    Route::get('/videos', [App\Http\Controllers\Main\MainController::class, 'videos'])->name('main_videos');

    Route::get('/faq', [App\Http\Controllers\Main\MainController::class, 'faq'])->name('main_faq');
    Route::get('/downloads', [App\Http\Controllers\Main\MainController::class, 'downloads'])->name('main_downloads');
    Route::get('/downloads/{download}/download', [App\Http\Controllers\Main\MainController::class, 'download_doc'])->name('main_down_doc');

    Route::get('/contact-us', [App\Http\Controllers\Main\MainController::class, 'contact_us'])->name('main_contact_us');
});



// Auth::routes();

// Admin modified login & Register
Auth::routes(['login' => false, 'register' => false]);

// Route::get('/admin/signup', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm');
// Route::post('/admin/signup', 'App\Http\Controllers\Auth\RegisterController@register')->name('register');


// Admin
Route::prefix('/admin')->group(function () {
    // signin Routes
    Route::get('/signin', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
    Route::post('/signin', 'App\Http\Controllers\Auth\LoginController@login')->name('login');

    // Home routes
    Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Jobs routes
    Route::prefix('/jobs')->group(function () {
         Route::get('', [App\Http\Controllers\JobController::class, 'index'])->name('jobs');
         Route::get('/create', [App\Http\Controllers\JobController::class, 'create'])->name('show_create_job');
         Route::post('/create', [App\Http\Controllers\JobController::class, 'store'])->name('store_job');
         Route::get('/{job}/job-info', [App\Http\Controllers\JobController::class, 'show'])->name('show_job_info');
         Route::get('/{job}/edit-job', [App\Http\Controllers\JobController::class, 'edit'])->name('show_edit_job');
         Route::post('/{job}/job-info', [App\Http\Controllers\JobController::class, 'update'])->name('update_job');
         Route::post('/{job}/delete', [App\Http\Controllers\JobController::class, 'destroy'])->name('delete_job');
         Route::get('/{id}/download', [App\Http\Controllers\JobController::class, 'download_doc'])->name('job_download_doc');

         Route::post('/{id}/delete/milestone', [App\Http\Controllers\JobController::class, 'delete_milestone'])->name('delete_milestone');
         Route::post('/{id}/delete/content', [App\Http\Controllers\JobController::class, 'delete_content'])->name('delete_content');
         Route::post('/{id}/delete/report', [App\Http\Controllers\JobController::class, 'delete_report'])->name('delete_report');
         Route::post('/{id}/delete/docs', [App\Http\Controllers\JobController::class, 'delete_doc'])->name('delete_job_doc');

         Route::get('/get-business-sub-categories', [App\Http\Controllers\JobController::class, 'get_b_s_c'])->name('get_b_s_c');
    });

    // Settings routes
    Route::prefix('/settings')->group(function () {
         Route::get('', [App\Http\Controllers\SettingController::class, 'index'])->name('settings');

        //     Sys requiremment
        Route::post('/sys-requirement', [App\Http\Controllers\SysRequirementController::class, 'store'])->name('create_sys_requirement');
        Route::post('/sys-requirement/{sysRequirement}/update', [App\Http\Controllers\SysRequirementController::class, 'update'])->name('update_sys_requirement');
        Route::post('/sys-requirement/{sysRequirement}/destroy', [App\Http\Controllers\SysRequirementController::class, 'destroy'])->name('delete_sys_requirement');

        //  business logig route
         Route::get('/business_category', [App\Http\Controllers\SettingController::class, 'show_create_b_category'])->name('show_create_b_category');
         Route::post('/business_category', [App\Http\Controllers\SettingController::class, 'create_b_category'])->name('create_b_category');
         Route::get('/business_category/{id}/edit', [App\Http\Controllers\SettingController::class, 'show_edit_b_c'])->name('b_c_edit');
         Route::post('/business_category/{id}/update', [App\Http\Controllers\SettingController::class, 'update_b_c'])->name('update_b_c');
         Route::post('/business_category/delete-business-category/{id}', [App\Http\Controllers\SettingController::class, 'delete_b_c'])->name('delete_b_c');
         Route::post('/business_category/delete-business-sub-category/{id}', [App\Http\Controllers\SettingController::class, 'delete_b_s_c'])->name('delete_b_s_c');

         Route::get('/add/user', [App\Http\Controllers\SettingController::class, 'show_admins'])->name('users');
         Route::post('/add/user', [App\Http\Controllers\SettingController::class, 'register_admin'])->name('register_new_user');
    });

    // Database's routes
    Route::prefix('/database')->group(function () {
        //  Database
        Route::get('', [App\Http\Controllers\DatabaseController::class, 'index'])->name('database');
        Route::get('/{id}/applicant', [App\Http\Controllers\DatabaseController::class, 'applicant_profile'])->name('admin_applicant_profile');
        Route::post('/{id}/applicant', [App\Http\Controllers\DatabaseController::class, 'app_update_profile'])->name('admin_app_update_profile');
        Route::post('/{id}/applicant/deactivate', [App\Http\Controllers\DatabaseController::class, 'deactivate_applicant'])->name('deactivate_applicant');

        Route::get('/{id}/applicant/application', [App\Http\Controllers\DatabaseController::class, 'applicant_applications'])->name('admin_applicant_application');

        Route::get('/accept-aplicant-registration/{id}', [App\Http\Controllers\DatabaseController::class, 'accept_applicant_registration'])->name('accept_applicant_registration');
    });

    // Applications routes (now using BidController)
    Route::prefix('/applications')->group(function () {
        Route::get('', [App\Http\Controllers\BidController::class, 'index'])->name('applications');
        Route::get('/{id}/job', [App\Http\Controllers\BidController::class, 'job_apps'])->name('job_applications');
        Route::get('/{id}/job/export', [App\Http\Controllers\BidController::class, 'export_job_apps'])->name('job_export_applications');
        Route::get('/{id}/download', [App\Http\Controllers\BidController::class, 'download_doc'])->name('download_doc');
        Route::post('/{id}/update', [App\Http\Controllers\BidController::class, 'update'])->name('update_apply');
    });


});


// Applicants
Route::prefix('/applicant')->group(function () {
    // signin Routes
    Route::get('/signin', 'App\Http\Controllers\Applicant\Auth\LoginController@showLoginForm')->name('app_show_login');
    Route::post('/signin', 'App\Http\Controllers\Applicant\Auth\LoginController@login')->name('app_login');

    Route::get('/signup', 'App\Http\Controllers\Applicant\Auth\RegisterController@showRegistrationForm')->name('app_show_register');
    Route::post('/signup-company', 'App\Http\Controllers\Applicant\Auth\RegisterController@register_company')->name('app_register_company');
    Route::post('/signup-individual', 'App\Http\Controllers\Applicant\Auth\RegisterController@register_individual')->name('app_register_individual');

    Route::post('/sign-out', 'App\Http\Controllers\Applicant\Auth\LoginController@signOut')->name('app_logout');

    Route::get('/recover-password', 'App\Http\Controllers\Applicant\Auth\ForgotController@showFrogotPasswordForm')->name('app_show_forgot_pass');
    Route::post('/recover-password', 'App\Http\Controllers\Applicant\Auth\ForgotController@forgot_password')->name('app_forgot_pass');


    // Home routes
    Route::get('', [App\Http\Controllers\Applicant\HomeController::class, 'index'])->name('app_home');

    // Jobs routes
    Route::prefix('/jobs')->group(function () {
         Route::get('', [App\Http\Controllers\Applicant\JobController::class, 'index'])->name('app_jobs');
          Route::get('/{id}/job-info', [App\Http\Controllers\Applicant\JobController::class, 'job_info'])->name('app_job_info');
         Route::get('/job/{id}/apply', [App\Http\Controllers\Applicant\JobController::class, 'show_apply'])->name('show_apply_job');
         Route::post('/job/{id}/apply', [App\Http\Controllers\Applicant\JobController::class, 'apply'])->name('app_apply');
         Route::get('/{id}/download', [App\Http\Controllers\Applicant\JobController::class, 'download_doc'])->name('app_job_download_doc');

         Route::get('/job/{id}/update-application', [App\Http\Controllers\Applicant\JobController::class, 'show_update_app'])->name('app_show_update_app');
         Route::post('/job/{id}/update-application', [App\Http\Controllers\Applicant\JobController::class, 'update_app'])->name('app_update_app');

    });

    Route::get('/profile', [App\Http\Controllers\Applicant\ProfileController::class, 'index'])->name('app_profile');
    Route::post('/profile', [App\Http\Controllers\Applicant\ProfileController::class, 'update'])->name('app_update_profile');
    Route::post('/profile/{applicant}/consultant', [App\Http\Controllers\Applicant\ProfileController::class, 'update_c'])->name('app_update_c_profile');
    Route::post('/profile/{id}/change-password', [App\Http\Controllers\Applicant\ProfileController::class, 'update_password'])->name('app_change_pass');
    Route::post('/profile/delete-picture/{id}', [App\Http\Controllers\Applicant\ProfileController::class, 'delete_pic'])->name('app_delete_profile_pic');

    // Applications routes
    Route::prefix('/applications')->group(function () {
         Route::get('', [App\Http\Controllers\Applicant\ApplicationController::class, 'index'])->name('app_applications');
         Route::get('/{id}/download', [App\Http\Controllers\Applicant\ApplicationController::class, 'download_doc'])->name('app_download_doc');
         Route::get('/{id}/info', [App\Http\Controllers\Applicant\ApplicationController::class, 'show'])->name('app_application_info');
    });

});



Route::prefix('/web-admin')->group(function () {
    // signin Routes
    Route::get('/signin', 'App\Http\Controllers\Media\Auth\LoginController@showLoginForm')->name('m_show_login');
    Route::post('/signin', 'App\Http\Controllers\Media\Auth\LoginController@login')->name('m_login');

    Route::post('/sign-out', 'App\Http\Controllers\Media\Auth\LoginController@signOut')->name('m_logout');

    Route::get('/recover-password', 'App\Http\Controllers\Media\Auth\ForgotController@showFrogotPasswordForm')->name('m_show_forgot_pass');
    Route::post('/recover-password', 'App\Http\Controllers\Media\Auth\ForgotController@forgot_password')->name('m_forgot_pass');


    // Home routes
    Route::get('', [App\Http\Controllers\Media\HomeController::class, 'index'])->name('m_home');

    Route::prefix('/news')->group(function () {
         Route::get('', [App\Http\Controllers\Media\NewsController::class, 'index'])->name('news');
         Route::get('/create', [App\Http\Controllers\Media\NewsController::class, 'create'])->name('show_create_news');
         Route::post('/create', [App\Http\Controllers\Media\NewsController::class, 'store'])->name('store_news');
         Route::get('/{news}/news-info', [App\Http\Controllers\Media\NewsController::class, 'edit'])->name('show_edit_news');
         Route::post('/{news}/news-info', [App\Http\Controllers\Media\NewsController::class, 'update'])->name('update_news');

         Route::post('/{news}/delete/', [App\Http\Controllers\Media\NewsController::class, 'destroy'])->name('delete_news');
          Route::post('/{cont}/delete/content', [App\Http\Controllers\Media\NewsController::class, 'destroy_cont'])->name('delete_news_cont');
    });

    Route::prefix('/perss-release')->group(function () {
         Route::get('', [App\Http\Controllers\Media\PressReleaseController::class, 'index'])->name('press');
         Route::get('/create', [App\Http\Controllers\Media\PressReleaseController::class, 'create'])->name('show_create_press');
         Route::post('/create', [App\Http\Controllers\Media\PressReleaseController::class, 'store'])->name('store_press');
         Route::get('/{pressRelease}/press-release-info', [App\Http\Controllers\Media\PressReleaseController::class, 'edit'])->name('show_edit_press');
         Route::post('/{pressRelease}/press-release-info', [App\Http\Controllers\Media\PressReleaseController::class, 'update'])->name('update_press');

         Route::post('/{pressRelease}/delete/', [App\Http\Controllers\Media\PressReleaseController::class, 'destroy'])->name('delete_press');
          Route::post('/{cont}/delete/content', [App\Http\Controllers\Media\PressReleaseController::class, 'destroy_cont'])->name('delete_press_cont');
    });

    Route::prefix('/galleries')->group(function () {
         Route::get('', [App\Http\Controllers\Media\GalleryController::class, 'index'])->name('galleries');
         Route::get('/create', [App\Http\Controllers\Media\GalleryController::class, 'create'])->name('show_create_gallery');
         Route::post('/create', [App\Http\Controllers\Media\GalleryController::class, 'store'])->name('store_gallery');
         Route::get('/{gallery}/gallery-info', [App\Http\Controllers\Media\GalleryController::class, 'edit'])->name('show_edit_gallery');
         Route::post('/{gallery}/gallery-info', [App\Http\Controllers\Media\GalleryController::class, 'update'])->name('update_gallery');

         Route::post('/{gallery}/delete/', [App\Http\Controllers\Media\GalleryController::class, 'destroy'])->name('delete_gallery');
          Route::post('/{img}/delete/image', [App\Http\Controllers\Media\GalleryController::class, 'destroy_cont'])->name('delete_gallery_cont');
    });

    Route::prefix('/videos')->group(function () {
         Route::get('', [App\Http\Controllers\Media\VideoController::class, 'index'])->name('videos');
         Route::get('/create', [App\Http\Controllers\Media\VideoController::class, 'create'])->name('show_create_video');
         Route::post('/create', [App\Http\Controllers\Media\VideoController::class, 'store'])->name('store_video');
         Route::get('/{video}/video-info', [App\Http\Controllers\Media\VideoController::class, 'edit'])->name('show_edit_video');
         Route::post('/{video}/video-info', [App\Http\Controllers\Media\VideoController::class, 'update'])->name('update_video');

         Route::post('/{video}/delete/', [App\Http\Controllers\Media\VideoController::class, 'destroy'])->name('delete_video');
    });

    Route::prefix('/downloads')->group(function () {
         Route::get('', [App\Http\Controllers\Media\DownloadController::class, 'index'])->name('downs');
         Route::get('/create', [App\Http\Controllers\Media\DownloadController::class, 'create'])->name('show_create_down');
         Route::post('/create', [App\Http\Controllers\Media\DownloadController::class, 'store'])->name('store_down');
         Route::get('/{download}/download-info', [App\Http\Controllers\Media\DownloadController::class, 'edit'])->name('show_edit_down');
         Route::post('/{download}/download-info', [App\Http\Controllers\Media\DownloadController::class, 'update'])->name('update_down');

         Route::get('/{download}/download-document', [App\Http\Controllers\Media\DownloadController::class, 'download_doc'])->name('show_down_doc');
         Route::post('/{download}/delete/', [App\Http\Controllers\Media\DownloadController::class, 'destroy'])->name('delete_down');
    });

    Route::prefix('/faqs')->group(function () {
         Route::get('', [App\Http\Controllers\Media\FaqController::class, 'index'])->name('faqs');
         Route::get('/create', [App\Http\Controllers\Media\FaqController::class, 'create'])->name('show_create_faq');
         Route::post('/create', [App\Http\Controllers\Media\FaqController::class, 'store'])->name('store_faq');
         Route::get('/{faq}/faq-info', [App\Http\Controllers\Media\FaqController::class, 'edit'])->name('show_edit_faq');
         Route::post('/{faq}/faq-info', [App\Http\Controllers\Media\FaqController::class, 'update'])->name('update_faq');

         Route::post('/{faq}/delete/', [App\Http\Controllers\Media\FaqController::class, 'destroy'])->name('delete_faq');
    });

});

Route::get('/storage/{pat}/{filename}', function ($pat, $filename) {

    $storage = Storage::disk('local')->path('public/'.$pat.'/'.$filename);

     return response()->file($storage);
});

// Route::get('/excell', function(){
//     return Excel::download(new ApplicationExport, 'apps.xlsx');
// });
