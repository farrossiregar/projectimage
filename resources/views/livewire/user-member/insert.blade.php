@section('title', "Tambah Anggota")
@section('parentPageTitle', 'Anggota')
<div class="mt-2 card">
    <div class="card-body">
        <div class="row" {!!(!$show_form1?'style="display:none"':'')!!}>
            <div class="form-group col-md-8">
                <h5 class="text-info">DATA CALON ANGGOTA</h5>
            </div>
            <div class="col-md-4 text-right">
                <span wire:loading>
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                    <span class="sr-only">{{ __('Loading...') }}</span>
                </span>
            </div>
            <div class="col-md-12"><hr class="mt-0" style="border:1px solid #18a2b8" /></div>
        </div>
        <div {!!(!$is_success?'style="display:none"':'')!!}>
            <h6 class="text-success"><span><i class="fa fa-check"></i></span> Pendaftaran anda berhasil dilakukan</h6>
            {{-- <p>Terima kasih telah mendaftarkan diri anda sebagai Anggota Yayasan Sosial Santa Maria. Data diri anda akan segera kami proses setelah pembayaran kami terima. Silahkan cek email / Whatsapp anda untuk mendapatkan informasi pembayaran.</p> --}}
        </div>
        <form class="form-auth-small" method="POST" wire:submit.prevent="save" action="" {!!($is_success?'style="display:none"':'')!!}>
            @if($extend_register1 || $extend_register2)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <!-- if($umur <=74)
                    <i class="fa fa-warning"></i> Calon anggota berusia 65 s/d 74 wajib mendaftarkan 1 (satu) anggota baru di bawah usia 50 th<br />
                    endif
                    if($umur >=75 and $umur <=79)
                    <i class="fa fa-warning"></i> Calon anggota berusia 75 th keatas, wajib mendaftarkan 2 (dua) anggota baru di bawah usia 50 th 
                    endif
                    if($umur >=80)
                    <i class="fa fa-warning"></i> Calon anggota berusia 80 th keatas, wajib mendaftarkan 5 (lima) anggota baru di bawah usia 50 th 
                    endif -->
                    @if($umur >=60 and $umur <=64)
                    <i class="fa fa-warning"></i> Calon anggota berusia 60 s/d 64 wajib mendaftarkan 1 (satu) anggota baru di bawah usia 50 th<br />
                    @endif
                    @if($umur >=65 and $umur <=74)
                    <i class="fa fa-warning"></i> Calon anggota berusia 65 s/d 74 wajib mendaftarkan 3 (tiga) anggota baru di bawah usia 50 th 
                    @endif
                    @if($umur >=75)
                    <i class="fa fa-warning"></i> Calon anggota berusia 75 th keatas, wajib mendaftarkan 5 (lima) anggota baru di bawah usia 50 th 
                    @endif
                </div>            
            @endif
            <div class="row" {!!(!$show_form1?'style="display:none"':'')!!}>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputAlamat">No KTP</label>
                        <input type="text" class="form-control" wire:change="checkKTP" id="Id_Ktp" placeholder="Enter ID" wire:model="Id_Ktp">
                        @error('Id_Ktp') <span class="text-danger">{{ $message }}</span> <br />@enderror
                        <a href="javascript:void(0)" class="mt-1 ml-0" wire:click="checkKTP"><i class="fa fa-check"></i> Check Nomor KTP</a>
                        @if($messageKtp==1)
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <i class="fa fa-info"></i> Data KTP sudah digunakan
                        </div>
                        @endif
                        @if($messageKtp==2)
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <i class="fa fa-check"></i> Data KTP tersedia
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>No Anggota ex Gold</label>
                            <input type="text" class="form-control" wire:model="no_anggota_gold">
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="exampleInputName">No. Form</label>
                            <input type="text" class="form-control" id="form_no" placeholder="Enter Form No" wire:model="form_no">
                            @error('form_no') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName">Nama (sesuai KTP)</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputName">Nama yang dicantumkan di KTA</label>
                            <input type="text" class="form-control" id="name_kta" placeholder="Enter here" wire:model="name_kta">
                            @error('name_kta') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" wire:model="jenis_kelamin">
                                <option value=""> --- Jenis Kelamin --- </option>
                                @foreach(config('vars.jenis_kelamin') as $i)
                                <option>{{$i}}</option> 
                                @endforeach
                            </select>
                            @error('jenis_kelamin') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">No Telp. / HP</label>
                            <input type="text" class="form-control" id="phone_number" placeholder="Enter Phone Number" wire:model="phone_number">
                            @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName">E-mail</label>
                            <input type="E-mail" class="form-control" id="email" placeholder="Enter name" wire:model="email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Golongan Darah</label>
                            <select class="form-control" wire:model="blood_type">
                                <option value=""> --- Select --- </option>
                                @foreach(config('vars.golongan_darah') as $i)
                                <option>{{$i}}</option> 
                                @endforeach
                            </select>
                            @error('blood_type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" placeholder="Enter Place of Birth" wire:model="tempat_lahir">
                            @error('tempat_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputName">Tanggal Lahir 
                                <span wire:loading wire:target="hitungUmur">
                                    <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>
                                    <span class="sr-only">{{ __('Loading...') }}</span>
                                </span>
                                {!!$umur?"<span class=\"text-danger\" wire:loading.remove wire:target=\"hitungUmur\">( Umur {$umur} Thn)</span>" : ''!!}
                            </label>
                            <input type="date" class="form-control datepicker" id="tanggal_lahir" placeholder="Enter Date of Birth" wire:change="hitungUmur" wire:model="tanggal_lahir">
                            @error('tanggal_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Agama</label>
                            <select class="form-control" name="agama" wire:model="agama">
                                <option value=""> --- Agama --- </option>
                                <option>Islam</option> 
                                <option>Kristen</option> 
                                <option>Katolik</option> 
                                <option>Hindu</option> 
                                <option>Buddha</option> 
                                <option>Konghucu</option> 
                            </select>
                            @error('agama') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                            
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputAlamat">Alamat</label>
                        <input type="text" class="form-control" id="address" placeholder="Enter address" wire:model="address">
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputAlamat">Kota/Kabupaten</label>
                        <select class="form-control" wire:model="city">
                            <option value=""> --- Kota/Kabupaten --- </option>
                            @foreach(\App\Models\City::orderBy('code','ASC')->get() as $item)
                            <option value="{{$item->code}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if($city=='OTHER')
                            <div class="form-group">
                                <input type="text" class="form-control" id="city_lainnya" placeholder="Enter Other City" wire:model="city_lainnya">
                                @error('city_lainnya') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputAlamat">Iuran <strong class="text-danger">Rp. {{format_idr(get_setting('iuran_tetap'))}}</strong> (Rp {{format_idr($total_iuran_tetap)}})</label>
                            <select class="form-control" wire:model="iuran_tetap" wire:change="calculate_">
                                <option value=""> --- Minimal 1 Bulan --- </option>
                                @for($i=1;$i<=40;$i++)
                                    <option>{{$i}}</option>
                                @endfor
                            </select>
                            @error('iuran_tetap') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputAlamat">Uang Pendaftaran - Min <strong class="text-danger">Rp. {{format_idr(get_setting('uang_pendaftaran'))}}</strong></label>
                            <input type="number" class="form-control" wire:model="uang_pendaftaran" wire:input="calculate_">
                            @error('uang_pendaftaran') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputAlamat">Sumbangan Sukarela</label>
                            <input type="number" class="form-control" wire:model="sumbangan" wire:input="calculate_">
                            @error('sumbangan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group col-md-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="">Dana Form </label>
                                    <input type="text" class="form-control" wire:model="dana_form" value="Rp. 5.000" readonly>
                                    @error('uang_pendaftaran') <span class="text-danger">{{ $message }}</span> @enderror
                                </div> 
                                <div class="col-md-4">
                                    <label for="">Total </label>
                                    <h5 class="btn btn-outline-danger">Total Rp. {{format_idr($total)}}</h5>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>{{ __('Payment Date')}}</label>
                            <input type="date" class="form-control" wire:model="payment_date" />
                            @error('payment_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('Bank Account')}}</label>
                            <select class="form-control" wire:model="bank_account_id">
                                <option value=""> --- Bank Account --- </option>
                                <option value="1">TUNAI</option>
                                @foreach(\App\Models\BankAccount::all() as $bank)
                                <option value="{{$bank->id}}">{{$bank->bank}} {{$bank->no_rekening}} a/n {{$bank->owner}}</option>
                                @endforeach
                            </select>
                            @error('bank_account_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ __('Tanggal Aktif')}} <small>*default hari ini</small></label>
                            <input type="date" class="form-control" wire:model="tanggal_diterima" />
                            @error('tanggal_diterima')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">File Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="file_konfirmasi" wire:model="file_konfirmasi">
                            @error('file_konfirmasi') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Foto KTP</label>
                            <input type="file" class="form-control" id="foto_ktp" wire:model="foto_ktp">
                            @error('foto_ktp') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Foto KK</label>
                            <input type="file" class="form-control" id="foto_kk" wire:model="foto_kk">
                            @error('foto_kk') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Pasphoto 4x6</label>
                            <input type="file" class="form-control" id="pas_foto" wire:model="pas_foto">
                            @error('pas_foto') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>  
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">TTD Member</label>
                            <input type="file" class="form-control" id="ttd_member" wire:model="ttd_member">
                            @error('ttd_member') <span class="text-danger">{{ $message }}</span> @enderror
                        </div> 

                        <div class="form-group col-md-6">
                            <label>Koordinator Nama</label>
                            <input type="text" class="form-control" wire:model="koordinator_nama">
                            @error('koordinator_nama') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>  
                        <div class="form-group col-md-6">
                            <label>Koordinator NIK</label>
                            <input type="text" class="form-control" wire:model="koordinator_nik">
                            @error('koordinator_nik') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>  
                        <div class="form-group col-md-6">
                            <label>Koordinator HP</label>
                            <input type="text" class="form-control" wire:model="koordinator_hp">
                            @error('koordinator_nama') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>  
                        <div class="form-group col-md-6">
                            <label>Koordinator Alamat</label>
                            <input type="text" class="form-control" wire:model="koordinator_alamat">
                            @error('koordinator_alamat') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>  
                        
                    </div>
                </div>

                
                


                <div class="col-12"><br /></div>
                <div class="col-md-6">
                    <h6 class="text-info">DATA AHLI WARIS 1</h6>
                    <hr style="border-top:1px solid #18a2b8" />
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">No KTP</label>
                            <input type="text" class="form-control" id="Id_Ktpwaris1" placeholder="Enter ID" wire:model="Id_Ktpwaris1">
                            @error('Id_Ktpwaris1') <span class="text-danger">{{ $message }}</span> @enderror
                            <a href="javascript:void(0)" wire:click="checkKTPWaris1"><i class="fa fa-check"></i> Check Nomor KTP</a>
                            @if($messageKtpWaris1==1)
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <i class="fa fa-info"></i> Data KTP tersedia
                            </div>
                            @endif
                            @if($messageKtpWaris1==2)
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <i class="fa fa-check"></i> Data KTP tidak tersedia
                            </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputName">Nama (sesuai KTP)</label>
                            <input type="text" class="form-control" id="name_waris1" placeholder="Enter name" wire:model="name_waris1">
                            @error('name_waris1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahirwaris1" placeholder="Enter Place of Birth" wire:model="tempat_lahirwaris1">
                            @error('tempat_lahirwaris1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Alamat</label>
                            <input type="text" class="form-control" id="address_waris1" placeholder="Enter address" wire:model="address_waris1">
                            @error('address_waris1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName">Tanggal Lahir</label>
                            <input type="date" class="form-control datepicker" id="tanggal_lahirwaris1" placeholder="Enter Date of Birth" wire:model="tanggal_lahirwaris1">
                            @error('tanggal_lahirwaris1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">No Telp. / HP</label>
                            <input type="number" class="form-control" id="phone_numberwaris1" placeholder="Enter Phone Number" wire:model="phone_numberwaris1">
                            @error('phone_numberwaris1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelaminwaris1" wire:model="jenis_kelaminwaris1">
                                <option value=""> --- Jenis Kelamin --- </option>
                                @foreach(config('vars.jenis_kelamin') as $i)
                                <option>{{$i}}</option> 
                                @endforeach
                            </select>
                            @error('jenis_kelaminwaris1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Golongan Darah</label>
                            <select class="form-control" wire:model="blood_typewaris1">
                                <option value=""> --- Select --- </option>
                                @foreach(config('vars.golongan_darah') as $i)
                                <option>{{$i}}</option> 
                                @endforeach
                            </select>
                            @error('blood_typewaris1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Hubungan dengan Anggota</label>
                                <select class="form-control" wire:model="hubungananggota1">
                                    <option value=""> --- Select --- </option>
                                    @foreach(config('vars.hubungan_keluarga') as $i)
                                    <option>{{$i}}</option> 
                                    @endforeach
                                </select>
                                @error('hubungananggota1') <span class="text-danger">{{ $message }}</span> @enderror
                                @if($hubungananggota1=='Lainnya')
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="hubungananggota1_lainnya" placeholder="Hubungan Anggota" wire:model="hubungananggota1_lainnya">
                                        @error('hubungananggota1_lainnya') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                @endif
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Foto KTP</label>
                            <input type="file" class="form-control" id="foto_ktpwaris1" wire:model="foto_ktpwaris1">
                            @error('foto_ktpwaris1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">TTD Ahli Waris 1</label>
                            <input type="file" class="form-control" id="ttd_ahliwaris1" wire:model="ttd_ahliwaris1">
                            @error('ttd_ahliwaris1') <span class="text-danger">{{ $message }}</span> @enderror
                        </div> 
                    </div>
                </div>

                <div class="col-md-6">
                    <h6 class="text-info">DATA AHLI WARIS 2</h6>
                    <hr style="border-top:1px solid #18a2b8" />
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">No KTP</label>
                            <input type="text" class="form-control" id="Id_Ktpwaris2" placeholder="Enter ID" wire:model="Id_Ktpwaris2">
                            @error('Id_Ktpwaris2') <span class="text-danger">{{ $message }}</span> @enderror
                            <a href="javascript:void(0)" wire:click="checkKTPWaris2"><i class="fa fa-check"></i> Check Nomor KTP</a>
                            @if($messageKtpWaris2==1)
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <i class="fa fa-info"></i> Data KTP tersedia
                            </div>
                            @endif
                            @if($messageKtpWaris2==2)
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <i class="fa fa-check"></i> Data KTP tidak tersedia
                            </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputName">Nama (sesuai KTP)</label>
                            <input type="text" class="form-control" id="name_waris2" placeholder="Enter name" wire:model="name_waris2">
                            @error('name_waris2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahirwaris2" placeholder="Enter Place of Birth" wire:model="tempat_lahirwaris2">
                            @error('tempat_lahirwaris2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Alamat</label>
                            <input type="text" class="form-control" id="address_waris2" placeholder="Enter address" wire:model="address_waris2">
                            @error('address_waris2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName">Tanggal Lahir</label>
                            <input type="date" class="form-control datepicker" id="tanggal_lahirwaris2" placeholder="Enter Date of Birth" wire:model="tanggal_lahirwaris2">
                            @error('tanggal_lahirwaris2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>No Telp. / HP</label>
                            <input type="text" class="form-control" id="phone_numberwaris2" placeholder="Enter Phone Number" wire:model="phone_numberwaris2">
                            @error('phone_numberwaris2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelaminwaris2" wire:model="jenis_kelaminwaris2">
                                <option value=""> --- Jenis Kelamin --- </option>
                                @foreach(config('vars.jenis_kelamin') as $i)
                                <option>{{$i}}</option> 
                                @endforeach
                            </select>
                            @error('jenis_kelaminwaris2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Golongan Darah</label>
                            <select class="form-control" wire:model="blood_typewaris2">
                                <option value=""> --- Select --- </option>
                                @foreach(config('vars.golongan_darah') as $i)
                                <option>{{$i}}</option> 
                                @endforeach
                            </select>
                            @error('blood_typewaris2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Hubungan dengan Anggota</label>
                            <select class="form-control" wire:model="hubungananggota2">
                                <option value=""> --- Select --- </option>
                                @foreach(config('vars.hubungan_keluarga') as $i)
                                <option>{{$i}}</option> 
                                @endforeach
                            </select>
                            @error('hubungananggota2') <span class="text-danger">{{ $message }}</span> @enderror
                            @if($hubungananggota2=='Lainnya')
                                <div class="form-group">
                                    <input type="text" class="form-control" id="hubungananggota2_lainnya" placeholder="Hubungan Anggota" wire:model="hubungananggota2_lainnya">
                                    @error('hubungananggota2_lainnya') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">Foto KTP</label>
                            <input type="file" class="form-control" id="foto_ktpwaris2" wire:model="foto_ktpwaris2">
                                @error('foto_ktpwaris2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputAlamat">TTD Ahli Waris 2</label>
                            <input type="file" class="form-control" id="ttd_ahliwaris2" wire:model="ttd_ahliwaris2">
                            @error('ttd_ahliwaris2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div> 
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <hr />
                    <a href="/"><i class="fa fa-arrow-left"></i> {{__('Back')}}</a>
                    @if($extend_register1 || $extend_register2)
                        <button type="button" class="ml-3 btn btn-primary" wire:click="form2">{{ __('Berikutnya Data Rekomendasi') }} <i class="fa fa-arrow-right"></i></button>
                    @else
                        <button type="submit" class="ml-3 btn btn-primary" wire:click="form3">{{ __('Submit Pendaftaran') }} <i class="fa fa-check"></i></button>
                    @endif          
                    <span wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </span>     
                </div>
            </div>
            <div {!!(!$show_form2?'style="display:none"':'')!!} class="form2">
                @if($extend_register1 || $extend_register2)
                    
                    @if($extend_register1)
                        @livewire('user-member.insert-rekomendasi',['num'=>1],key(1))
                    @endif
                    @if($extend_register2)
                        @livewire('user-member.insert-rekomendasi',['num'=>2],key(2))
                    @endif
                    @if($extend_register3)
                        @livewire('user-member.insert-rekomendasi',['num'=>3],key(3))
                    @endif
                    @if($extend_register4)
                        @livewire('user-member.insert-rekomendasi',['num'=>4],key(4))
                    @endif
                    @if($extend_register5)
                        @livewire('user-member.insert-rekomendasi',['num'=>5],key(5))
                    @endif
                @endif
                <hr />
                <div class="col-md-12 form-group">
                    <a href="javascript:void(0)" wire:click="form1"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <button type="button" wire:loading.remove class="ml-3 btn btn-primary" wire:click="form3">{{ __('Submit Pendaftaran') }} <i class="fa fa-check"></i></button>
                    <span wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </span>
                </div>
            </div>  
        </form>
    </div>
</div>