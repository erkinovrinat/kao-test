<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use Mail;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $remember_token
*/
class User extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'remember_token', 'role_id', 'school_id', 'class'];

    public static function boot()
    {
        parent::boot();

        User::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }


    /**
     * Set to null if empty
     * @param $input
     */
    public function setRoleIdAttribute($input)
    {
        $this->attributes['role_id'] = $input ? $input : null;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id')->withTrashed();
    }

    public function isAdmin()
    {
        foreach ($this->role()->get() as $role) {
            if ($role->id == 1) {
                return true;
            }
        }

        return false;
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public static function filterResolver($request)
    {
        $fields = ['id', 'name', 'email', 'school_id', 'class'];
        $students = User::where('role_id', null)->get();
        if ($oblast_id = $request->oblast_id) {
            $oblast = Oblast::find($oblast_id);
            $schools = $oblast->schools;
            $students = $schools->map(function ($item) {
                return $item->students;
            })->flatten();
        }

        if ($region_id = $request->region_id) {
            $region = Region::find($region_id);
            $schools = $region->schools;
            $students = $schools->map(function ($item) {
                return $item->students;
            })->flatten();
        }

        if ($school_id = $request->school_id) {
            $students = User::where('school_id', $school_id)->get();
        }

        if ($grade_id = $request->grade_id) {
            $students = User::where('class', $grade_id)->get();
        }

        if ($student_id = $request->student_id) {
            $students = User::where('id', $student_id)->get();
        }

        return $students->sortBy('id')->map(function ($item) use ($fields) {
            return $item->only($fields);
        });
    }
}
