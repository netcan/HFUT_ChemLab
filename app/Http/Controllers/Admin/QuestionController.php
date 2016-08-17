<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Question;

class QuestionController extends Controller
{
    //
    public static function getAns($type, $ans) {
        return Question::$Ans[$type*4 + $ans];
    }

    public function index(Request $request) {
        if($request->get('filter') == 'all' || $request->get('filter') == null)
            $questions = Question::paginate(10);
        else if($request->get('filter') == 'multi')
            $questions = Question::where('type', 0)->paginate(10);
        else
            $questions = Question::where('type', 1)->paginate(10);

        return view('admin.questions.index', [
            'questions' => $questions,
            'questions_count' => [
                'all' => Question::count(),
                'multi' => Question::where('type', 0)->count(),
                'judge' => Question::where('type', 1)->count()
            ]
        ]);
    }

    public function show($id) {
        $question = Question::find($id);
        return \Response::json($question);
    }

    public function update(Request $request, $id) {
        if($request->type == 0)
            $this->validate($request, [
                'content' => 'required',
                'A' => 'required',
                'B' => 'required',
                'C' => 'required',
                'D' => 'required',
                'ans' => 'required',
            ]);
        else
            $this->validate($request, [
                'content' => 'required',
                'ans' => 'required',
            ]);

        $question = Question::find($id);
        $question->content = $request->get('content');
        $question->A = $request->get('A');
        $question->B = $request->get('B');
        $question->C = $request->get('C');
        $question->D = $request->get('D');
        $question->ans = $request->get('ans');
        $question->save();
        return \Response::json($question);
    }
}
