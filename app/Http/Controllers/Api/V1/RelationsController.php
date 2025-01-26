<?php

namespace App\Http\Controllers\APi\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Resources\TagResource;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class RelationsController extends Controller
{
   /**
     * Get lessons associated with the user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userLessons($id)
    {
        $user = User::with('lessons')->findOrFail($id);
        $lessons = $user->lessons->map(function ($lesson) {
            return [
                'Title' => $lesson->title,
                'Content' => $lesson->body,
            ];
        });

        return Response::json([
            'data' => $lessons,
        ], 200);
    }


  /**
     * Get tags associated with the lesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lessonTags($id)
    {
        $lesson = Lesson::with('tags')->findOrFail($id);
        $tags = $lesson->tags->map(function ($tag) {
            return [
                'Tag' => $tag->name,
            ];
        });

        return Response::json([
            'data' => $tags,
        ], 200);
    }

/**
     * Get lessons associated with the tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tagLessons($id)
    {
        $tag = Tag::with('lessons')->findOrFail($id);
        $lessons = $tag->lessons->map(function ($lesson) {
            return [
                'Title' => $lesson->title,
                'Content' => $lesson->body,
            ];
        });

        return Response::json([
            'data' => $lessons,
        ], 200);
    }
}