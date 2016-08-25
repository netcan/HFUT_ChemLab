<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Paper;
use App\Question;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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
        $paper = Paper::find($id);
        $user = Auth::user();
        if($user->isStudent()) {
            if(! $user->papers()->find($id))
                $user->papers()->attach($id, [
                    'start_time'=>Carbon::now(),
                    'end_time'=>Carbon::now()->addMinutes($paper->time)->min(Carbon::parse($paper->end_time)),
                ]);
        }
        return view('paper.exam', [
            'paper'=>$paper,
        ]);
    }
    public function examRemainTime($id) {
        $pivot = Auth::user()->papers()->find($id)->pivot;
        $start_time = Carbon::parse($pivot->start_time);
        $end_time = Carbon::parse($pivot->end_time);
        $now = Carbon::now();
        $all = $start_time->diffInSeconds($end_time);
        $timeUsed = $start_time->diffInSeconds($now);
        $remainTime = $all - $timeUsed;
        $remainTime_minute = $remainTime / 60;

        if($now >= $end_time)
            return \Response::json([
                'all'=>$all,
                'timeUsed'=>$timeUsed,
                'remainTime'=>0,
                'remainTime_Minute'=>0,
                'percent'=>'100%',
            ]);
        else
            return \Response::json([
                'all'=>$all,
                'timeUsed'=>$timeUsed,
                'remainTime'=>$remainTime,
                'remainTime_Minute'=>round($remainTime_minute),
                'percent'=>sprintf('%0.1f%%',$timeUsed*100/$all),
            ]);
    }
}
