import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {environment} from "../../environments/environment";

const httpOptions = {
  headers: new HttpHeaders().set('Content-Type', 'application/json')
};
@Injectable({
  providedIn: 'root'
})
export class ClientService {
  private clientUrl = environment.apiUrl + 'clients';

  constructor(
      private http: HttpClient
  ) { }

  get(id?): Promise<any> {
    id = typeof id === "undefined" ? '' : id;
    return this.http.get(`${this.clientUrl}/${id}`, httpOptions).toPromise() as Promise<any>;
  }

  store(client, id?): Promise<any> {
    if (id) {
      return this.http.put(`${this.clientUrl}/${id}`, client, httpOptions).toPromise() as Promise<any>;
    } else {
      return this.http.post(`${this.clientUrl}`, client, httpOptions).toPromise() as Promise<any>;
    }
  }

  delete(id): Promise<any> {
    return this.http.delete(`${this.clientUrl}/${id}`, httpOptions).toPromise() as Promise<any>;
  }
}
