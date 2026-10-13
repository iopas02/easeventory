<?php

namespace App\Support;

use App\Models\Tenant;

/**
 * Holds the tenant for the current request so tenant-owned models can be
 * scoped automatically. Registered as a singleton in AppServiceProvider.
 */
class TenantManager
{
    protected ?Tenant $tenant = null;

    /**
     * Set the current tenant.
     */
    public function set(?Tenant $tenant): void
    {
        $this->tenant = $tenant;
    }

    /**
     * Get the current tenant.
     */
    public function get(): ?Tenant
    {
        return $this->tenant;
    }

    /**
     * Get the current tenant's id.
     */
    public function id(): ?int
    {
        return $this->tenant?->getKey();
    }

    /**
     * Whether a tenant is currently set.
     */
    public function has(): bool
    {
        return $this->tenant !== null;
    }

    /**
     * Forget the current tenant.
     */
    public function forget(): void
    {
        $this->tenant = null;
    }
}
