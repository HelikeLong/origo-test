import { Component, OnInit } from '@angular/core';
import {Client} from "../../models/Client";
import {ClientService} from "../../services/client.service";
import {AuthService} from "../../services/auth.service";

@Component({
  selector: 'app-clients',
  templateUrl: './clients.component.html',
  styleUrls: ['./clients.component.scss']
})
export class ClientsComponent implements OnInit {
  clients: Client[];
  clientForm?: Client = null;
  showForm: boolean = false;

  constructor(
    private clientService: ClientService,
    private authService: AuthService
  ) { }

  async ngOnInit() {
    this.clients = (await this.clientService.get()).data as Client[];
  }

  toggleForm(value) {
    this.showForm = value;
    if (!value) {
      this.clientForm = null;
    }
  }

  logout () {
    this.authService.logout();
  }

  delete(id) {
    this.clientService.delete(id)
      .then((res) => {
        this.clients = this.clients.filter((client) => {
          return client.id !== id;
        });
      })
      .catch((res) => {
        alert(res.error.message);
      });
  }

  edit(id) {
    this.clientForm = this.clients.filter((client) => {
      return client.id === id;
    }).pop();
    this.toggleForm(true);
  }

  save(client: Client) {
    this.clientService.store(client, client.id)
      .then(async () => {
        this.clients = (await this.clientService.get()).data as Client[];
        this.toggleForm(false);
      })
      .catch((res) => {
        alert(Object.keys(res.error).map( (err) => res.error[err] ).join('\n'));
      });
  }
}
