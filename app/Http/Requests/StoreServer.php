<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:24'],
            // 'slug' => ['required', 'string', 'alpha_dash', 'min:3', 'max:24', 'unique:servers'],
            'description' => ['nullable'],
            'host' => ['required', 'min:3', 'max:24', 'unique:servers'],
            'port' => ['required', 'integer', 'gte:0'],
            'version_id' => ['required', 'integer'],
            'type_id' => ['required', 'integer'],
            'country_id' => ['required', 'integer'],
            'link_website' => ['nullable', 'active_url'],
            'voting_service_host' => ['nullable', 'string', 'min:3', 'max:24'],
            'voting_service_port' => ['nullable', 'integer', 'gte:0'],
            'voting_service_token' => ['nullable', 'alpha_num'],
        ];
    }
}
