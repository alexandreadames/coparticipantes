import { BankAccountsComponent } from './components/bank-accounts/bank-accounts.component';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { ChartsModule } from 'ng2-charts';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
//import { ToastrModule } from 'ngx-toastr';

import { AdminNavbarComponent } from './admin-navbar/admin-navbar.component';
import { AdminSidebarComponent } from './admin-sidebar/admin-sidebar.component';
import { AdminFooterComponent } from './admin-footer/admin-footer.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { IconsComponent } from './components/icons/icons.component';

import { AdminRoutes } from './admin-routing';
import { CreateBankAccountComponent } from './components/bank-accounts/create-bank-account/create-bank-account.component';



@NgModule({
  imports: [
    RouterModule.forChild(AdminRoutes),
    CommonModule,
    ChartsModule,
    NgbModule,
    FormsModule,
    HttpClientModule,
    //ToastrModule.forRoot()
  ],
  declarations: [
    AdminNavbarComponent,
    AdminSidebarComponent,
    AdminFooterComponent,
    DashboardComponent,
    IconsComponent,
    BankAccountsComponent,
    CreateBankAccountComponent
  ],
  exports: [
    AdminNavbarComponent,
    AdminSidebarComponent,
    AdminFooterComponent
  ]
})
export class AdminModule { }
