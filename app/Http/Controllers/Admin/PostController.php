<?php

namespace App\Http\Controllers\Admin;
use App\Model\Post;
use App\Model\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags= Tag::all(); // richiamo tutti i tag
        return view('admin.posts.create', ['tags'=> $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // facciamo controllo per non permettere ad untenti con id diverso di modificare creare ecc
        if (Auth::user()->id != $data['user_id']) {
            abort('404');
        }
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'tags.*' => 'exists:App\Model\Tag,id' //controllo su un array per vedere se gli elementi esistono 
        ]);


        // $slug = Str::slug($data['title'], '-');
        // $postPresente = Post::where('slug', $slug)->first(); //controllo se lo slug e'univoco

        // $counter = 0;
        // while ($postPresente){
        //     $slug = $slug . '-' . $counter;
        //     $postPresente = Post::where('slug', $slug)->first();
        //     $counter++;
        // }
        $slug= Post::createSlug($data['title']);

        $newPost = new Post();
        $newPost->fill($data);
        $newPost->slug = $slug;
        $newPost->save();

        //controllo per vedere se tags é riempito 
        if(!empty($data['tags'])){
            $newPost->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', ['post' => $newPost]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //if per vedere se sono l'autore del post o no 
        if (Auth::user()->id != $post->user_id && !Auth::user()->roles()->get()->contains(1)) {
            abort('403');
        }

        $tags = Tag::all(); // richiamo i tag

        return view('admin.posts.edit', ['post' => $post, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        //if per vedere se sono l'autore del post o no 
        if (Auth::user()->id != $post->user_id && !Auth::user()->roles()->get()->contains(1)) {
            abort('403');
        }
        //validazione dati 
        $postValidate = $request->validate(
            [
                'title' => 'required|max:240',
                'content' => 'required',
                'tags.*' => 'nullable|exists:App\Model\Tag,id',
            ]
        );


        //controlliamo se i $data sono stati cambiati
        if ($data['title'] != $post->title) {
            $post->title = $data['title'];
            $post->slug = $post->createSlug($data['title']);
        }
        if ($data['content'] != $post->content) {
            $post->content = $data['content'];
        }

        //update del salvataggio su database
        $post->update();

        return redirect()->route('admin.posts.show', $post);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', "Post id $post->id cancellato");
    }
}
