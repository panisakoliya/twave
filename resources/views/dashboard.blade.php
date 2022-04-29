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

        <div class="col-xl-3">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-primary">
                            <i class="material-icons-outlined">segment</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">
                                <a class="text-decorate-none"
                                   href="{{route('category.index')}}">Total Categories</a>
                            </span>
                            <span class="widget-stats-amount">{{count($categories)}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-primary">
                            <i class="material-icons-outlined">extension</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">
                                <a class="text-decorate-none"
                                   href="{{route('product.index')}}">Total Products</a>
                            </span>
                            <span class="widget-stats-amount">{{count($products)}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-primary">
                            <i class="material-icons-outlined">summarize</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">
                                <a class="text-decorate-none"
                                   href="{{route('hero.index')}}">Total Heros</a>
                            </span>
                            <span class="widget-stats-amount">{{count($heros)}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
