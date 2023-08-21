<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use Illuminate\Support\Facades\Validator;


class NoticeController extends Controller
{
    // Admin Part/ Authorization
    public function index()
    {
        $notices = Notice::select()->with('user')->orderBy('id', 'desc')->get();
        return view('notice.index', compact('notices'));
    }
    public function store(Request $request)
    {
             
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:notices,title',
            'description' => 'required',
            'files' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondWithErrorWeb($validator->errors());
        }

        try {

            $notice = new Notice();
            $notice->title = $request->title;
            $notice->description = $request->description;
            $notice->notice_no = $this->getNoticeNumber();
            $notice->added_by  = auth()->user()->id;

            if ($request->hasfile('files')) {
                $files = [];
                foreach ($request->file('files') as $file) {
                    $fileName = "notice_file_" . Date('d_m_y_h_m_s')  . $file->getClientOriginalName();
                    $file->storeAs('noticeFile/', $fileName, 'public');
                    $fileName = "storage" . "/" . "noticeFile" . "/" . $fileName;
                    $files[] =  $fileName;
                }
                $notice->file = json_encode($files);
            }
            $notice->save();
            return $this->respondWithSuccessWeb('Notice Added Successfully');
        } catch (Exception $e) {
            return $this->respondWithErrorWeb($e->getMessage());
        }
    }

    public function publicationUpdate($id){
        $notice = Notice::find($id);
        if($notice->is_published === "1"){
            $notice->is_published = "0";
        }else{
            $notice->is_published = "1";
        }
        $notice->added_by  = auth()->user()->id;
        $notice->save();
        return $this->respondWithSuccessWeb('Notice Publication Status Updated Successfully');
    }





    // User Part/ Public
    public function publicIndex()
    {
        $notices = Notice::where('is_published', 1)->get();
        return view('public.notice', compact('notices'));
    }
    public function viewFile($id)
    {
        $notice = Notice::find($id);
        $notice->file = json_decode($notice->file);
        $pathToFile = public_path($notice->file[0]);
        return response()->file($pathToFile);
    }

    protected function getNoticeNumber(){
        $notice = Notice::select()->orderBy('id', 'desc')->first();
        if($notice){
            $notice_no = $notice->notice_no;
            $notice_no = $notice_no + 1;
        }else{
            $notice_no = 1001;
        }
        return $notice_no;
    }
}
