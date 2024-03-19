@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                Selamat datang di dashboard.

                <p>Silahkan pilih menu di bawah ini.</p>
                @canany(['create-role', 'edit-role', 'delete-role'])
                <a class="btn btn-primary" href="{{ route('roles.index') }}">
                    <i class="bi bi-person-fill-gear"></i> Atur Roles</a>
                @endcanany
                @canany(['create-user', 'edit-user', 'delete-user'])
                <a class="btn btn-success" href="{{ route('users.index') }}">
                    <i class="bi bi-people"></i> Atur User</a>
                @endcanany
                <br /><br />
                @canany(['view mutasi-tag-bin1'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_tag_bin1.index') }}">
                    <i class="bi bi-bag"></i> Mutasi Tag Bin 1</a>
                @endcanany
                @canany(['view mutasi-tag-bin2'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_tag_bin2.index') }}">
                    <i class="bi bi-bag"></i> Mutasi Tag Bin 2</a>
                @endcanany
                @canany(['view mutasi-tag-bin3'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_tag_bin3.index') }}">
                    <i class="bi bi-bag"></i> Mutasi Tag Bin 3</a>
                @endcanany
                @canany(['view mutasi-tag-bin4'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_tag_bin4.index') }}">
                    <i class="bi bi-bag"></i> Mutasi Tag Bin 4</a>
                @endcanany
                <br /><br />

                @canany(['view mutasi-cw1'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_cw1.index') }}">
                    <i class="bi bi-bag"></i> Mutasi C W 1</a>
                @endcanany
                @canany(['view mutasi-cw2'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_cw2.index') }}">
                    <i class="bi bi-bag"></i> Mutasi C W 2</a>
                @endcanany
                @canany(['view mutasi-cw3'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_cw3.index') }}">
                    <i class="bi bi-bag"></i> Mutasi C W 3</a>
                @endcanany
                @canany(['view mutasi-cw4'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_cw4.index') }}">
                    <i class="bi bi-bag"></i> Mutasi C W 4</a>
                @endcanany
                @canany(['view mutasi-cw5'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_cw5.index') }}">
                    <i class="bi bi-bag"></i> Mutasi C W 5</a>
                @endcanany

                <br /><br />

                @canany(['view mutasi-d1'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_d1.index') }}">
                    <i class="bi bi-bag"></i> Mutasi D 1</a>
                @endcanany
                @canany(['view mutasi-d2'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_d2.index') }}">
                    <i class="bi bi-bag"></i> Mutasi D 2</a>
                @endcanany
                @canany(['view mutasi-d3'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_d3.index') }}">
                    <i class="bi bi-bag"></i> Mutasi D 3</a>
                @endcanany
                @canany(['view mutasi-d4'])
                <a class="btn btn-danger mt-2" href="{{ route('mutasi_d4.index') }}">
                    <i class="bi bi-bag"></i> Mutasi D 4</a>
                @endcanany

                <br /><br />

                @canany(['view crystal-report1'])
                <a class="btn btn-danger mt-2" href="{{ route('crystal_report1.index') }}">
                    <i class="bi bi-bag"></i> CR 1</a>
                @endcanany
                @canany(['view crystal-report2'])
                <a class="btn btn-danger mt-2" href="{{ route('crystal_report2.index') }}">
                    <i class="bi bi-bag"></i> CR 2</a>
                @endcanany
                @canany(['view crystal-report3'])
                <a class="btn btn-danger mt-2" href="{{ route('crystal_report3.index') }}">
                    <i class="bi bi-bag"></i> CR 3</a>
                @endcanany
                @canany(['view crystal-report4'])
                <a class="btn btn-danger mt-2" href="{{ route('crystal_report4.index') }}">
                    <i class="bi bi-bag"></i> CR 4</a>
                @endcanany
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
</div>
@endsection