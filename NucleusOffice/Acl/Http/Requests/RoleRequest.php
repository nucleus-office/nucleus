<?php

namespace NucleusOffice\Acl\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    protected $tableNames;

    protected $internID;

    function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->tableNames = config('permission.table_names');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->internID = $this->route('role');

        if ($this->getMethod() == 'POST') {
            return $this->storeRules();
        } elseif($this->getMethod() == 'PUT') {
            return $this->updateRules();
        }

        return [
            // No validation rules
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    private function storeRules()
    {
        return [
            'name' => [
                'required',
                'max:255',
                "unique:{$this->tableNames['roles']},name,{$this->internID},id,deleted_at,NULL"
            ],
            'type' => [
                'required',
                'in:permissive,prohibitive'
            ],
            'description' => [
                'required',
                'max:255'
            ],
            'permissions' => 'required',
            'permissions.*' => 'exists:' . $this->tableNames['permissions'] . ',id'
        ];
    }

    private function updateRules()
    {
        return [
            'name' => [
                'max:255',
                "unique:{$this->tableNames['roles']},name,{$this->internID},id,deleted_at,NULL"
            ],
            'type' => [
                'in:permissive,prohibitive'
            ],
            'description' => [
                'max:255'
            ],
            'permissions.*' => 'exists:' . $this->tableNames['permissions'] . ',id'
        ];
    }
}
