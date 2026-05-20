<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    protected $fillable = ['id'];
    // هذه الـ Traits هي التي تحل مشكلة الخطأ الذي يظهر لك
    use HasDatabase, HasDomains;

    // لكي يقبل الحزمة حقل 'plan' مباشرة عند الإنشاء
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'plan',
        ];
    }
}