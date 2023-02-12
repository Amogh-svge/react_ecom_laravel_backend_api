<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site_InfoRequest;
use App\Models\SiteInfo;
use Illuminate\Http\Request;

class SiteInfoController extends Controller
{
    public function allSiteInfo()
    {
        return SiteInfo::all();
    }

    public function manageSiteInfo()
    {
        $site_info = SiteInfo::first();
        return view('admin.siteInfo.manage_site', compact('site_info'));
    }

    public function updateSiteInfo(Site_InfoRequest $request)
    {
        $update_data = [
            'about' => $request->about,
            'refund' => $request->refund,
            'purchase_guide' => $request->purchase_guide,
            'privacy' => $request->privacy,
            'address' => $request->address,
            'facebook_link' => $request->facebook_link,
            'instagram_link' => $request->instagram_link,
            'twitter_link' => $request->twitter_link,
            'ios_app_link' => $request->ios_app_link,
            'android_app_link' => $request->android_app_link,
            'copyright_link' => $request->copyright_link,
        ];

        $update = SiteInfo::find(1)->first()->update($update_data);

        $notification = [
            'alert' => $update ? 'success' : 'failed',
            'message' => $update ?  'Successfully Updated SiteInfo' : 'Failed To Update SiteInfo',
        ];

        return redirect('/siteinfo')->with('notification', $notification);
    }
}
