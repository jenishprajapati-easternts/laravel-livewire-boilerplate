<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Hobby;
use App\Models\State;
use App\Models\User;
use App\Models\UserGallery;
use App\Traits\UploadTrait;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class CreateUsers extends Component
{

    use WithFileUploads, UploadTrait;

    public User $user;
    public $countries, $states, $cities;
    public $hobbies = [], $galleries = [];


    /**
     * rules
     *
     * @return void
     */
    protected function rules()
    {
        return [
            'user.first_name' => ['required', 'string', 'max:255'],
            'user.last_name' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'email', 'unique:users,email'],
            'user.mobile_no' => 'required | regex:/^[6-9]\d{9}$/ | digits:10',
            'user.address' => ['required', 'string', 'max:500'],
            'user.gender' =>  ['required', Rule::in([0, 1])],
            'user.dob' => 'required|date|date_format:Y-m-d',
            'user.country_id' => 'required|integer|exists:countries,id,deleted_at,NULL',
            'user.state_id' => 'required|integer|exists:states,id,deleted_at,NULL',
            'user.city_id' => 'required|integer|exists:cities,id,deleted_at,NULL',
            'hobbies' => 'required|exists:hobbies,id,deleted_at,NULL|array',
            'hobbies.*' => 'required|integer',
            'galleries' => 'required|array|max:5',
            'galleries.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',

        ];
    }

    // Fetch states of a country    
    /**
     * getCountryStates
     *
     * @return void
     */
    public function getCountryStates()
    {

        $this->states = State::orderby('name', 'asc')
            ->select('*')
            ->where('country_id', $this->user->country_id)
            ->get();

        // Reset values 
        unset($this->cities);
        $this->user->state_id = "";
        $this->user->city_id = "";
    }

    // Fetch cities of a state    
    /**
     * getStateCities
     *
     * @return void
     */
    public function getStateCities()
    {
        $this->cities = City::orderby('name', 'asc')
            ->select('*')
            ->where('state_id', $this->user->state_id)
            ->get();

        // Reset value 
        $this->user->city_id = "";
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.create-users', ['getHobbies' =>  Hobby::all()]);
    }

    /**
     * mount
     *
     * @return void
     */
    public function mount()
    {

        $this->user = new User;
        $this->countries = Country::all();
    }


    /**
     * createUser
     *
     * @return void
     */
    public function createUser()
    {

        $this->validate();


        $this->user->user_type = '1'; // User type id author or sub admin
        $this->user->save();

        /* Insert multiple user galleries */
        if (!empty($this->galleries)) {

            $realPath = 'user/' . $this->user->id . '/';

            foreach ($this->galleries as $image) {
                $path = $this->uploadOne($image, '/public/' . $realPath);
                UserGallery::create(['user_id' => $this->user->id, 'filename' => $realPath . pathinfo($path, PATHINFO_BASENAME)]);
            }
        }

        /* Insert multiple hobbies */
        if (!empty($this->hobbies)) {
            $this->user->hobbies()->attach($this->hobbies); //this executes the insert-query
        }


        redirect()->to('/admin/users');
        session()->flash('message', 'User Created Successfully.');

        /* if ($this->role_id == config('constants.users_roles_ids.client')) {
            Mail::to($this->user->email)->queue(new WelcomeUser($this->user));
        } */
    }

    /**
     * updated
     *
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules());
    }
}
