<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use JWTAuth;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        // if(!$user = JWTAuth::parseToken()->authenticate()){
        //     return response()->json(['message' => 'User not found'], 404);
        // }
        $user = JWTAuth::parseToken()->toUser();
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->save();
        return response()->json(['comment' => $comment, 'user' => $user], 200);
    }

    public function getComments()
    {
        $comment = Comment::all();
        if(!$comment)
        {
            return response()->json(['message'=>"not found"],404);
        }
        $response = [
            'comments' => $comment
        ];
        error_log(implode("",$response));//print in console, implode is function for converting
                                        //array to string
        return response()->json($response, 200);
    }

    public function updateComment(Request $request, $id)
    {
        $comment = Comment::find($id);
        if(!$comment)
        {
            return response()->json(['message' => "Not found"], 404);
        }

        $comment->content = $request->input('content');
        $comment->save();
        return response()->json(['comment' => $comment], 200);
    }

    public function deleteComment(Request $request, $id)
    {
        $comment = Comment::find($id);
        if(!$comment)
        {
            return response()->json(['message'=>'not found'], 404);
        }
        $comment->delete();
        return response()->json(['message' => 'deleted'], 200);
    }
}