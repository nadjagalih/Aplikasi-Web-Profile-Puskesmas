<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\AnnouncementController;

use App\Http\Controllers\SambutanController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AlurPelayananController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\StrukturOrganisasiController;

// Admin Controllers
use App\Http\Controllers\ProfilAdminController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\AdminKontakController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminGalleryController;
use App\Http\Controllers\AdminLayananController;
use App\Http\Controllers\AdminProfilPkmController;
use App\Http\Controllers\AdminAnnouncementController;
use App\Http\Controllers\AdminIdentitasSitusController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminVisiMisiController;
use App\Http\Controllers\AdminStrukturOrganisasiController;

use App\Http\Controllers\AdminSambutanController;
use App\Http\Controllers\AdminAgendaController;
use App\Http\Controllers\AdminAlurPelayananController;
use App\Http\Controllers\AdminBerkasController;
use App\Http\Controllers\AdminSkmConfigController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BerandaController::class, 'index']);

Route::get('/berita/{beritas:slug}', [BeritaController::class, 'berita']);
Route::get('/berita', [BeritaController::class, 'index']);

Route::post('/berita/{slug}', [CommentController::class, 'comment']);
Route::post('/berita/{slug}/reply', [CommentController::class, 'commentReply']);

Route::get('/kategori/{kategori:slug}', [KategoriController::class, 'index']);

Route::get('/sambutan', [SambutanController::class, 'index']);

Route::get('/profil', [ProfilController::class, 'index']);

Route::get('/visi-misi', [VisiMisiController::class, 'index']);

Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index']);

Route::get('/kontak', [KontakController::class, 'index']);

Route::get('/layanan', [LayananController::class, 'index']);
Route::get('/alur-pelayanan', [AlurPelayananController::class, 'index']);

Route::get('/berkas', [BerkasController::class, 'index'])->name('berkas.frontend');
Route::get('/berkas/download/{id}', [BerkasController::class, 'download'])->name('berkas.download');

Route::get('/gallery', [GalleryController::class, 'index']);

Route::get('/pengumuman', [AnnouncementController::class, 'index']);
Route::get('/pengumuman/{pengumuman:slug}', [AnnouncementController::class, 'detail']);

Route::get('/agenda', [AgendaController::class, 'index']);
Route::get('/agenda/events', [AgendaController::class, 'getEvents']);

Route::get('/berita', [BeritaController::class, 'index']);

//Admin Dashboard 
Auth::routes();

// Custom reset password dengan username
Route::get('/password/reset-username', [\App\Http\Controllers\Auth\CustomResetPasswordController::class, 'showResetForm'])->name('password.reset-username');
Route::post('/password/reset-username', [\App\Http\Controllers\Auth\CustomResetPasswordController::class, 'resetPassword'])->name('password.reset-username.submit');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

Route::resource('/admin/slider', AdminSliderController::class);

Route::get('/admin/berita/slug', [AdminBeritaController::class, 'slug']);
Route::resource('/admin/berita', AdminBeritaController::class);

Route::get('/admin/komentar', [AdminCommentController::class, 'index']);
Route::delete('/admin/komentar/{id}', [AdminCommentController::class, 'destroy']);

Route::get('/admin/kategori/slug', [AdminKategoriController::class, 'slug']);
route::resource('/admin/kategori', AdminKategoriController::class);

// Menu Management Routes
Route::get('/admin/menu/slug', [AdminMenuController::class, 'slug']);
Route::post('/admin/menu/{menu}/toggle', [AdminMenuController::class, 'toggleStatus']);
Route::post('/admin/menu/reorder', [AdminMenuController::class, 'reorder']);
Route::resource('/admin/menu', AdminMenuController::class);

// Page Management Routes
Route::get('/admin/pages', [AdminPageController::class, 'index'])->name('pages.index');
Route::get('/admin/pages/create', [AdminPageController::class, 'create'])->name('pages.create');
Route::post('/admin/pages', [AdminPageController::class, 'store'])->name('pages.store');
Route::get('/admin/pages/{id}/edit', [AdminPageController::class, 'edit'])->name('pages.edit');
Route::put('/admin/pages/{id}', [AdminPageController::class, 'update'])->name('pages.update');
Route::post('/admin/pages/{id}/toggle', [AdminPageController::class, 'toggleStatus'])->name('pages.toggle');
Route::delete('/admin/pages/{id}', [AdminPageController::class, 'destroy'])->name('pages.destroy');
Route::post('/admin/pages/create-from-menu', [AdminPageController::class, 'createFromMenu'])->name('pages.createFromMenu');
Route::post('/admin/pages/upload-image', [AdminPageController::class, 'uploadImage'])->name('pages.uploadImage');
Route::post('/admin/pages/{id}/delete-banner', [AdminPageController::class, 'deleteBanner'])->name('pages.deleteBanner');

// Puskesmas Admin Routes
Route::resource('admin/sambutan', AdminSambutanController::class);
Route::resource('admin/agenda', AdminAgendaController::class);
Route::resource('admin/alur-pelayanan', AdminAlurPelayananController::class);
Route::resource('admin/skm-config', AdminSkmConfigController::class);

Route::get('admin/profilpkm', [AdminProfilPkmController::class, 'index']);
Route::get('admin/profilpkm/{id}/edit', [AdminProfilPkmController::class, 'edit']);
Route::put('admin/profilpkm/{id}', [AdminProfilPkmController::class, 'update']);

Route::get('admin/visi-misi', [AdminVisiMisiController::class, 'index']);
Route::get('admin/visi-misi/{id}/edit', [AdminVisiMisiController::class, 'edit']);
Route::put('admin/visi-misi/{id}', [AdminVisiMisiController::class, 'update']);

Route::resource('admin/struktur-organisasi', AdminStrukturOrganisasiController::class);

Route::get('/admin/kontak', [AdminKontakController::class, 'index']);
Route::put('/admin/kontak/{id}', [AdminKontakController::class, 'update']);

Route::get('/admin/identitas-situs/', [AdminIdentitasSitusController::class, 'index']);
Route::put('/admin/identitas-situs/{id}', [AdminIdentitasSitusController::class, 'update']);

Route::get('/admin/profil/', [ProfilAdminController::class, 'index']);
Route::put('/admin/profil/{id}', [ProfilAdminController::class, 'update']);
Route::put('/admin/profil/', [ProfilAdminController::class, 'changePassword']);

Route::resource('/admin/layanan', AdminLayananController::class);

Route::resource('/admin/gallery', AdminGalleryController::class);

Route::get('/admin/pengumuman/slug', [AdminAnnouncementController::class, 'slug']);
Route::resource('/admin/pengumuman', AdminAnnouncementController::class);

Route::resource('/admin/berkas', AdminBerkasController::class);
Route::get('/admin/berkas/{id}/preview', [AdminBerkasController::class, 'preview'])->name('berkas.preview');

Route::get('/galeri/{id}', [GalleryController::class, 'show'])->name('galeri.show');

// Dynamic Page Route (must be last to avoid conflicts with other routes)
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');