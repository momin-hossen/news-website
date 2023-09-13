<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin as Admin;
use Illuminate\Support\Facades\Artisan;

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
// Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('blogs', Admin\BlogController::class);
    Route::resource('tags', Admin\TagController::class)->except('create', 'show', 'edit');
    Route::resource('categories', Admin\CategoryController::class)->except('create', 'show', 'edit');
    Route::resource('pages', Admin\PageController::class)->except('show');
    Route::resource('taglines', Admin\TaglineController::class);
    Route::resource('experiences', Admin\ExperienceController::class);
    Route::resource('skills', Admin\SkillController::class);
    Route::resource('services', Admin\ServiceController::class);
    Route::resource('portfolios', Admin\PortfolioController::class);
    Route::resource('testimonials', Admin\TestimonialController::class);
    Route::resource('subscribers', Admin\SubscriberController::class);
    Route::resource('social_links', Admin\SocialLinkController::class);
    Route::resource('news_categories', Admin\NewsCategoryController::class);
    Route::resource('sub_news_categories', Admin\SubNewsCategoryController::class);
    Route::resource('news', Admin\NewsController::class);
    Route::resource('reporters', Admin\NewsReporterController::class);

    // Settings
    Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
        Route::resource('seo', Admin\SeoController::class)->except('create', 'show');
        Route::resource('languages', Admin\LanguageController::class)->except('create', 'show');
        Route::post('language/{key}', [Admin\LanguageController::class, 'updateText'])->name('languages.text');
        Route::post('language/add-text/{key}', [Admin\LanguageController::class, 'addText'])->name('languages.add-text');

        // Menu Settiongs
        Route::resource('menu', Admin\MenuController::class);
        Route::post('/menus/destroy', [Admin\MenuController::class, 'destroy'])->name('menus.destroy');
        Route::post('menues/node', [Admin\MenuController::class, 'MenuNodeStore'])->name('menus.MenuNodeStore');
    });
});

Route::get('reset', function() {
    Artisan::call('migrate:fresh --seed');
    return back()->with('success', 'Restart');
});
