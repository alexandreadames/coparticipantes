import { CreateBankAccountComponent } from './components/bank-accounts/create-bank-account/create-bank-account.component';
import { BankAccountsComponent } from './components/bank-accounts/bank-accounts.component';
import { AdminComponent } from './admin.component';
import { Routes } from '@angular/router';

import { DashboardComponent } from './components/dashboard/dashboard.component';
import { IconsComponent } from './components/icons/icons.component';
import { 
  AuthGuardService as AuthGuard 
} from '../services/auth-guard.service';

export const AdminRoutes: Routes = [
    {
      path: 'admin',
      component: AdminComponent,
      canActivate: [AuthGuard],
      children: [
        {
          path: '',
          redirectTo: 'dashboard',
          pathMatch: 'full'
        },
        {
          path: 'dashboard',
          component: DashboardComponent
        },
        {
          path: 'icons',
          component: IconsComponent
        },
        {
          path: 'bank-accounts',
          component: BankAccountsComponent
        },
        {
          path: 'bank-accounts/create',
          component: CreateBankAccountComponent
        }
      ]
      
    }/*,
    { path: '404', component: NotfoundComponent },
    { path: '**', redirectTo: '404' }*/
  ]
