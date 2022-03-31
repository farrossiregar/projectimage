<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\UserAccess;
use Illuminate\Support\Facades\Hash;

class Insert extends Component
{
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
        'email' => 'required|email|unique:users',
        'password' => 'required|string',
        'telepon' => 'required',
        'user_access_id' => 'required',
    ];

    public function render()
    {
        return view('livewire.user.insert')->with(
            ['access'=>UserAccess::whereIn('id',[1,2,5])->get()]
        );
    }

    public function save(){
        $this->validate();
        
        $data = new User();
        $data->nik = $this->nik;
        $data->name = $this->name;
        $data->email = $this->email;
        $data->password = Hash::make($this->password);
        $data->telepon = $this->telepon;
        $data->address = $this->address;
        $data->user_access_id = $this->user_access_id;
        $data->referal_code= $this->referal_code;
        $data->url = $this->url;
        $data->save();

        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->to('users');
    }
    
}
