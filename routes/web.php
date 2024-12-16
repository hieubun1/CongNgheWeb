<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IssueController;

// Đường dẫn hiển thị danh sách đồ án (trang chủ)

Route::get('/issues', [IssueController::class, 'index'])->name('Issues.index');

// Đường dẫn để tạo mới một đồ án (hiển thị form thêm mới)
Route::get('/issues/create', [IssueController::class, 'create'])->name('Issues.create');

// Đường dẫn để lưu dữ liệu đồ án mới (thực hiện thêm mới)
Route::post('/Issues', [IssueController::class, 'store'])->name('Issues.store');

// Đường dẫn để hiển thị chi tiết một đồ án cụ thể (tuỳ chọn)
Route::get('/Issues/{id}', [IssueController::class, 'show'])->name('Issues.show');

// Đường dẫn để chỉnh sửa thông tin đồ án (hiển thị form chỉnh sửa)
Route::get('/Issues/{id}/edit', [IssueController::class, 'edit'])->name('Issues.edit');

// Đường dẫn để cập nhật thông tin đồ án (thực hiện cập nhật)
Route::put('/Issues/{id}', [IssueController::class, 'update'])->name('Issues.update');

// Đường dẫn để xóa đồ án (thực hiện xóa sau khi có modal xác nhận)
Route::delete('/Issues/{id}', [IssueController::class, 'destroy'])->name('Issues.destroy');