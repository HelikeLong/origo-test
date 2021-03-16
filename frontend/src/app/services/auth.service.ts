import { Injectable } from '@angular/core';
import {BehaviorSubject} from "rxjs";
import {Router} from "@angular/router";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {environment} from "../../environments/environment";

const httpOptions = {
  headers: new HttpHeaders().set('Content-Type', 'application/json')
};
@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private authState: BehaviorSubject<number> = new BehaviorSubject(0);
  private loginApi: string = environment.apiUrl + 'auth/login';
  private logoutApi: string = environment.apiUrl + 'auth/logout';

  constructor(
      private router: Router,
      private http: HttpClient
  ) {
    this.authState.next(window.localStorage.getItem('USER_DATA') ? 1 : 2);
  }

  /**
   * Authenticate and login user
   * @param formData
   * @return void|HttpErrorResponse
   */
  login(formData) {
    try {
      // Get access token and store it
      this.http.post(this.loginApi, formData, httpOptions).subscribe((token: any) => {
        window.localStorage.setItem('USER_DATA', token.access_token);
        this.authState.next(1);
      });
      return true;
    } catch (e) {
      console.log(e);
      return false;
    }
  }

  /**
   * Logout the current user
   */
  logout() {
    this.http.post(this.logoutApi, {}, httpOptions).subscribe(() => {
      window.localStorage.removeItem('USER_DATA');
      this.authState.next(2);
      this.router.navigate(['']);
    });
  }

  /**
   * Return Authentication state object
   * @return BehaviorSubject
   */
  getAuthState(): BehaviorSubject<number> {
    return this.authState;
  }
}
