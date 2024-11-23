<div class="reviews-modal modal theme-modal fade" id="edit-password" tabindex="-1" role="dialog" aria-modal="true" wire:ignore.self>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Edit Password</h4>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pt-0">
            <form wire:submit.prevent="ChnagePassword">
                <div class="row g-3">        
                    <div class="col-12"> 
                    <div class="from-group"> 
                        <label class="form-label">Current Password</label>
                        <input class="form-control  @error('current_password') error-border  @enderror" type="password" placeholder="******" name="current_password" autocomplete="off" wire:model="current_password" />
                        @error('current_password')
                            <div class="text-danger pt-2">{{$message}}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="col-12">
                    <div class="from-group"> 
                        <label class="form-label">New password</label>
                        <input class="form-control @error('new_password') error-border  @enderror" type="password" placeholder="enter a new password" name="new_password" autocomplete="off" wire:model="new_password" />
                        @error('new_password')
                            <div class="text-danger pt-2">{{$message}}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="col-12">
                    <div class="from-group"> 
                        <label class="form-label">Confirm password</label>
                        <input class="form-control @error('new_password_confirmation') error-border  @enderror" type="password" placeholder="enter a confirm password" name="new_password_confirmation" autocomplete="off" wire:model="new_password_confirmation" />
                        @error('new_password_confirmation')
                            <div class="text-danger pt-2">{{$message}}</div>
                        @enderror
                    </div>
                    </div>
                    <button class="btn btn-submit mt-3" type="submit" style="width: 155px;">
                        <span wire:loading.remove wire:target="ChnagePassword">Save Change</span>
                        <span wire:loading wire:target="ChnagePassword">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
