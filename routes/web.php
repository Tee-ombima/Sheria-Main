<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttachmentController;

use App\Http\Controllers\LocationController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\AdminPupillageController;

use Illuminate\Support\Facades\Mail;

use App\Models\InternshipApplication;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRoleController;

use App\Http\Controllers\InternshipController;
use App\Http\Controllers\AdminInternshipController;

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PupillageController;
use App\Http\Controllers\PostPupillageController;

use App\Http\Controllers\AdminPostPupillageController;


Auth::routes(['verify' => true]);


Route::get('/', [ListingController::class, 'index'])->name('index');

Route::middleware(['auth','verified'])->group(function () {
    


    

});


// Profile Routes (Accessible only to authenticated users)
Route::middleware(['auth', 'verified'])->group(function () {   
    
    // Route::get('/getConstituencies/{homecounty_id}', [LocationController::class, 'getConstituencies']);
    // Route::get('/getSubcounties/{constituency_id}', [LocationController::class, 'getSubcounties']);
    // Correct the routes to match the controller's expected parameters
Route::get('/getSubcounties/{homecounty_id}', [LocationController::class, 'getSubcounties']);
Route::get('/getConstituencies/{subcounty_id}', [LocationController::class, 'getConstituencies']);
    Route::get('/profile-dropdown', [ProfileController::class, 'showDropdown'])->name('profile.dropdown');

    // Add more profile routes here...
    Route::get('/profile/personal-info', [ProfileController::class, 'showPersonalInfo'])->name('profile.personal-info');
Route::post('/profile/personal-info', [ProfileController::class, 'savePersonalInfo'])->name('profile.save-personal-info');

// Repeat for other sections
Route::get('/profile/academic-info', [ProfileController::class, 'showAcademicInfo'])->name('profile.academic-info');
Route::post('/profile/academic-info', [ProfileController::class, 'saveAcademicInfo'])->name('profile.save-academic-info');
Route::post('/add-row', [ProfileController::class, 'addRow'])->name('add.row');
Route::post('/remove-session-row', [ProfileController::class, 'removeSessionRow'])->name('remove.session.row');
Route::delete('/delete-academic-info/{id}', [ProfileController::class, 'deleteAcademicInfo'])->name('delete.academic.info');
Route::get('/profile/academic-info/edit/{id}', [ProfileController::class, 'editAcademicInfo'])->name('edit.academic.info');
Route::post('/profile/academic-info/update/{id}', [ProfileController::class, 'updateAcademicInfo'])->name('update.academic.info');


// Repeat for other sections
Route::get('/profile/prof-info', [ProfileController::class, 'showProfInfo'])->name('profile.prof-info');
Route::post('/profile/prof-info', [ProfileController::class, 'saveProfInfo'])->name('profile.save-prof-info');
Route::post('/add-profrow', [ProfileController::class, 'addProfRow'])->name('add.profrow');
Route::post('/remove-profsession-row', [ProfileController::class, 'removeProfSessionRow'])->name('remove.profsession.row');
Route::delete('/delete-prof-info/{id}', [ProfileController::class, 'deleteProfInfo'])->name('delete.prof.info');
Route::get('/profile/prof-info/edit/{id}', [ProfileController::class, 'editProfInfo'])->name('edit.prof.info');
Route::post('/profile/prof-info/update/{id}', [ProfileController::class, 'updateProfInfo'])->name('update.prof.info');



// Repeat for other sections
Route::get('/profile/relevant-courses', [ProfileController::class, 'showRelevantCourses'])->name('profile.relevant-courses');
Route::post('/profile/relevant-courses', [ProfileController::class, 'saveRelevantCourses'])->name('profile.save-relevant-courses');
Route::post('/add-relrow', [ProfileController::class, 'addRelRow'])->name('add.relrow');
Route::post('/remove-relsession-row', [ProfileController::class, 'removeRelSessionRow'])->name('remove.relsession.row');
Route::delete('/delete-rel-info/{id}', [ProfileController::class, 'deleteRelInfo'])->name('delete.rel.info');
Route::get('/profile/relevant-courses/edit/{id}', [ProfileController::class, 'editRelevantCourse'])->name('edit.rel.info');
Route::post('/profile/relevant-courses/update/{id}', [ProfileController::class, 'updateRelevantCourse'])->name('update.rel.info');



Route::get('/profile/attachments', [AttachmentController::class, 'showAttachmentForm'])->name('profile.attachments');
    Route::post('/profile/upload-attachment', [AttachmentController::class, 'uploadAttachment'])->name('profile.upload-attachment');
    Route::post('/profile/edit-attachment', [AttachmentController::class, 'editAttachment'])->name('profile.edit-attachment');
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
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/listings/create', [ListingController::class, 'create'])->middleware(['auth', 'permission:manage_listings']);

    Route::get('/listings', [ListingController::class, 'index']);
    Route::get('/listings/{listing}', [ListingController::class, 'show']);  
    Route::post('/listings/{id}/apply', [ApplicationController::class, 'apply'])->middleware('auth');

    Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware(['auth', 'permission:manage_listings']);
   
    Route::put('/listings/{listing}/archive', [ListingController::class, 'archive'])->name('listings.archive')->middleware(['auth', 'permission:manage_listings']);
    Route::put('/listings/{listing}/unarchive', [ListingController::class, 'unarchive'])->name('listings.unarchive')->middleware(['auth', 'permission:manage_listings']);
    Route::get('/admin/export/listing/{listing}', [AdminController::class, 'exportFullListing'])
     ->name('admin.export.listing')->middleware(['auth', 'permission:manage_listings']);


});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware(['auth', 'permission:manage_listings']);
    Route::get('/admin/{job}', [AdminController::class, 'show'])->name('admin.show')->middleware(['auth', 'permission:manage_listings']);
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports')->middleware(['auth', 'permission:manage_listings']);
    Route::get('/reports/download', [AdminController::class, 'downloadPDF'])->name('reports.download')->middleware(['auth', 'permission:manage_listings']);
    Route::post('/admin/update-status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus')->middleware(['auth', 'permission:manage_listings']);
    Route::post('/admin/jobs/{job}/bulk-update', [AdminController::class, 'updateStatusBulk'])->name('admin.updateStatusBulk')
