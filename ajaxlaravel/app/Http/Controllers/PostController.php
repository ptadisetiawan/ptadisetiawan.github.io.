<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Propinsi;
use App\Kabupaten;
use App\Kecamatan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //    $categories = Category::all();
    //    $propinsis =  Propinsi::all();
    //    return view('addpost', compact('categories', 'propinsis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['photo'] = null;

        if ($request->hasFile('photo')){
            $input['photo'] = '/upload/photo/'.str_slug($input['title'], '-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('/upload/photo/'), $input['photo']);
        }

        Post::create($input);
    
        return response()->json([
            'success' => true,
            'message' => 'Post Created'
        ]);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('postshow', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $post = Post::findOrFail($id);

        $input['photo'] = $post->photo;

        if ($request->hasFile('photo')){
            if (!$post->photo == NULL){
                unlink(public_path($post->photo));
            }
            $input['photo'] = '/upload/photo/'.str_slug($input['title'], '-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('/upload/photo/'), $input['photo']);
        }

        $post->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Post Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (!$post->photo == NULL){
            unlink(public_path($post->photo));
        }

        Post::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Post Deleted'
        ]);
    }

    public function apiPost()
    {
        
        $post = DB::table('posts')->join('categories', 'posts.category_id', '=', 'categories.id')
                ->select('posts.*', 'categories.category')->get();
        
        return Datatables::of($post)
            ->addColumn('show_photo', function($post){
                if ($post->photo == NULL){
                    return 'No Image';
                }
                return '<img class="rounded-square" width="50" height="50" src="'. url($post->photo) .'" alt="">';

            })
            ->addColumn('action', function($post){
                return '<a onclick="editForm('. $post->id .')" class="btn btn-primary btn-xs" style="color:white;">Edit</a> ' .
                       '<a onclick="deleteData('. $post->id .')" class="btn btn-danger btn-xs" style="color:white;">Delete</a>';
            })
            ->rawColumns(['show_photo', 'action'])->make(true);
        
    }

    public function findKabupaten(Request $request)
    {
        $data = Kabupaten::select('id', 'kabupaten')->where('propinsi_id', $request->id)->get();
        return response()->json($data);
    }
    public function findKecamatan(Request $request)
    {
        $data = Kecamatan::select('id', 'kecamatan')->where('kabupaten_id', $request->id)->get();
        return response()->json($data);
    }

    public function findCategory()
    {
        $data = Category::all();
        return response()->json($data);
    }
    public function findPropinsi()
    {
        $data = Propinsi::all();
        return response()->json($data);
    }

    public function showByCategory($id)
    {
        $posts = DB::table('posts')->join('categories', 'categories.id', '=', 'posts.category_id')->where('category_id', $id)
                        ->select('posts.*', 'categories.category')->get();
        return view('showByCategory', compact('posts'));    
    }

    public function postSearch()
    {
        $posts = Post::all();
        return view('postsearch', compact('posts'));
        // return view('postsearch');
    }

    public function findPostByPropinsi($id)
    {
        $post = Post::where('propinsi_id', $id)->get();
        $jml= count($post);
        if($jml >0){
            return response()->json($post);
        }else{
            $err = null;
            return response()->json($err);
        }
    }
    public function findPostByKabupaten($id)
    {
        $post = Post::where('kabupaten_id', $id)->get();
        $jml= count($post);
        if($jml >0){
            return response()->json($post);
        }else{
            $err = null;
            return response()->json($err);
        }
    }
    public function findPostByKecamatan($id)
    {
        $post = Post::where('kecamatan_id', $id)->get();
        $jml= count($post);
        if($jml >0){
            return response()->json($post);
        }else{
            $err = null;
            return response()->json($err);
        }
    }
    public function findPostByCategory($id)
    {
        $post = Post::where('category_id', $id)->get();
        $jml= count($post);
        if($jml >0){
            return response()->json($post);
        }else{
            $err = null;
            return response()->json($err);
        }
    }
 
    public function findAllPost()
    {
        $post = Post::all();
        $jml= count($post);
        if($jml >0){
            return response()->json($post);
        }else{
            $err = null;
            return response()->json($err);
        }
    }


}
