<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends AbstractRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    protected function applyFilters($query, array $filters)
    {
        $filtersQuery = [
            'name' => $filters['name'] ?? '',
            'email' => $filters['email'] ?? '',
        ];
    
        if (!empty($filtersQuery)) {
            $query->where([
                ['name', 'LIKE', '%' . $filtersQuery['name'] . '%'],
                ['email', 'LIKE', '%' . $filtersQuery['email'] . '%'],
            ]);
        }
    }

    public function updatePassword(User $user, $newPassword): void
    {
        $user->password = Hash::make($newPassword);
        
        $user->save();
    }
}
