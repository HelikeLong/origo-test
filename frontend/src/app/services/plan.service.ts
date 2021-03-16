import { Injectable } from '@angular/core';
import {environment} from "../../environments/environment";
import {HttpClient, HttpHeaders} from "@angular/common/http";

const httpOptions = {
  headers: new HttpHeaders().set('Content-Type', 'application/json')
};
@Injectable({
  providedIn: 'root'
})
export class PlanService {
  private planUrl = environment.apiUrl + 'plans';

  constructor(
      private http: HttpClient
  ) { }

  get(): Promise<any> {
    return this.http.get(`${this.planUrl}`, httpOptions).toPromise() as Promise<any>;
  }
}
