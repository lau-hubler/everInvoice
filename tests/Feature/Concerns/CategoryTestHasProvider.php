<?php


namespace Tests\Feature\Concerns;

use Illuminate\Support\Str;

trait CategoryTestHasProvider
{
    /**
     * An array with basic category data
     *
     * @var array
     */
    protected $categoryBaseData = [
        'code' => 'CTG001',
        'name' => 'General',
        'description' => 'This is a geneeral category',
        'iva' => 0.19,
    ];

    /**
     * Data provider for store validations test
     *
     * @return array
     */
    public function storeTestDataProvider(): array
    {
        return [
            'code field is null' => [
                array_replace_recursive($this->categoryBaseData, ['code' => null]),
                'code'
            ],
            'code field is too short' => [
                array_replace_recursive($this->categoryBaseData, ['code' => 'PRD']),
                'code'
            ],
            'code field is too long' => [
                array_replace_recursive($this->categoryBaseData, ['code' => 'PRD1234']),
                'code'
            ],
            'name field is null' => [
                array_replace_recursive($this->categoryBaseData, ['name' => null]),
                'name'
            ],
            'name field is too short' => [
                array_replace_recursive($this->categoryBaseData, ['name' => 'a']),
                'name'
            ],
            'name field is too long' => [
                array_replace_recursive($this->categoryBaseData, ['name' => Str::random(81)]),
                'name'
            ],
            'description field is null' => [
                array_replace_recursive($this->categoryBaseData, ['description' => null]),
                'description'
            ],
            'description field is too short' => [
                array_replace_recursive($this->categoryBaseData, ['description' => 'a']),
                'description'
            ],
            'description field is too long' => [
                array_replace_recursive($this->categoryBaseData, ['description' => Str::random((256))]),
                'description'
            ],
            'iva field is null' => [
                array_merge_recursive($this->categoryBaseData, ['iva' => null]),
                'iva'
            ],
            'iva field is not numeric' => [
                array_merge_recursive($this->categoryBaseData, ['iva' => 'a']),
                'iva'
            ],
        ];
    }
}
