<?php

namespace App\Http\Livewire\Dashboard\Stores;

use App\Models\City;
use App\Models\Company;
use App\Models\Image;
use App\Models\Location;
use App\Models\Phone;
use App\Models\SocialNetwork;
use App\Models\User;
use App\Models\WorkShedule;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Rules\CheckedElement;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    public $store, $user;
    public $cities, $cityId, $city, $localities = [], $localityId, $locality;
    public $addresses, $street, $number, $postalcode, $reference;
    public $phoneNumber, $phones;
    public $socialNetwork, $url, $socialNetworks;
    public $days, $workDays, $startTime, $finishTime, $workSchedules, $schedules;
    public $logo, $identificador;
    public $banners, $temporaryBanners, $identificadorBanners;

    protected $listeners = [
        'refreshStore',
        'refreshUser',
    ];

    protected $rules = [
        'store.name' => 'required',
        'store.slug' => 'required',
        'store.description' => 'required',
        'store.priority' => '',
        'store.status' => '',
        'user.email' => ''
    ];

    protected $rulesAddresses = [
        'cityId' => 'required|numeric|min:1',
        'localityId' => 'required',
        'street' => 'required',
        'number' => 'required|numeric|integer',
        'postalcode' => 'required|numeric|digits:5',
        'reference' => 'max:50',
    ];

    protected $rulesPhones = [
        'phoneNumber' => 'required|numeric|digits:10',
    ];

    protected $rulesSocialNetworks = [
        'socialNetwork' => 'required|numeric|min:1',
        'url' => 'required|url',
    ];

    protected $messagesValidation = [
        'store.name.required' => 'El nombre de la tienda es requerido',
        'store.slug.required' => 'El slug requerido',
        'store.description.required' => 'La descripción es requerida',
        'user.email.required' => 'El email de contacto es requerido',
        'user.email.unique' => 'El email proporcionado ya se encuentra regitrado para otro negocio, proporciona otro',
    ];
    
    public $form = [
        'title' => null,
        'action' => null,
        'actionButton' => null,
    ];

    public function mount(Company $store) {
        $this->store = $store;
        $this->user = $this->store->user;

        $this->form['title'] = 'Editar negocio';
        $this->form['action'] = 'update';
        $this->form['actionButton'] = 'Actualizar';

        $this->identificador = rand();
        $this->identificadorBanners = rand();

        $this->getAddresses();
        $this->getPhones();
        $this->getSocialNetworks();
        $this->getSchedules();

        $this->socialNetwork = 1;
        $this->workDays = [];
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

        $this->cities = City::where('parent_id',null)->get();
        $this->localities = [];
        $this->cityId = 0;
    }

    public function updatedStoreName($value){
        $this->store->slug = Str::slug($value);
    }

    public function updated() {
        $this->getTemporaryBanners();
    }

    public function updatedCityId() {
        $this->locationsByCity();
    }

    public function render()
    {
        $header = '';
        return view('livewire.dashboard.stores.edit')->layout('layouts.dashboard', compact('header'));
    }

    public function create() {
        $this->open_edit = true;
        $this->store = new Company();
        $this->user = new User();

        $this->form['title'] = 'Crear negocio';
        $this->form['action'] = 'save';
        $this->form['actionButton'] = 'Guardar';
    }

    public function edit($store) {
        $this->store = Company::find($store);
        $this->user = new User();
        $this->user->email = $this->store->user->email;
        $this->open_edit = true;

        $this->form['title'] = 'Editar negocio';
        $this->form['action'] = 'update';
        $this->form['actionButton'] = 'Actualizar';
    }

    public function update() {
        $this->validate([
            'store.name' => 'required',
            'store.slug' => 'required',
            'store.description' => 'required',
            'store.priority' => '',
            'store.status' => '',
            'user.email' => 'required|email|unique:users,email,'.$this->user->id
        ], $this->messagesValidation);

        $this->store->save();
        
        // foreach ($this->addresses as $address) {
        //     Location::create([
        //         'street' => $address['street'],
        //         'number' => intval($address['numInt']),
        //         'postal_code' => intval($address['postalcode']),
        //         'reference' => $address['reference'],
        //         'city_id' => $address['locality']['id'],
        //         'company_id' => $this->store->id,
        //     ]);
        // }

        // foreach ($this->phones as $phone) {
        //     Phone::create([
        //         'phone_number' => $phone['phoneNumber'],
        //         'company_id' => $this->store->id,
        //     ]);
        // }

        // foreach ($this->socialNetworks as $socialNetwork) {
        //     SocialNetwork::create([
        //         'url' => $socialNetwork['url'],
        //         'type' => $socialNetwork['socialNetwork'],
        //         'company_id' => $this->store->id,
        //     ]);
        // }

        // foreach ($this->workSchedules as $workSchedule) {
        //     WorkShedule::create([
        //         'work_shedule_id ' => $workSchedule['id'],
        //         'company_id' => $this->store->id,
        //     ]);
        // }

        $this->emit('alert', 'El negocio se actualizó satisfactoriamente');
    }

    public function save() {
        $this->validate([ 
            'store.name' => 'required',
            'store.slug' => 'required',
            'store.description' => 'required',
            'user.email' => 'required|email|unique:users,email,'.$this->user->id
        ], $this->messagesValidation);
        

        $logo = $this->image->store('users');

        $this->user->name = $this->store->name;
        $this->user->password = $this->random_password();
        $this->type = 2;
        $this->user->save();

        $this->store->user_id = $this->user->id;
        $this->store->save();

        $this->reset(['user']);
        $this->emit('alert', 'El negocio se agregó correctamente');
    }

    function random_password() {  
        $longitud = 8; // longitud del password  
        $pass = substr(md5(rand()),0,$longitud);
        return $pass; // devuelve el password
    }

    // public function deleteLogo() {
    //     $this->reset(['logo']);
    //     $this->identificador = rand();
    // }

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

    // METODOS PARA LAS DIRECCIONES DE LOS NEGOCIOS

    public function getAddresses() {
        $this->addresses = Location::where('company_id',$this->store->id)->get();
    }

    public function addDirection() {
        $this->validate($this->rulesAddresses);

        Location::create([
            'street' => $this->street,
            'number' => intval($this->number),
            'postal_code' => intval($this->postalcode),
            'reference' => $this->reference,
            'city_id' => $this->locality->id,
            'company_id' => $this->store->id,
        ]);

        $this->getAddresses();
        $this->reset(['cityId','locality','localityId','street','number','postalcode','reference']);
    }

    public function deleteDirection(Location $direction) {
        $direction->delete();
        $this->getAddresses();
    }

    // METODOS PARA LOS NÚMEROS DE TELÉFONO

    public function getPhones() {
        $this->phones =  Phone::where('company_id',$this->store->id)->get();
    }

    public function addPhonenumber(){
        $this->validate($this->rulesPhones);

        Phone::create([
            'phone_number' => $this->phoneNumber,
            'type' => 1,
            'company_id' => $this->store->id,
        ]);

        $this->getPhones();

        $this->reset(['phoneNumber']);
    }

    public function deletePhones(Phone $phone) {
        $phone->delete();
        $this->getPhones();
    }

    // METODOS PARA LAS REDES SOCIALES

    public function getSocialNetworks() {
        $this->socialNetworks =  SocialNetwork::where('company_id',$this->store->id)->get();
    }

    public function addSocialNetwork() {
        $this->validate($this->rulesSocialNetworks);

        SocialNetwork::create([
            'url' => $this->url,
            'type' => $this->socialNetwork,
            'company_id' => $this->store->id,
        ]);

        $this->getSocialNetworks();
        $this->reset(['socialNetwork','url']);
        $this->socialNetwork = 1;
    }

    public function deleteSocialNetwork(SocialNetwork $socialNetwork) {
        $socialNetwork->delete();
        $this->getSocialNetworks();
    }

    // METODOS PARA LOS HORARIOS DE TRABAJO

    public function getSchedules() {
        $this->workSchedules = [];
        $wschedules =  $this->store->workSchedules;
        // $this->getWorkShedulesList($wschedules);

        // $schedules = [];
        // $dayName = '';
        foreach ($wschedules as $key => $value) {
            $schedules = [
                'startTime' => $value->start_time,
                'finishTime' => $value->finish_time,
                'id' => $value->id,
            ];
            $this->getWorkShedulesList($value->day, $schedules);
        }
    }

    public function getWorkShedulesList($day, $schedules) {
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

        if(!isset($this->workSchedules[$day])){
            $this->workSchedules[$day] = [
                'dayNumber' => $day,
                'dayName' => $dayName,
                'schedules' => [],
            ];
        }            
        array_push($this->workSchedules[$day]['schedules'],$schedules);
        
    }

    public function addWorkShedule() {

        $this->validate([
            'workDays' => ['required','array', new CheckedElement],
            'startTime' => 'required|date_format:H:i',
            'finishTime' => 'required|date_format:H:i|after:startTime',
        ], $this->messagesValidation);

        // $this->getWorkShedules();
        $schedules = [
            'startTime' => $this->startTime,
            'finishTime' => $this->finishTime,
        ];
        foreach ($this->workDays as $key => $day) {
            $scheduleId = $this->saveWorkSchedule($schedules, $day);

            $this->store->workSchedules()->attach($scheduleId);
            $schedules['id'] = $scheduleId;
            $this->getWorkShedulesList($day,$schedules);
        }

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

            $workScheduleId = $this->saveWorkSchedule($schedules, $day);

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
                'id' => $workScheduleId,
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

    public function deleteSchedule($dayId, $id, $scheduleId) {
        array_splice($this->workSchedules[$dayId]['schedules'], $id, 1);
        $this->store->workSchedules()->detach($scheduleId);

        if(count($this->workSchedules[$dayId]['schedules']) === 0){
            unset($this->workSchedules[$dayId]);            
        }
    }

    // METODOS PARA LOS BANNERS

    public function getTemporaryBanners() {
        
        foreach ($this->banners as $banner) {
            array_push($this->temporaryBanners, $banner);
        }
        $this->reset(['banners']);
        $this->banners = [];
        $this->identificadorBanners = rand();

    }

    public function deleteBanner(Image $banner) {
        Storage::delete([$banner->url]);
        $banner->delete();

        $this->store = $this->store->fresh();
        // array_splice($this->temporaryBanners, $bannerId ,1);
    }

    public function refreshStore(){
        $this->store = $this->store->fresh();
    }

    // METODOS PARA EL LOGOTIPO
    public function deleteLogo(Image $logo) {
        Storage::delete([$logo->url]);
        $logo->delete();

        $this->store->user = $this->store->user->fresh();
        // array_splice($this->temporaryBanners, $bannerId ,1);
    }

    public function refreshUser(){
        $this->store->user = $this->store->user->fresh();
    }

}
