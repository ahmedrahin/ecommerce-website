<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AddAdminModal extends Component
{
    use WithFileUploads;

    public $user_id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $image;
    public $current_image;

    public $edit_mode = false;

    protected $rules = [
        'name'      => 'required|string',
        'email'     => 'required|email|unique:users,email',
        'role'      => 'nullable|string',
        'image'     => 'nullable|sometimes|image|max:2048',
    ];

    protected $listeners = [
        'delete_user' => 'deleteUser',
        'update_user' => 'updateUser',
        'open_add_modal' =>'openAddModal',
        'update_status'   => 'updateStatus',
    ];

    public function render()
    {
        $roles = Role::all();
        return view('livewire.user.add-admin-modal', compact('roles'));
    }

    public function submit()
    {
        // Adjust validation rules for editing
        if ($this->edit_mode) {
            $this->rules['email'] = 'required|email|unique:users,email,' . $this->user_id;
        } else {
            $this->rules['password'] = 'required|min:6';
        }

        $this->validate();

        DB::transaction(function () {

            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'created_by' => Auth::id(),
                'isAdmin' => 1
            ];

            // Handle image upload when not in edit mode
            if ($this->image && !$this->edit_mode) {
                $thisImage = $this->image;
                $imageName = time() . '_' . $thisImage->getClientOriginalName();
                $path = $thisImage->storeAs('uploads/admin', $imageName, 'real_public');
            
                // Store the path in the database
                $data['avatar'] = 'uploads/admin/' . $imageName;
            }

            // Handle password
            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }

            // Handle image upload for edit mode
            if ($this->edit_mode) {
                $user = User::find($this->user_id);
            
                // Handle image upload during update
                if ($this->image) {
                    if ($user->avatar) {
                        Storage::disk('real_public')->delete($user->avatar);
                    }
                    $user->avatar = $this->image->store('uploads/admin', 'real_public');
                } elseif ($this->current_image === null) {
                    // If no new image is uploaded and the current image is set to null (user wants to remove it)
                    if ($user->avatar) {
                        Storage::disk('real_public')->delete($user->avatar);
                    }
            
                    // Set avatar to null in the database
                    $user->avatar = null;
                }
            
                $user->save();
            }

            // Create or update the user
            $user = User::updateOrCreate(
                ['email' => $this->email],
                $data
            );

            // Handle role assignment
            if ($this->edit_mode) {
                // Sync roles
                $user->syncRoles($this->role);

                // Manually update the created_at timestamp in model_has_roles
                DB::table('model_has_roles')
                    ->where('model_id', $user->id)
                    ->where('model_type', User::class)
                    ->update(['created_at' => now()]);

                $this->emit('success', __('Admin is updated'));
            } else {
                // Assign new role
                $user->assignRole($this->role);

                // Manually update the created_at timestamp in model_has_roles
                DB::table('model_has_roles')
                    ->where('model_id', $user->id)
                    ->where('model_type', User::class)
                    ->update(['created_at' => now()]);

                $this->emit('success', __('New admin created'));
            }
        });

        $this->reset();
    }


    public function deleteUser($id)
    {
        // Prevent deletion of current user
        if ($id == 1) {
            $this->emit('warning', 'You cannot delete this account');
            return;
        }else if($id == Auth::id()){
            $this->emit('error', 'You cannot delete your own account');
            return;
        }

        // Get the user
        $user = User::find($id);

        if ($user) {
            // Delete avatar if exists
            if ($user->avatar) {
                Storage::disk('real_public')->delete($user->avatar);
            }

            // Delete user
            $user->delete();

            $this->emit('info', 'Admin was deleted');
        }
    }

    public function updateUser($id)
    {
        $this->edit_mode = true;
        $user = User::find($id);

        if ($user) {
            $this->user_id = $user->id;
            $this->current_image = $user->avatar;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->roles?->first()->name ?? '';
        }
    }

    //update status
    public function updateStatus($id, $status)
    {
        $user = User::findOrFail($id);
    
        // Prevent disabling the super admin
        if ($user->id == 1) {
            $this->emit('warning', 'You cannot disable this account.');
            return;
        }
    
        // Prevent the currently authenticated user from disabling their own account without logging out
        if (auth()->id() == $user->id && $status == 0) {
            $user->update(['status' => $status]);
    
            // Log the user out
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
    
            // Delete the user's session
            DB::table('sessions')
                ->where('user_id', $user->id)
                ->delete();
    
            // Redirect to login
            return redirect()->route('login')->with('info', 'Your account has been disabled and you have been logged out.');
        }
    
        // Disable or enable another user's account
        $user->update(['status' => $status]);
    
        if ($status == 0) {
            // Delete the user's session
            DB::table('sessions')
                ->where('user_id', $user->id)
                ->delete();
    
            // Emit a message for admin
            $message = "{$user->name}'s account has been disabled.";
            $this->emit('info', $message);
        } else {
            $message = "{$user->name}'s account has been enabled.";
            $this->emit('success', $message);
        }
    }
    

    public function removeImage()
    {
        $this->image = null;
        if ($this->current_image) {
            $this->current_image = null;
        }
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openAddModal()
    {
        $this->reset();
        $this->edit_mode = false; // Ensure edit mode is reset
    }
}
