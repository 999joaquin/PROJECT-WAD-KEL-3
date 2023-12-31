<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('admin.dashboard') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.patients.dashboard') }}">Patients List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.selectPatient') }}">Add Details</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.viewAppointments') }}">View Appointments</a>
        </li>
        <li class="nav-item">
  <a class="nav-link" href="{{ route('admin.viewDoctors') }}">View Doctors</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.showAddDoctorForm') }}">Add Doctor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.addScheduleForm') }}">Add Schedule</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.addMedicines') }}">Medicine</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.articleIndex') }}">Article</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </li>
      </ul>
      <span class="nav-text"></span>
    </div>
</nav>