<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:sliders',
            'status' => 'nullable',
            'image' => 'required|image|mimes:jpg,png',
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/slider/',$filename);
            $validatedData['image'] = 'uploads/slider/'.$filename;
        }

        $validatedData['status'] = $request->status == true ? '1':'0';

        Slider::create([
            'title' => $validatedData['title'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status']
        ]);

        return redirect('admin/slider')->with('message', 'Slider Added Successfully!');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:sliders,title,' . $slider->id,
            'status' => 'nullable',
            'image' => 'sometimes|image|mimes:jpg,png',
        ]);

        if($request->hasFile('image')){

            if(File::exists($slider->image)) {
                File::delete($slider->image);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/slider/', $filename);
            $validatedData['image'] = 'uploads/slider/' . $filename;
        }

        $validatedData['status'] = $request->status == true ? '1':'0';

        $slider->update($validatedData);

        return redirect('admin/slider')->with('message', 'Slider Updated Successfully!');
    }


    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if($slider){
            $destination = $slider->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }

            $slider->delete();
            return redirect('admin/slider')->with('message', 'Slider Deleted Successfully!');
        }
        return redirect('admin/slider')->with('message', 'Something went wrong!');
    }
}
