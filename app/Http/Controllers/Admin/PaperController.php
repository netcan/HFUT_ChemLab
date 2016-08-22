<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Paper;
use App\Question;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaperController extends Controller
{
    public function index() {
        return view('admin.papers.index', ['papers'=>Paper::all()]);
    }
    public function edit($id) {
        $questions_added = [];
        foreach(Paper::find($id)->questions()->get() as $question)
            $questions_added[] = $question->id;

        return view('admin.papers.edit', [
            'id' => $id,
            'questions'=>Question::paginate(10),
            'questions_added' => $questions_added,
        ]);
    }

    public function add_question($pid, $qid) {
        $paper = Paper::find($pid);
        $paper->questions()->sync([$qid], false);
        return \Response::json('success');
    }

    public function delete_question($pid, $qid) {
        $paper = Paper::find($pid);
        $paper->questions()->detach($qid);
        return \Response::json('success');
    }

}
