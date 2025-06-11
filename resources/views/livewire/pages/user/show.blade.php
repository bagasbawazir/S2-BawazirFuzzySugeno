@section('title', 'Detail User')

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
                        <a href="{{ route('user.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <!-- ./card-header -->
                    <div class="card-body pt-4">

                        <blockquote class="quote-secondary">
                            <h4>ID USER: {{ 'U-' . '' . str_pad('' . $this->user->id_user, 5, '0', STR_PAD_LEFT) }}</h4>
                        </blockquote>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 130px"><strong>FULL NAME</strong></td>
                                    <td>{{ $this->user->fullname }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 130px"><strong>USERNAME</strong></td>
                                    <td>{{ $this->user->username }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 130px"><strong>ROLES</strong></td>
                                    <td>
                                        @foreach ($this->user->getRoleNames() as $role)
                                            <span class="badge bg-primary">{{ $role }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 125px"><strong>Member Since</strong></td>
                                    <td>{{ $this->user->created_at->format('F-Y') }}</td>
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
