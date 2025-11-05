  <div class="breadcrumb-container">
      <div class="breadcrumb-back">
          <a href="javascript:history.back()" class="back-button">
              <i class="fa-solid fa-arrow-left"></i>
          </a>
      </div>
      <div class="breadcrumb-icon">
          <i class="fa-solid fa-fire-extinguisher"></i>
      </div>
      <nav class="breadcrumb-nav">
          <div class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">Home</a>
          </div>
          <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
          <div class="breadcrumb-item">
              <a href="{{ route('admin.ShowAdminInspectionMenu') }}">Inspections</a>
          </div>
          <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
          <div class="breadcrumb-item active">
              Extinguishers
          </div>
      </nav>
  </div>
