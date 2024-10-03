<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttachmentController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRoleController;

use App\Http\Controllers\InternshipController;
use App\Http\Controllers\AdminInternshipController;

use App\Http\Controllers\DepartmentController;

Auth::routes(['verify' => true]);


Route::get('/', [ListingController::class, 'index'])->name('index');



// Profile Routes (Accessible only to authenticated users)
Route::middleware(['auth', 'verified'])->group(function () {   
    
    Route::get('/constituencies', [ProfileController::class, 'getConstituencies']);
Route::get('/subcounties', [ProfileController::class, 'getSubcounties']);

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
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/listings/manage', [ListingController::class, 'manage']);

    Route::get('/listings/create', [ListingController::class, 'create']);

    Route::get('/listings', [ListingController::class, 'index']);
    Route::get('/listings/{listing}', [ListingController::class, 'show']); // Ensure normal users can view listings
    Route::post('/listings/{id}/apply', [ApplicationController::class, 'apply'])->middleware('auth');
    Route::put('/listings/{listing}/archive', [ListingController::class, 'archive'])->name('listings.archive');
    Route::put('/listings/{listing}/unarchive', [ListingController::class, 'unarchive'])->name('listings.unarchive');


});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/{job}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/reports/download', [AdminController::class, 'downloadPDF'])->name('reports.download');
    Route::post('/admin/update-status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');


    Route::get('/admin/reports/selected', [AdminController::class, 'showSelectedForInterview'])->name('admin.reports.selected');
    Route::get('/admin/reports/appointed', [AdminController::class, 'showAppointed'])->name('admin.reports.appointed');

    Route::get('/admin/reports/export/csv', [AdminController::class, 'exportCSV'])->name('export.csv');
    Route::get('/admin/reports/export/pdf', [AdminController::class, 'exportPDF'])->name('export.pdf');

    Route::get('/role-management', [UserRoleController::class, 'index'])->name('admin.role-management');
    Route::post('/role-management/{user}/toggle-role', [UserRoleController::class, 'toggleRole'])->name('admin.role-management.toggleRole');

    
    Route::post('/listings', [ListingController::class, 'store']);
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);
    Route::put('/listings/{listing}', [ListingController::class, 'update']);
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);
    // Add more admin-exclusive routes here...
    


    
});

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/internships/create', [InternshipController::class, 'create'])->name('internships.create');
    Route::post('/internships', [InternshipController::class, 'store'])->name('internships.store');
    Route::get('/internships', [InternshipController::class, 'index'])->name('internships.index'); // This route is for listing all internships
    Route::get('/internships/apply/{department}', [InternshipController::class, 'apply'])->name('internships.apply');

});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/admin/internships', [AdminInternshipController::class, 'index'])->name('internships.index');
    Route::get('/admin/internships/{department}', [AdminInternshipController::class, 'show'])->name('internships.show');
    Route::patch('/admin/internships/{application}', [AdminInternshipController::class, 'update'])->name('internships.update');
    Route::post('/admin/departments', [AdminInternshipController::class, 'storeDepartment'])->name('departments.store');

    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('admin.departments.create');
    
    // Add other department-related routes if not already added
    Route::post('/admin/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/admin/departments', [DepartmentController::class, 'index'])->name('departments.index');

    Route::resource('/admin/departments', DepartmentController::class)->except(['show']);
    Route::patch('/admindepartments/{department}/archive', [DepartmentController::class, 'archive'])->name('departments.archive');
    Route::patch('/admindepartments/{department}/unarchive', [DepartmentController::class, 'unarchive'])->name('departments.unarchive');
    Route::delete('/admindepartments/{department}', [DepartmentController::class, 'destroy'])->name('admin.departments.destroy');
    Route::get('/admindepartments/archived', [DepartmentController::class, 'archived'])->name('departments.archived');


});

