<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * List every tenant user across all organizations.
     */
    public function index(Request $request): View
    {
        $search = trim($request->string('q')->toString());

        $users = User::with('tenant')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('superadmin.users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        return view('superadmin.users.create');
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateUser($request);

        DB::beginTransaction();

        try {
            $tenant = $this->resolveTenant($data['email'], $data['store_name']);

            User::create([
                'tenant_id' => $tenant->id,
                'name' => $data['name'],
                'email' => Str::lower($data['email']),
                'password' => $data['password'],
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }

        return redirect()
            ->route('superadmin.users.index')
            ->with('status', 'User created successfully.');
    }

    /**
     * Show the form for editing an existing user.
     */
    public function edit(User $user): View
    {
        $user->load('tenant');

        return view('superadmin.users.edit', compact('user'));
    }

    /**
     * Update the given user.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $this->validateUser($request, $user);

        DB::beginTransaction();

        try {
            $tenant = $this->resolveTenant($data['email'], $data['store_name']);

            $user->fill([
                'tenant_id' => $tenant->id,
                'name' => $data['name'],
                'email' => Str::lower($data['email']),
            ]);

            if (! empty($data['password'])) {
                $user->password = $data['password'];
            }

            $user->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }

        return redirect()
            ->route('superadmin.users.index')
            ->with('status', 'User updated successfully.');
    }

    /**
     * Delete the given user.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()
            ->route('superadmin.users.index')
            ->with('status', 'User deleted successfully.');
    }

    /**
     * Validate the user form input.
     *
     * @return array<string, string>
     */
    protected function validateUser(Request $request, ?User $user = null): array
    {
        return $request->validate([
            'store_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user?->id),
            ],
            'password' => [
                $user ? 'nullable' : 'required',
                'string', 'min:6',
            ],
        ]);
    }

    /**
     * Resolve the tenant for an email, creating it when the domain is new.
     *
     * The tenant is keyed by email domain, matching the login behaviour.
     */
    protected function resolveTenant(string $email, string $storeName): Tenant
    {
        $domain = Str::lower(Str::after(trim($email), '@'));

        return Tenant::updateOrCreate(
            ['domain' => $domain],
            ['name' => $storeName],
        );
    }
}
