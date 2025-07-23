@extends('layouts.app')
@section('content')
    {{--this is for to make workable image choose box--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>All Teacher</h2>

            <div class="right-wrapper text-end">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{route('dashboard')}}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>

                    <li><span>Pages</span></li>

                    <li><span>All Teacher</span></li>

                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
            </div>
        </header>
        <div class="row">
            <div class="col-md-12">
                <section class="card">
                    <div class="card-body">

                    </div>
                </section>

            </div>
        </div>
    </section>
@endsection

<script>

</script>
