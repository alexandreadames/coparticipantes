import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import 'bank-account-validator/dist/bank-account-validator.min';

declare var Moip: any;

//Models
import { BankAccount } from './../../../../models/BankAccount';


//enviroment
import { environment } from 'environments/environment';

@Component({
  selector: 'app-create-bank-account',
  templateUrl: './create-bank-account.component.html',
  styleUrls: ['./create-bank-account.component.scss']
})
export class CreateBankAccountComponent implements OnInit {

  banks: {};
  bank: BankAccount = {
    id_bank: 0,
    agencyNumber: 0,
    agencyCheckNumber: 0,
    accountNumber: 0,
    accountCheckNumber: 0,
    id_account_type: 0
  };
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

  validate(){
    //Use moip library account validator in front
    Moip.BankAccount.validate({
      bankNumber         : this.selectedBank.code,
      agencyNumber       : this.bank.agencyNumber,
      agencyCheckNumber  : this.bank.agencyCheckNumber,
      accountNumber      : this.bank.accountNumber,
      accountCheckNumber : this.bank.accountCheckNumber,
      valid: function() {
        alert("Conta bancária válida")
      },
      invalid: function(data) {
        var errors = "Conta bancária inválida: \n";
        for(let i in data.errors){
          errors += data.errors[i].description + "-" + data.errors[i].code + ")\n";
        }
        alert(errors);
      }
    });
    console.log("ACCOUNT DATA=>",this.bank);
    console.log("SELECTED BANK=>", this.selectedBank);
  }

}
