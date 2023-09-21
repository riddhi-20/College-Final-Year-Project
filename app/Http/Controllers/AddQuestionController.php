<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\questions;

class AddQuestionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'topics_id'          =>  'required',
            'question'          =>  'required',
            'correctAns'         =>  'required',
            'quesimg' => 'image|mimes:jpg,png,jpeg,bmp,svg,webp|max:4096',
            'optAimg' => 'image|mimes:jpg,png,jpeg,bmp,svg,webp|max:4096',
            'optBimg' => 'image|mimes:jpg,png,jpeg,bmp,svg,webp|max:4096',
            'optCimg' => 'image|mimes:jpg,png,jpeg,bmp,svg,webp|max:4096',
            'optDimg' => 'image|mimes:jpg,png,jpeg,bmp,svg,webp|max:4096',
        ]);

            $question = new questions;
            $question->topics_id = $request->topics_id;
            $question->question = $request->question;
            $question->optionA = $request->optionA;
            $question->optionB = $request->optionB;
            $question->optionC = $request->optionC;
            $question->optionD = $request->optionD;
            $question->correctAns = $request->correctAns;


            if(isset($request->quesimg) or isset($request->optAimg) or isset($request->optBimg) or isset($request->optCimg) or isset($request->optDimg))
            {
                $question->is_img = 1;
            }
            else
            {
                $question->is_img = 0;
            }

            $question->quesimg = $request->quesimg;
            $question->optAimg = $request->optAimg;
            $question->optBimg = $request->optBimg;
            $question->optCimg = $request->optCimg;
            $question->optDimg = $request->optDimg;

            if(($request->file('quesimg')) and isset($request->quesimg)){
                $file= $request->file('quesimg');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('assets/CRTimage'), $filename);  /// store image in public/userimage
                $question['quesimg']= $filename;
            }

            if(($request->file('optAimg')) and isset($request->optAimg)){
                $file= $request->file('optAimg');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('assets/CRTimage'), $filename);  /// store image in public/userimage
                $question['optAimg']= $filename;
            }

            if(($request->file('optBimg')) and isset($request->optBimg)){
                $file= $request->file('optBimg');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('assets/CRTimage'), $filename);  /// store image in public/userimage
                $question['optBimg']= $filename;
            }

            if(($request->file('optCimg')) and isset($request->optCimg)){
                $file= $request->file('optCimg');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('assets/CRTimage'), $filename);  /// store image in public/userimage
                $question['optCimg']= $filename;
            }

            if(($request->file('optDimg')) and isset($request->optDimg)){
                $file= $request->file('optDimg');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('assets/CRTimage'), $filename);  /// store image in public/userimage
                $question['optDimg']= $filename;
            }

            $question->save();

            return redirect()->route('questions.create')->with('success', 'Question Added Successfully.');    
        }

    public function update($id, Request $request)
    {
        $request->validate([
            'topicid'          =>  'required',
            'question'          =>  'required',
            'CorrectAns'         =>  'required',

            'quesimg' => 'image|mimes:jpg,png,jpeg,bmp,svg,webp|max:4096',
            'optAimg' => 'image|mimes:jpg,png,jpeg,bmp,svg,webp|max:4096',
            'optBimg' => 'image|mimes:jpg,png,jpeg,bmp,svg,webp|max:4096',
            'optCimg' => 'image|mimes:jpg,png,jpeg,bmp,svg,webp|max:4096',
            'optDimg' => 'image|mimes:jpg,png,jpeg,bmp,svg,webp|max:4096',
        ]);

            $question = questions::find($id);

            $question->topics_id = $request->topicid;
            $question->question = $request->question;
            $question->optionA = $request->optionA;
            $question->optionB = $request->optionB;
            $question->optionC = $request->optionC;
            $question->optionD = $request->optionD;
            $question->correctAns = $request->CorrectAns;

            if(isset($request->quesimg) or isset($request->optAimg) or isset($request->optBimg) or isset($request->optCimg) or isset($request->optDimg))
            {
                $question->is_img = 1;
            }
            else
            {
                $question->is_img = 0;
            }

            // $question->quesimg = $request->quesimg;
            // $question->optAimg = $request->optAimg;
            // $question->optBimg = $request->optBimg;
            // $question->optCimg = $request->optCimg;
            // $question->optDimg = $request->optDimg;

            if(isset($request->quesimg) and ($request->file('quesimg'))){
                $file= $request->file('quesimg');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('assets/CRTimage'), $filename);  /// store image in public/userimage
                $question['quesimg']= $filename;
            }
            else{
                $question->quesimg = $question->quesimg;
            }

            if(isset($request->optAimg) and ($request->file('optAimg'))){
                $file= $request->file('optAimg');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('assets/CRTimage'), $filename);  /// store image in public/userimage
                $question['optAimg']= $filename;
            }
            else{
                $question->optAimg = $question->optAimg;
            }

            if(isset($request->optBimg) and ($request->file('optBimg'))){
                $file= $request->file('optBimg');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('assets/CRTimage'), $filename);  /// store image in public/userimage
                $question['optBimg']= $filename;
            }
            else{
                $question->optBimg = $question->optBimg;
            }

            if(isset($request->optCimg) and ($request->file('optCimg'))){
                $file= $request->file('optCimg');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('assets/CRTimage'), $filename);  /// store image in public/userimage
                $question['optCimg']= $filename;
            }
            else{
                $question->optCimg = $question->optCimg;
            }

            if(isset($request->optDimg) and ($request->file('optDimg'))){
                $file= $request->file('optDimg');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('assets/CRTimage'), $filename);  /// store image in public/userimage
                $question['optDimg']= $filename;
            }
            else{
                $question->optDimg = $question->optDimg;
            }

            $question->update();

            return redirect()->route('questions.index')->with('success', 'Question Updated successfully');
        
    }

    public function destroy($id)
    {
        $question = questions::where('id', $id);
        $question->delete();

        return View('viewquestions')->with('success', 'Question deleted successfully');
    }
}
