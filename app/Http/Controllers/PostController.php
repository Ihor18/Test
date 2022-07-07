<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\VoteRequest;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Upvote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return PostResource::collection(Post::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request): \Illuminate\Http\Response
    {
        try {
            Post::create($request->validated());

            return response('Created!', 201);
        } catch (\Exception $ex) {
            return response('Something wrong', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return PostResource
     */
    public function show(Post $post): PostResource
    {
        return new PostResource($post->load('comments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostRequest $request
     * @param  Post        $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post): \Illuminate\Http\Response
    {
        try {
            $post->update($request->validated());

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
    public function destroy(int $id): \Illuminate\Http\Response
    {
        $post = Post::find($id);

        if ($post) {
            DB::transaction(
                function () use ($post) {
                    Comment::where('post_id', $post->id)->delete();
                    Upvote::where('post_id', $post->id)->delete();
                    $post->delete();
                }
            );
        }

        return response()->noContent();
    }


    /**
     * @param  Post    $post
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function vote(VoteRequest $request, Post $post): \Illuminate\Http\Response
    {
        $request = $request->validated();

        $vote = Upvote::where('author_name', $request['name'])
            ->where('post_id', $post->id)->first();

        if (!$vote) {
            $post->increment('upvote_count');
            Upvote::create(
                [
                'author_name' => $request['name'],
                'post_id' => $post->id
                ]
            );

            return response('OK');
        }

        return response('You have already voted');
    }
}
