<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request){
        $contact = $request->only(['first_name', 'last_name', 'gender',  'email', 'tel__first', 'tel__second', 'tel__third', 'address', 'building',  'detail']);
        $category = Category::find($request->category_id);
        return view('confirm', compact('contact', 'category'));
        
    }

    public function store(Request $request){
        $contact = $request->only(['first_name','last_name', 'gender',  'email', 'tel', 'address', 'building',  'detail']);
        Contact::create(array_merge($contact, [
           'category_id' => $request->category_id,
        ]));
        return view('thanks');
    }

}
