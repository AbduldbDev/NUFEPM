 @if (session('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
 @endif

 {{-- Error Message --}}
 @if ($errors->has('error'))
     <div class="alert alert-danger">
         {{ $errors->first('error') }}
     </div>
 @endif

 @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">
             <span>{{ $error }}</span>
         </div>
     @endforeach
 @endif
