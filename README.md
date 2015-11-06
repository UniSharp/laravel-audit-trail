Laravel Audit Trail
===================

### What is this package for? ###

* This package is for laravel 5.0/5.1, which helps you create your auditing logs into your database. 

## Setup

1. In `/config/app.php`, add the following to `providers`:

    ```
    Unisharp\AuditTrail\AuditServiceProvider::class,
    ```

    and the following to `aliases`:

    ```
    'Audit' => Unisharp\AuditTrail\Facades\Audit::class,
    ```
2. Run `php artisan migrate`.

## Usage

> All your logs will be recorded in 'audit_trails' table. 

* You need to add a trait to the model you're going to audit.
    
    ```php
    class User extends Eloquent
    {
      use \Unisharp\AuditTrail\Auditable;

      protected $table = 'users';

      protected $hidden = ['password'];

      protected $fillable = ['username', 'email', 'password'];
    }
    ```

* In any place you want to audit your user logs

       ```php
       $User->log($action, $comment = null, $subject = null, $subject_id = null)
       ```

       ```php
       $User->log('log in', 'the action is approved')
       ```

    * $User is an Eloquent Object here.
    * The second, third parameters are optional.
    * You could put your modified column and column id to `subject` and `subject_id` parameters.

* Other usages

  * You can get your model logs by:

       ```php
       $User->getLogs();
       ```
  * Get all the logs by single user by using:

       ```php
       Audit::getByUserId($user_id)
       ```
  * As time grows, logs would be outdated. You may clean them by:

       ```php
       $User->cleanLogs()
       ```