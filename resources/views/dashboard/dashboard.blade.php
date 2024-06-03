@extends('template.main')
@section('title', 'Dashboard')
@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">@yield('title')</a></li>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $jmlprestasi }}</h3>
                                <p>Total Prestasi</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fa-solid fa-trophy"></i>
                            </div>
                            <a href="/prestasi" class="small-box-footer">Selengkapnya <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                  <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $jmlproker }}</h3>

                                <p>Total Progam Kerja</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fa-solid fa-book-open"></i>
                            </div>
                            <a href="/proker" class="small-box-footer">Selengkapnya <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $jmlkegiatan }}</h3>
                                <p>Total Kegiatan</p>

                            </div>
                            <div class="icon">
                                <i class="nav-icon fa-solid fa-calendar-check"></i>
                            </div>
                            <a href="/kegiatan" class="small-box-footer">Selengkapnya <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    {{-- <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> --}}
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

@endsection
