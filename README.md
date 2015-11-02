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
2. Run `php artisan vendor:publish`.
3. In `/config/audit.php`, set your model map for Model and Log Model.
   * Model(key) means the model class you're going to be audited.
   * Log model(value) stands for the model you'd like to save your auditing records.
   * You need to make your own migrations to record those logs. (there's a sample migration file in the package) 
   * If you don't create a mapping for your model, the package will record your logs to the default `log` model.  

## Usage

* If there's a User model, and I would like to keep users' records to UserLog model
  1. Create a UserLog migration file
  2. Fill in your model map in `config/audit.php` like this: `'App\User' => 'App\UserLog'`
  3. In any place you want to audit your user logs
       ```
       Audit::log(Model $model, $action, $comment = null, $subject = null, $subject_id = null)
       ```
       ```
       Audit::log($User, 'log in', 'the action is approved')
       ```
  * $User is Eloquent Object here.
  * The third, forth and fifth parameters are optional.
  * You could put your modified column and column id to subject and subject_id parameters.