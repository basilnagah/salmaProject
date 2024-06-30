<?php

namespace App\services;

use App\Models\Media;
use Illuminate\Support\Str;

class MediaService
{
    
    function createMediaSettings($image, $model)
    {          
        $data = [
            'filename' => "AppSetting/" . time(). Str::random(10) . $image->getClientOriginalName(),
            'filetype' => $image->getClientMimeType(),
            'type' => 'image',
        ];
        
        $image->move(public_path('AppSetting'), $data['filename']);
        $model->image()->create($data);

        return $data['filename'];
    }

    function updateMediaSettings($image, $model)
    {

        // Check if there's an existing image associated with the model
        $existingImage = $model->image;

        if ($existingImage) {
            // Delete the old image file
            $oldImagePath =  $existingImage->filename;

            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Delete the old image record from the database
            $existingImage->delete();
        }
        
        $data = [
        'filename' => "AppSetting/" . time(). Str::random(10) . $image->getClientOriginalName(),
        'filetype' => $image->getClientMimeType(),
        'type' => 'image',
        ];
        
        $image->move(public_path('AppSetting'), $data['filename']);
        $model->image()->create($data);

        return $data['filename'];

    }

    // function createMedia($image, $model)
    // {          
    //     // if ($request->hasFile('image')) {
    //     //     $image = $request->file('image');

    //         // Check if there's an existing image associated with the model
    //         $existingImage = $model->image;

    //         if ($existingImage) {
    //             // Delete the old image file
    //             $oldImagePath = public_path('products') . '/' . $existingImage->filename;

    //             if (file_exists($oldImagePath)) {
    //                 unlink($oldImagePath);
    //             }

    //             // Delete the old image record from the database
    //             $existingImage->delete();

    //         }

    //         // Continue with the code to store the new image
    //         $data = [
    //             'filename' => "products/" . time() . $image->getClientOriginalName(),
    //             'filetype' => $image->getClientMimeType(),
    //             'type' => 'image',
    //             // 'createBy_type' => get_class($model),
    //             // 'createBy_id' => $model->id,
    //             // 'updateBy_type' => null,
    //             // 'updateBy_id' => null,
    //         ];
            
    //         $image->move(public_path('products'), $data['filename']);
    //         // $model->image()->updateOrCreate(['createBy_id' => $model->id], $data);
    //         $model->image()->updateOrCreate($data); //['createBy_id' => $model->id],
    //         return $data['filename'];
    //     // }
    // }

    function createMedia($image, $model, $colorId)
    {          
        // Check if there's an existing image associated with the model
        // $existingImage = $model->image()->where('color_id', $colorId)->first();
        // $existingImage = $model->image();

        // if ($existingImage) {
        //     // Delete the old image file
        //     $oldImagePath = public_path('products') . '/' . $existingImage->filename;

        //     if (file_exists($oldImagePath)) {
        //         unlink($oldImagePath);
        //     }

        //     // Delete the old image record from the database
        //     $existingImage->delete();
        // }
        // $string = str_random(15);
        // Store the new image
        $data = [
            'filename' => "products/" . time(). Str::random(10) . $image->getClientOriginalName(),
            'filetype' => $image->getClientMimeType(),
            'type' => 'image',
            'color_id' => $colorId,
        ];
        
        $image->move(public_path('products'), $data['filename']);
        $model->image()->create($data);

        return $data['filename'];
    }

    function deleteMedia($model)
    {
        // Check if there's an existing image associated with the model
        $existingImage = $model->image;

        if ($existingImage) {
            // Delete the old image file
            $oldImagePath = public_path('products') . '/' . $existingImage->filename;

            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Delete the old image record from the database
            $existingImage->delete();
        }
    }

    function deleteAppsettingMedia($model)
    {
        // Check if there's an existing image associated with the model
        $existingImage = $model->image;

        if ($existingImage) {
            // Delete the old image file
            $oldImagePath =  $existingImage->filename;
            // public_path('AppSetting') . '/' .
            // return $oldImagePath;

            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Delete the old image record from the database
            $existingImage->delete();
        }
    }

    // function deleteProductMedia($model)
    // {
    //         $existingImages = $model->image->get();
             
    //         if ($existingImages) {
    //             // Delete the old image file
    //             foreach($existingImages as $image)
    //             {
    //                 $oldImagePath = public_path('products') . '/' . $image->filename;

    //                 if (file_exists($oldImagePath)) {
    //                     unlink($oldImagePath);
    //                 }
    
    //                 // Delete the old image record from the database
    //                 $image->delete();
    //             }
                
    //         }
    // }

    function deleteProductMedia($model)
{
    $existingImages = $model->image()->get();
     
    if ($existingImages) {
        // Delete the old image files
        foreach ($existingImages as $image) {
            $oldImagePath = public_path($image->filename);
            // return $oldImagePath;

            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Delete the old image record from the database
            $image->delete();
        }
    }
}


}
