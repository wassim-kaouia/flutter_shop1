<?php

namespace App\Http\Controllers;

use Session;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::paginate(env('PAGINATION_COUNT'));
        $paginationState = true;

        return view('admin.categories.categories')->with([
            'categories' => $categories,
            'pagState' => $paginationState,
            ]);
    }
    private function unitNameExists($unitName)
    {
        $unit = Unit::where(
            'unit_name', '=', $unitName
        )->first();

        if (!is_null($unit)) {
            Session::flash('status', 'Unit Name Already Existed!');
            return false;
        }
        return true;
    }

    private function categoryNameExists($categoryName)
    {
        $unit = Category::where(
            'name', '=', $categoryName
        )->first();

        if (!is_null($unit)) {
            Session::flash('status', 'Category Name Already Existed!');
            return false;
        }
        return true;

    }
    public function store(Request $request)
    {

        //validate the forms by their names
        $request->validate([
            'category-name' => 'required',
        ]);

        $categoryName = $request->input('category-name');
        

        if (!$this->categoryNameExists($categoryName)) {
            return redirect()->back();
        }


        $category = new Category();

        $category->name = $categoryName;
        $category->save();

        $request->session()->flash('status', 'Category Added !');

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $id = $request->input('edit_id');
        $request->validate([
            'category-update' => 'required',
        ]);

        $categoryName = $request->input('category-update');

        if (!$this->categoryNameExists($categoryName)) {
            return redirect()->back();
        }
 

        $category = Category::findOrFail($id);

        $category->name = $categoryName;
        $category->save();

        Session::flash('status', 'Category Updated');

        return redirect()->back();

    }


    public function search(Request $request){
        // dd($request);
        $paginationState = false;
        $request->validate([
            'category_search' => 'required',
        ]);

        $searchTerm = $request->input('category_search');

        $categories = Category::where('name','like','%'.$searchTerm.'%')
                   ->get();//we use paginate because in index action we used the same id name units and we had paginatation
        // dd($units);
        if(count($categories)>0){
            return view('admin.categories.categories')->with([
                'categories' => $categories,
                'pagState' => $paginationState,
                ]);
        } 
      
        $request->session()->flash('status','This Item Not Found !');
        return redirect()->route('categories');
    }

    public function delete(Request $request)
    {

        $id = $request->input('delete_id');
        if (is_null($id) || empty($id)) {
            $request->session()->flash('status', 'Category Is Required !');
            return redirect()->back();
        }

        $category = Category::findOrFail($id);

        $category->delete();

        $request->session()->flash('status', 'Category Deleted !');

        return redirect()->back();

    }

}

