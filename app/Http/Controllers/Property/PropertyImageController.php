<?php

namespace App\Http\Controllers\Property; 

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Http\Requests\Property\PropertyImageRequest;
use Illuminate\Support\Facades\Request;

class PropertyImageController extends Controller
{
    public function store(PropertyImageRequest $request, $propertyId)
    {
        // Fetch the property
        $property = Property::findOrFail($propertyId);

        // Initialize an array to store image paths
        $storedImages = [];

        // Process each image
        foreach ($request->file('images') as $image) {
            // Generate a unique name for the image
            $imageName = time() . '-' .  $image->getClientOriginalName();

            // Use the move method to store the image in the 'property-images' folder
            $image->move(public_path('property-images'), $imageName);

            $fullName = url('property-images/' . $imageName);

            // Save the image to the database
            $propertyImage = PropertyImage::create([
                'property_id' => $property->id,
                'image_path' =>  $fullName, // Store the relative path
            ]);

            // Add the saved image to the response array
            $storedImages[] = $propertyImage;
        }

        // Return a success response
        return response()->json([
            'message' => 'Images uploaded successfully!',
            'images' => $storedImages,
        ], 200);
    }

    public function updateThumbnail($propertyImageId)
    {
        // Fetch the property image
        $propertyImage = PropertyImage::findOrFail($propertyImageId);

        // Ensure all other images for the same property are not thumbnails
        PropertyImage::where('property_id', $propertyImage->property_id)
            ->update(['is_thumbnail' => 0]);

        // Update the specified image to be the thumbnail
        $propertyImage->is_thumbnail = 1;
        $propertyImage->save();

        // Return a success response
        return response()->json([
            'message' => 'Thumbnail updated successfully!',
            'property_image' => $propertyImage
        ], 200);
    }

}