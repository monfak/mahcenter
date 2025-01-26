<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class QuestionController extends Controller
{
    /**
     * QuestionController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:questions-manage');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $questions = Question::latest()->paginate();
        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $products = Product::pluck('name', 'id')->toArray();
        $users = User::get();
        return view('admin.questions.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $questionData = $request->only(['user_id', 'product_id', 'ip', 'title', 'status']);
        $question = Question::create($questionData);
	    success('نظر با موفقیت ثبت شد.');
	    return redirect()->route('admin.questions.index');
	}

    /**
     * Show the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(Question $question)
    {
        $question->load('answers');
        return view('admin.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        if($request->input('answer')) {
            $answer = Answer::create([
                'content'       => $request->input('answer'),
                'question_id'   => $question->id,
            ]);
        }
        success();
        return redirect()->route('admin.questions.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $question = Question::findorFail($id);

        if (isset($data['active'])) {
            $stat = $data['active'];
            $stat = ($stat == 1 ? 1 : 0);
            $question->status = $stat;
            $question->save();
        }

        if ( isset($data['delete'] )) {
            $question->delete();
        }

        success();
        return redirect()->route('admin.questions.index');
    }
}
