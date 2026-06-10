<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

class AdminController extends Controller
{
    public function admin(Request $request){

        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();


        return view('admin',[
            'user' => $request->user(),
        ],compact('contacts', 'categories'));
    }

    public function search(Request $request){

        $contacts = Contact::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->GenderSearch($request->gender)->DateSearch($request->date)->paginate(7)->appends($request->query());
        $categories = Category::all();

         return view('admin', compact('contacts', 'categories'));
    }

    public function reset(){
         return redirect('/admin');
    }

     public function destroy(Request $request){
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
    
    public function export(Request $request){
        $contacts = Contact::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->GenderSearch($request->gender)->DateSearch($request->date)->get();
        $categories = Category::all();

      $header = [
        '名前',
        '性別',
        'メールアドレス',
        '電話番号',
        '住所',
        '建物名',
        'お問い合わせの種類',
        'お問い合わせ内容',
      ];
      $callback = function () use ($contacts, $header) {
        $file = fopen('php://output', 'w');
    
         mb_convert_variables('SJIS', 'UTF-8', $header);
         fputcsv($file, $header);
         
         foreach ($contacts as $contact) {
            $row = [
                $contact->last_name . ' ' . $contact->first_name,
                $gender = match ($contact->gender) {
                        1 => '男性',
                        2 => '女性',
                        default => 'その他',
                },
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category->content,
                $contact->detail,
            ];
            mb_convert_variables('SJIS', 'UTF-8', $row);
            fputcsv($file, $row);
         };
         fclose($file);
        };
        return response()->streamDownload(
         $callback,
        'contacts.csv',
        ['Content-Type' => 'text/csv']
    );
    }
}
