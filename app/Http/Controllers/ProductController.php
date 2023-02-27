<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /*
      Display a listing of the resource.
      @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //echo('<h1 style="text-align: center">CRUD OPERATIONS PROJECT</h1>');
        //return view('products.index');

        $products = Product::all();
        
        return view('products.index', compact('products'));
        //return view('products.index', ['products' => $products]); //the data can be passed to view like an array too
    }
    //_____________________________________________________________________________________

    /*
      Show the form for creating a new resource.
      @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }
//_____________________________________________________________________________________

    /*
     Store a newly created resource in storage.
     @param  \Illuminate\Http\Request  $request
     @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail| required| min:2|max:100',
            'description' => 'required| min:10',
            'filenames' => 'required',
            'filenames.*' => 'mimes:doc,pdf,docx,zip,png,jpge,jpg',
            'price' => 'required',
        ]);

        ##tried and tested this code while storing file as path

        //     if($request->hasfile('filenames'))
        // {
        //    foreach($request->file('filenames') as $file)
        //    {
        //        $name = time().'.'.$file->extension();
        //        $file->move(base_path() . '/storage/app/public', $name);
        //        $data[] = $name; //output = ["filepath"]
        //    }
        // }


        //$filename = time() . "." . $request->file('filenames')->getClientOriginalName();
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        //$request->file('file')->store('files'); ## this stores the file in the storage folder
                  
        //json_encode($data); //tried and tested code conti...
        $product->price = $request->input('price');
       
        if($request->hasFile('filenames')){
            $filename = time() . "." . $request->file('filenames')->getClientOriginalName();
            $product->filenames = $request->file('filenames')->storeAs('public/files', $filename);
        }
        $product->save();

        ##alternate method to create a new record and store without calling save() method

        // Product::create([
        //     'name' => request('name'),
        //     'description' => request('description'),
        //     'filenames' => request('filenames'),
        //     'price' => request('price')
        // ]);
          
        return redirect()->route('products.index');



        ## code references from google that helped me solve my files store issues

        // {
        //     $this->validate($request, [
        //             'filenames' => 'required',
        //             'filenames.*' => 'mimes:doc,pdf,docx,zip,png,jpge,jpg'
        //     ]);
        //     if($request->hasfile('filenames'))
        //      {
        //         foreach($request->file('filenames') as $file)
        //         {
        //             $name = time().'.'.$file->extension();
        //             $file->move(base_path() . '/storage/app/public', $name);
        //             $data[] = $name;
        //         }
        //      }
        //      $file= new File();
        //      $file->filenames=json_encode($data);
        //      $file->save();
        //     return back()->with('success', 'Your files has been send successfully');
        // }
    }
   //_____________________________________________________________________________________

    ##downloading the file that was uploaded
    public function fileDownload(Product $product)
    {
        ## code references from google that helped me solve my file download issues

        // $myFile = storage_path("/public/files{ $product->filenames }");
        //echo asset('storage/file.txt');
        //return Storage::download(storage_path('/app/'.$path));
        //return Storage::disk('public')->get(storage_path().'/app/'.$path);
        //return response()->download(storage_path('app\public\files\1677132417.library_Qry.txt'));

        $path = Product::where("id", $product->id)->value("filenames");
        return response()->download(storage_path('/app/' . $path)); ##here the /app/ appends to the storage_path path. the filenames value
            
    }
   

    ## code references from google that helped me solve my file download issues

    // public function downloadFile($id){
    //     $path = Student::where("id", $id)->value("file_path");
    //     return Storage::download($path);
    //   }
 //_____________________________________________________________________________________


    ##my softdeleted records view page - same as index page but with only softdeleted records
    public function archive()
    {
        $products = Product::onlyTrashed()->get();
        return view('products.archive', compact('products'));
    }
 //_____________________________________________________________________________________


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',  ['product' => Product::find($product->id)]);
    }
 //_____________________________________________________________________________________

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
       // echo storage_path();
        return view('products.edit', ['product' => $product]);
    }
 //_____________________________________________________________________________________


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    { 
            $request->validate([
                'name' => 'bail| required| min:2|max:100',
                'description' => 'required| min:10',
                'filenames' => 'required',
                'filenames.*' => 'mimes:doc,pdf,docx,zip,png,jpge,jpg',
                'price' => 'required',
            ]);
            $filename = time() . "." . $request->file('filenames')->getClientOriginalName();
            $product->filenames = $request->file('filenames')->storeAs('public/files', $filename);

    
            $product->update($request->all());

            return redirect()->route('products.index');
            // $validated = $request->validated();
            // $product->fill($validated);
            // $product->save();

            // $request->session()->flash('status', 'Blog Post was updated!');
            // return back();
            //return redirect()->route('poroducts.edit', ['product' => $product]);
        }


 //____________________________________________________________________________________


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {


        // $product = Product::withTrashed()->findOrFail($product->id);
        // if($product->trashed()){
        //     $product->forceDelete();
        //    return redirect()->route('products.index');
        // }
        // if($product->deleted_at == null){
        //     $product->delete();
        //   }
        //   else {
        //     $product->forceDelete();
        //   }
        $product->delete();
        return redirect()->route('products.index');
    }


    public function restore(Product $product, Request $request)
    {
        $product->restore();

        // return redirect()->route('products.index');
        return redirect()->back();
    }

    public function deleteForce(Product $product)
    {
        $product->onlyTrashed()->find($product->id)->forceDelete();

        return redirect()->back();
    }

    // public function restore(Product $product)
    // {
    //     Product::withTrashed()->find($product)->restore();

    //     return back()->with('success', 'Post Restore successfully');
    // }

    // public function restore_all()
    // {
    //     Product::onlyTrashed()->restore();

    //     return back()->with('success', 'All Post Restored successfully');
    // }
}
