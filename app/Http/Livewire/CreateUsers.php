<?php

namespace App\Http\Livewire;

use App\Http\Controllers\UsersController;
use App\Models\City;
use App\Models\Country;
use App\Models\Hobby;
use App\Models\State;
use App\Models\User;
use App\Models\UserComment;
use App\Models\UserGallery;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class CreateUsers extends Component
{

    use WithFileUploads, UploadTrait;

    public User $user;
    public $countries, $states, $cities, $comment;
    public $hobbies = [], $galleries = [], $tags = [], $multiple_options;
    public $inputs  = [];
    public $i = 1;
    public $updateMode = false;


    /**
     * add
     *
     * @param  mixed $i
     * @return void
     */
    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    /**
     * remove
     *
     * @param  mixed $i
     * @return void
     */
    public function remove($i)
    {
        unset($this->inputs[$i]);
    }


    private function resetInputFields()
    {
        $this->comment = '';
    }


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
            'comment.0' => 'required',
            'comment.*' => 'required',
            //'multiple_options' => 'required',
            //'tags' => 'required',

        ];
    }

    /**
     * messages
     *
     * @return void
     */
    protected function messages()
    {
        return [
            'comment.0.required' => 'The comment field is required.',
            'comment.*.required' => 'The comment field is required.',
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
        //sleep(10);
        $this->countries = Country::all();
    }


    /**
     * createUser
     *
     * @return void
     */
    public function store()
    {

        $this->validate();

        $userData = [
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'email' => $this->user->email,
            'mobile_no' => $this->user->mobile_no,
            'gender' => $this->user->gender,
            'dob' => $this->user->dob,
            'country_id' => $this->user->country_id,
            'state_id' => $this->user->state_id,
            'city_id' => $this->user->city_id,
            'address' => $this->user->address,
        ];
        /* common code for user data insert into database */
        UsersController::commonUserInsert($userData, $this->galleries, $this->hobbies, $this->comment);

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

    /**
     * cancel
     *
     * @return void
     */
    public function cancel()
    {
        redirect()->to('/admin/users');
    }
}
