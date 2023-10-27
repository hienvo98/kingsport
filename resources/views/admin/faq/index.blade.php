@extends('layouts.appAdmin')
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">FAQS</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQS</li>
                </ol>
            </nav>
        </div>
    </div>
    @if (session('message'))
        <div id="notification" class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <!-- Page Header Close -->
    <!-- Start::row-1 -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- Start::row-1 -->
            <div class="row justify-content-center mb-5">
                <div class="col-xl-12">
                    <div class="row justify-content-center">
                        <div class="col-xl-6">
                            <div class="text-center p-3 faq-header mb-4">
                                <h5 class="mb-1 text-primary op-5 fw-semibold">F.A.Q's</h5>
                                <h4 class="mb-1 fw-semibold">Frequently Asked Questions</h4>
                                <p class="fs-15 text-muted op-7">We have shared some of the most frequently asked questions to help you out! </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="row">
                        @foreach($category as $key => $cate)
                        <div class="col-xl-6">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">
                                        {{$cate->name}}
                                    </div>
                                </div>
                                <div class="card-body">
                                @foreach($cate->faq as $faq)
                                    <div class="accordion accordion-customicon1 accordion-primary" id="accordionFAQ{{ $faq->id }}">
                                        
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingcustomicon2{{$faq->id}}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsecustomicon2{{$faq->id}}" aria-expanded="true"
                                                    aria-controls="collapsecustomicon2{{$faq->id}}">
                                                        {{$faq->answer}}
                                                </button>
                                            </h2>
                                            <div id="collapsecustomicon2{{$faq->id}}" class="accordion-collapse collapse"
                                                aria-labelledby="headingcustomicon2{{$faq->id}}"
                                                data-bs-parent="#accordionFAQ{{ $faq->id }}">
                                                <div class="accordion-body">
                                                    {{$faq->question}}
                                                </div>
                                                <div class="text-end mt-3 mb-2">
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>  
                        @endforeach
                    </div>
                </div>
            </div>
            <!--End::row-1 -->

        </div>
    </div>
    <!--End::row-1 -->
@endsection
