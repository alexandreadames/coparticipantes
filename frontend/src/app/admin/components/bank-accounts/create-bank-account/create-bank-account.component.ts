import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import * as $ from 'jquery';

declare var Moip: any;

//Models
import { BankAccount } from './../../../../models/BankAccount';
import { Bank } from './../../../../models/Bank';
import { AccountType } from './../../../../models/AccountType';

//enviroment
import { environment } from 'environments/environment';

interface AccountBankValidationErrors {
  invalidBankNumber: {
    code: string,
    msg: string
  },
  invalidAgencyNumber: {
    code: string,
    msg: string
  },
  invalidAgencyCheckNumber: {
    code: string,
    msg: string
  },
  invalidAccountNumber: {
    code: string,
    msg: string
  },
  invalidAccountCheckNumber: {
    code: string,
    msg: string
  },
  invalidAgencyCheckNumberDontMatch: {
    code: string,
    msg: string
  },
  invalidAccountCheckNumberDontMatch: {
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

  banks: Bank[];
  accountTypes: AccountType[];
  bank: BankAccount = {
    id_bank: 0,
    agencyNumber: 0,
    agencyCheckNumber: 0,
    accountNumber: 0,
    accountCheckNumber: 0,
    id_account_type: 0
  };

  abv_errors: AccountBankValidationErrors = {
    invalidBankNumber:{
      code: 'INVALID_BANK_NUMBER',
      msg: ''
    },
    invalidAgencyNumber:{
      code: 'INVALID_AGENCY_NUMBER',
      msg: ''
    },
    invalidAgencyCheckNumber: {
      code: 'INVALID_AGENCY_CHECK_NUMBER',
      msg: ''
    },
    invalidAccountNumber:{
      code: 'INVALID_ACCOUNT_NUMBER',
      msg: ''
    },
    invalidAccountCheckNumber:{
      code: 'INVALID_ACCOUNT_CHECK_NUMBER',
      msg: ''
    },
    invalidAgencyCheckNumberDontMatch:{
      code: 'AGENCY_CHECK_NUMBER_DONT_MATCH',
      msg: ''
    },
    invalidAccountCheckNumberDontMatch:{
      code: 'ACCOUNT_CHECK_NUMBER_DONT_MATCH',
      msg: ''
    }
  };

  selectedBank: Bank = {
    id: 0,
    name: null,
    initials: null,
    code: "0",
    jurisdiction: null,
    website: null,
    id_country: 0

  };

  selectedAccountType: AccountType = {
    id: 0,
    description: ''
  }

  baseApiUrl: string = environment.baseApiUrl;
  banksUrl: string = `${this.baseApiUrl}/secure/banks`;
  accountTypesUrl: string = `${this.baseApiUrl}/secure/accounttypes`;

  constructor(private http: HttpClient) { 
  }

  ngOnInit() {
    this.loadBanks();
    this.loadAccountTypes();
  }

  loadBanks() {

    this.http.get<Bank[]>(this.banksUrl,{

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

  loadAccountTypes() {

    this.http.get<AccountType[]>(this.accountTypesUrl,{

      headers: new HttpHeaders().set('Authorization', 'Bearer '+localStorage.getItem("userToken"))
  
    }).subscribe(
      res => {
        console.log("RESPONSE=>", res);
        this.accountTypes = res;
    },
        err => {
          console.log("ERROR=>",err);

        }
  );

  }

  validate(){
    let $ = this;
    //Clear errors msgs
    this.clearErrorsMsgs();
    //Use moip library account validator in front
    Moip.BankAccount.validate({
      bankNumber         : this.selectedBank.code,
      agencyNumber       : this.bank.agencyNumber,
      agencyCheckNumber  : this.bank.agencyCheckNumber,
      accountNumber      : this.bank.accountNumber,
      accountCheckNumber : this.bank.accountCheckNumber,
      valid: function() {
        //if valid bank account show data
        console.log("Conta bancária válida");
        console.log("ACCOUNT DATA=>",$.bank);
        console.log("SELECTED BANK=>", $.selectedBank);
        console.log("SELECTED ACCOUNT TYPE=>",$.selectedAccountType);
      },
      invalid: function(data) {
        let errors = "Conta bancária inválida: \n";
        for(let i in data.errors){
          errors += data.errors[i].description + "-" + data.errors[i].code + ")\n";
          //console.log(data.errors[i].code, data.errors[i].description);
          switch (data.errors[i].code) {
              case $.abv_errors.invalidBankNumber.code:
                $.abv_errors.invalidBankNumber.msg = data.errors[i].description
              break;
              case $.abv_errors.invalidAgencyNumber.code:
                $.abv_errors.invalidAgencyNumber.msg = data.errors[i].description
              break;
              case $.abv_errors.invalidAgencyCheckNumber.code:
                $.abv_errors.invalidAgencyCheckNumber.msg = data.errors[i].description
              break; 
              case $.abv_errors.invalidAccountNumber.code:
                $.abv_errors.invalidAccountNumber.msg = data.errors[i].description
              break;
              case $.abv_errors.invalidAccountCheckNumber.code:
                $.abv_errors.invalidAccountCheckNumber.msg = data.errors[i].description
              break;
              case $.abv_errors.invalidAgencyCheckNumberDontMatch.code:
                $.abv_errors.invalidAgencyCheckNumberDontMatch.msg = data.errors[i].description
              break;
              case  $.abv_errors.invalidAccountCheckNumberDontMatch.code:
                $.abv_errors.invalidAccountCheckNumberDontMatch.msg = data.errors[i].description
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
  }

  clearErrorsMsgs(){
   this.abv_errors.invalidBankNumber.msg = '';
   this.abv_errors.invalidAgencyNumber.msg = '';
   this.abv_errors.invalidAgencyCheckNumber.msg = '';
   this.abv_errors.invalidAccountNumber.msg = '';
   this.abv_errors.invalidAccountCheckNumber.msg = '';
   this.abv_errors.invalidAgencyCheckNumberDontMatch.msg = '';
   this.abv_errors.invalidAccountCheckNumberDontMatch.msg = '';
  }

}
