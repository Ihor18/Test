<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CommentResource::collection(Comment::paginate(10));
    }


    /**
     * @param  int $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getByPost(int $id)
    {
        return CommentResource::collection(Comment::where('post_id', $id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, Post $post)
    {
        try {
            $data = $request->validated();
            $data['post_id'] = $post->id;
            Comment::create($data);
            return response('Created!', 201);
        } catch (\Exception $ex) {
            return response('Something wrong', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Comment $comment
     * @return CommentResource
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CommentRequest $request
     * @param  Comment        $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        try {
            $comment->update($request->validated());

            return response('Updated!', 200);
        } catch (\Exception $ex) {
            return response('Something wrong', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
        }

        return response()->noContent();
    }
}
