<?php


namespace Tests\Feature\Concerns;

use Illuminate\Support\Str;

trait RoleTestHasProvider
{
    protected $roleBaseData = [
        'name' => 'role',
        'description' => 'role description',
    ];

    /**
     * Data provider for store validations test
     *
     * @return array
     */
    public function storeTestDataProvider(): array
    {
        return [
            'name field is null' => [
                array_replace_recursive($this->roleBaseData, ['name' => null]),
                'name'
            ],
            'name field is too short' => [
                array_replace_recursive($this->roleBaseData, ['name' => 'a']),
                'name'
            ],
            'name field is too long' => [
                array_replace_recursive($this->roleBaseData, ['name' => Str::random(81)]),
                'name'
            ],
            'description field is null' => [
                array_replace_recursive($this->roleBaseData, ['description' => null]),
                'description'
            ],
            'description field is too short' => [
                array_replace_recursive($this->roleBaseData, ['description' => 'a']),
                'description'
            ],
            'description field is too long' => [
                array_replace_recursive($this->roleBaseData, ['description' => Str::random((256))]),
                'description'
            ],
        ];
    }
}
