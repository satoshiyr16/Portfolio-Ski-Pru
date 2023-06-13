<?php
namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

//*************************************************************
// Rule
//1.  use App\Http\Requests\UsersValidation; //Add Controller
//2.  public function store( UsersValidation $request ){ //example
//*************************************************************

class UsersValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //[ *1. default=false ]
    }
    
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //[ *2. Validation rule description location ]
        return [
				"name" => "required|max:30", //string('name',30)
				"image" => "nullable|max:255", //string('image',255)->nullable()
				"email" => "required|max:100", //string('email',100)
				"password" => "required|max:30", //string('password',30)
				"age" => "nullable|digits:3", //integer('age',3)->nullable()
				"introduction" => "nullable", //text('introduction')->nullable()
				"skin_status" => "nullable", //text('skin_status')->nullable()
				"skin_item" => "nullable", //text('skin_item')->nullable()

            ];
        }
    
        //[ *3. Set Validation message (*Optional) ]
        //Be sure to use [messages] for the Function name.
        //[Ja]https://readouble.com/laravel/6.x/ja/validation-php.html
        public function messages(){
            return [
                //"email.required"  => "メールアドレスを入力してください",
                //"email.max"       => "**文字以下で入力してください",
            ];
        }
    
    }



