<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\courses;
use Redirect, Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'Category'          =>  'required',
            'Topic'         =>  'required'
        ]);

        if (courses::where('category_id', $request->Category)
            ->where('topic_name', $request->Topic)->exists()
        ) {

            return redirect()->route('admin.home')->with('warning', 'Topic Already Exists in Database.');
        } else {
            $course = new courses;
            $course->category_id = $request->Category;
            $course->topic_name = $request->Topic;

            $course->save();

            return redirect()->route('admin.home')->with('success', 'Topic Added Successfully.');
        }
    }


    public function update($id, Request $request)
    {
        $request->validate([
            'category_id'      =>  'required',
            'topic_name'     =>  'required'
        ]);

        if (courses::where('category_id', $request->category_id)
            ->where('topic_name', $request->topic_name)->exists()
        ) {
            return redirect()->route('topics.index')->with('warning', 'Topic Already Exists in Database.');
        } else {
            $course = courses::find($id);

            $course->category_id = $request->category_id;
            $course->topic_name = $request->topic_name;
            $course->save();

            return redirect()->route('topics.index')->with('success', 'Topic Updated successfully');
        }
    }

    public function destroy($id)
    {
        $course = courses::where('id', $id);
        $course->delete();

        return view('viewtopics')->with('success', 'Topic deleted successfully');
    }
}
