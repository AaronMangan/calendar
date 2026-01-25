<?php

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    const ROLES_AND_PERMISSIONS = [
        'roles' => [
            'superadmin' => [
                'manage users',
                'manage family users',
                'view family details',
                'edit family details',
                'view calendar',
                'edit calendar',
                'view events',
                'edit events',
            ],
            'family_admin' => [
                'manage family users',
                'view family details',
                'edit family details',
                'view calendar',
                'edit calendar',
                'view events',
                'edit events',
            ],
            'family_member' => [
                'view family details',
                'view calendar',
                'edit calendar',
                'view events',
                'edit events',
            ],
            'family_viewer' => [
                'view events',
                'view calendar',
            ],
            'guest' => [
                'register only',
            ],
        ],
        'permissions' => [
            'manage users',
            'manage family users',
            'view family details',
            'edit family details',
            'view calendar',
            'edit calendar',
            'view events',
            'edit events',
            'register only',
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $permissions = collect(self::ROLES_AND_PERMISSIONS['permissions']);
        $roles = collect(self::ROLES_AND_PERMISSIONS['roles']);

        $permissions->each(function ($permission) {
            if (! Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        });

        $roles->each(function ($rolePermissions, $role) {
            $roleModel = Role::firstOrCreate(['name' => $role]);

            $permissions = collect($rolePermissions);
            $roleModel->syncPermissions($permissions->toArray());
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('family_id')->nullable()->constrained('families')->onDelete('set null');
        });
    }
};
