<?php
namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

//*************************************************************
// Rule
//1.  use App\Http\Requests\ArticleCategoriesValidation; //Add Controller
//2.  public function store( ArticleCategoriesValidation $request ){ //example
//*************************************************************

class ArticleCategoriesValidation extends FormRequest
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
				"id" => "nullable|integer", //integer('id')->nullable()
				"user_id" => "nullable|integer", //integer('user_id')->nullable()
				"company_id" => "nullable|integer", //integer('company_id')->nullable()
				"foodmenu_article_id" => "required|integer", //integer('foodmenu_article_id')
				"problem_article_id" => "required|integer", //integer('problem_article_id')
				"problem_solve_article_id" => "required|integer", //integer('problem_solve_article_id')
				"category" => "required|max:100", //string('category',100)

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



