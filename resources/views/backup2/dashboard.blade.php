<x-app-layout>
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Create New</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
              <div class="breadcrumb-item"><a href="#">Posts</a></div>
              <div class="breadcrumb-item">Create New Post</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Create New</h2>
            <p class="section-lead">
              On this page you can create a new post and fill in all fields.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Basic DataTables</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                            <tr>
                                <th class="text-center">
                                #
                                </th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                1
                                </td>
                                <td>
                                <img alt="image" src="{{ asset('img/avatar/avatar-5.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                                </td>
                                <td>Create a mobile app</td>
                                <td>hanafiahtkj95@gmail.com</td>
                                <td>General</td>
                                <td><div class="badge badge-success">Completed</div></td>
                                <td>2018-01-20</td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                                <td>
                                2
                                </td>
                                <td>
                                <img alt="image" src="{{ asset('img/avatar/avatar-4.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                                </td>
                                <td>Redesign homepage</td>
                                <td>hanafiahtkj95@gmail.com</td>
                                <td>General</td>
                                <td><div class="badge badge-success">Completed</div></td>
                                <td>2018-01-20</td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                                <td>
                                3
                                </td>
                                <td>
                                <img alt="image" src="{{ asset('img/avatar/avatar-3.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                                </td>
                                <td>Backup database</td>
                                <td>hanafiahtkj95@gmail.com</td>
                                <td>General</td>
                                <td><div class="badge badge-success">Completed</div></td>
                                <td>2018-01-20</td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                                <td>
                                4
                                </td>
                                <td>
                                <img alt="image" src="{{ asset('img/avatar/avatar-2.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                                </td>
                                <td>Input data</td>
                                <td>hanafiahtkj95@gmail.com</td>
                                <td>General</td>
                                <td><div class="badge badge-success">Completed</div></td>
                                <td>2018-01-20</td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

          </div>
        </section>
    </div>
</x-app-layout>
