<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Role management
     */

    const ROLE_PUPIL = 'pupil';
    const ROLE_TEACHER = 'teacher';
    const ROLE_RECTOR = 'rector';
    const ROLE_ADMIN = 'admin';

    private static array $roleHierarchy = [
        self::ROLE_PUPIL => [],
        self::ROLE_TEACHER => [self::ROLE_PUPIL],
        self::ROLE_RECTOR => [self::ROLE_TEACHER, self::ROLE_PUPIL],
        self::ROLE_ADMIN => [self::ROLE_RECTOR, self::ROLE_TEACHER, self::ROLE_PUPIL],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'standard_book_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function hasRoleOrHigher(string $role): bool
    {
        $allowedRoles = self::$roleHierarchy[$this->role] ?? [];
        $allowedRoles[] = $this->role;
        return in_array($role, $allowedRoles);
    }

    public function standardBook(): ?BelongsTo
    {
        return $this->belongsTo(Book::class, 'standard_book_id');
    }
}
