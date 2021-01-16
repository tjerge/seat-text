<?php

namespace CryptaEve\Seat\Text\Http\Controllers;

use Seat\Web\Http\Controllers\Controller;
use CryptaEve\Seat\Text\Models\Page;
use CryptaEve\Seat\Text\Validation\AddPage;
use Illuminate\Database\QueryException;


class TextController extends Controller 
{

    public function getConfigureView()
    {

        $pages = Page::all();
        

        return view("text::configure", compact('pages'));
    }

    public function getTextByID($id){

        return Page::find($id);
    }

    public function getPublicText($url){

        return Page::where('url', $url)->firstOrFail()->text;
    }

    public function postNewPage(AddPage $request)
    {
        try{
            $page = new Page();

            if ($request->id > 0){
                $page = Page::find($request->id);
            }

            $page->name = $request->name;
            $page->url = strtolower($request->url);
            $page->text = $request->text;

            $page->save();
    
            return redirect()->route('text.list')->with('success', 'Created / Updated Text');
        }
        catch (QueryException $e)
        {
            return redirect()->route('text.list')->with('error', 'Error creating text: '. $e->getMessage());
        }
        
    }

    public function deletePageById($id)
    {
        Page::destroy($id);

        return redirect()->route('text.list')->with('success', 'Deleted Text');
    }

    public function getAboutView()
    {
        return view("text::about");
    }

    public function getInstructionsView()
    {
        return view("text::instructions");
    }

}
