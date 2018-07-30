import { AdminComponent } from './admin.component';
import { Routes } from '@angular/router';

import { DashboardComponent } from './components/dashboard/dashboard.component';
import { IconsComponent } from './components/icons/icons.component';


export const AdminRoutes: Routes = [
    {
      path: 'admin',
      component: AdminComponent,
      //canActivate: [AuthGuard],
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
        }
      ]
      
    }/*,
    { path: '404', component: NotfoundComponent },
    { path: '**', redirectTo: '404' }*/
  ]
