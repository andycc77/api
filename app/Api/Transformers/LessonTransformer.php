<?php
/**
 * Created by PhpStorm.
 * User: chenallen
 * Date: 2017/3/25
 * Time: 下午2:55
 */

namespace App\Api\Transformers;


use App\Lesson;
use League\Fractal\TransformerAbstract;

class LessonTransformer extends TransformerAbstract
{
    public function transform(Lesson $lesson)
    {
        return [
            'title'=>$lesson['title'],
            'content'=>$lesson['body'],
            'is_free'=>(boolean)$lesson['free']
        ];
    }
}