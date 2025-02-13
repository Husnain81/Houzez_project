<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\SubPropertiesRequest;
use App\Models\Property;
use App\Models\SubProperty;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubPropertiesController extends Controller
{
    // public function createOrUpdate(SubPropertiesRequest $request, Property $property): JsonResponse

    // {
    //     try {
    //         // Step 1: Validate the request data
    //         $data = $request->validated();
    //         $subPropertiesData = $data['subProperties']; 
    //         $storedSubProperties = [];
    
    //         // Step 2: Process each sub-property
    //         foreach ($subPropertiesData as $subProperty) {
    //             if (!empty($subProperty['id'])) {
    //                 // Check if the sub-property exists for this property
    //                 $existingSubProperty = SubProperty::where('id', $subProperty['id'])
    //                     ->where('property_id', $property->id)
    //                     ->first();
    
    //                 if ($existingSubProperty) {
    //                     // Update only provided fields
    //                     $existingSubProperty->update($subProperty);
    //                     $storedSubProperties[] = $existingSubProperty;
    //                 } else {
    //                     \Log::warning("Sub-property with ID {$subProperty['id']} not found for property ID {$property->id}.");
    //                     return response()->json([
    //                         'message' => "Sub-property with ID {$subProperty['id']} not found for this property.",
    //                     ], 404);
    //                 }
    //             } else {
    //                 // Create new sub-property
    //                 $subProperty['property_id'] = $property->id;
    //                 $storedSubProperties[] = $property->subProperties()->create($subProperty);
    //             }
    //         }
    
    //         // Step 3: Return success response
    //         return response()->json([
    //             'message' => 'Sub-properties updated/created successfully!',
    //             'subProperties' => $storedSubProperties,
    //         ], 200);
    
    //     } catch (ValidationException $e) {
    //         return response()->json([
    //             'message' => 'Validation failed.',
    //             'errors' => $e->errors(),
    //         ], 422);
    //     } catch (\Exception $e) {
    //         \Log::error("Error in createOrUpdate: " . $e->getMessage());
    //         return response()->json([
    //             'message' => 'An error occurred while processing the request.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }



 

    public function storeOrUpdateSubProperties(SubPropertiesRequest $request, $property_id)
    {
        // Check if the property exists
        $property = Property::find($property_id);
    
        if (!$property) {
            return response()->json(['message' => 'Property not found'], 404);
        }
    
        $validatedData = $request->validated();
    
        $response = []; 
    
        foreach ($validatedData['subproperties'] as $subpropertyData) {
            if (!empty($subpropertyData['id'])) {
                // Update existing subproperty if it belongs to the given property
                $subproperty = SubProperty::where('id', $subpropertyData['id'])
                                          ->where('property_id', $property_id)
                                          ->first();
    
                if ($subproperty) {
                    $subproperty->update($subpropertyData);
                    $response[] = ['message' => 'SubProperty updated', 'data' => $subproperty];
                    continue;
                }
            }
    
            // Create a new subproperty if ID is not provided or not found
            $newSubproperty = SubProperty::create(array_merge($subpropertyData, ['property_id' => $property_id]));
            $response[] = ['message' => 'SubProperty created', 'data' => $newSubproperty];
        }
    
        return response()->json($response, 200);
    }
    
    
}
