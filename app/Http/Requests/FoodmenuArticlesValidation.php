<?php
namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

//*************************************************************
// Rule
//1.  use App\Http\Requests\FoodmenuArticlesValidation; //Add Controller
//2.  public function store( FoodmenuArticlesValidation $request ){ //example
//*************************************************************

class FoodmenuArticlesValidation extends FormRequest
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
				"user_id" => "nullable|integer", //integer('user_id')->nullable()
				"company_id" => "nullable|integer", //integer('company_id')->nullable()
				"title" => "required|max:100", //string('title',100)
				"cooking_time" => "nullable|digits:4", //integer('cooking_time',4)->nullable()
				"cooking_method" => "required", //text('cooking_method')
				"image" => "nullable|max:255", //string('image',255)->nullable()

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



