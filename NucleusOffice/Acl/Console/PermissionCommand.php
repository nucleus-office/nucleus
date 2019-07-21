<?php

namespace NucleusOffice\Acl\Console;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class PermissionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'permission:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed permissions from config file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    protected $defaultActions;

    public function handle()
    {
        $this->defaultActions = config('acl.default_actions');

        $permissions = config('acl.permissions');

        $total = $this->countPermissions($permissions, count($this->defaultActions));

        $this->warn('Updating permissions...');

        $bar = $this->output->createProgressBar($total + 1);

        $bar->setFormat('Progress: [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');

        $bar->start();

        $stored = [];

        foreach ($permissions as $key => $permission) {
            $actions = $this->defaultActions;
            $name = $permission;

            if (is_array($permission)) {
                $name = $key;
                $actions = $this->getActions($permission);
            }

            foreach ($actions as $action) {
                $stored[] = Permission::firstOrCreate([
                    'name' => $name . '_' . $action
                ])->name;

                $bar->advance();
            }
        }

        Permission::query()->orWhereNotIn('name', $stored)->delete();

        $bar->finish();

        $this->line('');

        $this->info('Permissions updated successfully');
    }

    private function getActions($permission)
    {
        if (isset($permission['strict']) && $permission['strict'] == true) {
            $actions = $permission['actions'];
        } else {
            $actions = array_merge($this->defaultActions, $permission['actions']);
        }

        return $actions;
    }

    private function countPermissions($permissions, $default)
    {
        $count = 0;

        foreach($permissions as $permission) {

            if (is_string($permission)) {
                $count += $default;
            } elseif (isset($permission['actions'])) {
                $count += count($permission['actions']);

                if (!isset($permission['strict']) || $permission['strict'] == false) {
                    $count += $default;
                }
            }
        }

        return $count;
    }
}
