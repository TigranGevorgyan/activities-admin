<?php

namespace App\Filament\Resources\AdminUserResource\Pages;

use App\Filament\Resources\AdminUserResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateAdminUser extends CreateRecord
{
    protected static string $resource = AdminUserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = bcrypt('password');
        return $data;
    }

    protected function afterCreate(): void
    {
        $this->record->assignRole($this->data['role']);
    }
}
