<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\services\MediaService;
use Illuminate\Http\Request;

class AppSettingsController extends Controller
{
    protected $mediaService;
    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index()
    {
        $appSettings = AppSetting::all();

        return view('admin.AppSettings.index',compact('appSettings'));
    }

    public function create()
    {
        return view('admin.AppSettings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => "required|unique:app_settings,key",
            'title' => "string|nullable",
            'desc' => "string|nullable",
        ]);


        $appSetting = AppSetting::create([
            'key' => $request->key,
            'title' => $request->title ?? null,
            'desc' => $request->desc ?? null,
        ]);

        if($request->hasFile('image'))
        {
            $this->mediaService->createMediaSettings($request->image,$appSetting);
        }

        if($appSetting)
        {
            return redirect(url('appSettingsIndex'))->with('success', 'Data inserted successfully');
        } else {
            return redirect(route('appSettings.create'))->with('error', 'Save failed');
        }

    }

    public function show($id)
    {
        $appSetting = AppSetting::find($id);

        return view('admin.AppSettings.show', compact('appSetting'));
    }

    public function edit($id)
    {
        $appSetting = AppSetting::find($id);

        if($appSetting)
        {
            return view('admin.AppSettings.edit', compact('appSetting'));
        }
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'key' => "required|unique:app_settings,key",
            'title' => "string|nullable",
            'desc' => "string|nullable",
        ]);

        $appSetting = AppSetting::find($id);

        if($request->hasFile('image'))
        {
            $this->mediaService->updateMediaSettings($request->image,$appSetting);
        }

        $appSetting->update([
            'key' => $request->key,
            'title' => $request->title ?? null,
            'desc' => $request->desc ?? null,
        ]);

        return redirect(url('appSettingsIndex'))->with('success', 'Data Updated successfully');

    }

    public function delete($id)
    {
        $appSetting = AppSetting::find($id);

   
        if($appSetting)
        {
            if(isset($appSetting->image))
            {
               $image = $this->mediaService->deleteAppsettingMedia($appSetting);

            }
    
            $appSetting->delete();
            
            return redirect()->back();
        }
        return redirect()->back();
    }


    //==========USER_SIDE============

    public function footerData()
    {
        $footerData = AppSetting::all();

        if($footerData)
        {
            foreach ($footerData as $data)
            {
                if($data->key == 'address') {
                    $address = $data;
                } elseif ($data->key == 'Whatsapp') {
                    $whatsapp = $data;
                } elseif ($data->key == 'instgram') {
                    $instgram = $data;
                } elseif ($data->key == 'facebook') {
                    $facebook = $data;
                }
            }

            return view('user.footer',compact('address', 'whatsapp', 'instgram', 'facebook'));
        }
    }

    public function ReturnPolicy()
    {
        $ReturnPolicy = AppSetting::where('key', 'ReturnPolicy')->first();

        if($ReturnPolicy)
        {
            return view('user.ergaa',compact('ReturnPolicy'));
        }

        return redirect()->back();
    }
    public function shippingPolicy()
    {
        $shippingPolicy = AppSetting::where('key', 'shippingPolicy')->first();

        if($shippingPolicy)
        {
            return view('user.shaan',compact('shippingPolicy'));
        }

        return redirect()->back();
    }
}
