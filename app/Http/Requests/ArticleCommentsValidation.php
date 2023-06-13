<?php
namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

//*************************************************************
// Rule
//1.  use App\Http\Requests\ArticleCommentsValidation; //Add Controller
//2.  public function store( ArticleCommentsValidation $request ){ //example
//*************************************************************

class ArticleCommentsValidation extends FormRequest
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
				"foodmenu_article_id" => "nullable|integer", //integer('foodmenu_article_id')->nullable()
				"problem_article_id" => "nullable|integer", //integer('problem_article_id')->nullable()
				"problem_solve_aritcle_id" => "nullable|integer", //integer('problem_solve_aritcle_id')->nullable()
				"comment" => "nullable|max:100", //string('comment',100)->nullable()

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



