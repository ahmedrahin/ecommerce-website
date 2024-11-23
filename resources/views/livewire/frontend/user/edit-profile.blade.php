<div class="reviews-modal modal theme-modal fade" id="edit-box" tabindex="-1" role="dialog" aria-modal="true" wire:ignore.self>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Edit Profile</h4>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pt-0">
            <form wire:submit.prevent="submit">
                <div class="row g-3">      
                    <div class="col-12"> 
                    <div class="from-group"> 
                        <label class="form-label">Name</label>
                        <input class="form-control @error('name') error-border @enderror" type="text" name="name" placeholder="Enter your name." wire:model="name">
                        @error('name')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                    </div>
                
                    <div class="col-md-6">
                    <div class="from-group"> 
                        <label class="form-label">Email address</label>
                        <input class="form-control @error('email') error-border @enderror" type="email" placeholder="Enter your email" wire:model="email">
                        @error('email')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-6"> 
                    <div class="from-group"> 
                        <label class="form-label">Phone</label>
                        <input class="form-control @error('phone') error-border @enderror" type="number" name="phone" placeholder="Enter your Number" wire:model="phone">
                        @error('phone')
                            <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="col-12">    
                    <div class="from-group">    
                        <label class="form-label">Address</label>
                        <textarea class="form-control" cols="30" rows="3" placeholder="Write your Address..." wire:model="address_line1"></textarea>
                    </div>
                    </div>
                    <button class="btn btn-submit mt-3" type="submit" style="width: 100px;">
                        <span wire:loading.remove wire:target="submit">Submit</span>
                        <span wire:loading wire:target="submit">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
