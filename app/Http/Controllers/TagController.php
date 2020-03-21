<?php

namespace App\Http\Controllers;
use Session;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::paginate(env('PAGINATION_COUNT'));
        $pagState = true;

        return view('admin.tags.tags')->with(
            [
               'tags' => $tags,
               'pagState' =>$pagState,
            ]);
    }

    private function tagNameExists($tagName)
    {
        $tag = Tag::where(
            'tag', '=', $tagName
        )->first();

        if (!is_null($tag)) {
            Session::flash('status', 'Tag Name Already Existed!');
            return false;
        }
        return true;
    }

  
    public function store(Request $request)
    {

        //validate the forms by their names
        $request->validate([
            'tag-name' => 'required',
        ]);

        $tagName = $request->input('tag-name');

        if (!$this->tagNameExists($tagName)) {
            return redirect()->back();
        }


        $tag = new Tag();

        $tag->tag = $tagName;
        $tag->save();

        $request->session()->flash('status', 'Tag Added !');

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $id = $request->input('edit_id');
        $request->validate([
            'tag-update' => 'required',
        ]);

        $tagName = $request->input('tag-update');
       

        if (!$this->tagNameExists($tagName)) {
            return redirect()->back();
        }
      
   

        $tag = Tag::findOrFail($id);
        $tag->tag = $tagName;
        $tag->save();

        Session::flash('status', 'Tag Updated');

        return redirect()->back();

    }


    public function search(Request $request){
        // dd($request);
        $pagState = false;
        $request->validate([
            'tag_search' => 'required',
        ]);

        $searchTerm = $request->input('tag_search');

        $tags = Tag::where('tag','like','%'.$searchTerm.'%')->paginate();//we use paginate because in index action we used the same id name units and we had paginatation
        // dd($units);
        if(count($tags)>0){
            return view('admin.tags.tags')->with([
                'tags' => $tags,
                'pagState' =>$pagState,
                ]);
        }else{
        $request->session()->flash('status','This Item Not Found !');
        }
        return redirect()->route('tags');
        
    }

    public function delete(Request $request)
    {

        $id = $request->input('delete_id');
        if (is_null($id) || empty($id)) {
            $request->session()->flash('status', 'Tag Is Required !');
            return redirect()->back();
        }

        $tag = Tag::findOrFail($id);
        // dd($tag);
        $tag->delete();

        $request->session()->flash('status', 'Tag Deleted !');

        return redirect()->back();

    }

}

