<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
            <h3>Super Admin</h3>

        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top">

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0; display: inline;">
            @csrf <!-- CSRF token for security -->
            <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Logout</button>
        </form>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>


    </nav>
