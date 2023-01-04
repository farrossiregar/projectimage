@section('title', 'Stock Photo')
@section('parentPageTitle', 'Home')
<div class="clearfix row">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <!-- <div class="col-md-2">
                    <select class="form-control" wire:model="koordinator_id">
                        <option value=""> --- Koordinator --- </option>
                        @foreach(\App\Models\UserMember::groupBy('koordinator_nama')->get() as $koordinator)
                            @if($koordinator->koordinator_nama=="") @continue @endif
                            <option>{{$koordinator->koordinator_nama}}</option>
                        @endforeach
                    </select>
                </div> -->
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Pencarian" />
                </div>
                <div class="col-md-2 px-0">
                    <select class="form-control" wire:model="status">
                        <option value=""> --- Status --- </option>
                        <option value="1">Inactive</option>
                        <option value="2">Active</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <!-- <a href="javascript:;" class="ml-2 btn btn-info" wire:click="downloadExcel"><i class="fa fa-download"></i> Download</a> -->
                    <a href="{{route('stock-photo.insert')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Image</a>
                    <span wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </span>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive" style="min-height:400px;">
                    <table class="table table-hover m-b-0 c_list">
                        <thead>
                            <tr style="background: #eee;">
                                <th>No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Source</th>
                                <th>Uploaded Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($number= $data->total() - (($data->currentPage() -1) * $data->perPage()) )
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td style="width: 50px;">
                                    <img src="{{ asset('assets/img/bg-auth.jpg') }}" alt="Image" style="width: 95px;"/>
                                    <?php //echo asset("storage/app/public/klaim/foto_kta20220917115852.jpg"); ?>
                                    <!-- <img src="{{ public_path('storage/app/public/foto_kta20220917115852.jpg') }}" alt="Image" style="width: 120px;"/> -->
                                    <!-- <img src="{{ base_path('public/foto_kta20220917115852.jpg') }}" alt="Image Stock" style="width: 120px;"/> -->
                                    <!-- <br>asset('storage/Vendor_Management/Org_chart/'.$item->org_chart.'') -->
                                    <!-- <img src="{{ asset('storage/klaim/foto_kta20220917115852.jpg') }}" class="user-photo media-object" alt="Logo" style="width:100%;"> -->
                                    <?php //echo public_path("storage/app/public/foto_kta20220917115852.jpg"); ?>
                                    <br>
                                    
                                    <!-- {{$item->foto_name}} -->
                                </td>
                                <td style="width: 50px;">{{$item->name}}</td>
                                <td style="width: 50px;">{{$item->category}}</td>
                                <td style="width: 50px;">{{$item->subcategory}}</td>
                                <td style="width: 50px;">{{$item->foto_source}}</td>
                                <td style="width: 50px;">{{$item->created_at}}</td>
                                
                                <td> 
                                    <a href="javascript:void(0)" class="badge badge-warning">Inactive</a>
                                </td>
                                
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-navicon"></i></a>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            @if($item->user_id && $item->status < 4)
                                            <a href="#" class="dropdown-item text-success" onclick="autologin('{{ route('users.autologin',['id'=>$item->user_id]) }}','{{$item->name}}')" title="Autologin"><i class="fa fa-sign-in"></i> Autologin</a>
                                            @endif
                                            <a class="dropdown-item" href="{{route('user-member.edit',['id'=>$item->id])}}"><i class="fa fa-search-plus"></i> Detail</a>
                                            <a class="dropdown-item" href="{{route('user-member.print-member',['id'=>$item->id])}}" target="_blank"><i class="fa fa-print"></i> Print</a>
                                            @if($item->status_pembayaran < 1)
                                                <a class="dropdown-item text-danger" href="{{route('user-member.proses',['id'=>$item->id])}}"><i class="fa fa-check"></i> Konfirmasi</a>
                                            @endif
                                            @if($item->status_pembayaran == 1)
                                                @if($item->admin_approval === NULL || $item->admin_approval < 0)
                                                <a class="dropdown-item text-danger" href="{{route('user-member.approval',['id'=>$item->id])}}"><i class="fa fa-check"></i> Konfirmasi</a>
                                                @endif
                                            @endif
                                            <a class="dropdown-item" href="javascript:void(0)" wire:click="set_member({{$item->id}})" data-toggle="modal" data-target="#modal_set_password"><i class="fa fa-key"></i> Set Password</a>
                                        </div>
                                    </div>    
                                </td>
                            </tr>
                            @php($number--)
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br />
                {{$data->links()}}
            </div>
        </div>
    </div>

    <!-- <div wire:ignore.self class="modal fade" id="modal_set_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="changePassword">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sign-in"></i> Set Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control" wire:model="password" />
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger close-modal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
</div>


<div class="modal fade" id="modal_autologin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sign-in"></i> Autologin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger close-modal">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:user-member.upload />
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="modal_konfirmasi_meninggal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="min-width: 90%;" role="document">
        <div class="modal-content">
            <livewire:user-member.konfirmasi-meninggal />
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="modal_detail_meninggal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="min-width: 90%;" role="document">
        <div class="modal-content">
            <livewire:user-member.detail-meninggal />
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="modal_ajukan_klaim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 90%;" role="document">
        <div class="modal-content">
            <livewire:user-member.ajukan-klaim />
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-warning"></i> Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <p>Are you want delete this data ?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">No</button>
                <button type="button" wire:click="delete()" class="btn btn-danger close-modal">Yes</button>
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
<script>
    Livewire.on('modal-konfirmasi-meninggal',(data)=>{
        $("#modal_konfirmasi_meninggal").modal("show");
    });
    Livewire.on('modal-detail-meninggal',(data)=>{
        $("#modal_detail_meninggal").modal("show");
    });
</script>
@endpush
@section('page-script')
function autologin(action,name){
    $("#modal_autologin form").attr("action",action);
    $("#modal_autologin .modal-body").html('<p>Autologin as '+name+' ?</p>');
    $("#modal_autologin").modal("show");
}
@endsection