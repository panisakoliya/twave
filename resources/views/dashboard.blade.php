@extends('layouts.app')
@section('title') Dashboard @endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-primary">
                            <i class="material-icons-outlined">person</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">
                                <a class="text-decorate-none"
                                   href="{{route('user.index')}}">Total Users</a>
                            </span>
                            <span class="widget-stats-amount">{{count($users)}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
