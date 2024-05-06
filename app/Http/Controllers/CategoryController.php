<?php

namespace App\Http\Controllers;

use ApiResponse;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoriesResource;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
   
        $categories = Category::all();
        if(count($categories) > 0) {
            return ApiResponse::apiResponse(200, 'Categories retieve successfully', CategoriesResource::collection($categories));
        } else {
            return ApiResponse::apiResponse(200, 'No categories found yet');
        }
    }

   
    public function create(){
    
       
    }

    
    public function store(StoreCategoryRequest $request) {

        $validatedData = $request->validated();
         $category = Category::create($validatedData);

         if($category) {
            return ApiResponse::apiResponse(200, 'Category created successfully', new CategoriesResource($category));
         } else {
            return ApiResponse::apiResponse(401, 'Category not created');
         }

   
      
    }

  
    public function show($id) {
   
      
    }

  
    public function edit($id) {
   
        
    }

    
    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);
    
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        // Update the category with the validated name
        $category->name = $validatedData['name'];
        $updatedCategory = $category->save(); // Save the changes to the database
    
        if ($updatedCategory) {
            return ApiResponse::apiResponse(200, 'Category updated successfully', new CategoriesResource($category));
        } else {
            return ApiResponse::apiResponse(401, 'Category did not update');
        }
    }
    

   
    public function destroy($id) {
        $category = Category::findOrFail($id);
        if($category->delete()){
            return ApiResponse::apiResponse(200, 'Category deleted successfully');

        }
        
    }
}
