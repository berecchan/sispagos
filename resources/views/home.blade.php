@extends('layouts.main')

@section('content')


<div class="row d-flex justify-content-center">
  <div class="col-lg-9 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Bienvenid@ {{Auth::user()->name}}! 🎉</h5>
            <p class="mb-4">
              Sistema de Gestión de <span class="fw-bold">Matrículas y Pagos</span>
            </p>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img
              src="../assets/img/illustrations/man-with-laptop-light.png"
              height="140"
              alt="View Badge User"
              data-app-dark-img="illustrations/man-with-laptop-dark.png"
              data-app-light-img="illustrations/man-with-laptop-light.png" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row d-flex justify-content-center">
  <div class="col-md-3 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">                  
            <img src="{{asset('assets/img/unicons/wallet-info.png')}}" alt="chart success" class="rounded">
          </div>
          
        </div>
        <span class="fw-semibold d-block mb-1">{{$ctd_matricula}}</span>
        <h3 class="card-title text-nowrap mb-1">Alumnos</h3>
        <div class="row text-center">
          <a href="{{route('estudiantes.index')}}" class="btn btn-outline-info"><i class="bx bx-user-pin"></i> Alumnos</a>
        </div>                
      </div>
    </div>
  </div>

  <div class="col-md-3 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <img src="{{asset('assets/img/unicons/cc-warning.png')}}" alt="chart success" class="rounded">
          </div>
          
        </div>
        <span class="fw-semibold d-block mb-1">$ {{number_format($pagos_matricula, 2, '.', ',')}}</span>
        <h3 class="card-title text-nowrap mb-1">Pagos</h3>
        <div class="row text-center">
          <a href="{{route('pagos.index')}}" class="btn btn-outline-warning"> <i class="bx bx-money"></i> Pagos</a>       
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <img src="{{asset('assets/img/unicons/chart-success.png')}}" alt="chart info" class="rounded">
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">-</span>
        <h3 class="card-title text-nowrap mb-1">Ingresos</h3>
        <div class="row text-center">
          <a href="{{route('reportes')}}" class="btn btn-outline-success"> <i class='bx bxs-pie-chart-alt-2'></i> Reportes de ingresos</a>       
        </div>
      </div>
    </div>
  </div>

</div>

    
@endsection