<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Computer;
use App\Models\issue;
use App\Models\issues;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    //
    public function index()
    {
        // Sử dụng paginate thay vì all()
        $issues = issues::with('Computer')->paginate(5); // Lấy 5 bản ghi mỗi trang
        return view('Issues.index', compact('issues'));

    }
    public function create()
    {
        $computers = Computer::all(); // Lấy danh sách máy tính để chọn
        $issues = Issues::all(); // Lấy danh sách sự cố
        return view('Issues.create', compact('computers', 'issues')); // Sửa lại tên biến ở đây
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'computer_id' => 'required',
            'reported_by' => 'required|max:50',
            'reported_date' => 'required|date',
            'description' => 'required|max:100',
            'urgency' => 'required',
            'status' => 'required',
        ]);

        issues::create($request->all());

        return redirect()->route('Issues.index')->with('success', 'Thêm vấn đề thành công');
    }
    public function edit($id)
    {
        $issues = issues::findOrFail($id);
        $computers = Computer::all();
        return view('Issues.edit', compact('issues', 'computers'));
    }
    public function update(Request $request, $id) {
        // Kiểm tra dữ liệu đầu vào (validation)
        $request->validate([
            'computer_id' => 'required',
            'reported_by' => 'required',
            'reported_date' => 'required|date',
            'description' => 'required',
            'urgency' => 'required',
            'status' => 'required',
        ]);
    
        // Tìm đối tượng Thesis cần cập nhật
        $issue = issues::find($id);
        
        // Cập nhật thông tin
        $issue->update($request->all());
    
        // Điều hướng trở lại trang index với thông báo thành công
        return redirect()->route('Issues.index')->with('success', 'Cập nhập báo cáo thành công');
    }

    public function destroy($id)
    {
        $issue = issues::findOrFail($id);
        $issue->delete();

        return redirect()->route('Issues.index')->with('success', 'Báo cáo đã được xóa');
    }
    //
}