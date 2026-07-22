<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\OtpVerificationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);

// Register routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister']);

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password reset routes
Route::get('/password/reset', [ForgetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/password/verify', [OtpVerificationController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/password/reset/{email}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

//Task routes
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

#bilash start 
// Budget Routes
// Add Budget Form Route
Route::get('/budgets/create', [BudgetController::class, 'create'])->name('budgets.create');

// View Budgets Table Route
Route::get('/budgets', [BudgetController::class, 'index'])->name('budgets.index');

// Store Budget Route
Route::post('/budgets', [BudgetController::class, 'store'])->name('budgets.store');

Route::delete('/budgets/{id}', [BudgetController::class, 'destroy'])->name('budgets.destroy');

Route::get('/budgets/spend', [BudgetController::class, 'spend'])->name('budgets.spend');
Route::post('/budgets/spend', [BudgetController::class, 'storeSpend'])->name('budgets.storeSpend');
#bilash end

//Subtask routes
Route::prefix('tasks/{task}/subtasks')->group(function () {
    Route::get('/', [SubtaskController::class, 'index'])->name('subtasks.index');
    Route::post('/', [SubtaskController::class, 'store'])->name('subtasks.store');
    Route::put('/{subtask}', [SubtaskController::class, 'update'])->name('subtasks.update');
    Route::delete('/{subtask}', [SubtaskController::class, 'destroy'])->name('subtasks.destroy');
    Route::get('/manage', [SubtaskController::class, 'manage'])->name('subtasks.manage');
});

//Atanu
Route::get('/admin', [AdminController::class, 'showAdmin'])->name('admin');
Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
Route::get('/admin/tasks', [AdminController::class, 'showTasks'])->name('admin.tasks');
Route::patch('/admin/users/{user}', [AdminController::class, 'updateUserStatus'])->name('admin.update-user-status');
Route::get('/admin/spendings', [AdminController::class, 'spendingTrends'])->name('admin.spendings');
Route::get('/admin/productivity', [AdminController::class, 'showProductivity'])->name('admin.productivity');
Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');

