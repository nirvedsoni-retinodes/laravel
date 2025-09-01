<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PDO;
use PDOException;

class InstallController extends Controller
{
    protected $requirements = [
        'php' => '8.1.0',
        'extensions' => [
            'BCMath',
            'Ctype',
            'JSON',
            'Mbstring',
            'OpenSSL',
            'PDO',
            'Tokenizer',
            'XML',
            'cURL',
            'GD',
            'fileinfo',
            'zip'
        ],
        'writable_dirs' => [
            'storage/app',
            'storage/framework',
            'storage/logs',
            'bootstrap/cache'
        ]
    ];

    public function index()
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        $step = session('install_step', 1);
        $data = $this->getStepData($step);

        return view('install.wizard', compact('step', 'data'));
    }

    public function step(Request $request, $step)
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        switch ($step) {
            case 1:
                return $this->requirements($request);
            case 2:
                return $this->database($request);
            case 3:
                return $this->admin($request);
            case 4:
                return $this->finish($request);
            default:
                return redirect()->route('install.index');
        }
    }

    protected function requirements(Request $request)
    {
        if ($request->isMethod('post')) {
            $check = $this->checkRequirements();
            
            if ($check['passed']) {
                session(['install_step' => 2]);
                return redirect()->route('install.step', 2);
            } else {
                return back()->withErrors($check['errors']);
            }
        }

        $data = $this->checkRequirements();
        return view('install.requirements', compact('data'));
    }

    protected function database(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'db_host' => 'required',
                'db_port' => 'required|numeric',
                'db_database' => 'required',
                'db_username' => 'required',
                'db_password' => 'nullable'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Test database connection
            if ($this->testDatabaseConnection($request)) {
                // Save database config
                $this->saveDatabaseConfig($request);
                
                // Run migrations and seeders
                if ($this->setupDatabase()) {
                    session(['install_step' => 3]);
                    return redirect()->route('install.step', 3);
                } else {
                    return back()->withErrors(['db_error' => 'Failed to setup database']);
                }
            } else {
                return back()->withErrors(['db_error' => 'Database connection failed']);
            }
        }

        return view('install.database');
    }

    protected function admin(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'admin_name' => 'required|string|max:255',
                'admin_email' => 'required|email|unique:users,email',
                'admin_password' => 'required|string|min:8|confirmed',
                'site_name' => 'required|string|max:255',
                'site_url' => 'required|url'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Create admin user and configure site
            if ($this->setupAdmin($request)) {
                session(['install_step' => 4]);
                return redirect()->route('install.step', 4);
            } else {
                return back()->withErrors(['admin_error' => 'Failed to create admin user']);
            }
        }

        return view('install.admin');
    }

    protected function finish(Request $request)
    {
        if ($request->isMethod('post')) {
            // Mark installation as complete
            $this->markAsInstalled();
            
            // Clear installation session
            session()->forget('install_step');
            
            return redirect('/')->with('success', 'Installation completed successfully!');
        }

        return view('install.finish');
    }

    protected function checkRequirements()
    {
        $errors = [];
        $passed = true;

        // Check PHP version
        if (version_compare(PHP_VERSION, $this->requirements['php'], '<')) {
            $errors[] = "PHP version must be {$this->requirements['php']} or higher. Current: " . PHP_VERSION;
            $passed = false;
        }

        // Check extensions
        foreach ($this->requirements['extensions'] as $extension) {
            if (!extension_loaded($extension)) {
                $errors[] = "PHP extension '{$extension}' is required but not installed.";
                $passed = false;
            }
        }

        // Check writable directories
        foreach ($this->requirements['writable_dirs'] as $dir) {
            if (!is_writable($dir)) {
                $errors[] = "Directory '{$dir}' must be writable.";
                $passed = false;
            }
        }

        return [
            'passed' => $passed,
            'errors' => $errors,
            'php_version' => PHP_VERSION,
            'required_php' => $this->requirements['php'],
            'extensions' => $this->requirements['extensions'],
            'writable_dirs' => $this->requirements['writable_dirs']
        ];
    }

    protected function testDatabaseConnection(Request $request)
    {
        try {
            $dsn = "mysql:host={$request->db_host};port={$request->db_port}";
            $pdo = new PDO($dsn, $request->db_username, $request->db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Test if database exists, if not create it
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$request->db_database}`");
            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    protected function saveDatabaseConfig(Request $request)
    {
        $envContent = File::get('.env');
        
        $replacements = [
            'DB_HOST=127.0.0.1' => "DB_HOST={$request->db_host}",
            'DB_PORT=3306' => "DB_PORT={$request->db_port}",
            'DB_DATABASE=laravel_booking' => "DB_DATABASE={$request->db_database}",
            'DB_USERNAME=root' => "DB_USERNAME={$request->db_username}",
            'DB_PASSWORD=' => "DB_PASSWORD={$request->db_password}",
        ];

        foreach ($replacements as $search => $replace) {
            $envContent = str_replace($search, $replace, $envContent);
        }

        File::put('.env', $envContent);
    }

    protected function setupDatabase()
    {
        try {
            // Clear config cache
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            
            // Run migrations
            Artisan::call('migrate:fresh', ['--force' => true]);
            
            // Run seeders
            Artisan::call('db:seed', ['--force' => true]);
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    protected function setupAdmin(Request $request)
    {
        try {
            // Update site configuration
            $this->updateSiteConfig($request);
            
            // Create admin user
            $admin = \App\Models\User::create([
                'name' => $request->admin_name,
                'email' => $request->admin_email,
                'password' => Hash::make($request->admin_password),
                'email_verified_at' => now(),
            ]);

            // Assign admin role
            $admin->assignRole('admin');
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    protected function updateSiteConfig(Request $request)
    {
        $envContent = File::get('.env');
        
        $replacements = [
            'APP_NAME="Laravel Booking Platform"' => "APP_NAME=\"{$request->site_name}\"",
            'APP_URL=http://localhost' => "APP_URL={$request->site_url}",
        ];

        foreach ($replacements as $search => $replace) {
            $envContent = str_replace($search, $replace, $envContent);
        }

        File::put('.env', $envContent);
    }

    protected function markAsInstalled()
    {
        // Create installed file
        File::put(storage_path('installed'), date('Y-m-d H:i:s'));
        
        // Clear all caches
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
    }

    protected function isInstalled()
    {
        return File::exists(storage_path('installed'));
    }

    protected function getStepData($step)
    {
        switch ($step) {
            case 1:
                return $this->checkRequirements();
            case 2:
                return [];
            case 3:
                return [];
            case 4:
                return [];
            default:
                return [];
        }
    }
}
