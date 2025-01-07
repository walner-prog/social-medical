<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
 
class DropzoneController extends Controller
{
    /**
     * Generate Image upload View
     *
     * @return void
     */
    public function index(): View
    {
        $images = Image::where('user_id', Auth::id())->latest()->take(12)->get(); 
        return view('dropzone', compact('images'));
    }

    public function galeryImage(): View
    {
        
        return view('galery');
    }
    
    
    /**
     * Image Upload Code
     *
     * @return void
     */
    public function store(Request $request): JsonResponse
    {
        // Initialize an array to store image information
        $images = [];
  
        // Process each uploaded image
        foreach($request->file('files') as $image) {
            // Generate a unique name for the image
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
              
            // Move the image to the desired location
           // $image->move(public_path('images'), $imageName);
            $image->move(public_path('images/dropzone'), $imageName);

  
            // Add image information to the array
            $images[] = [
                'name' => $imageName,
                'path' => asset('/images/dropzone/'. $imageName),
                'filesize' => filesize(public_path('images/dropzone/'.$imageName)),
                'user_id' => Auth::id(), // Asociar la imagen con el usuario autenticado
            ];
        }
  
        // Store images in the database using create method
        foreach ($images as $imageData) {
            Image::create($imageData);
        }
     
        return response()->json(['success'=>$images]);
    }
}
