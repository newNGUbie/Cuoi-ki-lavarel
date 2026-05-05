<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminSlideController extends Controller
{
    private function slideDir(): string
    {
        return public_path('source/image/slide');
    }

    public function getList()
    {
        $slides = Slide::all();

        return view('admin.slide.list', compact('slides'));
    }

    public function getAdd()
    {
        return view('admin.slide.add');
    }

    public function postAdd(Request $request)
    {
        $request->validate(['image' => 'required|image']);
        $dir = $this->slideDir();
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $slide = new Slide;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $image = Str::random(4).'_'.$name;
            while (file_exists($dir.DIRECTORY_SEPARATOR.$image)) {
                $image = Str::random(4).'_'.$name;
            }
            $file->move($dir, $image);
            $slide->image = $image;
        }
        $slide->link = $request->link ?? '';
        $slide->save();

        return redirect()->route('admin.slide.getList')->with('success', 'Thêm thành công');
    }

    public function getEdit($id)
    {
        $slide = Slide::find($id);
        if (! $slide) {
            return redirect()->route('admin.slide.getList')->with('error', 'Không tìm thấy slide');
        }

        return view('admin.slide.edit', compact('slide'));
    }

    public function postEdit(Request $request, $id)
    {
        $slide = Slide::find($id);
        if (! $slide) {
            return redirect()->route('admin.slide.getList')->with('error', 'Không tìm thấy slide');
        }

        $dir = $this->slideDir();
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $image = Str::random(4).'_'.$name;
            while (file_exists($dir.DIRECTORY_SEPARATOR.$image)) {
                $image = Str::random(4).'_'.$name;
            }
            $file->move($dir, $image);
            $oldPath = $dir.DIRECTORY_SEPARATOR.$slide->image;
            if ($slide->image && file_exists($oldPath)) {
                @unlink($oldPath);
            }
            $slide->image = $image;
        }
        $slide->link = $request->link ?? '';
        $slide->save();

        return redirect()->route('admin.slide.getList')->with('success', 'Sửa thành công');
    }

    public function getDelete($id)
    {
        $slide = Slide::find($id);
        if ($slide) {
            $path = $this->slideDir().DIRECTORY_SEPARATOR.$slide->image;
            if ($slide->image && file_exists($path)) {
                @unlink($path);
            }
            $slide->delete();
        }

        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
