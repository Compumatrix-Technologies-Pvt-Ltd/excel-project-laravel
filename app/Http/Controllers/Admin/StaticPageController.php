<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    //
    public function cmsPages(Request $request)
    {
        $this->ViewData['moduleAction'] = "CMS Pages";
        $this->ViewData['pages'] = StaticPage::all();
        return view('admin.cms.cms-index', $this->ViewData);
    }

    public function cmsPagesEdit(Request $request, $encodedId)
    {
        $id = base64_decode(base64_decode($encodedId));

        $page = StaticPage::find($id);

        if (!$page) {
            return redirect()->route('cms.pages.index')->with('error', 'Page not found.');
        }

        $this->ViewData['moduleAction'] = "CMS Pages Edit";
        $this->ViewData['pageId'] = $page->id;
        $this->ViewData['pageName'] = $page->page_name;
        $this->ViewData['content'] = $page->page_content;

        return view('admin.cms.cms-edit', $this->ViewData);
    }

    public function updateCmsPage(Request $request, $id)
    {
        try {
            // Validate input
            $request->validate([
                'page_name' => 'required|string|max:255',
                'page_content' => 'required|string',
            ]);

            // Decode ID (if it's encoded)

            // Find page
            $page = StaticPage::find($id);

            if (!$page) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Page not found.',
                ], 404);
            }

            $page->page_name = $request->page_name;
            $page->page_content = $request->page_content;
            $page->save();

            return response()->json([
                'status' => 'success',
                'url' => route('admin.cms.pages'),
                'msg' => 'Page updated successfully!',
            ]);

        } catch (\Exception $e) {
            // Return error JSON
            return response()->json([
                'status' => 'error',
                'msg' => 'Something went wrong. ' . $e->getMessage(),
            ], 500);
        }
    }

}
