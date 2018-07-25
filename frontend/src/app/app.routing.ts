import { LandingComponent } from './landing/landing.component';
import { AdminComponent } from './admin/admin.component';
import { NgModule } from '@angular/core';
import { CommonModule, } from '@angular/common';
import { BrowserModule  } from '@angular/platform-browser';
import { Routes, RouterModule } from '@angular/router';

/*const routes: Routes =[
  {
    path: '',
    redirectTo: 'admin',
    pathMatch: 'full',
  }, {
    path: '',
    component: AdminComponent,
    children: [
        {
      path: '',
      loadChildren: './admin/admin.module#AdminModule'
  }]},
  {
    path: '**',
    redirectTo: 'admin'
  }

];*/

const routes: Routes =[
  {
    path: '',
    component: LandingComponent
  }, {
    path: 'admin',
    component: AdminComponent,
    children: [
        {
      path: '',
      loadChildren: './admin/admin.module#AdminModule'
  }]}
];


@NgModule({
  imports: [
    CommonModule,
    BrowserModule,
    RouterModule.forRoot(routes)
  ],
  exports: [
  ],
})
export class AppRoutingModule { }
