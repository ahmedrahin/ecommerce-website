<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class GenarelSettings extends Component
{   
    use WithFileUploads;

    public $setting;
    public $logo;
    public $fav_icon;
    public $title;
    public $email;
    public $number1;
    public $number2;
    public $state;
    public $address;
    public $current_image;
    public $current_favIcon;

    public function mount()
    {
        $this->setting = Setting::find(1);

        $this->title =  $this->setting->site_title ?? '';
        $this->email =  $this->setting->email ?? '';
        $this->number1 =  $this->setting->number1 ?? '';
        $this->number2 =  $this->setting->number2 ?? '';
        $this->state =   $this->setting->state ?? '';
        $this->address = $this->setting->address ?? '';
        $this->current_image = $this->setting->logo;
        $this->current_favIcon = $this->setting->fav_icon;
    }

    protected $rules = [
        'title' => 'required',
        'email' => 'required|email',
    ];

    public function update($id = 1){
        $this->validate();
        $updateData = Setting::find($id);
        $updateData->update([
            'site_title' => $this->title,
            'email'      => $this->email,
            'number1'    => $this->number1,
            'number2'    => $this->number2,
            'state'      => $this->state,
            'address'    => $this->address,
        ]);

        $this->logo_favImageHandle($updateData);

        $this->emit('success', __('Store settings Updated successfully.'));
    }

    public function logo_favImageHandle($updateData)
    {
        // Logo upload
        if ($this->logo) {
            // Check if a logo exists before trying to delete it
            if ($updateData->logo && Storage::disk('real_public')->exists($updateData->logo)) {
                Storage::disk('real_public')->delete($updateData->logo);
            }

            // Store the new logo
            $thisImage = $this->logo;
            $imageName = time() . '_' . $thisImage->getClientOriginalName();
            $path = $thisImage->storeAs('uploads/logo_fav', $imageName, 'real_public');

            // Update the setting with the new logo path
            $updateData->update([
                'logo' => 'uploads/logo_fav/' . $imageName
            ]);
        } elseif ($this->current_image === null && $updateData->logo) {
            // Only delete if the logo exists and current_image is null
            if (Storage::disk('real_public')->exists($updateData->logo)) {
                Storage::disk('real_public')->delete($updateData->logo);
            }
            $updateData->update(['logo' => null]);
        }

        // Fav icon upload
        if ($this->fav_icon) {
            // Check if a fav icon exists before trying to delete it
            if ($updateData->fav_icon && Storage::disk('real_public')->exists($updateData->fav_icon)) {
                Storage::disk('real_public')->delete($updateData->fav_icon);
            }

            // Store the new fav icon
            $thisImage = $this->fav_icon;
            $imageName = time() . '_' . $thisImage->getClientOriginalName();
            $path = $thisImage->storeAs('uploads/logo_fav', $imageName, 'real_public');

            // Update the setting with the new fav icon path
            $updateData->update([
                'fav_icon' => 'uploads/logo_fav/' . $imageName
            ]);
        } elseif ($this->current_favIcon === null && $updateData->fav_icon) {
            // Only delete if the fav icon exists and current_favIcon is null
            if (Storage::disk('real_public')->exists($updateData->fav_icon)) {
                Storage::disk('real_public')->delete($updateData->fav_icon);
            }
            $updateData->update(['fav_icon' => null]);
        }
    }

    

    // Method to remove the image
    public function removeLogo()
    {
        $this->logo   = null;
        if ($this->current_image) {
            $this->current_image = null;
        }
    }

    public function removeFavIcon()
    {
        $this->fav_icon = null; 
        if ($this->current_favIcon) {
            $this->current_favIcon = null;
        }
    }



    public function render()
    {
        return view('livewire.settings.genarel-settings', [
            'setting' => $this->setting,
        ]);
    }
}
