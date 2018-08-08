import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';

//enviroment
import { environment } from 'environments/environment';

@Component({
  selector: 'app-create-bank-account',
  templateUrl: './create-bank-account.component.html',
  styleUrls: ['./create-bank-account.component.scss']
})
export class CreateBankAccountComponent implements OnInit {

  banks: {};
  selectedBank: number;
  baseApiUrl: string = environment.baseApiUrl;
  banksUrl: string = `${this.baseApiUrl}/secure/banks`;

  constructor(private http: HttpClient) { }

  ngOnInit() {
    this.loadBanks();
  }

  loadBanks() {

    this.http.get(this.banksUrl,{

      headers: new HttpHeaders().set('Authorization', 'Bearer '+localStorage.getItem("userToken"))
  
    }).subscribe(
      res => {
        console.log("RESPONSE=>", res);
        this.banks = res;
    },
        err => {
          console.log("ERROR=>",err);

        }
  );

  }

}
