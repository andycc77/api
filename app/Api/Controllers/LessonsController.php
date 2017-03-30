<?php
/**
 * Created by PhpStorm.
 * User: chenallen
 * Date: 2017/3/30
 * Time: 下午2:17
 */

namespace App\Api\Controllers;

use App\Api\Transformers\LessonTransformer;
use App\Lesson;
use Illuminate\Http\Request;
//use Dingo\Api\Http\Request;
class LessonsController extends BaseController
{
    public function index()
    {
        $lessons = Lesson::all();
        return $this->collection($lessons,new LessonTransformer());
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);
        if(! $lesson){
            return $this->response->errorNotFound('Lesson not found');
        }
        return $this->item($lesson,new LessonTransformer());
    }

    public function store(Request $request)
    {
        if(! $request->get('title') && ! $request->get('body')){
            return $this->response->errorNotFound('validate fails');
        }
        Lesson::create($request->all());
        return $this->response->created();
    }

    public function update(Request $request, $id)
    {
        if(! $request->get('title') && ! $request->get('body')){
            return $this->response->errorNotFound('validate fails');
        }
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());
        return $this->response->item($lesson,new LessonTransformer());
    }

    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();
        return $this->response->noContent();
    }

    public function images(Request $request)
    {
        $file = $request->file('image');

        $destinationPath = 'uploads/';
        $filename = $file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        return $this->response->created();
    }
}