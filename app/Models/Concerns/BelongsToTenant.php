<?php

namespace App\Models\Concerns;

use App\Models\Tenant;
use App\Support\TenantManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Use this trait on any model whose rows are owned by a single tenant
 * (products, suppliers, purchase orders, sales, stock movements, ...).
 *
 * It automatically:
 *   - fills tenant_id when creating a record, and
 *   - scopes all queries to the current tenant.
 */
trait BelongsToTenant
{
    protected static function bootBelongsToTenant(): void
    {
        static::creating(function ($model) {
            if (is_null($model->tenant_id)) {
                $model->tenant_id = app(TenantManager::class)->id();
            }
        });

        static::addGlobalScope('tenant', function (Builder $builder) {
            $tenantId = app(TenantManager::class)->id();

            if (! is_null($tenantId)) {
                $builder->where($builder->getModel()->getTable().'.tenant_id', $tenantId);
            }
        });
    }

    /**
     * The tenant this record belongs to.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
