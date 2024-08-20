<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttachmentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', [ListingController::class, 'index'])->name('index');

// Authentication Routes
Route::get('/register', [UserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/users', [UserController::class, 'store'])->middleware('guest');
Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

// Password Reset Routes
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    session()->flash('message', 'Verification link sent!');
    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Show the resend email form
Route::get('/email/resend', function () {
    return view('auth.resend-email');
})->middleware('auth')->name('verification.resend-form');

// Resend the email verification link
Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    session()->flash('message', 'Verification link resent!');
    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

// Profile Routes (Accessible only to authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/submit', [UserController::class, 'submitProfile'])->name('profile.submit');

    // Add more profile routes here...
    Route::get('/profile/personal-info', [ProfileController::class, 'showPersonalInfo'])->name('profile.personal-info');
Route::post('/profile/personal-info', [ProfileController::class, 'savePersonalInfo'])->name('profile.save-personal-info');

// Repeat for other sections
Route::get('/profile/academic-info', [ProfileController::class, 'showAcademicInfo'])->name('profile.academic-info');
Route::post('/profile/academic-info', [ProfileController::class, 'saveAcademicInfo'])->name('profile.save-academic-info');
Route::post('/add-row', [ProfileController::class, 'addRow'])->name('add.row');
Route::post('/remove-session-row', [ProfileController::class, 'removeSessionRow'])->name('remove.session.row');
Route::delete('/delete-academic-info/{id}', [ProfileController::class, 'deleteAcademicInfo'])->name('delete.academic.info');

// Repeat for other sections
Route::get('/profile/prof-info', [ProfileController::class, 'showProfInfo'])->name('profile.prof-info');
Route::post('/profile/prof-info', [ProfileController::class, 'saveProfInfo'])->name('profile.save-prof-info');
Route::post('/add-profrow', [ProfileController::class, 'addProfRow'])->name('add.profrow');
Route::post('/remove-profsession-row', [ProfileController::class, 'removeProfSessionRow'])->name('remove.profsession.row');
Route::delete('/delete-prof-info/{id}', [ProfileController::class, 'deleteProfInfo'])->name('delete.prof.info');

// Repeat for other sections
Route::get('/profile/relevant-courses', [ProfileController::class, 'showRelevantCourses'])->name('profile.relevant-courses');
Route::post('/profile/relevant-courses', [ProfileController::class, 'saveRelevantCourses'])->name('profile.save-relevant-courses');
Route::post('/add-relrow', [ProfileController::class, 'addRelRow'])->name('add.relrow');
Route::post('/remove-relsession-row', [ProfileController::class, 'removeRelSessionRow'])->name('remove.relsession.row');
Route::delete('/delete-rel-info/{id}', [ProfileController::class, 'deleteRelInfo'])->name('delete.rel.info');

Route::get('/profile/attachments', [AttachmentController::class, 'showAttachmentForm'])->name('profile.attachments');
    Route::post('/profile/upload-attachment', [AttachmentController::class, 'uploadAttachment'])->name('profile.upload-attachment');
    Route::delete('/profile/delete-attachment/{id}', [AttachmentController::class, 'deleteAttachment'])->name('profile.delete-attachment');
    Route::post('/profile/save-attachments', [AttachmentController::class, 'saveAttachments'])->name('profile.save-attachments');

// Repeat for other sections
Route::get('/profile/pro-bodies', [ProfileController::class, 'showProBodies'])->name('profile.pro-bodies');
Route::post('/profile/pro-bodies', [ProfileController::class, 'saveProBodies'])->name('profile.save-pro-bodies');

// Repeat for other sections
Route::get('/profile/emp-details', [ProfileController::class, 'showEmpDetails'])->name('profile.emp-details');
Route::post('/profile/emp-details', [ProfileController::class, 'saveEmpDetails'])->name('profile.save-emp-details');

// Repeat for other sections
Route::get('/profile/referees', [ProfileController::class, 'showReferees'])->name('profile.referees');
Route::post('/profile/referees', [ProfileController::class, 'saveReferees'])->name('profile.save-referees');

// Repeat for other sections

// Route::get('/profile/next-step', [UserController::class, 'nextStep'])->name('profile.next-step');

Route::get('/profile/summary', [ProfileController::class, 'showSummary'])->name('profile.summary');
Route::post('/profile/save', [ProfileController::class, 'saveProfile'])->name('profile.save');

Route::get('/my-applications', [ApplicationController::class, 'index'])->name('applications.index');

});

// Listings Routes (Accessible only to authenticated users)
Route::middleware(['auth'])->group(function () {

    Route::get('/listings/manage', [ListingController::class, 'manage']);

    Route::get('/listings/create', [ListingController::class, 'create']);

    Route::get('/listings', [ListingController::class, 'index']);
    Route::get('/listings/{listing}', [ListingController::class, 'show']); // Ensure normal users can view listings
    Route::post('/listings/{id}/apply', [ApplicationController::class, 'apply'])->middleware('auth');
    Route::put('/listings/{listing}/archive', [ListingController::class, 'archive'])->name('listings.archive');
    Route::put('/listings/{listing}/unarchive', [ListingController::class, 'unarchive'])->name('listings.unarchive');


});

// Admin-exclusive Routes (Accessible only to authenticated users with admin role)
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/{job}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/reports/download', [AdminController::class, 'downloadPDF'])->name('reports.download');
    Route::post('/admin/update-status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    

    Route::get('/admin/reports/selected', [AdminController::class, 'showSelectedForInterview'])->name('admin.reports.selected');
Route::get('/admin/reports/appointed', [AdminController::class, 'showAppointed'])->name('admin.reports.appointed');

Route::get('/admin/reports/export/csv', [AdminController::class, 'exportCSV'])->name('export.csv');
Route::get('/admin/reports/export/pdf', [AdminController::class, 'exportPDF'])->name('export.pdf');

    
    Route::post('/listings', [ListingController::class, 'store']);
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);
    Route::put('/listings/{listing}', [ListingController::class, 'update']);
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);
    // Add more admin-exclusive routes here...
});

Route::get('/constituencies', [ProfileController::class, 'getConstituencies']);
Route::get('/profile-dropdown', [ProfileController::class, 'showDropdown'])->name('profile.dropdown');

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');

// Catch-all Route

