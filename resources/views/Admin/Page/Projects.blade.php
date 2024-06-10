@extends('Admin/Layout.Main')
@section('Content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Projects Settings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Projects</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Home Setting</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th width="70%">
                                        <b>Area Settings</b>
                                    </th>
                                    <th>Active</th>
                                    <td>Updated at</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Updated at</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                        </div>
                                    </td>
                                    <td>Updated at</td>
                                </tr>
                                <tr>
                                    <td>Unity Pugh</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                        </div>
                                    </td>
                                    <td>Curicó</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
<!-- End #main -->
@endsection