
    
    <!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | General Form Elements</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff"
        media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a"
        media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE 4 | General Form Elements" />
    <meta name="author" content="ColorlibHQ" />
    <meta
        name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta
        name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="./css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous"
        media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="./css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
</head>
<!--end::Head-->
<!--begin::Body-->

    <!--begin::Sidebar-->

    <!--end::Sidebar-->

    <!--begin::App Main-->
    <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0">Register</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User
                  Form</li>
              </ol>
            </div>
          </div>
          <!--end::Row-->
        </div>
        <!--end::Container-->
      </div>
      <!--end::App Content Header-->
      <!--begin::App Content-->
      <div class="app-content" style="display:flex; justify-content:center; ">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row justify-content-center">

            <!--begin::Col-->
            <div class="col-md-6">
              <!--begin::Quick Example-->
              <div class="card card-primary card-outline mb-4">
                <!--begin::Header-->


                <!--end::Header-->

                <!--begin::Form-->
                <form method="post" action="insert.php"
                  enctype="multipart/form-data">
                  <!--begin::Body-->
                  <div class="card-body">

                    <div class="mb-3">
                      <label for="firstName" class="form-label">First
                        Name</label>
                      <input
                        type="text"
                        name="last_name"
                        class="form-control"
                        required />
                    </div>

                    <div class="mb-3">
                      <label for="lastName" class="form-label">Last
                        Name</label>
                      <input
                        type="text"
                        name="first_name"
                        class="form-control"
                        id="lastName"
                        required />
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email
                        address</label>
                      <input
                        type="email"
                        name="email"
                        class="form-control"
                        id="exampleInputEmail1"
                        aria-describedby="emailHelp"
                        required />
                      <div id="emailHelp" class="form-text">
                        We'll never share your email with anyone else.
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputPassword1"
                        class="form-label">Password</label>
                      <input type="password" class="form-control"
                        name="password" minlength="8" required id="exampleInputPassword1" required />
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1"
                        class="form-label">Confirm Password</label>
                      <input type="password" class="form-control"
                        name="confirm_password" minlength="8" required id="exampleInputPassword1"
                        required />
                    </div>

                    

                  </div>
                  <!--end::Body-->
                  <!--begin::Footer-->
                  <div class="card-footer" style="display:flex; justify-content:center; ">
                    <!-- <button type="submit" name="submit"
                        class="btn btn-primary">Submit</button> -->
                    <input type="submit" name="submit" class="btn btn-primary" value="Register">

                  </div>
                  <!--end::Footer-->
                </form>
                <!--end::Form-->
              </div>
              <!--end::Quick Example-->


              <!--begin::JavaScript-->
              <script>
                // Example starter JavaScript for disabling form submissions if there are invalid fields
                (() => {
                  'use strict';

                  // Fetch all the forms we want to apply custom Bootstrap validation styles to
                  const forms = document.querySelectorAll('.needs-validation');

                  // Loop over them and prevent submission
                  Array.from(forms).forEach((form) => {
                    form.addEventListener(
                      'submit',
                      (event) => {
                        if (!form.checkValidity()) {
                          event.preventDefault();
                          event.stopPropagation();
                        }

                        form.classList.add('was-validated');
                      },
                      false,
                    );
                  });
                })();
              </script>
              <!--end::JavaScript-->
            </div>
            <!--end::Form Validation-->
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->
      </div>
      <!--end::Container-->
  </div>
  <!--end::App Content-->
  </main>
  <!--end::App Main-->

      <script
        src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="./js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
</body>
<!--end::Body-->

</html>
  
  
