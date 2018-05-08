<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Like;
use App\Models\Quote;
use App\Models\QuoteComment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like($data_type, $data_likeable_id)
    {
        // dd($data_type.'-'.$data_model_id);
        $results            = $this->checkType($data_type, $data_likeable_id);
        $data_likeable_type = $results[0];
        $model              = $results[1];
        
        // Ngga boleh Like Sendiri
        if(Auth::user()->id == $model->user->id)
            die('0');

        // Ngga boleh like berkali2
        if($model->isLiked() == null) {
            Like::create([
                'user_id' => Auth::user()->id,
                'likeable_id' => $data_likeable_id,
                'likeable_type' => $data_likeable_type
            ]);            
        } 
        else 
        {
            die('1');
        }          

    }

    public function unlike($data_type, $data_likeable_id)
    {
        // dd($data_type.'-'.$data_model_id);
        $results            = $this->checkType($data_type, $data_likeable_id);
        $data_likeable_type = $results[0];
        $model              = $results[1];

        // Hapus Like 
        if($model->isLiked()) {
            Like::where('user_id', Auth::user()->id)
                    ->where('likeable_id', $data_likeable_id)
                    ->where('likeable_type', $data_likeable_type)
                    ->delete();
        }         

    }    

    public function checkType($data_type, $data_likeable_id) 
    {
        if ($data_type == 1) 
        {
            $data_likeable_type = "App\Models\Quote";
            $model = Quote::find($data_likeable_id);
        }

        else
        {
            $data_likeable_type = "App\Models\QuoteComment";
            $model = QuoteComment::find($data_likeable_id);
        }
        return array($data_likeable_type, $model);
    }
}
