<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlbumRequest;
use App\Models\Category;
use App\Models\Album;
use App\Models\Tag;
use App\Traits\SlugCreater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    use SlugCreater;

    public function __construct()
    {
        $this->authorizeResource(Album::class, 'album');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Album::with(['category:id,name', 'user:id,name'])->latest()->paginate(15);

        return view('admin.album.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.album.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        $post_data = $request->except('image');
// dd($post_data);
        if ($request->hasfile('image')) {
            $get_file = $request->file('image')->store('images/albums');
            $post_data['image'] = $get_file;
        }

        $post = Album::create($post_data);

// return $post;
        return to_route('admin.album.index')->with('message', trans('admin.album_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        $categories = Category::all();
        $post=Album::find($post);
// dd($post);
        return view('admin.album.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $request, $post)
    {
        $post_data = $request->except('image');
        $post=Album::find($post);
        if ($request->hasfile('image')) {
            Storage::delete($post->image);
            $get_file = $request->file('image')->store('images/albums');
            $post_data['image'] = $get_file;
        }

        $post->update($post_data);

        return to_route('admin.album.index')->with('message', trans('admin.album_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $post=Album::find($post);
        if ($post->image != null) {
            Storage::delete($post->image);
        }
        $post->delete();

        return back()->with('message', trans('admin.album_deleted'));
    }

    public function getSlug(Request $request)
    {
        $slug = $this->createSlug($request, Album::class);

        return response()->json(['slug' => $slug]);
    }

    
}
