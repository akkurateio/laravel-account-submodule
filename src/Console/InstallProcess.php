<?php

namespace Akkurate\LaravelAccountSubmodule\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account-submodule:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer the files to your application and change the necessary occurrences';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Start of treatment');
        $this->line('');

        $this->copyFilesToApp();
        $this->replaceOccurrences();

        $this->line('');
        $this->info('End of treatment');
    }

    /**
     * Search and replace occurrences inside the application.
     */
    protected function replaceOccurrences()
    {
        /**
         * Replace namespaces ...
         */

        //Factories
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace ', base_path('database/factories/UserFactory.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace ', base_path('database/factories/AccountFactory.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace ', base_path('database/factories/PreferenceFactory.php'));

        //Seeders
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace ', base_path('database/seeders/AccountsTableSeeder.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace ', base_path('database/seeders/DatabaseSeeder.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace ', base_path('database/seeders/PermissionsTableSeeder.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace ', base_path('database/seeders/RolesTableSeeder.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace ', base_path('database/seeders/UserHasRolesTableSeeder.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace ', base_path('database/seeders/UsersTableSeeder.php'));

        //Models
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Models/User.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Models/Account.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Models/Preference.php'));

        //Notifications
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Notifications/ResetPasswordNotification.php'));

        //Policies
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Policies/AccountPolicy.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Policies/PermissionPolicy.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Policies/RolePolicy.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Policies/UserPolicy.php'));

        //Providers
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Providers/AuthServiceProvider.php'));

        //Traits
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Traits/HasAccount.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Traits/IsActivable.php'));

        //Rules
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Rules/Firstname.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Rules/Lastname.php'));

        //Requests
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Requests/Account/CreateAccountRequest.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Requests/Account/UpdateAccountRequest.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Requests/Preference/UpdatePreferenceRequest.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Requests/User/CreateUserRequest.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Requests/User/UpdateUserRequest.php'));

        //Resources
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Resources/Account/Account.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Resources/Account/AccountCollection.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Resources/Permission/Permission.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Resources/Permission/PermissionCollection.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Resources/Role/Role.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Resources/Role/RoleCollection.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Resources/User/User.php'));
        $this->replaceInFile('namespace Akkurate\\LaravelAccountSubmodule\\', 'namespace App\\', app_path('Http/Resources/User/UserCollection.php'));


        /**
         * Remplace uses ...
        */

        //Factories
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', base_path('database/factories/UserFactory.php'));
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', base_path('database/factories/AccountFactory.php'));
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', base_path('database/factories/PreferenceFactory.php'));

        //Seeders
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', base_path('database/seeders/AccountsTableSeeder.php'));
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', base_path('database/seeders/UserHasRolesTableSeeder.php'));
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', base_path('database/seeders/UsersTableSeeder.php'));

        //Models
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\Database\\', 'use Database\\', app_path('Models/Account.php'));
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', app_path('Models/Account.php'));
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\Database\\', 'use Database\\', app_path('Models/Preference.php'));
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\Database\\', 'use Database\\', app_path('Models/User.php'));
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', app_path('Models/User.php'));

        //Policies
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', app_path('Policies/AccountPolicy.php'));
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', app_path('Policies/PermissionPolicy.php'));
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', app_path('Policies/RolePolicy.php'));
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', app_path('Policies/UserPolicy.php'));

        //Providers
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', app_path('Providers/AuthServiceProvider.php'));

        //Traits
        $this->replaceInFile('use Akkurate\\LaravelAccountSubmodule\\', 'use App\\', app_path('Traits/HasAccount.php'));

        $this->info('Occurrences have been replaced with success');
    }

    /**
     * Copy the folders and files into the application
     */
    protected function copyFilesToApp()
    {
        // Publish Migrations...
        $this->callSilent('vendor:publish', ['--tag' => 'account-submodule-migrations', '--force' => true]);

        // Service Providers...
        copy(__DIR__.'/../../src/Providers/AuthServiceProvider.php', app_path('Providers/AuthServiceProvider.php'));

        // Factories...
        (new Filesystem)->copyDirectory(__DIR__.'/../../database/factories', base_path('database/factories'));

        // Seeders...
        (new Filesystem)->copyDirectory(__DIR__.'/../../database/seeders', base_path('database/seeders'));

        // Policies...
        (new Filesystem)->copyDirectory(__DIR__.'/../../src/Policies', app_path('Policies'));

        // Notifications...
        (new Filesystem)->copyDirectory(__DIR__.'/../../src/Notifications', app_path('Notifications'));

        // Models...
        (new Filesystem)->copyDirectory(__DIR__.'/../../src/Models', app_path('Models'));

        // Rules...
        (new Filesystem)->copyDirectory(__DIR__.'/../../src/Rules', app_path('Rules'));

        // Traits...
        (new Filesystem)->copyDirectory(__DIR__.'/../../src/Traits', app_path('Traits'));

        // Resources...
        (new Filesystem)->copyDirectory(__DIR__.'/../../src/Http/Resources', app_path('Http/Resources'));

        // Requests...
        (new Filesystem)->copyDirectory(__DIR__.'/../../src/Http/Requests', app_path('Http/Requests'));

        $this->info('Resources installed on your project');
    }



    /**
     * Replace a given string within a given file.
     *
     * @param string $search
     * @param string $replace
     * @param string $path
     * @return void
     */
    protected function replaceInFile(string $search, string $replace, string $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
