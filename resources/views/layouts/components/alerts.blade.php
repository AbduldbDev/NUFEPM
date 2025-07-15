 @if (session('success'))
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             showFloatingAlert("{{ session('success') }}", "success");
         });
     </script>
 @endif

 @if ($errors->has('error'))
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             showFloatingAlert("{{ $errors->first('error') }}", "danger");
         });
     </script>
 @endif

 @if ($errors->any())
     @foreach ($errors->all() as $error)
         <script>
             document.addEventListener('DOMContentLoaded', function() {
                 showFloatingAlert("{{ $error }}", "danger");
             });
         </script>
     @endforeach
 @endif

 <div id="floatingAlert" class="floating-alert shadow" role="alert">
     <div class="d-flex align-items-center">
         <div class="icon-container me-3">
             <i id="alertIcon" class="fas fa-check-circle fa-lg fa-beat"></i>
         </div>
         <div class="alert-message flex-grow-1" id="alertMessage" style="text-transform: capitalize">
             Operation completed successfully.
         </div>
         <button type="button" class="btn-close ms-3" aria-label="Close" onclick="hideFloatingAlert()"></button>
     </div>
 </div>