->middleware(['auth', 'permission:manage_listings']);


    Route::get('/admin/reports/selected', [AdminController::class, 'showSelectedForInterview'])->name('admin.reports.selected')->middleware(['auth', 'permission:manage_listings']);
    Route::get('/admin/reports/appointed', [AdminController::class, 'showAppointed'])->name('admin.reports.appointed')->middleware(['auth', 'permission:manage_listings']);

    Route::get('/admin/reports/export/csv', [AdminController::class, 'exportCSV'])->name('export.csv')->middleware(['auth', 'permission:manage_listings']);
    Route::get('/admin/reports/export/pdf', [AdminController::class, 'exportPDF'])->name('export.pdf')->middleware(['auth', 'permission:manage_listings']);

    Route::get('/role-management', [UserRoleController::class, 'index'])->name('admin.role-management');
    Route::post('/role-management/{user}/toggle-role', [UserRoleController::class, 'toggleRole'])->name('admin.role-management.toggleRole');
    Route::delete('admin/users/{user}', [UserRoleController::class, 'destroy'])->name('admin.users.destroy');
    Route::match(['post', 'put'], '/users/{user}/permissions', [UserRoleController::class, 'updatePermissions'])
    ->name('users.update-permissions');


    
    Route::post('/listings', [ListingController::class, 'store'])->middleware(['auth', 'permission:manage_listings']);
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware(['auth', 'permission:manage_listings']);
    Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware(['auth', 'permission:manage_listings']);
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware(['auth', 'permission:manage_listings']);
    // Add more admin-exclusive routes here...
    


    
});

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/internships/create', [InternshipController::class, 'create'])->name('internships.create');
    Route::post('/internships', [InternshipController::class, 'store'])->name('internships.store');
    Route::get('/internships', [InternshipController::class, 'index'])->name('internships.index'); // This route is for listing all internships
    Route::post('/internships/upload-file', [InternshipController::class, 'uploadFile'])->name('internships.uploadFile');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/pupillages/create', [PupillageController::class, 'create'])->name('pupillages.create');
    Route::post('/pupillages', [PupillageController::class, 'store'])->name('pupillages.store');
    Route::get('/pupillages', [PupillageController::class, 'index'])->name('pupillages.index');
    Route::get('/getSubCounties/{county_id}', [PupillageController::class, 'getSubCounties'])->name('getSubCounties');

});
Route::middleware(['auth'])->group(function () {
    Route::get('/post-pupillages/create', [PostPupillageController::class, 'create'])->name('postPupillages.create');
    Route::post('/post-pupillages', [PostPupillageController::class, 'store'])->name('postPupillages.store');
    Route::get('/post-pupillages', [AdminPostPupillageController::class, 'index'])->name('postPupillages.index')->middleware(['auth','admin', 'permission:manage_post_pupillages']);
    Route::get('/getSubCounties/{county_id}', [PostPupillageController::class, 'getSubCounties'])->name('getSubCounties');

});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');


    Route::get('/admin/internships', [AdminInternshipController::class, 'index'])->name('internships.index')->middleware(['auth', 'permission:manage_internships']);
    Route::get('/admin/internships/{department}', [AdminInternshipController::class, 'show'])->name('internships.show')->middleware(['auth', 'permission:manage_internships']);
    Route::post('/admin/departments', [AdminInternshipController::class, 'storeDepartment'])->name('departments.store')->middleware(['auth', 'permission:manage_internships']);
    // routes/web.php
