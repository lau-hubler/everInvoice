<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    protected $types = ['category', 'product', 'stakeholder', 'invoice', 'order', 'role'];
    protected $actions = ['index', 'store', 'update', 'show', 'delete'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertCrudPermissions();

        DB::table('permissions')->insert([
            'code' => 'invoice.import',
            'description' => 'User can import invoices'
        ]);

        DB::table('permissions')->insert([
            'code' => 'invoice.export',
            'description' => 'User can export invoices'
        ]);
    }

    private function insertCrudPermissions(): void
    {
        foreach ($this->types as $type) {
            foreach ($this->actions as $action) {
                $method = sprintf('get%sDescription', ucfirst($action));
                DB::table('permissions')->insert([
                    'code' => "$type.$action",
                    'description' => $this->$method($type)
                ]);
            }
        }
    }

    protected function getIndexDescription($type)
    {
        return "User can access $type's group";
    }

    protected function getStoreDescription($type)
    {
        return "User can create a new $type";
    }

    protected function getUpdateDescription($type)
    {
        return "User can update a $type";
    }

    protected function getShowDescription($type)
    {
        return "User can access details of a $type";
    }

    protected function getDeleteDescription($type)
    {
        return "User can delete a $type";
    }
}
