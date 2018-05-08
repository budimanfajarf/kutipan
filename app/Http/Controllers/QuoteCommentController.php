<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Quote;
use App\Models\Notification;
use App\Models\QuoteComment;
use Illuminate\Http\Request;

class QuoteCommentController extends Controller
{

    public function index(Request $request) {
        return redirect('/quotes');
    }

    public function store(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            'subject' => 'required|min:5'
        ]);

        $quote = Quote::findOrFail($request->quote_id);

        $quoteComment = QuoteComment::create([
            'subject' => $request->subject,
            'user_id' => Auth::user()->id,
            'quote_id' => $quote->id            
        ]);

        if ($quote->user->id != Auth::user()->id) {
            Notification::create([
                'user_id' => $quote->user->id,
                'quote_id' => $quote->id,
                'subject' => 'Ada Komentar nih dari '. Auth::user()->name
            ]);    
        }
        
        return redirect('quotes/'.$quote->slug)->with('msg', 'Komentar berhasil disubmit');
    }

    public function edit($id)
    {
        $quoteComment = QuoteComment::findOrFail($id);
        if ($quoteComment->isCommentOwner()) {
            return view('quote_comments.edit', compact('quoteComment'));           
        } else {
            return abort(403);
        }         
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'subject' => 'required|min:5'
        ]);

        $quoteComment = QuoteComment::findOrFail($id);

        if ($quoteComment->isCommentOwner()) {
            $quoteComment->update([
                'subject' => $request->subject
            ]);            
        } else {
            return abort(403);
        }           

        $msg = 'Comment ke-'.$id.' berhasil di Edit';

        return redirect('/quotes/'.$quoteComment->quote->slug)->with('msg', $msg);
    }

    public function destroy($id)
    {
        $quoteComment = QuoteComment::findOrFail($id);

        if ($quoteComment->isCommentOwner()) {
            $quoteComment->delete();           
        } else {
            return abort(403);
        }       
        $msg = 'Comment ke-'.$id.' berhasil di Hapus';

        return redirect('/quotes/'.$quoteComment->quote->slug)->with('msg', $msg);        
    }

}