Route::delete('/admin/internships/{id}', [AdminInternshipController::class, 'destroy'])
->name('internships.destroy')->middleware(['auth', 'permission:manage_internships']);


Route::get('/admin/settings', [AdminInternshipController::class, 'editSettings'])->name('settings.edit')->middleware(['auth', 'permission:manage_internships']);
Route::put('/admin/settings', [AdminInternshipController::class, 'updateSettings'])->name('settings.update')->middleware(['auth', 'permission:manage_internships']);






    Route::post('/admin/internships/{application}/archive', [AdminInternshipController::class, 'archive'])->name('internships.archive')->middleware(['auth', 'permission:manage_internships']);
    Route::get('/admin/archived-applications', [AdminInternshipController::class, 'archivedApplications'])->name('archived.applications')->middleware(['auth', 'permission:manage_internships']);
    Route::patch('/admin/internships/{application}/unarchive', [AdminInternshipController::class, 'unarchive'])->name('internships.unarchive');
    Route::get('/internships/non-pending', [AdminInternshipController::class, 'nonPending'])->name('internships.nonPending')->middleware(['auth', 'permission:manage_internships']);

    Route::post('/admin/internships/{application}/update', [AdminInternshipController::class, 'update'])->name('internships.update')->middleware(['auth', 'permission:manage_internships']);

    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('admin.departments.create')->middleware(['auth', 'permission:manage_internships']);
    
    // Add other department-related routes if not already added
    Route::post('/admin/departments', [DepartmentController::class, 'store'])->name('departments.store')->middleware(['auth', 'permission:manage_internships']);
    Route::get('/admin/departments', [DepartmentController::class, 'index'])->name('departments.index')->middleware(['auth', 'permission:manage_internships']);

    Route::resource('/admin/departments', DepartmentController::class)->except(['show'])->middleware(['auth', 'permission:manage_internships']);
    Route::patch('/admindepartments/{department}/archive', [DepartmentController::class, 'archive'])->name('departments.archive')->middleware(['auth', 'permission:manage_internships']);
    Route::patch('/admindepartments/{department}/unarchive', [DepartmentController::class, 'unarchive'])->name('departments.unarchive')->middleware(['auth', 'permission:manage_internships']);
    Route::delete('/admindepartments/{department}', [DepartmentController::class, 'destroy'])->name('admin.departments.destroy')->middleware(['auth', 'permission:manage_internships']);
    Route::get('/admindepartments/archived', [DepartmentController::class, 'archived'])->name('departments.archived')->middleware(['auth', 'permission:manage_internships']);

    Route::get('internships/accepted', [AdminInternshipController::class, 'accepted'])->name('internships.accepted')->middleware(['auth', 'permission:manage_internships']);
    Route::get('internships/not_accepted', [AdminInternshipController::class, 'notAccepted'])->name('internships.not_accepted')->middleware(['auth', 'permission:manage_internships']);
    Route::get('internships/export', [AdminInternshipController::class, 'export'])->name('internships.export')->middleware(['auth', 'permission:manage_internships']);
    // ... other routes ...
    Route::post('/internships/toggle-apply', [AdminInternshipController::class, 'toggleApply'])->name('internships.toggleApply')->middleware(['auth', 'permission:manage_internships']);

});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Pupillage Applications
    Route::get('/admin/pupillages', [AdminPupillageController::class, 'index'])->name('pupillages.index')->middleware(['auth', 'permission:manage_pupillages']);
    Route::get('/admin/pupillages/{application}', [AdminPupillageController::class, 'show'])->name('pupillages.show')->middleware(['auth', 'permission:manage_pupillages']);
    Route::post('/admin/pupillages/departments', [AdminPupillageController::class, 'storeDepartment'])->name('pupillage.departments.store')->middleware(['auth', 'permission:manage_pupillages']);
    Route::delete('/admin/pupillages/{application}', [AdminPupillageController::class, 'destroy'])->name('pupillages.destroy')->middleware(['auth', 'permission:manage_pupillages']);
    Route::post('/admin/pupillages/{application}/archive', [AdminPupillageController::class, 'archive'])->name('pupillages.archive')->middleware(['auth', 'permission:manage_pupillages']);
    Route::get('/admin/pupillages/archived-applications', [AdminPupillageController::class, 'archivedApplications'])->name('pupillages.archived.applications')->middleware(['auth', 'permission:manage_pupillages']);
    Route::patch('/admin/pupillages/{application}/unarchive', [AdminPupillageController::class, 'unarchive'])->name('pupillages.unarchive')->middleware(['auth', 'permission:manage_pupillages']);
    Route::get('/pupillages/non-pending', [AdminPupillageController::class, 'nonPending'])->name('pupillages.nonPending')->middleware(['auth', 'permission:manage_pupillages']);
    // In web.php

