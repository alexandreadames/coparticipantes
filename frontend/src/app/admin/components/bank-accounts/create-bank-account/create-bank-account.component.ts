import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import * as $ from 'jquery';

declare var Moip: any;

//Models
import { BankAccount } from './../../../../models/BankAccount';
import { Bank } from './../../../../models/Bank';


//enviroment
import { environment } from 'environments/environment';

interface AccountBankValidationErrors {
  invalidAgencyNumber: {
    code: string,
    msg: string
  },
  invalidAgencyCheckNumber: {
    code: string,
    msg: string
  }
};

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

  abv_errors: AccountBankValidationErrors = {
    invalidAgencyNumber:{
      code: 'INVALID_AGENCY_NUMBER',
      msg: ''
    },
    invalidAgencyCheckNumber: {
      code: 'INVALID_AGENCY_CHECK_NUMBER',
      msg: ''
    }
  };

  selectedBank: Bank;
  baseApiUrl: string = environment.baseApiUrl;
  banksUrl: string = `${this.baseApiUrl}/secure/banks`;

  constructor(private http: HttpClient) { 
  }

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
    let $ = this;
    //Clear errors msgs
    $.abv_errors.invalidAgencyNumber.msg = '';
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
        let errors = "Conta bancária inválida: \n";
        for(let i in data.errors){
          errors += data.errors[i].description + "-" + data.errors[i].code + ")\n";
          //console.log(data.errors[i].code, data.errors[i].description);
          switch (data.errors[i].code) {
            case $.abv_errors.invalidAgencyNumber.code:
              $.abv_errors.invalidAgencyNumber.msg = data.errors[i].description
              break;
              case $.abv_errors.invalidAgencyCheckNumber.code:
              $.abv_errors.invalidAgencyCheckNumber.msg = data.errors[i].description
              break;  
          
            default:
              break;
          }  
          // if (data.errors[i].code === $.abv_errors.invalidAgencyNumber.code){
          //   $.abv_errors.invalidAgencyNumber.msg = data.errors[i].description
          // }
        }
        console.log("VALIDATION ERRORS",errors);
      }
    });
    console.log("ACCOUNT DATA=>",this.bank);
    console.log("SELECTED BANK=>", this.selectedBank);
  }

}
