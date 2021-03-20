<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Category;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::when($request->search, function ($q) use ($request) {

                return $q->where('name','like', '%' . $request->search . '%');

            })->when($request->category_id, function ($q) use ($request) {

                return $q->where('category_id', $request->category_id);

            })->latest()->paginate(5);

            return view('dashboard.products.index', compact('categories', 'products'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create' , compact('categories'));

    }


    public function store(Request $request)
    {
      $request->validate([
        'name' => 'required|unique:products,name',
        'description' => 'required',
        'category_id' => 'required',
        'purchase_price' => 'required',
        'sale_price' => 'required',
        'stock' => 'required',


      ]);

      $request_data = $request->all();

      if ($request->image) {

          Image::make($request->image)
              ->resize(300, null, function ($constraint) {
                  $constraint->aspectRatio();
              })
              ->save(public_path('uploads/product_images/' . $request->image->hashName()));

          $request_data['image'] = $request->image->hashName();

      }//end of if

      Product::create($request_data);
      session()->flash('success', __('site.added_successfully'));
      return redirect()->route('dashboard.products.index');

    }//end of store


    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
      $categories = Category::all();
      return view('dashboard.products.edit' , compact('categories' , 'product'));

    }


    public function update(Request $request, Product $product)
    {
      $request->validate([
        'name' => 'required|unique:products,name',
        'description' => 'required',
        'category_id' => 'required',
        'purchase_price' => 'required',
        'sale_price' => 'required',
        'stock' => 'required',
      ]);

      $request_data = $request->all();

      if ($request->image) {

            if ($product->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);

            }//end of if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of if

        $product->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');

    }//end of update



    public function destroy(Product $product)
    {
      if ($product->image != 'default.png') {

          Storage::disk('public_uploads')->delete('/product_images/' . $product->image);

      }//end of if

      $product->delete();
      session()->flash('success', __('site.deleted_successfully'));
      return redirect()->route('dashboard.products.index');
    }//end of destroy
}