Route::post('/admin/pupillages/bulk-update', [AdminPupillageController::class, 'bulkUpdate'])
->name('pupillages.bulk-update')->middleware(['auth', 'permission:manage_pupillages']);

Route::delete('/admin/pupillages/bulk-destroy', [AdminPupillageController::class, 'bulkDestroy'])
->name('pupillages.bulk-destroy')->middleware(['auth', 'permission:manage_pupillages']);

    // Other admin routes...
    // Corrected to PUT
Route::put('/pupillages/{application}', [AdminPupillageController::class, 'update'])
->name('admin.pupillages.update')->middleware(['auth', 'permission:manage_pupillages']);
    Route::get('pupillages/accepted', [AdminPupillageController::class, 'accepted'])->name('pupillages.accepted')->middleware(['auth', 'permission:manage_pupillages']);
    Route::get('pupillages/not_accepted', [AdminPupillageController::class, 'notAccepted'])->name('pupillages.not_accepted')->middleware(['auth', 'permission:manage_pupillages']);
    Route::get('pupillages/export', [AdminPupillageController::class, 'export'])->name('pupillages.export')->middleware(['auth', 'permission:manage_pupillages']);
    Route::post('/pupillages/toggle-apply', [AdminPupillageController::class, 'toggleApply'])->name('pupillages.toggleApply')->middleware(['auth', 'permission:manage_pupillages']);

    
