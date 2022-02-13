<?php

namespace App\Http\Livewire\Dashboard\Stores;

use Livewire\Component;
use App\Models\City;
use App\Models\Company;
use App\Models\Image;
use App\Models\Location;
use App\Models\Phone;
use App\Models\SocialNetwork;
use App\Models\User;
use App\Models\WorkShedule;
use Livewire\WithFileUploads;
use App\Rules\CheckedElement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\StoreRegisterMailable;
use Illuminate\Support\Facades\Mail;


class Create extends Component
{
    use WithFileUploads;

    public $name, $description, $email;

    public $city, $cities, $cityId, $locality, $localities = [], $localityId, $street, $numInt, $postalcode, $reference;
    public $addresses, $comboIdentificador;
    public $typePhoneNumber, $phoneNumber, $phones;
    public $socialNetwork, $url, $socialNetworks;
    public $days, $workDays, $startTime, $finishTime, $workSchedules, $schedules;
    public $logo, $identificador;
    public $banners, $temporaryBanners, $identificadorBanners;

    protected $listeners = [
        'addBanner',
    ];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',

        'description' => 'required',

        'logo' => 'required|image|max:2048',
        'temporaryBanners' => 'required|array',
    ];

    protected $rulesAddresses = [
        'cityId' => 'required|numeric|min:1',
        'localityId' => 'required',
        'street' => 'required',
        'numInt' => 'required|numeric|integer|min:1',
        'postalcode' => 'required|numeric|digits:5',
        'reference' => 'max:50',
    ];

    protected $rulesPhones = [
        'phoneNumber' => 'required|numeric|digits:10',
        'typePhoneNumber' => 'required|numeric|in:1,2',
    ];

    protected $rulesSocialNetworks = [
        'socialNetwork' => 'required|numeric|min:1',
        'url' => 'required|url',
    ];

    protected $rulesBanners = [
        'banners' => 'required|array',
        'banners.*' => 'required|image|max:2048',
    ];

    protected $messagesValidation = [
        'name.required' => 'El campo nombre es requerido',
        'email.required' => 'El campo email es requerido',
        'email.email' => 'El campo debe ser tipo email',
        'email.unique' => 'Ya existe un registro con este correo. Intente con otro',
        'description.required' => 'El campo descripción es requerido',
        'logo.required' => 'La imagen de la empresa es requerida',

        'cityId.required' => 'El campo ciudad es requerido',
        'cityId.numeric' => 'El campo ciudad es requerido',
        'cityId.min' => 'Selecciona entre las opciones brindadas',
        'localityId.required' => 'El campo localidad es requerido',
        'localityId.numeric' => 'El campo localidad es requerido',
        'localityId.min' => 'Selecciona entre las opciones brindadas',
        'street.required' => 'El campo calle es requerido',
        'numInt.required' => 'El campo número es requerido',
        'postalcode.required' => 'El campo código postal es requerido',
        'reference.required' => 'El campo debe contener máximo 50 caracteres',

        'phoneNumber.required' => 'El campo número de teléfono es requerido',
        'phoneNumber.numeric' => 'Ingresa un valor númerico de 10 dígitos',
        'phoneNumber.digits' => 'El número de teléfono debe contener 10 dígitos',

        'socialNetwork.required' => 'El campo es requerido',
        'socialNetwork.numeric' => 'El campo es requerido',
        'socialNetwork.min' => 'El campo es requerido',

        'workDays.required' => 'Selecciona al menos un día',
        'workDays.array' => 'Selecciona al menos un día',
        'startTime.required' => 'Campo requerido. Selecciona una hora',
        'startTime.date_format' => 'Selecciona una hora de las opciones brindadas',
        'finishTime.required' => 'Campo requerido. Selecciona una hora',
        'finishTime.date_format' => 'Selecciona una hora de las opciones brindadas',
        'finishTime.after' => 'La hora de cierre debe ser mayor a la hora de inicio. Seleccione otro horario',
        
        'url.required' => 'El campo es requerido',
        'url.url' => 'Ingresa una url correcta',

        'banners.required' => 'Es requerido al menos un banner',
        'banners.array' => 'Debe ser un listado de imagenes. Selecciona las imagenes desde el selector',
        'banners.*.required' => 'Es requerido al menos un banner 2',
        'banners.*.image' => 'Los archivos a subir deben ser de tipo imagen',
        'banners.*.max' => 'El tamaño de las imagenes debe ser menor a 2MB',

        'temporaryBanners.required' => 'Es requerido al menos un banner',
        'temporaryBanners.array' => 'Debe ser un listado de imagenes. Selecciona las imagenes desde el selector',
    ];

    public $form = [
        'title' => null,
        'action' => null,
        'actionButton' => null,
    ];

    public function mount() {
        $this->identificador = rand();
        $this->identificadorBanners = rand();

        $this->addresses = [];
        $this->phones = [];
        $this->socialNetworks = [];
        $this->socialNetwork = 1;
        $this->workDays = [];
        $this->workSchedules =[];
        $this->schedules = [];
        $this->banners = [];
        $this->temporaryBanners = [];
        $this->days = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            7 => 'Domingo',
        ];

        $this->form['title'] = 'Agregar negocio';
        $this->form['action'] = 'save';
        $this->form['actionButton'] = 'Guardar';

        $this->cities = City::where('parent_id',null)->get();
        $this->localities = [];
        $this->cityId = 0;
    }

    public function render()
    {
        $this->locationsByCity();
        return view('livewire.dashboard.stores.create');
    }

    public function save() {

        $this->validate($this->rules, $this->messagesValidation);
        

        $urlLogo = $this->logo->store('users');

        $password = $this->random_password();
        $user = User::create([
            'email' => $this->email,
            'type' => 2,
            'password' => bcrypt($password),
            'remember_token' => Str::random(10),
            'name' => $this->name,
        ]);

        $store = Company::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'user_id' => $user->id,
        ]);

        $user->image()->create([
            'url' => $urlLogo,
        ]);

        foreach ($this->temporaryBanners as $key => $banner) {

            Image::create([
                'url' => $banner->store('companies'),
                'imageable_id' => $store->id,
                'imageable_type' => Company::class,
            ]);
        }

        foreach ($this->addresses as $address) {
            Location::create([
                'street' => $address['street'],
                'number' => intval($address['numInt']),
                'postal_code' => intval($address['postalcode']),
                'reference' => $address['reference'],
                'city_id' => $address['locality']['id'],
                'company_id' => $store->id,
            ]);
        }

        foreach ($this->phones as $phone) {
            Phone::create([
                'type' => $phone['typePhoneNumber'],
                'phone_number' => $phone['phoneNumber'],
                'company_id' => $store->id,
            ]);
        }

        foreach ($this->socialNetworks as $socialNetwork) {
            SocialNetwork::create([
                'url' => $socialNetwork['url'],
                'type' => $socialNetwork['socialNetwork'],
                'company_id' => $store->id,
            ]);
        }

        foreach ($this->workSchedules as $workSchedule) {

            foreach ($workSchedule['schedules'] as $schedule) {
                $schedules = [
                    'startTime' => $schedule['startTime'],
                    'finishTime' => $schedule['finishTime'],
                ];
                $scheduleId = $this->saveWorkSchedule($schedules, $workSchedule['dayNumber']);
                $store->workSchedules()->attach($scheduleId);
            }
        }


        $this->addresses = [];
        $this->phones = [];
        $this->socialNetworks = [];
        $this->workSchedules =[];
        $this->schedules = [];
        $this->temporaryBanners = [];

        $this->reset(['name','email','description','logo', 'banners']);
        $this->identificador = rand();
        $this->identificadorBanners = rand();

        $correo = new StoreRegisterMailable($store, $password);
        Mail::to($user->email)->send($correo);

        $this->emit('alert','Su registro se ha enviado correctamente');
    }

    function random_password() {  
        $longitud = 8; // longitud del password  
        $pass = substr(md5(rand()),0,$longitud);
        return $pass; // devuelve el password
    }

    public function deleteLogo() {
        $this->reset(['logo']);
        $this->identificador = rand();
    }

    public function locationsByCity(){

        $this->localities = [];

        if($this->cityId !== null){
            if($this->cityId !== 0){
                $this->city = City::find($this->cityId);
                
                if($this->city !== null){
                    $localities = $this->city->cities;
                    if(count($localities) !== 0){
                        $this->localities = $localities;
                        $this->localityId = $localities[0]->id;
                        $this->locality = $localities[0];
                    }
                }
            }else{
                $this->city = [];
            }  
        }
    }

    public function addDirection() {

        $this->validate($this->rulesAddresses, $this->messagesValidation);

        array_push($this->addresses, [
            'cityId' => $this->city->name,
            'localityId' => $this->locality->name,
            'city' => $this->city,
            'locality' => $this->locality,
            'street' => $this->street,
            'numInt' => $this->numInt,
            'postalcode' => $this->postalcode,
            'reference' => $this->reference
        ]);

        $this->reset(['cityId','locality','localityId','street','numInt','postalcode','reference']);
    }

    public function deleteDirection($directionId) {
        array_splice($this->addresses, $directionId ,1);
    }

    public function addPhonenumber(){
        $this->validate($this->rulesPhones, $this->messagesValidation);

        array_push($this->phones, [
            'typePhoneNumber' => $this->typePhoneNumber,
            'phoneNumber' => $this->phoneNumber,
        ]);

        $this->reset(['typePhoneNumber','phoneNumber']);
    }

    public function deletePhones($phoneId) {
        array_splice($this->phones, $phoneId ,1);
    }

    public function addSocialNetwork() {
        $this->validate($this->rulesSocialNetworks, $this->messagesValidation);

        array_push($this->socialNetworks, [
            'socialNetwork' => $this->socialNetwork,
            'url' => $this->url,
        ]);

        $this->reset(['socialNetwork','url']);
        $this->socialNetwork = 1;
    }

    public function deleteSocialNetwork($socialNetworkId) {
        array_splice($this->socialNetworks, $socialNetworkId ,1);
    }

    public function addWorkShedule() {

        $this->validate([
            'workDays' => ['required','array', new CheckedElement],
            'startTime' => 'required|date_format:H:i',
            'finishTime' => 'required|date_format:H:i|after:startTime',
        ], $this->messagesValidation);
        $this->getWorkShedules();
        $this->reset(['workDays','startTime','finishTime']);
    }

    public function getWorkShedules(){

        $schedules = [];
        $dayName = '';
        foreach ($this->workDays as $key => $day){
            $schedules = [
                'startTime' => $this->startTime,
                'finishTime' => $this->finishTime,
            ];
            if(!isset($this->schedules[$key])){
                $this->schedules[$key] = []; 
                array_push($this->schedules[$key],$schedules);

            }else{
                array_push($this->schedules[$key],$schedules);
            }

            switch ($day) {
                case 1:
                    $dayName = 'Lunes';
                    break;
                case 2:
                    $dayName = 'Martes';
                    break;
                case 3:
                    $dayName = 'Miércoles';
                    break;
                case 4:
                    $dayName = 'Jueves';
                    break;
                case 5:
                    $dayName = 'Viernes';
                    break;
                case 6:
                    $dayName = 'Sábado';
                    break;
                case 7:
                    $dayName = 'Domingo';
                    break;
                default:
                    # code...
                    break;
            }

            $this->workSchedules[$key] = [
                'dayNumber' => $this->workDays[$key],
                'dayName' => $dayName,
                'schedules' => $this->schedules[$key],
            ];

            $schedules = [];
        }

    }

    public function saveWorkSchedule($schedules, $day) {

        $workSchedule = WorkShedule::where('start_time', $schedules['startTime'])
                                    ->where('finish_time', $schedules['finishTime'])
                                    ->where('day', $day)
                                    ->first();
        
        if($workSchedule === null) {
            $workSchedule =  WorkShedule::create([
                'start_time' => $schedules['startTime'],
                'finish_time' => $schedules['finishTime'],
                'day' => $day,
            ]);
        }

        return $workSchedule->id;
    }

    public function deleteSchedule($dayId,$scheduleId) {
        array_splice($this->workSchedules[$dayId]['schedules'], $scheduleId, 1);
        array_splice($this->schedules[$dayId], $scheduleId, 1);


        if(count($this->workSchedules[$dayId]['schedules']) === 0){
            unset($this->workSchedules[$dayId]);            
        }
    }

    public function updatedBanners() {
        $this->getTemporaryBanners();
    }

    public function addTemporaryImages(Request $request) {
        $url = Storage::put('companies', $request->file('file'));
        
        $this->emitSelf('addBanner',$url);
    }

    public function addBanner($url) {
        array_push($this->temporaryBanners, $url);
    }

    public function getTemporaryBanners() {
        
        $this->validate($this->rulesBanners, $this->messagesValidation);

        foreach ($this->banners as $banner) {
            if(count($this->temporaryBanners) < 5) {
                array_push($this->temporaryBanners, $banner);
            }
        }
        $this->reset(['banners']);
        $this->banners = [];
        $this->identificadorBanners = rand();
        
    }

    public function deleteBanner($bannerId) {
        array_splice($this->temporaryBanners, $bannerId ,1);
    }
}
