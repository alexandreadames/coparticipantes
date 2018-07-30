//Native Components
import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {NgbDatepickerConfig, NgbDateStruct} from '@ng-bootstrap/ng-bootstrap';

//enviroment
import { environment } from '../../environments/environment';

//Models
import { User } from './../models/User';



@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss'],
  providers: [NgbDatepickerConfig] // add NgbDatepickerConfig to the component providers
})
export class RegisterComponent implements OnInit {

  states : any[];
  cities: any[];
  selectedState: any;
  selectedCity: any;
  baseApiUrl: string = environment.baseApiUrl;
  locationUrl: string = `${this.baseApiUrl}/location`;
  user: User = {
    email: '',
    password: '',
    name: '',
    phone: '',
    street: '',
    street_number: null,
    district: '',
    additional_address_details: '',
    zip_code: '',
    id_city: null,
    type: null,
    cpf_cnpj: '',
    date_of_birth: '',
    sex: ''
  };

  //Form Models
  //Model of ngdatepicker
  dateOfBirth;
  userPassword;
  userPasswordRetyped;
  //Fisic Person by default...
  personType = "1";

  constructor(
    private http: HttpClient,
    config: NgbDatepickerConfig
  ) { 
    // customize default values of datepickers used by this component tree
    //Calculate initial and end date for date of birth
    const now = new Date();

    config.minDate = {year: now.getFullYear() - 120, month: 1, day: 1};
    config.maxDate = {year: now.getFullYear() - 18, month: now.getMonth()+1, day: now.getDate()};
  }

  ngOnInit() {
    this.loadStates();
  }

  loadStates(){
    let statesLocationUrl = `${this.locationUrl}/states`;
    this.http.get<any>(statesLocationUrl).subscribe(
      res => {
      console.log("RESULT=>", res);
      this.states = res.data.states;
      this.selectedState = this.states[0].state_id;
      this.loadCities();
    },
        err => {
          console.log("ERROR=>",err);
        }
  );
  }	

  loadCities(){
    let citiesLocationUrl = `${this.locationUrl}/cities/${this.selectedState}`;
    this.http.get<any>(citiesLocationUrl).subscribe(
      res => {
      console.log("RESULT=>", res);
      this.cities = res.data.cities;
      this.selectedCity = this.cities[0].city_id;
    },
        err => {
          console.log("ERROR=>",err);
        }
  );
  }
  
  //Load Location by cep using viacep api
  loadLocation() {
    let fullLocationUrl = `${this.locationUrl}/${this.user.zip_code}`;
    this.http.get<any>(fullLocationUrl).subscribe(
      res => {
      console.log("RESULT=>", res);
      this.cities = res.data.selected_cities;
      this.selectedCity = res.data.selected_location.city_id;
      this.selectedState = res.data.selected_location.state_id;
    },
        err => {
          console.log("ERROR=>",err);
        }
  );
  }
  
  updateState(){

  }
}
