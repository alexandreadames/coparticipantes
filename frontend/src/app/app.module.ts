import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

import { AppRoutingModule } from './app.routing';
import { AppComponent } from './app.component';

//My components and Modules
import { LoginComponent } from './login/login.component';
import { NavbarComponent } from './shared/navbar/navbar.component';
import { LandingComponent } from './landing/landing.component';
import { AdminComponent } from './admin/admin.component';
import { AdminModule } from './admin/admin.module';
import { RegisterComponent } from './register/register.component';

//My Services
import { UserService } from './services/user.service';
import { AuthService } from './services/auth-service';
import { AuthGuardService } from './services/auth-guard.service';




@NgModule({
  imports: [
    BrowserAnimationsModule,
    FormsModule,
    HttpClientModule,
    AdminModule,
    RouterModule,
    AppRoutingModule,
    NgbModule.forRoot()
  ],
  declarations: [
    AppComponent,
    AdminComponent,
    NavbarComponent,
    LandingComponent,
    LoginComponent,
    RegisterComponent
  ],
  providers: [
    UserService,
    AuthGuardService, 
    AuthService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
