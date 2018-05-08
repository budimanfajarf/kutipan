<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Tag;
use App\Models\User;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_q = $request->search;        

        if(!empty($search_q)) {
            // $quotes = Quote::with('tags','user')->where('title', 'like', '%'.$search_q.'%')->get();
            $quotes = Quote::with(['tags','user'])->where('title', 'like', '%'.$search_q.'%')->paginate(5);        
        }
        else{
            // $quotes = Quote::with('tags','user')->get();  
            $quotes = Quote::with(['tags', 'user'])->paginate(5);
        }

            
        $tags = Tag::All();

        return view('quotes.index', compact('quotes', 'tags', 'search_q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::All();;
        return view('quotes.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'subject' => 'required|min:5'
        ]);

        $request->tags = array_unique(array_diff($request->tags, [0]));
        if(empty($request->tags))
            return redirect('quotes/create')->withInput($request->input())->with('tag_error', 'Tag minimal 1');

        $slug = str_slug($request->title, '-');

        //cek slug ngga kembar
        if(Quote::where('slug', $slug)->first() != null)
            $slug = $slug . '-' .time();
                    
        $quote = Quote::create([
            'title' => $request->title,
            'slug' => $slug,
            'subject' => $request->subject,
            'user_id' => Auth::user()->id
        ]);   
        
        $quote->tags()->attach($request->tags);

        return redirect('quotes')->with('msg', 'Kutipan berhasil disubmit');
        // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $quote = Quote::with('quoteComments.user')->where('slug', $slug)->first();
        if(empty($quote)) 
            abort(404);

        return view('quotes.single', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quote = Quote::findOrFail($id);
        if ($quote->isQuoteOwner()) {
            $tags = Tag::All();
            return view('quotes.edit', compact('quote', 'tags'));
        } else {
            return abort(403); 
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // dd($request->tags);

        $this->validate($request, [
            'title' => 'required|min:3',
            'subject' => 'required|min:5',
            'tags' => 'required'
        ]);   

        $request->tags = array_unique(array_diff($request->tags, [0]));
        if(empty($request->tags)) {
            $red = 'quotes/'.$id.'/edit';
            return redirect($red)->withInput($request->input())->with('tag_error', 'Tag minimal 1');        
        }

        $quote = Quote::findOrFail($id);

        if ($quote->isQuoteOwner()) {
            $quote->update([
                'title' => $request->title,
                'subject' => $request->subject,
            ]);  
            $quote->tags()->sync($request->tags);          
        } else {
            return abort(403);
        }       
        $msg = 'Kutipan ke-'.$id.' berhasil di Edit';

        return redirect('quotes')->with('msg', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = Quote::findOrFail($id);

        if ($quote->isQuoteOwner()) {
            $quote->delete();           
        } else {
            return abort(403);
        }       
        $msg = 'Kutipan ke-'.$id.' berhasil di Hapus';

        return redirect('quotes')->with('msg', $msg);        
    }

    public function random() 
    {
        $quote = Quote::inRandomOrder()->first();
        return redirect('quotes/'.$quote->slug);        
    }

    public function tag($tag)
    {
        $tags = Tag::All();

        // $quotes = Quote::with('tags')->
        //     whereHas(
        //         'tags', 
        //         function($query) use ($tag){
        //             $query->where('name', $tag);
        //         }
        //     )->get();

        $quotes = Quote::with('tags')->
            whereHas(
                'tags', 
                function($query) use ($tag){
                    $query->where('name', $tag);
                }
            )->paginate(5);

        $search_q = $tag;

        return view('quotes.index', compact('quotes', 'tags', 'search_q'));
    }

}
