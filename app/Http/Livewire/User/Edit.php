<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\UserAccess;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Edit extends Component
{
    public $data;
    public $nik,$name;
    public $email;
    public $password;
    public $telepon;
    public $address;
    public $user_access_id;
    public $message;
    public $referal_code;
    public $url;

    protected $rules = [
        'nik' => 'required',
        'name' => 'required|string',
        'email' => 'required|email',
        //'password' => 'required|string',
        'telepon' => 'required',
        'user_access_id' => 'required',
    ];

    public function render()
    {
        return view('livewire.user.edit')
                        ->with([
                            'access' => UserAccess::whereIn('id',[1,2,5])->get(),
                            'data' => $this->data
                        ]);
    }

    public function mount($id)
    {
        $this->data = User::find($id);
        $this->nik = $this->data->nik;
        $this->name = $this->data->name;
        $this->email = $this->data->email;
        $this->telepon = $this->data->telepon;
        $this->address = $this->data->address;
        $this->user_access_id = $this->data->user_access_id;
        $this->referal_code = $this->data->referal_code;
        $this->url = $this->data->url;
    }

    public function save(){
        $this->validate();
        
        $this->data->nik = $this->nik;
        $this->data->name = $this->name;
        $this->data->email = $this->email;
        if($this->password!="") $this->data->password = Hash::make($this->password);
        $this->data->telepon = $this->telepon;
        $this->data->address = $this->address;
        $this->data->user_access_id = $this->user_access_id;
        $this->data->referal_code = $this->referal_code;
        $this->data->url = $this->url;
        $this->data->save();

        session()->flash('message-success',__('Data saved successfully'));
        
        return redirect()->to('users');
    }
}
