@extends('partials.admin')
@section('title', 'Admin Dashboard')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'ads.all'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Ads Listing', 'hasBack' => true, 'backTitle' => 'Dashboard', 'backUrl' => route('admin.dashboard')])
            <div class="row">
                <div class="col-12 col-sm-12">
                   <div class="card">
                      <div class="card-header">
                         <h3 class="card-title mb-0">All Ads</h3>
                      </div>
                      <div class="card-body pt-4">
                         <div class="grid-margin">
                            <div class="">
                               <div class="panel panel-primary">
                                  <div class="panel-body tabs-menu-body border-0 pt-0">
                                    <form class="input-group mb-5">
                                       <input name="search" type="text" class="form-control" placeholder="Search" value="{{ request()->search }}" />
                                       <div class="input-group-text btn btn-primary">
                                          <button class="bg-transparent border-0 text-white">
                                           <i type="submit" class="fa-regular fa-search" aria-hidden="true"></i>
                                          </button>
                                       </div>
                                    </form>
                                     <div class="tab-content">
                                        <div class="tab-pane active">
                                           <div class="table-responsive">
                                              <div id="data-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                 <div class="row">
                                                    <div class="col-sm-12">
                                                       <table id="data-table"
                                                          class="table table-bordered text-nowrap mb-0 dataTable no-footer"
                                                          role="grid" aria-describedby="data-table_info">
                                                          <thead class="border-top">
                                                             <tr role="row">
                                                                <th class="bg-transparent border-bottom-0 sorting"
                                                                   tabindex="0"
                                                                   aria-controls="data-table"
                                                                   rowspan="1" colspan="1" aria-label="
                                                                   Ad Title: activate to sort column ascending"
                                                                   style="width: 137.531px;">
                                                                   Ad Title
                                                                </th>
                                                                <th class="bg-transparent border-bottom-0 sorting"
                                                                   tabindex="0"
                                                                   aria-controls="data-table"
                                                                   rowspan="1" colspan="1" aria-label="
                                                                   Customer: activate to sort column ascending"
                                                                   style="width: 103.695px;">
                                                                   Customer
                                                                </th>
                                                                <th class="bg-transparent border-bottom-0 sorting sorting_desc"
                                                                   tabindex="0"
                                                                   aria-controls="data-table"
                                                                   rowspan="1" colspan="1" aria-label="
                                                                   Timeframe: activate to sort column ascending"
                                                                   style="width: 74.6797px;"
                                                                   aria-sort="descending">
                                                                   Timeframe
                                                                </th>
                                                                <th class="bg-transparent border-bottom-0 sorting_disabled"
                                                                   rowspan="1" colspan="1" aria-label="
                                                                   Amount" style="width: 86.1172px;">
                                                                   Amount
                                                                </th>
                                                                <th class="bg-transparent border-bottom-0 sorting"
                                                                   style="width: 58.1172px;"
                                                                   tabindex="0"
                                                                   aria-controls="data-table"
                                                                   rowspan="1" colspan="1"
                                                                   aria-label="Status: activate to sort column ascending">
                                                                   Status
                                                                </th>
                                                                <th class="bg-transparent border-bottom-0 sorting"
                                                                   style="width: 51.6328px;"
                                                                   tabindex="0"
                                                                   aria-controls="data-table"
                                                                   rowspan="1" colspan="1"
                                                                   aria-label="Action: activate to sort column ascending">
                                                                   Action
                                                                </th>
                                                             </tr>
                                                          </thead>
                                                          <tbody>
                                                            @foreach ($ads as $ad)
                                                            <tr class="border-bottom odd">
                                                               <td>
                                                                  <div class="d-flex">
                                                                     <span class="avatar bradius"
                                                                        style="background-image: url({{$ad->media->first()->url}})"></span>
                                                                     <div
                                                                        class="ms-3 mt-0 mt-sm-2 d-block">
                                                                        <h6
                                                                           class="mb-0 fs-14 fw-semibold">
                                                                           {{ shorten_chars($ad->title, 30) }}
                                                                        </h6>
                                                                     </div>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <div class="d-flex">
                                                                     <div
                                                                        class="mt-0 mt-sm-3 d-block">
                                                                        <h6
                                                                           class="mb-0 fs-14 fw-semibold">
                                                                           {{ $ad->user->name }}
                                                                        </h6>
                                                                     </div>
                                                                  </div>
                                                               </td>
                                                               <td class="sorting_1">
                                                                  <span class="mt-sm-2 d-block">
                                                                     {{ $ad->started_at->format('d M, Y') }} - {{ $ad->expired_at->format('d M, Y') }}
                                                                  </span>
                                                               </td>
                                                               <td><span class="fw-semibold mt-sm-2 d-block"> {{ money($ad->price) }} </span>
                                                               </td>
                                                               <td class="">
                                                                  <div class="mt-sm-1 d-block">
                                                                     <span class="badge bg-{{$ad->status->color()}}-transparent rounded-pill text-{{$ad->status->color()}} p-2 px-3"> {{ $ad->status->label() }} </span>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <div class="g-2">
                                                                     <a class="btn text-dark btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="View"><span
                                                                        class="fa-regular fa-eye fs-14"></span></a>
                                                                     <a class="btn text-primary btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Edit"><span
                                                                        class="fa-regular fa-edit fs-14"></span></a>
                                                                     <a class="btn text-danger btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Delete"><span
                                                                        class="fa-regular fa-trash fs-14"></span></a>
                                                                  </div>
                                                               </td>
                                                            </tr>
                                                            @endforeach
                                                          </tbody>
                                                       </table>
                                                    </div>
                                                 </div>
                                                 {{ $ads->links('pagination.admin') }}
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection