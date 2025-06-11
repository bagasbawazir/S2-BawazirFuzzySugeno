@section('title', 'Detail Role')

<div>
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @livewire('components.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('includes.content-header')

            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('role.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                            Back</a>
                    </div>
                    <!-- ./card-header -->
                    <div class="card-body pt-4">

                        <blockquote class="quote-secondary">
                            <h4>ID ROLE: {{ 'ROLE-' . '' . str_pad('' . $this->role->id, 3, '0', STR_PAD_LEFT) }}</h4>
                        </blockquote>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 125px"><strong>NAME ROLE</strong></td>
                                    <td>{{ $this->role->name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 125px"><strong>PERMISSIONS</strong></td>
                                    <td>
                                        @foreach ($this->role->permissions as $permission)
                                            <span class="badge bg-primary">{{ Str::title(str_replace('_', ' ', $permission['name'])) }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('includes.footer')
    </div>
    <!-- ./wrapper -->
</div>
