import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';

import { ChartsModule } from 'ng2-charts';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
//import { ToastrModule } from 'ngx-toastr';

import { AdminNavbarComponent } from './admin-navbar/admin-navbar.component';
import { AdminSidebarComponent } from './admin-sidebar/admin-sidebar.component';
import { AdminFooterComponent } from './admin-footer/admin-footer.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';

import { AdminRoutes } from './admin-routing';



@NgModule({
  imports: [
    RouterModule.forChild(AdminRoutes),
    CommonModule,
    ChartsModule,
    NgbModule,
    //ToastrModule.forRoot()
  ],
  declarations: [
    AdminNavbarComponent,
    AdminSidebarComponent,
    AdminFooterComponent,
    DashboardComponent
  ],
  exports: [
    AdminNavbarComponent,
    AdminSidebarComponent,
    AdminFooterComponent
  ]
})
export class AdminModule { }
