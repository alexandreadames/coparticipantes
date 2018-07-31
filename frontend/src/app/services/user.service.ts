import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
/*import { Observable, of } from 'rxjs';
import { catchError, map, tap } from 'rxjs/operators';*/

//enviroment
import { environment } from '../../environments/environment';

//Models
import { User } from './../models/User';


@Injectable()
export class UserService {

  baseApiUrl: string = environment.baseApiUrl;
  //testUrl: string = `${this.baseApiUrl}/test/register/error`;
  registerUrl: string = `${this.baseApiUrl}/user/register`;

  constructor(private http: HttpClient) { }

  public register(user: User) {
   return this.http.post<any>(this.registerUrl, user).pipe(
    res=>res, 
    err=>err
   )
  }

}
