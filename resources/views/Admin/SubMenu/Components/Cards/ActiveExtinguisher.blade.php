 <div class="menu-card position-relative">
     <a href="{{ url('Extinguisher/Active/all') }}" class="card-link"></a>
     <div class="card-body">
         <div class="card-icon-container">
             <div class="card-icon">
                 <i class="fa-solid fa-school"></i>
             </div>
         </div>
         <h3 class="card-title">All {{ $type }}</h3>
         <p class="card-description">
             {{ $total }} {{ $type }}
         </p>
     </div>
 </div>
