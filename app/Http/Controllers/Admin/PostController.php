<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\TagsParsingService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // użytkownik mysi być zalogowany
        $this->middleware('can:manage-posts'); // podpowiada ślicznie to co zdefiniowaliśmy w AuthServiceProvider.php
    }

    protected function validator($data)
    {
        //$id = isset($data['id']) ? ','.$data['id'].',id':'';
        $validated = Validator::make($data, [
            //'title' => 'required|max:255|unique:posts,title',
            'title' => "required|unique:posts,title,{$data['id']}", //do edycji posta
            'type' => 'required|in:text,photo',
            'date' => 'nullable|date',
            'tags' => 'nullable',
            'image' => 'nullable|max:6995|image',
            'content' => 'nullable',
            'published' => 'boolean',
            'premium' => 'boolean'
        ])->validate();
        $validated = Arr::add($validated, 'published', 0);
        $validated = Arr::add($validated, 'premium', 0);

        return $validated;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|void
     */
    public function create()
    {
        //
      return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $request['id'] = ''; //do edycji posta
        $data = $this->validator($request->all());
        if (isset($data['image'])) {
            $path = $request->file('image')->store('photos');
            $data['image'] = $path;
        }

        $data['user_id'] = $request->user()->id;

        $post = Post::create($data);

        if (isset($data['tags'])) {
            $tags = TagsParsingService::parse($data['tags']);
            $post->tags()->sync($tags);
        }

        session()->flash('message', 'Post has been added!');

        return redirect(route('posts.single', $post->slug));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function edit(int $id)
    {
        $post = Post::findOrfail($id);
        return  view('admin.post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $post = Post::findOrFail($id);
        $oldImage = $post->image;
        $request['id'] = $post->id; //do edycji posta

        $data = $this->validator($request->all());

        if (isset($data['image'])) {
            $path = $request->file('image')->store('photos');
            $data['image'] = $path;
        }

        $post->update($data);

        if (isset($data['tags'])) {
            $tags = TagsParsingService::parse($data['tags']);
            $post->tags()->sync($tags);
        }

        if (isset($data['image']) AND isset($oldImage)) {
            Storage::move($oldImage, "delete/$oldImage");
           // Storage::delete($oldImage);
        }

        // return back()->with('message', 'Post has been updated!');
        session()->flash('message', 'Post has been updated!');
        return redirect(route('posts.single', $post->slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector|void
     */
    public function destroy(int $id)
    {
        $post = Post::FindOrFail($id);
        $post->delete();

       // Storage::delete($post->image);
        if($post->image) {
            Storage::move($post->image, "delete/$post->image");
        }
        return redirect('/')->with('message','Post has been deleted!');
    }
}
