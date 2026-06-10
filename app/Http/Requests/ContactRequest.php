<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'first_name' => ['required', 'string'],
             'last_name' => ['required', 'string'],
             'gender' =>['required'],
             'email' => ['required', 'string', 'email'],
             'tel__first' => ['required', 'numeric', 'digits_between:1,5', 'regex:/^[0-9-]+$/'],
             'tel__second' => ['required', 'numeric', 'digits_between:1,5', 'regex:/^[0-9-]+$/'],
             'tel__third' => ['required', 'numeric', 'digits_between:1,5', 'regex:/^[0-9-]+$/'],
             'address' => ['required'],
             'category_id' =>['required'],
             'detail'=> ['required', 'max:120'],
            ];   
    }

    public function messages()
      {
          return [
              'last_name.required' => '姓を入力してください',
              'first_name.required' =>'名を入力してください',
              'gender.required' => '性別を選択してください',
              'email.required' => 'メールアドレスを入力してください',
              'email.email' => 'メールアドレスはメール形式で入力してください',
              'email.max' => 'メールアドレスを255文字以下で入力してください',
              'tel__first.required' => '電話番号を入力してください',
              'tel__first.digits_between' => '電話番号は5桁までの数値で入力してください',
              'tel__first.regex:/^[0-9-]+$/' => '電話番号は半角英数字で入力してください',
              'tel__second.required' => '電話番号を入力してください',
              'tel__second.digits_between' => '電話番号は5桁までの数値で入力してください',
              'tel__second.regex:/^[0-9-]+$/' => '電話番号は半角英数字で入力してください',
              'tel__third.required' => '電話番号を入力してください',
              'tel__third.digits_between' => '電話番号は5桁までの数値で入力してください',
              'tel__third.regex:/^[0-9-]+$/' => '電話番号は半角英数字で入力してください',
              'address.required' => '住所を入力してください',
              'category_id.required' => 'お問い合わせの種類を選択してください',
              'detail.required' => 'お問い合わせ内容を入力してください',
              'detail.max:120' => 'お問い合わせ内容は120文字以内で入力してください',
          ];
        }
}
