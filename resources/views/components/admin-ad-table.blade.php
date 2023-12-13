<div class="card-body pt-4">
    <div class="grid-margin">
       <div class="">
          <div class="panel panel-primary">
             <div class="panel-body tabs-menu-body border-0 pt-0">
               <form class="input-group mb-5">
                  <input name="search" type="text" class="form-control" placeholder="Search" value="{{ request()->search }}" />
                  <div class="input-group-text btn btn-primary">
                     <button type="submit" class="bg-transparent border-0 text-white">
                      <i class="fa-regular fa-search" aria-hidden="true"></i>
                     </button>
                  </div>
               </form>
               @if(count($ads) > 0)
               @if($reported)
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
                                              Reason: activate to sort column ascending"
                                              style="width: 103.695px;">
                                              Reason
                                           </th>
                                           <th class="bg-transparent border-bottom-0 sorting sorting_desc"
                                              tabindex="0"
                                              aria-controls="data-table"
                                              rowspan="1" colspan="1" aria-label="
                                              Email: activate to sort column ascending"
                                              style="width: 74.6797px;"
                                              aria-sort="descending">
                                              Email
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
                                       @foreach ($ads as $reportAd)
                                       <tr class="border-bottom odd">
                                          <td>
                                             <div class="d-flex">
                                                <span class="avatar bradius"
                                                   style="background-image: url({{$reportAd->ad->media->first()->url}})"></span>
                                                <div
                                                   class="ms-3 mt-0 mt-sm-2 d-block">
                                                   <a href="{{ route('admin.ads.reported.show', $reportAd->ad->slug) }}"
                                                      class="mb-0 fs-14 fw-semibold text-info">
                                                      {{ shorten_chars($reportAd->ad->title, 30) }}
                                                   </a>
                                                </div>
                                             </div>
                                          </td>
                                          <td>
                                             <div class="d-flex">
                                                <div
                                                   class="mt-0 mt-sm-3 d-block">
                                                   <h6
                                                      class="mb-0 fs-14 fw-semibold">
                                                      {{ $reportAd->reason }}
                                                   </h6>
                                                </div>
                                             </div>
                                          </td>
                                          <td class="sorting_1">
                                             <span class="mt-sm-2 d-block">
                                               {{ mask_chars($reportAd->email, 2, 4, '@') }}
                                             </span>
                                          </td>
                                          <td class="">
                                             <div class="mt-sm-1 d-block">
                                                <span class="badge bg-{{$reportAd->ad->status->color()}}-transparent rounded-pill text-{{$reportAd->ad->status->color()}} p-2 px-3"> {{ $reportAd->ad->status->label() }} </span>
                                             </div>
                                          </td>
                                          <td>
                                             <div class="g-2 text-center">
                                                <a href="{{ route('admin.ads.reported.show', $reportAd->ad->slug) }}" class="btn text-dark btn-sm"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-original-title="View"><span
                                                   class="fa-regular fa-eye fs-14"></span></a>
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
               @else
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
                                                  <a href="{{ route('admin.ads.show', $ad->slug) }}"
                                                     class="mb-0 fs-14 fw-semibold text-info">
                                                     {{ shorten_chars($ad->title, 30) }}
                                                  </a>
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
                                            <div class="d-flex">
                                               <a href="{{ route('admin.ads.show', $ad->slug) }}" class="btn text-dark btn-sm"
                                                  data-bs-toggle="tooltip"
                                                  data-bs-original-title="View"><span
                                                  class="fa-regular fa-eye fs-14"></span>
                                                </a>
                                                <a href="{{ route('admin.ads.edit', $ad->slug) }}" class="btn text-primary btn-sm"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-original-title="Edit"><span
                                                   class="fa-regular fa-edit fs-14"></span>
                                                </a>
                                                <form action="{{ route('admin.ads.destroy', $ad->slug) }}" method="POST">
                                                   @csrf
                                                   @method('DELETE')
                                                   <button class="btn text-danger btn-sm"><span class="fa-regular fa-trash fs-14"></span></button>
                                                </form>
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
               @endif
               @else
               <div class="text-center p-4">
                  <img src="{{ asset('assets/images/icons/man.svg') }}" class="w-25" alt="empty">
                  <h4 class="mt-3">No Ads Found</h4>
                </div>
               @endif
             </div>
          </div>
       </div>
    </div>
 </div>