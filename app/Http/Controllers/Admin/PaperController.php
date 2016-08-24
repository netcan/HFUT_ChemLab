<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Paper;
use App\Question;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PaperController extends Controller
{
    public function index() {
        return view('admin.papers.index', [
            'papers'=>Paper::with('questions')->paginate(10),
        ]);
    }
    public function edit($id) {
        $questions_added = [];
        foreach(Paper::find($id)->questions()->get() as $question)
            $questions_added[] = $question->id;

        return view('admin.papers.edit', [
            'paper' => Paper::find($id),
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

    public function update(Request $request, $id) {
        $start_time = Carbon::parse($request->get('start_time'));
        $end_time = Carbon::parse($request->get('end_time'));
        $this->validate($request, [
            'name'=>'required|unique:papers,title,'.$id,
            'multi_score'=>'required|numeric',
            'judge_score'=>'required|numeric',
            'time'=>'required|numeric',
            'start_time'=>'required|date_format:Y-m-d\TG:i|before:'.$end_time->toDateTimeString(),
            'end_time'=>'required|date_format:Y-m-d\TG:i'
        ]);
        $paper = Paper::find($id);
        $paper->fill([
            'title' => $request->get('name'),
            'multi_score' => $request->get('multi_score'),
            'judge_score' => $request->get('judge_score'),
            'time' => $request->get('time'),
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time')
        ]);
        if($paper->save())
            return redirect('admin/papers');
        else
            return redirect()->back()->withInput()->withErrors('保存失败！');
    }

    public function destroy($id) {
        $paper = Paper::find($id);
        $paper->questions()->sync([]);
        $paper->delete();
        return redirect()->back();
    }

    public function create() {
        return view('admin.papers.create');
    }

    public function store(Request $request) {
        $start_time = Carbon::parse($request->get('start_time'));
        $end_time = Carbon::parse($request->get('end_time'));
        $this->validate($request, [
            'name'=>'required|unique:papers,title',
            'multi_score'=>'required|numeric',
            'judge_score'=>'required|numeric',
            'time'=>'required|numeric',
            'start_time'=>'required|date_format:Y-m-d\TG:i|before:'.$end_time->toDateTimeString(),
            'end_time'=>'required|date_format:Y-m-d\TG:i'
        ]);
        if(Paper::create([
            'title' => $request->get('name'),
            'multi_score' => $request->get('multi_score'),
            'judge_score' => $request->get('judge_score'),
            'time' => $request->get('time'),
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time')
        ]))
            return redirect('admin/papers');
        else
            return redirect()->back()->withInput()->withErrors('保存失败！');
    }
    public function exam($id) {
        return view('paper.exam', [
            'paper'=>Paper::find($id),
        ]);
    }
}