Route::get('/admin/settings/pupillage', [AdminPupillageController::class, 'editSettings'])->name('pupillage.edit')->middleware(['auth', 'permission:manage_pupillages']);
Route::put('/admin/settings/pupillage', [AdminPupillageController::class, 'updateSettings'])->name('pupillage.update')->middleware(['auth', 'permission:manage_pupillages']);

});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Pupillage Applications
    Route::get('/admin/post-pupillages', [AdminPostPupillageController::class, 'index'])->name('postPupillages.index')->middleware(['auth', 'permission:manage_post_pupillages']);
    Route::get('/admin/post-pupillages/{application}', [AdminPostPupillageController::class, 'show'])->name('postPupillages.show')->middleware(['auth', 'permission:manage_post_pupillages']);
    Route::post('/admin/post-pupillages/departments', [AdminPostPupillageController::class, 'storeDepartment'])->name('postPupillages.departments.store')->middleware(['auth', 'permission:manage_post_pupillages']);
    Route::delete('/admin/post-pupillages/{application}', [AdminPostPupillageController::class, 'destroy'])->name('postPupillages.destroy')->middleware(['auth', 'permission:manage_post_pupillages']);
    Route::post('/admin/post-pupillages/{application}/archive', [AdminPostPupillageController::class, 'archive'])->name('postPupillages.archive')->middleware(['auth', 'permission:manage_post_pupillages']);
    Route::get('/admin/post-pupillages/archived-applications', [AdminPostPupillageController::class, 'archivedApplications'])->name('postPupillages.archived.applications')->middleware(['auth', 'permission:manage_post_pupillages']);
    Route::patch('/admin/post-pupillages/{application}/unarchive', [AdminPostPupillageController::class, 'unarchive'])->name('postPupillages.unarchive')->middleware(['auth', 'permission:manage_post_pupillages']);
    Route::get('/post-pupillages/non-pending', [AdminPostPupillageController::class, 'nonPending'])->name('postPupillages.nonPending')->middleware(['auth', 'permission:manage_post_pupillages']);

    // Other admin routes...
    Route::patch('/post-pupillages/{application}', [AdminPostPupillageController::class, 'update'])->name('admin.postPupillages.update')->middleware(['auth', 'permission:manage_post_pupillages']);

    Route::get('postPupillages/accepted', [AdminPostPupillageController::class, 'accepted'])->name('postPupillages.accepted')->middleware(['auth', 'permission:manage_post_pupillages']);
    Route::get('postPupillages/not_accepted', [AdminPostPupillageController::class, 'notAccepted'])->name('postPupillages.not_accepted')->middleware(['auth', 'permission:manage_post_pupillages']);
    Route::get('postPupillages/export', [AdminPostPupillageController::class, 'export'])->name('postPupillages.export')->middleware(['auth', 'permission:manage_post_pupillages']);
    Route::post('/postPupillages/toggle-apply', [AdminPostPupillageController::class, 'toggleApply'])->name('postPupillages.toggleApply')->middleware(['auth', 'permission:manage_post_pupillages']);


    Route::get('/post-pupillage/vacancy-number', [AdminPostPupillageController::class, 'editVacancyNumber'])->name('postPupillages.editVacancyNumber')->middleware(['auth', 'permission:manage_post_pupillages']);
    Route::post('/post-pupillage/vacancy-number', [AdminPostPupillageController::class, 'updateVacancyNumber'])->name('postPupillages.updateVacancyNumber')->middleware(['auth', 'permission:manage_post_pupillages']);
    
Route::get('/admin/settings/post-pupillage', [AdminPostPupillageController::class, 'editSettings'])->name('postpupillage.edit')->middleware(['auth', 'permission:manage_post_pupillages']);
Route::put('/admin/settings/post-pupillage', [AdminPostPupillageController::class, 'updateSettings'])->name('postpupillage.update')->middleware(['auth', 'permission:manage_post_pupillages']);

// web.php

Route::post('/admin/post-pupillages/bulk-update', [AdminPostPupillageController::class, 'bulkUpdate'])
     ->name('postPupillages.bulk-update')->middleware(['auth', 'permission:manage_post_pupillages']);

Route::delete('/admin/post-pupillages/bulk-destroy', [AdminPostPupillageController::class, 'bulkDestroy'])
     ->name('postPupillages.bulk-destroy')->middleware(['auth', 'permission:manage_post_pupillages']);

});


