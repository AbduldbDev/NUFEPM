 <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content border-0 shadow rounded-3">
             <div class="modal-body text-center p-4">
                 <div class="mb-3">
                     <i class="fa-solid fa-triangle-exclamation fa-3x text-danger fa-beat"></i>
                 </div>
                 <h5 class="mb-3">Confirm Deletion</h5>
                 <p class="text-muted">Are you sure you want to delete this item? <br>
                     This action cannot be undone.</p>
                 <div class="d-flex justify-content-center gap-2 mt-4">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                     <button type="button" class="btn btn-danger" onclick="proceedDelete()">Delete</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
