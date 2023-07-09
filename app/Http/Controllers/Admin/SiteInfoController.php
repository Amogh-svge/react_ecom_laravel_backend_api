<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteInfoRequest;
use App\Models\SiteInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteInfoController extends Controller
{
    protected SiteInfo $siteInfoModel;

    public function __construct(SiteInfo $siteInfoModel)
    {
        $this->siteInfoModel = $siteInfoModel;
    }

    public function index(): JsonResponse
    {
        $data = $this->siteInfoModel->all();
        return $data->isNotEmpty() ?
            $this->successResponse(['data' => $data], "Successfully Retrived") :
            $this->successResponse(['data' => []], "No Results Found");
    }

    public function manageSiteInfo(): View
    {
        $site_info = $this->siteInfoModel->first();
        return view('admin.siteInfo.manage_site', compact('site_info'));
    }

    public function updateSiteInfo(SiteInfo $siteInfo, SiteInfoRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $siteInfo->update($validated);

        $notification = $this->notification($siteInfo, 'SiteInfo Successfully Updated', 'Failed To Update SiteInfo');
        return redirect('/siteinfo')->with('notification', $notification);
    }
}
