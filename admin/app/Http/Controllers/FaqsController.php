<?php

namespace App\Http\Controllers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\Faqs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class FaqsController extends Controller
{
    
    protected $faqs;
 
    public function __construct(Faqs $faqs)
    {
        $this->faqs = $faqs;
    }

    public function update(Request $request, $id)
    {
        $faq = Faqs::find($id);

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->category_id = $request->category_id;
        $faq->save();

        session()->flash('status', 'FAQs has been update !!');
        return back();
    }

    public function create(Request $request)
    {
        $data = $request->input();

        Faqs::create([
            'question' => $data['question'],
            'answer' => $data['answer'],
            'category_id' => $data['category_id'],
        ]);

        session()->flash('status', 'FAQs has been created !!');
        return back();
    }

    public function destroy($id)
    {
        try {
            $faqs = Faqs::find($id);
            $faqs->delete();
            return redirect('/user/faqs')->with('status',"FAQs deleted successfully");
        }
        catch(Exception $e){
            return redirect('/user/faqs')->with('failed',"Something went wrong");
        }
    }

}
