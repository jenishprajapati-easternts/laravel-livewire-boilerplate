<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;

class CreateUsers extends Component
{

    public User $user;
    public $countries, $states, $cities;


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
            'user.hobby' => 'required|exists:hobbies,id,deleted_at,NULL|array',
            'user.hobby.*' => 'required|integer',

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
        return view('livewire.create-users');
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

        //$this->user->status = config('constants.user_status_id.verified');
        $this->user->save();
        /* $this->user->assignRole($this->role_id);
        redirect()->to('/users');
        session()->flash('message', 'User Created Successfully.');

        if ($this->role_id == config('constants.users_roles_ids.client')) {
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
