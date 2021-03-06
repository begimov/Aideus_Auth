<?php

namespace Aideus\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $table = 'users';

    protected $fillable = [
        'email',
        'username',
        'password',
        'active',
        'active_hash',
        'remember_identifier',
        'remember_token',
        'recover_hash',
        'first_name',
        'last_name'
    ];

    public function getFullName()
    {
        if (!$this->first_name || !$this->last_name) {
            return null;
        }
        return "{$this->first_name} {$this->last_name}";
    }

    public function getName()
    {
        return $this->getFullName() ?: $this->username;
    }

    public function activateAccount()
    {
        $this->update([
            'active' => true,
            'active_hash' => null
        ]);
    }

    public function updateRememberStatus($remembermeId, $remembermeToken)
    {
        $this->update([
            'remember_identifier' => $remembermeId,
            'remember_token' => $remembermeToken
        ]);
    }

    public function removeRememberStatus()
    {
        $this->updateRememberStatus(null, null);
    }

    public function hasPermission($permission)
    {
        return (bool) $this->permissions->{$permission};
    }

    public function isAdmin()
    {
        return $this->hasPermission('is_admin');
    }

    public function permissions()
    {
        return $this->hasOne('Aideus\User\UserPermission');
    }

    public function isSameUser($user1, $user2)
    {
        return $user1->id == $user2->id;
    }
}
