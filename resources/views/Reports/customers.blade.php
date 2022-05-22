@php
$title = 'كـشـف حـساب';
@endphp
@extends('layouts.app')

@section('content')
  <div id="wrapper" class='toggled-2'>
    @include('includes.sidebar')
    <div id="page-content-wrapper">
      <main class="py-4">
        <section class='expense'>
          <div class="container">
            <div class="page-title">
              <h2>كـشـف حـسـاب عـمـيـل</h2>
              <div class="title-buttons">
                @can('excel كشف حساب عميل')
                  <button class="btn btn-success new-add" id='to-Excel'>
                      <i class="far fa-file-excel"></i>
                    <span>To Excel</span>
                  </button>
                  @endcan
                  @can('pdf كشف حساب عميل')
                  <button class="btn btn-success new-add" id='to-Pdf'>
                    <i class="far fa-file-excel"></i>
                  <span>To PDF</span>
                  </button>
                @endcan
                @can('طباعة كشف حساب عميل')
                <button class="btn btn-success new-add" id='to-Pdf'>
                  <i class="far fa-file-excel"></i>
                <span>طباعة</span>
                </button>
              @endcan
              </div>
            </div>
            <div class="portlet mb-3">
              <div class="row">
                <div class="col-lg-9 col-md-12">
                  <div class="main-input search-container">
                    <div class="main-input input-group">
                      <select class="custom-select" id="reports-customer">
                        <option value="" disabled selected></option>
                        @if(!empty($customers))
                          @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->customer }}</option>
                          @endforeach
                        @endif
                      </select>
                      <div class='search-select'>
                        <div class='label-Select'>
                          <label>حدد العميل</label>
                          <span class="select-value"></span>
                          <i class="fa fa-chevron-down arrow"></i>
                        </div>
                        <div class='input-options'>
                          <input autocomplete="off" type='text' class="search-input" id='branch-input' placeholder="بحث" />
                          <ul></ul>
                        </div>
                      </div>
                    </div>
                    <div class="main-input input-group search-date">
                      <div class="main-input input-group">
                        <input type="date" class="form-control" id='date_to'>
                        <div class="input-group-prepend">
                          <span class="input-group-text">الى</span>
                        </div>
                      </div>
                    </div>
                    <div class="main-input input-group search-date">
                      <div class="main-input input-group">
                        <input type="date" class="form-control" id='date_from'>
                        <div class="input-group-prepend">
                          <span class="input-group-text">من</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-12">
                  <button id="search" class="btn btn-primary btn-block">بحث</button>
                </div>
              </div>
            </div>
                {{-- This Body --}}
          </div>
        </section>
      </main>
    </div>
        <!-- Add expense Modal -->
        <div class="modal modal-info buy-report-modal fade" id="buy-report-modal" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <button type="button" class='close-modal' data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
              <div class="modal-content-form">
                <table class="fl-table view-table update-table" id='table-buy-details'>
                  <thead>
                    <tr>
                      <th>اسم المنتج</th>
                      <th>الوحدة</th>
                      <th>الكمية</th>
                      <th>السعر</th>
                      <th>الخصم</th>
                      <th>الاجمالي</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
  </div>
  @include('ajax.Reports.customer')
@endsection
