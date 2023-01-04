<?php
namespace App\Http\Livewire\StockPhoto;

use App\Models\UserAccess;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\StockPhoto;
use App\Models\Category;
use App\Models\Subcategory;
use Image;
use Illuminate\Validation\Rule; 

class Insert extends Component 
{
	use WithFileUploads;
	public $stock_photo, $foto_source, $foto_caption, $category, $subcategory;

    public $is_approve,$is_success=false;
 

	protected $listeners = ['save-all'=>'save_all'];

	public function render()
    {
        return view('livewire.stock-photo.insert');
    }
    
	public function mount()
	{
		
	}
	
	
	public function save()
    {
		$rules = [
			// 'Id_Ktp'=>['required',
			// 				Rule::unique('user_member')->where(function($query) {
			// 					$query->where('Id_Ktp', $this->Id_Ktp)->where('status', 2);
			// 				})
			// 			],
			'foto_caption' => 'required|string',
			'foto_source' => 'required|string',
			'category' => 'required',
			'subcategory'=>'required',
			'stock_photo'=>'required|image:max:1024',
		
		];

		// $image = $request->file('image');
		// $image = $this->stock_photo;
        // $input['imagename'] = time().'.'.$image->extension();
		
		// $destinationPath = public_path('/thumbnail');
        // $img = Image::make($image->path());
        // $img->resize(100, 100, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($destinationPath.'/'.$input['imagename']);
   
        // $destinationPath = public_path('/images');
        // $image->move($destinationPath, $input['imagename']);

		// dd('Insert Photo');

		$data 				= new StockPhoto();
        $data->name			= $this->foto_caption;
        $data->foto_name	= $this->stock_photo;
        $data->foto_source	= $this->foto_source;
        $data->category		= $this->category;
        $data->subcategory	= $this->subcategory;
        $data->save();



		
		// if($this->validate_form_5){ 
		// 	$counting =  get_setting('counting_no_anggota_new')+1;
		// 	update_setting('counting_no_anggota_new',$counting);
		// 	$this->emit('save_rekomendasi',['num'=>5,'id'=>$data->id,'no_anggota'=>$counting]);
		// }
		// $this->is_success =true;
		
		// $messageWa  = "Kepada Yth Ibu/Bpak ".$data->name.",\n\nTerima kasih telah mendaftar sebagai Anggota di Yayasan Kematian Santa Maria, \nNomor Anggota : *".$data->no_anggota_platinum."*\n. Silahkan login dengan menggunakan username :". $data->no_anggota_platinum ."\n dan password {$password} \n";
        // $messageWa .= 'Masa Tunggu Klaim : '. date('d F Y',strtotime($data->masa_tenggang));
        // sendNotifWa($messageWa, $this->phone_number);
        
		session()->flash('message-success',__('Photo berhasil disimpan'));
    }
}