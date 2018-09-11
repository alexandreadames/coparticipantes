import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';

//enviroment
import { environment } from 'environments/environment';

@Component({
  selector: 'app-bank-accounts',
  templateUrl: './bank-accounts.component.html',
  styleUrls: ['./bank-accounts.component.scss']
})
export class BankAccountsComponent implements OnInit {

  userBankAccounts = [];
  baseApiUrl: string = environment.baseApiUrl;
  userBankAccountUrl: string = `${this.baseApiUrl}/secure/user/bankaccount`;

  constructor(private http: HttpClient) { }

  ngOnInit() {
    this.loadBankAccounts()
  }

  loadBankAccounts(){
    this.http.get<any[]>(this.userBankAccountUrl,{

      headers: new HttpHeaders().set('Authorization', 'Bearer '+localStorage.getItem("userToken"))
  
    }).subscribe(
      res => {
        console.log("RESPONSE=>", res);
        this.userBankAccounts = res;
    },
        err => {
          console.log("ERROR=>",err);

        }
  );
  }

}
